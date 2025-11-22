<?php
$post_tags = get_the_tags();
if ($post_tags) :
?>
    <div class="tags-list">
        <?php foreach ($post_tags as $tag) : ?>
            <a class="tag" href="<?php echo get_tag_link($tag->term_id); ?>">
                <?php echo esc_html($tag->name); ?>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>