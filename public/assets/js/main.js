(function($) {
    jQuery(document).ready(function($) {
        $(".wpwax-single-docs .left-sidebar ul").slideUp();
        $(".wpwax-single-docs .left-sidebar h4").each(function (i, e) {
            if($(e).hasClass("active")){
                $(e).next().slideDown();
            }
            $(e).on("click", function () {
                $(".wpwax-single-docs .left-sidebar").siblings().children("h4").removeClass("active");
                $(".wpwax-single-docs .left-sidebar").siblings().children("ul").slideUp();
                $(e).addClass("active");
                $(e).next().slideToggle();
            })
        })
    });
})(jQuery);

