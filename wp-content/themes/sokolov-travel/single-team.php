<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package tours
 */
?>
<?php
get_header();
?>

<main id="primary" class="site-main category-page">
	<header class="entry-header">
		<div class="container">
			<ul class="breadcrumbs__list">
				<?php site_breadcrumbs(); ?>
			</ul>

			<?php the_title('<h1 class="page-title">', '</h1>'); ?>
		</div>
	</header>

	<div class="container">

		<div class="container__inner">
			<div class="entry-content _single-team">
				<?php if (has_post_thumbnail()) : ?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail('full'); ?>
					</div>
				<?php endif; ?>
				<?php the_content() ?>
			</div>
		</div>

		<?php if (is_active_sidebar('sidebar-1')) : ?>
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar('sidebar-1'); ?>
			</aside>
		<?php endif; ?>
	</div>

	<?php get_template_part('template-parts/main-form') ?>
</main>

<?php get_footer(); ?>