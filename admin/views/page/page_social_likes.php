<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php		
 wp_enqueue_style('tmm_theme_social-likes_css', TMM_THEME_URI . '/css/social-likes.css');		
  $label["facebook_btn_".$data] = "Facebook";
  $label["twitter_btn_".$data] = "Twitter";
  $label["google_btn_".$data] = "Google+";
  $label["pinterest_btn_".$data] = "Pinterest";
 
  $page_social_likes=TMM::get_option($data);
  
  ?>
 
<input type="hidden" name="<?php echo $data ?>" value="<?php echo $page_social_likes ?>"/>
<div class="custom-page-options clearfix">
       
        <ul class="post_type_selector_like_<?php echo $data ?>">	
            <?php
            foreach ($label as $kay => $value) {
                ?>
                <li class="option_checkbox_like">
                    <input  type="checkbox" name="" id="<?php echo $kay ?>" value="<?php  echo $kay  ?>" />					
                    <label for="<?php echo $kay  ?>" class="wpsl-label"><span></span><?php echo $value  ?></label>
                </li>
                <?php
            }
            ?>            
        		
        </ul>
 </div>
<div class="row">
    <div id="preview_<?php echo $data ?>" class="shadow-border"></div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
            
        var wpsl_ul = jQuery('<ul class="social-likes-<?php echo $data ?>"></ul>');
	var parent = '<div class="social-likes_single-w"></div>';	
	var single = false;	
	var li = {};
        
        li['facebook_btn_<?php echo $data ?>'] = '<li class="social-likes__widget social-likes__widget_facebook" title="Share link on Facebook"><span class="social-likes__button social-likes__button_facebook"><span class="social-likes__icon social-likes__icon_facebook"></span>Facebook</span></li>';
	li['twitter_btn_<?php echo $data ?>'] = '<li class="social-likes__widget social-likes__widget_twitter" title="Share link on Twitter"><span class="social-likes__button social-likes__button_twitter"><span class="social-likes__icon social-likes__icon_twitter"></span>Twitter</span></li>';
	li['google_btn_<?php echo $data ?>'] = '<li class="social-likes__widget social-likes__widget_plusone" title="Share link on Google+"><span class="social-likes__button social-likes__button_plusone"><span class="social-likes__icon social-likes__icon_plusone"></span>Google+</span></li>';
	li['pinterest_btn_<?php echo $data ?>'] = '<li class="social-likes__widget social-likes__widget_pinterest" title="Share image on Pinterest" data-media=""><span class="social-likes__button social-likes__button_pinterest"><span class="social-likes__icon social-likes__icon_pinterest"></span>Pinterest</span></li>';
        
        function init(){
            var cur_btn=jQuery('input[name=<?php echo $data ?>]').val();
            if (cur_btn){
               
                wpsl_ul.empty();
                cur_btn=cur_btn.split(',');
                
                for (i = 0; i < cur_btn.length; i++) {                   
                    wpsl_ul.append(li[cur_btn[i]]);
                    jQuery('#'+cur_btn[i]).attr('checked','checked');
                }
                var preview = jQuery('#preview_<?php echo $data ?>');               
                    preview.append(wpsl_ul);          
            }
        }
        
	function sort_buttons() {
		wpsl_ul.empty();
                var in_val='';
		jQuery('.post_type_selector_like_<?php echo $data ?> input[type="checkbox"]:checked').each(function () {  
                    var this_id=jQuery(this).attr('id');
			wpsl_ul.append(li[this_id]);	
                        if (this_id!=undefined){
                            in_val+=this_id+',';
                        }                        
		});
		var preview = jQuery('#preview_<?php echo $data ?>');	
               	preview.append(wpsl_ul);		
                jQuery('input[name=<?php echo $data ?>]').val(in_val);
	}
	init();        
        jQuery('.post_type_selector_like_<?php echo $data ?>').on('change', 'input:checkbox', function () {
            
		sort_buttons();
	});
            
        });
</script>