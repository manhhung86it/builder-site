<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class A3_Portfolio_Backend_Scripts
{
	public function __construct() {
		if ( is_admin() ) {
			// Add custom style to dashboard
			add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );

			// Add style for Portfolio Add-ons page
			if ( isset( $_GET['page'] ) && 'portfolio-addons' == $_GET['page'] ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'load_addons_page_scripts' ) );
			}

			// Add text on right of Visit the plugin on Plugin manager page
			add_filter( 'plugin_row_meta', array( $this, 'plugin_extra_links'), 10, 2 );
		}
	}

	public function load_scripts() {
		// Add custom style to dashboard
		wp_enqueue_style( 'a3rev-wp-admin-style', A3_PORTFOLIO_CSS_URL . '/a3_wp_admin.css' );

		// Add admin sidebar menu css
		wp_enqueue_style( 'a3rev-admin-a3-portfolio-sidebar-menu-style', A3_PORTFOLIO_CSS_URL . '/admin_sidebar_menu.css' );
	}

	public function load_addons_page_scripts() {
		wp_enqueue_style( 'a3-portfolio-addons-style', A3_PORTFOLIO_CSS_URL . '/a3.portfolio.addons.admin.css' );

		if ( is_rtl() ) {
			wp_enqueue_style( 'a3-portfolio-addons-style-rtl', A3_PORTFOLIO_CSS_URL . '/a3.portfolio.addons.admin.rtl.css' );
		}
	}

	public function plugin_extra_links($links, $plugin_name) {
		if ( $plugin_name != A3_PORTFOLIO_NAME ) {
			return $links;
		}
		$links[] = '<a href="'.admin_url( 'edit.php?post_type=a3-portfolio&page=a3-portfolios-settings', 'relative' ).'">'.__('Settings', 'a3_portfolios').'</a>';
		$links[] = '<a href="https://wordpress.org/support/plugin/a3-portfolio" target="_blank">'.__('Support', 'a3_portfolios').'</a>';
		return $links;
	}

}

global $a3_portfolio_backend_scripts;
$a3_portfolio_backend_scripts = new A3_Portfolio_Backend_Scripts();
?>