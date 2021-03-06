import '@popperjs/core';
import 'bootstrap';

(function ($) {

	var script = {};

	/* Define Functions */

	script.slider = function(){
		$('#slider').slick({
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 2000,
			arrows: false,
			dots: true,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 1
					}
				}
			]
		});
	};

	script.localscroll = function(){
		$(document).on('click', 'a[href^="#"]', function (event) {
			event.preventDefault();

			var a = $.attr(this, 'href');
			$('html, body').animate({
				scrollTop: $(a).offset().top
			}, 500);
		});
	};

	/* Start Functions */

	$(document).ready(function() {

		script.slider();
		script.localscroll();

	});

	$(window).on('load', function() {
		console.log('Loaded...');

		setTimeout(function(){
			$('body').addClass('body-ready');
		}, 500);
	});

})(jQuery);
