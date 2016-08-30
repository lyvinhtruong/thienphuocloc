<?php
/**
 * The template used for displaying page content in page.php
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
			<!-- Multi Page in One Post -->
			<?php
				$args = array(
					'before'      => '<div class="multi-page  clearfix">' . /* translators: after that comes pagination like 1, 2, 3 ... 10 */ esc_html__( 'Pages:', 'legalpress-pt' ) . ' &nbsp; ',
					'after'       => '</div>',
					'link_before' => '<span class="btn  btn-info">',
					'link_after'  => '</span>',
					'echo'        => 1,
				);
				wp_link_pages( $args );
			?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->