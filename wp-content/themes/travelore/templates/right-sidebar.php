<?php
/*
 * Template Name: Right Sidebar ( Content, Primary Sidebar )
 *
 * Template Post Type: post, page
 *
 * The template for displaying Page/Post with Sidebar on right
 *
 * @package Travelore
 */

get_header(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php travelore_sections( 'content' ); ?>
        </main><!-- .site-main -->
    </div><!-- .content-area -->
    <?php get_sidebar(); ?>
<?php get_footer(); ?>
