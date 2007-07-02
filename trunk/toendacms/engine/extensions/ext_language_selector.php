<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Language Selector
|
| File:	ext_language_selector.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Language Selector
 *
 * This module is used for a language selector.
 *
 * @version 0.0.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


if($tcms_config->useContentLanguage()){
	using('toendacms.datacontainer.sidebarextensions');
	
	
	$seDC = new tcms_dc_sidebarextensions();
	$seDC = $tcms_dcp->getSidebarExtensionSettings();
	
	$arr_lang = explode(';', $seDC->getLanguages());
	
	
	echo '<div class="langSelector">';
	
	if($tcms_main->isReal($arr_lang)) {
		foreach($languages['fine'] as $key => $val) {
			if(in_array($val, $arr_lang)) {
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id='.( $id == 'components' ? $id.'&amp;item='.$item : $id ).'&amp;s='.$s.'&amp;lang='.$val;
				$link = $tcms_main->urlConvertToSEO($link);
				
				$title = ' title="'.$languages['name'][$key].'"';
				$alt = ' alt="'.$languages['name'][$key].'"';
				
				echo '&nbsp;<a'.$title.$alt.' class="langSelectorLink" href="'.$link.'">'
				.'<img'.$title.$alt.' src="'.$imagePath.'engine/images/flags/'.$val.'.png" border="0" />'
				.'</a>';
			}
		}
	}
	
	echo '</div>';
}

?>
