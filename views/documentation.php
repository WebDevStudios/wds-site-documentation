<?php
/**
 * Get the media urls and display the documentation.
 */

namespace WebDevStudios\Documentation\Views\Documentation;

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
