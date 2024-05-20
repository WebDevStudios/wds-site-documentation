
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
		showAllTermLinks();
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

	function showAllTermLinks() {
		termLinks.forEach(function(termLink) {
			termLink.style.display = 'inline-block';
		});
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