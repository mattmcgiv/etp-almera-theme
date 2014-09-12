function save_options(type) {
	var data = {
		type: type,
		action: "change_options",
		values: jQuery("#theme_options").serialize()
	};
	//send data to server
	jQuery.post(ajaxurl, data, function(response) {
		show_info_popup(response);
		if (type == 'reset') {
			window.location.reload();
		}
	});
}


function init_tabs() {

	var slideSpeed = 500; // 'slow', 'normal', 'fast', or miliseconds
	var $nav = jQuery('#tm ul.admin-nav');
	var $sub = $nav.find('ul');
	var $navLi = $nav.children('li');
	var $navliFirst = $nav.find('li:first');

	if ($navliFirst.length) {
		$navliFirst.addClass('current-shortcut');
		if ($navliFirst.find('ul')) {
			$navliFirst.find('ul').css('display', 'block');
			$navliFirst.find('ul li:first').addClass('sub-current');
		}
	}

	$nav.on('click', 'a', function(e) {

		var $cont = jQuery('#admin-content');
		$cont.attr('style', '');

		window_height = jQuery(window).outerHeight(true),
				admin_height = $cont.outerHeight(true);

		if (admin_height <= window_height) {
			jQuery('#admin-aside, #admin-content').css('min-height', window_height - jQuery('#title-bar').outerHeight(true) - jQuery('.set-holder').outerHeight(true) - 200);
		}
		e.preventDefault();
	});

	$sub.find('a').on('click', function(e) {

		$target = jQuery(e.target);
		$sub.children('li').removeClass();
		$target.parent('li').addClass('sub-current');

		e.preventDefault();
	});

	$navLi.children('a').on('click', function(e) {

		$target = jQuery(e.target);
		jQuery(this).parent('li').children('ul').slideUp(slideSpeed);

		if (jQuery(this).parent('li').children('ul').css('display') == "block") {
			jQuery(this).parent('li').children('ul').slideUp(slideSpeed);
			$target.parent('li').removeClass();

		} else {
			$sub.slideUp(slideSpeed);
			$sub.find('li').removeClass();
			jQuery(this).parent('li').children('ul').slideDown(slideSpeed).find('li:first').addClass('sub-current');
		}

		$navLi.removeClass();
		$target.parent('li').addClass('current-shortcut');

		e.preventDefault();

	});

	var $contentTabs = jQuery('.admin-container');

	jQuery.fn.tabs = function($obj) {
		$tabsNavLis = $obj.find('ul.admin-nav').children('li'),
				$tabContent = $obj.find('#admin-content').children('.tab-content');

		$tabContent.hide();
		$tabsNavLis.first().addClass('active').show();
		$tabContent.first().show();

		$obj.find('ul.admin-nav li > a').on('click', function(e) {

			var $this = jQuery(this);

			$obj.find('ul.admin-nav li').removeClass('active');
			$this.addClass('active');
			$obj.find('.tab-content').hide();
			jQuery($this.attr('href')).fadeIn();

			e.preventDefault();
		});
	};

	$contentTabs.tabs($contentTabs);
}




function deinit_tabs() {
	var $nav = jQuery('#tm ul.admin-nav');
	var $sub = $nav.find('ul');
	var $navLi = $nav.children('li');
	$sub.find('a').unbind('click');
	$navLi.children('a').unbind('click');


	jQuery.fn.tabs = function($obj) {
		$obj.find('ul.admin-nav li > a').unbind('click');
	};
}



//*****

function save_color_pickers_states() {
	var pickers = jQuery(".bg_hex_color");

	jQuery.each(pickers, function(index, picker) {
		var name = jQuery(picker).attr('name');
		var color = jQuery(picker).val();
		var pickers_saved_values = jQuery.cookie(name);

		if (pickers_saved_values === null) {
			pickers_saved_values = [];
		} else {
			pickers_saved_values = pickers_saved_values.split('+');
		}

		if (pickers_saved_values.length > 20) {
			pickers_saved_values.pop();
		}

		var already_in_array = false;

		for (var i = 0; i < pickers_saved_values.length; i++) {
			if (color == pickers_saved_values[i]) {
				already_in_array = true;
				break;
			}
		}
		//do not save equaly colors
		if (!already_in_array) {
			pickers_saved_values.unshift(color);
		}

		//to string again
		pickers_saved_values = pickers_saved_values.join('+');
		jQuery.cookie(name, pickers_saved_values);
	});

}

function get_color_picker_value(input, index) {
	index = parseInt(index, 10);
	var name = jQuery(input).attr('name');

	var pickers_saved_values = jQuery.cookie(name);

	if (pickers_saved_values === null) {
		return false;
	}

	if (pickers_saved_values.length === 0) {
		return false;
	}

	//to array
	pickers_saved_values = pickers_saved_values.split('+');
	pickers_saved_values.pop();
	//***

	if (index < 0) {
		index = pickers_saved_values.length - 1;
		jQuery(input).attr('value-index', index);
	}


	if (pickers_saved_values[index] == undefined && index == 0) {
		return false;
	}

	if (pickers_saved_values[index] == undefined || pickers_saved_values[index].length == 0) {
		jQuery(input).attr('value-index', 0);
		index = 0;
	}


	if (index >= pickers_saved_values.length) {
		index = 0;
		jQuery(input).attr('value-index', 0);
	}


	return pickers_saved_values[index];
}



jQuery(document).ready(function($) {


	show_loader();

	init_tabs();

               
	//option_checkbox
	jQuery(".option_checkbox").life('click', function() {
		if (jQuery(this).is(":checked")) {
			jQuery(this).parents(".checker").prev("input[type=hidden]").val(1);
			jQuery(this).parents(".checker").next("input[type=hidden]").val(1);
		} else {
			jQuery(this).parents(".checker").prev("input[type=hidden]").val(0);
			jQuery(this).parents(".checker").next("input[type=hidden]").val(0);
		}
	});

	jQuery('.button_save_options').life('click', function()
	{
		save_color_pickers_states();
		save_options("save");
		return false;
	});


	jQuery(".js_picker_val_ahead").life('click', function() {
		var input = jQuery(this).parent().find(".bg_hex_color").eq(0);
		var button = jQuery(this).parent().find(".bgpicker").eq(0);
		var index = parseInt(jQuery(input).attr('value-index'), 10);

		if (index >= 20) {
			index = 0;
		}

		var val = get_color_picker_value(input, index);
		if (val !== false) {
			jQuery(input).val(val);
			jQuery(button).css('background-color', val);

			if (index != parseInt(jQuery(input).attr('value-index'), 10)) {
				jQuery(input).attr('value-index', parseInt(jQuery(input).attr('value-index'), 10) + 1);
			} else {
				jQuery(input).attr('value-index', index + 1);
			}

		}

	});

	jQuery(".js_picker_val_back").life('click', function() {
		var input = jQuery(this).parent().find(".bg_hex_color").eq(0);
		var button = jQuery(this).parent().find(".bgpicker").eq(0);
		var index = parseInt(jQuery(input).attr('value-index'), 10);

		var val = get_color_picker_value(input, index);

		if (val !== false) {
			jQuery(input).val(val);
			jQuery(button).css('background-color', val);

			if (index != parseInt(jQuery(input).attr('value-index'), 10)) {
				jQuery(input).attr('value-index', parseInt(jQuery(input).attr('value-index'), 10) - 1);
			} else {
				jQuery(input).attr('value-index', index - 1);
			}
		}

	});



	jQuery(".js_picker_val_reset").life('click', function() {
		var input = jQuery(this).parent().find(".bg_hex_color").eq(0);
		var button = jQuery(this).parent().find(".bgpicker").eq(0);
		var def_val = jQuery(input).data('default-value');
		jQuery(input).val(def_val);
		jQuery(button).css('background-color', def_val);
	});



	jQuery('.button_reset_options').life('click', function()
	{
		if (confirm("Sure?")) {
			jQuery.each(tmm_options_reset_array, function(key, value) {
				var elem = jQuery("[name=" + value + "]");
				jQuery(elem).val(jQuery(elem).data('default-value'));
			});

			save_options("reset");
		}

		return false;
	});


	//*** logo block ***
	
	
	

	jQuery("[name=logo_type]").click(function() {
		switch (parseInt(jQuery(this).val(), 10)) {
			case 0:
				jQuery(".logo_img").hide(hide_delay);
				jQuery(".logo_text").show(show_delay);
				break;
			case 1:
				jQuery(".logo_img").show(show_delay);
				jQuery(".logo_text").hide(hide_delay);
				break;
		}
	});
	//***
	//Pattern Selector
	jQuery('.thumb_pattern a').click(function() {
		jQuery('.thumb_pattern a').removeClass('current');
		jQuery(this).addClass('current');
		jQuery('[name=body_pattern]').val(jQuery(this).attr('href'));
		return false;
	});

	jQuery('.body_pattern').life('click', function()
	{
		get_tb_editor_image_link(jQuery('[name=body_pattern]'), jQuery('#body_pattern_upload'));
		return false;
	});

	//insert background by hands
	jQuery('#body_pattern_upload').life('blur', function() {
		jQuery("#body_pattern_custom_image_preview").show();
		jQuery(".body_pattern_custom_image img").attr("src", jQuery(this).val());
		jQuery('[name=body_pattern]').val(jQuery(this).val());
		return false;
	});

	jQuery('[name=body_pattern]').life('change', function() {
		jQuery("#body_pattern_custom_image_preview").show();
		jQuery(".body_pattern_custom_image img").attr("src", jQuery(this).val());
		return false;
	});


	jQuery('[name=body_pattern_selected]').change(function() {
		jQuery(".options_custom_body_pattern ul li").hide();

		switch (parseInt(jQuery(this).val(), 10)) {
			case 0:
				jQuery(".body_pattern_default_image").show(show_delay);
				break;
			case 1:
				jQuery(".body_pattern_custom_image").show(show_delay);
				break;
			case 2:
				jQuery(".body_pattern_custom_color").show(show_delay);
				break;
		}


	});


	//*****
	jQuery("[name=favicon_img]").change(function() {
		jQuery("#favicon_preview_image").show();
		jQuery("#favicon_preview_image").attr("src", jQuery(this).val());
	});
	jQuery("[name=logo_img]").change(function() {
		jQuery("#logo_preview_image").show();
		jQuery("#logo_preview_image").attr("src", jQuery(this).val());
	});


	//*****

	jQuery(".delegate_click").life('click', function() {
		var id_data = jQuery(this).attr('id-data');
		jQuery("[href=#" + id_data + "]").trigger('click');
		return false;
	});



	//ACCORDION

	if (jQuery(".acc-trigger").length) {

		var $container = jQuery('.acc-container'),
				$trigger = jQuery('.acc-trigger');

		$container.hide();
		$trigger.first().addClass('active').next().show();

		$trigger.on('click', function(e) {
			var $this = jQuery(this);

			if ($this.attr('data-mode') === 'toggle') {
				$this.toggleClass('active').next().stop(true, true).slideToggle(300);
			} else if ($this.next().is(':hidden')) {
				$trigger.removeClass('active').next().slideUp(300);
				$this.toggleClass('active').next().slideDown(300);
			}
			e.preventDefault();
		});

	}

	//***
	jQuery(".options_list_items").sortable({
		stop: function(event, ui) {
			//***
		}
	});

	jQuery(".js_add_options_list_item").click(function() {
		var clone = jQuery(this).prev('ul').find(".list_item:last").clone(true);
		var last_row = jQuery(this).prev('ul').find(".list_item:last");
		jQuery(clone).insertAfter(last_row, clone);
		return false;
	});

	jQuery(".js_delete_options_list_item").click(function() {
		if (jQuery(this).parents('.options_list_items').find(".list_item").length > 1) {
			jQuery(this).parents('li').hide(200, function() {
				jQuery(this).remove();
			});
		}
		return false;
	});


	//*****
	hide_loader();
	
	
	jQuery('#tm select').wrap('<label class="sel" />');
	

});


/* ---------------------------------------------------- */
/*	jQuery Cookie
 /* ---------------------------------------------------- */
//for color options history
jQuery.cookie = function(name, value, options) {
	if (typeof value != 'undefined') {
		options = options || {};
		if (value === null) {
			value = '';
			options.expires = -1;
		}
		var expires = '';
		/*
		 if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
		 var date;
		 if (typeof options.expires == 'number') {
		 date = new Date();
		 date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000))
		 } else {
		 date = options.expires
		 }
		 expires = '; expires=' + date.toUTCString()
		 }
		 */

		var date = new Date();
		date.setTime(date.getTime() + 24 * 60 * 60 * 30 * 1000);
		expires = '; expires=' + date.toUTCString();


		var path = options.path ? '; path=' + (options.path) : '';
		var domain = options.domain ? '; domain=' + (options.domain) : '';
		var secure = options.secure ? '; secure' : '';
		document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
	} else {
		var cookieValue = null;
		if (document.cookie && document.cookie != '') {
			var cookies = document.cookie.split(';');
			for (var i = 0; i < cookies.length; i++) {
				var cookie = jQuery.trim(cookies[i]);
				if (cookie.substring(0, name.length + 1) == (name + '=')) {
					cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
					break;
				}
			}
		}
		return cookieValue;
	}
};
