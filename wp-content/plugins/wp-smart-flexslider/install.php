<?php 
/*
Plugin Name: WP Smart Flexslider
Author: <strong>Rajan V, A2Z Technologies</strong>
Version: 1.0.1
Description: This is Flex Slider plugin. Its use Bootstrap 3x Themes to create easy Sliders.
*/

/*  Copyright 2007-2014 Rajan V (email: ratanit2000 at gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
ob_start();
session_start();
add_action('init', 'initial');

function initial(){
	$labels = array(
	'name' => _x('Flexsliders', 'post type general name', ''),
	'singular_name' => _x('Flexslider', 'post type singular name', ''),
	'add_new' => _x('Add New', 'print', ''),
	'add_new_item' => __('Add New Flexslider', ''),
	'edit_item' => __('Edit Flexslider', ''),
	'new_item' => __('New Flexslider', ''),
	'all_items' => __('All Flexsliders', ''),
	'view_item' => __('View Flexslider', ''),
	'search_items' => __('Search Flexsliders', ''),
	'not_found' =>  __('No flexsliders found', ''),
	'not_found_in_trash' => __('No flexsliders found in Trash', ''), 
	'parent_item_colon' => '',
	'menu_name' => __('Flexsliders', '')
	);
	$args = array(
	'labels' => $labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'show_in_menu' => true, 
	'query_var' => true,
	'capability_type' => 'post',
	'has_archive' => true, 
	'hierarchical' => false,
	'menu_position' => null,
	'menu_icon' => plugins_url( 'wp-smart-flexslider/images/flexslider.png'),
	'supports' =>array( 'title', 'editor', 'thumbnail' )
	); 
	register_post_type('flexslider', $args);
	
}

add_action('admin_menu', 'my_plugin_menu');

function my_plugin_menu() {
	add_options_page('Flexslider Settings', 'Flexslider Settings', 'manage_options', 'flexslider_settings.php', 'flexslider_settings_page');
}
function flexslider_settings_page(){
	include "flexslider_settings_page.php";
}

add_action( 'admin_init', 'flex_options_init' );
function flex_options_init(){
	register_setting( 'flexslider_opt', 'flexslider_options' );
}

function display_flexslider_func( $atts ) {
	$options = get_option( 'flexslider_options' );
	?>
    <div id="carousel-banner" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            global $post; $i = 1;
            $args = array( 'numberposts' => $options['number_slides'], 'post_type' => 'flexslider' );
            $myposts = get_posts( $args );
            foreach( $myposts as $post ) { setup_postdata($post); ?>
            <div class="item <?php if($i == 1){?> active <?php $i++; }?>">
                <?php the_post_thumbnail( 'full' );?>
                <div class="carousel-caption">
                    <?php the_content();?>
                </div>
            </div>
            <?php }?>
        </div>
        <?php if( $options['nav_controls'] == "Yes" ){?>
        <ol class="carousel-indicators">
            <?php
            global $post; $i = 0;
            $args = array( 'numberposts' => $options['number_slides'], 'post_type' => 'flexslider' );
            $myposts = get_posts( $args );
            foreach( $myposts as $post ) { setup_postdata($post); ?>
            <li data-target="#carousel-banner" data-slide-to="<?php echo $i;?>" class="<?php if($i == 0){?> active <?php $i++; }?>"></li>
            <?php }?>
        </ol>
        <?php }?>
        <?php if( $options['direction_controls'] == "Yes" ){?>
        <a class="left carousel-control" href="#carousel-banner" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-banner" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
        <?php }?>
    </div>
    <?php
}
add_shortcode('display_flexslider', 'display_flexslider_func');

?>