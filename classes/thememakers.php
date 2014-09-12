<?php

class TMM {

	public static $options, $app_options;

	public static function register() {
		self::$options = get_option(TMM_THEME_PREFIX . 'theme_options');
		self::$app_options = get_option(TMM_THEME_PREFIX . 'theme_app_options');
	}

	public static function get_option($option, $prefix = TMM_THEME_PREFIX) {
		if ($prefix == TMM_THEME_PREFIX) {
			if (isset(self::$options[$option])) {
				return self::$options[$option];
			}
		} else {
			if (isset(self::$app_options[$prefix][$option])) {
				return self::$app_options[$prefix][$option];
			}
		}
	}
        
        /* Convert hexdec color string to rgb(a) string */

        public static function hex2rgba($color, $opacity = false) {

                $default = 'rgb(0,0,0)';

                //Return default if no color provided
                if(empty($color))
                  return $default; 

                //Sanitize $color if "#" is provided 
                if ($color[0] == '#' ) {
                        $color = substr( $color, 1 );
                }

                //Check if color has 6 or 3 characters and get values
                if (strlen($color) == 6) {
                        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
                } elseif ( strlen( $color ) == 3 ) {
                        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
                } else {
                        return $default;
                }

                //Convert hexadec to rgb
                $rgb =  array_map('hexdec', $hex);

                //Check if opacity is set(rgba or rgb)
                if($opacity){
                        if(abs($opacity) > 1)
                                $opacity = 1.0;
                        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
                } else {
                        $output = 'rgb('.implode(",",$rgb).')';
                }

                //Return rgb(a) color string
                return $output;
        }

	public static function update_option($option, $data, $prefix = TMM_THEME_PREFIX) {
		if ($prefix == TMM_THEME_PREFIX) {
			self::$options[$option] = $data;
			update_option($prefix . 'theme_options', self::$options);
		} else {
			self::$app_options[$prefix][$option] = $data;
			update_option(TMM_THEME_PREFIX . 'theme_app_options', self::$app_options);
		}
	}
      

        //ajax
        public static function update_allowed_alias() {

        parse_str($_REQUEST['values'], $data);
        $data = TMM_Helper::db_quotes_shield($data);
        foreach ($data as $option => $newvalue) {
            if (is_array($newvalue)) {
                self::update_option($option, $newvalue);
            }
        }
   
    }
        
	public static function change_options() {

		$action_type = $_REQUEST['type'];
		$data = array();
		parse_str($_REQUEST['values'], $data);
		$data = TMM_Helper::db_quotes_shield($data);

		switch ($action_type) {
			case 'save':
                            
				if (!empty($data)) {
                                                                                                                                             
					foreach ($data as $option => $newvalue) {                                   
                                                                                          
						if ($option == "sidebars") {
							unset($newvalue[0]);
							TMM::update_option('sidebars', $newvalue);
							continue;
						}
						if ($option == "seo_group") {
							unset($newvalue[0]);
							TMM::update_option('seo_groups', $newvalue);
							continue;
						}
						if ($option == "contact_form") {
							if (!empty($newvalue)) {
								foreach ($newvalue as $key => $form) {
									if (!isset($newvalue[$key]['title'])) {
										unset($newvalue[$key]);
									}

									if (empty($newvalue[$key]['title'])) {
										unset($newvalue[$key]);
									}
								}
							}
							TMM_Contact_Form::save($newvalue);
							continue;
						}
						if (is_array($newvalue)) {
							self::update_option($option, $newvalue);
						} else {
							$newvalue = stripcslashes($newvalue);
							$newvalue = str_replace('\"', '"', $newvalue);
							$newvalue = str_replace("\'", "'", $newvalue);
							self::update_option($option, $newvalue);
						}
					}
				}
                                  
				_e('Options have been updated.', 'almera');
				break;


			case 'reset':
				if (!empty($data)) {
                                    
					foreach ($data as $option => $newvalue) {
						if ($option == "sidebars") {
							continue;
						}
						if ($option == "contact_form") {
							continue;
						}

						self::update_option($option, $newvalue);
					}
				}
				_e('Options have been reset.', 'almera');
				break;


			default:
				break;
		}


		//**** CSS REGENERATION
		$custom_css1 = self::draw_free_page(TMM_THEME_PATH . '/admin/theme_options/custom_css1.php');
		$custom_css2 = self::draw_free_page(TMM_THEME_PATH . '/admin/theme_options/custom_css2.php');
		$handle = fopen(TMM_THEME_PATH . '/css/custom1.css', 'w');
		fwrite($handle, $custom_css1);
		fclose($handle);
		$handle = fopen(TMM_THEME_PATH . '/css/custom2.css', 'w');
		fwrite($handle, $custom_css2);
		fclose($handle);
		exit;
	}

	public static function draw_free_page($pagepath, $data = array()) {
		@extract($data);
		ob_start();
		include($pagepath);
		return ob_get_clean();
	}

	public static function draw_html($view, $data = array()) {
		@extract($data);
		ob_start();
		include(TMM_THEME_PATH . '/admin/views/' . $view . '.php' );
		return ob_get_clean();
	}

}

