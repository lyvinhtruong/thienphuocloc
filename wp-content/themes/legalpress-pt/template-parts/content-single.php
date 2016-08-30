<?php
/**
 * Template part for displaying single posts.
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
	<header class="hentry__header">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-responsive' ) ); ?>
		<?php endif; ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="hentry__meta">
			<?php get_template_part( 'template-parts/meta-data' ); ?>
		</div><!-- .hentry__meta -->
		<?php endif; ?>

		<?php the_title( '<h1 class="hentry__title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

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

	<footer class="hentry__footer">
		<?php // _s_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->