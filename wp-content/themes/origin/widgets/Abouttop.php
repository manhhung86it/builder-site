<?php

class WP_Abouttop extends WP_Widget {

    var $image_bg_field = 'image_bg';  // the image field ID

    public function __construct() {
        parent::__construct(
                'WP_Abouttop', // Base ID
                'Background and Text top', // Name
                array('description' => 'Show background and text on top')
        );
    }

    public function widget($args, $instance) {
        extract($args);
         $image_id   = $instance[$this->image_bg_field];
         $image      = new WidgetImageField( $this, $image_id );
         $tmp = $image->get_image_src('full');
         $style = 'style="background: url(\''.$tmp.'\') no-repeat center center;  -webkit-background-size: 100%; -moz-background-size: 100%; -o-background-size: 100%; background-size: 100%;"';
        if ($instance) {
            $list_about = '<div class="about-top" '.$style.'>'
                    . '<div class="about-top-content">';
            $list_about .= $instance['content'];
            $list_about .= $instance['content_2'];
            $list_about .='</div>'
                    . '</div>';
            echo $list_about;
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance[$this->image_bg_field] = intval(strip_tags($new_instance[$this->image_bg_field]));
        $instance['content'] = $new_instance['content'];
        $instance['content_2'] = $new_instance['content_2'];
        return $instance;
    }

    public function form($instance) {
        
        $image_bg_id = esc_attr(isset($instance[$this->image_bg_field]) ? $instance[$this->image_bg_field] : 0 );
        $image_bg = new WidgetImageField($this, $image_bg_id);
        ?>

        <div id="div_background_image">
            <label><?php _e('Background Image:'); ?></label>
            <?php echo $image_bg->get_widget_field('bg_image', 'bg'); ?>
        </div>

        <p id="div_content">
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('content:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" type="text" value="<?php echo esc_attr($instance['content']); ?>" />
        </p>
        
        <p id="div_content_2">
            <label for="<?php echo $this->get_field_id('content_2'); ?>"><?php _e('second content:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('content_2'); ?>" name="<?php echo $this->get_field_name('content_2'); ?>" type="text" value="<?php echo esc_attr($instance['content_2']); ?>" />
        </p>

        <?php
    }

}

add_action('widgets_init', create_function('', 'register_widget( "WP_Abouttop" );'));
