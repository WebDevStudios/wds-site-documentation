<?php
/**
 * WDS Site Documentation.
 *
 * @package           WebDevStudios\Documentation
 * @author            WebDevStudios
 * @copyright         2021 WebDevStudios
 * @license           GPL-2.0-or-later
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       WDS Site Documentation
 * Plugin URI:        https://github.com/webdevstudios/wds-site-documentation
 * Description:       A plugin to host site documentation in an easily accessible place in the WordPress dashboard.
 * Version:           1.1.0-dev
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            WebDevStudios
 * Author URI:        https://webdevstudios.com
 * Text Domain:       wds-site-documentation
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace WebDevStudios\Documentation;

use WP_Query;

/**
 * Add Site Documentation page to the admin menu for admins only.
 *
 * @author Evan Hildreth <evan.hildreth@webdevstudios.com>
 * @since  1.0.0
 */
function add_wds_documentation_dashboard_page() {
	add_submenu_page(
		'options-general.php',
		'Site Documentation',
		'Documentation',
		'manage_options',
		'wds_documentation',
		__NAMESPACE__ . '\wds_documentation_dashboard',
		100
	);
}

/**
 * Output the dashboard page for documentation
 *
 * @author Evan Hildreth <evan.hildreth@webdevstudios.com>
 * @since  1.0.0
 */
function wds_documentation_dashboard() {
	$img_url        = apply_filters(
		'wds_documentation_banner_url',
		plugin_dir_url( __FILE__ ) . '/wds_banner.png'
	);
	$enable_changes = apply_filters( 'wds_documentation_enable_changes', true );

	if ( $enable_changes ) {
		// Save attachment ID.
		if ( isset( $_POST['submit_selectors'] ) ) {
			check_admin_referer( 'wds_documentation_update', 'wds_documentation_update_nonce' );
			update_option( 'wds_documentation_video_id', absint( $_POST['wds_documentation_video_id'] ?? 0 ) );
			update_option( 'wds_documentation_pdf_id', absint( $_POST['wds_documentation_pdf_id'] ?? 0 ) );
		}

		wp_enqueue_media();
	}
	?>
	<h1><?php esc_html_e( 'Everything You Need to Know About Your WordPress Website', 'wds-site-documentation' ); ?></h1>

	<p><a href="https://webdevstudios.com/"><img src="<?php echo esc_url( $img_url ); ?>" style="max-width:100%;height:auto;" alt="WebDevStudios"></a></p>

	<?php display_documentation(); ?>

	<?php if ( $enable_changes ) : ?>
		<h2>Administration</h2>

		<form method='post'>
			<p>Current video: <span id="wds-video-name"><?php echo esc_html( get_the_title( get_option( 'wds_documentation_video_id' ) ) ); ?></span></p>
			<p><input id="upload_video_button" type="button" class="button" value="<?php esc_html_e( 'Select or upload video', 'wds-site-documentation' ); ?>" />
			<input type='hidden' name='wds_documentation_video_id' id='wds_documentation_video_id' value='<?php echo esc_attr( get_option( 'wds_documentation_video_id' ) ); ?>'></p>

			<p>Current PDF: <span id="wds-pdf-name"><?php echo esc_html( get_the_title( get_option( 'wds_documentation_pdf_id' ) ) ); ?></span></p>
			<p><input id="upload_pdf_button" type="button" class="button" value="<?php esc_html_e( 'Select or upload PDF', 'wds-site-documentation' ); ?>" />
			<input type='hidden' name='wds_documentation_pdf_id' id='wds_documentation_pdf_id' value='<?php echo esc_attr( get_option( 'wds_documentation_pdf_id' ) ); ?>'></p>

			<?php wp_nonce_field( 'wds_documentation_update', 'wds_documentation_update_nonce' ); ?>
			<input type="submit" name="submit_selectors" value="Save" class="button-primary">
		</form>

		<?php media_selector_print_scripts(); ?>
	<?php endif; ?>

	<?php
}

add_action( 'admin_menu', __NAMESPACE__ . '\add_wds_documentation_dashboard_page' );

/**
 * Add a Site Documentation item to the Admin Bar
 *
 * @author Evan Hildreth <evan.hildreth@webdevstudios.com>
 * @since  1.0.0
 *
 * @param Object $admin_bar Admin bar object from WordPress.
 */
function add_toolbar_items( $admin_bar ) {
	$admin_bar->add_menu(
		[
			'id'    => 'wds-documentation',
			'title' => 'Site Documentation',
			'href'  => '/wp-admin/admin.php?page=wds_documentation',
			'meta'  => [
				'title' => __( 'Documentation', 'wds-site-documentation' ),
			],
		]
	);
}
add_action( 'admin_bar_menu', __NAMESPACE__ . '\add_toolbar_items', 100 );

/**
 * Register the dashboard widget with WordPress.
 *
 * @author Evan Hildreth <evan.hildreth@webdevstudios.com>
 * @since  1.0.0
 */
function add_widget() {
	wp_add_dashboard_widget( 'wds_site_documentation', 'Everything You Need to Know About Your WordPress Website', __NAMESPACE__ . '\wds_documentation_widget' );
}
add_action( 'wp_dashboard_setup', __NAMESPACE__ . '\add_widget' );

/**
 * Display the widget on the WordPress dashboard.
 *
 * @author Evan Hildreth <evan.hildreth@webdevstudios.com>
 * @since  1.0.0
 */
function wds_documentation_widget() {
	$img_url = plugin_dir_url( __FILE__ ) . '/wds_banner.png';
	?>

	<?php display_documentation(); ?>

	<?php
}

/**
 * Display the documentation information.
 *
 * Filter the video URL with `wds_documentation_video_url`
 * Filter the PDF URL with `wds_documentation_pdf_url`
 *
 * @author Evan Hildreth <evan.hildreth@webdevstudios.com>
 * @since  1.0.0
 */
function display_documentation() {
	include __DIR__ . '/views/documentation.php';
}

/**
 * Output JavaScript needed to display the media selector boxes.
 *
 * @author Evan Hildreth <evan.hildreth@webdevstudios.com>
 * @since  1.0.0
 */
function media_selector_print_scripts() {

	$video_id = esc_js( get_option( 'wds_documentation_video_id', 0 ) );
	$pdf_id   = esc_js( get_option( 'wds_documentation_pdf_id', 0 ) );

	wp_enqueue_script( 'wds_documentation_media', plugin_dir_url( __FILE__ ) . '/js/media_selector.js', [ 'jquery' ], '1', true );
	wp_add_inline_script(
		'wds_documentation_media',
		"var set_to_video_id = $video_id;
		var set_to_pdf_id = $pdf_id;",
		'after'
	);
}
