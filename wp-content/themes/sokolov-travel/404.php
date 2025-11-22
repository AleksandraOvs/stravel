<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package tours
 */

get_header();
?>

<main id="primary" class="site-main">

	<section class="error-404 not-found">
		<header class="entry-header">
			<div class="container">

				<ul class="breadcrumbs__list">
					<?php echo site_breadcrumbs(); ?>
				</ul>

				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>

			</div>

		</header><!-- .entry-header -->

		<div class="page-content _error404">
			<div class="container">
				<span class="_error404-text">404</span>
				<p><?php esc_html_e('Похоже, здесь ничего нет. Попробуйте воспользоваться ссылками ниже или поиском.', 'tours'); ?></p>

				<?php
				get_search_form();

				//the_widget('WP_Widget_Recent_Posts');
				?>

				<div class="widget widget_categories">
					<h2 class="widget-title"><?php esc_html_e('Популярные категории', 'tours'); ?></h2>
					<ul>
						<?php
						wp_list_categories(
							array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							)
						);
						?>
					</ul>
				</div><!-- .widget -->

			</div>

		</div><!-- .page-content -->
	</section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
