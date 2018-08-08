<?php 
/**
 * Add the whitelist as an option
 */
function add_download_whitelist_option(){
	add_submenu_page( 'edit.php?post_type=downloads', 'Email Whitelist', 'Email Whitelist', 'edit_pages', 'download-whitelist-page', 'download_whitelist_page' );
}
add_action('admin_menu', 'add_download_whitelist_option');

/**
 * Include the template as the page instead of coding it here.
 */
function download_whitelist_page(){
	include('whitelist-page.php');
}

/**
 * Store the whitelist as an array in options
 */
function download_email_whitelist() {
	status_header(200);

	// Check the nonce is correct
	if(!wp_verify_nonce( $_POST['dl-wl-nonce'], 'download-whitelist' )){
		die();
	}

	// Break out input into an array for use
	$our_whitelist = explode("\r\n", esc_textarea($_POST['email-whitelist']));

	$updated = update_option( 'download_whitelist', $our_whitelist );

	// Return the user either with or without an error
	if(!$updated){
		wp_redirect( $_POST['redirect-to'].'&error=true' );
	} else {
		wp_redirect( $_POST['redirect-to'] );
	}

	// This should end with a die
	die();
}
add_action( 'admin_post_download_whitelist', 'download_email_whitelist' );