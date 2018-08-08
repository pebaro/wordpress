<?php
/*
 * Scripts & Styles for the imgtec plugin
 */

// -----------------------------------------------------------
// =====> Register Styles <===================================

#####: adding styles for use in WordPress admin :#####
function imgtec_custom_wp_admin_styles(){
	wp_register_style('custom_wp_admin_css', plugin_dir_url( __FILE__ ) . '../css/main.css');
	wp_enqueue_style('custom_wp_admin_css');
}
add_action('admin_enqueue_scripts', 'imgtec_custom_wp_admin_styles');
// -----------------------------------------------------------



// ------------------------------------------------------------
// =====> Register Scripts <===================================

#####: adding scripts for use in WordPress admin :#####
function imgtec_custom_wp_admin_scripts(){
	// activate non default activated features in bootstrap
	wp_register_script( 'bootstrap_features_wp_admin',
		plugin_dir_url( __FILE__ ) . '../js/bootstrap-features.js',
		array(), 2.3, true );

	wp_enqueue_script( 'bootstrap_features_wp_admin',
		plugin_dir_url( __FILE__ ) . '../js/bootstrap-features.js',
		array('jQuery'), 2.3, true );
}
add_action('admin_enqueue_scripts', 'imgtec_custom_wp_admin_scripts');
// ------------------------------------------------------------