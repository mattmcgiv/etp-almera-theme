<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php get_header(); ?>
<?php
TMM_OptionsHelper::enqueue_script('cycle');
TMM_OptionsHelper::enqueue_script('isotope');
global $post;
$current_single_gall_id = $post->ID;
$tmm_gallery = get_post_meta($post->ID, 'thememakers_gallery', true);
?>
<input type="hidden" id="refer" value="<?php echo $_SERVER['HTTP_REFERER']  ?>">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="sixteen columns single-gall" >

			<?php if (!empty($tmm_gallery)): ?>
				<div class="cycle-slider">
					<ul>
						<?php foreach ($tmm_gallery as $pic) : ?>
							<li>
								<a title="<?php echo $pic['title'] ?>" rel="gall" href="<?php echo $pic['imgurl'] ?>" class="single-image plus-icon animTop" title="">
									<img alt="<?php echo $pic['title'] ?>" src="<?php echo TMM_Helper::resize_image($pic['imgurl'], '940*480') ?>">
								</a>
							</li>
						<?php endforeach; ?>
					</ul>			
				</div><!--/ .cycle-slider-->	
			<?php endif; ?>

			<?php the_content() ?>                  

		</div><!--/ .columns-->
		<?php
	endwhile;
endif;
?>
<div class="divider-solid"></div>

<?php if (TMM::get_option('gallery_show_recent_galleries')){ ?>
<?php
$args = array('numberposts' => 8, 'post_type' => TMM_Gallery::$slug, 'exclude' => $current_single_gall_id);
$posts = get_posts($args);
?>
<?php if (!empty($posts)): ?>

	<h3 class="section-title"><?php _e("Recent Galleries", 'almera') ?></h3>

	<section class="recent-projects">

		<?php foreach ($posts as $post) : ?>
		
			<article class="four columns">

				<div class="project-thumb">

					<a href="<?php echo TMM_Helper::get_post_featured_image($post->ID, '', true); ?>" class="single-image plus-icon animTop" title="<?php echo $post->post_title ?>" rel="gallery">
							<img alt="<?php echo $post->post_title ?>" src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '420*300', true); ?>">
						</a>
		
					<a href="<?php echo $post->guid ?>" class="project-meta">
						<h6 class="title"><?php echo $post->post_title ?></h6>
						<span class="categories"><?php echo strip_tags(get_the_term_list($post->ID, 'gallery_categories', '', ' / ', '')); ?></span>
					</a>	

				</div><!--/ .project-thumb-->

				<?php the_content() ?>

			</article><!--/ .columns-->	
			
		<?php endforeach; ?>

	</section><!--/ .recent-projects-->
<?php endif; ?>
<?php } ?>

<?php get_footer(); ?>
