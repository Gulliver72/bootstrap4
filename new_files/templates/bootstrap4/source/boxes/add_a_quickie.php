<?php
/* -----------------------------------------------------------------------------------------
   $Id: add_a_quickie.php 12770 2020-05-17 15:32:10Z GTB $

   modified eCommerce Shopsoftware
   http://www.modified-shop.org

   Copyright (c) 2009 - 2013 [www.modified-shop.org]
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce (search.php,v 1.22 2003/02/10); www.oscommerce.com 
   (c) 2003      nextcommerce (search.php,v1.9 2003/08/17); www.nextcommerce.org
   (c) 2003-2006 XT-Commerce

   Third Party contributions:
   Add A Quickie v1.0 Autor  Harald Ponce de Leon

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

// include smarty
include(DIR_FS_BOXES_INC . 'smarty_default.php');

$box_smarty->assign('FORM_ACTION',xtc_draw_form('quick_add', xtc_href_link(basename($PHP_SELF), xtc_get_all_get_params(array ('action')) . 'action=add_a_quickie', $request_type)));
$box_smarty->assign('INPUT_FIELD',xtc_draw_input_field('quickie','','class="form-control form-control-sm" aria-label="quickie"'));
$box_smarty->assign('SUBMIT_BUTTON', xtc_image_submit('button_add_quick.gif', BOX_HEADING_ADD_PRODUCT_ID));
$box_smarty->assign('FORM_END', '</form>');

$box_smarty->caching = 0;
$box_add_a_quickie = $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_add_a_quickie.html');

$smarty->assign('box_ADD_QUICKIE', $box_add_a_quickie);
?>