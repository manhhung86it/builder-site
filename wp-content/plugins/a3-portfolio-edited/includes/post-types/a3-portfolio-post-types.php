<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class A3_Portfolio_Post_Types
{
	public function __construct() {

		if ( is_admin() ) {
			/* START : Update the columns for Portfolio post type */

			// Add sortable for custom column
			add_action( 'restrict_manage_posts', array( $this, 'cats_restrict_manage_posts' ) );
			add_filter( 'parse_query', array( $this, 'a3_portfolio_filters_query' ) );

			// Add custom column for Portfolio post type
			add_filter( 'manage_edit-a3-portfolio_columns', array( $this, 'edit_columns' ) );
			add_filter( 'manage_a3-portfolio_posts_columns', array( $this, 'edit_columns' ) );
			add_action( 'manage_a3-portfolio_posts_custom_column', array( $this, 'custom_columns' ) );

			/* END : Update the columns for Portfolio post type */
		}
	}

	public function register_post_type() {

		// Register custom taxonomy
		register_taxonomy( 'portfolio_cat',
				array( 'a3-portfolio' ),
				apply_filters( 'a3_portfolio_register_cat_agrs', array(
					'hierarchical' 			=> true,
					'update_count_callback' => '_update_post_term_count',
					'label' 				=> __( 'Categories', 'a3_portfolios'),
					'labels' => array(
							'name' 				=> __( 'Portfolio Categories', 'a3_portfolios'),
							'singular_name' 	=> __( 'Portfolio Categories', 'a3_portfolios'),
							'search_items' 		=> __( 'Search Portfolio Categories', 'a3_portfolios'),
							'menu_name'			=> __( 'Categories', 'a3_portfolios' ),
							'popular_items'		=> NULL,
							'parent_item'		=> __( 'Parent Portfolio Categories', 'a3_portfolios'),
							'parent_item_colon'	=> __( 'Parent Portfolio Categories:', 'a3_portfolios'),
							'all_items' 		=> __( 'All Portfolio Categories', 'a3_portfolios'),
							'edit_item' 		=> __( 'Edit Portfolio Categories', 'a3_portfolios'),
							'update_item' 		=> __( 'Update Portfolio Categories', 'a3_portfolios'),
							'add_new_item' 		=> __( 'Add New Portfolio Category', 'a3_portfolios'),
							'new_item_name' 	=> __( 'New Portfolio Categories Name', 'a3_portfolios')
					),
					'show_ui' 				=> true,
					'query_var' 			=> true,
					'rewrite' 				=> array(  'slug' => 'portfolio-category', 'with_front' => false, 'hierarchical' => false ),
				) )
		);

		// Register custom taxonomy
		register_taxonomy( 'portfolio_tag',
	        array( 'a3-portfolio' ),
			apply_filters( 'a3_portfolio_register_tag_agrs', array(
	            'hierarchical' 			=> false,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> __( 'Tags', 'a3_portfolios' ),
	            'labels' => array(
	                    'name' 				=> __( 'Portfolio Tags', 'a3_portfolios' ),
	                    'singular_name' 	=> __( 'Portfolio Tag', 'a3_portfolios' ),
						'menu_name'			=> _x( 'Tags', 'Admin menu name', 'a3_portfolios' ),
	                    'search_items' 		=> __( 'Search Portfolio Tags', 'a3_portfolios' ),
	                    'all_items' 		=> __( 'All Portfolio Tags', 'a3_portfolios' ),
	                    'parent_item' 		=> __( 'Parent Portfolio Tag', 'a3_portfolios' ),
	                    'parent_item_colon' => __( 'Parent TPortfolio ag:', 'a3_portfolios' ),
	                    'edit_item' 		=> __( 'Edit Portfolio Tag', 'a3_portfolios' ),
	                    'update_item' 		=> __( 'Update Portfolio Tag', 'a3_portfolios' ),
	                    'add_new_item' 		=> __( 'Add New Portfolio Tag', 'a3_portfolios' ),
	                    'new_item_name' 	=> __( 'New Portfolio Tag Name', 'a3_portfolios' )
	            ),

				'show_ui' 				=> true,
				'query_var' 			=> true,
				'rewrite' 				=> array( 'slug' => 'portfolio-tag', 'with_front' => false, 'hierarchical' => false ),
	        ) )
	    );

		// Register custom post type
		$labels_array = apply_filters( 'a3_portfolio_post_type_labels', array(
							'name'               => __( 'Portfolio Items', 'a3_portfolios'),
							'singular_name'      => __( 'Portfolio Item', 'a3_portfolios'),
							'menu_name'          => __( 'Portfolio', 'a3_portfolios'),
							'all_items'          => __( 'Portfolio Items', 'a3_portfolios'),
							'add_new'            => __( 'Add Item', 'a3_portfolios'),
							'add_new_item'       => __( 'Add New Portfolio', 'a3_portfolios'),
							'edit'               => __( 'Edit', 'a3_portfolios'),
							'edit_item'          => __( 'Edit Item', 'a3_portfolios'),
							'new_item'           => __( 'New Portfolio', 'a3_portfolios'),
							'view'               => __( 'View', 'a3_portfolios'),
							'view_item'          => __( 'View Item', 'a3_portfolios'),
							'search_items'       => __( 'Search Portfolios', 'a3_portfolios'),
							'not_found'          => __( 'No Portfolio Found', 'a3_portfolios'),
							'not_found_in_trash' => __( 'No Portfolio found in Trash', 'a3_portfolios'),
							'parent'             => __( 'Parent', 'a3_portfolios')
							) );

		$supports_array = apply_filters( 'a3_portfolio_post_type_supports', array(
								'title',
								'editor',
								/*'excerpt',*/
								/*'trackbacks',*/
								/*'custom-fields',*/
								/*'comments',*/
								/*'revisions',*/
								'thumbnail',
								/*'author',*/
								'page-attributes'
							   ) );

		register_post_type( 'a3-portfolio',
							apply_filters( 'a3_portfolio_post_type_register', array(
								'description'     => __( 'Portfolios Custom Post Type', 'a3_portfolios'),
								'public'          => true,
								'show_ui'         => true,
								'show_in_menu'    => true,
								'capability_type' => 'post',
								'hierarchical'    => false,
								'rewrite'         => array('slug' => 'a3-portfolio'),
								'query_var'       => true,
								'has_archive'     => false,
								'_builtin'        => false,
								'supports'        => $supports_array,
								'labels'          => $labels_array,
								'supports'        => array('title', 'editor', 'thumbnail', 'author', 'comments', 'date')
								) ) );

		if ( get_option('a3_portfolio_just_installed') == 'yes' ) {
			flush_rewrite_rules();
		}
	}

	/* Custom column for Portfolio post type */
	public function cats_restrict_manage_posts_print_terms( $taxonomy, $parent = 0, $level = 0 ){
		$prefix = str_repeat( '&nbsp;&nbsp;&nbsp;' , $level );
		$terms = get_terms( $taxonomy, array( 'parent' => $parent, 'hide_empty' => false ) );
		if ( !( $terms instanceof WP_Error ) && !empty( $terms ) ) {
			foreach ( $terms as $term ){
				echo '<option value="'. $term->slug . '"', ( isset($_GET[$term->taxonomy]) && $_GET[$term->taxonomy] == $term->slug) ? ' selected="selected"' : '','>' . $prefix . $term->name .' (' . $term->count . ')</option>';
				$this->cats_restrict_manage_posts_print_terms( $taxonomy, $term->term_id, $level+1 );
			}
		}
	}

	public function cats_restrict_manage_posts() {
		global $typenow;
		if ( 'a3-portfolio' == $typenow ) {
			$filters = array( 'portfolio_cat' );

			foreach ( $filters as $tax_slug ) {
				// output html for taxonomy dropdown filter
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>" . __( 'Show all categories', 'a3_portfolios' ) . "</option>";
					$this->cats_restrict_manage_posts_print_terms( $tax_slug );

				$the_query = new WP_Query( array(
					'posts_per_page'	=> 1,
					'post_type'			=> 'a3-portfolio',
					'post_status'		=> array( 'publish', 'pending', 'draft' ),
					'tax_query'		=> array(
						array(
							'taxonomy' => 'portfolio_cat',
	        				'field' => 'id',
							'terms' => get_terms( 'portfolio_cat', array( 'fields' => 'ids' ) ),
							'operator' => 'NOT IN'
						) ),
				) );
				wp_reset_postdata();
				if ( isset( $_GET['portfolio_cat'] ) && $_GET['portfolio_cat'] == '0' ) {
					echo "<option value='0' selected='selected'>" . __( 'Uncategorized', 'a3_portfolios' ) . " (".$the_query->found_posts.")</option>";
				} else {
					echo "<option value='0'>" . __( 'Uncategorized', 'a3_portfolios' ) . " (".$the_query->found_posts.")</option>";
				}
				echo "</select>";
			}


		}
	}

	public function a3_portfolio_filters_query( $query ) {
		global $typenow, $wp_query;

	    if ( 'a3-portfolio' == $typenow ) {

			// Categories
	        if ( isset( $_GET['portfolio_cat'] ) && $_GET['portfolio_cat'] == '0' ) {
	        	$query->query_vars['tax_query'][] = array(
	        		'taxonomy' => 'portfolio_cat',
	        		'field' => 'id',
					'terms' => get_terms( 'portfolio_cat', array( 'fields' => 'ids' ) ),
					'operator' => 'NOT IN'
	        	);
	        }
		}
		return $query;
	}

	public function edit_columns( $columns ) {
		$columns = array();

		$columns['cb'] 				= '<input type="checkbox" />';
		$columns['image'] 			= __( 'Thumbnail', 'a3_portfolios' );
		$columns['title'] 			= __( 'Name', 'a3_portfolios' );
		$columns['cats'] 			= __( 'Categories', 'a3_portfolios' );
		$columns['date'] 			= __( 'Date', 'a3_portfolios' );

		return $columns;
	}

	public function custom_columns( $column ) {
		global $post;

		switch ( $column ) {
			case 'image':
				echo '<a style="display:inline-block;" href="' . get_edit_post_link( $post->ID ) . '">' . a3_portfolio_get_thumbnail_image( $post->ID, array( 40, 40 ) ) . '</a>';
                break;
			case "cats" :
				$terms = get_the_terms( $post->ID, 'portfolio_cat' );
				if ( $terms && ! is_wp_error( $terms ) ) {
					$portfolio_categoriess = array();
					foreach ( $terms as $term ) {
						$portfolio_categoriess[] = "<a href='edit-tags.php?post_type=a3-portfolio&amp;action=edit&amp;taxonomy=portfolio_cat&amp;tag_ID={$term->term_id}'> " . esc_html( $term->name ) . "</a>";
					}
					echo join( ', ', $portfolio_categoriess );
				} else {
					echo '–';
				}
				break;
		}
	}
}

global $a3_portfolio_post_types;
$a3_portfolio_post_types = new A3_Portfolio_Post_Types();
?>
