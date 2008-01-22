<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| News Categories
|
| File:	mod_news_categories.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * News Categories
 *
 * This module is used for the news categories.
 *
 * @version 0.3.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_POST['new_cat_name'])){ $new_cat_name = $_POST['new_cat_name']; }
if(isset($_POST['new_cat_desc'])){ $new_cat_desc = $_POST['new_cat_desc']; }
if(isset($_POST['dbAction'])){ $dbAction = $_POST['dbAction']; }




//=====================================================
// INIT
//=====================================================

if(!isset($todo)){ $todo = 'show'; }




//=====================================================
// SHOW OLD VALUES
//=====================================================

if($todo == 'show') {
	echo $tcms_html->bold(_NEWS_CATEGORIES_TITLE);
	echo $tcms_html->text(_NEWS_CATEGORIES_TEXT.'<br /><br />', 'left');
	
	if($choosenDB == 'xml') {
		$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_news_categories/');
		
		$count = 0;
		
		if(isset($arr_filename) && !empty($arr_filename) && $arr_filename != ''){
			foreach($arr_filename as $key => $value){
				$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_news_categories/'.$value,'r');
				$arrCat['tag'][$key]  = substr($value, 0, 5);
				$arrCat['name'][$key] = $menu_xml->read_section('cat', 'name');
				$arrCat['desc'][$key] = $menu_xml->read_section('cat', 'desc');
				
				if(!$arrCat['name'][$key]){ $arrCat['name'][$key]  = ''; }
				if(!$arrCat['desc'][$key]){ $arrCat['desc'][$key]  = ''; }
				
				// CHARSETS
				$arrCat['name'][$key] = $tcms_main->decodeText($arrCat['name'][$key], '2', $c_charset);
				$tempStr = $tcms_main->decodeText($arrCat['desc'][$key], '2', $c_charset);
				$arrCat['desc'][$key] = ( strlen($tempStr) > 60 ? substr($tempStr, 0, 60).'...' : $tempStr );
				
				$count++;
				$checkCatAmount = $count;
			}
			
			array_multisort(
				$arrCat['name'], SORT_ASC, 
				$arrCat['desc'], SORT_ASC, 
				$arrCat['tag'], SORT_ASC
			);
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'news_categories ORDER BY name');
		
		$count = 0;
		
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$arrCat['tag'][$count]  = $sqlARR['uid'];
			$arrCat['name'][$count] = $sqlARR['name'];
			$arrCat['desc'][$count] = $sqlARR['desc'];
			
			if($arrCat['name'][$count] == NULL){ $arrCat['name'][$count] = ''; }
			if($arrCat['desc'][$count] == NULL){ $arrCat['desc'][$count] = ''; }
			
			// CHARSETS
			$arrCat['name'][$count] = $tcms_main->decodeText($arrCat['name'][$count], '2', $c_charset);
			$tempStr = $tcms_main->decodeText($arrCat['desc'][$count], '2', $c_charset);
			$arrCat['desc'][$count] = ( strlen($tempStr) > 60 ? substr($tempStr, 0, 60).'...' : $tempStr );
			
			$count++;
			$checkCatAmount = $count;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	
	echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
	echo '<tr class="tcms_bg_blue_01">'
	.'<th valign="middle" class="tcms_db_title" width="10%" colspan="2" align="left">'._TABLE_NAME.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="100%">'._TABLE_DESCRIPTION.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="20%" align="right">'._TABLE_FUNCTIONS.'</th>'
	.'</tr>';
	
	if(isset($arrCat['name']) && !empty($arrCat['name']) && $arrCat['name'] != ''){
		foreach($arrCat['name'] as $key => $value){
			if(is_integer($key/2)){ $wsc = 0; }
			else{ $wsc = 1; }
			
			echo '<tr height="25" id="row'.$key.'" '
			.'bgcolor="'.$arr_color[$wsc].'" '
			.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
			.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\')" '
			.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_news_categories&amp;todo=edit&amp;maintag='.$arrCat['tag'][$key].'\';">';
			
			echo '<td class="tcms_db_2" style="width: 13px !important;"><img border="0" src="../images/cat.png" /></td>';
			echo '<td class="tcms_db_2">'.$arrCat['name'][$key].'</td>';
			
			echo '<td class="tcms_db_2">'.$arrCat['desc'][$key].'&nbsp;</td>';
			
			echo '<td class="tcms_db_2" align="right" valign="middle">'
			.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_news_categories&amp;todo=edit&amp;maintag='.$arrCat['tag'][$key].'">'
			.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
			.'</a>&nbsp;'
			.( $checkCatAmount < 2 
				? '' 
				: '<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_news_categories&amp;&todo=delete&amp;maintag='.$arrCat['tag'][$key].'">'
				.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
				.'</a>&nbsp;'
			)
			.'</td>';
			
			echo '</tr>';
		}
	}
	
	echo '</table><br />';
}




//=====================================================
// FORM
//=====================================================

if($todo == 'edit'){
	if(isset($maintag) && !empty($maintag) && $maintag != ''){
		if($choosenDB == 'xml'){
			$user_xml  = new xmlparser(_TCMS_PATH.'/tcms_news_categories/'.$maintag.'.xml','r');
			$cat_name  = $user_xml->read_value('name');
			$cat_desc  = $user_xml->read_value('desc');
			$cat_count = $user_xml->read_value('count');
			
			if($cat_name == false){ $cat_name = ''; }
			if($cat_desc == false){ $cat_desc = ''; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'news_categories', $maintag);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$cat_name = $sqlARR['name'];
			$cat_desc = $sqlARR['desc'];
			
			if($cat_name == NULL){ $cat_name = ''; }
			if($cat_desc == NULL){ $cat_desc = ''; }
			
			$dbDo = 'save';
		}
		
		$cat_name = $tcms_main->decodeText($cat_name, '2', $c_charset);
		$cat_desc = $tcms_main->decodeText($cat_desc, '2', $c_charset);
		
		echo $tcms_html->bold(_TABLE_EDIT);
		$odot = 'save';
	}
	else{
		$cat_name = '';
		$cat_desc = '';
		
		$maintag = $tcms_main->getNewUID(5, 'news_categories');
		
		echo $tcms_html->bold(_TABLE_NEW);
		$odot = 'save';
		if($choosenDB != 'xml'){ $dbDo = 'next'; }
	}
	//
	//***************************
	
	
	$cat_name = htmlspecialchars($cat_name);
	
	$cat_desc = ereg_replace('<br />'.chr(10), chr(13), $cat_desc);
	$cat_desc = ereg_replace('<br />'.chr(13), chr(13), $cat_desc);
	$cat_desc = ereg_replace('<br />', chr(13), $cat_desc);
	
	$cat_desc = ereg_replace('<br/>'.chr(10), chr(13), $cat_desc);
	$cat_desc = ereg_replace('<br/>'.chr(13), chr(13), $cat_desc);
	$cat_desc = ereg_replace('<br/>', chr(13), $cat_desc);
	
	$cat_desc = ereg_replace('<br>'.chr(10), chr(13), $cat_desc);
	$cat_desc = ereg_replace('<br>'.chr(13), chr(13), $cat_desc);
	$cat_desc = ereg_replace('<br>', chr(13), $cat_desc);
	
	$cat_desc = htmlspecialchars($cat_desc);
	
	
	$width = '200';
	
	echo $tcms_html->text(_NEWS_CATEGORIES_TEXT.'<br /><br />', 'left');
	
	
	echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_news_categories" method="post">'
	.'<input name="todo" type="hidden" value="'.$odot.'" />'
	.'<input name="maintag" type="hidden" value="'.$maintag.'" />';
	
	if($choosenDB != 'xml'){
		echo '<input name="dbAction" type="hidden" value="'.$dbDo.'" />';
	}
	else{
		echo '<input name="CatCount" type="hidden" value="'.$cat_count.'" />';
	}
	
	
	// table
	echo '<table width="100%" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">';
	echo '<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>';
	echo '</tr></table>';
	
	
	// table
	echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong>'._TABLE_NAME.'</strong></td>'
	.'<td><input class="tcms_input_normal" name="new_cat_name" type="text" value="'.$cat_name.'" />'
	.'</td></tr>';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong>'._TABLE_DESCRIPTION.'</strong></td>'
	.'<td valign="top"><textarea class="tcms_textarea_big" name="new_cat_desc">'.$cat_desc.'</textarea>'
	.'</td></tr>';
	
	
	echo '</table>';
	
	echo '</form>';
}




//=====================================================
// SAVING
//=====================================================

if($todo == 'save'){
	if($new_cat_name == '' || !isset($new_cat_name)){ $new_cat_name = 'Uncategorized'; }
	if($new_cat_desc == '' || !isset($new_cat_desc)){ $new_cat_desc = ''; }
	
	$new_cat_desc = $tcms_main->convertNewlineToHTML($new_cat_desc);
	
	// CHARSETS
	$new_cat_name = $tcms_main->encodeText($new_cat_name, '2', $c_charset);
	$new_cat_desc = $tcms_main->encodeText($new_cat_desc, '2', $c_charset);
	
	if($choosenDB == 'xml'){
		if(!isset($_POST['CatCount']) || $_POST['CatCount'] == '' || empty($_POST['CatCount'])){ $_POST['CatCount'] = 0; }
		$xmluser = new xmlparser(_TCMS_PATH.'/tcms_news_categories/'.$maintag.'.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('cat');
		
		$xmluser->write_value('name', $new_cat_name);
		$xmluser->write_value('desc', $new_cat_desc);
		$xmluser->write_value('count', $_POST['CatCount']);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('cat');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		switch($dbAction){
			case 'save':
				$newSQLData = ''
				.$tcms_db_prefix.'news_categories.name="'.$new_cat_name.'", '
				.$tcms_db_prefix.'news_categories.desc="'.$new_cat_desc.'"';
				
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'news_categories', $newSQLData, $maintag);
				break;
			
			case 'next':
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`name`, `desc`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'name, "desc"';
						break;
					
					case 'mssql':
						$newSQLColumns = '[name], [desc]';
						break;
				}
				$newSQLData = "'".$new_cat_name."', '".$new_cat_desc."'";
				
				$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'news_categories', $newSQLColumns, $newSQLData, $maintag);
				break;
		}
	}
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_news_categories\'</script>';
}




//=====================================================
// DELETE
//=====================================================

if($todo == 'delete'){
	if($choosenDB == 'xml'){
		unlink(_TCMS_PATH.'/tcms_news_categories/'.$maintag.'.xml');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlAL->sqlDeleteOne($tcms_db_prefix.'news_categories', $maintag);
		$sqlAL->sqlQuery("DELETE FROM ".$tcms_db_prefix."news_to_categories WHERE news_uid = '".$maintag."'");
	}
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_news_categories\'</script>';
}

?>
