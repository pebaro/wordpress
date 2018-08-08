<div id="download-requests" class="download-plugin">
	<h2>Download Requests for the <?php echo get_blog_option( $blog_id, 'blogname' ); ?> site</h2>
	<?php
		// Get only users with a download_requests meta
		$user_query_args	= array(
									'meta_key' => 'download_requests',
									'fields' => array('ID', 'user_login', 'user_nicename', 'user_email', 'display_name')
								);

		$user_query = new WP_User_Query( $user_query_args );

		// Pull out the results from the query to use
		$user_download_requests = $user_query->get_results();

		// Initialize some values to use
		$total_requests_pending = 0;
		$user_requests_pending = array( 'status' => 'Pending', 'results' => array()  );

		$total_requests_accepted = 0;
		$user_requests_accepted = array( 'status' => 'Accepted', 'results' => array() );

		$total_requests_denied = 0;
		$user_requests_denied = array( 'status' => 'Denied', 'results' => array() );

		// used for displaying results on a per site basis
		//$blogname = get_blog_option( $blog_id, 'blogname' );
		$blog_id = get_current_blog_id();

		// Build up the user array to include the download_requests meta
		foreach ($user_download_requests as $user_request_key => $user_request) {
			$download_requests = get_user_meta( $user_request->ID, 'download_requests', true );
			// Build up some usefull arrays from our data.
			if(is_array($download_requests)){
				foreach ($download_requests as $request) {
					switch ($request['download_status']) {
						case 'pending':
							if(in_array($blog_id, $request) || !in_array($blog_id, $request)){
								$total_requests_pending++;
								if(!isset($user_requests_pending['results'][$user_request->ID])){
										$user_requests_pending['results'][$user_request->ID] = clone $user_request;
								}
								$user_requests_pending['results'][$user_request->ID]->download_requests[] = $request;
							}
							break;

						case 'accepted':
							if(in_array($blog_id, $request) || !in_array($blog_id, $request)){
								$total_requests_accepted++;
								if(!isset($user_requests_accepted['results'][$user_request->ID])){
									$user_requests_accepted['results'][$user_request->ID] = clone $user_request;
								}
								$user_requests_accepted['results'][$user_request->ID]->download_requests[] = $request;
							}
							if(!in_array($blog_id, $request)){
								update_user_meta($user_id, 'download_requests', $blog_id);
							}
							break;

						case 'denied':
							if(in_array($blog_id, $request) || !in_array($blog_id, $request)){
								$total_requests_denied++;
								if(!isset($user_requests_denied['results'][$user_request->ID])){
									$user_requests_denied['results'][$user_request->ID] = clone $user_request;
								}
								$user_requests_denied['results'][$user_request->ID]->download_requests[] = $request;
							}
							break;
					}
				}
			}
		}
	?>

	<ul class="nav nav-tabs" role="tablist">
		<li class="active">
			<a href="#pending-requests" class="pending-requests" role="tab" data-toggle="tab">Pending (ALL Sites) <span class="badge"><?php echo $total_requests_pending; ?></span></a>
		</li>
		<li>
			<a href="#accepted-requests" class="accepted-requests" role="tab" data-toggle="tab">Accepted (ALL Sites) <span class="badge"><?php echo $total_requests_accepted; ?></span></a>
		</li>
		<li>
			<a href="#denied-requests" class="denied-requests" role="tab" data-toggle="tab">Denied (ALL Sites) <span class="badge"><?php echo $total_requests_denied; ?></span></a>
		</li>
		<li>
			<span class="fake-tab">Total (ALL Sites) <span class="badge"><?php echo ($total_requests_pending + $total_requests_accepted + $total_requests_denied); ?></span></span>
		</li>
	</ul>
	<div class="tab-content requests-tab">
		<div class="tab-pane active" id="pending-requests">
			<?php output_requests_table( $user_requests_pending ); ?>
		</div>
		<div class="tab-pane" id="accepted-requests">
			<?php output_requests_table( $user_requests_accepted ); ?>
		</div>
		<div class="tab-pane" id="denied-requests">
			<?php output_requests_table( $user_requests_denied ); ?>
		</div>

	</div>
</div>
<script type="text/javascript">
	(function($){

		// script to show & hide intended use descriptions
		var // cache elements
			intended_use = $('a.intended-use'),
			iud = $('div.iud'),
			description = $('div.description');
		// show/hide description
		intended_use.on('click', function () {
			// cache this
			var $this = $(this);
			$this.closest(iud).find(description).slideToggle();
		});


		// temporary script to hide records relevant to a different admin panel
		// delete this script when requests are handled properly on a per site basis
		// cache element
		var record = $('tr.record');

	    record.each(function() {
	    	// cache this
	    	var $this = $(this);
	    	// cell for file name 
	        var cell = $.trim($this.find('td.filename').text());
	        // hide the row if file name cell is empty
	        if (cell.length === 0){
	            $this.hide();
	        }                   
	    });

	})(jQuery);
</script>