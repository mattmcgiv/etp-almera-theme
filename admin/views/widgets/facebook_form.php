<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $widget->get_field_id('pageID'); ?>"><?php _e('Facebook Page ID', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('pageID'); ?>" name="<?php echo $widget->get_field_name('pageID'); ?>" value="<?php echo $instance['pageID']; ?>" />
</p>
<p>
    <label for="<?php echo $widget->get_field_id('connection'); ?>"><?php _e('People to show', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('connection'); ?>" name="<?php echo $widget->get_field_name('connection'); ?>" value="<?php echo $instance['connection']; ?>" />
</p>
<p>
    <label for="<?php echo $widget->get_field_id('height'); ?>"><?php _e('Box height', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('height'); ?>" name="<?php echo $widget->get_field_name('height'); ?>" value="<?php echo $instance['height']; ?>" />
</p>

<p>
	<?php
	$checked = "";
	if ($instance['header'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('header'); ?>" name="<?php echo $widget->get_field_name('header'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('header'); ?>"><?php _e('Header', 'almera') ?></label>
</p>
