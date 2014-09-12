<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="tab-content" id="<?php echo $sidebar_id; ?>">
    <input type="hidden" name="sidebars[<?php echo $sidebar_id; ?>][name]" value="<?php echo $sidebar_name; ?>" />

    <div class="clearfix ">

        <div class="admin-one-half">

            <div class="add-button add_page" sidebar-id="<?php echo $sidebar_id; ?>"></div>&nbsp;<strong><?php _e('Add Page', 'almera'); ?></strong><br /><br />
            <div class="tmk_row">
				<?php echo $categories_select ?>
            </div>

        </div><!--/ .admin-one-half-->

        <div class="admin-one-half last">

            <div class="add-button add_category" sidebar-id="<?php echo $sidebar_id; ?>"></div>&nbsp;<strong><?php _e('Add Category', 'almera'); ?></strong><br /><br />
            <div class="tmk_row">
				<?php echo $pages_select ?>
            </div>

        </div><!--/ .admin-one-half-->

    </div>
    <br />
    <div class="tmk_row">
        <a class="remove-button remove_sidebar" sidebar-id="<?php echo $sidebar_id; ?>" href="#"></a>&nbsp;<strong><?php _e('Remove Sidebar', 'almera'); ?></strong>
    </div>
    <hr class="admin-divider" />
</div>



