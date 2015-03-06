<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header();
?>

<div class="about-body">
    <?php while (have_posts()) : the_post(); ?>

        <div class="col-md-12 no-padding cya-single">
            <h1 class="news-head"><?php the_title(); ?></h1>
            <div class="cya-entry-meta">
                <?php pm_entry_meta(); ?>
            </div>
            <div class="service_share">
                <p>Share:</p>
                <ul>
                    <li class="fb"><iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink()); ?>&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe></li>
                    <li><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo get_permalink(); ?>">Tweet</a>
                        <script>!function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                if (!d.getElementById(id)) {
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = p + '://platform.twitter.com/widgets.js';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }
                            }(document, 'script', 'twitter-wjs');</script></li>
                    <li><a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  data-pin-color="white"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_white_20.png" /></a>
                        <!-- Please call pinit.js only once per page -->
                        <script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script></li>
                </ul>
                <div class="clearfix"></div>
            </div>

        </div>
        <div id="content" role="main" class="col-md-8 no-padding-left news-content">        
            <?php get_template_part('content', get_post_format()); ?>

            <nav class="nav-single">
                <h3 class="assistive-text"><?php _e('Post navigation', 'pm'); ?></h3>
                <span class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'pm') . '</span> %title'); ?></span>
                <span class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'pm') . '</span>'); ?></span>
            </nav><!-- .nav-single -->

            <?php comments_template('', true); ?>
        </div>
    <?php endwhile; // end of the loop. ?>
    <div id="secondary" class="widget-area col-md-4 no-padding-right" role="complementary">
        <?php get_sidebar(); ?>

    </div>
</div>
<?php get_footer(); ?>