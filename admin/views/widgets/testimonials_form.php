<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p style="display: <?php echo($instance['show'] != 0) ? 'none' : 'block'; ?>;" id="block_<?php echo $widget->get_field_id('post_id'); ?>">
    <label for="<?php echo $widget->get_field_id('post_id'); ?>"><?php _e('Select Testimonial', 'almera') ?>:</label>
    <select id="<?php echo $widget->get_field_id('post_id'); ?>" name="<?php echo $widget->get_field_name('post_id'); ?>" class="widefat">
		<?php $testimonials = get_posts(array('numberposts' => -1, 'post_type' => 'testimonials')); ?>
		<?php foreach ($testimonials as $post) : ?>
			<option <?php echo($post->ID == $instance['post_id'] ? "selected" : "") ?> value="<?php echo $post->ID ?>"><?php echo $post->post_name ?></option>
		<?php endforeach; ?>
    </select>
</p>

<p>	
    <input onclick='jQuery("#block_<?php echo $widget->get_field_id('post_id'); ?>").show()' type="radio" <?php if ($instance['show'] == 0) echo 'checked'; ?> id="<?php echo $widget->get_field_id('show0'); ?>" name="<?php echo $widget->get_field_name('show'); ?>" value="0" />
    <label for="<?php echo $widget->get_field_id('show0'); ?>"><?php _e('Show selected testimonial', 'almera') ?></label><br />

	<input onclick='jQuery("#block_<?php echo $widget->get_field_id('post_id'); ?>").hide()' type="radio" <?php if ($instance['show'] == 1) echo 'checked'; ?> id="<?php echo $widget->get_field_id('show1'); ?>" name="<?php echo $widget->get_field_name('show'); ?>" value="1" />
    <label for="<?php echo $widget->get_field_id('show1'); ?>"><?php _e('Show random testimonials', 'almera') ?></label><br />

	<input onclick='jQuery("#block_<?php echo $widget->get_field_id('post_id'); ?>").hide()' type="radio" <?php if ($instance['show'] == 2) echo 'checked'; ?> id="<?php echo $widget->get_field_id('show2'); ?>" name="<?php echo $widget->get_field_name('show'); ?>" value="2" />
    <label for="<?php echo $widget->get_field_id('show2'); ?>"><?php _e('Show latest testimonial', 'almera') ?></label><br />
		
</p>

<p>
    <label for="<?php echo $widget->get_field_id('timeout'); ?>"><?php _e('Timeout', 'almera') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('timeout'); ?>" name="<?php echo $widget->get_field_name('timeout'); ?>" value="<?php echo $instance['timeout']; ?>" />
</p>

