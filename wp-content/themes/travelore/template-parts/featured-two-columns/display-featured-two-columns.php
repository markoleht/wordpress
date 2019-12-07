<?php
/**
 * The template for displaying featured-two-columns items
 *
 * @package Travelore
 */
?>

<?php
$enable = get_theme_mod( 'travelore_featured_two_columns_option', 'disabled' );

if ( ! travelore_check_section( $enable ) ) {
	// Bail if featured-two-columns section is disabled.
	return;
}

$headline = get_theme_mod( 'travelore_featured_two_columns_headline', esc_html__( 'Featured Two Columns', 'travelore' ) );
$subheadline = get_theme_mod( 'travelore_featured_two_columns_subheadline' );
?>
<div id="travelore-featured-two-columns-section" class="travelore-featured-two-columns-section section travelore-section">
	<div class="wrapper">
		<?php if ( $headline || $subheadline ) : ?>
			<div class="section-heading-wrapper">
			<?php if ( $headline ) : ?>
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo wp_kses_post( $headline ); ?></h2>
				</div><!-- .section-title-wrapper -->
			<?php endif; ?>

			<?php if ( $subheadline ) : ?>
				<div class="taxonomy-description-wrapper section-subtitle">
					<?php
	                $subheadline = apply_filters( 'the_content', $subheadline );
	                echo str_replace( ']]>', ']]&gt;', $subheadline );
	                ?>
				</div><!-- .taxonomy-description-wrapper -->
			<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper travelore-featured-two-columns-content-wrapper layout-two">
			<?php
				get_template_part( 'template-parts/featured-two-columns/post-types', 'featured-two-columns' );
			?>
		</div><!-- .featured-two-columns-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #featured-two-columns-content-section -->
