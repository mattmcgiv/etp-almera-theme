<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="1" name="tmm_meta_saving" />
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('width'); ?>"><?php _e('Width', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('width'); ?>" name="<?php echo $widget->get_field_name('width'); ?>" value="<?php echo $instance['width']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('height'); ?>"><?php _e('Height', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('height'); ?>" name="<?php echo $widget->get_field_name('height'); ?>" value="<?php echo $instance['height']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('location_mode'); ?>"><?php _e('Location Mode', 'almera') ?>:</label>
    <select id="<?php echo $widget->get_field_id('location_mode'); ?>" name="<?php echo $widget->get_field_name('location_mode'); ?>" class="widefat">
		<?php
		$location_mode = array(
			'address' => __('Address', 'almera'),
			'coordinates' => __('Coordinates', 'almera'),
		);
		?>
		<?php foreach ($location_mode as $mode => $location_mode_name) : ?>
			<option <?php echo($mode == $instance['location_mode'] ? "selected" : "") ?> value="<?php echo $mode ?>"><?php echo $location_mode_name ?></option>
		<?php endforeach; ?>
    </select>
</p>

<div class="location_mode_<?php echo $widget->get_field_id('location_mode_coordinates'); ?>" style="display: <?php if ($instance['location_mode'] == 'coordinates'): ?>block<?php else: ?>none<?php endif; ?>">
	<p>
		<label for="<?php echo $widget->get_field_id('latitude'); ?>"><?php _e('Latitude', 'almera') ?>:</label>
		<input class="widefat" type="text" id="<?php echo $widget->get_field_id('latitude'); ?>" name="<?php echo $widget->get_field_name('latitude'); ?>" value="<?php echo $instance['latitude']; ?>" />
	</p>

	<p>
		<label for="<?php echo $widget->get_field_id('longitude'); ?>"><?php _e('Longitude', 'almera') ?>:</label>
		<input class="widefat" type="text" id="<?php echo $widget->get_field_id('longitude'); ?>" name="<?php echo $widget->get_field_name('longitude'); ?>" value="<?php echo $instance['longitude']; ?>" />
	</p>
</div>

<div class="location_mode_<?php echo $widget->get_field_id('location_mode_address'); ?>" style="display: <?php if ($instance['location_mode'] == 'address'): ?>block<?php else: ?>none<?php endif; ?>">
	<p>
		<label for="<?php echo $widget->get_field_id('address'); ?>"><?php _e('Address', 'almera') ?>:</label>
		<input class="widefat" type="text" id="<?php echo $widget->get_field_id('address'); ?>" name="<?php echo $widget->get_field_name('address'); ?>" value="<?php echo $instance['address']; ?>" />
	</p>
</div>


<p>
    <label for="<?php echo $widget->get_field_id('mode'); ?>"><?php _e('Mode', 'almera') ?>:</label>
    <select id="<?php echo $widget->get_field_id('mode'); ?>" name="<?php echo $widget->get_field_name('mode'); ?>" class="widefat">
		<?php
		$modes = array(
			'image' => __('Image', 'almera'),
			'map' => __('Map', 'almera'),
		);
		?>
		<?php foreach ($modes as $mode => $mode_name) : ?>
			<option <?php echo($mode == $instance['mode'] ? "selected" : "") ?> value="<?php echo $mode ?>"><?php echo $mode_name ?></option>
		<?php endforeach; ?>
    </select>
</p>

<p>
    <label for="<?php echo $widget->get_field_id('zoom'); ?>"><?php _e('Zoom', 'almera') ?>:</label>
    <select id="<?php echo $widget->get_field_id('zoom'); ?>" name="<?php echo $widget->get_field_name('zoom'); ?>" class="widefat">
		<?php
		$zoom = array();
		for ($i = 1; $i < 24; $i++) {
			$zoom[] = $i;
		}
		?>
		<?php foreach ($zoom as $i) : ?>
			<option <?php echo($i == $instance['zoom'] ? "selected" : "") ?> value="<?php echo $i ?>"><?php echo $i ?></option>
		<?php endforeach; ?>
    </select>
</p>


<p>
    <label for="<?php echo $widget->get_field_id('maptype'); ?>"><?php _e('Map type', 'almera') ?>:</label>
    <select id="<?php echo $widget->get_field_id('maptype'); ?>" name="<?php echo $widget->get_field_name('maptype'); ?>" class="widefat">
		<?php
		$maptypes = array(
			'ROADMAP' => __('ROADMAP', 'almera'),
			'SATELLITE' => __('SATELLITE', 'almera'),
			'HYBRID' => __('HYBRID', 'almera'),
			'TERRAIN' => __('TERRAIN', 'almera'),
		);
		?>
		<?php foreach ($maptypes as $type) : ?>
			<option <?php echo($type == $instance['maptype'] ? "selected" : "") ?> value="<?php echo $type ?>"><?php echo $type ?></option>
		<?php endforeach; ?>
    </select>
</p>

<p>
	<?php
	$checked = "";
	if ($instance['marker'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('marker'); ?>" name="<?php echo $widget->get_field_name('marker'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('marker'); ?>"><?php _e('Display Marker', 'almera') ?></label>
</p>

<p class="map_<?php echo $widget->get_field_id('mode'); ?>" style="display: <?php echo($instance['mode'] == 'map' ? 'block' : 'none') ?>">
	<?php
	$checked = "";
	if ($instance['popup'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('popup'); ?>" name="<?php echo $widget->get_field_name('popup'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('popup'); ?>"><?php _e('Display popup', 'almera') ?></label>
</p>

<p class="map_<?php echo $widget->get_field_id('mode'); ?>" style="display: <?php echo($instance['mode'] == 'map' ? 'block' : 'none') ?>">
	<?php
	$checked = "";
	if ($instance['scrollwheel'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('scrollwheel'); ?>" name="<?php echo $widget->get_field_name('scrollwheel'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('scrollwheel'); ?>"><?php _e('Display scrollwheel', 'almera') ?></label>
</p>


<p class="map_<?php echo $widget->get_field_id('mode'); ?>" style="display: <?php echo($instance['mode'] == 'map' ? 'block' : 'none') ?>">
    <label for="<?php echo $widget->get_field_id('popup_text'); ?>"><?php _e('Popup text', 'almera') ?>:</label>
    <textarea name="<?php echo $widget->get_field_name('popup_text'); ?>" id="<?php echo $widget->get_field_id('popup_text'); ?>" class="widefat"><?php echo $instance['popup_text']; ?></textarea>
</p>


<script type="text/javascript">
	jQuery(function() {
		jQuery("#<?php echo $widget->get_field_id('mode'); ?>").on('change', function() {
			if (jQuery(this).val() == 'map') {
				jQuery(".map_<?php echo $widget->get_field_id('mode'); ?>").show();
			} else {
				jQuery(".map_<?php echo $widget->get_field_id('mode'); ?>").hide();
			}
		});

		//***

		jQuery("#<?php echo $widget->get_field_id('location_mode'); ?>").on('change', function() {
			if (jQuery(this).val() == 'address') {
				jQuery(".location_mode_<?php echo $widget->get_field_id('location_mode_address'); ?>").show();
				jQuery(".location_mode_<?php echo $widget->get_field_id('location_mode_coordinates'); ?>").hide();
			} else {
				jQuery(".location_mode_<?php echo $widget->get_field_id('location_mode_coordinates'); ?>").show();
				jQuery(".location_mode_<?php echo $widget->get_field_id('location_mode_address'); ?>").hide();
			}
		});
	});
</script>