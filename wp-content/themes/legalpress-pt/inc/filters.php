<?php
/**
 * Filters for LegalPress WP theme
 *
 * @package LegalPress
 */

class LegalPressFilters {

	function __construct() {
		// Add shortcodes in widgets
		add_filter( 'widget_text', 'do_shortcode' );

		// ProteusWidgets
		add_filter( 'pw/widget_views_path', array( $this, 'set_widgets_view_path' ) );
		add_filter( 'pw/testimonial_widget', array( $this, 'set_testimonial_settings' ) );
		add_filter( 'pw/google_map_skins', array( $this, 'set_google_maps_skins' ) );
		add_filter( 'pw/featured_page_widget_page_box_image_size', array( $this, 'set_page_box_image_size' ) );
		add_filter( 'pw/featured_page_widget_inline_image_size', array( $this, 'set_inline_image_size' ) );
		add_filter( 'pw/social_icons_fa_icons_list', array( $this, 'social_icons_fa_icons_list' ) );
		add_filter( 'pw/featured_page_fields', array( $this, 'featured_page_widget_fields' ) );
		add_filter( 'pw/default_social_icon', array( $this, 'default_social_icon' ) );

		// Visual Composer
		add_filter( 'vc_pt/current_theme_google_map_style', array( $this, 'set_current_theme_google_map_style' ) );

		// Custom tag font size
		add_filter( 'widget_tag_cloud_args', array( $this, 'set_tag_cloud_sizes' ) );

		// Custom text after excerpt
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

		// Footer widgets with dynamic layouts
		add_filter( 'dynamic_sidebar_params', array( $this, 'footer_widgets_params' ), 9, 1 );

		// Google fonts
		add_filter( 'pre_google_web_fonts', array( $this, 'additional_fonts' ) );
		add_filter( 'subsets_google_web_fonts', array( $this, 'subsets_google_web_fonts' ) );

		// Page builder
		add_filter( 'siteorigin_panels_widget_style_fields', array( $this, 'add_fields_to_pagebuilder_widget_panel' ) );
		add_filter( 'siteorigin_panels_widget_style_attributes', array( $this, 'add_attributes_to_pagebuilder_widget_panel' ), 10, 2 );
		add_filter( 'siteorigin_panels_settings_defaults', array( $this, 'siteorigin_panels_settings_defaults' ) );

		// Embeds
		add_filter( 'embed_oembed_html', array( $this, 'embed_oembed_html' ), 10, 1 );

		// Protocols
		add_filter( 'kses_allowed_protocols', array( $this, 'kses_allowed_protocols' ) );

		// Filter the text in the footer
		foreach ( array( 'legalpress/footer_left_txt', 'legalpress/footer_center_txt', 'legalpress/footer_right_txt' ) as $legalpress_filter ) {
			add_filter( $legalpress_filter, 'wptexturize' );
			add_filter( $legalpress_filter, 'convert_chars' );
			add_filter( $legalpress_filter, 'capital_P_dangit' );
		}
	}


	/**
	* Filter the Testimonial widget fields that the Legalpress theme will need from ProteusWidgets - Tesimonial widget
	*/
	function set_testimonial_settings( $attr ) {
		$attr['number_of_testimonial_per_slide'] = 2;
		$attr['rating']                          = false;
		$attr['author_description']              = true;
		return $attr;
	}


	/**
	 * Custom tag font size
	 */
	function set_tag_cloud_sizes($args) {
		$args['smallest'] = 8;
		$args['largest']  = 12;
		return $args;
	}


	/**
	 * Custom text after excerpt
	 */
	function excerpt_more( $more ) {
		return _x( ' &hellip;', 'custom read more text after the post excerpts' , 'legalpress-pt' );
	}


	/**
	 * Filter the dynamic sidebars and alter the BS col classes for the footer wigets
	 * @param  array $params
	 * @return array
	 */
	function footer_widgets_params( $params ) {
		static $counter              = 0;
		static $first_row            = true;
		$footer_widgets_layout_array = LegalPressHelpers::footer_widgets_layout_array();

		if ( 'footer-widgets' === $params[0]['id'] ) {
			// 'before_widget' contains __col-num__, see inc/theme-sidebars.php
			$params[0]['before_widget'] = str_replace( '__col-num__', $footer_widgets_layout_array[ $counter ], $params[0]['before_widget'] );

			// first widget in the any non-first row
			if ( false === $first_row && 0 === $counter ) {
				$params[0]['before_widget'] = '</div><div class="row">' . $params[0]['before_widget'];
			}

			$counter++;
		}

		end( $footer_widgets_layout_array );
		if ( $counter > key( $footer_widgets_layout_array ) ) {
			$counter   = 0;
			$first_row = false;
		}

		return $params;
	}


	/**
	 * Filter for LegalPress skin of google maps widget (ProteusWidgets)
	 * @param  array $skins
	 * @return array
	 */
	function set_google_maps_skins( $skins ) {
		if ( ! isset( $skins['LegalPress'] ) ) {
			$skins['LegalPress'] = '[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]';
		}

		return $skins;
	}


	/**
	 * Filter for LegalPress Google maps style (Visual Composer)
	 * @return string
	 */
	function set_current_theme_google_map_style() {
		return 'LegalPress';
	}


	/**
	 * Filter setting ProteusWidgets mustache widget views path for LegalPress
	 */
	function set_widgets_view_path() {
		return get_template_directory() . '/inc/widgets-views';
	}


	/**
	* Filter the Featured page widget pw-page-box image size for LegalPress (ProteusWidgets)
	*/
	function set_page_box_image_size( $image ) {
		$image['width']  = 360;
		$image['height'] = 240;
		return $image;
	}


	/**
	* Filter the Featured page widget pw-page-box image size for LegalPress (ProteusWidgets)
	*/
	function default_social_icon( $image ) {
		return 'fa-linkedin-square';
	}


	/**
	* Filter the Featured page widget pw-inline image size for LegalPress (ProteusWidgets)
	*/
	function set_inline_image_size( $image ) {
		$image['width']  = 100;
		$image['height'] = 70;
		return $image;
	}

	/**
	* Filter for the list of Font-Awesome icons in social icons widget in LegalPress (ProteusWidgets)
	*/
	function social_icons_fa_icons_list() {
		return array(
			'fa-facebook-square',
			'fa-twitter-square',
			'fa-youtube-square',
			'fa-google-plus-square',
			'fa-pinterest-square',
			'fa-tumblr-square',
			'fa-xing-square',
			'fa-vimeo-square',
			'fa-linkedin-square',
			'fa-rss-square',
			'fa-github-square',
			'fa-bitbucket-square',
		);
	}

	/**
	* Filter for the Featured page widget in LegalPress (ProteusWidgets). To disable the Read more input field,
	* as it is not need in the theme
	*/
	function featured_page_widget_fields() {
		return array( 'read_more_text' => false );
	}

	/**
	 * Return Google fonts and sizes
	 *
	 * @see https://github.com/grappler/wp-standard-handles/blob/master/functions.php
	 * @return array Google fonts and sizes.
	 */
	function additional_fonts( $fonts ) {

		/* translators: If there are characters in your language that are not supported by Noto Serif, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'legalpress-pt' ) ) {
			$fonts['Roboto'] = array(
				'400' => '400',
				'700' => '700',
			);
			$fonts['Alegreya'] = array(
				'400' => '400',
				'700' => '700',
			);
		}

		return $fonts;
	}


	/**
	 * Add subsets from customizer, if needed.
	 *
	 * @return array
	 */
	function subsets_google_web_fonts( $subsets ) {
		$additional_subset = get_theme_mod( 'charset_setting', 'latin' );

		array_push( $subsets, $additional_subset );

		return $subsets;
	}


	/**
	 * Add the "featured widget" checkbox to the PageBuilder widget panel under Design section.
	 * @link https://siteorigin.com/docs/page-builder/hooks/custom-row-settings/
	 * @param $fields Array of all existing (default) PageBuilder widget settings fields
	 * @return array
	 */
	function add_fields_to_pagebuilder_widget_panel( $fields ) {
		$fields['featured_widgets'] = array(
			'name'     => _x( 'Widget Style', 'backend', 'legalpress-pt' ),
			'type'     => 'checkbox',
			'label'    => _x( 'Set a box around the widget', 'backend', 'legalpress-pt' ),
			'group'    => 'design',
			'priority' => 17,
		);

		$fields['bigger_title'] = array(
			'name'     => _x( 'Widget Title', 'backend', 'legalpress-pt' ),
			'type'     => 'checkbox',
			'label'    => _x( 'Exposed title (bigger font, thin line)', 'backend', 'legalpress-pt' ),
			'group'    => 'design',
			'priority' => 18,
		);

		return $fields;
	}


	/**
	 * Add the functionality of the above "featured widget" checkbox
	 * @link https://siteorigin.com/docs/page-builder/hooks/custom-row-settings/
	 * @param $attributes Array of all attributes that get applied to the widget on front-end
	 * @param $args Array of all settings from the widget panel
	 * @return array
	 */
	function add_attributes_to_pagebuilder_widget_panel( $attributes, $args ) {
		if ( empty( $attributes['class'] ) ) {
			$attributes['class'] = array();
		}

		if ( ! empty( $args['featured_widgets'] ) ) {
			$attributes['class'][] = 'featured-widget';
		}

		if ( ! empty( $args['bigger_title'] ) ) {
			$attributes['class'][] = 'widget-title--big';
		}

		return $attributes;
	}


	/**
	 * Embedded videos and video container around them
	 */
	function embed_oembed_html( $html ) {
		if (
			false !== strstr( $html, 'youtube.com' ) ||
			false !== strstr( $html, 'wordpress.tv' ) ||
			false !== strstr( $html, 'wordpress.com' ) ||
			false !== strstr( $html, 'vimeo.com' )
		) {
			$out = '<div class="embed-responsive  embed-responsive-16by9">' . $html . '</div>';
		} else {
			$out = $html;
		}
		return $out;
	}


	/**
	 * Add more allowed protocols
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_allowed_protocols/
	 */
	static function kses_allowed_protocols( $protocols ) {
		return array_merge( $protocols, array( 'skype' ) );
	}


	/**
	 * Change the default settings for SO
	 * @param  array $settings
	 * @return array
	 */
	function siteorigin_panels_settings_defaults( $settings ) {
		$settings['title-html'] = '<h3 class="widget-title"><span class="widget-title__inline">{{title}}</span></h3>';
		$settings['full-width-container'] = '.boxed-container';
		$settings['mobile-width'] = '991';

		return $settings;
	}

}

// Single instance
$cargoress_filters = new LegalPressFilters();