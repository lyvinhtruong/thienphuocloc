<div class="meta-data">
	<time datetime="<?php the_time( 'c' ); ?>" class="meta-data__date"><?php echo get_the_date(); ?></time>
	<span class="meta-data__separator">|</span>
	<span class="meta-data__author"><?php the_author(); ?></span>
	<span class="meta-data__separator">|</span>
	<span class="meta-data__comments"><a href="<?php comments_link(); ?>"><?php LegalPressHelpers::pretty_comments_number(); ?></a></span>
	<span class="meta-data__separator">|</span>
	<?php if ( has_category() ) { ?>
		<span class="meta-data__categories"><?php esc_html_e( '' , 'legalpress-pt' ); ?> <?php the_category( ', ' ); ?></span>
	<?php } ?>
	<?php if ( has_tag() ) { ?>
		<span class="meta-data__separator">|</span>
		<span class="meta-data__tags"><?php esc_html_e( '' , 'legalpress-pt' ); ?> <?php the_tags( '', ', ' ); ?></span>
	<?php } ?>
</div>