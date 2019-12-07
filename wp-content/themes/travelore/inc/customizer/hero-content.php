<?php
/**
 * Hero Content Options
 *
 * @package Travelore
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function travelore_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'travelore_hero_content_options', array(
			'title' => esc_html__( 'Hero Content Options', 'travelore' ),
			'panel' => 'travelore_theme_options',
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'travelore_sanitize_select',
			'choices'           => travelore_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'travelore' ),
			'section'           => 'travelore_hero_content_options',
			'type'              => 'select',
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'travelore_sanitize_post',
			'active_callback'   => 'travelore_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'travelore' ),
			'section'           => 'travelore_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);
}
add_action( 'customize_register', 'travelore_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'travelore_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Travelore 1.0
	*/
	function travelore_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'travelore_hero_content_visibility' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return travelore_check_section( $enable );
	}
endif;
