<?php
$selected = carbon_get_post_meta(get_the_ID(), 'front_calendar_posts');

if (!empty($selected)):
?>
    <section class="actually-posts-section">
        <div class="container">
            <div class="posts-header">
                <h2 class="title">Актуальные события</h2>
                <a href="/calendar" class="button _mob_hidden">Смотреть все</a>
            </div>

            <div class="actually-posts__grid">

                <?php foreach ($selected as $item):

                    $post_id = $item['id'];
                    $post = get_post($post_id);
                    setup_postdata($post);
                ?>

                    <?php get_template_part('template-parts/content-actually'); ?>

                <?php endforeach; ?>

                <?php wp_reset_postdata();
                ?>
                <a href="/calendar" class="button _desk_hidden">Смотреть все</a>
            </div>
        </div>
    </section>

<?php endif; ?>