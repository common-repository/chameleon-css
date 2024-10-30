=== Chameleon CSS ===
Contributors: zeally
Donate link: http://wegrass.com/playground/ccss
Tags: css, switcher, switch, chameleon, choose, style sheet, condition, theme, ajax
Requires at least: 2.8
Tested up to: 3.0.5
Stable tag: 1.2

CSS Swither (Manual and Automatic by condition).

== Description ==

* Chameleon CSS let your WordPress site to automatically select CSS file upon your specific condition, for current release Time, Date, Day and Month conditions are available.
* Generate CSS switch list (widget and template tag)

Feature:

* Date, Time, Day and Month condition
* Date-Time souce: Client or Server
* CSS switch list (Widget and Template Tag)
* Very friendly UI
* Compatible with WP Super Cache

Relate Link: [Plugin Homepage & Document](http://wegrass.com/playground/ccss/)


== Installation ==

1. Upload the full directory into your wp-content/plugins directory
2. Activate the plugin at the plugin administration page
3. If you use *WP Super Cache*, go to setting - WP Super Cache and click on [Delete Cache] button
4. Prepare CSS files for different looks
5. Go to plugin configuration page (Setting -> Chameleon CSS)
6. Fill CSS description and file path, then click add button
7. Drag selected CSS to decided condition
8. Happy

* After update new version, don't forget to press Ctrl + F5 at Chameleon CSS admin page to clear the CSS cache.

== Frequently Asked Questions ==

I'm waiting for your question.

== Screenshots ==

1. Sample result
2. Administration - Time condition interface

== Changelog ==

= 1.2 =
* Added : ability to remember selected CSS from "CSS switch list"
* Added : ability to turn on / off "file existence checking"

= 1.1.2 =
* Fixed : minor fix (report by Webslugger)

= 1.1a =
* Fixed : minor bug fix (report by Vasilj Milosevic)

= 1.1 =
* Added : ability to generate CSS switch list (widget and template tag) - Suggest by Jim Wurster
* Updated : Admin UI improved.
* Fixed : css path mismatch in admin page.

= 1.0 =
* Stable release
* Updated : UI improved
* Fixed : php deprecate function issue ( above PHP 5.3.0 )
* Updated : jQuery core

= 0.7b =
* Fixed : minor compatability

= 0.7 =
* Added : Month condition.
* Fixed : minor bugs

= 0.6 =
* Added : Day condition.

= 0.5 =
* Added : ability to active / inactive the plugin
* Updated : author url

= 0.4 =
* Fixed : library conflict problem (Thank you for Marcelo)

= 0.3 =
* Added : Date-Time source (client / server)

= 0.2 =
* Fixed : Compatible with WP Super Cache

= 0.1 =
* Hatch.

== Credit ==

* Justin Tadlock : widget creating guide http://justintadlock.com/archives/2009/05/26/the-complete-guide-to-creating-widgets-in-wordpress-28
* Jim Wurster : CSS switch list (feature suggest)

== Upgrade Notice ==

= 1.0 =
* Fix error when using PHP 5.3.0 or upper. 
* Lot of UI improve.
* Stable release.
* Update jQuery core.

= 1.1.2 =
* Solve : Fatal error: Cannot redeclare class services_json