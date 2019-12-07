<?php
/**
 * The template for displaying top reads items
 *
 * @package Travelore
 */
?>

<?php
$number = get_theme_mod( 'travelore_top_reads_number', 4 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'orderby'             => 'post__in',
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$post_list  = array();// list of valid post/page ids

	$args['post_type'] = 'page';

	for ( $i = 1; $i <= $number; $i++ ) {
		$post_id = '';

		$post_id = get_theme_mod( 'travelore_top_reads_page_' . $i );

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

		$classes = array();

		$classes[] = 'hentry'; 

		if ( is_page() ) {
			$classes[] = 'page';
		} else {
			$classes[] = 'post';
		}

		if ( has_post_thumbnail() ) {
			$classes[] = 'has-post-thumbnail';
		} 
	?>
		<article id="top-reads-post-<?php the_ID(); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="hentry-inner">
				<div class="post-thumbnail">
					<a rel="bookmark" href="<?php the_permalink(); ?>">
						<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'travelore-featured' );
						} else {
							echo '<img src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb-640x480.jpg"/>';
						}
						?>
					</a>
				</div>

				<div class="entry-container">
					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
					</header>
				</div><!-- .entry-container -->
			</div><!-- .hentry-inner -->
		</article>
	<?php
	endwhile;
	wp_reset_postdata();
endif;
