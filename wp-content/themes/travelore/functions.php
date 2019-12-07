<?php
/**
 * Travelore functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package Travelore
 */

/**
 * Travelore only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require trailingslashit( get_template_directory() ) . 'inc/back-compat.php';
}

if ( ! function_exists( 'travelore_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own travelore_setup() function to override in a child theme.
 *
 * @since Travelore 1.0
 */
function travelore_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/travelore
	 * If you're building a theme based on Travelore, use a find and replace
	 * to change 'travelore' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'travelore', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Travelore 1.0
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Used in excerpt image Top 16:9 Ratio
	set_post_thumbnail_size( 1230, 692, true );

	// Used ins Featured Slider 1 col, Promotion Headline, 21:9 Ratio
	add_image_size( 'travelore-slider', 1920, 822, true );

	// Used ins Featured Slider 3 col, Promotion Headline, 1:1 Ratio
	add_image_size( 'travelore-slider-three-cols', 640, 640, true );

	// Used in Hero Content, 4:3 ratio
	add_image_size( 'travelore-hero-content', 730, 547, true );

	// Used in Team Section, Portfolio Section, Featured Content, Scrolling Section, Weekly Top Reads, Featured Two Columns Except First Image 4:3 ratio
	add_image_size( 'travelore-featured', 640, 480, true );
	
	// Used in testimonial, Services,  1:1 ratio
	add_image_size( 'travelore-testimonial', 100, 100, true );

	// Used in Highlight Section First Image, 3:4 Ratio
	add_image_size( 'travelore-highlight-first', 640, 853, true );

	// Used in Highlight Section Second Image, 4:3 Ratio
	add_image_size( 'travelore-highlight-second', 640, 480, true );

	// Used in Highlight Section Third Image, 3:2 Ratio
	add_image_size( 'travelore-highlight-third', 640, 426, true );

	// Used in Featured Two Columns First Image, 4:3 Ratio
	add_image_size( 'travelore-featured-two-columns-first', 820, 615, true );

	// Used in excerpt image left and right, 1:1 Ratio
	add_image_size( 'travelore-excerpt-image-left-right', 210, 144, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'menu-1'              => esc_html__( 'Primary', 'travelore' ),
		'social-header-right' => esc_html__( 'Social Header Left', 'travelore' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css', travelore_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add custom editor font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => esc_html__( 'Small', 'travelore' ),
				'shortName' => esc_html__( 'S', 'travelore' ),
				'size'      => 13,
				'slug'      => 'small',
			),
			array(
				'name'      => esc_html__( 'Normal', 'travelore' ),
				'shortName' => esc_html__( 'M', 'travelore' ),
				'size'      => 16,
				'slug'      => 'normal',
			),
			array(
				'name'      => esc_html__( 'Large', 'travelore' ),
				'shortName' => esc_html__( 'L', 'travelore' ),
				'size'      => 28,
				'slug'      => 'large',
			),
			array(
				'name'      => esc_html__( 'Huge', 'travelore' ),
				'shortName' => esc_html__( 'XL', 'travelore' ),
				'size'      => 38,
				'slug'      => 'huge',
			),
		)
	);

	// Add support for custom color scheme.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => esc_html__( 'White', 'travelore' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html__( 'Black', 'travelore' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
		array(
			'name'  => esc_html__( 'Dark Gray', 'travelore' ),
			'slug'  => 'dark-gray',
			'color' => '#333333',
		),
		array(
			'name'  => esc_html__( 'Medium Gray', 'travelore' ),
			'slug'  => 'medium-gray',
			'color' => '#e5e5e5',
		),
		array(
			'name'  => esc_html__( 'Light Gray', 'travelore' ),
			'slug'  => 'light-gray',
			'color' => '#f7f7f7',
		),
		array(
			'name'  => esc_html__( 'Red', 'travelore' ),
			'slug'  => 'red',
			'color' => '#ff3c41',
		),
	) );

	// Support Alternate image for services, testimonials when using Essential Content Types Pro.
	if ( class_exists( 'Essential_Content_Types_Pro' ) ) {
		add_theme_support( 'ect-alt-featured-image-jetpack-testimonial' );
	}

	/**
	 * Add Support for Sticky Menu.
	 */
	add_theme_support( 'catch-sticky-menu', apply_filters( 'travelore_sticky_menu_args', array(
		'sticky_desktop_menu_selector' => '#header-navigation-area',
		'sticky_mobile_menu_selector'  => '#header-navigation-area',
	) ) );

	/**
	 * Adds support for Catch Breadcrumb.
	 */
	add_theme_support( 'catch-breadcumb', array(
		'content_selector' => '.header-media-section .entry-title',
	) );

	add_theme_support( 'infinite-scroll', array(
		'container' => '#infinite-post-wrap',
	) );
}
endif; // travelore_setup
add_action( 'after_setup_theme', 'travelore_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Travelore 1.0
 */
function travelore_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'travelore_content_width', 820 );
}
add_action( 'after_setup_theme', 'travelore_content_width', 0 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
 *
 * @global int $content_width
 */
function travelore_template_redirect() {
	$layout = travelore_get_theme_layout();

	if ( 'no-sidebar-full-width' == $layout ) {
		$GLOBALS['content_width'] = 1230;
	}
}
add_action( 'template_redirect', 'travelore_template_redirect' );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Travelore 1.0
 */
function travelore_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'travelore' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'travelore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrap"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'travelore' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'travelore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrap"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'travelore' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'travelore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrap"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'travelore' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'travelore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrap"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	//Instagram Widget
	if ( class_exists( 'Catch_Instagram_Feed_Gallery_Widget' ) ||  class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Instagram', 'travelore' ),
			'id'            => 'sidebar-instagram',
			'description'   => esc_html__( 'Appears above footer. This sidebar is only for Widget from plugin Catch Instagram Feed Gallery Widget and Catch Instagram Feed Gallery Widget Pro', 'travelore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div clas="section-heading-wrapper"><h2 class="section-title">',
			'after_title'   => '</h2></div>',
		) );
	}
}
add_action( 'widgets_init', 'travelore_widgets_init' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Travelore 1.0
 */
function travelore_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-5' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="widget-area footer-widget-area ' . $class . '"'; // WPCS: XSS OK.
}

if ( ! function_exists( 'travelore_fonts_url' ) ) :
/**
 * Register Google fonts for Travelore
 *
 * Create your own travelore_fonts_url() function to override in a child theme.
 *
 * @since Travelore 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function travelore_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Montserrat, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$merriweather_sans = _x( 'on', 'Merriweather Sans: on or off', 'travelore' );

	/* Translators: If there are characters in your language that are not
	* supported by Montserrat, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$yesteryear = _x( 'on', 'Yesteryear: on or off', 'travelore' );

	/* Translators: If there are characters in your language that are not
	* supported by Playfair Display, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$merriweather = _x( 'on', 'Merriweather: on or off', 'travelore' );
	if ( 'off' !== $merriweather_sans || 'off' !== $yesteryear || 'off' !== $merriweather) {
		$font_families = array();

		if ( 'off' !== $merriweather_sans ) {
		$font_families[] = 'Merriweather Sans:300,400,500,500italic,600,700,900';
		}

		if ( 'off' !== $yesteryear ) {
		$font_families[] = 'Yesteryear:300,400,500,500italic,600,700,900';
		}

		if ( 'off' !== $merriweather ) {
		$font_families[] = 'Merriweather:300,400,500,500italic,600,700,900';
		}
		
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Travelore 1.0
 */
function travelore_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'travelore_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Travelore 1.0
 */
function travelore_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'travelore-fonts', travelore_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'travelore-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'travelore-block-style', get_theme_file_uri( 'assets/css/blocks.css' ), array( 'travelore-style' ), '1.0' );

	// Load the html5 shiv.
	wp_enqueue_script( 'travelore-html5',  get_theme_file_uri( 'assets/js/html5.min.js' ), array(), '3.7.3' );
	wp_script_add_data( 'travelore-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'travelore-skip-link-focus-fix',  get_theme_file_uri( 'assets/js/skip-link-focus-fix.min.js' ), array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'travelore-keyboard-image-navigation',  get_theme_file_uri( 'assets/js/keyboard-image-navigation.min.js' ), array( 'jquery' ), '20160816' );
	}

	wp_register_script( 'jquery-match-height',  get_theme_file_uri( 'assets/js/jquery.matchHeight.min.js' ), array( 'jquery' ), '20151215', true );

	$deps = array( 'jquery', 'jquery-match-height' );

	//Slider Scripts
	$enable_slider      = get_theme_mod( 'travelore_slider_option', 'disabled' );
	$enable_testimonial = get_theme_mod( 'travelore_testimonial_option', 'homepage' );
	$enable_news_ticker = get_theme_mod( 'travelore_news_ticker_option', 'disabled' );

	$nticker_trans_in           = 'flipInX';
	$nticker_trans_out          = 'slideOutDown';
	$testimonial_trans_in       = get_theme_mod( 'travelore_testimonial_transition_in', 'default' );
	$testimonial_trans_out      = get_theme_mod( 'travelore_testimonial_transition_out', 'default' );

	if ( travelore_check_section( $enable_slider ) || $enable_testimonial || travelore_check_section( $enable_news_ticker ) ) {
		// Enqueue owl carousel css. Must load CSS before JS.
		wp_enqueue_style( 'owl-carousel-core', get_theme_file_uri( 'assets/css/owl-carousel/owl.carousel.min.css' ), null, '2.3.4' );
		wp_enqueue_style( 'owl-carousel-default', get_theme_file_uri( 'assets/css/owl-carousel/owl.theme.default.min.css' ), null, '2.3.4' );

		if ( ( travelore_check_section( $enable_news_ticker ) && ( 'default' !== $nticker_trans_in || 'default' !== $nticker_trans_out ) )
		|| ( $enable_testimonial ) ) {
			wp_enqueue_style( 'animate', get_theme_file_uri( 'assets/css/animate.css' ), null, '3.7.0' );
		}

		// Enqueue script
		wp_enqueue_script( 'owl-carousel', get_theme_file_uri( 'assets/js/owl.carousel.min.js' ), array( 'jquery' ), '2.3.4', true );

		$deps[] = 'owl-carousel';

	}

	wp_enqueue_script( 'travelore-script',  get_theme_file_uri( 'assets/js/functions.min.js' ), $deps, '20160816', true );

	wp_localize_script( 'travelore-script', 'traveloreOptions', array(
		'screenReaderText' => array(
			'expand'   => esc_html__( 'expand child menu', 'travelore' ),
			'collapse' => esc_html__( 'collapse child menu', 'travelore' ),
			'icon'     => travelore_get_svg( array(
					'icon'     => 'angle-down',
					'fallback' => true,
				)
			),
		),
		'testimonialOptions' => array(
			'transitionIn'      => esc_js( $testimonial_trans_in ),
			'transitionOut'     => esc_js( $testimonial_trans_out ),
			'nav'               => esc_js( get_theme_mod( 'travelore_testimonial_nav' ) ),
			'autoplay'          => esc_js( get_theme_mod( 'travelore_testimonial_autoplay' ) ),
			'loop'              => esc_js( get_theme_mod( 'travelore_testimonial_loop' ) ),
			'transitionTimeout' => esc_js( get_theme_mod( 'travelore_testimonial_transition_timeout', 4 ) ),
			'layout'            => esc_js( get_theme_mod( 'travelore_testimonial_layout', 1 ) ),
			'dots'              => esc_js( get_theme_mod( 'travelore_testimonial_dots' ) ),
		),
		'iconNavPrev'     => travelore_get_svg( array(
				'icon'     => 'angle-left',
				'fallback' => true,
			)
		),
		'iconNavNext'     => travelore_get_svg( array(
				'icon'     => 'angle-right',
				'fallback' => true,
			)
		),
		'rtl' => is_rtl(),
	) );
}
add_action( 'wp_enqueue_scripts', 'travelore_scripts' );

/**
 * Enqueues editor styles for Gutenberg.
 *
 * @since Travelore 1.0
 */
function travelore_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'travelore-block-editor-style',  get_theme_file_uri( 'assets/css/editor-blocks.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'travelore-fonts', travelore_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'travelore_block_editor_styles' );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Travelore 1.0
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function travelore_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'travelore_widget_tag_cloud_args' );

/**
 * Load TGMPA
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function travelore_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// Catch Web Tools.
		array(
			'name' => 'Catch Web Tools', // Plugin Name, translation not required.
			'slug' => 'catch-web-tools',
		),
		// Catch IDs
		array(
			'name' => 'Catch IDs', // Plugin Name, translation not required.
			'slug' => 'catch-ids',
		),
		// To Top.
		array(
			'name' => 'To top', // Plugin Name, translation not required.
			'slug' => 'to-top',
		),
		// Catch Gallery.
		array(
			'name' => 'Catch Gallery', // Plugin Name, translation not required.
			'slug' => 'catch-gallery',
		),
	);

	if ( ! class_exists( 'Catch_Infinite_Scroll_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Infinite Scroll', // Plugin Name, translation not required.
			'slug' => 'catch-infinite-scroll',
		);
	}

	if ( ! class_exists( 'Essential_Content_Types_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Content Types', // Plugin Name, translation not required.
			'slug' => 'essential-content-types',
		);
	}

	if ( ! class_exists( 'Essential_Widgets_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Widgets', // Plugin Name, translation not required.
			'slug' => 'essential-widgets',
		);
	}

	if ( ! class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Instagram Feed Gallery & Widget', // Plugin Name, translation not required.
			'slug' => 'catch-instagram-feed-gallery-widget',
		);
	}

	if ( ! class_exists( 'Catch_Breadcrumb_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Breadcrumb', // Plugin Name, translation not required.
			'slug' => 'catch-breadcrumb',
		);
	}

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'travelore',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'travelore_register_required_plugins' );

/**
 * Checks if there are options already present from free version and adds it to the Pro theme options
 *
 * @since Travelore 1.0
 * @hook after_theme_switch
 */
function travelore_setup_options( $old_theme_name ) {
	if ( $old_theme_name ) {
		$old_theme_slug = sanitize_title( $old_theme_name );
		$free_version_slug = array(
			'travelore',
		);

		$pro_version_slug  = 'travelore';

		$free_options = get_option( 'theme_mods_' . $old_theme_slug );

		// Perform action only if theme_mods_audioman free version exists.
		if ( in_array( $old_theme_slug, $free_version_slug ) && $free_options && '1' !== get_theme_mod( 'free_pro_migration' ) ) {
			$new_options = wp_parse_args( get_theme_mods(), $free_options );

			if ( update_option( 'theme_mods_' . $pro_version_slug, $free_options ) ) {
				// Set Migration Parameter to true so that this script does not run multiple times.
				set_theme_mod( 'free_pro_migration', '1' );
			}
		}
	}
}
add_action( 'after_switch_theme', 'travelore_setup_options' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( 'inc/template-tags.php' );

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Include Header Background Color Options
 */
require get_parent_theme_file_path( 'inc/header-background-color.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( 'inc/icon-functions.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_parent_theme_file_path( 'inc/extras.php' );

/**
 * Add theme admin page.
 */
if ( is_admin() ) {
	require get_parent_theme_file_path( 'inc/about.php' );
}

/**
 * Custom functions are used by sections sorter.
 */
require get_parent_theme_file_path( 'inc/sections-sorter.php' );

/**
 * Add functions for header media.
 */
require get_parent_theme_file_path( 'inc/custom-header.php' );

/**
 * Include Widgets
 */
require get_parent_theme_file_path( '/inc/widgets/social-icons.php' );
