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
 * Version:           1.0.0
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
	add_menu_page(
		'Site Documentation',
		'Documentation',
		'manage_options',
		'wds_documentation',
		__NAMESPACE__ . '\wds_documentation_dashboard',
		'dashicons-media-document',
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
	$img_url = plugin_dir_url( __FILE__ ) . '/wds_banner.png';

	$pdf_query = new WP_Query( [
		'name'                => 'wds-documentation-pdf',
		'post_type'           => [ 'attachment' ],
		'nopaging'            => false,
		'posts_per_page'      => '1',
		'ignore_sticky_posts' => false,
	] );

	$video_query = new WP_Query( [
		'name'                => 'wds-documentation-video',
		'post_type'           => [ 'attachment' ],
		'nopaging'            => false,
		'posts_per_page'      => '1',
		'ignore_sticky_posts' => false,
	] );

?>
	<h1>Site Documentation</h1>

	<p><a href="https://webdevstudios.com/"><img src="<?php echo esc_attr( $img_url ); ?>" style="max-width:100%;height:auto;" alt="WebDevStudios"></a></p>

	<h2>Video</h2>

	<?php if ( $video_query->have_posts() ) : ?>
		<p>Video goes here</p>
	<?php else : ?>
		<p>Video not found; upload a video to the media library with the slug <code>wds-documentation-video</code>.</p>
	<?php endif; ?>

	<h2>Documentation</h2>

	<?php if ( $pdf_query->have_posts() ) : ?>
		<p>PDF goes here</p>
	<?php else : ?>
		<p>PDF not found; upload a PDF to the media library with the slug <code>wds-documentation-pdf</code>.</p>
	<?php endif; ?>

<?php
}

add_action( 'admin_menu', __NAMESPACE__ . '\add_wds_documentation_dashboard_page' );
