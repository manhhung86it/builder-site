<?php

class WP_Services extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'WP_Services', // Base ID
                'Home Services', // Name
                array('description' => 'Show list services on home page')
        );
    }

    public function widget($args, $instance) {
        extract($args);
        $posts = get_posts(array(
            'posts_per_page' => $instance['number'],
            'post_type' => 'services',
            'meta_key' => 'show_on_homepage',
            'meta_value' => 1
        ));
        if ($posts) {
            $list_services = '<div class="col-sm-3 col-xs-8 second-table"> <div class="second-table-content"> <ul>';
            foreach ($posts as $post) {                
                $list_services .= '<li><div class="li-style">&#9632;</div> <a href="'.get_post_permalink($post->ID).'">'.$post->post_title.'</a></li>';
            }
            $list_services .='</ul></div>';

            if ($instance['link'] != '') {
                $list_services .='<div class="second-table-button"><a href="' . $instance['link'] . '" target="' . $instance['link_target'] . '" class="btn cya-btn">DETAIL  &gt;</a></div>';
            }

            $list_services .='</div>';
            echo $list_services;
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['number'] = $new_instance['number'];
        $instance['link'] = strip_tags($new_instance['link']);
        $instance['link_target'] = strip_tags($new_instance['link_target']);
        return $instance;
    }

    public function form($instance) {
        if (empty($instance['title'])) {
            $title = '';
        } else {
            $title = $instance['title'];
        }
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p id="div_number">
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of services to show:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($instance['number']); ?>" />
        </p>


        <p id="div_link">
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($instance['link']); ?>" />
            <select name="<?php echo $this->get_field_name('link_target'); ?>" id="<?php echo $this->get_field_id('link_target'); ?>">
                <option value="new_window" <?php if ($instance['link_target'] == 'new_window') echo "selected='true'"; ?>><?php _e('New Window'); ?></option>
                <option value="stay_in_window" <?php if ($instance['link_target'] == 'stay_in_window') echo "selected='true'"; ?>><?php _e('Stay in window'); ?></option>
                <option value="pop_up" <?php if ($instance['link_target'] == 'pop_up') echo "selected='true'"; ?>><?php _e('Open popup'); ?></option>
            </select>
        </p>

        <?php
    }

}

add_action('widgets_init', create_function('', 'register_widget( "WP_Services" );'));
