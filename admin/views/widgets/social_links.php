<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_social clearfix">
	<?php if ($instance['title'] != '') : ?>
		<h3 class="widget-title"><?php echo $instance['title']; ?></h3>
	<?php endif; ?>


    <ul class="social-icons clearfix">
		
		<?php if ($instance['twitter_links'] != '') { ?>
			<li class="twitter">
				<a title="<?php echo $instance['twitter_tooltip']; ?>" target="_blank" href="<?php echo $instance['twitter_links']; ?>"><span><?php echo $instance['twitter_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['facebook_links'] != '') { ?>
			<li class="facebook">
				<a title="<?php echo $instance['facebook_tooltip']; ?>" target="_blank" href="<?php echo $instance['facebook_links']; ?>"><span><?php echo $instance['facebook_tooltip']; ?></span></a>
			</li>
		<?php } ?>
			
		<?php if ($instance['dribbble_links'] != '') { ?>
			<li class="dribble">
				<a title="<?php echo $instance['dribbble_tooltip']; ?>" target="_blank" href="<?php echo $instance['dribbble_links']; ?>"><span><?php echo $instance['dribbble_tooltip']; ?></span></a>
			</li>
		<?php } ?>	
			
		<?php if ($instance['vimeo_links'] != '') { ?>
			<li class="vimeo">
				<a title="<?php echo $instance['vimeo_tooltip']; ?>" target="_blank" href="<?php echo $instance['vimeo_links']; ?>"><span><?php echo $instance['vimeo_tooltip']; ?></span></a>
			</li>
		<?php } ?>	
			
		<?php if ($instance['youtube_links'] != '') { ?>
			<li class="youtube">
				<a title="<?php echo $instance['youtube_tooltip']; ?>" target="_blank" href="<?php echo $instance['youtube_links']; ?>"><span><?php echo $instance['youtube_tooltip']; ?></span></a>
			</li>
		<?php } ?>
			
		<?php if ($instance['picasa_links'] != '') { ?>
			<li class="picasa">
				<a title="<?php echo $instance['picasa_tooltip']; ?>" target="_blank" href="<?php echo $instance['picasa_links']; ?>"><span><?php echo $instance['picasa_tooltip']; ?></span></a>
			</li>
		<?php } ?>
			
		<?php if ($instance['instagram_links'] != '') { ?>
			<li class="instagram">
				<a title="<?php echo $instance['instagram_tooltip']; ?>" target="_blank" href="<?php echo $instance['instagram_links']; ?>"><span><?php echo $instance['instagram_tooltip']; ?></span></a>
			</li>
		<?php } ?>
			
		<?php if ($instance['skype_links'] != '') { ?>
			<li class="skype">
				<a title="<?php echo $instance['skype_tooltip']; ?>" target="_blank" href="<?php echo $instance['skype_links']; ?>"><span><?php echo $instance['skype_tooltip']; ?></span></a>
			</li>
		<?php } ?>
			
		<?php if ($instance['dropbox_links'] != '') { ?>
			<li class="dropbox">
				<a title="<?php echo $instance['dropbox_tooltip']; ?>" target="_blank" href="<?php echo $instance['dropbox_links']; ?>"><span><?php echo $instance['dropbox_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['linkedin_links'] != '') { ?>
			<li class="linkedin">
				<a title="<?php echo $instance['linkedin_tooltip']; ?>" target="_blank" href="<?php echo $instance['linkedin_links']; ?>"><span><?php echo $instance['linkedin_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['pinterest_links'] != '') { ?>
			<li class="pinterest">
				<a title="<?php echo $instance['pinterest_tooltip']; ?>" target="_blank" href="<?php echo $instance['pinterest_links']; ?>"><span><?php echo $instance['pinterest_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['blogger_links'] != '') { ?>
			<li class="blogger">
				<a title="<?php echo $instance['blogger_tooltip']; ?>" target="_blank" href="<?php echo $instance['blogger_links']; ?>"><span><?php echo $instance['blogger_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['flickr_links'] != '') { ?>
			<li class="flickr">
				<a title="<?php echo $instance['flickr_tooltip']; ?>" target="_blank" href="<?php echo $instance['flickr_links']; ?>"><span><?php echo $instance['flickr_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['delicious_links'] != '') { ?>
			<li class="delicious">
				<a title="<?php echo $instance['delicious_tooltip']; ?>" target="_blank" href="<?php echo $instance['delicious_links']; ?>"><span><?php echo $instance['delicious_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['yahoo_links'] != '') { ?>
			<li class="yahoo">
				<a title="<?php echo $instance['yahoo_tooltip']; ?>" target="_blank" href="<?php echo $instance['yahoo_links']; ?>"><span><?php echo $instance['yahoo_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['evernote_links'] != '') { ?>
			<li class="evernote">
				<a title="<?php echo $instance['evernote_tooltip']; ?>" target="_blank" href="<?php echo $instance['evernote_links']; ?>"><span><?php echo $instance['evernote_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['behance_links'] != '') { ?>
			<li class="behance">
				<a title="<?php echo $instance['behance_tooltip']; ?>" target="_blank" href="<?php echo $instance['behance_links']; ?>"><span><?php echo $instance['behance_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['gplus_links'] != '') { ?>
			<li class="gplus">
				<a title="<?php echo $instance['gplus_tooltip']; ?>" target="_blank" href="<?php echo $instance['gplus_links']; ?>"><span><?php echo $instance['gplus_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['digg_links'] != '') { ?>
			<li class="digg">
				<a title="<?php echo $instance['digg_tooltip']; ?>" target="_blank" href="<?php echo $instance['digg_links']; ?>"><span><?php echo $instance['digg_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['myspace_links'] != '') { ?>
			<li class="myspace">
				<a title="<?php echo $instance['myspace_tooltip']; ?>" target="_blank" href="<?php echo $instance['myspace_links']; ?>"><span><?php echo $instance['myspace_tooltip']; ?></span></a>
			</li>
		<?php } ?>

		<?php if ($instance['show_rss_tooltip'] == 'true') { ?>
			<li class="rss">
				<a title="<?php echo $instance['rss_tooltip']; ?>" href="<?php bloginfo('rss2_url'); ?>">
					<span>RSS</span>
				</a>
			</li>
		<?php } ?>


    </ul><!--/ .social-list-->		

</div><!--/ .widget_social-->

