function tmm_recent_projects(unique_id) {
	var $projects = jQuery("#recent-projects-box_"+unique_id+" > ul");

	if ($projects.length) {

		// Run slider when all images are fully loaded
		jQuery(window).load(function() {

			$projects.each(function(i) {

				var $this = jQuery(this);

				$this.css('height', $this.children('li:first').height())
						.after('<div class="recent-projects-nav"><a class="prevBtn recent-nav-prev-' + i + '">Prev</a> <a class="nextBtn recent-nav-next-' + i + '">Next</a> </div>')
						.cycle({
					before: function(curr, next, opts) {
						var $this = jQuery(this);
						$this.parent().stop().animate({height: $this.height()}, opts.speed);
					},
					containerResize: false,
					easing: 'easeInOutExpo',
					fit: true,
					next: '.recent-nav-next-' + i,
					pause: true,
					prev: '.recent-nav-prev-' + i,
					slideResize: true,
					speed: 600,
					timeout: 5000,
					width: '100%'
				}).data('slideCount', $projects.children('li').length);
			});

			// Pause on Nav Hover
			jQuery('.recent-projects-nav a').on('mouseenter', function() {
				jQuery(this).parent().prev().cycle('pause');
			}).on('mouseleave', function() {
				jQuery(this).parent().prev().cycle('resume');
			});

			// Hide navigation if only a single slide
			if ($projects.data('slideCount') <= 1) {
				$projects.next('.recent-projects-nav').hide();
			}

		});

		// Resize
		jQuery(window).on('resize', function() {
			$projects.css('height', $projects.find('li:visible').height());
		});

		// Include Swipe
		if (Modernizr.touch) {

			function swipeFunc(e, dir) {

				var $projects = jQuery(e.currentTarget);

				// Enable swipes if more than one slide
				if ($projects.data('slideCount') > 1) {

					$projects.data('dir', '');

					if (dir === 'left'){
						$projects.cycle('next');
					}						

					if (dir === 'right') {
						$projects.data('dir', 'prev');
						$projects.cycle('prev');
					}

				}

			}

			$projects.swipe({
				swipeLeft: swipeFunc,
				swipeRight: swipeFunc,
				allowPageScroll: 'auto'
			});

		}
	}

}