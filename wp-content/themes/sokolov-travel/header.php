<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package stravel
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="yandex-verification" content="26f7fc8635d8b220" />
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Favicon -->
	<!-- <link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favi.ico">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon_16x16.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon_32x32.png"> -->

	<!-- Apple -->
	<!-- <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/apple-touch-icon.png"> -->

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'stravel'); ?></a>

		<header id="masthead" class="site-header">
			<div class="container">
				<div class="site-header__inner">
					<div class="site-branding">
						<?php
						$header_logo = get_theme_mod('header_logo');
						$img = wp_get_attachment_image_src($header_logo, 'full');
						if ($img) : echo '<a class="custom-logo-link" href="' . site_url() . '"><img src="' . $img[0] . '" alt=""></a>';
						endif;
						?>

						<!-- <p class="site-description">
							<?php //bloginfo('description'); 
							?>
						</p> -->
					</div><!-- .site-branding -->


					<div class="header-right">

						<?php get_template_part('template-parts/contacts')
						?>


					</div>
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<div class="bar"></div>
						<div class="bar"></div>
						<div class="bar"></div>
					</button>


				</div>

				<nav id="site-navigation" class="main-navigation">
					<?php wp_nav_menu([
						'container' => false,
						'theme_location'  => 'menu-main',
						'walker' => new My_Custom_Walker_Nav_Menu,
						'depth'           => 2,
					]); ?>
				</nav><!-- #site-navigation -->
			</div>

		</header><!-- #masthead -->
		<?php get_template_part('template-parts/mobile-menu') ?>