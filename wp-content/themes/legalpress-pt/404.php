<?php
/**
 * 404 page
 *
 * @package LegalPress
 */

get_header();

get_template_part( 'template-parts/main-title' );
get_template_part( 'template-parts/breadcrumbs' );

?>

<div class="error-404">
	<div class="container">
		<img src="<?php echo esc_attr( get_template_directory_uri() ) . '/assets/images/404.png'; ?>" alt="<?php esc_html_e( '404 Picture' , 'legalpress-pt' ); ?>" class="push-down-30">
		<div class="error-404__content">
			<h2><?php esc_html_e( 'The page you were looking for is not here.' , 'legalpress-pt' ); ?></h2>
			<p class="error-404__text">
			<?php
				printf(
					/* translators: %s represents link to home page wrap around the Home word */
					esc_html__( 'Go %s Home %s or try to search:' , 'legalpress-pt' ),
					'<b><a href="' . esc_url( home_url( '/' ) ) . '">',
					'</a></b>'
				);
			?>
			</p>
			<div class="widget_search">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>