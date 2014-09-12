<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
TMM_OptionsHelper::enqueue_script('mousewheel');
TMM_OptionsHelper::enqueue_script('resizegrid');

$slideup=(TMM::get_option("folio_enable_slide_up_bar") ) ? '1' : '0';

//***
$folio_ids_array = array();
if (!isset($folio_post_id)) {
    $folio_post_id = 0;
}
if ($folio_post_id > 0) {
    $folio_ids_array = array($folio_post_id);
} else {
    $folio_ids_array = TMM::get_option('folio_template2_items');
}
//***
$args = array(
    'post_type' => TMM_Portfolio::$slug,
    'post__in' => $folio_ids_array,
    'posts_per_page' => -1
);
//***
$images = array();
$counter = 0;
if (!empty($folio_ids_array)) {
    foreach ($folio_ids_array as $folio_id) {
        $tmp_images = get_post_meta($folio_id, 'tmm_portfolio', true);
        if (!empty($tmp_images)) {
            foreach ($tmp_images as $image) {
                $images[$counter]['imgurl'] = $image['imgurl'];
                $images[$counter]['title'] = $image['title'];
                if (!isset($image['imgurl2'])) {
                    $image['imgurl2'] = "";
                }
                $images[$counter]['imgurl2'] = $image['imgurl2'];
                if (!isset($image['categories'])) {
                    $image['categories'] = "";
                }
                
                $images[$counter]['title_href'] = $image['title_href'];                
                $images[$counter]['categories'] = $image['categories'];
                
                $images[$counter]['id'] = $folio_id;
                $counter++;
            }
        }
    }
}
//***
$term_list_tmp = get_categories(array('taxonomy' => 'foliocat'));
$term_list = array();
if (!empty($term_list_tmp)) {
    foreach ($term_list_tmp as $term) {
        $term_list[$term->term_id] = $term->name;
    }
}

//***
function get_grid_image_url($block, $is_link = false) {
    if (!$is_link) {
        if (isset($block['imgurl2'])) {
            if (!empty($block['imgurl2'])) {
                if (strlen($block['imgurl2']) > 8) {
                    return $block['imgurl2'];
                }
                return $block['imgurl'];
            } else {
                return $block['imgurl'];
            }
        } else {
            return $block['imgurl'];
        }
    } else {
        return $block['imgurl'];
    }
}
?>

<div class="scroll-box" data-listing-page-id="<?php echo get_the_ID(); ?>">

    <div class="grid">

        <?php for ($i = 0; $i < count($images); $i++): ?>
            <div class="gr-box">

                <div class="item full">
                    <?php $title = explode('^', $images[$i]['title']); ?>
                    <?php
                    $p = $images[$i]['imgurl'];
                    preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
                    if (isset($matches[2]) && $matches[2] != '') {
                        $youtubecode = $matches[2];
                        $video_icon = 'video-icon';
                        $ip = $images[$i]['imgurl2'];
                        if (empty($ip)) {
                            $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                        } else {
                            $th_url = get_grid_image_url($images[$i]);
                        }
                    } else {
                        $vimeo = substr_count($p, 'vimeo');
                        if ($vimeo != '0') {
                            $video_icon = 'video-icon vimeo';
                            $ip = $images[$i]['imgurl2'];
                            if (empty($ip)) {
                                $arr = parse_url($images[$i]['imgurl']);
                                $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                                if ($xml) {
                                    $th_url = (string) $xml->video->thumbnail_medium;
                                }
                            } else {
                                $th_url = get_grid_image_url($images[$i]);
                            }
                        } else {
                            $video_icon = '';
                            $th_url = get_grid_image_url($images[$i]);
                        }
                    }
                    ?>
                    <?php $t = implode('', $title); ?>
                                        
                    <figure class="gr-figure">
                        <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : '' ?>" 
                           href="<?php echo get_grid_image_url($images[$i], true) ?>" data-fancybox-group="grid">
                            <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '995*995') ?>" alt="">
                        </a>

                        <a href="<?php echo $title_href = (!empty($images[$i]['title_href'])) ?  $images[$i]['title_href'] : get_permalink($images[$i]['id']) ?>" class="gr-caption">							
    <?php if (!empty($title)): ?>
                                <?php foreach ($title as $kk => $value) : ?>									
                                    <h5><?php echo $value ?></h5>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <span><?php
                            if (!empty($images[$i]['categories'])) {
                                $tmp = explode(',', $images[$i]['categories']);
                                if (!empty($tmp)) {
                                    foreach ($tmp as $kk => $term_id) {
                                        if ($kk > 0) {
                                            echo ' / ';
                                        }
                                        echo $term_list[$term_id];
                                    }
                                }
                            }
                            ?>
                            </span>
                        </a>
                    </figure><!--/ .gr-figure-->

                </div><!--/ .item-->

            </div><!--/ .gr-box-->
<?php endfor; ?>

    </div>


</div><!--/ .scroll-box-->

