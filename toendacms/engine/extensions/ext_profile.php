<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| User Profile Module
|
| File:	ext_profile.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * User Profile Module
 *
 * This module is used as a base module fpr user operations.
 *
 * @version 1.0.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


if(isset($_GET['todo'])){ $todo = $_GET['todo']; }
if(isset($_GET['u'])){ $u = $_GET['u']; }

if(isset($_POST['todo'])){ $todo = $_POST['todo']; }
if(isset($_POST['u'])){ $u = $_POST['u']; }
if(isset($_POST['maintag'])){ $maintag = $_POST['maintag']; }
if(isset($_POST['new_news_publishing_date'])){ $new_news_publishing_date = $_POST['new_news_publishing_date']; }
if(isset($_POST['new_news_title'])){ $new_news_title = $_POST['new_news_title']; }
if(isset($_POST['new_news_autor'])){ $new_news_autor = $_POST['new_news_autor']; }
if(isset($_POST['new_news_date'])){ $new_news_date = $_POST['new_news_date']; }
if(isset($_POST['new_news_time'])){ $new_news_time = $_POST['new_news_time']; }
if(isset($_POST['new_news_published'])){ $new_news_published = $_POST['new_news_published']; }
if(isset($_POST['new_news_content'])){ $new_news_content = $_POST['new_news_content']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }
if(isset($_POST['your_password'])){ $your_password = $_POST['your_password']; }
if(isset($_POST['your_group'])){ $your_group = $_POST['your_group']; }
if(isset($_POST['your_joindate'])){ $your_joindate = $_POST['your_joindate']; }
if(isset($_POST['your_enabled'])){ $your_enabled = $_POST['your_enabled']; }
if(isset($_POST['new_name'])){ $new_name = $_POST['new_name']; }
if(isset($_POST['new_username'])){ $new_username = $_POST['new_username']; }
if(isset($_POST['new_email'])){ $new_email = $_POST['new_email']; }
if(isset($_POST['new_password'])){ $new_password = $_POST['new_password']; }
if(isset($_POST['new_pass'])){ $new_pass = $_POST['new_pass']; }
if(isset($_POST['news_news_access'])){ $news_news_access = $_POST['news_news_access']; }
if(isset($_POST['new_www'])){ $new_www = $_POST['new_www']; }
if(isset($_POST['new_icq'])){ $new_icq = $_POST['new_icq']; }
if(isset($_POST['new_aim'])){ $new_aim = $_POST['new_aim']; }
if(isset($_POST['new_yim'])){ $new_yim = $_POST['new_yim']; }
if(isset($_POST['new_msn'])){ $new_msn = $_POST['new_msn']; }
if(isset($_POST['new_skype'])){ $new_skype = $_POST['new_skype']; }
if(isset($_POST['new_day'])){ $new_day = $_POST['new_day']; }
if(isset($_POST['new_month'])){ $new_month = $_POST['new_month']; }
if(isset($_POST['new_year'])){ $new_year = $_POST['new_year']; }
if(isset($_POST['new_lastlogin'])){ $new_lastlogin = $_POST['new_lastlogin']; }
if(isset($_POST['new_sex'])){ $new_sex = $_POST['new_sex']; }
if(isset($_POST['new_occ'])){ $new_occ = $_POST['new_occ']; }
if(isset($_POST['new_tcms'])){ $new_tcms = $_POST['new_tcms']; }
if(isset($_POST['new_signature'])){ $new_signature = $_POST['new_signature']; }
if(isset($_POST['new_location'])){ $new_location = $_POST['new_location']; }
if(isset($_POST['new_hobby'])){ $new_hobby = $_POST['new_hobby']; }
if(isset($_POST['pubTimecode'])){ $pubTimecode = $_POST['pubTimecode']; }
if(isset($_POST['pubAlbum'])){ $pubAlbum = $_POST['pubAlbum']; }
if(isset($_POST['pubFile'])){ $pubFile = $_POST['pubFile']; }
if(isset($_POST['pubDesc'])){ $pubDesc = $_POST['pubDesc']; }
if(isset($_POST['pubLished'])){ $pubLished = $_POST['pubLished']; }
if(isset($_POST['new_cat'])){ $new_cat = $_POST['new_cat']; }
if(isset($_POST['new_static'])){ $new_static = $_POST['new_static']; }
if(isset($_POST['new_comments_enabled'])){ $new_comments_enabled = $_POST['new_comments_enabled']; }
if(isset($_POST['mediaImage'])){ $mediaImage = $_POST['mediaImage']; }
if(isset($_POST['saveMedia'])){ $saveMedia = $_POST['saveMedia']; }
if(isset($_POST['submitMedia'])){ $submitMedia = $_POST['submitMedia']; }




/*
	init
*/

if(!isset($todo)){ $todo = 'show'; }

using('toendacms.datacontainer.account');




/*
	values
*/

if($choosenDB == 'xml') {
	if(file_exists($tcms_administer_site.'/tcms_user/'.$ws_id.'.xml')){ $checkUserExists = true; }
	else{ $checkUserExists = false; }
}
else{
	$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
	$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$sqlQR = $sqlAL->getOne($tcms_db_prefix.'user', $ws_id);
	$user_exists = $sqlAL->getNumber($sqlQR);
	
	if($user_exists != 0){ $checkUserExists = true; }
	else{ $checkUserExists = false; }
}

if($checkUserExists) {
	if($choosenDB == 'xml'){
		$mtu_xml = new xmlparser($tcms_administer_site.'/tcms_global/sidebar.xml','r');
		$menu_title_user = $mtu_xml->readSection('side', 'usermenu_title');
		
		$xmlSet = new xmlparser($tcms_administer_site.'/tcms_global/userpage.xml','r');
		$npo = $xmlSet->readSection('userpage', 'news_publish');
		$ipo = $xmlSet->readSection('userpage', 'image_publish');
		$apo = $xmlSet->readSection('userpage', 'album_publish');
		$cpo = $xmlSet->readSection('userpage', 'cat_publish');
		$ppo = $xmlSet->readSection('userpage', 'pic_publish');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getOne($tcms_db_prefix.'userpage', 'userpage');
		$sqlObj = $sqlAL->fetchObject($sqlQR);
		
		$npo = $sqlObj->news_publish;
		$ipo = $sqlObj->image_publish;
		$apo = $sqlObj->album_publish;
		$cpo = $sqlObj->cat_publish;
		$ppo = $sqlObj->pic_publish;
	}
	
	
	
	
	
	// -----------------------------------
	// PUBLISH NEWS
	// -----------------------------------
	
	if($tcms_main->isReal($todo) 
	&& $todo == 'submitNews' 
	&& $npo == 1) {		
		if($is_admin == 'Administrator' 
		|| $is_admin == 'Developer' 
		|| $is_admin == 'Writer' 
		|| $is_admin == 'Editor') {
			$show_wysiwyg = $tcms_config->getWYSIWYGEditor();
			
			
			echo '<!-- jsCalendar -->'
			.'<script language="JavaScript" src="'.$imagePath.'engine/js/jscalendar/calendar.js"></script>'
			.'<script language="Javascript" src="'.$imagePath.'engine/js/jscalendar/lang/calendar-en.js"></script>'
			.'<script language="Javascript" src="'.$imagePath.'engine/js/jscalendar/calendar-setup.js"></script>'
			.'<link rel="stylesheet" type="text/css" href="'.$imagePath.'engine/js/jscalendar/calendar-toendaCMS.css" title="toendaCMS" />'
			.'<!-- /jsCalendar -->';
			
			if($show_wysiwyg == 'tinymce'){
				include('engine/tcms_kernel/tcms_tinyMCE.lib.php');
				
				$tcms_tinyMCE = new tcms_tinyMCE($seoFolder, $seoEnabled);
				$tcms_tinyMCE->initTinyMCE(false);
				
				unset($tcms_tinyMCE);
			}
			
			
			echo $tcms_html->contentTitle(_LOGIN_SUBMIT_NEWS);
			echo '<br />';
			
			
			if($choosenDB == 'xml'){
				$userp_xml = new xmlparser($tcms_administer_site.'/tcms_global/userpage.xml','r');
				$width  = $userp_xml->readSection('userpage', 'text_width');
				$width2 = $userp_xml->readSection('userpage', 'input_width');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'userpage', 'userpage');
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				
				$width  = $sqlObj->text_width;
				$width2 = $sqlObj->input_width;
			}
			
			
			if($choosenDB == 'xml'){
				$con_xml = new xmlparser($tcms_administer_site.'/tcms_user/'.$ws_id.'.xml','r');
				$tu_name     = $con_xml->readSection('user', 'name');
				$tu_username = $con_xml->readSection('user', 'username');
				
				$tu_name     = $tcms_main->decodeText($tu_name, '2', $c_charset);
				$tu_username = $tcms_main->decodeText($tu_username, '2', $c_charset);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'user', $ws_id);
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				
				$tu_name      = $sqlObj->name;
				$tu_username  = $sqlObj->username;
				
				$tu_name     = $tcms_main->decodeText($tu_name, '2', $c_charset);
				$tu_username = $tcms_main->decodeText($tu_username, '2', $c_charset);
				
				if($tu_name      == NULL){ $tu_name      = ''; }
				if($tu_username  == NULL){ $tu_username  = ''; }
			}
			
			$maintag = $tcms_main->getNewUID(10, 'news');
			
			
			
			/*
				new categories
			*/
			
			if($choosenDB == 'xml'){
				$arrCatFiles = $tcms_main->getPathContent($tcms_administer_site.'/tcms_news_categories/');
				
				if($tcms_main->isArray($arrCatFiles)){
					foreach($arrCatFiles as $key => $value){
						$menu_xml = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$value,'r');
						$arrNewsCat['tag'][$key]  = substr($value, 0, 5);
						$arrNewsCat['name'][$key] = $menu_xml->readSection('cat', 'name');
						$arrNewsCat['desc'][$key] = $menu_xml->readSection('cat', 'desc');
						
						if(!$arrNewsCat['name'][$key]){ $arrNewsCat['name'][$key] = ''; }
						if(!$arrNewsCat['desc'][$key]){ $arrNewsCat['desc'][$key] = ''; }
						
						// CHARSETS
						$arrNewsCat['name'][$key] = $tcms_main->decodeText($arrNewsCat['name'][$key], '2', $c_charset);
						$arrNewsCat['desc'][$key] = $tcms_main->decodeText($arrNewsCat['desc'][$key], '2', $c_charset);
					}
				}
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getAll($tcms_db_prefix.'news_categories');
				
				$key = 0;
				
				while($sqlObj = $sqlAL->fetchObject($sqlQR)){
					$arrNewsCat['tag'][$key]  = $sqlObj->uid;
					$arrNewsCat['name'][$key] = $sqlObj->name;
					$arrNewsCat['desc'][$key] = $sqlObj->desc;
					
					if($arrNewsCat['name'][$key] == NULL){ $arrNewsCat['name'][$key] = ''; }
					if($arrNewsCat['desc'][$key] == NULL){ $arrNewsCat['desc'][$key] = ''; }
					
					// CHARSETS
					$arrNewsCat['name'][$key] = $tcms_main->decodeText($arrNewsCat['name'][$key], '2', $c_charset);
					$arrNewsCat['desc'][$key] = $tcms_main->decodeText($arrNewsCat['desc'][$key], '2', $c_charset);
					
					$key++;
				}
			}
			
			
			
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			
			// form
			echo '<form action="'.$link.'" method="post" id="news">'
			.'<input name="todo" type="hidden" value="saveNews" />'
			.'<input name="maintag" type="hidden" value="'.$maintag.'" />'
			.'<input name="new_news_publishing_date" type="hidden" value="'.date('d.m.Y-H:i').'" />';
			
			
			// table head
			echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
			
			
			// row
			echo '<tr style="height: 28px;">'
			.'<td valign="top" width="'.$width.'"><span class="text_normal">'._TABLE_TITLE.'</span></td>'
			.'<td valign="top"><input class="inputtext" style="width: '.$width2.'px;" name="new_news_title" type="text" value="" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr style="height: 28px;">'
			.'<td valign="top" width="'.$width.'"><span class="text_normal">'._TABLE_AUTOR.'</span></td>'
			.'<td valign="top">'
			.'<select class="tcms_select" name="new_news_autor" style="width: '.$width2.'px;">'
				.'<option value="'.$tu_name.'">'.$tu_name.'</option>'
				.'<option value="'.$tu_username.'">'.$tu_username.'</option>'
			.'</select>'
			.'</td></tr>';
			
			
			// row
			$_date_ = date('d.m.Y');
			
			echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'"><span class="text_normal">'._NEWS_DATE.'</span></td>'
			.'<td valign="top">'
			.'<input class="inputtext" style="width: '.$width2.'px;" id="new_news_date" name="new_news_date" type="text" value="'.$_date_.'" />'
			.'<input class="inputtext" type="button" value="&nbsp;" style="width: 22px; height: 16px; background: transparent url('.$imagePath.'engine/js/jscalendar/img.gif) no-repeat;" id="triggerButtonDate" />'
			.'</td></tr>';
			
			echo '<script type="text/javascript">
				Calendar.setup({
			        inputField     :    "new_news_date",
			        ifFormat       :    "%d.%m.%Y",
			        showsTime      :    false,
			        button         :    "triggerButtonDate",
			        singleClick    :    false,
			        step           :    1
			    });
			</script>';
			
			
			// row
			$_time_ = date('H:i');
			
			echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'">'
			.'<span class="text_normal">'._NEWS_TIME.'</span>'
			.'</td><td valign="top">'
			.'<input class="inputtext" style="width: '.$width2.'px;" name="new_news_time" type="text" value="'.$_time_.'" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'">'
			.'<span class="text_normal">'._TABLE_PUBLISHED.'</span>'
			.'</td><td valign="top">'
			.'<input name="new_news_published" value="1" type="checkbox" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'">'
			.'<span class="text_normal">'._TABLE_COMMENTS.'</span>'
			.'</td><td valign="top">'
			.'<input name="new_comments_enabled" value="1" type="checkbox" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'">'
			.'<span class="text_normal">'._TABLE_ACCESS.'</span>'
			.'</td><td valign="top">'
			.'<select name="news_news_access" class="tcms_select">'
			.'<option value="Public">'._TABLE_PUBLIC.'</option>'
			.'<option value="Protected">'._TABLE_PROTECTED.'</option>'
			.'<option value="Private">'._TABLE_PRIVATE.'</option>'
			.'</select></td></tr>';
			
			
			// row
			echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'" colspan="2">'
			.'<fieldset><legend><strong class="tcms_bold">'._TABLE_CATEGORY.'</strong></legend>';
				foreach($arrNewsCat['tag'] as $Ckey => $Cvalue){
					echo '<div style="margin: 0; padding: 0 0 4px 0;">'
					.'<label for="new_cat_'.$Ckey.'">'
					.'<input type="checkbox" style="margin: 0 0 -3px 0 !important;" id="new_cat_'.$Ckey.'" name="new_cat_'.$Ckey.'" value="'.$Cvalue.'"'.( $defaultCat == $Cvalue ? ' checked="checked"' : '' ).' />'
					.'&nbsp;'.$arrNewsCat['name'][$Ckey]
					.'</label>'
					.'</div>';
					
					$catAmount = $Ckey;
				}
			echo '</fieldset>'
			.'<input name="catAmount" type="hidden" value="'.$catAmount.'" /><br />'
			.'</td></tr>';
			
			
			// table end
			echo '</table>';
			
			
			// new table
			echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
			
			
			// row
			echo '<tr><td valign="top">';
			//.'<script>createToendaToolbar(\'news\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \''.$imagePath.'browse.php?session='.$session.'\', \'\');</script>';
			
			if($show_wysiwyg == 'tinymce'){
			}
			elseif($show_wysiwyg == 'fckeditor'){
				echo ''._TCMSSCRIPT_MORE.': {tcms_more}';
			}
			else{
				if($show_wysiwyg == 'toendaScript'){
					echo '<script>createToolbar(\'news\', \''.$tcms_lang.'\', \'toendaScript\');</script>';
				}
				else{
					echo '<script>createToolbar(\'news\', \''.$tcms_lang.'\', \'HTML\');</script>';
				}
			}
			
			echo '<br /><br />';
			
			if($show_wysiwyg == 'tinymce'){
				echo '<textarea class="newsSubmit" id="content" name="content" mce_editable="true"></textarea>';
			}
			elseif($show_wysiwyg == 'fckeditor'){
				if($seoEnabled == 1)
					$sBasePath = ( $seoFolder == '' ? '' : $seoFolder.'/' ).'engine/js/FCKeditor/';
				else
					$sBasePath = 'engine/js/FCKeditor/';
				
				$oFCKeditor = new FCKeditor('content') ;
				
				$oFCKeditor->BasePath = $sBasePath;
				$oFCKeditor->Value = '';
				$oFCKeditor->ToolbarSet = 'Basic';
				
				$oFCKeditor->Create();
			}
			else{
				echo '<textarea class="newsSubmit" id="content" name="content"></textarea>';
			}
			
			echo '</td></tr>';
			
			echo '</table>';
			
			if($show_wysiwyg == 'tinymce'){
				echo '<br /><input type="submit" class="inputbutton" onclick="javascript:tinyMCE.triggerSave();tinyMCE.updateContent(\'content\');" value="'._TCMS_ADMIN_SAVE.'" />';
			}
			elseif($show_wysiwyg == 'fckeditor'){
				echo '<br /><input type="submit" class="inputbutton" onclick="javascript:save();" value="'._TCMS_ADMIN_SAVE.'" />';
			}
			else{
				echo '<br /><input type="submit" class="inputbutton" onclick="javascript:save();" value="'._TCMS_ADMIN_SAVE.'" />';
			}
				
			
			echo '</form>';
		}
	}
	
	
	
	
	
	// -----------------------------------
	// UPLOAD IMAGES
	// -----------------------------------
	
	if(!$param_save_mode) {
		if($tcms_main->isReal($todo) 
		&& $todo == 'submitImages' 
		&& $ipo == 1) {
			if($is_admin == 'Administrator' 
			|| $is_admin == 'Developer' 
			|| $is_admin == 'Writer' 
			|| $is_admin == 'Editor') {
				$show_wysiwyg = $tcms_config->getWYSIWYGEditor();
				
				if($choosenDB == 'xml'){
					$userp_xml = new xmlparser($tcms_administer_site.'/tcms_global/userpage.xml','r');
					$width  = $userp_xml->readSection('userpage', 'text_width');
					$width2 = $userp_xml->readSection('userpage', 'input_width');
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->getOne($tcms_db_prefix.'userpage', 'userpage');
					$sqlObj = $sqlAL->fetchObject($sqlQR);
					
					$width  = $sqlObj->text_width;
					$width2 = $sqlObj->input_width;
				}
				
				echo $tcms_html->contentTitle(_LOGIN_SUBMIT_IMAGES);
				echo '<br />';
				
				$link = '?session='.$session.'&amp;id=profile&amp;s='.$s
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '<form action="'.$link.'" method="post" enctype="multipart/form-data">'
				.'<input name="todo" type="hidden" value="saveImage" />'
				.'<input name="pubTimecode" type="hidden" value="'.date('YmdHis').'" />';
				
				
				echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
				
				
				
				echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'">
					<span class="text_normal">'._TABLE_ALBUM.'</span>
				</td><td valign="top">';
					echo '<select name="pubAlbum">';
					
					if($choosenDB == 'xml'){
						$arrAlbums = $tcms_main->getPathContent($tcms_administer_site.'/tcms_albums/');
						
						if($arrAlbums){
							foreach($arrAlbums as $key => $val){
								$xmlAlbums = new xmlparser($tcms_administer_site.'/tcms_albums/'.$val, 'r');
								$arrAlbum['title'][$key] = $xmlAlbums->readSection('album', 'title');
								$arrAlbum['path'][$key]  = $xmlAlbums->readSection('album', 'path');
								
								$arrAlbum['title'][$key] = $tcms_main->decodeText($arrAlbum['title'][$key], '2', $c_charset);
								
								echo '<option value="'.$arrAlbum['path'][$key].'">'.$arrAlbum['title'][$key].'</option>';
							}
						}
					}
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->getAll($tcms_db_prefix.'albums WHERE published=1');
						
						$count = 0;
						
						while($sqlObj = $sqlAL->fetchObject($sqlQR)){
							$arrAlbum['count'][$count] = $sqlObj->uid;
							$arrAlbum['title'][$count] = $sqlObj->title;
							$arrAlbum['path'][$count]  = $sqlObj->album_id;
							
							if($arrAlbum['title'][$count] == NULL){ $arrAlbum['title'][$count] = ''; }
							if($arrAlbum['path'][$count]  == NULL){ $arrAlbum['path'][$count]  = ''; }
							
							// CHARSETS
							$arrAlbum['title'][$count] = $tcms_main->decodeText($arrAlbum['title'][$count], '2', $c_charset);
							
							echo '<option value="'.$arrAlbum['path'][$count].'">'.$arrAlbum['title'][$count].'</option>';
							
							$count++;
							$checkCatAmount = $count;
						}
						
						$sqlAL->freeResult($sqlQR);
					}
					
					echo '</select>';
				echo '</td></tr>';
				
				
				// row
				echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'">'
				.'<span class="text_normal">'._TABLE_IMAGE.'</span>'
				.'</td><td valign="top">'
				.'<input type="file" name="pubFile" accept="image/*" />'
				.'</td></tr>';
				
				
				// row
				echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'" colspan="2">'
				.'<span class="text_normal">'._TABLE_DESCRIPTION.'</span>'
				.'<br />'
				.'<textarea class="inputtextarea" name="pubDesc"></textarea>'
				.'</td></tr>';
				
				
				echo '</table>';
				
				
				echo '<br /><br /><input type="submit" class="inputbutton" value="'._TCMS_ADMIN_SAVE.'" />';
				
				
				echo '</form>';
			}
		}
	}
	else{
		echo '<strong>'._MSG_PHP_SAFE_MODE_SETTINGS.'</strong>';
	}
	
	
	
	
	
	// -----------------------------------
	// CREATE ALBUM
	// -----------------------------------
	
	if($tcms_main->isReal($todo) 
	&& $todo == 'createAlbum' 
	&& $apo == 1) {
		if($is_admin == 'Administrator' 
		|| $is_admin == 'Developer' 
		|| $is_admin == 'Writer' 
		|| $is_admin == 'Editor') {
			$show_wysiwyg = $tcms_config->getWYSIWYGEditor();
			
			if($choosenDB == 'xml'){
				$userp_xml = new xmlparser($tcms_administer_site.'/tcms_global/userpage.xml','r');
				$width  = $userp_xml->readSection('userpage', 'text_width');
				$width2 = $userp_xml->readSection('userpage', 'input_width');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'userpage', 'userpage');
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				
				$width  = $sqlObj->text_width;
				$width2 = $sqlObj->input_width;
			}
			
			
			echo $tcms_html->contentTitle(_LOGIN_CREATE_ALBUM);
			echo '<br />';
			
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<form action="'.$link.'" method="post">'
			.'<input name="todo" type="hidden" value="saveAlbum" />'
			.'<input name="maintag" type="hidden" value="'.$tcms_main->getNewUID(6, 'albums').'" />';
			
			
			// table head
			echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
			
			
			// row
			echo '<tr style="height: 28px;">'
			.'<td valign="top" width="'.$width.'">'
			.'<span class="text_normal">'._GALLERY_NEW.'</span>'
			.'<br />'
			.'<input name="pubAlbum" class="inputtext" type="text" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr style="height: 28px;">'
			.'<td valign="top" width="'.$width.'">'
			.'<br />'
			.'<input name="pubLished" value="1" type="checkbox" />&nbsp;'
			.'<span class="text_normal">'._TABLE_PUBLISHED.'</span>'
			.'</td></tr>';
			
			
			// row
			echo '<tr style="height: 28px;">'
			.'<td valign="top">'
			.'<br />'
			.'<span class="text_normal">'._GALLERY_DESCRIPTION.'</span>'
			.'<br />'
			.'<textarea class="inputtextarea" name="pubDesc"></textarea>'
			.'</td></tr>';
			
			
			
			echo '</table>';
			
			
			echo '<br /><br />'
			.'<input type="submit" class="inputbutton" value="'._TCMS_ADMIN_SAVE.'" />';
			
			
			echo '</form>';
		}
	}
	
	
	
	
	
	// -----------------------------------
	// CREATE CATEGORY
	// -----------------------------------
	
	if($tcms_main->isReal($todo) 
	&& $todo == 'createCat' 
	&& $cpo == 1) {
		if($is_admin == 'Administrator' 
		|| $is_admin == 'Developer' 
		|| $is_admin == 'Writer' 
		|| $is_admin == 'Editor') {
			if($choosenDB == 'xml'){
				$userp_xml = new xmlparser($tcms_administer_site.'/tcms_global/userpage.xml','r');
				$width  = $userp_xml->readSection('userpage', 'text_width');
				$width2 = $userp_xml->readSection('userpage', 'input_width');
				
				//while(($maintag=substr(md5(time()),0,5)) && file_exists($tcms_administer_site.'/tcms_news_categories/'.$maintag.'.xml')){}
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'userpage', 'userpage');
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$width  = $sqlARR['text_width'];
				$width2 = $sqlARR['input_width'];
				
				//$n2c_maintag = $tcms_main->create_uid($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'news_categories', 5);
			}
			
			
			$maintag = $tcms_main->getNewUID(5, 'news_categories');
			
			
			echo $tcms_html->contentTitle(_LOGIN_CREATE_CATEGORY);
			echo '<br />';
			
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			
			// form
			echo '<form action="'.$link.'" method="post">'
			.'<input name="todo" type="hidden" value="saveCat" />'
			.'<input name="maintag" type="hidden" value="'.$maintag.'" />';
			
			
			// table head
			echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
			
			
			// row
			echo '<tr style="height: 28px;">'
			.'<td valign="top" width="'.$width.'">'
			.'<span class="text_normal">'._TABLE_NAME.'</span>'
			.'<br />'
			.'<input name="new_cat" class="inputtext" type="text" />'
			.'</td></tr>';
			
			
			//row
			echo '<tr style="height: 28px;">'
			.'<td valign="top">'
			.'<span class="text_normal">'._TABLE_DESCRIPTION.'</span>'
			.'<br />'
			.'<textarea class="inputtextarea" name="pubDesc"></textarea>'
			.'</td></tr>';
			
			
			// table end
			echo '</table>';
			
			
			echo '<br /><br />'
			.'<input type="submit" class="inputbutton" value="'._TCMS_ADMIN_SAVE.'" />';
			
			
			echo '</form>';
		}
	}
	
	
	
	
	
	// -----------------------------------
	// UPLOAD MEDIA
	// -----------------------------------
	
	if($tcms_main->isReal($todo) 
	&& $todo == 'submitMedia' 
	&& $ppo == 1) {
		if($is_admin == 'Administrator' 
		|| $is_admin == 'Developer' 
		|| $is_admin == 'Writer' 
		|| $is_admin == 'Editor') {
			if($choosenDB == 'xml'){
				$userp_xml = new xmlparser($tcms_administer_site.'/tcms_global/userpage.xml','r');
				$width  = $userp_xml->readSection('userpage', 'text_width');
				$width2 = $userp_xml->readSection('userpage', 'input_width');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'userpage', 'userpage');
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$width  = $sqlARR['text_width'];
				$width2 = $sqlARR['input_width'];
			}
			
			
			
			echo $tcms_html->contentTitle(_LOGIN_SUBMIT_MEDIA);
			echo '<br />';
			
			
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<form name="upload" id="upload" action="'.$link.'" method="post" enctype="multipart/form-data">'
			.'<input name="todo" type="hidden" value="saveMedia" />';
			
			
			echo $tcms_html->tableHeadNoBorder('0', '0', '0', '100%');
			
			
			echo '<tr style="height: 28px;"><td valign="top" width="'.$width.'"><span class="text_normal">'._TABLE_IMAGE.'</span></td>'
			.'<td valign="top"><input name="mediaImage" type="file" accept="image/*" /></td></tr>';
			
			
			// table end
			echo '</table>';
			
			echo '<br /><br /><input type="submit" class="inputbutton" value="'._TCMS_ADMIN_SAVE.'" />';
			
			echo '</form><br /><br />';
		}
	}
}




/*
	save values
*/

if($is_admin == 'Administrator' 
|| $is_admin == 'Developer' 
|| $is_admin == 'Writer' 
|| $is_admin == 'Editor') {
	if($todo == 'saveNews') {
		if($new_news_published   == '' || empty($new_news_published)   || !isset($new_news_published))  { $new_news_published   = 0; }
		if($new_comments_enabled == '' || empty($new_comments_enabled) || !isset($new_comments_enabled)){ $new_comments_enabled = 0; }
		
		
		if($choosenDB == 'xml'){
			$myCat = '';
			$i = 0;
			
			while($i <= $_POST['catAmount']){
				if(!empty($_POST['new_cat_'.$i]) && isset($_POST['new_cat_'.$i])){
					$myCat .= $_POST['new_cat_'.$i].'{###}';
				}
				
				$i++;
			}
			
			$new_cat = $myCat;
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`news_uid`, `cat_uid`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'news_uid, cat_uid';
					break;
				
				case 'mssql':
					$newSQLColumns = '[news_uid], [cat_uid]';
					break;
			}
			
			
			for($i = 0; $i <= count($arrNewsCat['tag']); $i++){
				if(!empty($_POST['new_cat_'.$i]) && isset($_POST['new_cat_'.$i])){
					//$n2c_maintag = $tcms_main->create_uid($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'news_to_categories', 5);
					$n2c_maintag = $tcms_main->getNewUID(5, 'news_to_categories');
					
					$newSQLData = "'".$maintag."', '".$_POST['new_cat_'.$i]."'";
					
					$sqlQR = $sqlAL->createOne($tcms_db_prefix.'news_to_categories', $newSQLColumns, $newSQLData, $n2c_maintag);
				}
			}
		}
		
		
		if($show_wysiwyg == 'fckeditor'){
			$content = str_replace('../../../../../../../../../', '', $content);
		}
		
		if($show_wysiwyg != 'tinymce' && $show_wysiwyg != 'fckeditor'){
			$content = $tcms_main->convertNewlineToHTML($content);
		}
		
		
		// CHARSETS
		$new_news_title = $tcms_main->encodeText($new_news_title, '2', $c_charset);
		$new_news_autor = $tcms_main->encodeText($new_news_autor, '2', $c_charset);
		$content        = $tcms_main->encodeText($content, '2', $c_charset);
		
		
		$date = date('d.m.Y');
		$time = date('H:i');
		
		
		if($stamp == ''){
			$tmp_date = substr($date,6,4);
			$tmp_date .= substr($date,3,2);
			$tmp_date .= substr($date,0,2);
			$stamp = $tmp_date.$time;
			$stamp = str_replace('-','',$stamp);
			$stamp = str_replace(':','',$stamp);
		}
		
		
		if($new_news_date == '') $new_news_date = $date;
		if($new_news_time == '') $new_news_time = $time;
		$new_news_publish_date = $new_news_date.'-'.$new_news_time;
		
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser($tcms_administer_site.'/tcms_news/'.$maintag.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('news');
			
			$xmluser->write_value('title', $new_news_title);
			$xmluser->write_value('autor', $new_news_autor);
			$xmluser->write_value('date', $new_news_date);
			$xmluser->write_value('time', $new_news_time);
			$xmluser->write_value('newstext', $content);
			$xmluser->write_value('order', $maintag);
			$xmluser->write_value('stamp', $stamp);
			$xmluser->write_value('published', $new_news_published);
			$xmluser->write_value('publish_date', $new_news_publish_date);
			$xmluser->write_value('comments_enabled', $new_comments_enabled);
			$xmluser->write_value('image', '');
			$xmluser->write_value('category', $new_cat);
			$xmluser->write_value('access', $news_news_access);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('news');
			
			$old_umask = umask(0);
			mkdir($tcms_administer_site.'/tcms_news/comments_'.$maintag.'/', 0777);
			umask($old_umask);
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`title`, `autor`, `date`, `time`, `newstext`, `stamp`, '
					.'`published`, `publish_date`, `comments_enabled`, `access`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'title, autor, date, "time", newstext, stamp, '
					.'published, publish_date, comments_enabled, "access"';
					break;
				
				case 'mssql':
					$newSQLColumns = '[title], [autor], [date], [time], [newstext], [stamp], '
					.'[published], [publish_date], [comments_enabled], [access]';
					break;
			}
			
			$newSQLData = "'".$new_news_title."', '".$new_news_autor."', '".$new_news_date."', '".$new_news_time."', '".$content."', ".$stamp.", ".$new_news_published.", '".$new_news_publish_date."', ".$new_comments_enabled.", '".$news_news_access."'";
			
			$sqlQR = $sqlAL->createOne($tcms_db_prefix.'news', $newSQLColumns, $newSQLData, $maintag);
		}
		
		$link = '?session='.$session.'&s='.$s
		.( isset($lang) ? '&amp;lang='.$lang : '' );
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<script>'
		.'document.location=\''.$link.'\''
		.'</script>';
	}
	
	
	
	
	
	// -----------------------------------
	// SAVE IMAGE
	// -----------------------------------
	
	if($todo == 'saveImage') {
		if($_FILES['pubFile']['size'] > 0 && (
		$_FILES['pubFile']['type'] == 'image/gif' || 
		$_FILES['pubFile']['type'] == 'image/png' || 
		$_FILES['pubFile']['type'] == 'image/jpg' || 
		$_FILES['pubFile']['type'] == 'image/jpeg' || 
		$_FILES['pubFile']['type'] == 'image/bmp')){
			$fileName = $_FILES['pubFile']['name'];
			$imgDir = $tcms_administer_site.'/images/albums/'.$pubAlbum.'/';
			copy($_FILES['pubFile']['tmp_name'], $imgDir.$fileName);
			
			
			// CHARSETS
			$pubDesc = $tcms_main->decodeText($pubDesc, '2', $c_charset);
			
			if($choosenDB == 'xml'){
				$xmluser = new xmlparser($tcms_administer_site.'/tcms_imagegallery/'.$pubAlbum.'/'.$fileName.'.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('image');
				
				$xmluser->write_value('text', $pubDesc);
				$xmluser->write_value('timecode', $pubTimecode);
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('image');
			}
			else{
				//$new_image_id = $tcms_main->create_uid($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, 'tcms_imagegallery', 10);
				$new_image_id = $tcms_main->getNewUID(10, 'imagegallery');
				
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`album`, `image`, `text`, `date`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'album, image, text, date';
						break;
					
					case 'mssql':
						$newSQLColumns = '[album], [image], [text], [date]';
						break;
				}
				
				$newSQLData = "'".$pubAlbum."', '".$fileName."', '".$pubDesc."', '".$pubTimecode."'";
				
				$sqlQR = $sqlAL->createOne($tcms_db_prefix.'imagegallery', $newSQLColumns, $newSQLData, $new_image_id);
			}
			
			$link = '?session='.$session.'&id=imagegallery&s='.$s
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<script>document.location=\''.$link.'\'</script>';
		}
		else{
			$link = '?session='.$session.'&id=profile&s='.$s.'&todo=submitImages'
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<script>'
			.'alert(\''._MSG_NOUPLOAD.'.\');'
			.'document.location=\''.$link.'\';'
			.'</script>';
		}
	}
	
	
	
	
	
	// -----------------------------------
	// SAVE ALBUM
	// -----------------------------------
	
	if($todo == 'saveAlbum') {
		if($pubAlbum == ''){ $pubAlbum = '[TYPE DESCRIPTION]'; }else{ $pubAlbum = $pubAlbum; }
		if($pubDesc  == ''){ $pubDesc  = '[TYPE DESCRIPTION]'; }else{ $pubDesc  = $pubDesc; }
		if(!isset($pubLished) || $pubLished == ''){ $pubLished = 0; }
		
		// CHARSETS
		$pubAlbum = $tcms_main->decodeText($pubAlbum, '2', $c_charset);
		$pubDesc  = $tcms_main->decodeText($pubDesc, '2', $c_charset);
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser($tcms_administer_site.'/tcms_albums/album_'.$maintag.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('album');
			
			$xmluser->write_value('title', $pubAlbum);
			$xmluser->write_value('path', $maintag);
			$xmluser->write_value('use', $pubLished);
			$xmluser->write_value('description', $pubDesc);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('album');
			
			mkdir($tcms_administer_site.'/images/albums/'.$maintag, 0777);
			mkdir($tcms_administer_site.'/tcms_imagegallery/'.$maintag, 0777);
			mkdir($tcms_administer_site.'/thumbnails/'.$maintag, 0777);
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$album_path = substr($maintag, 0, 6);
			
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`title`, `album_id`, `published`, `desc`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'title, album_id, published, "desc"';
					break;
				
				case 'mssql':
					$newSQLColumns = '[title], [album_id], [published], [desc]';
					break;
			}
			
			$newSQLData = "'".$pubAlbum."', '".$album_path."', ".$pubLished.", '".$pubDesc."'";
			
			$sqlQR = $sqlAL->createOne($tcms_db_prefix.'albums', $newSQLColumns, $newSQLData, $maintag);
			
			mkdir($tcms_administer_site.'/images/albums/'.$album_path, 0777);
			mkdir($tcms_administer_site.'/thumbnails/'.$album_path, 0777);
		}
		
		$link = '?session='.$session.'&id=imagegallery&s='.$s
		.( isset($lang) ? '&amp;lang='.$lang : '' );
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<script>'
		.'document.location=\''.$link.'\''
		.'</script>';
	}
	
	
	
	
	
	// -----------------------------------
	// SAVE CAT
	// -----------------------------------
	
	if($todo == 'saveCat') {
		if($new_cat == '' || !isset($new_cat)){ $new_cat = ''; }
		if($pubDesc == '' || !isset($pubDesc)){ $pubDesc = ''; }
		
		// CHARSETS
		$new_cat = $tcms_main->decode_text($new_cat, '2', $c_charset);
		$pubDesc = $tcms_main->decode_text($pubDesc, '2', $c_charset);
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$maintag.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('cat');
			
			$xmluser->write_value('name', $new_cat);
			$xmluser->write_value('desc', $pubDesc);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('cat');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
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
			
			$newSQLData = "'".$new_cat."', '".$pubDesc."'";
			
			$sqlQR = $sqlAL->createOne($tcms_db_prefix.'news_categories', $newSQLColumns, $newSQLData, $maintag);
		}
		
		$link = '?session='.$session.'&id=frontpage&s='.$s
		.( isset($lang) ? '&amp;lang='.$lang : '' );
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<script>'
		.'document.location=\''.$link.'\''
		.'</script>';
	}
	
	
	
	
	
	// -----------------------------------
	// SAVE MEDIA
	// -----------------------------------
	
	if($todo == 'saveMedia') {
		if($_FILES['mediaImage']['size'] > 0 && (
		$_FILES['mediaImage']['type'] == 'image/gif' || 
		$_FILES['mediaImage']['type'] == 'image/png' || 
		$_FILES['mediaImage']['type'] == 'image/jpg' || 
		$_FILES['mediaImage']['type'] == 'image/jpeg' || 
		$_FILES['mediaImage']['type'] == 'image/bmp')){
			$fileName = $_FILES['mediaImage']['name'];
			$imgDir = $tcms_administer_site.'/images/Image/';
			
			copy($_FILES['mediaImage']['tmp_name'], $imgDir.$fileName);
			
			$msg = _MSG_UPLOAD.' '.$imgDir.$_FILES['mediaImage']['name'];
			$relocate = 1;
		}
		else{
			$msg = _MSG_NOUPLOAD;
			$relocate = 0;
		}
		
		if($relocate == 1){
			$link = '?session='.$session.'&id=frontpage&s='.$s
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<script>document.location=\''.$link.'\';</script>';
		}
		else{
			$link = '?session='.$session.'&id=profile&s='.$s.'&todo=submitMedia'
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<script>'
			.'alert(\''.$msg.'.\');'
			.'document.location=\''.$link.'\';'
			.'</script>';
		}
	}
}




/*
	show user
*/

if($todo != 'submitNews' 
&& $todo != 'submitImages' 
&& $todo != 'createAlbum' 
&& $todo != 'createCat' 
&& $todo != 'submitMedia' 
&& $action != 'list'){
	if($choosenDB == 'xml'){
		if(file_exists($tcms_administer_site.'/tcms_user/'.$u.'.xml')){ $checkUserExists = true; }
		else{ $checkUserExists = false; }
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getOne($tcms_db_prefix.'user', $u);
		$user_exists = $sqlAL->getNumber($sqlQR);
		
		if($user_exists != 0){ $checkUserExists = true; }
		else{ $checkUserExists = false; }
	}
	
	if($checkUserExists){
		if($todo == 'show'){
			//****************************
			// PROFILE
			//****************************
			
			$dcUser = new tcms_dc_account();
			$dcUser = $tcms_ap->getAccount($u);
			
			$tu_name      = $dcUser->getName();
			$tu_username  = $dcUser->getUsername();
			$tu_password  = $dcUser->getPassword();
			$tu_email     = $dcUser->getEmail();
			$tu_group     = $dcUser->getGroup();
			$tu_join      = $dcUser->getJoinDate();
			$tu_www       = $dcUser->getHomepage();
			$tu_icq       = $dcUser->getICQ();
			$tu_aim       = $dcUser->getAIM();
			$tu_yim       = $dcUser->getYIM();
			$tu_msn       = $dcUser->getMSN();
			$tu_skype     = $dcUser->getSkype();
			$tu_birthday  = $dcUser->getBirthday();
			$tu_sex       = $dcUser->getGender();
			$tu_occ       = $dcUser->getOccupation();
			$tu_enabled   = $dcUser->getEnabled();
			$tu_tcms      = $dcUser->getTCMSScriptEnabled();
			$tu_signature = $dcUser->getSignature();
			$tu_location  = $dcUser->getLocation();
			$tu_hobby     = $dcUser->getHobby();
			
			
			echo $tcms_html->contentTitle(_PROFILE_TITLE.' :: '.$tu_username);
			echo '<br />';
			
			$left_width  = '35%';
			$right_width = '65%';
			
			echo $tcms_html->userProfileTitle(_TABLE_GENERAL);
			echo '<br />';
			
			$tu_join = lang_date(substr($tu_join, 8, 2), substr($tu_join, 5, 2), substr($tu_join, 0, 4), substr($tu_join, 11, 2), substr($tu_join, 14, 2), substr($tu_join, 17, 2));
			
			//echo tcms_html::table_head_cl('0', '0', '0', '95%', 'text_normal');
			echo $tcms_html->tableHeadClass('0', '0', '0', '95%', 'text_normal');
			
			if(isset($tu_name) && trim($tu_name) != ''){
				echo '<tr height="21"><td valign="top" align="right" width="'.$left_width.'">'._PERSON_NAME.':&nbsp;</td>'
				.'<td valign="top" width="'.$right_width.'"><strong>'.$tu_name.'</strong></td></tr>';
			}
			
			echo '<tr height="21"><td valign="top" align="right" width="'.$left_width.'">'._PERSON_JOINDATE.':&nbsp;</td>'
			.'<td valign="top" width="'.$right_width.'"><strong>'.$tu_join.'</strong></td></tr>';
			
			if(isset($tu_username) && trim($tu_username) != ''){
				echo '<tr height="21"><td valign="top" align="right" width="'.$left_width.'">'._PERSON_USERNAME.':&nbsp;</td>'
				.'<td valign="top" width="'.$right_width.'"><strong>'.$tu_username.'</strong></td></tr>';
			}
			
			if(isset($tu_www) && trim($tu_www) != ''){
				if(substr($tu_www, 0, 7) != 'http://'){ $tu_www = 'http://'.$tu_www; }
				echo '<tr height="21"><td valign="top" align="right" width="'.$left_width.'">'._PERSON_WWW.':&nbsp;</td>'
				.'<td valign="top" width="'.$right_width.'"><strong><a href="'.$tu_www.'" target="_blank">'.$tu_www.'</a></strong></td></tr>';
			}
			
			if(isset($tu_location) && trim($tu_location) != ''){
				echo '<tr height="21"><td valign="top" align="right" width="'.$left_width.'">'._PERSON_LOCATION.':&nbsp;</td>'
				.'<td valign="top" width="'.$right_width.'"><strong>'.$tu_location.'</strong></td></tr>';
			}
			
			if(isset($tu_occ) && trim($tu_occ) != ''){
				echo '<tr height="21"><td valign="top" align="right" width="'.$left_width.'">'._PERSON_OCCUPATION.':&nbsp;</td>'
				.'<td valign="top" width="'.$right_width.'"><strong>'.$tu_occ.'</strong></td></tr>';
			}
			
			if(isset($tu_hobby) && trim($tu_hobby) != ''){
				echo '<tr height="21"><td valign="top" align="right" width="'.$left_width.'">'._PERSON_HOBBY.':&nbsp;</td>'
				.'<td valign="top" width="'.$right_width.'"><strong>'.$tu_hobby.'</strong></td></tr>';
			}
			
			echo $tcms_html->tableEnd();
			echo '<br /><br />';
			
			
			
			echo $tcms_html->userProfileTitle(_TABLE_CONTACT);
			echo '<br />';
			
			echo $tcms_html->tableHeadClass('0', '0', '0', '95%', 'text_normal');
			
			if($cipher_email == 1)
				$mmm = '<script>JSCrypt.displayCryptMailTo(\''.$tcms_main->encodeBase64($tu_email).'\');</script>';
			else
				$mmm = '<a href="mailto:'.$tu_email.'">';
			
			echo '<tr height="21"><td valign="middle" align="right" width="'.$left_width.'">'._PERSON_EMAIL.':&nbsp;</td>'
			.'<td valign="middle" width="'.$right_width.'">&nbsp;'.$mmm
			.'<img src="'.$imagePath.'engine/images/forum/icon_email.gif" border="0" /></a></td></tr>';
			
			if($tcms_main->isReal($tu_icq)){
				echo '<tr height="21"><td valign="middle" align="right" width="'.$left_width.'">'._PERSON_ICQ.':&nbsp;</td>'
				.'<td valign="middle" width="'.$right_width.'">&nbsp;'.( $tu_icq != '' ? '<a href="http://wwp.icq.com/scripts/search.dll?to='.$tu_icq.'" target="_blank">'
				.'<img src="'.$imagePath.'engine/images/forum/icon_icq.gif" border="0" /></a>' : '' ).'</td></tr>';
			}
			
			if($tcms_main->isReal($tu_aim)){
				echo '<tr height="21"><td valign="middle" align="right" width="'.$left_width.'">'._PERSON_AIM.':&nbsp;</td>'
				.'<td valign="middle" width="'.$right_width.'">&nbsp;<a href="aim:goim?screenname='.$tu_aim.'&message=Hello+Are+you+there?">'
				.'<img src="'.$imagePath.'engine/images/forum/icon_aim.gif" border="0" /></a></td></tr>';
			}
			
			if($tcms_main->isReal($tu_yim)){
				echo '<tr height="21"><td valign="middle" align="right" width="'.$left_width.'">'._PERSON_YIM.':&nbsp;</td>'
				.'<td valign="middle" width="'.$right_width.'">&nbsp;<a href="http://edit.yahoo.com/config/send_webmesg?.target='.$tu_yim.'&.src=pg" target="_blank">'
				.'<img src="'.$imagePath.'engine/images/forum/icon_yim.gif" border="0" /></a></td></tr>';
			}
			
			if($tcms_main->isReal($tu_msn)){
				echo '<tr height="21"><td valign="middle" align="right" width="'.$left_width.'">'._PERSON_MSN.':&nbsp;</td>'
				.'<td valign="middle" width="'.$right_width.'">&nbsp;<strong>'.$tu_msn.'</strong></td></tr>';
			}
			
			if($tcms_main->isReal($tu_skype)){
				echo '<tr height="21"><td valign="middle" align="right" width="'.$left_width.'">'._PERSON_SKYPE.':&nbsp;</td>'
				.'<td valign="middle" width="'.$right_width.'">&nbsp;<a href="skype:'.$tu_skype.'?call">'
				.'<strong>'.$tu_skype.'</strong></a></td></tr>';
			}
			
			echo $tcms_html->tableEnd();
			echo '<br /><br />';
			
			
			if(!(strlen($tu_birthday) < 9)
			|| ($tcms_main->isReal($tu_sex) && $tu_sex != '-')
			|| $tu_signature != ''){
				//echo tcms_html::user_gerneral(_TABLE_PERSON);
				echo $tcms_html->userProfileTitle(_TABLE_PERSON);
				echo '<br />';
			}
			
			//echo tcms_html::table_head_cl('0', '0', '0', '95%', 'text_normal');
			echo $tcms_html->tableHeadClass('0', '0', '0', '95%', 'text_normal');
			
			if(!(strlen($tu_birthday) < 9)){
				echo '<tr height="21"><td valign="top" align="right" width="'.$left_width.'">'._PERSON_BIRTHDAY.':&nbsp;</td>'
				.'<td valign="top" width="'.$right_width.'"><strong>'.$tu_birthday.'</strong></td></tr>';
			}
			
			if($tcms_main->isReal($tu_sex) && $tu_sex != '-'){
				echo '<tr height="21"><td valign="top" align="right" width="'.$left_width.'">'._PERSON_SEX.':&nbsp;</td>'
				.'<td valign="top" width="'.$right_width.'"><strong>'.( $tu_sex == 'man' ? _PERSON_SEX_MAN : _PERSON_SEX_WOMAN ).'</strong></td></tr>';
			}
			
			if(trim($tu_signature) != ''){
				if($tu_tcms == 1){
					$toendaScript = new toendaScript($tu_signature);
					$tu_signature = $toendaScript->toendaScript_trigger();
					$tu_signature = $toendaScript->checkSEO($tu_signature, $imagePath);
				}
				
				echo '<tr height="21"><td valign="top" align="right" width="'.$left_width.'">'._PERSON_SIGNATURE.':&nbsp;</td>'
				.'<td valign="top" width="'.$right_width.'"><strong>'.$tu_signature.'</strong></td></tr>';
			}
			
			echo $tcms_html->tableEnd();
			echo '<br /><br />';
			
			if($check_session){
				if($u == $ws_id){
					$link = '?'.( isset($session) ? 'session='.$session.'' : '' )
					.'&amp;id=profile&amp;s='.$s.'&amp;todo=edit&amp;u='.$u
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlConvertToSEO($link);
					
					echo '<form action="'.$link.'" method="post">';
					echo '<input type="submit" class="inputbutton" value="'._TABLE_EDITBUTTON.'" />';
					echo '</form>';
				}
			}
		}
		
		
		
		
		
		if($todo == 'edit'){
			if($check_session){
				if($u == $ws_id){
					$dcUser = new tcms_dc_account();
					$dcUser = $tcms_ap->getAccount($u);
					
					$tu_name      = $dcUser->getName();
					$tu_username  = $dcUser->getUsername();
					$tu_password  = $dcUser->getPassword();
					$tu_email     = $dcUser->getEmail();
					$tu_group     = $dcUser->getGroup();
					$tu_lastlogin = $dcUser->getLastLogin();
					$tu_join      = $dcUser->getJoinDate();
					$tu_www       = $dcUser->getHomepage();
					$tu_icq       = $dcUser->getICQ();
					$tu_aim       = $dcUser->getAIM();
					$tu_yim       = $dcUser->getYIM();
					$tu_msn       = $dcUser->getMSN();
					$tu_skype     = $dcUser->getSkype();
					$tu_birthday  = $dcUser->getBirthday();
					$tu_sex       = $dcUser->getGender();
					$tu_occ       = $dcUser->getOccupation();
					$tu_enabled   = $dcUser->getEnabled();
					$tu_tcms      = $dcUser->getTCMSScriptEnabled();
					$tu_static    = $dcUser->getStaticValue();
					$tu_signature = $dcUser->getSignature();
					$tu_location  = $dcUser->getLocation();
					$tu_hobby     = $dcUser->getHobby();
					
					//***********************
					// DATES
					//
					for($ic = 0; $ic < 31; $ic ++){
						if($ic + 1 < 10){ $icd = $ic + 1; $icd = '0'.$icd; }
						else{ $icd = $ic + 1; }
						$arr_day[$ic] = $icd;
					}
					for($ic = 0; $ic < 12; $ic ++){
						if($ic + 1 < 10){ $icm = $ic + 1; $icm = '0'.$icm; }
						else{ $icm = $ic + 1; }
						$arr_month[$ic] = $icm;
					}
					for($ic = 0; $ic < 12; $ic ++){
						if($ic + 1 < 10){ $icm = $ic + 1; }
						else{ $icm = $ic + 1; }
						$arr_month12[$ic] = $icm;
					}
					
					
					if($choosenDB == 'xml'){
						$userp_xml = new xmlparser($tcms_administer_site.'/tcms_global/userpage.xml','r');
						$width  = $userp_xml->readSection('userpage', 'text_width');
						$width2 = $userp_xml->readSection('userpage', 'input_width');
					}
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->getOne($tcms_db_prefix.'userpage', 'userpage');
						$sqlARR = $sqlAL->fetchArray($sqlQR);
						
						$width  = $sqlARR['text_width'];
						$width2 = $sqlARR['input_width'];
					}
					
					
					//****************************
					// FORM
					//****************************
					
					echo $tcms_html->contentTitle(_PROFILE_EDIT);
					echo '<br />';
					
					$link = '?session='.$session.'&amp;id=profile&amp;s='.$s;
					
					echo '<form id="personal" action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).''.$link.'" method="post">'
					.'<input name="your_password" type="hidden" value="'.$tu_password.'" />'
					.'<input name="your_group" type="hidden" value="'.$tu_group.'" />'
					.'<input name="your_joindate" type="hidden" value="'.$tu_join.'" />'
					.'<input name="new_lastlogin" type="hidden" value="'.$tu_lastlogin.'" />'
					.'<input name="your_enabled" type="hidden" value="'.$tu_enabled.'" />'
					.'<input name="u" type="hidden" value="'.$u.'" />'
					.'<input name="todo" type="hidden" value="update" />'
					.'<input name="new_static" type="hidden" value="'.$tu_static.'" />';
					
					
					// table head
					echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_NAME.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_2.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_name" type="text" value="'.$tu_name.'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_USERNAME.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_2.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_username" type="text" value="'.$tu_username.'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_EMAIL.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_2.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_email" type="text" value="'.$tu_email.'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_PASSWORD.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_2.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_password" type="password" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_VPASSWORD.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_2.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="check_pass" type="password" />'
					.'</td></tr>';
					
					
					// row line
					echo '<tr style="height: 28px;"><td colspan="2">&nbsp;</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_WWW.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_www" type="text" value="'.$tu_www.'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_ICQ.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_icq" type="text" value="'.$tu_icq.'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_AIM.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_aim" type="text" value="'.$tu_aim.'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_YIM.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_yim" type="text" value="'.$tu_yim.'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_MSN.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_msn" type="text" value="'.$tu_msn.'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_SKYPE.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_skype" type="text" value="'.$tu_skype.'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'" valign="top"><span class="text_normal">'._PERSON_BIRTHDAY.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
					.'<select name="new_day" class="tcms_select_day">';
					
					foreach($arr_day as $key => $val){
						echo '<option value="'.$val.'"'.( substr($tu_birthday, 0, 2) == $val ? ' selected' : '' ).'>'.$val.'</option>';
					}
					
					echo '</select>'
					.'<select name="new_month" class="tcms_select_month">';
					
					foreach($arr_month12 as $key => $val){
						echo '<option value="'.$val.'"'.( substr($tu_birthday, 3, 2) == $val ? ' selected' : '' ).'>'.$monthName[$val].'</option>';
					}
					
					echo '</select><br />'
					.'&nbsp;<img src="'.$imagePath.'engine/images/px.png" width="8" height="8" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_year" type="text" value="'.( substr($tu_birthday, 6, 4) ).'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_SEX.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
					.'<select class="tcms_select" name="new_sex">'
					.'<option value="-"'.( $tu_sex == '-' ? ' selected' : '').'>'._PERSON_SEX_KA.'</option>'
					.'<option value="man"'.( $tu_sex == 'man' ? ' selected' : '').'>'._PERSON_SEX_MAN.'</option>'
					.'<option value="woman"'.( $tu_sex == 'woman' ? ' selected' : '').'>'._PERSON_SEX_WOMAN.'</option>'
					.'</select>'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_OCCUPATION.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_occ" type="text" value="'.$tu_occ.'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_LOCATION.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_location" type="text" value="'.$tu_location.'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_HOBBY.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
					.'<input class="inputtext" style="width: '.$width2.'px;" name="new_hobby" type="text" value="'.$tu_hobby.'" />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td width="'.$width.'"><span class="text_normal">'._PERSON_TCMS_ENABLED.'</span></td>'
					.'<td>&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
					.'<input name="new_tcms" value="1" type="checkbox"'.( $tu_tcms == 1 ? ' checked="checked"' : $tu_tcms ).' />'
					.'</td></tr>';
					
					
					// row
					echo '<tr style="height: 28px;"><td colspan="2" valign="top">'
					.'<span class="text_normal">'._PERSON_SIGNATURE.'</span>'
					.'<br />'
					//.'<script>createToendaToolbar(\'personal\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \''.$imagePath.'browse.php?session='.$session.'&amp;n=toendaScript\', \'\');</script>'
					.'<script>createToolbar(\'personal\', \''.$tcms_lang.'\', \'toendaScript\');</script>'
					.'<br /><br />'
					.'<textarea id="content" name="new_signature" class="inputtextarea signatureform">'.$tu_signature.'</textarea>'
					.'</td></tr>';
					
					
					// table end
					echo '</table>';
					
					// end form
					echo '<br />'
					.'<input type="submit" value="'._TCMS_ADMIN_UPDATE.'" border="0" class="inputbutton" />';
					
					echo '</form>';
				}
			}
		}
		
		
		
		
		//****************************
		// SEND REGISTRATION
		//****************************
		
		if($todo == 'update'){
			if($check_session){
				if($u == $ws_id){
					if(!isset($new_password) || empty($new_password) || $new_password == ''){ $new_tupwd = $your_password; }
					else{
						$new_password = md5($new_password);
						$check_pass   = md5($check_pass);
						
						switch($new_password){
							case $new_password != $your_password:
								if($new_password == $check_pass){ $new_tupwd = $new_password; }
								else{ echo '<script>alert(\''._MSG_PASSWORDNOTVALID.'\'); go.history(-1);</script>'; }
								break;
							
							case $new_password == $your_password:
								$new_tupwd = $your_password;
								break;
							
							case !isset($new_password) || empty($new_password) || $new_password == '':
								$new_tupwd = $your_password;
								break;
						}
					}
					
					if(empty($new_tcms) || !isset($new_tcms)){ $new_tcms = 0; }
					
					$new_signature = $tcms_main->convertNewlineToHTML($new_signature);
					
					$dcUser = new tcms_dc_account();
					
					$dcUser->setID($u);
					$dcUser->setName($new_name);
					$dcUser->setUsername($new_username);
					$dcUser->setPassword($new_tupwd);
					$dcUser->setEmail($new_email);
					$dcUser->setGroup($your_group);
					$dcUser->setLocation($new_lastlogin);
					$dcUser->setJoinDate($your_joindate);
					$dcUser->setHomepage($new_www);
					$dcUser->setICQ($new_icq);
					$dcUser->setAIM($new_aim);
					$dcUser->setYIM($new_yim);
					$dcUser->setMSN($new_msn);
					$dcUser->setSkype($new_skype);
					$dcUser->setBirthday($new_day.'.'.$new_month.'.'.$new_year);
					$dcUser->setGender($new_sex);
					$dcUser->setOccupation($new_occ);
					$dcUser->setEnabled($your_enabled);
					$dcUser->setTCMSScriptEnabled($new_tcms);
					$dcUser->setStaticValue($new_static);
					$dcUser->setSignature($new_signature);
					$dcUser->setLocation($new_location);
					$dcUser->setHobby($new_hobby);
					
					$tcms_ap->saveAccount($dcUser);
					
					$link = '?session='.$session.'&id='.$id.'&s='.$s.'&u='.$u
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					
					if($seoEnabled == 1)
						$link = $tcms_main->urlConvertToSEO($link);
					
					echo '<script>document.location=\''.$link.'\';</script>';
				}
			}
		}
	}
	else{
		if($todo != 'submitNews'){
			echo $tcms_html->bold(_MSG_USERNOTEXISTS);
		}
	}
}




/*
	list users
*/

if($action == 'list'){
	if($show_ml == 1){
		echo $tcms_html->contentModuleHeader(
			_LOGIN_LIST, 
			_LOGIN_LIST_TEXT, 
			''
		);
		
		$count = 0;
		
		if($choosenDB == 'xml'){
			$arr_filename = $tcms_main->getPathContent($tcms_administer_site.'/tcms_user/');
			
			if($tcms_main->isArray($arr_filename)){
				foreach($arr_filename as $key => $value){
					$menu_xml = new xmlparser($tcms_administer_site.'/tcms_user/'.$value,'r');
					$user_enable = $menu_xml->readSection('user', 'enabled');
					
					if($user_enable == 1){
						$arr_user['tag'][$count]   = substr($value, 0, 32);
						$arr_user['name'][$count]  = $menu_xml->readSection('user', 'name');
						$arr_user['user'][$count]  = $menu_xml->readSection('user', 'username');
						$arr_user['group'][$count] = $menu_xml->readSection('user', 'group');
						$arr_user['email'][$count] = $menu_xml->readSection('user', 'email');
						$arr_user['www'][$count]   = $menu_xml->readSection('user', 'homepage');
						$arr_user['jdate'][$count] = $menu_xml->readSection('user', 'join_date');
						$arr_user['ll'][$count]    = $menu_xml->readSection('user', 'last_login');
						
						if($arr_user['name'][$count]  == false){ $arr_user['name'][$count]   = ''; }
						if($arr_user['user'][$count]  == false){ $arr_user['user'][$count]   = ''; }
						if($arr_user['group'][$count] == false){ $arr_user['group'][$count]  = ''; }
						if($arr_user['email'][$count] == false){ $arr_user['email'][$count]  = ''; }
						if($arr_user['jdate'][$count] == false){ $arr_user['jdate'][$count]  = ''; }
						if($arr_user['www'][$count]   == false){ $arr_user['www'][$count]    = ''; }
						if($arr_user['ll'][$count]    == false){ $arr_user['ll'][$count]     = ''; }
						
						// CHARSETS
						$arr_user['name'][$count] = $tcms_main->decodeText($arr_user['name'][$count], '2', $c_charset);
						$arr_user['user'][$count] = $tcms_main->decodeText($arr_user['user'][$count], '2', $c_charset);
						
						$count++;
					}
				}
			}
			
			if(is_array($arr_user)){
				array_multisort(
					$arr_user['name'], SORT_ASC, 
					$arr_user['user'], SORT_ASC, 
					$arr_user['group'], SORT_ASC, 
					$arr_user['email'], SORT_ASC, 
					$arr_user['tag'], SORT_ASC, 
					$arr_user['jdate'], SORT_ASC, 
					$arr_user['www'], SORT_ASC, 
					$arr_user['ll'], SORT_ASC
				);
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."user "
			."WHERE ".$tcms_db_prefix."user.enabled = 1 "
			."ORDER BY ".$tcms_db_prefix."user.name ASC, "
			.$tcms_db_prefix."user.username ASC, "
			.$tcms_db_prefix."user.group ASC";
			
			$sqlQR = $sqlAL->query($sqlSTR);
			
			while($sqlARR = $sqlAL->fetchArray($sqlQR)){
				$arr_user['tag'][$count]   = $sqlARR['uid'];
				$arr_user['name'][$count]  = $sqlARR['name'];
				$arr_user['user'][$count]  = $sqlARR['username'];
				$arr_user['group'][$count] = $sqlARR['group'];
				$arr_user['email'][$count] = $sqlARR['email'];
				$arr_user['www'][$count]   = $sqlARR['homepage'];
				$arr_user['jdate'][$count] = $sqlARR['join_date'];
				$arr_user['ll'][$count]    = $sqlARR['last_login'];
				
				if($arr_user['name'][$count]  == NULL){ $arr_user['name'][$count]  = ''; }
				if($arr_user['user'][$count]  == NULL){ $arr_user['user'][$count]  = ''; }
				if($arr_user['group'][$count] == NULL){ $arr_user['group'][$count] = ''; }
				if($arr_user['email'][$count] == NULL){ $arr_user['email'][$count] = ''; }
				if($arr_user['www'][$count]   == NULL){ $arr_user['www'][$count]   = ''; }
				if($arr_user['jdate'][$count] == NULL){ $arr_user['jdate'][$count] = ''; }
				if($arr_user['ll'][$count]    == NULL){ $arr_user['ll'][$count]    = ''; }
				
				// CHARSETS
				$arr_user['name'][$count] = $tcms_main->decodeText($arr_user['name'][$count], '2', $c_charset);
				$arr_user['user'][$count] = $tcms_main->decodeText($arr_user['user'][$count], '2', $c_charset);
				
				$count++;
				$checkUserAmount = $count;
			}
			
			$sqlAL->freeResult($sqlQR);
		}
		
		
		
		$width_1 = '25%';
		$width_2 = '20%';
		$width_3 = '10%';
		$width_4 = '15%';
		$width_5 = '10%';
		$width_6 = '10%';
		//$width_7 = '15%';
		
		//echo tcms_html::table_head_cl('0', '0', '0', '100%', 'text_normal');
		echo $tcms_html->tableHeadClass('0', '0', '0', '95%', 'text_normal');
		
		echo '<tr height="21">'
		.'<th valign="top" class="titleBG" width="'.$width_1.'" align="left">'._TABLE_NAME.'</th>'
		.'<th valign="top" class="titleBG" width="'.$width_2.'" align="left">'._TABLE_USERNAME.'</th>'
		.'<th valign="top" class="titleBG" width="'.$width_3.'" align="left">'._PERSON_JOINDATE.'</th>'
		.'<th valign="top" class="titleBG" width="'.$width_4.'" align="left">'._PERSON_LASTLOGIN.'</th>'
		.'<th valign="top" class="titleBG" width="'.( $width_5 + $width_6 ).'" align="left" colspan="2">'._TABLE_INFO.'</th>'
		//.'<th valign="top" class="titleBG" width="'.$width_7.'" align="left">'._TABLE_GROUP.'</th>'
		.'<tr>';
		
		if(is_array($arr_user)){
			foreach($arr_user['name'] as $key => $value){
				echo '<tr height="21">';
				echo '<td valign="middle" align="left" width="'.$width_1.'"><strong>'.$value.'</strong></td>';
				
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id=profile&amp;s='.$s.'&amp;u='.$arr_user['tag'][$key]
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '<td valign="middle" width="'.$width_2.'">'
				.'<a class="mainlevel" href="'.$link.'">'
				.$arr_user['user'][$key]
				.'</td>';
				
				
				echo '<td valign="middle" width="'.$width_3.'" style="padding: 2px;">'
				.lang_date(substr($arr_user['jdate'][$key], 0, 4), substr($arr_user['jdate'][$key], 5, 2), substr($arr_user['jdate'][$key], 8, 2), '', '', '')
				.'</td>';
				
				
				echo '<td valign="middle" width="'.$width_4.'" style="padding: 2px;">'
				.( $arr_user['ll'][$key] == '' ? '-' :
					lang_date(substr($arr_user['ll'][$key], 0, 4), substr($arr_user['ll'][$key], 5, 2), substr($arr_user['ll'][$key], 8, 2), '', '', '')
				)
				.'</td>';
				
				
				echo '<td valign="middle" width="'.$width_5.'" align="center">';
				
				if($cipher_email == 1){
					echo '<script>JSCrypt.displayCryptMail(\''.$tcms_main->encodeBase64($arr_user['email'][$key]).'\', \'<img src="'.$imagePath.'engine/images/letter.gif" border="0" />\');</script>';
				}
				else{
					if($arr_user['email'][$key] != ''){
						echo '<a href="mailto:'.$arr_user['email'][$key].'">'
						.'<img src="'.$imagePath.'engine/images/letter.gif" border="0" />'
						.'</a>';
					}
				}
				
				echo '</td>';
				
				
				echo '<td valign="middle" width="'.$width_6.'" align="center">';
				
				if($arr_user['www'][$key] != ''){
					if(substr($arr_user['www'][$key], 0, 7) != 'http://'){
						$arr_user['www'][$key] = 'http://'.$arr_user['www'][$key];
					}
					
					echo '<a href="'.$arr_user['www'][$key].'" target="_blank">'
					.'<img src="'.$imagePath.'engine/images/website.gif" border="0" />'
					.'</a>';
				}
				echo '</td>';
				
				
				//echo '<td valign="middle" width="'.$width_7.'">'.$arr_user['group'][$key].'</td>';
				echo '</tr>';
			}
		}
		
		echo $tcms_html->tableEnd();
	}
	else{
		echo '<strong>'._MSG_DISABLED_MODUL.'</strong>';
	}
}

?> 
