<?php
/**
 * The template part for displaying content
 *
 * @package Travelore
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-wrapper">
		<div class="image-meta-wrapper">
			<div class="entry-meta">
				<?php echo travelore_entry_category(); ?>
			</div>
			<?php

			travelore_post_thumbnail( 'travelore-featured' );
			
			?>
		</div>

		<div class="entry-container">
			<header class="entry-header">
				<div class="entry-meta">
				</div><!-- .entry-meta -->
				<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
					<span class="sticky-post"><?php esc_html_e( 'Featured', 'travelore' ); ?></span>
				<?php endif; ?>

				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<?php echo travelore_entry_header(); ?>
			</header><!-- .entry-header -->
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<footer class="entry-footer">
				<div class="entry-meta">
					<?php 
						travelore_edit_link();
					?>
				</div>
			</footer>
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article><!-- #post-## -->
