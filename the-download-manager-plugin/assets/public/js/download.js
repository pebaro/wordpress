(function($) {
	$(document).ready(function(){
		/**
		 * Check if a notice is displayed and add a click event to close it.
		 */
		if($('.download-notice').length){
			$('.download-notice .close-download-notice').on('click', function(){
				$('.download-notice').slideUp();
			});
		}

		/**
		 * Have a link submit the hidden form
		 */
		if($('a.download-request-submit').length){
			$('a.download-request-submit').on('click', function(){
				$(this).parents('form').submit();
			});
		}
	});
})(jQuery);