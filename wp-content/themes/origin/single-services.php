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
                    <?php echo the_post_thumbnail(); ?><div><?php the_title(); ?></div>
                </div>
            </div>
            <div class="about group">    
                <div class="col-sm-6 col-xs-12 about-content pull-right">
                    <div class="service-detail-image-1">
                        <img src="<?php echo the_field('content_image_1'); ?>" />
                    </div>
                    <div class="service-detail-image-2">
                        <img src="<?php echo the_field('content_image_2'); ?>" />
                    </div>
                    
                    <?php if(get_field('show_arrow') == true ) { ?>
                        <div class="service-detail-image-3">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/services-detail-3.png" />
                        </div>
                    <?php } ?>

                </div>
                <div class="col-sm-6 col-xs-12 about-content pull-left">
                    <!--                    <div class="about-content-title">
                                            <h4>Lorem Ipsum is simply dummy text</h4>
                                        </div>-->
                    <div class="about-content-top">
                        <?php the_content(); ?>
                        <span class="best-service-detail">Best service for you<i class="fa fa-check"></i></span>
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