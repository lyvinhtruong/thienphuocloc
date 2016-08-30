<?php
/**
 * The Header for LegalPress Theme
 *
 * @package LegalPress
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<?php wp_head(); ?>
	</head>

	<body <?php body_class( LegalPressHelpers::add_body_class() ); ?>>
	<div class="boxed-container">

	<header>
		<?php if ( 'no' !== get_theme_mod( 'top_bar_visibility', 'yes' ) ) : ?>
		<div class="top<?php echo 'hide_mobile' === get_theme_mod( 'top_bar_visibility', 'yes' ) ? '  hidden-xs  hidden-sm' : ''; ?>">
			<div class="container">
				<div class="top__tagline">
					<?php bloginfo( 'description' ); ?>
				</div>
				<div class="top__widgets">
					<?php
					if ( is_active_sidebar( 'top-widgets' ) ) {
						dynamic_sidebar( 'top-widgets' );
					}
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>

		<div class="container">
			<?php get_template_part( 'template-parts/header', get_theme_mod( 'header_layout', 'center-logo' ) ); ?>
		</div>
	</header>