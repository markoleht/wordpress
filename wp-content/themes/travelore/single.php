<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Travelore
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php 
		get_template_part( 'template-parts/featured-two-columns/display-featured-two-columns' );
		get_template_part( 'template-parts/top-reads/display-top-reads' );
		get_template_part( 'template-parts/main-content/display-main-content' );
		?>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
