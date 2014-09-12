<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
/*
  Template Name: Folio Layout 3 (Fullscreen)
 */

get_header('folio');
?>

<div class="ajax">

	<div id="folio_images_area">
		<?php TMM_Portfolio::draw_home_layout(3); ?>
	</div>

</div><!--/ .ajax-->

<?php wp_reset_query(); ?>

<?php get_footer('folio'); ?>
