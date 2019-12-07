<?php
/**
 * The template used for displaying service
 *
 * @package Travelore
 */
$quantity     = get_theme_mod( 'travelore_service_number', 4 );
$post_list    = array();// list of valid post/page ids
$type         = 'ect-service';

$args = array(
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

//Get valid number of posts

$args['post_type'] = $type;

for ( $i = 1; $i <= $quantity; $i++ ) {
	$post_id = '';

	$post_id = get_theme_mod( 'travelore_service_cpt_' . $i );
	

	if ( $post_id && '' !== $post_id ) {
		// Polylang Support.
		if ( class_exists( 'Polylang' ) ) {
			$post_id = pll_get_post( $post_id, pll_current_language() );
		}

		$post_list = array_merge( $post_list, array( $post_id ) );

	}
}

$args['post__in'] = $post_list;
$args['orderby'] = 'post__in';

$args['posts_per_page'] = $quantity;

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :
	$loop->the_post();

	?>
	<article id="service-post-<?php echo esc_html( $loop->current_post + 1 ) ?>" class="status-publish has-post-thumbnail hentry">
		<div class="hentry-inner">	
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php

				// Default value if there is no first image
				$image = '<img class="wp-post-image" src="' . trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb-100x100.jpg" >';

				if ( $media_id = get_post_meta( $post->ID, 'ect-alt-featured-image', true ) ) {
					$title_attribute = the_title_attribute( 'echo=0' );
					// Get alternate thumbnail from CPT meta.
					echo wp_get_attachment_image( $media_id, 'travelore-testimonial', false,  array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				} elseif ( has_post_thumbnail() ) {
					the_post_thumbnail( 'travelore-testimonial' );
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
			</a>
			
			<div class="entry-container">
				<header class="entry-header">
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>
					</h2>
				<?php		
					$excerpt = get_the_excerpt();
					echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
				?>
			</div><!-- .entry-container -->
		</div><!-- .hentry-inner -->
	</article><!-- .featured-post-<?php echo esc_html( $loop->current_post + 1 ); ?> -->
<?php
endwhile;

wp_reset_postdata();
