<?php
/**
 * Display Header Media
 *
 * @package Travelore
 */

$header_image = travelore_featured_overall_image();

if ( '' == $header_image && ! travelore_has_header_media_text() ) {
	// Bail if all header media are disabled.
	return;
}
?>
<div class="header-media section">
	<div class="wrapper">
		<?php
		if ( is_header_video_active() && has_header_video() ) {
			the_custom_header_markup();
		} elseif ( $header_image ) {
			if ( is_singular() ) {
				echo '<div class="post-thumbnail singular-header-image">';
			} else {
				echo '<div class="post-thumbnail archive-header-image">';
			}
			
			echo '<img src="' . esc_url( $header_image ) . '"/></div><!-- .post-thumbnail -->';
		}
		?>

		<?php travelore_header_media_text(); ?>
	</div><!-- .wrapper -->
</div><!-- .header-media -->
