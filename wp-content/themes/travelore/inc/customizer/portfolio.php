<?php
/**
 * Add Portfolio Settings in Customizer
 *
 * @package Travelore
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function travelore_portfolio_options( $wp_customize ) {
    // Add note to Jetpack Portfolio Section
    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_jetpack_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Travelore_Note_Control',
            'label'             => sprintf( esc_html__( 'For Portfolio Options , go %1$shere%2$s', 'travelore' ),
                 '<a href="javascript:wp.customize.section( \'travelore_portfolio\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'jetpack_portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	$wp_customize->add_section( 'travelore_portfolio', array(
            'panel' => 'travelore_theme_options',
            'title' => esc_html__( 'Portfolio', 'travelore' ),
        )
    );

    $action = 'install-plugin';
    $slug   = 'essential-content-types';

    $install_url = wp_nonce_url(
        add_query_arg(
            array(
                'action' => $action,
                'plugin' => $slug
            ),
            admin_url( 'update.php' )
        ),
        $action . '_' . $slug
    );

    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_portfolio_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Travelore_Note_Control',
            'active_callback'   => 'travelore_is_ect_portfolio_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Portfolio, install %1$sEssential Content Types%2$s Plugin with Portfolio Type Enabled', 'travelore' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'travelore_portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_portfolio_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'travelore_sanitize_select',
            'active_callback'   => 'travelore_is_ect_portfolio_active',
			'choices'           => travelore_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'travelore' ),
			'section'           => 'travelore_portfolio',
			'type'              => 'select',
		)
	);

    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Travelore_Note_Control',
            'active_callback'   => 'travelore_is_portfolio_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'travelore' ),
                 '<a href="javascript:wp.customize.control( \'jetpack_portfolio_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'travelore_portfolio',
            'type'              => 'description',
        )
    );

    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_portfolio_number',
            'default'           => '4',
            'sanitize_callback' => 'travelore_sanitize_number_range',
            'active_callback'   => 'travelore_is_portfolio_active',
            'label'             => esc_html__( 'Number of items', 'travelore' ),
            'section'           => 'travelore_portfolio',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'travelore_portfolio_number', 4 );

    for ( $i = 1; $i <= $number ; $i++ ) {

        //for CPT
        travelore_register_option( $wp_customize, array(
                'name'              => 'travelore_portfolio_cpt_' . $i,
                'sanitize_callback' => 'travelore_sanitize_post',
                'active_callback'   => 'travelore_is_portfolio_active',
                'label'             => esc_html__( 'Portfolio', 'travelore' ) . ' ' . $i ,
                'section'           => 'travelore_portfolio',
                'type'              => 'select',
                'choices'           => travelore_generate_post_array( 'jetpack-portfolio' ),
            )
        );

    } // End for().
}
add_action( 'customize_register', 'travelore_portfolio_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'travelore_is_portfolio_active' ) ) :
    /**
    * Return true if portfolio is active
    *
    * @since Travelore 1.0
    */
    function travelore_is_portfolio_active( $control ) {
        $enable = $control->manager->get_setting( 'travelore_portfolio_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return ( travelore_is_ect_portfolio_active( $control ) &&  travelore_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'travelore_is_ect_portfolio_inactive' ) ) :
    /**
    *
    * @since Travelore 1.0
    */
    function travelore_is_ect_portfolio_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

if ( ! function_exists( 'travelore_is_ect_portfolio_active' ) ) :
    /**
    *
    * @since Travelore 1.0
    */
    function travelore_is_ect_portfolio_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

