<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$folioposts_array = explode('^', $folioposts);
if (!empty($folioposts_array)) {
	$foliopost = $folioposts_array[$foliopost_key];
} else {
	return "";
}
//***
$images = get_post_meta($foliopost, 'tmm_portfolio', true);
if (!empty($images)) {
	foreach ($images as $key => $value) {
		$images[$key]['id'] = $foliopost;
	}
}

//***
$current_col_algoritm_arr = explode(',', $current_col_algoritm);
$current_col_algoritm_arr = array_reverse($current_col_algoritm_arr);
$columns_img_sizes = array('col1' => '227*180', 'col2' => '227*250', 'col3' => '227*320');
$counter = 0;
?>

<?php if (!empty($images)): ?>
	<?php foreach ($images as $image): ?>
		<?php
		$col = $current_col_algoritm_arr[$counter];
		$counter++;
		if ($counter >= count($current_col_algoritm_arr))
			$counter = 0;
                $p = $image['imgurl'];
            preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $p, $matches);
            if (isset($matches[2]) && $matches[2] != '') {
                $youtubecode = $matches[2];
                $video_icon = 'video-icon';
                $ip = $image['imgurl2'];
                if (empty($ip)) {
                    $th_url = '	http://img.youtube.com/vi/' . $youtubecode . '/default.jpg';
                } else {
                    $th_url = $ip;
                }
            } else {
                $vimeo = substr_count($p, 'vimeo');
                if ($vimeo != '0') {
                    $video_icon = 'video-icon vimeo';
                    $ip = $image['imgurl2'];
                    if (empty($ip)) {
                        $arr = parse_url($image['imgurl']);
                        $xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');
                        if ($xml) {
                            $th_url = (string) $xml->video->thumbnail_medium;
                        }
                    } else {
                        $th_url = $ip;
                    }
                } else {
                    $video_icon = '';                    
                    $th_url = $p;
                }
            }
           ?>

		<article class="box <?php echo $col ?> masonry_piece_<?php echo $foliopost_key ?>" style="opacity: 0">
			<div class="project-thumb">
				<a href="<?php echo $image['imgurl'] ?>" class="single-image <?php echo $video_icon ?> plus-icon animTop" rel="masonry" title="<?php echo $t=((TMM::get_option('hide_image_titles'))=='0') ? $image['title'] : '' ?>">
					<img src="<?php echo TMM_Helper::resize_image($th_url, $columns_img_sizes[$col]) ?>" alt="" />
					<span class="curtain"></span>
				</a>
				<a href="<?php echo get_permalink($image['id']) ?>" class="project-meta">
					<h6 class="title"><?php echo str_replace('^', '<br />', $image['title']) ?></h6>
					<span class="categories"><?php echo strip_tags(get_the_term_list($image['id'], 'foliocat', '', ' / ', '')); ?></span>
				</a>	
			</div><!--/ .project-thumb-->
		</article><!--/ .box-->
                
	<?php endforeach; ?>	
<?php endif; ?>
<?php if (!empty($folioposts_array) AND isset($folioposts_array[$foliopost_key + 1])): ?>
	<?php $current_col_algoritm = implode(',', $current_col_algoritm_arr); ?>
	<div id="masonryjaxloader" data-next-post-key="<?php echo($foliopost_key + 1) ?>" data-posts="<?php echo $folioposts ?>" data-col-algoritm="<?php echo $current_col_algoritm ?>"></div>
<?php endif; ?>
