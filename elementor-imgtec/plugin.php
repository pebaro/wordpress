<?php
namespace ElementorImgTec;

use ElementorImgTec\Widgets\AnimateCC;
use ElementorImgTec\Widgets\SimpleModal;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 * Register new widgets
 */
class Plugin {

	// Constructor
	public function __construct() {
		$this->add_actions();
		//$this->enqueue_frontend_styles();
	}

	// Add Actions
	private function add_actions() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );

		// front end scripts
		add_action( 'elementor/frontend/after_register_scripts', function() {
			wp_register_script( 'animate_cc', plugins_url( '/assets/js/animate-cc.js', ELEMENTOR_IMGTEC__FILE__ ), [ 'jquery' ], false, true );
			wp_register_script( 'simple_modal', plugins_url( '/assets/js/simple-modal.js', ELEMENTOR_IMGTEC__FILE__ ), [ 'jquery' ], false, true );
		} );

		// create a custom section for all imgtec widgets
		add_action( 'elementor/init', function(){
			\Elementor\Plugin::$instance->elements_manager->add_category(
				'elementor-imgtec',
				[
					'title' => __( 'ImgTec Custom Widgets', 'elementor-imgtec' ),
					'icon' => 'fa fa-plug'
				],
				2
			);
		} );

		// front end styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_styles' ] );
	}

	public function enqueue_frontend_styles() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.css';

		wp_register_style(
			'simple-modal',
			plugins_url( '/assets/css/simple-modal.css', ELEMENTOR_IMGTEC__FILE__ ),
			[],
			ELEMENTOR_IMGTEC_VERSION
		);
		wp_enqueue_style( 'simple-modal' );
	}

	// On Widgets Registered
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	// Includes
	private function includes() {
		require __DIR__ . '/widgets/animate-cc.php';
		require __DIR__ . '/widgets/simple-modal.php';
	}

	// Register AnimateCC Widget
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new AnimateCC() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new SimpleModal() );
	}
}

new Plugin();
