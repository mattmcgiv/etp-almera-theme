<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Ext_Slider_Flex extends TMM_Ext_Sliders {

	public static $slider_options = array();
	public static $slider_js_options = array();

	public static function init() {
		parent::$sliders_classes_array[] = __CLASS__;
		//***
		self::$slider_options = array(
			'key' => "flex",
			'name' => "Flexslider",
			'fields' => array(
				'title' => array(
					'name' => __('Slide Title', 'almera'),
					'type' => 'textinput',
					'field_options' => array(),
					'field_options_defaults' => array()
				),
				'description' => array(
					'name' => __('Slide Description', 'almera'),
					'type' => 'textarea',
					'field_options' => array(
						'font_family' => __('Font family', 'almera'),
						'font_size' => __('Font size', 'almera'),
						'font_color' => __('Font color', 'almera')
					),
					'field_options_defaults' => array(
						'font_family' => '',
						'font_size' => '',
						'font_color' => ''
					)
				),
				'slide_desc_bg' => array(
					'name' => __('Slide description box color background', 'almera'),
					'type' => 'color',
					'field_options' => array()
				),
				'url' => array(
					'name' => __('Slide URL', 'almera'),
					'type' => 'textinput',
					'field_options' => array()
				),
			),
		);
		parent::$slider_options[self::$slider_options['key']] = self::$slider_options;
		//***
		self::$slider_js_options = array(
			'slide_image_alias' => array(
				'title' => __('Slide size', 'almera'),
				'type' => 'text',
				'description' => __('Slide size. width*height, for example 500*300. Empty field means full size!', 'almera'),
				'default' => '',
			),
                   
			'enable_caption' => array(
				'title' => __('Enable caption', 'almera'),
				'type' => 'checkbox',
				'description' => "",
				'default' => 1,
			),
			'slideshow' => array(
				'title' => __('Slideshow', 'almera'),
				'type' => 'checkbox',
				'description' => __("Animate slider automatically", 'almera'),
				'default' => 1,
			),
			'init_delay' => array(
				'title' => __('initDelay', 'almera'),
				'type' => 'text',
				'description' => __("Integer: Set an initialization delay, in milliseconds", 'almera'),
				'default' => 0,
				'max' => 500
			),
			'animation_speed' => array(
				'title' => __('Animation Speed', 'almera'),
				'type' => 'text',
				'description' => __("Set the speed of animations, in milliseconds", 'almera'),
				'default' => 600,
				'max' => 2000
			),
			'slideshow_speed' => array(
				'title' => __('Slideshow Speed', 'almera'),
				'type' => 'text',
				'description' => __("Set the speed of the slideshow cycling, in milliseconds", 'almera'),
				'default' => 7000,
				'max' => 20000
			),
			'animation' => array(
				'title' => __('Animation', 'almera'),
				'type' => 'select',
				'values_list' => array(
					'fade' => __('Fade', 'almera'),
					'slide' => __('Slide', 'almera'),
				),
				'description' => __('Select your animation type, "fade" or "slide"', 'almera'),
				'default' => 'slide',
			),
			'directionNav' => array(
				'title' => __('Direction Nav', 'almera'),
				'type' => 'checkbox',
				'description' => __("Direction Navigation", 'almera'),
				'default' => 1,
			),
			'controlnav' => array(
				'title' => __('Control Navigation', 'almera'),
				'type' => 'checkbox',
				'description' => __("Control Navigation", 'almera'),
				'default' => 1,
			),
			'direction' => array(
				'title' => __('Direction', 'almera'),
				'type' => 'select',
				'values_list' => array(
					'horizontal' => __('Horizontal', 'almera'),
					'vertical' => __('Vertical', 'almera'),
				),
				'description' => "",
				'default' => 'horizontal',
			)
		);
		parent::$slider_js_options[self::$slider_options['key']] = self::$slider_js_options;
	}

}