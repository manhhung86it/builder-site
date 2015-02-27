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

class A3_Portfolio_Global_Settings extends A3_Portfolio_Admin_UI
{
	
	/**
	 * @var string
	 */
	private $parent_tab = 'global-settings';
	
	/**
	 * @var array
	 */
	private $subtab_data;
	
	/**
	 * @var string
	 * You must change to correct option name that you are working
	 */
	public $option_name = 'a3_portfolio_global_settings';
	
	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'a3_portfolio_global_settings';
	
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
			'name'				=> 'global-settings',
			'label'				=> __( 'Global Settings', 'a3_portfolios' ),
			'callback_function'	=> 'a3_portfolio_global_settings_form',
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
				'name' 		=> __( 'Portfolio Item Display', 'a3_portfolios' ),
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Maximum Items Per Row', 'a3_portfolios' ),
				'desc' 		=> __( 'Maximum Items to show per row in larger screens.', 'a3_portfolios' ),
				'id' 		=> 'portfolio_items_per_row',
				'type' 		=> 'slider',
				'default'	=> 4,
				'min'		=> 1,
				'max'		=> 6,
				'increment'	=> 1,
			),

			array(
				'name' 		=> __( 'Item Main Image Thumbnails', 'a3_portfolios' ),
				'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Thumbnail Size', 'a3_portfolios' ),
				'desc' 		=> __( 'Sizes set here are the maximum in pixels that WordPress Media will crop or resize the Item Main Image thumbnail.', 'a3_portfolios' ),
				'id' 		=> 'portfolio_image_thumb',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'portfolio_image_thumb_width',
	 										'name' 		=> __( 'x', 'a3_portfolios' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '300' ),
	 
	 								array(  'id' 		=> 'portfolio_image_thumb_height',
	 										'name' 		=> __( 'px', 'a3_portfolios' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '250' )
	 							)
			),
			array(
				'name' 		=> "",
				'desc' 		=>  __( 'OFF to Hard Crop thumbnail to exact dimensions. ON for Soft Crop were thumbnails are resized in proportion. If changing you will  need to <a href="http://wordpress.org/extend/plugins/regenerate-thumbnails/">regenerate</a> your thumbnails to see changes on existing Portfolio Items.', 'a3_portfolios' ),
                'id' 		=> 'portfolio_image_thumbnail_crop',
				'type' 		=> 'onoff_checkbox',
				'class'		=> 'portfolio_image_thumbnail_crop',
				'default'	=> false,
				'checked_value'		=> true,
				'unchecked_value'	=> false,
				'checked_label'		=> __( 'ON', 'a3_portfolios' ),
				'unchecked_label' 	=> __( 'OFF', 'a3_portfolios' ),
			),

			array(
				'name'		=> __( 'Item Card Title Display', 'a3_portfolios' ),
				'desc' 		=> '',
				'id'		=> 'cards_title_type_heading',
				'class'		=> 'cards_title_type_heading',
                'type' 		=> 'heading',
           	),
     		array(
				'name' 		=> __( 'Item Card Title Display Type', 'a3_portfolios' ),
				'id' 		=> 'cards_title_type',
				'class'		=> 'cards_title_type',
				'type' 		=> 'switcher_checkbox',
				'default'	=> 'hover',
				'checked_value'		=> 'hover',
				'unchecked_value'	=> 'under',
				'checked_label'		=> __( 'On Mouse Over', 'a3_portfolios' ),
				'unchecked_label' 	=> __( 'Under Image', 'a3_portfolios' ),
			),


           	array(
				'name' 		=> __( 'Image Watermarks', 'a3_portfolios' ),
                'type' 		=> 'heading',
                'desc' 		=> __( 'To add Watermarks to the Portfolio item images, please use the free <a target="_blank" href="https://wordpress.org/plugins/easy-watermark/">Easy Watermark plugin</a>. It is tested 100% compatible with a3 Portfolios.', 'a3_portfolios' ),
           	),

        ));
	}

	public function include_script() {}
}

global $a3_portfolio_global_settings_panel;
$a3_portfolio_global_settings_panel = new A3_Portfolio_Global_Settings();

/**
 * a3_portfolio_cards_settings_form()
 * Define the callback function to show subtab content
 */
function a3_portfolio_global_settings_form() {
	global $a3_portfolio_global_settings_panel;
	$a3_portfolio_global_settings_panel->settings_form();
}

?>
