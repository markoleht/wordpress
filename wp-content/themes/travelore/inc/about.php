<?php
/**
 * Adds Theme page
 *
 * @package travelore
 */

function travelore_about_admin_style( $hook ) {
	if ( 'appearance_page_travelore-about' === $hook ) {
		wp_enqueue_style( 'travelore-about-admin', get_theme_file_uri( 'assets/css/about-admin.css' ), null, '1.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'travelore_about_admin_style' );

/**
 * Add theme page
 */
function travelore_menu() {
	add_theme_page( esc_html__( 'About Theme', 'travelore' ), esc_html__( 'About Theme', 'travelore' ), 'edit_theme_options', 'travelore-about', 'travelore_about_display' );
}
add_action( 'admin_menu', 'travelore_menu' );

/**
 * Display About page
 */
function travelore_about_display() {
	$theme = wp_get_theme();
	?>
	<div class="wrap about-wrap full-width-layout">
		<h1><?php echo esc_html( $theme ); ?></h1>
		<div class="about-theme">
			<div class="theme-description">
				<p class="about-text">
					<?php
					// Remove last sentence of description.
					$description = explode( '. ', $theme->get( 'Description' ) );

					array_pop( $description );

					$description = implode( '. ', $description );

					echo esc_html( $description . '.' );
				?></p>
				<p class="actions">
					<a href="https://catchthemes.com/themes/travelore" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'travelore' ); ?></a>

					<a href="https://catchthemes.com/demo/travelore" class="button button-secondary" target="_blank"><?php esc_html_e( 'View Demo', 'travelore' ); ?></a>

					<a href="https://catchthemes.com/themes/travelore/#theme-instructions" class="button button-primary" target="_blank"><?php esc_html_e( 'Theme Instructions', 'travelore' ); ?></a>

					<a href="https://wordpress.org/support/theme/travelore/reviews/#new-post" class="button button-secondary" target="_blank"><?php esc_html_e( 'Rate this theme', 'travelore' ); ?></a>

					<a href="https://catchthemes.com/themes/travelore" class="green button button-secondary" target="_blank"><?php esc_html_e( 'Upgrade to pro', 'travelore' ); ?></a>
				</p>
			</div>

			<div class="theme-screenshot">
				<img src="<?php echo esc_url( $theme->get_screenshot() ); ?>" />
			</div>

		</div>

		<nav class="nav-tab-wrapper wp-clearfix" aria-label="<?php esc_html_e( 'Secondary menu', 'travelore' ); ?>">
			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'travelore-about' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['page'] ) && 'travelore-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'About', 'travelore' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'travelore-about', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Free Vs Pro', 'travelore' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'travelore-about', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Changelog', 'travelore' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'travelore-about', 'tab' => 'import_demo' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'import_demo' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Import Demo', 'travelore' ); ?></a>
		</nav>

		<?php
			travelore_main_screen();

			travelore_free_vs_pro_screen();

			travelore_changelog_screen();

			travelore_import_demo();
		?>

		<div class="return-to-dashboard">
			<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
				<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
					<?php is_multisite() ? esc_html_e( 'Return to Updates', 'travelore' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'travelore' ); ?>
				</a> |
			<?php endif; ?>
			<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'travelore' ) : esc_html_e( 'Go to Dashboard', 'travelore' ); ?></a>
		</div>
	</div>
	<?php
}

/**
 * Output the main about screen.
 */
function travelore_main_screen() {
	if ( isset( $_GET['page'] ) && 'travelore-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) {
	?>
		<div class="feature-section two-col">
			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Theme Customizer', 'travelore' ); ?></h2>
				<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'travelore' ) ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Customize', 'travelore' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Got theme support question?', 'travelore' ); ?></h2>
				<p><?php esc_html_e( 'Get genuine support from genuine people. Whether it\'s customization or compatibility, our seasoned developers deliver tailored solutions to your queries.', 'travelore' ) ?></p>
				<p><a href="https://catchthemes.com/support-forum" class="button button-primary"><?php esc_html_e( 'Support Forum', 'travelore' ); ?></a></p>
			</div>
		</div>
	<?php
	}
}

/**
 * Output the changelog screen.
 */
function travelore_free_vs_pro_screen() {
	if ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) {
	?>
		<div class="wrap about-wrap vs-theme-table">
			<div id="compare" aria-labelledby="ui-id-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" style="display: block;" aria-hidden="false">
			   <div class="tab-containter">
				  <div class="wrapper">
					 <div class="tab-header">
						<h2 class="entry-title">Free Vs Pro (Premium)</h2>
					 </div>
					 <div class="compare-table">
						<div class="hentry">
							<table>
								<thead>
									<tr>
										<th>Free</th>
										<th>Features</th>
										<th>Pro (Premium)</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Responsive Design</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Super Easy Setup</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Color Options for various sections</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Base Color Scheme: Dark, Red, Gray, Yellow, Clean, Sports and Fashion</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Header Top Menu</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Social Top Menu</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Header Right Menu</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Social Header Left</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Primary Menu</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Social Primary</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Footer Menu</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Social Footer</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Ads Section</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Best of the Week: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Best of the Week: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Best of the Week: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Best of the Week: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Best of the Week: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Comment Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Excerpt Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured content: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured content: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured content: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured content: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured content: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Featured content: Custom Post Types</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Slider: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Featured Slider: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Slider: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Slider: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Slider: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Two Columns: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Featured Two Columns: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Two Columns: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Two Columns: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Two Columns: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Video</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Font Family Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Footer Editor Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Header Highlights: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Header Highlights: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Header Highlights: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Header Highlights: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Header Highlights: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Header Highlights: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Header Top Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
										<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Hero Content:Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Hero Content: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Hero Content: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Hero Content: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Hero Content:Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Site Layout: Boxed/Fluid</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Default Layout: Right Sidebar ( Content, Primary Sidebar ) </td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td> Default Layout: Left Sidebar ( Primary Sidebar, Content ) </td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td> Default Layout: No Sidebar </td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td> Default Layout: No Sidebar: Full Width </td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Homepage/Archive Layout: Right Sidebar(Content, Primary Sidebar)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Homepage/Archive Layout: Left Sidebar</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Homepage/Archive Layout:No Sidebar</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Homepage/Archive Layout:Full Width</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Archive Content Layout:Show Excerpt(Image Left)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Archive Content Layout:Show Excerpt(Image Right)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Archive Content Layout:Show Excerpt(Image Top)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Archive Content Layout:Show Full Content(Image Top)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Single Page/Post Image Layout: Post Thumbnail</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Archive Content Layout:Show Full Content(No Featured Image)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Single Page/Post Image Layout: Post Thumbnail</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Single Page/Post Image Layout: Slider Image Size(1920*822)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Original Image Size: Slider Image Size</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Section Title Layouts</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>WooCommerce Layout</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Menu Options: enable/disable Primary menu</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Menu Options: Primary Menu Layout</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Menu Options: enable/disable search in home button on Primary menu</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Menu Options: enable/disable search in Primary Menu</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Menu Options: enable/disable search in Header Right Search</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Most Viewed: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Most Viewed: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Most Viewed: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Most Viewed: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Most Viewed: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Most Viewed: Display Date</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Most Viewed: Display Author</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>News Ticker: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>News Ticker: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>News Ticker: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>News Ticker: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>News Ticker: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Portfolio: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Portfolio: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Portfolio: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Portfolio: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Portfolio: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Portfolio: Custom Post Type</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Promotion Headline: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Promotion Headline: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Promotion Headline: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Promotion Headline: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Promotion Headline: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Pagination Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Scrolling: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Scrolling: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Scrolling: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Scrolling: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Scrolling: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Scroll Up Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Section Sorter</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Services: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Services: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Services: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Services: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Services: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Services: Custom Post Type</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Team: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Team: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Team: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Team: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Team: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Testimonials: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Testimonials: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Testimonials: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Testimonials: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Testimonials: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Testimonials: Custom Post Type</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Top Reads: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Top Reads: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Top Reads: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Top Reads: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Top Reads: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Trending: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Trending: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Trending: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Trending: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Trending: Tags</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Two Columns: Section One</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Two Columns: Section Two</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Update Notifier</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>WPML Ready</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>WooCommerce Ready</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
								</tbody>
							</table>
						</div>
					 </div>
				  </div>
			   </div>
			</div>
		</div>
	<?php
	}
}

/**
 * Output the changelog screen.
 */
function travelore_changelog_screen() {
	if ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) {
		global $wp_filesystem;
	?>
		<div class="wrap about-wrap">

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'travelore' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'travelore_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = travelore_parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
	<?php
	}
}

/**
 * Parse changelog from readme file.
 * @param  string $content
 * @return string
 */
function travelore_parse_changelog( $content ) {
	// Explode content with ==  to juse separate main content to array of headings.
	$content = explode ( '== ', $content );

	$changelog_isolated = '';

	// Get element with 'Changelog ==' as starting string, i.e isolate changelog.
	foreach ( $content as $key => $value ) {
		if (strpos( $value, 'Changelog ==') === 0) {
			$changelog_isolated = str_replace( 'Changelog ==', '', $value );
		}
	}

	// Now Explode $changelog_isolated to manupulate it to add html elements.
	$changelog_array = explode( '= ', $changelog_isolated );

	// Unset first element as it is empty.
	unset( $changelog_array[0] );

	$changelog = '<pre class="changelog">';
		
	foreach ( $changelog_array as $value) {
		// Replace all enter (\n) elements with </span><span> , opening and closing span will be added in next process.
		$value = preg_replace( '/\n+/', '</span><span>', $value );

		// Add openinf and closing div and span, only first span element will have heading class.
		$value = '<div class="block"><span class="heading">= ' . $value . '</span></div>';

		// Remove empty <span></span> element which newr formed at the end.
		$changelog .= str_replace( '<span></span>', '', $value );
	}

	$changelog .= '</pre>';

	return wp_kses_post( $changelog );
}

/**
 * Import Demo data for theme using catch themes demo import plugin
 */
function travelore_import_demo() {
	if ( isset( $_GET['tab'] ) && 'import_demo' === $_GET['tab'] ) {
	?>
		<div class="wrap about-wrap demo-import-wrap">
			<div class="feature-section one-col">
			<?php if ( class_exists( 'CatchThemesDemoImportPlugin' ) ) { ?>
				<div class="col card">
					<h2 class="title"><?php esc_html_e( 'Import Demo', 'travelore' ); ?></h2>
					<p><?php esc_html_e( 'You can easily import the demo content using the Catch Themes Demo Import Plugin.', 'travelore' ) ?></p>
					<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=catch-themes-demo-import' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Import Demo', 'travelore' ); ?></a></p>
				</div>
				<?php } 
				else {
					$action = 'install-plugin';
					$slug   = 'catch-themes-demo-import';
					$install_url = wp_nonce_url(
							add_query_arg(
								array(
									'action' => $action,
									'plugin' => $slug
								),
								admin_url( 'update.php' )
							),
							$action . '_' . $slug
						); ?>
					<div class="col card">
					<h2 class="title"><?php esc_html_e( 'Install Catch Themes Demo Import Plugin', 'travelore' ); ?></h2>
					<p><?php esc_html_e( 'You can easily import the demo content using the Catch Themes Demo Import Plugin.', 'travelore' ) ?></p>
					<p><a href="<?php echo esc_url( $install_url ); ?>" class="button button-primary"><?php esc_html_e( 'Install Plugin', 'travelore' ); ?></a></p>
				</div>
				<?php } ?>
			</div>
		</div>
	<?php
	}
}
