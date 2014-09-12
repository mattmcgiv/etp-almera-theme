<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_testimonials">

	<?php
	TMM_OptionsHelper::enqueue_script('cycle');
	wp_enqueue_script('tmm_widget_testimonials', TMM_THEME_URI . '/js/widgets/testimonials.js');
	//***
	$args = array(
		'post_type' => 'testimonials',
		'p' => $instance['post_id'],
	);

	if ($instance['show'] == 1) {
		$args = array(
			'post_type' => 'testimonials',
			'orderby' => 'rand',
			'posts_per_page' => -1,
		);
	}


	if ($instance['show'] == 2) {
		$args = array(
			'post_type' => 'testimonials',
			'posts_per_page' => 1,
		);
	}

	$unique_id = uniqid();
	$query = new WP_Query($args);
	?>

	<div class="widget widget_testimonials">

		<div class="quoteBox" id="quoteBox_<?php echo $unique_id ?>">
			<?php if ($instance['title'] != '') : ?>
				<h3 class="widget-title"><?php echo $instance['title']; ?></h3>
			<?php endif; ?>

			<ul class="quotes quotes_<?php echo $unique_id ?>">

				<?php
				if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
						?>

						<li>
							<blockquote class="quote-text"><?php the_content(); ?></blockquote><!--/ .quote-text-->
							<div class="quote-author"><?php the_title(); ?>, <?php echo get_post_meta(get_the_ID(), 'position', true) ?></div>
						</li>

						<?php
					endwhile;
				endif;
				wp_reset_query();
				?>

			</ul>

		</div><!--/ .quoteBox-->

	</div><!--/ .widget-->
	<?php if ($instance['show'] == 1): ?>
	<?php if (!isset($instance['timeout'])) $instance['timeout'] = 3000; ?>
		<script type="text/javascript">
			jQuery(function() {
				tmm_init_testimonials('<?php echo $unique_id; ?>',<?php echo $instance['timeout'] ?>);
			});
		</script>
	<?php endif; ?>
</div><!--/ .widget-container-->



