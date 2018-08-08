<?php
/**
 * Add the requests panel as an option
 */
function add_download_requests_panel(){
	add_submenu_page( 'edit.php?post_type=downloads', 'Requests', 'Requests', 'edit_pages', 'download-requests-panel', 'download_requests_panel' );
}
add_action('admin_menu', 'add_download_requests_panel');

/**
 * Include the template as the page instead of coding it here.
 */
function download_requests_panel(){
	include('requests-page.php');
}