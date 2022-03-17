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
		'general',
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
		'general',
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
			media_selector_print_scripts();
			esc_html_e( 'Set the video and PDF to be displayed on the dashboard and documentation page.', 'wds-site-documentation' );
		},
		'general'
	);

	add_settings_field(
		'wds_documentation_pdf_id',
		'Current PDF',
		function() {
			$option = get_option( 'wds_documentation_pdf_id' );
			$title  = get_the_title( $option );
			printf(
				'<span id="wds-pdf-name">%s</span><br /><input id="upload_pdf_button" type="button" class="button" value="%s" />
				<input type="hidden" name="wds_documentation_pdf_id" id="wds_documentation_pdf_id" value="%d">',
				esc_html( $title ),
				esc_attr__( 'Select or upload PDF', 'wds-site-documentation' ),
				esc_attr( $option ),
			);
		},
		'general',
		'wds_site_documentation'
	);

	add_settings_field(
		'wds_documentation_video_id',
		'Current Video',
		function() {
			$option = get_option( 'wds_documentation_video_id' );
			$title  = get_the_title( $option );
			printf(
				'<span id="wds-video-name">%s</span><br /><input id="upload_video_button" type="button" class="button" value="%s" />
				<input type="hidden" name="wds_documentation_video_id" id="wds_documentation_video_id" value="%d">',
				esc_html( $title ),
				esc_attr__( 'Select or upload video', 'wds-site-documentation' ),
				esc_attr( $option ),
			);
		},
		'general',
		'wds_site_documentation'
	);
}
add_action( 'admin_init', __NAMESPACE__ . '\register_settings_and_fields', 10, 0 );


/**
 * Output JavaScript needed to display the media selector boxes.
 */
function media_selector_print_scripts() {

	$video_id = esc_js( get_option( 'wds_documentation_video_id', 0 ) );
	$pdf_id   = esc_js( get_option( 'wds_documentation_pdf_id', 0 ) );

	wp_enqueue_media();
	wp_enqueue_script( 'wds_documentation_media', plugin_dir_url( __FILE__ ) . '/js/media_selector.js', [ 'jquery' ], '1', true );
	wp_add_inline_script(
		'wds_documentation_media',
		"var set_to_video_id = $video_id;
		var set_to_pdf_id = $pdf_id;",
		'after'
	);
}
