<?php

// Добавляем метабокс
function my_sidebar_metabox()
{
    add_meta_box(
        'my_sidebar_box',           // ID
        'Настройки страницы',       // Заголовок
        'my_sidebar_box_callback',  // Callback
        ['post', 'page'],           // Где показывать (post, page или кастомные типы)
        'side',                     // Контекст (normal, side)
        'default'                   // Приоритет
    );
}
add_action('add_meta_boxes', 'my_sidebar_metabox');

function my_sidebar_box_callback($post)
{
    wp_nonce_field('my_sidebar_nonce', 'my_sidebar_nonce_field');
    $value = get_post_meta($post->ID, '_enable_sidebar', true);
?>
    <p>
        <label>
            <input type="checkbox" name="enable_sidebar" value="1" <?php checked($value, '1'); ?> />
            Включить сайдбар
        </label>
    </p>
<?php
}

// Сохраняем метаполе
function my_sidebar_save_post($post_id)
{
    if (
        !isset($_POST['my_sidebar_nonce_field']) ||
        !wp_verify_nonce($_POST['my_sidebar_nonce_field'], 'my_sidebar_nonce')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['enable_sidebar'])) {
        update_post_meta($post_id, '_enable_sidebar', '1');
    } else {
        delete_post_meta($post_id, '_enable_sidebar');
    }
}
add_action('save_post', 'my_sidebar_save_post');
