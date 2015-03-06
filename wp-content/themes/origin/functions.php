<?php

// Add RSS links to <head> section
automatic_feed_links();

// Load jQuery
if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', (get_stylesheet_directory_uri() . "/js/jquery.js"), false);
    wp_enqueue_script('jquery');
}

function wpbootstrap_scripts_with_jquery() {
    // Register the script like this for a theme:
    wp_register_script('custom-script', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script('custom-script');
}

add_action('wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery');

function magnific_scripts_with_jquery() {
    // Register the script like this for a theme:
    wp_register_script('magnific-script', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array('jquery'));
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script('magnific-script');
}

add_action('wp_enqueue_scripts', 'magnific_scripts_with_jquery');

function wpslider_scripts_with_jquery() {
    // Register the script like this for a theme:
    wp_register_script('slider-script', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'));
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script('slider-script');
}

add_action('wp_enqueue_scripts', 'wpslider_scripts_with_jquery');

function wpslider_options_scripts_with_jquery() {
    // Register the script like this for a theme:
    wp_register_script('slider-options', get_template_directory_uri() . '/js/slider-options.js', array('jquery'));
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script('slider-options');
}

add_action('wp_enqueue_scripts', 'wpslider_options_scripts_with_jquery');

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

    register_sidebar(array(
        'name' => __('Home Sidebar - Top', 'pm'),
        'id' => 'sidebar-home-top',
        'description' => __('Appears on home page', 'pm'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Home Sidebar - Middle', 'pm'),
        'id' => 'sidebar-home',
        'description' => __('Appears on home page', 'pm'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Newletter - bottom', 'pm'),
        'id' => 'newletter-bottom',
        'description' => __('Appears on about page', 'pm'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Contact Sidebar - Top', 'pm'),
        'id' => 'sidebar-contact',
        'description' => __('Appears on contact page', 'pm'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('About Sidebar - Top', 'pm'),
        'id' => 'sidebar-about',
        'description' => __('Appears on about page', 'pm'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Service Sidebar - Top', 'pm'),
        'id' => 'service-wg',
        'description' => __('Appears on service page', 'pm'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Suppliers Sidebar - Top', 'pm'),
        'id' => 'supplier-wg',
        'description' => __('Appears on supplier page', 'pm'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Testimonials Sidebar - Top', 'pm'),
        'id' => 'testimonials-wg',
        'description' => __('Appears on testimonials page', 'pm'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));   
    register_sidebar(array(
        'name' => __('Gallery Sidebar - Top', 'pm'),
        'id' => 'gallery-wg',
        'description' => __('Appears on gallery page', 'pm'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));   
}
add_theme_support('post-thumbnails');
add_theme_support('custom-header');

// add class active to menu
add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

function special_nav_class($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'menu-cya-menu-active';
    }
    return $classes;
}

// add second menu
register_nav_menus(array(
    'primary' => __('Primary Menu', 'origin'),
    'secondary' => __('Secondary Menu', 'origin'),
));

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

function wp_abouttop_() {
    register_post_type(
            "abouttop", array(
        'labels' => array(
            'add_new' => 'Add New',
            'name' => __('Abouttop'),
            'singular_name' => __("Abouttop"),
            'all_items' => __("All"),
            'add_new_item' => __("Add"),
            'edit_item' => __("Edit")),
        'public' => true,
        'show_ui' => true,
        'hierarchical' => true,
        'supports' => array('title', 'editor', 'excerpt', 'page-attributes', 'thumbnail'),)
    );
}

add_action('init', 'wp_abouttop_');

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

class CSS_Menu_Maker_Walker extends Walker {

    var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        global $wp_query;
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        /* Check for children */
        $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
        if (!empty($children)) {
            $classes[] = 'has-sub';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '><span>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</span></a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }

}

require_once ( get_template_directory() . '/theme-options.php' );
include ABSPATH . 'wp-content/themes/origin/widgets/Services.php';
include ABSPATH . 'wp-content/themes/origin/widgets/Testimonial.php';
include ABSPATH . 'wp-content/themes/origin/widgets/Abouttop.php';
include ABSPATH . 'wp-content/themes/origin/widgets/Supplier.php';
include ABSPATH . 'wp-content/themes/origin/widgets/ShortText.php';
?>