!function(s){var o={fadeonscroll:function(){s(document).on("scroll",function(){for(var o=s(document).scrollTop()+s(window).height(),e=s("section"),i=0;i<e.length;i++){var l=e[i];s(l).position().top<o?s(l).addClass("visible"):s(l).removeClass("visible")}})},slider:function(){s("#homepage-slider").slick({dots:!0,arrows:!0,infinite:!0,slidesToShow:3,slidesToScroll:1,autoplay:!0,autoplaySpeed:4e3,centerMode:!0,centerPadding:0,responsive:[{breakpoint:1024,settings:{slidesToShow:1,dots:!1}}]}),s(".lavori-media-galleria-list-center").slick({dots:!0,arrows:!1,infinite:!1,slidesToShow:1,centerMode:!0,variableWidth:!0}),s(".lavori-media-galleria-list-left").slick({dots:!0,arrows:!1,infinite:!1,slidesToShow:4,variableWidth:!0}),s(".archive-clienti .archive-settore-list").slick({dots:!0,arrows:!1,infinite:!1,slidesToShow:4}),s("#cliente #cliente-nav-slider").slick({dots:!0,arrows:!1,infinite:!0,slidesToShow:6,slidesToScroll:6,autoplay:!0,autoplaySpeed:4e3,responsive:[{breakpoint:1200,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:768,settings:{slidesToShow:1,slidesToScroll:1}}]}),s("#homepage-slider").on("wheel",function(o){o.preventDefault(),o.originalEvent.deltaY<0?s(this).slick("slickPrev"):s(this).slick("slickNext")})},menu:function(){s("#logo").click(function(o){o.preventDefault(),s("nav").toggleClass("active")}),s(document).keyup(function(o){27===o.keyCode&&s("nav").removeClass("active")}),s(".nav-col-outern").click(function(){s("nav").removeClass("active")})},localscroll:function(){s(document).on("click",'a[href^="#"]',function(o){o.preventDefault(),s("html, body").animate({scrollTop:s(s.attr(this,"href")).offset().top-100},500)})},localscrollnewpage:function(){var o=(o=window.location.hash).replace("#","");window.location.hash="",s(window).load(function(){o&&s("html, body").animate({scrollTop:s("#"+o).offset().top-100},1500)})}};s(document).ready(function(){o.fadeonscroll(),o.slider(),o.menu(),o.localscroll(),o.localscrollnewpage()}),s(window).on("load",function(){console.log("Loaded..."),setTimeout(function(){s("body").addClass("body-ready")},500)})}(jQuery);