<?php
/**
 * Helper functions
 *
 * @package LegalPress
 */



class LegalPressHelpers {
	/**
	 * Get logo dimensions from the db
	 * @param  string $theme_mod theme mod where the array with width and height is saved
	 * @return mixed             string or FALSE
	 */
	static function get_logo_dimensions( $theme_mod = 'logo_dimensions_array' ) {
		$width_height_array = get_theme_mod( $theme_mod );

		if ( is_array( $width_height_array ) && 2 === count( $width_height_array ) ) {
			return sprintf( ' width="%d" height="%d" ', absint( $width_height_array['width'] ), absint( $width_height_array['height'] ) );
		}
		else {
			return '';
		}
	}


	/**
	 * comments_number() does not use _n function, here we are to fix that
	 * @return void
	 */
	static function pretty_comments_number() {
		global $post;
		printf(
			/* translators: %s represents a number */
			_n( '%s Comment', '%s Comments', get_comments_number(), 'legalpress-pt' ), number_format_i18n( get_comments_number() )
		);
	}


	/**
	 * Check if WooCommerce is active
	 * @return boolean
	 */
	static function is_woocommerce_active() {
		return class_exists( 'Woocommerce' );
	}


	/**
	 * Return array of the number which represent the layout of the footer.
	 * @return array
	 */
	static function footer_widgets_layout_array() {
		$layout = get_theme_mod( 'footer_widgets_layout', '[4,6,8]' );
		$layout = json_decode( $layout );

		if ( is_array( $layout ) && ! empty( $layout ) ) {
			$spans = array( (int) $layout[0] );

			for ( $i = 0; $i < ( sizeof( $layout ) - 1 ); $i++ ) {
				$spans[] = $layout[ $i + 1 ] - $layout[ $i ];
			}

			$spans[] = 12 - $layout[ $i ];

			return $spans;
		}
		else if ( 1 === $layout ) { // single column
			return array( '12' );
		}

		// default: disable footer
		return array();
	}

	/**
	 * Return url with Google Fonts.
	 *
	 * @see https://github.com/grappler/wp-standard-handles/blob/master/functions.php
	 * @return string Google fonts URL for the theme.
	 */
	static function google_web_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = array( 'latin' );

		$fonts = apply_filters( 'pre_google_web_fonts', $fonts );

		foreach ( $fonts as $key => $value ) {
			$fonts[ $key ] = $key . ':' . implode( ',', $value );
		}

		/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'legalpress-pt' );
		if ( 'cyrillic' == $subset ) {
			array_push( $subsets, 'cyrillic', 'cyrillic-ext' );
		} elseif ( 'greek' == $subset ) {
			array_push( $subsets, 'greek', 'greek-ext' );
		} elseif ( 'devanagari' == $subset ) {
			array_push( $subsets, 'devanagari' );
		} elseif ( 'vietnamese' == $subset ) {
			array_push( $subsets, 'vietnamese' );
		}

		$subsets = apply_filters( 'subsets_google_web_fonts', $subsets );

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( implode( ',', array_unique( $subsets ) ) ),
				),
				'//fonts.googleapis.com/css'
			);
		}

		return apply_filters( 'google_web_fonts_url', $fonts_url );
	}


	/**
	 * Prepare the srcset attribute value.
	 * @param  int $img_id ID of the image
	 * @param  array $sizes array of the image sizes. Example: $sizes = array( 'jumbotron-slider-s', 'jumbotron-slider-l' );
	 * @uses http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src
	 * @return string
	 */
	static function get_slide_sizes( $img_id, $sizes ) {
		$srcset = array();

		foreach ( $sizes as $size ) {
			$img = wp_get_attachment_image_src( absint( $img_id ), $size );
			$srcset[] = sprintf( '%s %sw', $img[0], $img[1] );
		}

		return implode( ', ' , $srcset );
	}


	/**
	 * Create a style for the HTML attribute from the array of the CSS properties
	 * @param array $attrs array with CSS settings
	 * @return string of the background style (CSS)
	 */
	static function create_background_style_attr( $attrs ) {
		$bg_style = array();

		if ( ! empty( $attrs ) ) {
			foreach ( $attrs as $key => $value ) {
				$trimmed_val = trim( $value );
				if ( ! empty( $trimmed_val ) ) {
					if ( 'background-image' === $key ) {
						$bg_style[] = $key . ': url(' . esc_url( $trimmed_val ) . ')';
					}
					else if ( 'background-color' === $key ) {
						// to overwrite the gradient set with CSS background property
						$bg_style[] = 'background: ' . $trimmed_val;
					}
					else {
						$bg_style[] = $key . ': ' . $trimmed_val;
					}
				}
			}
		}

		if ( empty( $bg_style ) ) {
			return '';
		}
		else {
			return join( '; ', $bg_style );
		}

	}


	/**
	 * Append right body classes to the body
	 * @return string
	 */
	static function add_body_class() {
		$out = array();

		if ( 'boxed' === get_theme_mod( 'layout_mode', 'wide' ) ) {
			$out[] = 'boxed';
		}

		if ( 'sticky' === get_theme_mod( 'main_navigation_sticky', 'static' ) ) {
			$out[] = 'fixed-navigation';
		}

		return implode( ' ', $out );
	}


	/**
	 * Custom wp_list_comments callback (template)
	 */
	static function custom_comment( $comment, $args, $depth ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
	?>

		<<?php echo tag_escape( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( array( 'clearfix', empty( $args['has_children'] ) ? '' : 'parent' ) ); ?>>
			<div class="avatar-container">
				<?php if ( 0 != $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>
			</div>
			<div class="comment-content">
				<div class="comment-inner">
					<cite class="comment-author vcard">
						<?php echo get_comment_author_link(); ?>
					</cite>
					<div class="comment-metadata">
						<time datetime="<?php comment_time( 'c' ); ?>">
						 	<?php printf( _x( '%1$s at %2$s', '1: date, 2: time' , 'legalpress-pt' ), get_comment_date(), get_comment_time() ); ?>
						</time>
						<?php comment_reply_link( array_merge( $args, array(
							'depth' => $depth,
							'before' => ' / ',
						) ) ); ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'legalpress-pt' ), ' / ' ); ?>
					</div>
					<div class="comment-text">
						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' , 'legalpress-pt' ); ?></p>
						<?php endif; ?>

						<?php comment_text(); ?>
					</div>
				</div>

		<?php
	}

}