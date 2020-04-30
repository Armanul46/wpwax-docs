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
        });
        $(".atbd-docs-name").each(function (i, e) {
            if($(e).children("ul").children("li").length > 5){
                $(e).addClass("atbd-docs-flex");
            }
        });

        $(".sidbar-category a").on("click", function(){
            var $this = $(this);
            $(""+$this.attr("href")+"").addClass("active");
            setTimeout(function () {
                $(""+$this.attr("href")+"").removeClass("active");
            },3000)
        })

    });
})(jQuery);

