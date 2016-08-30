<?php
/**
 * Load the Customizer with some custom extended addons
 *
 * @package LegalPress
 * @link http://codex.wordpress.org/Theme_Customization_API
 */

/**
 * This funtion is only called when the user is actually on the customizer page
 * @param  WP_Customize_Manager $wp_customize
 */
if ( ! function_exists( 'legalpress_customizer' ) ) {
	function legalpress_customizer( $wp_customize ) {
		// add required files
		require_once( get_template_directory() . '/inc/customizer/class-customize-base.php' );

		new LegalPress_Customizer_Base( $wp_customize );
	}
	add_action( 'customize_register', 'legalpress_customizer' );
}


/**
 * Takes care for the frontend output from the customizer and nothing else
 */
if ( ! function_exists( 'legalpress_customizer_frontend' ) && ! class_exists( 'LegalPress_Customize_Frontent' ) ) {
	function legalpress_customizer_frontend() {
		require_once( get_template_directory() . '/inc/customizer/class-customize-frontend.php' );
		$legalpress_customize_frontent = new LegalPress_Customize_Frontent();
	}
	add_action( 'init', 'legalpress_customizer_frontend' );
}
