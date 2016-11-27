(function($){

	var script = {};
		
	/* Define Functions */
	
	script.dummy = function(){
		
		console.log('dummy');

	};
	
	/* Start Functions */
	
	$(document).ready(function() {
		
		script.dummy();
		
	});
	
})(jQuery);
