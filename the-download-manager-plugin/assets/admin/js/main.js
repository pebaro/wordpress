(function($) {
	$(document).ready(function() {
		// Common form scripts to run
		if($('#download-manager-form').length){
			toggle_control();

			// $('#download-link').on('blur', function(){
			// 	var request;
			// 	request = $.ajax({
			// 		type: "HEAD",
			// 		url: $(this).val(),
			// 	})
			// 	.done(function() {
			// 		var fileSize = request.getResponseHeader("Content-Length");
			// 		if(fileSize > 0){
			// 			// Update the field value
			// 			$('#download-size').val(bytesToSize(fileSize));

			// 			// Remove any warnings if we have them
			// 			if($('#download-size-warning').length){
			// 				$('#download-size-warning').remove();
			// 			}
			// 		} else {
			// 			// If file size is 0 or less show an error
			// 			if($('#download-size-warning').length === 0){
			// 				$('#download-size').val('').after('<small id="download-size-warning" class="required">There was an issue retrieving the file size.</small>');
			// 			}
			// 		}
			// 	})
			// 	.fail(function() {
			// 		if($('#download-size-warning').length === 0){
			// 			$('#download-size').val('').after('<small id="download-size-warning" class="required">There was an issue retrieving the file size.</small>');
			// 		}
			// 	});
			// });

			// $('#download-size').on('change', function(){
			// 	if($('#download-size-warning').length){
			// 		$('#download-size-warning').remove();
			// 	}
			// });
		}

		// Only fires on pages with the download file form
		if($('#download-requests').length){
			$(document).on('change', 'select[name="request-status"]', function(){
				var table_row = $(this).parents('tr');

				// Lets disable the field while we are running our code
				$(this).prop('disabled', true);

				// Make an ajax call to change the status
				// NOTE: ajaxurl is declared in the admin area already
				$.post(
					ajaxurl,
					{
						'action' : 'download_request_change',
						'new_status' : $(this).val(),
						'user_id' : $(this).data("user"),
						'download_id' : $(this).data("request")
					}
				).done(function( statuses ){
					statuses = $.parseJSON(statuses);

					// If the other table has no results remove that row for our new one.
					if($('.download-request-' + statuses.new_status + ' .empty').length){
						$('.download-request-' + statuses.new_status + ' .empty').remove();
					}

					// Clone our row into a new table with the changed value
					$('.download-request-' + statuses.new_status + ' tr:last').after($(table_row).clone());
					$('.download-request-' + statuses.new_status + ' tr:last').find('select').val(statuses.new_status);

					// Update the stats at the top
					var new_status_count = $('.' + statuses.new_status + '-requests .badge').text();
					var old_status_count = $('.' + statuses.old_status + '-requests .badge').text();

					$('.' + statuses.new_status + '-requests .badge').text( parseInt(new_status_count, 10) + 1 );
					$('.' + statuses.old_status + '-requests .badge').text( parseInt(old_status_count, 10) - 1 );

					// Remove the row that was changed
					$.when($(table_row).fadeOut().remove()).then( function(){
						if($('.download-request-' + statuses.old_status + ' tr').length == 1){
							$('.download-request-' + statuses.old_status + ' tbody').after('<tr><td class="empty" colspan="5">There are no ' + statuses.old_status + ' requests.</td></tr>');
						}
					});

				}).fail(function( data ){
					alert('There was an AJAX error, The request status has not been changed.');
				});

				// enable the field again
				$(this).prop('disabled', false);
			});
		}
	});

	/**
	 * Handles all the toggle checkboxes for hiding and showing elements.
	 */
	function toggle_control(){
		// On page load
		$('input[type="checkbox"].checkbox-toggle-key').each(function(){
			if($(this).is(':checked')){
				$(this).parents('.checkbox').next('.checkbox-toggle').show();
			}
		});

		// Listening for changes
		$('input[type="checkbox"].checkbox-toggle-key').change(function(){
			if($(this).is(':checked')){
				$(this).parents('.checkbox').next('.checkbox-toggle').slideDown();
			} else {
				$(this).parents('.checkbox').next('.checkbox-toggle').slideUp();
			}
		});
	}

	/**
	 * Convert Bytes to a useable measurment.
	 * @param  int  	bytes	The number of bytes
	 * @return string 			of total bytes
	 */
	function bytesToSize(bytes) {
		if(bytes == 0) return '0 Byte';
		var k = 1024;
		var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
		var i = Math.floor(Math.log(bytes) / Math.log(k));
		return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
	}


})(jQuery); // Allow us to use the $ sybmol for jQuery