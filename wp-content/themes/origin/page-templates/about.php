<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/* Template Name: about Page
 */
?>
<?php get_header(); ?>
<div class="body">
    <?php dynamic_sidebar('about Sidebar - Top'); ?> 
    <div class="about-body">
        <?php while (have_posts()) : the_post(); ?>           
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="about-title">
                    <h1 class="border-left">ABOUT</h1>
                </div>
                <div class="about group">

                    <div class="col-sm-4 col-xs-12 about-image">
                        <?php  echo the_post_thumbnail(); ?>
                    </div>
                    <div class="col-sm-8 col-xs-12 about-content">
                        <div class="about-content-title">
                            <h1><?php the_title(); ?></h1>
                        </div>
                        <div class="about-content-top about-content-bottom" id="about-content-top">
                            <?php the_content(); ?>
                        </div>
                    </div>  
                </div>
            </article><!-- #post -->
        <?php endwhile; // end of the loop.    ?>        
    </div><!-- #content -->
    <?php dynamic_sidebar('Newletter - bottom'); ?> 
</div>
<?php get_footer(); ?>
