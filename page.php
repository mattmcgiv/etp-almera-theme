 <?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>

<!-- - - - - - - - - - - - Entry - - - - - - - - - - - - - - -->

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<div class="clear"></div>
		<?php
			TMM_Ext_LayoutConstructor::draw_front(get_the_ID());                  
                        
	endwhile;
endif;
?>

<!-- - - - - - - - - - - - end Entry - - - - - - - - - - - - - - -->

<?php get_footer(); ?>

