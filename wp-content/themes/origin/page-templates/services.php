<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Template Name: Services Page
 */

get_header();
?>
<?php query_posts(array('post_type' => 'services')); ?>
<?php
$i = 0;
if (have_posts())
    while (have_posts()) : the_post();
        $i++;
        ?>
        <div class="col-md-6 entry_service <?php echo ($i % 3 ? '' : 'clear-left'); ?>" id="post-<?php the_ID(); ?>">
            <a href="<?php echo the_permalink(); ?>">
                <?php
                if (has_post_thumbnail()) {
                    $domsxe = simplexml_load_string(get_the_post_thumbnail());
                    $thumbnailsrc = $domsxe->attributes()->src;
                    echo '<img src="' . $thumbnailsrc . '">';
                } else {
                    ?>
                    <img src="<?php echo $default_thumb->get_image_src('thumbnail'); ?>">
                    <?php
                }
                ?></a>
            <a href="<?php echo the_permalink(); ?>"><h1 class="service_title"><?php the_title(); ?></h1></a>
            <div class="service_excerpt">
                <?php the_excerpt(); ?>
            </div>
        </div>
    <?php endwhile; ?>

<?php get_footer(); ?>
