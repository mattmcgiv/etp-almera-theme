<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php wp_enqueue_style('tmm_theme_admin_gallery_css', TMM_THEME_URI . '/admin/css/gallery.css'); ?>
<?php wp_enqueue_script('tmm_theme_admin_gallery_js', TMM_THEME_URI . '/admin/js/portfolio.js'); ?>
<div class="gallery-meta-container">
	<input type="hidden" value="1" name="tmm_meta_saving" />
	<div class="gallery_layout">		
		<p>
			<a href="#" class="js_inpost_gallery_add_slide button button-primary"><?php _e('Add images', 'almera'); ?></a>&nbsp;
			<a href="#" class="js_inpost_gallery_add_video button button-primary"><?php _e('Add video', 'almera'); ?></a>
		</p>
	</div>	

	<ul id="gallery_item_list">
		<?php if (!empty($tmm_portfolio)){ ?>			
				<?php
						foreach	($tmm_portfolio	as	$value)	{
									TMM_Portfolio::render_gallery_item($value);
							}				
					?>			
		<?php } ?>
	</ul>
	<div class="clear"></div>
</div>
