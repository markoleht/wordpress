<?php
/**
 * The template used for displaying slider
 *
 * @package Travelore
 */

$quantity     = get_theme_mod( 'travelore_slider_number', 4 );
$no_of_post   = 0; // for number of posts
$post_list    = array(); // list of valid post/page ids
$type         = 'page';

$args = array(
	'post_type'           => 'any',
	'ignore_sticky_posts' => 1, // ignore sticky posts
);

//Get valid number of posts

for ( $i = 1; $i <= $quantity; $i++ ) {
	$post_id = '';

	$post_id = get_theme_mod( 'travelore_slider_page_' . $i );
	

	if ( $post_id && '' !== $post_id ) {
		$post_list = array_merge( $post_list, array( $post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;
$args['orderby'] = 'post__in';


if ( ! $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :
	$loop->the_post();

	$classes = 'post post-' . get_the_ID() . ' hentry slides';

	// Default value if there is no featurd image or first image.
	$image_url = trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb-1920x822.jpg';
	$thumbnail = 'travelore-slider';

	if ( has_post_thumbnail() ) {
		$image_url = get_the_post_thumbnail_url( get_the_ID(), $thumbnail );
	} else {
		// Get the first image in page, returns false if there is no image.
		$first_image_url = travelore_get_first_image( get_the_ID(), $thumbnail, '', true );

		// Set value of image as first image if there is an image present in the page.
		if ( $first_image_url ) {
			$image_url = $first_image_url;
		}
	}
	?>
	<article class="<?php echo esc_attr( $classes ); ?>">
		<div class="hentry-inner">
			<div class="slider-image-wrapper">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<img src="<?php echo esc_url( $image_url ); ?>" class="wp-post-image" alt="<?php the_title_attribute(); ?>">
					</a>
			</div><!-- .slider-image-wrapper -->

			<div class="slider-content-wrapper">
				<div class="entry-container">
					<header class="entry-header">						
						<h2 class="entry-title">
							<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
								<?php the_title( '<span>','</span>' ); ?>
							</a>
						</h2>
					</header>
				</div><!-- .entry-container -->
			</div><!-- .slider-content-wrapper -->
		</div><!-- .hentry-inner -->
	</article><!-- .slides -->
<?php
endwhile;

wp_reset_postdata();
