<?php

/**
 ** Template name: Thank you page
 */

get_header();
?>

<main id="primary" class="site-main">

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <div class="container">
                <ul class="breadcrumbs__list">
                    <?php echo site_breadcrumbs(); ?>
                </ul>
            </div>

        </header><!-- .entry-header -->

        <div class="entry-content">
            <div class="container">
                <?php
                the_content();
                ?>
            </div>

        </div><!-- .entry-content -->

</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
