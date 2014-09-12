<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php wp_enqueue_style('tmm_theme_admin_gallery_css', TMM_THEME_URI . '/admin/css/gallery.css'); ?>
<?php wp_enqueue_script('tmm_theme_admin_gallery_js', TMM_THEME_URI . '/admin/js/gallery.js'); ?>
<div class="gallery-meta-container">
	<input type="hidden" value="1" name="tmm_meta_saving" />
	<div class="gallery_layout" style="display: none;">
		<label for=""><?php _e('Gallery Layout:', 'almera'); ?></label>
		<div class="sel">
			<?php
			$layouts = array(__('3 columns', 'almera'), __('4 columns', 'almera'));
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => "layout",
				'type' => 'select',
				'default_value' => 3,
				'values' => $layouts,
				'value' => $layout,
				'description' => "",
				'css_class' => '',
				'hide_item_html' => 1
			));
			?>
		</div>
	</div>
	<div class="clear"></div>
	<p><a href="#" class="js_inpost_gallery_add_slide button button-primary"><?php _e('Add images', 'almera'); ?></a></p>
	<script type="text/javascript">
		jQuery(function() {
			jQuery("#gallery_img_categoriesdiv").remove();
		});
	</script>

	<ul id="gallery_item_list">
		<?php if (!empty($tmm_gallery)): ?>
			<?php foreach ($tmm_gallery as $value) : ?>
				<?php TMM_Gallery::render_gallery_item($value) ?>
			<?php endforeach; ?>
                <?php endif; ?>
	</ul>
	<div class="clear"></div>
</div>