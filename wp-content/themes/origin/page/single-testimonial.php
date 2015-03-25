<?php
/**
 * The Template for displaying all single products
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<?php get_header(); ?>
<div class="body">
    <?php dynamic_sidebar('about Sidebar - Top'); ?> 
    <div class="about-body">

        <?php while (have_posts()) : the_post(); ?>
            <div class="about-title about-title-second">
                <div class="about-title-second-content">
                    <div><?php the_title(); ?></div>
                </div>
            </div>

            <div class="about group">    
                <div class="col-sm-5 col-xs-12 about-content testimonial-images">
                    <?php echo the_post_thumbnail(); ?>
                </div>
                <div class="col-sm-7 col-xs-12 about-content testimonial-content">
                    <div class="about-content-top">
                        <?php the_content(); ?>
                        <h4><?php echo the_field('customer_email'); ?></h4>
                    </div>
                    <div class="service-detail-bottom">
                    </div>
                </div>
            </div>   

        <?php endwhile; // end of the loop. ?>
    </div>
    <?php dynamic_sidebar('Newletter - bottom'); ?> 
</div>
<?php get_footer(); ?>