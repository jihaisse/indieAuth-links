=== IndieAuth Links ===
Contributors: jihaisse
Donate link: 
Tags: authentication, indieweb, login
Requires at least: 3.3
Tested up to: 3.7.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

IndieAuth Links enable sign in with your domain name.

== Description ==

IndieAuth is a way to use your own domain name to sign in to websites. It's like OpenID, but simpler! It works by linking your website to one or more authentication providers such as Twitter or Google, then entering your domain name in the login form on websites that support IndieAuth.

This plugin add link on your home page to your various social profiles with the attribute rel="me"

After the user enters their domain in the sign-in form and submits, indieauth.com goes and scans their domain looking for rel="me" links from providers it knows about (twitter, github, etc...). It also verifies that the third-party website links back to the user's domain with a rel="me" link as well.

This plugin does not send data to other party. It just add HTML markup in the head of your home page.

All authentications processes are delegated.

== Installation ==

1. Upload the folder `indieauth-links` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the plugin, add your profiles links (https://twitter.com/jihaisse)
4. Ensure your profiles link back to your home page
4. Test on https://indieauth.com to login.

== Frequently asked questions ==

= Why IndieAuth? =

IndieAuth is part of the Indie Web movement to take back control of your online identity. Instead of logging in to websites as "you on Twitter" or "you on Facebook", you should be able to log in as just "you". We should not be relying on Twitter or Facebook to provide our authenticated identities, we should be able to use our own domain names to log in to sites everywhere.

IndieAuth was built to make it as easy as possible for users and for developers to start using this new way of signing in on the web, without the complexities of OpenID.

= Is this plugin sending data to third party =

No, this plugin just add HTML markup on your home page.
When you want to sign in form a web sign in with your domain name, it scan your website for links from providers it knows about (see https://indieauth.com). It also verifies that the third-party website links back to the user's domain with a rel="me" link as well.

= Does this require users to have their own domain name? =

Yes, the assumption is that people are willing to own their online identities in the form of a domain name. It is getting easier and easier to host content on your own domain name. See "Getting Started on the Indie Web"" for some suggestions, including mapping your domain to a Tumblr blog, or signing up for a simple web hosting service like Dreamhost.

== Changelog ==

= 0.2 =
* 4 Nov. 2013
* Add support for Persona & SMS