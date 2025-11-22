<?php
$head      = carbon_get_theme_option('crb_main_form_head');
$img_id    = carbon_get_theme_option('crb_main_form_img');
$link      = carbon_get_theme_option('crb_main_form_link');
$link_text = carbon_get_theme_option('crb_main_form_text');

$img_url = $img_id ? wp_get_attachment_image_url($img_id, 'full') : '';
?>

<section class="main-form-section">
    <div class="container">
        <div class="main-form-section__inner">
            <div class="main-form-section__content">
                <?php if ($head): ?>
                    <div class="accent-paragraph"><?php echo $head ?></div>
                <?php endif; ?>

                <?php if ($link_text): ?>
                    <div class="main-form-link">
                        <?php if ($link): ?>
                            <a class="button" href="#main-form" data-fancybox data-type="inline"><?php echo esc_html($link_text); ?></a>
                        <?php else: ?>
                            <?php echo $link_text ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($img_url): ?>
                <div class="main-form-img">
                    <img src="<?php echo esc_url($img_url); ?>" alt="">
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>