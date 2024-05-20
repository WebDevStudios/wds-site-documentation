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
 * Version:           1.1.1
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
 * Include all settings files.
 *
 * @author Ashley Stanley <ashley.stanley@webdevstudios.com>
 * @since  1.1.1
 */
$dashboard_path = plugin_dir_path( __FILE__ ) . 'settings/';

$php_dash_files = glob( $dashboard_path . '*.php' );

foreach ( $php_dash_files as $php_dash_file ) {
    require_once $php_dash_file;
}

/**
 * Include all dashboard files.
 *
 * @author Ashley Stanley <ashley.stanley@webdevstudios.com>
 * @since  1.1.1
 */
$dashboard_path = plugin_dir_path( __FILE__ ) . 'dashboard/';

$php_dash_files = glob( $dashboard_path . '*.php' );

foreach ( $php_dash_files as $php_dash_file ) {
    require_once $php_dash_file;
}

/**
 * Include all glossary files.
 *
 * @author Ashley Stanley <ashley.stanley@webdevstudios.com>
 * @since  1.1.1
 */
$glossary_path = plugin_dir_path( __FILE__ ) . 'glossary/';

$php_glossary_files = glob( $glossary_path . '*.php' );

foreach ( $php_glossary_files as $php_glossary_file ) {
    require_once $php_glossary_file;
}

/**
 * Include all patterns files.
 *
 * @author Ashley Stanley <ashley.stanley@webdevstudios.com>
 * @since  1.1.1
 */
$patterns_path = plugin_dir_path( __FILE__ ) . 'patterns/';

$php_patterns_files = glob( $patterns_path . '*.php' );

foreach ( $php_patterns_files as $php_patterns_file ) {
    require_once $php_patterns_file;
}

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
 * Enqueues the plugin styles.
 *
 * @throws Exception If the plugin styles cannot be enqueued.
 */
function enqueue_plugin_styles() {
    wp_enqueue_style('plugin-style', plugin_dir_url(__FILE__) . 'style.css');
	wp_enqueue_script('plugin-script', plugin_dir_url(__FILE__) . 'script.js', array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', __NAMESPACE__ . '\enqueue_plugin_styles');