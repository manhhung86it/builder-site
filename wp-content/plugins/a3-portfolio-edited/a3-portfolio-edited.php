<?php
/*
Plugin Name: a3 Portfolio
Description: Creates a beautiful fully mobile responsive, fully customizable, Google images style portfolio to showcase your work.
Version: 1.0.4
Author: a3 Revolution
Author URI: http://www.cyasoft.com/
Requires at least: 3.8
Tested up to: 4.1
License: GPLv2 or later
	Copyright © 2011 a3 Revolution Software Development team
	a3 Revolution Software Development team
	admin@a3rev.com
	PO Box 1170
	Gympie 4570
	QLD Australia
*/
?>
<?php
define('A3_PORTFOLIO_FILE_PATH', dirname(__FILE__));
define('A3_PORTFOLIO_DIR_NAME', basename(A3_PORTFOLIO_FILE_PATH));
define('A3_PORTFOLIO_FOLDER', dirname(plugin_basename(__FILE__)));
define('A3_PORTFOLIO_NAME', plugin_basename(__FILE__));
define('A3_PORTFOLIO_URL', str_replace(array('http:','https:'), '', untrailingslashit(plugins_url('/', __FILE__))));
define('A3_PORTFOLIO_DIR', WP_CONTENT_DIR . '/plugins/' . A3_PORTFOLIO_FOLDER);
define('A3_PORTFOLIO_JS_URL', A3_PORTFOLIO_URL . '/assets/js');
define('A3_PORTFOLIO_CSS_URL', A3_PORTFOLIO_URL . '/assets/css');
define('A3_PORTFOLIO_IMAGES_URL', A3_PORTFOLIO_URL . '/assets/images');
define('A3_PORTFOLIO_TEMPLATE_PATH', A3_PORTFOLIO_FILE_PATH . '/templates');
define('A3_PORTFOLIO_TEMPLATE_CSS_URL', A3_PORTFOLIO_URL . '/templates/css');
define('A3_PORTFOLIO_TEMPLATE_IMAGES_URL', A3_PORTFOLIO_URL . '/templates/images');

include ( 'admin/plugin-init.php' );

/**
 * Call when the plugin is activated
 */
global $a3_portfolio;
register_activation_hook(__FILE__, array( $a3_portfolio, 'plugin_activated' ) );
?>