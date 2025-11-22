<?php
// === Добавляем страницу настроек архивов ===
add_action('admin_menu', function () {
    add_menu_page(
        'Изображения архивов',
        'Изображения архивов',
        'manage_options',
        'archive-images',
        'render_archive_images_page',
        'dashicons-format-image',
        20
    );
});

// === Выводим страницу настроек ===
function render_archive_images_page()
{
?>
    <div class="wrap">
        <h1>Изображения архивов (Services / Team)</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('archive_images_settings');
            do_settings_sections('archive_images_settings');

            $services_image = get_option('archive_image_services');
            $team_image     = get_option('archive_image_team');
            ?>

            <table class="form-table">
                <tr>
                    <th scope="row">Изображение для Services</th>
                    <td>
                        <input type="text" id="archive_image_services" name="archive_image_services" value="<?php echo esc_attr($services_image); ?>" style="width:60%;" />
                        <button class="button upload_image_button">Загрузить / выбрать</button>
                        <?php if ($services_image): ?>
                            <div><img src="<?php echo esc_url($services_image); ?>" style="max-width:150px;margin-top:10px;"></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Изображение для Team</th>
                    <td>
                        <input type="text" id="archive_image_team" name="archive_image_team" value="<?php echo esc_attr($team_image); ?>" style="width:60%;" />
                        <button class="button upload_image_button">Загрузить / выбрать</button>
                        <?php if ($team_image): ?>
                            <div><img src="<?php echo esc_url($team_image); ?>" style="max-width:150px;margin-top:10px;"></div>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <?php submit_button('Сохранить изменения'); ?>
        </form>
    </div>

    <script>
        jQuery(document).ready(function($) {
            var frame;
            $('.upload_image_button').on('click', function(e) {
                e.preventDefault();
                var input = $(this).prev('input');
                if (frame) {
                    frame.open();
                    return;
                }
                frame = wp.media({
                    title: 'Выберите изображение',
                    button: {
                        text: 'Использовать это изображение'
                    },
                    multiple: false
                });
                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    input.val(attachment.url);
                });
                frame.open();
            });
        });
    </script>
<?php
}

// === Регистрируем настройки ===
add_action('admin_init', function () {
    register_setting('archive_images_settings', 'archive_image_services');
    register_setting('archive_images_settings', 'archive_image_team');
});
