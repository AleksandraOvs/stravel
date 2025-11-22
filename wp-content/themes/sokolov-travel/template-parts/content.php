<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tours
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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

	<?php //tours_post_thumbnail(); 
	?>

	<div class="entry-content">
		<div class="container">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'tours'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);

			custom_pagination();
			?>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //tours_entry_footer(); 
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->