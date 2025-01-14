<?php
/*-----------------------------------------------------------
   $Id: general_bottom.js.php 13771 2021-10-15 13:35:43Z GTB $

   modified eCommerce Shopsoftware
   http://www.modified-shop.org

   Copyright (c) 2009 - 2013 [www.modified-shop.org]
  -----------------------------------------------------------
   based on: (c) 2003 - 2006 XT-Commerce (general.js.php)
  -----------------------------------------------------------
   Released under the GNU General Public License
   -----------------------------------------------------------
*/
// this javascriptfile get includes at the BOTTOM of every template page in shop
// you can add your template specific js scripts here
defined('DIR_TMPL_JS') OR define('DIR_TMPL_JS', DIR_TMPL.'javascript/');

// Template Sprachdatei laden
$smarty->config_load('lang_'.$_SESSION['language'].'.custom');

$script_array = array(
	DIR_TMPL_JS.'jquery.min.js',
	DIR_TMPL_JS.'bootstrap.bundle.min.js',
	DIR_TMPL_JS.'bscarousel.min.js',
);

$script_array_defer = array(
	DIR_TMPL_JS.'pushy.min.js',
	DIR_TMPL_JS.'jquery.lazysizes.min.js',
	DIR_TMPL_JS.'jquery.alertable.min.js',
);

// Zeilenbegrenzung Artikelname in Top- und Bestsellerslider
if (BS4_BSCAROUSEL_NAME_LINES != 0 || BS4_TOPCAROUSEL_NAME_LINES != 0) {
	$script_array[] = DIR_TMPL_JS .'ellipsis.js';
}

// EasyZoom
if (BS4_USE_EASYZOOM == 'true') {
	$script_array_defer[] = DIR_TMPL_JS .'easyzoom.min.js';
}

// Touch use für Superfishmenü
if (BS4_TOUCH_USE == 'true') {
	$script_array_defer[] = DIR_TMPL_JS .'touchuse.min.js';
}

// nur Superfishmenü
if (BS4_SUPERFISHMENU_SHOW == 'true') {
	$script_array[] = DIR_TMPL_JS .'prepbigmenu.min.js';
}

// Superfish- und Responsivmenü
$script_array[] = DIR_TMPL_JS .'preparemenu.min.js';

// Bootstrap4
$script_array[] = DIR_TMPL_JS .'bs4.min.js';

$script_min = DIR_TMPL_JS.'tpl_plugins.min.js';

$this_f_time = filemtime(DIR_FS_CATALOG.DIR_TMPL_JS.'general_bottom.js.php');

if (COMPRESS_JAVASCRIPT == 'true') {
	require_once(DIR_FS_BOXES_INC.'combine_files.inc.php');
	$script_array = combine_files($script_array,$script_min,false,$this_f_time);
}

foreach ($script_array as $script) {
	$script .= strpos($script,$script_min) === false ? '?v=' . filemtime(DIR_FS_CATALOG.$script) : '';
	echo '<script src="'.DIR_WS_BASE.$script.'" type="text/javascript"></script>'.PHP_EOL;
}
foreach ($script_array_defer as $script) {
	$script .= strpos($script,$script_min) === false ? '?v=' . filemtime(DIR_FS_CATALOG.$script) : '';
	echo '<script src="'.DIR_WS_BASE.$script.'" type="text/javascript" defer></script>'.PHP_EOL;
}

ob_start();
foreach(auto_include(DIR_FS_CATALOG.DIR_TMPL_JS.'/extra/','php') as $file) require ($file);
$javascript = ob_get_clean();
if (COMPRESS_JAVASCRIPT == 'true') {
  require_once(DIR_TMPL.'source/external/compactor/compactor.php');
  $compactor = new BS4_Compactor(array('strip_php_comments' => false, 'compress_scripts' => true));
  $javascript = $compactor->squeeze($javascript);
}
echo $javascript.PHP_EOL;
?>