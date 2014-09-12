<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Gallery {

	public static $slug = 'gall';

	public static function register() {

		$args = array(
			'labels' => array(
				'name' => __('Galleries', 'almera'),
				'singular_name' => __('Gallery', 'almera'),
				'add_new' => __('Add New', 'almera'),
				'add_new_item' => __('Add New Gallery', 'almera'),
				'edit_item' => __('Edit Gallery', 'almera'),
				'new_item' => __('New Gallery', 'almera'),
				'view_item' => __('View Gallery', 'almera'),
				'search_items' => __('Search Gallery', 'almera'),
				'not_found' => __('No Galleries found', 'almera'),
				'not_found_in_trash' => __('No Galleries found in Trash', 'almera'),
				'parent_item_colon' => ''
			),
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
			'rewrite' => array('slug' => self::$slug),
			'show_in_admin_bar' => true,
			'menu_icon' => ''
		);
		register_post_type(self::$slug, $args);
		//*** taxonomies ****
		register_taxonomy("gallery_categories", array(self::$slug), array(
			"hierarchical" => true,
			"labels" => array(
				'name' => __('Gallery Categories', 'almera'),
				'singular_name' => __('Gallery Category', 'almera'),
				'add_new' => __('Add New', 'almera'),
				'add_new_item' => __('Add New Gallery Category', 'almera'),
				'edit_item' => __('Edit Gallery Category', 'almera'),
				'new_item' => __('New Gallery Category', 'almera'),
				'view_item' => __('View Gallery Category', 'almera'),
				'search_items' => __('Search Gallery Categories', 'almera'),
				'not_found' => __('No Gallery Categories found', 'almera'),
				'not_found_in_trash' => __('No Gallery Categories found in Trash', 'almera'),
				'parent_item_colon' => ''
			),
			"singular_label" => __("Gallery Category", 'almera'),
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'page',
			'has_archive' => true,
			'hierarchical' => true,
			'show_in_admin_bar' => true,
			"rewrite" => true,
			'show_in_nav_menus' => false,
		));		
	
		//***
		flush_rewrite_rules(false);
		add_filter("manage_gall_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_gall_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));
	}

	public static function gallery_meta() {
		global $post;
		$data = array();
		$data['tmm_gallery'] = get_post_meta($post->ID, 'thememakers_gallery', true);
		$data['layout'] = get_post_meta($post->ID, 'layout', true);
		echo TMM::draw_html('gallery/metabox', $data);
	}

	public static function save($post_id) {
		update_post_meta($post_id, "thememakers_gallery", @$_POST["tmm_gallery"]);
		update_post_meta($post_id, "layout", @$_POST["layout"]);
	}

	public static function init_meta_boxes() {
		add_meta_box("gallery_meta", __("Gallery images", 'almera'), array(__CLASS__, 'gallery_meta'), self::$slug, "normal", "low");
	}

	public static function show_edit_columns_content($column) {
		global $post;

		switch ($column) {
			case "image":
					echo '<img alt="" src="' . TMM_Helper::get_post_featured_image($post->ID, '200*200', true) . '"/>';
				
				break;
			case "image_count":
				$custom = get_post_custom($post->ID);
				$tmm_gallery = unserialize(@$custom["thememakers_gallery"][0]);
				if (empty($tmm_gallery)) {
					$tmm_gallery = array();
				}
				echo count($tmm_gallery);
				break;
		}
		
	}

	public static function show_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Title", 'almera'),
			"image" => __("Cover", 'almera'),
			"image_count" => __("Image count", 'almera'),
			"date" => __("Date", 'almera')
		);

		return $columns;
	}

	//for ajax
	public static function add_gallery_item() {
		$data = array();
		$data['imgurl'] = $_REQUEST['imgurl'];
		$data['title'] = "";
		$data['description'] = "";
		$data['layout'] = 2;
		$data['category'] = "";
		echo TMM::draw_html('gallery/render_gallery_item', $data);
		exit;
	}

	public static function render_gallery_item($data) {
		echo TMM::draw_html('gallery/render_gallery_item', $data);
	}

}

