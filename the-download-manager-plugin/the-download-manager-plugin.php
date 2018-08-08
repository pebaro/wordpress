<?php
/**
 * Plugin Name: The Download Manager Plugin
 * Plugin URI: http://logicspot.com/
 * Description: A flexible, powerful plugin to manage your downloads
 * Version: 1.0
 * Author: Michael Pereira & Gavin Jaynes @ LogicSpot
 * Author URI: http://logicspot.com/
 * License: 
 */

/**
 * Define constant for download base file
 */
if ( ! defined( 'DOWNLOAD_BASE_FILE' ) ){
    define( 'DOWNLOAD_BASE_FILE', __FILE__ );
}

/**
 * Define a constant for the base directory
 */
if ( ! defined( 'DOWNLOAD_BASE_DIRECTORY' ) ){
    define( 'DOWNLOAD_BASE_DIRECTORY', dirname( DOWNLOAD_BASE_FILE ) );
}

/**
 * Define a constant for the base directory
 */
if ( ! defined( 'PLUGIN_URL' ) ){
    define( 'PLUGIN_URL', trailingslashit(plugins_url(basename(dirname(__FILE__)))) );
}

/*
 * check whether the user have access to the download page. one function to check and one to show the message
 */
require_once ("lib/init.php");
/*
 * shows the download page
 */
require_once ("lib/template-loader.php");
/*
 * The download shortcode manager
 */
require_once ("lib/shortcode-manager.php");
/*
 * load front and back end css and js scripts
 */
require_once ("lib/scripts.php");
/*
 * usefull reusable small functions
 */
require_once ("lib/utils.php");
/*
 * registered post types and taxonomies
 */
require_once ("lib/post-types.php");
/**
 * The downloads options meta box and processing
 */
require_once ("lib/download-options.php");
/*
 * meta boxes ( Note Download Options is it's own file )
 */
require_once ("lib/meta-boxes.php");
/*
 * The reports managment file
 */
require_once ("lib/reports.php");
/*
 * The downloads report queries
 */
require_once ("lib/report-queries.php");
/*
 * The email whitelist page
 */
require_once ("lib/whitelist.php");
/*
 * The download requests page
 */
require_once ("lib/requests.php");