<div class="mobile-menu">

    <nav id="site-navigation" class="main-navigation">

        <?php wp_nav_menu([
            'container' => false,
            'theme_location'  => 'menu-main',
            'walker' => new My_Custom_Walker_Nav_Menu,
            'depth'           => 2,
        ]); ?>

    </nav><!-- #site-navigation -->

    <div class="mobile-menu__inner">
        <?php
        // Адрес
        $address      = carbon_get_theme_option('crb_address');
        $address_icon = carbon_get_theme_option('crb_address_icon');

        // Кнопка
        $btn_text = carbon_get_theme_option('crb_button_text');
        $btn_link = carbon_get_theme_option('crb_button_link');
        ?>

        <div class="_desk_hidden">
            <?php get_template_part('template-parts/contacts') ?>
        </div>
        <?php if ($address_icon): $address_icon_url = wp_get_attachment_image_url($address_icon, 'full'); ?>
            <div class="mm-contact">
                <img src="<?php echo $address_icon_url ?>" alt="Адреса" />
            <?php endif; ?>
            <p><?php echo $address ?></p>
            </div>
    </div>

</div>