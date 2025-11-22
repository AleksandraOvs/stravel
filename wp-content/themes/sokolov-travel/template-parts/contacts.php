<?php
// Инфо-ссылки
$links = carbon_get_theme_option('crb_links');

// Мессенджеры
$contacts = carbon_get_theme_option('crb_contacts');
?>

<?php if ($links): ?>
    <div class="top-header__links">
        <?php foreach ($links as $link): ?>
            <?php if (!empty($link['crb_link'])): ?>
                <a href="<?php echo esc_url($link['crb_link']); ?>" class="top-header__link">
                    <?php if ($link['crb_link_icon']):
                        $link_icon = wp_get_attachment_image_url($link['crb_link_icon'], 'full'); ?>
                        <img src="<?php echo esc_url($link_icon); ?>" alt="<?php echo esc_attr($link['crb_link_text']); ?>">
                    <?php endif; ?>
                    <p><?php echo esc_html($link['crb_link_text']); ?></p>
                </a>
            <?php else: ?>
                <div class="top-header__link">
                    <?php if ($link['crb_link_icon']):
                        $link_icon = wp_get_attachment_image_url($link['crb_link_icon'], 'full'); ?>
                        <img src="<?php echo esc_url($link_icon); ?>" alt="<?php echo esc_attr($link['crb_link_text']); ?>">
                    <?php endif; ?>
                    <p><?php echo esc_html($link['crb_link_text']); ?></p>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div> <!-- /.top-header__links -->
<?php endif; ?>

<?php if ($contacts): ?>
    <div class="contacts">
        <?php foreach ($contacts as $contact): ?>
            <?php if (!empty($contact['crb_contact_link'])): ?>
                <a target="_blank" href="<?php echo esc_url($contact['crb_contact_link']); ?>" class="contact__link">
                    <?php if (!empty($contact['crb_contact_image'])): ?>
                        <?php $img_url = wp_get_attachment_image_url($contact['crb_contact_image'], 'full'); ?>
                        <?php if ($img_url): ?>
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($contact['crb_contact_name']); ?>">
                        <?php endif; ?>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>