/*
| ----------------------------------------------------------------------------------
| TABLE OF CONTENT
| ----------------------------------------------------------------------------------
	1. Paralax
    2. All button span fix
	3. Bxslider
	4. Scroll to top 
	5. Navigation
	6. Scroll Top
	7. Flex Slider
	8. Hover animation
	9.  Sly Scroll Slider
    10. jQuery prettyPhoto, lightbox
	11. Fancybox
	12.  jQuery isotope
	13.  Sticky Header
	
*/
jQuery(function($) {
	
	
	
	"use strict";

    /////////////////////////////////////
    //  Sticky Header
    /////////////////////////////////////


    if ($('body').length) {
        $(window).on('scroll', function() {
            var winH = $(window).scrollTop();
            var $pageHeader = $('.front-page .ha-header');
            if (winH > 100) {
                $pageHeader.addClass('ha-header-small');
            } else {
                $pageHeader.removeClass('ha-header-small');
            }
        });
    }



    if ($('body').length) {
        $(window).on('scroll', function() {
            var winH = $(window).scrollTop();
            var $pageHeader = $('.not-front  #ha-header');
            if (winH > 60) {
                $pageHeader.addClass('ha-header-small');
            } else {
                $pageHeader.removeClass('ha-header-small');
            }
        });
    }


    if ($('body').length) {
        $(window).on('scroll', function() {
            var winH = $(window).scrollTop();
            var $pageHeader = $('.not-front  #ha-header');
            if (winH > 260) {

                $pageHeader.addClass('ha-header-hide');
            } else {
                $pageHeader.removeClass('ha-header-hide');
            }
        });
    }


    /////////////////////////////////////
    //  Chars Start
    /////////////////////////////////////


    if ($('body').length) {
        $(window).on('scroll', function() {
            var winH = $(window).scrollTop();

          $('#facts-numbers').waypoint(function(){
    $('.chart').each(function(){
   CharsStart();
    });
},{offset:'80%'});


        });
    }



    function CharsStart() {


        $('.chart').easyPieChart({

            barColor: false,
            trackColor: false,
            scaleColor: false,
            scaleLength: false,
            lineCap: false,
            lineWidth: false,
            size: false,
            animate: 7000,


            onStep: function(from, to, percent) {

                $(this.el).find('.percent').text(Math.round(percent));



            }
        });

    }



    var windowWidth = $(window).width();




    if (windowWidth < 1000) {


        /////////////////////////////////////
        //  Disable Mobile Animated
        /////////////////////////////////////


        $("html").removeClass("noIE");


    }




    ////////////////////////////////////////////  
    // PARALAX
    ///////////////////////////////////////////  

    $(window).scroll(function(e) {
        parallax();
    });

    function parallax() {
        var scrolled = $(window).scrollTop();
        $('.bg').css('top', -(scrolled * 0.1) + 'px');

    }




    ////////////////////////////////////////////  
    // BXCAROUSEL
    ///////////////////////////////////////////  



    if (windowWidth > 1000) {



        var bxcarousel = $('.bxcarousel li').length;

        if (bxcarousel > 3) {




            $('.bxcarousel').bxSlider({
                slideWidth: 270,
                minSlides: 6,
                maxSlides: 7,
                slideMargin: 0,
                auto: true
            });



        }

    } else {


        if (windowWidth > 700) {



            $('.bxcarousel').bxSlider({
                slideWidth: 270,
                minSlides: 3,
                maxSlides: 3,
                slideMargin: 0,
                auto: true
            });

        } else {

            $('.bxcarousel').bxSlider({

                auto: true
            });

        }


    }




    ////////////////////////////////////////////  
    //  Scroll to top 
    ///////////////////////////////////////////  



    $('.go-top').click(function(event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: 0
        }, 300);
    });




    ////////////////////////////////////////////  
    // Navigation
    ///////////////////////////////////////////  

    $('#dl-menu').dlmenu({
        animationClasses: {
            classin: 'dl-animate-in-5',
            classout: 'dl-animate-out-5'
        }
    });


    $('.main-menu li').hoverIntent({
        // on menu mouse hover function handler
        over: function() {
            $(this).addClass('hover-item').children('ul').animate({
                'height': 'toggle'
            }, 300);
        },
        // mouse out handler
        out: function() {
            var $this = $(this),
                $sub = $this.children('ul');
            if ($sub.length) {
                $this.children('ul').animate({
                    'height': 'toggle'
                }, 200, function() {
                    $this.removeClass('hover');
                });
            } else {
                $this.removeClass('hover');
            }
        },
        // A simple delay, in milliseconds, before the "out" function is called
        timeout: 200
    });




    $('#main-menu').onePageNav({
        begin: function() {
            console.log('start')
        },
        end: function() {
            console.log('stop')
        }
    });


    $('.slide-title').onePageNav({
        begin: function() {
            console.log('start')
        },
        end: function() {
            console.log('stop')
        }
    });



    $('#main-menu li:first-child').addClass('first');
    $('#main-menu li:last-child').addClass('last');



    ////////////////////////////////////////////  
    // SLIDER
    ///////////////////////////////////////////  


    // The slider being synced must be initialized first

    if ($('#slider-product').length > 0) {


        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 190,
            itemMargin: 4,
            asNavFor: '#slider-product'
        });

        $('#slider-product').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });


    }






    ////////////////////////////////////////////  
    // HOVER ANIMATION
    ///////////////////////////////////////////  


    $('.brand-logo img').wrap("<div class='ovrl-brand'></div>");

    $('.brand-logo:eq(0)').addClass("brand0");
    $('.brand-logo:eq(1)').addClass("brand1");
    $('.brand-logo:eq(2)').addClass("brand2");
    $('.brand-logo:eq(3)').addClass("brand3");
    $('.brand-logo:eq(4)').addClass("brand4");
    $('.brand-logo:eq(5)').addClass("brand5");
    $('.brand-logo:eq(6)').addClass("brand6");
    $('.brand-logo:eq(7)').addClass("brand7");
    $('.brand-logo:eq(8)').addClass("brand8");
    $('.brand-logo:eq(9)').addClass("brand9");




    $(".brand-logo img").hover(
        function() {
            $(this).addClass('pop');
        },
        function() {
            $(this).removeClass('pop');
        }
    );



    ///////////////////////////////////////////////////////////////////////////////////////////  
    // Slider  #home  Services  portfolio   our-team  our-reviews 
    /////////////////////////////////////////////////////////////////////////////////////////  


    $('.flexslider').flexslider({
        animation: 'fade', //String: Select your animation type, "fade" or "slide"
        controlNav: true, //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        directionNav: true, //Boolean: Create navigation for previous/next navigation? (true/false)
        slideshowSpeed: 7000, //Integer: Set the speed of the slideshow cycling, in milliseconds
        animationSpeed: 600, //Integer: Set the speed of animations, in milliseconds
        pauseOnHover: false, //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
        prevText: "", //String: Set the text for the "previous" directionNav item
        nextText: "" //String: Set the text for the "next" directionNav item
    });




    function header() {


        var windowHeight = $(window).height();
        var windowWidth = $(window).width();



        var slider = $(".home-slider .flexslider");

        slider.css("height", windowHeight);
		
		
		var captionHeight = windowHeight / 7 ;
		

		
		$(".home-slider .flex-caption img").css("margin-top", captionHeight);
		
		
		
		

    }



    header();


    $(window).resize(function() {
        header();
    });
	

   
   $(function(){
   $('.home-slider a[href^="#"]').click(function(){
        var target = $(this).attr('href');
        $('html, body').animate({scrollTop: $(target).offset().top}, 700);
        return false; 
   }); 
});




    /////////////////////////////////////
    //  Sly Scroll Slider
    /////////////////////////////////////




    if ($('.portfolio-frame').length > 0) {

        // Portfolio
        var $frame = $('.portfolio-frame'),
            $wrap = $frame.parent();

        if ($frame.length) {
            var portfolio_slider = new Sly($frame, {
                horizontal: 1,
                itemNav: 'basic',
                smart: 1,
                mouseDragging: 1,
                touchDragging: 1,
                releaseSwing: 1,
                scrollBar: $wrap.find('.sly_scrollbar'),
                speed: 300,
                elasticBounds: 1,
                easing: 'easeOutExpo',
                dragHandle: 1,
                dynamicHandle: 1,
                clickBar: 1
            });
        }

    }

    $('.portfolio-filter li:first-child a').addClass("btn-primary")


    if ($('.team-frame').length > 0) {

        // Team
        var $frame = $('.team-frame'),
            $wrap = $frame.parent();

        if ($frame.length) {
            var team_slider = new Sly($frame, {
                horizontal: 1,
                itemNav: 'basic',
                smart: 1,
                mouseDragging: 1,
                touchDragging: 1,
                releaseSwing: 1,
                scrollBar: $wrap.find('.sly_scrollbar'),
                speed: 300,
                elasticBounds: 1,
                easing: 'easeOutExpo',
                dragHandle: 1,
                dynamicHandle: 1,
                clickBar: 1,
            });
        }


    }



    if ($('.reviews-frame').length > 0) {




        // Reviews
        var $frame = $('.reviews-frame'),
            $wrap = $frame.parent();




        if ($frame.length) {
            var reviews_slider = new Sly($frame, {
                horizontal: 1,
                itemNav: 'basic',
                smart: 1,
                mouseDragging: 1,
                touchDragging: 1,
                releaseSwing: 1,
                scrollBar: $wrap.find('.sly_scrollbar'),
                speed: 300,
                elasticBounds: 1,
                easing: 'easeOutExpo',
                dragHandle: 1,
                dynamicHandle: 1,
                clickBar: 1,

                // Buttons
                prevPage: $wrap.find('.prev-page'),
                nextPage: $wrap.find('.next-page')
            });
        }


    }



    /////////////////////////////////////
    //  jQuery prettyPhoto, lightbox
    /////////////////////////////////////

    $("a[rel^='zoomPhoto']").magnificPopup({
        type: 'image'
    });

    $("a.zoomPhoto").magnificPopup({
        type: 'image'
    });




    $(".video-popab").prettyPhoto({
        changepicturecallback: function() {
            $('.pp_pic_holder').show();


            theme: 'dark_square'
        }
    });



    /////////////////////////////////////
    //  jQuery isotope
    /////////////////////////////////////



    $('.portfolio-filter  a').click();

    var $portfolio = $('.portfolio-slider'),
        $portfolio_items = $portfolio.find('.portfolio-item');

    $portfolio.imagesLoaded(function() {


        var wW = $(window).width()

        if ($(".row-view").hasClass("row-one")) {
            var rows = 1;
           // $portfolio_items.css('width', wW - 30 + 'px');
        } else {
            var rows = 2;
        }



        $portfolio.css('height', ((get_max($portfolio_items) + 40) * rows) + 'px');




        $portfolio.isotope({
            onLayout: function() {
                sticky_header();
            },
            itemSelector: $portfolio_items,
           // layoutMode: 'fitColumns'
		      isFitWidth: true ,
        }, function() {
            if ($('.portfolio-filter').length > 0) {
                portfolio_slider.init();
            }
            if ($('.team-frame').length > 0) {
                team_slider.init();
            }
            if ($('.reviews-frame').length > 0) {
                reviews_slider.init();
            }
        });




    });



    if ($('.portfolio-filter').length > 0) {
        portfolio_slider.init();
    }
    if ($('.team-frame').length > 0) {
        team_slider.init();
    }
    if ($('.reviews-frame').length > 0) {
        reviews_slider.init();
    }


    /* Isotope filtering */
    $('.portfolio-filter a').on('click', function() {
        $(this).closest('ul').find('.btn-primary').removeClass('btn-primary').addClass('btn-default');
        $(this).addClass('btn-primary');
        var selector = $(this).attr('data-filter');
        $portfolio.isotope({
            filter: selector
        });
        return false;
    });




    $(window).on('smartresize', function() {
        sticky_header();
    });

    sticky_header();

    /////////////////////////////////////
    //  Sticky Header
    /////////////////////////////////////


    if ($('body').length) {
        $(window).on('scroll', function() {
            var winH = $(window).scrollTop();
            var $pageHeader = $('.page-header');
            if (winH > 60) {
                $pageHeader.addClass('sticky');
            } else {
                $pageHeader.removeClass('sticky');
            }
        });
    }




    // set margin top for inner pages with fixed header
    function fix_content_margin() {
        var phH = $('.page-header').height();
        var mt = (phH > 100) ? phH : 100 - phH;
        $('.inner-page.sticky-header #main').css('margin-top', mt);
    }
    fix_content_margin();


    function sticky_header() {
        // Destory All waypoints
        $.waypoints('destroy');

        // Hashchange event
        onHashChange();

        fix_content_margin();

        // Change active class on scroll to sections
        $('body:not(.inner-page) .section').waypoint({
            handler: function(direction) {
                // add active class to reached waypoint
                var $active_section;
                $active_section = $(this);
                if (direction === 'up') $active_section = $active_section.prev();
                $('.menu').find('.active').removeClass('active');
                $('.menu').find('a[href="#' + $active_section[0].id + '"]').parent().addClass('active');
            },
            offset: '15%'
        });

        try {
            portfolio_slider.reload();
            team_slider.reload();
            tweet_slider_width();
            reviews_slider.reload();
        } catch (err) {}




        /////////////////////////////////////
        //  animate elements when they are in viewport
        /////////////////////////////////////




        $('.noIE .animated:not(.animation-done)').waypoint(function() {



            var animation = $(this).data('animation');

            $(this).addClass('animation-done').addClass(animation);

        }, {
            triggerOnce: true,
            offset: '95%'
        });

    }




    /////////////////////////////////////
    //  Hashchange & ScrollTo Plugin
    /////////////////////////////////////




    function onHashChange() {
        $(window).bind('hashchange', function(e) {
            e.preventDefault();
            try {
                var target = '#' + window.location.hash.substring(1),
                    $target = $(target);
            } catch (e) {
                // console.debug(e.message);
            }
            if ($target === undefined || !target || $target.length == 0) return false;

            /*
                        $('body').scrollTo($target, 500, {
                            easing: 'easeInQuad'
                        }, function() {
                            sticky_header();
                        });*/
            return false;
        });




        $(window).trigger('hashchange');
        $('.menu li > a, .scrollto').on('click', function(e) {
            if ($(e.target) === undefined || $(e.target).length == 0) return false;
            $(window).unbind('hashchange');

            $(window).bind('hashchange');
        });
    }




    function get_max($el) {
        /* Get max height */
        var max = 0;
        $el.each(function() {
            var this_h = $(this).outerHeight();
            if (this_h > max) max = this_h;
        });
        return max;
    }




    $('aside li:last-child').addClass("last-item");



});