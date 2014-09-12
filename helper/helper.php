<?php

class TMM_Helper {

	public static $shortcodes_js_links = array();

	//to call shorcodes by ajax
	public static function add_shortcode_js_link($js_link) {
		if (isset($_REQUEST['is_ajax_action'])) {
			if (!in_array($js_link, self::$shortcodes_js_links)) {
				self::$shortcodes_js_links[] = $js_link;
			}
		}
	}

	//*****

	public static function get_post_featured_image($post_id, $alias, $show_cap = false) {
		$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'single-post-thumbnail');
		$img_src = $img_src[0];
		$url = self::get_image($img_src, $alias, $show_cap);
		return $url;
	}

	public static function resize_image($img_src, $alias, $show_cap = true) {
		return self::get_image($img_src, $alias, $show_cap);
	}


    public static function get_image($img_src, $alias, $show_cap = true) {
        if (empty($alias)) {
            return $img_src;
        }

        $al = explode('*', $alias);
        $new_img_src = aq_resize($img_src, $al[0], $al[1], true);
               
        $caps=(TMM::get_option('dark')=='1') ? 'caps_dark' : 'caps_light';

        if (!$new_img_src) {
            if ($show_cap) {
                $al = str_replace('*', 'x', $alias);
                return TMM_THEME_URI . '/images/' . $caps . '/no-image_' . $al . '.jpg';
            }
        }

        return $new_img_src;
    }

    public static function is_file_url_exists($url) {
		$current_domen_count = substr_count($url, home_url());
		if (!$current_domen_count) {
			return FALSE;
		}
		//***
		$path_array = explode('wp-content', $url);
		if (file_exists(ABSPATH . 'wp-content' . $path_array[1])) {
			return TRUE;
		}

		return FALSE;
	}

	/*
	 * Get type of video (vimeo,youtube) and images of site
	 */

	public static function get_media_type($source_url) {
		$media_type = 'image';
		//***
		$allows_video_array = array('youtube.com', 'vimeo.com');
		foreach ($allows_video_array as $needle) {
			$count = strpos($source_url, $needle);
			if ($count !== FALSE) {
				$media_type = 'video';
				break;
			}
		}

		return $media_type;
	}

//Custom page navigation
	public static function pagenavi($query = null) {
		global $wp_query, $wp_rewrite;
		if (!$query)
			$query = $wp_query;
		$pages = '';
		$max = $query->max_num_pages;
		if (!$current = get_query_var('paged')) {
			$current = 1;
		}

		$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
		$a['total'] = $max;
		$a['current'] = $current;

		$total = 1; //1 - display the text "Page N of N", 0 - not display
		$a['mid_size'] = 5; //how many links to show on the left and right of the current
		$a['end_size'] = 1; //how many links to show in the beginning and end
		$a['prev_text'] = ''; //text of the "Previous page" link
		$a['next_text'] = ''; //text of the "Next page" link

		echo $pages . paginate_links($a);
	}

	public function add_comment() {
		if (!empty($_REQUEST['comment_content'])) {
			$time = current_time('mysql');
			$user = get_userdata(get_current_user_id());
			$data = array(
				'comment_post_ID' => $_REQUEST['comment_post_ID'],
				'comment_author' => $user->data->user_nicename,
				'comment_author_email' => $user->data->user_email,
				'comment_author_url' => $user->data->user_url,
				'comment_content' => $_REQUEST['comment_content'],
				'comment_parent' => $_REQUEST['comment_parent'],
				'user_id' => $user->data->ID,
				'comment_date' => $time,
			);

			echo wp_insert_comment($data);
		}

		exit;
	}

	public static function get_monts_names($num) {
		$monthes = array(
			0 => __('January', 'almera'),
			1 => __('February', 'almera'),
			2 => __('March', 'almera'),
			3 => __('April', 'almera'),
			4 => __('May', 'almera'),
			5 => __('June', 'almera'),
			6 => __('July', 'almera'),
			7 => __('August', 'almera'),
			8 => __('September', 'almera'),
			9 => __('October', 'almera'),
			10 => __('November', 'almera'),
			11 => __('December', 'almera'),
		);

		return $monthes[$num];
	}

	public static function get_short_monts_names($num) {
		$monthes = array(
			0 => __('jan', 'almera'),
			1 => __('feb', 'almera'),
			2 => __('mar', 'almera'),
			3 => __('apr', 'almera'),
			4 => __('may', 'almera'),
			5 => __('jun', 'almera'),
			6 => __('jul', 'almera'),
			7 => __('aug', 'almera'),
			8 => __('sep', 'almera'),
			9 => __('oct', 'almera'),
			10 => __('nov', 'almera'),
			11 => __('dec', 'almera'),
		);

		return $monthes[$num];
	}

	public static function get_days_of_week($num) {
		$days = array(
			0 => __('Sunday', 'almera'),
			1 => __('Monday', 'almera'),
			2 => __('Tuesday', 'almera'),
			3 => __('Wednesday', 'almera'),
			4 => __('Thursday', 'almera'),
			5 => __('Friday', 'almera'),
			6 => __('Saturday', 'almera'),
		);

		return $days[$num];
	}

	public static function db_quotes_shield($data) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				if (is_array($value)) {
					$data[$key] = self::db_quotes_shield($value);
				} else {
					$value = stripslashes($value);
					$value = str_replace('\"', '"', $value);
					$value = str_replace("\'", "'", $value);
					$data[$key] = $value;
				}
			}
		}

		return $data;
	}

	public static function get_post_sort_array() {
		return array('ID' => 'ID', 'date' => 'date', 'post_date' => 'post_date', 'title' => 'title',
			'post_title' => 'post_title', 'name' => 'name', 'post_name' => 'post_name', 'modified' => 'modified',
			'post_modified' => 'post_modified', 'modified_gmt' => 'modified_gmt', 'post_modified_gmt' => 'post_modified_gmt',
			'menu_order' => 'menu_order', 'parent' => 'parent', 'post_parent' => 'post_parent',
			'rand' => 'rand', 'comment_count' => 'comment_count', 'author' => 'author', 'post_author' => 'post_author');
	}

	public static function get_post_categories() {
		$post_categories_objects = get_categories(array(
			'orderby' => 'name',
			'order' => 'ASC',
			'style' => 'list',
			'show_count' => 0,
			'hide_empty' => 0,
			'use_desc_for_title' => 1,
			'child_of' => 0,
			'hierarchical' => true,
			'title_li' => '',
			'show_option_none' => '',
			'number' => NULL,
			'echo' => 0,
			'depth' => 0,
			'current_category' => 0,
			'pad_counts' => 0,
			'taxonomy' => 'category',
			'walker' => 'Walker_Category'));

		$post_categories = array();
		$post_categories[0] = __('All Categories', 'almera');
		foreach ($post_categories_objects as $value) {
			$post_categories[$value->term_id] = $value->name;
		}

		return $post_categories;
	}

	public static function get_the_category_list($separator = '', $parents = '', $post_id = false) {
		global $wp_rewrite, $cat;
		if (!is_object_in_taxonomy(get_post_type($post_id), 'category'))
			return apply_filters('the_category', '', $separator, $parents);

		$categories = get_the_category($post_id);
		if (empty($categories))
			return apply_filters('the_category', __('Uncategorized', 'almera'), $separator, $parents);

		$rel = ( is_object($wp_rewrite) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

		$thelist = '';
		foreach ($categories as $category) {

			if ($cat == $category->term_id) {
				$thelist .= '&nbsp;' . $category->name;
				break;
			} else {
				$thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' . esc_attr(sprintf(__("View all posts in %s", 'almera'), $category->name)) . '" ' . $rel . '>' . $category->name . '</a></li>';
			}
		}

		return apply_filters('the_category', $thelist, $separator, $parents);
	}

	public static function get_page_backround($page_id) {
		if ($page_id > 0) {
			$page_bg = TMM_Page::get_page_settings($page_id);

			if ($page_bg['pagebg_type'] == "image") {
				if (!empty($page_bg['pagebg_image'])) {

					if (!$page_bg['pagebg_type_image_option']) {
						$page_bg['pagebg_type_image_option'] = "repeat";
					}

					switch ($page_bg['pagebg_type_image_option']) {
						case "repeat-x":
							if (!empty($page_bg['pagebg_image'])) {
								return "background: url(" . $page_bg['pagebg_image'] . ") repeat-x 0 0";
							} else {
								return "";
							}
							break;

						case "fixed":
							if (!empty($page_bg['pagebg_image'])) {
								return "background: url(" . $page_bg['pagebg_image'] . ") no-repeat center top fixed;";
							} else {
								return "";
							}
							break;

						default:
							if (!empty($page_bg['pagebg_image'])) {
								return "background: url(" . $page_bg['pagebg_image'] . ") repeat 0 0";
							} else {
								return "";
							}
							break;
					}
				}
			}

			if ($page_bg['pagebg_type'] == "color") {
				if (!empty($page_bg['pagebg_color'])) {
					return "background: " . $page_bg['pagebg_color'];
				}
			}

			//return self::draw_body_bg();
		} else {
			//return self::draw_body_bg();
		}

		return "";
	}

	public static function draw_wrapper_bg() {
		$disable_body_bg = TMM::get_option('disable_body_bg');
		if (!$disable_body_bg) {
			$body_pattern = TMM::get_option('body_pattern');
			$body_pattern_custom_color = TMM::get_option('body_pattern_custom_color');
			$body_pattern_selected = (int) TMM::get_option('body_pattern_selected');
			$body_bg_color_selected = TMM::get_option('body_bg_color');

			if ($body_pattern_selected == 0 OR $body_pattern_selected == 1) {
				if (!empty($body_pattern)) {
					return "background: url(" . $body_pattern . ") repeat 0 0 " . $body_bg_color_selected . ";";
				} else {
					return "";
				}
			} else {
                            if (!empty($body_pattern_custom_color)){
                                return "background: " . $body_pattern_custom_color;
                            }else{
                                return '';
                            }
				
			}
		}
	}

	public static function get_header_bg($page_id) {
		if ($page_id > 0) {
			$page_settings = TMM_Page::get_page_settings($page_id);

			if (!isset($page_settings['headerbg_opacity'])) {
				$page_settings['headerbg_opacity'] = 100;
			}

			if ($page_settings['headerbg_type'] == "image") {
				if (!empty($page_settings['headerbg_image'])) {

					if (!$page_settings['headerbg_type_image_option']) {
						$page_settings['headerbg_type_image_option'] = "repeat";
					}

					switch ($page_settings['headerbg_type_image_option']) {
						case "repeat-x":
							if (!empty($page_settings['headerbg_image'])) {
								return "style='background: url(" . $page_settings['headerbg_image'] . ") repeat-x 0 0;opacity:" . ((float) $page_settings['headerbg_opacity'] / 100) . "'";
							} else {
								return "";
							}
							break;

						case "fixed":
							if (!empty($page_settings['headerbg_image'])) {
								return "style='background: url(" . $page_settings['headerbg_image'] . ") no-repeat center top fixed;opacity:" . ((float) $page_settings['headerbg_opacity'] / 100) . "'";
							} else {
								return "";
							}
							break;

						default:
							if (!empty($page_settings['headerbg_image'])) {
								return "style='background: url(" . $page_settings['headerbg_image'] . ") repeat 0 0;opacity:" . ((float) $page_settings['headerbg_opacity'] / 100) . "'";
							} else {
								return "";
							}
							break;
					}
				}
			}

			if ($page_settings['headerbg_type'] == "color") {
				if (!empty($page_settings['headerbg_color'])) {
					return "style='background: " . $page_settings['headerbg_color'] . ";opacity:" . ((float) $page_settings['headerbg_opacity'] / 100) . "'";
				}
			}
		}


		return "";
	}

	public static function get_footer_bg($page_id) {
		if ($page_id > 0) {
			
			$page_settings = TMM_Page::get_page_settings($page_id);

			if (!isset($page_settings['footerbg_opacity'])) {
				$page_settings['footerbg_opacity'] = 100;
			}

			if ($page_settings['footerbg_type'] == "image") {
				
				if (!empty($page_settings['footerbg_image'])) {

					if (!$page_settings['footerbg_type_image_option']) {
						$page_settings['footerbg_type_image_option'] = "repeat";
					}

					switch ($page_settings['footerbg_type_image_option']) {
						case "repeat-x":
							if (!empty($page_settings['footerbg_image'])) {
								return "style='background: url(" . $page_settings['footerbg_image'] . ") repeat-x 0 0;opacity:" . ((float) $page_settings['footerbg_opacity'] / 100) . "'";
							} else {
								return "";
							}
							break;

						case "fixed":
							if (!empty($page_settings['footerbg_image'])) {
								return "style='background: url(" . $page_settings['footerbg_image'] . ") no-repeat center top fixed;opacity:" . ((float) $page_settings['footerbg_opacity'] / 100) . "'";
							} else {
								return "";
							}
							break;

						default:
							if (!empty($page_settings['footerbg_image'])) {
								return "style='background: url(" . $page_settings['footerbg_image'] . ") repeat 0 0;opacity:" . ((float) $page_settings['footerbg_opacity'] / 100) . "'";
							} else {
								return "";
							}
							break;
					}
				}
			}

			if ($page_settings['footerbg_type'] == "color") {
				if (!empty($page_settings['footerbg_color'])) {
					return "style='background: " . $page_settings['footerbg_color'] . ";opacity:" . ((float) $page_settings['footerbg_opacity'] / 100) . "'";
				}
			}
		}


		return "";
	}

	public static function hex2rgb($hex) {

		$hex = str_replace("#", "", $hex);

		if (strlen($hex) == 3) {
			$r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
			$g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
			$b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
		} else {
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));
		}
		$rgb = array($r, $g, $b);

		foreach ($rgb as $key => $color) {
			if ($key > 0)
				echo ',';
			echo $color;
		}
	}

	public static function get_upload_folder() {
		$path = wp_upload_dir();
		$path = $path['basedir'];

		if (!file_exists($path)) {
			mkdir($path, 0777);
		}

		$path = $path . '/thememakers/';
		if (!file_exists($path)) {
			mkdir($path, 0777);
		}

		return $path;
	}

	public static function get_upload_folder_uri() {
		$link = wp_upload_dir();
		return $link['baseurl'] . '/thememakers/';
	}

	public static function delete_dir($path) {
		if (is_dir($path)) {
			$it = new RecursiveDirectoryIterator($path);
			$files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
			foreach ($files as $file) {
				if ($file->isDir()) {
					rmdir($file->getRealPath());
				} else {
					unlink($file->getRealPath());
				}
			}
			rmdir($path);
		}
	}

	//ajax
	public static function get_resized_image_url() {
		echo TMM_Helper::resize_image($_REQUEST['imgurl'], $_REQUEST['alias']);
		exit;
	}

	/*
	 * recursive copy of folders
	 */

	public static function recursive_copy($src, $dst) {
		$dir = opendir($src);
		@mkdir($dst);
		while (false !== ( $file = readdir($dir))) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if (is_dir($src . '/' . $file)) {
					self::recursive_copy($src . '/' . $file, $dst . '/' . $file);
				} else {
					copy($src . '/' . $file, $dst . '/' . $file);
				}
			}
		}
		closedir($dir);
	}

	public static function draw_html_option($data) {
		switch ($data['type']) {
			case 'textarea':
				?>
				<?php if (!empty($data['title'])): ?>
					<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
				<?php endif; ?>

				<textarea id="<?php echo $data['id'] ?>" class="js_shortcode_template_changer data-area" data-shortcode-field="<?php echo $data['shortcode_field'] ?>"><?php echo $data['default_value'] ?></textarea>
				<span class="preset_description"><?php echo $data['description'] ?></span>
				<?php
				break;
			case 'select':
				if (!isset($data['display'])) {
					$data['display'] = 1;
				}
				?>
				<?php if (!empty($data['title'])): ?>
					<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
				<?php endif; ?>

				<?php if (!empty($data['options'])): ?>
					<select <?php if ($data['display'] == 0): ?>style="display: none;"<?php endif; ?> class="js_shortcode_template_changer data-select <?php echo @$data['css_classes']; ?>" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" id="<?php echo $data['id'] ?>">

						<?php foreach ($data['options'] as $key => $text) : ?>
							<option <?php if ($data['default_value'] == $key) echo 'selected' ?> value="<?php echo $key ?>"><?php echo $text ?></option>
						<?php endforeach; ?>

					</select>
				<?php endif; ?>
				<?php
				break;
			case 'text':
				?>
				<?php if (!empty($data['title'])): ?>
					<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
				<?php endif; ?>

				<input type="text" value="<?php echo $data['default_value'] ?>" class="js_shortcode_template_changer data-input <?php echo @$data['css_classes']; ?>" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" id="<?php echo $data['id'] ?>" />
				<span class="preset_description"><?php echo $data['description'] ?></span>
				<?php
				break;
			case 'color':
				?>
				<?php if (!empty($data['title'])): ?>
					<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
				<?php endif; ?>

				<input type="text" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" value="<?php echo $data['default_value'] ?>" class="bg_hex_color text small js_shortcode_template_changer <?php echo @$data['css_classes']; ?>" id="<?php echo $data['id'] ?>">
				<div style="background-color: <?php echo $data['default_value'] ?>" class="bgpicker"></div>
				<span class="preset_description"><?php echo $data['description'] ?></span>
				<?php
				break;
			case 'upload':
				?>
				<?php if (!empty($data['title'])): ?>
					<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
				<?php endif; ?>

				<input type="text" id="<?php echo $data['id'] ?>" value="<?php echo $data['default_value'] ?>" class="js_shortcode_template_changer data-input data-upload <?php echo @$data['css_classes']; ?>" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" />
				<a title="" class="button_upload button-primary" href="#">
					<?php _e('Upload', 'almera'); ?>
				</a>
				<span class="preset_description"><?php echo $data['description'] ?></span>
				<?php
				break;
			case 'checkbox':
				?>
				<?php if (!empty($data['title'])): ?>
					<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
				<?php endif; ?>

				<div class="radio-holder">
					<input <?php if ($data['is_checked']): ?>checked=""<?php endif; ?> type="checkbox" value="<?php if ($data['is_checked']): ?>1<?php else: ?>0<?php endif; ?>" id="<?php echo $data['id'] ?>" class="js_shortcode_template_changer js_shortcode_checkbox_self_update data-check" data-shortcode-field="<?php echo $data['shortcode_field'] ?>">
					<label for="<?php echo $data['id'] ?>"><span></span><i class="description"><?php echo $data['description'] ?></i></label>
					<span class="preset_description"><?php echo $data['description'] ?></span>
				</div><!--/ .radio-holder-->
				<?php
				break;
			case 'radio':
				?>
				<?php if (!empty($data['title'])): ?>
					<h4 class="label" for="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></h4>
				<?php endif; ?>

				<div class="radio-holder">
					<input <?php if ($data['values'][0]['checked'] == 1): ?>checked=""<?php endif; ?> type="radio" name="<?php echo $data['name'] ?>" id="<?php echo $data['values'][0]['id'] ?>" value="<?php echo $data['values'][0]['value'] ?>" class="js_shortcode_radio_self_update" />
					<label for="<?php echo $data['values'][0]['id'] ?>" class="label-form"><span></span><?php echo $data['values'][0]['title'] ?></label>

					<input <?php if ($data['values'][1]['checked'] == 1): ?>checked=""<?php endif; ?> type="radio" name="<?php echo $data['name'] ?>" id="<?php echo $data['values'][1]['id'] ?>" value="<?php echo $data['values'][1]['value'] ?>" class="js_shortcode_radio_self_update" />
					<label for="<?php echo $data['values'][1]['id'] ?>" class="label-form"><span></span><?php echo $data['values'][1]['title'] ?></label>

					<input type="hidden" id="<?php echo @$data['hidden_id'] ?>" value="<?php echo $data['value'] ?>" class="js_shortcode_template_changer" data-shortcode-field="<?php echo $data['shortcode_field'] ?>" />
				</div><!--/ .radio-holder-->
				<span class="preset_description"><?php echo $data['description'] ?></span>
				<?php
				break;
		}
	}

	public static function sort_terms_hierarchicaly(Array &$cats, Array &$into, $parentId = 0) {
		foreach ($cats as $i => $cat) {
			if ($cat->parent == $parentId) {
				$into[$cat->term_id] = $cat;
				unset($cats[$i]);
			}
		}

		foreach ($into as $topCat) {
			$topCat->children = array();
			self::sort_terms_hierarchicaly($cats, $topCat->children, $topCat->term_id);
		}
	}

	//for gallery images select in backend
	public static function draw_cats_select_options($categoryHierarchy, $selected, $level = 0) {
		?>
		<?php foreach ($categoryHierarchy as $term_id => $term) : ?>
			<option value="<?php echo $term_id ?>" <?php echo($selected == $term_id ? 'selected=""' : "") ?>><?php echo str_repeat('-', $level) ?><?php echo $term->name ?></option>
			<?php
			if (!empty($term->children)) {
				self::draw_cats_select_options($term->children, $selected, $level + 1);
			}
			?>
		<?php endforeach; ?>
		<?php
	}

	//for portfolio popup
	public static function draw_cats_checkbox_options($categoryHierarchy, $selected_array, $level = 0) {
		?>
		<?php foreach ($categoryHierarchy as $cat) : ?>
			<li>
				<div class="radio-holder" style="margin-left: <?php echo($level * 15) ?>px; margin-bottom: 5px;">
					<input type="checkbox" id="tmm_portfolio_item_cat_<?php echo $cat->term_id ?>" value="<?php echo $cat->term_id ?>" <?php if (in_array($cat->term_id, $selected_array)): ?>checked<?php endif; ?> class="tmm_portfolio_item_cat" />
					<label for="tmm_portfolio_item_cat_<?php echo $cat->term_id ?>"><span></span><i class="tmm_description"><?php echo $cat->name ?></i></label>
				</div><!--/ .radio-holder-->
			</li>
			<?php
			if (!empty($cat->children)) {
				self::draw_cats_checkbox_options($cat->children, $selected_array, $level + 1);
			}
			?>
		<?php endforeach; ?>
		<?php
	}

}

/**
 * Retrieve a post's terms as a list ordered by hierarchy.
 *
 * @param int $post_id Post ID.
 * @param string $taxonomy Taxonomy name.
 * @param string $term_divider Optional. Separate items using this.
 * @param string $reverse Optional. Reverse order of links in string.
 * @return string
 */
class GetTheTermList {

	public function get_the_term_list($post_id, $taxonomy, $term_divider = '/', $reverse = false) {
		$object_terms = wp_get_object_terms($post_id, $taxonomy);
		$parents_assembled_array = array();
		//***
		if (!empty($object_terms)) {
			foreach ($object_terms as $term) {
				$parents_assembled_array[$term->parent][] = $term;
			}
		}
		//***
		$sorting_array = $this->sort_taxonomies_by_parents($parents_assembled_array);
		$term_list = $this->get_the_term_list_links($taxonomy, $sorting_array);
		if ($reverse) {
			$term_list = array_reverse($term_list);
		}
		$result = implode($term_divider, $term_list);

		return $result;
	}

	private function sort_taxonomies_by_parents($data, $parent_id = 0) {
		if (isset($data[$parent_id])) {
			if (!empty($data[$parent_id])) {
				foreach ($data[$parent_id] as $key => $taxonomy_object) {
					if (isset($data[$taxonomy_object->term_id])) {
						$data[$parent_id][$key]->childs = $this->sort_taxonomies_by_parents($data, $taxonomy_object->term_id);
					}
				}

				return $data[$parent_id];
			}
		}

		return array();
	}

	//only for taxonomies. returns array of term links
	private function get_the_term_list_links($taxonomy, $data, $result = array()) {
		if (!empty($data)) {
			foreach ($data as $term) {
				$result[] = '<a rel="tag" href="' . get_term_link($term->slug, $taxonomy) . '">' . $term->name . '</a>';
				if (!empty($term->childs)) {
					//***
					$res = $this->get_the_term_list_links($taxonomy, $term->childs, array());
					if (!empty($res)) {
						//***
						foreach ($res as $val) {
							if (!is_array($val)) {
								$result[] = $val;
							}
						}
						//***
					}
					//***
				}
			}
		}

		return $result;
	}

}



