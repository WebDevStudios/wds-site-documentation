<?php
/**
 * Dashboard.
 */

namespace WebDevStudios\Documentation;

use WP_Query;

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
	$video_url = '';
	$pdf_url   = '';
	$footer    = '';

	$video_id = get_option( 'wds_documentation_video_id' );
	if ( $video_id ) {
		$video_url = wp_get_attachment_url( $video_id );
	}
	$video_url = apply_filters( 'wds_documentation_video_url', $video_url );

	$pdf_id = get_option( 'wds_documentation_pdf_id' );
	if ( $pdf_id ) {
		$pdf_url = wp_get_attachment_url( $pdf_id );
	}
	$pdf_url = apply_filters( 'wds_documentation_pdf_url', $pdf_url );

	$footer = apply_filters(
		'wds_documentation_footer',
		'<p>If you need assistance, would like to add more functionality to your site, or require a new redesign, please contact WebDevStudios.</p>
		<p><a href="https://webdevstudios.com/contact/" class="button button-primary" style="background-color: #f3713c; border-color: #f3713c">Contact WebDevStudios Now</a></p>'
	);
	?>
	<?php if ( $video_url ) : ?>
		<p>
			<?php esc_html_e( 'Watch a video tutorial of how your website works:', 'wds-site-documentation' ); ?><br>
			<video controls>
				<source src="<?php echo esc_url( $video_url ); ?>">
				<a href="<?php echo esc_url( $video_url ); ?>"><?php esc_html_e( 'View video tutorial', 'wds-site-documentation' ); ?></a>
			</video>
		</p>
	<?php endif; ?>

	<?php if ( $pdf_url ) : ?>
		<p>
			<?php
				echo wp_kses_post(
					sprintf(
						// translators: placeholder is link to PDF document.
						__( 'Prefer to read? Take a look at this %1$s that guides you through your website.', 'wds-site-documentation' ),
						sprintf(
							'<a href="%1$s">%2$s</a>',
							esc_url( $pdf_url ),
							__( 'document', 'wds-site-documentation' )
						)
					)
				);
			?>
		</p>
	<?php endif; ?>

	<?php echo wp_kses_post( $footer ); ?>
	<?php
}
