<div id="footer">    
    <div class="menu-footer group">
        <?php wp_nav_menu(array('menu' => 'menu-bottom','theme_location' => 'secondary', 'container' => '','menu_class' => 'bottom-menu')); ?>
    </div>
    <div class="footer-infor">
        © <?php echo date("Y"); ?> Renovation A. All rights reserved.
    </div>                   

</div>

</div>

<?php wp_footer(); ?>

<!-- Don't forget analytics -->

</body>

</html>
