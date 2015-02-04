<div id="footer">
    <div class="news-letter">
        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
        <form>
            <input type="text" name="news">
            <input type="submit" name="submit" value="Go">
        </form>
    </div>
    <div class="menu-footer">
        <?php wp_nav_menu(array('menu' => 'Page Menu', 'container' => '', 'menu_class' => 'nav navbar-nav')); ?>
    </div>
    <div class="footer-infor">
        &copy;<?php echo date("Y");
        echo " ";
        bloginfo('name'); ?>
    </div>                   

</div>

</div>

<?php wp_footer(); ?>

<!-- Don't forget analytics -->

</body>

</html>
