<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>
<?php 
$class='fourteen';
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

		<article id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix') ?>>

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
											<li>
												<a rel="lightbox" href="<?php echo $source_url; ?>" class="single-image plus-icon"><img src="<?php echo TMM_Helper::resize_image($source_url, $thumb_size) ?>" alt="<?php echo $post->post_title ?>" /></a>
											</li>
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
							<a href="<?php echo TMM_Helper::get_post_featured_image($post->ID, ''); ?>" class="single-image plus-icon"><img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, $thumb_size); ?>" alt="<?php the_title(); ?>" /></a>
						<?php endif; ?>
						<?php
						break;
				}
				?>
				<div class="clear"></div>

				<?php if (TMM::get_option("blog_single_show_date")) : ?>
					<div class="entry-date">
						<a href="<?php echo home_url() ?>/?m=<?php echo get_the_date('Ym') ?>">
							<span class="entry-day"><?php echo get_the_date('d') ?></span>
							<span class="entry-month"><?php echo get_the_date('M') ?></span>
						</a>
						<span class="entry-year"><?php echo get_the_date('Y') ?></span>
					</div><!--/ .entry-date-->
				<?php endif; ?>

				<div class="entry-meta">

					<h3 class="title"><?php the_title(); ?></h3>

					<?php if (TMM::get_option("blog_single_show_all_metadata")): ?>

						<?php if (TMM::get_option("blog_single_show_author")) : ?>
							<span class="author"><a href="#"><?php _e('By', 'almera'); ?>&nbsp;<?php the_author_link() ?></a></span>
						<?php endif; ?>

						<?php $tags = get_the_tag_list('', ', '); ?>
						<?php if (TMM::get_option("blog_single_show_tags") AND !empty($tags)) : ?>						
							<span class="tag"><?php echo $tags ?></span>
						<?php endif; ?>

						<?php if (TMM::get_option("blog_single_show_category")) : ?>
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

				<div class="entry-body">

					<?php the_content() ?>
					<?php TMM_Ext_LayoutConstructor::draw_front($post->ID); ?>

				</div><!--/ .entry-body-->                                                             

			</div><!--/ .columns-->

		</article><!--/ .entry-->
                             
                        <?php $page_social_likes=TMM::get_option('single_page_social_likes'); ?>
                        <?php if (!empty($page_social_likes)) {
                            ?>
                            <ul class="social-likes">

                                <?php
                               
                                $page_social_likes = explode(",", $page_social_likes);
                               
                                foreach ($page_social_likes as $page_social_like) {
                                   
                                    switch ($page_social_like) {
                                        case 'facebook_btn_single_page_social_likes':
                                            ?>
                                            <li class="facebook" title="Like">Facebook</li>
                                            <?php
                                            break;
                                        case 'twitter_btn_single_page_social_likes':
                                            ?>
                                            <li class="twitter" title="Like">Twitter</li>
                                            <?php
                                            break;
                                        case 'google_btn_single_page_social_likes':
                                            ?>
                                            <li class="plusone" data-counter="<?php the_permalink() ?>/googleplusonecount.php?url={url}&amp;callback=?" title="Like">Google+</li>
                                            <?php
                                            break;
                                        case 'pinterest_btn_single_page_social_likes':
                                            ?>
                                            <li class="pinterest" title="Like" data-media="<?php echo TMM_Helper::get_post_featured_image($post->ID, ''); ?>">Pinterest</li>
                                            <?php
                                            break;
                                            ;
                                    }
                                }
                                ?>
                            </ul>
                            <?php }
                        ?>
           
		<?php
	endwhile;
endif;
?>                           
               <?php if (TMM::get_option("blog_single_show_fb_comments")){ ?>             
                    <div class="fb-comments" data-href="<?php  the_permalink() ?>" data-width="680px"></div>

               <?php } ?>
               
<?php if (TMM::get_option("blog_single_show_comments")): ?>

	<?php comments_template(); ?>

<?php endif; ?>                   


<?php get_footer(); ?>