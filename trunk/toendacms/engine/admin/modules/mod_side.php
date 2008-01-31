<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Sidebar Content Manager
|
| File:	mod_side.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Sidebar Content Manager
 *
 * This module is used for the sidebar content.
 *
 * @version 0.5.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['check'])){ $check = $_GET['check']; }

if(isset($_POST['new_sb_title'])){ $new_sb_title = $_POST['new_sb_title']; }
if(isset($_POST['new_sb_key'])){ $new_sb_key = $_POST['new_sb_key']; }
if(isset($_POST['new_sb_text'])){ $new_sb_text = $_POST['new_sb_text']; }
if(isset($_POST['new_sb_foot'])){ $new_sb_foot = $_POST['new_sb_foot']; }
if(isset($_POST['new_sb_id'])){ $new_sb_id = $_POST['new_sb_id']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }



if($id_group == 'Developer' 
|| $id_group == 'Administrator' 
|| $id_group == 'Writer'){
	/*
		init
	*/
	
	echo '<script language="JavaScript" src="../js/dhtml.js"></script>';
	
	if(!isset($todo)){ $todo = 'show'; }
	
	$arr_farbe[0] = $arr_color[0];
	$arr_farbe[1] = $arr_color[1];
	
	$bgkey = 0;
	
	// link-to
	if($choosenDB == 'xml') {
		$arr_activepages = $tcms_file->getPathContent(
			_TCMS_PATH.'/tcms_content/'
		);
		
		foreach($languages['code'] as $key => $value) {
			//
		}
		
		$arr_modules['xml'][0]  = 'newsmanager.xml';
		$arr_modules['name'][0] = _TCMS_MENU_NEWS;
		$arr_modules['xml'][1]  = 'download.xml';
		$arr_modules['name'][1] = _TCMS_MENU_DOWN;
		$arr_modules['xml'][2]  = 'frontpage.xml';
		$arr_modules['name'][2] = _TCMS_MENU_FRONT;
		$arr_modules['xml'][3]  = 'imprint.xml';
		$arr_modules['name'][3] = _TCMS_MENU_IMP;
		$arr_modules['xml'][4]  = 'imagegallery.xml';
		$arr_modules['name'][4] = _TCMS_MENU_GALLERY;
		$arr_modules['xml'][5]  = 'guestbook.xml';
		$arr_modules['name'][5] = _TCMS_MENU_QBOOK;
		$arr_modules['xml'][6]  = 'contactform.xml';
		$arr_modules['name'][6] = _TCMS_MENU_CFORM;
		$arr_modules['xml'][7]  = 'products.xml';
		$arr_modules['name'][7] = _TCMS_MENU_PRODUCTS;
		
		$care = $mod = 0;
		
		if($tcms_main->isArray($arr_activepages)) {
			while(key_exists($mod, $arr_modules['xml'])) {
				if($arr_activepages){
					if(( is_array($arr_filename) ? !in_array($arr_modules['xml'][$mod], $arr_filename) : $arr_modules['xml'][$mod])){
						$arr_activefiles['xml'][$care]  = substr($arr_modules['xml'][$mod], 0, strpos($arr_modules['xml'][$mod], '.xml'));
						$arr_activefiles['name'][$care] = $arr_modules['name'][$mod];
						$care++;
					}
					$mod++;
				}
			}
			
			foreach($arr_activepages as $apKey => $apVal) {
				if($arr_activepages){
					if(( is_array($arr_filename) ? !in_array($apVal, $arr_filename) : $apVal)){
						$arr_activefiles['xml'][$care]  = substr($apVal, 0, 5);
						$arr_activefiles['name'][$care] = substr($apVal, 0, 5);
						$care++;
					}
				}
			}
		}
	}
	else {
		$arr_activefiles['xml'][0]  = 'newsmanager';
		$arr_activefiles['name'][0] = _TCMS_MENU_NEWS;
		$arr_activefiles['xml'][1]  = 'download';
		$arr_activefiles['name'][1] = _TCMS_MENU_DOWN;
		$arr_activefiles['xml'][2]  = 'frontpage';
		$arr_activefiles['name'][2] = _TCMS_MENU_FRONT;
		$arr_activefiles['xml'][3]  = 'imprint';
		$arr_activefiles['name'][3] = _TCMS_MENU_IMP;
		$arr_activefiles['xml'][4]  = 'imagegallery';
		$arr_activefiles['name'][4] = _TCMS_MENU_GALLERY;
		$arr_activefiles['xml'][5]  = 'guestbook';
		$arr_activefiles['name'][5] = _TCMS_MENU_QBOOK;
		$arr_activefiles['xml'][6]  = 'contactform';
		$arr_activefiles['name'][6] = _TCMS_MENU_CFORM;
		$arr_activefiles['xml'][7]  = 'products';
		$arr_activefiles['name'][7] = _TCMS_MENU_PRODUCTS;
		
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getAll($tcms_db_prefix.'content');
		
		$i = 8;
		
		while($sqlARR = $sqlAL->fetchArray($sqlQR)){
			$arr_activefiles['xml'][$i] = $sqlARR['uid'];
			$arr_activefiles['name'][$i] = $sqlARR['title'];
			
			if($arr_activefiles['xml'][$i]  == NULL){ $arr_activefiles['xml'][$i]  = ''; }
			if($arr_activefiles['name'][$i] == NULL){ $arr_activefiles['name'][$i] = ''; }
			
			$i++;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	
	
	/*
		list
	*/
	
	if($todo == 'show'){
		echo $tcms_html->bold(_CONTENT_TITLE);
		echo $tcms_html->text(_SIDE_TEXT.'<br /><br />', 'left');
		
		if($choosenDB == 'xml'){
			$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_sidebar/');
			
			if($tcms_main->isArray($arr_filename)){
				foreach($arr_filename as $key => $value){
					$main_xml = new xmlparser(_TCMS_PATH.'/tcms_sidebar/'.$value,'r');
					$arr_side['tag'][$key]   = substr($value, 0, strpos($value, '.xml'));
					$arr_side['title'][$key] = $main_xml->readSection('side', 'title');
					$arr_side['id'][$key]    = $main_xml->readSection('side', 'id');
					
					if(!$arr_side['title'][$key]){ $arr_side['title'][$key] = ''; }
					if(!$arr_side['id'][$key])   { $arr_side['id'][$key]    = ''; }
					
					$arr_side['title'][$key] = $tcms_main->decodeText($arr_side['title'][$key], '2', $c_charset);
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->getAll($tcms_db_prefix.'sidebar');
			
			$count = 0;
			
			while($sqlObj = $sqlAL->fetchObject($sqlQR)){
				$arr_side['title'][$count] = $sqlObj->title;
				$arr_side['id'][$count]    = $sqlObj->id;
				$arr_side['tag'][$count]   = $sqlObj->uid;
				
				if($arr_side['title'][$count] == NULL){ $arr_side['title'][$count] = ''; }
				if($arr_side['id'][$count]    == NULL){ $arr_side['id'][$count]    = ''; }
				
				$arr_side['title'][$count] = $tcms_main->decodeText($arr_side['title'][$count], '2', $c_charset);
				
				$count++;
				$checkCatAmount = $count;
			}
		}
		
		if(is_array($arr_side)){
			array_multisort(
				$arr_side['id'], SORT_ASC, 
				$arr_side['title'], SORT_ASC, 
				$arr_side['tag'], SORT_ASC
			);
		}
		
		echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
		echo '<tr class="tcms_bg_blue_01">'
			.'<th valign="middle" class="tcms_db_title" align="left" width="75%">'._TABLE_TITLE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="25%">'._TABLE_LINKTO.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="20%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';
		
		if(isset($arr_side['id']) && !empty($arr_side['id']) && $arr_side['id'] != ''){
			foreach($arr_side['id'] as $key => $value){
				$bgkey++;
				if(is_integer($bgkey/2)){ $ws_farbe = $arr_farbe[0]; }else{ $ws_farbe = $arr_farbe[1]; }
				
				echo '<tr height="25" id="row'.$key.'" '
				.'bgcolor="'.$ws_farbe.'" '
				.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
				.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$ws_farbe.'\')" '
				.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_side&amp;todo=edit&amp;maintag='.$arr_side['tag'][$key].'\';">';
				
				echo '<td class="tcms_db_2"><img src="../images/side.png" border="0" /> '.( empty($arr_side['title'][$key]) ? '<em>-empty-</em>' : $arr_side['title'][$key] ).'</td>';
				echo '<td align="center" class="tcms_db_2">'.($arr_side['id'][$key]==''?'<em>-empty-</em>':$arr_side['id'][$key]).'</td>';
				
				echo '<td class="tcms_db_2" align="right" valign="middle">'
				.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_side&amp;todo=edit&amp;maintag='.$arr_side['tag'][$key].'">'
				.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
				.'</a>&nbsp;'
				.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_side&amp;todo=delete&amp;maintag='.$arr_side['tag'][$key].'">'
				.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
				.'</a>&nbsp;'
				.'</td>';
				
				echo '</tr>';
			}
		}
		
		echo '</table><br />';
	}
	
	
	
	/*
		edit
	*/
	
	if($todo == 'edit'){
		// Auslesen
		if(isset($maintag)){
			if($choosenDB == 'xml'){
				$main_xml = new xmlparser(_TCMS_PATH.'/tcms_sidebar/'.$maintag.'.xml','r');
				$sb_title = $main_xml->readSection('side', 'title');
				$sb_key   = $main_xml->readSection('side', 'key');
				$sb_text  = $main_xml->readSection('side', 'content');
				$sb_foot  = $main_xml->readSection('side', 'foot');
				$sb_id    = $main_xml->readSection('side', 'id');
				
				if(!sb_title){ $sb_title = ''; }
				if(!$sb_key) { $sb_key   = ''; }
				if(!$sb_text){ $$sb_text = ''; }
				if(!$sb_foot){ $sb_foot  = ''; }
				if(!$sb_id)  { $sb_id    = ''; }
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'sidebar', $maintag);
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				
				$sb_title = $sqlObj->title;
				$sb_key   = $sqlObj->key;
				$sb_text  = $sqlObj->content;
				$sb_foot  = $sqlObj->foot;
				$sb_id    = $sqlObj->id;
				
				if($sb_title == NULL){ $sb_title = ''; }
				if($sb_key   == NULL){ $sb_key   = ''; }
				if($sb_text  == NULL){ $sb_text  = ''; }
				if($sb_foot  == NULL){ $sb_foot  = ''; }
				if($sb_id    == NULL){ $sb_id    = ''; }
			}
			
			// CHARSETS
			$sb_title = $tcms_main->decodeText($sb_title, '2', $c_charset);
			$sb_key   = $tcms_main->decodeText($sb_key, '2', $c_charset);
			$sb_text  = $tcms_main->decodeText($sb_text, '2', $c_charset);
			$sb_foot  = $tcms_main->decodeText($sb_foot, '2', $c_charset);
			
			echo '<strong>'._TABLE_EDIT.'</strong><br>';
			$odot = 'save';
		}
		else{
			$sb_title = '';
			$sb_key   = '';
			$sb_text  = '';
			$sb_foot  = '';
			$sb_id    = '';
			
			echo '<strong>'._TABLE_NEW.'</strong><br>';
			$odot = 'next';
		}
		
		
		
		$sb_text = ereg_replace('<br />'.chr(10), chr(13), $sb_text);
		$sb_text = ereg_replace('<br />'.chr(13), chr(13), $sb_text);
		$sb_text = ereg_replace('<br />', chr(13), $sb_text);
		
		$sb_text = ereg_replace('<br/>'.chr(10), chr(13), $sb_text);
		$sb_text = ereg_replace('<br/>'.chr(13), chr(13), $sb_text);
		$sb_text = ereg_replace('<br/>', chr(13), $sb_text);
		
		$sb_text = ereg_replace('<br>'.chr(10), chr(13), $sb_text);
		$sb_text = ereg_replace('<br>'.chr(13), chr(13), $sb_text);
		$sb_text = ereg_replace('<br>', chr(13), $sb_text);
		
		
		
		
		$width = '150';
		
		echo $tcms_html->text(_SIDE_TEXT.'<br /><br />', 'left');
		
		
		// form head
		echo '<form td="side" name="side" action="admin.php?id_user='.$id_user.'&amp;site=mod_side" method="post">'
		.'<input name="todo" type="hidden" value="'.$odot.'" />';
		
		
		// table head
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder"><tr class="tcms_bg_blue_01">'
		.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>'
		.'</tr></table>';
		
		
		// table head
		echo $tcms_html->tableHeadClass('1', '5', '0', '100%', 'tcms_table');
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_TITLE.'</strong>'
		.'</td><td>'
		.'<input class="tcms_input_normal" name="new_sb_title" type="text" value="'.$sb_title.'" />'
		.'</td></tr>';
		
		
		// table row
		$chk = $key / $tcms_main->countArrayValues($languages['fine']);
		
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_LINKTO.'</strong>'
		.'</td><td valign="top">'
		.'<select name="new_sb_id" class="tcms_select">';
		
		if(isset($sb_id) && $sb_id != '') {
			echo '<option selected value="'.$sb_id.'"> &bull; '.$sb_id.' &bull; </option>';
		}
		
		/*echo '<optgroup label="'.$tcms_main->getLanguageNameByTCMSLanguageCode(
			$languages, 
			$tcms_config->getLanguageFrontend()
		).'">';*/
		
		foreach($arr_activefiles['xml'] as $key => $value) {
			echo '<option value="'.$value.'"'.( $sb_id == $value ? ' selected' : '' ).'>'
			.$arr_activefiles['name'][$key]
			.'</option>';
		}
		
		//echo '</optgroup>';
		
		echo '</select>'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_SUBTITLE.'</strong>'
		.'</td><td>'
		.'<input class="tcms_input_normal" name="new_sb_key" type="text" value="'.$sb_key.'" />'
		.'</td></tr>';
		
		
		// table end
		echo $tcms_html->tableEnd();
		
		
		// table head
		echo $tcms_html->tableHeadClass('1', '5', '0', '100%', 'tcms_table');
		
		
		// table row
		echo '<tr><td valign="top">'
		.'<strong class="tcms_bold">'._TABLE_TEXT.'</strong>'
		.'<br /><br />'
		.'<script>createToendaToolbar(\'side\', \''.$tcms_lang.'\', \''.( $show_wysiwyg == 'toendaScript' ? $show_wysiwyg : 'HTML' ).'\', \'n=without\', \'\', \''.$id_user.'\');</script>';
		
		if($show_wysiwyg == 'toendaScript'){
			echo '<script>createToolbar(\'side\', \''.$tcms_lang.'\', \'toendaScript\');</script>';
		}
		else{
			echo '<script>createToolbar(\'side\', \''.$tcms_lang.'\', \'HTML\');</script>';
		}
		
		echo '<textarea class="tcms_textarea_huge" id="content" name="content">'.$sb_text.'</textarea>'
		.'</td></tr>';
		
		
		// table end
		echo $tcms_html->tableEnd();
		
		
		// foot
		echo $tcms_html->tableHeadClass('1', '5', '0', '100%', 'tcms_table')
		.'<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._CONTENT_FOOT.'</strong>'
		.'</td><td>'
		.'<textarea class="tcms_textarea_big" name="new_sb_foot" type="text">'.$sb_foot.'</textarea>'
		.'</td></tr>'
		.$tcms_html->tableEnd();
		
		
		echo '</form>';
	}
	
	
	
	/*
		save
	*/
	
	if($todo == 'save'){
		$content = $tcms_main->convertNewlineToHTML($content);
		
		// CHARSETS
		$new_sb_title = $tcms_main->encodeText($new_sb_title, '2', $c_charset);
		$new_sb_key   = $tcms_main->encodeText($new_sb_key, '2', $c_charset);
		$content  = $tcms_main->encodeText($content, '2', $c_charset);
		$new_sb_foot  = $tcms_main->encodeText($new_sb_foot, '2', $c_charset);
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_sidebar/'.$new_sb_id.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('side');
			
			$xmluser->write_value('title', $new_sb_title);
			$xmluser->write_value('key', $new_sb_key);
			$xmluser->write_value('content', $content);
			$xmluser->write_value('foot', $new_sb_foot);
			$xmluser->write_value('id', $new_sb_id);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('side');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$newSQLData = ''
			.$tcms_db_prefix.'sidebar.title="'.$new_sb_title.'", '
			.$tcms_db_prefix.'sidebar.key="'.$new_sb_key.'", '
			.$tcms_db_prefix.'sidebar.content="'.$content.'", '
			.$tcms_db_prefix.'sidebar.foot="'.$new_sb_foot.'", '
			.$tcms_db_prefix.'sidebar.id="'.$new_sb_id.'"';
			
			$sqlAL->sqlUpdateOne($tcms_db_prefix.'sidebar', $newSQLData, $new_sb_id);
		}
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_side\'</script>';
	}
	
	
	
	/*
		new
	*/
	
	if($todo == 'next'){
		$content = $tcms_main->convertNewlineToHTML($content);
		
		// CHARSETS
		$new_sb_title = $tcms_main->encodeText($new_sb_title, '2', $c_charset);
		$new_sb_key   = $tcms_main->encodeText($new_sb_key, '2', $c_charset);
		$content  = $tcms_main->encodeText($content, '2', $c_charset);
		$new_sb_foot  = $tcms_main->encodeText($new_sb_foot, '2', $c_charset);
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser(_TCMS_PATH.'/tcms_sidebar/'.$new_sb_id.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('side');
			
			$xmluser->write_value('title', $new_sb_title);
			$xmluser->write_value('key', $new_sb_key);
			$xmluser->write_value('content', $content);
			$xmluser->write_value('foot', $new_sb_foot);
			$xmluser->write_value('id', $new_sb_id);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('side');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`title`, `key`, `content`, `foot`, `id`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'title, "key", content, foot, id';
					break;
				
				case 'mssql':
					$newSQLColumns = '[title, [key], [content], [foot], [id]';
					break;
			}
			
			$newSQLData = "'".$new_sb_title."', '".$new_sb_key."', '".$content."', '".$new_sb_foot."', '".$new_sb_id."'";
			
			$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'sidebar', $newSQLColumns, $newSQLData, $new_sb_id);
		}
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_side\'</script>';
	}
	
	
	
	/*
		delete
	*/
	
	if($todo == 'delete'){
		if($check == 'yes'){
			if($choosenDB == 'xml'){ unlink(_TCMS_PATH.'/tcms_sidebar/'.$maintag.'.xml'); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$sqlAL->sqlDeleteOne($tcms_db_prefix.'sidebar', $maintag);
			}
			
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_side\'</script>';
		}
		else{
			echo '<script type="text/javascript">
			delCheck = confirm("'._MSG_DELETE_SUBMIT.'");
			if(delCheck == false){
				document.location=\'admin.php?id_user='.$id_user.'&site=mod_side\';
			}
			else{
				document.location=\'admin.php?id_user='.$id_user.'&site=mod_side&todo=delete&check=yes&maintag='.$maintag.'\';
			}
			</script>';
		}
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
