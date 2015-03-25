<?php
/**
 * The Template for displaying all single products
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php if (is_search()) { ?>
            <meta name="robots" content="noindex, nofollow" /> 
        <?php } ?>
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page-wrap">
            <div class="body">
                <div class="about-body">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="about-title about-title-second">
                            <div class="about-title-second-content">
                                <div><?php the_title(); ?></div>
                            </div>
                        </div>
                        <div class="about group testimonial-single-content">    
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
            </div>
        </div>
    </body>
</html>