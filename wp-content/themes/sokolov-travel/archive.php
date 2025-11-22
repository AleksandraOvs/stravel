<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tours
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php if (have_posts()) : ?>

		<header class="entry-header">
			<div class="container">
				<ul class="breadcrumbs__list">
					<?php echo site_breadcrumbs(); ?>
				</ul>
				<?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				the_archive_description('<div class="archive-description">', '</div>');
				?>
			</div>

		</header><!-- .page-header -->

		<section class="section-posts">
			<div class="container">
				<div class="posts-list">
				<?php
				/* Start the Loop */
				while (have_posts()) :

					the_post();

					/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */

					get_template_part('template-parts/content-post');


				endwhile;

				//the_posts_navigation();

				custom_pagination();

			else :

				get_template_part('template-parts/content', 'none');

			endif;
				?>
				</div>
			</div>
		</section>


</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
