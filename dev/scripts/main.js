(function($){

	var script = {};

	/* Define Functions */

	script.slider = function(){

		$('#homepage-slider').slick({
			dots: false,
			arrows: false,
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 4000,
			centerMode: true,
			centerPadding: 0
		});

	};

	script.menu = function(){
		$('#hamburger button').click(function(){
			$('nav').toggleClass('active');
		})
	}

	script.localscroll = function(){
		$(document).on('click', 'a[href^="#"]', function (event) {
			event.preventDefault();
			$('html, body').animate({
				scrollTop: ( $($.attr(this, 'href')).offset().top - 100 )
			}, 500);
		});
	}

	/* Start Functions */

	$(document).ready(function() {

		script.slider();
		script.menu();
		script.localscroll();

	});

})(jQuery);
