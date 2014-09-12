<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div class="widget widget_likebox">

	<?php if ($instance['title'] != '') { ?>

		<h3 class="widget-title"><?php echo $instance['title']; ?></h3>

	<?php } ?>

	<div class="widget-container">
                <?php $colorscheme= (TMM::get_option('dark')=='1') ? 'dark' : 'light'; ?>
		<iframe src="http://www.facebook.com/plugins/likebox.php?id=<?php echo $instance['pageID']; ?>&connections=<?php echo $instance['connection']; ?>&width=200&height=<?php echo $instance['height']; ?>&colorscheme=<?php echo $colorscheme ?>&show_border=false&header=<?php echo $instance['header']? 1 : 0 ?>" style="width:200px; height:<?php echo $instance['height']; ?>px" ></iframe>

	</div><!--/ .widget-container-->

</div><!--/ .widget-->
