<div id="footer">
    <div class="news-letter">
        <div class="news-letter-title">Newsletter</div>
        <div class="news-letter-content">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            <form>
                <div class="icon-body-bottom"></div>
                <div class="form-body-bottom">
                    <input type="text" name="news">
                    <input type="submit" name="submit" value="Go">
                </div>
                <script>
                    var cntUl = jQuery(".news-letter-content form").length;
                    var withInput1 = jQuery(".icon-body-bottom").length;
                    var withInput2 = jQuery(".form-body-bottom").length;
                    var a = (cntUl - (withInput1+withInput2))/2;
                    console.log(cntUl);
                    jQuery(".form-body-bottom").css('right',a+'px');
                    jQuery(".icon-body-bottom").css('padding-right',withInput2 + a+'px');
                </script>
            </form>
        </div>
    </div>
    <div class="menu-footer group">
        <?php wp_nav_menu(array('menu' => 'Page Menu', 'container' => '', 'menu_class' => 'nav navbar-nav')); ?>
    </div>
    <div class="footer-infor">
        &copy;© 2013 Soho Projects. All rights resevered. Designed by CYASOFT
    </div>                   

</div>

</div>

<?php wp_footer(); ?>

<!-- Don't forget analytics -->

</body>

</html>
