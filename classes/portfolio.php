<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

//include_once TMM_THEME_PATH . '/helper/multiple-post-thumbnails/multi-post-thumbnails.php';

class TMM_Portfolio {

	public static $slug = 'folio';

	public static function register() {

		$args = array(
			'labels' => array(
				'name' => __('Portfolios', 'almera'),
				'singular_name' => __('Portfolio', 'almera'),
				'add_new' => __('Add New', 'almera'),
				'add_new_item' => __('Add New Portfolio', 'almera'),
				'edit_item' => __('Edit Portfolio', 'almera'),
				'new_item' => __('New Portfolio', 'almera'),
				'view_item' => __('View Portfolio', 'almera'),
				'search_items' => __('Search Portfolios', 'almera'),
				'not_found' => __('No Portfolios found', 'almera'),
				'not_found_in_trash' => __('No Portfolios found in Trash', 'almera'),
				'parent_item_colon' => ''
			),
			'public' => true,
			'archive' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'editor', 'thumbnail', 'tags', 'comments'),
			'rewrite' => array('slug' => self::$slug),
			'show_in_admin_bar' => true,
			'taxonomies' => array('foliocat', 'post_tag'), // this is IMPORTANT
			'menu_icon' => ''
		);

		//*** taxonomies ****		
		register_taxonomy("foliocat", array(self::$slug), array(
			"hierarchical" => true,
			"labels" => array(
				'name' => __('Categories', 'almera'),
				'singular_name' => __('Category', 'almera'),
				'add_new' => __('Add New', 'almera'),
				'add_new_item' => __('Add New Category', 'almera'),
				'edit_item' => __('Edit Category', 'almera'),
				'new_item' => __('New Category', 'almera'),
				'view_item' => __('View Category', 'almera'),
				'search_items' => __('Search Categories', 'almera'),
				'not_found' => __('No Categories found', 'almera'),
				'not_found_in_trash' => __('No Categories found in Trash', 'almera'),
				'parent_item_colon' => ''
			),
			"singular_label" => __("foliocat", 'almera'),
			"rewrite" => true,
			'show_in_nav_menus' => false,
			'capabilities' => array('manage_terms'),
			'show_ui' => true
		));

		//***
		register_post_type(self::$slug, $args);
		flush_rewrite_rules(false);
		//***

		add_filter("manage_folio_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_folio_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));
		//*****
		/*
		  if (class_exists('MultiPostThumbnails')) {
		  new MultiPostThumbnails(
		  array(
		  'label' => __('Secondary featured image', 'almera'),
		  'id' => 'secondary-image',
		  'post_type' => self::$slug
		  )
		  );
		  }
		 */
	}

	public static function get_foliocats() {
		$foliocats = get_terms('foliocat');
		$foliocats_array = array();
		if (!empty($foliocats)) {
			foreach ($foliocats as $value) {
				$foliocats_array[$value->term_id] = $value->name;
			}
		}

		return $foliocats_array;
	}

	public static function credits_meta() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['portfolio_date'] = @$custom["portfolio_date"][0];
		
		$data['portfolio_clients'] = @$custom["portfolio_clients"][0];
		$data['portfolio_tools'] = @$custom["portfolio_tools"][0];
		$data['tmm_portfolio'] = unserialize(@$custom["tmm_portfolio"][0]);
		//***
		$data['portfolio_camera'] = @$custom["portfolio_camera"][0];
                $data['portfolio_camera_label'] = @$custom["portfolio_camera_label"][0];
		$data['portfolio_lens'] = @$custom["portfolio_lens"][0];
                $data['portfolio_lens'] = @$custom["portfolio_lens_label"][0];
		$data['portfolio_tripod_or_handheld'] = @$custom["portfolio_tripod_or_handheld"][0];
                $data['portfolio_tripod_or_handheld_label'] = @$custom["portfolio_tripod_or_handheld_label"][0];
		$data['portfolio_fl'] = @$custom["portfolio_fl"][0];
                $data['portfolio_fl_label'] = @$custom["portfolio_fl_label"][0];
		$data['portfolio_exposure'] = @$custom["portfolio_exposure"][0];
                $data['portfolio_exposure_label'] = @$custom["portfolio_exposure_label"][0];
		$data['portfolio_brackets'] = @$custom["portfolio_brackets"][0];
                $data['portfolio_brackets_label'] = @$custom["portfolio_brackets_label"][0];
		$data['portfolio_processed'] = @$custom["portfolio_processed"][0];
                $data['portfolio_processed_label'] = @$custom["portfolio_processed_label"][0];
		$data['portfolio_etc'] = @$custom["portfolio_etc"][0];
                $data['portfolio_etc_label'] = @$custom["portfolio_etc_label"][0];	
		
		//***
		echo TMM::draw_html('portfolio/credits_meta', $data);
				
	}

	public static function save($post_id) {
		if (isset($_POST)) {
			update_post_meta($post_id, "portfolio_date", @$_POST["portfolio_date"]);
			
			update_post_meta($post_id, "portfolio_clients", @$_POST["portfolio_clients"]);
			update_post_meta($post_id, "portfolio_tools", @$_POST["portfolio_tools"]);
			update_post_meta($post_id, "tmm_portfolio", @$_POST["tmm_portfolio"]);
			//***
			update_post_meta($post_id, "portfolio_camera", @$_POST["portfolio_camera"]);
                        update_post_meta($post_id, "portfolio_camera_label", @$_POST["portfolio_camera_label"]);
			update_post_meta($post_id, "portfolio_lens", @$_POST["portfolio_lens"]);
                        update_post_meta($post_id, "portfolio_lens_label", @$_POST["portfolio_lens_label"]);
			update_post_meta($post_id, "portfolio_tripod_or_handheld", @$_POST["portfolio_tripod_or_handheld"]);
                        update_post_meta($post_id, "portfolio_tripod_or_handheld_label", @$_POST["portfolio_tripod_or_handheld_label"]);
			update_post_meta($post_id, "portfolio_fl", @$_POST["portfolio_fl"]);
                        update_post_meta($post_id, "portfolio_fl_label", @$_POST["portfolio_fl_label"]);
			update_post_meta($post_id, "portfolio_exposure", @$_POST["portfolio_exposure"]);
                        update_post_meta($post_id, "portfolio_exposure_label", @$_POST["portfolio_exposure_label"]);
			update_post_meta($post_id, "portfolio_brackets", @$_POST["portfolio_brackets"]);
                        update_post_meta($post_id, "portfolio_brackets_label", @$_POST["portfolio_brackets_label"]);
			update_post_meta($post_id, "portfolio_processed", @$_POST["portfolio_processed"]);
                        update_post_meta($post_id, "portfolio_processed_label", @$_POST["portfolio_processed_label"]);
			update_post_meta($post_id, "portfolio_etc", @$_POST["portfolio_etc"]);
                        update_post_meta($post_id, "portfolio_etc_label", @$_POST["portfolio_etc_label"]);
			
		
		}
	}

	public static function init_meta_boxes() {
		add_meta_box("credits_meta", __("Portfolio attributes", 'almera'), array(__CLASS__, 'credits_meta'), self::$slug, "normal", "low");
		add_meta_box("folio_gallery_meta", __("Folio items", 'almera'), array(__CLASS__, 'gallery_meta'), self::$slug, "normal", "low");
	}

	public static function gallery_meta() {
		global $post;
		$data = array();
		$data['tmm_portfolio'] = get_post_meta($post->ID, 'tmm_portfolio', true);
		echo TMM::draw_html('portfolio/gallery_meta', $data);
	}

	public static function render_gallery_item($data) {
		echo TMM::draw_html('portfolio/render_gallery_item', $data);
	}

	//for ajax
	public static function add_gallery_item() {
		$data = array();
		$data['imgurl'] = $_REQUEST['imgurl'];
		$data['imgurl2'] = '';
		$data['title'] = '';
		$data['categories'] = '';
		echo TMM::draw_html('portfolio/render_gallery_item', $data);
		exit;
	}

	public static function draw_home_layout($layout_num, $folio_post_id = 0) {
		$data = array('folio_post_id' => $folio_post_id);
		echo TMM::draw_html('portfolio/home/layout' . $layout_num, $data);
	}

	//ajax
	public static function get_by_folio_id() {
		$folio_post_id = 0;
		if (isset($_REQUEST['folio_post_id'])) {
			$folio_post_id = intval($_REQUEST['folio_post_id']);
		}
		$layout_num = 1;
		if (isset($_REQUEST['folio_post_id'])) {
			$layout_num = intval($_REQUEST['layout']);
		}

		self::draw_home_layout($layout_num, $folio_post_id);
		exit;
	}

	public static function show_edit_columns_content($column) {
		global $post;

		switch ($column) {
			case "image":
				echo '<div style="width:400px;">';
				echo '<img alt="" src="' . TMM_Helper::get_post_featured_image($post->ID, '200*200', true) . '"/>';

				echo '</div>';
				break;
			case "description":
				the_excerpt();
				break;
			case "tags":
				echo get_the_tag_list('', '', '', $post->ID);
				break;
			case "foliocat":
				echo get_the_term_list($post->ID, 'foliocat', '', ', ', '');
				break;
		}
	}

	public static function show_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Title", 'almera'),
			"image" => __("Cover", 'almera'),
			"description" => __("Description", 'almera'),
			"tags" => __("Tags", 'almera'),
			"foliocat" => __("Categories", 'almera'),
		);

		return $columns;
	}

	//ajax
	public static function get_masonry_piece() {
		$post_key = (int) $_REQUEST['post_key'];
		$posts = $_REQUEST['posts'];
		if (!isset($posts[$post_key])) {
			echo "";
			exit;
		} else {
			$data = array();
			$data['folioposts'] = $posts;
			$data['foliopost_key'] = $post_key;
			$data['foliopost'] = $posts[$post_key];
			$data['current_col_algoritm'] = $_REQUEST['current_col_algoritm'];
			echo TMM::draw_html('portfolio/shortcodes/masonry_piece', $data);
		}

		exit;
	}

}

