var TMM_PORTFOLIO_ADMIN = function() {
	"use strict";
	var self = {
		html_buffer: "",
		init: function() {
			jQuery('body').append('<div id="inpost_gallery_html_buffer" style="display: none;"></div>');
			jQuery('body').append('<div id="inpost_gallery_info_popup" style="display: none;"></div>');
			self.html_buffer = jQuery("#inpost_gallery_html_buffer");
			jQuery("#gallery_item_list").sortable();
			//*****
			jQuery('.js_inpost_gallery_add_slide').life('click', function(event)
			{
				window.send_to_editor = function(html)
				{
					self.insert_html_in_buffer(html);
					var images = jQuery(self.html_buffer).find('a');
					var img_urls = [];
					jQuery.each(images, function(index, value) {
						img_urls[index] = jQuery(value).attr('href');
					});
					self.add_meta_slide_items(img_urls, 0);
					self.insert_html_in_buffer("");
				};
				wp.media.editor.open(null);

				return false;
			});

			jQuery('.js_inpost_gallery_add_video').life('click', function(event)
			{
				var video_url = prompt("Enter youtube or vimeo link");
				if (video_url.length > 0) {
					var video = [video_url];
					self.add_meta_slide_items(video, 0);
				}

				return false;
			});

			jQuery(".delete_gallery_item").life('click', function() {
				var self_button = this;
				jQuery(self_button).parents('li').eq(0).hide(333, function() {
					jQuery(self_button).parents('li').eq(0).remove();
				});

				return false;
			});
			
				/* choose folio type*/
			
			jQuery('#folio_type option').life('click', function(){
					jQuery('#choose_folio_t').val(jQuery(this).val());
					
			});
			/* end folio type */
		},
		add_meta_slide_items: function(img_urls, index) {
			show_info_popup(lang_loading + ' ...');
			var data = {
				action: "add_gallery_folio_item",
				imgurl: img_urls[index]
			};
			jQuery.post(ajaxurl, data, function(response) {
				jQuery("#gallery_item_list").append(response);
				if (index < (img_urls.length - 1)) {
					self.add_meta_slide_items(img_urls, index + 1);
				}
			});
		},
		folio_image_options: function(container_id, unique_id) {
			var params = {
				content: jQuery('#' + container_id).html(),
				title: "Portfolio image options",
				overlay: true,
				width: 400,
				open: function() {
					//***
				},
				buttons: {
					0: {
						name: 'Apply',
						action: function(_self) {
							var content = _self.get_content();
							jQuery('#' + container_id).html(content);
							//***
							var title = jQuery(_self.popup_li).find(".js_edit_gallery_item_title").val();
							var imgurl2 = jQuery(_self.popup_li).find(".js_edit_gallery_item_imgurl2").val();
							var title3_style = jQuery(_self.popup_li).find(".js_edit_gallery_item_title3_style").val();
							var title3_position = jQuery(_self.popup_li).find(".js_edit_gallery_item_title3_position").val();
                                                        var title_href = jQuery(_self.popup_li).find(".js_edit_gallery_item_title_href").val();
							jQuery("[name='tmm_portfolio[" + unique_id + "][title]']").val(title);
							jQuery("[name='tmm_portfolio[" + unique_id + "][imgurl2]']").val(imgurl2);
							jQuery("[name='tmm_portfolio[" + unique_id + "][title3_style]']").val(title3_style);
							jQuery("[name='tmm_portfolio[" + unique_id + "][title3_position]']").val(title3_position);
                                                        jQuery("[name='tmm_portfolio[" + unique_id + "][title_href]']").val(title_href);
							//***
							var tmm_portfolio_item_cats = jQuery(_self.popup_li).find('.tmm_portfolio_item_cat:checked');
							var tmm_portfolio_item_cats_ids = [];
							if (tmm_portfolio_item_cats.length > 0) {
								jQuery.each(tmm_portfolio_item_cats, function(index, checkbox) {
									tmm_portfolio_item_cats_ids.push(jQuery(checkbox).val());
								});
							}
							jQuery("[name='tmm_portfolio[" + unique_id + "][categories]']").val(tmm_portfolio_item_cats_ids.join());
						},
						close: true
					},
					1: {
						name: 'Close',
						action: 'close'
					}
				}
			};
			tmm_advanced_wp_popup.popup(params);

		},
		insert_html_in_buffer: function(html) {
			jQuery(self.html_buffer).html(html);
		}
	};

	return self;
};

var tmm_admin_portfolio = new TMM_PORTFOLIO_ADMIN();
jQuery(document).ready(function() {
	tmm_admin_portfolio.init();
});