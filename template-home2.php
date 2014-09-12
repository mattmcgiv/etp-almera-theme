<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
/*
  Template Name: Folio Layout 2 (Inline Carousel)
 */

get_header('folio');
$folio_post_id=0;
?>

<div class="ajax">

	<?php if (TMM::get_option('folio_tpl_show_folios_bar')): ?>
		<?php $folios = TMM::get_option('folio_template2_items'); ?>
		<?php if (!empty($folios)): ?>
			<ul class="scroll-box-nav" id="folio_categories_bar">
				<?php foreach ($folios as $post_id) : ?>
					<?php
					if($folio_post_id == 0){
						$folio_post_id=$post_id;
					}
					?>
					<li><a href="#" data-post-id="<?php echo $post_id ?>" data-layout="2"><?php echo get_post_field('post_title', $post_id) ?></a></li>
				<?php endforeach; ?>
			</ul><!--/ .scroll-box-nav-->
		<?php endif; ?>
	<?php endif; ?>

	<div id="folio_images_area">
		<?php TMM_Portfolio::draw_home_layout(2,$folio_post_id); ?>
	</div>

</div><!--/ .ajax-->

<?php wp_reset_query(); ?>

<?php get_footer('folio'); ?>
