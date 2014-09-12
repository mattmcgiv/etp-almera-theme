<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

add_action('init', array('TMM_Ext_Sliders', 'register'), 2);
add_action("admin_init", array('TMM_Ext_Sliders', 'admin_init'));
add_action('save_post', array('TMM_Ext_Sliders', 'save_post'));
//AJAX
add_action('wp_ajax_add_meta_slide_item', array('TMM_Ext_Sliders', 'add_meta_slide_item'));

class TMM_Ext_Sliders {

	public static $post_type_name = 'slidergroup';
	public static $sliders_classes_array = array();
	public static $sliders_folders = array();
	public static $slider_options = array(); //$key=>$name
	public static $slider_js_options = array();
	public static $easing_effects = array();

	//*****

	public static function register() {
		self::$easing_effects = array(
			'swing' => __('Swing', 'almera'),
			'easeInQuad' => __('easeInQuad', 'almera'),
			'easeOutQuad' => __('easeOutQuad', 'almera'),
			'easeInOutQuad' => __('easeInOutQuad', 'almera'),
			'easeInCubic' => __('easeInCubic', 'almera'),
			'easeOutCubic' => __('easeOutCubic', 'almera'),
			'easeInOutCubic' => __('easeInOutCubic', 'almera'),
			'easeInQuart' => __('easeInQuart', 'almera'),
			'easeOutQuart' => __('easeOutQuart', 'almera'),
			'easeInOutQuart' => __('easeInOutQuart', 'almera'),
			'easeInQuint' => __('easeInQuint', 'almera'),
			'easeOutQuint' => __('easeOutQuint', 'almera'),
			'easeInOutQuint' => __('easeInOutQuint', 'almera'),
			'easeInExpo' => __('easeInExpo', 'almera'),
			'easeOutExpo' => __('easeOutExpo', 'almera'),
			'easeInOutExpo' => __('easeInOutExpo', 'almera'),
			'easeInSine' => __('easeInSine', 'almera'),
			'easeOutSine' => __('easeOutSine', 'almera'),
			'easeInOutSine' => __('easeInOutSine', 'almera'),
			'easeInCirc' => __('easeInCirc', 'almera'),
			'easeOutCirc' => __('easeOutCirc', 'almera'),
			'easeInOutCirc' => __('easeInOutCirc', 'almera'),
			'easeInElastic' => __('easeInElastic', 'almera'),
			'easeOutElastic' => __('easeOutElastic', 'almera'),
			'easeInOutElastic' => __('easeInOutElastic', 'almera'),
			'easeInBack' => __('easeInBack', 'almera'),
			'easeOutBack' => __('easeOutBack', 'almera'),
			'easeInOutBack' => __('easeInOutBack', 'almera'),
			'easeInBounce' => __('easeInBounce', 'almera'),
			'easeOutBounce' => __('easeOutBounce', 'almera'),
			'easeInOutBounce' => __('easeInOutBounce', 'almera'),
		);
		//*****
		$handler = opendir(self::get_application_path() . "/items/");
		while ($file = readdir($handler)) {
			if ($file != "." AND $file != "..") {
				self::$sliders_folders[] = $file;
				include_once self::get_application_path() . '/items/' . $file . '/index.php';
			}
		}
		//INIT SLIDERS WITHOUT E-V-A-L
		TMM_Ext_Slider_Flex::init();
		//*****

		$arguments = array(
			'labels' => array(
				'name' => __('Slider Groups', 'almera'),
				'singular_name' => __('Group', 'almera'),
				'add_new' => __('Add New', 'almera'),
				'add_new_item' => __('Add New Slider Group', 'almera'),
				'edit_item' => __('Edit Slider Group', 'almera'),
				'new_item' => __('New Slider Group', 'almera'),
				'view_item' => __('View Slider Group', 'almera'),
				'search_items' => __('Search Slider Groups', 'almera'),
				'not_found' => __('No Slide Groups found', 'almera'),
				'not_found_in_trash' => __('No Slide Groups found in Trash', 'almera'),
				'parent_item_colon' => ''
			),
			'public' => false,
			'archive' => false,
			'exclude_from_search' => false,
			'publicly_queryable' => false,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'thumbnail'),
			'rewrite' => array('slug' => self::$post_type_name),
			'show_in_admin_bar' => false,
			'menu_icon' => '',
			'taxonomies' => array()
		);

		register_post_type(self::$post_type_name, $arguments);
		flush_rewrite_rules(false);

		add_filter("manage_" . self::$post_type_name . "_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_" . self::$post_type_name . "_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));

		return false;
	}

	//*****************************

	public static function get_application_path() {
		return TMM_EXT_PATH . '/sliders';
	}

	public static function get_application_uri() {
		return TMM_EXT_URI . '/sliders';
	}

	public static function admin_init() {
		self::init_meta_boxes();
	}

	public static function init_meta_boxes() {
		add_meta_box("tmm_slides_meta", __("Slides", 'almera'), array(__CLASS__, 'draw_slidergroup_slides_meta'), self::$post_type_name, "normal", "low");
		//***
		add_meta_box("tmm_slider_meta_box", __("Page slider", 'almera'), array(__CLASS__, 'draw_page_slides_meta_box'), "post", "side", "low");
		add_meta_box("tmm_slider_meta_box", __("Page slider", 'almera'), array(__CLASS__, 'draw_page_slides_meta_box'), "page", "side", "low");
	}

	public static function get_slider_types() {
		$result = array();
		$slider_options = self::$slider_options;
		foreach ($slider_options as $value) {
			$result[$value['key']] = $value['name'];
		}

		return $result;
	}

	public static function draw_slidergroup_slides_meta() {
		wp_enqueue_style('tmm_ext_sliders_css', self::get_application_uri() . '/css/style.css');
		wp_enqueue_script('tmm_ext_sliders_js', self::get_application_uri() . '/js/slidergroup.js');
		global $post;
		$data = array();
		$slides_group = self::get_page_slides($post->ID);
		$data['slides_group'] = $slides_group;
		echo TMM::draw_free_page(self::get_application_path() . '/views/meta.php', $data);
	}

	public static function draw_page_slides_meta_box() {
		wp_enqueue_script('tmm_ext_sliders_js', self::get_application_uri() . '/js/slidergroup.js');
		global $post;
		$data = array();
		$data['slides'] = self::get_list_of_groups();
		$data['slider_types'] = self::get_slider_types();
		$data = array_merge($data, self::get_page_settings($post->ID));
		$data['layerslider_slide_group'] = $data['layerslider_slide_group'];
		$data['cuteslider_slide_group'] = $data['cuteslider_slide_group'];
		echo TMM::draw_free_page(self::get_application_path() . '/views/meta_box.php', $data);
	}

	public static function save_post($post_id) {
		global $post;
		if (is_object($post) AND !empty($_POST)) {
			$allows_post_types = array(self::$post_type_name, 'post', 'page');
			if (in_array($post->post_type, $allows_post_types)) {
				update_post_meta($post_id, "slides_group", @$_POST["slides_group"]);
				//***
				update_post_meta($post_id, "page_slider", @$_POST["page_slider"]);
				update_post_meta($post_id, "layerslider_slide_group", @$_POST["layerslider_slide_group"]);
				update_post_meta($post_id, "cuteslider_slide_group", @$_POST["cuteslider_slide_group"]);
				update_post_meta($post_id, "page_slider_type", @$_POST["page_slider_type"]);
			}
		}
	}

	public static function get_page_settings($post_id) {
		$custom = get_post_custom($post_id);
		$data = array();
		$data['page_slider'] = @$custom["page_slider"][0];
		$data['layerslider_slide_group'] = @$custom["layerslider_slide_group"][0];
		$data['cuteslider_slide_group'] = @$custom["cuteslider_slide_group"][0];
		$data['page_slider_type'] = @$custom["page_slider_type"][0];
		return $data;
	}

	public static function get_page_slides_count($post_id) {
		$slides = self::get_page_slides($post_id);
		return count($slides);
	}

	public static function get_page_slides($post_id) {
		return get_post_meta($post_id, 'slides_group', true);
	}

	//ajax
	public static function add_meta_slide_item() {
		$data = array();
		$data['imgurl'] = $_REQUEST['imgurl'];
		$data['group'] = $data;
		echo TMM::draw_free_page(self::get_application_path() . '/views/meta_slide_item.php', $data);
		exit;
	}

	public static function show_edit_columns_content($column) {
		global $post;

		switch ($column) {
			case "image":

				echo '<img alt="' . $post->post_title . '" src="' . TMM_Helper::get_post_featured_image($post->ID, '200*200', true) . '"/>';
				
				break;
			case "count":
				echo self::get_page_slides_count($post->ID);
				break;
		}
	}

	public static function show_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Title", 'almera'),
			"image" => __("Group Cover", 'almera'),
			"count" => __("Image Count", 'almera'),
		);

		return $columns;
	}

	public static function get_list_of_groups() {
		$result = array();

		$posts = get_posts(array(
			'post_type' => self::$post_type_name,
			'order' => 'ASC',
			'orderby' => 'post_title',
			'posts_per_page' => -1
		));

		if (!empty($posts)) {
			foreach ($posts as $value) {
				$result[$value->ID] = $value->post_title;
			}
		}

		return $result;
	}

	//********************************************************************
	//for front
	public static function draw_sliders_options() {
		return TMM::draw_free_page(self::get_application_path() . '/views/sliders_options.php');
	}

	public static function get_slider_js_options($slider_type) {
		$options_list = self::$slider_js_options[$slider_type];

		$options = array();
		if (!empty($options_list)) {
			foreach ($options_list as $option_key => $values) {
				$option = TMM::get_option("slider_" . $slider_type . "_" . $option_key);
				if (empty($option) AND !is_numeric($option)) {
					$option = $values['default'];
				}

				$options[$option_key] = $option;
			}
		}

		return $options;
	}

	public static function draw_page_slider($post_id) {
		$page_settings = self::get_page_settings($post_id);

		//***

		if ($page_settings['page_slider_type'] == 'layerslider') {
			if ($page_settings['layerslider_slide_group'] > 0) {
				return do_shortcode('[layerslider id="' . $page_settings['layerslider_slide_group'] . '"]');
			}
			return "";
		}


		if ($page_settings['page_slider_type'] == 'cuteslider') {
			if ($page_settings['cuteslider_slide_group'] > 0) {
				return do_shortcode('[cuteslider id="' . $page_settings['cuteslider_slide_group'] . '"]');
			}
			return "";
		}

		//*****

		if (!$page_settings['page_slider']) {
			return "";
		}

		if (!isset(self::$slider_options[$page_settings['page_slider_type']])) {
			return "";
		}

		$data = array();
		$data['post_id'] = $post_id;
		$data['slides'] = self::get_page_slides($page_settings['page_slider']);
		$data['options'] = self::get_slider_js_options($page_settings['page_slider_type']);
		$_REQUEST['page_slider_activated'] = TRUE; //if I need to know is page slider activated
		return TMM::draw_free_page(self::get_application_path() . '/items/' . $page_settings['page_slider_type'] . '/views/page_output.php', $data);
	}

	//for shortcode slider only
	public static function draw_shortcode_slider($type, $group_id, $alias) {
		$data = array();
		$data['slides'] = self::get_page_slides($group_id);
		$data['options'] = self::get_slider_js_options($type);
		$data['alias'] = $alias;
		$data['is_shortcode'] = true;
		return TMM::draw_free_page(self::get_application_path() . '/items/' . $type . '/views/page_output.php', $data);
	}

	//$post_id - slider group post type id
	public static function draw_group_slider($post_id, $page_slider_type, $alias = 0) {
		if (!isset(self::$slider_options[$page_slider_type])) {
			return "";
		}

		$data = array();
		$data['post_id'] = $post_id;
		$data['slides'] = self::get_page_slides($post_id);
		$data['options'] = self::get_slider_js_options($page_slider_type);
		$data['alias'] = $alias;
		$_REQUEST['page_slider_activated'] = TRUE; //if I need to know is page slider activated
		return TMM::draw_free_page(self::get_application_path() . '/items/' . $page_slider_type . '/views/page_output.php', $data);
	}

}

