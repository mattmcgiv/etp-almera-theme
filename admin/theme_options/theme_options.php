<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$form_constructor = new TMM_Contact_Form('contacts_form');
$form_constructor->options_description = array(
    "form_title" => array(__("Form Title", 'almera'), "input"),
    "field_type" => array(__("Field Type", 'almera'), "select"),
    "form_label" => array(__("Field Label", 'almera'), "input"),
    "enable_captcha" => array(__("Enable Captcha", 'almera'), "checkbox")
);
//*****
$google_fonts = TMM_HelperFonts::get_google_fonts();
$content_fonts = TMM_HelperFonts::get_content_fonts();
$fonts = array_merge($content_fonts, $google_fonts);
$fonts = array_merge(array("" => ""), $fonts);
//*****
$sidebars = TMM::get_option('sidebars');
//*****
$contact_forms = TMM::get_option('contact_form');
//*****
$seo_groups = TMM::get_option('seo_groups');
if (is_string($seo_groups) AND !empty($seo_groups)) {
    $seo_groups = unserialize($seo_groups);
}
?>

<script type="text/javascript">
    var tmm_options_reset_array = [
        "logo_font",
        "logo_text_color",
        "logo_font_size",
        "general_elements",
        "general_font_family",
        "general_font_size",
        "general_text_color",
        "general_normal_links_color",
        "general_header_bg_color",
        "general_footer_bg_color",
        "body_pattern_selected",
        "body_pattern_custom_color",
        "page_header_divider_color",
        "page_footer_divider_color",
        "content_divider_color",
        "h1_font_family",
        "h1_font_size",
        "h1_font_color",
        "h1_normal_link_color",
        "h1_mouseover_link_color",
        "h2_font_family",
        "h2_font_size",
        "h2_font_color",
        "h2_normal_link_color",
        "h2_mouseover_link_color",
        "h3_font_family",
        "h3_font_size",
        "h3_font_color",
        "h3_normal_link_color",
        "h3_mouseover_link_color",
        "h4_font_family",
        "h4_font_size",
        "h4_font_color",
        "h4_normal_link_color",
        "h4_mouseover_link_color",
        "h5_font_family",
        "h5_font_size",
        "h5_font_color",
        "h5_normal_link_color",
        "h5_mouseover_link_color",
        "h6_font_family",
        "h6_font_size",
        "h6_font_color",
        "h6_normal_link_color",
        "h6_mouseover_link_color",
        "main_nav_font",
        "main_nav_first_level_font_size",
        "main_nav_second_level_font_size",
        "main_nav_def_text_color",
        "main_nav_curr_text_color",
        "main_nav_hover_text_color",
        "main_nav_dd_def_text_color",
        "main_nav_dd_curr_text_color",
        "main_nav_dd_hover_text_color",
        "main_nav_dd_bg_links_color",
        "main_nav_dd_border_color",
        "main_nav_line_color",
        "page_header_text_color",
        "blog_year_bg_color",
        "blog_title_color",
        "pagenavi_links_bg_color",
        "pagenavi_links_color",
        "pagenavi_active_link_bg_color",
        "pagenavi_active_link_color",
        "comments_title_color",
        "comments_author_color",
        "folio_nav_link_color",
        "folio_nav_link_hover_color",
        "folio_nav_link_cur_color",
        "folio_cap_bg_color",
        "folio_scroll_color",
        "folio_scroll_bg_color",
        "gallery_filter_link_color",
        "gallery_filter_bg_color",
        "gallery_filter_div_color",
        "gallery_cap_bg_color",
        "albums_frame_color",
        "albums_title_color",
        "albums_title_count_color",
        "albums_title_bg_count_color",
        "social_links_bg_color",
        "controls_color",
        "controls_bg_color",
        "controls_hover_color",
        "inputs_bg_color",
        "inputs_border_color",
        "inputs_focus_border_color",
        "toggle_links_color",
        "tabs_bg_color",
        "tabs_link_color",
        "tabs_active_link_color",
        "blockquote_bg_color",
        "blockquote_text_color",
        "list_icons_color",
        "error_box_text_color",
        "error_box_bg_color",
        "error_box_frame_color",
        "success_box_text_color",
        "success_box_bg_color",
        "success_box_frame_color",
        "notice_box_text_color",
        "notice_box_bg_color",
        "notice_box_frame_color",
        "info_box_text_color",
        "info_box_bg_color",
        "info_box_frame_color",
        "buttons_font_family",
        "buttons_font_size",
        "buttons_bg_color",
        "buttons_text_color",
        "buttons_hover_bg_color",
        "buttons_hover_text_color",
        "widget_title_color",
        "widget_title_first_color",
        "widget_link_color",
        "image_brd_width",
        "sb_image_brd_width",
        "image_brd_color",
        "image_brd_hover_color",
        "dark"

    ];</script>
<?php if (true): ?>
    <form id="theme_options" name="theme_options" method="post" style="display: none;">
        <div id="tm">

            <section class="admin-container clearfix">

                <header id="title-bar" class="clearfix">

                    <a href="#" class="admin-logo"></a>
                    <span class="fw-version">framework v.<?php echo TMM_FRAMEWORK_VERSION ?></span>

                    <div class="clear"></div>

                </header><!--/ #title-bar-->

                <section class="set-holder clearfix">

                    <ul class="support-links">
                        <li><a class="support-docs" href="<?php echo TMM_THEME_LINK ?>" target="_blank"><?php _e('View Theme Docs', 'almera'); ?></a></li>
                        <li><a class="support-forum" href="<?php echo TMM_THEME_FORUM_LINK ?>" target="_blank"><?php _e('Visit Forum', 'almera'); ?></a></li>
                    </ul><!--/ .support-links-->

                    <div class="button-options">
                        <a href="#" class="admin-button button-small button-yellow button_reset_options"><?php _e('Reset All Options', 'almera'); ?></a>
                        <a href="#" class="admin-button button-small button-yellow button_save_options"><?php _e('Save All Changes', 'almera'); ?></a>
                    </div><!--/ .button-options-->

                </section><!--/ .set-holder-->

                <aside id="admin-aside">

                    <ul class="admin-nav">
                        <li>
                            <a class="shortcut-options" href="#general"><?php _e('General', 'almera'); ?></a>
                        </li>
                        <li>
                            <a class="shortcut-styling" href="#styling_general"><?php _e('Styling', 'almera'); ?></a>
                            <ul>
                                <li><a href="#styling_general"><?php _e('General', 'almera'); ?></a></li>
                                <li><a href="#styling_headings"><?php _e('Headings', 'almera'); ?></a></li>
                                <li><a href="#styling_main_navigation"><?php _e('Main Navigation', 'almera'); ?></a></li>
                                <li><a href="#styling_pages"><?php _e('Pages', 'almera'); ?></a></li>
                                <li><a href="#styling_buttons"><?php _e('Buttons', 'almera'); ?></a></li>
                                <li><a href="#styling_widgets"><?php _e('Widgets', 'almera'); ?></a></li>
                            </ul>
                        </li>
                        <?php $slider_types = TMM_Ext_Sliders::get_slider_types(); ?>
                        <li>
                            <?php
                            if (isset($slider_types['layerslider'])) {
                                unset($slider_types['layerslider']);
                            }
                            $first_slider_key = array_keys($slider_types);
                            ?>
                            <a class="shortcut-slider" href="#tab_slider_<?php echo reset($first_slider_key) ?>">
                                <?php _e('Sliders Settings', 'almera'); ?>
                            </a>
                            <ul>
                                <?php if (!empty($slider_types)): ?>
                                    <?php foreach ($slider_types as $slider_key => $slider_name): ?>
                                        <?php
                                        if ($slider_key == 'layerslider') {
                                            continue;
                                        }
                                        ?>
                                        <li><a href="#tab_slider_<?php echo $slider_key ?>"><?php echo $slider_name ?></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </li>

                        <li><a class="shortcut-blog" href="#blog"><?php _e('Blog/News', 'almera'); ?></a></li>
                        <li><a class="shortcut-portfolio" href="#portfolio"><?php _e('Portfolio', 'almera'); ?></a></li>
                        <li><a class="shortcut-contact" href="#contact_forms_tab"><?php _e('Contact Forms', 'almera'); ?></a>
                            <ul class="contact_forms_groups_list">
                                <li><a href="#contact_forms_tab" class="contact_page_nav_link"><?php _e('Add Form', 'almera'); ?></a></li>
                                <?php
                                if (is_string($contact_forms) AND !empty($contact_forms)) {
                                    $contact_forms = unserialize($contact_forms);
                                }
                                ?>
                                <?php if (!empty($contact_forms) AND is_array($contact_forms)): ?>
                                    <?php $counter = 0; ?>
                                    <?php foreach ($contact_forms as $contact_form_id => $contact_form) : ?>
                                        <li style="display: none"><a href="#contact_form_<?php echo $counter; ?>"><?php echo $contact_form['title']; ?></a></li>
                                        <?php $counter++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </li>

                        <li><a class="shortcut-sidebar" href="#custom_sidebars_tab"><?php _e('Custom Sidebars', 'almera'); ?></a>
                            <ul class="custom_sidebars_list">
                                <li><a href="#custom_sidebars_tab" class="custom_sidebars_list_nav_link"><?php _e('General', 'almera'); ?></a></li>
                                <?php
                                if (is_string($sidebars) AND !empty($sidebars)) {
                                    $sidebars = unserialize($sidebars);
                                }
                                ?>
                                <?php if (!empty($sidebars) AND is_array($sidebars)): ?>
                                    <?php foreach ($sidebars as $sidebar_id => $sidebar) : ?>
                                        <li style="display: none"><a href="#<?php echo $sidebar_id; ?>"><?php echo $sidebar['name']; ?></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li><a class="shortcut-seo" href="#seo_tools">
                                <?php _e('SEO Tools', 'almera'); ?></a>
                            <ul class="seo_groups_list">
                                <li><a class="shortcut-footer" href="#seo_tools"><?php _e('General', 'almera'); ?></a></li>
                                <li><a class="shortcut-footer seo_groups_nav_link" href="#seo_groups_tab"><?php _e('SEO Groups', 'almera'); ?></a></li>

                                <?php if (!empty($seo_groups) AND is_array($seo_groups)): ?>
                                    <?php foreach ($seo_groups as $group_id => $seo_group) : ?>
                                        <?php if ($group_id): ?>
                                            <li style="display: none;"><a href="#<?php echo $group_id; ?>"><?php echo $seo_group['name']; ?></a></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li><a class="shortcut-footer" href="#footer"><?php _e('Footer', 'almera'); ?></a></li>
                        <?php if (is_plugin_active('tmm_db_migrate/index.php')) { ?> 
                            <li><a class="shortcut-footer" href="#tmm_db_migrate"><?php _e('TM DB Migrate', 'almera'); ?></a></li>
                        <?php } ?>
                    </ul><!--/ .admin-nav-->

                </aside><!--/ #admin-aside-->

                <section id="admin-content" class="clearfix">

                    <div class="tab-content" id="general">
                        <h1><?php _e('General Settings', 'almera'); ?></h1>


                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'enable_ajax',
                            'type' => 'checkbox',
                            'default_value' => 0,
                            'title' => __('Enable Ajax', 'almera'),
                            'description' => __('If checked, ajax version will be activated', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'add_hash',
                            'type' => 'checkbox',
                            'default_value' => 0,
                            'title' => __('Replace hash in address bar', 'almera'),
                            'description' => __('', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Website Logo &amp; Favicon', 'almera'); ?></h2>
                        <h3><?php _e('Website Favicon', 'almera'); ?></h3>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'favicon_img',
                            'type' => 'upload',
                            'default_value' => TMM_THEME_URI . '/favicon.ico',
                            'description' => __('Upload your favicon here. It will appear in your browser\'s address bar as per example below. Recommended dimensions: 16x16. Recommended image types: png, ico.', 'almera'),
                            'id' => '',
                        ));
                        ?>

                        <?php $favicon = TMM::get_option('favicon_img'); ?>
                        <div class="favicon_sample"><img id="favicon_preview_image" class="favicon" src="<?php echo(!empty($favicon)) ? $favicon : TMM_THEME_URI . '/favicon.ico' ?>" alt="favicon" /></div>

                        <hr />

                        <h3><?php _e('Website Logo', 'almera'); ?></h3>
                        <ul>
                            <li>
                                <input id="logoimage" type="radio" name="logo_type" value="1" <?php echo(TMM::get_option('logo_type') ? "checked" : "") ?> /><label for="logoimage"><span></span><?php _e('Image', 'almera'); ?></label>&nbsp; &nbsp;
                                <input id="logotext" type="radio" name="logo_type" value="0" <?php echo(!TMM::get_option('logo_type') ? "checked" : "") ?> /><label for="logotext"><span></span><?php _e('Text', 'almera'); ?></label>
                                <br /><br />
                            </li>
                            <li class="logo_img" <?php echo (TMM::get_option('logo_type') ? "" : 'style="display:none;"') ?>>
                                <?php
                                TMM_OptionsHelper::draw_theme_option(array(
                                    'name' => 'logo_img',
                                    'type' => 'upload',
                                    'default_value' => '',
                                    'description' => __('Upload your logo image here. Recommended dimensions: width <= 300px, height = any. Recommended image types: png, gif, jpg.', 'almera'),
                                    'id' => '',
                                ));
                                ?>

                                <?php $logo_img = TMM::get_option('logo_img') ?>
                                <img id="logo_preview_image" style="display: <?php if ($logo_img): ?>inline<?php else: ?>none<?php endif; ?>; max-width:300px;" src="<?php echo $logo_img ?>" alt="logo" />
                            </li>
                            <li class="logo_text" <?php echo(!TMM::get_option('logo_type') ? "" : 'style="display:none;"') ?>>
                                <?php
                                TMM_OptionsHelper::draw_theme_option(array(
                                    'name' => 'logo_text',
                                    'type' => 'text',
                                    'description' => __('Type your website name here, it will appear instead of your Logo in text format.', 'almera'),
                                    'default_value' => TMM_THEME_NAME,
                                    'css_class' => '',
                                ));
                                ?>
                                <?php
                                $logo_font_size = array();
                                for ($i = 12; $i < 65; $i++) {
                                    $logo_font_size[$i] = $i;
                                }
                                TMM_OptionsHelper::draw_theme_option(array(
                                    'name' => 'logo_font_size',
                                    'type' => 'select',
                                    'description' => '',
                                    'values' => $logo_font_size,
                                    'default_value' => 42,
                                    'css_class' => '',
                                ));
                                ?>

                                <h4><?php _e('Logo Font Family', 'almera'); ?></h4>
                                <?php
                                TMM_OptionsHelper::draw_theme_option(array(
                                    'name' => 'logo_font',
                                    'type' => 'google_font_select',
                                    'default_value' => 'Allura',
                                    'fonts' => $fonts,
                                ));
                                ?>

                                <h4><?php _e('Logo Text Color', 'almera'); ?></h4>
                                <?php
                                TMM_OptionsHelper::draw_theme_option(array(
                                    'name' => 'logo_text_color',
                                    'type' => 'color',
                                    'default_value' => '#ff8b84',
                                    'description' => __('Logo text color for text logo only. Do not edit this field to use default theme styling.', 'almera'),
                                    'css_class' => '',
                                ));
                                ?>
                            </li>
                        </ul>

                        <hr />

                        <h2><?php _e('Social Links', 'almera'); ?></h2>

                        <?php $admin_social_links = TMM::get_option('admin_social_links'); ?>

                        <?php
                        $admin_social_links_fields = array(
                            'twitter' => array(
                                'title' => 'Twitter Link',
                                'name' => 'twitter_social_icon',
                                'description' => __('Enter the Twitter Link', 'almera'),
                                'default_value' => 'https://twitter.com/'
                            ),
                            'facebook' => array(
                                'title' => 'Facebook Link',
                                'name' => 'facebook_social_icon',
                                'description' => __('Enter the Facebook Link', 'almera'),
                                'default_value' => 'https://www.facebook.com/',
                            ),
                            'dribbble' => array(
                                'title' => 'Dribble Link',
                                'name' => 'dribbble_social_icon',
                                'description' => __('Enter the Dribbble Link', 'almera'),
                                'default_value' => 'http://dribbble.com/',
                            ),
                            'vimeo' => array(
                                'title' => 'Vimeo Link',
                                'name' => 'vimeo_social_icon',
                                'description' => __('Enter the Vimeo Link', 'almera'),
                                'default_value' => 'https://vimeo.com/',
                            ),
                            'youtube' => array(
                                'title' => 'Youtube Link',
                                'name' => 'youtube_social_icon',
                                'description' => __('Enter the Youtube Link', 'almera'),
                                'default_value' => 'https://www.youtube.com/',
                            ),
                            'pinterest' => array(
                                'title' => 'Pinterest Link',
                                'name' => 'pinterest_social_icon',
                                'description' => __('Enter the Pinterest Link', 'almera'),
                                'default_value' => 'https://www.pinterest.com/',
                            ),
                            'instagram' => array(
                                'title' => 'Instagram Link',
                                'name' => 'instagram_social_icon',
                                'description' => __('Enter the Instagram Link', 'almera'),
                                'default_value' => 'http://instagram.com/',
                            ),
                            'linkedin' => array(
                                'title' => 'Linkedin Link',
                                'name' => 'linkedin_social_icon',
                                'description' => __('Enter the Linkedin Link', 'almera'),
                                'default_value' => 'http://www.linkedin.com/',
                            ),
                            'flickr' => array(
                                'title' => 'Flickr Link',
                                'name' => 'flickr_social_icon',
                                'description' => __('Enter the Flickr Link', 'almera'),
                                'default_value' => 'http://www.flickr.com/',
                            ),
                            'gplus' => array(
                                'title' => 'Google+ Link',
                                'name' => 'google_social_icon',
                                'description' => __('Enter the Google+ Link', 'almera'),
                                'default_value' => 'https://accounts.google.com',
                            ),
                            'behance' => array(
                                'title' => 'Behance Link',
                                'name' => 'behance_social_icon',
                                'description' => __('Enter the Behance Link', 'almera'),
                                'default_value' => 'http://www.behance.net/',
                            ),
                            'rss' => array(
                                'title' => 'Rss Link',
                                'name' => 'rss_icon',
                                'description' => __('Enter the Rss Feed', 'almera'),
                                'default_value' => 'feed',
                            )
                        );
                        ?>

                        <ul class="options_list_items admin_social_links">
                            <?php
                            if (!empty($admin_social_links)) {
                            
                                foreach ($admin_social_links as $key_id => $value) {
                                    ?>
                                    <li>
                                        <h4><?php echo $admin_social_links_fields[$key_id]['title'] ?></h4>                                                       
                                        <?php
                                        TMM_OptionsHelper::draw_theme_option(array(
                                            'name' => 'admin_social_links[' . $key_id . ']',
                                            'type' => 'text',
                                            'description' => $admin_social_links_fields[$key_id]['description'],
                                            'default_value' => $admin_social_links_fields[$key_id]['default_value'],
                                            'css_class' => '',
                                        ));
                                        ?>

                                    </li>                                                
                                    <?php
                                }
                            } else {
                                foreach ($admin_social_links_fields as $key => $value) {
                                    ?>
                                    <li>
                                        <h4><?php echo $value['title'] ?></h4>
                                        <?php
                                        TMM_OptionsHelper::draw_theme_option(array(
                                            'name' => 'admin_social_links[' . $key . ']',
                                            'type' => 'text',
                                            'description' => $value['description'],
                                            'default_value' => $value['default_value'],
                                            'css_class' => '',
                                        ));
                                        ?>

                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>

                        <hr>

                        <br />

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'hide_social_links',
                            'type' => 'checkbox',
                            'default_value' => 0,
                            'title' => __('Hide Social Links', 'almera'),
                            'description' => __('If checked, the social links area will be hidden for all the website.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Default Sidebar position', 'almera'); ?></h2>

                        <?php
                        $sidebar_position_selected = TMM::get_option('sidebar_position');
                        ?>
                        <?php $sidebar_position_selected = (!$sidebar_position_selected ? "sbr" : $sidebar_position_selected) ?>
                        <input type="hidden" value="<?php echo $sidebar_position_selected ?>" name="sidebar_position" />
                        <ul class="admin-choice-sidebar clearfix">
                            <li class="lside <?php echo ($sidebar_position_selected == "sbl" ? "current-item" : "") ?>"><a href="#" data-val="sbl"><?php _e('Left Sidebar', 'almera'); ?></a></li>
                            <li class="wside <?php echo ($sidebar_position_selected == "no_sidebar" ? "current-item" : "") ?>"><a href="#" data-val="no_sidebar"><?php _e('Without Sidebar', 'almera'); ?></a></li>
                            <li class="rside <?php echo ($sidebar_position_selected == "sbr" ? "current-item" : "") ?>"><a data-val="sbr" href="#"><?php _e('Right Sidebar', 'almera'); ?></a></li>
                        </ul>

                        <hr />



                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'hide_wp_image_sizes',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Disable Default Image Media Settings', 'almera'),
                            'description' => __('If checked, all the images you upload will not be cropped to default wordpress images sizes. We recommend to leave it as "checked".', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'hide_image_titles',
                            'type' => 'checkbox',
                            'default_value' => 0,
                            'title' => __('Hide Image Titles', 'almera'),
                            'description' => __('If checked, all the images will be displayed without attribute title. It also means that all images in fancybox will be displayed without captions.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Single Gallery', 'almera'); ?></h2>                


                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'gallery_show_recent_galleries',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show Recent Galleries', 'almera'),
                            'description' => __('Show Recent Galleries', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h4><?php _e('Tracking Code', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'tracking_code',
                            'type' => 'textarea',
                            'description' => __('Place here your Google Analytics (or other) tracking code. It will be inserted before closing body tag in your theme.', 'almera'),
                            'default_value' => '',
                            'css_class' => '',
                        ));
                        ?>												

                        <h4 style="display: none;"><?php _e('Item Purchase Code', 'almera'); ?></h4>
                        <?php
                        /*
                          ThememakersOptionsHelper::draw_theme_option(array(
                          'name' => 'buyer_envato_code',
                          'type' => 'text',
                          'description' => __('Item purchase code. It will be used for future free theme updates.', 'almera'),
                          'default_value' => '',
                          'css_class' => '',
                          ));
                         *
                         */
                        ?>					

                    </div>
                    <div class="tab-content" id="styling_general">
                        <h1><?php _e('General Styling', 'almera'); ?></h1>
                        <h2><?php _e('Skin Composer', 'almera'); ?></h2>

                        <div class="clearfix ">
                            <div class="admin-one-half">
                                <h4><?php _e('Create a new skin', 'almera'); ?></h4>
                                <p>
                                    <input type="text" id="new_color_scheme_name" class="middle" placeholder="Type here new skin name" />
                                    <a href="#" class="add-button" id="save_current_color_scheme" title="<?php _e('Create new skin', 'almera'); ?>"></a>
                                </p>
                            </div>
                            <div class="admin-one-half last">
                                <h4><?php _e('Color Mark', 'almera'); ?></h4>
                                <?php
                                TMM_OptionsHelper::draw_theme_option(array(
                                    'name' => '',
                                    'type' => 'color',
                                    'default_value' => '',
                                    'description' => __('New skin name', 'almera'),
                                    'css_class' => 'new_color_scheme_color',
                                    'hide_item_html' => 1,
                                    'placeholder' => __('#ffffff', 'almera')
                                ));
                                ?>
                            </div>
                        </div>

                        <h4><?php _e('Load Skin From', 'almera'); ?></h4>
                        <div class="clearfix ">
                            <div class="admin-one-half">
                                <?php $theme_schemes = TMM_Ext_Demo::get_theme_schemes(); ?>

                                <select id="color_schemes_select">
                                    <option value=""></option>
                                    <?php if (!empty($theme_schemes)): ?>
                                        <?php foreach ($theme_schemes as $value) : ?>
                                            <option data-color="<?php echo $value['color'] ?>" style="color: <?php echo $value['color'] ?>;" value="<?php echo $value['key'] ?>"><?php echo $value['name'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="admin-one-half last">
                                <a href="#" class="admin-button button-gray button-medium" id="upload_color_scheme"><?php _e('Load', 'almera'); ?></a>
                                &nbsp;
                                <a href="#" class="admin-button button-gray button-medium" id="edit_color_scheme"><?php _e('Modify', 'almera'); ?></a>
                                &nbsp;
                                <a href="#" class="admin-button button-gray button-medium" id="delete_color_scheme"><?php _e('Delete', 'almera'); ?></a>
                            </div>
                        </div>

                        <input type="hidden" data-default-value="0" value="0" name="dark">

                        <div class="clearfix">
                            <?php
                            TMM_OptionsHelper::draw_theme_option(array(
                                'name' => 'hide_layout_front_popup',
                                'type' => 'checkbox',
                                'default_value' => 0,
                                'title' => __('Hide Options panel', 'almera'),
                                'description' => __('Hide Theme Options sliding panel from Front End', 'almera'),
                                'css_class' => '',
                            ));
                            ?>
                        </div>

                        <hr/>

                        <h2><?php _e('Elements', 'almera'); ?></h2>
                        <h4><?php _e('Website Elements Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'general_elements',
                            'type' => 'color',
                            'default_value' => '#ff8b84',
                            'description' => __('General website elements color(Such elements like icons, some backgrounds etc.). Do not edit this field to use default theme styling.<br><b>Notice:</b> All the styles below may override this color if necessary.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Text', 'almera'); ?></h2>
                        <h4><?php _e('Website Font Family', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'general_font_family',
                            'type' => 'google_font_select',
                            'default_value' => 'Arial',
                            'fonts' => $fonts,
                        ));
                        ?>

                        <h4><?php _e('Website Font Size', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'general_font_size',
                            'type' => 'slider',
                            'description' => __('General website font size in pixels. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => 12,
                            'min' => 10,
                            'max' => 18,
                        ));
                        ?>

                        <h4><?php _e('Website Text Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'general_text_color',
                            'type' => 'color',
                            'default_value' => '#9f9f9f',
                            'description' => __('General website text color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Website Normal Links Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'general_normal_links_color',
                            'type' => 'color',
                            'default_value' => '#5A5D60',
                            'description' => __('General website normal links color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Backgrounds', 'almera'); ?></h2>
                        <div class="tmk_option select ">
                            <div class="options_custom_body_pattern">

                                <h4><?php _e('Website Header Background', 'almera'); ?></h4>
                                <?php
                                TMM_OptionsHelper::draw_theme_option(array(
                                    'name' => 'general_header_bg_color',
                                    'type' => 'color',
                                    'default_value' => '#ffffff',
                                    'description' => __('General website header background color (The top area where logo is located). Do not edit this field to use default theme styling.', 'almera'),
                                    'css_class' => '',
                                ));
                                ?>

                                <h4><?php _e('Website Footer Background', 'almera'); ?></h4>
                                <?php
                                TMM_OptionsHelper::draw_theme_option(array(
                                    'name' => 'general_footer_bg_color',
                                    'type' => 'color',
                                    'default_value' => '#fefefe',
                                    'description' => __('General website footer background color (The bottom area where  copyright info is located). Do not edit this field to use default theme styling.', 'almera'),
                                    'css_class' => '',
                                ));
                                ?>

                                <h4><?php _e('Website Background', 'almera'); ?></h4>
                                <?php
                                TMM_OptionsHelper::draw_theme_option(array(
                                    'name' => 'body_pattern_selected',
                                    'type' => 'select',
                                    'default_value' => 2,
                                    'values' => array(
                                        0 => __('Patterns', 'almera'),
                                        1 => __('Custom Background Image', 'almera'),
                                        2 => __('Background Color', 'almera'),
                                    ),
                                    'description' => __('General website background. Do not edit this field to use default theme styling.', 'almera'),
                                    'css_class' => '',
                                ));
                                ?>

                                <?php $body_pattern_selected = TMM::get_option('body_pattern_selected'); ?>
                                <ul>
                                    <li class="body_pattern_custom_color"<?php echo($body_pattern_selected == 2 ? "" : 'style="display:none;"') ?>>
                                        <?php
                                        TMM_OptionsHelper::draw_theme_option(array(
                                            'name' => 'body_pattern_custom_color',
                                            'type' => 'color',
                                            'default_value' => '#f8f8f8',
                                            'description' => __('General website background color behind your pattern image. Do not edit this field to use default theme styling.', 'almera'),
                                            'css_class' => '',
                                        ));
                                        ?>

                                    </li>
                                    <li class="body_pattern_default_image" <?php echo($body_pattern_selected == 0 ? "" : 'style="display:none;"') ?>>

                                        <?php
                                        $body_pattern = TMM::get_option('body_pattern');
                                        $result = array();
                                        $patterns_path = TMM_THEME_PATH . "/images/patterns/";
                                        $dir_handle = opendir($patterns_path); # Open the path
                                        while ($file = readdir($dir_handle)) {
                                            if (is_dir($file)) {
                                                continue;
                                            }
                                            $result[] = $file;
                                        }
                                        closedir($dir_handle);
                                        ?>
                                        <div class="thumb_pattern">
                                            <?php if (!empty($result)): ?>
                                                <?php foreach ($result as $key => $file_name) : ?>
                                                    <?php $img_path = TMM_THEME_URI . "/images/patterns/" . $file_name; ?>
                                                    <a class="thumb_thumb_<?php echo($key + 1) ?> <?php if ($img_path == $body_pattern) echo "current"; ?>" style="background: url(<?php echo $img_path ?>);" href="<?php echo $img_path ?>"></a>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="clear"></div>

                                        <br />

                                        <h4><?php _e('Pattern Background Color', 'almera'); ?></h4>
                                        <?php
                                        TMM_OptionsHelper::draw_theme_option(array(
                                            'name' => 'body_bg_color',
                                            'type' => 'color',
                                            'default_value' => '#ECECEC',
                                            'description' => __('General website background color behind your pattern image. Do not edit this field to use default theme styling.', 'almera'),
                                            'css_class' => '',
                                        ));
                                        ?>

                                    </li>
                                    <li class="body_pattern_custom_image"<?php echo($body_pattern_selected == 1 ? "" : 'style="display:none;"') ?>>
                                        <?php
                                        TMM_OptionsHelper::draw_theme_option(array(
                                            'name' => 'body_pattern',
                                            'type' => 'upload',
                                            'default_value' => '',
                                            'description' => '',
                                            'id' => 'body_pattern_upload'
                                        ));
                                        ?>

                                        <div id="body_pattern_custom_image_preview" <?php if (!$body_pattern OR $body_pattern_selected == 0): ?>style="display: none;"<?php endif; ?>>
                                            <img src="<?php echo $body_pattern; ?>" alt="" class="max_image_width" />
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="clear"></div>

                        <hr />

                        <!-- //////// -->
                        <h4><?php _e('Page Header Border Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'page_header_divider_color',
                            'type' => 'color',
                            'description' => __('General website header border color. Do not edit this field to use default theme styling', 'almera'),
                            'default_value' => '#EAEAEA',
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Page Footer Border Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'page_footer_divider_color',
                            'type' => 'color',
                            'description' => __('General website footer border color. Do not edit this field to use default theme styling', 'almera'),
                            'default_value' => '#EAEAEA',
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Content Divider Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'content_divider_color',
                            'type' => 'color',
                            'description' => __('General website content divider color. Do not edit this field to use default theme styling', 'almera'),
                            'default_value' => '#E1E1E1',
                            'css_class' => '',
                        ));
                        ?>
                        <!-- //////// -->                                             
                        <hr />

                        <h4><?php _e('Custom CSS Styles', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'custom_css',
                            'type' => 'textarea',
                            'description' => '',
                            'default_value' => '',
                            'css_class' => 'fullwidth',
                        ));
                        ?>
                    </div>
                    <div class="tab-content" id="styling_headings">

                        <h1><?php _e('Headings Styling', 'almera'); ?></h1>
                        <h2><?php _e('H1 Heading', 'almera'); ?></h2>
                        <h4><?php _e('Font Family', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h1_font_family',
                            'type' => 'google_font_select',
                            'default_value' => 'Oswald',
                            'fonts' => $fonts,
                        ));
                        ?>

                        <h4><?php _e('Font Size', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h1_font_size',
                            'type' => 'slider',
                            'description' => __('H1 heading font size in pixels. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => 40,
                            'min' => 35,
                            'max' => 50,
                        ));
                        ?>

                        <h4><?php _e('Font Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h1_font_color',
                            'type' => 'color',
                            'description' => __('H1 heading cont color. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#1d1e1f',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Normal Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h1_normal_link_color',
                            'type' => 'color',
                            'description' => __('A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#1d1e1f',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Mouseover Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h1_mouseover_link_color',
                            'type' => 'color',
                            'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#ff8b84',
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('H2 Heading', 'almera'); ?></h2>
                        <h4><?php _e('Font Family', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h2_font_family',
                            'type' => 'google_font_select',
                            'default_value' => 'Oswald',
                            'fonts' => $fonts,
                        ));
                        ?>

                        <h4><?php _e('Font Size', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h2_font_size',
                            'type' => 'slider',
                            'description' => __('H2 heading font size in pixels. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => 36,
                            'min' => 26,
                            'max' => 42,
                        ));
                        ?>

                        <h4><?php _e('Font Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h2_font_color',
                            'type' => 'color',
                            'description' => __('H2 heading cont color. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#1d1e1f',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Normal Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h2_normal_link_color',
                            'type' => 'color',
                            'description' => __('A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#1d1e1f',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Mouseover Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h2_mouseover_link_color',
                            'type' => 'color',
                            'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#ff8b84',
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('H3 Heading', 'almera'); ?></h2>
                        <h4><?php _e('Font Family', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h3_font_family',
                            'type' => 'google_font_select',
                            'default_value' => 'Oswald',
                            'fonts' => $fonts,
                        ));
                        ?>

                        <h4><?php _e('Font Size', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h3_font_size',
                            'type' => 'slider',
                            'description' => __('H3 heading font size in pixels. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => 24,
                            'min' => 16,
                            'max' => 36,
                        ));
                        ?>

                        <h4><?php _e('Font Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h3_font_color',
                            'type' => 'color',
                            'description' => __('H3 heading cont color. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#1d1e1f',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Normal Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h3_normal_link_color',
                            'type' => 'color',
                            'description' => __('A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#1d1e1f',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Mouseover Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h3_mouseover_link_color',
                            'type' => 'color',
                            'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#ff8b84',
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('H4 Heading', 'almera'); ?></h2>
                        <h4><?php _e('Font Family', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h4_font_family',
                            'type' => 'google_font_select',
                            'default_value' => 'Oswald',
                            'fonts' => $fonts,
                        ));
                        ?>

                        <h4><?php _e('Font Size', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h4_font_size',
                            'type' => 'slider',
                            'description' => __('H4 heading font size in pixels. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => 18,
                            'min' => 14,
                            'max' => 30,
                        ));
                        ?>

                        <h4><?php _e('Font Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h4_font_color',
                            'type' => 'color',
                            'description' => __('H4 heading cont color. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#1d1e1f',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Normal Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h4_normal_link_color',
                            'type' => 'color',
                            'description' => __('A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#1d1e1f',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Mouseover Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h4_mouseover_link_color',
                            'type' => 'color',
                            'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#ff8b84',
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('H5 Heading', 'almera'); ?></h2>
                        <h4><?php _e('Font Family', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h5_font_family',
                            'type' => 'google_font_select',
                            'default_value' => 'Oswald',
                            'fonts' => $fonts,
                        ));
                        ?>

                        <h4><?php _e('Font Size', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h5_font_size',
                            'type' => 'slider',
                            'description' => __('H5 heading font size in pixels. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => 16,
                            'min' => 12,
                            'max' => 24,
                        ));
                        ?>

                        <h4><?php _e('Font Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h5_font_color',
                            'type' => 'color',
                            'description' => __('H5 heading cont color. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#1d1e1f',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Normal Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h5_normal_link_color',
                            'type' => 'color',
                            'description' => __('A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#1d1e1f',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Mouseover Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h5_mouseover_link_color',
                            'type' => 'color',
                            'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#ff8b84',
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('H6 Heading', 'almera'); ?></h2>
                        <h4><?php _e('Font Family', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h6_font_family',
                            'type' => 'google_font_select',
                            'default_value' => 'Oswald',
                            'fonts' => $fonts,
                        ));
                        ?>

                        <h4><?php _e('Font Size', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h6_font_size',
                            'type' => 'slider',
                            'description' => __('H6 heading font size in pixels. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => 14,
                            'min' => 10,
                            'max' => 22,
                        ));
                        ?>

                        <h4><?php _e('Font Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h6_font_color',
                            'type' => 'color',
                            'description' => __('H6 heading cont color. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#1d1e1f',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Normal Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h6_normal_link_color',
                            'type' => 'color',
                            'description' => __('A normal, visited and unvisited link. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#1d1e1f',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Mouseover Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'h6_mouseover_link_color',
                            'type' => 'color',
                            'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => '#ff8b84',
                            'css_class' => '',
                        ));
                        ?>
                    </div>
                    <div class="tab-content" id="styling_main_navigation">

                        <h1><?php _e('Navigation Styling', 'almera'); ?></h1>
                        <h2><?php _e('General Styling', 'almera'); ?></h2>
                        <h4><?php _e('Font Family', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'main_nav_font',
                            'type' => 'google_font_select',
                            'default_value' => 'Oswald',
                            'fonts' => $fonts,
                        ));
                        ?>

                        <h4><?php _e('First Level\'s Font Size', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'main_nav_first_level_font_size',
                            'type' => 'slider',
                            'description' => __('Main navigation first level\'s font size in pixels. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => 12,
                            'min' => 10,
                            'max' => 14,
                        ));
                        ?>

                        <h4><?php _e('Second Level\'s Font Size', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'main_nav_second_level_font_size',
                            'type' => 'slider',
                            'description' => __('Main navigation seconds level\'s font size in pixels. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => 12,
                            'min' => 12,
                            'max' => 18,
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Links Color (First level)', 'almera'); ?></h2>
                        <h4><?php _e('Normal', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'main_nav_def_text_color',
                            'type' => 'color',
                            'default_value' => '#92999e',
                            'description' => __('A normal, visited and unvisited link color for main navigation. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Current', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'main_nav_curr_text_color',
                            'type' => 'color',
                            'default_value' => '#1b1d1f',
                            'description' => __('Current menu item\'s link color for main navigation. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Mouseover', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'main_nav_hover_text_color',
                            'type' => 'color',
                            'default_value' => '#1b1d1f',
                            'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Links Color (Second level)', 'almera'); ?></h2>
                        <h4><?php _e('Normal', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'main_nav_dd_def_text_color',
                            'type' => 'color',
                            'default_value' => '#92999e',
                            'description' => __('A normal, visited and unvisited link color for main navigation. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Current', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'main_nav_dd_curr_text_color',
                            'type' => 'color',
                            'default_value' => '#ff8b84',
                            'description' => __('Current menu item\'s link color for main navigation. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Mouseover', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'main_nav_dd_hover_text_color',
                            'type' => 'color',
                            'default_value' => '#ff8b84',
                            'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <!-- // -->

                        <h4><?php _e('Links Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'main_nav_dd_bg_links_color',
                            'type' => 'color',
                            'default_value' => '#ffffff',
                            'description' => __('Second level links background color. Do not edit this field to use default theme styling', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Navigation Border Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'main_nav_dd_border_color',
                            'type' => 'color',
                            'default_value' => '#ffffff',
                            'description' => __('Second level links navigation border color. Do not edit this field to use default theme styling', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <!-- // -->

                        <hr />

                        <h4><?php _e('Navigation Line Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'main_nav_line_color',
                            'type' => 'color',
                            'default_value' => '#ff8b84',
                            'description' => __('Navigation lava lamp line color', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                    </div>
                    <div class="tab-content" id="styling_pages">
                        <h1><?php _e('Pages Styling', 'almera'); ?></h1>
                        <h4><?php _e('Page Header Text Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'page_header_text_color',
                            'type' => 'color',
                            'default_value' => '#1D1E1F',
                            'description' => __('General page header text color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <hr />
                        <h2><?php _e('Blog Page Styling', 'almera'); ?></h2>
                        <h4><?php _e('Post Icon Year Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_year_bg_color',
                            'type' => 'color',
                            'default_value' => '#FFFFFF',
                            'description' => __('General post icons background color where year is set. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Blog Posts Title Text Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_title_color',
                            'type' => 'color',
                            'default_value' => '#1D1E1F',
                            'description' => __('General post title text color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Blog Page Pagination links background color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'pagenavi_links_bg_color',
                            'type' => 'color',
                            'default_value' => '#E1E3E4',
                            'description' => __('Pagination items/icons (1,2,3,4..) background color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Blog Page Pagination links color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'pagenavi_links_color',
                            'type' => 'color',
                            'default_value' => '#5A5D60',
                            'description' => __('Pagination links text color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Blog Page Pagination active links background color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'pagenavi_active_link_bg_color',
                            'type' => 'color',
                            'default_value' => '#FF8B84',
                            'description' => __('Pagination active links background color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Blog Page Pagination active links color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'pagenavi_active_link_color',
                            'type' => 'color',
                            'default_value' => '#FFFFFF',
                            'description' => __('Pagination active links color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Comment Box Title Text Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'comments_title_color',
                            'type' => 'color',
                            'default_value' => '#92999E',
                            'description' => __('Color of "Leave comment" titles text. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Author\'s Comments  text color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'comments_author_color',
                            'type' => 'color',
                            'default_value' => '#5A5D60',
                            'description' => __('Color of username text who added a comment. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <hr />
                        <h2><?php _e('Folio Styling', 'almera'); ?></h2>
                        <h4><?php _e('Folio Filtering Links Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_nav_link_color',
                            'type' => 'color',
                            'default_value' => '#92999E',
                            'description' => __('Categories navigation links title color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Folio Filtering Hover Links Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_nav_link_hover_color',
                            'type' => 'color',
                            'default_value' => '#FF8B84',
                            'description' => __('Categories navigation links title color by hovering. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>  
                        <h4><?php _e('Folio Filtering Current Links  Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_nav_link_cur_color',
                            'type' => 'color',
                            'default_value' => '#FF8B84',
                            'description' => __('Categories navigation current links title color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?> 

                        <h4><?php _e('Folio Title/Caption background color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_cap_bg_color',
                            'type' => 'color',
                            'default_value' => '#FFFFFF',
                            'description' => __('General Folio Titles Background color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Folio Scroll Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_scroll_color',
                            'type' => 'color',
                            'default_value' => '#FF8B84',
                            'description' => __('Folio Scrolling line color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Folio Scroll Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_scroll_bg_color',
                            'type' => 'color',
                            'default_value' => '#FFFFFF',
                            'description' => __('Folio scrolling line background color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>  
                        <hr />
                        <h2><?php _e('Gallery Styling', 'almera'); ?></h2>
                        <h4><?php _e('Gallery Filter Links Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'gallery_filter_link_color',
                            'type' => 'color',
                            'default_value' => '#ACB4B9',
                            'description' => __('Color of gallery categories links. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?> 
                        <h4><?php _e('Gallery Filter Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'gallery_filter_bg_color',
                            'type' => 'color',
                            'default_value' => '#FFFFFF',
                            'description' => __('Color of galleries links list background. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?> 
                        <h4><?php _e('Gallery Filter Divider Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'gallery_filter_div_color',
                            'type' => 'color',
                            'default_value' => '#F0F0F0',
                            'description' => __('Color of the lines between categories links list. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Galleries Title/Caption background color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'gallery_cap_bg_color',
                            'type' => 'color',
                            'default_value' => '#FFFFFF',
                            'description' => __('General Gallery Titles Background color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <hr />
                        <h2><?php _e('Albums Styling', 'almera'); ?></h2>
                        <h4><?php _e('Albums Frame Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'albums_frame_color',
                            'type' => 'color',
                            'default_value' => '#FFFFFF',
                            'description' => __('General albums frame and title background color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Albums Title Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'albums_title_color',
                            'type' => 'color',
                            'default_value' => '#333333',
                            'description' => __('General albums titles color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Albums Title Count Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'albums_title_count_color',
                            'type' => 'color',
                            'default_value' => '#AAAAAA',
                            'description' => __('General Title count color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Albums Title Background Count Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'albums_title_bg_count_color',
                            'type' => 'color',
                            'default_value' => '#F7F7F7',
                            'description' => __('General color of count background title. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <hr />

                        <h2><?php _e('Navigation Elements Styling', 'almera'); ?></h2>
                        <h4><?php _e('Navigation Elements Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'controls_color',
                            'type' => 'color',
                            'default_value' => '#DEDEDF',
                            'description' => __('General navigation elements color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Navigation Elements Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'controls_bg_color',
                            'type' => 'color',
                            'default_value' => '#FFFFFF',
                            'description' => __('General color of navigation elemnts background. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Navogation Elements Hover Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'controls_hover_color',
                            'type' => 'color',
                            'default_value' => '#ff8b84',
                            'description' => __('Color of navigation elemnts on hover. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <hr />

                        <h2><?php _e('Inputs Styling', 'almera'); ?></h2>
                        <h4><?php _e('Inputs Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'inputs_bg_color',
                            'type' => 'color',
                            'default_value' => '#FDFDFD',
                            'description' => __('General color of inputs background. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Inputs Border Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'inputs_border_color',
                            'type' => 'color',
                            'default_value' => '#E1E1E1',
                            'description' => __('General color of inputs border. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Inputs Focus Border Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'inputs_focus_border_color',
                            'type' => 'color',
                            'default_value' => '#B4B4B4',
                            'description' => __('General Inputs focus border color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <hr />

                        <h2><?php _e('Elements Styling', 'almera'); ?></h2>
                        <h4><?php _e('Social Links Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'social_links_bg_color',
                            'type' => 'color',
                            'default_value' => '#D4D4D4',
                            'description' => __('General color of social links background. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Toggles Links Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'toggle_links_color',
                            'type' => 'color',
                            'default_value' => '#92999E',
                            'description' => __('General toggles links text color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Tabs Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'tabs_bg_color',
                            'type' => 'color',
                            'default_value' => '#FFFFFF',
                            'description' => __('General tabs background color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Tabs Links Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'tabs_link_color',
                            'type' => 'color',
                            'default_value' => '#FFFFFF',
                            'description' => __('General tab links text color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Tabs Active Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'tabs_active_link_color',
                            'type' => 'color',
                            'default_value' => '#92999E',
                            'description' => __('General active tab links color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Blockquote Type_2 Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blockquote_bg_color',
                            'type' => 'color',
                            'default_value' => '#FFFFFF',
                            'description' => __('General background color of Blockquote Type_2. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Blockquote Type_2 Text Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blockquote_text_color',
                            'type' => 'color',
                            'default_value' => '#1D1E1F',
                            'description' => __('General text color of Blockquote Type_2. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('List Icons Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'list_icons_color',
                            'type' => 'color',
                            'default_value' => '#323232',
                            'description' => __('General color of icons list. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Error Box Text Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'error_box_text_color',
                            'type' => 'color',
                            'default_value' => '#B76973',
                            'description' => __('Color of Error messages text. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Error Box Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'error_box_bg_color',
                            'type' => 'color',
                            'default_value' => '#F4B7BE',
                            'description' => __('Background color of error box. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?> 
                        <h4><?php _e('Error Box Frame Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'error_box_frame_color',
                            'type' => 'color',
                            'default_value' => '#D67D88',
                            'description' => __('Color of error box borders. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?> 
                        <h4><?php _e('Success Box Text Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'success_box_text_color',
                            'type' => 'color',
                            'default_value' => '#79985B',
                            'description' => __('Color of Success messages text. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Success Box Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'success_box_bg_color',
                            'type' => 'color',
                            'default_value' => '#D3EABC',
                            'description' => __('Background color of success box. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?> 
                        <h4><?php _e('Successs Box Frame Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'success_box_frame_color',
                            'type' => 'color',
                            'default_value' => '#91B66D',
                            'description' => __('Color of success box borders. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Notice Box Text Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'notice_box_text_color',
                            'type' => 'color',
                            'default_value' => '#B49133',
                            'description' => __('Color of Notice messages text. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Notice Box Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'notice_box_bg_color',
                            'type' => 'color',
                            'default_value' => '#FAE6B2',
                            'description' => __('Background color of notice box. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?> 
                        <h4><?php _e('Notice Box Frame Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'notice_box_frame_color',
                            'type' => 'color',
                            'default_value' => '#D2B565',
                            'description' => __('Color of notice box borders. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Info Box Text Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'info_box_text_color',
                            'type' => 'color',
                            'default_value' => '#52889B',
                            'description' => __('Color of Info messages text. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <h4><?php _e('Info Box Background Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'info_box_bg_color',
                            'type' => 'color',
                            'default_value' => '#B3DDEC',
                            'description' => __('Background color of Info box. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?> 
                        <h4><?php _e('Info Box Frame Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'info_box_frame_color',
                            'type' => 'color',
                            'default_value' => '#7DA5B4',
                            'description' => __('Color of Info box borders. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                    </div>
                    <div class="tab-content" id="styling_buttons">

                        <h1><?php _e('Buttons Styling', 'almera'); ?></h1>
                        <h2><?php _e('General Styles', 'almera'); ?></h2>
                        <h4><?php _e('Font Family', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'buttons_font_family',
                            'type' => 'google_font_select',
                            'default_value' => 'Arial',
                            'fonts' => $fonts,
                        ));
                        ?>

                        <h4><?php _e('Font Size', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'buttons_font_size',
                            'type' => 'slider',
                            'description' => __('General buttons font size in pixels. Do not edit this field to use default theme styling.', 'almera'),
                            'default_value' => 12,
                            'min' => 10,
                            'max' => 15,
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Normal Color Styles', 'almera'); ?></h2>
                        <h4><?php _e('Text', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'buttons_text_color',
                            'type' => 'color',
                            'default_value' => '#ffffff',
                            'description' => __('A normal, visited and unvisited default button\'s text color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Background', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'buttons_bg_color',
                            'type' => 'color',
                            'default_value' => '#ff8b84',
                            'description' => __('A normal, visited and unvisited default button\'s background color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Mouseover Color Styles', 'almera'); ?></h2>

                        <h4><?php _e('Background', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'buttons_hover_bg_color',
                            'type' => 'color',
                            'default_value' => '#92999e',
                            'description' => __('Default button\'s background color when the user mouses over it. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                    </div>
                    <div class="tab-content" id="styling_widgets">

                        <h1><?php _e('Widgets Styling', 'almera'); ?></h1>
                        <h2><?php _e('Sidebar Widgets', 'almera'); ?></h2>
                        <h4><?php _e('Title Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'widget_title_color',
                            'type' => 'color',
                            'default_value' => '#92999e',
                            'description' => __('Widget\'s title text color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Normal Link Color', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'widget_link_color',
                            'type' => 'color',
                            'default_value' => '#9f9f9f',
                            'description' => __('A normal, visited and unvisited link color. Do not edit this field to use default theme styling.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                    </div>

                    <div class="tab-content">
                        <div class="options_slider_settings">
                            <?php echo TMM_Ext_Sliders::draw_sliders_options(); ?>
                        </div>
                    </div>

                    <?php if (!empty($slider_types)): ?>
                        <?php foreach ($slider_types as $slider_key => $slider_name): ?>
                            <div class="tab-content" id="tab_slider_<?php echo $slider_key ?>"><?php echo $slider_name ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="tab-content" id="blog">

                        <h1><?php _e('Blog/News', 'almera'); ?></h1>
                        <h2><?php _e('Listing Page', 'almera'); ?></h2>

                        <h4><?php _e('Excerpt Symbols Count', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'excerpt_symbols_count',
                            'type' => 'slider',
                            'description' => __('This option will excerpt full article content with a necessary amount of symbols on the blog listing page.', 'almera'),
                            'default_value' => 220,
                            'min' => 10,
                            'max' => 900,
                        ));
                        ?>

                        <h3><?php _e('Meta Data', 'almera'); ?></h3>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_listing_show_all_metadata',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide All Meta Info', 'almera'),
                            'description' => __('If checked, all the meta info will disappear under article title such as date, author, tags etc. This option will owerride the next separate four options.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_listing_show_date',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide Date Info', 'almera'),
                            'description' => __('If checked, the date info will appear under article title.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_listing_show_author',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide Author Info', 'almera'),
                            'description' => __('If checked, the author info will appear under article title.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_listing_show_tags',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide Tags Info', 'almera'),
                            'description' => __('If checked, the tags info will appear under article title.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_listing_show_category',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide Category Info', 'almera'),
                            'description' => __('If checked, the category info will appear under article title.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Single Page', 'almera'); ?></h2>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_single_show_comments',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide Comments', 'almera'),
                            'description' => __('If checked, all the visitors will be allowed to post their comments to articles.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_single_show_fb_comments',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide Facebook Comments', 'almera'),
                            'description' => __('If checked, all the visitors will be allowed to post Facebook comments to articles.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <h3><?php _e('Meta Data', 'almera'); ?></h3>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_single_show_all_metadata',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide All Meta Info', 'almera'),
                            'description' => __('If checked, all the meta info will disappear under article title such as date, author, tags etc. This option will owerride the next separate four options.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_single_show_date',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide Date Info', 'almera'),
                            'description' => __('If checked, the date info will appear under article title.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_single_show_author',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide Author Info', 'almera'),
                            'description' => __('If checked, the author info will appear under article title.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_single_show_tags',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide Tags Info', 'almera'),
                            'description' => __('If checked, the tags info will appear under article title.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'blog_single_show_category',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide Category Info', 'almera'),
                            'description' => __('If checked, the category info will appear under article title.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <hr />

                        <h2><?php _e('Single Page Social Share Buttons', 'almera'); ?></h2> 

                        <?php echo TMM::draw_html('page/page_social_likes', "single_page_social_likes"); ?> 



                    </div>

                    <div class="tab-content" id="portfolio">
                        <h1><?php _e('Portfolio', 'almera'); ?></h1>						

                        <h2><?php _e('Page templates', 'almera'); ?></h2>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_tpl_show_folios_bar',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show categories bar', 'almera'),
                            'description' => '',
                            'css_class' => '',
                        ));
                        ?>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_enable_scrolling_bar',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Enable scrolling bar', 'almera'),
                            'description' => '',
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Scrolling Speed', 'almera'); ?></h4>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_scrolling_speed',
                            'title' => 'Scrolling Speed',
                            'type' => 'slider',
                            'default_value' => 5,
                            'description' => __('Folio Scrolling Speed. Do not edit this field to use default theme styling.', 'almera'),
                            'min' => 1,
                            'max' => 10,
                        ));
                        ?>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_enable_slide_up_bar',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Enable Slide-Up Effect', 'almera'),
                            'description' => '',
                            'css_class' => '',
                        ));
                        ?>

                        <h3><?php _e('Home Template', 'almera'); ?> <span class="description"><?php _e('(Grid)', 'almera') ?></span></h3>						

                        <?php
                        $posts = get_posts(array('post_type' => TMM_Portfolio::$slug, 'numberposts' => -1));
                        $posts_array = array();
                        if (!empty($posts)) {
                            foreach ($posts as $value) {
                                $posts_array[$value->ID] = $value->post_title;
                            }
                        }
                        //***
                        $folio_template1_items = TMM::get_option('folio_template1_items');
                        ?>

                        <ul class="list-items options_list_items">
                            <?php if (!empty($folio_template1_items)): ?>
                                <?php foreach ($folio_template1_items as $folio_id) : ?>
                                    <li class="list_item">
                                        <table class="list-table">
                                            <tr>
                                                <td width="100%">
                                                    <?php
                                                    TMM_OptionsHelper::draw_theme_option(array(
                                                        'type' => 'select',
                                                        'title' => '',
                                                        'name' => 'folio_template1_items[]',
                                                        'shortcode_field' => 'folioposts',
                                                        'id' => '',
                                                        'values' => $posts_array,
                                                        'css_class' => '',
                                                        'default_value' => $folio_id,
                                                        'description' => '',
                                                        'hide_item_html' => 1
                                                    ));
                                                    ?>
                                                </td>
                                                <td>
                                                    <a class="button button-secondary js_delete_options_list_item" href="#"><?php _e('Remove', 'almera'); ?></a>
                                                </td>
                                                <td><div class="row-mover"></div></td>
                                            </tr>
                                        </table>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list_item">
                                    <table class="list-table">
                                        <tr>
                                            <td width="100%">
                                                <?php
                                                TMM_OptionsHelper::draw_theme_option(array(
                                                    'type' => 'select',
                                                    'title' => '',
                                                    'name' => 'folio_template1_items[]',
                                                    'shortcode_field' => 'folioposts',
                                                    'id' => '',
                                                    'values' => array(0 => __('No items', 'almera')) + $posts_array,
                                                    'css_class' => '',
                                                    'default_value' => 0,
                                                    'description' => '',
                                                    'hide_item_html' => 1
                                                ));
                                                ?>
                                            </td>
                                            <td>
                                                <a class="button button-secondary js_delete_options_list_item" href="#"><?php _e('Remove', 'almera'); ?></a>
                                            </td>
                                            <td><div class="row-mover"></div></td>
                                        </tr>
                                    </table>
                                </li>
                            <?php endif; ?>	
                        </ul>
                        <a class="button button-secondary js_add_options_list_item" href="#"><?php _e('Add Group', 'almera'); ?></a><br />

                        <hr />

                        <h3><?php _e('Home Template', 'almera'); ?> <span class="description"><?php _e('(Inline Carousel)', 'almera') ?></span></h3>						

                        <?php
                        $posts = get_posts(array('post_type' => TMM_Portfolio::$slug, 'numberposts' => -1));
                        $posts_array = array();
                        if (!empty($posts)) {
                            foreach ($posts as $value) {
                                $posts_array[$value->ID] = $value->post_title;
                            }
                        }
                        //***
                        $folio_template2_items = TMM::get_option('folio_template2_items');
                        ?>

                        <ul class="list-items options_list_items">
                            <?php if (!empty($folio_template2_items)): ?>
                                <?php foreach ($folio_template2_items as $folio_id) : ?>
                                    <li class="list_item">
                                        <table class="list-table">
                                            <tr>
                                                <td width="100%">
                                                    <?php
                                                    TMM_OptionsHelper::draw_theme_option(array(
                                                        'type' => 'select',
                                                        'title' => '',
                                                        'name' => 'folio_template2_items[]',
                                                        'shortcode_field' => 'folioposts',
                                                        'id' => '',
                                                        'values' => $posts_array,
                                                        'css_class' => '',
                                                        'default_value' => $folio_id,
                                                        'description' => '',
                                                        'hide_item_html' => 1
                                                    ));
                                                    ?>
                                                </td>
                                                <td>
                                                    <a class="button button-secondary js_delete_options_list_item" href="#"><?php _e('Remove', 'almera'); ?></a>
                                                </td>
                                                <td><div class="row-mover"></div></td>
                                            </tr>
                                        </table>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list_item">
                                    <table class="list-table">
                                        <tr>
                                            <td width="100%">
                                                <?php
                                                TMM_OptionsHelper::draw_theme_option(array(
                                                    'type' => 'select',
                                                    'title' => '',
                                                    'name' => 'folio_template2_items[]',
                                                    'shortcode_field' => 'folioposts',
                                                    'id' => '',
                                                    'values' => array(0 => __('No items', 'almera')) + $posts_array,
                                                    'css_class' => '',
                                                    'default_value' => 0,
                                                    'description' => '',
                                                    'hide_item_html' => 1
                                                ));
                                                ?>
                                            </td>
                                            <td>
                                                <a class="button button-secondary js_delete_options_list_item" href="#"><?php _e('Remove', 'almera'); ?></a>
                                            </td>
                                            <td><div class="row-mover"></div></td>
                                        </tr>
                                    </table>
                                </li>
                            <?php endif; ?>	
                        </ul>
                        <a class="button button-secondary js_add_options_list_item" href="#"><?php _e('Add Group', 'almera'); ?></a><br />

                        <hr />

                        <h3><?php _e('Home Template', 'almera'); ?> <span class="description"><?php _e('(Fullscreen)', 'almera') ?></span></h3>						

                        <?php
                        $posts = get_posts(array('post_type' => TMM_Portfolio::$slug, 'numberposts' => -1));
                        $posts_array = array();
                        if (!empty($posts)) {
                            foreach ($posts as $value) {
                                $posts_array[$value->ID] = $value->post_title;
                            }
                        }
                        //***
                        $folio_template3_items = TMM::get_option('folio_template3_items');
                        ?>

                        <ul class="list-items options_list_items">
                            <?php if (!empty($folio_template3_items)): ?>
                                <?php foreach ($folio_template3_items as $folio_id) : ?>
                                    <li class="list_item">
                                        <table class="list-table">
                                            <tr>
                                                <td width="100%">
                                                    <?php
                                                    TMM_OptionsHelper::draw_theme_option(array(
                                                        'type' => 'select',
                                                        'title' => '',
                                                        'name' => 'folio_template3_items[]',
                                                        'shortcode_field' => 'folioposts',
                                                        'id' => '',
                                                        'values' => $posts_array,
                                                        'css_class' => '',
                                                        'default_value' => $folio_id,
                                                        'description' => '',
                                                        'hide_item_html' => 1
                                                    ));
                                                    ?>
                                                </td>
                                                <td>
                                                    <a class="button button-secondary js_delete_options_list_item" href="#"><?php _e('Remove', 'almera'); ?></a>
                                                </td>
                                                <td><div class="row-mover"></div></td>
                                            </tr>
                                        </table>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list_item">
                                    <table class="list-table">
                                        <tr>
                                            <td width="100%">
                                                <?php
                                                TMM_OptionsHelper::draw_theme_option(array(
                                                    'type' => 'select',
                                                    'title' => '',
                                                    'name' => 'folio_template3_items[]',
                                                    'shortcode_field' => 'folioposts',
                                                    'id' => '',
                                                    'values' => array(0 => __('No items', 'almera')) + $posts_array,
                                                    'css_class' => '',
                                                    'default_value' => 0,
                                                    'description' => '',
                                                    'hide_item_html' => 1
                                                ));
                                                ?>
                                            </td>
                                            <td>
                                                <a class="button button-secondary js_delete_options_list_item" href="#"><?php _e('Remove', 'almera'); ?></a>
                                            </td>
                                            <td><div class="row-mover"></div></td>
                                        </tr>
                                    </table>
                                </li>
                            <?php endif; ?>	
                        </ul>
                        <a class="button button-secondary js_add_options_list_item" href="#"><?php _e('Add Group', 'almera'); ?></a><br />

                        <hr />

                        <h2><?php _e('Single Page', 'almera'); ?></h2>

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_show_related_works',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show Related Works', 'almera'),
                            'description' => __('Show Related', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Single Folio Page Social Share Buttons', 'almera'); ?></h2>

                        <?php echo TMM::draw_html('page/page_social_likes', "folio_page_social_likes"); ?>

                        <hr />                                                

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_single_show_comments',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide Comments', 'almera'),
                            'description' => __('If checked, all the visitors will be allowed to post their comments to articles.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'folio_single_show_fb_comments',
                            'type' => 'checkbox',
                            'default_value' => 1,
                            'title' => __('Show/Hide Facebook Comments', 'almera'),
                            'description' => __('If checked, all the visitors will be allowed to post Facebook comments to articles.', 'almera'),
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h4><?php _e('Page Layout', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'type' => 'select',
                            'title' => '',
                            'name' => 'single_folio_layout',
                            'shortcode_field' => '',
                            'id' => '',
                            'values' => array(
                                0 => __('Layout 1', 'almera'),
                                1 => __('Layout 2', 'almera'),
                            ),
                            'css_class' => '',
                            'default_value' => 1,
                            'description' => __('Single page layout type.', 'almera'),
                        ));
                        ?>

                        <hr />

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'single_folio_hide_metadata',
                            'type' => 'checkbox',
                            'default_value' => 0,
                            'title' => __('Hide single folio metadata', 'almera'),
                            'description' => '',
                            'css_class' => '',
                        ));
                        ?>
                        <hr />

                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'single_folio_like_button',
                            'type' => 'checkbox',
                            'default_value' => 0,
                            'title' => __('Hide single folio Like button', 'almera'),
                            'description' => '',
                            'css_class' => '',
                        ));
                        ?>

                    </div>

                    <div class="tab-content" id="contact_forms_tab">

                        <h1><?php _e('Contact Forms', 'almera'); ?></h1>

                        <h4><?php _e('Add new Form', 'almera'); ?></h4>
                        <input type="text" value="" placeholder="type title here" id="new_contact_form_name" />&nbsp;<div class="add-button add_form"></div><br />

                        <hr />

                        <ul class="groups contact_forms_groups_list">
                            <?php if (!empty($contact_forms) AND is_array($contact_forms)): ?>
                                <?php $counter = 0; ?>
                                <?php foreach ($contact_forms as $contact_form_id => $contact_form) : ?>
                                    <li>
                                        <a id-data="contact_form_<?php echo $counter ?>" class="delegate_click" href="#"><?php echo @$contact_form['title']; ?></a>
                                        <a href="#" title="<?php _e("Delete", 'almera') ?>" class="remove delete_contact_form" form-list-index="<?php echo $counter ?>"></a>
                                        <a id-data="contact_form_<?php echo $counter ?>" href="#" title="<?php _e("Edit", 'almera') ?>" class="edit delegate_click"></a>
                                    </li>
                                    <?php $counter++; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="js_no_one_item_else"><span><?php _e('You have not created any group yet. Please create one using the form above.', 'almera'); ?></span></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <?php
                    //print contacts forms
                    $form_constructor = new TMM_Contact_Form('contacts_form');
                    $form_constructor->draw_forms();
                    ?>


                    <div class="tab-content" id="custom_sidebars_tab">

                        <h1><?php _e('Custom Sidebars', 'almera'); ?></h1>

                        <h4><?php _e('Add Sidebar', 'almera'); ?></h4>

                        <input type="text" value="" id="sidebar_name" placeholder="<?php _e("type title here", 'almera') ?>">

                        <div class="add-button add_sidebar"></div>

                        <hr />
                        <h4><?php _e("Custom Sidebars", 'almera'); ?></h4>
                        <ul class="groups custom_sidebars_list">
                            <input type="hidden" name="sidebars[]" value="" />
                            <?php if (!empty($sidebars) AND is_array($sidebars)): ?>
                                <?php foreach ($sidebars as $sidebar_id => $sidebar) : ?>
                                    <li>
                                        <a id-data="<?php echo $sidebar_id; ?>" class="delegate_click" href="#"><?php echo $sidebar['name']; ?></a>
                                        <input type="hidden" name="sidebars[<?php echo $sidebar_id; ?>][name]" value="<?php echo $sidebar['name']; ?>" />
                                        <a href="#" title="<?php _e('Delete', 'almera'); ?>" class="remove remove_sidebar" sidebar-id="<?php echo $sidebar_id ?>"></a>
                                        <a id-data="<?php echo $sidebar_id; ?>" href="#" title="<?php _e('Edit', 'almera'); ?>" class="edit delegate_click"></a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="js_no_one_item_else"><span><?php _e('You have not created any sidebar group yet. Please create one using the form above.', 'almera'); ?></span></li>
                            <?php endif; ?>

                        </ul>
                    </div>
                    <?php
                    $data['sidebars'] = $sidebars;
                    $data['entity_sidebars'] = new TMM_Custom_Sidebars();
                    echo TMM_Custom_Sidebars::draw_sidebars_panel();
                    ?>

                    <div class="tab-content" id="seo_tools">

                        <h1><?php _e('Seo Tools', 'almera'); ?></h1>

                        <h4><?php _e('Home page meta title', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'meta_title_home',
                            'type' => 'text',
                            'description' => __('SEO title of page. Title - 50-80 characters (usually - 75)', 'almera'),
                            'default_value' => "",
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Home page meta keywords', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'meta_keywords_home',
                            'type' => 'textarea',
                            'description' => __('Keywords - up to 250 characters', 'almera'),
                            'default_value' => "",
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Home page meta description', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'meta_description_home',
                            'type' => 'textarea',
                            'description' => __('Description - about 150-200 characters', 'almera'),
                            'default_value' => "",
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Posts listing/Blog page', 'almera'); ?></h2>
                        <h4><?php _e('Meta title', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'meta_title_post_listing',
                            'type' => 'text',
                            'description' => __('SEO title of page. Title - 50-80 characters (usually - 75)', 'almera'),
                            'default_value' => "",
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Meta keywords', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'meta_keywords_post_listing',
                            'type' => 'textarea',
                            'description' => __('Keywords - up to 250 characters', 'almera'),
                            'default_value' => "",
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Meta description', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'meta_description_post_listing',
                            'type' => 'textarea',
                            'description' => __('Description - about 150-200 characters', 'almera'),
                            'default_value' => "",
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Portfolio listing', 'almera'); ?></h2>

                        <h4><?php _e('Meta title', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'meta_title_portfolio_listing',
                            'type' => 'text',
                            'description' => __('SEO title of page. Title - 50-80 characters (usually - 75)', 'almera'),
                            'default_value' => "",
                        ));
                        ?>

                        <h4><?php _e('Meta keywords', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'meta_keywords_portfolio_listing',
                            'type' => 'textarea',
                            'description' => __('Keywords - up to 250 characters', 'almera'),
                            'default_value' => "",
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Meta description', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'meta_description_portfolio_listing',
                            'type' => 'text',
                            'description' => __('Description - about 150 - 200 characters', 'almera'),
                            'default_value' => "",
                            'css_class' => '',
                        ));
                        ?>

                        <hr />

                        <h2><?php _e('Gallery listing', 'almera'); ?></h2>

                        <h4><?php _e('Meta title', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'meta_title_gallery_listing',
                            'type' => 'text',
                            'description' => __('SEO title of page. Title - 50-80 characters (usually - 75)', 'almera'),
                            'default_value' => "",
                        ));
                        ?>

                        <h4><?php _e('Meta keywords', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'meta_keywords_gallery_listing',
                            'type' => 'textarea',
                            'description' => __('Keywords - up to 250 characters', 'almera'),
                            'default_value' => "",
                            'css_class' => '',
                        ));
                        ?>

                        <h4><?php _e('Meta description', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'meta_description_gallery_listing',
                            'type' => 'textarea',
                            'description' => __('Description - about 150-200 characters', 'almera'),
                            'default_value' => "",
                            'css_class' => '',
                        ));
                        ?>

                    </div>
                    <div class="tab-content" id="seo_groups_tab">


                        <h4><?php _e('Add SEO Group', 'almera'); ?></h4>
                        <input type="text" value="" id="seo_group_name" placeholder="<?php _e("type title here", 'almera') ?>">
                        <div class="add-button add_seo_group"></div>
                        <hr />
                        <h4><?php _e('SEO Groups', 'almera'); ?></h4>
                        <input type="hidden" name="seo_group[]" value="" />
                        <ul class="groups seo_groups_list">
                            <?php unset($seo_groups[0]); ?>
                            <?php if (!empty($seo_groups) AND is_array($seo_groups)): ?>
                                <?php foreach ($seo_groups as $group_id => $seo_group) : ?>
                                    <?php if ($group_id): ?>
                                        <li>
                                            <a id-data="<?php echo $group_id; ?>" class="delegate_click" href="#"><?php echo $seo_group['name']; ?></a>
                                            <a href="#" title="<?php _e('Delete', 'almera'); ?>" class="remove remove_seo_group" seo-group-id="<?php echo $group_id ?>"></a>
                                            <a id-data="<?php echo $group_id; ?>" href="#" title="<?php _e('Edit', 'almera'); ?>" class="edit delegate_click"></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="js_no_one_item_else"><span><?php _e('You have not created any group yet. Please create one using the form above.', 'almera'); ?></span></li>
                            <?php endif; ?>

                        </ul>

                    </div>

                    <?php echo TMM_SEO_Group::draw_seo_groups_panel(); ?>                           

                    <div class="tab-content" id="footer">

                        <h1><?php _e('Footer', 'almera'); ?></h1>

                        <h4><?php _e('Footer text', 'almera'); ?></h4>
                        <?php
                        TMM_OptionsHelper::draw_theme_option(array(
                            'name' => 'copyright_text',
                            'type' => 'textarea',
                            'description' => '',
                            'default_value' => "",
                            'css_class' => 'fullwidth',
                        ));
                        ?>

                    </div>

                    <?php if (is_plugin_active('tmm_db_migrate/index.php')) { ?>                                                     
                        <div class="tab-content" id="tmm_db_migrate">
                            <h1><?php _e('DB Migrate options', 'almera'); ?></h1>

                            <div>
                                <?php if (TMM_ImpExp_DB::is_zip_file_exists()): ?>

                                    <?php if ((wp_count_posts()->publish > 3) && (wp_count_posts('page')->publish > 3)) {
                                        ?>
                                        <h3 style="color: red;"><?php _e('Attention! You already have some content!', 'tmm_db_migrate'); ?><h3>
                                                <h3 style="color: red;"> <?php _e('It will be rewritten if you press "Demo Data Install"', 'tmm_db_migrate'); ?></h3>
                                                <?php
                                            } else {
                                                ?>
                                                <h3 style="color: green;"><?php _e('Data is ready for import', 'tmm_db_migrate'); ?></h3>
                                                <?php
                                            }
                                            ?>       
                                            <a href="#" class="button button-primary button-large" id="button_prepare_import_data"><?php _e('Demo Data Install', 'tmm_db_migrate'); ?></a>
                                        <?php else: ?>
                                            <h3 style="color: red;"><?php _e('Something wrong, folder "wp-content/uploads/tmm_db_migrate" is not uploaded. Please set permissions for "wp-content/uploads/tmm_db_migrate" folder 0777!', 'tmm_db_migrate'); ?></h3>
                                        <?php endif; ?>		
                                        <ul id="tmm_db_migrate_process_imp"></ul>
                               </div>

                                        <?php
                                        if (!class_exists('ZipArchive')) {
                                            ?>
                                            <h3 style="color: red;"> <?php _e('Your server is not able to export zip files (PHP Class "ZipArchive" not found)', 'tmm_db_migrate'); ?></h3>
                                            <?php
                                        }
                                        ?>

                                        <a href="#" class="button button-primary button-large" id="button_prepare_export_data"><?php _e('Export Data', 'tmm_db_migrate'); ?></a>	

                                        <ul id="tmm_db_migrate_process"></ul>

                                </div>
                                <?php } ?>

                                    <div class="admin-group-button clearfix">
                                        <a class="admin-button button-yellow button-medium align-btn-left button_reset_options" href="#"><?php _e('Reset All Options', 'almera'); ?></a>
                                        <a class="admin-button button-yellow button-medium align-btn-right button_save_options" href="#"><?php _e('Save All Changes', 'almera'); ?></a>
                                    </div>

                                    </section><!--/ #admin-content-->

                                    </section><!--/ .admin-container-->

                                    </div><!--/ #tm-->
                                    </form>
                                <?php endif; ?>
                                <!-- html templates for js -->

                                <?php TMM_Contact_Form::draw_forms_templates(); ?>

                                <div class="clear"></div>
