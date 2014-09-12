<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div class="widget widget_recent_projects">

	<?php
	TMM_OptionsHelper::enqueue_script('cycle');
	wp_enqueue_script('tmm_widget_recent_projects', TMM_THEME_URI . '/js/widgets/recent_projects.js');
	wp_reset_query();
	$query = new WP_Query(array(
		'post_type' => TMM_Portfolio::$slug,
		'showposts' => $instance['post_number'],
	));
	$unique_id = uniqid();
	global $post;
	?>

	<?php if ($instance['title'] != '') : ?>
		<h3 class="widget-title"><?php echo $instance['title']; ?></h3>
	<?php endif; ?>

	<div class="recent-projects-box" id="recent-projects-box_<?php echo $unique_id ?>">

		<ul class="recent-projects">
			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
					<li>
						<?php if ($instance['show_thumbnail'] == 'true'): ?>
								<a class="single-image link-icon" href="<?php the_permalink(); ?>">
									<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '440*270', true); ?>" alt="<?php the_title(); ?>">
								</a>
							
						<?php endif; ?>

						<?php if ($instance['show_title']): ?>
							<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
						<?php endif; ?>

						<?php if ($instance['exerpt_symbols_count'] > 0): ?>
							<p>
								<?php if ($instance['show_exerpt'] == 'true') : ?>
									<?php
									if ((int) $instance['exerpt_symbols_count'] > 0) {
										echo substr(strip_tags(get_the_excerpt()), 0, (int) $instance['exerpt_symbols_count']) . " ...";
									} else {
										the_excerpt();
									}
									?>
								<?php else: ?>
									<?php echo substr(strip_tags(get_the_content($post->ID)), 0, (int) $instance['exerpt_symbols_count']) . " ..."; ?>
								<?php endif; ?>							

							</p>
						<?php endif; ?>
					</li>

					<?php
				endwhile;
			endif;
			?>
		</ul><!--/ .recent-projects-->

	</div><!--/ .recent-projects-box-->

	<script type="text/javascript">
		jQuery(function() {
			tmm_recent_projects('<?php echo $unique_id; ?>');
		});
	</script>

	<?php if ($instance['show_button']): ?>
		<a class="button default small" href="<?php echo get_post_type_archive_link(TMM_Portfolio::$slug) ?>"><?php _e('See all projects', 'almera'); ?></a>
	<?php endif; ?>

</div><!--/ .widget-->	
