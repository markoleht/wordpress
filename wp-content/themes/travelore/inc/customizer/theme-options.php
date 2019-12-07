<?php
/**
 * Theme Options
 *
 * @package Travelore
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function travelore_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'travelore_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'travelore' ),
		'priority' => 130,
	) );
	
	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_latest_posts_title',
			'default'           => esc_html__( 'News', 'travelore' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Latest Posts Title', 'travelore' ),
			'section'           => 'travelore_theme_options',
		)
	);

	// Layout Options
	$wp_customize->add_section( 'travelore_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'travelore' ),
		'panel' => 'travelore_theme_options',
		)
	);

	/* Default Layout */
	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'travelore_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'travelore' ),
			'section'           => 'travelore_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'travelore' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'travelore' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_homepage_archive_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'travelore_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'travelore' ),
			'section'           => 'travelore_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'travelore' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'travelore' ),
			),
		)
	);

	/* Single Page/Post Image Layout */
	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'travelore_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image Layout', 'travelore' ),
			'section'           => 'travelore_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'disabled'         => esc_html__( 'Disabled', 'travelore' ),
				'post-thumbnail'   => esc_html__( 'Post Thumbnail', 'travelore' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'travelore_excerpt_options', array(
		'panel'     => 'travelore_theme_options',
		'title'     => esc_html__( 'Excerpt Options', 'travelore' ),
	) );

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_excerpt_length',
			'default'           => '15',
			'sanitize_callback' => 'absint',
			'description' => esc_html__( 'Excerpt length. Default is 15 words', 'travelore' ),
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'travelore' ),
			'section'  => 'travelore_excerpt_options',
			'type'     => 'number',
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_excerpt_more_text',
			'default'           => esc_html__( 'Continue Reading', 'travelore' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'travelore' ),
			'section'           => 'travelore_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'travelore_search_options', array(
		'panel'     => 'travelore_theme_options',
		'title'     => esc_html__( 'Search Options', 'travelore' ),
	) );

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_search_text',
			'default'           => esc_html__( 'Search', 'travelore' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Search Text', 'travelore' ),
			'section'           => 'travelore_search_options',
			'type'              => 'text',
		)
	);
	
	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'travelore_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'travelore' ),
		'panel'       => 'travelore_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'travelore' ),
	) );

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_front_page_category',
			'sanitize_callback' => 'travelore_sanitize_category_list',
			'custom_control'    => 'Travelore_Multi_Categories_Control',
			'label'             => esc_html__( 'Categories', 'travelore' ),
			'section'           => 'travelore_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'Blog', 'travelore' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'travelore' ),
			'section'           => 'travelore_homepage_options',
		)
	);

	// Menu Options
	$wp_customize->add_section( 'travelore_menu_options', array(
		'description' => esc_html__( 'Extra Menu Options specific to this theme', 'travelore' ),
		'title'       => esc_html__( 'Menu Options', 'travelore' ),
		'panel'       => 'travelore_theme_options',
	) );
	// Menu Options End.
	
	$wp_customize->add_section( 'travelore_pagination_options', array(
		'panel' => 'travelore_theme_options',
		'title' => esc_html__( 'Pagination Options', 'travelore' ),
	) );

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_pagination_type',
			'default'           => 'numeric',
			'sanitize_callback' => 'travelore_sanitize_select',
			'choices'           => travelore_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'travelore' ),
			'section'           => 'travelore_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'travelore_scrollup', array(
		'panel'    => 'travelore_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'travelore' ),
	) );

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_disable_scrollup',
			'sanitize_callback' => 'travelore_sanitize_checkbox',
			'label'             => esc_html__( 'Scroll Up', 'travelore' ),
			'section'           => 'travelore_scrollup',
			'custom_control'	=> 'Travelore_Toggle_Control',
		)
	);

}
add_action( 'customize_register', 'travelore_theme_options' );


