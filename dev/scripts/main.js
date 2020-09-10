(function($){

	var script = {};

	/* Define Functions */

	script.fadeonscroll = function() {
		$(document).on('scroll', function () {
			var pageTop = $(document).scrollTop();
			var pageBottom = pageTop + $(window).height();
			var tags = $('section');

			for (var i = 0; i < tags.length; i++) {
				var tag = tags[i];

				if ($(tag).position().top < pageBottom) {
					$(tag).addClass('visible');
				} else {
					$(tag).removeClass('visible');
				}
			}
		});
	};

	script.slider = function(){
		$('#homepage-slider').slick({
			dots: true,
			arrows: true,
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 4000,
			centerMode: true,
			centerPadding: 0,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 1,
						dots: false,
					}
				}
			]
		});

		$('.lavori-media-galleria-list-center').slick({
			dots: true,
			arrows: false,
			infinite: false,
			slidesToShow: 1,
			centerMode: true,
			variableWidth: true
		});

		$('.lavori-media-galleria-list-left').slick({
			dots: true,
			arrows: false,
			infinite: false,
			slidesToShow: 4,
			variableWidth: true
		});

		$('.archive-clienti .archive-settore-list').slick({
			dots: true,
			arrows: false,
			infinite: false,
			slidesToShow: 4,
		});

		$('#cliente #cliente-nav-slider').slick({
			dots: true,
			arrows: false,
			infinite: true,
			slidesToShow: 6,
			slidesToScroll: 6,
			autoplay: true,
			autoplaySpeed: 4000,
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3
					}
				},{
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		});

		$('#homepage-slider').on('wheel', (function(e) {
			e.preventDefault();

			if (e.originalEvent.deltaY < 0) {
				$(this).slick('slickPrev');
			} else {
				$(this).slick('slickNext');
			}
		}));
	};

	script.menu = function(){
		$('#logo').click(function(event){
			event.preventDefault();
			$('nav').toggleClass('active');
		});

		$(document).keyup(function(event) {
			if (event.keyCode === 27){
				$('nav').removeClass('active');
			}
		});

		$('.nav-col-outern').click(function(){
			$('nav').removeClass('active');
		});
	};

	script.localscroll = function(){
		$(document).on('click', 'a[href^="#"]', function (event) {
			event.preventDefault();
			$('html, body').animate({
				scrollTop: ( $($.attr(this, 'href')).offset().top - 100 )
			}, 500);
		});
	};

	script.localscrollnewpage = function(){
		// store the hash (DON'T put this code inside the $() function, it has to be executed
		// right away before the browser can start scrolling!
		var target = window.location.hash,
			target = target.replace('#', '');

		// delete hash so the page won't scroll to it
		window.location.hash = '';

		// now whenever you are ready do whatever you want
		// (in this case I use jQuery to scroll to the tag after the page has loaded)
		$(window).load(function() {
			if (target) {
				$('html, body').animate({
					scrollTop: ($('#' + target).offset().top - 100 )
				}, 1500);
			}
		});
	};

	/* Start Functions */

	$(document).ready(function() {

		script.fadeonscroll();
		script.slider();
		script.menu();
		script.localscroll();
		script.localscrollnewpage();

	});

	$(window).on('load', function() {
		console.log('Loaded...');

		setTimeout(function(){
			$('body').addClass('body-ready');
		}, 500);
	});

})(jQuery);
