<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" name="tmm_meta_saving" value="1" />
<a href="javascript:tmm_ext_layout_constructor.add_row(); void(0);" class="button button-primary button-large"><?php _e("Add New Row", 'almera') ?></a><br />

<ul id="layout_constructor_items" class="page-methodology" style="clear: both; display: none;">
	<?php if (!empty($tmm_layout_constructor)): ?>
		<?php foreach ($tmm_layout_constructor as $row => $row_data) : ?>
			<?php
			if (!is_integer($row)) {
				//continue;
			}
			?>
			<li id="layout_constructor_row_<?php echo $row ?>" class="layout_constructor_item">
				<table>
					<tr>
						<td>
							<a href="javascript:tmm_ext_layout_constructor.add_column(<?php echo $row ?>);void(0);" class="button" style="width: 110px;text-align:center;margin-right:5px;"><?php _e("Add Column", 'almera') ?></a><br />
							<a href="javascript:tmm_ext_layout_constructor.edit_row(<?php echo $row ?>);void(0);" class="button" style="width: 45px;"><?php _e("Edit", 'almera') ?></a><a href="javascript:tmm_ext_layout_constructor.delete_row(<?php echo $row ?>);void(0);" class="button" style="width: 60px;margin:0 0 0 5px;"><?php _e("Delete", 'almera') ?></a>
						</td>
						<td class="col_items">
							<span class="row_columns_container" id="row_columns_container_<?php echo $row ?>">
								<?php if (!empty($row_data)): ?>
									<?php foreach ($row_data as $uniqid => $column) : ?>
										<?php
										if ($uniqid == 'row_data') {
											continue;
										}
										?>
										<?php
										$col_data = array(
											'row' => $row,
											'uniqid' => $uniqid,
											'css_class' => $column['css_class'],
											'front_css_class' => $column['front_css_class'],
											'value' => $column['value'],
											'content' => $column['content'],
											'title' => $column['title'],
											'effect' => @$column['effect'],
										);
										
										TMM_Ext_LayoutConstructor::draw_column_item($col_data);
										?>
									<?php endforeach; ?>
								<?php endif; ?>
							</span>
						</td>
						<td><div class="row-mover"><?php _e("Row Mover", 'almera') ?></div></td>
					</tr>
				</table>

				<input type="hidden" id="row_bg_type_<?php echo $row ?>" value="<?php echo (isset($tmm_layout_constructor_row[$row]) ? @$tmm_layout_constructor_row[$row]['bg_type'] : '') ?>" name="tmm_layout_constructor_row[<?php echo $row ?>][bg_type]" />
				<input type="hidden" id="row_bg_data_<?php echo $row ?>" value="<?php echo (isset($tmm_layout_constructor_row[$row]) ? @$tmm_layout_constructor_row[$row]['bg_data'] : '') ?>" name="tmm_layout_constructor_row[<?php echo $row ?>][bg_data]" />
				<input type="hidden" id="row_border_type_<?php echo $row ?>" value="<?php echo (isset($tmm_layout_constructor_row[$row]) ? @$tmm_layout_constructor_row[$row]['border_type'] : '') ?>" name="tmm_layout_constructor_row[<?php echo $row ?>][border_type]" />
				<input type="hidden" id="row_border_width_<?php echo $row ?>" value="<?php echo (isset($tmm_layout_constructor_row[$row]) ? @$tmm_layout_constructor_row[$row]['border_width'] : '') ?>" name="tmm_layout_constructor_row[<?php echo $row ?>][border_width]" />
				<input type="hidden" id="row_border_color_<?php echo $row ?>" value="<?php echo (isset($tmm_layout_constructor_row[$row]) ? @$tmm_layout_constructor_row[$row]['border_color'] : '') ?>" name="tmm_layout_constructor_row[<?php echo $row ?>][border_color]" />

			</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>


<div style="display: none;">
	<div id="layout_constructor_column_item">
		<?php
		$col_data = array(
			'row' => '__ROW_ID__',
			'uniqid' => '__UNIQUE_ID__',
			'css_class' => 'element1-4',
			'front_css_class' => 'four columns',
			'value' => '1/4',
			'content' => '',
			'title' => '',
			'effect' => '',
		);
		TMM_Ext_LayoutConstructor::draw_column_item($col_data);
		?>
	</div>
	<div id="layout_constructor_column_row">
		<li id="layout_constructor_row___ROW_ID__" class="layout_constructor_item">
			<table>
				<tr>
					<td>
						<a href="javascript:tmm_ext_layout_constructor.add_column(__ROW_ID__);void(0);" class="button" style="width: 110px;text-align:center;margin-right:5px;"><?php _e("Add Column", 'almera') ?></a><br />
						<a href="javascript:tmm_ext_layout_constructor.edit_row(__ROW_ID__);void(0);" class="button" style="width: 45px;"><?php _e("Edit", 'almera') ?></a><a href="javascript:tmm_ext_layout_constructor.delete_row(__ROW_ID__);void(0);" class="button" style="width: 60px;margin:0 0 0 5px;"><?php _e("Delete", 'almera') ?></a>
					</td>
					<td class="col_items">
						<span class="row_columns_container" id="row_columns_container___ROW_ID__"></span>
					</td>
					<td><div class="row-mover"><?php _e("Row Mover", 'almera') ?></div></td>
				</tr>
			</table>
			<input type="hidden" id="row_bg_type___ROW_ID__" value="" name="tmm_layout_constructor_row[__ROW_ID__][bg_type]" />
			<input type="hidden" id="row_bg_data___ROW_ID__" value="" name="tmm_layout_constructor_row[__ROW_ID__][bg_data]" />
			<input type="hidden" id="row_border_type___ROW_ID__" value="" name="tmm_layout_constructor_row[__ROW_ID__][border_type]" />
			<input type="hidden" id="row_border_width___ROW_ID__" value="" name="tmm_layout_constructor_row[__ROW_ID__][border_width]" />
			<input type="hidden" id="row_border_color___ROW_ID__" value="" name="tmm_layout_constructor_row[__ROW_ID__][border_color]" />
		</li>
	</div>

	<div id="layout_constructor_effects">
		<?php
		TMM_Helper::draw_html_option(array(
			'type' => 'select',
			'title' => '',
			'label' => __("Layout constructor", 'almera'),
			'shortcode_field' => 'effects_selector',
			'id' => '',
			'options' => TMM_Ext_LayoutConstructor::$effects,
			'default_value' => '',
			'description' => '',
			'css_classes' => 'effects_selector'
		));
		?>
	</div>

	<!-------------------------- DIALOGs TEMPLATES ----------------------------------------- -->


	<div style="display: none;">
		<div id="layout_constructor_layout_dialog"></div>
		<div id="layout_constructor_row_dialog">
			<div class="tmm_shortcode_template clearfix">
				<div class="one-half">
					<?php
					TMM_Helper::draw_html_option(array(
						'type' => 'select',
						'title' => __('Row Background Type', 'almera'),
						'shortcode_field' => 'row_background_type',
						'id' => 'row_background_type',
						'options' => array(
							'color' => __('Color', 'almera'),
							'image' => __('Image', 'almera'),
						),
						'default_value' => 'color',
						'description' => ''
					));
					?>
				</div>
				<div class="clear"></div>
				<div class="one-half" id="row_background_color_box" style="display: none;">
					<?php
					TMM_Helper::draw_html_option(array(
						'title' => __('Background Color', 'almera'),
						'shortcode_field' => 'row_background_color',
						'type' => 'color',
						'description' => '',
						'default_value' => '',
						'id' => 'row_background_color'
					));
					?>
				</div>
				<div class="clear"></div>
				<div class="one-half" id="row_background_image_box" style="display: none;">
					<?php
					TMM_Helper::draw_html_option(array(
						'type' => 'upload',
						'title' => __('Background Image', 'almera'),
						'shortcode_field' => 'row_background_image',
						'id' => 'row_background_image',
						'default_value' => '',
						'description' => ''
					));
					?>

				</div>
				<div class="clear"></div>
				<div class="one-half">
					<?php
					TMM_Helper::draw_html_option(array(
						'type' => 'select',
						'title' => __('Border width', 'almera'),
						'shortcode_field' => 'row_border_width',
						'id' => 'row_border_width',
						'options' => array(
							0 => 0,
							1 => 1,
							2 => 2,
							3 => 3,
							4 => 4,
							5 => 5,
						),
						'default_value' => 0,
						'description' => ''
					));
					?>
				</div>
				<div class="clear"></div>
				<div class="one-half">
					<?php
					TMM_Helper::draw_html_option(array(
						'type' => 'select',
						'title' => __('Border type', 'almera'),
						'shortcode_field' => 'row_border_type',
						'id' => 'row_border_type',
						'options' => array(
							'solid' => __('Solid', 'almera'),
							'dashed' => __('Dashed', 'almera'),
							'dotted' => __('Dotted', 'almera'),
						),
						'default_value' => 'solid',
						'description' => ''
					));
					?>
				</div>
				<div class="clear"></div>

				<div class="one-half">
					<?php
					TMM_Helper::draw_html_option(array(
						'title' => __('Border Color', 'almera'),
						'shortcode_field' => 'row_border_color',
						'type' => 'color',
						'description' => '',
						'default_value' => '',
						'id' => 'row_border_color'
					));
					?>
				</div>


			</div>

			<div class="clear"></div>
		</div>
	</div>

</div>
<!-- programmer realmag777 -->
