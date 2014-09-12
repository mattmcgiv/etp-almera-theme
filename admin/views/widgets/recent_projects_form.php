<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('post_number'); ?>"><?php _e('Post Number', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('post_number'); ?>" name="<?php echo $widget->get_field_name('post_number'); ?>" value="<?php echo $instance['post_number']; ?>" />
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_thumbnail'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_thumbnail'); ?>" name="<?php echo $widget->get_field_name('show_thumbnail'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_thumbnail'); ?>"><?php _e('Show thumbnail', 'almera') ?></label>
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_exerpt'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_exerpt'); ?>" name="<?php echo $widget->get_field_name('show_exerpt'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_exerpt'); ?>"><?php _e('Show Exerpt', 'almera') ?></label>
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_title'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_title'); ?>" name="<?php echo $widget->get_field_name('show_title'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_title'); ?>"><?php _e('Display Title', 'almera') ?></label>
</p>

<p>
    <label for="<?php echo $widget->get_field_id('exerpt_symbols_count'); ?>"><?php _e('Symbols count', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('exerpt_symbols_count'); ?>" name="<?php echo $widget->get_field_name('exerpt_symbols_count'); ?>" value="<?php echo $instance['exerpt_symbols_count']; ?>" />
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_button'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_button'); ?>" name="<?php echo $widget->get_field_name('show_button'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_button'); ?>"><?php _e('Show button', 'almera') ?></label>
</p>
