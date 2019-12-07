<?php
/**
 * Header Media Options
 *
 * @package Travelore
 */

function travelore_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'travelore' );

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_header_media_option',
			'default'           => 'disable',
			'sanitize_callback' => 'travelore_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'travelore' ),
				'entire-site'            => esc_html__( 'Entire Site', 'travelore' ),
				'disable'                => esc_html__( 'Disabled', 'travelore' ),
			),
			'label'             => esc_html__( 'Enable on ', 'travelore' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'travelore' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Text', 'travelore' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_header_media_url',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'travelore' ),
			'section'           => 'header_image',
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'travelore' ),
			'section'           => 'header_image',
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_header_url_target',
			'sanitize_callback' => 'travelore_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'travelore' ),
			'section'           => 'header_image',
			'custom_control'	=> 'Travelore_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'travelore_header_media_options' );

