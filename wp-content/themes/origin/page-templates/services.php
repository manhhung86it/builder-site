<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Template Name: Services Page
 */
?>
<?php get_header(); ?>
<div class="body">

    <?php dynamic_sidebar('Service Sidebar - Top'); ?> 

    <div class="about-body">
        <div class="about-title">
            <h1 class="border-left">SERVICES</h1>
        </div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="testimonial-title"><?php the_content(); ?></div>
                <?php
            endwhile;
        endif;
        ?>
        <div class="about group"> 
            <?php query_posts(array('post_type' => 'services', 'orderby' => 'menu_order', 'order' => 'ASC')); ?>
            <?php
            $i = 0;
            if (have_posts())
                while (have_posts()) : the_post();
                    $i++;
                    ?>
                    <div class="services-body services-body-height col-sm-4">                
                        <!--                        <div class="services-icon">
                                                    <a href="<?php echo the_permalink(); ?>">
                        <?php echo the_post_thumbnail(); ?> 
                                                    </a>
                                                </div>-->
                        <div class="col-sm-11 services-page-content">
                            <a href="<?php echo the_permalink(); ?>"> 
                                <h4><?php the_title(); ?></h4>
                            </a>
                            <span><?php the_excerpt(); ?></span>
                        </div>
                    </div> 
                <?php endwhile; ?>
        </div>
    </div>
    <?php dynamic_sidebar('Newletter - bottom'); ?> 
</div>
<?php get_footer(); ?>
