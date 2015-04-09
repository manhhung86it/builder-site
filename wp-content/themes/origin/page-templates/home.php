<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Template Name: Home Page
 */
?>

<?php get_header(); ?>

<div class="body">
    <div class="body-top">
        <?php dynamic_sidebar('Home Sidebar - Top'); ?> 
    </div>
    <div class="body-middle">
        <?php dynamic_sidebar('Home Sidebar - Middle'); ?> 
        <?php dynamic_sidebar('Newletter - bottom'); ?>
    </div>
</div>

<?php get_footer(); ?>