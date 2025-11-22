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
            // Получаем все теги, которые есть у постов этой рубрики
            $tags = get_tags([
                'hide_empty' => true,
            ]);

            if ($tags) :
            ?>
                <div class="tags-filter">
                    <div class="tags-list">
                        <a href="#" class="tag remove active" data-tag-id="all">Все статьи</a></li>
                        <?php foreach ($tags as $tag) : ?>

                            <a href="#" class="tag" data-tag-id="<?php echo $tag->term_id; ?>">
                                <?php echo esc_html($tag->name); ?>
                            </a>

                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <section class="section-posts">
                <div class="posts-category-list" id="ajax-posts">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php get_template_part('template-parts/content-category-post') ?>
                        <?php endwhile; ?>
                        <?php the_posts_navigation(); ?>
                    <?php else : ?>
                        <?php get_template_part('template-parts/content', 'none'); ?>
                    <?php endif; ?>
                </div>
                <!-- Лоадер -->
                <div id="loader" class="loader" style="display: none;"></div>

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
        const tagLinks = document.querySelectorAll('.tag');
        const postsContainer = document.getElementById('ajax-posts');
        const loader = document.getElementById('loader');

        if (!tagLinks.length) return;

        // Хранит выбранные ID тегов
        let selectedTags = new Set();

        tagLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const tagId = this.getAttribute('data-tag-id');

                // === "Показать все" ===
                if (tagId === 'all') {
                    selectedTags.clear();

                    // Сброс всех активных
                    tagLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');

                    fetchPosts('all');
                    return;
                }

                // Убираем активный класс у "Показать все"
                const allLink = document.querySelector('.tag-link[data-tag-id="all"]');
                if (allLink) allLink.classList.remove('active');

                // === Выбор/снятие тега ===
                if (selectedTags.has(tagId)) {
                    selectedTags.delete(tagId);
                    this.classList.remove('active');
                } else {
                    selectedTags.add(tagId);
                    this.classList.add('active');
                }

                // Если ничего не выбрано — вернуться к "все"
                if (selectedTags.size === 0) {
                    if (allLink) allLink.classList.add('active');
                    fetchPosts('all');
                    return;
                }

                // Отправляем выбранные теги
                const tagIds = Array.from(selectedTags).join(',');
                fetchPosts(tagIds);
            });
        });

        // === AJAX подгрузка постов ===
        function fetchPosts(tagIds) {
            loader.style.display = 'block';
            postsContainer.style.opacity = '0.5';

            const bodyData = 'action=load_tagged_posts&tag_ids=' + encodeURIComponent(tagIds);

            fetch(ajaxurlObj.ajaxurl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: bodyData
                })
                .then(res => res.text())
                .then(html => {
                    loader.style.display = 'none';
                    postsContainer.style.opacity = '1';
                    postsContainer.innerHTML = html;
                })
                .catch(err => {
                    loader.style.display = 'none';
                    postsContainer.style.opacity = '1';
                    postsContainer.innerHTML = '<p>Ошибка загрузки постов.</p>';
                    console.error(err);
                });
        }
    });
</script>