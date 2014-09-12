<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" name="tmm_meta_saving" value="1" />

<div class="custom-page-options">

	<h4><?php _e('Page title', 'almera'); ?></h4>
		<div class="sel">
			<select name="page_title_status" class="headerbg_type">
				<?php
				$page_title_statuses = array(
					"show" => __("Show", 'almera'),
					"hide" => __("Hide", 'almera'),
				);

				if (!$page_title_status) {
					$page_title_status = "show";
				}
				?>
				<?php foreach ($page_title_statuses as $key => $status) : ?>
					<option <?php echo($key == $page_title_status ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $status; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	
	<div class="clear"></div>	

	<h4><?php _e('Header Background', 'almera'); ?></h4>
	<div class="bg-type-option">
		<div class="sel">
			<select name="headerbg_type" class="headerbg_type">
				<?php
				$types = array(
					"color" => __("Color", 'almera'),
					"image" => __("Image", 'almera'),
				);

				if (!$headerbg_type) {
					$headerbg_type = "color";
				}
				?>
				<?php foreach ($types as $key => $type) : ?>
					<option <?php echo($key == $headerbg_type ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $type; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<ul id="headerbg_type_options">

		<li id="headerbg_type_image" style="display: none;">
			<p>
				<input type="text" value="<?php echo $headerbg_image; ?>" name="headerbg_image" class="headerbg_image" />
				<a href="#" class="button_upload button" title=""><?php _e('Upload', 'almera'); ?></a>
			</p>

			<div class="clear"></div>

			<label><?php _e('Set options', 'almera'); ?>:</label>
			<div class="sel right">
				<select name="headerbg_type_image_option" class="headerbg_type_image_option">
					<?php
					$options = array(
						"repeat" => "Repeat",
						"repeat-x" => "Repeat-X",
						"fixed" => "Fixed",
					);

					if (!$headerbg_type_image_option) {
						$headerbg_type_image_option = "repeat";
					}
					?>
					<?php foreach ($options as $key => $option) : ?>
						<option <?php echo($key == $headerbg_type_image_option ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</li>

		<li id="headerbg_type_color" style="display: none;">
			<p><input type="text" class="colorpicker_input headerbg_color" value="<?php echo $headerbg_color; ?>" name="headerbg_color" placeholder="#ffffff" /></p>
		</li>

	</ul>

	<h4><?php _e('Opacity', 'almera'); ?></h4>
	<?php
	wp_enqueue_script('tmm_theme_options_js', TMM_THEME_URI . '/admin/theme_options/js/options.js', array('jquery', 'jquery-ui-core'));
	wp_enqueue_style("tmm_theme_jquery_ui_css2", TMM_THEME_URI . '/admin/theme_options/css/jquery-ui.css');
	//***
	if (!isset($headerbg_opacity)) {
		$headerbg_opacity = 100;
	}
	//***
	TMM_OptionsHelper::draw_theme_option(array(
		'name' => 'headerbg_opacity',
		'type' => 'slider',
		'description' => '',
		'default_value' => $headerbg_opacity,
		'min' => 0,
		'max' => 100,
	));
	?>

	<div class="clear"></div>

	<p><a style="float: right" href="#" class=" button headerbg_button_reset" title=""><?php _e('Reset', 'almera'); ?></a></p>

	<div class="clear"></div>
</div>

<hr />

<div class="custom-page-options">
	<h4><?php _e('Page Background', 'almera'); ?></h4>
	<div class="bg-type-option">
		<div class="sel">
			<select name="pagebg_type" class="pagebg_type">
				<?php
				$types = array(
					"color" => __("Color", 'almera'),
					"image" => __("Image", 'almera'),
				);

				if (!$pagebg_type) {
					$pagebg_type = "color";
				}
				?>
				<?php foreach ($types as $key => $type) : ?>
					<option <?php echo($key == $pagebg_type ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $type; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<ul id="pagebg_type_options" style="margin: 0; padding: 0;">

		<li id="pagebg_type_image" style="display: none;">
			<p>
				<input type="text" value="<?php echo $pagebg_image; ?>" name="pagebg_image" class="pagebg_image" /> <a href="#" class="button_upload button" title="">
					<?php _e('Upload', 'almera'); ?></a>
			</p>

			<div class="clear"></div>

			<label><?php _e('Set options', 'almera'); ?>:</label>
			<div class="sel right">
				<select name="pagebg_type_image_option" class="pagebg_type_image_option">
					<?php
					$options = array(
						"repeat" => "Repeat",
						"repeat-x" => "Repeat-X",
						"fixed" => "Fixed",
					);

					if (!$pagebg_type_image_option) {
						$pagebg_type_image_option = "repeat";
					}
					?>
					<?php foreach ($options as $key => $option) : ?>
						<option <?php echo($key == $pagebg_type_image_option ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

		</li>

		<li id="pagebg_type_color" style="display: none;">
			<p><input type="text" class="colorpicker_input pagebg_color" value="<?php echo $pagebg_color; ?>" name="pagebg_color" placeholder="#ffffff" /></p>
		</li>
	</ul>

	<div class="clear"></div>

	<p><a style="float: right" href="#" class="button button_reset" title=""><?php _e('Reset', 'almera'); ?></a></p>

	<div class="clear"></div>
</div>

<hr>

<div class="custom-page-options">
	<h4><?php _e('Footer Background', 'almera'); ?></h4>
	<div class="bg-type-option">
		<div class="sel">
			<select name="footerbg_type" class="footerbg_type">
				<?php
				$types = array(
					"color" => __("Color", 'almera'),
					"image" => __("Image", 'almera'),
				);

				if (!$footerbg_type) {
					$footerbg_type = "color";
				}
				?>
				<?php foreach ($types as $key => $type) : ?>
					<option <?php echo($key == $footerbg_type ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $type; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<ul id="footerbg_type_options">

		<li id="footerbg_type_image" style="display: none;">
			<p>
				<input type="text" value="<?php echo $footerbg_image; ?>" name="footerbg_image" class="footerbg_image" />
				<a href="#" class="button_upload button" title=""><?php _e('Upload', 'almera'); ?></a>
			</p>

			<div class="clear"></div>

			<label><?php _e('Set options', 'almera'); ?>:</label>
			<div class="sel right">
				<select name="footerbg_type_image_option" class="headerbg_type_image_option">
					<?php
					$options = array(
						"repeat" => "Repeat",
						"repeat-x" => "Repeat-X",
						"fixed" => "Fixed",
					);

					if (!$footerbg_type_image_option) {
						$footerbg_type_image_option = "repeat";
					}
					?>
					<?php foreach ($options as $key => $option) : ?>
						<option <?php echo($key == $footerbg_type_image_option ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</li>

		<li id="footerbg_type_color" style="display: none;">
			<p><input type="text" class="colorpicker_input footerbg_color" value="<?php echo $footerbg_color; ?>" name="footerbg_color" placeholder="#ffffff" /></p>
		</li>

	</ul>

	<h4><?php _e('Opacity', 'almera'); ?></h4>
	<?php
	if (!isset($footerbg_opacity)) {
		$footerbg_opacity = 100;
	}
	//***
	TMM_OptionsHelper::draw_theme_option(array(
		'name' => 'footerbg_opacity',
		'type' => 'slider',
		'description' => '',
		'default_value' => $footerbg_opacity,
		'min' => 0,
		'max' => 100,
	));
	?>

	<div class="clear"></div>

	<p><a style="float: right" href="#" class="button footerbg_button_reset" title=""><?php _e('Reset', 'almera'); ?></a></p>

	<div class="clear"></div>
</div>

<hr />

<h4><?php _e('Page Sidebar Position', 'almera'); ?></h4>
<input type="hidden" value="<?php echo (!$page_sidebar_position ? "sbr" : $page_sidebar_position) ?>" name="page_sidebar_position" />

<ul class="admin-page-choice-sidebar clearfix">
	<li class="lside <?php echo ($page_sidebar_position == "sbl" ? "current-item" : "") ?>"><a data-val="sbl" href="#"><?php _e('Left Sidebar', 'almera'); ?></a></li>
	<li class="wside <?php echo ($page_sidebar_position == "no_sidebar" ? "current-item" : "") ?>"><a data-val="no_sidebar" href="#"><?php _e('Without Sidebar', 'almera'); ?></a></li>
	<li class="rside <?php echo ($page_sidebar_position == "sbr" ? "current-item" : "") ?>"><a data-val="sbr" href="#"><?php _e('Right Sidebar', 'almera'); ?></a></li>
</ul>
<div class="clear"></div>

<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery("#pagebg_type_<?php echo $pagebg_type; ?>").show();

		jQuery("[name=pagebg_type]").change(function() {
			jQuery("#pagebg_type_options li").hide(200);
			jQuery("#pagebg_type_" + jQuery(this).val()).show(400);
		});

		jQuery('.button_reset').life('click', function()
		{
			jQuery("#pagebg_type_options input").val("");
			jQuery("#pagebg_type_options select").val(0);
			return false;
		});

		//*****

		jQuery("#headerbg_type_<?php echo $headerbg_type; ?>").show();

		jQuery("[name=headerbg_type]").change(function() {
			jQuery("#headerbg_type_options li").hide(200);
			jQuery("#headerbg_type_" + jQuery(this).val()).show(400);
		});


		jQuery('.headerbg_button_reset').life('click', function()
		{
			jQuery("#headerbg_type_options input").val("");
			jQuery("#headerbg_type_options select").val(0);
			jQuery("input[name='headerbg_opacity']").val(100).prev('input').val(100).trigger('change');
			return false;
		});

		//*****

		jQuery("#footerbg_type_<?php echo $footerbg_type; ?>").show();

		jQuery("[name=footerbg_type]").change(function() {
			jQuery("#footerbg_type_options li").hide(200);
			jQuery("#footerbg_type_" + jQuery(this).val()).show(400);
		});


		jQuery('.footerbg_button_reset').life('click', function()
		{
			jQuery("#footerbg_type_options input").val("");
			jQuery("#footerbg_type_options select").val(0);
			jQuery("input[name='footerbg_opacity']").val(100).prev('input').val(100).trigger('change');
			return false;
		});


	});
</script>

