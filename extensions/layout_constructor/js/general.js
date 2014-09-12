var TMM_APP_CONTENT_CONSTRUCTOR = function() {
	var self = {
		columns: null,
		active_editor_id: null,
		init: function() {
			self.columns = [
				{
					'value': '1/4',
					'name': 'One fourth',
					'css_class': 'element1-4',
					'front_css_class': 'four columns'
				},
				{
					'value': '1/3',
					'name': 'One third',
					'css_class': 'element1-3',
					'front_css_class': 'one-third column'
				},
				{
					'value': '1/2',
					'name': 'One half',
					'css_class': 'element1-2',
					'front_css_class': 'eight columns'
				},
				{
					'value': '2/3',
					'name': 'Two thirds',
					'css_class': 'element2-3',
					'front_css_class': 'two-thirds column'
				},
				{
					'value': '3/4',
					'name': 'Three Fourth',
					'css_class': 'element3-4',
					'front_css_class': 'twelve columns'
				},
				{
					'value': '1',
					'name': 'Full width',
					'css_class': 'element1-1',
					'front_css_class': ''
				}
			];

			jQuery('#layout_constructor_items').sortable();
			jQuery('.row_columns_container').sortable();

			//create hidden popup area wor changing column width
			jQuery.each(self.columns, function(index, column) {
				
				var link = jQuery('<a>')
						.attr('href', '#')
						.attr('data-value', column.value)
						.attr('data-css-class', column.css_class)
						.attr('data-front-css-class', column.front_css_class)
						.addClass('change_column_size')
						.html(column.name);

				jQuery('<li class="css-class-' + column.css_class + '">')
						.append(link)
						.appendTo('.layout_constructor_column_sizes_list');

			});


			//*****

			jQuery("#layout_constructor_items .delete-element").life('click', function() {
				if (jQuery(".layout_constructor_layout_dialog_desc").length > 0) {
					return;
				}

				if (confirm(lang_sure_item_delete)) {
					jQuery("#item_" + jQuery(this).data('item-id')).remove();
				}

				return false;
			});


			jQuery("#layout_constructor_items .edit-element").life('click', function() {

				if (jQuery(".layout_constructor_layout_dialog_desc").length > 0) {
					return;
				}

				//var dialog = jQuery("#layout_constructor_layout_dialog");

				var item_id = jQuery(this).data('item-id');
				var title = jQuery("#item_" + item_id).find('.page-element-item-text').html();
				if (title === lang_empty) {
					title = "";
				}
				var text = jQuery("#item_" + item_id).find('.js_content').text();
                                
                                var html = '\
<input type="text" placeholder="' + lang_empty + '" value="' + title + '" class="layout_constructor_layout_dialog_desc" /><br />\n\
<a title="' + lang_add_media + '" data-editor="layout_constructor_editor" class="button insert-media add_media" href="#">\n\
<span class="wp-media-buttons-icon"></span> ' + lang_add_media + '</a>&nbsp;<ul id="layout_constructor_column_options"></ul>\n\
<textarea id="layout_constructor_editor" style="height:400px;"></textarea>';

				var popup_params = {
					content: html,
					title: lang_popup_title,
					overlay: true,
					width: 800,
					height: 600,
					open: function() {
                                               
                                                //tinyMCE.activeEditor.id = 'layout_constructor_editor';
                                                
						self.active_editor_id = 'layout_constructor_editor';
						tinyMCE.execCommand('mceAddEditor', false, self.active_editor_id);
						tinyMCE.execCommand('mceSetContent', false, text);
						//column options settings
						jQuery('#layout_constructor_column_options').append('<li>' + jQuery('#layout_constructor_effects').html() + '</li>');
						jQuery('.effects_selector').val(jQuery("#item_" + item_id).find('.js_effect').val());
						jQuery('.effects_selector').change(function() {
							jQuery("#item_" + item_id).find('.js_effect').val(jQuery(this).val());
						});
					},
					close: function() {
						jQuery('#tmm_advanced_wp_popup3 li').hide();
						//tinyMCE.execCommand('mceCleanup', false, self.active_editor_id);
						//tinyMCE.execCommand('mceRemoveControl', false, self.active_editor_id);
                                                
                                                tinyMCE.execCommand('mceRemoveEditor', false, self.active_editor_id);                                                
                                                
						self.active_editor_id = null;
						jQuery(".layout_constructor_layout_dialog_desc").remove();
						//*** column options settings
						jQuery('.effects_selector').val('');
					},
					buttons: {
						0: {
							name: 'Apply',
							action: function(__self) {
								var new_title = jQuery(".layout_constructor_layout_dialog_desc").val();

								if (new_title.length == 0) {
									new_title = lang_empty;
								}

								jQuery("#item_" + item_id).find('.js_title').val(new_title == lang_empty ? "" : new_title);
								jQuery("#item_" + item_id).find('.page-element-item-text').html(new_title);
								jQuery("#item_" + item_id).find('.js_content').text(tinyMCE.get(self.active_editor_id).getContent());
								//***
								jQuery('.advanced_wp_popup_close3').trigger('click');
							},
							close: false
						},
						1: {
							name: 'Close',
							action: 'close'
						}
					}
				};
				tmm_advanced_wp_popup3.popup(popup_params);

				return false;
                                /*

				jQuery(dialog).dialog({
					autoOpen: false,
					width: 800,
					height: 600,
					position: [200, 200],
					zIndex: 1,
					stack: true,
					title: "Column content editor",
					buttons: {
						"Apply": function() {
							var new_title = jQuery(".layout_constructor_layout_dialog_desc").val();

							if (new_title.length == 0) {
								new_title = lang_empty;
							}

							jQuery("#item_" + item_id).find('.js_title').val(new_title == lang_empty ? "" : new_title);
							jQuery("#item_" + item_id).find('.page-element-item-text').html(new_title);
							jQuery("#item_" + item_id).find('.js_content').text(tinyMCE.get(self.active_editor_id).getContent());
							//***
							jQuery(this).dialog("close");
						},
						"Cancel": function() {
							jQuery(this).dialog("close");
						}
					},
					close: function(event, ui) {
						tinyMCE.execCommand('mceCleanup', false, self.active_editor_id);
						tinyMCE.execCommand('mceRemoveControl', false, self.active_editor_id);
						self.active_editor_id = null;
						jQuery(this).dialog("destroy");
						jQuery(".layout_constructor_layout_dialog_desc").remove();
						//*** column options settings
						jQuery('.effects_selector').val('');
					},
					open: function(event, ui) {
						self.active_editor_id = 'layout_constructor_editor';
						tinyMCE.execCommand('mceAddControl', false, self.active_editor_id);
						//tinyMCE.execCommand('mceInsertContent', false, text);
						tinyMCE.execCommand('mceSetContent', false, text);
						//column options settings
						jQuery('#layout_constructor_column_options').append('<li>' + jQuery('#layout_constructor_effects').html() + '</li>');
						jQuery('.effects_selector').val(jQuery("#item_" + item_id).find('.js_effect').val());
						jQuery('.effects_selector').change(function() {
							jQuery("#item_" + item_id).find('.js_effect').val(jQuery(this).val());
						});
						//***
					}
				});
				jQuery(dialog).dialog('open');

				return false;
                            */
			});


			jQuery("#layout_constructor_items .add-element-size-plus").life('click', function() {
				var item_id = jQuery(this).data('item-id');
				var css_class = jQuery("#item_" + item_id).find('.js_css_class').val();
				var next_li = jQuery("#item_" + item_id + " li.css-class-" + css_class).next('li');
				if (next_li.length > 0) {
					jQuery(next_li).find('a').trigger('click');
				}

				/*
				 * I am realmag777 and I programmed here all you can see in this theme, I like it =)
				 var position=jQuery(this).position();
				 jQuery(".layout_constructor_column_sizes_list").hide();
				 
				 jQuery("#item_"+item_id+" .layout_constructor_column_sizes_list")
				 .css('top', position.top)
				 .css('left', position.left+20)
				 .show(200);
				 */
				return false;
			});


			jQuery("#layout_constructor_items .add-element-size-minus").life('click', function() {
				var item_id = jQuery(this).data('item-id');
				var css_class = jQuery("#item_" + item_id).find('.js_css_class').val();
				var prev_li = jQuery("#item_" + item_id + " li.css-class-" + css_class).prev('li');
				if (prev_li.length > 0) {
					jQuery(prev_li).find('a').trigger('click');
				}
				return false;
			});

			jQuery(".change_column_size").life('click', function() {

				var parent = jQuery(this).parent().parent();

				if (jQuery(this).data('value') == 0) {
					jQuery(parent).hide(200);
					return false;
				}
				//*****

				var item_id = jQuery(parent).data('item-id');

				jQuery("#item_" + item_id).removeAttr('class').addClass('page-element').addClass(jQuery(this).data('css-class'));
				jQuery("#item_" + item_id).find('.element-size-text').html(jQuery(this).data('value'));

				jQuery("#item_" + item_id).find('.js_css_class').val(jQuery(this).data('css-class'));
				jQuery("#item_" + item_id).find('.js_front_css_class').val(jQuery(this).data('front-css-class'));
				jQuery("#item_" + item_id).find('.js_value').val(jQuery(this).data('value'));
				jQuery(parent).hide(200);

				return false;
			});

			//****
			jQuery('#row_background_type').change(function() {
				var val = jQuery(this).val();
				switch (val) {
					case 'color':
						jQuery('#row_background_color_box').show();
						jQuery('#row_background_image_box').hide();
						break;
					case 'image':
						jQuery('#row_background_color_box').hide();
						jQuery('#row_background_image_box').show();
						break;
				}
			});

			//****
			self._is_rows_exists();
		},
		add_column: function(row_id) {
			var html = jQuery("#layout_constructor_column_item").html();
			var unique_id = get_time_miliseconds();
			html = html.replace(/__UNIQUE_ID__/gi, unique_id);
			html = html.replace(/__ROW_ID__/gi, row_id);
			jQuery("#row_columns_container_" + row_id).append(html);
			jQuery('#layout_constructor_items').sortable();
		},
		add_row: function() {
			var html = jQuery("#layout_constructor_column_row").html();
			var row_id = get_time_miliseconds();
			html = html.replace(/__ROW_ID__/gi, row_id);
			jQuery("#layout_constructor_items").append(html);
			jQuery('.row_columns_container').sortable();
			self._is_rows_exists();
			colorizator();
		},
		edit_row: function(row_id) {

			var dialog = jQuery("#layout_constructor_row_dialog");

			jQuery(dialog).dialog({
				autoOpen: false,
				width: 410,
				height: 455,
				position: ['48%', '48%'],
				zIndex: 1,
				stack: true,
				title: "Row editor",
				buttons: {
					"Apply": function() {
						var bg_type = jQuery('#row_background_type').val();
						jQuery('#row_bg_type_' + row_id).val(bg_type);
						var bg_val = '';
						switch (bg_type) {
							case 'color':
								bg_val = jQuery('#row_background_color').val();
								break;
							case 'image':
								bg_val = jQuery('#row_background_image').val();
								break;
						}
						jQuery('#row_bg_data_' + row_id).val(bg_val);
						//*** apply borders
						jQuery('#row_border_type_' + row_id).val(jQuery('#row_border_type').val());
						jQuery('#row_border_width_' + row_id).val(jQuery('#row_border_width').val());
						jQuery('#row_border_color_' + row_id).val(jQuery('#row_border_color').val());

						jQuery(this).dialog("close");
					},
					"Cancel": function() {
						jQuery(this).dialog("close");
					}
				},
				close: function(event, ui) {
					jQuery(this).dialog("destroy");
				},
				open: function(event, ui) {
					jQuery('#row_background_image').val('');
					jQuery('#row_background_color').val('');
					jQuery('#row_background_color').next('.bgpicker').css('background-color', '');
					//***
					var bg_type = jQuery('#row_bg_type_' + row_id).val();
					jQuery('#row_background_type').val(bg_type);
					switch (bg_type) {
						case 'color':
							var bg_val = jQuery('#row_bg_data_' + row_id).val();
							jQuery('#row_background_color').val(bg_val);
							jQuery('#row_background_color').next('.bgpicker').css('background-color', bg_val);
							break;
						case 'image':
							var bg_val = jQuery('#row_bg_data_' + row_id).val();
							jQuery('#row_background_image').val(bg_val);
							break;
					}
					jQuery('#row_background_type').trigger('change');
					//*** borders init
					jQuery('#row_border_type').val(jQuery('#row_border_type_' + row_id).val());
					jQuery('#row_border_width').val(jQuery('#row_border_width_' + row_id).val());
					jQuery('#row_border_color').val(jQuery('#row_border_color_' + row_id).val());
					jQuery('#row_border_color').next('.bgpicker').css('background-color', jQuery('#row_border_color_' + row_id).val());
				}
			});
			jQuery(dialog).dialog('open');

			return false;
		},
		delete_row: function(row_id) {
			if (jQuery(".layout_constructor_layout_dialog_desc").length > 0) {
				return;
			}

			if (confirm(lang_sure_row_delete)) {
				jQuery("#layout_constructor_row_" + row_id).remove();
			}

			self._is_rows_exists();
		},
		_is_rows_exists: function() {
			if (jQuery("#layout_constructor_items > li").size() === 0) {
				jQuery("#layout_constructor_items").hide();
				return false;
			} else {
				jQuery("#layout_constructor_items").show();
			}

			return true;
		}
	};

	return self;
};
//*****

var tmm_ext_layout_constructor = null;
jQuery(document).ready(function() {
	tmm_ext_layout_constructor = new TMM_APP_CONTENT_CONSTRUCTOR();
	tmm_ext_layout_constructor.init();
});


