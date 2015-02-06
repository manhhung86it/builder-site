<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Template Name: Home Page
 */

get_header();
?>
<div class="body">
    <div class="body-top">
        <?php dynamic_sidebar('Home Sidebar - Top'); ?> 
    </div>
</div>

<?php dynamic_sidebar('Home Sidebar - Middle'); ?>   


<?php get_footer(); ?>
