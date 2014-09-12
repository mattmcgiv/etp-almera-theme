<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Page {

	public static $post_pod_types = array();

	public static function register() {

		self::$post_pod_types = array(
			'default' => __("Default", 'almera'),
			'video' => __("Video", 'almera'),
			'audio' => __("Audio", 'almera'),
			//'link' => __("Link", 'almera'),
			'quote' => __("Quote", 'almera'),
			'gallery' => __("Gallery", 'almera'),
		);
	}

	public static function save($post_id) {
		update_post_meta($post_id, "meta_title", @$_POST["meta_title"]);
		update_post_meta($post_id, "meta_keywords", @$_POST["meta_keywords"]);
		update_post_meta($post_id, "meta_description", @$_POST["meta_description"]);
		//*****
		update_post_meta($post_id, "post_pod_type", @$_POST["post_pod_type"]);
		update_post_meta($post_id, "post_type_values", @$_POST["post_type_values"]);
		//***
		update_post_meta($post_id, "page_title_status", @$_POST["page_title_status"]);

		update_post_meta($post_id, "pagebg_type", @$_POST["pagebg_type"]);
		update_post_meta($post_id, "pagebg_color", @$_POST["pagebg_color"]);
		update_post_meta($post_id, "pagebg_image", @$_POST["pagebg_image"]);
		update_post_meta($post_id, "pagebg_type_image_option", @$_POST["pagebg_type_image_option"]);
		update_post_meta($post_id, "page_sidebar_position", @$_POST["page_sidebar_position"]);
                update_post_meta($post_id, "fb_com", @$_POST["fb_com"]);
		//***
		update_post_meta($post_id, "headerbg_type", @$_POST["headerbg_type"]);
		update_post_meta($post_id, "headerbg_color", @$_POST["headerbg_color"]);
		update_post_meta($post_id, "headerbg_image", @$_POST["headerbg_image"]);
		update_post_meta($post_id, "headerbg_type_image_option", @$_POST["headerbg_type_image_option"]);
		update_post_meta($post_id, "headerbg_opacity", @$_POST["headerbg_opacity"]);
		//***
		update_post_meta($post_id, "footerbg_type", @$_POST["footerbg_type"]);
		update_post_meta($post_id, "footerbg_color", @$_POST["footerbg_color"]);
		update_post_meta($post_id, "footerbg_image", @$_POST["footerbg_image"]);
		update_post_meta($post_id, "footerbg_type_image_option", @$_POST["footerbg_type_image_option"]);
		update_post_meta($post_id, "footerbg_opacity", @$_POST["footerbg_opacity"]);
                
                
	}

	public static function init_meta_boxes() {
		add_meta_box("seo_options", __("Seo options", 'almera'), array(__CLASS__, 'page_seo_options'), "page", "normal", "low");
		add_meta_box("seo_options", __("Seo options", 'almera'), array(__CLASS__, 'page_seo_options'), "post", "normal", "low");
		add_meta_box("seo_options", __("Seo options", 'almera'), array(__CLASS__, 'page_seo_options'), TMM_Portfolio::$slug, "normal", "low");
		add_meta_box("seo_options", __("Seo options", 'almera'), array(__CLASS__, 'page_seo_options'), TMM_Gallery::$slug, "normal", "low");
		//*****
		add_meta_box("post_types", __("Post type", 'almera'), array(__CLASS__, 'post_type_meta_box'), "post", "side", "low");
		add_meta_box("post_types_data", __("Post type data", 'almera'), array(__CLASS__, 'post_type_meta_panel'), "post", "normal");
		//*****
		add_meta_box("tmm_page_bg", __("Custom Page Options", 'almera'), array(__CLASS__, 'page_background_options'), "post", "side", "low");
		add_meta_box("tmm_page_bg", __("Custom Page Options", 'almera'), array(__CLASS__, 'page_background_options'), "page", "side", "low");
		add_meta_box("tmm_page_bg", __("Custom Page Options", 'almera'), array(__CLASS__, 'page_background_options'), TMM_Gallery::$slug, "side", "low");
		add_meta_box("tmm_page_bg", __("Custom Page Options", 'almera'), array(__CLASS__, 'page_background_options'), TMM_Portfolio::$slug, "side", "low");                
               
	}

	public static function page_background_options() {
		global $post;
		echo TMM::draw_html('page/background_options', self::get_page_settings($post->ID));
	}
       
	public static function get_page_settings($post_id) {
		$custom = get_post_custom($post_id);
		$data = array();
		$data['page_title_status'] = "";
		if (isset($custom["page_title_status"][0])) {
			$data['page_title_status'] = $custom["page_title_status"][0];
		}

		$data['pagebg_type'] = @$custom["pagebg_type"][0];
		$data['pagebg_color'] = @$custom["pagebg_color"][0];
		$data['pagebg_image'] = @$custom["pagebg_image"][0];
		$data['pagebg_type_image_option'] = @$custom["pagebg_type_image_option"][0];
                $data['fb_com'] = @$custom["fb_com"][0];
                
		//***
		$data['headerbg_type'] = @$custom["headerbg_type"][0];
		$data['headerbg_color'] = @$custom["headerbg_color"][0];
		$data['headerbg_image'] = @$custom["headerbg_image"][0];
		$data['headerbg_type_image_option'] = @$custom["headerbg_type_image_option"][0];

		$data['headerbg_opacity'] = "";
		if (isset($custom["headerbg_opacity"][0])) {
			$data['headerbg_opacity'] = $custom["headerbg_opacity"][0];
		}

		//***
		$data['footerbg_type'] = "";
		if (isset($custom["footerbg_type"][0])) {
			$data['footerbg_type'] = $custom["footerbg_type"][0];
		}
		$data['footerbg_color'] = "";
		if (isset($custom["footerbg_color"][0])) {
			$data['footerbg_color'] = $custom["footerbg_color"][0];
		}
		$data['footerbg_image'] = "";
		if (isset($custom["footerbg_image"][0])) {
			$data['footerbg_image'] = $custom["footerbg_image"][0];
		}
		$data['footerbg_type_image_option'] = "";
		if (isset($custom["footerbg_type_image_option"][0])) {
			$data['footerbg_type_image_option'] = $custom["footerbg_type_image_option"][0];
		}
		$data['footerbg_opacity'] = "";
		if (isset($custom["footerbg_opacity"][0])) {
			$data['footerbg_opacity'] = $custom["footerbg_opacity"][0];
		}
		//***
		$data['page_sidebar_position'] = @$custom["page_sidebar_position"][0];
		return $data;
	}

	//***

	public static function page_seo_options() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['meta_title'] = @$custom["meta_title"][0];
		$data['meta_keywords'] = @$custom["meta_keywords"][0];
		$data['meta_description'] = @$custom["meta_description"][0];
		echo TMM::draw_html('page/seo_options', $data);
	}

	public static function post_type_meta_box() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['post_pod_types'] = self::$post_pod_types;
		$data['current_post_pod_type'] = @$custom["post_pod_type"][0];
		if (!$data['current_post_pod_type']) {
			$data['current_post_pod_type'] = 'default';
		}
		echo TMM::draw_html('page/post_pod_type_box', $data);
	}

	public static function post_type_meta_panel() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['post_pod_types'] = self::$post_pod_types;
		$data['current_post_pod_type'] = @$custom["post_pod_type"][0];
		if (!$data['current_post_pod_type']) {
			$data['current_post_pod_type'] = 'default';
		}
		$data['post_type_values'] = unserialize(@$custom["post_type_values"][0]);

		echo TMM::draw_html('page/post_pod_type_panel', $data);
	}

	//ajax
	public static function add_post_podtype_gallery_image() {
		$data = array();
		$data['imgurl'] = $_REQUEST['imgurl'];
		echo TMM::draw_html('page/draw_post_podtype_gallery_image', $data);
		exit;
	}

}
