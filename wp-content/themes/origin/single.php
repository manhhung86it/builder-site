<?php get_header(); ?>
<?php dynamic_sidebar('about Sidebar - Top'); ?> 
<div class="body">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="about-body">
                <div class="about-title">
                    <h1 class="border-left"><?php the_title(); ?></h1>
                </div>
                <?php the_content(); ?>
            </div>
            <?php edit_post_link('Edit this entry', '', '.'); ?>

            <?php
        endwhile;
    endif;
    ?>
    <?php dynamic_sidebar('Newletter - bottom'); ?> 
</div>

<?php get_footer(); ?>