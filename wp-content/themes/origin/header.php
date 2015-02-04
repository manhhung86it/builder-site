<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />

        <?php if (is_search()) { ?>
            <meta name="robots" content="noindex, nofollow" /> 
        <?php } ?>

        <title>
            <?php
            if (function_exists('is_tag') && is_tag()) {
                single_tag_title("Tag Archive for &quot;");
                echo '&quot; - ';
            } elseif (is_archive()) {
                wp_title('');
                echo ' Archive - ';
            } elseif (is_search()) {
                echo 'Search for &quot;' . wp_specialchars($s) . '&quot; - ';
            } elseif (!(is_404()) && (is_single()) || (is_page())) {
                wp_title('');
                echo ' - ';
            } elseif (is_404()) {
                echo 'Not Found - ';
            }
            if (is_home()) {
                bloginfo('name');
                echo ' - ';
                bloginfo('description');
            } else {
                bloginfo('name');
            }
            if ($paged > 1) {
                echo ' - page ' . $paged;
            }
            ?>
        </title>

        <link rel="shortcut icon" href="/favicon.ico">

        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

        <div id="page-wrap">

            <div id="header">
                <div class="top-header">
                    <?php
                    $options = get_option('wp_theme_options');
                    ?>
                    <div class="header-contact col-sm-6">
                        <div><?php echo $options['email']; ?></div>
                        <div><?php echo $options['phone']; ?></div>
                    </div>
                    <div class="header-social col-sm-6">
                        <ul class="group">
                            <li><a href="<?php echo $options['LinkIn_url']; ?>"><i class="sc-LinkIn"></i></a></li>                 
                            <li><a href="<?php echo $options['google_url']; ?>"><i class="sc-google"></i></a></li>       
                            <li><a href="<?php echo $options['fb_url']; ?>"><i class="fa fa-facebook"></i></a></li>                        
                            <li><a href="<?php echo $options['twitter_url']; ?>"><i class="sc-twiter"></i></a></li>                                
                        </ul>
                    </div>
                </div>
                <div class="bottom-header group">
                    <div class="col-sm-4">
                        <?php if (get_header_image()) : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php header_image(); ?>" class="img-responsive" alt="" /></a>
                        <?php endif; ?> 
                    </div>
                    <div class="col-sm-8 navbar navbar-default navbar-cya navbar-static-top" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                            <?php wp_nav_menu(array('menu' => 'Page Menu', 'container' => '', 'menu_class' => 'nav navbar-nav')); ?>
                        </div>
                    </div>
                </div>
            </div>