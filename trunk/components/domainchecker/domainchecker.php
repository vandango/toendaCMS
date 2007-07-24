<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Aren Slootweg                                                  |
+------------------------------------------------------------------------+
|
| Domainchecker component
|
| File:	domainchecker.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Domainchecker component
 *
 * This components generates a domainchecker.
 *
 * @version 0.0.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Components
 * 
 */


if(isset($_GET['dc_name'])){ $dc_name = $_GET['dc_name']; }
if(isset($_GET['dc_domain'])){ $dc_domain = $_GET['dc_domain']; }

if(isset($_POST['dc_name'])){ $dc_name = $_POST['dc_name']; }
if(isset($_POST['dc_domain'])){ $dc_domain = $_POST['dc_domain']; }


$path = $tcms_administer_site.'/components/domainchecker/images';

$dcTitle       = $_TCMS_CS_ARRAY['domainchecker']['content']['dc_title'];
$dcSubTitle    = $_TCMS_CS_ARRAY['domainchecker']['content']['dc_subtitle'];
$show_dc_title = $_TCMS_CS_ARRAY['domainchecker']['content']['show_dc_title'];
$cs_font_style = $_TCMS_CS_ARRAY['domainchecker']['content']['font_style'];

$dcFolder = $_TCMS_CS_ID['domainchecker']['folder'];


if($_TCMS_CS_ARRAY['webcam']['attribute']['dc_title']['ENCODE'] == 1){
	$dcTitle = $tcms_main->encode_text_without_crypt($dcTitle, '2', $c_charset);
}

if($_TCMS_CS_ARRAY['domainchecker']['attribute']['dc_subtitle']['ENCODE'] == 1){
	$dcSubTitle = $tcms_main->decodeText($dcSubTitle, '2', $c_charset, true, true);
}



if($show_dc_title == 1){
	echo $tcms_html->contentTitle($dcTitle);
	echo $tcms_html->contentText($dcSubTitle);
	//echo '<br />';
}
else{
	echo '<br />';
}



using('toendacms.kernel.domaincheck');

$tcms_dc = new tcms_domaincheck();


$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
.'id=components&amp;item=domainchecker'
.'&amp;s='.$s
.( isset($lang) ? '&amp;lang='.$lang : '' );
$link = $tcms_main->urlConvertToSEO($link);

echo $tcms_dc->getDomainCheckForm($link, $dc_name, $dc_domain);



echo '<br />';
//echo '<br />';

?>
