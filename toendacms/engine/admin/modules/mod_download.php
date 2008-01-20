<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Download Manager
|
| File:	mod_download.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Download Manager
 *
 * This module is used for the download configuration
 * and the administration of all the downloads.
 *
 * @version 0.8.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['category'])){ $category = $_GET['category']; }
if(isset($_GET['action'])){ $action = $_GET['action']; }

if(isset($_POST['create_folder'])){ $create_folder = $_POST['create_folder']; }
if(isset($_POST['delete'])){ $delete = $_POST['delete']; }
if(isset($_POST['rm'])){ $rm = $_POST['rm']; }
if(isset($_POST['category'])){ $category = $_POST['category']; }
if(isset($_POST['type'])){ $type = $_POST['type']; }
if(isset($_POST['new_download_id'])){ $new_download_id = $_POST['new_download_id']; }
if(isset($_POST['download_title'])){ $download_title = $_POST['download_title']; }
if(isset($_POST['download_stamp'])){ $download_stamp = $_POST['download_stamp']; }
if(isset($_POST['download_text'])){ $download_text = $_POST['download_text']; }
if(isset($_POST['new_date'])){ $new_date = $_POST['new_date']; }
if(isset($_POST['maintag'])){ $maintag = $_POST['maintag']; }
if(isset($_POST['img_as_mime'])){ $img_as_mime = $_POST['img_as_mime']; }
if(isset($_POST['new_name'])){ $new_name = $_POST['new_name']; }
if(isset($_POST['new_type'])){ $new_type = $_POST['new_type']; }
if(isset($_POST['new_desc'])){ $new_desc = $_POST['new_desc']; }
if(isset($_POST['new_sort'])){ $new_sort = $_POST['new_sort']; }
if(isset($_POST['new_pub'])){ $new_pub = $_POST['new_pub']; }
if(isset($_POST['new_access'])){ $new_access = $_POST['new_access']; }
if(isset($_POST['new_file'])){ $new_file = $_POST['new_file']; }
if(isset($_POST['new_image'])){ $new_image = $_POST['new_image']; }
if(isset($_POST['new_title'])){ $new_title = $_POST['new_title']; }
if(isset($_POST['new_cat'])){ $new_cat = $_POST['new_cat']; }
if(isset($_POST['down_title'])){ $down_title = $_POST['down_title']; }
if(isset($_POST['down_desc'])){ $down_desc = $_POST['down_desc']; }
if(isset($_POST['down_image'])){ $down_image = $_POST['down_image']; }
if(isset($_POST['down_file_exists'])){ $down_file_exists = $_POST['down_file_exists']; }
if(isset($_POST['down_file_otherurl'])){ $down_file_otherurl = $_POST['down_file_otherurl']; }
if(isset($_POST['down_name_otherurl'])){ $down_name_otherurl= $_POST['down_name_otherurl']; }
if(isset($_POST['fileplace'])){ $fileplace= $_POST['fileplace']; }




// ----------------------------------------------------
// INIT
// ----------------------------------------------------

echo '<script language="JavaScript" src="../js/jscalendar/calendar.js"></script>';
echo '<script language="Javascript" src="../js/jscalendar/lang/calendar-en.js"></script>';
echo '<script language="Javascript" src="../js/jscalendar/calendar-setup.js"></script>';
echo '<link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-toendaCMS.css" title="toendaCMS" />';

if(!isset($todo)){ $todo = 'show'; }
if(!isset($action)){ $action = ''; }

$arr_farbe[0] = $arr_color[0];
$arr_farbe[1] = $arr_color[1];
$bgkey     = 0;

$arr_downfiles = $tcms_file->getPathContent(_TCMS_PATH.'/files/');




$param_save_mode = 'off';
if($param_save_mode == 'off'){
	if($id_group == 'Developer' 
	|| $id_group == 'Administrator'){
		// ----------------------------------------------------
		// CONFIG
		// ----------------------------------------------------
		
		if($todo == 'config'){
			if($choosenDB == 'xml'){
				$down_xml = new xmlparser(_TCMS_PATH.'/tcms_global/download.xml','r');
				$old_download_id    = $down_xml->readSection('config', 'download_id');
				$old_download_title = $down_xml->readSection('config', 'download_title');
				$old_download_stamp = $down_xml->readSection('config', 'download_stamp');
				$old_download_text  = $down_xml->readSection('config', 'download_text');
				$down_xml->flush();
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'downloads_config', 'download');
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				
				$old_download_id    = $sqlARR['download_id'];
				$old_download_title = $sqlARR['download_title'];
				$old_download_stamp = $sqlARR['download_stamp'];
				$old_download_text  = $sqlARR['download_text'];
			}
			
			
			$old_download_title = $tcms_main->decodeText($old_download_title, '2', $c_charset);
			$old_download_stamp = $tcms_main->decodeText($old_download_stamp, '2', $c_charset);
			$old_download_text  = $tcms_main->decodeText($old_download_text, '2', $c_charset);
			
			$old_download_title = htmlspecialchars($old_download_title);
			$old_download_stamp = htmlspecialchars($old_download_stamp);
			
			$old_download_text = ereg_replace('<br />'.chr(10), chr(13), $old_download_text);
			$old_download_text = ereg_replace('<br />'.chr(13), chr(13), $old_download_text);
			$old_download_text = ereg_replace('<br />', chr(13), $old_download_text);
			
			$old_download_text = ereg_replace('<br/>'.chr(10), chr(13), $old_download_text);
			$old_download_text = ereg_replace('<br/>'.chr(13), chr(13), $old_download_text);
			$old_download_text = ereg_replace('<br/>', chr(13), $old_download_text);
			
			$old_download_text = ereg_replace('<br>'.chr(10), chr(13), $old_download_text);
			$old_download_text = ereg_replace('<br>'.chr(13), chr(13), $old_download_text);
			$old_download_text = ereg_replace('<br>', chr(13), $old_download_text);
			
			
			
			/*
				BEGIN FORM
			*/
			echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_download" method="post">'
			.'<input name="todo" type="hidden" value="save_config" />';
			
			
			// table head
			echo '<table cellpadding="2" cellspacing="0" width="100%" border="0" class="noborder">';
			
			
			// row
			echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini"><strong>'._EXT_DOWNLOAD.'</strong></td></tr>';
			
			
			// row
			echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_DOWNLOAD_ID.'</td>'
			.'<td valign="top" colspan="2"><input name="new_download_id" readonly class="tcms_input_small" value="'.$old_download_id.'" />'
			.'</td></tr>';
			
			
			//  row
			echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_DOWNLOAD_TITLE.'</td>'
			.'<td valign="top" colspan="2"><input name="download_title" class="tcms_input_normal" value="'.$old_download_title.'" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_DOWNLOAD_SUBTITLE.'</td>'
			.'<td valign="top" colspan="2"><input name="download_stamp" class="tcms_input_normal" value="'.$old_download_stamp.'" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td class="tcms_padding_mini" valign="top">'._EXT_DOWNLOAD_TEXT.'</td>'
			.'<td valign="top" colspan="2"><textarea name="download_text" class="tcms_textarea_big">'.$old_download_text.'</textarea>'
			.'</td></tr>';
			
			
			// Table end
			echo '</table><br />';
			
			echo '</form>';
		}
		
		
		
		
		//=====================================================
		// VALUES
		//=====================================================
		
		if($todo == 'show'){
			echo $tcms_html->bold(_DOWNLOADS_TITLE);
			echo $tcms_html->text(_DOWNLOADS_TEXT.'<br /><br />', 'left');
			
			
			if(isset($category)){
				if($choosenDB == 'xml'){
					$count = 0;
					
					if($category != ''){
						$xml = new xmlparser(_TCMS_PATH.'/files/'.$category.'/info.xml', 'r');
						
						//$access_cat = $down_xml->readSection('faq', 'access');
						
						$arrDownParent['type'][$count] = $xml->readSection('info', 'sql_type');
						$arrDownParent['pub'][$count]  = $xml->readSection('info', 'pub');
					}
					else{
						$arrDownParent['type'][$count] = 'd';
						$arrDownParent['pub'][$count]  = '1';
					}
					
					if($arrDownParent['type'][$count] == 'd' && $arrDownParent['pub'][$count] == '1'){
						if($category != ''){
							$arrDownParent['title'][$count]  = $xml->readSection('info', 'name');
							$arrDownParent['parent'][$count] = $xml->readSection('info', 'parent');
							$arrDownParent['uid'][$count]    = substr($category, 0, 10);
							
							// CHARSETS
							$arrDownParent['title'][$count] = $tcms_main->decodeText($arrDownParent['title'][$count], '2', $c_charset);
							
							$checkCat = $xml->readSection('info', 'cat');
							
							$xml->flush();
							
							$count++;
						}
						else{
							$arrDownParent['title'][$count]  = '';
							$arrDownParent['parent'][$count] = '';
							$arrDownParent['uid'][$count]    = '';
							
							$checkCat = '';
						}
						
						while($checkCat != ''){
							$xml = new xmlparser(_TCMS_PATH.'/files/'.$arrDownParent['parent'][$count - 1].'/info.xml', 'r');
							
							$checkCat = $xml->readSection('info', 'cat');
							$arrDownParent['type'][$count]   = $xml->readSection('info', 'sql_type');
							$arrDownParent['pub'][$count]    = $xml->readSection('info', 'pub');
							
							if($arrDownParent['type'][$count] == 'd' && $arrDownParent['pub'][$count] == '1'){
								$arrDownParent['title'][$count]  = $xml->readSection('info', 'name');
								$arrDownParent['parent'][$count] = $xml->readSection('info', 'parent');
								$arrDownParent['uid'][$count]    = substr($arrDownParent['parent'][$count - 1], 0, 10);
								
								$xml->flush();
								
								// CHARSETS
								$arrDownParent['title'][$count] = $tcms_main->decodeText($arrDownParent['title'][$count], '2', $c_charset);
								
								//echo $count.' -> '.$arrDownParent['parent'][$count].' -> '.$arrDownParent['title'][$count].'<br>';
								
								$count++;
								$checkFAQTitle = $count;
							}
						}
					}
				}
				else{
					switch($id_group){
						case 'Developer':
						case 'Administrator':
							$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
							break;
						
						case 'User':
						case 'Editor':
						case 'Presenter':
							$strAdd = " OR access = 'Protected' ) ";
							break;
						
						default:
							$strAdd = ' ) ';
							break;
					}
					
					$sqlSTRparent = "SELECT * "
					."FROM ".$tcms_db_prefix."downloads "
					."WHERE uid = '".$category."' "
					."AND ( access = 'Public' "
					.$strAdd;
					
					$count = 0;
					
					$sqlQR = $sqlAL->sqlQuery($sqlSTRparent);
					$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
					
					while($sqlNR > 0){
						$sqlARR = $sqlAL->fetchArray($sqlQR);
						
						unset($sqlQR);
						
						$arrDownParent['title'][$count]  = $sqlARR['name'];
						$arrDownParent['uid'][$count]    = $sqlARR['uid'];
						$arrDownParent['parent'][$count] = $sqlARR['parent'];
						
						if($arrDownParent['title'][$count]  == NULL){ $arrDownParent['title'][$count]  = ''; }
						if($arrDownParent['uid'][$count]    == NULL){ $arrDownParent['uid'][$count]    = ''; }
						if($arrDownParent['parent'][$count] == NULL){ $arrDownParent['parent'][$count] = ''; }
						
						// CHARSETS
						$arrDownParent['title'][$count] = $tcms_main->decodeText($arrDownParent['title'][$count], '2', $c_charset);
						
						$sqlSTRparent = "SELECT * "
						."FROM ".$tcms_db_prefix."downloads "
						."WHERE uid = '".$arrDownParent['parent'][$count]."' "
						."AND ( access = 'Public' "
						.$strAdd;
						
						$sqlQR = $sqlAL->sqlQuery($sqlSTRparent);
						
						$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
						
						$count++;
						$checkFAQTitle = $count;
					}
				}
				
				if(!isset($checkFAQTitle)) $checkFAQTitle = 1;
				
				
				echo '<a href="admin.php?id_user='.$id_user.'&amp;site=mod_download">'
				.'<strong>'
				._TCMS_MENU_DOWN
				.'</strong>'
				.'</a>';
				
				
				for($i = ($checkFAQTitle - 1); $i >= 0; $i--){
					echo '&nbsp;/&nbsp;';
					
					if($i == 0){
						echo $arrDownParent['title'][$i];
					}
					else{
						echo '<a href="admin.php?id_user='.$id_user.'&amp;site=mod_download&amp;category='.$arrDownParent['uid'][$i].'">'
						.$arrDownParent['title'][$i]
						.'</a>';
					}
				}
				
				echo '<br /><br />';
			}
			
			
			if($choosenDB == 'xml'){
				$count = 0;
				
				if(isset($arr_downfiles) && !empty($arr_downfiles) && $arr_downfiles != ''){
					foreach($arr_downfiles as $key => $value){
						if($value != 'index.html'){
							$xml      = new xmlparser(_TCMS_PATH.'/files/'.$value.'/info.xml','r');
							$checkPub = $xml->readSection('info', 'pub');
							
							
							// show pub
							if($checkPub == 1){
								$checkCat = $xml->readSection('info', 'cat');
								
								
								/*
									rules
								*/
								if(!isset($category) || trim($category) == ''){
									if($checkCat == '')
										$countThis = true;
									else
										$countThis = false;
								}
								else{
									if($checkCat == $category)
										$countThis = true;
									else
										$countThis = false;
								}
								
								
								// show cat
								if($countThis){
									$checkAcc = $xml->readSection('info', 'access');
									
									
									/*
										access
									*/
									switch($id_group){
										case 'Developer':
										case 'Administrator':
											if($checkAcc == 'Public' || $checkAcc == 'Protected' || $checkAcc == 'Private')
												$showThis = true;
											else
												$showThis = false;
											break;
										
										case 'User':
										case 'Editor':
										case 'Presenter':
											if($checkAcc == 'Public' || $checkAcc == 'Protected')
												$showThis = true;
											else
												$showThis = false;
											break;
										
										default:
											if($checkAcc == 'Public')
												$showThis = true;
											else
												$showThis = false;
											break;
									}
									
									
									// show access
									if($showThis){
										$arr_dw['uid'][$count]  = substr($value, 0, 10);
										$arr_dw['name'][$count] = $xml->readSection('info', 'name');
										$arr_dw['date'][$count] = $xml->readSection('info', 'date');
										$arr_dw['desc'][$count] = $xml->readSection('info', 'desc');
										$arr_dw['type'][$count] = $xml->readSection('info', 'type');
										$arr_dw['sort'][$count] = $xml->readSection('info', 'sort');
										$arr_dw['file'][$count] = $xml->readSection('info', 'file');
										$arr_dw['pub'][$count]  = $checkPub;
										$arr_dw['ac'][$count]   = $checkAcc;
										$arr_dw['cat'][$count]  = $xml->readSection('info', 'cat');
										$arr_dw['st'][$count]   = $xml->readSection('info', 'sql_type');
										$arr_dw['img'][$count]  = $xml->readSection('info', 'image');
										$arr_dw['mir'][$count]  = $xml->readSection('info', 'mirror');
										
										
										// CHARSETS
										$arr_dw['name'][$count] = $tcms_main->decodeText($arr_dw['name'][$count], '2', $c_charset);
										$arr_dw['desc'][$count] = $tcms_main->decodeText($arr_dw['desc'][$count], '2', $c_charset);
										
										$count++;
									}
								}
							}
							
							$checkDownAmount = $count;
							
							$xml->flush();
						}
					}
				}
				
				if(is_array($arr_dw) && !empty($arr_dw)){
					array_multisort(
						$arr_dw['sort'], SORT_ASC, 
						$arr_dw['date'], SORT_ASC, 
						$arr_dw['name'], SORT_ASC, 
						$arr_dw['type'], SORT_ASC, 
						$arr_dw['desc'], SORT_ASC, 
						$arr_dw['file'], SORT_ASC, 
						$arr_dw['uid'], SORT_ASC, 
						$arr_dw['pub'], SORT_ASC, 
						$arr_dw['cat'], SORT_ASC, 
						$arr_dw['ac'], SORT_ASC, 
						$arr_dw['st'], SORT_ASC, 
						$arr_dw['img'], SORT_ASC, 
						$arr_dw['mir'], SORT_ASC
					);
				}
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				switch($id_group){
					case 'Developer':
					case 'Administrator':
						$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
						break;
					
					case 'User':
					case 'Editor':
					case 'Presenter':
						$strAdd = " OR access = 'Protected' ) ";
						break;
					
					default:
						$strAdd = ' ) ';
						break;
				}
				
				if(!isset($category) || trim($category) == ''){
					$sqlSTR = "SELECT * "
					."FROM ".$tcms_db_prefix."downloads "
					."WHERE ( parent IS NULL "
					."OR parent = '' ) "
					."AND ( access = 'Public' "
					.$strAdd
					."ORDER BY sort ASC, date ASC, name ASC";
				}
				else{
					$sqlSTR = "SELECT * "
					."FROM ".$tcms_db_prefix."downloads "
					."WHERE cat = '".$category."' "
					//."AND parent IS NULL "
					//."OR parent = '' "
					."AND ( access = 'Public' "
					.$strAdd
					."ORDER BY sort ASC, date ASC, name ASC";
				}
				
				//$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix."downloads WHERE sql_type='d' ORDER BY sort ASC");
				
				$sqlQR = $sqlAL->sqlQuery($sqlSTR);
				
				$count = 0;
				
				while($sqlARR = $sqlAL->fetchArray($sqlQR)){
					$arr_dw['uid'][$count]   = $sqlARR['uid'];
					$arr_dw['name'][$count]  = $sqlARR['name'];
					$arr_dw['date'][$count]  = $sqlARR['date'];
					$arr_dw['desc'][$count]  = $sqlARR['desc'];
					$arr_dw['type'][$count]  = $sqlARR['type'];
					$arr_dw['sort'][$count]  = $sqlARR['sort'];
					$arr_dw['file'][$count]  = $sqlARR['file'];
					$arr_dw['pub'][$count]   = $sqlARR['pub'];
					$arr_dw['ac'][$count]    = $sqlARR['access'];
					$arr_dw['st'][$count]    = $sqlARR['sql_type'];
					$arr_dw['cat'][$count]   = $sqlARR['cat'];
					$arr_dw['img'][$count]   = $sqlARR['image'];
					$arr_dw['mir'][$count]   = $sqlARR['mirror'];
					
					if($arr_dw['uid'][$count]  == NULL){ $arr_dw['uid'][$count]  = ''; }
					if($arr_dw['name'][$count] == NULL){ $arr_dw['name'][$count] = ''; }
					if($arr_dw['date'][$count] == NULL){ $arr_dw['date'][$count] = ''; }
					if($arr_dw['desc'][$count] == NULL){ $arr_dw['desc'][$count] = ''; }
					if($arr_dw['type'][$count] == NULL){ $arr_dw['type'][$count] = ''; }
					if($arr_dw['sort'][$count] == NULL){ $arr_dw['sort'][$count] = ''; }
					if($arr_dw['file'][$count] == NULL){ $arr_dw['file'][$count] = ''; }
					if($arr_dw['pub'][$count]  == NULL){ $arr_dw['pub'][$count]  = ''; }
					if($arr_dw['ac'][$count]   == NULL){ $arr_dw['ac'][$count]   = ''; }
					if($arr_dw['st'][$count]   == NULL){ $arr_dw['st'][$count]   = ''; }
					if($arr_dw['img'][$count]  == NULL){ $arr_dw['img'][$count]  = ''; }
					if($arr_dw['mir'][$count]  == NULL){ $arr_dw['mir'][$count]  = ''; }
					if($arr_dw['cat'][$count]  == NULL){ $arr_dw['cat'][$count]  = ''; }
					
					// CHARSETS
					$arr_dw['name'][$count] = $tcms_main->decodeText($arr_dw['name'][$count], '2', $c_charset);
					$arr_dw['desc'][$count] = $tcms_main->decodeText($arr_dw['desc'][$count], '2', $c_charset);
					
					$count++;
					$checkCatAmount = $count;
				}
			}
			
			echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
			echo '<tr class="tcms_bg_blue_01">'
				.'<th valign="middle" class="tcms_db_title" width="5%" align="left">&nbsp;</th>'
				.'<th valign="middle" class="tcms_db_title" width="60%" align="left">'._TABLE_TITLE.', '._TABLE_DESCRIPTION.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_POS.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_PUBLISHED.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_MACCESS.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._TABLE_DELETE.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="10%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';
			
			if(isset($arr_dw['sort']) && !empty($arr_dw['sort']) && $arr_dw['sort'] != ''){
				foreach($arr_dw['sort'] as $key => $value){
					$bgkey++;
					if(is_integer($bgkey/2)){ $ws_farbe = $arr_farbe[0]; }
					else{ $ws_farbe = $arr_farbe[1]; }
					
					$dType = ( $arr_dw['st'][$key] == 'd' ? true : false );
					
					
					
					// onclick
					if($dType){
						$strLocation = 'document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_download&amp;category='.$arr_dw['uid'][$key].'\';';
					}
					
					
					
					// row
					echo '<tr id="row1'.$key.'" '
					.'bgcolor="'.$ws_farbe.'" '
					.'onMouseOver="wxlBgCol(\'row1'.$key.'\',\'#ececec\');wxlBgCol(\'row2'.$key.'\',\'#ececec\');" '
					.'onMouseOut="wxlBgCol(\'row1'.$key.'\',\''.$ws_farbe.'\');wxlBgCol(\'row2'.$key.'\',\''.$ws_farbe.'\');"'
					.( $dType == true
					? ''//' onclick="'.$strLocation.'"'
					: ''
					).'>';
					
					
					
					// cell
					echo '<td valign="top" align="center" style="padding: 5px 0 0 5px;">'
					.'<form name="'.$arr_dw['uid'][$key].'" id="'.$arr_dw['uid'][$key].'" action="admin.php?id_user='.$id_user.'&amp;site=mod_download" method="post">';
					
					
					
					// date
					// title
					// -- type
					// -- image
					if($dType){
						echo '<input name="todo" id="todo'.$key.'" type="hidden" value="category" />'
						.'<input name="maintag" type="hidden" value="'.$arr_dw['uid'][$key].'" />'
						.'<input name="new_date" type="hidden" value="'.$arr_dw['date'][$key].'" />'
						.'<input name="fileplace" type="hidden" value="'.( $arr_dw['mir'][$key] == 1 ? 3 : 0 ).'" />'
						.'<strong>'._TABLE_CATEGORY.'</strong></td>';
						
						
						echo '<td valign="top" align="left">'
						.'<input name="new_name" class="tcms_input_small" value="'.$arr_dw['name'][$key].'" />'
						.'<br />'
						.'<select name="new_type" class="tcms_select">';
						
						foreach($arr_fs['tag'] as $fskey => $fsvalue){
							echo '<option value="'.$fsvalue.'"'.( $arr_dw['type'][$key] == $fsvalue ? ' selected="selected"' : '' ).'>'.$arr_fs['des'][$fskey].'</option>';
						}
						
						echo '</select>'
						.'</td>';
					}
					else{
						echo '<input name="todo" id="todo'.$key.'" type="hidden" value="save" />'
						//.'<input name="type" id="todo'.$key.'" type="hidden" value="file" />'
						//.'<input name="rm" type="hidden" value="file" />'
						.'<input name="maintag" type="hidden" value="'.$arr_dw['uid'][$key].'" />'
						.'<input name="new_type" type="hidden" value="'.$arr_dw['type'][$key].'" />'
						.'<input name="new_image" type="hidden" value="'.$arr_dw['img'][$key].'" />'
						.'<input name="fileplace" type="hidden" value="'.( $tcms_main->checkWebLink($arr_dw['file'][$key]) ? 3 : 0 ).'" />'
						.'<strong>'._TABLE_FILE.'</strong></td>';
						
						
						echo '<td valign="top" align="left">'
						.'<input type="text" class="tcms_input_normal" name="new_name" value="'.$arr_dw['name'][$key].'" />'
						.'<br />'
						.'<input type="text" class="tcms_input_normal" name="new_file" value="'.$arr_dw['file'][$key].'" />'
						.'</td>';
					}
					
					
					
					// sort
					echo '<td valign="top" align="center">'
					.'<input name="new_sort" type="text" class="tcms_input_makro" value="'.$arr_dw['sort'][$key].'" />'
					.'</td>';
					
					
					
					// published
					echo '<td valign="top" align="left">'
					.'<input type="checkbox" name="new_pub"'.( $arr_dw['pub'][$key] == 1 ? ' checked="checked"' : $arr_dw['pub'][$key] ).' value="1" />'
					.'</td>';
					
					
					
					// access
					echo '<td valign="top" align="center">'
					.'<select name="new_access" class="tcms_select">'
						.'<option value="Public"'.(    $arr_dw['ac'][$key] == 'Public'    ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
						.'<option value="Protected"'.( $arr_dw['ac'][$key] == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
						.'<option value="Private"'.(   $arr_dw['ac'][$key] == 'Private'   ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
					.'</select></td>';
					
					
					
					// delete
					echo '<td valign="top" align="left">'
					.'<input type="checkbox" name="delete" value="1" />'
					.'</td>';
					
					
					
					// delete
					echo '<td valign="top" align="right">';
					
					if($dType){
						echo '<a title="'._TABLE_GOUPBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_download&amp;category='.$arr_dw['uid'][$key].'">'
						.'<img title="'._TABLE_GOUPBUTTON.'" alt="'._TABLE_GOUPBUTTON.'" style="padding-top: 3px;" border="0" src="../images/go_right.gif" />'
						.'</a><br />';
					}
					
					echo '</td>';
					
					
					
					// end row
					echo '</tr>';
					
					
					
					// row2
					echo '<tr id="row2'.$key.'" '
					.'bgcolor="'.$ws_farbe.'" '
					.'onMouseOver="wxlBgCol(\'row2'.$key.'\',\'#ececec\');wxlBgCol(\'row1'.$key.'\',\'#ececec\');" '
					.'onMouseOut="wxlBgCol(\'row2'.$key.'\',\''.$ws_farbe.'\');wxlBgCol(\'row1'.$key.'\',\''.$ws_farbe.'\');"'
					.( $dType == true
					? ''//' onclick="'.$strLocation.'"'
					: ''
					).'>';
					
					
					
					// show image
					if($dType){
						echo '<td valign="top" align="left" class="tcms_db_2">'
						.'&nbsp;<img src="../images/filesystem/'.$arr_dw['type'][$key].'.png" border="0" />'
						.'</td>';
					}
					else{
						echo '<td valign="top" align="left" class="tcms_db_2">&nbsp;'
						.( $arr_dw['img'][$key] == '_mimetypes_' 
						?
							( file_exists('../images/mimetypes/'.$arr_dw['type'][$key].'.png')
							? '<img src="../images/mimetypes/'.$arr_dw['type'][$key].'.png" border="0" />'
							: '<img src="../images/mimetypes/empty.png" border="0" />' )
							.'<input name="img_as_mime" value="1" type="hidden" />'
						:
							'<img src="../../'.$tcms_administer_site.'/files/'.$arr_dw['uid'][$key].'/'.$arr_dw['img'][$key].'" border="0" />'
							.'<br />'
							.'<input name="img_as_mime" id="img_as_mime_id_'.$key.'" value="1" type="checkbox" />'
							.'<label for="img_as_mime_id_'.$key.'">'._DOWNLOADS_SAVE_AS_MIMITYPE.'</label>'
						).'</td>';
					}
					
					
					
					// desc
					echo '<td valign="top" align="left" class="tcms_db_2" colspan="5">';
					
					if($dType){
						echo '<textarea name="new_desc" class="tcms_textarea_big">'.$arr_dw['desc'][$key].'</textarea>'
						.'<br />'
						.'<select class="tcms_select" name="new_cat">'
						.'<option value="_DB_NULL_"'.( trim($arr_dw['cat'][$key]) == '' ? ' selected="selected"' : '' ).'>'._FAQ_BASE_CATEGORY.'</option>';
						
						foreach($arrDownCategories['tag'] as $mkey => $mvalue){
							if($mvalue != $arr_dw['uid'][$key])
								echo '<option value="'.$mvalue.'"'.( $arr_dw['cat'][$key] == $mvalue ? ' selected="selected"' : '' ).'>'.$arrDownCategories['title'][$mkey].'</option>';
						}
						
						echo '</select>';
					}
					else{
						echo '<textarea name="new_desc" class="tcms_textarea_big">'.$arr_dw['desc'][$key].'</textarea>'
						.'<br />'
						.'<input class="tcms_input_small" id="new_date" name="new_date" type="text" value="'.$arr_dw['date'][$key].'" />'
						.'<input type="button" value="&nbsp;" style="background: transparent url(../js/jscalendar/img.gif) no-repeat;" id="triggerButtonDateTime" />'
						.'<script type="text/javascript">
						Calendar.setup({
					        inputField     :    "new_date",
					        ifFormat       :    "%d.%m.%Y-%H:%M",
					        showsTime      :    true,
					        timeFormat     :    24,
					        button         :    "triggerButtonDateTime",
					        singleClick    :    false,
					        step           :    1
					    });
						</script>'
						.'<br />'
						.'<select class="tcms_select" name="new_cat">'
						.'<option value="_DB_NULL_"'.( $arr_dw['cat'][$key] == '' ? ' selected="selected"' : '' ).'>'._FAQ_BASE_CATEGORY.'</option>';
						
						foreach($arrDownCategories['tag'] as $okey => $ovalue){
							echo '<option value="'.$ovalue.'"'.( $arr_dw['cat'][$key] == $ovalue ? ' selected="selected"' : '' ).'>'.$arrDownCategories['title'][$okey].'</option>';
						}
						
						echo '</select>';
					}
					
					echo '</form>'
					.'</td>';
					
					
					
					// functions
					echo '<td align="right" valign="top" class="tcms_db_2">'
					.'<a title="'._TABLE_SAVEBUTTON.'" href="javascript:document.getElementById(\''.$arr_dw['uid'][$key].'\').submit();">'
					.'<img title="'._TABLE_SAVEBUTTON.'" alt="'._TABLE_SAVEBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_save.gif" />'
					.'</a><br />'
					.'<a title="'._TABLE_DELBUTTON.'" href="javascript:submitXML(\''.$arr_dw['uid'][$key].'\', \'todo'.$key.'\', \'delete\');">'
					.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
					.'</a>'
					.'</td>';
					
					
					
					// end row 2
					echo '</tr>';
				}
			}
			
			echo '</table><br />';
		}
		
		
		
		
		/*
			create
			category
		*/
		
		if($todo == 'create'){
			$width = '150';
			
			
			echo $tcms_html->bold(_TABLE_NEW);
			echo $tcms_html->text(_DOWNLOADS_NEW_CAT.'<br /><br />', 'left');
			
			
			// form
			echo '<form action="admin.php?id_user='.$id_user.'&site=mod_download" method="post">'
			.'<input name="todo" type="hidden" value="category" />'
			.'<input name="create_folder" type="hidden" value="1" />';
			
			
			// table head
			echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder"><tr class="tcms_bg_blue_01">'
			.'<th valign="top" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>'
			.'</tr></table>';
			
			
			// table head
			echo '<table width="100%" border="0" cellpadding="1" cellspacing="5" class="tcms_table">';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_CATEGORY.'</strong></td>'
			.'<td valign="top">'
			.'<select class="tcms_select" name="new_cat">'
			.'<option value="_DB_NULL_"'.( isset($category) ? '' : ' selected="selected"' ).'>'._FAQ_BASE_CATEGORY.'</option>';
			
			foreach($arrDownCategories['tag'] as $key => $value){
				echo '<option value="'.$value.'"'.( isset($category) ? ' selected="selected"' : '' ).'>'.$arrDownCategories['title'][$key].'</option>';
			}
			
			echo '</select>'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TITLE.'</strong></td>'
			.'<td valign="top"><input class="tcms_input_normal" name="new_name" type="text" />'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_DESCRIPTION.'</strong></td>'
			.'<td valign="top"><textarea class="tcms_textarea_big" name="new_desc" type="text"></textarea>'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_PUBLISHED.'</strong></td>'
			.'<td valign="top"><input name="new_pub" value="1" checked="checked" type="checkbox" />'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ACCESS.'</strong></td>'
			.'<td valign="top">'
			.'<select name="new_access" class="tcms_select">'
				.'<option value="Public" selected="selected">'._TABLE_PUBLIC.'</option>'
				.'<option value="Protected">'._TABLE_PROTECTED.'</option>'
				.'<option value="Private">'._TABLE_PRIVATE.'</option>'
			.'</select>'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_CATEGORY.'</strong></td>'
			.'<td valign="top">'
			.'<select name="new_type" class="tcms_select">';
			foreach($arr_fs['tag'] as $fskey => $fsvalue){
					echo '<option value="'.$fsvalue.'"'.( $arr_dw['type'][$key] == $fsvalue ? ' selected' : '' ).'>'.$arr_fs['des'][$fskey].'</option>';
				}
			echo '</select>'
			.'</td></tr>';
			
			
			// table end
			echo '</table>'
			.'</form>';
		}
		
		
		
		
		
		
		
		
		
		/*
			list / edit
			download
		*/
		if($todo == 'edit'){
			// init
			$width = '150';
			
			
			// title
			echo $tcms_html->bold(_TABLE_NEW);
			echo $tcms_html->text(_DOWNLOADS_NEW.' '._DOWNLOADS_HELP.'<br /><br />', 'left');
			
			
			// begin form
			echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_download" method="post" enctype="multipart/form-data">'
			.'<input name="todo" type="hidden" value="save" />'
			.'<input name="create_folder" type="hidden" value="1" />';
			
			
			// table head
			echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder"><tr class="tcms_bg_blue_01">';
			echo '<th valign="top" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>';
			echo '</tr></table>';
			
			
			// table head
			echo '<table width="100%" border="0" cellpadding="1" cellspacing="5" class="tcms_table">';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_CATEGORY.'</strong></td>'
			.'<td valign="top">'
			.'<select class="tcms_select" name="new_cat">'
			.'<option value="_DB_NULL_"'.( isset($category) ? '' : ' selected="selected"' ).'>'._FAQ_BASE_CATEGORY.'</option>';
			
			foreach($arrDownCategories['tag'] as $key => $value){
				echo '<option value="'.$value.'"'.( isset($category) ? ' selected="selected"' : '' ).'>'.$arrDownCategories['title'][$key].'</option>';
			}
			
			echo '</select>'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TITLE.'</strong></td>'
			.'<td valign="top"><input class="tcms_input_normal" name="new_name" type="text" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_DESCRIPTION.'</strong></td>'
			.'<td valign="top"><textarea class="tcms_textarea_big" name="new_desc" type="text"></textarea>'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_PUBLISHED.'</strong></td>'
			.'<td valign="top"><input name="new_pub" value="1" checked="checked" type="checkbox" />'
			.'</td></tr>';
			
			
			// table row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ACCESS.'</strong></td>'
			.'<td valign="top">'
			.'<select name="new_access" class="tcms_select">'
				.'<option value="Public" selected="selected">'._TABLE_PUBLIC.'</option>'
				.'<option value="Protected">'._TABLE_PROTECTED.'</option>'
				.'<option value="Private">'._TABLE_PRIVATE.'</option>'
			.'</select>'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_IMAGE.'</strong></td>'
			.'<td valign="top"><input class="tcms_upload" name="down_image" type="file" accept="image/*" />'
			.'</td></tr>';
			
			
			// table end
			echo '</table>';
			
			
			// table head
			echo '<table width="100%" border="0" cellpadding="1" cellspacing="5" class="tcms_table tcms_switchcolor_1">';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'
				.'<input type="radio" name="fileplace" id="fileplace1" checked="checked" value="1" />'
				.'<label for="fileplace1"><strong class="tcms_bold">'._TABLE_FILE.'</strong></label>'
			.'</td><td valign="top">'
				.'<input class="tcms_upload" name="down_file" type="file" onclick="document.getElementById(\'fileplace1\').checked=true;" />'
			.'</td></tr>';
			
			
			// table end
			echo '</table>';
			
			
			// table head
			echo '<table width="100%" border="0" cellpadding="1" cellspacing="5" class="tcms_table tcms_switchcolor_2">';
			
			
			// table row
			echo '<tr><td valign="top" colspan="2">'
				.'<label for="fileplace2"><strong class="tcms_bold">'._TABLE_FILE_EXISTS.'</strong></label>'
			.'</td></tr>'
			.'<tr class="tcms_switchcolor_2"><td valign="top" width="'.$width.'">'
				.'<input type="radio" name="fileplace" id="fileplace2" value="2" />'
				.'<label for="fileplace2"><strong class="tcms_bold">'._TABLE_FILE_EXISTS_NAME.'</strong></label>'
			.'</td><td valign="top">'
			.	'<input class="tcms_input_normal" name="down_file_exists" type="text" onclick="document.getElementById(\'fileplace2\').checked=true;" />'
			.'</td></tr>';
			
			
			// table end
			echo '</table>';
			
			
			// table head
			echo '<table width="100%" border="0" cellpadding="1" cellspacing="5" class="tcms_table tcms_switchcolor_3">';
			
			
			// table row
			echo '<tr><td valign="top" colspan="2">'
				.'<label for="fileplace3"><strong class="tcms_bold">'._TABLE_FILE_OTHERURL.'</strong></label>'
			.'</td></tr>'
			.'<tr><td valign="top" width="'.$width.'">'
				.'<input type="radio" name="fileplace" id="fileplace3" value="3" />'
				.'<label for="fileplace3"><strong class="tcms_bold">'._TABLE_FILE_OTHERURL_NAME.'</strong></label>'
			.'</td><td valign="top">'
				.'<input class="tcms_input_normal" name="down_file_otherurl" type="text" onclick="document.getElementById(\'fileplace3\').checked=true;" />'
			//.'</td></tr>'
			//.'<tr><td valign="top" width="'.$width.'">'
				//.'<label for="fileplace3"><strong class="tcms_bold">'._TABLE_NAME.'</strong></label>'
			//.'</td><td valign="top">'
				//.'<input class="tcms_input_small" name="down_name_otherurl" type="text" />'
			.'</td></tr>';
			
			
			// table end
			echo '</table>';
			
			
			// master table end
			echo '</form>';
		}
		
		
		
		
		/*
			save
			config
		*/
		
		if($todo == 'save_config'){
			if(empty($new_download_id)){ $new_download_id = 'download'; }
			if(empty($download_title)) { $download_title  = $old_download_title; }
			if(empty($download_stamp)) { $download_stamp  = $old_download_stamp; }
			if(empty($download_text))  { $download_text   = $old_download_text; }
			
			$download_title = $tcms_main->encodeText($download_title, '2', $c_charset);
			$download_stamp = $tcms_main->encodeText($download_stamp, '2', $c_charset);
			$download_text  = $tcms_main->encodeText($download_text, '2', $c_charset);
			
			$download_text = $tcms_main->convertNewlineToHTML($download_text);
			
			if($choosenDB == 'xml'){
				$xmluser = new xmlparser(_TCMS_PATH.'/tcms_global/download.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('config');
				
				$xmluser->write_value('download_id', $new_download_id);
				$xmluser->write_value('download_title', $download_title);
				$xmluser->write_value('download_stamp', $download_stamp);
				$xmluser->write_value('download_text', $download_text);
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('config');
				$xmluser->flush();
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$newSQLData = ''
				.$tcms_db_prefix.'downloads_config.download_id="'.$new_download_id.'", '
				.$tcms_db_prefix.'downloads_config.download_title="'.$download_title.'", '
				.$tcms_db_prefix.'downloads_config.download_stamp="'.$download_stamp.'", '
				.$tcms_db_prefix.'downloads_config.download_text="'.$download_text.'"';
				
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'downloads_config', $newSQLData, 'download');
			}
			
			//---------------------------------------------------------------------
			
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_download&todo=config\';</script>';
		}
		
		
		
		
		/*
			save
			category
		*/
		
		if($todo == 'category'){
			if($create_folder == 1)
				$createMe = true;
			else
				$createMe = false;
			
				
			if($new_sort == ''){
				if($choosenDB == 'xml'){
					$max_files = $tcms_file->getPathContent(_TCMS_PATH.'/files/');
					$new_sort = count($max_files) + 1;
				}
				else{
					$new_sort = $tcms_main->create_sort_id($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'downloads', 'sort', true, ( $new_cat == '_DB_NULL_' ? '' : $new_cat ));
				}
			}
			else{
				$new_sort = $new_sort;
			}
			
			
			if($new_pub == '' || !isset($new_pub) || empty($new_pub))
				$new_pub = 0;
			
				
			if(!isset($new_date))
				$new_date = date('d.m.Y-H:i');
			
			
			if($new_name == '' || empty($new_name) || !isset($new_name)){ $new_name = ''; }
			if($new_desc == '' || empty($new_desc) || !isset($new_desc)){ $new_desc = ''; }
			
			//$download_text = $tcms_main->convertNewlineToHTML($download_text);
			
			
			// UID
			if($createMe)
				$maintag = $tcms_main->getNewUID(10, 'downloads');
			
			
			// CHARSETS
			$new_name = $tcms_main->encodeText($new_name, '2', $c_charset);
			$new_desc = $tcms_main->encodeText($new_desc, '2', $c_charset);
			
			
			if($createMe){
				$old_umask = umask(0);
				mkdir(_TCMS_PATH.'/files/'.$maintag, 0777);
				umask($old_umask);
				
				
				/*
					toendaCMS 403 Error page
				*/
				$fp = fopen(_TCMS_PATH.'/files/'.$maintag.'/index.html', 'w');
				fwrite($fp, '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
				.'<html xmlns="http://www.w3.org/1999/xhtml">'
				.'<head><title>toendaCMS Error 403: Forbidden!</title><meta name="generator" content="'.$cms_name.' - '.$cms_tagline.' | Copyright '.$toenda_copy.' Toenda Software Development. '._TCMS_ADMIN_RIGHT.'" /></head>'
				.'<body><div align="center"><h1 style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif; padding: 100px 0 0 0;">toendaCMS Error 403: Forbidden!</h1></div></body>'
				.'</html>');
				fclose($fp);
			}
			
			
			if($choosenDB == 'xml'){
				$xmluser = new xmlparser(_TCMS_PATH.'/files/'.$maintag.'/info.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('info');
				
				$xmluser->write_value('name', $new_name);
				$xmluser->write_value('date', $new_date);
				$xmluser->write_value('desc', $new_desc);
				$xmluser->write_value('type', $new_type);
				$xmluser->write_value('sort', $new_sort);
				$xmluser->write_value('pub', $new_pub);
				$xmluser->write_value('access', $new_access);
				$xmluser->write_value('image', '');
				$xmluser->write_value('file', '');
				$xmluser->write_value('cat', ( $new_cat == '_DB_NULL_' ? '' : $new_cat ));
				$xmluser->write_value('parent', ( $new_cat == '_DB_NULL_' ? '' : $new_cat ));
				$xmluser->write_value('sql_type', 'd');
				$xmluser->write_value('mirror', '');
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('info');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				if($createMe){
					switch($choosenDB){
						case 'mysql':
							$newSQLColumns = '`name`, `date`, `desc`, `type`, `sort`, `pub`, '
							.'`access`, `image`, `file`, `cat`, `parent`, `sql_type`, `mirror`';
							break;
						
						case 'pgsql':
							$newSQLColumns = 'name, date, "desc", "type", sort, pub, '
							.'"access", image, file, cat, parent, sql_type, mirror';
							break;
						
						case 'mssql':
							$newSQLColumns = '[name], [date], [desc], [type], [sort], [pub], '
							.'[access], [image], [file], [cat], [parent], [sql_type], [mirror]';
							break;
					}
					
					$newSQLData = "'".$new_name."', '".$new_date."', '".$new_desc."', '".$new_type."', ".$new_sort.", "
					."".$new_pub.", '".$new_access."', NULL, NULL, "
					."".( $new_cat == '_DB_NULL_' ? 'NULL' : "'".$new_cat."'" ).", ".( $new_cat == '_DB_NULL_' ? 'NULL' : "'".$new_cat."'" ).", 'd', NULL";
					
					$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'downloads', $newSQLColumns, $newSQLData, $maintag);
				}
				else{
					$newSQLData = ''
					.$tcms_db_prefix.'downloads.name="'.$new_name.'", '
					.$tcms_db_prefix.'downloads.date="'.$new_date.'", '
					.$tcms_db_prefix.'downloads.desc="'.$new_desc.'", '
					.$tcms_db_prefix.'downloads.type="'.$new_type.'", '
					.$tcms_db_prefix.'downloads.sort='.$new_sort.', '
					.$tcms_db_prefix.'downloads.pub='.$new_pub.', '
					.$tcms_db_prefix.'downloads.access="'.$new_access.'", '
					.$tcms_db_prefix.'downloads.image=NULL, '
					.$tcms_db_prefix.'downloads.file=NULL, '
					.$tcms_db_prefix.'downloads.cat='.( $new_cat == '_DB_NULL_' ? 'NULL' : '"'.$new_cat.'"' ).', '
					.$tcms_db_prefix.'downloads.parent='.( $new_cat == '_DB_NULL_' ? 'NULL' : '"'.$new_cat.'"' ).', '
					.$tcms_db_prefix.'downloads.sql_type="d", '
					.$tcms_db_prefix.'downloads.mirror=NULL';
					
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'downloads', $newSQLData, $maintag);
				}
			}
			
			//*****************************************
			
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_download\'</script>';
			
			//*****************************************
		}
		
		
		
		
		/*
			save
			file
		*/
		
		if($todo == 'save'){
			if($create_folder == 1)
				$createMe = true;
			else
				$createMe = false;
			
			$file_up = false;
			$image_up = false;
			
			
			// only at creating
			if($createMe){
				// check
				if($fileplace == 3){
					if($down_file_otherurl == '')
						echo '<script>alert(\''._BOOK_FILL_IN.'\');history.back;\'</script>';
					
					//if($down_name_otherurl == '')
						//echo '<script>alert(\''._BOOK_FILL_IN.'\');history.back;\'</script>';
				}
				
				
				// test
				switch($fileplace){
					case 1: // DOWN_FILE
						if($_FILES['down_file']['size'] > 0)
							$file_up = true;
						else
							echo '<script>alert(\''._MSG_NOUPLOAD.'\');history.back;\'</script>';
						
						$down_file = $_FILES['down_file']['name'];
						break;
					
					case 2: // DOWN_FILE_EXISTS
						$file_up = false;
						
						if(!empty($down_file_exists) && $down_file_exists != '')
							$down_file = $down_file_exists;
						else
							echo '<script>alert(\''._MSG_NOUPLOAD.'\');history.back;\'</script>';
						break;
					
					case 3: // DOWN_FILE_ON_OTHER_SERVER
						$file_up = false;
						
						if(!empty($down_file_otherurl) && $down_file_otherurl != '')
							$down_file = $down_file_otherurl;
						else
							echo '<script>alert(\''._MSG_NOUPLOAD.'\');history.back;\'</script>';
						break;
				}
			}
			else{
				$down_file = $new_file;
			}
			
			
			// start
			if($down_file != ''){
				/*
					TITLE AND DESCRIPTION
				*/
				if($new_name == '' || empty($new_name) || !isset($new_name)){ $new_name = ''; }
				if($new_desc == '' || empty($new_desc) || !isset($new_desc)){ $new_desc = ''; }
				
				//$download_text = $tcms_main->convertNewlineToHTML($download_text);
				
				
				
				/*
					CHARSETS
				*/
				$new_name = $tcms_main->encodeText($new_name, '2', $c_charset);
				$new_desc = $tcms_main->encodeText($new_desc, '2', $c_charset);
				
				
				
				/*
					DATE
				*/
				if($createMe)
					$down_date = date('d.m.Y-H:i');
				else
					$down_date = $new_date;
				
				
				
				/*
					SORT
				*/
				if(!isset($new_sort) || $new_sort == '' || empty($new_sort)){
					if($choosenDB == 'xml'){
						$max_files = $tcms_file->getPathContent(_TCMS_PATH.'/files/');
						$down_sort = count($max_files) + 1;
					}
					else{
						$down_sort = $tcms_main->create_sort_id($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'downloads', 'sort', true, ( $new_cat == '_DB_NULL_' ? '' : $new_cat ));
					}
				}
				else{
					$down_sort = $new_sort;
				}
				
				
				
				/*
					PUB
				*/
				if($new_pub == '' || !isset($new_pub) || empty($new_pub))
					$down_pub = 0;
				else
					$down_pub = 1;
				
				
				
				/*
					MIMETYPES
				*/
				$down_filetype = $tcms_file->getMimeType($down_file);
				
				
				
				/*
					UID
				*/
				if($createMe)
					$maintag = $tcms_main->getNewUID(10, 'downloads');
				
				
				
				/*
					CREATE FOLDER
				*/
				if($createMe){
					if(!is_dir(_TCMS_PATH.'/files/'.$maintag)){
						$old_umask = umask(0);
						mkdir(_TCMS_PATH.'/files/'.$maintag, 0777);
						umask($old_umask);
						
						/*
							toendaCMS 403 Error page
						*/
						$fp = fopen(_TCMS_PATH.'/files/'.$maintag.'/index.html', 'w');
						fwrite($fp, '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
						.'<html xmlns="http://www.w3.org/1999/xhtml">'
						.'<head><title>toendaCMS Error 403: Forbidden!</title><meta name="generator" content="'.$cms_name.' - '.$cms_tagline.' | Copyright '.$toenda_copy.' Toenda Software Development. '._TCMS_ADMIN_RIGHT.'" /></head>'
						.'<body><div align="center"><h1 style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif; padding: 100px 0 0 0;">toendaCMS Error 403: Forbidden!</h1></div></body>'
						.'</html>');
						fclose($fp);
					}
				}
				
				
				
				/*
					UPLOAD FILE
				*/
				if($file_up == true){
					$down_dir = _TCMS_PATH.'/files/'.$maintag.'/';
					
					$down_file = str_replace(' ', '_', $down_file);
					$down_file = str_replace('Ü', 'Ue', $down_file);
					$down_file = str_replace('ü', 'ue', $down_file);
					$down_file = str_replace('Ä', 'Ae', $down_file);
					$down_file = str_replace('ä', 'ae', $down_file);
					$down_file = str_replace('Ö', 'Oe', $down_file);
					$down_file = str_replace('ö', 'oe', $down_file);
					$down_file = str_replace('ß', 'ss', $down_file);
					
					//$down_file = strtolower($down_file);
					
					copy($_FILES['down_file']['tmp_name'], $down_dir.$down_file);
					
					$msg = _MSG_UPLOAD.' '.$down_dir.$down_file;
				}
				
				if($fileplace == 2){
					$down_dir = _TCMS_PATH.'/files/';
					$new_dir = _TCMS_PATH.'/files/'.$maintag.'/';
					
					copy($down_dir.$down_file, $new_dir.$down_file);
					
					unlink($down_dir.$down_file);
				}
				
				
				
				/*
					UPLOAD IMAGE
				*/
				if($createMe){
					if($_FILES['down_image']['size'] > 0 && (
					$_FILES['down_image']['type'] == 'image/gif' || 
					$_FILES['down_image']['type'] == 'image/png' || 
					$_FILES['down_image']['type'] == 'image/jpg' || 
					$_FILES['down_image']['type'] == 'image/jpeg' || 
					$_FILES['down_image']['type'] == 'image/bmp')){
						$image_up = true;
						
						$down_dir = _TCMS_PATH.'/files/'.$maintag.'/';
						$down_image = $_FILES['down_image']['name'];
						
						copy($_FILES['down_image']['tmp_name'], $down_dir.$down_image);
						
						$msg = _MSG_UPLOAD.' '.$down_dir.$_FILES['down_image']['name'];
					}
					else{
						$image_up = false;
						$down_image = '_mimetypes_';
					}
				}
				else{
					if(isset($new_image) && $new_image != '' && !empty($new_image)){
						if($img_as_mime == '1'){
							$down_image = '_mimetypes_';
							
							if(file_exists(_TCMS_PATH.'/files/'.$maintag.'/'.$new_image))
								unlink(_TCMS_PATH.'/files/'.$maintag.'/'.$new_image);
						}
						else{
							$down_image = $new_image;
						}
					}
					else{
						$down_image = '_mimetypes_';
					}
				}
				
				
				
				/*
					and now: save
				*/
				if($choosenDB == 'xml'){
					$xmluser = new xmlparser(_TCMS_PATH.'/files/'.$maintag.'/info.xml', 'w');
					$xmluser->xml_declaration();
					$xmluser->xml_section('info');
					
					$xmluser->write_value('name', $new_name);
					$xmluser->write_value('date', $down_date);
					$xmluser->write_value('desc', $new_desc);
					$xmluser->write_value('type', $down_filetype);
					$xmluser->write_value('sort', $down_sort);
					$xmluser->write_value('pub', $down_pub);
					$xmluser->write_value('access', $new_access);
					$xmluser->write_value('image', $down_image);
					$xmluser->write_value('file', $down_file);
					$xmluser->write_value('cat', ( $new_cat == '_DB_NULL_' ? '' : $new_cat ));
					$xmluser->write_value('parent', ( $new_cat == '_DB_NULL_' ? '' : $new_cat ));
					$xmluser->write_value('sql_type', 'f');
					$xmluser->write_value('mirror', ( $fileplace == 3 ? '1' : '0' ));
					
					$xmluser->xml_section_buffer();
					$xmluser->xml_section_end('info');
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					if($createMe){
						switch($choosenDB){
							case 'mysql':
								$newSQLColumns = '`name`, `date`, `desc`, `type`, `sort`, `pub`, '
								.'`access`, `image`, `file`, `cat`, `parent`, `sql_type`, `mirror`';
								break;
							
							case 'pgsql':
								$newSQLColumns = 'name, date, "desc", "type", sort, pub, '
								.'"access", image, file, cat, parent, sql_type, mirror';
								break;
							
							case 'mssql':
								$newSQLColumns = '[name], [date], [desc], [type], [sort], [pub], '
								.'[access], [image], [file], [cat], [parent], [sql_type], [mirror]';
								break;
						}
						
						$newSQLData = "'".$new_name."', '".$down_date."', '".$new_desc."', '".$down_filetype."', ".$down_sort.", 
						".$down_pub.", '".$new_access."', '".$down_image."', '".$down_file."', 
						".( $new_cat == '_DB_NULL_' ? 'NULL' : "'".$new_cat."'" ).", ".( $new_cat == '_DB_NULL_' ? 'NULL' : "'".$new_cat."'" ).", 'f', ".( $fileplace == 3 ? '1' : '0' )."";
						
						$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'downloads', $newSQLColumns, $newSQLData, $maintag);
					}
					else{
						$newSQLData = ''
						.$tcms_db_prefix.'downloads.name="'.$new_name.'", '
						.$tcms_db_prefix.'downloads.date="'.$down_date.'", '
						.$tcms_db_prefix.'downloads.desc="'.$new_desc.'", '
						.$tcms_db_prefix.'downloads.type="'.$down_filetype.'", '
						.$tcms_db_prefix.'downloads.sort='.$down_sort.', '
						.$tcms_db_prefix.'downloads.pub='.$down_pub.', '
						.$tcms_db_prefix.'downloads.access="'.$new_access.'", '
						.$tcms_db_prefix.'downloads.image="'.$down_image.'", '
						.$tcms_db_prefix.'downloads.file="'.$down_file.'", '
						.$tcms_db_prefix.'downloads.cat='.( $new_cat == '_DB_NULL_' ? 'NULL' : '"'.$new_cat.'"' ).', '
						.$tcms_db_prefix.'downloads.parent='.( $new_cat == '_DB_NULL_' ? 'NULL' : '"'.$new_cat.'"' ).', '
						.$tcms_db_prefix.'downloads.sql_type="f", '
						.$tcms_db_prefix.'downloads.mirror='.( $fileplace == 3 ? '1' : '0' );
						
						$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'downloads', $newSQLData, $maintag);
					}
				}
				
				//*****************************************
				
				echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_download'.( $new_cat == '_DB_NULL_' ? '' : '&category='.$new_cat ).'\';</script>';
				
				//*****************************************
			}
			else{
				echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_download'.( $new_cat == '_DB_NULL_' ? '' : '&category='.$new_cat ).'\';</script>';
			}
		}
		
		
		
		
		
		/*
			delete
			file
		*/
		
		if($todo == 'delete'){
			if(isset($delete) && $delete == 1){
				if($choosenDB != 'xml'){
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$sqlRes = $sqlAL->sqlDeleteOne($tcms_db_prefix.'downloads', $maintag);
					
					$sqlQR = $sqlAL->sqlQuery("SELECT * FROM ".$tcms_db_prefix."downloads WHERE cat='".$maintag."' AND sql_type='d'");
					$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
					
					$sqlQR2 = $sqlAL->sqlQuery("DELETE FROM ".$tcms_db_prefix."downloads WHERE cat='".$maintag."'");
					
					//while($sqlNR != 0){
						while($sqlARR = $sqlAL->fetchArray($sqlQR)){
							$new_maintag = $sqlARR['uid'];
							
							if(is_dir(_TCMS_PATH.'/files/'.$maintag.'/')) {
								$tcms_file->deleteDir(_TCMS_PATH.'/files/'.$new_maintag.'/');
							}
							
							$sqlQR = $sqlAL->sqlQuery("DELETE FROM ".$tcms_db_prefix."downloads WHERE cat='".$new_maintag."'");
							
							//$sqlQR = $sqlAL->sqlQuery("SELECT * FROM ".$tcms_db_prefix."downloads WHERE cat='".$new_maintag."' AND sql_type='d'");
							//$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
							
							//$sqlARR = $sqlAL->fetchArray($sqlQR);
							//$new_maintag = $sqlARR['uid'];
						}
					//}
				}
				
				if(is_dir(_TCMS_PATH.'/files/'.$maintag.'/')) {
					$tcms_file->deleteDir(_TCMS_PATH.'/files/'.$maintag.'/');
				}
				
				echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_download'.( $category == '' || !isset($category) ? '' : '&category='.$category ).'\';</script>';
			}
			else{
				echo '<script>'
				.'alert(\''._MSG_DELETE_INACTIVE.'\');'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_download'.( $category == '' || !isset($category) ? '' : '&category='.$category ).'\';'
				.'</script>';
			}
		}
	}
	else{
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
}
else{
	echo '<strong>'._MSG_PHP_SAFE_MODE_SETTINGS.'</strong>';
}

?>
