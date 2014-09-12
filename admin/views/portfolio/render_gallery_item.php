<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php $unique_id = uniqid() ?>
<li id="slide_item_<?php echo $unique_id ?>" class="gallery_item">
	<img class="gallery_thumb" src="<?php echo TMM_Helper::resize_image($imgurl, "100*100") ?>" alt="" />

	<input type="hidden" name="tmm_portfolio[<?php echo $unique_id ?>][imgurl]" value="<?php echo $imgurl ?>" />
	<input type="hidden" name="tmm_portfolio[<?php echo $unique_id ?>][imgurl2]" value="<?php echo $imgurl2 ?>" />
	<input type="hidden" name="tmm_portfolio[<?php echo $unique_id ?>][title]" value="<?php echo $title ?>" />
	<input type="hidden" name="tmm_portfolio[<?php echo $unique_id ?>][categories]" value="<?php echo $categories ?>" />
	<?php if (!isset($title3_style)) $title3_style = 'caption-1'; ?>
	<input type="hidden" name="tmm_portfolio[<?php echo $unique_id ?>][title3_style]" value="<?php echo $title3_style ?>" />
	<?php if (!isset($title3_position)) $title3_position = 'left-position'; ?>
	<input type="hidden" name="tmm_portfolio[<?php echo $unique_id ?>][title3_position]" value="<?php echo $title3_position ?>" />
        
	<input type="hidden" name="tmm_portfolio[<?php echo $unique_id ?>][title_href]" value="<?php echo $title_href ?>" />
        
	<a href="javascript:tmm_admin_portfolio.folio_image_options('gallery_item_popup_<?php echo $unique_id ?>','<?php echo $unique_id ?>');void(0);" class="update_gallery_item" slide-id="<?php echo $unique_id ?>" title="<?php _e("Edit item title", 'almera') ?>"><?php _e('Edit item title', 'almera'); ?></a>
	<a href="#" class="delete_gallery_item" slide-id="<?php echo $unique_id ?>" title="<?php _e("Delete Item", 'almera') ?>"><?php _e("Delete Item", 'almera'); ?></a>


	<div id="gallery_item_popup_<?php echo $unique_id ?>" style="display: none;">

		<div class="tmm_item">
			<h4><?php _e("Title", 'almera') ?></h4>
			<input type="text" class="js_edit_gallery_item_title" value="<?php echo $title ?>" />
			<span class="preset_description"><?php _e("For multiline text use ^ symbol (Win: SHIFT+6)", 'almera') ?></span>
		</div>
            
                <div class="tmm_item">
			<h4><?php _e("Title Custom Link", 'almera') ?></h4>		
			<input type="text" class="js_edit_gallery_item_title_href" value="<?php echo $title_href ?>" />
			<span class="preset_description"><?php _e("Enter the custom link to this field", 'almera') ?></span>
		</div>

		<div class="tmm_item">
			<h4><?php _e("Cover Image", 'almera') ?></h4>		
			<input type="text" class="js_edit_gallery_item_imgurl2 data-upload" value="<?php echo $imgurl2 ?>" />
			<a href="#" class="button_upload button-primary"><?php _e("Browse", 'almera'); ?></a>
		</div>               

		<div class="tmm_item">
			<?php
			$cats = get_terms('foliocat', array('hide_empty' => false));;
			if (!isset($categories)) {
				$categories = "";
			}
			$categories = explode(',', $categories);
			//***
			$categoryHierarchy = array();
			TMM_Helper::sort_terms_hierarchicaly($cats, $categoryHierarchy);
			?>

			<?php if (!empty($categoryHierarchy)): ?>
				<ul class="tmm_portfolio_item_cats">
					<?php TMM_Helper::draw_cats_checkbox_options($categoryHierarchy, $categories, 0); ?>
				</ul>
			<?php endif; ?>

		</div>

		<a href="javascript:jQuery('#additional_folio_item_options').toggle();void(0);">[+]&nbsp;<?php _e("Additional options", 'almera') ?></a><br />
		
		<br />
		
		<div style="display: none;" id="additional_folio_item_options">
			
			<div class="tmm_item">
				
				<h4><?php _e("Caption Style", 'almera') ?></h4>	
				
				<?php
				$captions_array = array(
					'epic-caption-boxed' => 'Caption Boxed', 
					'epic-caption-bordered' => 'Caption Bordered',
					'epic-caption-white' => 'Caption White'
				);
				?>
				
				<select class="js_edit_gallery_item_title3_style data-select">
					<?php foreach ($captions_array as $value => $name) : ?>
						<option value="<?php echo $value ?>" <?php if ($title3_style == $value) echo 'selected'; ?>><?php echo $name ?></option>
					<?php endforeach; ?>
				</select> 
				
				<span class="preset_description"><?php _e("(Only for Folio Layout 3)", 'almera') ?></span>
				
			</div><!--/ .tmm_item-->
			
			<div class="tmm_item">
				
				<h4><?php _e("Caption Position", 'almera') ?></h4>	
				
				<?php
				$captions_pos_array = array(
					'left-position' => 'Left',					
					'center-position' => 'Center',					
					'right-position' => 'Right'					
				);
				?>
				
				<select class="js_edit_gallery_item_title3_position data-select">
					<?php foreach ($captions_pos_array as $value => $name) : ?>
						<option value="<?php echo $value ?>" <?php if ($title3_position == $value) echo 'selected'; ?>><?php echo $name ?></option>
					<?php endforeach; ?>
				</select> 
				
				<span class="preset_description"><?php _e("(Only for Folio Layout 3)", 'almera') ?></span>
				
			</div><!--/ .tmm_item-->
			
		</div><!--/ #additional_folio_item_options-->

	</div>

</li>
