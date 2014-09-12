<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php $unique_id = uniqid() ?>
<li id="slide_item_<?php echo $unique_id ?>" class="gallery_item">
	<img class="gallery_thumb" src="<?php echo TMM_Helper::resize_image($imgurl, "100*100") ?>" alt="<?php _e('media item', 'almera'); ?>" />
	<input type="hidden" name="tmm_gallery[<?php echo $unique_id ?>][imgurl]" value="<?php echo $imgurl ?>" />
	<input type="hidden" name="tmm_gallery[<?php echo $unique_id ?>][title]" value="<?php echo $title ?>" />
	<input type="hidden" name="tmm_gallery[<?php echo $unique_id ?>][description]" value="<?php echo $description ?>" />
        <input type="hidden" name="tmm_gallery[<?php echo $unique_id ?>][title_href]" value="<?php echo $title_href ?>" />
	<a href="javascript:tmm_admin_gallery.gallery_image_options('gallery_item_popup_<?php echo $unique_id ?>','<?php echo $unique_id ?>');void(0);" class="update_gallery_item" slide-id="<?php echo $unique_id ?>" title="<?php _e("Edit item title and description", 'almera') ?>"><?php _e('Edit item title and description', 'almera'); ?></a>
	<a href="#" class="delete_gallery_item" slide-id="<?php echo $unique_id ?>" title="<?php _e("Delete Item", 'almera') ?>"><?php _e("Delete Item", 'almera'); ?></a>

	<?php
	$gallery_categories_terms = get_terms('gallery_categories', array('hide_empty' => false));
	$categoryHierarchy = array();
	TMM_Helper::sort_terms_hierarchicaly($gallery_categories_terms, $categoryHierarchy);
	if(!isset($category)){
		$category=0;
	}
	?>

	<?php if (!empty($categoryHierarchy)): ?>
		<div class="sel gallery_item_category_wrap">
			<select name="tmm_gallery[<?php echo $unique_id ?>][category]">

				<?php TMM_Helper::draw_cats_select_options($categoryHierarchy,$category, 0); ?>

			</select>
		</div>
	<?php endif; ?>


	<div id="gallery_item_popup_<?php echo $unique_id ?>" style="display: none;">

		<div class="tmm_item">
			<h4><?php _e("Title", 'almera') ?></h4>
			<input type="text" class="js_edit_gallery_item_title" value="<?php echo $title ?>" />
		</div><!--/ .tmm_item-->
                
                <div class="tmm_item">
			<h4><?php _e("Title Custom Link", 'almera') ?></h4>		
			<input type="text" class="js_edit_gallery_item_title_href" value="<?php echo $title_href ?>" />
			<span class="preset_description"><?php _e("Enter the custom link to this field", 'almera') ?></span>
		</div>

		<div class="tmm_item" style="display: none;">
			<h4><?php _e("Description", 'almera') ?></h4>
			<textarea class="js_edit_gallery_item_description data-area"><?php echo $description ?></textarea>
		</div><!--/ .tmm_item-->

		<div class="clear"></div>
	</div>
</li>