<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Template Name: supplier Page
 */
?>
<?php get_header(); ?>
<div class="body">

    <div class="body-bottom">
        <?php dynamic_sidebar('Suppliers Sidebar - Top'); ?>         
    </div>

    <div class="about-body">        
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="about-title">
                    <h1 class="border-left" style="text-transform: uppercase;"><?php the_title(); ?></h1>
                </div>
                <div class="testimonial-title"><?php the_content(); ?></div>
            <?php
            endwhile;
        endif;
        ?>

        <div class="about group"> 
            <?php query_posts(array('post_type' => 'supplier')); ?>
            <?php
            $i = 0;
            if (have_posts())
                while (have_posts()) : the_post();
                    $i++;
                    ?>
                    <div class="services-body col-sm-6">                
                        <div class="col-sm-5 supplier-icon">
                            <?php 
                            $feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));                            
                            ?>
                            <img src="<?php echo $feat_image;?>" />
                        </div>
                        <div class="col-sm-7 services-page-content supplier-page-content">
                            <h4><?php echo the_title(); ?></h4>
                            <span><?php the_excerpt(); ?></span>
                            <a href="<?php echo the_field('website'); ?>" target="_blank"><h5 style="padding-top: 5px;font-size: 13px;color: #000;"><?php echo the_field('website'); ?></h5></a>
                        </div>
                    </div>                    
    <?php endwhile; ?>
        </div>
    </div>
<?php dynamic_sidebar('Newletter - bottom'); ?> 
</div>
<?php get_footer(); ?>
