<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class A3_Portfolio_Feature_Data
{
	/**
	 * @var data table name
	 */
	public $table_name = 'a3_portfolio_feature';

	public function __construct() {
		if ( is_admin() ) {
			// Ajax Update Portfolio Feature Order
			add_action( 'wp_ajax_portfolio_update_feature_order', array( $this, 'portfolio_update_feature_order' ) );
			add_action( 'wp_ajax_nopriv_portfolio_update_feature_order', array( $this, 'portfolio_update_feature_order' ) );
		}
	}

	public function get_all_features() {
		global $wpdb;

		$all_features = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . $this->table_name . " ORDER BY `feature_order` ASC, `id` DESC" );

		return $all_features;
	}

	public function get_feature( $feature_id ) {
		global $wpdb;

		$the_feature = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . $this->table_name . " WHERE `id` = %d ", $feature_id ) );

		return $the_feature;
	}

	public function add_feature( $feature_data = array() ) {
		global $wpdb;
		extract( $feature_data );

		$result = $wpdb->query( $wpdb->prepare( "INSERT INTO " . $wpdb->prefix . $this->table_name . "(`feature_name`, `feature_slug`) VALUES ( %s, %s )", $feature_name, $feature_slug ) );

		return $result;
	}

	public function update_feature( $feature_data = array() ) {
		global $wpdb;
		extract( $feature_data );

		$result = $wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . $this->table_name . " SET `feature_name` = %s, `feature_slug` = %s WHERE `id` = %d ", $feature_name, $feature_slug, $feature_id ) );

		return $result;
	}

	public function delete_feature( $feature_id ) {
		global $wpdb;
		$result = false;

		$the_feature = $this->get_feature( $feature_id );
		if ( $the_feature ) {
			$result = $wpdb->query( $wpdb->prepare( "DELETE FROM " . $wpdb->prefix . $this->table_name . " WHERE `id` = %d ", $feature_id ) );
			$wpdb->query( $wpdb->prepare( "DELETE FROM " . $wpdb->prefix . "postmeta WHERE `meta_key` = %s", 'portfolio_feature_' . $feature_id ) );
		}
		return $result;
	}

	public function check_add_feature( $feature_name = '' ) {
		global $wpdb;

		$the_feature = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . $this->table_name . " WHERE `feature_name` = %s ", $feature_name ) );

		return $the_feature;
	}

	public function check_edit_feature( $feature_id = 0, $feature_name = '' ) {
		global $wpdb;

		$the_feature = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . $this->table_name . " WHERE `id` = %d  AND `feature_name` = %s ", $feature_id, $feature_name ) );

		return $the_feature;
	}

	public function portfolio_update_feature_order(){
		global $wpdb;
		check_ajax_referer( 'portfolio-feature-order', 'security' );
		$update_order 	= $_REQUEST['recoders'];

		$i = 1;
		foreach ( $update_order as $feature_id ) {
			$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . $this->table_name . " SET `feature_order` = %s WHERE `id` = %d ", $i, $feature_id ) );
			$i++;
		}
		die();
	}
}

global $a3_portfolio_feature_data;
$a3_portfolio_feature_data = new A3_Portfolio_Feature_Data();
