﻿=== Speed Booster Pack ===
Contributors: SpeedWorks
Donate link:
Tags: speed, optimization, performance, scripts to the footer, google libraries, font awesome cdn, defer parsing of javascript, remove query strings, lazy load images, gtmetrix, google pageSpeed, yslow, eliminate external render-blocking javascript and css, compression, async, render-blocking css
Requires at least: 3.6
Tested up to: 4.8
Stable tag: 3.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A light, frequently updated and easy to use plugin to make your site load faster and score higher on Google PSI.

== Description ==

**Speed Booster Pack is a lightweight, frequently updated, easy to use and well supported plugin which allows you to improve your website's loading speed.**

Improving your site's speed will get you a better score on major speed testing services such as [Google PageSpeed](http://developers.google.com/speed/pagespeed/insights/), [GTmetrix](http://gtmetrix.com/), [YSlow](https://developer.yahoo.com/yslow/), [Pingdom](http://tools.pingdom.com/fpt/), [Webpagetest](http://www.webpagetest.org/) and will also improve your overall site's usability. This will persuade Google and other search engines to rank your site higher in search results thus sending more traffic.

= Why Site Speed Is Important? =

Visitors usually close a website if it doesn't load in a few seconds and the slower a site loads the greater the chances are that the visitors will leave. And you don't want that to happen, do you? :-)
Speed Booster Pack is a plugin that can help you speed up your website by tweaking different options.

= Main Plugin Features =

* **Eliminate external render-blocking javascript and css** in above-the-fold content.
* **Move scripts to the footer** to improve page loading speed.
* **Load CSS asynchronously** to render your page more quickly and get a higher score on the major speed testing services.
* **Minify and inline all CSS styles and move them to the footer** to eliminate external render-blocking CSS and optimize CSS delivery.
* ** Minify HTML and JavaScript to increase your page load speed.
* **Lazy loads images** to improve page load times and save bandwidth.
* **Change image compression level** to keep file sizes smaller; Change JPG quality.
* **Load javascript files from Google Libraries** rather than serving them from your WordPress install directly, to reduce latency, increase parallelism and improve browser caching.
* **Defer parsing of javascript files** to reduce the initial load time of your page.
* **Remove query strings from static resources** to improve your speed scores.
* **Remove extra Font Awesome stylesheets** added to your theme by certain plugins, if *Font Awesome* is already used in your theme.
* **Remove junk header tags** to clean up your WordPress Header.
* **Display page loading time** in the plugin options page.
* **Display the number of executed SQL queries** in the plugin options page.
* **Display the Peak Memory Used** in the plugin options page.
* **Exclude scripts** from being moved to the footer or defered.
* **Remove RSD Link** if you are not using a Weblog Client or some 3rd party sites/programs that use the XML-RPC request formats.
* **Remove WordPress Shortlink**
* **Remove the WordPress Version** this option is added for security reasons and cleaning the header.
* **Remove all rss feed links** to cleanup your WordPress header.

* For complete usage instructions visit [Plugin Documentation](http://tiguandesign.com/docs/speed-booster/)

A short video about how Speed Booster pack can help actually increase a website's score in Google PageSpeed Insights:

https://www.youtube.com/watch?v=u0G6pk2mX4M

Future Development:

* Enable compression option.
* Leverage browser caching.
* Option to disable specific plugin actions on specific pages directly via the page edit screen metabox.
* Option to keep specific scripts in the header, since there are many javascript-based plugins scripts, that rely on jQuery to be loaded prior to the HTML elements.

= Recommended Plugins =

* [ShortPixel Image Compresson](https://wordpress.org/plugins/shortpixel-image-optimiser/) - An image optimization plugin that further boosts your site's speed.
* [Simple Author Box](http://wordpress.org/plugins/simple-author-box/) - A simple but cool author box with social icons.
* [Verify Ownership](http://wordpress.org/plugins/verify-ownership/) - Adds meta tag verification codes to your site.

**Keywords:** booster, performance, wp optimize, minimify, minify, lazy load, lazy loading, optimize javascript, render blocking, above the fold, Leverage browser caching, gzip compression, html minify,improve page load time, js optimizer, css optimizer, defer parsing of javascript, remove query strings, lazy load images, gtmetrix, google pageSpeed, yslow, eliminate external render-blocking javascript and css, compression, async, pingdom, webpagetest, speed up website, above-the-fold, loading speed, move scritps, autoptimize, asynchronously, change jpeg quality, image compression, change jpg quality, browser caching, query string, remove query strings, junk header, page loading, improve page loading, autooptimize, css minify, js, javascript, minimify


== Installation ==

1. Download the plugin (.zip file) on your hard drive.
2. Unzip the zip file contents.
3. Upload the `speed-booster-pack` folder to the `/wp-content/plugins/` directory.
4. Activate the plugin through the 'Plugins' menu in WordPress.
5. A new sub menu item `Speed Booster Pack` will appear in your main Settings menu.

== Screenshots ==
1. Plugin options page, simple view (v2.5)
2. The Google Page Speed results on our [testing site](http://tiguandesign.com/testing-speed-booster/) (v2.5)

== Changelog ==

= 3.4 =
* Added an option to increase your page load speed by minifying JavaScript and HTML. Removed option to remove RSD Link, since its impact on improving speed was insignificant.

= 3.3 =
* Fix Lazy Load CSS problem.

= 3.2 =
* Added Lazy Load feature to improve the web page loading times of your images.

= 3.1 =
* Following requests from users, added back the option of excluding javascript elements.

= 3.0 =
* We removed the option of excluding javascript elements as this option falls page speed score, making this plugin almost useless. Also, these options were only for advanced users, for regular users, incorrect use these options could destabilize the entire site functionality.
* We also removed the lazy load images option because it was outdated and broken. We'll come up with a new and updated solution soon.

= 2.9 =
* Added a new recommended features that can make your site load faster

= 2.8 =
* Fixed plugin options visibility issue

= 2.7 =
* All important options switched to off by default (on first plugin activation).

= 2.6 =
* Added Spanish translation by [Andrew Kurtis](http://www.webhostinghub.com/)

= 2.5 =
* Added option to exclude certain JS files from being moved to the footer.
* Added option to exclude certain JS files from being defered.
* Added a list of handles of all scripts and styles enqueued by your theme, useful for excluding options.
* Removed FOUC option since is useless with W3 Total Cache.
* Some visual changes on plugin options page.
* Translation updated with the new strings.
* Moved some admin inline scripts to js files.

= 2.4 =
* Fixed TypeError: $ is not a function when Prevent Flash of Unstyled Content (FOUC) option is active. Thanks to [@Marcio Duarte](http://profiles.wordpress.org/pagelab) for the [bug report](http://wordpress.org/support/topic/javascript-error-53).

= 2.3 =
* Added option to exclude certain CSS files from being loaded asynchronously.
* Changed the position of the styles when they are inlined to the footer (before js files).
* Added an experimental option to eliminate flash of unstyled content (FOUC) when all CSS styles are inlined to the footer.
* Translations updated.

= 2.2 =
* Fixed option to disable all CSS Async features on mobile devices.
* Fixed incompatibility with WPtouch plugin. Thanks to [@DevilIce](http://profiles.wordpress.org/devilice) for the [bug report](http://wordpress.org/support/topic/css-asynchronously-and-wptouch-issue).
* Updated function wp_is_mobile() on lazy load images to really disabled this feature on mobile devices.

= 2.1 =
*Added an option to disable all CSS Async features on mobile devices, to avoid some appearance issues until finding a clean solution to fix it.

= 2.0 =
*Modified: amended previous except for the admin toolbar css to enqueue its stylesheets only if admin bar is showing, to not break the render blocking plugin option.

= 1.9 =
* Fix: breaking the SEO by Yoast plugin interface (perhaps as well as to others too). Thanks to [@JahLive](http://profiles.wordpress.org/jahlive) for the [bug report](http://wordpress.org/support/topic/yoast-wordpress-seo-broken-after-update).
* Added an except for the admin toolbar css since the Load CSS asynchronously option removes its dashicons and stylesheets.


= 1.8 =
* Added option to load CSS asynchronously to render your page more quickly and get a higher score on the major speed testing services
* Added option to inline and minify all CSS styles and move them to the header or to the footer, to eliminate external render-blocking CSS and optimize CSS delivery.
* Added option to change the default image compression level, to help your pages load faster and keep file sizes smaller.
* Added memory usage information and active plugins number in the plugin options page.
* Replaced PHP version info with memory usage information (more useful).
* Added Romanian translation and POT file. Translators are welcome!

= 1.7 =
* Fixed Lazy Load missed js.

= 1.6 =
* Fixed some errors and missed codes from plugin functions.

= 1.5 =
* Added Lazy Load feature to improve the web page loading times of your images.
* Added an option to remove all rss feed links from WP Head.
* Added plugin options informations to the footer, visible in page source(hidden in front end), useful for debugging.

= 1.4 =
* Added a new option to remove extra Font Awesome stylesheets added to your theme by certain plugins, if Font Awesome is already used in your theme.
* Added a new option to remove WordPress Version Number.

= 1.3 =
* Fixed strict standards error: redefining already defined constructor for class.

= 1.2 =
* Modified the plugin version number variable in plugin options page.

= 1.1 =
* Modified Readme file

= 1.0 =
* Initial release

== Page Load Stats ==

Page Load Stats is a brief statistic displayed in the plugin options page. It displays your homepage loading speed (in seconds) and number of processed queries.

**Page loading time** – the progress bar color will be:

* *green* if the page load takes less than a second
* *orange* when loading the page takes between 1 and 2 seconds
* *red* if the page loading takes longer than 2 seconds

**Number of executed queries** – the progress bar color will be:

* *green* if there were less than 100 queries
* *orange* if there were between 100 and 200 queries
* *red* if the page required more than 200 queries

== Credits ==

* Thanks to [Jason Penney](http://jasonpenney.net/) for Google Libraries feature.
* CSS option was implemented from Async JS and CSS plugin and updated to our plugin.
* Credits for Lazy Load feature belongs to [pluginkollektiv](https://github.com/pluginkollektiv/crazy-lazy)
