<?php
/**
 * The template used for displaying slider
 *
 * @package Travelore
 */
?>
<?php
$enable_slider = get_theme_mod( 'travelore_slider_option', 'disabled' );

if ( ! travelore_check_section( $enable_slider ) ) {
	return;
}

?>

<div id="feature-slider-section" class="section">
	<div class="wrapper section-content-wrapper">
		<div class="main-slider owl-carousel">
			<?php
			// Select Slider
				get_template_part( 'template-parts/slider/post-type', 'slider' );		
			?>
		</div><!-- .main-slider -->
	</div><!-- .wrapper -->
</div><!-- #feature-slider -->

