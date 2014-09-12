<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
global $post;
$meta_title = "";
$meta_keywords = "";
$meta_description = "";


if (is_front_page()) {
	$meta_title = TMM::get_option("meta_title_home");
	$meta_keywords = TMM::get_option("meta_keywords_home");
	$meta_description = TMM::get_option("meta_description_home");
} else {
	if (is_single() OR is_page()) {
		$custom = get_post_custom($post->ID);
		$meta_title = @$custom["meta_title"][0];
		$meta_keywords = @$custom["meta_keywords"][0];
		$meta_description = @$custom["meta_description"][0];
	} else {

		if (is_object($post)) {
			switch ($post->post_type) {
				case 'post':
					$meta_title = TMM::get_option("meta_title_post_listing");
					$meta_keywords = TMM::get_option("meta_keywords_post_listing");
					$meta_description = TMM::get_option("meta_description_post_listing");
					break;
				case TMM_Portfolio::$slug:
					$meta_title = TMM::get_option("meta_title_portfolio_listing");
					$meta_keywords = TMM::get_option("meta_keywords_portfolio_listing");
					$meta_description = TMM::get_option("meta_description_portfolio_listing");
					break;
				case TMM_Gallery::$slug:
					$meta_title = TMM::get_option("meta_title_gallery_listing");
					$meta_keywords = TMM::get_option("meta_keywords_gallery_listing");
					$meta_description = TMM::get_option("meta_description_gallery_listing");
					break;

				default:
					break;
			}
		}

		//***
		global $cat;
		$cat_head_seo_data = TMM_SEO_Group::get_cat_head_seo_data($cat);
		if (!empty($cat_head_seo_data['meta_title'])) {
			$meta_title = $cat_head_seo_data['meta_title'];
			$meta_keywords = $cat_head_seo_data['meta_keywords'];
			$meta_description = $cat_head_seo_data['meta_description'];
		}
	}
}
?>
<title><?php if (empty($meta_title)): ?><?php echo get_bloginfo('name', 'display') ?> <?php wp_title(); ?><?php else: ?><?php echo get_bloginfo('name', 'display') ?> &raquo; <?php echo($meta_title); ?><?php endif; ?></title>

<?php if (!empty($meta_keywords)): ?>
	<META NAME="keywords" CONTENT="<?php echo htmlspecialchars($meta_keywords, ENT_QUOTES) ?>">
<?php endif; ?>
<?php if (!empty($meta_description)): ?>
	<META NAME="Description" CONTENT="<?php echo htmlspecialchars($meta_description, ENT_QUOTES) ?>">
<?php endif; ?>
