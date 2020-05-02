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
        });

        //add active class when scroll on sidebar category
        var addClassOnScroll = function () {
            var windowTop = $(window).scrollTop();
            $('.atbd-docs-name[id]').each(function (index, elem) {
                var offsetTop = $(elem).offset().top;
                var outerHeight = $(this).outerHeight(true);

                if( windowTop > (offsetTop - 50) && windowTop < ( offsetTop + outerHeight)) {
                    var elemId = $(elem).attr('id');
                    $(".sidbar-category a.active").removeClass('active');
                    $(".sidbar-category a[href='#" + elemId + "']").addClass('active');
                }
            });
        };
        $(function () {
            $(window).on('scroll', function () {
                addClassOnScroll();
            });
        });

        //sticky left sidebar when scroll
        function sticky_relocate() {
            var window_top = $(window).scrollTop();
            var div_top = $('#sticky-anchor').offset().top;
            if (window_top > div_top) {
                $('.docs-sidebar ul').addClass('stick');
            } else {
                $('.docs-sidebar ul').removeClass('stick');
            }
        }
        $(function() {
            $(window).scroll(sticky_relocate);
            sticky_relocate();
        });

    });
})(jQuery);

