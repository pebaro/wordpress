<?php
/**
 * Create a table for tracking downloads unless one exists.
 */
function download_tracking_table() {
	global $wpdb;

	$table_name = $wpdb->prefix . "download_tracking";
	$users_table = $wpdb->prefix . "users";
	$posts_table = $wpdb->prefix . "posts";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

		if ( ! empty( $wpdb->charset ) ) {
			$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
		}

		if ( ! empty( $wpdb->collate ) ) {
			$charset_collate .= " COLLATE {$wpdb->collate}";
		}

		$sql = "CREATE TABLE $table_name (
			`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			`download_id` BIGINT(20) UNSIGNED NOT NULL,
			`user_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
			`ip_address` VARCHAR(45) NOT NULL,
			`timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`),
			INDEX `download_id` (`download_id`),
			INDEX `user_id` (`user_id`),
			CONSTRAINT `download_id` FOREIGN KEY (`download_id`) REFERENCES $posts_table (`ID`),
			CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES $users_table (`ID`)
		)
		$charset_collate;
		AUTO_INCREMENT=1;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
}
register_activation_hook(DOWNLOAD_BASE_FILE, 'download_tracking_table');

/**
 * Check for a $_GET variable to display a notice on page load.
 */
function download_redirect_notice() {
    if ( isset( $_GET['download'] ) && $_GET['download'] ){

        switch ( $_GET['download'] ) {
            case 'denied':
                download_notice('You have been redirect. You did not have the permissions for that download.', 'denied');
				break;
			case 'login-required':
				download_notice('You must be logged in to download this file. <a href="'.wp_login_url(get_permalink(get_the_ID())).'" class="btn btn-primary">Login here</a>', 'denied');
				break;
			case 'license-needed':
				download_notice('You must be agreee to the terms to download this file.', 'denied');
				break;
			default:
				exit;
				break;
		}
	}

}
add_action( 'get_header', 'download_redirect_notice', 10, 1 );

/**
 * Do a background check to see if they are allowed to download the link.
 */
function do_download(){

	// Is a download being requested?
	if ( isset( $_GET['do-download'] ) && $_GET['do-download'] ){
		$download_id = $_GET['do-download'];

		// Checks we are dealing with a download
		if( !in_array(get_post_type($download_id), array('downloads', 'downloads-arch')) ){
			return;
		}

		// Check if user needs to be logged in
		if(get_post_meta($download_id, 'download_login_required', true)){
			// Check user is logged in
			if(is_user_logged_in()){
				// If they are whitelisted or an admin let them them download
				if(whitelist_check() || current_user_can( 'edit_posts' )){
					download_and_track($download_id);
				}

				// Check allowed user group settings
				$allowed_groups = get_post_meta( $download_id, 'download_user_roles_allowed', true );
				if( empty($allowed_groups) ){
					// Do they need to agree to anything
					if(license_check( $download_id )){
						// Do they need to request the download
						$approval_result = check_approval($download_id);
						if($approval_result['status'] == true){
							// Let them download the file
							download_and_track($download_id);
						} else {
							wp_redirect( '?download=denied' );
						}
					} else {
						// They still need to sign the terms
						$license_id = get_post_meta( $download_id, 'download_agreement_needed', true );
						wp_redirect( get_permalink($license_id).'?download=license-needed' );
					}
				} elseif(is_array($allowed_groups) && dl_user_has_role($allowed_groups)) {
					// Do they need to agree to anything
					if(license_check( $download_id )){
						// Do they need to request the download
						$approval_result = check_approval($download_id);
						if($approval_result['status'] == true){
							// Let them download the file
							download_and_track($download_id);
						} else {
							wp_redirect( '?download=denied' );
						}
					} else {
						// They still need to sign the terms
						$license_id = get_post_meta( $download_id, 'download_agreement_needed', true );
						wp_redirect( get_permalink($license_id).'?download=license-needed' );
					}
				} else {
					// wrong user group
					wp_redirect( '?download=denied' );
				}
			} else {
				// Register or log in
				wp_redirect( '?download=login-required' );
			}
		} else {
			// Do they need to agree to anything?
			if(license_check($download_id)){
				// Let them download the file
				download_and_track($download_id);
			} else {
				// Make them sign the  terms
				$license_id = get_post_meta( $download_id, 'download_agreement_needed', true );
				wp_redirect( get_permalink($license_id).'?download=license-needed' );
			}
		}
	}
}
add_action( 'template_redirect', 'do_download', 5 );

/**
 * Track the download and send them through to the download.
 * @param  [int] $download_id [post ID of the download]
 */
function download_and_track($download_id){
	// Simple total download tracking
	$dl_count = get_post_meta( $download_id, 'download_count', true );
	$dl_count++;
	update_post_meta( $download_id, 'download_count', $dl_count );

	global $wpdb;

	// If the user is logged in track the ID ELSE don't track it.
	if(get_current_user_id()){
		$wpdb->query(
			$wpdb->prepare(
				"
				INSERT INTO ".$wpdb->prefix."download_tracking
				(download_id, user_id, ip_address)
				VALUES ( %s, %s, %s)
				",
				$download_id, get_current_user_id(), $_SERVER['REMOTE_ADDR']
			)
		);
	} else {
		$wpdb->query(
			$wpdb->prepare(
				"
				INSERT INTO ".$wpdb->prefix."download_tracking
				(download_id, ip_address)
				VALUES ( %s, %s)
				",
				$download_id, $_SERVER['REMOTE_ADDR']
			)
		);
	}

	wp_redirect(get_post_meta( $download_id, 'download_link', true ));
	exit;
}

/**
 * Handle the submit for requesting a download
 */
function request_this_download(){
	//status_header(200);

	// We have a valid ID
	if( $_POST['download-id'] && in_array(get_post_type($_POST['download-id']), array( 'downloads', 'downloads-arch' )) ){

		// Get some data we need
		$download_id = $_POST['download-id'];
		$download_title = get_post_meta( $download_id, 'download_title', true );
		$intended_use = esc_textarea($_POST['describe-intended-use-userentry']);
		$user = get_userdata( get_current_user_id() );

		if(function_exists('university_data_retriever')){
			$iup_user_info = university_data_retriever(get_current_user_id());
		}
		if (function_exists('subscriber_data_retreiver')){
			$subscriber_user_info = subscriber_data_retriever(get_current_user_id());
		}
		if(function_exists('company_data_retreiver')){
			$company_user_info = company_data_retreiver(get_current_user_id());
		}

		$iup_downloads = get_post_meta( $download_id, 'download_user_roles_allowed', true );
		$iup_package = get_post_meta($download_id, 'iup_package', true);
		$subscriber_downloads = get_post_meta( $download_id, 'download_user_roles_allowed', true );

		// Set the details of the email
		$to = ( $to = get_post_meta( $download_id, 'approval_email', true ))? $to : get_bloginfo( 'admin_email' );

		if($iup_package !== '') {

			// Change subject to add extra IUP data.
			$subject  = 'Download Request for: ';
			$subject .= $download_title;
			$subject .= ' > ';
			$subject .= $iup_user_info['last_name'];
			$subject .= ' (';
			$subject .= $iup_user_info['first_name'];
			$subject .= ') > ';
			$subject .= $iup_user_info['iup_university_name'];
			$subject .= ' > ';
			$subject .= $iup_user_info['iup_country'];
			// $subject .= '';

		} else {

			$subject  = 'Download Request for: ';
			$subject .= $download_title;
			$subject .= ' > from: ';
			$subject .= $subscriber_user_info['last_name'];
			$subject .= ' (';
			$subject .= $subscriber_user_info['last_name'];
			$subject .= ')';
			// $subject .= '';
			
		}

		$message = '<p>Hi,<br>The user called <a href="' . admin_url( 'user-edit.php?user_id='. get_current_user_id() .'' ) . '" target="_blank">' . $user->user_login . '</a> has requested to download the following file:</p>';
		$message .= '<p>' . get_permalink( $download_id ) . '<p>' ;
		$message .= '<p><strong>Username:</strong> <a href="' . admin_url( 'user-edit.php?user_id='. get_current_user_id() .'' ) . '" target="_blank">' . $user->user_login . '</a><br>';
		$message .= '<strong>Email address:</strong> ' . $user->user_email . '</p>';

		if(isset($iup_user_info) && $iup_package !== '') {
			$message .= '<hr>';
			$message .= '<p><strong>University name:</strong> '. $iup_user_info['iup_university_name'] .'<br>';
			$message .= '<strong>Country:</strong> '. $iup_user_info['iup_country'] .'<br>';
			$message .= '<strong>University email:</strong> '. $iup_user_info['iup_email_address'] .'<br>';
			$message .= '<strong>Personal email:</strong> '. $iup_user_info['iup_personal_email_address'] .'</p>';
		}
		if (isset($company_user_info)) {
			$message .= '<hr>';
			$message .= '<p><strong>Company name:</strong> '. $company_user_info['title'] .'</p>';

		}
		// adding users' description of their intended use
		$message .= '<hr>';
		$message .= '<p><strong>Intended use:</strong> ' . $intended_use . '</p>';
		$message .= '<hr>';
		$message .= '<p>To approve this request please <a href="' . admin_url( 'edit.php?post_type=downloads&page=download-requests-panel' ) . '" target="_blank">click here.</a></p>';

		// Send the email.
		add_filter( 'wp_mail_content_type', 'set_mail_as_html' );
		wp_mail( $to, $subject, $message );
		remove_filter( 'wp_mail_content_type', 'set_mail_as_html' );

		// Get all the users download requests
		$download_requests = get_user_meta( get_current_user_id(), 'download_requests', true );
		
		// used for displaying results on a per site basis
		//$blogname = get_blog_option( $blog_id, 'blogname' );
		$blog_id = get_current_blog_id();

		// If they already have something there add onto it our new request
		if(is_array($download_requests)){
			$download_requests[$download_id] = array(
					'download_id' => $_POST['download-id'],
					'download_status' => 'pending',
					'timestamp' => time(),
					'request_site' => $blog_id
				);

			if(!empty($intended_use)){
				$download_requests[$download_id]['intended_use'] = $intended_use;
			}
		} else {
			// The user has not had any requests yet so make our first
			$download_requests = array(
					$download_id => array(
						'download_id' => $_POST['download-id'],
						'download_status' => 'pending',
						'timestamp' => time(),
						'request_site' => $blog_id
					)
				);

			if(!empty($intended_use)){
				$download_requests[$download_id]['intended_use'] = $intended_use;
			}
		}

		// Update that users meta information
		update_user_meta( get_current_user_id(), 'download_requests', $download_requests );
	}

	// Send them back somewhere
	if (isset($_POST['redirect-to'])){
		wp_redirect($_POST['redirect-to']);
	} else {
		wp_redirect( get_site_url() );
	}

	// this is needed, trust me.
	//die();
}
add_action( 'admin_post_request_download', 'request_this_download' );
add_action( 'admin_post_nopriv_request_download', 'request_this_download' );
