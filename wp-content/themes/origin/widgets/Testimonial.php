<?php

class WP_Testimonial extends WP_Widget {

    var $image_bg_field = 'image_bg';  // the image field ID

    public function __construct() {
        parent::__construct(
                'WP_Testimonial', // Base ID
                'Home Testimonial', // Name
                array('description' => 'Show list testimonial on home page')
        );
    }

    public function widget($args, $instance) {
        extract($args);
        $image_id = $instance[$this->image_bg_field];
        $image = new WidgetImageField($this, $image_id);
        $tmp = $image->get_image_src('full');
        $style = 'style="background: url(\''.$tmp.'\') no-repeat center center; -webkit-background-size: 100%; -moz-background-size: 100%; -o-background-size: 100%; background-size: 100%;"';
        
        $posts = get_posts(array(
            'posts_per_page' => $instance['number'],
            'post_type' => 'testimonial',
            'meta_key' => 'show_on_homepage',
            'meta_value' => 1
        ));
        if ($posts) {
            $list_testimonial = '<div class="testimonials-box"  '.$style.'>'
                    . '<div class="mainslider">'
                    . '<ul class="slides group">';

            foreach ($posts as $post) {
                $list_testimonial .='<li>'
                        . get_the_post_thumbnail($post->ID, 'thumbnail')
                        . '<div class="slider-content">'
                        . '<div class="slider-title">' . $post->customer_name . '</div>';
                if (strlen($post->post_content) >= 200) {
                    $list_testimonial .= '<span>' . substr( strip_tags($post->post_content), 0, 200) . '</span>';
                    $list_testimonial .= '<a class=\'more-link\' href="'.get_site_url().'/testimonials">...read more</a>';
                } else {
                    $list_testimonial .= '<span>' . $post->post_content . '</span>';
                }
                $list_testimonial .= '</div>'
                        . '</li>';
            }

            $list_testimonial .='</ul>'
                    . '</div>'
                    . '</div>';
            echo $list_testimonial;
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance[$this->image_bg_field] = intval(strip_tags($new_instance[$this->image_bg_field]));
        $instance['number'] = $new_instance['number'];
        return $instance;
    }

    public function form($instance) {
        if (empty($instance['title'])) {
            $title = '';
        } else {
            $title = $instance['title'];
        }
        $image_bg_id = esc_attr(isset($instance[$this->image_bg_field]) ? $instance[$this->image_bg_field] : 0 );
        $image_bg = new WidgetImageField($this, $image_bg_id);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <div id="div_background_image">
            <label><?php _e('Background Image:'); ?></label>
            <?php echo $image_bg->get_widget_field('bg_image', 'bg'); ?>
        </div>

        <p id="div_number">
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of testimonials to show:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($instance['number']); ?>" />
        </p>

        <?php
    }

}

add_action('widgets_init', create_function('', 'register_widget( "WP_Testimonial" );'));
