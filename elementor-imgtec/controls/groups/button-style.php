<?php
namespace ElementorImgTec;

use Elementor\Group_Control_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Group_Control_Button_Style extends Group_Control_Base {

	protected static $fields;

	private static $con_type;
	private static $con_size;
	private static $con_weight;
	private static $con_background;
	private static $con_color;
	private static $con_padding;
	private static $con_margin;
	private static $con_display;
}