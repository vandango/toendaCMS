<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS documentation
|
| File:		mod_documentation.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS documentation
 *
 * This is used as a documents wiki wrapper.
 *
 * @version 0.0.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


echo tcms_html::bold(_DOCU_TITLE);
echo _DOCU_TEXT;
echo '<br /><br />';


echo '<iframe src="http://wiki.toendacms.com/index.php/Main_Page" class="tcms_help_frame" frameborder="1" />';

$lang_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml', 'r');
$tcms_lang = $lang_xml->read_section('global', 'lang');

if(file_exists('documentation/documentation_'.$tcms_lang.'.html')) {
	include('documentation_'.$tcms_lang.'.html');
}
else {
	include('documentation_english_EN.html');
}

echo '</iframe>';


?> 
