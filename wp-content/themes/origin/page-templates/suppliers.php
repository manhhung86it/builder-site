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
        <?php dynamic_sidebar('Contact Sidebar - Top'); ?>         
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
                            <?php echo the_post_thumbnail(); ?>
                        </div>
                        <div class="col-sm-7 services-page-content supplier-page-content">
                            <span><?php the_excerpt(); ?></span>
                            <h4><?php echo the_title(); ?></h4>
                        </div>
                    </div>                    
    <?php endwhile; ?>
        </div>
    </div>
<?php dynamic_sidebar('Newletter - bottom'); ?> 
</div>
<?php get_footer(); ?>