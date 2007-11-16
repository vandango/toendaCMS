<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| "Layout Changer" Extension
|
| File:	ext_layoutchanger.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * "Layout Changer" Extension
 *
 * This module provides the layout changer functionality.
 *
 * @version 0.2.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */


if($use_layout_chooser == 1) {
	using('toendacms.datacontainer.sidebarextensions');
	
	$seDC = new tcms_dc_sidebarextensions();
	$seDC = $tcms_dcp->getSidebarExtensionSettings();
	
	
	$arr_webtheme  = $tcms_file->getPathContent('theme/');
	
	
	if($seDC->getShowLayoutChooserTitle()) {
		echo $tcms_html->subTitle($seDC->getLayoutChooserTitle());
	}
	
	echo '<div align="center">'
	.'<img id="show_thumbnail" src="'.$imagePath.'theme/'.$s.'/thumbnail.jpg" border="0" style="border: 1px solid #777777;" alt="Thumbnail" />';
	
	$link = '?'.( isset($session) ? 'session='.$session : '' ).( isset($u) ? '&amp;u='.$u : '' );
	
	echo '<form name="selectform" action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).''.$link.'" method="post">'
	.'<input type="hidden" name="id" value="'.$id.'" />'
	.( isset($lang) ? '<input type="hidden" name="lang" value="'.$lang.'" />' : '' )
	.'<select name="s" onchange="document.getElementById(\'show_thumbnail\').src=\''.$imagePath.'theme/\'+this.value+\'/thumbnail.jpg\';">';
	
	foreach($arr_webtheme as $lc_key => $lc_value) {
		if($lc_value != 'printer' && ( substr($lc_value, 0, 1) != '.' )) {
			$xml = new xmlparser('theme/'.$lc_value.'/index.xml','r');
			$layout_name = $xml->readSection('template', 'name');
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			echo '<option'.( $lc_value == $s ? ' selected' : '' ).' value="'.$lc_value.'">'
			.$layout_name
			.'</option>';
		}
	}
	
	echo '</select>'
	.'<input type="submit" value="GO" class="inputbutton" />'
	.'</form>'
	.'</div>'
	.'<br />'
	.'<br />';
}

?>
