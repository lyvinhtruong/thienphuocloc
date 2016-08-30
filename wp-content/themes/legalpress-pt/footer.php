<?php
/**
 * Footer
 *
 * @package LegalPress
 */

$footer_widgets_layout = LegalPressHelpers::footer_widgets_layout_array();

?>

	<footer class="footer">
		<?php if ( ! empty( $footer_widgets_layout ) && is_active_sidebar( 'footer-widgets' ) ) : ?>
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'footer-widgets' ); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-4">
						<div class="footer-bottom__left">
							<?php echo apply_filters( 'legalpress/footer_left_txt', get_theme_mod( 'footer_left_txt', 'LegalPress Theme Made by <a href="https://www.proteusthemes.com/">ProteusThemes</a>.' ) ); ?>
						</div>
					</div>
					<div class="col-xs-12 col-md-4">
						<div class="footer-bottom__center">
							<?php echo apply_filters( 'legalpress/footer_center_txt', get_theme_mod( 'footer_center_txt', '<i class="fa  fa-3x  fa-cc-visa"></i> &nbsp; <i class="fa  fa-3x  fa-cc-mastercard"></i> &nbsp; <i class="fa  fa-3x  fa-cc-amex"></i> &nbsp; <i class="fa  fa-3x  fa-cc-paypal"></i>' ) ); ?>
						</div>
					</div>
					<div class="col-xs-12 col-md-4">
						<div class="footer-bottom__right">
							<?php echo apply_filters( 'legalpress/footer_right_txt', get_theme_mod( 'footer_right_txt', 'Copyright &copy; 2009–2015 LegalPress. All rights reserved.' ) ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	</div><!-- end of .boxed-container -->

	<?php wp_footer(); ?>
	</body>
</html>