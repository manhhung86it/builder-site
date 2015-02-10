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
        <div class="mainslider">
            <ul class="slides group">
                <li>
                    <img src="http://localhost/cya-wp/wp-content/themes/origin/images/home-background-bottom.png" />
                    <div class="slider-content">
                        <div class="slider-title">BILL GATE</div>
                        <span>The replacement of all kitchens and bathrooms involved detailed design development 
                            and coordination, on-site inspections and detailed cost control. The management under 
                            Iosh and Shay Nassi has an unquestioned integrity and honesty with outstanding 
                            leadership qualities.”
                        </span>
                    </div>
                </li>
                <li>
                    <img src="http://localhost/cya-wp/wp-content/themes/origin/images/home-background-top.png" />
                    <div class="slider-content">
                        <div class="slider-title">NGUYEN KIEN</div>
                        <span>The replacement of all kitchens and bathrooms involved detailed design development 
                            and coordination, on-site inspections and detailed cost control. The management under 
                            Iosh and Shay Nassi has an unquestioned integrity and honesty with outstanding 
                            leadership qualities.”
                        </span>
                    </div>
                </li>
                <li>
                    <img src="http://localhost/cya-wp/wp-content/themes/origin/images/home-background-bottom.png" />
                    <div class="slider-content">
                        <div class="slider-title">NGUYEN KIEN</div>
                        <span>The replacement of all kitchens and bathrooms involved detailed design development 
                            and coordination, on-site inspections and detailed cost control. The management under 
                            Iosh and Shay Nassi has an unquestioned integrity and honesty with outstanding 
                            leadership qualities.”
                        </span>
                    </div>
                </li>
            </ul>
        </div>


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
                            <div><span>Email:</span>  <?php echo $options['email']; ?></div>
                            <div><span>Phone:</span> <?php echo $options['phone']; ?></div>
                            <div><span>Fax:</span> <?php echo $options['fax']; ?></div>
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
</div>
<?php get_footer(); ?>
