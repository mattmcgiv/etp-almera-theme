<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<!DOCTYPE html>
<!--[if lte IE 8]>              <html class="ie8 no-js" <?php language_attributes(); ?>>     <![endif]-->
<!--[if IE 9]>					<html class="ie9 no-js" <?php language_attributes(); ?>>     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" <?php language_attributes(); ?>>  <!--<![endif]-->
	<head>
		<?php get_template_part('header', 'seocode'); ?>
		<!-- Google Web Fonts
	  ================================================== -->
		<?php echo TMM_HelperFonts::get_google_fonts_link() ?>

		<!-- Basic Page Needs
	  ================================================== -->
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<!--[if ie]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<?php
		$favicon = TMM::get_option("favicon_img");
		if ($favicon) :
			?>
			<link href="<?php echo $favicon; ?>" rel="icon" type="image/x-icon" />
		<?php else: ?>
			<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" type="image/x-icon" />
		<?php endif; ?>

		<!-- Mobile Specific Metas
	  ================================================== -->

		<?php if (!isset($content_width)) $content_width = 960; ?>

		<!-- Mobile Specific Metas
	  ================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url') ?>" />

		<!-- CSS
	  ================================================== -->
		
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<?php wp_head(); ?>		

	</head>
	
	<?php echo TMM::get_option("tracking_code"); ?>
	<?php
	$_REQUEST['PAGE_ID'] = 0;
	if (is_single() OR is_page() OR is_front_page()) {
		global $post;
		$_REQUEST['PAGE_ID'] = $post->ID;
	}
	?>
	
	<body <?php body_class(); ?> <?php if ($_REQUEST['PAGE_ID'] > 0): ?>style="<?php echo TMM_Helper::get_page_backround($_REQUEST['PAGE_ID']) ?>"<?php endif; ?>>

		<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->	

		<header id="header">

			<div class="container">

				<div class="sixteen columns">

					<div id="logo">
						
						<?php
						$logo_type = TMM::get_option("logo_type");
						$logo_text = TMM::get_option("logo_text");
						$logo_img = TMM::get_option("logo_img");

						if (!$logo_type AND $logo_text) {
							
						?>
							<h1><a title="<?php bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><?php echo $logo_text; ?></a></h1>
						<?php } else if ($logo_type AND $logo_img) { ?>
							<a title="<?php bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><img src="<?php echo $logo_img; ?>" alt="<?php bloginfo('description'); ?>" /></a>
						<?php } else { ?>
							<h1><a title="<?php bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
						<?php } ?>
							
					</div>

					<nav id="navigation" class="navigation">

						<?php wp_nav_menu(array('theme_location' => 'primary', 'container_class' => false)); ?>

					</nav><!--/ #navigation-->	

				</div><!--/ .columns-->

			</div><!--/ .container-->

		</header><!--/ #header-->

		<!-- - - - - - - - - - - - - - end Header - - - - - - - - - - - - - - - - -->	


		<!-- - - - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->	
		<?php
		$sidebar_position = "sbr";

		$_REQUEST['sidebar_position'] = $sidebar_position;

		if (is_single() AND $post->post_type == TMM_Portfolio::$slug) {
			$_REQUEST['sidebar_position'] = 'no_sidebar';
			$sidebar_position = 'no_sidebar';
		} else {

			$page_sidebar_position = "default";

			if (!is_404()) {
				if (is_single() OR is_page()) {
					$page_sidebar_position = get_post_meta(get_the_ID(), 'page_sidebar_position', TRUE);
				}

				if (!empty($page_sidebar_position) AND $page_sidebar_position != 'default') {
					$sidebar_position = $page_sidebar_position;
				} else {
					$sidebar_position = TMM::get_option("sidebar_position");
				}

				if (!$sidebar_position) {
					$sidebar_position = "sbr";
				}

				//*****
			} else {
				$sidebar_position = 'no_sidebar';
			}
		}


		//***
		//is portfolio archive
		if (is_archive()) {
			if (is_post_type_archive(TMM_Portfolio::$slug)) {
				$sidebar_position = TMM::get_option('folio_archive_sidebar');
				if (empty($sidebar_position)) {
					$sidebar_position = 'no_sidebar';
				}
			}
		}

		$_REQUEST['sidebar_position'] = $sidebar_position;
		?>

		<!-- - - - - - - - - - - - - - - - Dynamic Content - - - - - - - - - - - - - - - - -->	

		<div id="wrapper" class="<?php echo $sidebar_position ?>">

			<div id="content">



