<?php
/**
 * Add the link to documentation under Appearance in the wp-admin
 */

if ( ! function_exists( 'legalpress_add_docs_page' ) ) {
	function legalpress_add_docs_page() {
		add_theme_page(
			_x( 'Documentation', 'backend', 'legalpress-pt' ),
			_x( 'Documentation', 'backend', 'legalpress-pt' ),
			'',
			'proteusthemes-theme-docs',
			'legalpress_docs_page_output'
		);
	}
	add_action( 'admin_menu', 'legalpress_add_docs_page' );

	function legalpress_docs_page_output() {
		?>
		<div class="wrap">
			<h2><?php _ex( 'Documentation', 'backend', 'legalpress-pt' ); ?></h2>

			<p>
				<strong><a href="https://www.proteusthemes.com/docs/legalpress-pt/" class="button button-primary " target="_blank"><?php _ex( 'Click here to see online documentation of the theme!', 'backend', 'legalpress-pt' ); ?></a></strong>
			</p>
		</div>
		<?php
	}
}