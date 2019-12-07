<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Travelore
 */
?>
<h2 class="entry-title title-id-<?php the_ID(); ?> news-ticker-title">
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</h2>
