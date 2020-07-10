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
			arrows: false,
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
					}
				}
			]
		});
	};

	script.menu = function(){
		$('#logo').click(function(event){
			event.preventDefault();
			$('nav').toggleClass('active');
		});

		$(document).keyup(function() {
			if (e.keyCode === 27){
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

	script.galleria = function(){
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
			slidesToShow: 3,
			variableWidth: true
		});
	};

	/* Start Functions */

	$(document).ready(function() {

		script.fadeonscroll();
		script.slider();
		script.menu();
		script.localscroll();
		script.galleria();

	});

	$(window).on('load', function() {
		console.log('Loaded...');

		setTimeout(function(){
			$('body').addClass('body-ready');
		}, 500);

		script.localscroll();
	});

})(jQuery);
