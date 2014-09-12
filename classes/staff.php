<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Staff {

	public static $slug = 'staff-page';

	public static function register() {

		$args = array(
			'labels' => array(
				'name' => __('Staff', 'almera'),
				'singular_name' => __('Staff', 'almera'),
				'add_new' => __('Add New', 'almera'),
				'add_new_item' => __('Add New Staff', 'almera'),
				'edit_item' => __('Edit Staff', 'almera'),
				'new_item' => __('New Staff', 'almera'),
				'view_item' => __('View Staff', 'almera'),
				'search_items' => __('Search In Staff', 'almera'),
				'not_found' => __('Nothing found', 'almera'),
				'not_found_in_trash' => __('Nothing found in Trash', 'almera'),
				'parent_item_colon' => ''
			),
			'public' => false,
			'archive' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'thumbnail', 'excerpt'),
			'rewrite' => array('slug' => self::$slug),
			'show_in_admin_bar' => true,
			'taxonomies' => array('position'), // this is IMPORTANT
			'menu_icon' => ''
		);

		register_taxonomy("position", array(self::$slug), array(
			"hierarchical" => true,
			"labels" => array(
				'name' => __('Position', 'almera'),
				'singular_name' => __('Position', 'almera'),
				'add_new' => __('Add New', 'almera'),
				'add_new_item' => __('Add New Position', 'almera'),
				'edit_item' => __('Edit Position', 'almera'),
				'new_item' => __('New Position', 'almera'),
				'view_item' => __('View Position', 'almera'),
				'search_items' => __('Search GPosition', 'almera'),
				'not_found' => __('No Position found', 'almera'),
				'not_found_in_trash' => __('No Position found in Trash', 'almera'),
				'parent_item_colon' => ''
			),
			"singular_label" => __("Position", 'almera'),
			"rewrite" => true,
			'show_in_nav_menus' => false,
		));
		//***	


		register_post_type(self::$slug, $args);
		flush_rewrite_rules(false);

		//***

		add_filter("manage_staff-page_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_staff-page_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));
	}

	public static function credits_meta() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['twitter'] = @$custom["twitter"][0];
		$data['facebook'] = @$custom["facebook"][0];
		$data['dribble'] = @$custom["dribble"][0];
		echo TMM::draw_html('staff/credits_meta', $data);
	}

	public static function save($post_id) {
		if (isset($_POST)) {
			update_post_meta($post_id, "twitter", @$_POST["twitter"]);
			update_post_meta($post_id, "facebook", @$_POST["facebook"]);
			update_post_meta($post_id, "dribble", @$_POST["dribble"]);
		}
	}

	public static function init_meta_boxes() {
		add_meta_box("credits_meta", __("Staff attributes", 'almera'), array(__CLASS__, 'credits_meta'), self::$slug, "normal", "low");
	}

	public static function show_edit_columns_content($column) {
		global $post;

		switch ($column) {
			case "image":

				echo '<img alt="" src="' . TMM_Helper::get_post_featured_image($post->ID, '200*200', true) . '"/>';
				
				break;
			case "twitter":
				echo get_post_meta($post->ID, 'twitter', true);
				break;
			case "facebook":
				echo get_post_meta($post->ID, 'facebook', true);
				break;
			case "dribble":
				echo get_post_meta($post->ID, 'dribble', true);
				break;
		}
	}

	public static function show_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Name", 'almera'),
			"image" => __("Photo", 'almera'),
			"twitter" => __("Twitter", 'almera'),
			"facebook" => __("Facebook", 'almera'),
			"dribble" => __("Dribble", 'almera')
		);

		return $columns;
	}

}
