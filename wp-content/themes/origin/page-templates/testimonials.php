<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Template Name: testimonials Page
 */
?>
<?php get_header(); ?>
<div class="body">

    <div class="body-bottom">
        <?php dynamic_sidebar('Testimonials Sidebar - Top'); ?>         
    </div>

    <div class="about-body">
        <div class="about-title">
            <h1 class="border-left">TESTIMONIALS</h1>
        </div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="testimonial-title"><?php the_content(); ?></div>
            <?php endwhile;
        endif;
        ?>

        <div class="about group"> 
            <?php query_posts(array('post_type' => 'testimonial')); ?>
            <?php
            $i = 0;
            if (have_posts())
                while (have_posts()) : the_post();
                    $i++;
                    ?>
                    <div class="services-body col-sm-6">                
                        <div class="col-sm-4 testimonial-icon">
        <?php echo the_post_thumbnail(); ?>
                        </div>
                        <div class="col-sm-8 services-page-content testimonial-page-content">
                            <span><?php the_excerpt(); ?></span>
                            <h4><?php echo the_field('customer_name'); ?></h4>
        <?php echo the_field('customer_email'); ?>
                        </div>
                    </div>                    
    <?php endwhile; ?>
        </div>
    </div>
<?php dynamic_sidebar('Newletter - bottom'); ?> 
</div>
<?php get_footer(); ?>
