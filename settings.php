<?php
/**
 * Use the settings API to save our options. Only admins should have access to
 * this screen, and then only if the `wds_documentation_enable_changes` filter
 * is `true`.
 */

namespace WebDevStudios\Documentation\Settings;

/**
 * Register the two options and their respective fields.
 */
function register_settings_and_fields() : void {
	register_setting(
		'wds_site_documentation',
		'wds_documentation_video_id',
		[
			'type' => 'integer',
			'description' => 'Attachment ID for the documentation video',
			'sanitize_callback' => 'intval',
			'show_in_rest' => false,
			'default' => 0,
		]
	);
	register_setting(
		'wds_site_documentation',
		'wds_documentation_pdf_id',
		[
			'type' => 'integer',
			'description' => 'Attachment ID for the documentation PDF',
			'sanitize_callback' => 'intval',
			'show_in_rest' => false,
			'default' => 0,
		]
	);

	add_settings_section(
		'wds_site_documentation',
		__( 'Site Documentation', 'wds-site-documentation' ),
		function() {
			esc_html_e( 'Set the video and PDF to be displayed on the dashboard and documentation page.', 'wds-site-documentation' );
		},
		'general'
	);
}
add_action( 'admin_init', __NAMESPACE__ . '\register_settings_and_fields', 10, 0 );
