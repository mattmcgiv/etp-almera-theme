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

	<body <?php body_class(); ?>>            
       
        <div id="fb-root"></div>
            
		<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->
               
		<header id="header" <?php if ($_REQUEST['PAGE_ID'] > 0): ?><?php echo TMM_Helper::get_header_bg($_REQUEST['PAGE_ID']) ?><?php endif; ?>>

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
		if (is_post_type_archive() == TMM_Portfolio::$slug) {
			if (is_archive()) {
				$_REQUEST['sidebar_position'] = 'sbr';
				$sidebar_position = 'sbr';
			}
		}
		?>

		<!-- - - - - - - - - - - - - - - - Dynamic Content - - - - - - - - - - - - - - - - -->
                
		<div id="wrapper" class="<?php echo $sidebar_position ?>" <?php if ($_REQUEST['PAGE_ID'] > 0): ?>style="<?php echo TMM_Helper::get_page_backround($_REQUEST['PAGE_ID']) ?>"<?php endif; ?>>

			<div id="content">
				<!-- - - - - - - - - - - - - - Container - - - - - - - - - - - - - - - - -->

				<div class="container ajax">

					<?php
					$slider_html = "";
					if ($_REQUEST['PAGE_ID'] > 0 AND is_object($post)) {
						$slider_html = TMM_Ext_Sliders::draw_page_slider($_REQUEST['PAGE_ID']);
					}
					?>

					<?php if (empty($slider_html)): ?>
						<?php
						$page_title_status = 'show';
						if ($_REQUEST['PAGE_ID'] > 0 AND is_object($post)) {
							$page_title_status = get_post_meta($_REQUEST['PAGE_ID'], 'page_title_status', TRUE);
							if (!$page_title_status) {
								$page_title_status = 'show';
							}
						}
						?>
						<?php if ($page_title_status == 'show'): ?>
							<div class="page-header">
                                                            
								<?php if (is_404()): ?>
									<h1><?php _e("Page not Found", 'almera') ?></h1>
								<?php else: ?>

									<?php if (is_home()): ?>
										<h1><?php bloginfo('description'); ?></h1>
									<?php endif; ?>

									<?php if (is_single() OR is_page()): ?>                                                                               
										<h1 <?php echo ((strlen($post->post_title) > 23) ? "class='font-small'" : '') ?>><?php echo $post->post_title ?></h1>
                                                                                
                                                                                
									<?php endif; ?>

									<?php if (is_search()): ?>
										<h1><?php printf(__('Search Results for: %s', 'almera'), '<span>' . get_search_query() . '</span>'); ?></h1>
									<?php endif; ?>

									<?php if (is_tag()): ?>
										<h1><?php printf(__('Tag Archives: %s', 'almera'), '<span>' . single_tag_title('', false) . '</span>'); ?></h1>
									<?php endif; ?>

									<?php
									$queried_object = get_queried_object();
									$is_defined = false;
									?>

									<?php if (is_object($queried_object)): ?>
										<?php if ($queried_object->taxonomy == 'foliocat'): $is_defined = true; ?>
											<h1><?php printf(__('Folios by Categories: %s', 'almera'), '<span>' . $queried_object->name . '</span>'); ?></h1>
										<?php endif; ?>
									<?php endif; ?>


									<?php if (is_archive() AND !$is_defined): ?>

										<?php if (is_post_type_archive(TMM_Portfolio::$slug)): ?>
											<h1 class="page-title">
												<?php if (is_day()) : ?>
													<?php printf(__('Daily Portfolio Archives: %s', 'almera'), '<span>' . get_the_date() . '</span>'); ?>
												<?php elseif (is_month()) : ?>
													<?php printf(__('Monthly Portfolio Archives: %s', 'almera'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'almera')) . '</span>'); ?>
												<?php elseif (is_year()) : ?>
													<?php printf(__('Yearly Portfolio Archives: %s', 'almera'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'almera')) . '</span>'); ?>
												<?php else : ?>
													<?php _e('Portfolio Archives', 'almera'); ?>
												<?php endif; ?>
											</h1>

										<?php endif; ?>

										<?php if (is_object($queried_object)): ?>
											<?php if ($queried_object->taxonomy == 'category'):$is_defined = true; ?>
												<h1><?php printf(__('Category: %s', 'almera'), '<span>' . $queried_object->name . '</span>'); ?></h1>
											<?php endif; ?>
										<?php endif; ?>


										<?php if (is_post_type_archive() != TMM_Portfolio::$slug AND $is_defined == false AND !is_page()): ?>
											<h1 class="page-title">
												<?php if (is_day()) : ?>
													<?php printf(__('Daily Archives: %s', 'almera'), '<span>' . get_the_date() . '</span>'); ?>
												<?php elseif (is_month()) : ?>
													<?php printf(__('Monthly Archives: %s', 'almera'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'almera')) . '</span>'); ?>
												<?php elseif (is_year()) : ?>
													<?php printf(__('Yearly Archives: %s', 'almera'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'almera')) . '</span>'); ?>
												<?php else : ?>
													<?php _e('Blog Archives', 'almera'); ?>
												<?php endif; ?>
											</h1>

										<?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>

							</div><!--/ .page-header-->
						<?php endif; ?>
					<?php else: ?>
						<!-- - - - - - - - - - - - - Slider - - - - - - - - - - - - - - - -->

						<div class="slider">
							<?php echo $slider_html ?>
						</div>

						<!-- - - - - - - - - - - - - end Slider - - - - - - - - - - - - - - -->
					<?php endif; ?>


					<?php if ($_REQUEST['sidebar_position'] != 'no_sidebar'): ?><section class="twelve columns" id="main"><?php endif; ?>


