<?php

/**
 * Template Name: Все записи (таблица)
 * Description: Шаблон для отображения всех записей в таблице с Yoast SEO полями.
 */

get_header();
?>

<main id="primary" class="site-main all-posts-template">
    <div class="container">
        <h1 class="page-title"><?php the_title(); ?></h1>

        <?php
        // Получаем все записи
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
        ?>
            <table class="posts-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Миниатюра</th>
                        <th>Заголовок</th>
                        <th>URL</th>
                        <th>Категории</th>
                        <th>Yoast Title</th>
                        <th>Yoast Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($query->have_posts()) : $query->the_post();

                        $yoast_title = get_post_meta(get_the_ID(), '_yoast_wpseo_title', true);
                        $yoast_desc  = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);

                        // Категории и подкатегории
                        $categories = get_the_category();
                        $cat_links = [];
                        if (!empty($categories)) {
                            foreach ($categories as $cat) {
                                $cat_links[] = '<a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a>';
                            }
                        }

                        // Миниатюра
                        $thumb = get_the_post_thumbnail(get_the_ID(), 'thumbnail', ['class' => 'post-thumb']);

                        echo '<tr>';
                        echo '<td>' . esc_html($i) . '</td>';
                        echo '<td>' . ($thumb ?: '—') . '</td>';
                        echo '<td><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></td>';
                        echo '<td><a href="' . esc_url(get_permalink()) . '" target="_blank">' . esc_url(get_permalink()) . '</a></td>';
                        echo '<td>' . implode(' / ', $cat_links) . '</td>';
                        echo '<td>' . esc_html($yoast_title ?: '—') . '</td>';
                        echo '<td>' . esc_html($yoast_desc ?: '—') . '</td>';
                        echo '</tr>';

                        $i++;
                    endwhile;
                    ?>
                </tbody>
            </table>

        <?php
            wp_reset_postdata();
        else :
            echo '<p>Пока нет записей.</p>';
        endif;
        ?>
    </div>
</main>

<style>
    .all-posts-template .posts-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        font-size: 14px;
    }

    .all-posts-template .posts-table th,
    .all-posts-template .posts-table td {
        border: 1px solid #ddd;
        padding: 10px;
        vertical-align: top;
    }

    .all-posts-template .posts-table th {
        background-color: #f7f7f7;
        text-align: left;
    }

    .all-posts-template .posts-table tr:nth-child(even) {
        background-color: #fafafa;
    }

    .all-posts-template .post-thumb {
        width: 80px;
        height: auto;
        border-radius: 4px;
    }

    .all-posts-template .posts-table a {
        color: #0073aa;
        text-decoration: none;
    }

    .all-posts-template .posts-table a:hover {
        text-decoration: underline;
    }
</style>

<?php get_footer(); ?>