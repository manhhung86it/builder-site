<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * WP Header
 *
 */
add_action( 'wp_head', 'a3_portfolio_header_meta', 4 );

/**
 * Category Before
 *
 */
add_action( 'a3_portfolio_before_template_part', 'a3_portfolio_term_description' );

/**
 * Before Main Content
 *
 */
add_action( 'a3_portfolio_before_main_content', 'a3_portfolio_nav_bar', 10 );

/**
 * Before Main Loop
 *
 */
add_action( 'a3_portfolio_before_main_loop', 'a3_portfolio_main_query', 10 );

/**
 * After Main Loop
 *
 */
add_action( 'a3_portfolio_after_main_loop', 'a3_portfolio_get_portfolios_uncategorized', 10 );

/**
 * Before Category Content
 *
 */
add_action( 'a3_portfolio_before_category_content', 'a3_portfolio_category_nav_bar', 10 );

/**
 * Before Tag Content
 *
 */
add_action( 'a3_portfolio_before_tag_content', 'a3_portfolio_tag_nav_bar', 10 );

/**
 * Before Expander Item Content
 *
 */
add_action( 'a3_portfolio_before_item_expander_content', 'a3_portfolio_get_entry_metas', 5 );
add_action( 'a3_portfolio_before_item_expander_content', 'a3_portfolio_get_social_icons', 10 );
add_action( 'a3_portfolio_before_item_expander_content', 'a3_portfolio_get_item_feature_data', 20 );

/**
 * After Expander Item Content
 *
 */
add_action( 'a3_portfolio_after_item_expander_content', 'a3_portfolio_get_categories_meta', 5 );
add_action( 'a3_portfolio_after_item_expander_content', 'a3_portfolio_get_tags_meta', 10 );
add_action( 'a3_portfolio_after_item_expander_content', 'a3_portfolio_get_launch_button', 20 );

 /**
 * Footer
 *
 */
?>