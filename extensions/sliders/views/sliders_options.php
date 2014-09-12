<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<ul id="slider_options">

	<?php foreach (TMM_Ext_Sliders::$slider_js_options as $slider_key => $slider) : ?>

		<?php
		if ($slider_key == 'cuteslider' OR $slider_key == 'layerslider') {
			continue;
		}
		?>

		<li id="<?php echo $slider_key ?>">

			<h1><?php _e('Slider Settings', 'almera'); ?></h1>
			<h2><?php echo TMM_Ext_Sliders::$slider_options[$slider_key]['name'] ?></h2>
			<?php $counter = count($slider); ?>
			<?php foreach ($slider as $option => $options_array) : ?>

				<?php if ($options_array['type'] != 'checkbox'): ?>
					<h4><?php echo $options_array['title'] ?></h4>
				<?php endif; ?>

				<?php
				switch ($options_array['type']) {
					case 'text':
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "slider_" . $slider_key . "_" . $option,
							'type' => 'slider',
							'description' => $options_array['description'],
							'default_value' => $options_array['default'],
							'min' => 0,
							'max' => 2560,
							'css_class' => '',
						));
						break;

					case 'select':
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "slider_" . $slider_key . "_" . $option,
							'type' => 'select',
							'description' => $options_array['description'],
							'values' => $options_array['values_list'],
							'default_value' => $options_array['default'],
							'css_class' => '',
						));
						break;

					case 'image_link':
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "slider_" . $slider_key . "_" . $option,
							'type' => 'upload',
							'default_value' => $options_array['default'],
							'description' => $options_array['description'],
							'id' => '',
							'css_class' => 'slide_option_textinput',
						));

						break;

					case 'color':
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "slider_" . $slider_key . "_" . $option,
							'type' => 'color',
							'default_value' => $options_array['default'],
							'description' => $options_array['description'],
							'css_class' => '',
						));
						break;

					case 'checkbox':
						TMM_OptionsHelper::draw_theme_option(array(
							'name' => "slider_" . $slider_key . "_" . $option,
							'type' => 'checkbox',
							'default_value' => $options_array['default'],
							'title' => $options_array['title'],
							'description' => $options_array['description'],
							'css_class' => '',
						));
						break;

					default:
						_e('Such option type does not exist!', 'almera');
						break;
				}
				?>

				<?php $counter--; ?>
				<?php if ($counter > 1): ?>
					<hr class="admin-divider">
				<?php endif; ?>

			<?php endforeach; ?>

		</li>
	<?php endforeach; ?>
</ul>

<script type="text/javascript">
	//slider_type
	jQuery(document).ready(function() {
<?php $slider_types = TMM_Ext_Sliders::get_slider_types(); ?>
<?php if (!empty($slider_types)): ?>
	<?php foreach ($slider_types as $slider_key => $slider_name): ?>
				jQuery("#tab_slider_<?php echo $slider_key ?>").html(jQuery("#<?php echo $slider_key ?>").html());
				jQuery("#<?php echo $slider_key ?>").remove();
	<?php endforeach; ?>
<?php endif; ?>
	});
</script>

