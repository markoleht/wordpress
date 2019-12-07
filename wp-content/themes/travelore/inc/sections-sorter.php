<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Travelore
 */

if ( ! function_exists( 'travelore_sections' ) ) :
	/**
	 * Display Sections on header and footer with respect to the section option set in travelore_sections_sort
	 */
	function travelore_sections( $selector = 'header' ) {
		get_template_part( 'template-parts/header/site-header-main' );
		get_template_part( 'template-parts/navigation/navigation-primary' );
		get_template_part( 'template-parts/news-ticker/display-news-ticker' );
		get_template_part( 'template-parts/header/header-media' );
		get_template_part( 'template-parts/slider/display-slider' );
		get_template_part( 'template-parts/featured-content/display-featured' );
		get_template_part( 'template-parts/service/display-service' );
		get_template_part( 'template-parts/hero-content/content-hero' );
	}
endif;

