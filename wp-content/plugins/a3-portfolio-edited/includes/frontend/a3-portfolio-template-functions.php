<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * a3_portfolio_get_css_file_url( $file )
 *
 * @param $file string filename
 * @return URL to the file
 */
function a3_portfolio_get_css_file_url( $file = '' ) {
	// If we're not looking for a file, do not proceed
	if ( empty( $file ) )
		return;

	// Look for file in stylesheet
	if ( file_exists( get_stylesheet_directory() . '/portfolios/' . $file ) ) {
		$file_url = get_stylesheet_directory_uri() . '/portfolios/' . $file;

	// Look for file in stylesheet
	} elseif ( file_exists( get_stylesheet_directory() . '/' . $file ) ) {
		$file_url = get_stylesheet_directory_uri() . '/' . $file;

	// Look for file in template
	} elseif ( file_exists( get_template_directory() . '/portfolios/' . $file ) ) {
		$file_url = get_template_directory_uri() . '/portfolios/' . $file;

	// Look for file in template
	} elseif ( file_exists( get_template_directory() . '/' . $file ) ) {
		$file_url = get_template_directory_uri() . '/' . $file;

	// Backwards compatibility
	} else {
		$file_url = A3_PORTFOLIO_CSS_URL. '/' . $file;
	}

	$file_url = str_replace( array( 'http:', 'https:' ), '', $file_url );

	return apply_filters( 'a3_portfolio_get_css_file_url', $file_url, $file );
}

/**
 * Get templates passing attributes and including the file.
 *
 * @access public
 * @param string $template_name
 * @param array $args (default: array())
 * @return void
 */
function a3_portfolio_get_template( $template_name, $args = array() ) {
	if ( $args && is_array( $args ) ) {
		extract( $args );
	}

	$template_file_path = a3_portfolio_get_template_file_path( $template_name );

	if ( ! file_exists( $template_file_path ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file_path ), '1.0.0' );
		return;
	}

	// Allow 3rd party plugin filter template file from their plugin
	$template_file_path = apply_filters( 'a3_portfolio_get_template', $template_file_path, $template_name, $args );

	do_action( 'a3_portfolio_before_template_part', $template_name, $template_file_path, $args );

	include( $template_file_path );

	do_action( 'a3_portfolio_after_template_part', $template_name, $template_file_path, $args );
}

/**
 * a3_portfolio_get_template_file_path( $file )
 *
 * This is the load order:
 *
 *		yourtheme					/	portfolio	/	$file
 *		yourtheme					/	$file
 *		A3_PORTFOLIO_TEMPLATE_PATH	/	$file
 *
 * @access public
 * @param $file string filename
 * @return PATH to the file
 */
function a3_portfolio_get_template_file_path( $file = '' ) {
	// If we're not looking for a file, do not proceed
	if ( empty( $file ) )
		return;

	// Look for file in stylesheet
	if ( file_exists( get_stylesheet_directory() . '/portfolios/' . $file ) ) {
		$file_path = get_stylesheet_directory() . '/portfolios/' . $file;

	// Look for file in stylesheet
	} elseif ( file_exists( get_stylesheet_directory() . '/' . $file ) ) {
		$file_path = get_stylesheet_directory() . '/' . $file;

	// Look for file in template
	} elseif ( file_exists( get_template_directory() . '/portfolios/' . $file ) ) {
		$file_path = get_template_directory() . '/portfolios/' . $file;

	// Look for file in template
	} elseif ( file_exists( get_template_directory() . '/' . $file ) ) {
		$file_path = get_template_directory() . '/' . $file;

	// Get default template
	} else {
		$file_path = A3_PORTFOLIO_TEMPLATE_PATH . '/' . $file;
	}

	// Return filtered result
	return apply_filters( 'a3_portfolio_get_template_file_path', $file_path, $file );
}

/**
 * a3_portfolio_get_per_page()
 *
 * @return number
 */
function a3_portfolio_get_per_page() {
	$post_per_page = -1;
	return apply_filters( 'a3_portfolio_get_per_page', $post_per_page );
}

/**
 * a3_portfolio_get_col_per_row()
 *
 * @return number
 */
function a3_portfolio_get_col_per_row() {
	global $a3_portfolio_global_settings;
	$number_columns = 3;
	if ( $a3_portfolio_global_settings['portfolio_items_per_row'] >= 1 ) {
		$number_columns = $a3_portfolio_global_settings['portfolio_items_per_row'];
	}
	return apply_filters( 'a3_portfolio_get_col_per_row', $number_columns );
}

/**
 * is_viewing_portfolio_taxonomy()
 *
 * @return boolean
 */
function is_viewing_portfolio_taxonomy(){
	global $wp_query;
	$wp_query->posts_per_page = 1;
	$is_viewing = false;
	if ( ( isset( $wp_query->query_vars['taxonomy'] ) && 'portfolio_cat' == $wp_query->query_vars['taxonomy'] ) || isset( $wp_query->query_vars['portfolio_cat'] ) || isset( $wp_query->query_vars['portfolio_tag'] ) ) {
		$is_viewing = true;
	}

	return apply_filters( 'is_viewing_portfolio_taxonomy', $is_viewing );
}

/**
 * a3_portfolio_expander_template()
 *
 * @return html ouput
 */
function a3_portfolio_expander_template() {
	$expander_template = '
<div class="a3-portfolio-expander-popup">
	<div class="a3-portfolio-controller">
		<div class="closebutton"><i class="a3-portfolio-icon-close"></i></div>
	</div>
	<div style="clear:both;"></div>
	<div class="inner a3-portfolio-inner-container">
		<div class="a3-portfolio-inner-wrap">
		</div>
	</div>
	<div class="closebutton"><i class="a3-portfolio-icon-close"></i></div>
</div>';

	return $expander_template = apply_filters( 'a3_portfolio_expander_template', $expander_template );
}

/**
 * a3_portfolio_header_meta()
 *
 * @return html ouput
 */
function a3_portfolio_header_meta() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
}

/**
 * a3_portfolio_term_description()
 *
 * @return html ouput
 */
function a3_portfolio_term_description() {
	global $wp_query;
	$term_desc = '';
	if ( isset( $wp_query->query_vars['portfolio_cat'] ) || isset($wp_query->query_vars['portfolio_tag'] ) ) {
		if ( isset( $wp_query->query_vars['portfolio_cat'] ) ) {
			if ( term_description() ) {
				$term_desc = '<div class="porfolio-term-description">'.term_description().'</div>';
			}
		}
		if ( isset( $wp_query->query_vars['portfolio_tag'] ) ) {
			$category = get_term_by('slug',$wp_query->query_vars['portfolio_tag'],'portfolio_tag');
			if ( $category->description ) {
				$term_desc = '<div class="porfolio-term-description"><p>'.$category->description.'</p></div>';
			}
		}
	}

	echo apply_filters( 'a3_portfolio_term_description', $term_desc );
}

/**
 * a3_portfolio_nav_bar()
 *
 * @return void
 */
function a3_portfolio_nav_bar() {

	$menus = array();
	$top_cats = a3_portfolio_get_parent_category_visiable();
	if ( ! empty( $top_cats ) && ! is_wp_error( $top_cats ) ) {
		foreach ( $top_cats as $term ) {
			$menus[$term->slug] = $term->name;
		}
	}

	a3_portfolio_get_template( 'navbar/main-navbar.php', array( 'menus' => $menus ) );
}

/**
 * a3_portfolio_category_nav_bar()
 *
 * @return void
 */
function a3_portfolio_category_nav_bar( $term_id = null ) {
	if ( is_tax( 'portfolio_cat' ) ) {
		$term = get_term_by( 'slug', get_query_var('portfolio_cat'), 'portfolio_cat' );
		$term_id = $term->term_id;
	}

	$args = array(
		'parent' 		=> $term_id,
		'child_of'		=> $term_id,
		'menu_order'	=> 'ASC',
		'hide_empty'	=> 1,
		'hierarchical'	=> 1,
		'taxonomy'		=> 'portfolio_cat',
		'pad_counts'	=> 1
	);
	$menus = get_categories( $args );
	if ( ! $menus || ! is_array( $menus ) || count( $menus ) < 1 ) {
		$menus = false;
	}

	a3_portfolio_get_template( 'navbar/category-navbar.php', array( 'menus' => $menus ) );
}

/**
 * a3_portfolio_tag_nav_bar()
 *
 * @return void
 */
function a3_portfolio_tag_nav_bar() {

	$menus = array();
	$all_cats = a3_portfolio_get_all_categories_visiable();
	if ( ! empty( $all_cats ) && ! is_wp_error( $all_cats ) ) {
		foreach ( $all_cats as $term ) {
			$menus[$term->slug] = $term->name;
		}
	}

	a3_portfolio_get_template( 'navbar/tag-navbar.php', array( 'menus' => $menus ) );
}

/**
 * a3_portfolio_main_query()
 *
 * @return void
 */
function a3_portfolio_main_query() {
	global $wp_query;

	$top_cat_ids = array_keys( a3_portfolio_get_parent_category_visiable() );

	// Just get portfolio of parent category
	$wp_query->query_vars['tax_query'] = array(
		array(
			'taxonomy'         => 'portfolio_cat',
			'field'            => 'id',
			'terms'            => $top_cat_ids,
			'include_children' => false,
			'operator'         => 'IN'
		)
	);

	$wp_query = new WP_Query( $wp_query->query_vars );
}

/**
 * a3_portfolio_get_portfolios_uncategorized()
 *
 * @return void
 */
function a3_portfolio_get_portfolios_uncategorized() {
	a3_portfolio_main_uncategorized_query();

	while ( have_posts() ) : the_post();

		a3_portfolio_get_template( 'content-portfolio.php' );

	endwhile;
}

/**
 * a3_portfolio_main_uncategorized_query()
 *
 * @return void
 */
function a3_portfolio_main_uncategorized_query() {
	global $wp_query;

	$all_cat_ids = array_keys( a3_portfolio_get_all_categories() );

	// Just get portfolio of parent category
	$wp_query->query_vars['tax_query'] = array(
		array(
			'taxonomy'         => 'portfolio_cat',
			'field'            => 'id',
			'terms'            => $all_cat_ids,
			'include_children' => false,
			'operator'         => 'NOT IN'
		)
	);

	$wp_query = new WP_Query( $wp_query->query_vars );
}

/**
 * a3_portfolio_get_image_blank()
 *
 * @return void
 */
function a3_portfolio_get_image_blank() {
	$image_blank = A3_PORTFOLIO_IMAGES_URL . '/_blank.gif';

	return apply_filters( 'a3_portfolio_get_image_blank', $image_blank );
}


/**
 * a3_portfolio_card_get_first_thumb_image()
 *
 * @return void
 */
function a3_portfolio_card_get_first_thumb_image( $portfolio_id = 0, $gallery = array(), $echo = true ) {
	if ( $portfolio_id < 1 ) {
		$portfolio_id = get_the_ID();
	}

	$_blank = a3_portfolio_get_image_blank();

	$main_thumb_image = '';
	if ( $gallery ) {
		$thumb_url = wp_get_attachment_image_src( $gallery[0], 'a3-portfolio', true );
		if ( $thumb_url && $thumb_url[0] != '' ) {
			$main_thumb_image = '<img class="a3-portfolio-thumb-lazy attachment-a3-portfolio wp-post-image" src="'.$_blank.'" data-original="'.$thumb_url[0].'" />';
		}
	}

	if ( trim( $main_thumb_image ) == '' ) {
		$main_thumb_image = '<img class="a3-portfolio-thumb-lazy no-thumb" src="'.$_blank.'" data-original="' . a3_portfolio_no_image() . '" />';
	}

	$main_thumb_image = apply_filters( 'a3_portfolio_card_get_first_thumb_image', $main_thumb_image, $portfolio_id );

	if ( $echo ) {
		echo $main_thumb_image;
	} else {
		return $main_thumb_image;
	}
}

/**
 * a3_portfolio_get_first_thumb_image_url()
 *
 * @return void
 */
function a3_portfolio_get_first_thumb_image_url( $portfolio_id = 0, $gallery = array(), $echo = true ) {
	if ( $portfolio_id < 1 ) {
		$portfolio_id = get_the_ID();
	}

	$_blank = a3_portfolio_get_image_blank();

	$main_thumb_image = '';
	if ( $gallery ) {
		$thumb_url = wp_get_attachment_image_src( $gallery[0], 'a3-portfolio', true );
		if ( $thumb_url && $thumb_url[0] != '' ) {
			$main_thumb_image = $thumb_url[0];
		}
	}

	if ( trim( $main_thumb_image ) == '' ) {
		$main_thumb_image = a3_portfolio_no_image();
	}

	$main_thumb_image = apply_filters( 'a3_portfolio_get_first_thumb_image_url', $main_thumb_image, $portfolio_id );

	if ( $echo ) {
		echo $main_thumb_image;
	} else {
		return $main_thumb_image;
	}
}

/**
 * a3_portfolio_card_get_item_title()
 *
 * @return void
 */
function a3_portfolio_card_get_item_title( $portfolio_id = 0, $echo = true ) {
	global $a3_portfolio_global_settings;

	if ( $portfolio_id < 1 ) {
		$portfolio_id = get_the_ID();
	}

	$title_class = 'a3-portfolio-card-overlay';
	if ( isset( $a3_portfolio_global_settings['cards_title_type'] ) && $a3_portfolio_global_settings['cards_title_type'] == 'under' ) {
		$title_class = 'a3-portfolio-card-title-under';
	}
	$title_class = apply_filters('a3_portfolio_cards_title_class', $title_class );

	$item_title = sprintf( '<div class="%s"><h3>'.get_the_title( $portfolio_id ).'</h3></div>', $title_class );

	$item_title = apply_filters( 'a3_portfolio_card_get_item_title', $item_title, $portfolio_id );

	if ( $echo ) {
		echo $item_title;
	} else {
		return $item_title;
	}
}

/**
 * a3_portfolio_get_large_image_container()
 *
 * @return void
 */
function a3_portfolio_get_large_image_container( $portfolio_id = 0, $gallery ) {
	if ( $portfolio_id < 1 ) {
		$portfolio_id = get_the_ID();
	}

	a3_portfolio_get_template( 'expander/large-image-container.php', array( 'portfolio_id' => $portfolio_id, 'gallery' => $gallery ) );
}

/**
 * a3_portfolio_get_first_large_image()
 *
 * @return void
 */
function a3_portfolio_get_first_large_image( $gallery = array(), $echo = true ) {
	$_blank = a3_portfolio_get_image_blank();

	$main_large_image = '';
	if ( $gallery ) {
		$large_url = wp_get_attachment_image_src( $gallery[0], 'full', true );
		if ( $large_url && $large_url[0] != '' ) {
			$the_caption = get_post_field( 'post_excerpt', $gallery[0] );
			$main_large_image = '<img class="a3-portfolio-large-lazy portfolio_image" src="'.$_blank.'" data-original="'.$large_url[0].'" data-caption="'.$the_caption.'" />';
		}
	}

	if ( trim( $main_large_image ) == '' ) {
		$main_large_image = '<img class="a3-portfolio-large-lazy no-thumb" src="'.$_blank.'" data-original="' . a3_portfolio_no_image('no-image-large.png') . '" />';
	}

	$main_large_image = apply_filters( 'a3_portfolio_get_first_large_image', $main_large_image );

	if ( $echo ) {
		echo $main_large_image;
	} else {
		return $main_large_image;
	}
}

/**
 * a3_portfolio_get_entry_metas()
 *
 * @return void
 */
function a3_portfolio_get_entry_metas( $portfolio_id = 0 ) {
	if ( $portfolio_id < 1 ) {
		$portfolio_id = get_the_ID();
	}

	a3_portfolio_get_template( 'expander/entry-metas.php', array( 'portfolio_id' => $portfolio_id ) );
}

/**
 * a3_portfolio_get_social_icons()
 *
 * @return void
 */
function a3_portfolio_get_social_icons( $portfolio_id = 0 ) {
	if ( $portfolio_id < 1 ) {
		$portfolio_id = get_the_ID();
	}

	a3_portfolio_get_template( 'expander/social-icons.php', array( 'portfolio_id' => $portfolio_id ) );
}

/**
 * a3_portfolio_get_item_feature_data()
 *
 * @return void
 */
function a3_portfolio_get_item_feature_data( $portfolio_id = 0 ) {
	if ( $portfolio_id < 1 ) {
		$portfolio_id = get_the_ID();
	}

	global $a3_portfolio_feature_data;
	$portfolio_features = $a3_portfolio_feature_data->get_all_features();

	a3_portfolio_get_template( 'expander/feature-data.php', array( 'portfolio_id' => $portfolio_id, 'portfolio_features' => $portfolio_features ) );
}

/**
 * a3_portfolio_get_gallery_thumbs()
 *
 * @return void
 */
function a3_portfolio_get_gallery_thumbs( $portfolio_id = 0, $gallery ) {
	if ( $portfolio_id < 1 ) {
		$portfolio_id = get_the_ID();
	}

	$image_blank = a3_portfolio_get_image_blank();

	a3_portfolio_get_template( 'expander/gallery-thumbs.php', array( 'portfolio_id' => $portfolio_id, 'gallery' => $gallery, 'image_blank' => $image_blank ) );
}

/**
 * a3_portfolio_get_categories_meta()
 *
 * @return void
 */
function a3_portfolio_get_categories_meta( $portfolio_id = 0 ) {
	if ( $portfolio_id < 1 ) {
		$portfolio_id = get_the_ID();
	}

	$portfolio_terms = get_the_terms( $portfolio_id, 'portfolio_cat' );

	a3_portfolio_get_template( 'expander/categories-meta.php', array( 'portfolio_categories' => $portfolio_terms ) );
}

/**
 * a3_portfolio_get_tags_meta()
 *
 * @return void
 */
function a3_portfolio_get_tags_meta( $portfolio_id = 0 ) {
	if ( $portfolio_id < 1 ) {
		$portfolio_id = get_the_ID();
	}

	$portfolio_tags = get_the_terms( $portfolio_id, 'portfolio_tag' );

	a3_portfolio_get_template( 'expander/tags-meta.php', array( 'portfolio_tags' => $portfolio_tags ) );
}

/**
 * a3_portfolio_get_launch_button()
 *
 * @return void
 */
function a3_portfolio_get_launch_button( $portfolio_id = 0 ) {
	if ( $portfolio_id < 1 ) {
		$portfolio_id = get_the_ID();
	}

	$button_class = 'portfolio_button';
	$button_text  = get_post_meta( $portfolio_id, '_a3_portfolio_launch_button_text', true );
	$button_link  = get_post_meta( $portfolio_id, '_a3_portfolio_launch_site_url', true );
	$open_type    = get_post_meta( $portfolio_id, '_a3_portfolio_launch_open_type', true );

	if ( empty( $button_text ) || $button_text == '' ) {
		$button_text = a3_portfolio_ei_ict_t__( 'Launch Site Button Text', __( 'LAUNCH SITE', 'a3_portfolios' ) );
	}

	$button_class = apply_filters( 'a3_portfolio_launch_button_class', $button_class, $portfolio_id );
	$button_text  = apply_filters( 'a3_portfolio_launch_button_text', $button_text, $portfolio_id );
	$button_link  = apply_filters( 'a3_portfolio_launch_site_url', $button_link, $portfolio_id );
	$open_type    = apply_filters( 'a3_portfolio_launch_open_type', $open_type, $portfolio_id );

	a3_portfolio_get_template( 'expander/launch-button.php', array( 'launch_site_url' => $button_link, 'button_text' => $button_text, 'open_type' => $open_type, 'button_class' => $button_class ) );
}

?>
