<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/* Template Name: Contact Page
 */
?>
<?php get_header(); ?>
<div class="body">
    <div class="body-bottom">
        <?php dynamic_sidebar('Contact Sidebar - Top'); ?>         
    </div>

    <div id="content" role="main" class="about-body">
        <?php while (have_posts()) : the_post(); ?>           
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="about-title">
                    <h1 style="text-align: center;">CONTACT</h1>
                </div>
                <div class="about group">  
                    <div class="col-sm-6 col-xs-12 contact-right pull-right">
                        <div class="google-map">
                            <?php
                            echo do_shortcode('[put_wpgm id=1]');
                            ?>
                        </div>
                        <?php
                        $options = get_option('wp_theme_options');
                        ?>
                        <div class="contact">
                            <h3>Contact Details</h3>
                            <div><span>Address:</span> <?php echo $options['address']; ?></div>
                            <div><span>Email:</span> <a href="mailto:<?php echo $options['email']; ?>" target="_top" > <?php echo $options['email']; ?></a></div>
                            <div><span>Phone:</span><a href="tel:%2B<?php echo str_replace(' ','',$options['phone']); ?>"> 0<?php echo $options['phone']; ?></a></div>
                            <?php
                            if ($options['fax'] != '')
                                echo '<div><span>Fax:</span> ' . $options['fax'] . '</div>';
                            ?>

                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12 about-content pull-left">

                        <div class="about-content-title">
                            <h2><?php the_title(); ?></h2>
                        </div>
                        <div class="about-content-top">
                            <?php the_content(); ?>
                        </div>
                        <div class="about-content-bottom">
                            <?php
                            echo do_shortcode('[contact-form-7 id="92" title="Contact"]');
                            ?>
                        </div>
                    </div>

                </div>
            </article><!-- #post -->
        <?php endwhile; // end of the loop.    ?>
    </div><!-- #content -->
    <?php dynamic_sidebar('Newletter - bottom'); ?> 
</div>
<?php get_footer(); ?>
