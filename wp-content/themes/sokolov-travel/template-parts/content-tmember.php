<div class="team-list__item">
    <a href="<?php the_permalink() ?>" class="team-list__item__thumbnail">
        <?php
        if (has_post_thumbnail()) {
            the_post_thumbnail('full'); // 
        } else {
            echo '<img src="' . get_stylesheet_directory_uri() . '/images/svg/placeholder.svg" alt="' . get_the_title() . '">';
        }
        ?>
    </a>

    <div class="team-list__item__content">
        <div class="team-list__item__content__head">
            <h3 class="news-title"> <?php echo the_title() ?></h3>
            <?php the_excerpt() ?>
        </div>

        <!-- <a class="button-link" href="<?php //echo get_permalink() 
                                            ?> ">Читать</a> -->
    </div>
</div>