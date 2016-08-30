<?php
/**
 * Search form
 *
 * @package LegalPress
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php  esc_html_e( 'Search for:', 'legalpress-pt' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php  esc_html_e( 'Search ...', 'legalpress-pt' ); ?>" value="" name="s">
	</label>
	<button type="submit" class="search-submit"><i class="fa  fa-lg  fa-search"></i></button>
</form>