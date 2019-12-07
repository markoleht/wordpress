<?php
/**
 * Displays Header Right Navigation
 *
 * @package Travelore
 */
?>

<?php if ( has_nav_menu( 'social-header-right' ) ): ?>
	<nav id="social-secondary-navigation-top" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Header Right Social Links Menu', 'travelore' ); ?>">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'social-header-right',
				'menu_class'     => 'social-links-menu',
				'depth'          => 1,
				'link_before'    => '<span class="screen-reader-text">',
				'link_after'     => '</span>' . travelore_get_svg( array( 'icon' => 'chain' ) ),
			) );
		?>
	</nav><!-- #social-secondary-navigation -->
<?php endif;
