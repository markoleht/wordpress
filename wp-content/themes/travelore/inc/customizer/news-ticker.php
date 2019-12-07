<?php
/**
 * Add News Ticker Settings in Customizer
 *
 * @package Travelore
 */

/**
 * Add news_ticker options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function travelore_news_ticker_options( $wp_customize ) {
	$wp_customize->add_section( 'travelore_news_ticker', array(
            'panel' => 'travelore_theme_options',
            'title' => esc_html__( 'News Ticker', 'travelore' ),
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_news_ticker_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'travelore_sanitize_select',
			'choices'           => travelore_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'travelore' ),
			'section'           => 'travelore_news_ticker',
			'type'              => 'select',
		) 
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_news_ticker_label',
			'default'           => esc_html__( 'Breaking News', 'travelore' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'travelore_is_news_ticker_active',
			'label'             => esc_html__( 'Label', 'travelore' ),
			'section'           => 'travelore_news_ticker',
			'type'              => 'text',
		)
	);

	travelore_register_option( $wp_customize, array(
			'name'              => 'travelore_news_ticker_number',
			'default'           => 4,
			'sanitize_callback' => 'travelore_sanitize_number_range',
			'active_callback'   => 'travelore_is_news_ticker_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of items is changed', 'travelore' ),
			'input_attrs'       => array(
				'style'       => 'width: 100px;',
				'min'         => 0,
			),
			'label'             => esc_html__( 'No of items', 'travelore' ),
			'section'           => 'travelore_news_ticker',
			'type'              => 'number',
			'transport'         => 'postMessage'
		)
	);

	$number = get_theme_mod( 'travelore_news_ticker_number', 4 );

	for ( $i = 1; $i <= $number; $i++ ) {

		//Page News Ticker
		travelore_register_option( $wp_customize, array(
				'name'              => 'travelore_news_ticker_page_' . $i,
				'sanitize_callback' => 'travelore_sanitize_post',
				'active_callback'   => 'travelore_is_news_ticker_active',
				'label'             => esc_html__( 'Page', 'travelore' ) . ' ' . $i ,
				'section'           => 'travelore_news_ticker',
				'type'              => 'dropdown-pages',
			)
		);
	}
	// News Ticker Setting End
}
add_action( 'customize_register', 'travelore_news_ticker_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'travelore_is_news_ticker_active' ) ) :
    /**
    * Return true if news ticker is active
    *
    * @since Travelore 1.0
    */
    function travelore_is_news_ticker_active( $control ) {
        $enable = $control->manager->get_setting( 'travelore_news_ticker_option' )->value();

        //return true only if previwed page on customizer matches the type of option selected
        return travelore_check_section( $enable );
    }
endif;

