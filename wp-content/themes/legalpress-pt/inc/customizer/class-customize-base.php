<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @package LegalPress
 * @link http://codex.wordpress.org/Theme_Customization_API
 */

class LegalPress_Customizer_Base {
	/**
	 * The singleton manager instance
	 *
	 * @see wp-includes/class-wp-customize-manager.php
	 * @var WP_Customize_Manager
	 */
	protected $wp_customize;

	public function __construct( WP_Customize_Manager $wp_manager ) {
		// set the private propery to instance of wp_manager
		$this->wp_customize = $wp_manager;

		// register the settings/panels/sections/controls, main method
		$this->register();

		/**
		 * Action and filters
		 */

		// render the CSS and cache it to the theme_mod when the setting is saved
		add_action( 'customize_save_after' , array( $this, 'cache_rendered_css' ) );

		// save logo width/height dimensions
		add_action( 'customize_save_logo_img' , array( __CLASS__, 'save_logo_dimensions' ), 10, 1 );

		// flush the rewrite rules after the OT settings are saved
		add_action( 'customize_save_after', 'flush_rewrite_rules' );

		// handle the postMessage transfer method with some dynamically generated JS in the footer of the theme
		add_action( 'wp_footer', array( $this, 'customize_footer_js' ), 30 );
	}

	/**
	* This hooks into 'customize_register' (available as of WP 3.4) and allows
	* you to add new sections and controls to the Theme Customize screen.
	*
	* Note: To enable instant preview, we have to actually write a bit of custom
	* javascript. See live_preview() for more.
	*
	* @see add_action('customize_register',$func)
	*/
	public function register () {
		/**
		 * Settings
		 */

		// branding
		$this->wp_customize->add_setting( 'logo_img' );
		$this->wp_customize->add_setting( 'logo2x_img' );
		$this->wp_customize->add_setting( 'logo_top_margin', array( 'default' => '5' ) );

		// header
		$this->wp_customize->add_setting( 'top_bar_visibility', array( 'default' => 'yes' ) );
		$this->wp_customize->add_setting( 'header_layout', array( 'default' => 'center-logo' ) );

		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'top_bar_bg', array(
			'default' => '#f7f7f7',
			'css_map' => array(
				'background-color' => array(
					'.top',
					'.top .widget_nav_menu ul .sub-menu > li > a',
				),
				'border-bottom-color|darken(3)' => array(
					'.top',
				),
				'border-color' => array(
					'.top .widget_nav_menu ul .sub-menu > li:first-of-type > a',
				)
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'top_bar_color', array(
			'default' => '#999999',
			'css_map' => array(
				'color' => array(
					'.top',
					'.top .icon-box .fa',
					'.top .icon-box__title',
					'.top .icon-box__subtitle',
					'.top .social-icons__link',
					'.top .widget_nav_menu ul > li > a',
					'.top .widget_nav_menu ul .sub-menu > li > a',
				),
			)
		) ) );

		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'header_bg', array(
			'default' => '#ffffff',
			'css_map' => array(
				'background-color' => array(
					'.boxed-container > header',
					'.header__left-widgets',
					'.header__logo',
					'.header__right-widgets',
					'.main-navigation .sub-menu>li>a|@media (max-width: 991px)',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'header_text', array(
			'default' => '#777777',
			'css_map' => array(
				'color' => array(
					'.header',
					'.header .icon-box__title',
				),
				'color|lighten(13)' => array(
					'.header .icon-box__subtitle',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'breadcrumbs_bg', array(
			'default' => '#ffffff',
			'css_map' => array(
				'background-color' => array(
					'.breadcrumbs',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'breadcrumbs_color', array(
			'default' => '#999999',
			'css_map' => array(
				'color' => array(
					'.breadcrumbs a',
				),
				'color|lighten(20)' => array(
					'.breadcrumbs span:first-of-type > a::before',
				),
				'color|darken(13)' => array(
					'.breadcrumbs a:hover',
					'.breadcrumbs span:first-of-type > a:hover::before',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'breadcrumbs_color_active', array(
			'default' => '#777777',
			'css_map' => array(
				'color' => array(
					'.breadcrumbs span > span',
				),
			)
		) ) );

		// navigation
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_navigation_bg', array(
			'default' => '#45414d',
			'css_map' => array(
				'background-color' => array(
					'.main-navigation',
					'.jumbotron',
					'.jumbotron__control',
					'.testimonial__carousel--left',
					'.testimonial__carousel--right',
					'body.woocommerce-page span.onsale',
					'.woocommerce span.onsale',
				),
				'background-color|lighten(8)' => array(
					'.main-navigation .sub-menu > li > a|@media (max-width: 991px)',
				),
				'border-color' => array(
					'.main-navigation',
					'.jumbotron__control',
					'.testimonial__carousel--left',
					'.testimonial__carousel--right',
					'.main-navigation .sub-menu|@media (min-width: 992px)',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_navigation_color', array(
			'default' => '#ffffff',
			'css_map' => array(
				'background-color' => array(
					'.main-navigation > li:hover > a::after|@media (min-width: 992px)',
					'.main-navigation > li:focus > a::after|@media (min-width: 992px)',
				),
				'color' => array(
					'.main-navigation > li > a',
					'.main-navigation .menu-item-has-children::after|@media (min-width: 992px)',
					'.main-navigation > li:hover > a|@media (min-width: 992px)',
					'.main-navigation > li:focus > a|@media (min-width: 992px)',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_navigation_sub_bg', array(
			'default' => '#ccb68d',
			'css_map' => array(
				'background-color' => array(
					'.main-navigation .sub-menu > li > a|@media (min-width: 992px)',
					'.main-navigation ul.sub-menu|@media (min-width: 992px)',
				),
				'border-color|darken(5)' => array(
					'.main-navigation .sub-menu > li > a|@media (min-width: 992px)',
					'.main-navigation .sub-menu .sub-menu > li > a|@media (min-width: 992px)',
					'.main-navigation .sub-menu > li:first-of-type',
				),
				'background-color|darken(5)' => array(
					'.main-navigation .sub-menu > li > a:hover|@media (min-width: 992px)',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_navigation_sub_color', array(
			'default' => '#ffffff',
			'css_map' => array(
				'color' => array(
					'.main-navigation .sub-menu > li > a|@media (min-width: 992px)',
					'.main-navigation .sub-menu > li > a:hover|@media (min-width: 992px)',
					'.main-navigation .sub-menu .menu-item-has-children::after|@media (min-width: 992px)',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_navigation_link_mobile_color_hover', array(
			'default' => '#ccb68d',
			'css_map' => array(
				'color' => array(
					'.main-navigation > li:hover > a|@media (max-width: 991px)',
					'.main-navigation > li:focus > a|@media (max-width: 991px)',
					'.main-navigation .sub-menu > li > a:hover|@media (max-width: 991px)',
				),
			)
		) ) );

		// main title area
		$this->wp_customize->add_setting( 'main_title_mode', array( 'default' => 'big-title-area' ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_title_bg_color', array(
			'default' => '#f7f7f7',
			'css_map' => array(
				'background-color' => array(
					'.main-title',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_title_bg_img', array(
			'default' => get_template_directory_uri() . '/assets/images/pattern-background.png',
			'css_map' => array(
				'background-image|url' => array(
					'.main-title',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_title_color', array(
			'default' => '#333333',
			'css_map' => array(
				'color' => array(
					'.main-title h1',
					'.main-title h2',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'main_subtitle_color', array(
			'default' => '#999999',
			'css_map' => array(
				'color' => array(
					'.main-title h3',
				),
			)
		) ) );

		// typography
		$this->wp_customize->add_setting( 'charset_setting', array( 'default' => 'latin' ) );

		// theme layout & color
		$this->wp_customize->add_setting( 'layout_mode', array( 'default' => 'wide' ) );

		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'text_color', array(
			'default' => '#999999',
			'css_map' => array(
				'color' => array(
					'body',
					'.widget_pw_icon_box .icon-box__subtitle',
					'.latest-news__excerpt',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'headings_color', array(
			'default' => '#45423d',
			'css_map' => array(
				'color' => array(
					'h1',
					'h2',
					'h3',
					'h4',
					'h5',
					'h6',
					'hentry__title',
					'.hentry__title a',
					'.page-box__title a',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'primary_color', array(
			'default' => '#ccb68d',
			'css_map' => array(
				'color' => array(
					'a',
					'hr.hr-quote::after',
					'.top .social-icons__link:hover',
					'.top .icon-box:hover',
					'.main-navigation > .current-menu-item > a',
					'.jumbotron-content__headline',
					'.more-link',
					'.latest-news--more-news',
					'.latest-news--more-news::after',
					'.testimonial__author-description',
					'.sidebar .widget_nav_menu ul > li > a',
					'.main-navigation > .current-menu-item > a:hover',
					'.top a.icon-box:hover .fa',
					'.top a.icon-box:hover .icon-box__title',
					'.top a.icon-box:hover .icon-box__subtitle',
					'.header .icon-box:hover .fa',
					'.person-profile__social_icon:hover',
					'.latest-news__title a:hover',
					'.latest-news--inline:hover .latest-news__title',
					'.footer .icon-container:hover',
					'.footer-bottom a:hover',
					'.top .widget_nav_menu ul > li > a:hover',
					'.top .widget_nav_menu ul > li > a:focus',
					'.top .widget_nav_menu ul .sub-menu > li > a:hover',
					'.top .widget_nav_menu ul .sub-menu > li > a:focus',
					'body.woocommerce-page ul.products li.product a:hover img',
					'.woocommerce ul.products li.product a:hover img',
					'body.woocommerce-page ul.products li.product .price',
					'.woocommerce ul.products li.product .price',
					'body.woocommerce-page .star-rating',
					'.woocommerce .star-rating',
					'body.woocommerce-page div.product p.price',
					'body.woocommerce-page p.stars a',
					'body.woocommerce-page ul.product_list_widget .amount',
					'.woocommerce.widget_shopping_cart .total .amount',
				),
				'color|darken(5)' => array(
					'.sidebar .widget_nav_menu ul > li > a:hover',
				),
				'color|darken(15)' => array(
					'a:hover',
					'a:focus',
				),
				'background-color' => array(
					'.latest-news__date',
					'.entry-content .icon-box .fa',
					'.person-profile__tag',
					'.main-navigation .current-menu-item > a::after|@media (min-width: 992px)',
					'.navbar-toggle',
					'.widget_search .search-submit',
					'.sidebar .widget_nav_menu ul > li.current-menu-item a',
					'.main-navigation > .current-menu-item > a:hover::after|@media (min-width: 992px)',
					'body.woocommerce-page .widget_shopping_cart_content .buttons .checkout',
					'body.woocommerce-page button.button.alt',
					'body.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active',
					'body.woocommerce-page .woocommerce-error a.button',
					'body.woocommerce-page .woocommerce-info a.button',
					'body.woocommerce-page .woocommerce-message a.button',
					'.woocommerce-cart .wc-proceed-to-checkout a.checkout-button',
					'body.woocommerce-page #payment #place_order',
					'body.woocommerce-page #review_form #respond input#submit',
					'.woocommerce button.button.alt:disabled',
					'.woocommerce button.button.alt:disabled:hover',
					'.woocommerce button.button.alt:disabled[disabled]',
					'.woocommerce button.button.alt:disabled[disabled]:hover',
				),
				'background-color|darken(5)' => array(
					'.navbar-toggle:hover',
					'.widget_search .search-submit:hover',
					'.widget_search .search-submit:focus',
					'body.woocommerce-page .widget_shopping_cart_content .buttons .checkout:hover',
					'body.woocommerce-page button.button.alt:hover',
					'body.woocommerce-page .woocommerce-error a.button:hover',
					'body.woocommerce-page .woocommerce-info a.button:hover',
					'body.woocommerce-page .woocommerce-message a.button:hover',
					'.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover',
					'body.woocommerce-page #payment #place_order:hover',
					'body.woocommerce-page #review_form #respond input#submit:hover',
				),
				'border-color' => array(
					'.person-profile__content',
					'.btn-primary',
					'.pagination .prev',
					'.pagination .next',
					'.entry-content .icon-box:hover',
					'.logo-panel img:hover',
					'body.woocommerce-page .widget_shopping_cart_content .buttons .checkout',
				),
				'background|linear_gradient_to_bottom(1)' => array(
					'.btn-primary',
					'body.woocommerce-page nav.woocommerce-pagination ul li .prev',
					'body.woocommerce-page nav.woocommerce-pagination ul li .next',
					'.pagination .prev',
					'.pagination .next',
				),
				'background|darken(5)' => array(
					'.btn-primary:hover',
					'body.woocommerce-page nav.woocommerce-pagination ul li .prev:hover',
					'body.woocommerce-page nav.woocommerce-pagination ul li .next:hover',
					'.pagination .prev:hover',
					'.pagination .next:hover',
				),
				'border-color|darken(5)' => array(
					'.btn-primary:hover',
					'.pagination .prev:hover',
					'.pagination .next:hover',
				),
			)
		) ) );

		// shop
		$this->wp_customize->add_setting( 'products_per_page', array( 'default' => 9 ) );
		$this->wp_customize->add_setting( 'single_product_sidebar', array( 'default' => 'left' ) );

		// footer
		$this->wp_customize->add_setting( 'footer_widgets_layout', array( 'default' => '[4,6,8]' ) );

		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'footer_bg_img', array(
			'default' => get_template_directory_uri() . '/assets/images/footer_bg_img.png',
			'css_map' => array(
				'background-image|url' => array(
					'.footer-top',
				),
			)
		) ) );

		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'footer_bg_color', array(
			'default' => '#45414d',
			'css_map' => array(
				'background-color' => array(
					'.footer-top',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'footer_title_color', array(
			'default' => '#ffffff',
			'css_map' => array(
				'color' => array(
					'.footer-top__headings',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'footer_text_color', array(
			'default' => '#b2b1b5',
			'css_map' => array(
				'color' => array(
					'.footer-top',
					'.footer-top .textwidget',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'footer_link_color', array(
			'default' => '#b2b1b5',
			'css_map' => array(
				'color' => array(
					'.footer-top .widget_nav_menu ul > li > a',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'footer_bottom_bg_color', array(
			'default' => '#393640',
			'css_map' => array(
				'background-color' => array(
					'.footer-bottom',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'footer_bottom_text_color', array(
			'default' => '#999999',
			'css_map' => array(
				'color' => array(
					'.footer-bottom',
				),
			)
		) ) );
		$this->wp_customize->add_setting( new ProteusThemes_Customize_Setting_Dynamic_CSS( $this->wp_customize, 'footer_bottom_link_color', array(
			'default' => '#ffffff',
			'css_map' => array(
				'color' => array(
					'.footer-bottom a',
				),
			)
		) ) );
		$this->wp_customize->add_setting( 'footer_left_txt', array( 'default' => 'LegalPress Theme Made by <a href="https://www.proteusthemes.com/">ProteusThemes</a>.' ) );
		$this->wp_customize->add_setting( 'footer_center_txt', array( 'default' => '<i class="fa  fa-3x  fa-cc-visa"></i> &nbsp; <i class="fa  fa-3x  fa-cc-mastercard"></i> &nbsp; <i class="fa  fa-3x  fa-cc-amex"></i> &nbsp; <i class="fa  fa-3x  fa-cc-paypal"></i>' ) );
		$this->wp_customize->add_setting( 'footer_right_txt', array( 'default' => 'Copyright &copy; 2009–2015 LegalPress. All rights reserved.' ) );

		// custom code (css/js)
		$this->wp_customize->add_setting( 'custom_css', array( 'default' => '' ) );
		$this->wp_customize->add_setting( 'custom_js_head' );
		$this->wp_customize->add_setting( 'custom_js_footer' );

		// acf
		$this->wp_customize->add_setting( 'show_acf', array( 'default' => 'no' ) );

		/**
		 * Panel and Sections
		 */

		// one ProteusThemes panel to rule them all
		$this->wp_customize->add_panel( 'panel_legalpress', array(
			'title'       => _x( '[PT] Theme Options', 'backend', 'legalpress-pt' ),
			'description' => _x( 'All LegalPress theme specific settings.', 'backend', 'legalpress-pt' ),
			'priority'    => 10,
		) );

		// individual sections

		// Logo
		$logo_section_array = array(
			'title'       => _x( 'Logo', 'backend', 'legalpress-pt' ),
			'description' => _x( 'Logo settings for the LegalPress theme.', 'backend', 'legalpress-pt' ),
			'priority'    => 10,
			'panel'       => 'panel_legalpress',
		);

		// Theme favicon section, which will be phased out, because of WP core favicon integration
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
			$logo_section_array['title']       = _x( 'Logo &amp; Favicon', 'backend', 'legalpress-pt' );
			$logo_section_array['description'] = _x( 'Logo &amp; Favicon for the LegalPress theme.', 'backend', 'legalpress-pt' );
		}

		$this->wp_customize->add_section( 'legalpress_section_logos', $logo_section_array );

		// Header
		$this->wp_customize->add_section( 'legalpress_section_header', array(
			'title'       => _x( 'Header &amp; Breadcrumbs', 'backend', 'legalpress-pt' ),
			'description' => _x( 'All layout and appearance settings for the header and breadcrumbs.', 'backend', 'legalpress-pt' ),
			'priority'    => 20,
			'panel'       => 'panel_legalpress',
		) );

		$this->wp_customize->add_section( 'legalpress_section_navigation', array(
			'title'       => _x( 'Navigation', 'backend', 'legalpress-pt' ),
			'description' => _x( 'Navigation for the LegalPress theme.', 'backend', 'legalpress-pt' ),
			'priority'    => 30,
			'panel'       => 'panel_legalpress',
		) );

		$this->wp_customize->add_section( 'legalpress_section_main_title', array(
			'title'       => _x( 'Main Title Area', 'backend', 'legalpress-pt' ),
			'description' => _x( 'All layout and appearance settings for the main title area (regular pages).', 'backend', 'legalpress-pt' ),
			'priority'    => 33,
			'panel'       => 'panel_legalpress',
		) );

		$this->wp_customize->add_section( 'legalpress_section_typography', array(
			'title'       => _x( 'Typography', 'backend', 'legalpress-pt' ),
			'priority'    => 35,
			'panel'       => 'panel_legalpress',
		) );

		$this->wp_customize->add_section( 'legalpress_section_theme_colors', array(
			'title'       => _x( 'Theme Layout &amp; Colors', 'backend', 'legalpress-pt' ),
			'priority'    => 40,
			'panel'       => 'panel_legalpress',
		) );

		if ( LegalPressHelpers::is_woocommerce_active() ) {
			$this->wp_customize->add_section( 'legalpress_section_shop', array(
				'title'       => _x( 'Shop', 'backend', 'legalpress-pt' ),
				'priority'    => 80,
				'panel'       => 'panel_legalpress',
			) );
		}

		$this->wp_customize->add_section( 'section_footer', array(
			'title'       => _x( 'Footer', 'backend', 'legalpress-pt' ),
			'description' => _x( 'All layout and appearance settings for the footer.', 'backend', 'legalpress-pt' ),
			'priority'    => 90,
			'panel'       => 'panel_legalpress',
		) );

		$this->wp_customize->add_section( 'section_custom_code', array(
			'title'       => _x( 'Custom Code' , 'backend', 'legalpress-pt' ),
			'priority'    => 100,
			'panel'       => 'panel_legalpress',
		) );

		$this->wp_customize->add_section( 'section_other', array(
			'title'       => _x( 'Other' , 'backend', 'legalpress-pt' ),
			'priority'    => 150,
			'panel'       => 'panel_legalpress',
		) );

		/**
		 * Controls
		 */

		// Section: legalpress_section_logos
		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'logo_img',
			array(
				'label'       => _x( 'Logo Image', 'backend', 'legalpress-pt' ),
				'description' => _x( 'Max height for the logo image is 120px.', 'backend', 'legalpress-pt' ),
				'section'     => 'legalpress_section_logos',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'logo2x_img',
			array(
				'label'       => _x( 'Retina Logo Image', 'backend', 'legalpress-pt' ),
				'description' => _x( '2x logo size, for screens with high DPI.', 'backend', 'legalpress-pt' ),
				'section'     => 'legalpress_section_logos',
			)
		) );
		$this->wp_customize->add_control(
			'logo_top_margin',
			array(
				'type'        => 'number',
				'label'       => _x( 'Logo top margin', 'backend', 'legalpress-pt' ),
				'description' => _x( 'In pixels.', 'backend', 'legalpress-pt' ),
				'section'     => 'legalpress_section_logos',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 120,
					'step' => 10,
				),
			)
		);

		// Section: header
		$this->wp_customize->add_control( 'top_bar_visibility', array(
			'type'        => 'select',
			'priority'    => 0,
			'label'       => _x( 'Top bar visibility', 'backend', 'legalpress-pt' ),
			'description' => _x( 'Show or hide?', 'backend', 'legalpress-pt' ),
			'section'     => 'legalpress_section_header',
			'choices'     => array(
				'yes'         => _x( 'Show', 'backend', 'legalpress-pt' ),
				'no'          => _x( 'Hide', 'backend', 'legalpress-pt' ),
				'hide_mobile' => _x( 'Hide on Mobile', 'backend', 'legalpress-pt' ),
			),
		) );
		$this->wp_customize->add_control( 'header_layout', array(
			'type'        => 'select',
			'priority'    => 1,
			'label'       => _x( 'Header layout', 'backend', 'legalpress-pt' ),
			'description' => _x( 'Choose the position of the logo.', 'backend', 'legalpress-pt' ),
			'section'     => 'legalpress_section_header',
			'choices'     => array(
				'center-logo' => _x( 'Logo in the center', 'backend', 'legalpress-pt' ),
				'left-logo'   => _x( 'Logo on the left', 'backend', 'legalpress-pt' ),
			),
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'top_bar_bg',
			array(
				'priority' => 2,
				'label'    => _x( 'Top bar background color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_header',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'top_bar_color',
			array(
				'priority' => 3,
				'label'    => _x( 'Top bar text color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_header',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'header_bg',
			array(
				'priority' => 30,
				'label'    => _x( 'Header background color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_header',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'header_text',
			array(
				'priority' => 32,
				'label'    => _x( 'Header text color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_header',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'breadcrumbs_bg',
			array(
				'priority' => 60,
				'label'    => _x( 'Breadcrumbs background color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_header',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'breadcrumbs_color',
			array(
				'priority' => 61,
				'label'    => _x( 'Breadcrumbs text color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_header',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'breadcrumbs_color_active',
			array(
				'priority' => 62,
				'label'    => _x( 'Breadcrumbs active text color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_header',
			)
		) );

		// Section: legalpress_section_navigation
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_bg',
			array(
				'priority' => 120,
				'label'    => _x( 'Main navigation background color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_navigation',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_color',
			array(
				'priority' => 130,
				'label'    => _x( 'Main navigation link color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_navigation',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_sub_bg',
			array(
				'priority' => 160,
				'label'    => _x( 'Main navigation submenu background', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_navigation',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_sub_color',
			array(
				'priority' => 170,
				'label'    => _x( 'Main navigation submenu link color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_navigation',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_navigation_link_mobile_color_hover',
			array(
				'priority' => 190,
				'label'    => _x( 'Main navigation link hover color (mobile)', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_navigation',
			)
		) );

		// section: legalpress_section_main_title
		$this->wp_customize->add_control( 'main_title_mode', array(
			'type'     => 'select',
			'priority' => 0,
			'label'    => _x( 'Main title option', 'backend', 'legalpress-pt' ),
			'section'  => 'legalpress_section_main_title',
			'choices'  => array(
				'big-title-area'   => _x( 'Big title area', 'backend', 'legalpress-pt' ),
				'small-title-area' => _x( 'Small title area', 'backend', 'legalpress-pt' ),
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_title_bg_color',
			array(
				'priority' => 10,
				'label'    => _x( 'Main title background color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_main_title',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'main_title_bg_img',
			array(
				'priority' => 20,
				'label'    => _x( 'Main title background pattern', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_main_title',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_title_color',
			array(
				'priority' => 30,
				'label'    => _x( 'Main title color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_main_title',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'main_subtitle_color',
			array(
				'priority' => 31,
				'label'    => _x( 'Main subtitle color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_main_title',
			)
		) );

		// Section: legalpress_section_typography
		$this->wp_customize->add_control( 'charset_setting', array(
			'type'     => 'select',
			'priority' => 0,
			'label'    => _x( 'Character set for Google Fonts', 'backend' , 'legalpress-pt' ),
			'section'  => 'legalpress_section_typography',
			'choices'  => array(
				'latin'        => 'Latin',
				'latin-ext'    => 'Latin Extended',
				'cyrillic'     => 'Cyrillic',
				'cyrillic-ext' => 'Cyrillic Extended',
			)
		) );

		// Section: legalpress_section_theme_colors
		$this->wp_customize->add_control( 'layout_mode', array(
			'type'     => 'select',
			'priority' => 10,
			'label'    => _x( 'Layout', 'backend', 'legalpress-pt' ),
			'section'  => 'legalpress_section_theme_colors',
			'choices'  => array(
				'wide'  => _x( 'Wide', 'backend', 'legalpress-pt' ),
				'boxed' => _x( 'Boxed', 'backend', 'legalpress-pt' ),
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'text_color',
			array(
				'priority' => 30,
				'label'    => _x( 'Text color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_theme_colors',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'headings_color',
			array(
				'priority' => 31,
				'label'    => _x( 'Headings color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_theme_colors',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'primary_color',
			array(
				'priority' => 32,
				'label'    => _x( 'Primary color', 'backend', 'legalpress-pt' ),
				'section'  => 'legalpress_section_theme_colors',
			)
		) );

		// Section: legalpress_section_shop
		if ( LegalPressHelpers::is_woocommerce_active() ) {
			$this->wp_customize->add_control( 'products_per_page', array(
					'label'   => _x( 'Number of products per page', 'backend', 'legalpress-pt' ),
					'section' => 'legalpress_section_shop',
				)
			);
			$this->wp_customize->add_control( 'single_product_sidebar', array(
					'label'   => _x( 'Sidebar on single product page', 'backend', 'legalpress-pt' ),
					'section' => 'legalpress_section_shop',
					'type'    => 'select',
					'choices' => array(
						'none'  => _x( 'No sidebar', 'backend', 'legalpress-pt' ),
						'left'  => _x( 'Left', 'backend', 'legalpress-pt' ),
						'right' => _x( 'Right', 'backend', 'legalpress-pt' ),
					)
				)
			);
		}

		// Section: section_footer
		$this->wp_customize->add_control( new WP_Customize_Range_Control(
			$this->wp_customize,
			'footer_widgets_layout',
			array(
				'priority'    => 1,
				'label'       => _x( 'Footer widgets layout', 'backend', 'legalpress-pt' ),
				'description' => _x( 'Select number of widget you want in the footer and then with the slider rearrange the layout', 'backend', 'legalpress-pt' ),
				'section'     => 'section_footer',
				'input_attrs' => array(
					'min'     => 0,
					'max'     => 12,
					'step'    => 1,
					'maxCols' => 6,
				)
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Image_Control(
			$this->wp_customize,
			'footer_bg_img',
			array(
				'priority' => 5,
				'label'    => _x( 'Footer background image', 'backend', 'legalpress-pt' ),
				'section'  => 'section_footer',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_bg_color',
			array(
				'priority' => 10,
				'label'    => _x( 'Footer background color', 'backend', 'legalpress-pt' ),
				'section'  => 'section_footer',
			)
		) );
		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_title_color',
			array(
				'priority' => 30,
				'label'    => _x( 'Footer widget title color', 'backend', 'legalpress-pt' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_text_color',
			array(
				'priority' => 31,
				'label'    => _x( 'Footer text color', 'backend', 'legalpress-pt' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_link_color',
			array(
				'priority' => 32,
				'label'    => _x( 'Footer link color', 'backend', 'legalpress-pt' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_bottom_bg_color',
			array(
				'priority' => 35,
				'label'    => _x( 'Footer bottom background color', 'backend', 'legalpress-pt' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_bottom_text_color',
			array(
				'priority' => 36,
				'label'    => _x( 'Footer bottom text color', 'backend', 'legalpress-pt' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( new WP_Customize_Color_Control(
			$this->wp_customize,
			'footer_bottom_link_color',
			array(
				'priority' => 37,
				'label'    => _x( 'Footer bottom link color', 'backend', 'legalpress-pt' ),
				'section'  => 'section_footer',
			)
		) );

		$this->wp_customize->add_control( 'footer_left_txt', array(
				'type'        => 'text',
				'priority'    => 110,
				'label'       => _x( 'Footer text on left', 'backend', 'legalpress-pt' ),
				'description' => _x( 'You can use HTML.', 'backend', 'legalpress-pt' ),
				'section'     => 'section_footer',
			) );

		$this->wp_customize->add_control( 'footer_center_txt', array(
			'type'        => 'text',
			'priority'    => 115,
			'label'       => _x( 'Footer text in center', 'backend', 'legalpress-pt' ),
			'description' => _x( 'You can use HTML.', 'backend', 'legalpress-pt' ),
			'section'     => 'section_footer',
		) );

		$this->wp_customize->add_control( 'footer_right_txt', array(
			'type'        => 'text',
			'priority'    => 120,
			'label'       => _x( 'Footer text on right', 'backend', 'legalpress-pt' ),
			'description' => _x( 'You can use HTML.', 'backend', 'legalpress-pt' ),
			'section'     => 'section_footer',
		) );

		// Section: section_custom_code
		$this->wp_customize->add_control( 'custom_css', array(
			'type'        => 'textarea',
			'label'       => _x( 'Custom CSS', 'backend', 'legalpress-pt' ),
			'description' => sprintf( _x( '%s How to find CSS classes %s in the theme.', 'backend', 'legalpress-pt' ), '<a href="https://www.youtube.com/watch?v=V2aAEzlvyDc" target="_blank">', '</a>' ),
			'section'     => 'section_custom_code',
		) );

		$this->wp_customize->add_control( 'custom_js_head', array(
			'type'        => 'textarea',
			'label'       => _x( 'Custom JavaScript (head)', 'backend', 'legalpress-pt' ),
			'description' => _x( 'You have to include the &lt;script&gt;&lt;/script&gt; tags as well. Paste your Google Analytics tracking code here.', 'backend', 'legalpress-pt' ),
			'section'     => 'section_custom_code',
		) );

		$this->wp_customize->add_control( 'custom_js_footer', array(
			'type'        => 'textarea',
			'label'       => _x( 'Custom JavaScript (footer)', 'backend', 'legalpress-pt' ),
			'description' => _x( 'You have to include the &lt;script&gt;&lt;/script&gt; tags as well.', 'backend', 'legalpress-pt' ),
			'section'     => 'section_custom_code',
		) );

		// Section: section_other
		$this->wp_customize->add_control( 'show_acf', array(
			'type'        => 'select',
			'label'       => _x( 'Show ACF admin panel?', 'backend', 'legalpress-pt' ),
			'description' => _x( 'If you want to use ACF and need the ACF admin panel set this to <strong>Yes</strong>. Do not change if you do not know what you are doing.', 'backend', 'legalpress-pt' ),
			'section'     => 'section_other',
			'choices'     => array(
				'no'  => _x( 'No', 'backend', 'legalpress-pt' ),
				'yes' => _x( 'Yes', 'backend', 'legalpress-pt' ),
			),
		) );


		// Theme favicon setting and control, which will be phased out, because of WP core favicon integration
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
			$this->wp_customize->add_setting( 'favicon' );

			$this->wp_customize->add_control( new WP_Customize_Image_Control(
				$this->wp_customize,
				'favicon',
				array(
					'label'       => _x( 'Favicon Image', 'backend', 'legalpress-pt' ),
					'description' => _x( 'Recommended dimensions are 32 x 32px.', 'backend', 'legalpress-pt' ),
					'section'     => 'legalpress_section_logos',
				)
			) );
		}
	}

	/**
	 * Cache the rendered CSS after the settings are saved in the DB.
	 * This is purely a performance improvement.
	 *
	 * Used by hook: add_action( 'customize_save_after' , array( $this, 'cache_rendered_css' ) );
	 *
	 * @return void
	 */
	public function cache_rendered_css() {
		set_theme_mod( 'cached_css', $this->render_css() );
	}

	/**
	 * Get the dimensions of the logo image when the setting is saved
	 * This is purely a performance improvement.
	 *
	 * Used by hook: add_action( 'customize_save_logo_img' , array( $this, 'save_logo_dimensions' ), 10, 1 );
	 *
	 * @return void
	 */
	public static function save_logo_dimensions( $setting ) {
		$logo_width_height = array();
		$img_data          = getimagesize( esc_url( $setting->post_value() ) );

		if ( is_array( $img_data ) ) {
			$logo_width_height = array_slice( $img_data, 0, 2 );
			$logo_width_height = array_combine( array( 'width', 'height' ), $logo_width_height );
		}

		set_theme_mod( 'logo_dimensions_array', $logo_width_height );
	}

	/**
	 * Render the CSS from all the settings which are of type `ProteusThemes_Customize_Setting_Dynamic_CSS`
	 *
	 * @return string text/css
	 */
	public function render_css() {
		$out = '';

		foreach ( $this->get_dynamic_css_settings() as $setting ) {
			$out .= $setting->render_css();
		}

		return $out;
	}

	/**
	 * Get only the CSS settings of type `ProteusThemes_Customize_Setting_Dynamic_CSS`.
	 *
	 * @see is_dynamic_css_setting
	 * @return array
	 */
	public function get_dynamic_css_settings() {
		return array_filter( $this->wp_customize->settings(), array( $this, 'is_dynamic_css_setting' ) );
	}

	/**
	 * Helper conditional function for filtering the settings.
	 *
	 * @see
	 * @param  mixed  $setting
	 * @return boolean
	 */
	protected function is_dynamic_css_setting( $setting ) {
		return is_a( $setting, 'ProteusThemes_Customize_Setting_Dynamic_CSS' );
	}

	/**
	 * Dynamically generate the JS for previewing the settings of type `ProteusThemes_Customize_Setting_Dynamic_CSS`.
	 *
	 * This function is better for the UX, since all the color changes are transported to the live
	 * preview frame using the 'postMessage' method. Since the JS is generated on-the-fly and we have a single
	 * entry point of entering settings along with related css properties and classes, we cannnot forget to
	 * include the setting in the customizer itself. Neat, man!
	 *
	 * @return string text/javascript
	 */
	public function customize_footer_js() {
		$settings = $this->get_dynamic_css_settings();

		ob_start();
		?>

			<script type="text/javascript">
				( function( $ ) {
					'use strict';

				<?php
				foreach ( $settings as $key_id => $setting ) :
				?>

					wp.customize( '<?php echo esc_js( $key_id ); ?>', function( value ) {
						value.bind( function( newval ) {

						<?php
						foreach ( $setting->get_css_map() as $css_prop_raw => $css_selectors ) {
							extract( $setting->filter_css_property( $css_prop_raw ) );

							// background image needs a little bit different treatment
							if ( 'background-image' === $css_prop ) {
								echo 'newval = "url(" + newval + ")";' . PHP_EOL;
							}

							printf( '$( "%1$s" ).css( "%2$s", newval );%3$s', $setting->plain_selectors_for_all_groups( $css_prop_raw ), $css_prop, PHP_EOL );
						}
						?>

						} );
					} );

				<?php
				endforeach;
				?>

				} )( jQuery );
			</script>

		<?php

		echo ob_get_clean();
	}
}