jQuery(document).ready(function ($) {

    // Portfolio Filtering
    $('.a3-portfolio-menus-container .filter-m').click(function (e) {
        e.preventDefault();

        $('.a3-portfolio-menus-container .filter-m.active').removeClass('active');
        $(this).addClass('active');
        var filterVal = $(this).attr('rel');        
        if (filterVal === '*') {
            $('.a3-portfolio-box-content .a3-portfolio-item.hidden').fadeIn('normal').removeClass('hidden');
        } else {            
            $('.a3-portfolio-box-content .a3-portfolio-item').each(function () {
                if (!$(this).hasClass(filterVal)) {
                    $(this).fadeOut('slow').addClass('hidden');
                } else {
                    $(this).fadeIn('slow').removeClass('hidden');
                }
            });
        }        
    });
    
    $('.a3-portfolio-navigation-mobile').click(function (e) {
        e.preventDefault();
        
        if (!$('.a3-portfolio-menus-container').hasClass('showed')) {
            $('.a3-portfolio-menus-container').fadeIn('slow').addClass('showed');
        }else{
            $('.a3-portfolio-menus-container').fadeOut('slow').removeClass('showed');
        }
    });
});
