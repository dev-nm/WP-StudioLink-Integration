=== Plugin Name ===
Contributors: dev-nm, marxphil
Donate link: -
Tags: Podcast, Studio Link, Audio, Theme Developer
Requires at least: 4.1
Tested up to: 5.0.3
Stable tag: 5.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Integrates Studio Link into Wordpress. Let your site react to the status of your Podcast.

== Description ==

This Plugin Integrates Studio Link into Wordpress. It lets you change your Wordpress Site corresponding to the Status of your Podcast.

With the Shortcode [StudioLink][/StudioLink] you can include Text, HTML or Javascript into your Site if your Podcast has a certain Status.

Examples:
[StudioLink online="True"]This Text is only shown, if your Podcast is Online.[/StudioLink]
[StudioLink]This has the exact same effect as the Above![/StudioLink]
[StudioLink status="Live"]We're Live! You can hear our Podcast here: LINK[/StudioLink]
[StudioLink status="Preshow"]We're just about to start our Live Podcast! Click HERE to join us![/StudioLink]

There are the following States:
online= "True" / "False"
status= "test" /  "preshow" / "live" / "postshow" / "break" / "online" / "offline"

We will update the plugin in the future to support more functions as having a specific ruleset where to apply changes for a certain status.


== Installation ==

1. Upload the whole Content of the Zip File to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 1.0.1 =
Redesign of the admin panel structure. Beginning of the Implementation of a Twitter Auto Post algorythm.

= 1.0 =
The Base Version. Everything works (as far as I know), but there is only one Shortcodes until now.

== Upgrade Notice ==

= 1.0.1 =
The new Menu is way more user friendly. You can now disable ShortCodes and you cann see the new Structure for the Twitter Postings.

= 1.0 =
Well - You dont really have a choice - do you?

`<?php code(); // goes in backticks ?>`