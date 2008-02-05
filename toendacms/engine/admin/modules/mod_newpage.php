<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| NewPage Wizard
|
| File:	mod_newpage.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * NewPage Wizard
 *
 * This module is used for a wizard to create a new page.
 *
 * @version 0.4.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_POST['np_title'])){ $np_title = $_POST['np_title']; }
if(isset($_POST['which_menu'])){ $which_menu = $_POST['which_menu']; }
if(isset($_POST['tmp_order'])){ $tmp_order = $_POST['tmp_order']; }
if(isset($_POST['access'])){ $access = $_POST['access']; }
if(isset($_POST['tmp_linkto'])){ $tmp_linkto = $_POST['tmp_linkto']; }
if(isset($_POST['new_published'])){ $new_published = $_POST['new_published']; }
if(isset($_POST['language'])){ $language = $_POST['language']; }





//=====================================================
// INIT
//=====================================================

if($id_group == 'Developer' || $id_group == 'Administrator'){
	echo '<script language="JavaScript" src="../js/dhtml.js"></script>';
	
	if(!isset($todo)){ $todo = 'show'; }
	
	$width = 200;
	
	if(!isset($which_menu)){ $which_menu = 'sidemenu'; }
	
	
	
	
	if($choosenDB == 'xml'){
		$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_menu/');
		$i = $z = 0;
		while(!empty($arr_filename[$i])){
			$arr_maintag[$i] = substr($arr_filename[$i],0,5);
			$all_xml = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$arr_filename[$i],'r');
			
			$ltype = $all_xml->read_section('menu', 'type');
			if($ltype == 'link'){
				$arr_parent['id'][$z]     = $all_xml->read_value('id');
				$arr_parent['subid'][$z]  = ( !$all_xml->read_value('subid') ? $all_xml->read_value('subid') : '-' );
				$arr_parent['parent'][$z] = ( !$all_xml->read_value('parent') ? $all_xml->read_value('parent') : '0' );
				$arr_parent['name'][$z]   = $all_xml->read_value('name');
				
				$arr_parent['name'][$z] = $tcms_main->decodeText($arr_parent['name'][$z], '2', $c_charset);
				$z++;
			}	
			$i++;
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getAll($tcms_db_prefix."sidemenu WHERE type='link'");
		
		$count = 0;
		
		while($sqlARR = $sqlAL->fetchArray($sqlQR)){
			$arr_parent['id'][$count]     = trim($sqlARR['id']);
			$arr_parent['subid'][$count]  = trim($sqlARR['subid']);
			$arr_parent['parent'][$count] = trim($sqlARR['parent']);
			$arr_parent['name'][$count]   = trim($sqlARR['name']);
			
			if($arr_parent['id'][$count]     == NULL){ $arr_parent['id'][$count]     = ''; }
			if($arr_parent['subid'][$count]  == NULL){ $arr_parent['subid'][$count]  = '-'; }
			if($arr_parent['parent'][$count] == NULL){ $arr_parent['parent'][$count] = '-'; }
			if($arr_parent['name'][$count]   == NULL){ $arr_parent['name'][$count]   = ''; }
			
			// CHARSETS
			$arr_parent['name'][$count] = $tcms_main->decodeText($arr_parent['name'][$count], '2', $c_charset);
			
			$count++;
			$checkCatAmount = $count;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	if(is_array($arr_parent)){
		array_multisort(
			$arr_parent['id'], SORT_ASC, 
			$arr_parent['subid'], SORT_ASC, 
			$arr_parent['parent'], SORT_ASC, 
			$arr_parent['name'], SORT_ASC
		);
	}
	
	
	
	
	
	//=====================================================
	// SET VALUES
	//=====================================================
	
	if($todo == 'show'){
		echo $tcms_html->bold(_NEWPAGE_TITLE);
		echo $tcms_html->text(_NEWPAGE_TEXT.'<br /><br />', 'left');
		
		echo '<form action="admin.php?id_user='.$id_user.'&site=mod_newpage" method="POST">';
		
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder"><tr class="tcms_bg_blue_01"">';
		echo '<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>';
		echo '</tr></table>';
		
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
		
		//================================================
		
		// row
		if($tcms_config->useContentLanguage()) {
			echo '<tr><td valign="top" width="'.$width.'">'
			.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
			.'</td><td>'
			.'<select class="tcms_select" id="language" name="language">';
			
			foreach($languages['code'] as $key => $value) {
				if($value != $tcms_config->getLanguageCode(true)) {
					if($tm_lang == $value) {
						$dl = ' selected="selected"';
					}
					else {
						$dl = '';
					}
					
					echo '<option value="'.$value.'"'.$dl.'>'
					.$languages['name'][$key]
					.'</option>';
				}
			}
			
			echo '</select>'
			.'</td></tr>';
		}
		
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TITLE.'</b>
		</td><td><input class="tcms_input_normal" name="np_title" type="text" value="" />
		</td></tr>';
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_WHICHMENU.'</b>
		</td><td>
			<select name="which_menu" class="tcms_select">
				<option value="sidemenu">'._TABLE_SIDEMENU.'</option>
				<option value="topmenu">'._TABLE_TOPMENU.'</option>
			</select>
			'._TABLE_MENUINFO.'
		</td></tr>';
		
		
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_PARENT.'</b>
		</td><td valign="top">';
		echo '<select name="tmp_order" class="tcms_select">
			<option selected value="-"> &bull; '._TABLE_PARENTC.' &bull; </option>
			<option selected value="-"> &bull; '._TABLE_PARENTN.' &bull; </option>';
			foreach($arr_parent['id'] as $key => $value){		
				if($arr_parent['subid'][$key] == '-'){ echo '<option value="'.( $arr_parent['subid'][$key] == '-' ? $value : '-' ).'">'.( $arr_parent['subid'][$key] == '-' ? $arr_parent['name'][$key] : '&nbsp;-&nbsp;'.$arr_parent['name'][$key] ).'</option>'; }
			}
			echo '</select>';
		echo '</td></tr>';
		
		
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ACCESS.'</b>
		</td><td>
			<select name="access" class="tcms_select">
				<option value="Public">'._TABLE_PUBLIC.'</option>
				<option value="Protected">'._TABLE_PROTECTED.'</option>
				<option value="Private">'._TABLE_PRIVATE.'</option>
			</select>
		</td></tr>';
		
		
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_LINKTO.'</b>
		</td><td valign="top">';
		echo '<select name="tmp_linkto" class="tcms_select">
			<option selected value="new_page"> &bull; '._TABLE_NEW.' &bull; </option>';
			foreach($arr_linkcom['link'] as $key => $value){
				echo '<option value="'.$arr_linkcom['link'][$key].'">'.$arr_linkcom['name'][$key].'</option>';
			}
			echo '</select>';
		echo '</td></tr>';
		
		
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_PUBLISHED.'</b>
		</td><td>
			<input name="new_published" type="checkbox" value="1" />
		</td></tr>';
		
		//================================================
		
		echo '<input name="todo" type="hidden" value="edit" />';
		echo '</form>';
		echo '</table><br />';
	}
	
	
	
	
	
	//=====================================================
	// CREATE PAGE
	//=====================================================
	
	if($todo == 'edit'){
		switch($which_menu){
			case 'sidemenu':
				if($tmp_order != '-'){
					/************************
					* SUB MENU ID GENERTAOR
					*/
					$id_main = $tmp_order;
					
					if($choosenDB == 'xml'){
						$arr_fn = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_menu/');
						$x = 0;
						foreach($arr_fn as $key => $value){
							$all_xml = new xmlparser(_TCMS_PATH.'/tcms_menu/'.$value,'r');
							$arr_i[$key] = $all_xml->read_value('id');
							$arr_s[$key] = ( !$all_xml->read_value('subid') ? $all_xml->read_value('subid') : '-' );
							
							if($arr_i[$key] == $id_main){
								$arr_sub['id'][$x]  = $arr_i[$key];
								$arr_sub['sub'][$x] = $arr_s[$key];
								$x++;
							}
						}
						
						$id_sub = ( max($arr_sub['sub']) == '-' ? '0' : max($arr_sub['sub']) + 1 );
					}
					else{
						$id_sub = $tcms_main->create_sort_id_sub($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'sidemenu', 'subid', 'parent', $id_main);
						
						if($id_sub != null){ $id_sub = $id_sub + 1; }
						else{ $id_sub = '-'; }
					}
					
					$parent = $tmp_order;
				}
				else{
					$id_main = max($arr_parent['id']) + 1;
					$id_sub  = '-';
					$parent  = '-';
				}
				$tcms_menu = $tcms_db_prefix.'menu';
				break;
			
			//****************************************************
			case 'topmenu':
				$id_main   = max($arr_parent['id']) + 1;
				$tcms_menu = $tcms_db_prefix.'topmenu';
				break;
		}
		
		
		switch($tmp_linkto){
			case 'new_page':
				$new_linkto = $tcms_main->getNewUID(5, 'content');
				$relocate = 'mod_content';
				break;
			
			case 'knowledgebase':
				$new_linkto = 'knowledgebase';
				$relocate = 'mod_knowledgebase';
				break;
			
			case 'products':
				$new_linkto = 'products';
				$relocate = 'mod_products';
				break;
			
			case 'links':
				$new_linkto = 'links';
				$relocate = 'mod_links';
				break;
			
			case 'download':
				$new_linkto = 'download';
				$relocate = 'mod_download';
				break;
			
			case 'contactform':
				$new_linkto = 'contactform';
				$relocate = 'mod_contactform';
				break;
			
			case 'imprint':
				$new_linkto = 'imprint';
				$relocate = 'mod_imprint';
				break;
			
			case 'guestbook':
				$new_linkto = 'guestbook';
				$relocate = 'mod_guestbook_config';
				break;
			
			case 'frontpage':
				$new_linkto = 'frontpage';
				$relocate = 'mod_frontpage';
				break;
			
			case 'newsmanager':
				$new_linkto = 'newsmanager';
				$relocate = 'mod_news';
				break;
			
			case 'imagegallery':
				$new_linkto = 'imagegallery';
				$relocate = 'mod_gallery';
				break;
			
			case 'polls':
				$new_linkto = 'polls';
				$relocate = 'mod_poll';
				break;
			
			case 'search':
				$new_linkto = 'search';
				$relocate = 'mod_start';
				break;
			
			default:
				$new_linkto = $tmp_linkto;
				$relocate = 'mod_content';
				break;
		}
		
		
		$maintag = $tcms_main->getNewUID(5, 'sidemenu');
		
		
		$np_title = $tcms_main->encodeText($np_title, '2', $c_charset);
		
		if(empty($new_published) || !isset($new_published)){ $new_published = 0; }
		
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser(_TCMS_PATH.'/'.$tcms_menu.'/'.$maintag.'.xml', 'w');
			$xmluser->xmlDeclaration();
			if($tcms_menu == $tcms_db_prefix.'topmenu'){ $xmluser->xmlSection('top'); }
			else{ $xmluser->xmlSection('menu'); }
			
			$xmluser->writeValue('name', $np_title);
			$xmluser->writeValue('id', $id_main);
			
			if($tcms_menu == $tcms_db_prefix.'menu'){
				$xmluser->writeValue('subid', $id_sub);
				$xmluser->writeValue('type', 'link');
				$xmluser->writeValue('parent', $parent);
			}
			
			$xmluser->writeValue('language', $language);
			$xmluser->writeValue('link', $new_linkto);
			$xmluser->writeValue('published', $new_published);
			if($tcms_menu == $tcms_db_prefix.'menu' || $tcms_menu == $tcms_db_prefix.'topmenu'){
				$xmluser->writeValue('access', $access);
			}
			
			$xmluser->xmlSectionBuffer();
			
			if($tcms_menu == $tcms_db_prefix.'topmenu'){ $xmluser->xmlSectionEnd('top'); }
			else{ $xmluser->xmlSectionEnd('menu'); }
		}
		else{
			if($tcms_menu == $tcms_db_prefix.'menu'){ $tcms_menu = $tcms_db_prefix.'sidemenu'; }
			
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`name`, `id`';
					$newSQLData = "'".$np_title."', ".$id_main;
					
					if($tcms_menu == $tcms_db_prefix.'sidemenu'){
						$newSQLColumns .= ', `subid`, `parent`';
						$newSQLData .= ", '".$id_sub."', '".$parent."'";
					}
					
					$newSQLColumns .= ', `type`, `link`, `published`, `access`, `language`';
					$newSQLData .= ", 'link', '".$new_linkto."', ".$new_published.", '".$access."', '".$language."'";
					break;
				
				case 'pgsql':
					$newSQLColumns = 'name, id';
					$newSQLData = "'".$np_title."', ".$id_main;
					
					if($tcms_menu == $tcms_db_prefix.'sidemenu'){
						$newSQLColumns .= ', subid, parent';
						$newSQLData .= ", '".$id_sub."', '".$parent."'";
					}
					
					$newSQLColumns .= ', "type", link, published, "access", "language"';
					$newSQLData .= ", 'link', '".$new_linkto."', ".$new_published.", '".$access."', '".$language."'";
					break;
				
				case 'mssql':
					$newSQLColumns = '[name], [id]';
					$newSQLData = "'".$np_title."', ".$id_main;
					
					if($tcms_menu == $tcms_db_prefix.'sidemenu'){
						$newSQLColumns .= ', [subid], [parent]';
						$newSQLData .= ", '".$id_sub."', '".$parent."'";
					}
					
					$newSQLColumns .= ', [type], [link], [published], [access], [language]';
					$newSQLData .= ", 'link', '".$new_linkto."', ".$new_published.", '".$access."', '".$language."'";
					break;
			}
			
			$sqlAL->createOne($tcms_menu, $newSQLColumns, $newSQLData, $maintag);
		}
		
		
		
		if($choosenDB == 'xml'){
			if(!file_exists(_TCMS_PATH.'/tcms_content/'.$new_linkto.'.xml')){
				$content_not_exists = true;
			}
			else{ $content_not_exists = false; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->getOne($tcms_db_prefix.'content', $new_linkto);
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			if($sqlNR == 0){ $content_not_exists = true; }
			else{ $content_not_exists = false; }
		}
		
		
		
		if($relocate == 'mod_content' && $content_not_exists) {
			if($choosenDB == 'xml'){
				$xmluser = new xmlparser(_TCMS_PATH.'/tcms_content/'.$new_linkto.'.xml', 'w');
				
				$xmluser->xmlDeclarationWithCharset($c_charset);
				$xmluser->xmlSection('main');
				
				$xmluser->writeValue('title', $np_title);
				$xmluser->writeValue('key', '');
				$xmluser->writeValue('content00', '');
				$xmluser->writeValue('content01', '');
				$xmluser->writeValue('foot', '');
				$xmluser->writeValue('id', $new_linkto);
				//$xmluser->writeValue('db_layout', '');
				$xmluser->writeValue('access', $access);
				
				$xmluser->xmlSectionBuffer();
				$xmluser->xmlSectionEnd('main');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`title`, `access`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'title, "access"';
						break;
					
					case 'mssql':
						$newSQLColumns = '[title], [access]';
						break;
				}
				
				$newSQLData = "'".$np_title."', '".$access."'";
				
				$sqlAL->createOne($tcms_db_prefix.'content', $newSQLColumns, $newSQLData, $new_linkto);
			}
		}
		
		echo '<script>'
		.'alert(\''._MSG_SAVED.'\');'
		.'document.location=\'admin.php?id_user='.$id_user.'&site='.( $relocate == 'mod_content' ? $relocate.'&todo=edit&maintag='.$new_linkto : $relocate ).'\';'
		.'</script>';
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
