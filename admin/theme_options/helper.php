<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_OptionsHelper {

	public static $google_fonts = array(
		"Allura",
		"Oranienbaum",
		"Oswald:300,400,700"
	);
	public static $content_fonts = array(
		"Arial" => "Arial",
		"Tahoma" => "Tahoma",
		"Verdana" => "Verdana",
		"Calibri" => "Calibri"
	);

	/*
	 * Drawing theme option for admin panel
	 */

	public static function draw_theme_option($data, $prefix = TMM_THEME_PREFIX) {
             
		$value = "";
		//sometimes I have value or cant get in by TMM::get_option
		if (isset($data['value'])) {
			$value = $data['value'];
		} else {
			$value = TMM::get_option($data['name'], $prefix);
		}
                
		if (empty($value) && '0' != $value ) {
			$value = @$data['default_value'];
		}
                $pl=$value;
                                
                if ((($data['name']=='admin_social_links[twitter]')||($data['name']=='admin_social_links[facebook]')||($data['name']=='admin_social_links[dribbble]')||($data['name']=='admin_social_links[vimeo]')||($data['name']=='admin_social_links[youtube]')||($data['name']=='admin_social_links[pinterest]')||($data['name']=='admin_social_links[instagram]')||($data['name']=='admin_social_links[linkedin]')||($data['name']=='admin_social_links[flickr]')||($data['name']=='admin_social_links[gplus]')||($data['name']=='admin_social_links[behance]')||($data['name']=='admin_social_links[rss]'))){
                    
                    $value_name = explode('[', $data['name']);
                    $value_name = $value_name['1'];
                    $value_name = explode(']', $value_name);
                    $value_name = $value_name['0'];                                       
                    $value = TMM::get_option('admin_social_links');
                    $value = $value[$value_name];
                                     
                    $pl=@$data['default_value'];                    
                }
                
		switch ($data['type']) {
			case 'slider':
				?>
				<?php if (@!$data['hide_item_html']): ?>
					<div class="clearfix ">
						<div class="admin-one-half">
							<p>
							<?php endif; ?>
							<input data-default-value="<?php echo @$data['default_value'] ?>" type="text" name="<?php echo $data['name'] ?>" value="<?php echo $value ?>" min-value="<?php echo $data['min'] ?>" max-value="<?php echo $data['max'] ?>" class="ui_slider_item" />
							<?php if (@!$data['hide_item_html']): ?>
							</p>
						</div>

						<div class="admin-one-half last">
              
							<p class="admin-info">
								<?php echo $data['description'] ?>
							</p>
						</div>
					</div>
				<?php endif; ?>
				<?php
				break;
			case 'text':
				?>
				<?php if (@!$data['hide_item_html']): ?>
					<div class="clearfix ">
						<div class="admin-one-half">
							<p>
							<?php endif; ?>
                                                            <input placeholder="<?php echo $pl ?>" data-default-value="<?php echo @$data['default_value'] ?>" type="text" class="<?php echo @$data['css_class'] ?>" name="<?php echo $data['name'] ?>" value="<?php echo $value ?>">
							<?php if (@!$data['hide_item_html']): ?>
							</p>
						</div>

						<div class="admin-one-half last">
                                                    <p class="admin-info">
								<?php echo $data['description'] ?>
                                                    </p>
                                                    <?php                                                                     
                                                        if ((($data['name']=='admin_social_links[twitter]')||($data['name']=='admin_social_links[facebook]')||($data['name']=='admin_social_links[dribbble]')||($data['name']=='admin_social_links[vimeo]')||($data['name']=='admin_social_links[youtube]')||($data['name']=='admin_social_links[pinterest]')||($data['name']=='admin_social_links[instagram]')||($data['name']=='admin_social_links[linkedin]')||($data['name']=='admin_social_links[flickr]')||($data['name']=='admin_social_links[google]')||($data['name']=='admin_social_links[behance]')||($data['name']=='admin_social_links[rss]'))){
                                                            ?>
                                                            <div class="row-mover"></div>
                                                            <?php
                                                        }                    
                                                      ?>
							
						</div>
					</div>
				<?php endif; ?>
				<?php
				break;
			case 'textarea':
				?>
				<?php if (!@$data['hide_item_html']): ?>
					<div class="clearfix ">
						<div class="admin-one-half">
							<p>
							<?php endif; ?>
							<textarea data-default-value="<?php echo @$data['default_value'] ?>" name="<?php echo $data['name'] ?>" class="<?php echo $data['css_class'] ?>"><?php echo $value ?></textarea>
							<?php if (!@$data['hide_item_html']): ?>
							</p>
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php echo $data['description'] ?>
							</p>
						</div>
					</div>
				<?php endif; ?>
				<?php
				break;
			case 'select':
				?>
				<?php if (!@$data['hide_item_html']): ?>
					<div class="clearfix ">
						<div class="admin-one-half">
						<?php endif; ?>
						<select data-default-value="<?php echo @$data['default_value'] ?>" name="<?php echo $data['name'] ?>" class="<?php echo $data['css_class'] ?>">
							<?php if (!empty($data['values'])): ?>
								<?php foreach ($data['values'] as $key => $option_text) : ?>
									<option value="<?php echo $key ?>" <?php echo($value == $key ? 'selected=""' : "") ?>><?php echo $option_text ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>
						<?php if (!@$data['hide_item_html']): ?>
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php echo $data['description'] ?>
							</p>
						</div>
					</div>
				<?php endif; ?>
				<?php
				break;
			case 'checkbox':
				?>
				<?php if (@!$data['hide_item_html']): ?>
					<div class="clearfix">
						<div class="admin-one-half">
							<p>
							<?php endif; ?>
							<input data-default-value="<?php echo @$data['default_value'] ?>" type="hidden" value="<?php echo($value == 1 ? "1" : "0") ?>" name="<?php echo $data['name'] ?>">
							<input type="checkbox" id="<?php echo $data['name'] ?>" class="option_checkbox <?php echo $data['css_class'] ?>" <?php echo($value == 1 ? "checked" : "") ?> />
							<label for="<?php echo $data['name'] ?>"><span></span><?php echo $data['title'] ?></label>

							<?php if (@!$data['hide_item_html']): ?>
							</p>
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php echo $data['description'] ?>
							</p>
						</div>
					</div>
				<?php endif; ?>
				<?php
				break;
			case 'color':
				?>
				<?php if (@!$data['hide_item_html']): ?>
					<div class="clearfix ">
						<div class="admin-one-half">
						<?php endif; ?>
						<input data-default-value="<?php echo @$data['default_value'] ?>" value-index="0" type="text" class="bg_hex_color text small <?php echo @$data['css_class'] ?>" value="<?php echo $value ?>" name="<?php echo $data['name'] ?>">
						<div class="bgpicker" style="background-color: <?php echo $value ?>"></div>
						<?php if (@!$data['hide_item_html']): ?>

							<?php if (@$_GET['page'] == 'tmm_theme_options'): ?>
								<a href="javascript:void(0);" class="js_picker_val_back" title="Back">back</a>&nbsp;
								<a href="javascript:void(0);" class="js_picker_val_ahead" title="Forward">forward</a>&nbsp;
								<a href="javascript:void(0);" class="js_picker_val_reset" title="Reset">reset</a>
							<?php endif; ?>

						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php echo $data['description'] ?>
							</p>
						</div>
					</div>
				<?php endif; ?>
				<?php
				break;

			case 'google_font_select':
				?>
				<select data-default-value="" name="<?php echo $data['name'] ?>" class="google_font_select">
					<?php foreach ($data['fonts'] as $font_name) : ?>
						<?php
						$font_clean_name = explode(":", $font_name);
						$font_clean_name = $font_clean_name[0];
						?>
						<option <?php echo ($font_clean_name == $value ? "selected" : "") ?> value="<?php echo $font_clean_name; ?>"><?php echo $font_name; ?></option>
					<?php endforeach; ?>
				</select>&nbsp;<a title="" class="admin-button button-gray button-medium" href="javascript:add_google_font();void(0);"><?php _e('Browse', 'almera'); ?></a>

				<?php
				break;

			case 'upload':
				?>
				<?php if (@!$data['hide_item_html']): ?>
					<div class="clearfix ">
						<div class="admin-one-half">
						<?php endif; ?>
						<input data-default-value="" id="<?php echo @$data['id'] ?>" class="middle" type="text" name="<?php echo $data['name'] ?>" value="<?php echo $value ?>">
						<a class="admin-button button-gray button-medium button_upload" href="#"><?php _e('Browse', 'almera'); ?></a>

						<?php if (@!$data['hide_item_html']): ?>
						</div>
						<div class="admin-one-half last">
							<p class="admin-info">
								<?php echo $data['description'] ?>
							</p>
						</div>
					</div>
				<?php endif; ?>
				<?php
				break;

			default:
				_e('Option type does not exist!', 'almera');
				break;
		}
	}

	public static function get_theme_buttons() {
		return array(
			'default' => __('Default', 'almera'),
			'cyan' => __('Cyan', 'almera'),
			'turquoise' => __('Turquoise', 'almera'),
			'green' => __('Green', 'almera'),
			'blue' => __('Blue', 'almera'),
			'violet' => __('Violet', 'almera'),
			'orange' => __('Orange', 'almera'),
			'yellow' => __('Yellow', 'almera'),
			'pink' => __('Pink', 'almera'),
			'coral' => __('Coral', 'almera'),
			'brown' => __('Brown', 'almera'),
			'lightgrey' => __('Lightgrey', 'almera'),
		);
	}

	public static function get_theme_buttons_sizes() {
		return array(
			'small' => __('Small', 'almera'),
			'medium' => __('Medium', 'almera'),
			'large' => __('Large', 'almera'),
		);
	}   
	
	//register front scripts
	public static function register_scripts_and_styles() {
		wp_register_script('tmm_easing_js', TMM_THEME_URI . '/js/jquery.easing.1.3.min.js', array('jquery'), false, true);
		wp_register_script('tmm_animationEasing_js', TMM_THEME_URI . '/js/jquery.animation.easing.js', array('jquery'), false, true);
		wp_register_script('tmm_cycle_js', TMM_THEME_URI . '/js/jquery.cycle.all.min.js', array('jquery'), false, true);
		wp_register_script('tmm_mousewheel_js', TMM_THEME_URI . '/js/jquery.mousewheel.js', array('jquery'), false, true);
		wp_register_script('tmm_epic_slider_js', TMM_THEME_URI . '/js/epicslider/jquery.epicslider.js', array('jquery'), false, true);
		wp_register_script('tmm_stapel_js', TMM_THEME_URI . '/js/jquery.stapel.js', array('jquery'), false, true);
		wp_register_script('tmm_sudoslider_js', TMM_THEME_URI . '/js/jquery.sudoslider.min.js', array('jquery'), false, true);
		wp_register_script('tmm_isotope_js', TMM_THEME_URI . '/js/jquery.isotope.min.js', array('jquery'), false, true);
		wp_register_script('tmm_masonry_js', TMM_THEME_URI . '/js/jquery.masonry.min.js', array('jquery'), false, true);
		wp_register_script('tmm_resizegrid_js', TMM_THEME_URI . '/js/jquery.resizegrid.js', array('jquery'),false, false);
		wp_register_script('tmm_theme_js', TMM_THEME_URI . '/js/theme.js', array('jquery','tmm_resizegrid_js'), false, true);
		//***
		wp_register_script('tmm_touchswipe_js', TMM_THEME_URI . '/js/jquery.touchswipe.min.js', array('jquery'), false, true);
		wp_register_script('tmm_mobile_touchswipe_js', TMM_THEME_URI . '/js/jquery.mobile-touch-swipe-1.0.js', array('jquery'), false, true);
		wp_register_script('tmm_fancybox_js', TMM_THEME_URI . '/js/fancybox/jquery.fancybox.pack.js', array('jquery'), false, true);
				
		//*** STYLES
		wp_register_style('tmm_theme_style_css', TMM_THEME_URI . '/style.css', null, false);
		wp_register_style('tmm_skeleton_css', TMM_THEME_URI . '/css/skeleton.css', null, false);
		wp_register_style('tmm_layout_css', TMM_THEME_URI . '/css/layout.css', null, false);
		wp_register_style('tmm_font_awesome_css', TMM_THEME_URI . '/css/font-awesome.css', null, false);
		wp_register_style('tmm_animation_css', TMM_THEME_URI . '/css/animation.css', null, false);
		wp_register_style('tmm_custom1_css', TMM_THEME_URI . '/css/custom1.css', null, false);
		wp_register_style('tmm_custom2_css', TMM_THEME_URI . '/css/custom2.css', null, false);
		wp_register_style('tmm_fancybox_css', TMM_THEME_URI . '/js/fancybox/jquery.fancybox.css', null, false);
		wp_register_style('tmm_epic_slider_css', TMM_THEME_URI . '/js/epicslider/epicslider.css', null, false);
		wp_register_style('tmm_epic_slider_responsive_css', TMM_THEME_URI . '/js/epicslider/epicslider-reponsive.css', null, false);
                
                 
                
                
	}

	public static function enqueue_script($key, $in_footer = false) {
		wp_enqueue_script('tmm_' . $key . '_js', false, array(), false, $in_footer);
	}

	public static function enqueue_style($key) {
		wp_enqueue_style('tmm_' . $key . '_css');
	}

}

