<?php error_reporting(0); ?>
<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
/* ---------------------------------------------------------------------- */
/* 	Basic Theme Settings
  /* ---------------------------------------------------------------------- */

add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_filter('widget_text', 'do_shortcode');
//*****
register_nav_menu('primary', 'Primary Menu');
//*****
define('TMM_THEME_URI', get_template_directory_uri());
define('TMM_THEME_PATH', get_template_directory());
define('TMM_THEME_PREFIX', 'thememakers_');
define('TMM_EXT_URI', TMM_THEME_URI . '/extensions');
define('TMM_EXT_PATH', TMM_THEME_PATH . '/extensions');
//***
define('TMM_THEME_NAME', 'Almera');
define('TMM_FRAMEWORK_VERSION', '2.0.7');
define('TMM_THEME_LINK', 'http://almera.webtemplatemasters.com/help/');
define('TMM_THEME_FORUM_LINK', 'http://forums.webtemplatemasters.com/');

/* ---------------------------------------------------------------------- */
/* 	Load Parts
  /* ---------------------------------------------------------------------- */

load_theme_textdomain('almera', TMM_THEME_PATH . '/languages');

include_once TMM_THEME_PATH . '/helper/aq_resizer.php';
include_once TMM_THEME_PATH . '/admin/theme_options/helper.php';
include_once TMM_THEME_PATH . '/helper/helper.php';
include_once TMM_THEME_PATH . '/helper/helper_fonts.php';
//***
include_once TMM_THEME_PATH . '/classes/thememakers.php';
//***
include_once TMM_THEME_PATH . '/classes/portfolio.php';
include_once TMM_THEME_PATH . '/classes/staff.php';
include_once TMM_THEME_PATH . '/classes/testimonials.php';
include_once TMM_THEME_PATH . '/classes/gallery.php';
include_once TMM_THEME_PATH . '/classes/page.php';
include_once TMM_THEME_PATH . '/classes/contact_form.php';
include_once TMM_THEME_PATH . '/classes/custom_sidebars.php';
include_once TMM_THEME_PATH . '/classes/seo_group.php';
//extensions INCLUDING----------------------------------------------
include_once TMM_EXT_PATH . '/includer.php';

//***

include_once TMM_THEME_PATH . '/admin/options.php';

//WIDGETS-------------------------------------------------------------

include_once TMM_THEME_PATH . '/admin/theme_widgets.php';


add_action('wp_enqueue_scripts', 'tmm_theme_wp_head', 1);
add_action('wp_enqueue_scripts', 'tmm_theme_wp_footer', 1);


add_action('init', array('TMM', 'register'), 1);
add_action('init', array('TMM_Portfolio', 'register'));
add_action('init', array('TMM_Staff', 'register'), 2);
add_action('init', array('TMM_Testimonials', 'register'), 2);
add_action('init', array('TMM_Gallery', 'register'), 2);
add_action('init', array('TMM_Page', 'register'), 2);
//*****
add_action('init', 'tmm_init', 1001);
add_action('admin_init', 'tmm_admin_init');
add_action('save_post', 'tmm_save_details');


//static attributes
$before_widget = '<div id="%1$s" class="widget %2$s">';
$after_widget = '</div>';
$before_title = '<h3 class="widget-title">';
$after_title = '</h3>';

function tmm_init() {
   
    //custom widget areas
    global $before_widget, $after_widget, $before_title, $after_title;
    TMM_Custom_Sidebars::register_custom_sidebars($before_widget, $after_widget, $before_title, $after_title);
}

function tmm_admin_init() {
    TMM_Portfolio::init_meta_boxes();
    TMM_Staff::init_meta_boxes();
    TMM_Gallery::init_meta_boxes();
    TMM_Page::init_meta_boxes();
    TMM_Testimonials::init_meta_boxes();
}

function tmm_save_details() {
    if (is_admin()) {
        if (!empty($_POST)) {
            if (isset($_POST['tmm_meta_saving'])) {
                global $post;
                $post_type = get_post_type($post->ID);
                switch ($post_type) {
                    case 'page':case 'post':
                    case TMM_Portfolio::$slug:
                    case TMM_Gallery::$slug:
                    case TMM_Staff::$slug:
                        TMM_Gallery::save($post->ID);
                        TMM_Staff::save($post->ID);
                        TMM_Portfolio::save($post->ID);
                        break;
                    case 'testimonials':
                        TMM_Testimonials::save($post->ID);
                        break;
                    default:
                        break;
                }

                TMM_Page::save($post->ID); //for all types
            }
        }
    }
}

/* ---------------------------------------------------------------------- */
/* 	Register Sidebar
  /* ---------------------------------------------------------------------- */

if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'add_sidebar') {
        $_REQUEST = TMM_Helper::db_quotes_shield($_REQUEST);
    }
}

register_sidebar(array(
    'name' => __('Thememakers Default Sidebar', 'almera'),
    'id' => 'tmm_default_sidebar',
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title
));

//custom widget areas
TMM_Custom_Sidebars::register_custom_sidebars($before_widget, $after_widget, $before_title, $after_title);

/* ---------------------------------------------------------------------- */
/* 	Filter Image Sizes
  /* ---------------------------------------------------------------------- */

function tmm_filter_image_sizes($sizes) {

    unset($sizes['thumbnail']);
    unset($sizes['medium']);
    unset($sizes['large']);

    return $sizes;
}

if (TMM::get_option('hide_wp_image_sizes')) {
    add_filter('intermediate_image_sizes_advanced', 'tmm_filter_image_sizes');
}

add_action('init', 'tmm_do_filter');

function tmm_do_filter() {
    remove_filter('the_content', 'wptexturize');
}

/* ---------------------------------------------------------------------- */
/* 	Theme scripts and styles Header
  /* ---------------------------------------------------------------------- */

function tmm_theme_wp_head() {
    TMM_OptionsHelper::register_scripts_and_styles();
    //***
    TMM_OptionsHelper::enqueue_style('theme_style');
    TMM_OptionsHelper::enqueue_style('skeleton');
    TMM_OptionsHelper::enqueue_style('layout');
    TMM_OptionsHelper::enqueue_style('font_awesome');
    TMM_OptionsHelper::enqueue_style('animation');
    
       
    TMM_OptionsHelper::enqueue_style('custom1');
    TMM_OptionsHelper::enqueue_style('custom2');    
  
    
    TMM_OptionsHelper::enqueue_style('fancybox');
    TMM_OptionsHelper::enqueue_style('epic_slider');
    TMM_OptionsHelper::enqueue_style('epic_slider_responsive');
    wp_enqueue_style("tmm_flexslider_css", TMM_Ext_Sliders::get_application_uri() . '/items/flex/css/styles.css');
    //***
    wp_enqueue_script('jquery');
    wp_enqueue_script('thememakers_js', TMM_THEME_URI . '/js/thememakers.js', array('jquery'));
    wp_enqueue_script('modernizr', TMM_THEME_URI . '/js/jquery.modernizr.js', array('jquery'));
}

/* ---------------------------------------------------------------------- */
/* 	Theme scripts Footer
  /* ---------------------------------------------------------------------- */

function tmm_theme_wp_footer() {

    TMM_OptionsHelper::enqueue_script('animationEasing',1);
    TMM_OptionsHelper::enqueue_script('easing',1);
    TMM_OptionsHelper::enqueue_script('cycle',1);
    TMM_OptionsHelper::enqueue_script('touchswipe',1);
    TMM_OptionsHelper::enqueue_script('fancybox',1);
    TMM_OptionsHelper::enqueue_script('theme',1);
    ?>

    <script type="text/javascript">
        var enable_hash = "<?php if (TMM::get_option("add_hash")) {
        echo "true";
    } else {
        echo "false";
    } ?>";
        var enable_scrolling_bar="<?php if (TMM::get_option("folio_enable_scrolling_bar") ){
            echo "true";
        } else{
            echo "false";
        }?>"; 
        
        var scrolling_speed="<?php echo (TMM::get_option("folio_scrolling_speed")) ? TMM::get_option("folio_scrolling_speed") : 5; ?>";
        var site_url = "<?php echo home_url() ?>";
        var capcha_image_url = "<?php echo TMM_THEME_URI ?>/helper/capcha/image.php/";
        var template_directory = "<?php echo TMM_THEME_URI; ?>/";
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        var ajax_nonce = "<?php echo  wp_create_nonce('ajax-nonce') ?>";
        //translations
        var lang_enter_correctly = "<?php _e('Please enter correct', 'almera'); ?>";
        var lang_sended_succsessfully = "<?php _e('Your message has been sent successfully!', 'almera'); ?>";
        var lang_server_failed = "<?php _e('Server failed. Send later', 'almera'); ?>";
        var lang_any = "<?php _e('Any', 'almera'); ?>";
        var lang_home = "<?php _e('Home', 'almera'); ?>";
    </script>

    <?php
}

/* ---------------------------------------------------------------------- */
/* 	Filter Hooks for Form
  /* ---------------------------------------------------------------------- */

// Modity comments form fields
function tmk_comments_form_defaults($defaults) {

    $commenter = wp_get_current_commenter();

    $req = get_option('require_name_email');

    $aria_req = ( $req ? " required" : '' );

    $defaults['fields']['author'] = '<p class="comment-form-author">' . '<input id="author" placeholder="Your Name' . ( $req ? ' *' : '' ) . '" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>';
    $defaults['fields']['email'] = '<p class="comment-form-email">' . '<input id="email" placeholder="E-mail' . ( $req ? ' *' : '' ) . '" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>';
    $defaults['fields']['url'] = '<p class="comment-form-url"><input id="url" placeholder="Website" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>';
    $defaults['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" placeholder="Message' . ( $req ? ' *' : '' ) . '" name="comment" ' . $aria_req . '></textarea></p>';

    $defaults['comment_notes_before'] = '';
    $defaults['comment_notes_after'] = '';

    $defaults['cancel_reply_link'] = ' - ' . __('Cancel reply', 'almera');
    $defaults['title_reply'] = __('Leave a Comment', 'almera');
    $defaults['label_submit'] = __('Submit', 'almera');

    return $defaults;
}

add_filter('comment_form_defaults', 'tmk_comments_form_defaults');

function tmk_comments($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    ?>

    <li class="comment" id="comment-<?php echo comment_ID() ?>" comment-id="<?php echo comment_ID() ?>">

        <article>
            <div class="gravatar">
    <?php echo get_avatar($comment, $size = '60', TMM_THEME_URI . '/images/gravatar.jpg'); ?>
            </div>
            <div class="comment-body">
                <div class="comment-meta clearfix">
                    <div class="comment-author"><?php echo get_comment_author_link(); ?></div>
                    <div class="comment-date"><?php comment_date(); ?> - </div>
    <?php echo get_comment_reply_link(array_merge(array('reply_text' => __('Reply', 'almera')), array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div><!--/ .comment-meta -->	
                <p><?php comment_text_rss(); ?></p>
            </div><!--/ .comment-body-->
        </article>

    </li>

<?php } ?>
<?php
add_action('init', 'ajax_rewrite_rules');

function ajax_rewrite_rules() {
    global $wp_rewrite;
    if (TMM::get_option("enable_ajax")) {
        $wp_rewrite->set_permalink_structure('');
        flush_rewrite_rules(false);
    }
}

function ajax_load_content() {

    $type = $_POST['data_type'];

    $id = $_POST['data_id'];

    $page_paged = $_POST['datapaged'];

    if ($type == 'p') {

        $query = new WP_Query('post_type=post&p=' . $id);
        ob_start();
        if ($query->have_posts()) {
            while ($query->have_posts()) :
                $query->the_post();
                global $wp_query;
                $wp_query->is_single = 1;
                $wp_query->query_vars = $query->query_vars;
                $wp_query->posts = $query->posts;
                $wp_query->post_count = $query->post_count;
                $wp_query->query = $query->query;
                $wp_query->tax_query = $query->tax_query;
                get_template_part('single', null);
            endwhile;
        }
        else {
            get_template_part('index', null);
        }
        $response = ob_get_contents();
        ob_end_clean();
    } else if ($type == 'page_id') {

        if (!empty($page_paged)) {
            $query = new WP_Query('post_type=page&paged=' . $page_paged . '&page_id=' . $id);
        } else {
            $query = new WP_Query('post_type=page&page_id=' . $id);
        }
        ob_start();
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                global $wp_query;
                $wp_query->is_page = 1;
                $wp_query->query_vars = $query->query_vars;
                //	TMM_OptionsHelper::enqueue_script('stapel');

                if (is_page_template('template-blog.php')) {
                    $wp_query->is_archive = 1;
                    get_template_part('template', 'blog');
                } else if (is_page_template('template-home1.php')) {
                    get_template_part('template', 'home1');
                } else if (is_page_template('template-home2.php')) {
                    get_template_part('template', 'home2');
                } else if (is_page_template('template-home3.php')) {
                    get_template_part('template', 'home3');
                } else if (is_page_template('template-testimonials.php')) {
                    get_template_part('template', 'testimonials');
                } else {
                    get_header();
                    the_content();
                    
                    TMM_Ext_LayoutConstructor::draw_front(get_the_ID());
                    
                    //$page_social_likes = get_post_meta(get_the_ID(), 'page_social_likes', TRUE);            
                        
                         if (!empty($page_social_likes)) {
                            ?>
                            <div class="shr"></div>
                            <ul class="social-likes">

                                <?php
                                $page_social_likes = explode(",", $page_social_likes);
                                foreach ($page_social_likes as $page_social_like) {
                                    switch ($page_social_like) {
                                        case 'facebook_btn':
                                            ?>
                                            <li class="facebook" title="Like">Facebook</li>
                                            <?php
                                            break;
                                        case 'twitter_btn':
                                            ?>
                                            <li class="twitter" title="Like">Twitter</li>
                                            <?php
                                            break;
                                        case 'google_btn':
                                            ?>
                                            <li class="plusone" data-counter="<?php the_permalink() ?>/googleplusonecount.php?url={url}&amp;callback=?" title="Like">Google+</li>
                                            <?php
                                            break;
                                        case 'pinterest_btn':
                                            ?>
                                            <li class="pinterest" title="Like" data-media="<?php echo TMM_Helper::get_post_featured_image($post->ID, ''); ?>">Pinterest</li>
                                            <?php
                                            break;
                                            ;
                                    }
                                }
                                ?>
                            </ul>
                            <?php }
                    get_footer();
                }
            }
        } else {
            get_template_part('index', null);
        }

        $response = ob_get_contents();
        ob_end_clean();
    } else if ($type == 'gall') {

        if (ctype_digit($id)) {
            $query = new WP_Query('post_type=gall&p=' . $id);
        } else {
            $query = new WP_Query('post_type=gall&name=' . $id);
        }

        ob_start();
        if ($query->have_posts()) {
            while ($query->have_posts()) :
                $query->the_post();
                global $wp_query;
                $wp_query->is_single = 1;
                $wp_query->query_vars = $query->query_vars;
                $wp_query->posts = $query->posts;
                $wp_query->post_count = $query->post_count;
                $wp_query->query = $query->query;
                $wp_query->tax_query = $query->tax_query;
                //	TMM_OptionsHelper::enqueue_script('cycle');
                //	TMM_OptionsHelper::enqueue_script('isotope');
                get_template_part('single', 'gall');
            endwhile;
        } else {
            get_template_part('index', null);
        }
        $response = ob_get_contents();
        ob_end_clean();
    } else if ($type == 'folio') {
        if (ctype_digit($id)) {
            $query = new WP_Query('post_type=folio&p=' . $id);
        } else if ($id == 'archive') {
            $query = new WP_Query('post_type=folio');
        } else {
            $query = new WP_Query('post_type=folio&name=' . $id);
        }

        ob_start();
        if ($query->have_posts()) {
            while ($query->have_posts()) :
                $query->the_post();
                global $wp_query;
                $wp_query->query_vars = $query->query_vars;
                $wp_query->posts = $query->posts;
                $wp_query->post_count = $query->post_count;
                $wp_query->query = $query->query;
                $wp_query->tax_query = $query->tax_query;
                if ($id == 'archive') {
                    $wp_query->is_archive = 1;
                    get_template_part('archive', 'folio');
                } else {
                    $wp_query->is_single = 1;
                    get_template_part('single', 'folio');
                }
            endwhile;
        } else {
            get_template_part('index', null);
        }
        $response = ob_get_contents();
        ob_end_clean();
    } else if ($type == 'cat') {
        $query = new WP_Query('cat=' . $id);
        ob_start();
        if ($query->have_posts()) {
            while ($query->have_posts()) :
                $query->the_post();
                global $wp_query;
                $wp_query->is_category = 1;
                $wp_query->is_archive = 1;
                $wp_query->query_vars = $query->query_vars;
                $wp_query->posts = $query->posts;
                $wp_query->post_count = $query->post_count;
                $wp_query->query = $query->query;
                $wp_query->tax_query = $query->tax_query;
                get_template_part('category', null);
            endwhile;
        } else {
            get_template_part('index', null);
        }
        $response = ob_get_contents();
        ob_end_clean();
    } else if ($type == 'tag') {
        $query = new WP_Query('tag=' . $id);
        ob_start();
        if ($query->have_posts()) {
            while ($query->have_posts()) :
                $query->the_post();
                global $wp_query;
                $wp_query->is_tag = 1;
                $wp_query->is_archive = 1;
                $wp_query->query_vars = $query->query_vars;
                $wp_query->posts = $query->posts;
                $wp_query->post_count = $query->post_count;
                $wp_query->query = $query->query;
                $wp_query->tax_query = $query->tax_query;
                get_template_part('tag', null);

            endwhile;
        }
        else {
            get_template_part('tag', null);
        }
        $response = ob_get_contents();
        ob_end_clean();
    } else if ($type == 'm') {
        $year = substr($id, 0, 4);
        $monthnum = substr($id, 5);
        $query = new WP_Query('year=' . $year . '&monthnum=' . $monthnum);
        ob_start();
        if ($query->have_posts()) {
            while ($query->have_posts()) :
                $query->the_post();
                global $wp_query;
                $wp_query->is_archive = 1;
                $wp_query->query_vars = $query->query_vars;
                $wp_query->posts = $query->posts;
                $wp_query->post_count = $query->post_count;
                $wp_query->query = $query->query;
                $wp_query->tax_query = $query->tax_query;
                get_template_part('archive', null);
            endwhile;
        }
        else {
            get_template_part('tag', null);
        }
        $response = ob_get_contents();
        ob_end_clean();
    }

    echo $response;
    die();
}

add_action('wp_ajax_ajax_load_content', 'ajax_load_content');
add_action('wp_ajax_nopriv_ajax_load_content', 'ajax_load_content');


function ajax_load_single_gall(){
    $listing=$_POST['listing_page_id'];    
    echo $listing;
    die();
}
add_action('wp_ajax_ajax_load_single_gall', 'ajax_load_single_gall');
add_action('wp_ajax_nopriv_ajax_load_single_gall', 'ajax_load_single_gall');

function ajax_load_gall_bycat() {
    $cat_id = $_POST['cat_id'];
    $current_page = $_POST['page'];
    $post_per_page = $_POST['post_per_page'];
    $layout = $_POST['layout'];

    if ($cat_id == 'all') {
        $query = new WP_Query('post_type=gall&posts_per_page=-1');
    } else {
        $query = new WP_Query('post_type=gall&gallery_categories=' . $cat_id);
    }
    $images = array();
         
    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) :
            $query->the_post();
            global $post;

            $tmp = get_post_meta($post->ID, 'thememakers_gallery', true);
            if (!empty($tmp)) {
                foreach ($tmp as $key => $value) {
                    $tmp[$key]['post_id'] = $post->ID;
                }
                $images = $images + $tmp;
            } else {
                $tmp = array();
            }
        endwhile;
    }
    $images = $images + $tmp;
    


    $title_array = array();
    if (!empty($images)) {
        foreach ($images as $key => $value) {
            if (!isset($title_array[$value['post_id']])) {
                $title_array[$value['post_id']] = array();
                $title_array[$value['post_id']]['title'] = get_the_title($value['post_id']);
                $title_array[$value['post_id']]['permalink'] = get_permalink($value['post_id']);
            }
        }
    }


    $i = 1;
    foreach ($images as $key => $value) {
        $images[$key]['key'] = $i;
        $i++;
    }


    $img_terms = array();
    $img_t = get_terms('gallery_categories', array('hide_empty' => false));
    if (!empty($img_t)) {
        foreach ($img_t as $value) {
            $img_terms[$value->term_id]['slug'] = $value->slug;
            $img_terms[$value->term_id]['name'] = $value->name;
        }
    }
    $uniq_id = 0;
    ?>
    <section id="gallery-items" data-listing-page-id="<?php echo get_the_ID(); ?>"  class="gallery-items clearfix" data-pagination="2" >
       
    <?php foreach ($images as $img) : ?>
        
        
            <?php if (($img['key'] > ($post_per_page * $current_page - $post_per_page)) && ($img['key'] <= $post_per_page * $current_page)) { ?>

                <?php
                if ($layout == 3) {
                    ?>
                    <article class="one-third column" data-categories="<?php echo $cat_id ?>">

                        <div class="project-thumb">

                            <a href="<?php echo $img['imgurl'] ?>" class="single-image plus-icon animTop" title="<?php echo $img['title'] ?>" data-fancybox-group="gallery">
                                <img alt="" src="<?php echo TMM_Helper::resize_image($img['imgurl'], '420*300') ?>">
                            </a>

                            <a href="<?php echo $title_array[$img['post_id']]['permalink'] ?>" class="project-meta">
                                <h6 class="title"><?php echo $img['title'] ?></h6>
                                <span class="categories"><?php echo $img_terms[$img['category']]['name'] ?></span>
                            </a>

                        </div><!--/ .project-thumb-->

                    </article>  <!--/ .column-->
                <?php
            } else if ($layout == 4) {
                ?>
                    <article class="four columns" data-categories="<?php echo $cat_id ?>">

                        <div class="project-thumb">

                            <a href="<?php echo $img['imgurl'] ?>" class="single-image plus-icon animTop" title="<?php echo $img['title'] ?>" data-fancybox-group="gallery">
                                <img alt="" src="<?php echo TMM_Helper::resize_image($img['imgurl'], '420*300') ?>">
                            </a>

                            <a href="<?php echo $title_array[$img['post_id']]['permalink'] ?>" class="project-meta">
                                <h6 class="title"><?php echo $img['title'] ?></h6>
                                <span class="categories"><?php echo $img_terms[$img['category']]['name'] ?></span>
                            </a>

                        </div><!--/ .project-thumb-->

                    </article><!--/ .column-->
                <?php
            }
            ?>

                <?php $uniq_id = $uniq_id + $img['key'] + $img['post_id'] + $img['category'] + '_' . $cat_id ?>

            <?php } ?>

        <?php endforeach; ?>

        <?php
        if ($post_per_page < count($images)) {
            $page_count = ceil(count($images) / $post_per_page);
            $t = 1;
            if (($current_page != 1) && ($current_page != $page_count + 1)) {
                $t = 1;
            }
            ?>
            <div class="wp-pagenavi gall">
            <?php
            for ($i = 1; $i <= $page_count + $t; $i++) {
                if ($page_count == $current_page) {
                    if ($i == 1) {
                        ?>
                            <li><a class="prev page-numbers" data-categories="<?php echo $cat_id ?>" data-post-per-page="<?php echo $post_per_page ?>" data-page-namber="<?php echo $current_page - 1 ?>"  href="#"></a></li>
                            <?php
                        } else if ($i == $page_count + $t) {
                            ?>
                            <span class="page-numbers current"><?php echo $current_page ?></span>
                            <?php
                        } else {
                            ?>
                            <li><a class="page-numbers" data-categories="<?php echo $cat_id ?>" data-post-per-page="<?php echo $post_per_page ?>" data-page-namber="<?php echo $i - 1 ?>" href="#"><?php echo $i - 1 ?></a></li>

                            <?php
                        }
                    } else {
                        if ($i == 1) {
                            if ($current_page == $i) {
                                ?>
                                <span class="page-numbers current"><?php echo $current_page ?></span>
                                <?php
                            } else {
                                ?>
                                <li><a class="prev page-numbers" data-categories="<?php echo $cat_id ?>" data-post-per-page="<?php echo $post_per_page ?>" data-page-namber="<?php echo $current_page - 1 ?>"  href="#"></a></li>
                                <?php
                            }
                        } else if ($i == $page_count + $t) {
                            if ($current_page == $i - $t) {
                                ?>
                                <span class="page-numbers current"><?php echo $current_page ?></span>
                                <?php
                            } else {
                                ?>
                                <li><a class="next page-numbers" data-categories="<?php echo $cat_id ?>" data-post-per-page="<?php echo $post_per_page ?>" data-page-namber="<?php echo $current_page + 1 ?>" href="#"></a></li>
                                <?php
                            }
                            ?>

                            <?php
                        } else {
                            if ($current_page == $i) {
                                ?>
                                <span class="page-numbers current"><?php echo $current_page ?></span>
                                <?php
                            } else {
                                ?>
                                <li><a class="page-numbers" data-categories="<?php echo $cat_id ?>" data-post-per-page="<?php echo $post_per_page ?>" data-page-namber="<?php echo $i ?>" href="#"><?php echo $i ?></a></li>
                                <?php
                            }
                            ?>

                            <?php
                        }
                    }
                }
                ?>
            </div>
                <?php
            }
            ?>				
        <input type="hidden" id="uniq_id" data-uniq-id="<?php echo $uniq_id ?>">				
    </section>
        <?php
        $response = ob_get_contents();
        ob_end_clean();
        echo $response;
        die();
    }

    add_action('wp_ajax_ajax_load_gall_bycat', 'ajax_load_gall_bycat');
    add_action('wp_ajax_nopriv_ajax_load_gall_bycat', 'ajax_load_gall_bycat');

    function ajax_load_search() {

        $keyword = $_POST['data_content'];
        $query = new WP_Query('s=' . $keyword);
        ob_start();
        if ($query->have_posts()) {
            while ($query->have_posts()) :
                $query->the_post();
                global $wp_query;
                $wp_query->is_search = 1;
                $wp_query->query_vars = $query->query_vars;
                $wp_query->posts = $query->posts;
                $wp_query->post_count = $query->post_count;
                $wp_query->query = $query->query;
                $wp_query->tax_query = $query->tax_query;
                get_template_part('search', null);
            endwhile;
        }
        else {
            get_template_part('index', null);
        }
        $response = ob_get_contents();
        ob_end_clean();
        echo $response;
        die();
    }

    add_action('wp_ajax_ajax_load_search', 'ajax_load_search');
    add_action('wp_ajax_nopriv_ajax_load_search', 'ajax_load_search');

    function enqueue_script_ajax() {
        
            wp_enqueue_script('tmm_theme_social-likes_js', TMM_THEME_URI . '/js/social-likes.js');
            wp_enqueue_style('tmm_theme_social-likes_css', TMM_THEME_URI . '/css/social-likes.css');
            
          

        if (TMM::get_option("enable_ajax")) {

            TMM_OptionsHelper::enqueue_script('stapel');
            TMM_OptionsHelper::enqueue_script('isotope');

            TMM_OptionsHelper::enqueue_style('epic_slider');
            TMM_OptionsHelper::enqueue_style('epic_slider_responsive');
            TMM_OptionsHelper::enqueue_script('epic_slider');
            TMM_OptionsHelper::enqueue_script('mobile_touchswipe');

            wp_enqueue_script('tmm_theme_map_api_js', 'http://maps.google.com/maps/api/js?sensor=false');
            wp_enqueue_script('tmm_theme_markerwithlabel_js', TMM_Ext_Shortcodes::get_application_uri() . '/js/autoshortcodes/markerwithlabel.js');
            wp_enqueue_script("tmm_shortcode_google_map_js", TMM_Ext_Shortcodes::get_application_uri() . '/js/autoshortcodes/google_map.js');

            TMM_OptionsHelper::enqueue_script('masonry');

            TMM_OptionsHelper::enqueue_script('resizegrid');

            TMM_OptionsHelper::enqueue_script('sudoslider');

            wp_enqueue_script("tmm_shortcode_contact_form_js", TMM_Ext_Shortcodes::get_application_uri() . '/js/autoshortcodes/contact_form.js');

            wp_enqueue_style("tmm_flexslider_css", TMM_Ext_Sliders::get_application_uri() . '/items/flex/css/styles.css');
            wp_enqueue_script('tmm_flexslider_js', TMM_Ext_Sliders::get_application_uri() . '/items/flex/js/jquery.flexslider-min.js');

            wp_enqueue_script("tmm_theme_mediaelementplayer_js", TMM_Ext_Shortcodes::get_application_uri() . '/js/autoshortcodes/mediaelement/mediaelement-and-player.min.js');
            wp_enqueue_style("tmm_theme_mediaelementplayer_css", TMM_Ext_Shortcodes::get_application_uri() . '/js/autoshortcodes/mediaelement/jquery.mediaelementplayer.css');

            wp_enqueue_script('tmm_widget_recent_projects', TMM_THEME_URI . '/js/widgets/recent_projects.js');

            TMM_OptionsHelper::enqueue_script('mobile_touchswipe');

            wp_enqueue_script('tmm_widget_jflickrfeed', TMM_THEME_URI . '/js/widgets/jquery.jflickrfeed.min.js');
            wp_enqueue_script('tmm_widget_twitterFetcher', TMM_THEME_URI . '/js/widgets/twitterFetcher.js');
            wp_enqueue_script('tmm_widget_testimonials', TMM_THEME_URI . '/js/widgets/testimonials.js');

            wp_enqueue_script('tmm_theme_js_ajax', TMM_THEME_URI . '/js/theme_ajax.js', array('jquery'));
            
            wp_enqueue_script('tmm_theme_social-likes_js', TMM_THEME_URI . '/js/social-likes.js');
            wp_enqueue_style('tmm_theme_social-likes_css', TMM_THEME_URI . '/css/social-likes.css');
            
            add_action('comment_post', 'ajaxify_comments', 20, 2);
            wp_enqueue_script('comment-reply');
        }
    }

    add_action('wp_footer', 'enqueue_script_ajax');

    function ajaxify_comments($comment_ID, $comment_status) {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            //If AJAX Request Then
            switch ($comment_status) {
                case '0':
                    //notify moderator of unapproved comment
                    wp_notify_moderator($comment_ID);
                case '1': //Approved comment
                    echo "success";
                    $commentdata = &get_comment($comment_ID, ARRAY_A);
                    $post = &get_post($commentdata['comment_post_ID']);
                    wp_notify_postauthor($comment_ID, $commentdata['comment_type']);
                    break;
                default:
                    echo "error";
            }
            exit;
        }
    }

add_filter('flash_uploader', 'noflashuploader');

function noflashuploader() {
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';

    if (strpos($user_agent, 'mac') !== false) {
        return false;
    } else {
        return true;
    }
}

add_action('wp_ajax_nopriv_post-like', 'post_like');  
add_action('wp_ajax_post-like', 'post_like');

    function post_like()  
    {  
        // Check for nonce security  
        $nonce = $_POST['nonce'];  
       
        if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )  
            die ( 'Busted!');  
          
        if(isset($_POST['post_like']))  
        {  
            // Retrieve user IP address  
            $ip = $_SERVER['REMOTE_ADDR'];  
            $post_id = $_POST['post_id'];  
              
            $voted_IP = array();  
            // Get voters'IPs for the current post  
            $meta_IP = get_post_meta($post_id, "voted_IP");  
            
            if (!empty($meta_IP[0]))            
                $voted_IP = $meta_IP[0];             
              
            // Get votes count for the current post  
            $meta_count = get_post_meta($post_id, "votes_count", true);  
      
            // Use has already voted ?  
            if(!hasAlreadyVoted($post_id))  
            {  
                $voted_IP[$ip] = time();  
      
                // Save IP and increase votes count  
                update_post_meta($post_id, "voted_IP", $voted_IP);  
                update_post_meta($post_id, "votes_count", ++$meta_count);  
                  
                // Display count (ie jQuery return value)  
                echo $meta_count;  
            }  
            else  
                echo "already";  
        }  
        exit;  
    }  
 function hasAlreadyVoted($post_id){  
      
    // Retrieve post votes IPs  
    $meta_IP = get_post_meta($post_id, "voted_IP");  
    
    $voted_IP = array();  
    
    if (!empty($meta_IP[0]))
    $voted_IP = $meta_IP[0];  
             
    // Retrieve current user IP  
    $ip = $_SERVER['REMOTE_ADDR'];  
      
    // If user has already voted  
    if(in_array($ip, array_keys($voted_IP)))  
    {  
        return true;
    }
    else{
        return false;
    }
      
     
} 