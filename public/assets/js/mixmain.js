!function(e){"use strict";function s(){e("[data-bgimg]").each(function(){var s=e(this).data("bgimg");e(this).css({"background-image":"url("+s+")"})})}function o(){return!!e("html").hasClass("rtl")}function i(s){"success"===s.result?(e(".mailchimp-success").addClass("active"),e(".mailchimp-success").html(""+s.msg).fadeIn(900),e(".mailchimp-error").fadeOut(400)):"error"===s.result&&e(".mailchimp-error").html(""+s.msg).fadeIn(900)}(new WOW).init(),e(window).on("load",function(){s()}),e(window).on("scroll",function(){e(window).scrollTop()<100?e(".sticky-header").removeClass("sticky"):e(".sticky-header").addClass("sticky")}),e(".slider_area").owlCarousel({animateOut:"fadeOut",autoplay:!0,loop:!0,nav:!0,autoplay:!1,autoplayTimeout:8e3,items:1,dots:!0,rtl:o(),navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']}),e(".product_column3").slick({centerMode:!0,centerPadding:"0",slidesToShow:3,arrows:!0,rows:2,rtl:o(),prevArrow:'<button class="prev_arrow"><i class="fa fa-angle-left"></i></button>',nextArrow:'<button class="next_arrow"><i class="fa fa-angle-right"></i></button>',responsive:[{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}},{breakpoint:768,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:992,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:1200,settings:{slidesToShow:2,slidesToScroll:2}}]}),e(".product_column4").slick({centerMode:!0,centerPadding:"0",slidesToShow:4,arrows:!0,rows:2,rtl:o(),prevArrow:'<button class="prev_arrow"><i class="fa fa-angle-left"></i></button>',nextArrow:'<button class="next_arrow"><i class="fa fa-angle-right"></i></button>',responsive:[{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}},{breakpoint:768,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:992,settings:{slidesToShow:3,slidesToScroll:3}}]}),e(".product_rows_column4").slick({centerMode:!0,centerPadding:"0",slidesToShow:4,arrows:!0,rows:3,rtl:o(),prevArrow:'<button class="prev_arrow"><i class="fa fa-angle-left"></i></button>',nextArrow:'<button class="next_arrow"><i class="fa fa-angle-right"></i></button>',responsive:[{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}},{breakpoint:768,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:992,settings:{slidesToShow:3,slidesToScroll:3}}]}),e(".product_row1").slick({centerMode:!0,centerPadding:"0",slidesToShow:4,arrows:!0,rtl:o(),prevArrow:'<button class="prev_arrow"><i class="fa fa-angle-left"></i></button>',nextArrow:'<button class="next_arrow"><i class="fa fa-angle-right"></i></button>',responsive:[{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}},{breakpoint:768,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:992,settings:{slidesToShow:3,slidesToScroll:3}}]}),e(".product_slick_column5").slick({centerMode:!0,centerPadding:"0",slidesToShow:5,arrows:!0,rtl:o(),prevArrow:'<button class="prev_arrow"><i class="fa fa-angle-left"></i></button>',nextArrow:'<button class="next_arrow"><i class="fa fa-angle-right"></i></button>',responsive:[{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}},{breakpoint:768,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:992,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:1200,settings:{slidesToShow:4,slidesToScroll:4}}]}),e(".product_column5").slick({centerMode:!0,centerPadding:"0",slidesToShow:5,arrows:!0,rows:2,rtl:o(),prevArrow:'<button class="prev_arrow"><i class="fa fa-angle-left"></i></button>',nextArrow:'<button class="next_arrow"><i class="fa fa-angle-right"></i></button>',responsive:[{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}},{breakpoint:768,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:992,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:1200,settings:{slidesToShow:4,slidesToScroll:4}}]}),e(".blog_column3").owlCarousel({autoplay:!0,loop:!0,nav:!0,autoplay:!1,rtl:o(),autoplayTimeout:8e3,items:3,dots:!1,navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],responsiveClass:!0,responsive:{0:{items:1},768:{items:2},992:{items:3}}}),e(".instagram_column5").owlCarousel({autoplay:!0,loop:!0,nav:!0,autoplay:!1,rtl:o(),autoplayTimeout:8e3,items:5,dots:!1,navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],responsiveClass:!0,responsive:{0:{items:1},500:{items:2},768:{items:3},992:{items:4},1200:{items:5}}}),e(".shipping_column5").owlCarousel({autoplay:!0,loop:!0,nav:!1,autoplay:!1,rtl:o(),autoplayTimeout:8e3,items:6,dots:!1,responsiveClass:!0,responsive:{0:{items:1},320:{items:2},480:{items:3},768:{items:4},992:{items:5},1200:{items:6}}}),e(".product_three_column4").owlCarousel({autoplay:!0,loop:!0,nav:!0,autoplay:!1,rtl:o(),autoplayTimeout:8e3,items:4,dots:!1,navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],responsiveClass:!0,responsive:{0:{items:1},480:{items:2},768:{items:3},992:{items:4}}}),e(".single-product-active").owlCarousel({autoplay:!0,loop:!0,nav:!0,autoplay:!1,rtl:o(),autoplayTimeout:8e3,items:4,margin:15,dots:!1,navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],responsiveClass:!0,responsive:{0:{items:1},320:{items:2},992:{items:3},1200:{items:4}}}),e(".blog_thumb_active").owlCarousel({autoplay:!0,loop:!0,nav:!0,autoplay:!1,rtl:o(),autoplayTimeout:8e3,items:1,dots:!1,navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']}),e(".product_navactive").owlCarousel({autoplay:!0,loop:!0,nav:!0,autoplay:!1,rtl:o(),autoplayTimeout:8e3,items:4,dots:!1,navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],responsiveClass:!0,responsive:{0:{items:1},250:{items:2},480:{items:3},768:{items:4}}}),e(".modal").on("shown.bs.modal",function(s){e(".product_navactive").resize()}),e(".product_navactive a").on("click",function(s){s.preventDefault();var o=e(this).attr("href");e(".product_navactive a").removeClass("active"),e(this).addClass("active"),e(".product-details-large .tab-pane").removeClass("active show"),e(".product-details-large "+o).addClass("active show")}),e("#mc-form").ajaxChimp({language:"en",callback:i,url:"http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"}),e(".instagram_pupop").magnificPopup({type:"image",gallery:{enabled:!0}}),e(".video_popup").magnificPopup({type:"iframe",removalDelay:300,mainClass:"mfp-fade"}),e(".port_popup").magnificPopup({type:"image",gallery:{enabled:!0}}),e(".select_option").niceSelect(),e(".faequently-accordion").collapse({accordion:!0,open:function(){this.slideDown(300)},close:function(){this.slideUp(300)}}),e(".counter_number").counterUp({delay:10,time:1e3}),e.scrollUp({scrollText:'<i class="fa fa-angle-double-up"></i>',easingType:"linear",scrollSpeed:900,animation:"fade"}),e(".currency > a,.language > a,.top_links > a").on("click",function(){e(this).removeAttr("href"),e(this).toggleClass("open").next(".dropdown_currency,.dropdown_language,.dropdown_links").toggleClass("open"),e(this).parents().siblings().find(".dropdown_currency,.dropdown_language,.dropdown_links").removeClass("open")}),e("body").on("click",function(s){var o=s.target;e(o).is(".currency > a,.language > a,.top_links > a")||e(".dropdown_currency,.dropdown_language,.dropdown_links").removeClass("open")}),e(".cart_link > a").on("click",function(s){e(window).width()<991&&e(".mini_cart").slideToggle("medium")}),e(".home_page_mennu").on("click",function(){e(".dropdown_home_menu").slideToggle("medium")}),e(".blog_menu").on("click",function(){e(".dropdown_blog_menu").slideToggle("medium")}),e(".other_page_menu").on("click",function(){e(".dropdown_other_page_menu").slideToggle("medium")}),e(".shop_menu_items").on("click",function(){e(".dropdown_shop_items").slideToggle("medium")}),e(".shop_menu_items2").on("click",function(){e(".dropdown_shop_items2").slideToggle("medium")}),e(".shop_menu_items3").on("click",function(){e(".dropdown_shop_items3").slideToggle("medium")}),e(".icone_menu > a").on("click",function(){e(this).removeAttr("href"),e(this).toggleClass("open").next(".home_menu_inner").toggleClass("open"),e(this).parents().siblings().find(".home_menu_inner").removeClass("open")}),e(".shop_menu > a").on("click",function(){e(this).removeAttr("href"),e(this).toggleClass("open").next(".dropdown_shop_menu").toggleClass("open"),e(this).parents().siblings().find(".dropdown_shop_menu").removeClass("open")}),e(".footer_show_button > a").on("click",function(){e(this).removeAttr("href"),e(this).toggleClass("open").next(".footer_widgets_inner").toggleClass("open"),e(this).parents().siblings().find(".footer_widgets_inner").removeClass("open")}),e(".search_btn").on("click",function(){e(this).removeAttr("href"),e(".dropdown_search_btn").addClass("active")}),e(".button_close").on("click",function(){e(".dropdown_search_btn").removeClass("active")}),e(".box_setting > a").on("click",function(){e(".dropdown_box_setting").slideToggle("medium")}),e("[data-countdown]").each(function(){var s=e(this),o=e(this).data("countdown");s.countdown(o,function(e){s.html(e.strftime('<div class="countdown_area"><div class="single_countdown"><div class="countdown_number">%D</div><div class="countdown_title">days</div></div><div class="single_countdown"><div class="countdown_number">%H</div><div class="countdown_title">hrs</div></div><div class="single_countdown"><div class="countdown_number">%M</div><div class="countdown_title">mins</div></div><div class="single_countdown"><div class="countdown_number">%S</div><div class="countdown_title">secs</div></div></div>'))})}),e("#slider-range").slider({range:!0,min:50,max:500,values:[0,500],slide:function(s,o){e("#amount").val("$"+o.values[0]+" - $"+o.values[1])}}),e("#amount").val("$"+e("#slider-range").slider("values",0)+" - $"+e("#slider-range").slider("values",1)),e(".niceselect_option").niceSelect(),e('[data-toggle="tooltip"]').tooltip(),e("#zoom1").elevateZoom({gallery:"gallery_01",responsive:!0,cursor:"crosshair",zoomType:"inner"}),e(".portfolio_gallery").imagesLoaded(function(){var s=e(".portfolio_gallery").isotope({itemSelector:".gird_item",percentPosition:!0,masonry:{columnWidth:".gird_item"}});e(".portfolio_button").on("click","button",function(){var o=e(this).attr("data-filter");s.isotope({filter:o}),e(this).siblings(".active").removeClass("active"),e(this).addClass("active")})}),setTimeout(function(){1==e.cookie("shownewsletter")&&e(".newletter-popup").hide(),e("#subscribe_pemail").keypress(function(s){13==s.which&&(s.preventDefault(),email_subscribepopup());var o=e(this).val();e("#subscribe_pname").val(o)}),e("#subscribe_pemail").change(function(){var s=e(this).val();e("#subscribe_pname").val(s)}),1!=e.cookie("shownewsletter")&&e(".newletter-popup").bPopup(),e("#newsletter_popup_dont_show_again").on("change",function(){1!=e.cookie("shownewsletter")?e.cookie("shownewsletter","1"):e.cookie("shownewsletter","0")})},2e3),e(".shop_toolbar_btn > button").on("click",function(s){s.preventDefault(),e(".shop_toolbar_btn > button").removeClass("active"),e(this).addClass("active");var o=e(".shop_wrapper"),i=e(this).data("role");o.removeClass("grid_3 grid_4 grid_5 grid_list").addClass(i),"grid_3"==i&&o.children().addClass("col-lg-4 col-md-4 col-sm-6").removeClass("col-lg-3 col-cust-5 col-12"),"grid_4"==i&&o.children().addClass("col-lg-3 col-md-4 col-sm-6").removeClass("col-lg-4 col-cust-5 col-12"),"grid_5"==i&&o.children().addClass("col-cust-5 col-md-4 col-sm-6").removeClass("col-lg-3 col-lg-4 col-12"),"grid_list"==i&&o.children().addClass("col-12").removeClass("col-lg-3 col-lg-4 col-md-4 col-sm-6 col-cust-5")}),e(".canvas_open").on("click",function(){e(".offcanvas_menu_wrapper,.off_canvars_overlay").addClass("active")}),e(".canvas_close,.off_canvars_overlay").on("click",function(){e(".offcanvas_menu_wrapper,.off_canvars_overlay").removeClass("active")});var t=e(".offcanvas_main_menu"),l=t.find(".sub-menu");l.parent().prepend('<span class="menu-expand"><i class="fa fa-angle-down"></i></span>'),l.slideUp(),t.on("click","li a, li .menu-expand",function(s){var o=e(this);o.parent().attr("class").match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/)&&("#"===o.attr("href")||o.hasClass("menu-expand"))&&(s.preventDefault(),o.siblings("ul:visible").length?o.siblings("ul").slideUp("slow"):(o.closest("li").siblings("li").find("ul:visible").slideUp("slow"),o.siblings("ul").slideDown("slow"))),o.is("a")||o.is("span")||o.attr("clas").match(/\b(menu-expand)\b/)?o.parent().toggleClass("menu-open"):o.is("li")&&o.attr("class").match(/\b('menu-item-has-children')\b/)&&o.toggleClass("menu-open")}),e(".js-ripples").ripples({resolution:512,dropRadius:20,perturbance:.04})}(jQuery);