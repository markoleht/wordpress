<?php
/**
 * The template part for displaying single posts
 *
 * @package Travelore
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
		if ( ! travelore_has_header_media_text() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} 
		?>
		<?php if ( 'post' === get_post_type() ) :
			travelore_entry_header();
		endif; ?>
	</header><!-- .entry-header -->

	<?php
	$single_layout = get_theme_mod( 'travelore_single_layout', 'disabled' );

	if ( 'disabled' !== $single_layout ) {
		travelore_post_thumbnail( $single_layout );
	}
	?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'travelore' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'travelore' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php travelore_entry_footer(); ?>

</article><!-- #post-## -->
