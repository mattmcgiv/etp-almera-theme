<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
wp_enqueue_script('tmm_flexslider_js', TMM_Ext_Sliders::get_application_uri() . '/items/flex/js/jquery.flexslider-min.js');
?>


<script type="text/javascript">
	
	jQuery(function() {
		
		(function() {

			var $flex = jQuery('.flexslider');

			if ($flex.length) {

				jQuery(window).load(function() {
					$flex.flexslider({
						animation: "<?php echo $options['animation'] ?>",
						slideshow: <?php echo ($options['slideshow'] ? 'true' : 'false') ?>,
						controlNav: <?php echo ($options['controlnav'] ? 'true' : 'false') ?>,
						slideshowSpeed: <?php echo $options['slideshow_speed'] ?>,
						animationSpeed: <?php echo $options['animation_speed'] ?>,
						initDelay: <?php echo $options['init_delay'] ?>,
						directionNav: <?php echo $options['directionNav'] ?>,
						direction: '<?php echo $options['direction'] ?>'
					});
				});

			}

		})();
		 
	});
	
</script>


<?php if (!empty($slides)): ?>

	<?php
	$in_shortcode = false;
	if (isset($is_shortcode)) {
		$in_shortcode = true;
	}
	?>

	<div class="slider clearfix">

		<div <?php if (!$in_shortcode): ?>class="sixteen columns"<?php endif; ?>>

			<div class="flexslider" data-animation="<?php echo $options['animation'] ?>" data-slideshow="<?php echo ($options['slideshow'] ? 'true' : 'false') ?>" data-controlnav="<?php echo ($options['controlnav'] ? 'true' : 'false') ?>" data-slideshow_speed="<?php echo $options['slideshow_speed'] ?>" data-animation_speed="<?php echo $options['animation_speed'] ?>" data-init_delay="<?php echo $options['init_delay'] ?>" data-directionNav="<?php echo $options['directionNav'] ?>" data-direction="<?php echo $options['direction'] ?>">

				<ul class="slides">

					<?php foreach ($slides as $slide_num => $slide) : ?>

						<?php
						if (!isset($alias) OR empty($alias)) {
							$alias = "910*430";
						}
						//***
						$slide_url = TMM_Helper::get_image($slide['imgurl'], $alias);
						$slide_description_font_family = $slide['flex']['field_values']['description']['font_family'];
						$slide_description_font_size = $slide['flex']['field_values']['description']['font_size'];
						$slide_description_font_color = $slide['flex']['field_values']['description']['font_color'];

						$style = "";
						if (!empty($slide_description_font_family)) {
							$style.='font-family:' . $slide_description_font_family . ';';
						}

						if (!empty($slide_description_font_size)) {
							$style.='font-size:' . $slide_description_font_size . 'px;';
						}

						if (!empty($slide_description_font_color)) {
							$style.='color:' . $slide_description_font_color . ';';
						}
						?>

						<li>
							<img src="<?php echo $slide_url ?>" alt="" />

							<?php if (!empty($slide['flex']['description'])): ?>
								<div class="flex-caption">
									<?php if (!empty($slide['flex']['url'])): ?>
										<a href="<?php echo $slide['flex']['url'] ?>"><h4 <?php if (!empty($style)): ?>style="<?php echo $style ?>"<?php endif; ?>><?php echo $slide['flex']['description'] ?></h4></a>
									<?php else: ?>
										<h4 <?php if (!empty($style)): ?>style="<?php echo $style ?>"<?php endif; ?>><?php echo $slide['flex']['description'] ?></h4>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</li>

					<?php endforeach; ?>
				</ul>

			</div><!--/ .flexslider-->
			
		</div>
	</div>
<?php endif; ?>
