
jQuery(window).load(function() {
    jQuery('.mainslider').flexslider({
        animation: "slide",
        controlNav: false,
        directionNav: true,
    });
});
jQuery(document).ready(function() {
    jQuery("#about-content-top ul li span").before("<i class=\"fa fa-check\"></i>");
});