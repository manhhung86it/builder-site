<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Template Name: News Page
 */

get_header();
?>
<div class="body">
    <div class="about-body group">
        <div class="col-md-12 no-padding content-news-template">
            <h1 class="news-head">Blog</h1>
        </div>
        <div id="content" role="main" class="col-md-8 no-padding-left content-news-template">
            <?php $postsperpage = get_option('posts_per_page'); ?>
            <?php query_posts('post_type=post&post_status=publish&posts_per_page=' . $postsperpage . '&paged=' . get_query_var('paged')); ?>
            <?php if (have_posts()): ?>
                <?php while (have_posts()): the_post(); ?>
                    <div class="col-md-12 no-padding-left posts border-news">
                        <div class="col-md-4 no-padding-left list-post-thumb">
                            <a href="<?php echo the_permalink(); ?>">
                                <?php
                                if (has_post_thumbnail()) {
                                    $domsxe = simplexml_load_string(get_the_post_thumbnail());
                                    $thumbnailsrc = $domsxe->attributes()->src;
                                    echo '<img src="' . $thumbnailsrc . '" class="new_home_thumb">';
                                } else {
                                    ?>
                                    No image
                                <?php }
                                ?>
                            </a>
                        </div>
                        <div class="col-md-8 no-padding-right">
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php if (is_sticky() && is_home() && !is_paged()) : ?>
                                    <div class="featured-post">
                                        <?php _e('Featured post', 'pm'); ?>
                                    </div>
                                <?php endif; ?>

                                <header class="entry-header">

                                    <?php if (is_single()) : ?>
                                        <h1 class="entry-title"><?php the_title(); ?></h1>
                                    <?php else : ?>
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <h1 class="entry-title">
                                                <?php the_title(); ?>
                                            </h1>
                                        </a>
                                    <?php endif; // is_single()   ?>

                                    <footer class="entry-meta">
                                        <?php pm_entry_meta(); ?>
                                        <?php edit_post_link(__('Edit', 'pm'), '<span class="edit-link">', '</span>'); ?>
                                    </footer>


                                    <?php if (comments_open()) : ?>
                                        <div class="comments-link">
                                            <?php comments_popup_link('<span class="leave-reply">' . __('Leave a reply', 'pm') . '</span>', __('1 Reply', 'pm'), __('% Replies', 'pm')); ?>
                                        </div><!-- .comments-link -->
                                    <?php endif; // comments_open()   ?>
                                </header><!-- .entry-header -->

                                <?php if (is_search()) : // Only display Excerpts for Search  ?>
                                    <div class="entry-summary">
                                        <p><?php the_field('short_desciption'); ?></p>                                
                                    </div><!-- .entry-summary -->
                                <?php else : ?>
                                    <div class="entry-content">
                                        <p><?php the_field('short_desciption'); ?></p>   
                                        <?php wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'pm'), 'after' => '</div>')); ?>
                                    </div><!-- .entry-content -->
                                <?php endif; ?>
                                <a href="<?php echo the_permalink(); ?>" class="read-more">Read more ...</a>
                                <!-- .entry-meta -->
                            </article><!-- #post -->
                        </div>
                    </div>

                <?php endwhile; ?>


                <?php
                if (function_exists('wp_paginate')) {
                    wp_paginate('range=4&anchor=2&nextpage=Next&previouspage=Previous');
                }
                ?>

            <?php else: ?>

                <div id="post-404" class="noposts">

                    <p><?php _e('None found.', 'example'); ?></p>

                </div><!-- /#post-404 -->

            <?php
            endif;
            wp_reset_query();
            ?>

        </div><!-- #content -->

        <?php if (is_active_sidebar('sidebar-news')) : ?>
            <div id="secondary" class="widget-area col-md-4 no-padding-right" role="complementary">
                <?php dynamic_sidebar('sidebar-news'); ?>
            </div><!-- #secondary -->
        <?php endif; ?>

    </div>
    <?php dynamic_sidebar('Newletter - bottom'); ?> 
</div>
<?php get_footer(); ?>
