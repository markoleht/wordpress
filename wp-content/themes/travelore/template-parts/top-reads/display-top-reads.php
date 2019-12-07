<?php
/**
 * The template for displaying top reads items
 *
 * @package Travelore
 */
?>

<?php
$enable = get_theme_mod( 'travelore_top_reads_option', 'disabled' );

if ( ! travelore_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}

$headline = get_theme_mod( 'travelore_top_reads_title', esc_html__( 'Top Reads', 'travelore' ) );

$classes[] = 'section travelore-top-reads-section travelore-section';

if ( ! $headline ) {
	$classes[] = 'no-headline';
}

?>
<div id="travelore-top-reads-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $headline ) : ?>
		<div class="section-heading-wrapper ">
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo wp_kses_post( $headline ); ?></h2>
				</div><!-- .section-title-wrapper -->
		</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper travelore-top-reads-content-wrapper layout-two">
			<?php
				get_template_part( 'template-parts/top-reads/post-types', 'top-reads' );
			?>
		</div><!-- .section-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- .top-reads-content-section -->
