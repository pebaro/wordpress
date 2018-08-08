<?php
/**
 * Plugin Name: 	Elementor ImgTec
 * Description: 	Customisations for the Elementor page builder done in-house at Imagination Technologies
 * Plugin URI: 		https://www.imgtec.com
 * Version:			1.0.0
 * Author: 			Robert Masters
 * Author URI: 		https://www.imgtec.com
 * Text Domain: 	elementor-imgtec
 */

if ( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly

define( 'ELEMENTOR_IMGTEC_VERSION', 2.0 );
define( 'ELEMENTOR_IMGTEC__FILE__', __FILE__ );
define( 'ELEMENTOR_IMGTEC_PLUGIN_BASE', plugin_basename( ELEMENTOR_IMGTEC__FILE__ ) );
define( 'ELEMENTOR_IMGTEC_PATH', plugin_dir_path( ELEMENTOR_IMGTEC__FILE__ ) );
define( 'ELEMENTOR_IMGTEC_URL', plugins_url( '/', ELEMENTOR_IMGTEC__FILE__ ) );
define( 'ELEMENTOR_IMGTEC_ASSETS_URL', ELEMENTOR_IMGTEC_URL . 'assets/' );

// load the plugin after Elementor and other plugins
function elementor_imgtec_load() {
	// Load localization file
	load_plugin_textdomain( 'elementor-imgtec' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'elementor_imgtec_fail_load' );
		return;
	}

	// Check version required
	$elementor_version_required = '1.0.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'elementor_imgtec_fail_load_out_of_date' );
		return;
	}

	// Require the main plugin file
	require( __DIR__ . '/plugin.php' );
}
add_action( 'plugins_loaded', 'elementor_imgtec_load' );