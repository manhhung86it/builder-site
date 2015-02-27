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
        <div class="about-title">
            <h1 class="border-left">SERVICES</h1>
        </div>

        <?php while (have_posts()) : the_post(); ?>
            <div class="about-title about-title-second">
                <div class="about-title-second-content">
                    <img src="<?php echo the_field('imga'); ?>"><div><?php the_title(); ?></div>
                </div>
            </div>

            <div class="about group">    
                <div class="col-sm-6 col-xs-12 about-content pull-right">
                    <div class="service-detail-image-1">
                        <?php echo the_post_thumbnail(); ?>
                    </div>
                    <div class="service-detail-image-2">
                        <img src="http://localhost/cya-wp/wp-content/themes/origin/images/services-detail-2.png" />
                    </div>
                    <div class="service-detail-image-3">
                        <img src="http://localhost/cya-wp/wp-content/themes/origin/images/services-detail-3.png" />
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12 about-content pull-left">
                    <div class="about-content-title">
                        <h4>Lorem Ipsum is simply dummy text</h4>
                    </div>
                    <div class="about-content-top">
                        <?php the_content(); ?>
                        <span class="best-service-detail">Best service for you<i class="fa fa-check"></i></span>
                        <div class="service-detail-btn">GET NOW</div>
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