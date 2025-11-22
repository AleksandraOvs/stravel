<?php
defined('ABSPATH') || exit;
get_header();

//inc/cpt-thumbnails.php -> добавление своего изображения для CPT
$image = get_option('archive_image_services');
?>


<main id="primary" class="site-main archive-page">
    <header class="entry-header">
        <div class="container">
            <div class="arhive-page__header__inner">
                <?php
                if ($image) {
                    echo '<img src="' . esc_url($image) . '" alt="" class="archive-header-image">';
                }
                ?>
                <ul class="breadcrumbs__list">
                    <?php echo site_breadcrumbs(); ?>
                </ul>
                <?php the_archive_title('<h1 class="archive-title">', '</h1>'); ?>
            </div>

        </div>
    </header><!-- .entry-header -->

    <?php
    // Получаем все термины таксономии services_cat
    $all_terms = get_terms(array(
        'taxonomy'   => 'services_cat',
        'hide_empty' => false,
    ));

    $terms = array();

    if (!empty($all_terms) && !is_wp_error($all_terms)) {
        foreach ($all_terms as $term) {
            // Проверяем, есть ли посты services в этой категории
            $count_query = new WP_Query(array(
                'post_type'      => 'services',
                'posts_per_page' => 1,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'services_cat',
                        'field'    => 'term_id',
                        'terms'    => $term->term_id,
                    ),
                ),
                'post_status'    => 'publish',
                'fields'         => 'ids',
            ));
            if ($count_query->have_posts()) {
                $terms[] = $term;
            }
            wp_reset_postdata();
        }
    }
    ?>

    <div class="container">
        <?php if (!empty($terms)) : ?>
            <section class="section-categories">

                <nav id="category-filter">
                    <a href="#" class="service-link" data-term="all">
                        Показать все
                    </a>

                    <?php foreach ($terms as $term) : ?>

                        <a class="service-link" href="#" data-term="<?php echo esc_attr($term->term_id); ?>">
                            <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.99253 19.3313L36.1619 19.3313L20.8126 3.15482C20.2772 2.59021 20.2741 1.67077 20.8057 1.1021C21.3374 0.533339 22.2033 0.530226 22.739 1.09481L40.4402 19.7515L40.6118 19.9726C40.7619 20.21 40.8429 20.4913 40.8429 20.7816C40.8429 21.1682 40.6986 21.5391 40.4402 21.8116L22.739 40.4683C22.2033 41.0329 21.3374 41.0298 20.8057 40.461C20.2741 39.8923 20.2772 38.9729 20.8126 38.4083L36.1619 22.2318L1.99253 22.2318C1.23776 22.2318 0.626669 21.583 0.626669 20.7816C0.626669 19.9801 1.23776 19.3313 1.99253 19.3313Z" fill="#155ECB" />
                            </svg>

                            <?php echo esc_html($term->name); ?>
                        </a>

                    <?php endforeach; ?>
                </nav>

            </section>
        <?php endif; ?>

        <div id="posts-list" class="posts-list">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content-post'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <p><?php esc_html_e('Посты не найдены.', 'textdomain'); ?></p>
            <?php endif; ?>
        </div>
        <?php custom_pagination(); ?>
    </div>

</main><!-- #main -->

<?php get_footer(); ?>