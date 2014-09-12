<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="1" name="tmm_meta_saving" />
<table class="form-table">
    <tbody>
        <tr>
            <th style="width:25%">
                <label for="portfolio_date">
                    <strong><?php _e('Release Date', 'almera'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $portfolio_date ?>" id="portfolio_date" name="portfolio_date">
            </td>
        </tr>
		<tr>
            <th style="width:25%">
                <label for="portfolio_clients">
                    <strong><?php _e('Portfolio clients', 'almera'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $portfolio_clients ?>" id="portfolio_clients" name="portfolio_clients">
            </td>
        </tr>
		<tr>
            <th style="width:25%">
                <label for="portfolio_tools">
                    <strong><?php _e('Portfolio tools', 'almera'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $portfolio_tools ?>" id="portfolio_tools" name="portfolio_tools">
            </td>
        </tr>
    </tbody>
</table>
<hr />
<table class="form-table">
    <tbody>
        <tr>
            <th style="width:25%">                
                    <input type="text" style="width:55%; margin-right: 20px; float:left;" size="30" placeholder="Camera" value="<?php echo $portfolio_camera_label ?>" id="portfolio_camera_label" name="portfolio_camera_label">
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" placeholder="Canon EOS 5 D Mark II" value="<?php echo $portfolio_camera ?>" id="portfolio_camera" name="portfolio_camera">
            </td>
        </tr>
        <tr>
            <th style="width:25%">
                
                    <input type="text" style="width:55%; margin-right: 20px; float:left;" size="30" placeholder="Lens" value="<?php echo $portfolio_lens_label ?>" id="portfolio_lens_label" name="portfolio_lens_label">
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
               
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" placeholder="EF 24-105 F/4L IS USM" value="<?php echo $portfolio_lens ?>" id="portfolio_lens" name="portfolio_lens">
            </td>
        </tr>
        <tr>
            <th style="width:25%">
                                   
                    <input type="text" style="width:65%; margin-right: 20px; float:left;" size="30" placeholder="Tripod or handheld" value="<?php echo $portfolio_tripod_or_handheld_label ?>" id="portfolio_tripod_or_handheld_label" name="portfolio_tripod_or_handheld_label">
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                
            </th>
            <td>
				<select name="portfolio_tripod_or_handheld">
					<option value="<?php _e('none', 'almera'); ?>" <?php if ($portfolio_tripod_or_handheld == 'none'): ?>selected=""<?php endif; ?>><?php _e('None', 'almera'); ?></option>
					<option value="<?php _e('handheld', 'almera'); ?>" <?php if ($portfolio_tripod_or_handheld == 'handheld'): ?>selected=""<?php endif; ?>><?php _e('Handheld', 'almera'); ?></option>
					<option value="<?php _e('tripod', 'almera'); ?>" <?php if ($portfolio_tripod_or_handheld == 'tripod'): ?>selected=""<?php endif; ?>><?php _e('Tripod', 'almera'); ?></option>
				</select>
            </td>
        </tr>
	<tr>
            <th style="width:25%">                
                    
                    <input type="text" style="width:55%; margin-right: 20px; float:left;" size="30" placeholder="FL" value="<?php echo $portfolio_fl_label ?>" id="portfolio_fl" name="portfolio_fl_label">
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" placeholder="40,0 mm" value="<?php echo $portfolio_fl ?>" id="portfolio_fl" name="portfolio_fl">
            </td>
        </tr>
        <tr>
            <th style="width:25%">
                                  
                    <input type="text" style="width:55%; margin-right: 20px; float:left;" size="30" placeholder="Exposure" value="<?php echo $portfolio_exposure_label ?>" id="portfolio_exposure_label" name="portfolio_exposure_label">
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" placeholder="F/10 ISO 100 - shot in AV mode" value="<?php echo $portfolio_exposure ?>" id="portfolio_exposure" name="portfolio_exposure">
            </td>
        </tr>
	<tr>
            <th style="width:25%">
                                   
                    <input type="text" style="width:55%; margin-right: 20px; float:left;" size="30" placeholder="Brackets" value="<?php echo $portfolio_brackets_label ?>" id="portfolio_brackets_label" name="portfolio_brackets_label">
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" placeholder="-2, 0, +2" value="<?php echo $portfolio_brackets ?>" id="portfolio_brackets" name="portfolio_brackets">
            </td>
        </tr>
	<tr>
            <th style="width:25%">
                                    
                    <input type="text" style="width:55%; margin-right: 20px; float:left;" size="30" placeholder="Processed" value="<?php echo $portfolio_processed_label ?>" id="portfolio_processed_label" name="portfolio_processed_label">
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" placeholder="in Photoshop CS 6 and Nik Software plugin" value="<?php echo $portfolio_processed ?>" id="portfolio_processed" name="portfolio_processed">
            </td>
        </tr>
	<tr>
            <th style="width:25%">
                                    
                    <input type="text" style="width:55%; margin-right: 20px; float:left;" size="30" placeholder="Etc." value="<?php echo $portfolio_etc_label ?>" id="portfolio_etc_label" name="portfolio_etc_label">
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" placeholder="" value="<?php echo $portfolio_etc ?>" id="portfolio_etc" name="portfolio_etc">
            </td>
        </tr>
    </tbody>
</table>
<div id="tmm_image_buffer"></div>


