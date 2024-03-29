<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>    
    <?php if (is_sticky() && is_home() && !is_paged()) : ?>
        <div class="featured-post">
            <?php _e('Featured post', 'pm'); ?>
        </div>
    <?php endif; ?>
    
    <?php if (is_search()) : // Only display Excerpts for Search ?>
        <header class="entry-header">
			
			<h1 class="entry-title">
                            <?php 
                            
                            $link= get_permalink(get_the_ID());
                            ?>
				<a href="<?php echo $link; ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>			
		
		</header><!-- .entry-header -->
        <div class="entry-summary">
            <p class="short-description"><?php the_field('short_desciption'); ?></p>   
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
    <?php else : ?>
        <div class="entry-content">
            <a href="<?php echo the_permalink(); ?>" class="read-more"><?php the_title(); ?></a>
            <p class="short-description"><?php the_field('short_desciption'); ?></p>   
            <?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'pm')); ?>
            <?php wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'pm'), 'after' => '</div>')); ?>
        </div><!-- .entry-content -->
    <?php endif; ?>

    <footer class="entry-meta">
        <?php edit_post_link(__('Edit', 'pm'), '<span class="edit-link">', '</span>'); ?>
        <?php if (is_singular() && get_the_author_meta('description') && is_multi_author()) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
            <div class="author-info">
                <div class="author-avatar">
                    <?php
                    /** This filter is documented in author.php */
                    $author_bio_avatar_size = apply_filters('pm_author_bio_avatar_size', 68);
                    echo get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size);
                    ?>
                </div><!-- .author-avatar -->
                <div class="author-description">
                    <h2><?php printf(__('About %s', 'pm'), get_the_author()); ?></h2>
                    <p><?php the_author_meta('description'); ?></p>
                    <div class="author-link">
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
                            <?php printf(__('View all posts by %s <span class="meta-nav">&rarr;</span>', 'pm'), get_the_author()); ?>
                        </a>
                    </div><!-- .author-link	-->
                </div><!-- .author-description -->
            </div><!-- .author-info -->
        <?php endif; ?>
    </footer><!-- .entry-meta -->
</article><!-- #post -->
