<?php

class WP_Supplier extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'WP_Supplier', // Base ID
                'Home Supplier', // Name
                array('description' => 'Show list suppliers on home page')
        );
    }

    public function widget($args, $instance) {
        extract($args);
        echo 'list supliers';
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
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of supplier to show:'); ?></label> 
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

add_action('widgets_init', create_function('', 'register_widget( "WP_Supplier" );'));
