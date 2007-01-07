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
| File:		ext_layoutchanger.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * "Layout Changer" Extension
 *
 * This module provides the layout changer functionality.
 *
 * @version 0.2.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */


if($use_layout_chooser == 1){
	if($choosenDB == 'xml'){
		$layout_xml    = new xmlparser($tcms_administer_site.'/tcms_global/sidebar.xml','r');
		$show_ct       = $layout_xml->read_section('side', 'show_chooser_title');
		$chooser_title = $layout_xml->read_section('side', 'chooser_title');
		
		$chooser_title = $tcms_main->decodeText($chooser_title, '2', $c_charset);
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidebar_extensions', 'sidebar_extensions');
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		$show_ct       = $sqlARR['show_chooser_title'];
		$chooser_title = $sqlARR['chooser_title'];
		
		$chooser_title = $tcms_main->decodeText($chooser_title, '2', $c_charset);
	}
	
	
	$arr_webtheme  = $tcms_main->readdir_ext('theme/');
	
	
	if($show_ct == 1){ echo tcms_html::subtitle($chooser_title); }
	
	echo '<div align="center">';
	echo '<img id="show_thumbnail" src="'.$imagePath.'theme/'.$s.'/thumbnail.jpg" border="0" style="border: 1px solid #777777;" alt="Thumbnail" />';
	
	$link = '?'.( isset($session) ? 'session='.$session : '' ).( isset($u) ? '&amp;u='.$u : '' );
	
	echo '<form name="selectform" action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).''.$link.'" method="post">'
	.'<input type="hidden" name="id" value="'.$id.'" />'
	.( isset($lang) ? '<input type="hidden" name="lang" value="'.$lang.'" />' : '' );
	
	echo '<select name="s" onchange="document.getElementById(\'show_thumbnail\').src=\''.$imagePath.'theme/\'+this.value+\'/thumbnail.jpg\';">';
	
	foreach ($arr_webtheme as $lc_key => $lc_value){
		if($lc_value != 'printer' && ( substr($lc_value, 0, 1) != '.' )){
			$lc_template_xml = new xmlparser('theme/'.$lc_value.'/index.xml','r');
			$layout_name=$lc_template_xml->read_section('template', 'name');
			
			echo '<option'.( $lc_value == $s ? ' selected' : '' ).' value="'.$lc_value.'">'.$layout_name.'</option>';
		}
	}
	
	echo '</select>
	<input type="submit" value="GO" class="inputbutton" />
	</form>';
	echo '</div>';
	
	echo '<br /><br />';
}

?>
