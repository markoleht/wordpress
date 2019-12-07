<?php
/**
 * The template for displaying featured-two-columns items
 *
 * @package Travelore
 */
?>

<?php
$number = get_theme_mod( 'travelore_featured_two_columns_number', 5 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'orderby'             => 'post__in',
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$post_list  = array();// list of valid post/page ids

$type = get_theme_mod( 'travelore_featured_two_columns_type', 'category' );

	$args['post_type'] = 'page';

	for ( $i = 1; $i <= $number; $i++ ) {
		$post_id = '';

		$post_id = get_theme_mod( 'travelore_featured_two_columns_page_' . $i );

		if ( $post_id && '' !== $post_id ) {
			// Polylang Support.
			if ( class_exists( 'Polylang' ) ) {
				$post_id = pll_get_post( $post_id, pll_current_language() );
			}

			$post_list = array_merge( $post_list, array( $post_id ) );

		}
	}

	$args['post__in'] = $post_list;

$args['posts_per_page'] = $number;
$loop = new WP_Query( $args );

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();

		$featured = '';

		if ( 0 === $loop->current_post ) {
			$featured = 'featured';
		}
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( $featured ); ?>>
			<div class="hentry-inner">
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php
						// Output the featured image.
						if ( has_post_thumbnail() ) {
							$thumbnail = 'travelore-featured';

							if ( 0 === $loop->current_post ) {
								$thumbnail = 'travelore-featured-two-columns-first';
							}

							the_post_thumbnail( $thumbnail );
						} else {
							if ( 0 === $loop->current_post ) {
								echo '<a href=' . esc_url( get_permalink() ) .'><img src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-640x480.jpg"/></a>';
							} else {
								echo '<a href=' . esc_url( get_permalink() ) .'><img src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-768x576.jpg"/></a>';
							}
							
						}
						?>
					</a>
				</div><!-- .featured-two-columns-thumbnail -->

				<div class="entry-container">
					<header class="entry-header">
						<?php 
							echo travelore_entry_category();
						 ?>

						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

						<?php
							echo travelore_entry_header();
						?>
					</header>
					<?php
					if ( 0 === $loop->current_post ) {
						echo '<div class="entry-summary"><p>' . wp_kses_post( get_the_excerpt() ) . '</p></div><!-- .entry-summary -->';
					} ?>
				</div><!-- .entry-container -->
			</div><!-- .hentry-inner -->
		</article>
	<?php
	endwhile;
	wp_reset_postdata();
endif;
