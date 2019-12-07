<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Base_Theme
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
<?php 
get_sidebar();
get_footer(); 
