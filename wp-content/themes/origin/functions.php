<?php

// Add RSS links to <head> section
automatic_feed_links();

// Load jQuery
if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("http://localhost/cya-wp/wp-includes/js/jquery/jquery.js?ver=1.11.1"), false);
    wp_enqueue_script('jquery');
}

// Clean up the <head>
function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}

add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

// Declare sidebar widget zone
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Sidebar Widgets',
        'id' => 'sidebar-widgets',
        'description' => 'These are widgets for the sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
}
add_theme_support('post-thumbnails');

function wp_services_() {
    register_post_type(
            "services", array(
        'labels' => array(
            'add_new' => 'Add New',
            'name' => __('Services'),
            'singular_name' => __("Service"),
            'all_items' => __("All"),
            'add_new_item' => __("Add"),
            'edit_item' => __("Edit")),
        'public' => true,
        'show_ui' => true,
        'hierarchical' => true,
        'supports' => array('title', 'editor', 'excerpt', 'page-attributes', 'thumbnail'),)
    );
}

add_action('init', 'wp_services_');

function wp_testimonial_() {
    register_post_type(
            "testimonial", array(
        'labels' => array(
            'add_new' => 'Add New',
            'name' => __('Testimonial'),
            'singular_name' => __("Testimonial"),
            'all_items' => __("All"),
            'add_new_item' => __("Add"),
            'edit_item' => __("Edit")),
        'public' => true,
        'show_ui' => true,
        'hierarchical' => true,
        'supports' => array('title', 'editor', 'excerpt', 'page-attributes', 'thumbnail'),)
    );
}

add_action('init', 'wp_testimonial_');


function wp_supplier_() {
    register_post_type(
            "supplier", array(
        'labels' => array(
            'add_new' => 'Add New',
            'name' => __('Supplier'),
            'singular_name' => __("Supplier"),
            'all_items' => __("All"),
            'add_new_item' => __("Add"),
            'edit_item' => __("Edit")),
        'public' => true,
        'show_ui' => true,
        'hierarchical' => true,
        'supports' => array('title', 'editor', 'excerpt', 'page-attributes', 'thumbnail'),)
    );
}

add_action('init', 'wp_supplier_');

include ABSPATH . 'wp-content/themes/origin/widgets/Services.php';
include ABSPATH . 'wp-content/themes/origin/widgets/Testimonial.php';
include ABSPATH . 'wp-content/themes/origin/widgets/Supplier.php';
?>