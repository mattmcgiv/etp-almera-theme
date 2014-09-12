<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>
<?php
global $post;
$single_folio_layout = TMM::get_option('single_folio_layout');
$image_alias = '580*480';
if ($single_folio_layout == 1) {
    $image_alias = '940*480';
}
?>
<input type="hidden" id="refer" value="<?php echo $_SERVER['HTTP_REFERER'] ?>">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="<?php get_post_class('container ajax') ?> single-gall" id="post-<?php the_ID(); ?>" >

            <div class="<?php if ($single_folio_layout == 1): ?>sixteen<?php else: ?>ten<?php endif; ?> columns">
                <?php
                $meta = get_post_custom($post->ID);
                $pictures = unserialize(@$meta["tmm_portfolio"][0]);
                ?>

                <?php if (!empty($pictures)): ?>
                    <div class="cycle-slider">
                        <ul>
                            <?php foreach ($pictures as $pic) : ?>
                                <li>
                                    <a rel="folio" href="<?php echo $pic['imgurl'] ?>" class="single-image plus-icon animTop" title="<?php echo $t = ((TMM::get_option('hide_image_titles')) == '0') ? $pic['title'] : '' ?>">
                                        <img alt="<?php echo $pic['title'] ?>" src="<?php echo TMM_Helper::resize_image($pic['imgurl'], $image_alias) ?>">
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

            </div><!--/ .columns-->

            <?php if (!TMM::get_option("single_folio_hide_metadata")): ?>

                <div class="six columns">

                    <ul class="gallery-detailed">
                        <?php if (!empty($meta["portfolio_date"][0])): ?>
                            <li><b><?php _e("Release", 'almera') ?>:</b>&nbsp;<span><?php echo $meta["portfolio_date"][0] ?></span></li>
                        <?php endif; ?>
                        <?php if (!empty($meta["portfolio_clients"][0])): ?>
                            <li><b><?php _e("Client(s)", 'almera') ?>:</b>&nbsp;<span><?php echo $meta["portfolio_clients"][0] ?></span></li>
                        <?php endif; ?>
                        <?php if (!empty($meta["portfolio_tools"][0])): ?>
                            <li><b><?php _e("Tools", 'almera') ?>:</b>&nbsp;<span><?php echo $meta["portfolio_tools"][0] ?></span></li>
                        <?php endif; ?>
                    </ul>

                    <ul class="gallery-detailed">
                        <?php if (!empty($meta["portfolio_camera"][0])): ?>
                            <li><b><?php echo (!empty($meta["portfolio_camera_label"][0])) ? $meta["portfolio_camera_label"][0] : 'Camera' ?>:</b>&nbsp;<span><?php echo $meta["portfolio_camera"][0] ?></span></li>
                        <?php endif; ?>
                        <?php if (!empty($meta["portfolio_lens"][0])): ?>
                            <li><b><?php echo (!empty($meta["portfolio_lens_label"][0])) ? $meta["portfolio_lens_label"][0] : "Lens" ?>:</b>&nbsp;<span><?php echo $meta["portfolio_lens"][0] ?></span></li>
                        <?php endif; ?>
                        <?php if ($meta["portfolio_tripod_or_handheld"][0] != 'none') { ?>
                            <?php if (!empty($meta["portfolio_tripod_or_handheld"][0])): ?>
                                <li><b><?php echo (!empty($meta["portfolio_tripod_or_handheld_label"][0])) ? $meta["portfolio_tripod_or_handheld_label"][0] : 'Tripod or handheld' ?>:</b>&nbsp;<span><?php echo $meta["portfolio_tripod_or_handheld"][0] ?></span></li>
                            <?php endif; ?>
                        <?php } ?>
                        <?php if (!empty($meta["portfolio_fl"][0])): ?>
                            <li><b><?php echo (!empty($meta["portfolio_fl_label"][0])) ? $meta["portfolio_fl_label"][0] : 'FL' ?>:</b>&nbsp;<span><?php echo $meta["portfolio_fl"][0] ?></span></li>
                        <?php endif; ?>
                        <?php if (!empty($meta["portfolio_exposure"][0])): ?>
                            <li><b><?php echo (!empty($meta["portfolio_exposure_label"][0])) ? $meta["portfolio_exposure_label"][0] : 'Exposure' ?>:</b>&nbsp;<span><?php echo $meta["portfolio_exposure"][0] ?></span></li>
                        <?php endif; ?>
                        <?php if (!empty($meta["portfolio_brackets"][0])): ?>
                            <li><b><?php echo (!empty($meta["portfolio_brackets_label"][0])) ? $meta["portfolio_brackets_label"][0] : 'Brackets' ?>:</b>&nbsp;<span><?php echo $meta["portfolio_brackets"][0] ?></span></li>
                        <?php endif; ?>
                        <?php if (!empty($meta["portfolio_processed"][0])): ?>
                            <li><b><?php echo (!empty($meta["portfolio_processed_label"][0])) ? $meta["portfolio_processed_label"][0] : 'Processed' ?>:</b>&nbsp;<span><?php echo $meta["portfolio_processed"][0] ?></span></li>
                        <?php endif; ?>
                        <?php if (!empty($meta["portfolio_etc"][0])): ?>
                            <li><b><?php echo (!empty($meta["portfolio_etc_label"][0])) ? $meta["portfolio_etc_label"][0] : 'Etc.' ?>:</b>&nbsp;<span><?php echo $meta["portfolio_etc"][0] ?></span></li>
                        <?php endif; ?>
                    </ul>

                    <?php if ($post->post_type == 'folio') { ?>
                        <?php if (!TMM::get_option("single_folio_like_button")) { ?>
                            <?php $vote_count = get_post_meta($post->ID, "votes_count", true); ?>
                            <?php
                            $meta_IP = get_post_meta($post->ID, "voted_IP");
                            $vote_class = 'no_vote';

                            if (!empty($meta_IP[0])) {
                                $voted_IP = $meta_IP[0];

                                if (!is_array($voted_IP))
                                    $voted_IP = array();
                                $ip = $_SERVER['REMOTE_ADDR'];
                                if (in_array($ip, array_keys($voted_IP))) {
                                    $vote_class = 'voted';
                                }
                            }
                            ?>

                            <div class="post-like">  
                                <a data-post_id="<?php echo $post->ID ?>" href="#" class="<?php echo $vote_class ?>">  
                                    <span class="qtip like icon-heart" title="I like this article"></span>  
                                </a>  
                                <span class="count"><?php echo $vote_count; ?></span>  
                            </div> 

                        <?php } ?>                                                                 

                    <?php } ?>

                </div><!--/ .columns-->

            <?php endif; ?>

            <div class="<?php if (!TMM::get_option("single_folio_hide_metadata") == 1): ?>ten<?php else: ?>sixteen<?php endif; ?> columns">

                <?php the_content() ?>
                <?php TMM_Ext_LayoutConstructor::draw_front($post->ID); ?>	



            </div><!--/ .columns-->


            <?php $page_social_likes = TMM::get_option('folio_page_social_likes'); ?>

            <?php if (!empty($page_social_likes)) {
                ?>

                <ul class="social-likes">

                    <?php
                    $page_social_likes = explode(",", $page_social_likes);

                    foreach ($page_social_likes as $page_social_like) {

                        switch ($page_social_like) {
                            case 'facebook_btn_folio_page_social_likes':
                                ?>
                                <li class="facebook" title="Like">Facebook</li>
                                <?php
                                break;
                            case 'twitter_btn_folio_page_social_likes':
                                ?>
                                <li class="twitter" title="Like">Twitter</li>
                                <?php
                                break;
                            case 'google_btn_folio_page_social_likes':
                                ?>
                                <li class="plusone" data-counter="<?php the_permalink() ?>/googleplusonecount.php?url={url}&amp;callback=?" title="Like">Google+</li>
                                <?php
                                break;
                            case 'pinterest_btn_folio_page_social_likes':
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
            ?>
            <?php
        endwhile;
    endif;
    ?>
</div>
<div class="clear"></div>


<?php if (TMM::get_option('folio_show_related_works')): ?>
    <div class="divider-solid"></div>
    <h3 class="section-title"><?php _e("Related Works", 'almera') ?></h3>

    <?php
    $tags = wp_get_post_tags($post->ID);
    $tag_ids = array();

    if ($tags) {
        foreach ($tags as $tag_item)
            $tag_ids[] = $tag_item->term_id;
    }

    $query = new WP_Query(array(
        'tag__in' => $tag_ids,
        'post_type' => 'folio',
        'post__not_in' => array($post->ID),
        'showposts' => 4
            )
    );
    ?>

    <section class="recent-projects">
        <?php
        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                ?>
                <article class="four columns">

                    <div class="project-thumb">

                        <a href="<?php echo TMM_Helper::get_post_featured_image($post->ID, ''); ?>" class="single-image plus-icon animTop" title="" rel="gallery">
                            <img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '420*300', true); ?>" alt="<?php the_title(); ?>" />
                        </a>


                        <a href="<?php the_permalink(); ?>" class="project-meta">
                            <h5 class="title"><?php the_title(); ?></h5>
                            <span class="categories"><?php echo strip_tags(get_the_term_list($post->ID, 'foliocat', '', ' / ', '')); ?></span>
                        </a>	

                    </div><!--/ .project-thumb-->

                </article><!--/ .columns-->


                <?php
            endwhile;
        endif;
        ?>
        <?php wp_reset_query(); ?>
    </section><!--/ .recent-projects-->
<?php endif; ?>
<?php if (TMM::get_option("folio_single_show_fb_comments")) { ?>             
    <div class="fb-comments" data-href="<?php the_permalink() ?>" data-width="680px"></div>

<?php } ?>
<?php if (TMM::get_option("folio_single_show_comments")): ?>
    <?php comments_template(); ?>
<?php endif; ?>
<?php get_footer(); ?>