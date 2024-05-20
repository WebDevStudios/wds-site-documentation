<?php
/**
 * Settings.
 */

namespace WebDevStudios\Documentation;

use WP_Query;

/**
 * Add Site Documentation page to the admin menu for admins only.
 *
 * @author Evan Hildreth <evan.hildreth@webdevstudios.com>
 * @since  1.0.0
 */
function add_wds_documentation_settings_page() {
    add_menu_page(
		__( 'Theme Help', 'textdomain' ),
		'Theme Help',
		'manage_options',
        'wds_documentation',
		__NAMESPACE__ . '\wds_documentation_dashboard',
		'',
		6
	);
	add_submenu_page(
		'wds_documentation',
		__( 'Glossary', 'textdomain' ),
		__( 'Glossary', 'textdomain' ),
		'manage_options',
		'wds_documentation_glossary',
		__NAMESPACE__ . '\wds_documentation_glossary'
	);
	add_submenu_page(
		'wds_documentation',
		__( 'Patterns', 'textdomain' ),
		__( 'Patterns', 'textdomain' ),
		'manage_options',
		'wds_documentation_patterns',
		__NAMESPACE__ . '\wds_documentation_patterns'
	);
}
add_action( 'admin_menu', __NAMESPACE__ . '\add_wds_documentation_settings_page' );

/**
 * Output the dashboard page for documentation
 *
 * @author Evan Hildreth <evan.hildreth@webdevstudios.com>
 * @since  1.0.0
 */
function wds_documentation_dashboard() {
	$img_url        = apply_filters(
		'wds_documentation_banner_url',
		plugin_dir_url( __FILE__ ) . '/imgs/wds_banner.png'
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

/**
 * Output JavaScript needed to display the media selector boxes.
 *
 * @author Evan Hildreth <evan.hildreth@webdevstudios.com>
 * @since  1.0.0
 */
function media_selector_print_scripts() {

	$video_id = get_option( 'wds_documentation_video_id', 0 );
	$pdf_id   = get_option( 'wds_documentation_pdf_id', 0 );

	?>
	<script type='text/javascript'>

		jQuery( document ).ready( function( $ ) {

			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_video_id = <?php echo esc_js( $video_id ); ?>; // Set this
			var set_to_pdf_id = <?php echo esc_js( $pdf_id ); ?>; // Set this

			jQuery('#upload_video_button').on('click', function( event ){

				event.preventDefault();

				// Set the wp.media post id so the uploader grabs the ID we want when initialised
				wp.media.model.settings.post.id = set_to_video_id;

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a video to upload',
					button: {
						text: 'Use this video',
					},
					library: {
						type: 'video',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					$( '#wds-video-name' ).text(attachment.title);
					$( '#wds_documentation_video_id' ).val( attachment.id );

					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});

				// Finally, open the modal
				file_frame.open();
			});

			jQuery('#upload_pdf_button').on('click', function( event ){

				event.preventDefault();

				// Set the wp.media post id so the uploader grabs the ID we want when initialised
				wp.media.model.settings.post.id = set_to_pdf_id;

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a PDF to upload',
					button: {
						text: 'Use this PDF',
					},
					library: {
						type: 'application/pdf',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					$( '#wds-pdf-name' ).text(attachment.title);
					$( '#wds_documentation_pdf_id' ).val( attachment.id );

					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});

					// Finally, open the modal
					file_frame.open();
			});

			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});

	</script>
	<?php

}