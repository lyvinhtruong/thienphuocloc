<?php

// Only require these files, if the Visual Composer plugin is activated
if ( defined( 'WPB_VC_VERSION' ) ) {

	// Require Visual Composer classes
	require_once( get_template_directory() . '/vendor/proteusthemes/visual-composer-elements/vc-shortcodes/class-vc-shortcode.php' );
	require_once( get_template_directory() . '/vendor/proteusthemes/visual-composer-elements/vc-shortcodes/class-vc-custom-param-types.php' );
	require_once( get_template_directory() . '/vendor/proteusthemes/visual-composer-elements/vc-shortcodes/class-vc-helpers.php' );

	// Require Visual Composer LegalPress front page template
	require_once( get_template_directory() . '/inc/theme-vc-home-page-template.php' );

	// Require custom VC elements for LegalPress theme
	require_once( get_template_directory() . '/inc/theme-vc-call-to-action.php' );
	require_once( get_template_directory() . '/inc/theme-vc-person-profile.php' );

	// Custom visual composer shortcodes for the theme from the Visual Composer Elements (PHP Composer package)
	$legalpress_custom_vc_shortcodes = array(
		// 'call-to-action', -> VC element is not compatible with the widget used in LegalPress theme (because of subtitle field)
		'brochure-box',
		'facebook',
		'featured-page',
		'icon-box',
		'latest-news',
		'skype',
		'opening-time',
		'social-icon',
		'container-social-icons',
		'location',
		'container-google-maps',
		'testimonial',
		'container-testimonials',
	);

	foreach ( $legalpress_custom_vc_shortcodes as $file ) {
		require_once( sprintf( '%s/vendor/proteusthemes/visual-composer-elements/vc-shortcodes/shortcodes/vc-%s.php', get_template_directory(), $file ) );
	}
}