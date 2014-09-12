<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<!-- - - - - - - - - - - - Pagination - - - - - - - - - - - - - - -->
<?php global $wp_query; ?>


<?php if (!empty($wp_query->query_vars['posts_per_page'])){?>

<?php if ($wp_query->query_vars['posts_per_page'] < $wp_query->found_posts): ?>
	<div class="wp-pagenavi">

		<?php
		if (true) {
			TMM_Helper::pagenavi();
		} else {
			wp_link_pages();
		}

		wp_reset_query();
		?>

	</div><!--/ .wp-pagenavi -->
<?php endif; ?>
<?php } ?>
<!-- - - - - - - - - - - end Pagination - - - - - - - - - - - - - -->

