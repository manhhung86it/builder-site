<?php get_header(); ?>
<?php dynamic_sidebar('about Sidebar - Top'); ?> 
<div class="body">
    <div class="about-body">
        <div class="about-title">
            <h1 class="border-left">Gallery</h1>
        </div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div id="single-nav-left"> <?php previous_post_link('%link', '&laquo; Previous', FALSE); ?></div>
                <?php the_title(); ?>
                <div id="single-nav-right"><?php next_post_link('%link', 'Next &raquo;', FALSE); ?></div>



                <?php the_content(); ?>

                <?php edit_post_link('Edit this entry', '', '.'); ?>

                <?php
            endwhile;
        endif;
        ?>
    </div>
    <?php dynamic_sidebar('Newletter - bottom'); ?> 

</div>

<?php get_footer(); ?>