<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tours
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-actually-item">

		<a href="<?php the_permalink() ?>" class="square-thumbnail">
			<?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('full'); // 
			} else {
				echo '<img src="' . get_stylesheet_directory_uri() . '/images/svg/placeholder.svg" alt="' . get_the_title() . '">';
			}
			?>
		</a>

		<div class="post-content">
			<h3> <?php echo the_title() ?></h3>
			<?php the_excerpt() ?>
			<a class="button-link" href="<?php echo get_permalink() ?> ">Читать</a>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->