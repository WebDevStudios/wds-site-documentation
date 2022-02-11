jQuery( document ).ready( function( $ ) {

	// Uploading files
	var file_frame;
	var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id

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