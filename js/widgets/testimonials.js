function tmm_init_testimonials(unique_id, timeout) {
	var $quotes = jQuery('.quotes_'+unique_id);

	if ($quotes.length) {

		$quotes.each(function(i) {

			var $this = jQuery(this);

			$this.css('height', $this.children('li:first').height())
					.after('<div class="quotes-nav"> <a class="prevBtn quotes-nav-prev-' + i + '">Prev</a><a class="nextBtn quotes-nav-next-' + i + '">Next</a> </div>')
					.cycle({
				before: function(curr, next, opts) {
					var $this = jQuery(this);
					$this.parent().stop().animate({height: $this.height()}, opts.speed);
				},
				containerResize: false,
				easing: 'easeInOutExpo',
				fit: true,
				next: '.quotes-nav-next-' + i,
				pause: true,
				prev: '.quotes-nav-prev-' + i,
				slideResize: true,
				speed: 600,
				timeout: timeout,
				width: '100%'
			}).data('slideCount', $quotes.children('li').length);
		});

		// Pause on Nav Hover
		jQuery('.quotes_'+unique_id+' .quotes-nav a').on('mouseenter', function() {
			jQuery(this).parent().prev().cycle('pause');
		}).on('mouseleave', function() {
			jQuery(this).parent().prev().cycle('resume');
		});

		// Hide Navigation if only a Single Slide
		if ($quotes.data('slideCount') <= 1) {
			$quotes.next('.quotes_'+unique_id+' .quotes-nav').hide();
		}

		// Resize
		jQuery(window).on('resize', function() {
			$quotes.css('height', $quotes.find('li:visible').height());
		});

		// Include Swipe
		if (Modernizr.touch) {

			function swipeFunc(e, dir) {

				var $quotes = jQuery(e.currentTarget);

				// Enable swipes if more than one slide
				if ($quotes.data('slideCount') > 1) {

					$quotes.data('dir', '');

					if (dir === 'left'){
						$quotes.cycle('next');
					}

					if (dir === 'right') {
						$quotes.data('dir', 'prev');
						$quotes.cycle('prev');
					}

				}

			}

			$quotes.swipe({
				swipeLeft: swipeFunc,
				swipeRight: swipeFunc,
				allowPageScroll: 'auto'
			});

		}
	}
}