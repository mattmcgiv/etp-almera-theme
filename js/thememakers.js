/* ---------------------------------------------------- */
/*	Life												*/
/* ---------------------------------------------------- */

(function($) {

	var THEMEMAKERS = function() {

		return {
			init: function() {
				$.fn.life = function(types, data, fn) {
					$(this.context).on(types, this.selector, data, fn);
					return this;
				};
			}
		};

	};
	new THEMEMAKERS().init();

}(jQuery));
