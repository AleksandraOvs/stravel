<div class="post-category-list__item">
    <div class="post-category-list__item__main">
        <?php get_template_part('template-parts/post-meta') ?>
        <a href="<?php the_permalink() ?>" class="pcl__thumbnail">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('full'); // 
            } else {
                echo '<img src="' . get_stylesheet_directory_uri() . '/images/svg/placeholder.svg" alt="' . get_the_title() . '">';
            }
            ?>

        </a>
        <?php get_template_part('template-parts/post-tags') ?>
    </div>


    <div class="pcl__content">
        <h2 class="title news-title"> <?php echo the_title() ?></h2>
        <?php the_excerpt() ?>

        <a class="button-link" href="<?php echo get_permalink() ?> ">Читать</a>

    </div>
</div>