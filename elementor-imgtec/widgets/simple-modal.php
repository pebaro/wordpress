<?php
namespace ElementorImgTec\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor SimpleModal
 * Elementor widget for Simple Modal
 */
class SimpleModal extends Widget_Base {

	// widget name
	public function get_name() {
		return 'simple-modal';
	}

	// retrieve widget title
	public function get_title() {
		return __( 'Simple Modal', 'elementor-imgtec' );
	}

	// set an icon for the widget
	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	/**
	 * Retrieve the list of categories the widget belongs to
	 * Used to determine where to display the widget in the editor
	 * Note that currently Elementor supports only one category
	 * When multiple categories passed, Elementor uses the first one
	 */
	public function get_categories() {
		return [ 'elementor-imgtec' ];
	}

	/**
	 * Retrieve the list of scripts the widget depends on
	 * Used to set script dependencies required to run the widget
	 */
	public function get_script_depends() {
		return [ 'simple_modal' ];
	}

	/**
	 * Register the widget controls
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Simple Modal', 'elementor-imgtec' ),
			]
		);

		$this->add_control(
			'unique_identifier',
			[
				'label' => __( 'Unique ID For Modal', 'elementor-imgtec' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'enter-unique-id-here'
			]
		);

		$this->add_control(
			'open_modal_type',
			[
				'label' 	=> 'Open Modal Type',
				'type' 		=> Controls_Manager::CHOOSE,
				'default' 	=> 'text',
				'options' 	=> [
					'text' 		=> [
						'title' 	=> __( '<a> Tag', 'elementor-imgtec' ),
						'icon' 		=> 'eicon-animation-text'
					],
					'button' 	=> [
						'title' 	=> __( '<button> Tag', 'elementor-imgtec' ),
						'icon' 		=> 'eicon-button'
					],
					'btn_primary' 	=> [
						'title' 	=> __( '<a class="btn-primary">', 'elementor-imgtec' ),
						'icon' 		=> 'eicon-button'
					]
				],
			]
		);

		$this->add_control(
			'open_modal_text',
			[
				'label' 		=> __( 'Open Modal Text', 'elementor-imgtec' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> 'Display Modal',
				'description' 	=> __( 'This text will open your modal when clicked.' ,'elementor-imgtec' )
			]
		);

		$this->add_control(
			'modal_content',
			[
				'label' 		=> __( 'Modal Content', 'elementor-imgtec' ),
				'type' 			=> Controls_Manager::WYSIWYG,
				'placeholder' 	=> __( 'Enter the content you wish to be contained on your modal. You can include images, videos, files from the media gallery, etc.' ,'elementor-imgtec' ),
			]
		);

		$this->add_control(
			'extra_modal_close',
			[
				'label' 		=> __( 'Extra Close Trigger Needed?', 'elementor-imgtec' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no',
				'label_on' 		=> __( 'YES', 'elementor-imgtec' ),
				'label_off' 	=> __( 'NO', 'elementor-imgtec' ),
				'return_value' 	=> 'yes',
				'description' 	=> __( 'This will be in addition to the "X" close button in the top right hand corner of the modal window', 'elementor-imgtec' )
			]
		);

		$this->add_control(
			'close_modal_type',
			[
				'label' 	=> 'Close Modal Type',
				'type' 		=> Controls_Manager::CHOOSE,
				'default' 	=> 'text',
				'options' 	=> [
					'text' 		=> [
						'title' 	=> __( '<a> Tag', 'elementor-imgtec' ),
						'icon' 		=> 'eicon-animation-text'
					],
					'button' 	=> [
						'title' 	=> __( '<button> Tag', 'elementor-imgtec' ),
						'icon' 		=> 'eicon-button'
					],
					'btn_primary' => [
						'title' 	=> __( '<a class="btn-primary">', 'elementor-imgtec' ),
						'icon' 		=> 'eicon-button'
					]
				],
				'condition' => [
					'extra_modal_close' => 'yes'
				]
			]
		);

		$this->add_control(
			'close_modal_text',
			[
				'label' 		=> __( 'Close Modal Text', 'elementor-imgtec' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> 'Close Modal',
				'description' 	=> __( 'This text will close your modal when clicked.' ,'elementor-imgtec' ),
				'condition' 	=> [
					'extra_modal_close' => 'yes'
				]
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend
	 * Generates the final HTML
	 */
	protected function render() {
		$settings = $this->get_settings();

		$simple_modal 	= '';

		$modal_name 		= $settings['unique_identifier'];
		$open_modal_text 	= $settings['open_modal_text'];
		$modal_content 		= $settings['modal_content'];
		$close_modal_text 	= $settings['close_modal_text'];

		switch ( $settings['open_modal_type'] ) {
			case 'text':
				$simple_modal .= '<a data-modal-open="' . $modal_name . '">' . $open_modal_text . '</a>';
				break;
			case 'button':
				$simple_modal .= '<button data-modal-open="' . $modal_name . '">' . $open_modal_text . '</button>';
				break;
			case 'btn_primary':
				$simple_modal .= '<a class="btn btn-primary" data-modal-open="' . $modal_name . '">' . $open_modal_text . '</a>';
				break;
			default:
				$simple_modal .= '<a class="btn btn-default" data-modal-open="' . $modal_name . '">' . $open_modal_text . '</a>';
				break;
		}

		$simple_modal .= '<div class="modal" data-modal="' . $modal_name . '">';
		$simple_modal .= 	'<div class="modal-inner">';
		$simple_modal .= 		'<a class="modal-close" data-modal-close="' . $modal_name . '" href=""> X </a>';
		$simple_modal .= 		$modal_content;

		if ( $settings['extra_modal_close'] == 'yes' ) {
			switch ( $settings['close_modal_type'] ) {
				case 'text':
					$simple_modal .= '<a data-modal-close="' . $modal_name . '">' . $close_modal_text . '</a>';
					break;

				case 'button':
					$simple_modal .= '<button data-modal-close="' . $modal_name . '">' . $close_modal_text . '</button>';
					break;

				case 'btn_primary':
					$simple_modal .= '<a class="btn btn-primary" data-modal-close="' . $modal_name . '">' . $close_modal_text . '</a>';
					break;

				default:
					$simple_modal .= '<a class="btn btn-default" data-modal-close="' . $modal_name . '">' . $close_modal_text . '</a>';
					break;
			}
		}

		$simple_modal .= 	'</div>';
		$simple_modal .= '</div>';

		echo $simple_modal;
	}

	/**
	 * Render the widget output in the editor
	 * Backbone JavaScript template used to generate the live preview
	 */
	protected function _content_template() { ?><#

		var output 	= '',
			name 	= settings.unique_identifier,
			text 	= settings.open_modal_text;

		if ( settings.open_modal_type === 'button' ) {
			output += '<button data-modal-open="'+name+'">' + text + '</button>';
		} else if ( settings.open_modal_type === 'text' ) {
			output += '<a href="" data-modal-open="'+name+'">' + text + '</a>';
		} else if ( settings.open_modal_type === 'btn_class' ) {
			output += '<a href="" data-modal-open="'+name+'" class="btn btn-primary">' + text + '</a>';
		} else {
			output += '<a href="" data-modal-open="'+name+'" class="btn btn-default">' + text + '</a>';
		}

		print( output );

		#><?php
	}
}
