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

$enable_sidebar = get_post_meta(get_the_ID(), '_enable_sidebar', true);
?>

<main id="primary" class="site-main single-temp <?php echo $enable_sidebar ? 'with-sidebar' : 'full-width'; ?>">

	<div class="container <?php echo $enable_sidebar ? 'content-70' : 'content-100'; ?>">
		<header class="entry-header">
			<div class="container">

				<ul class="breadcrumbs__list">
					<?php echo site_breadcrumbs(); ?>
				</ul>
				<?php
				if (is_singular()) :
					the_title('<h1 class="entry-title">', '</h1>');
				else :
					the_title('<h2 class="entry-title title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
				endif;
				?>

			</div>

			<?php

			// if ('post' === get_post_type()) :
			// 
			?>
			<!-- <div class="entry-meta"> -->
			<?php
			// 		tours_posted_on();
			// 		tours_posted_by();
			// 		
			?>
			<!-- </div> -->
			<!-- .entry-meta -->
			<?php //endif; 
			?>
		</header><!-- .entry-header -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>

		<?php if ($enable_sidebar): ?>
			<div class="sidebar-area">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>

	</div>

	<?php get_template_part('template-parts/main-form') ?>
</main>

<?php get_footer(); ?>