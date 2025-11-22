<?php

/**
 * Template name: Contacts page
 */

get_header();

$enable_sidebar = get_post_meta(get_the_ID(), '_enable_sidebar', true); ?>

<main id="primary" class="site-main single-temp <?php echo $enable_sidebar ? 'with-sidebar' : 'full-width'; ?>">

    <div class="container <?php echo $enable_sidebar ? 'content-70' : 'content-100'; ?>">
        <header class="entry-header">
            <div class="container">

                <ul class="breadcrumbs__list">
                    <?php echo site_breadcrumbs(); ?>
                </ul>
                <?php
                if (is_singular()) :
                    the_title('<h1 class="entry-title">', '</h1>');
                else :
                    the_title('<h2 class="entry-title title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                endif;
                ?>
            </div>

        </header><!-- .entry-header -->
        <div class="entry-content">
            <?php get_template_part('template-parts/08map') ?>
        </div>
    </div>
</main>

<?php get_footer() ?>