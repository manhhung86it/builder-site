<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

        <div id="page-wrap">

            <div id="header">
                <div class="top-header group">                   
                    
                    <div class="bottom-header-image-invisible">
                        <?php if (get_header_image()) : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php header_image(); ?>" class="img-responsive" alt="" /></a>
                        <?php endif; ?> 
                    </div>
                    
                    <?php
                    $options = get_option('wp_theme_options');
                    ?>
                    <div class="header-contact col-sm-6">
                        <div class="header-contact-content">
                            <div class="header-contact-icon"><i class="fa fa-envelope"></i></div>
                            <div class="header-contact-value"><a href="mailto:<?php echo $options['email']; ?>" target="_top" ><?php echo $options['email']; ?></a></div>
                        </div>
                        <span></span>
                        <div class="header-contact-content">
                            <div class="header-contact-icon"><i class="fa fa-phone"></i></div>
                            <div class="header-contact-value"><a href="tel:%2B<?php echo $options['country_code'].str_replace(' ','',$options['phone']); ?>">0<?php echo $options['phone']; ?></a></div>
                        </div>
                    </div>
                    
                    <div class="header-social col-sm-6">
                        <ul class="group">
                            <?php if($options['LinkIn_url'] != null){ ?>
                            <li><a href="<?php echo $options['LinkIn_url']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <?php } ?>
                            
                            <?php if($options['google_url'] != null){ ?>
                            <li><a href="<?php echo $options['google_url']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>  
                            <?php } ?>
                            
                            <?php if($options['fb_url'] != null){ ?>
                            <li><a href="<?php echo $options['fb_url']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>  
                            <?php } ?>
                            
                            <?php if($options['twitter_url'] != null){ ?>
                            <li><a href="<?php echo $options['twitter_url']; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>   
                            <?php } ?>
                        </ul>
                    </div>
                </div>                
                <div class="bottom-header group">
                    <div class="bottom-header-image col-sm-3">
                        <?php if (get_header_image()) : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php header_image(); ?>" class="img-responsive" alt="" /></a>
                        <?php endif; ?> 
                    </div>
                    <div class="col-sm-9 navbar navbar-default navbar-cya navbar-static-top" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="navbar" class="navbar-collapse group collapse" aria-expanded="false" style="height: 1px;">
                            <?php wp_nav_menu(array('menu' => 'menu-top', 'container' => '', 'menu_class' => 'nav navbar-nav', 'walker' => new CSS_Menu_Maker_Walker())); ?>
                        </div>
                    </div>
                </div>
            </div>