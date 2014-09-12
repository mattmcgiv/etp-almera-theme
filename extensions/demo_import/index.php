<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
add_action('admin_head', array('TMM_Ext_DemoImport', 'admin_head'), 1);
//AJAX
add_action('wp_ajax_tmm_import_demo_data', array('TMM_Ext_DemoImport', 'import_demo_data'));


class TMM_Ext_DemoImport {

	public static function admin_head() {
		if (isset($_GET['page'])) {
			if ($_GET['page'] == 'tmm_theme_options') {
				?>
				<script type="text/javascript">
					var lang_app_demo_import1 = "<?php _e("Sure? Current data base will be fully erased!!", 'almera') ?>";
					var lang_app_demo_import3 = "<?php _e("Page reloading ...", 'almera') ?>";
				</script>
				<?php
				wp_enqueue_script('tmm_ext_demo_import_js', TMM_EXT_URI . '/demo_import/js/general.js', array('jquery'));
			}
		}
	}

	

	//ajax
	public static function import_demo_data() {
		//FIRSTLY LETS CHESK IS CUSTOMER UPLOAD DATA FILES IN wp_content/uploads	
		$wp_options = file_exists(TMM_Helper::get_upload_folder() . 'almera' . '/wp_options.dat');
		$wp_postmeta = file_exists(TMM_Helper::get_upload_folder() . 'almera' . '/wp_postmeta.dat');
		$demo_db = file_exists(TMM_Helper::get_upload_folder() . 'almera' . '/demo_db.sql');

		if (!$wp_options OR !$wp_postmeta OR !$demo_db) {
			_e("Ooops! It seems demo files are missed on the server. Please, make sure the \"uploads\" directory exists in your \"/wp-content\" directory with all the necessary files from theme bundle.", 'almera');
			exit;
		}

		//*** check for tmm_shortcodes plugin uploading
		$tmm_shortcodes = ABSPATH . 'wp-content/plugins/tmm_shortcodes';
		$tmm_shortcodes = is_dir($tmm_shortcodes);
		if (!$tmm_shortcodes) {
			_e("Ooops! You've missed to install the \"tmm_shortcodes\" before demo installation. Please install tmm_shortcodes before doing that. You can find it in theme bundle. ", 'almera');
			exit;
		}
		//*** DATA BASE IMPORT
		global $wpdb;
		$site_url = site_url();
		$new_file_path = ABSPATH;
		//***
		$sql_install_data = (file_get_contents(TMM_Helper::get_upload_folder() . 'almera' . '/demo_db.sql'));
		$sql_install_data = str_replace('new_site_url', $site_url, $sql_install_data);
		$sql_install_data = str_replace('new_file_path', $new_file_path, $sql_install_data);
		//***
		$wpdb->query("DROP TABLE `{$wpdb->commentmeta}`");
		$wpdb->query("DROP TABLE `{$wpdb->comments}`");
		$wpdb->query("DROP TABLE `{$wpdb->links}`");
		$wpdb->query("DROP TABLE `{$wpdb->options}`");
		$wpdb->query("DROP TABLE `{$wpdb->postmeta}`");
		$wpdb->query("DROP TABLE `{$wpdb->posts}`");
		$wpdb->query("DROP TABLE `{$wpdb->terms}`");
		$wpdb->query("DROP TABLE `{$wpdb->term_relationships}`");
		$wpdb->query("DROP TABLE `{$wpdb->term_taxonomy}`");
		$wpdb->query("DROP TABLE `{$wpdb->usermeta}`");
		$wpdb->query("DROP TABLE `{$wpdb->users}`");
		//***
		$sql_install_data = str_replace('wp_commentmeta', $wpdb->commentmeta, $sql_install_data);
		$sql_install_data = str_replace('wp_comments', $wpdb->comments, $sql_install_data);
		$sql_install_data = str_replace('wp_layerslider', $wpdb->base_prefix . 'layerslider', $sql_install_data);
		$sql_install_data = str_replace('wp_links', $wpdb->links, $sql_install_data);
		$sql_install_data = str_replace('wp_options', $wpdb->options, $sql_install_data);
		$sql_install_data = str_replace('wp_postmeta', $wpdb->postmeta, $sql_install_data);
		$sql_install_data = str_replace('wp_posts', $wpdb->posts, $sql_install_data);
		$sql_install_data = str_replace('wp_revslider_sliders', $wpdb->base_prefix . 'revslider_sliders', $sql_install_data);
		$sql_install_data = str_replace('wp_terms', $wpdb->terms, $sql_install_data);
		$sql_install_data = str_replace('wp_term_relationships', $wpdb->term_relationships, $sql_install_data);
		$sql_install_data = str_replace('wp_term_taxonomy', $wpdb->term_taxonomy, $sql_install_data);
		$sql_install_data = str_replace('wp_usermeta', $wpdb->usermeta, $sql_install_data);
		$sql_install_data = str_replace('wp_users', $wpdb->users, $sql_install_data);
		//***
		$sql_install_data = str_replace('wp_user_roles', $wpdb->base_prefix . 'user_roles', $sql_install_data);
		//***
		$sql_install_data = explode('#---TMM_DUMP', $sql_install_data);
		//***
		$sql_install_data = array_map('trim', $sql_install_data);
		$sql_install_data = array_map('utf8_encode', $sql_install_data);
		//***
		if (!empty($sql_install_data)) {
			foreach ($sql_install_data as $query) {
				if (!empty($query)) {
					$wpdb->query($query);
				}
			}
		}

		//*** export serialized data from wp_postmeta.dat to wp_postmeta
		$wp_postmeta_data = file_get_contents(TMM_Helper::get_upload_folder() . 'almera' . '/wp_postmeta.dat');
		$wp_postmeta_data = json_decode($wp_postmeta_data, TRUE);

		if (!empty($wp_postmeta_data)) {
			$wp_postmeta_data = self::array_value_replace($wp_postmeta_data, 'new_site_url', $site_url);
			foreach ($wp_postmeta_data as $row_data) {
				$data = array();

				if (is_array($row_data['meta_value'])) {
					$data = array(
						'meta_id' => $row_data['meta_id'],
						'post_id' => $row_data['post_id'],
						'meta_key' => $row_data['meta_key'],
						'meta_value' => '',
					);
				} else {
					$data = array(
						'meta_id' => $row_data['meta_id'],
						'post_id' => $row_data['post_id'],
						'meta_key' => $row_data['meta_key'],
						'meta_value' => $row_data['meta_value'],
					);
				}

				//*****

				$wpdb->insert($wpdb->postmeta, $data);
				if (is_array($row_data['meta_value'])) {
					update_post_meta($row_data['post_id'], $row_data['meta_key'], $row_data['meta_value']);
				}
			}
		}

		//*** export serialized data from wp_options.dat to wp_postmeta
		$wp_options_data = (file_get_contents(TMM_Helper::get_upload_folder() . 'almera' . '/wp_options.dat'));
		$wp_options_data = json_decode($wp_options_data, TRUE);

		if (!empty($wp_options_data)) {
			$wp_options_data = self::array_value_replace($wp_options_data, 'new_site_url', $site_url);
			update_option(TMM_THEME_PREFIX . 'theme_options', $wp_options_data);
		}
		//***
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure('/%postname%/');
		$wp_rewrite->flush_rules(true);
		//***
		$theme_mods = get_option('theme_mods_' . 'almera');
		$theme_mods['nav_menu_locations']['primary'] = 2;
		update_option('theme_mods_' . 'almera', $theme_mods);
		//***
		//DEMO USER CREATING
		$userdata['user_login'] = 'demo';
		$userdata['user_pass'] = 'demo';
		$userdata['user_email'] = 'demo@demo.com';
		$userdata['user_nicename'] = 'demo';
		$userdata['role'] = 'administrator';
		wp_insert_user($userdata);
		//***
		echo 'succsess';
		exit;
	}

	public static function array_value_replace($maybe_array, $replace_from, $replace_to) {

		if (!empty($maybe_array)) {
			if (is_array($maybe_array)) {
				foreach ($maybe_array as $key => $value) {
					$maybe_array[$key] = self::array_value_replace($value, $replace_from, $replace_to);
				}
			} else {
				if (is_string($maybe_array)) {
					$maybe_array = str_replace($replace_from, $replace_to, $maybe_array);
				}
			}
		}

		return $maybe_array;
	}

}

