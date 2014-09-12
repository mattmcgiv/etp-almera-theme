<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php global $post; ?>

<?php if ( get_comments_number() != 0 ) : ?>

	<!-- - - - - - - - - - - - Post Comments - - - - - - - - - - - - - - -->

	<section id="comments">

		<h6 class="title"><?php echo get_comments_number() . " " . __('Comments', 'almera'); ?></h6>

		<?php paginate_comments_links() ?>

		<ol class="comments-list">
			<?php wp_list_comments('avatar_size=50&callback=tmk_comments'); ?>
		</ol>

		<?php paginate_comments_links() ?>

	</section><!--/ #comments-->

	<!-- - - - - - - - - - - end Post Comments - - - - - - - - - - - - - -->

<?php endif; ?>

<?php if (comments_open()) : ?>
	
	<!-- - - - - - - - - - - Comment Form - - - - - - - - - - - - - -->

	<?php comment_form(); ?>
	
	<!-- - - - - - - - - - end Comment Form - - - - - - - - - - - - -->

<?php endif; ?>

 <?php
if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments'))
	wp_enqueue_script('comment-reply');
?>
<input type="hidden" name="current_post_id" value="<?php echo $post->ID ?>" />
<input type="hidden" name="current_post_url" value="<?php echo get_permalink($post->ID) ?>" />
<input type="hidden" name="is_user_logged_in" value="<?php echo (is_user_logged_in() ? 1 : 0) ?>" />

