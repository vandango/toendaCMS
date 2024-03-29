<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Shop sidebar component
|
| File:		tcmsshop_sb.php
| Version:	0.0.1
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Shop sidebar component
 *
 * This components generates a shop.
 *
 * @version 0.0.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Components
 * 
 */


/*
	init
*/

$path = $tcms_administer_site.'/components/tcmsshop/images';

$tcmsshopTitle       = $_TCMS_CS_ARRAY['tcmsshop']['content']['sb_tcmsshop_title'];
$tcmsshopSubTitle    = $_TCMS_CS_ARRAY['tcmsshop']['content']['sb_tcmsshop_subtitle'];
$show_tcmsshop_title = $_TCMS_CS_ARRAY['tcmsshop']['content']['sb_show_tcmsshop_title'];
$cs_font_style     = $_TCMS_CS_ARRAY['tcmsshop']['content']['sb_font_style'];

$tcmsshopFolder   = $_TCMS_CS_ID['tcmsshop']['folder'];


if($_TCMS_CS_ARRAY['tcmsshop']['attribute']['sb_tcmsshop_title']['ENCODE'] == 1){
	$tcmsshopTitle = $tcms_main->encode_text_without_crypt($tcmsshopTitle, '2', $c_charset);
}





/*
	init
*/

if($show_tcmsshop_title == 1){
	echo $tcms_html->subTitle($tcmsshopTitle);
	//.$tcms_html->sidebarText($tcmsshopSubTitle);
	//echo '<br />';
}
else{
	echo '<br />';
}





/*
	add to cart link
*/

if(isset($article)) {
	$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
	.'id=components&amp;item=tcmsshop'
	.'&amp;cmd=add'
	.'&amp;article='.$article
	.'&amp;s='.$s
	.( isset($lang) ? '&amp;lang='.$lang : '' );
	$link = $tcms_main->urlConvertToSEO($link);
	
	// valign="top"
	echo '<div style="padding: 2px 0 0 0;">'
	.'<a class="main" title="'._PRODUCTS_ADD_TO_CART.'" href="'.$link.'">'
	.'<img style="margin-bottom: -4px;" src="'.$imagePath.'engine/images/cart_add.png"'
	.' border="0" alt="'._PRODUCTS_ADD_TO_CART.'" />'
	.'&nbsp;'
	._PRODUCTS_ADD_TO_CART
	.'</a>'
	.'</div>';
}





/*
	end
*/

echo '<br />';

?>
