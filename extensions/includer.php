<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$active_extencions = array(
	'sliders',
	'layout_constructor',
	'demo',
	'demo_import'
);

foreach ($active_extencions as $value) {
	include_once TMM_EXT_PATH . '/' . $value . '/index.php';
}


