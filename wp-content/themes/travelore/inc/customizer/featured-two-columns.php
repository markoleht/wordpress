<?php
/**
 * Add Featured Two Columns Section in Customizer
 *
 * @package Travelore
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function travelore_featured_two_columns_options( $wp_customize ) {
    $wp_customize->add_section( 'travelore_featured_two_columns', array(
            'panel' => 'travelore_theme_options',
            'title' => esc_html__( 'Featured Two Columns', 'travelore' ),
        )
    );

    travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_featured_two_columns_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'travelore_sanitize_select',
			'choices'           => travelore_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'travelore' ),
			'section'           => 'travelore_featured_two_columns',
			'type'              => 'select',
		)
	);

    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_featured_two_columns_headline',
            'default'           => esc_html__( 'Featured Two Columns', 'travelore' ),
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Headline', 'travelore' ),
            'active_callback'   => 'travelore_is_featured_two_columns_active',
            'section'           => 'travelore_featured_two_columns',
            'type'              => 'text',
        )
    );

    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_featured_two_columns_subheadline',
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Sub headline', 'travelore' ),
            'active_callback'   => 'travelore_is_featured_two_columns_active',
            'section'           => 'travelore_featured_two_columns',
            'type'              => 'textarea',
        )
    );

    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_featured_two_columns_number',
            'default'           => '5',
            'sanitize_callback' => 'travelore_sanitize_number_range',
            'active_callback'   => 'travelore_is_featured_two_columns_active',
            'label'             => esc_html__( 'Number of items', 'travelore' ),
            'section'           => 'travelore_featured_two_columns',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'travelore_featured_two_columns_number', 5 );

    for ( $i = 1; $i <= $number ; $i++ ) {
  
        travelore_register_option( $wp_customize, array(
                'name'              => 'travelore_featured_two_columns_page_' . $i,
                'sanitize_callback' => 'travelore_sanitize_post',
                'active_callback'   => 'travelore_is_featured_two_columns_active',
                'label'             => esc_html__( 'Page', 'travelore' ) . ' ' . $i ,
                'section'           => 'travelore_featured_two_columns',
                'type'              => 'dropdown-pages',
            )
        );
    } // End for().
}
add_action( 'customize_register', 'travelore_featured_two_columns_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'travelore_is_featured_two_columns_active' ) ) :
    /**
    * Return true if portfolio is active
    *
    * @since Travelore 1.0
    */
    function travelore_is_featured_two_columns_active( $control ) {
        $enable = $control->manager->get_setting( 'travelore_featured_two_columns_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return travelore_check_section( $enable );
    }
endif;
