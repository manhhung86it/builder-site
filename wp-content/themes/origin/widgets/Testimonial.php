<?php

class WP_Testimonial extends WP_Widget {

    var $image_field = 'image';  // the image field ID
    var $image_bg_field = 'image_bg';  // the image field ID

    public function __construct() {
        parent::__construct(
                'WP_Testimonial', // Base ID
                'Home Testimonial', // Name
                array('description' => 'Show all testimonial on home page')
        );
    }
    

}

add_action('widgets_init', create_function('', 'register_widget( "WP_Testimonial" );'));
