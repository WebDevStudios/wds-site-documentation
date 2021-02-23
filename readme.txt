=== Plugin Name ===
Contributors: webdevstudios, oddevan
Tags: documentation
Requires at least: 5.6
Tested up to: 5.6
Requires PHP: 7.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
A plugin to host site documentation in an easily accessible place in the WordPress dashboard.
 
== Description ==
 
Host documentation for your clients right where they need it most: on the website! This plugin creates
a page on the WordPress dashboard called "Documentation" that shows a video and links to a PDF.

Brought to you by the fine folks at [WebDevStudios][wds]!

[wds]:https://webdevstudios.com/
 
== Installation ==
 
1. Upload the plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Upload a video to the WordPress media library and give it the slug `wds-documentation-video`.
1. Upload a PDF to the WordPress media library and give it the slug `wds-documentation-pdf`.
 
== Frequently Asked Questions ==
 
= Why should I use this? =
 
When an agency hands a site off to the client, they should also provide documentation on how to use the
site, even if the site is mostly "vanilla WordPress." This plugin makes it easy to set up a
documentation section in the WordPress dashboard.
 
= Can you build my site? =
 
Absolutely. [Drop us a line!][wds-contact]

[wds-contact]:https://webdevstudios.com/contact/
 
== Screenshots ==
 
1. This is the documentation page as it is shown in the WordPress dashboard.
2. This shows how to set the slug for an item in the media library.
 
== Changelog ==
 
= 1.0 =
* Initial release

== Filters for developers ==

The URLs for the movie and PDF files can be modified with the `wds_documentation_video_url`
and `wds_documentation_pdf_url` filters respectively. For example:

```php
add_filter( 'wds_documentation_pdf_url', function( $pdf_url ) {
	return 'https://agency.site/docs/client.pdf';
}, 10, 1 );
```