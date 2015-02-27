<?php
/**
 * a3 Portfolio Uninstall
 *
 * Uninstalling deletes options, tables, and pages.
 *
 */
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) 
	exit();

global $wpdb;

// Delete Pages
wp_trash_post( get_option( 'portfolio_page_id' ) );

// Delete Plugin Settings
delete_option( 'a3_portfolio_global_settings' );
delete_option( 'a3_portfolio_item_posts_settings' );

// Delete Tables
$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . "a3_portfolio_feature" );
$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . "a3_portfolio_categorymeta" );

// Delete postmeta
delete_post_meta_by_key( '_a3_portfolio_meta_gallery_wide' );
delete_post_meta_by_key( '_a3_portfolio_meta_thumb_position' );
delete_post_meta_by_key( '_a3_portfolio_launch_site_url' );
delete_post_meta_by_key( '_a3_portfolio_launch_button_text' );
delete_post_meta_by_key( '_a3_portfolio_image_gallery' );
$wpdb->query( "DELETE FROM $wpdb->postmeta WHERE meta_key LIKE '_a3_portfolio_meta_feature_%';" );

// Delete posts
$wpdb->query( "DELETE FROM {$wpdb->posts} WHERE post_type IN ( 'a3-portfolio' );" );

// Delete wpml data
$string_ids = $wpdb->get_col( "SELECT id FROM {$wpdb->prefix}icl_strings WHERE context='a3 Portfolios' " );
if ( is_array( $string_ids ) && count( $string_ids ) > 0 ) {
    $str = join( ',', array_map( 'intval', $string_ids ) );
    $wpdb->query( "
		DELETE s.*, t.* FROM {$wpdb->prefix}icl_strings s LEFT JOIN {$wpdb->prefix}icl_string_translations t ON s.id = t.string_id
		WHERE s.id IN ({$str})" );
    $wpdb->query( "DELETE FROM {$wpdb->prefix}icl_string_positions WHERE string_id IN ({$str})" );
}