<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php
$show_post_metadata = TMM::get_option("blog_listing_show_all_metadata");
if (isset($_REQUEST['shortcode_show_metadata'])) {
	$show_post_metadata = $_REQUEST['shortcode_show_metadata'];
}
$class='fourteen';
//($_REQUEST['sidebar_position']=='no_sidebar')? $class='fourteen' : $class='ten';
$thumb_size='580*360';
if($_REQUEST['sidebar_position']=='no_sidebar'){
    $class='fourteen';
    $thumb_size='910*430';
}else{
     $class='ten';
     $thumb_size='580*360';
}
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class("entry clearfix"); ?>>

			<div class="<?php echo $class ?> columns">
				<?php
				$post_pod_type = get_post_meta($post->ID, 'post_pod_type', true);
				$post_type_values = get_post_meta($post->ID, 'post_type_values', true);
				//***
				switch ($post_pod_type) {
					case 'audio':
						echo do_shortcode('[tmm_audio]' . $post_type_values[$post_pod_type] . '[/tmm_audio]');
						break;
					case 'video':
						?>

						<?php
						$video_width = 580;
						$video_height = 360;

						$source_url = $post_type_values[$post_pod_type];
						if (!empty($source_url)) {

							$video_type = 'youtube.com';
							$allows_array = array('youtube.com', 'vimeo.com');

							foreach ($allows_array as $key => $needle) {
								$count = strpos($source_url, $needle);
								if ($count !== FALSE) {
									$video_type = $allows_array[$key];
								}
							}


							switch ($video_type) {
								case $allows_array[0]:
									echo do_shortcode('[tmm_video type="youtube" width="' . $video_width . '" height="' . $video_height . '"]' . $source_url . '[/tmm_video]');
									break;
								case $allows_array[1]:
									echo do_shortcode('[tmm_video type="vimeo" width="' . $video_width . '" height="' . $video_height . '"]' . $source_url . '[/tmm_video]');
									break;
								default:
									break;
							}
						}
						?>
						<?php
						break;

					case 'quote':
						echo do_shortcode('[blockquote]' . $post_type_values[$post_pod_type] . '[/blockquote]');
						break;

					case 'gallery':
						TMM_OptionsHelper::enqueue_script('cycle');
						$gall = array();
						if (isset($post_type_values[$post_pod_type])) {
							$gall = $post_type_values[$post_pod_type];
						}
						?>

						<?php if (!empty($gall)) : ?>

							<div class="image-post-slider">
								<ul>
									<?php if (!empty($gall)): ?>
										<?php foreach ($gall as $key => $source_url): ?>
											<li><a data-fancybox-group="lightbox" href="<?php echo $source_url; ?>" class="single-image plus-icon"><img src="<?php echo TMM_Helper::resize_image($source_url, $thumb_size) ?>" alt="<?php echo $post->post_title ?>" /></a></li>
										<?php endforeach; ?>
									<?php endif; ?>
								</ul>
							</div><!--/ .image-post-slider-->


						<?php endif; ?>
						<?php
						break;

					default:
						?>
						<?php if (has_post_thumbnail()) : ?>
							<a href="<?php the_permalink() ?>" class="single-image link-icon"><img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, $thumb_size); ?>" alt="<?php the_title(); ?>" /></a>
						<?php endif; ?>
						<?php
						break;
				}
				?>

				<?php if (TMM::get_option("blog_listing_show_date")) : ?>
					<div class="entry-date">
						<a href="<?php echo home_url() ?>/?m=<?php echo get_the_date('Ym') ?>">
							<span class="entry-day"><?php echo get_the_date('d') ?></span>
							<span class="entry-month"><?php echo get_the_date('M') ?></span>
						</a>
						<span class="entry-year"><?php echo get_the_date('Y') ?></span>
					</div><!--/ .entry-date-->
				<?php endif; ?>

				<div class="entry-meta">

					<h3 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

					<?php if ($show_post_metadata): ?>

						<?php if (TMM::get_option("blog_listing_show_author")): ?>
							<span class="author"><?php _e('By', 'almera'); ?>&nbsp;<?php the_author_link() ?></span>
						<?php endif; ?>

						<?php $tags = get_the_tag_list('', ', '); ?>
						<?php if (TMM::get_option("blog_listing_show_tags") AND !empty($tags)) : ?>						
							<span class="tag"><?php echo $tags ?></span>
						<?php endif; ?>	

						<?php if (TMM::get_option("blog_listing_show_category")) : ?>
							<?php $categories_list = get_the_category_list(__(', ', 'almera')); ?>
							<?php if (!empty($categories_list)) : ?>
								<span class="categories">
									<?php echo $categories_list ?>
								</span>
							<?php endif; ?>
						<?php endif; ?>

						<?php if (TMM::get_option("blog_single_show_comments")) : ?>
							<span class="comments">
								<a href="<?php the_permalink() ?>#comments"><?php echo get_comments_number(); ?>&nbsp;<?php _e('Comments', 'almera'); ?></a>
							</span>
						<?php endif; ?>

					<?php endif; ?>

				</div><!--/ .entry-meta-->

				<div class="clear"></div>

				<div class="entry-body">

					<p>
						<?php
						if (TMM::get_option("excerpt_symbols_count")) {
							if (empty($post->post_excerpt)) {
								$txt = do_shortcode($post->post_content);
								$txt = strip_tags($txt);
								if (function_exists('mb_substr')) {
									echo do_shortcode(mb_substr($txt, 0, TMM::get_option("excerpt_symbols_count")) . " ...");
								} else {
									echo do_shortcode(substr($txt, 0, TMM::get_option("excerpt_symbols_count")) . " ...");
								}
							} else {
								if (function_exists('mb_substr')) {
									echo do_shortcode(mb_substr($post->post_excerpt, 0, TMM::get_option("excerpt_symbols_count")) . " ...");
								} else {
									echo do_shortcode(substr($post->post_excerpt, 0, TMM::get_option("excerpt_symbols_count")) . " ...");
								}
							}
						} else {
							echo do_shortcode($post->post_excerpt);
						}
						?>
					</p>

					<a class="button" href="<?php the_permalink() ?>"><?php _e('Read More', 'almera'); ?></a>

				</div><!--/ .entry-body-->

			</div><!--/ .columns-->

		</article><!--/ .entry-->

		<?php
	endwhile;
else:
	get_template_part('content', 'nothingfound');
endif;
?>



