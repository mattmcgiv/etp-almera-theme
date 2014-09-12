<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
/*
  Template Name: Blog
 */

get_header();
wp_reset_query();
//posts query
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$posts_per_page = get_option('posts_per_page');
query_posts(array(
	'post_type' => 'post',
	'paged' => $paged,
	'posts_per_page' => $posts_per_page
));
global $wp_query;
?>
<?php get_template_part('content', 'default'); ?>
<?php if ($posts_per_page < $wp_query->found_posts): ?>
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
<?php get_footer(); ?>
