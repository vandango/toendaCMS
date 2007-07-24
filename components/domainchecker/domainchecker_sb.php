<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Domainchecker sidebar component
|
| File:	domainchecker_sb.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Domainchecker sidebar component
 *
 * This components generates a domainchecker.
 *
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Components
 * 
 */


$path = $tcms_administer_site.'/components/domainchecker/images';

$dcTitle       = $_TCMS_CS_ARRAY['domainchecker']['content']['sb_dc_title'];
$dcSubTitle    = $_TCMS_CS_ARRAY['domainchecker']['content']['sb_dc_subtitle'];
$show_dc_title = $_TCMS_CS_ARRAY['domainchecker']['content']['sb_show_dc_title'];
$cs_font_style = $_TCMS_CS_ARRAY['domainchecker']['content']['sb_font_style'];

$dcFolder   = $_TCMS_CS_ID['domainchecker']['folder'];


if($_TCMS_CS_ARRAY['domainchecker']['attribute']['sb_dc_title']['ENCODE'] == 1){
	$dcTitle = $tcms_main->decodeText($dcTitle, '2', $c_charset, true, true);
}

if($_TCMS_CS_ARRAY['domainchecker']['attribute']['sb_dc_subtitle']['ENCODE'] == 1){
	$dcSubTitle = $tcms_main->decodeText($dcSubTitle, '2', $c_charset, true, true);
}



if($show_dc_title == 1){
	echo $tcms_html->sidebarTitle($dcTitle)
	.'<br />'
	.$tcms_html->sidebarText($dcSubTitle);
	//echo '<br />';
}
else{
	echo '<br />';
}



echo '<br />';
//echo '<br />';

?>
