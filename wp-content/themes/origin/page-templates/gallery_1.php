<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/* Template Name: gallery test Page
 */
?>
<?php get_header(); ?>
<div class="body">
    <?php dynamic_sidebar('about Sidebar - Top'); ?> 

    <div id="content" role="main" class="about-body">
        <?php while (have_posts()) : the_post(); ?>           
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="about-title">
                    <h1 class="border-left"><?php the_title(); ?></h1>
                </div>
                <div class="about group">
                    <?php echo do_shortcode('[nimble-portfolio post_type="portfolio" taxonomy="nimble-portfolio-type" skin="default" orderby="menu_order" order="ASC" ]') ?>
                </div>
            </article><!-- #post -->
        <?php endwhile; // end of the loop.    ?>
    </div><!-- #content -->
    <?php dynamic_sidebar('Newletter - bottom'); ?> 
</div>
<?php get_footer(); ?>