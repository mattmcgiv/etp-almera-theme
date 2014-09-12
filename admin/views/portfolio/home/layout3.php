<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
TMM_OptionsHelper::enqueue_script('epic_slider');
TMM_OptionsHelper::enqueue_script('mobile_touchswipe');


//***
$folio_ids_array = array();
if (!isset($folio_post_id)) {
	$folio_post_id = 0;
}
if ($folio_post_id > 0) {
	$folio_ids_array = array($folio_post_id);
} else {
	$folio_ids_array = TMM::get_option('folio_template3_items');
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
				$images[$counter]['categories'] = $image['categories'];

				if (!isset($image['title3_style'])) {
					$image['title3_style'] = "caption-1";
				}
				$images[$counter]['title3_style'] = $image['title3_style'];

				if (!isset($image['title3_position'])) {
					$image['title3_position'] = "left-position";
				}
				$images[$counter]['title3_position'] = $image['title3_position'];

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

<div class="ajax">
                    
	<div class="epic-wrapper">

		<div id="epicSlider" class="epicSlider theme-default slider-wrapper">
                  
			<div id="slides">
				<?php for ($i = 0; $i < count($images); $i++): ?>
				
                                <?php
                                $p = $images[$i]['imgurl'];
                                $data_vimeo="";
                                $data_youtube="";                                
                                preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
                                if (isset($matches[2]) && $matches[2] != '') {                                    
                                    $video_icon = 'video-icon';
                                    $data_youtube=$matches[2];
                                    if (empty($images[$i]['imgurl2'])) {
                                        $youtubecode = $matches[2];
                                        $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                                    } else {
                                        $th_url = $images[$i]['imgurl2'];
                                    }
                                } else {
                                    $vimeo = substr_count($p, 'vimeo');
                                    if ($vimeo != '0') {
                                        $arr = parse_url($images[$i]['imgurl']);
                                        $data_vimeo=$arr['path'];
                                        $video_icon = 'video-icon';
                                        if (empty($images[$i]['imgurl2'])) {                                            
                                            $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');                                            
                                            if ($xml) {
                                                $th_url = (string) $xml->video->thumbnail_medium;
                                            }
                                        } else {
                                            $th_url = $images[$i]['imgurl2'];
                                        }
                                    } else {
                                        $video_icon = '';
                                        $th_url = $images[$i]['imgurl'];
                                    }
                                }
                                ?>
                            
					<img class="<?php echo $video_icon ?>" data-video-youtube="<?php echo $data_youtube ?>" data-video-vimeo="<?php echo $data_vimeo ?>" src="<?php echo $th_url ?>" alt="" data-title="#caption-<?php echo $i ?>" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? '#caption-'.$i : '' ?>" />
				<?php endfor; ?>
			</div><!--/ #slides-->

			<?php for ($i = 0; $i < count($images); $i++): ?>
				<?php if (!empty($images[$i]['title'])): ?>
					<div id="caption-<?php echo $i ?>" class="epic-caption <?php echo $images[$i]['title3_style'] ?> <?php echo $images[$i]['title3_position'] ?>">
						<?php $title = explode('^', $images[$i]['title']); ?>
						<?php if (!empty($title)): ?>
							<?php foreach ($title as $kk=>$value) : ?>
								<?php
								if($kk>0){
									echo '<br />';
								}
								?>
								<h2><?php echo $value ?></h2>
							<?php endforeach; ?>
						<?php endif; ?>
					</div><!--/ .epic-caption-->
				<?php endif; ?>
			<?php endfor; ?>

		</div><!--/ #epicSlider-->		

	</div>

</div><!--/ .ajax-->



