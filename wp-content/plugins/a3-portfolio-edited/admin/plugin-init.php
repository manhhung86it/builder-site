<?php
class A3_Portfolio {

	/**
	* Default contructor
	*/
	public function __construct() {
		update_option( 'a3_portfolio_plugin', 'a3_portfolios' );

		// Include a3 framework files
		add_action( 'plugins_loaded', array( $this, 'includes_framework' ), 1 );

		// Include required files
		$this->includes();

		a3_portfolio_set_global_page();

		add_action( 'init', array( $this, 'plugin_init' ), 8 );

		// Register Widgets
		add_action( 'widgets_init', array( $this, 'register_widget' ) );
	}

	public function includes_framework() {
		include( 'admin-ui.php' );
		include( 'admin-interface.php' );

		do_action( 'a3_portfolios_before_include_admin_page' );

		include( 'admin-pages/admin-settings-page.php' );

		do_action( 'a3_portfolios_after_include_admin_page' );

		include( 'admin-init.php' );

		global $a3_portfolio_admin_init;
		$a3_portfolio_admin_init->init();

	}

	public function includes() {

		do_action( 'a3_portfolios_before_include_files' );

		include( A3_PORTFOLIO_DIR . '/includes/wpml-support/class-portfolio-wpml.php' );
		include( A3_PORTFOLIO_DIR . '/includes/feature-data/class-a3-portfolio-feature-data.php' );
		include( A3_PORTFOLIO_DIR . '/includes/taxonomies/a3-portfolio-cat.php' );
		include( A3_PORTFOLIO_DIR . '/includes/post-types/a3-portfolio-post-types.php' );
		include( A3_PORTFOLIO_DIR . '/includes/frontend/a3-portfolio-template-functions.php' );
		include( A3_PORTFOLIO_DIR . '/includes/frontend/class-a3-portfolio-template-loader.php' );
		include( A3_PORTFOLIO_DIR . '/includes/a3-portfolio-core-functions.php' );

		if ( is_admin() ) {
			include( A3_PORTFOLIO_DIR . '/includes/backend/class-a3-portfolio-backend-scripts.php' );
			include( A3_PORTFOLIO_DIR . '/includes/feature-data/class-a3-portfolio-feature-page.php' );
			include( A3_PORTFOLIO_DIR . '/includes/taxonomies/a3-portfolio-tag.php' );
			include( A3_PORTFOLIO_DIR . '/includes/addons/class-a3-portfolio-addons-page.php' );
			include( A3_PORTFOLIO_DIR . '/includes/meta-boxes/a3-portfolio-data-metabox.php' );
			include( A3_PORTFOLIO_DIR . '/includes/post-types/a3-portfolio-duplicate.php' );
		}

		include( A3_PORTFOLIO_DIR . '/includes/widgets/class-portfolio-recently-viewed-widget.php' );
		include( A3_PORTFOLIO_DIR . '/includes/widgets/class-portfolio-categories-widget.php' );
		include( A3_PORTFOLIO_DIR . '/includes/widgets/class-portfolio-tags-widget.php' );
		include( A3_PORTFOLIO_DIR . '/includes/cookies/class-a3-portfolio-cookies.php' );

		if ( ! is_admin() ) {
			include( A3_PORTFOLIO_DIR . '/includes/frontend/class-a3-portfolio-frontend-scripts.php' );
			include( A3_PORTFOLIO_DIR . '/includes/frontend/a3-portfolio-template-hooks.php' );
		}

		do_action( 'a3_portfolios_after_include_files' );
	}

	public function plugin_activated(){
		update_option('a3_portfolio_version', '1.0.4');

		// Install Database
		include ( A3_PORTFOLIO_DIR . '/includes/class-a3-portfolio-data.php' );
		global $a3_portfolio_data;
		$a3_portfolio_data->install_database();

		$portfolio_page_id_created = a3_portfolio_create_page( _x('portfolios', 'page_slug', 'a3_portfolios'), '', __('Portfolios', 'a3_portfolios'), '[portfoliopage]' );
		update_option( 'portfolio_page_id', $portfolio_page_id_created );

		// Create Portfolio page for languages support by WPML
		a3_portfolio_auto_create_page_for_wpml( $portfolio_page_id_created, _x('portfolios', 'page_slug', 'a3_portfolios'), __('Portfolios', 'a3_portfolios'), '[portfoliopage]' );

		update_option('a3_portfolio_just_installed', true);

	}

	public function setup_image_size() {
		global $a3_portfolio_global_settings;

		if ( ! current_theme_supports( 'post-thumbnails' ) ) {
			add_theme_support( 'post-thumbnails' );
		}
		add_post_type_support( 'a3-portfolio', 'thumbnail' );


		$thumbnail_crop = true;
		if ( isset( $a3_portfolio_global_settings['portfolio_image_thumbnail_crop'] ) ) {
			$thumbnail_crop = $a3_portfolio_global_settings['portfolio_image_thumbnail_crop'];
		}

		if ( $a3_portfolio_global_settings['portfolio_image_thumb_width'] > 0 && $a3_portfolio_global_settings['portfolio_image_thumb_height'] > 0 )
			add_image_size( 'a3-portfolio', $a3_portfolio_global_settings['portfolio_image_thumb_width'], $a3_portfolio_global_settings['portfolio_image_thumb_height'], $thumbnail_crop );
		else
			add_image_size( 'a3-portfolio', 300, 250, $thumbnail_crop );
	}

	public function plugin_init() {
		global $a3_portfolio_post_types;

		// Register Post Type
		$a3_portfolio_post_types->register_post_type();

		if ( get_option( 'a3_portfolio_just_installed' ) ) {
			// Set Settings Default from Admin Init
			global $a3_portfolio_admin_init;
			$a3_portfolio_admin_init->set_default_settings();

			delete_option( 'a3_portfolio_just_installed' );
			wp_redirect( admin_url( 'edit.php?post_type=a3-portfolio&page=a3-portfolios-settings', 'relative' ) );
			exit;
		}

		// Add image sizes for portfolio item
		$this->setup_image_size();

		load_plugin_textdomain( 'a3_portfolios', false, A3_PORTFOLIO_FOLDER.'/languages' );

		// Upgrade Plugin
		$this->upgrade_plugin();
	}

	public function register_widget() {
		register_widget( 'A3_Portfolio_Categories_Widget' );
		register_widget( 'A3_Portfolio_Tags_Widget' );
		register_widget( 'A3_Portfolio_Recently_Viewed_Widget' );
	}

	public static function upgrade_plugin() {
		update_option( 'a3_portfolio_version', '1.0.4' );
	}
}

global $a3_portfolio;
$a3_portfolio = new A3_Portfolio();
?>