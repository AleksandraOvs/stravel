<?php
$slides = carbon_get_post_meta(get_the_ID(), 'crb_dest_hero_slider');
?>

<section class="hero">
    <div class="container">
        <?php
        $slides = carbon_get_the_post_meta('crb_dest_hero_slider');

        if ($slides) : ?>
            <div class="swiper hero-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($slides as $slide) :

                        $image_id = isset($slide['image']) ? $slide['image'] : false;
                        $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';
                        $alt = isset($slide['alt']) ? esc_attr($slide['alt']) : '';
                        $title = isset($slide['title']) ? esc_html($slide['title']) : '';
                        $subtitle = isset($slide['subtitle']) ? wp_kses_post($slide['subtitle']) : '';

                    ?>
                        <div class="swiper-slide hero-slide">
                            <?php if ($image_url) : ?>
                                <img src="<?php echo $image_url; ?>" alt="<?php echo $alt; ?>" class="hero-slide__image">
                            <?php endif; ?>

                            <div class="hero-slide__content">
                                <?php if ($title) : ?>
                                    <h2 class="hero-slide__title"><?php echo $title; ?></h2>
                                <?php endif; ?>

                                <?php if ($subtitle) : ?>
                                    <div class="hero-slide__subtitle">
                                        <?php echo $subtitle; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>


</section>