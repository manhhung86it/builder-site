<?php get_header(); ?>
<div class="body">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>


            <div class="about-body">
                <div class="about-title">
                    <h1 class="border-left"><?php the_title(); ?></h1>
                </div>
            </div>

                    <!--<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

                        <h2><?php the_title(); ?></h2>

                        <div class="entry">

            <?php the_content(); ?>

                        </div>

            <?php edit_post_link('Edit this entry', '', '.'); ?>

                    </div>-->


            <?php
        endwhile;
    endif;
    ?>
    <?php dynamic_sidebar('Newletter - bottom'); ?> 
</div>

<?php get_footer(); ?>