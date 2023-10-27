<?php
/**
 * Glossary
 */

namespace WebDevStudios\Documentation;

use WP_Query;

// Create a glossary page that shows a list of terms and their definitions
function wds_documentation_glossary() {
	?>
	<div class="wds-site-glossary-page">
		<div class="header">
			<h1><?php esc_html_e( 'Glossary', 'wds-site-documentation' ); ?></h1>
			<a class="back-to-glossary-link button" href="#">Show All Terms</a>
		</div>

		<!-- Add anchor links for each letter of the alphabet -->
		<div class="alphabet-links">
			<?php
			// Generate anchor links for letters A to Z
			foreach ( range( 'A', 'Z' ) as $letter ) {
				echo '<a href="#' . esc_attr( $letter ) . '">' . esc_html( $letter ) . '</a> ';
			}
			?>
		</div>

		<div>

			<?php

			$terms_folder = plugin_dir_path( __FILE__ ) . 'terms';

			if ( is_dir( $terms_folder ) ) {
				// Get a list of Markdown files in the folder
				$markdown_files = glob( $terms_folder . '/*.md' );

				// Custom sorting function to order terms alphabetically by their filenames
				usort(
					$markdown_files,
					function ( $a, $b ) {
						return strcmp( pathinfo( $a, PATHINFO_FILENAME ), pathinfo( $b, PATHINFO_FILENAME ) );
					}
				);

				echo '<div class="term-link-container">';

				// Create an instance of Parsedown
				$parsedown = new \Parsedown();

				foreach ( $markdown_files as $markdown_file ) {
					$term_name = pathinfo( $markdown_file, PATHINFO_FILENAME );

					// Replace hyphens with spaces and capitalize every word
					$formatted_term_name = ucwords( str_replace( '-', ' ', $term_name ) );

					// Output a hidden div with the parsed HTML content
					echo '<a class="term-link" data-term-name="' . esc_attr( $term_name ) . '">' . esc_html( $formatted_term_name ) . '</a><br>';
				}
				echo '</div>';
				echo '<div class="terms-content">';
				foreach ( $markdown_files as $markdown_file ) {
					$term_name = pathinfo( $markdown_file, PATHINFO_FILENAME );

					// Replace hyphens with spaces and capitalize every word
					$formatted_term_name = ucwords( str_replace( '-', ' ', $term_name ) );

					// Get the content of the Markdown file
					$term_file    = plugin_dir_path( __FILE__ ) . 'terms/' . $term_name . '.md';
					$term_content = file_exists( $term_file ) ? file_get_contents( $term_file ) : 'The term does not exist.';

					// Parse Markdown content to HTML using Parsedown
					$html_content = $parsedown->text( $term_content );

					// Output a hidden div with the parsed HTML content
					echo '<div id="term-content-' . esc_attr( $term_name ) . '" style="display: none;">' . $html_content . '</div>';
				}
				echo '</div>';
			} else {
				echo 'The "terms" folder does not exist.';
			}
			?>
		</div>
	</div>
	<?php
}
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
	var termLinks = document.querySelectorAll('.term-link');
	var termLinkContainer = document.querySelector('.term-link-container'); // Select the container
	var backToGlossaryLink = document.querySelector('.back-to-glossary-link');
	var termContainers = document.querySelectorAll('[id^="term-content-"]');
	var alphabetLinks = document.querySelectorAll('.alphabet-links a');

	alphabetLinks.forEach(function(alphabetLink) {
		alphabetLink.addEventListener('click', function(event) {
			event.preventDefault();
			var letter = alphabetLink.textContent;
			hideAllTermContainers();
			showTermLinkContainer();
			filterTermsByLetter(letter); 
		});
	});

	termLinks.forEach(function(termLink) {
		termLink.addEventListener('click', function(event) {
			event.preventDefault();
			var termName = termLink.getAttribute('data-term-name');
			hideTermLinkContainer(); 
			showTermContent(termName);
		});
	});

	backToGlossaryLink.addEventListener('click', function(event) {
		event.preventDefault();
		showTermLinkContainer();
		hideAllTermContainers();
	});

	function filterTermsByLetter(letter) {
		termLinks.forEach(function(termLink) {
			var termName = termLink.getAttribute('data-term-name');
			if (termName && termName.charAt(0).toUpperCase() === letter) {
				termLink.style.display = 'inline-block';
			} else {
				termLink.style.display = 'none';
			}
		});
	}

	function hideTermLinkContainer() {
		termLinkContainer.style.display = 'none';
	}

	function showTermLinkContainer() {
		termLinkContainer.style.display = 'grid';
	}

	function hideAllTermContainers() {
		termContainers.forEach(function(container) {
			container.style.display = 'none';
		});
	}

	function showTermContent(termName) {
		var selectedTermContent = document.getElementById('term-content-' + termName);
		if (selectedTermContent) {
			selectedTermContent.style.display = 'block';
		}
	}
});
</script>
