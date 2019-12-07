<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Travelore
 */
?>

<?php
$travelore_layout = travelore_get_theme_layout();

// Bail early if no sidebar layout is selected.
if ( 'no-sidebar' === $travelore_layout || 'no-sidebar-full-width' === $travelore_layout ) {
	return;
}

$sidebar = travelore_get_sidebar_id();

if ( '' === $sidebar ) {
    return;
}
?>

<aside id="secondary" class="sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- .sidebar .widget-area -->
<?php dynamic_sidebar( 'ads-sidebar-1' ); ?>
