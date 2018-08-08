<?php
/**
 * Creating a sub page of downloads for viewing reports
 */
function add_reporting_page(){
	add_submenu_page( 'edit.php?post_type=downloads', 'Download Reports', 'Download Reports', 'edit_posts', 'download-reports', 'report_page' );
}
add_action( 'admin_menu', 'add_reporting_page' );

/**
 * The content of the download reporting page
 */
function report_page(){
	if(isset($_GET['download-id']) && is_numeric($_GET['download-id'])){
		require_once (DOWNLOAD_BASE_DIRECTORY.'/report-templates/download-report-single-download.php');
	} elseif(isset($_GET['user-id']) && is_numeric($_GET['user-id'])){
		require_once (DOWNLOAD_BASE_DIRECTORY.'/report-templates/download-report-single-user.php');
	} else {
		require_once (DOWNLOAD_BASE_DIRECTORY.'/report-templates/download-report-index.php');
	}
}