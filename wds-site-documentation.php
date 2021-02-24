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
	$img_url   = plugin_dir_url( __FILE__ ) . '/wds_banner.png';
?>
	<h1><?php esc_html_e( 'Site Documentation', 'wds-site-documentation' ); ?></h1>

	<p><a href="https://webdevstudios.com/"><img src="<?php echo esc_url( $img_url ); ?>" style="max-width:100%;height:auto;" alt="WebDevStudios"></a></p>

	<?php display_documentation(); ?>

	<p>If you need help, we're here to support you! <a href="https://webdevstudios.com/contact/">Contact WDS</a></p>
<?php
}

add_action( 'admin_menu', __NAMESPACE__ . '\add_wds_documentation_dashboard_page' );

add_action( 'admin_bar_menu', __NAMESPACE__ . '\add_toolbar_items', 100 );
function add_toolbar_items( $admin_bar ) {
	$admin_bar->add_menu( [
		'id'    => 'wds-documentation',
		'title' => 'Site Documentation',
		'href'  => '/wp-admin/admin.php?page=wds_documentation',
		'meta'  => [
			'title' => __( 'Documentation', 'wds-site-documentation' ),
		],
	] );
}

add_action( 'wp_dashboard_setup', __NAMESPACE__ . '\add_widget' );
function add_widget() {
	wp_add_dashboard_widget( 'wds_site_documentation', 'Site Documentation', __NAMESPACE__ . '\display_documentation' );
}

function display_documentation() {
	$video_url = '';
	$pdf_url   = '';

	$video_query = new WP_Query( [
		'name'                => 'wds-documentation-video',
		'post_type'           => [ 'attachment' ],
		'nopaging'            => false,
		'posts_per_page'      => '1',
		'ignore_sticky_posts' => false,
	] );
	if ( $video_query->have_posts() ) {
		$video_url = wp_get_attachment_url( $video_query->posts[0]->ID );
	}
	$video_url = apply_filters( 'wds_documentation_video_url', $video_url );

	$pdf_query = new WP_Query( [
		'name'                => 'wds-documentation-pdf',
		'post_type'           => [ 'attachment' ],
		'nopaging'            => false,
		'posts_per_page'      => '1',
		'ignore_sticky_posts' => false,
	] );
	if ( $pdf_query->have_posts() ) {
		$pdf_url = wp_get_attachment_url( $pdf_query->posts[0]->ID );
	}
	$pdf_url = apply_filters( 'wds_documentation_pdf_url', $pdf_url );
?>
	<?php if ( $video_url ) : ?>
		<p><video controls>
		<source src="<?php echo esc_url( $video_url ); ?>">
		<?php esc_html_e( 'Sorry, your browser doesn\'t support embedded videos.', 'wds-site-documentation' ); ?>
		</video></p>
	<?php else : ?>
		<p><?php esc_html_e( 'Video not found; upload a video to the media library with the slug', 'wds-site-documentation' ); ?> <code>wds-documentation-video</code>.</p>
	<?php endif; ?>

	<?php if ( $pdf_url ) : ?>
		<p><a href="<?php echo esc_url( $pdf_url ); ?>"><?php esc_html_e( 'View PDF documentation', 'wds-site-documentation' ); ?></a></p>
	<?php else : ?>
		<p><?php esc_html_e( 'PDF not found; upload a PDF to the media library with the slug', 'wds-site-documentation' ); ?> <code>wds-documentation-pdf</code>.</p>
	<?php endif; ?>
<?php
}
