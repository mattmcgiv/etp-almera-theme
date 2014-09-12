<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

TMM_OptionsHelper::enqueue_script('mousewheel', false);        
TMM_OptionsHelper::enqueue_script('resizegrid', false);       

$slideup=(TMM::get_option("folio_enable_slide_up_bar") ) ? '1' : '0';

$folio_ids_array = array();
if (!isset($folio_post_id)) {
    $folio_post_id = 0;
}
if ($folio_post_id > 0) {
    $folio_ids_array = array($folio_post_id);
} else {
    $folio_ids_array = TMM::get_option('folio_template1_items');
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

/* * */
$block_html_reverse = false;
?>

<div class="scroll-box" data-listing-page-id="<?php echo get_the_ID(); ?>">

    <div class="grid">

        <?php for ($i = 0; $i < count($images); $i+=4): ?>

            <?php
            $block = array_slice($images, $i, 4);

            if (empty($block)) {
                break;
            }
            ?>

            <?php if (count($block) == 1): ?>

                <div class="gr-box">

                    <div class="item full">
                        <?php $title = explode('^', $block[0]['title']); ?>
                        <?php
                        $p = $block[0]['imgurl'];
                        preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
                        if (isset($matches[2]) && $matches[2] != '') {
                            $youtubecode = $matches[2];
                            $video_icon = 'video-icon';
                            $ip = $block[0]['imgurl2'];
                            if (empty($ip)) {
                                $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                            } else {
                                $th_url = get_grid_image_url($block[0]);
                            }
                        } else {
                            $vimeo = substr_count($p, 'vimeo');
                            if ($vimeo != '0') {
                                $video_icon = 'video-icon vimeo';
                                $ip = $block[0]['imgurl2'];
                                if (empty($ip)) {
                                    $arr = parse_url($block[0]['imgurl']);
                                    $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                                    if ($xml) {
                                        $th_url = (string) $xml->video->thumbnail_medium;
                                    }
                                } else {
                                    $th_url = get_grid_image_url($block[0]);
                                }
                            } else {
                                $video_icon = '';
                                $th_url = get_grid_image_url($block[0]);
                            }
                        }
                        ?>
                        <?php
                        $t = implode('', $title);
                        ?>
                        <figure class="gr-figure">
                            <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : '' ?>" href="<?php echo $title_href = (!empty($block[0]['title_href'])) ?  $block[0]['title_href'] : get_permalink($block[0]['id']) ?>" data-fancybox-group="grid">
                                <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '995*995') ?>" alt="">
                            </a>

                            <a href="<?php echo $title_href = (!empty($block[0]['title_href'])) ?  $block[0]['title_href'] : get_permalink($block[0]['id']) ?>" class="gr-caption">

        <?php if (!empty($title)): ?>
            <?php foreach ($title as $kk => $value) : ?>										
                                        <h5><?php echo $value ?></h5>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <span><?php
                        if (!empty($block[0]['categories'])) {
                            $tmp = explode(',', $block[0]['categories']);
                            if (!empty($tmp)) {
                                foreach ($tmp as $kk => $term_id) {
                                    if ($kk > 0) {
                                        echo ' / ';
                                    }
                                    echo $term_list[$term_id];
                                }
                            }
                        }
                                ?></span>
                            </a>
                        </figure><!--/ .gr-figure-->

                    </div><!--/ .item-->

                </div><!--/ .gr-box-->

    <?php endif; ?>


            <?php if (count($block) == 2): ?>

                <div class="gr-box">

                    <div class="item large">
        <?php
        $p = $block[0]['imgurl'];
        preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
        if (isset($matches[2]) && $matches[2] != '') {
            $youtubecode = $matches[2];
            $video_icon = 'video-icon';
            $ip = $block[0]['imgurl2'];
            if (empty($ip)) {
                $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
            } else {
                $th_url = get_grid_image_url($block[0]);
            }
        } else {
            $vimeo = substr_count($p, 'vimeo');
            if ($vimeo != '0') {
                $video_icon = 'video-icon vimeo';
                $ip = $block[0]['imgurl2'];
                if (empty($ip)) {
                    $arr = parse_url($block[0]['imgurl']);
                    $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                    if ($xml) {
                        $th_url = (string) $xml->video->thumbnail_medium;
                    }
                } else {
                    $th_url = get_grid_image_url($block[0]);
                }
            } else {
                $video_icon = '';
                $th_url = get_grid_image_url($block[0]);
            }
        }
        ?>
                        <?php 
                        $t=$block[0]['title'];
                         ?>
                        <figure class="gr-figure">
                            <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : ''  ?>" href="<?php echo $title_href = (!empty($block[0]['title_href'])) ?  $block[0]['title_href'] : get_permalink($block[0]['id']) ?>" data-fancybox-group="grid">
                                <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '995*495') ?>" alt="">
                            </a>

                            <a href="<?php echo $title_href = (!empty($block[0]['title_href'])) ?  $block[0]['title_href'] : get_permalink($block[0]['id']) ?>" class="gr-caption">
                                <h5><?php echo $block[0]['title'] ?></h5>
                                <span><?php
                if (!empty($block[0]['categories'])) {
                    $tmp = explode(',', $block[0]['categories']);
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

                    <div class="item large">
                                    <?php
                                    $p = $block[1]['imgurl'];
                                    preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
                                    if (isset($matches[2]) && $matches[2] != '') {
                                        $youtubecode = $matches[2];
                                        $video_icon = 'video-icon';
                                        $ip = $block[1]['imgurl2'];
                                        if (empty($ip)) {
                                            $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                                        } else {
                                            $th_url = get_grid_image_url($block[1]);
                                        }
                                    } else {
                                        $vimeo = substr_count($p, 'vimeo');
                                        if ($vimeo != '0') {
                                            $video_icon = 'video-icon vimeo';
                                            $ip = $block[1]['imgurl2'];
                                            if (empty($ip)) {
                                                $arr = parse_url($block[1]['imgurl']);
                                                $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                                                if ($xml) {
                                                    $th_url = (string) $xml->video->thumbnail_medium;
                                                }
                                            } else {
                                                $th_url = get_grid_image_url($block[1]);
                                            }
                                        } else {
                                            $video_icon = '';
                                            $th_url = get_grid_image_url($block[1]);
                                        }
                                    }
                                    ?>
                        <?php 
                        $t=$block[1]['title'];
                         ?>
                        <figure class="gr-figure">
                            <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : '' ?>" href="<?php echo $title_href = (!empty($block[1]['title_href'])) ?  $block[1]['title_href'] : get_permalink($block[1]['id']) ?>" data-fancybox-group="grid">
                                <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '995*495') ?>" alt="">
                            </a>

                            <a href="<?php echo $title_href = (!empty($block[1]['title_href'])) ?  $block[1]['title_href'] : get_permalink($block[1]['id']) ?>" class="gr-caption">
                                <h5><?php echo $block[1]['title'] ?></h5>
                                <span><?php
                        if (!empty($block[1]['categories'])) {
                            $tmp = explode(',', $block[1]['categories']);
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

                                <?php endif; ?>

                                <?php if (count($block) == 3): ?>

                <div class="gr-box">

                    <div class="item half">

        <?php
        $p = $block[0]['imgurl'];
        preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
        if (isset($matches[2]) && $matches[2] != '') {
            $youtubecode = $matches[2];
            $video_icon = 'video-icon';
            $ip = $block[0]['imgurl2'];
            if (empty($ip)) {
                $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
            } else {
                $th_url = get_grid_image_url($block[0]);
            }
        } else {
            $vimeo = substr_count($p, 'vimeo');
            if ($vimeo != '0') {
                $video_icon = 'video-icon vimeo';
                $ip = $block[0]['imgurl2'];
                if (empty($ip)) {
                    $arr = parse_url($block[0]['imgurl']);
                    $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                    if ($xml) {
                        $th_url = (string) $xml->video->thumbnail_medium;
                    }
                } else {
                    $th_url = get_grid_image_url($block[0]);
                }
            } else {
                $video_icon = '';
                $th_url = get_grid_image_url($block[0]);
            }
        }
        ?>
                        <?php 
                        $t=$block[0]['title'];
                         ?>
                        <figure class="gr-figure">
                            <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : '' ?>" href="<?php echo $title_href = (!empty($block[0]['title_href'])) ?  $block[0]['title_href'] : get_permalink($block[0]['id']) ?>" data-fancybox-group="grid">
                                <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '495*495') ?>" alt="">
                            </a>

                            <a href="<?php echo $title_href = (!empty($block[0]['title_href'])) ?  $block[0]['title_href'] : get_permalink($block[0]['id']) ?>" class="gr-caption">
                                <h5><?php echo $block[0]['title'] ?></h5>
                                <span><?php
                        if (!empty($block[0]['categories'])) {
                            $tmp = explode(',', $block[0]['categories']);
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

                    <div class="item half">

                                    <?php
                                    $p = $block[1]['imgurl'];
                                    preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
                                    if (isset($matches[2]) && $matches[2] != '') {
                                        $youtubecode = $matches[2];
                                        $video_icon = 'video-icon';
                                        $ip = $block[1]['imgurl2'];
                                        if (empty($ip)) {
                                            $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                                        } else {
                                            $th_url = get_grid_image_url($block[1]);
                                        }
                                    } else {
                                        $vimeo = substr_count($p, 'vimeo');
                                        if ($vimeo != '0') {
                                            $video_icon = 'video-icon vimeo';
                                            $ip = $block[1]['imgurl2'];
                                            if (empty($ip)) {
                                                $arr = parse_url($block[1]['imgurl']);
                                                $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                                                if ($xml) {
                                                    $th_url = (string) $xml->video->thumbnail_medium;
                                                }
                                            } else {
                                                $th_url = get_grid_image_url($block[1]);
                                            }
                                        } else {
                                            $video_icon = '';
                                            $th_url = get_grid_image_url($block[1]);
                                        }
                                    }
                                    ?>
                        <?php 
                        $t=$block[1]['title'];
                         ?>

                        <figure class="gr-figure">
                            <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : '' ?>" href="<?php echo $title_href = (!empty($block[1]['title_href'])) ?  $block[1]['title_href'] : get_permalink($block[1]['id']) ?>" data-fancybox-group="grid">
                                <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '495*495') ?>" alt="">
                            </a>

                            <a href="<?php echo $title_href = (!empty($block[1]['title_href'])) ?  $block[1]['title_href'] : get_permalink($block[1]['id']) ?>" class="gr-caption">
                                <h5><?php echo $block[1]['title'] ?></h5>
                                <span><?php
                        if (!empty($block[1]['categories'])) {
                            $tmp = explode(',', $block[1]['categories']);
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

                    <div class="item large">

                                    <?php
                                    $p = $block[2]['imgurl'];
                                    preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
                                    if (isset($matches[2]) && $matches[2] != '') {
                                        $youtubecode = $matches[2];
                                        $video_icon = 'video-icon';
                                        $ip = $block[2]['imgurl2'];
                                        if (empty($ip)) {
                                            $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                                        } else {
                                            $th_url = get_grid_image_url($block[2]);
                                        }
                                    } else {
                                        $vimeo = substr_count($p, 'vimeo');
                                        if ($vimeo != '0') {
                                            $video_icon = 'video-icon vimeo';
                                            $ip = $block[2]['imgurl2'];
                                            if (empty($ip)) {
                                                $arr = parse_url($block[2]['imgurl']);
                                                $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                                                if ($xml) {
                                                    $th_url = (string) $xml->video->thumbnail_medium;
                                                }
                                            } else {
                                                $th_url = get_grid_image_url($block[2]);
                                            }
                                        } else {
                                            $video_icon = '';
                                            $th_url = get_grid_image_url($block[2]);
                                        }
                                    }
                                    ?>
                        <?php
                        $t=$block[2]['title'];                        
                        ?>
                        <figure class="gr-figure">
                            <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : '' ?>" href="<?php echo $title_href = (!empty($block[2]['title_href'])) ?  $block[2]['title_href'] : get_permalink($block[2]['id']) ?>" data-fancybox-group="grid">
                                <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '995*495') ?>" alt="">
                            </a>

                            <a href="<?php echo $title_href = (!empty($block[2]['title_href'])) ?  $block[2]['title_href'] : get_permalink($block[2]['id']) ?>" class="gr-caption">
                                <h5><?php echo $block[2]['title'] ?></h5>
                                <span><?php
                        if (!empty($block[2]['categories'])) {
                            $tmp = explode(',', $block[2]['categories']);
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
    <?php endif; ?>



                                <?php if (count($block) == 4): ?>

                                    <?php if ($block_html_reverse): ?>
                    <div class="gr-box">

                        <div class="item large">

                                        <?php
                                        $p = $block[2]['imgurl'];
                                        preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
                                        if (isset($matches[2]) && $matches[2] != '') {
                                            $youtubecode = $matches[2];
                                            $video_icon = 'video-icon';
                                            $ip = $block[2]['imgurl2'];
                                            if (empty($ip)) {
                                                $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                                            } else {
                                                $th_url = get_grid_image_url($block[2]);
                                            }
                                        } else {
                                            $vimeo = substr_count($p, 'vimeo');
                                            if ($vimeo != '0') {
                                                $video_icon = 'video-icon vimeo';
                                                $ip = $block[2]['imgurl2'];
                                                if (empty($ip)) {
                                                    $arr = parse_url($block[2]['imgurl']);
                                                    $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                                                    if ($xml) {
                                                        $th_url = (string) $xml->video->thumbnail_medium;
                                                    }
                                                } else {
                                                    $th_url = get_grid_image_url($block[2]);
                                                }
                                            } else {
                                                $video_icon = '';
                                                $th_url = get_grid_image_url($block[2]);
                                            }
                                        }
                                        ?>
                            <?php 
                            $t=$block[2]['title'];                                    
                                    ?>
                            <figure class="gr-figure">
                                <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : '' ?>" href="<?php echo $title_href = (!empty($block[2]['title_href'])) ?  $block[2]['title_href'] : get_permalink($block[2]['id']) ?>" data-fancybox-group="grid">
                                    <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '995*495') ?>" alt="">
                                </a>

                                <a href="<?php echo $title_href = (!empty($block[2]['title_href'])) ?  $block[2]['title_href'] : get_permalink($block[2]['id']) ?>" class="gr-caption">
                                    
                                    <h5><?php echo $block[2]['title'] ?></h5>
                                    <span><?php
                            if (!empty($block[2]['categories'])) {
                                $tmp = explode(',', $block[2]['categories']);
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

                        <div class="item half">

            <?php
            $p = $block[0]['imgurl'];
            preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
            if (isset($matches[2]) && $matches[2] != '') {
                $youtubecode = $matches[2];
                $video_icon = 'video-icon';
                $ip = $block[0]['imgurl2'];
                if (empty($ip)) {
                    $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                } else {
                    $th_url = get_grid_image_url($block[0]);
                }
            } else {
                $vimeo = substr_count($p, 'vimeo');
                if ($vimeo != '0') {
                    $video_icon = 'video-icon vimeo';
                    $ip = $block[0]['imgurl2'];
                    if (empty($ip)) {
                        $arr = parse_url($block[0]['imgurl']);
                        $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                        if ($xml) {
                            $th_url = (string) $xml->video->thumbnail_medium;
                        }
                    } else {
                        $th_url = get_grid_image_url($block[0]);
                    }
                } else {
                    $video_icon = '';
                    $th_url = get_grid_image_url($block[0]);
                }
            }
            ?>
                            <?php 
                            $t=$block[0]['title'];                            
                            ?>
                            <figure class="gr-figure">
                                <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : '' ?>" href="<?php echo $title_href = (!empty($block[0]['title_href'])) ?  $block[0]['title_href'] : get_permalink($block[0]['id']) ?>" data-fancybox-group="grid">
                                    <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '495*495') ?>" alt="">
                                </a>

                                <a href="<?php echo $title_href = (!empty($block[0]['title_href'])) ?  $block[0]['title_href'] : get_permalink($block[0]['id']) ?>" class="gr-caption">
                                    
                                    <h5><?php echo $block[0]['title'] ?></h5>
                                    <span><?php
                            if (!empty($block[0]['categories'])) {
                                $tmp = explode(',', $block[0]['categories']);
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

                        <div class="item half">


                            <?php
                            $p = $block[1]['imgurl'];
                            preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
                            if (isset($matches[2]) && $matches[2] != '') {
                                $youtubecode = $matches[2];
                                $video_icon = 'video-icon';
                                $ip = $block[1]['imgurl2'];
                                if (empty($ip)) {
                                    $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                                } else {
                                    $th_url = get_grid_image_url($block[1]);
                                }
                            } else {
                                $vimeo = substr_count($p, 'vimeo');
                                if ($vimeo != '0') {
                                    $video_icon = 'video-icon vimeo';
                                    $ip = $block[1]['imgurl2'];
                                    if (empty($ip)) {
                                        $arr = parse_url($block[1]['imgurl']);
                                        $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                                        if ($xml) {
                                            $th_url = (string) $xml->video->thumbnail_medium;
                                        }
                                    } else {
                                        $th_url = get_grid_image_url($block[1]);
                                    }
                                } else {
                                    $video_icon = '';
                                    $th_url = get_grid_image_url($block[1]);
                                }
                            }
                            ?>
                            <?php
                            $t=$block[1]['title'];
                            ?>
                            <figure class="gr-figure">
                                <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : ''  ?>" href="<?php echo $title_href = (!empty($block[1]['title_href'])) ?  $block[1]['title_href'] : get_permalink($block[1]['id']) ?>" data-fancybox-group="grid">
                                    <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '495*495') ?>" alt="">
                                </a>

                                <a href="<?php echo $title_href = (!empty($block[1]['title_href'])) ?  $block[1]['title_href'] : get_permalink($block[1]['id']) ?>" class="gr-caption">
                                    <h5><?php echo $block[1]['title'] ?></h5>
                                    <span><?php
                            if (!empty($block[1]['categories'])) {
                                $tmp = explode(',', $block[1]['categories']);
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
                        <?php else: ?>
                            <?php $block_html_reverse = !$block_html_reverse; ?>
                    <div class="gr-box">

                        <div class="item half">

                            <?php
                            $p = $block[0]['imgurl'];
                            preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
                            if (isset($matches[2]) && $matches[2] != '') {
                                $youtubecode = $matches[2];
                                $video_icon = 'video-icon';
                                $ip = $block[0]['imgurl2'];
                                if (empty($ip)) {
                                    $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                                } else {
                                    $th_url = get_grid_image_url($block[0]);
                                }
                            } else {
                                $vimeo = substr_count($p, 'vimeo');
                                if ($vimeo != '0') {
                                    $video_icon = 'video-icon vimeo';
                                    $ip = $block[0]['imgurl2'];
                                    if (empty($ip)) {
                                        $arr = parse_url($block[0]['imgurl']);
                                        $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                                        if ($xml) {
                                            $th_url = (string) $xml->video->thumbnail_medium;
                                        }
                                    } else {
                                        $th_url = get_grid_image_url($block[0]);
                                    }
                                } else {
                                    $video_icon = '';
                                    $th_url = get_grid_image_url($block[0]);
                                }
                            }
                            ?>
                            <?php 
                            $t=$block[0]['title'];
                            ?>
                            <figure class="gr-figure">
                                <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : ''  ?>" href="<?php echo $title_href = (!empty($block[0]['title_href'])) ?  $block[0]['title_href'] : get_permalink($block[0]['id']) ?>" data-fancybox-group="grid">
                                    <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '495*495') ?>" alt="">
                                </a>

                                <a href="<?php echo $title_href = (!empty($block[0]['title_href'])) ?  $block[0]['title_href'] : get_permalink($block[0]['id']) ?>" class="gr-caption">
                                    <h5><?php echo $block[0]['title'] ?></h5>
                                    <span><?php
                            if (!empty($block[0]['categories'])) {
                                $tmp = explode(',', $block[0]['categories']);
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

                        <div class="item half">

                            <?php
                            $p = $block[1]['imgurl'];
                            preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
                            if (isset($matches[2]) && $matches[2] != '') {
                                $youtubecode = $matches[2];
                                $video_icon = 'video-icon';
                                $ip = $block[1]['imgurl2'];
                                if (empty($ip)) {
                                    $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                                } else {
                                    $th_url = get_grid_image_url($block[1]);
                                }
                            } else {
                                $vimeo = substr_count($p, 'vimeo');
                                if ($vimeo != '0') {
                                    $video_icon = 'video-icon vimeo';
                                    $ip = $block[1]['imgurl2'];
                                    if (empty($ip)) {
                                        $arr = parse_url($block[1]['imgurl']);
                                        $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                                        if ($xml) {
                                            $th_url = (string) $xml->video->thumbnail_medium;
                                        }
                                    } else {
                                        $th_url = get_grid_image_url($block[1]);
                                    }
                                } else {
                                    $video_icon = '';
                                    $th_url = get_grid_image_url($block[1]);
                                }
                            }
                            ?>
                            <?php
                            $t=$block[1]['title'];
                             ?>
                            <figure class="gr-figure">
                                <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : '' ?>" href="<?php echo $title_href = (!empty($block[1]['title_href'])) ?  $block[1]['title_href'] : get_permalink($block[1]['id']) ?>" data-fancybox-group="grid">
                                    <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '495*495') ?>" alt="">
                                </a>

                                <a href="<?php echo $title_href = (!empty($block[1]['title_href'])) ?  $block[1]['title_href'] : get_permalink($block[1]['id']) ?>" class="gr-caption">
                                    <h5><?php echo $block[1]['title'] ?></h5>
                                    <span><?php
                            if (!empty($block[1]['categories'])) {
                                $tmp = explode(',', $block[1]['categories']);
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

                        <div class="item large">

                            <?php
                            $p = $block[2]['imgurl'];
                            preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
                            if (isset($matches[2]) && $matches[2] != '') {
                                $youtubecode = $matches[2];
                                $video_icon = 'video-icon';
                                $ip = $block[2]['imgurl2'];
                                if (empty($ip)) {
                                    $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                                } else {
                                    $th_url = get_grid_image_url($block[2]);
                                }
                            } else {
                                $vimeo = substr_count($p, 'vimeo');
                                if ($vimeo != '0') {
                                    $video_icon = 'video-icon vimeo';
                                    $ip = $block[2]['imgurl2'];
                                    if (empty($ip)) {
                                        $arr = parse_url($block[2]['imgurl']);
                                        $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                                        if ($xml) {
                                            $th_url = (string) $xml->video->thumbnail_medium;
                                        }
                                    } else {
                                        $th_url = get_grid_image_url($block[2]);
                                    }
                                } else {
                                    $video_icon = '';
                                    $th_url = get_grid_image_url($block[2]);
                                }
                            }
                            ?>
                            <?php 
                            $t=$block[2]['title'];
                             ?>
                            <figure class="gr-figure">
                                <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : ''  ?>" href="<?php echo $title_href = (!empty($block[2]['title_href'])) ?  $block[2]['title_href'] : get_permalink($block[2]['id']) ?>" data-fancybox-group="grid">
                                    <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '995*495') ?>" alt="">
                                </a>

                                <a href="<?php echo $title_href = (!empty($block[2]['title_href'])) ?  $block[2]['title_href'] : get_permalink($block[2]['id']) ?>" class="gr-caption">
                                    <h5><?php echo $block[2]['title'] ?></h5>
                                    <span><?php
                            if (!empty($block[2]['categories'])) {
                                $tmp = explode(',', $block[2]['categories']);
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
                        <?php endif; ?>

                <div class="gr-box">

                    <div class="item full">

                        <?php
                        $p = $block[3]['imgurl'];
                        preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
                        if (isset($matches[2]) && $matches[2] != '') {
                            $youtubecode = $matches[2];
                            $video_icon = 'video-icon';
                            $ip = $block[3]['imgurl2'];
                            if (empty($ip)) {
                                $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                            } else {
                                $th_url = get_grid_image_url($block[3]);
                            }
                        } else {
                            $vimeo = substr_count($p, 'vimeo');
                            if ($vimeo != '0') {
                                $video_icon = 'video-icon vimeo';
                                $ip = $block[3]['imgurl2'];
                                if (empty($ip)) {
                                    $arr = parse_url($block[3]['imgurl']);
                                    $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                                    if ($xml) {
                                        $th_url = (string) $xml->video->thumbnail_medium;
                                    }
                                } else {
                                    $th_url = get_grid_image_url($block[3]);
                                }
                            } else {
                                $video_icon = '';
                                $th_url = get_grid_image_url($block[3]);
                            }
                        }
                        ?>
                        <?php
                        $t=$block[3]['title'];
                        ?>

                        <figure class="gr-figure">
                            <a class="gr-lightbox single-image <?php echo $video_icon ?> plus-icon animTop" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $t : ''  ?>" href="<?php echo $title_href = (!empty($block[3]['title_href'])) ?  $block[3]['title_href'] : get_permalink($block[3]['id']) ?>" data-fancybox-group="grid">
                                <img <?php if ($slideup=='1'){ ?> class="slideup" <?php } ?> src="<?php echo TMM_Helper::resize_image($th_url, '995*995') ?>" alt="">
                            </a>

                            <a href="<?php echo $title_href = (!empty($block[3]['title_href'])) ?  $block[3]['title_href'] : get_permalink($block[3]['id']) ?>" class="gr-caption">
                                <h5><?php echo $block[3]['title'] ?></h5>
                                <span><?php
                            if (!empty($block[3]['categories'])) {
                                $tmp = explode(',', $block[3]['categories']);
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

                    <?php endif; ?>

                <?php endfor; ?>


    </div><!--/ .grid-->
    
</div><!--/ .scroll-box-->

