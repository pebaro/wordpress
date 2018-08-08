<?php
namespace ElementorImgTec\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor AnimateCC
 * Elementor widget for Animate CC.
 */
class AnimateCC extends Widget_Base {

	// widget name
	public function get_name() {
		return 'animate-cc';
	}

	// retrieve widget title
	public function get_title() {
		return __( 'Animate CC', 'elementor-imgtec' );
	}

	// set an icon for the widget
	public function get_icon() {
		return 'eicon-animation';
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
		return [ 'animate_cc' ];
	}

	/**
	 * Register the widget controls
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Animate CC', 'elementor-imgtec' ),
			]
		);

		$this->add_control(
			'createjs_source_url',
			[
				'label' => __( 'CreateJS Source URL', 'elementor-imgtec' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'https://code.createjs.com/createjs-2015.11.26.min.js'
			]
		);

		$this->add_control(
			'ja_assets_url',
			[
				'label' => __( 'JavaScript Assets URL', 'elementor-imgtec' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'https://s3-eu-west-1.amazonaws.com/imagination-technologies-cloudfront-assets/animations/ADD_LINK_HERE.js'
			]
		);

		$this->add_control(
			'page_javascript_url',
			[
				'label' => __( 'Page JavaScript URL', 'elementor-imgtec' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'https://s3-eu-west-1.amazonaws.com/imagination-technologies-cloudfront-assets/animations/ADD_LINK_HERE-pagejs.js'
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'elementor-imgtec' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0)'
			]
		);

		$this->add_control(
			'canvas_width',
			[
				'label' 	=> __( 'Canvas Width (px)', 'elementor-imgtec' ),
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'size' 	=> 1,
				],
				'range' 	=> [
					'px' 	=> [
						'max' 	=> 1920,
						'min' 	=> 0,
						'step' 	=> 5,
					],
				]
			]
		);

		$this->add_control(
			'canvas_height',
			[
				'label' 	=> __( 'Canvas Height (px)', 'elementor-imgtec' ),
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'size' 	=> 1,
				],
				'range' 	=> [
					'px' 	=> [
						'max' 	=> 1200,
						'min' 	=> 0,
						'step' 	=> 5,
					],
				]
			]
		);

		$this->add_control(
			'canvas_background_color',
			[
				'label' => __( 'Canvas Background Color', 'elementor-imgtec' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0)'
			]
		);

		$this->add_control(
			'preloader',
			[
				'label' => __( 'Preloader URL', 'elementor-imgtec' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'https://s3-eu-west-1.amazonaws.com/imagination-technologies-cloudfront-assets/animations/_preloader.gif'
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

		$animation  = '<div class="animate-javascript-div">';
		$animation .= '<script src="' . $settings['createjs_source_url'] . '">';
		$animation .= '<script src="' . $settings['ja_assets_url'] . '">';
		$animation .= '<script src="' . $settings['page_javascript_url'] . '">';
		$animation .= '<body onload="init();" style="margin:0 auto 0">';
		$animation .= '</body></div>';

		echo $animation;
	}
	/**
	 * Render the widget output in the editor
	 * Backbone JavaScript template used to generate the live preview
	 */
	protected function _content_template() {
		?>
		<div class="animate-javascript-div">
			{{{ settings.createjs_source_url }}}{{{ settings.ja_assets_url }}}{{{ settings.page_javascript_url }}}
		</div>
		<?php
	}
}
