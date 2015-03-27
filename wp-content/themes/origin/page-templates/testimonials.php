<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Template Name: testimonials Page
 */
?>
<?php get_header(); ?>
<style type="text/css">
    .mfp-iframe-scaler iframe{
        height: 80% !important;
    }
    .mfp-content .mfp-iframe-scaler button.mfp-close{
        right: -20px !important;
        top: -27px !important;
    }
</style>
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
                <?php
            endwhile;
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
                        <div class="col-sm-5 col-md-4 testimonial-icon">
                            <?php if (has_post_thumbnail()) { ?>
                                <?php echo the_post_thumbnail(); ?>
                            <?php } else { ?>                          
                                <img src="<?php echo get_template_directory_uri(); ?>/images/defaultImg.jpg" class="attachment-post-thumbnail wp-post-image" alt="Testimonials">
                            <?php } ?>
                        </div>
                        <div class="col-sm-7 col-md-8 services-page-content testimonial-page-content testimonialPopup-<?php echo $i; ?>">
                            <span><?php the_excerpt(); ?></span>
                            <h4><?php echo the_field('customer_name'); ?></h4>
                            <?php // echo the_field('customer_email');  ?>
                        </div>
                    </div>                    
                <?php endwhile; ?>
        </div>
    </div>
    <?php dynamic_sidebar('Newletter - bottom'); ?> 
</div>
<?php get_footer(); ?>
<script>
    jQuery(document).ready(function() {

        jQuery('.testimonial-page-content a').magnificPopup({
            type: 'iframe',
            iframe: {
                markup: '<div class="mfp-iframe-scaler">' +
                        '<div class="mfp-close"></div>' +
                        '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                        '</div>',
                patterns: {
                    renovationa: {
                        src: '<?php echo get_site_url(); ?>'
                    }
                }

            }

        });

    });
</script>