<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_contacts">

	<?php if (!empty($instance['title'])): ?>
		<h3 class="widget-title"><?php echo $instance['title']; ?></h3>
	<?php endif; ?>


	<div class="vcard">
		<?php if (!empty($instance['email'])): ?>
			<span class="email"><a href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a></span>	
		<?php endif; ?>

		<?php if (!empty($instance['phone'])): ?>
			<span class="tel"><?php echo $instance['phone']; ?></span>
		<?php endif; ?>
	</div><!--/ .vcard-->


</div><!--/ .widget-container-->

