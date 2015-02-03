<?php

class WP_Services extends WP_Widget {

    var $image_field = 'image';  // the image field ID
    var $image_bg_field = 'image_bg';  // the image field ID

    public function __construct() {
        parent::__construct(
                'WP_Services', // Base ID
                'Home Services', // Name
                array('description' => 'Show all services on home page')
        );
    }

    public function widget($args, $instance) {
        extract($args);
        $image_id = esc_attr(isset($instance[$this->image_field]) ? $instance[$this->image_field] : 0 );
        $image = new WidgetImageField($this, $image_id);
        $image_bg_id = esc_attr(isset($instance[$this->image_bg_field]) ? $instance[$this->image_bg_field] : 0 );
        $image_bg = new WidgetImageField($this, $image_bg_id);
        ?>

        <div class="row home-experience text-left">
            <div class="col-md-5">
                <img class="featurette-image img-responsive" src="<?php echo $image_bg->get_image_src('full'); ?>" />
            </div>
            <div class="col-md-7">
                <h2 class="featurette-heading"><?php echo $instance['headline_big_text'] ?> <span class="text-muted"><?php echo $instance['headline'] ?></span></h2>
                <p>Our services:</p>
                <ul>
                    <?php query_posts(array('post_type' => 'services')); ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <li>
                            <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>                
        </div>
        <hr class="featurette-divider-no-border"/>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance[$this->image_bg_field] = intval(strip_tags($new_instance[$this->image_bg_field]));
        $instance['headline_big_text'] = $new_instance['headline_big_text'];
        $instance['headline'] = $new_instance['headline'];
        return $instance;
    }

    public function form($instance) {
        if (empty($instance['title'])) {
            $title = '';
        } else {
            $title = $instance['title'];
        }
        $image_id = esc_attr(isset($instance[$this->image_field]) ? $instance[$this->image_field] : 0 );
        $image = new WidgetImageField($this, $image_id);
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

        <p id="div_headline_big_text">
            <label for="<?php echo $this->get_field_id('headline_big_text'); ?>"><?php _e('Headline (Big text):'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('headline_big_text'); ?>" name="<?php echo $this->get_field_name('headline_big_text'); ?>" type="text" value="<?php echo esc_attr($instance['headline_big_text']); ?>" />
        </p>
        
        <p id="div_headline">
            <label for="<?php echo $this->get_field_id('headline'); ?>"><?php _e('Headline:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('headline'); ?>" name="<?php echo $this->get_field_name('headline'); ?>" type="text" value="<?php echo esc_attr($instance['headline']); ?>" />
        </p>

        <?php
    }

}

add_action('widgets_init', create_function('', 'register_widget( "WP_Services" );'));
