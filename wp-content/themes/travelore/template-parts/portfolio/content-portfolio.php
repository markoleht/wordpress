<?php
/**
 * The template used for displaying projects on index view
 *
 * @package Travelore
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<div class="portfolio-thumbnail post-thumbnail">
			<a class="post-thumbnail" href="<?php the_permalink(); ?>">
				<?php
				// Output the featured image.
				if ( has_post_thumbnail() ) {
					$thumbnail = 'travelore-featured';

					the_post_thumbnail( $thumbnail );
				} else {
						echo '<a href=' . esc_url( get_permalink() ) .'><img src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-640x480.jpg"/></a>';
				}
				?>
			</a>
		</div><!-- .portfolio-thumbnail -->

		<div class="entry-container">
			<header class="entry-header portfolio-entry-header">
				<?php echo travelore_entry_category_date(); ?>
			</header>
		</div><!-- .entry-container -->

	</div><!-- .hentry-inner -->
	<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

</article>
