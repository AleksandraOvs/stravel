<?php defined('ABSPATH') || exit;
get_header();

//inc/cpt-thumbnails.php -> добавление своего изображения для CPT
$image = get_option('archive_image_team');
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

    <div class="container">
        <?php $page = get_page_by_path('team');
        echo apply_filters('the_content', $page->post_content); // выводим контент из Gutenberg 
        ?>
    </div>

    <section class="our-team-section">
        <div class="container">
            <div class="section-title">
                <div class="section-title__slug">/our-team</div>
                <h2 class="title">Наши специалисты</h2>
            </div>

            <div id="team-list" class="team-list">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('template-parts/content-tmember'); ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p><?php esc_html_e('Посты не найдены.', 'textdomain'); ?></p>
                <?php endif; ?>
            </div>

        </div>

    </section>





</main><!-- #main -->

<?php get_footer(); ?>