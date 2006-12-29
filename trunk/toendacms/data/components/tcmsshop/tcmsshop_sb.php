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


if(isset($_GET['dc_name'])){ $dc_name = $_GET['dc_name']; }
if(isset($_GET['dc_domain'])){ $dc_domain = $_GET['dc_domain']; }

if(isset($_POST['dc_name'])){ $dc_name = $_POST['dc_name']; }
if(isset($_POST['dc_domain'])){ $dc_domain = $_POST['dc_domain']; }





$path = $tcms_administer_site.'/components/tcmsshop/images';

$tcmsshopTitle       = $_TCMS_CS_ARRAY['tcmsshop']['content']['sb_tcmsshop_title'];
$tcmsshopSubTitle    = $_TCMS_CS_ARRAY['tcmsshop']['content']['sb_tcmsshop_subtitle'];
$show_tcmsshop_title = $_TCMS_CS_ARRAY['tcmsshop']['content']['sb_show_tcmsshop_title'];
$cs_font_style     = $_TCMS_CS_ARRAY['tcmsshop']['content']['sb_font_style'];

$tcmsshopFolder   = $_TCMS_CS_ID['tcmsshop']['folder'];


if($_TCMS_CS_ARRAY['tcmsshop']['attribute']['sb_tcmsshop_title']['ENCODE'] == 1){
	$tcmsshopTitle = $tcms_main->encode_text_without_crypt($tcmsshopTitle, '2', $c_charset);
}




if($show_tcmsshop_title == 1){
	echo tcms_html::subtitle($tcmsshopTitle);
	echo tcms_html::sidemain($tcmsshopSubTitle);
	//echo '<br />';
}
else{
	echo '<br />';
}


echo '<br />';
//echo '<br />';

?>
