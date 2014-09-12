<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Testimonials {

	public static function register() {

		$args = array(
			'labels' => array(
				'name' => __('Testimonials', 'almera'),
				'singular_name' => __('Testimonials', 'almera'),
				'add_new' => __('Add New', 'almera'),
				'add_new_item' => __('Add New Testimonial', 'almera'),
				'edit_item' => __('Edit Testimonial', 'almera'),
				'new_item' => __('New Testimonial', 'almera'),
				'view_item' => __('View Testimonial', 'almera'),
				'search_items' => __('Search Testimonials', 'almera'),
				'not_found' => __('No Testimonials found', 'almera'),
				'not_found_in_trash' => __('No Testimonials found in Trash', 'almera'),
				'parent_item_colon' => ''
			),
			'public' => false,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'editor'),
			'rewrite' => array('slug' => 'testimonials'),
			'show_in_admin_bar' => true,
			'menu_icon' => ''
		);
		register_post_type('testimonials', $args);
		flush_rewrite_rules(false);
	}

	public static function save($post_id) {
		if (isset($_POST)) {
			update_post_meta($post_id, "position", @$_POST["position"]);
		}
	}

	public static function init_meta_boxes() {
		add_meta_box("testimonials_credits_meta", __("Position", 'almera'), array(__CLASS__, 'testimonials_credits_meta'), "testimonials", "normal", "low");
	}

	public static function testimonials_credits_meta() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['position'] = @$custom["position"][0];
		echo TMM::draw_html('testimonials/credits_meta', $data);
	}

}
