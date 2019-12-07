<?php
/**
 * Displays Header Right Search
 *
 * @package Travelore
 */
?>
<button id="search-toggle" class="menu-search-toggle menu-toggle"><?php echo travelore_get_svg( array(
	'icon' => 'search',
), true ); echo travelore_get_svg( array(
	'icon' => 'close',
), true ); ?><span class="screen-reader-text"><?php esc_html_e( 'Search', 'travelore' ); ?></span></button>

<div id="search-social-container" class="search-social-container secondary-search-wrapper">
	<div id="search-social-container-right" class="search-social-container-right">
    	<div class="search-container">
        	<?php get_search_form(); ?>
        </div><!-- .search-container -->
	</div><!-- #search-social-container -->
</div><!-- .secondary-search-wrapper -->
