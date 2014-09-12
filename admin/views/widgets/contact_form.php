<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_contact_form">
	<h3 class="widget-title"><?php echo $instance['title'] ?></h3>
	<?php echo do_shortcode('[contact_form]' . $instance['form'] . '[/contact_form]');?>
</div>

