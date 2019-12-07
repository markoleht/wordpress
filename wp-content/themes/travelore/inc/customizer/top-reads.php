<?php
/**
 * Top Reads options
 *
 * @package Travelore
 */

/**
 * Add top reads options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function travelore_top_reads_options( $wp_customize ) {
	$wp_customize->add_section( 'travelore_top_reads', array(
			'title' => esc_html__( 'Top Reads', 'travelore' ),
			'panel' => 'travelore_theme_options',
		)
	);

	// Add color scheme setting and control.
	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_top_reads_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'travelore_sanitize_select',
			'choices'           => travelore_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'travelore' ),
			'section'           => 'travelore_top_reads',
			'type'              => 'select',
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_top_reads_title',
			'default'           => esc_html__( 'Top Reads', 'travelore' ),
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'travelore_is_top_reads_active',
			'label'             => esc_html__( 'Title', 'travelore' ),
			'section'           => 'travelore_top_reads',
			'type'              => 'text',
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_top_reads_number',
			'default'           => 4,
			'sanitize_callback' => 'travelore_sanitize_number_range',
			'active_callback'   => 'travelore_is_top_reads_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of items is changed', 'travelore' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'travelore' ),
			'section'           => 'travelore_top_reads',
			'type'              => 'number',
		)
	);

	$number = get_theme_mod( 'travelore_top_reads_number', 4 );

	//loop for featured post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		travelore_register_option( $wp_customize, array(
				'name'              => 'travelore_top_reads_page_' . $i,
				'sanitize_callback' => 'travelore_sanitize_post',
				'active_callback'   => 'travelore_is_top_reads_active',
				'label'             => esc_html__( 'Page', 'travelore' ) . ' ' . $i ,
				'section'           => 'travelore_top_reads',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'travelore_top_reads_options', 10 );

/** Active Callback Functions **/
if( ! function_exists( 'travelore_is_top_reads_active' ) ) :
	/**
	* Return true if top reads is active
	*
	* @since Travelore 1.0
	*/
	function travelore_is_top_reads_active( $control ) {
		$enable = $control->manager->get_setting( 'travelore_top_reads_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return travelore_check_section( $enable );
	}
endif;
