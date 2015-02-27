<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class A3_Portfolio_Data
{
	public function install_database() {
		global $wpdb;
		$collate = '';
		if ( $wpdb->has_cap( 'collation' ) ) {
			if( ! empty($wpdb->charset ) ) $collate .= "DEFAULT CHARACTER SET $wpdb->charset";
			if( ! empty($wpdb->collate ) ) $collate .= " COLLATE $wpdb->collate";
		}
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		$a3_portfolio_feature = $wpdb->prefix . "a3_portfolio_feature";
		if($wpdb->get_var("SHOW TABLES LIKE '$a3_portfolio_feature'") != $a3_portfolio_feature){
			$sql = "CREATE TABLE " . $a3_portfolio_feature . " (
					   	  `id` bigint(20) NOT NULL auto_increment,
						  `feature_name` varchar(250) NOT NULL,
						  `feature_slug` varchar(250) NOT NULL,
						  `feature_order` bigint(20) NOT NULL default 0,
						  PRIMARY KEY  (`id`)
						) $collate ;";
			dbDelta($sql);
		}

		$table_a3_portfolio_categorymeta = $wpdb->prefix. "a3_portfolio_categorymeta";

		if ($wpdb->get_var("SHOW TABLES LIKE '$table_a3_portfolio_categorymeta'") != $table_a3_portfolio_categorymeta) {
			$sql = "CREATE TABLE IF NOT EXISTS `{$table_a3_portfolio_categorymeta}` (
				  meta_id bigint(20) NOT NULL auto_increment,
				  a3_portfolio_category_id bigint(20) NOT NULL,
				  meta_key varchar(255) NULL,
				  meta_value longtext NULL,
				  PRIMARY KEY  (meta_id),
				  KEY a3_portfolio_category_id (a3_portfolio_category_id),
				  KEY meta_key (meta_key)
				) $collate; ";

			dbDelta($sql);
		}
	}
}

global $a3_portfolio_data;
$a3_portfolio_data = new A3_Portfolio_Data();
?>