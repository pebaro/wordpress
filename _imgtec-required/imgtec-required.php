<?php
/**
 * Plugin Name: _ImgTec (required)
 * Plugin URI: https://www.imgtec.com
 * Description: CPTs & Taxonomies plus other custom functionality for the ImgTec site theme
 * Version: 3.2
 * Author: Rob Masters
 * Author URI: https://www.imgtec.com
 */

// custom branding for WP Admin
function imgtec_wpadmin_branding(){
	echo '<style type="text/css">#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before { background-image: url('.plugins_url( '_imgtec-required/images/imgtec-brand-icon.png' ).') !important; background-position: 0 0; background-repeat: no-repeat !important; color: rgba(0, 0, 0, 0); } #wpadminbar #wp-admin-bar-wp-logo:hover > .ab-item .ab-icon { background-position: 0 0; background-repeat: no-repeat !important; }</style>';
}
add_action('wp_before_admin_bar_render', 'imgtec_wpadmin_branding');

// admin page link
function imgtec_required_admin_page_link( $links, $file ){
	static $imgtec_required_plugin = null;

	if ( is_null( $imgtec_required_plugin ) ) {
		$imgtec_required_plugin = plugin_basename( __FILE__ );
	}
	if ( $file == $imgtec_required_plugin ) {
		$admin_link = '<a style="color:#7d0572;font-weight:bold;" href="admin.php?page=_imgtec-required/admin.php">' . __( '<i class="fa fa-laptop" aria-hidden="true"></i> Admin', 'imgtec-required' ) . '</a>';
		array_unshift( $links, $admin_link );
	}
	return $links;
}
add_filter( 'plugin_action_links', 'imgtec_required_admin_page_link', 10, 2 );

// files needed for the plugin to work
require_once('lib/custom-fields.php');                      // custom fields from ACF plugin
require_once('lib/functions.php'); 							// general plugin functions
require_once('lib/theme-functions.php'); 					// general theme functions
require_once('lib/partners-functions.php');  				// functions for Partners post type
require_once('lib/scripts.php'); 							// plugin scripts/styles
require_once('search-excludes.php'); 						// exclude page from search
require_once('lib/menus.php'); 								// admin menus
require_once('lib/imgtec-posts.php'); 						// all CPTs (imgtec)
require_once('lib/imgtec-taxonomies.php'); 					// all custom taxonomies (imgtec)
require_once('lib/events-data-table.php'); 					// data table for all events
require_once('lib/webinars-data-table.php'); 				// data table for all webinars
require_once('lib/presentations-data-table.php'); 			// data table for all presentations
require_once('lib/press-releases-data-table.php'); 			// data table for press releases
require_once('widgets/contact-info-events.php'); 			// events contact info widget
require_once('widgets/contact-blog-editor.php'); 			// blog editor contact info widget
require_once('widgets/contact-info-public-relations.php'); 	// PR contact info widget
require_once('widgets/blog-author.php'); 					// blog author widget
require_once('widgets/blog-tag.php'); 						// blog tag widget
require_once('widgets/popular-posts.php'); 					// popular posts widget
require_once('widgets/featured-posts.php'); 				// featured posts widget
