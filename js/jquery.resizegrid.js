/**
 * jquery.resizegrid.js v1.0.0
 *
 *
 */
(function ($, window) {
		
	'use strict';
	
	$.Resize = function(options, element) {
		this.el = $(element);
		this.init(options);
	};
	
	$.Resize.defaults = {
		speed : 300,
		gutter : 2,
		cursorcolor : "#ff8b84"
	};

	$.Resize.prototype = {
		init: function(options) {
			this.o = $.extend({}, $.Resize.defaults, options);
			var self = this;
		
			self.refreshElements();

			if ($(window).width() > 767) {
					self.layout();
				
			} else {
				self.el.children('.grid').attr('style', '');
				self.items.each(function () {$(this).attr('style', '');});
				self.box.each(function () {$(this).attr('style', '');});
			}
			
			this.resize(self);
		},
		resize : function(self) {
	
			$(window).on('resize', function() {
				if ($(window).width() > 767) {
					self.layout();
				}
			});
	
		},
		layout : function() {
			
			var self = this;
			
			this.el.css({
				height: self._screenAdjust()
			});
			
			this._elemWH(this.box, this.items, self);		
				
		},
		elements: {
			'.gr-box' : 'box',
			'.item' : 'items'
		},
		$: function (selector) {
			return $(selector, this.el);
		},
		refreshElements: function () {
			for (var key in this.elements) {
				this[this.elements[key]]= this.$(key);
			}
		},
		_elemWH: function(box, items, self) {

			if (self.o.gutter) {
				$(items).css({
					margin: self.o.gutter
				});
			}
			
			function adjustItem(item, hasclass) {
				
				switch(hasclass) {
					case 'half':
						$(item).css({
							width: self._screenAdjust() / 2 - (self.o.gutter * 2),
							height: self._screenAdjust() / 2 - (self.o.gutter * 2)
						});
						break;
					case 'large':
						$(item).css({
							width: self._screenAdjust() - (self.o.gutter * 2),
							height: self._screenAdjust() / 2 - (self.o.gutter * 2)
						})	
						break;
					case 'full':
						$(item).css({
							width: self._screenAdjust() - (self.o.gutter * 2),
							height: self._screenAdjust() - (self.o.gutter * 2)
						})
						break;
					default:
						return;	
						break;
				}
				
			}
			
			var countElements = $(box).length;

			$(box).each(function(i,val) {

				$(val).css({
					width: self._screenAdjust()
				});

				self.el.children().css({
					width: countElements * $(val).outerWidth(true) + (self.o.gutter * 2)
				});
				
			});

			$(items).each(function(index, value) {

				if ($(value).hasClass('half')) {
					adjustItem(value, 'half');
				} 

				if ($(value).hasClass('large')) {
					adjustItem(value, 'large');
				}

				if ($(value).hasClass('full')) {
					adjustItem(value, 'full');
				}

			});
			
		},
		
		_screenAdjust : function () {
			return $(window).outerHeight(true) - this.el.position().top - $('#footer').outerHeight(true) - 51;
		}
	};
	
	$.fn.resizeGrid = function (options) {
		var instance = $.data(this, 'resize', new $.Resize(options, this));
		return instance;
	};

})(jQuery, window);

