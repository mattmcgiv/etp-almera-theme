<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<!-- - - - - - - - - - - - - end Container - - - - - - - - - - - - - - - - -->		
</div>

</div><!--/ #wrapper-->

<!-- - - - - - - - - - - - - - - - Dynamic Content - - - - - - - - - - - - - - - - -->


<!-- - - - - - - - - - - - - - - - end Header - - - - - - - - - - - - - - - - -->


<!-- - - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

<footer id="footer" <?php if ($_REQUEST['PAGE_ID'] > 0): ?><?php echo TMM_Helper::get_footer_bg($_REQUEST['PAGE_ID']) ?><?php endif; ?>>

	<div class="container">

		<div class="sixteen columns">

			<div class="eight columns alpha">

				<div class="copyright">
					<?php echo TMM::get_option("copyright_text") ?>
				</div><!--/ .copyright-->

			</div><!--/ .columns-->

			<div class="eight columns omega">
				
				<?php if (!TMM::get_option('hide_social_links')): ?>

					<ul class="social-icons">
                                            
                                             <?php $social_links = TMM::get_option('admin_social_links');                                                                                                                                    
                                            
                                                    foreach ($social_links as $key => $value){
                                                        if (!empty($value)){
                                            ?>
                                                <li class="<?php echo $key ?>"><a target="_blank" href="<?php echo $value ?>"><span><?php echo $key ?></span></a></li>
                                            <?php                                                        
                                                    }
                                              }
                                            ?> 
                			</ul><!--/ .social-icons-->

				<?php endif; ?>
					
			</div><!--/ .columns-->

		</div><!--/ .columns-->

	</div><!--/ .container-->

</footer><!--/ #footer-->

<!-- - - - - - - - - - - - - - end Footer - - - - - - - - - - - - - - - -->
<?php wp_footer(); ?>
</body>
</html>
