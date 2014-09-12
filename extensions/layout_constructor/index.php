<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
add_action("admin_init", array('TMM_Ext_LayoutConstructor', 'admin_init'));
add_action('wp_head', array('TMM_Ext_LayoutConstructor', 'wp_head'), 1, 1);
add_action('admin_head', array('TMM_Ext_LayoutConstructor', 'admin_head'), 1, 1);
add_action('save_post', array('TMM_Ext_LayoutConstructor', 'save_post'));


#06-06-2013 13:16
class TMM_Ext_LayoutConstructor {

	public static $effects = array();

	public static function admin_init() {
		self::$effects = array(
			'' => __("No classes", 'almera'),
			'alpha' => __("Alpha", 'almera'),
			'omega' => __("Omega", 'almera')
		);
		//***
		add_meta_box("layout_constructor", __("Layout constructor", 'almera'), array(__CLASS__, 'draw_page_meta_box'), "page", "normal", "high");
		add_meta_box("layout_constructor", __("Layout constructor", 'almera'), array(__CLASS__, 'draw_page_meta_box'), "post", "normal", "high");
                
                //***
                $is_tmm_theme_options = FALSE;
		if (isset($_GET['page'])) {
			if ($_GET['page'] == 'tmm_theme_options') {
				$is_tmm_theme_options = TRUE;
			}
		}

		if ($is_tmm_theme_options === FALSE) {
			
			wp_enqueue_script('tmm_ext_layout_constructor', self::get_application_uri() . '/js/general.js', array('jquery', 'jquery-ui-core', 'jquery-ui-sortable'));
			wp_enqueue_style('tmm_ext_layout_constructor_popup3', self::get_application_uri() . '/js/tmm_popup/styles.css');
			wp_enqueue_script('tmm_ext_layout_constructor_popup3', self::get_application_uri() . '/js/tmm_popup/tmm_advanced_wp_popup.js', array('jquery'));
		}
                //***
	}

	public static function get_application_path() {
		return TMM_EXT_PATH . '/layout_constructor';
	}

	public static function get_application_uri() {
		return TMM_EXT_URI . '/layout_constructor';
	}

	public static function wp_head() {
	}

	public static function admin_head() {
		wp_enqueue_style('tmm_ext_layout_constructor_css', self::get_application_uri() . '/css/styles.css');
		//wp_enqueue_script('tmm_ext_layout_constructor_js', self::get_application_uri() . '/js/general.js', array('jquery', 'jquery-ui-core', 'jquery-ui-sortable'));
		?>
		<script type="text/javascript">
			var lang_sure_item_delete = "<?php _e("Sure about column deleting?", 'almera') ?>";
			var lang_sure_row_delete = "<?php _e("Sure about row deleting?", 'almera') ?>";
			var lang_add_media = "<?php _e("Add Media", 'almera') ?>";
			var lang_empty = "<?php _e("Empty", 'almera') ?>";
                        var lang_popup_title = "<?php _e("Column content editor", 'tmm_layout_constructor') ?>";
		</script>
		<?php
	}

	public static function draw_page_meta_box() {
		$data = array();
		global $post;
		$data['post_id'] = $post->ID;
		$data['tmm_layout_constructor'] = get_post_meta($post->ID, 'thememakers_layout_constructor', true);
		$data['tmm_layout_constructor_row'] = get_post_meta($post->ID, 'thememakers_layout_constructor_row', true);
		echo TMM::draw_free_page(self::get_application_path() . '/views/meta_panel.php', $data);
	}

	//in backend
	public static function draw_column_item($col_data) {
		global $post;
		$data = array();
		$col_data['post_id'] = $post->ID;		
		echo TMM::draw_free_page(self::get_application_path() . '/views/column_item.php', $col_data);
	}

	public static function save_post() {
		if (!empty($_POST)) {
			if (isset($_POST['tmm_layout_constructor'])) {
				global $post;
				unset($_POST['tmm_layout_constructor']['__ROW_ID__']); //unset column html template
				unset($_POST['tmm_layout_constructor_row']['__ROW_ID__']); //unset column html template
				update_post_meta($post->ID, 'thememakers_layout_constructor', $_POST['tmm_layout_constructor']);
				update_post_meta($post->ID, 'thememakers_layout_constructor_row', $_POST['tmm_layout_constructor_row']);
			}
		}
	}

	public static function draw_front($post_id) {
		$tmm_layout_constructor = get_post_meta($post_id, 'thememakers_layout_constructor', true);
		if (!empty($tmm_layout_constructor)) {
			$data = array();
			$data['tmm_layout_constructor'] = $tmm_layout_constructor;
			$data['tmm_layout_constructor_row'] = get_post_meta($post_id, 'thememakers_layout_constructor_row', true);

			if (!is_array($data['tmm_layout_constructor_row'])) {
				$data['tmm_layout_constructor_row'] = array();
			}

			echo trim(TMM::draw_free_page(self::get_application_path() . '/views/front_output.php', $data));
			return;
		}

		echo "";
		return;
	}

	public static function draw_row_bg($tmm_layout_constructor_row, $row) {
		$style = '';
		if (isset($tmm_layout_constructor_row[$row])) {
			$data = $tmm_layout_constructor_row[$row];
			//***
			$border_css_data = "";
			if (isset($data['border_color'])) {
				if ($data['border_width'] != 0) {
					$border_css_data = 'border-top:' . $data['border_width'] . 'px ' . $data['border_type'] . ' ' . $data['border_color'] . ';';
					$border_css_data.= 'border-bottom:' . $data['border_width'] . 'px ' . $data['border_type'] . ' ' . $data['border_color'] . ';';
				}
			}

			//***
			if (isset($data['bg_type'])) {
				switch ($data['bg_type']) {
					case 'color':
						$style = 'style="background-color:' . $data['bg_data'] . ' !important;' . $border_css_data . '"';
						break;

					case 'image':
						$style = 'style="background: url(' . $data['bg_data'] . ') repeat center center;' . $border_css_data . '"';
						break;

					default:
						break;
				}
			}
		}

		echo $style;
	}

}
