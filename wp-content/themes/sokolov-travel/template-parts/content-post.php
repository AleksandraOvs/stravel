<div class="post-list__item">
    <div class="post-list__item__thumbnail">
        <?php
        if (has_post_thumbnail()) {
            the_post_thumbnail('full'); // 
        } else {
            echo '<img src="' . get_stylesheet_directory_uri() . '/images/svg/placeholder.svg" alt="' . get_the_title() . '">';
        }
        ?>
    </div>

    <div class="post-list__item__content">
        <h3 class="news-title"> <?php echo the_title() ?></h3>
        <div class="post-list__item__content__excerpt">
            <?php the_excerpt() ?>
        </div>
        <a class="button-link" href="<?php echo get_permalink() ?> ">Подробнее...</a>
    </div>
</div>