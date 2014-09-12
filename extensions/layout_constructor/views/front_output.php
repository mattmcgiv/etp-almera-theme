<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php foreach ($tmm_layout_constructor as $row => $row_data) : ?>
	<?php if (!empty($row_data)): ?>
		<?php foreach ($row_data as $uniqid => $column) : ?>
			<?php
			$content = str_replace('<p>', '__P__', $column['content']);
			$content = str_replace('</p>', '__CP__', $content);
			//$content = preg_replace('/^<p>|<\/p>$/', '', do_shortcode($content));
			$content = do_shortcode($content);
			//$content = str_replace('__CP__', '</p>', $content);
			$content = str_replace('__CP__', '', $content);
			$content = str_replace('__P__', '<p>', $content);			
			?>
			<div class="clearfix <?php echo @$column['effect'] ?> <?php echo $column['front_css_class'] ?>"><?php echo $content ?></div>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endforeach; ?>