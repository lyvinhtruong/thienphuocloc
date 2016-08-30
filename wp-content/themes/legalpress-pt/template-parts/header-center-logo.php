<div class="header">
	<div class="header__left-widgets">
		<?php
		if ( is_active_sidebar( 'top-widgets' ) ) {
			dynamic_sidebar( 'header-left-widgets' );
		}
		?>
	</div>
	<div class="header__logo">
		<a href="<?php echo esc_url( home_url() ); ?>">
		<?php
			$logo   = get_theme_mod( 'logo_img', false );
			$logo2x = get_theme_mod( 'logo2x_img', false );

		if ( ! empty( $logo ) ) :
			?>
				<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" srcset="<?php echo esc_attr( $logo ); ?><?php echo empty ( $logo2x ) ? '' : ', ' . esc_url( $logo2x ) . ' 2x'; ?>" class="img-responsive" <?php echo LegalPressHelpers::get_logo_dimensions(); ?> />
			<?php
			else :
			?>
				<h1><?php bloginfo( 'name' ); ?></h1>
			<?php
		endif;
		?>
		</a>
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#legalpress-navbar-collapse">
			<span class="navbar-toggle__text"><?php esc_html_e( 'MENU', 'legalpress-pt' ); ?></span>
			<span class="navbar-toggle__icon-bar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</span>
		</button>
	</div>
	<div class="header__right-widgets">
		<?php
		if ( is_active_sidebar( 'header-right-widgets' ) ) {
			dynamic_sidebar( 'header-right-widgets' );
		}
		?>
	</div>
	<div class="header__navigation">
		<nav class="collapse  navbar-collapse" aria-label="<?php esc_html_e( 'Main Menu', 'legalpress-pt' ); ?>" id="legalpress-navbar-collapse">
			<?php
			if ( has_nav_menu( 'main-menu' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'main-menu',
					'container'      => false,
					'menu_class'     => 'main-navigation  js-main-nav',
					'walker'         => new Aria_Walker_Nav_Menu(),
					'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
				) );
			}
			?>
		</nav>
	</div>
</div>