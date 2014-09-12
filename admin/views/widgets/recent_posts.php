<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_custom_recent_entries">

	<?php
	$query = new WP_Query(array(
		'post_type' => 'post',
		'showposts' => $instance['post_number'],
		'cat' => $instance['category']
	));

	global $post;
	?>

	<?php if ($instance['title'] != '') { ?>
		<h3 class="widget-title"><?php echo $instance['title']; ?></h3>
	<?php } ?>

    <ul class="clearfix">

		<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

				<li>

					<?php if ($instance['show_thumbnail'] == 'true'): ?>
							<div class="image-holder">
								<a href="<?php the_permalink(); ?>">
									<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '60*60', true); ?>" alt="<?php the_title(); ?>">
								</a>
							</div>
						
					<?php endif; ?>

					<div class="post-holder">
						<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
						<span><?php echo get_the_date() ?></span>
					</div><!--/ .post-holder-->

					<div class="clear"></div>
					
					<?php if ($instance['show_exerpt']) : ?>
						<p>
							<?php $exerpt = get_the_excerpt(); ?>
							<?php if (!empty($exerpt)): ?>
								<?php
								if ((int) $instance['exerpt_symbols_count'] > 0) {
									echo substr(strip_tags($exerpt), 0, (int) $instance['exerpt_symbols_count']) . " ...";
								} else {
									the_excerpt();
								}
								?>
							<?php else : ?>
								<?php echo substr(strip_tags(get_the_content($post->ID)), 0, (int) $instance['exerpt_symbols_count']) . " ..."; ?>
							<?php endif; ?>
						</p>
					<?php endif; ?>

				</li>

				<?php
			endwhile;
		endif;
		?>

    </ul>

	<div class="clear"></div>

	<?php if ($instance['show_see_all_button'] == "true"): ?>
		<?php if ($instance['category'] > 0): ?>
			<a class="button default small" href="<?php echo get_category_link((int) $instance['category']); ?>"><?php _e('See all posts', 'almera'); ?></a>
		<?php else: ?>
			<a class="button default small" href="<?php echo home_url() . '/' . date('Y') ?>"><?php _e('See all posts', 'almera'); ?></a>
		<?php endif; ?>
	<?php endif; ?>


</div><!--/ .widget-container-->

