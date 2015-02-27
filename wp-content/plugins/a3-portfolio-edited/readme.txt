=== a3 Portfolio ===

Contributors: a3rev, A3 Revolution Software Development team
Tags: a3 Portfolio, Portfolio, Post Portfolio, Showcase, Image Showcase, Image Portfolio, Gallery, Photo Gallery, Image Gallery
Requires at least: 4.0
Tested up to: 4.1.0
Stable tag: 1.0.4
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

a3 Portfolio is an extendable post based plugin that makes creating beautiful content a breeze.

== Description ==

Inspired by Google Images UI a3 Portfolio is an image based creation and management extension for every blogger, artist, photographer, and web developer to showcase their own and clients work.

= Simple to use =
* If you know how to use WordPress posts, categories and tags then you know how to use a3 Portfolios.
* Portfolio Items are custom post types.
* Portfolio Categories (custom WordPress taxonomy)
* Portfolio Tags (custom WordPress taxonomy)
* Portfolio Custom feature data
* Each Portfolio item has its own image gallery (add multiple images to each item).

= Showcase All of your content =
* Portfolio page, category Pages and Tag pages show Portfolio items as Cards.
* Item details show on click in Google Images inspired Expander item.
* Each Item has its own image Gallery
* Option to set the number of item cards to show per row.
* Option to show Item title on mouse over item card or under the card.
* Option to set width of the Gallery main image on item post.
* Option to show thumbnails beside main image or under it on item post

= Demo Site =
Visiting the [demo site](http://woo.a3de.info/portfolios/) is the quickest way to see the frontend features of the a3 Portfolio. Note Demo site has the Free a3 Portfolio Isotope Add-On plugin installed.

= Widgets =
* a3 Portfolio Category widget for easy navigation
* a3 Portfolio Tag Cloud widget
* a3 Portfolio Recently viewed items widget.

= FREE a3 Portfolio Isotope Add-On plugin =
After installing a3 Portfolio please install and activate the a3 Portfolio Isotope Add-On. It is a FREE Add-On plugin that greatly enhances the Portfolio, Category and Tags page Items main images sort and filtering. It creates a real wow factor with the Portfolios for your site visitors.

* Isotope is a js. that is subject to a Commercial License which we have purchased.
* WordPress could not allow us to include the script into the a3 Portfolio core because of the Isotope commercial license.
* From the a3 Portfolio plugin admin dashboard go the Add-Ons Menu
* Click on the Get This Extension button on the Isotope plugin card.
* The link will take you to the Free Downloads section of the a3rev site.
* Register an account or if you have an existing a3rev account - use it to log in.
* Once logged in you will see the License Key and a Download Plugin button.
* Click the button and you will be asked to acknowledge that we supply the Plugin to you at no charge and that you are aware of and agree to be bound by the Isotope developers Commercial License terms and conditions.
* Copy the License Key and download the plugins zip file to your computer.
* Use the WordPress plugins installer to upload the zip from your computer.
* WordPress will unpack the zip and install the plugin.
* Click the activate link and on the page that opens and enter the Key you had copied and validate the License.
* If you have any existing Portfolio items clear any caching on your site and in your browser so you can see the beautiful Isotope sort and filter of the portfolio, category and tags pages.
* Notice that when you click on an item the expander now opens over the rows below and does not push them down below the expander window.
* Note the Isotope Add-On Key is a lifetime key for an unlimited number of site activations.

= More Features =
* HTML5 card Architecture - responsive mobile and tablet display.
* Fast loading with built in Lazy Load for all images.
* Lightweight - Portfolio resources only load on Portfolio Post items, Portfolio page, Category and Tags pages.
* WordPress Multi site ready.
* Full WMPL compatibility
* Backend and frontend support for RTL display.
* Translation ready

= Strength & flexibility =
a3 Portfolio is built using WordPress best practices both on the front and the back end. Clean code, all classes commented. An efficient, robust and intuitive plugin.

= Customizable =
a3 Portfolio works with any theme, including the default WordPress themes. Built in hooks and filters allow developers to create extensions with a robust template structure for easy customization.


== Installation ==

= Minimum Requirements =

* WordPress 4.0
* PHP version 5.2.4 or greater
* MySQL version 5.1.73 or greater

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't even need to leave your web browser. To do an automatic install of a3 Portfolio, log in to your WordPress admin panel, navigate to the Plugins menu and click Add New. Search a3 Portfolio, select and install.

== Screenshots ==

1. Screenshot Portfolio-items-front-end
2. Screenshot Portfolio-items-front-end-open
3. Screenshot Portfolio-items-post
4. Portfolio-item

== Usage ==

1. Install and activate the plugin

2. On wp-admin click on a3 Portfolio

3. Click Add New and create items.

4. Go to WordPress menu Appearance > Menus

5. From Pages select the Portfolio page and add to main menu. Save menu

6. Enjoy


== Changelog ==

= 1.0.4 - 2015/01/28 =
* Tweak - Add New Release a3 Portfolio Dynamic Stylesheet Add-On plugin Card to the Add-Ons menu
* Tweak - Added an image to the a3 Portfolio Isotope Add-On Card on the Add-Ons menu

= 1.0.3 - 2015/01/26 =
* Tweak - Update background of portfolio mobile control to be the same background color of item expander.
* Dev - Defined 'a3_portfolio_cards_title_class' filter tag. Developers can filter to add new class name for Card Title on Card Layout
* Dev - Defined 'a3_portfolio_backend_launch_button_text' filter tag. Developers can filter to change Launch button text that shows inside the item Expander
* Fix - Change <code>parameter == undefined</code> to <code>typeof parameter === 'undefined'</code> inside portfolio script to fix JavaScript undefined parameter error

= 1.0.2 - 2015/01/12 =
* Fix - Fatal Error on first install on some installs. Hook the 'set_default_settings' function into 'init' action instead hook into 'register_activation_hook'
* Fix - Item main image caption not showing. Updated if <code>( ! is_array( $gallery ) )</code> to <code>if ( is_array( $gallery ) )</code>
* Credit - Thanks to wordpress.org memeber [jmdev](https://wordpress.org/support/profile/jmdev) for reporting the issue.

= 1.0.1 - 2015/01/05 =
* Feature - Add a3 Portfolio Isotope Add-On Free plugin download from the Add-On's menu
* Tweak - Updated the plugins description with details about the Isotope Add-On plugin
* Tweak - Link from the Isotope Add-On plugin to http://a3rev.com/my-account/free-downloads/
* Tweak - Add Registration and Login features to the /free-downloads/ page
* Tweak - Add License agreement for first download of a3 Portfolio Isotope plugin
* Tweak - Added effect mouse over on the card for Add-On page
* Tweak - Remove custom colour for Add-On submenu title
* Dev - Hooked framework code into 'plugins_loaded' action. Allows developers to add their child plugin admin menu as a a3 Portfolio sub menu
* Dev - Defined 'a3_portfolio_before_portfolio_enqueue_styles' action tag
* Dev - Defined 'a3_portfolio_after_portfolio_enqueue_styles' action tag
* Dev - Defined 'a3_portfolio_before_portfolio_enqueue_styles_rtl' action tag
* Dev - Defined 'a3_portfolio_after_portfolio_enqueue_styles_rtl' action tag
* Dev - Defined 'a3_portfolio_before_single_enqueue_styles' action tag
* Dev - Defined 'a3_portfolio_after_single_enqueue_styles' action tag
* Dev - Defined 'a3_portfolio_before_single_enqueue_styles_rtl' action tag
* Dev - Defined 'a3_portfolio_after_single_enqueue_styles_rtl' action tag

= 1.0.0 - 2014/12/16 =
* First working release


== Upgrade Notice ==

= 1.0.4 =
Upgrade now and check the plugins Add-on menu for new release a3 Portfolio Dynamic Stylesheets Add-on plugin listing.

= 1.0.3 =
Upgrade now for 1 Mobile display code tweak, 2 new dev filters and 1 bug fix

= 1.0.2 =
Upgrade now for 2 bug fixes. Fatal Error on fist activation on some installs and item main image caption not showing.

= 1.0.1 =
Upgrade now to gain access to the FREE Isotope Add-On plugin from the Add-On menu to greatly improve a3 Portfolio sort and filter.
