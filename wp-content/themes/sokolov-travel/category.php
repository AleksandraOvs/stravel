<?php

/**
 * Category template with AJAX subcategory loading (vanilla JS + active class + loader)
 *
 * @package tours
 */

get_header();
?>

<main id="primary" class="site-main category-page">

    <header class="entry-header">
        <div class="container">
            <ul class="breadcrumbs__list">
                <?php site_breadcrumbs(); ?>
            </ul>

            <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
            <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
        </div>
    </header>

    <div class="container">
        <div class="container__inner">
            <?php
            $current_cat = get_queried_object();

            // Подкатегории текущей категории
            $subcategories = get_categories(array(
                'child_of'   => $current_cat->term_id,
                'hide_empty' => 0
            ));

            if ($subcategories) : ?>
                <nav class="category-subcategories">
                    <a href="#"
                        class="subcategory-link"
                        data-cat-id="<?php echo $current_cat->term_id; ?>">
                        Показать все
                    </a>
                    <?php foreach ($subcategories as $subcategory) : ?>
                        <a href="#"
                            class="subcategory-link"
                            data-cat-id="<?php echo $subcategory->term_id; ?>">
                            <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.99253 19.3313L36.1619 19.3313L20.8126 3.15482C20.2772 2.59021 20.2741 1.67077 20.8057 1.1021C21.3374 0.533339 22.2033 0.530226 22.739 1.09481L40.4402 19.7515L40.6118 19.9726C40.7619 20.21 40.8429 20.4913 40.8429 20.7816C40.8429 21.1682 40.6986 21.5391 40.4402 21.8116L22.739 40.4683C22.2033 41.0329 21.3374 41.0298 20.8057 40.461C20.2741 39.8923 20.2772 38.9729 20.8126 38.4083L36.1619 22.2318L1.99253 22.2318C1.23776 22.2318 0.626669 21.583 0.626669 20.7816C0.626669 19.9801 1.23776 19.3313 1.99253 19.3313Z" fill="#155ECB" />
                            </svg>
                            <span><?php echo esc_html($subcategory->name); ?></span>
                        </a>

                    <?php endforeach; ?>
                </nav>
            <?php endif; ?>

            <section class="section-posts">

                <?php if (have_posts()) : ?>
                    <div class="posts-list" id="ajax-posts">
                        <?php while (have_posts()) : the_post(); ?>
                            <?php get_template_part('template-parts/content', get_post_type()); ?>
                        <?php endwhile; ?>

                        <!-- Лоадер -->
                        <div id="loader" class="loader" style="display: none;"></div>
                    </div>
                    <?php custom_pagination(); ?>
                <?php else : ?>
                    <?php get_template_part('template-parts/content', 'none'); ?>
                <?php endif; ?>


            </section>
        </div>
        <?php if (is_active_sidebar('sidebar-1')) : ?>
            <aside id="secondary" class="widget-area">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </aside>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>

<!-- AJAX -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.subcategory-link');
        const postsContainer = document.getElementById('ajax-posts');
        const loader = document.getElementById('loader');

        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const catId = this.getAttribute('data-cat-id');

                // сброс активного класса
                links.forEach(l => l.classList.remove('active'));
                // добавляем активный класс на выбранную ссылку
                this.classList.add('active');

                // показываем лоадер
                loader.style.display = 'block';
                postsContainer.innerHTML = '';

                fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'action=load_category_posts&cat_id=' + encodeURIComponent(catId)
                    })
                    .then(response => response.text())
                    .then(html => {
                        loader.style.display = 'none';
                        postsContainer.innerHTML = html;
                    })
                    .catch(error => {
                        loader.style.display = 'none';
                        postsContainer.innerHTML = '<p>Произошла ошибка.</p>';
                        console.error(error);
                    });
            });
        });
    });
</script>