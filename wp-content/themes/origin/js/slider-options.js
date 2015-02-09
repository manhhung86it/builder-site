
jQuery(window).load(function() {
    jQuery('.mainslider').flexslider({
        animation: "slide",
        controlNav: false,
        directionNav: true,
    });
});
jQuery(document).ready(function(){
    jQuery('#menu-cya-menu li a').click(function(){
        jQuery('#menu-cya-menu li a').removeClass('menu-cya-menu-active');
        jQuery(this).addClass('menu-cya-menu-active');
    });
    
})