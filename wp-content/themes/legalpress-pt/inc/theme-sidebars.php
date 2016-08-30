<?php
/**
 * Register sidebars for LegalPress
 *
 * @package LegalPress
 */

function legalpress_sidebars() {
	// Blog Sidebar
	register_sidebar(
		array(
			'name'          => _x( 'Blog Sidebar', 'backend', 'legalpress-pt' ),
			'id'            => 'blog-sidebar',
			'description'   => _x( 'Sidebar on the blog layout.', 'backend', 'legalpress-pt' ),
			'class'         => 'blog  sidebar',
			'before_widget' => '<div class="widget  %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="sidebar__headings">',
			'after_title'   => '</h4>',
		)
	);

	// Regular Page Sidebar
	register_sidebar(
		array(
			'name'          => _x( 'Regular Page Sidebar', 'backend', 'legalpress-pt' ),
			'id'            => 'regular-page-sidebar',
			'description'   => _x( 'Sidebar on the regular page.', 'backend', 'legalpress-pt' ),
			'class'         => 'sidebar',
			'before_widget' => '<div class="widget  %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="sidebar__headings">',
			'after_title'   => '</h4>',
		)
	);

	// woocommerce shop sidebar
	if ( LegalPressHelpers::is_woocommerce_active() ) {
		register_sidebar(
			array(
				'name'          => _x( 'Shop Sidebar', 'backend' , 'legalpress-pt' ),
				'id'            => 'shop-sidebar',
				'description'   => _x( 'Sidebar for the shop page', 'backend' , 'legalpress-pt' ),
				'class'         => 'sidebar',
				'before_widget' => '<div class="widget  %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="sidebar__headings">',
				'after_title'   => '</h4>',
			)
		);
	}

	// Header Left - register only if the the header layout is center
	if ( 'center-logo' === get_theme_mod( 'header_layout', 'center-logo' ) ) {
		register_sidebar(
			array(
				'name'          => _x( 'Header Left', 'backend', 'legalpress-pt' ),
				'id'            => 'header-left-widgets',
				'description'   => _x( 'Header area for left side of the header.', 'backend', 'legalpress-pt' ),
				'before_widget' => '<div class="widget  %2$s">',
				'after_widget'  => '</div>',
			)
		);
	}

	// Header Right
	register_sidebar(
		array(
			'name'          => _x( 'Header Right', 'backend', 'legalpress-pt' ),
			'id'            => 'header-right-widgets',
			'description'   => _x( 'Header area for right side of the header.', 'backend', 'legalpress-pt' ),
			'before_widget' => '<div class="widget  %2$s">',
			'after_widget'  => '</div>',
		)
	);

	// Top
	register_sidebar(
		array(
			'name'          => _x( 'Top', 'backend', 'legalpress-pt' ),
			'id'            => 'top-widgets',
			'description'   => _x( 'Top area for Icon Box and Social Icons widgets.', 'backend', 'legalpress-pt' ),
			'before_widget' => '<div class="widget  %2$s">',
			'after_widget'  => '</div>',
		)
	);

	// Footer
	$footer_widgets_num = count( LegalPressHelpers::footer_widgets_layout_array() );

	// only register if not 0
	if ( $footer_widgets_num > 0 ) {
		register_sidebar(
			array(
				'name'          => _x( 'Footer', 'backend', 'legalpress-pt' ),
				'id'            => 'footer-widgets',
				'description'   => sprintf( _x( 'Footer area works best with %d widgets. This number can be changed in the Appearance &rarr; Customize &rarr; Theme Options &rarr; Footer.', 'backend', 'legalpress-pt' ), $footer_widgets_num ),
				'before_widget' => '<div class="col-xs-12  col-md-__col-num__"><div class="widget  %2$s">', // __col-num__ is replaced dynamically in filter 'dynamic_sidebar_params'
				'after_widget'  => '</div></div>',
				'before_title'  => '<h6 class="footer-top__headings">',
				'after_title'   => '</h6>',
			)
		);
	}
}
add_action( 'widgets_init', 'legalpress_sidebars' );