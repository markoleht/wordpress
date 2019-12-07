<?php
/**
 * The template for displaying featured content
 *
 * @package Travelore
 */
?>

<?php
$enable_content = get_theme_mod( 'travelore_news_ticker_option', 'disabled' );

if ( ! travelore_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$label = get_theme_mod( 'travelore_news_ticker_label', esc_html__( 'Breaking News', 'travelore' ) );
?>

<div id="news-ticker" class="section page">
	<div class="wrapper">
		<?php if ( $label ) : ?>
			<div class="section-heading-wrapper featured-section-headline">
				<h2 class="section-title news-ticker-label"><?php echo esc_html( $label ); ?></h2>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper news-ticker-content-wrapper">
			<div class="news-ticker-slider owl-carousel">

				<?php
					get_template_part( 'template-parts/news-ticker/post-types', 'news-ticker' );				
				?>
			</div><!-- .news-ticker-slider -->
		</div><!-- .featured-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #news-ticker -->
