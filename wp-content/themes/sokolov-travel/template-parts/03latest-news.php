<?php
// Аргументы запроса
$args = array(
    'category_name'  => 'blog', // название категории
    'posts_per_page' => 8,      // количество постов
    'orderby'        => 'date', // сортировка по дате
    'order'          => 'DESC'  // последние сначала
);

// Новый запрос
$blog_query = new WP_Query($args);

// Проверяем есть ли посты
if ($blog_query->have_posts()) :
?>
    <section class="posts-section">
        <div class="container">
            <div class="posts-header">
                <h2 class="title">Последние записи</h2>
                <a href="/blog" class="button">Смотреть все</a>
            </div>
            <div class="posts-list">
                <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    <?php get_template_part('template-parts/content-post'); ?>
                <?php endwhile; ?>
            </div>
        <?php
    else :
        echo '<p>Новости отсутствуют.</p>';
        ?>
        </div>
    </section>
<?php
    endif;

    // Сбрасываем глобальную переменную $post
    wp_reset_postdata();
?>