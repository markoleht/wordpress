<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Travelore
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function travelore_testimonial_options( $wp_customize ) {
    // Add note to Jetpack Testimonial Section
    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_jetpack_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Travelore_Note_Control',
            'label'             => sprintf( esc_html__( 'For Testimonial Options , go %1$shere%2$s', 'travelore' ),
                '<a href="javascript:wp.customize.section( \'travelore_testimonials\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'jetpack_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'travelore_testimonials', array(
            'panel'    => 'travelore_theme_options',
            'title'    => esc_html__( 'Testimonials', 'travelore' ),
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
            'name'              => 'travelore_testimonial_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Travelore_Note_Control',
            'active_callback'   => 'travelore_is_ect_testimonial_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with testimonial Type Enabled', 'travelore' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'travelore_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_testimonial_option',
            'default'           => 'disabled',
            'active_callback'   => 'travelore_is_ect_testimonial_active',
            'sanitize_callback' => 'travelore_sanitize_select',
            'choices'           => travelore_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'travelore' ),
            'section'           => 'travelore_testimonials',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Travelore_Note_Control',
            'active_callback'   => 'travelore_is_testimonial_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'travelore' ),
                '<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
                '</a>'
            ),
            'section'           => 'travelore_testimonials',
            'type'              => 'description',
        )
    );

    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_testimonial_number',
            'default'           => '3',
            'sanitize_callback' => 'travelore_sanitize_number_range',
            'active_callback'   => 'travelore_is_testimonial_active',
            'label'             => esc_html__( 'Number of items', 'travelore' ),
            'section'           => 'travelore_testimonials',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'travelore_testimonial_number', 3 );

    for ( $i = 1; $i <= $number ; $i++ ) {

        //for CPT
        travelore_register_option( $wp_customize, array(
                'name'              => 'travelore_testimonial_cpt_' . $i,
                'sanitize_callback' => 'travelore_sanitize_post',
                'active_callback'   => 'travelore_is_testimonial_active',
                'label'             => esc_html__( 'Testimonial', 'travelore' ) . ' ' . $i ,
                'section'           => 'travelore_testimonials',
                'type'              => 'select',
                'choices'           => travelore_generate_post_array( 'jetpack-testimonial' ),
            )
        );
    } // End for().
}
add_action( 'customize_register', 'travelore_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'travelore_is_testimonial_active' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since Travelore 1.0
    */
    function travelore_is_testimonial_active( $control ) {
        $enable = $control->manager->get_setting( 'travelore_testimonial_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return ( travelore_is_ect_testimonial_active( $control ) &&  travelore_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'travelore_is_ect_testimonial_inactive' ) ) :
    /**
    *
    * @since Travelore 1.0
    */
    function travelore_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

if ( ! function_exists( 'travelore_is_ect_testimonial_active' ) ) :
    /**
    *
    * @since Travelore 1.0
    */
    function travelore_is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

