<?php
/* "Copyright 2012 a3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
Portfolio General Settings

TABLE OF CONTENTS

- var parent_tab
- var subtab_data
- var option_name
- var form_key
- var position
- var form_fields
- var form_messages

- __construct()
- subtab_init()
- set_default_settings()
- get_settings()
- subtab_data()
- add_subtab()
- settings_form()
- init_form_fields()

-----------------------------------------------------------------------------------*/

class A3_Portfolio_Item_Posts_Settings extends A3_Portfolio_Admin_UI
{

	/**
	 * @var string
	 */
	private $parent_tab = 'general-settings';

	/**
	 * @var array
	 */
	private $subtab_data;

	/**
	 * @var string
	 * You must change to correct option name that you are working
	 */
	public $option_name = 'a3_portfolio_item_posts_settings';

	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'a3_portfolio_item_posts_settings';

	/**
	 * @var string
	 * You can change the order show of this sub tab in list sub tabs
	 */
	private $position = 1;

	/**
	 * @var array
	 */
	public $form_fields = array();

	/**
	 * @var array
	 */
	public $form_messages = array();

	/*-----------------------------------------------------------------------------------*/
	/* __construct() */
	/* Settings Constructor */
	/*-----------------------------------------------------------------------------------*/
	public function __construct() {
		$this->init_form_fields();
		$this->subtab_init();

		$this->form_messages = array(
				'success_message'	=> __( 'Settings successfully saved.', 'a3_portfolios' ),
				'error_message'		=> __( 'Error: Settings can not save.', 'a3_portfolios' ),
				'reset_message'		=> __( 'Settings successfully reseted.', 'a3_portfolios' ),
			);

		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );

		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );

		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_init' , array( $this, 'after_save_settings' ) );

		add_action( $this->plugin_name . '_get_all_settings' , array( $this, 'get_settings' ) );
	}

	/*-----------------------------------------------------------------------------------*/
	/* subtab_init() */
	/* Sub Tab Init */
	/*-----------------------------------------------------------------------------------*/
	public function subtab_init() {

		add_filter( $this->plugin_name . '-' . $this->parent_tab . '_settings_subtabs_array', array( $this, 'add_subtab' ), $this->position );

	}

	/*-----------------------------------------------------------------------------------*/
	/* set_default_settings()
	/* Set default settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function set_default_settings() {
		global $a3_portfolio_admin_interface;

		$a3_portfolio_admin_interface->reset_settings( $this->form_fields, $this->option_name, false );
	}

	/*-----------------------------------------------------------------------------------*/
	/* get_settings()
	/* Get settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function get_settings() {
		global $a3_portfolio_admin_interface;

		$a3_portfolio_admin_interface->get_settings( $this->form_fields, $this->option_name );
	}

	/*-----------------------------------------------------------------------------------*/
	/* after_save_settings()
	/* Process when clean on deletion option is un selected */
	/*-----------------------------------------------------------------------------------*/
	public function after_save_settings() {
		if ( isset( $_POST['bt_save_settings'] ) && isset( $_POST['portfolio_inner_container_single_main_image_width_reset'] ) ) {
			delete_option( 'portfolio_inner_container_single_main_image_width_reset' );
			global $wpdb;
			$wpdb->query( "DELETE FROM ".$wpdb->postmeta." WHERE meta_key='_a3_portfolio_meta_gallery_wide' OR meta_key='_a3_portfolio_meta_thumb_position' " );
			//delete_post_meta_by_key('_a3_portfolio_meta_gallery_wide');
			//delete_post_meta_by_key('_a3_portfolio_meta_thumb_position');
		}
	}

	/**
	 * subtab_data()
	 * Get SubTab Data
	 * =============================================
	 * array (
	 *		'name'				=> 'my_subtab_name'				: (required) Enter your subtab name that you want to set for this subtab
	 *		'label'				=> 'My SubTab Name'				: (required) Enter the subtab label
	 * 		'callback_function'	=> 'my_callback_function'		: (required) The callback function is called to show content of this subtab
	 * )
	 *
	 */
	public function subtab_data() {

		$subtab_data = array(
			'name'				=> 'item-posts',
			'label'				=> __( 'Item Posts', 'a3_portfolios' ),
			'callback_function'	=> 'a3_portfolio_item_posts_settings_form',
		);

		if ( $this->subtab_data ) return $this->subtab_data;
		return $this->subtab_data = $subtab_data;

	}

	/*-----------------------------------------------------------------------------------*/
	/* add_subtab() */
	/* Add Subtab to Admin Init
	/*-----------------------------------------------------------------------------------*/
	public function add_subtab( $subtabs_array ) {

		if ( ! is_array( $subtabs_array ) ) $subtabs_array = array();
		$subtabs_array[] = $this->subtab_data();

		return $subtabs_array;
	}

	/*-----------------------------------------------------------------------------------*/
	/* settings_form() */
	/* Call the form from Admin Interface
	/*-----------------------------------------------------------------------------------*/
	public function settings_form() {
		global $a3_portfolio_admin_interface;

		$output = '';
		$output .= $a3_portfolio_admin_interface->admin_forms( $this->form_fields, $this->form_key, $this->option_name, $this->form_messages );

		return $output;
	}

	/*-----------------------------------------------------------------------------------*/
	/* init_form_fields() */
	/* Init all fields of this form */
	/*-----------------------------------------------------------------------------------*/
	public function init_form_fields() {

  		// Define settings
     	$this->form_fields = apply_filters( $this->option_name . '_settings_fields', array(

     		array(
				'name'		=> __( 'Item Posts Container', 'a3_portfolios' ),
				'desc' 		=> __( 'Settings here apply to all Portfolio Item posts. These can be over-ridden from Portfolio Item Meta on each Items edit page.', 'a3_portfolios' ),
                'type' 		=> 'heading',
           	),

           	array(
				'name' => __( 'Main Image Width', 'a3_portfolios' ),
				'desc' 		=> '% ' . __( 'The Gallery main image container width as a percentage of the full content width', 'a3_portfolios' ),
				'id' 		=> 'portfolio_inner_container_single_main_image_width',
				'type' 		=> 'slider',
				'default'	=> 70,
				'min'		=> 30,
				'max'		=> 80,
				'increment'	=> 1,
			),

			array(
				'name' 		=> __( 'Gallery Thumbnail Position', 'a3_portfolios' ),
				'desc'		=> __( 'Gallery Thumbnails position in relation to the Gallery main image', 'a3_portfolios' ),
				'id' 		=> 'portfolio_inner_container_single_thumb_position',
				'type' 		=> 'switcher_checkbox',
				'default'	=> 'right',
				'checked_value'		=> 'right',
				'unchecked_value'	=> 'below',
				'checked_label'		=> __( 'Right', 'a3_portfolios' ),
				'unchecked_label' 	=> __( 'Below', 'a3_portfolios' ),
			),

			array(
				'name' 		=> __( "Global Reset", 'a3_portfolios' ),
				'desc'		=> __( 'Turn ON and Save Changes to reset every Item Post Image Width and Thumbnail position to the values set on this page.', 'a3_portfolios' ),
                'id' 		=> 'portfolio_inner_container_single_main_image_width_reset',
				'type' 		=> 'onoff_checkbox',
				'default'	=> false,
				'separate_option'	=> true,
				'checked_value'		=> true,
				'unchecked_value'	=> false,
				'checked_label'		=> __( 'ON', 'a3_portfolios' ),
				'unchecked_label' 	=> __( 'OFF', 'a3_portfolios' ),
			),

        ));
	}

	public function include_script() {
	}
}

global $a3_portfolio_item_posts_settings_panel;
$a3_portfolio_item_posts_settings_panel = new A3_Portfolio_Item_Posts_Settings();

/**
 * a3_portfolio_item_posts_settings_form()
 * Define the callback function to show subtab content
 */
function a3_portfolio_item_posts_settings_form() {
	global $a3_portfolio_item_posts_settings_panel;
	$a3_portfolio_item_posts_settings_panel->settings_form();
}

?>
