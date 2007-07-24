<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Shop component
|
| File:	tcmsshop.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Shop component
 *
 * This components generates a shop.
 *
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Components
 * 
 */


$path = $tcms_administer_site.'/components/tcmsshop/images';

$tcmsshopTitle       = $_TCMS_CS_ARRAY['tcmsshop']['content']['tcmsshop_title'];
$tcmsshopSubTitle    = $_TCMS_CS_ARRAY['tcmsshop']['content']['tcmsshop_subtitle'];
$show_tcmsshop_title = $_TCMS_CS_ARRAY['tcmsshop']['content']['show_tcmsshop_title'];
$cs_font_style       = $_TCMS_CS_ARRAY['tcmsshop']['content']['font_style'];

$tcmsshopFolder      = $_TCMS_CS_ID['tcmsshop']['folder'];


if($_TCMS_CS_ARRAY['tcmsshop']['attribute']['tcmsshop_title']['ENCODE'] == 1){
	$tcmsshopTitle = $tcms_main->encode_text_without_crypt($tcmsshopTitle, '2', $c_charset);
}



if($show_tcmsshop_title == 1){
	echo $tcms_html->contentTitle($tcmsshopTitle);
	echo $tcms_html->contentText($tcmsshopSubTitle);
	//echo '<br />';
}
else{
	echo '<br />';
}



echo '<br />';
//echo '<br />';

?>
