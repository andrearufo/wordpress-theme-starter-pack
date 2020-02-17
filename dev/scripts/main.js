(function($){

	var script = {};

	/* Define Functions */

	script.slider = function(){

		$('#slide').slick({
			dots: true,
			arrows: false
		});

	};

	/* Start Functions */

	$(document).ready(function() {

		script.slider();

	});

})(jQuery);
