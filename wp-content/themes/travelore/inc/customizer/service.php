<?php
/**
* The template for adding Service Settings in Customizer
*
 * @package Travelore
*/

function travelore_service_options( $wp_customize ) {
	// Add note to Jetpack Portfolio Section
    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_jetpack_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Travelore_Note_Control',
            'label'             => sprintf( esc_html__( 'For Service Options , go %1$shere%2$s', 'travelore' ),
                 '<a href="javascript:wp.customize.section( \'travelore_service\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'ect_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	$wp_customize->add_section( 'travelore_service', array(
			'panel'    => 'travelore_theme_options',
			'title'    => esc_html__( 'Service', 'travelore' ),
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
            'name'              => 'travelore_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Travelore_Note_Control',
            'active_callback'   => 'travelore_is_ect_services_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Service Type Enabled', 'travelore' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'travelore_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_service_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'travelore_sanitize_select',
			'active_callback'   => 'travelore_is_ect_services_active',
			'choices'           => travelore_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'travelore' ),
			'section'           => 'travelore_service',
			'type'              => 'select',
		)
	);

    travelore_register_option( $wp_customize, array(
            'name'              => 'travelore_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Travelore_Note_Control',
            'active_callback'   => 'travelore_is_service_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'travelore' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'travelore_service',
            'type'              => 'description',
        )
    );


	travelore_register_option( $wp_customize, array(
				'name'              => 'travelore_service_number',
				'default'           => 4,
				'sanitize_callback' => 'travelore_sanitize_number_range',
				'active_callback'   => 'travelore_is_service_active',
				'description'       => esc_html__( 'Save and refresh the page if No. of Service is changed', 'travelore' ),
				'input_attrs'       => array(
					'style' => 'width: 100px;',
					'min'   => 0,
				),
				'label'             => esc_html__( 'No of Service', 'travelore' ),
				'section'           => 'travelore_service',
				'type'              => 'number',
		)
	);

	$number = get_theme_mod( 'travelore_service_number', 4 );

	for ( $i = 1; $i <= $number ; $i++ ) {

		//for CPT
		travelore_register_option( $wp_customize, array(
				'name'              => 'travelore_service_cpt_' . $i,
				'sanitize_callback' => 'travelore_sanitize_post',
				'default'           => 0,
				'active_callback'   => 'travelore_is_service_active',
				'label'             => esc_html__( 'Service ', 'travelore' ) . ' ' . $i ,
				'section'           => 'travelore_service',
				'type'              => 'select',
				'choices'           => travelore_generate_post_array( 'ect-service' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'travelore_service_options' );

if ( ! function_exists( 'travelore_is_service_active' ) ) :
	/**
	* Return true if service is active
	*
	* @since Travelore 1.0
	*/
	function travelore_is_service_active( $control ) {
		$enable = $control->manager->get_setting( 'travelore_service_option' )->value();
		
		//return true only if previwed page on customizer matches the type of content option selected
		return ( travelore_is_ect_services_active( $control ) &&  travelore_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'travelore_is_ect_services_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Travelore 1.0
    */
    function travelore_is_ect_services_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'travelore_is_ect_services_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Travelore 1.0
    */
    function travelore_is_ect_services_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

