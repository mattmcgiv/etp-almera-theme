jQuery(function() {
	jQuery("#button_import_demo_data").click(function() {
		if (confirm(lang_app_demo_import1)) {
			show_static_info_popup(lang_loading);
			var data = {
				action: "tmm_import_demo_data"
			};
			jQuery.post(ajaxurl, data, function(response) {
				//hide_static_info_popup();
				if (response !== 'succsess') {
					show_static_info_popup(response);
				} else {
					show_info_popup(lang_app_demo_import3);
					window.location.reload();
				}
			});
		}
	});

	
});