<?php
/**
 * Featured Slider Options
 *
 * @package Travelore
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function travelore_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'travelore_featured_slider', array(
			'panel' => 'travelore_theme_options',
			'title' => esc_html__( 'Featured Slider', 'travelore' ),
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'travelore_sanitize_select',
			'choices'           => travelore_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'travelore' ),
			'section'           => 'travelore_featured_slider',
			'type'              => 'select',
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'travelore_sanitize_number_range',

			'active_callback'   => 'travelore_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'travelore' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'travelore' ),
			'section'           => 'travelore_featured_slider',
			'type'              => 'number',
		)
	);

	$slider_number = get_theme_mod( 'travelore_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {
		// Page Sliders
		travelore_register_option( $wp_customize, array(
				'name'              => 'travelore_slider_page_' . $i,
				'sanitize_callback' => 'travelore_sanitize_post',
				'active_callback'   => 'travelore_is_slider_active',
				'label'             => esc_html__( 'Page', 'travelore' ) . ' # ' . $i,
				'section'           => 'travelore_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'travelore_slider_options' );

/** Active Callback Functions */

if ( ! function_exists( 'travelore_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Travelore 1.0
	*/
	function travelore_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'travelore_slider_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return travelore_check_section( $enable );
	}
endif;

