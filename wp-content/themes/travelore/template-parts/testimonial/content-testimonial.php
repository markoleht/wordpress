<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Travelore
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<div class="testimonial-thumbnail post-thumbnail">
			<?php
			// Default value if there is no first image
			$image = '<img class="wp-post-image" src="' . trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb-100x100.jpg" >';

			if ( $media_id = get_post_meta( $post->ID, 'ect-alt-featured-image', true ) ) {
				$title_attribute = the_title_attribute( 'echo=0' ); 
				// Get alternate thumbnail from CPT meta.
				?> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php echo wp_get_attachment_image( $media_id, 'travelore-testimonial', false,  array( 'title' => $title_attribute, 'alt' => $title_attribute ) ); ?> </a> <?php
			} elseif ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
      				 <?php the_post_thumbnail(); ?>
   				</a> <?php
			} else {
				// Get the first image in page, returns false if there is no image.
				$first_image = travelore_get_first_image( get_the_ID(), 'travelore-testimonial', '' );

				// Set value of image as first image if there is an image present in the page.
				if ( $first_image ) {
					$image = $first_image;
				}

				echo $image;
			}
			?>
		</div>

		<div class="entry-container">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>

			<?php $position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); ?>

			<?php if ( $position ) : ?>
					<header class="entry-header">
						<?php 
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
						?>
						<?php if ( $position ) : ?>
							<p class="entry-meta"><span class="position">
								<?php echo esc_html( $position ); ?></span>
							</p>
						<?php endif; ?>
					</header>
			<?php endif;?>
		</div><!-- .entry-container -->	
	</div><!-- .hentry-inner -->
</article>
