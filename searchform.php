<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget_search clearfix">

    <form method="get" id="searchform" action="<?php echo home_url('/'); ?>">
		<p>
			<input type="text" name="s" value="<?php echo(isset($_GET['s']) ? $_GET['s'] : ''); ?>" />
			<button type="submit" class="submit-search"><?php _e('Search', 'almera') ?></button>
		</p>
    </form>

</div><!--/ .widget-->