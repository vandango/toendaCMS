<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Comment management
|
| File:	mod_comments.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Comment management
 *
 * This module is used to manage the comments.
 *
 * @version 0.2.9
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['image'])){ $image = $_GET['image']; }
if(isset($_GET['val'])){ $val = $_GET['val']; }
if(isset($_GET['album'])){ $album = $_GET['album']; }
if(isset($_GET['minValue'])){ $minValue = $_GET['minValue']; }
if(isset($_GET['maxValue'])){ $maxValue = $_GET['maxValue']; }
if(isset($_GET['thisValue'])){ $thisValue = $_GET['thisValue']; }

if(isset($_POST['action'])){ $action = $_POST['action']; }
if(isset($_POST['image'])){ $image = $_POST['image']; }
if(isset($_POST['val'])){ $val = $_POST['val']; }
if(isset($_POST['album'])){ $album = $_POST['album']; }
if(isset($_POST['new_comment_name'])){ $new_comment_name = $_POST['new_comment_name']; }
if(isset($_POST['new_comment_desc'])){ $new_comment_desc = $_POST['new_comment_desc']; }
if(isset($_POST['new_comment_email'])){ $new_comment_email = $_POST['new_comment_email']; }
if(isset($_POST['new_comment_www'])){ $new_comment_www = $_POST['new_comment_www']; }
if(isset($_POST['new_comment_ip'])){ $new_comment_ip = $_POST['new_comment_ip']; }
if(isset($_POST['new_comment_domain'])){ $new_comment_domain = $_POST['new_comment_domain']; }
if(isset($_POST['new_comment_time'])){ $new_comment_time = $_POST['new_comment_time']; }



if($id_group == 'Developer' 
|| $id_group == 'Administrator'){
	/*
		init
	*/
	
	if(!isset($todo)){ $todo = 'show'; }
	if(!isset($action)){ $action = 'news'; }
	
	if(!isset($minValue)){ $minValue = 0; }
	if(!isset($maxValue)){ $maxValue = 10; }
	if(!isset($thisValue)){ $thisValue = 10; }
	
	
	
	
	
	if($todo != 'edit'){
		/*
			tab for module news and image
		*/
		echo '<div style="display: block; width: 100%; border-bottom: 1px solid #ccc; padding-bottom: 2px;">'
		.'<div style="display: block; width: 30px; float: left;">&nbsp;</div>'
		.'<a'.( $action == 'news' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' href="admin.php?id_user='.$id_user.'&amp;site=mod_comments&amp;action=news">'._TCMS_MENU_NEWS.'</a>'
		.'<a'.( $action == 'image' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' href="admin.php?id_user='.$id_user.'&amp;site=mod_comments&amp;action=image">'._FOLDER_IMAGES.'</a>'
		.'</div>';
		
		echo '<div class="tcms_tabPage"><br />';
	}
	
	
	
	
	
	if($todo == 'show'){
		echo $tcms_html->bold(_COMMENTS_TITLE);
		echo $tcms_html->text(_COMMENTS_TEXT.'<br /><br />', 'left');
		
		
		if($choosenDB == 'xml') {
			if($action == 'news') {
				$arr_filename = $tcms_main->readdir_comment(_TCMS_PATH.'/tcms_news/');
			}
			else {
				$arr_filename = $tcms_main->readdir_image_comment(_TCMS_PATH.'/tcms_imagegallery/', 'image');
				$arr_album    = $tcms_main->readdir_image_comment(_TCMS_PATH.'/tcms_imagegallery/', 'album');
			}
			
			$count = 0;
			
			if($tcms_main->isArray($arr_filename)) {
				foreach($arr_filename as $key => $value) {
					if($value != 'index.html') {
						if($action == 'news') {
							$arrComments = $tcms_file->getPathContent(
								_TCMS_PATH.'/tcms_news/'.$value.'/'
							);
						}
						else {
							$arrComments = $tcms_file->getPathContent(
								_TCMS_PATH.'/tcms_imagegallery/'.$arr_album[$key].'/'.$value.'/'
							);
						}
						
						if(isset($arrComments) && !empty($arrComments) && $arrComments != ''){
							foreach($arrComments as $Ckey => $Cvalue){
								if($Cvalue != 'index.html'){
									/*
										news
									*/
									if($action == 'news'){
										$main_xml = new xmlparser(_TCMS_PATH.'/tcms_news/'.substr($value, 9, 10).'.xml','r');
										$_title_  = $main_xml->read_section('news', 'title');
										$main_xml->flush();
										
										$_title_ = $tcms_main->decodeText($_title_, '2', $c_charset);
									}
									else{
										$_title_  = substr($value, 9);
										
										$arrCat['album'][$count] = $arr_album[$key];
									}
									
									
									/*
										comment
									*/
									if($action == 'news') {
										$menu_xml = new xmlparser(
											_TCMS_PATH.'/tcms_news/'.$value.'/'.$Cvalue,
											'r'
										);
									}
									else {
										$menu_xml = new xmlparser(
											_TCMS_PATH.'/tcms_imagegallery/'.$arr_album[$key].'/'.$value.'/'.$Cvalue,
											'r'
										);
									}
									
									$_msg_ = $tcms_main->decodeText(
										$menu_xml->readSection('comment', 'msg'), 
										'2', 
										$c_charset
									);
									
									$_msg_ = str_replace('<br />', ' - ', $_msg_);
									$_msg_ = str_replace('<br/>', ' - ', $_msg_);
									$_msg_ = str_replace('<br>', ' - ', $_msg_);
									$_msg_ = str_replace('<BR />', ' - ', $_msg_);
									$_msg_ = str_replace('<BR/>', ' - ', $_msg_);
									$_msg_ = str_replace('<BR>', ' - ', $_msg_);
									//$_msg_ = str_replace('<a href=', '[a href=', $_msg_);
									//$_msg_ = str_replace('</a>', '[/a]', $_msg_);
									$_msg_ = strip_tags($_msg_);
									
									$arrCat['cnt'][$count]    = $count;
									$arrCat['tag'][$count]    = substr($Cvalue, 0, 14);
									$arrCat['uid'][$count]    = ( $action == 'news' ? substr($value, 9, 10) : substr($value, 9) );
									$arrCat['name'][$count]   = $menu_xml->read_section('comment', 'name');
									$arrCat['desc'][$count]   = ( strlen($_msg_) > 150 ? substr($_msg_, 0, 150).' ...' : $_msg_ );
									$arrCat['ip'][$count]     = $menu_xml->read_section('comment', 'ip');
									$arrCat['domain'][$count] = $menu_xml->read_section('comment', 'domain');
									$arrCat['email'][$count]  = $menu_xml->read_section('comment', 'email');
									$arrCat['www'][$count]    = $menu_xml->read_section('comment', 'web');
									$arrCat['title'][$count]  = $_title_;
									$arrCat['time'][$count]   = $menu_xml->read_section('comment', 'time');
									
									$menu_xml->flush();
									
									
									if(!$arrCat['tag'][$count])   { $arrCat['tag'][$count]     = '&nbsp;'; }
									if(!$arrCat['uid'][$count])   { $arrCat['uid'][$count]     = '&nbsp;'; }
									if(!$arrCat['name'][$count])  { $arrCat['name'][$count]    = '&nbsp;'; }
									if(!$arrCat['desc'][$count])  { $arrCat['desc'][$count]    = '&nbsp;'; }
									if(!$arrCat['ip'][$count])    { $arrCat['ip'][$count]      = '&nbsp;'; }
									if(!$arrCat['domain'][$count]){ $arrCat['domain'][$count]  = '&nbsp;'; }
									if(!$arrCat['email'][$count]) { $arrCat['email'][$count]   = '&nbsp;'; }
									if(!$arrCat['www'][$count])   { $arrCat['www'][$count]     = '&nbsp;'; }
									if(!$arrCat['title'][$count]) { $arrCat['title'][$count]   = '&nbsp;'; }
									if(!$arrCat['time'][$count])  { $arrCat['time'][$count]    = '&nbsp;'; }
									
									
									$count++;
									$checkCatAmount = $count;
								}
							}
						}
					}
				}
				
				if(is_array($arrCat) && !empty($arrCat) && $arrCat != ''){
					array_multisort(
						$arrCat['tag'], SORT_DESC, 
						$arrCat['title'], SORT_DESC, 
						$arrCat['time'], SORT_DESC, 
						$arrCat['name'], SORT_DESC, 
						$arrCat['desc'], SORT_DESC, 
						$arrCat['www'], SORT_DESC, 
						$arrCat['email'], SORT_DESC, 
						$arrCat['domain'], SORT_DESC, 
						$arrCat['ip'], SORT_DESC, 
						$arrCat['cnt'], SORT_DESC, 
						$arrCat['uid'], SORT_DESC
					);
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			if($action == 'news'){
				$strSQL = "SELECT * "
				."FROM ".$tcms_db_prefix."comments "
				."INNER JOIN ".$tcms_db_prefix."news ON (".$tcms_db_prefix."comments.UID = ".$tcms_db_prefix."news.UID) "
				."WHERE ".$tcms_db_prefix."comments.module = '".$action."' "
				."ORDER BY ".$tcms_db_prefix."comments.timestamp DESC";
			}
			else{
				$strSQL = "SELECT * "
				."FROM ".$tcms_db_prefix."comments "
				."INNER JOIN ".$tcms_db_prefix."imagegallery ON (".$tcms_db_prefix."comments.UID = ".$tcms_db_prefix."imagegallery.UID) "
				."WHERE ".$tcms_db_prefix."comments.module = '".$action."' "
				."ORDER BY ".$tcms_db_prefix."comments.timestamp DESC";
			}
			
			$sqlQR = $sqlAL->sqlQuery($strSQL);
			
			$count = 0;
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$_msg_ = str_replace('<br />', ' - ', $sqlARR['msg']);
				$_msg_ = str_replace('<br/>', ' - ', $_msg_);
				$_msg_ = str_replace('<br>', ' - ', $_msg_);
				$_msg_ = str_replace('<BR />', ' - ', $_msg_);
				$_msg_ = str_replace('<BR/>', ' - ', $_msg_);
				$_msg_ = str_replace('<BR>', ' - ', $_msg_);
				//$_msg_ = str_replace('<a href=', '[a href=', $_msg_);
				//$_msg_ = str_replace('</a>', '[/a]', $_msg_);
				$_msg_ = strip_tags($_msg_);
				
				$arrCat['cnt'][$count]    = $count;
				$arrCat['uid'][$count]    = $sqlARR['uid'];
				$arrCat['name'][$count]   = $sqlARR['name'];
				$arrCat['desc'][$count]   = ( strlen($_msg_) > 150 ? substr($_msg_, 0, 150).' ...' : $_msg_ );
				$arrCat['ip'][$count]     = $sqlARR['ip'];
				$arrCat['domain'][$count] = $sqlARR['domain'];
				$arrCat['email'][$count]  = $sqlARR['email'];
				$arrCat['www'][$count]    = $sqlARR['web'];
				$arrCat['tag'][$count]    = $sqlARR['timestamp'];
				
				if($action == 'news'){
					$arrCat['title'][$count]  = $sqlARR['title'];
				}
				else{
					$arrCat['title'][$count]  = $sqlARR['image'];
					$arrCat['album'][$count]  = $sqlARR['album'];
					
					if($arrCat['album'][$count] == NULL){ $arrCat['album'][$count] = ''; }
				}
				
				if($arrCat['name'][$count]   == NULL){ $arrCat['name'][$count]   = '&nbsp;'; }
				if($arrCat['desc'][$count]   == NULL){ $arrCat['desc'][$count]   = '&nbsp;'; }
				if($arrCat['ip'][$count]     == NULL){ $arrCat['ip'][$count]     = '&nbsp;'; }
				if($arrCat['domain'][$count] == NULL){ $arrCat['domain'][$count] = '&nbsp;'; }
				if($arrCat['email'][$count]  == NULL){ $arrCat['email'][$count]  = '&nbsp;'; }
				if($arrCat['www'][$count]    == NULL){ $arrCat['www'][$count]    = '&nbsp;'; }
				if($arrCat['title'][$count]  == NULL){ $arrCat['title'][$count]  = '&nbsp;'; }
				
				// CHARSETS
				$arrCat['desc'][$count]  = $tcms_main->decodeText($arrCat['desc'][$count], '2', $c_charset);
				$arrCat['title'][$count] = $tcms_main->decodeText($arrCat['title'][$count], '2', $c_charset);
				
				$count++;
				$checkCatAmount = $count;
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
		}
		
		echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
		echo '<tr class="tcms_bg_blue_01">'
			.'<th valign="middle" class="tcms_db_title" width="20%" align="left" colspan="2">'._TABLE_NAME.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="30%" align="left">'._FRONTPAGE_NEWS_TITLE.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="25%" align="left">'._TABLE_EMAIL.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="25%" align="left">'._FRONT_COMMENT_WEB.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._TABLE_IP.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._TABLE_DOMAIN.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="20%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';
		
		if(isset($arrCat) && !empty($arrCat) && $arrCat != ''){
			foreach($arrCat['tag'] as $key => $value){
				if($key >= $minValue && $key < $maxValue){
					$bgkey++;
					if(is_integer($key/2)){ $wsc = 0; }
					else{ $wsc = 1; }
					
					$strJS = ' onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_comments&amp;todo=edit&amp;maintag='.$arrCat['tag'][$key].'&val='.$arrCat['uid'][$key].''.( $action == 'image' ? '&action=image&album='.$arrCat['album'][$key] : '&action=news' ).'\';"';
					
					echo '<tr height="25" id="row'.$key.'" '
					.'bgcolor="'.$arr_color[$wsc].'" '
					.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\'); wxlBgCol(\'row2'.$key.'\',\'#ececec\')" '
					.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\'); wxlBgCol(\'row2'.$key.'\',\''.$arr_color[$wsc].'\');">';
					
					echo '<td style="width: 11px !important;"'.$strJS.'><img border="0" src="../images/comment.gif" /></td>';
					echo '<td'.$strJS.'>'.$arrCat['name'][$key].'</td>';
					
					if($action == 'news'){
						echo '<td'.$strJS.'><a href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=edit&amp;maintag='.$arrCat['uid'][$key].'">'.$arrCat['title'][$key].'</a></td>';
					}
					else{
						echo '<td'.$strJS.'>'.$arrCat['title'][$key].'</td>';
					}
					
					echo '<td'.$strJS.'><a href="mailto:'.$arrCat['email'][$key].'">'.$arrCat['email'][$key].'</a></td>';
					echo '<td'.$strJS.'>'.( trim($arrCat['www'][$key]) != '' ? '<a href="'.$arrCat['www'][$key].'">'.$arrCat['www'][$key].'</a>' : '&nbsp;' ).'</td>';
					echo '<td'.$strJS.'>'.$arrCat['ip'][$key].'&nbsp;</td>';
					echo '<td'.$strJS.'>'.$arrCat['domain'][$key].'&nbsp;</td>';
					
					echo '<td align="right" valign="middle">'
					.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_comments&amp;todo=edit&amp;maintag='.$arrCat['tag'][$key].'&amp;val='.$arrCat['uid'][$key].''.( $action == 'image' ? '&amp;action=image&amp;album='.$arrCat['album'][$key] : '&amp;action=news' ).'">'
					.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
					.'</a>&nbsp;'
					.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_comments&amp;todo=delete&amp;maintag='.$arrCat['tag'][$key].'&amp;val='.$arrCat['uid'][$key].''.( $action == 'image' ? '&amp;action=image&amp;album='.$arrCat['album'][$key] : '&amp;action=news' ).'" onclick="chk=confirm(\''._MSG_DELETE_SUBMIT.'\');return chk;">'
					.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
					.'</a>&nbsp;'
					.'</td>';
					
					echo '</tr>';
					
					echo '<tr height="25" id="row2'.$key.'" '
					.'bgcolor="'.$arr_color[$wsc].'" '
					.'onMouseOver="wxlBgCol(\'row2'.$key.'\',\'#ececec\'); wxlBgCol(\'row'.$key.'\',\'#ececec\');" '
					.'onMouseOut="wxlBgCol(\'row2'.$key.'\',\''.$arr_color[$wsc].'\'); wxlBgCol(\'row'.$key.'\',\''.$arr_color[$wsc].'\');">'
					.'<td colspan="8" class="tcms_db_2"'.$strJS.'>'.$arrCat['desc'][$key].'&nbsp;</td></tr>';
				}
			}
			
			$morePages = count($arrCat['tag']);
		}
		else{ $morePages = 0; }
		
		
		
		echo '<tr class="tcms_bg_blue_01"><td height="18" align="center" class="tcms_db_title tcms_padding_mini" colspan="8"><strong>';
		
		if($minValue > 0 || $maxValue == $morePages){
			echo '<a class="tcms_fm" href="admin.php?id_user='.$id_user.'&amp;site=mod_comments&amp;action='.$action.'">&laquo; '._TABLE_START.'</a>';
		}
		else{ echo '&laquo; '._TABLE_START; }
		
		
		echo '&nbsp;';
		
		
		if($minValue > 0){
			echo '<a class="tcms_fm" href="admin.php?id_user='.$id_user.'&amp;site=mod_comments&amp;action='.$action.'&amp;minValue='.( $minValue - $thisValue ).'&amp;maxValue='.( $maxValue - $thisValue ).'">&#8249; '._TABLE_PREVIOUS.'</a>';
		}
		else{ echo '&#8249; '._TABLE_PREVIOUS; }
		
		
		echo '&nbsp;|&nbsp;';
		
		echo '<a class="tcms_fm" href="admin.php?id_user='.$id_user.'&amp;site=mod_comments&amp;action='.$action.'&amp;minValue=0&amp;maxValue='.$morePages.'">'._NEWS_ALL.'</a>';
		
		echo '&nbsp;|&nbsp;';
		
		
		if($morePages > $maxValue){
			echo '<a class="tcms_fm" href="admin.php?id_user='.$id_user.'&amp;site=mod_comments&amp;action='.$action.'&amp;minValue='.( $minValue + $thisValue ).'&amp;maxValue='.( $maxValue + $thisValue ).'">'._TABLE_NEXT.' &#8250;</a>';
		}
		else{ echo _TABLE_NEXT.' &#8250;'; }
		
		
		echo '&nbsp;';
		
		
		if($morePages > $maxValue){
			if(strlen($morePages) < 3){
				$tmpmorePages = $morePages / 10;
			}
			elseif(strlen($morePages)== 3){
				$tmpmorePages = $morePages / 100;
			}
			$tmpmorePages = round($tmpmorePages);
			$tmpmorePages = ( strlen($tmpmorePages) == 1 ? $tmpmorePages.'0' : $tmpmorePages );
			echo '<a class="tcms_fm" href="admin.php?id_user='.$id_user.'&amp;site=mod_comments&amp;action='.$action.'&amp;minValue='.( $tmpmorePages ).'&amp;maxValue='.( $tmpmorePages + $thisValue ).'">'._TABLE_END.' &raquo;</a>';
		}
		else{ echo _TABLE_END.' &raquo;'; }
		
		echo '</strong></td></tr>';
		
		echo '</table><br />';
	}
	
	
	if($todo != 'edit'){
		echo '</div>';
	}
	
	
	
	
	
	
	
	/*
		edit comment
	*/
	if($todo == 'edit'){
		if($choosenDB == 'xml'){
			if($action == 'news'){
				$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_news/comments_'.$val.'/'.$maintag.'.xml', 'r');
			}
			else{
				$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_imagegallery/'.$album.'/comments_'.$val.'/'.$maintag.'.xml', 'r');
			}
			
			
			$comment_tag    = $val;
			$comment_name   = $menu_xml->read_section('comment', 'name');
			$comment_desc   = $menu_xml->read_section('comment', 'msg');
			$comment_ip     = $menu_xml->read_section('comment', 'ip');
			$comment_domain = $menu_xml->read_section('comment', 'domain');
			$comment_email  = $menu_xml->read_section('comment', 'email');
			$comment_www    = $menu_xml->read_section('comment', 'web');
			$comment_time   = $menu_xml->read_section('comment', 'time');
			
			
			if(!$comment_name)  { $comment_name   = ''; }
			if(!$comment_desc)  { $comment_desc   = ''; }
			if(!$comment_ip)    { $comment_ip     = ''; }
			if(!$comment_domain){ $comment_domain = ''; }
			if(!$comment_email) { $comment_email  = ''; }
			if(!$comment_www)   { $comment_www    = ''; }
			if(!$comment_tag)   { $comment_tag    = ''; }
			if(!$comment_time)  { $comment_time   = ''; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."comments "
			."WHERE module = '".$action."' "
			."AND timestamp = '".$maintag."' "
			."AND uid = '".$val."'";
			
			$sqlQR = $sqlAL->sqlQuery($sqlSTR);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			
			$comment_name   = $sqlARR['name'];
			$comment_desc   = $sqlARR['msg'];
			$comment_ip     = $sqlARR['ip'];
			$comment_domain = $sqlARR['domain'];
			$comment_email  = $sqlARR['email'];
			$comment_www    = $sqlARR['web'];
			$comment_time   = $sqlARR['time'];
			$comment_tag    = $sqlARR['timestamp'];
			
			
			if($comment_name   == NULL){ $comment_name   = ''; }
			if($comment_desc   == NULL){ $comment_desc   = ''; }
			if($comment_ip     == NULL){ $comment_ip     = ''; }
			if($comment_domain == NULL){ $comment_domain = ''; }
			if($comment_email  == NULL){ $comment_email  = ''; }
			if($comment_www    == NULL){ $comment_www    = ''; }
			if($comment_time   == NULL){ $comment_time   = ''; }
		}
		
		$comment_desc = $tcms_main->decodeText($comment_desc, '2', $c_charset);
		
		
		$comment_desc = ereg_replace('<br />'.chr(10), chr(13), $comment_desc);
		$comment_desc = ereg_replace('<br />'.chr(13), chr(13), $comment_desc);
		$comment_desc = ereg_replace('<br />', chr(13), $comment_desc);
		
		$comment_desc = ereg_replace('<br/>'.chr(10), chr(13), $comment_desc);
		$comment_desc = ereg_replace('<br/>'.chr(13), chr(13), $comment_desc);
		$comment_desc = ereg_replace('<br/>', chr(13), $comment_desc);
		
		$comment_desc = ereg_replace('<br>'.chr(10), chr(13), $comment_desc);
		$comment_desc = ereg_replace('<br>'.chr(13), chr(13), $comment_desc);
		$comment_desc = ereg_replace('<br>', chr(13), $comment_desc);
		
		
		echo $tcms_html->bold(_TABLE_EDIT).'<br />';
		
		
		// form begin
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_comments" method="post">'
		.'<input name="maintag" type="hidden" value="'.$maintag.'" />'
		.'<input name="val" type="hidden" value="'.$val.'" />'
		.'<input name="todo" type="hidden" value="save" />'
		.'<input name="new_comment_time" type="hidden" value="'.$comment_time.'" />'
		.'<input name="action" type="hidden" value="'.$action.'" />';
		
		
		if($action == 'image'){
			echo '<input name="album" type="hidden" value="'.$album.'" />';
		}
		
		
		// details
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="noborder"><tr class="tcms_bg_blue_01">'
		.'<th valign="top" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>'
		.'</tr></table>';
		
		
		// head
		echo '<table width="100%" cellpadding="1" cellspacing="5" class="tcms_table">';
		
		
		// name
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_NAME.'</strong></td>'
		.'<td><input class="tcms_input_normal" name="new_comment_name" type="text" value="'.$comment_name.'" /></td></tr>';
		
		
		// desc
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._FRONT_COMMENT_TEXT.'</strong></td>'
		.'<td valign="top"><textarea class="tcms_textarea_big" name="new_comment_desc">'.$comment_desc.'</textarea></td></tr>';
		
		
		// published
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_EMAIL.'</strong></td>'
		.'<td><input class="tcms_input_normal" name="new_comment_email" type="text" value="'.$comment_email.'" /></td></tr>';
		
		
		// published
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._FRONT_COMMENT_WEB.'</strong></td>'
		.'<td><input class="tcms_input_normal" name="new_comment_www" type="text" value="'.$comment_www.'" /></td></tr>';
		
		
		// link to
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_IP.'</strong></td>'
		.'<td><input class="tcms_input_normal" name="new_comment_ip" type="text" value="'.$comment_ip.'" /></td></tr>';
		
		
		// pos
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_DOMAIN.'</strong></td>'
		.'<td><input class="tcms_input_normal" name="new_comment_domain" type="text" value="'.$comment_domain.'" /></td></tr>';
		
		
		// table end
		echo '</table></form>';
	}
	
	
	
	
	
	
	
	/*
		save edited comment
	*/
	if($todo == 'save'){
		if($new_comment_desc   == '' || !isset($new_comment_desc))  { $new_comment_desc   = ''; }
		if($new_comment_email  == '' || !isset($new_comment_email)) { $new_comment_email  = ''; }
		if($new_comment_www    == '' || !isset($new_comment_www))   { $new_comment_www    = ''; }
		if($new_comment_name   == '' || !isset($new_comment_name))  { $new_comment_name   = ''; }
		if($new_comment_ip     == '' || !isset($new_comment_ip))    { $new_comment_ip     = '127.0.0.1'; }
		if($new_comment_domain == '' || !isset($new_comment_domain)){ $new_comment_domain = 'localhost'; }
		if($new_comment_time   == '' || !isset($new_comment_time))  { $new_comment_time   = date('YmdHis'); }
		
		
		$new_comment_desc = $tcms_main->convertNewlineToHTML($new_comment_desc);
		
		
		// CHARSETS
		$new_comment_desc = $tcms_main->encodeText($new_comment_desc, '2', $c_charset);
		
		
		if($choosenDB == 'xml') {
			if($action == 'news') {
				$xmluser = new xmlparser(_TCMS_PATH.'/tcms_news/comments_'.$val.'/'.$maintag.'.xml', 'w');
			}
			else{
				$xmluser = new xmlparser(_TCMS_PATH.'/tcms_imagegallery/'.$album.'/comments_'.$val.'/'.$maintag.'.xml', 'w');
			}
			
			$xmluser->xml_declaration();
			$xmluser->xml_section('comment');
			
			$xmluser->write_value('name', $new_comment_name);
			$xmluser->write_value('email', $new_comment_email);
			$xmluser->write_value('web', $new_comment_www);
			$xmluser->write_value('msg', $new_comment_desc);
			$xmluser->write_value('time', $new_comment_time);
			$xmluser->write_value('ip', $new_comment_ip);
			$xmluser->write_value('domain', $new_comment_domain);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('comment');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			
			$newSQLData = ''
			.$tcms_db_prefix.'comments.name="'.$new_comment_name.'", '
			.$tcms_db_prefix.'comments.email="'.$new_comment_email.'", '
			.$tcms_db_prefix.'comments.web="'.$new_comment_www.'", '
			.$tcms_db_prefix.'comments.msg="'.$new_comment_desc.'", '
			.$tcms_db_prefix.'comments.time="'.$new_comment_time.'", '
			.$tcms_db_prefix.'comments.ip="'.$new_comment_ip.'", '
			.$tcms_db_prefix.'comments.domain="'.$new_comment_domain.'"';
			
			
			if($choosenDB == 'pgsql'){
				$newSQLData = str_replace('"', "'", $newSQLData);
				$newSQLData = str_replace($tcms_db_prefix.'comments.', '"', $newSQLData);
				$newSQLData = str_replace('=', '"=', $newSQLData);
				
				$newSQLStr = "UPDATE ".$tcms_db_prefix."comments SET ".$newSQLData." WHERE module = '".$action."' AND uid = '".$val."' AND timestamp = '".$maintag."'";
			}
			else{
				$newSQLStr = 'UPDATE '.$tcms_db_prefix.'comments SET '.$newSQLData.' WHERE module = "'.$action.'" AND uid = "'.$val.'" AND timestamp = "'.$maintag.'"';
			}
			
			
			$sqlQR = $sqlAL->sqlQuery($newSQLStr);
		}
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_comments&action='.$action.'\'</script>';
	}
	
	
	
	
	
	
	
	/*
		delete comment
	*/
	if($todo == 'delete'){
		if($choosenDB == 'xml'){
			if($action == 'news'){
				unlink(_TCMS_PATH.'/tcms_news/comments_'.$val.'/'.$maintag.'.xml');
			}
			elseif($action == 'image'){
				unlink(_TCMS_PATH.'/tcms_imagegallery/'.$album.'/comments_'.$val.'/'.$maintag.'.xml');
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strSQL = "DELETE FROM ".$tcms_db_prefix."comments WHERE module='".$action."' AND uid = '".$val."' AND timestamp = '".$maintag."'";
			
			$sqlAL->sqlQuery($strSQL);
		}
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_comments\';</script>';
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
