<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('email'); ?>"><?php _e('Email', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('email'); ?>" name="<?php echo $widget->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('phone'); ?>"><?php _e('Phone', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('phone'); ?>" name="<?php echo $widget->get_field_name('phone'); ?>" value="<?php echo $instance['phone']; ?>" />
</p>

