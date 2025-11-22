<div class="post-meta">
    <div class="post-date"><?php echo get_the_date(); ?></div>

    <div class="post-author">
        <span>Автор:</span> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
            <?php the_author(); ?>
        </a>
    </div>
</div>