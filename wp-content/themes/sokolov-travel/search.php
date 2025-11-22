<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package tours
 */

get_header();
?>

<main id="primary" class="site-main category-page">

	<header class="entry-header">
		<div class="container">
			<ul class="breadcrumbs__list">
				<?php site_breadcrumbs(); ?>
			</ul>

			<h1 class="page-title _search-heading">
				<?php
				/* translators: %s: search query. */
				printf(esc_html__('Найдены результаты по запросу: %s', 'cargo'), '<span>' . get_search_query() . '</span>');
				?>
			</h1>
		</div>
	</header>

	<div class="container">

		<div class="container__inner">
			<section class="section-posts">
				<div class="posts-list">
					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
							<?php get_template_part('template-parts/content-post'); ?>
						<?php endwhile; ?>
						<?php the_posts_navigation(); ?>
					<?php else : ?>
						<?php get_template_part('template-parts/content', 'none'); ?>
					<?php endif; ?>
				</div>
				<!-- Лоадер -->
				<div id="loader" class="loader" style="display: none;"></div>
			</section>
		</div>

		<?php if (is_active_sidebar('sidebar-1')) : ?>
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar('sidebar-1'); ?>
			</aside>
		<?php endif; ?>



	</div>

</main>

<?php get_footer(); ?>