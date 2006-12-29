<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Template Manager
|
| File:		mod_layout.php
| Version:	0.3.6
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



if(isset($_POST['select'])){ $select = $_POST['select']; }
if(isset($_POST['delete'])){ $delete = $_POST['delete']; }
if(isset($_POST['selectADM'])){ $selectADM = $_POST['selectADM']; }
if(isset($_POST['deleteADM'])){ $deleteADM = $_POST['deleteADM']; }




if($id_group == 'Developer' || $id_group == 'Administrator'){
	if(!is_writeable('../../'.$tcms_administer_site.'/tcms_global/layout.xml')){
		chmod('../../'.$tcms_administer_site.'/tcms_global/layout.xml', 0777);
	}
	
	if(!isset($todo)){ $todo == 'show'; }
	
	$layout_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/layout.xml','r');
	$sel = $layout_xml->read_section('layout', 'select');
	$adm = $layout_xml->read_section('layout', 'admin');
	
	//echo '<script>alert(\''.$sel.' - '.$adm.'\');</script>';
	
	
	
	
	
	
	if($todo == 'show'){
		//=====================================================
		// INIT
		//=====================================================
		
		$arr_theme = $tcms_main->readdir_ext('../../theme/');
		$arr_admin = $tcms_main->readdir_ext('theme/');
		
		$arr_farbe[0] = $arr_color[0];
		$arr_farbe[1] = $arr_color[1];
		$bgkey = 0;
		
		
		
		
		
		
		
		//==================================================
		// BEGIN FORM
		//==================================================
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_layout" method="post">'
		.'<input type="hidden" name="todo" value="save" />';
		
		
		
		/*
			Layout
		*/
		
		echo '<div style="margin: 0 0 3px 0;"><strong class="tcms_ft_white">'._LAYOUT_FRONTEND.'</strong></div>';
		
		echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
		echo '<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title" width="2%">'._LAYOUT_SELECT.'&nbsp;</th>'
		.'<th valign="middle" class="tcms_db_title" width="2%">'._TABLE_DELETE.'</th>'
		.'<th valign="middle" class="tcms_db_title" align="left">'._LAYOUT_NAME.'</th>'
		.'<th valign="middle" class="tcms_db_title" align="left">'._LAYOUT_AUTOR.'</th>'
		.'<th valign="middle" class="tcms_db_title" align="left">'._LAYOUT_URL.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._LAYOUT_VERSION.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%">'._LAYOUT_PREVIEW.'</th><tr>';
		
		foreach ($arr_theme as $zahl => $value){
			if($value != 'printer' && ( substr($value, 0, 1) != '.' )){
				$nailer = 0;
				
				$arr_index_thumbnails = $tcms_main->readdir_ext('../../theme/'.$value);
				while(substr($arr_index_thumbnails[$nailer], 0, 9) != 'thumbnail'){ $nailer++; }
				
				$template_xml = new xmlparser('../../theme/'.$value.'/index.xml','r');
				$name           = $template_xml->read_section('template', 'name');
				$autor          = $template_xml->read_section('template', 'autor');
				$url            = $template_xml->read_section('template', 'url');
				$desc           = $template_xml->read_section('template', 'desc');
				$layout_version = $template_xml->read_section('template', 'version');
				
				$bgkey++;
				if(is_integer($bgkey/2)){ $ws_farbe=$arr_farbe[0]; } else{ $ws_farbe=$arr_farbe[1]; }
				
				echo '<tr bgcolor="'.( $sel == $value ? '#e0e0e0' : $ws_farbe ).'" class="noborder">';
				
				echo '<td valign="top" width="5" align="center"><input name="select" type="radio" value="'.$arr_theme[$zahl].'"'.( $sel == $value ? ' checked="checked"' : '' ).' /></td>';
				echo '<td valign="top" width="5" align="center">'.( $value != 'printer' ? '<input name="delete" type="radio" value="'.$arr_theme[$zahl].'" />' : '' ).'</td>';
				
				echo '<td valign="top">&nbsp;<strong><em>'.$name.'</em></strong></td>';
				echo '<td valign="top">&nbsp;<em>'.$autor.'</em></td>';
				echo '<td valign="top">&nbsp;<em><a class="main" href="'.( substr($url, 0, 4) != 'http' ? 'http://'.$url : $url ).'">'.$url.'</a></em></td>';
				echo '<td valign="top" width="5%" align="center"><em>'.$layout_version.'</em></td>';
				
				echo '<td valign="top" width="10%" align="center" onmouseover="javascript:Menu.doHide(); Menu.show(\'snv'.$zahl.'\');" onmouseout="javascript:Menu.hide();">'
				.'<img border="0" src="../images/preview.png"> '._LAYOUT_PREVIEW.'';
				
				echo '<div id="snv'.$zahl.'" onmouseover="javascript:Menu.show(\'snv'.$zahl.'\');" onmouseout="javascript:Menu.hide();" style="position: absolute; margin: 0 0 0 -100px; visibility: hidden;" class="tcms_preview_box">'
				.'&nbsp;'.$name.'<br />'
				.'<img src="../../theme/'.$arr_theme[$zahl].'/'.$arr_index_thumbnails[$nailer].'" border="0" alt="Thumbnail" />'
				.'</div>';
				
				echo '</td>';
				
				echo '</tr>';
				
				echo '<tr bgcolor="'.( $sel == $value ? '#e0e0e0' : $ws_farbe ).'"><td colspan="7" class="tcms_db_2">'.$desc;
				echo '</td></tr>';
			}
		}
		
		echo '<tr class="tcms_bg_blue_01"><td width="250" class="tcms_db_title tcms_padding_mini" colspan="9">
			<strong>'._LAYOUT_COUNT.':</strong> '.$bgkey.'
		</td></tr>';
		
		echo '</table><br />';
		
		
		
		
		
		
		/*
			Admin Layout
		*/
		
		echo '<div style="margin: 0 0 3px 0;"><strong class="tcms_ft_white">'._LAYOUT_BACKEND.'</strong></div>';
		
		unset($arr_index_thumbnails);
		$bgkey = 0;
		
		echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
		echo '<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title" width="2%">'._LAYOUT_SELECT.'&nbsp;</th>'
		.'<th valign="middle" class="tcms_db_title" width="2%">'._TABLE_DELETE.'</th>'
		.'<th valign="middle" class="tcms_db_title" align="left">'._LAYOUT_NAME.'</th>'
		.'<th valign="middle" class="tcms_db_title" align="left">'._LAYOUT_AUTOR.'</th>'
		.'<th valign="middle" class="tcms_db_title" align="left">'._LAYOUT_URL.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._LAYOUT_VERSION.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%">'._LAYOUT_PREVIEW.'</th><tr>';
		
		foreach ($arr_admin as $key => $value){
			if($value != 'printer' && ( substr($value, 0, 1) != '.' )){
				$nailer = 0;
				
				$arr_index_thumbnails = $tcms_main->readdir_ext('theme/'.$value);
				while(substr($arr_index_thumbnails[$nailer], 0, 9) != 'thumbnail'){ $nailer++; }
				
				$template_xml = new xmlparser('theme/'.$value.'/index.xml','r');
				$name           = $template_xml->read_section('template', 'name');
				$autor          = $template_xml->read_section('template', 'autor');
				$url            = $template_xml->read_section('template', 'url');
				$desc           = $template_xml->read_section('template', 'desc');
				$layout_version = $template_xml->read_section('template', 'version');
				
				$bgkey++;
				if(is_integer($bgkey/2)){ $ws_farbe = $arr_farbe[0]; } else{ $ws_farbe = $arr_farbe[1]; }
				
				echo '<tr bgcolor="'.( $adm == $value ? '#e0e0e0' : $ws_farbe ).'" class="noborder">';
				
				echo '<td valign="top" width="5" align="center"><input name="selectADM" type="radio" value="'.$arr_admin[$key].'"'.( $adm == $value ? ' checked="checked"' : '' ).' /></td>';
				echo '<td valign="top" width="5" align="center">'.( $value != 'printer' ? '<input name="deleteADM" type="radio" value="'.$arr_admin[$key].'" />' : '' ).'</td>';
				
				echo '<td valign="top">&nbsp;<strong><em>'.$name.'</em></strong></td>';
				echo '<td valign="top">&nbsp;<em>'.$autor.'</em></td>';
				echo '<td valign="top" align="left">&nbsp;<em><a class="main" href="'.( substr($url, 0, 4) != 'http' ? 'http://'.$url : $url ).'">'.$url.'</a></em></td>';
				echo '<td valign="top" width="5%" align="center"><em>'.$layout_version.'</em></td>';
				
				echo '<td valign="top" width="10%" align="center" onmouseover="javascript:Menu.doHide(); Menu.show(\'adms'.$key.'\');" onmouseout="javascript:Menu.hide();">'
				.'<img border="0" src="../images/preview.png"> '._LAYOUT_PREVIEW.'';
				
				echo '<div id="adms'.$key.'" onmouseover="javascript:Menu.show(\'adms'.$key.'\');" onmouseout="javascript:Menu.hide();" style="position: absolute; margin: 0 0 0 -100px; visibility: hidden; border: 2px solid #336699; background-color: #fff;">'
				.'&nbsp;'.$name.'<br />'
				.'<img src="theme/'.$arr_admin[$key].'/'.$arr_index_thumbnails[$nailer].'" border="0" alt="Thumbnail" />'
				.'</div>';
				
				echo '</td>';
				
				echo '</tr>';
				
				echo '<tr bgcolor="'.( $adm == $value ? '#e0e0e0' : $ws_farbe ).'"><td colspan="7" class="tcms_db_2">'.$desc;
				echo '</td></tr>';
			}
		}
		
		echo '<tr class="tcms_bg_blue_01"><td width="250" class="tcms_db_title tcms_padding_mini" colspan="9">
			<strong>'._LAYOUT_COUNT.':</strong> '.$bgkey.'
		</td></tr>';
		
		echo '</table><br />';
		
		
		
		
		/*
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/'.$var_conf.'.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('layout');
		
		$xmluser->write_value('select', $sel);
		$xmluser->write_value('admin', $adm);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('layout');
		$xmluser->_xmlparser();
		*/
		echo '</form>';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//============================================================
	// TODO
	//============================================================
	
	if($todo == 'save'){
		//***************************************
		//
		// WRITE XML
		//
		
		if(isset($select) && !empty($select))      { $ws_command = 'change'; }
		if(isset($delete) && !empty($delete))      { $ws_command = 'delete'; $path = $delete; }
		if(isset($deleteADM) && !empty($deleteADM)){ $ws_command = 'deleteADM'; $path = $deleteADM; }
		
		// CHANGE
		switch($ws_command){
			case 'change':
				if(empty($select))   { $select    = $sel; }
				if(empty($selectADM)){ $selectADM = $adm; }
				
				$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/layout.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('layout');
				
				$xmluser->write_value('select', $select);
				$xmluser->write_value('admin', $selectADM);
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('layout');
				$xmluser->_xmlparser();
				
				echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_layout\';</script>';
				break;
			
			case 'delete':
				// remove data folders
				$dir = opendir('../../theme/'.$path.'/');
				while($entry = readdir($dir)){
					if($entry != '.' && $entry != '..' && $entry != 'index.php' && $entry != 'index.xml' && $entry != 'thumbnail.jpg'){
						$sec_path = $entry;
						$tcms_main->rmdirr('../../theme/'.$path.'/'.$sec_path.'/');
					}
				}
				closedir($dir);
				
				// remove theme folder
				$tcms_main->rmdirr('../../theme/'.$path.'/');
				
				echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_layout\';</script>';
				break;
			
			case 'deleteADM':
				$dir = opendir('theme/'.$path.'/');
				while($entry = readdir($dir)){
					if($entry != '.' && $entry != '..' && $entry != 'index.php' && $entry != 'index.xml' && $entry != 'thumbnail.jpg'){
						$sec_path = $entry;
						$tcms_main->rmdirr('theme/'.$path.'/'.$sec_path.'/');
					}
				}
				closedir($dir);
				
				// remove theme folder
				$tcms_main->rmdirr('theme/'.$path.'/');
				
				echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_layout\';</script>';
				break;
		}
		
		//***************************************
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
