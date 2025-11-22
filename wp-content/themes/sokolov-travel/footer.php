<footer class="site-footer">
	<div class="container">
		<div class="site-footer__inner">
			<div class="footer-columns__first">
				<div class="footer-columns__first__site-branding">
					<?php
					$footer_logo = get_theme_mod('footer_logo');
					$img = wp_get_attachment_image_src($footer_logo, 'full');

					if ($img) {
						echo '<a class="custom-logo-link" href="' . esc_url(site_url()) . '"><img src="' . esc_url($img[0]) . '" alt=""></a>';
					}
					?>

					<?php if (is_active_sidebar('footer-sidebar-1')): ?>
						<?php dynamic_sidebar('footer-sidebar-1'); ?>
					<?php endif; ?>
				</div>

				<?php if (is_active_sidebar('footer-sidebar-2')): ?>
					<div class="footer-col">
						<?php dynamic_sidebar('footer-sidebar-2'); ?>
					</div>
				<?php endif; ?>
			</div><!-- .footer-columns__first -->



			<div class="footer-col contacts-col">
				<div class="footer__contacts">
					<?php get_template_part('template-parts/contacts'); ?>

					<?php if (!empty($phone_link)): ?>
						<a href="<?php echo esc_url($phone_link); ?>" class="phone-link">
							<span>
								<?php echo !empty($phone_text) ? esc_html($phone_text) : 'Позвонить'; ?>
							</span>
						</a>
					<?php endif; ?>

					<?php if (!empty($phone_desc)): ?>
						<p class="footer-phone-desc"><?php echo esc_html($phone_desc); ?></p>
					<?php endif; ?>

				</div><!-- .footer__contacts -->
				<?php if (is_active_sidebar('footer-sidebar-3')): ?>
					<div class="footer-col">
						<?php dynamic_sidebar('footer-sidebar-3'); ?>
					</div>
				<?php endif; ?>
			</div><!-- .contacts-col -->



		</div><!-- .footer-columns -->

		<div class="footer-bottom">
			<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
			<a href="/policy" class="footer-link">Политика конфиденциальности</a>
		</div>

	</div><!-- .site-footer__inner -->
	</div><!-- .container -->
</footer>
<?php wp_footer() ?>

</div> <!-- end of #page ->