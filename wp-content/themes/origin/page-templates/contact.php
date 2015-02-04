<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/* Template Name: Contact Page
 */
?>
<?php get_header(); ?>
<div id="content" role="main" class="single-page contact-page">

    <?php while (have_posts()) : the_post(); ?>           
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">			
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <div class="col-md-12 no-padding contact-content">
                <?php the_content(); ?>
            </div>
            <div class="col-md-5 no-padding-left">
                <?php
                echo do_shortcode('[contact-form-7 id="15" title="Contact form 1"]');
                ?>
            </div>
            <div class="col-md-7">
                <?php
                echo do_shortcode('[put_wpgm id=1]');
                //echo do_shortcode('[contact_form]');
                ?>
            </div>
            <?php wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'pm'), 'after' => '</div>')); ?>
            <div class="clearfix"></div>
        </article><!-- #post -->
    <?php endwhile; // end of the loop.    ?>
</div><!-- #content -->
<footer class="entry-meta">
    <?php edit_post_link(__('Edit', 'pm'), '<span class="edit-link">', '</span>'); ?>
</footer><!-- .entry-meta -->
<?php get_footer(); ?>
