<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
//AJAX callbacks------------------------------------------------------------

add_action('wp_ajax_change_options', array('TMM', 'change_options'));
add_action('wp_ajax_nopriv_change_options', array('TMM', 'change_options'));
add_action('wp_ajax_update_allowed_alias', array('TMM', 'update_allowed_alias'));
add_action('wp_ajax_add_sidebar', array('TMM_Custom_Sidebars', 'add_sidebar'));
add_action('wp_ajax_add_sidebar_page', array('TMM_Custom_Sidebars', 'add_sidebar_page'));
add_action('wp_ajax_add_sidebar_category', array('TMM_Custom_Sidebars', 'add_sidebar_category'));
add_action('wp_ajax_contact_form_request', array('TMM_Contact_Form', 'contact_form_request'));
add_action('wp_ajax_add_comment', array('TMM_Helper', 'add_comment'));
add_action('wp_ajax_get_google_fonts', array('TMM_HelperFonts', 'get_google_fonts_ajax'));
add_action('wp_ajax_get_new_google_fonts', array('TMM_HelperFonts', 'get_new_google_fonts'));
add_action('wp_ajax_save_google_fonts', array('TMM_HelperFonts', 'save_google_fonts'));
add_action('wp_ajax_add_seo_group', array('TMM_SEO_Group', 'add_seo_group'));
add_action('wp_ajax_add_seo_group_category', array('TMM_SEO_Group', 'add_seo_group_category'));
add_action('wp_ajax_get_resized_image_url', array('TMM_Helper', 'get_resized_image_url'));
add_action('wp_ajax_add_gallery_item', array('TMM_Gallery', 'add_gallery_item'));
add_action('wp_ajax_add_gallery_folio_item', array('TMM_Portfolio', 'add_gallery_item'));
add_action('wp_ajax_add_post_podtype_gallery_image', array('TMM_Page', 'add_post_podtype_gallery_image'));
add_action('wp_ajax_folio_get_by_folio_id', array('TMM_Portfolio', 'get_by_folio_id'));
//***
add_action('wp_ajax_nopriv_contact_form_request', array('TMM_Contact_Form', 'contact_form_request'));
add_action('wp_ajax_nopriv_add_comment', array('TMM_Helper', 'add_comment'));
add_action('wp_ajax_nopriv_get_google_fonts', array('TMM_HelperFonts', 'get_google_fonts_ajax'));
add_action('wp_ajax_nopriv_get_new_google_fonts', array('TMM_HelperFonts', 'get_new_google_fonts'));
add_action('wp_ajax_nopriv_folio_get_by_folio_id', array('TMM_Portfolio', 'get_by_folio_id'));

add_action('wp_ajax_folio_get_masonry_piece', array('TMM_Portfolio', 'get_masonry_piece'));
add_action('wp_ajax_nopriv_folio_get_masonry_piece', array('TMM_Portfolio', 'get_masonry_piece'));

//--------------------------------------------------------------------------

add_action('admin_menu', 'tmm_theme_add_admin');
add_action('admin_enqueue_scripts', 'tmm_theme_admin_head');
add_action('admin_bar_menu', 'tmm_theme_admin_bar_menu', 89);

//*****

global $pagenow;
if (is_admin() AND 'themes.php' == $pagenow AND isset($_GET['activated'])) {
	//***** set default options
	$theme_was_activated = TMM::get_option('theme_was_activated');
	if (!$theme_was_activated) {
		//*****
		$menu_id = wp_update_nav_menu_object(0, array('menu-name' => 'Primary Menu'));
		$theme_mods = get_option('theme_mods_' . 'almera');
		$theme_mods['nav_menu_locations']['primary'] = $menu_id;
		update_option('theme_mods_' . 'almera', $theme_mods);

		if (class_exists('TMM_Ext_Shortcodes')) {
			$shortcodes = TMM_Ext_Shortcodes::get_shortcodes_array();
			if (!empty($shortcodes)) {
				foreach ($shortcodes as $shortcode) {
					TMM::update_option('show_shortcode_' . $shortcode, 1);
				}
			}
		}

		TMM::update_option('theme_was_activated', 1);
		//*****
		TMM::update_option('saved_google_fonts', 'a:1:{i:0;s:83:"Open Sans:300,300italic,400regular,italic,600,600italic,700,700italic,800,800italic";}');
		TMM::update_option('sidebar_position', 'sbr');
		TMM::update_option('copyright_text', 'Copyright &copy; 2013. <a target="_blank" href="http://webtemplatemasters.com">ThemeMakers</a>. All rights reserved');
	}
}

//********************
add_action('admin_notices', 'tmm_print_admin_notice');

function tmm_print_admin_notice() {
	$notices = "";

	if (!is_writable(TMM_THEME_PATH . "/css/custom1.css")) {
		$notices.=__('<div class="error"><p>To make your theme work correctly you need to set the permissions 777 for <b>' . TMM_THEME_PATH . '/css/custom1.css</b> folder. Follow <a href="http://webtemplatemasters.com/tutorials/permissions/" target="_blank">the link</a> to read the instructions how to do it properly.</p></div>', 'almera');
	}

	if (!is_writable(TMM_THEME_PATH . "/css/custom2.css")) {
		$notices.=__('<div class="error"><p>To make your theme work correctly you need to set the permissions 777 for <b>' . TMM_THEME_PATH . '/css/custom2.css</b> folder. Follow <a href="http://webtemplatemasters.com/tutorials/permissions/" target="_blank">the link</a> to read the instructions how to do it properly.</p></div>', 'almera');
	}


	echo $notices;
}

/* * ****************** functions *********************** */

function tmm_theme_admin_bar_menu() {
	global $wp_admin_bar;
	if (!is_super_admin() || !is_admin_bar_showing())
		return;
	$wp_admin_bar->add_menu(array(
		'id' => 'tmm_link',
		'title' => __("Theme Options", 'almera'),
		'href' => admin_url() . 'themes.php?page=tmm_theme_options',
	));
}

function tmm_theme_add_admin() {
	add_theme_page(__("Theme Options", 'almera'), __("Theme Options", 'almera'), 'manage_options', 'tmm_theme_options', 'tmm_theme_admin');
}

function tmm_theme_admin() {
	echo TMM::draw_free_page(TMM_THEME_PATH . '/admin/theme_options/theme_options.php');
}

function tmm_theme_admin_head() {
	wp_enqueue_style("tmm_admin_styles_css", TMM_THEME_URI . '/admin/css/styles.css');
	wp_enqueue_style("fonts", TMM_THEME_URI . '/admin/css/fonts.css');
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-sortable');

	wp_enqueue_script('media-upload');
	
	wp_enqueue_style('thickbox');
	wp_enqueue_script('thickbox');
	
	if (isset($_GET['page']) && $_GET['page'] == 'tmm_theme_options') {
		wp_enqueue_style("tmm_theme_admin_css", TMM_THEME_URI . '/admin/theme_options/css/options_styles.css');
		wp_enqueue_style("tmm_theme_jquery_ui_css2", TMM_THEME_URI . '/admin/theme_options/css/jquery-ui.css');
		
		wp_enqueue_script('tmm_theme_options_js', TMM_THEME_URI . '/admin/theme_options/js/options.js', array('jquery', 'jquery-ui-core', 'jquery-ui-dialog'));
		wp_enqueue_script('tmm_theme_custom_sidebars_js', TMM_THEME_URI . '/admin/theme_options/js/custom_sidebars.js');
		wp_enqueue_script('tmm_theme_seo_groups_js', TMM_THEME_URI . '/admin/theme_options/js/seo_groups.js');
		wp_enqueue_script('tmm_theme_form_constructor_js', TMM_THEME_URI . '/admin/theme_options/js/form_constructor.js');

		if (wp_script_is('jquery-ui-widget', 'registered')) {
			wp_enqueue_script('jquery-ui-progressbar', TMM_THEME_URI . '/admin/theme_options/js/jquery-ui/jquery.ui.progressbar.min.js', array('jquery-ui-core', 'jquery-ui-widget'));
		} else {
			wp_enqueue_script('jquery-ui-progressbar', TMM_THEME_URI . '/admin/theme_options/js/jquery-ui/jquery.ui.progressbar.min.1.7.2.js', array('jquery-ui-core'));
		}
	}
	
	wp_enqueue_script('thememakers_js', TMM_THEME_URI . '/js/thememakers.js', array('jquery'));
	wp_enqueue_script('tmm_theme_admin_js', TMM_THEME_URI . '/admin/js/general.js', array('jquery', 'jquery-ui-core', 'jquery-ui-slider', 'jquery-ui-sortable', 'jquery-ui-tabs'));
	//***
	wp_enqueue_style("tmm_theme_colorpicker_css", TMM_THEME_URI . '/admin/js/colorpicker/colorpicker.css');
	wp_enqueue_script('tmm_theme_colorpicker_js', TMM_THEME_URI . '/admin/js/colorpicker/colorpicker.js', array('jquery'));
	//***
	wp_enqueue_style("tmm_theme_popup_css", TMM_THEME_URI . '/admin/js/tmm_popup/styles.css');
	wp_enqueue_script('tmm_theme_popup_js', TMM_THEME_URI . '/admin/js/tmm_popup/tmm_advanced_wp_popup.js', array('jquery'));
	?>
	<!--[if IE]>
			<script>
				document.createElement('header');
				document.createElement('footer');
				document.createElement('section');
				document.createElement('aside');
				document.createElement('nav');
				document.createElement('article');
			</script>
	<![endif]-->
	
	<script type="text/javascript">
		var site_url = "<?php echo home_url(); ?>/";
		var template_directory = "<?php echo TMM_THEME_URI; ?>/";
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		//translations
		var lang_edit = "<?php _e('Edit', 'almera'); ?>";
		var lang_delete = "<?php _e('Delete', 'almera'); ?>";
		var lang_cancel = "<?php _e('Cancel', 'almera'); ?>";
		var lang_one_moment = "<?php _e("One moment", 'almera') ?>";
		var lang_loading = "<?php _e("Loading", 'almera') ?> ...";
	</script>


	<?php
	echo TMM_HelperFonts::get_google_fonts_link();
}
