=== WDS Site Documentation ===
Contributors: webdevstudios, oddevan
Tags: documentation
Requires at least: 5.6
Tested up to: 6.0
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
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Click the "Site Documentation" button in the Admin Bar or under "Settings" to view the documentation page.
4. Upload a Video and PDF using the buttons there. These will show up on the page and on the WordPress dashboard.

== Frequently Asked Questions ==

= Why should I use this? =

When an agency hands a site off to the client, they should also provide documentation on how to use the
site, even if the site is mostly "vanilla WordPress." This plugin makes it easy to set up a
documentation section in the WordPress dashboard.

= Can I turn off the buttons so the documentation can't be changed accidentally? =

Absolutely! See the "Filters for developers" section.

= Can I change the banner and footer on the page/widget? =

Yes, you can! See the "Filters for developers" section.

= Can you build my site? =

Absolutely. [Drop us a line!][wds-contact]

[wds-contact]:https://webdevstudios.com/contact/

== Screenshots ==

1. This shows the documentation widget on the main dashboard.
2. This shows the documentation page including the select/upload buttons.

== Changelog ==


= 1.0 =
* Initial release

== Filters for developers ==

The URLs for the movie and PDF files can be modified with the `wds_documentation_video_url`
and `wds_documentation_pdf_url` filters respectively. For example:

```
add_filter( 'wds_documentation_pdf_url', function( $pdf_url ) {
	return 'https://agency.site/docs/client.pdf';
}, 10, 1 );
```

The upload buttons can be turned off with the filter `wds_documentation_enable_changes`. To
turn off the buttons, add this code to your theme's `functions.php` file:

```
add_filter( 'wds_documentation_enable_changes', '__return_false', 10 );
```

The banner image can be modified with `wds_documentation_banner_url`:

```
add_filter( 'wds_documentation_banner_url', function( $banner_url ) {
	return 'https://agency.site/docs/agency.png';
}, 10, 1 );
```

The footer text can be customized with `wds_documentation_footer`:

```
add_filter( 'wds_documentation_footer', function( $footer ) {
	return '<a href="mailto:person@agency.site">Contact us!</a>';
}, 10, 1 );
```
