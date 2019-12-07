<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Travelore
 */
if ( ! function_exists( 'travelore_header_style' ) ) :
	/**
	 * Styles the header text displayed on the site.
	 *
	 * Create your own travelore_header_style() function to override in a child theme.
	 *
	 * @since Travelore 1.0
	 *
	 * @see travelore_custom_header_and_background().
	 */
	function travelore_header_style() {
	// If the header text has been hidden.
	?>
	<?php
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		$header_text_color = get_header_textcolor();
		$default_color     = trim( $color_scheme[1] , '#' );

		if ( $default_color !== $header_text_color ) :
		?>
		<style type="text/css" id="travelore-header-css">
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
		</style>
	<?php
		endif;
	} else {
		?>
		<style type="text/css" id="travelore-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}

		.site-identity {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
		</style>
	<?php
	}
}
endif; // travelore_header_style


if ( ! function_exists( 'travelore_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own travelore_featured_image(), and that function will be used instead.
	 *
	 * @since Catch Foodmania Pro 1.0
	 */
	function travelore_featured_image() {
		$thumbnail = is_front_page() ? 'catch-foodmania-header-inner' : 'catch-foodmania-slider';

		if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
			$jetpack_options = get_theme_mod( 'jetpack_testimonials' );

			if ( isset( $jetpack_options['featured-image'] ) && '' !== $jetpack_options['featured-image'] ) {
				$image = wp_get_attachment_image_src( (int) $jetpack_options['featured-image'], $thumbnail );
				return $image[0];
			} else {
				return false;
			}
		} elseif ( is_post_type_archive( 'jetpack-portfolio' ) || is_post_type_archive( 'featured-content' ) || is_post_type_archive( 'ect-service' ) ) { 
			$option = '';

			if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
				$option = 'jetpack_portfolio_featured_image';
			} elseif ( is_post_type_archive( 'featured-content' ) ) {
				$option = 'featured_content_featured_image';
			} elseif ( is_post_type_archive( 'ect-service' ) ) {
				$option = 'ect_service_featured_image';
			}

			$featured_image = get_option( $option );

			if ( '' !== $featured_image ) {
				$image = wp_get_attachment_image_src( (int) $featured_image, $thumbnail );
				return $image[0];
			} else {
				return get_header_image();
			}
		} else {
			return get_header_image();
		}
	} // travelore_featured_image
endif;

if ( ! function_exists( 'travelore_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own travelore_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * @since Catch Foodmania Pro 1.0
	 */
	function travelore_featured_page_post_image() {
		$thumbnail = is_front_page() ? 'catch-foodmania-header-inner' : 'catch-foodmania-slider';

		return get_the_post_thumbnail_url( get_the_id(), $thumbnail );
	} // travelore_featured_page_post_image
endif;

if ( ! function_exists( 'travelore_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own travelore_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Catch Foodmania Pro 1.0
	 */
	function travelore_featured_overall_image() {
		global $post, $wp_query;
		$enable = get_theme_mod( 'travelore_header_media_option', 'disable' );

		// Get Page ID outside Loop
		$page_id = absint( $wp_query->get_queried_object_id() );

		$page_for_posts = absint( get_option( 'page_for_posts' ) );

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_singular() ) {
			//Individual Page/Post Image Setting
			$individual_featured_image = get_post_meta( $post->ID, 'catch-foodmania-header-image', true );

			if ( 'disable' === $individual_featured_image || ( 'default' === $individual_featured_image && 'disable' === $enable ) ) {
				return;
			} elseif ( 'enable' == $individual_featured_image && 'disable' === $enable ) {
				return travelore_featured_page_post_image();
			}
		}

		// Check Homepage
		if ( 'homepage' === $enable ) {
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				return travelore_featured_image();
			}
		} elseif ( 'entire-site' === $enable ) {
			// Check Entire Site
			return travelore_featured_image();
		}
		return false;
	} // travelore_featured_overall_image
endif;

if ( ! function_exists( 'travelore_header_media_text' ) ):
	/**
	 * Display Header Media Text
	 *
	 * @since Catch Foodmania Pro 1.0
	 */
	function travelore_header_media_text() {
		if ( ! travelore_has_header_media_text() ) {
			// Bail if there is no header media text.
			return;
		}
		?>
		<div class="custom-header-content sections header-media-section">
			<h2 class="entry-title">
				<?php travelore_header_title(); ?>
			</h2>

			<?php travelore_header_text(); ?>
			</div>
		<?php
	} // travelore_header_media_text.
endif;

if ( ! function_exists( 'travelore_has_header_media_text' ) ):
	/**
	 * Return Header Media Text fro front page
	 *
	 * @since Foodie World 0.1
	 */
	function travelore_has_header_media_text() {
		$header_media_title = get_theme_mod( 'travelore_header_media_title' );

		$header_media_text = get_theme_mod( 'travelore_header_media_text' );
		$header_media_url      = get_theme_mod( 'travelore_header_media_url' );
		$header_media_url_text = get_theme_mod( 'travelore_header_media_url_text' );

		$header_image = travelore_featured_overall_image();

		if ( ( is_front_page() && ! $header_media_title && ! $header_media_text && ! $header_media_url && ! $header_media_url_text ) || ( ( is_singular() || is_archive() || is_search() || is_404() ) && ! $header_image ) ) {
			// Header Media text Disabled
			return false;
		}

		return true;
	} // travelore_has_header_media_text.
endif;

if ( ! function_exists( 'travelore_header_title' ) ) :
	/**
	 * Display Header Media Title
	 */
	function travelore_header_title() {
		if ( is_front_page() ) {
			echo wp_kses_post( get_theme_mod( 'travelore_header_media_title' ) );
		} elseif ( is_singular() ) {
			the_title();
		} elseif ( is_404() ) {
			esc_html_e( 'Oops! That page can&rsquo;t be found.', 'travelore' );
		} elseif ( is_search() ) {
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'travelore' ), '<span>' . get_search_query() . '</span>' );
		} else {
			the_archive_title();
		}
	}
endif;

if ( ! function_exists( 'travelore_header_text' ) ) :
	/**
	 * Display Header Media Text
	 */
	function travelore_header_text() {
		if ( is_front_page() ) {
			$content = get_theme_mod( 'travelore_header_media_text' );

			if ( $header_media_url = get_theme_mod( 'travelore_header_media_url', '#' ) ) {
				$target = get_theme_mod( 'travelore_header_url_target' ) ? '_blank' : '_self';

				$content .= '<a class="more-link"  href="' . esc_url( get_theme_mod( 'travelore_header_media_url', '#' ) ) . '" target="' . esc_attr( $target ) . '"  > <span class="more-button">' . esc_html( get_theme_mod( 'travelore_header_media_url_text', esc_html__( 'Continue reading', 'travelore' ) ) ) . '</span></a>';
			}

			echo '<p class="site-header-text">' . wp_kses_post( $content ) . '</p>';
		} elseif ( is_404() ) {
			echo '<p class="site-header-text">';
			esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'travelore' );
			echo '</p>';
		} elseif( is_search() ) {
			// No Header Media Text.
		} else {
			the_archive_description( '<p class="site-header-text">', '</p>' );
		}
	}
endif;
