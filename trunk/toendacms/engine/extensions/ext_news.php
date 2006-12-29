<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Newsmanager
|
| File:		ext_news.php
| Version:	1.2.4
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');




if(isset($_GET['news'])){ $news = $_GET['news']; }
if(isset($_GET['cmd'])){ $cmd = $_GET['cmd']; }
if(isset($_GET['cat'])){ $cat = $_GET['cat']; }
if(isset($_GET['date'])){ $date = $_GET['date']; }
if(isset($_GET['day'])){ $day = $_GET['day']; }
if(isset($_GET['XMLplace'])){ $XMLplace = $_GET['XMLplace']; }
if(isset($_GET['XMLfile'])){ $XMLfile = $_GET['XMLfile']; }

if(isset($_POST['news'])){ $news = $_POST['news']; }
if(isset($_POST['cmd'])){ $cmd = $_POST['cmd']; }
if(isset($_POST['date'])){ $date = $_POST['date']; }
if(isset($_POST['day'])){ $day = $_POST['day']; }
if(isset($_POST['comment_name'])){ $comment_name = $_POST['comment_name']; }
if(isset($_POST['comment_email'])){ $comment_email = $_POST['comment_email']; }
if(isset($_POST['comment_web'])){ $comment_web = $_POST['comment_web']; }
if(isset($_POST['comment_text'])){ $comment_text = $_POST['comment_text']; }
if(isset($_POST['comment_captcha'])){ $comment_captcha = $_POST['comment_captcha']; }
if(isset($_POST['check_captcha'])){ $check_captcha = $_POST['check_captcha']; }
if(isset($_POST['trackback_url'])){ $trackback_url = $_POST['trackback_url']; }




/*
	init
*/

include_once('engine/tcms_kernel/datacontainer/tcms_dc_news.lib.php');

$hr_line_1 = '<tr class="hr_line"><td colspan="2"></td></tr>';
$hr_line_2 = '<hr class="hr_line" /><div style="height: '.$news_spacing.'px;">&nbsp;</div>';
$hr_line_3 = '<tr class="hr_line"><td colspan="3"></td></tr>';
$hr_line_5 = '<hr class="hr_line" noshade="noshade" />';

if($choosenDB == 'xml') $arr_news = $tcms_main->readdir_ext('data/tcms_news/');

if(!isset($news)){ $news = 'start'; }
if(!isset($cmd)){ $cmd = ''; }
if(isset($cat)){ $news = ''; $cmd = ''; }
if(isset($date)){ $news = ''; $cmd = ''; $cat = ''; }
if(isset($day)){ $news = ''; $cmd = ''; $cat = ''; $date = ''; }

if($news == 'start' || $news == 'archive'){
	if($cat == '' || !isset($cat)){
		if(trim($news_title)    != '') echo tcms_html::contentheading($news_title);
		if(trim($news_stamp)    != '') echo tcms_html::contentstamp($news_stamp).'<br />';
		if(trim($news_maintext) != '') echo tcms_html::contentmain($news_maintext).'<br />';
	}
}




/*
	access authentication
*/
if($check_session){
	if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){
		$auth_down = 'Protected';
	}
	if($is_admin == 'Administrator' || $is_admin == 'Developer'){
		$auth_down = 'Private';
	}
}
else{
	$auth_down = 'Public';
}




/*
	show a complete list of all news
*/

if($news == 'start' && !isset($cat)){
	$arrNewsDC = $tcms_dcp->getNewsDCList($is_admin, $news_amount);
	
	echo '<table cellpadding="0" cellspacing="0" border="0" width="100%">'
	.'<tr>'
	.'<th class="titleBG" valign="top" align="left" width="30%">&nbsp;'._DOWNLOADS_SUBMIT_ON.'</th>'
	.'<th class="titleBG" valign="top" align="left" width="70%">&nbsp;'._TABLE_TITLE.'</th>'
	.'</tr>';
	
	echo '<tr><td colspan="3" style="height: 3px;"></td></tr>';
	
	if(!empty($arrNewsDC) && $arrNewsDC != '' && isset($arrNewsDC)){
		foreach($arrNewsDC as $n_key => $n_value){
			$dcNews = new tcms_dc_news();
			$dcNews = $arrNewsDC[$n_key];
			
			echo '<tr class="news_content_bg">';
			
			echo '<td valign="top">'
			.lang_date(substr($dcNews->GetDate(), 0, 2), substr($dcNews->GetDate(), 3, 2), substr($dcNews->GetDate(), 6, 4), substr($dcNews->GetTime(), 0, 2), substr($dcNews->GetTime(), 3, 2), '')
			.'</td>';
			
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;s='.$s.'&amp;news='.$dcNews->GetID();
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<td valign="top">'
			.
			( $dcNews->GetTitle() == ''
				? ''
				: '<a href="'.$link.'">'
				.$dcNews->GetTitle().'</a>'
			)
			.'</td>';
			
			echo '</tr>';
		}
	}
	echo '</table><br /><br />';
	
	
	/*
		TAB
	*/
	echo '<div style="display: block; float: left; padding-right: 5px;">';
	$link = '?'.( isset($session) ? 'session='.$session.'&' : '' ).'id=newsmanager&s='.$s;
	$link = $tcms_main->urlAmpReplace($link);
	echo '<input class="inputbutton" type="button" onclick="document.location=\''.$link.'\';" value="'._NEWS_ARCHIVE.' ('._NEWS_LAST.' '.$news_amount.')" />';
	echo '</div>';
	
	
	echo '<div style="display: block; float: left; padding-right: 5px;">';
	$link = '?'.( isset($session) ? 'session='.$session.'&' : '' ).'id=newsmanager&s='.$s.'&news=archive';
	$link = $tcms_main->urlAmpReplace($link);
	echo '<input class="inputbutton" type="button" onclick="document.location=\''.$link.'\';" value="'._NEWS_ARCHIVE.' ('._NEWS_ORDER_BY_TIME.')" />';
	echo '</div>';
	
	
	$link = '?'.( isset($session) ? 'session='.$session.'&' : '' ).'id=newsmanager&s='.$s.'&news=archive&cmd=category';
	$link = $tcms_main->urlAmpReplace($link);
	echo '<input class="inputbutton" type="button" onclick="document.location=\''.$link.'\';" value="'._NEWS_ARCHIVE.' ('._NEWS_ORDER_BY_CAT.')" />';
	
	
	if(trim($news_image) != '')
		echo '<img align="right" src="data/images/Image/'.$news_image.'" border="0" />';
}





/*
	show one news
*/
if($news != 'start' && $cmd != 'comment_save' && $news != 'archive' && !isset($cat)){
	$dcNews = new tcms_dc_news();
	$dcNews = $tcms_dcp->getNewsDC($news, $is_admin);
	
	if($dcNews->GetPublished() == 1){
		if($check_session && $canEdit){
			$link = ( $seoFolder == '' ? '' : $seoFolder.'/' ).'engine/admin/admin.php?id_user='.$session.'&amp;site=mod_news&amp;todo=edit&amp;maintag='.$dcNews->GetID();
			
			echo '<div style="display: block; float: right;">';
			
			echo '<a href="'.$link.'" />';
			
			echo '<script>if(browser == \'ie\'){
			document.write(\'<img alt="'._NEWS_EDIT_CURRENT.'" title="'._NEWS_EDIT_CURRENT.'" style="" src="'.$imagePath.'engine/images/pencil.gif" border="0" />\');
			}else{
			document.write(\'<img alt="'._NEWS_EDIT_CURRENT.'" title="'._NEWS_EDIT_CURRENT.'" style="padding-bottom: 0px; padding-top: 1px;" src="'.$imagePath.'engine/images/pencil.png" border="0" />\');
			}</script>';
			
			echo '<noscript>'
			.'<img alt="'._NEWS_EDIT_CURRENT.'" title="'._NEWS_EDIT_CURRENT.'" style="" src="'.$imagePath.'engine/images/pencil.gif" border="0" />'
			.'</noscript>';
			
			echo '</a>';
			
			echo '</div>';
		}
		
		
		
		echo '<div class="contentmain">';
		
		echo '<div style="width: 100%;" class="news_title_bg text_huge">'
		.$dcNews->GetTitle()
		.'</div>';
			
		
		if($show_autor_as_link == 1){
			if($choosenDB == 'xml')
				$userID = $tcms_main->getUserID($dcNews->GetAutor());
			else
				$userID = $tcms_main->getUserIDfromSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $dcNews->GetAutor());
		}
		
		
		/*
			get categories
		*/
		if($choosenDB == 'xml'){
			/*
				load categories from xml
			*/
			if($arr_news['cat'] != ''){
				if(strpos($arr_news['cat'], '{###}')){
					$catLinkTmp = explode('{###}', $arr_news['cat']);
					
					$count = 0;
					
					foreach($catLinkTmp as $catKey => $catVal){
						if(trim($catVal) != ''){
							$catXML = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$catVal.'.xml','r');
							
							$catLink['link'][$count] = $catVal;
							$catLink['name'][$count] = $catXML->read_section('cat', 'name');
							
							$catLink['name'][$count] = $tcms_main->decodeText($catLink['name'][$count], '2', $c_charset);
							
							$count++;
						}
					}
				}
				else{
					$catXML = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$arr_news['cat'].'.xml','r');
					
					$catLink['name'][0] = $catXML->read_section('cat', 'name');
					
					$catLink['name'][0] = $tcms_main->decodeText($catLink['name'][0], '2', $c_charset);
					
					$catLink['link'][0] = $arr_news['cat'];
				}
			}
			else{
				$catXML = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$defaultCat.'.xml','r');
				
				$catLink['name'][0] = $catXML->read_section('cat', 'name');
				
				$catLink['name'][0] = $tcms_main->decodeText($catLink['name'][0], '2', $c_charset);
				
				$catLink['link'][0] = $defaultCat;
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			
			$strSQL = "SELECT * "
			."FROM ".$tcms_db_prefix."news_to_categories "
			."INNER JOIN ".$tcms_db_prefix."news_categories ON (".$tcms_db_prefix."news_to_categories.cat_uid = ".$tcms_db_prefix."news_categories.uid) "
			."WHERE (".$tcms_db_prefix."news_to_categories.news_uid = '".$dcNews->GetID()."')";
			
			$sqlQR = $sqlAL->sqlQuery($strSQL);
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			
			
			if($sqlNR == 0){
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'news_categories', $defaultCat);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$catLink['name'][0] = $sqlARR['name'];
				$catLink['link'][0] = $defaultCat;
				
				if($catLink['name'][0] == NULL){ $catLink['name'][0] = ''; }
				
				$catLink['name'][0] = $tcms_main->decodeText($catLink['name'][0], '2', $c_charset);
			}
			else{
				$count = 0;
				
				while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
					$catLink['link'][$count] = $sqlARR['cat_uid'];
					$catLink['name'][$count] = $sqlARR['name'];
					
					$catLink['name'][$count] = $tcms_main->decodeText($catLink['name'][$count], '2', $c_charset);
					
					$count++;
				}
			}
		}
		
		
		/*
			time
			and categories
		*/
		echo '<span class="text_small">'._TABLE_PUBLISHED.'&nbsp;';
		switch($use_timesince){
			case 0:
				echo lang_date(
					substr($dcNews->GetDate(), 0, 2), 
					substr($dcNews->GetDate(), 3, 2), 
					substr($dcNews->GetDate(), 6, 4), 
					substr($dcNews->GetTime(), 0, 2), 
					substr($dcNews->GetTime(), 3, 2), 
					''
				);
				break;
			
			case 1:
				$timestamp = mktime(
					substr($dcNews->GetTime(), 0, 2), 
					substr($dcNews->GetTime(), 3, 2), 
					'00', 
					substr($dcNews->GetDate(), 3, 2), 
					substr($dcNews->GetDate(), 0, 2), 
					substr($dcNews->GetDate(), 6, 4)
				);
				
				echo time_since($timestamp);
				break;
			
			case 2:
				$month = substr($dcNews->GetDate(), 3, 2);
				echo substr($dcNews->GetDate(), 0, 2).'. '
				.$monthName[((
					substr($month, 0, 1) == 0 ?
					substr($month, 1, 1) :
					$month
				))].' ';
				echo substr($dcNews->GetDate(), 6, 4)
				.' '.substr($dcNews->GetTime(), 0, 2).':'
				.substr($dcNews->GetTime(), 3, 2).'h';
				echo ' '.time_of_day(substr($dcNews->GetTime(), 0, 2));
				break;
			
			default:
				echo lang_date(
					substr($dcNews->GetDate(), 0, 2), 
					substr($dcNews->GetDate(), 3, 2), 
					substr($dcNews->GetDate(), 6, 4), 
					substr($dcNews->GetTime(), 0, 2), 
					substr($dcNews->GetTime(), 3, 2), 
					''
				);
				break;
		}
		
		if(!empty($catLink) && $catLink != ''){
			echo '&nbsp;'._NEWS_IN;
			
			foreach($catLink['link'] as $catKey => $catVal){
				if($catKey != 0){ echo ','; }
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;s='.$s.'&amp;cat='.$catVal;
				$link = $tcms_main->urlAmpReplace($link);
				
				echo '&nbsp;<a href="'.$link.'">'
				.$catLink['name'][$catKey]
				.'</a>';
			}
		}
		
		
		/*
			author
		*/
		if($show_autor == 1){
			echo '&nbsp;&bull;&nbsp;';
			
			if($show_autor_as_link == 1){
				if($dcNews->GetAutor() != ''){
					echo _NEWS_WRITTEN.'&nbsp;';
					
					if($userID != false){
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=profile&amp;s='.$s.'&amp;u='.$userID;
						$link = $tcms_main->urlAmpReplace($link);
						
						echo '<a href="'.$link.'">'.$dcNews->GetAutor().'</a>';
					}
					else{
						echo $dcNews->GetAutor();
					}
				}
			}
			else{
				echo _NEWS_WRITTEN.' '.$dcNews->GetAutor();
			}
		}
		
		echo '</span>';
		
		
		/*
			content
		*/
		$news_content = $dcNews->GetText();
		
		$toendaScript = new toendaScript($news_content);
		$news_content = $toendaScript->toendaScript_trigger();
		
		$news_content = $toendaScript->toendaScript_more($news_content, 'text');
		$news_content = $toendaScript->checkSEO($news_content, $imagePath);
		
		echo '<div class="news_content_bg"><br />'
		.$news_content.'<br /><br /><br /></div>';
		
		
		/*
			comments?
		*/
		if($use_news_comments == 1){
			if($dcNews->GetCommentsEnabled() == 1){
				$nw_amount = $tcms_dcp->getCommentDCList($dcNews->GetID(), 'news', false);
				
				echo '<strong class="news_title_bg text_huge">'.$nw_amount.' '.( $nw_amount == 1 ? _FRONT_COMMENT : _FRONT_COMMENTS ).'</strong>';
				
				if($use_trackback == 1){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;s='.$s.'&amp;news='.$dcNews->GetID().'&amp;cmd=trackback';
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '&nbsp;(&nbsp;<a href="'.$link.'">'._NEWS_TRACKBACK.'</a>&nbsp;)';
				}
				
				echo $hr_line_5;
			}
		}
		
		
		
		/*
			trackback
		*/
		if($cmd == 'trackback'){
			if($use_trackback == 1){
				if(isset($trackback_url) && $trackback_url != ''){
					$trackback = new tcms_trackback($sitename, $arr_news['autor'], $c_charset);
					$trackback->ping($trackback_url, $websiteowner_url, $dcNews->GetTitle());
				}
				else{
					$footer_xml = new xmlparser('data/tcms_global/footer.xml','r');
					$owner_url  = $footer_xml->read_section('footer', 'owner_url');
					
					echo '<strong>'._FRONT_OWN_TRACKBACK.':</strong> '.$owner_url.'?id=newsmanager&amp;news='.$news;
					
					echo '<form name="trackback" id="trackback" action="'.( $seoEnabled == 1 ? ( $seoFolder != '' ? $seoFolder.'/' : '' ) : '' ).'?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'&amp;cmd=trackback" method="post">';
					
					echo '<strong>'._FRONT_TRACKBACK_URL.'</strong>&nbsp;<input name="trackback_url" id="comment_web" class="inputtext" type="text" /><br />';
					
					echo '<input type="hidden" name="news" value="'.$news.'" />';
					
					echo '<br /><input class="inputbutton" type="submit" value="'._FORM_SEND.'" />';
					
					echo '</form>';
				}
			}
		}
		
		echo '</div><br /><br />';
		
		
		
		if($use_news_comments == 1){
			if($dcNews->GetCommentsEnabled() == 1){
				//************************************
				// COMMENT FORM
				//
				
				/*
					JavaScript for checking inputs
				*/
				?><script language="JavaScript">
				function checkinputs(id){
					sendOK = true;
					
					strName = document.forms[id].comment_name.value;
					if(strName == '') {
						sendOK = false;
						alert('<? echo _MSG_NONAME; ?>');
						document.forms[id].comment_name.focus();
						return false;
					}
					
					strEmail = document.forms[id].comment_email.value;
					if(strEmail == '') {
						sendOK = false;
						alert('<? echo _MSG_NOEMAIL; ?>');
						document.forms[id].comment_email.focus();
						return false;
					}
					if(strEmail.indexOf('@') == -1) {
						sendOK = false;
						alert('<? echo _MSG_EMAILVALID; ?>');
						document.forms[id].comment_email.focus();
						return false;
					}
					
					strMsg = document.forms[id].comment_text.value;
					if(strMsg == '') {
						sendOK = false;
						alert('<? echo _MSG_NOMSG; ?>');
						document.forms[id].comment_text.focus();
						return false;
					}
					
					<? if($use_captcha == 1){ ?>
						strMsg = document.forms[id].comment_captcha.value;
						if(strMsg == '') {
							sendOK = false;
							alert('<? echo _MSG_NOMSG; ?>');
							document.forms[id].comment_captcha.focus();
							return false;
						}
					<? } ?>
					
					if (sendOK){ document.forms[id].submit(); }
				}
				</script><?
				
				
				include_once('engine/tcms_kernel/datacontainer/tcms_dc_comment.lib.php');
				
				$arrCommentDC = $tcms_dcp->getCommentDCList($news);
				
				if(count($arrCommentDC) > 0){
					$count = 1;
					
					if(!empty($arrCommentDC) && $arrCommentDC != '' && isset($arrCommentDC)){
						foreach($arrCommentDC as $key => $value){
							$commentDC = new tcms_dc_comment();
							$commentDC = $arrCommentDC[$key];
							
							if($use_gravatar == 1){
								$grav_url = 'http://www.gravatar.com/avatar.php?gravatar_id='.md5($commentDC->GetEMail()).'&amp;default='.urlencode('http://www.somewhere.com/homestar.jpg').'&amp;size=32';
								echo '<a href="http://www.gravatar.com" title="What is this?" target="_blank"><img align="right" border="0" src="'.$grav_url.'" alt="?" /></a><br />';
							}
							
							echo '<strong class="comment_title">'.$count.'. ';
							if($commentDC->GetURL() != ''){ echo '<a href="'.$commentDC->GetURL().'">'.$commentDC->GetName().'</a>'; }
							else{ echo $commentDC->GetName(); }
							echo '</strong>';
							
							echo '<span class="text_small" style="padding: 3px 0 0 3px;">'.lang_date(substr($commentDC->GetTime(), 6, 2), substr($commentDC->GetTime(), 4, 2), substr($commentDC->GetTime(), 0, 4), substr($commentDC->GetTime(), 8, 2), substr($commentDC->GetTime(), 10, 2), substr($commentDC->GetTime(), 12, 2)).'</span>';
							
							echo $hr_line_5;
							
							$msg = $commentDC->GetText();
							if($use_emoticons == 1)
								$msg = $tcms_main->replaceSmilyTags($msg, $imagePath);
							
							echo '<div class="comment_text">';
							echo $msg;
							echo '</div>';
							
							if($check_session){
								if($is_admin == 'Administrator' || $is_admin == 'Developer'){
									$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'&amp;cmd=delete&amp;XMLplace='.$commentDC->GetID().'&amp;XMLfile='.$commentDC->GetTimestamp();
									$link = $tcms_main->urlAmpReplace($link);
									
									echo '<a class="main" href="'.$link.'"><strong>'._TCMS_ADMIN_DELETE.'</strong></a>';
								}
							}
							
							echo '<br /><br />';
							
							$count++;
						}
					}
				}
				else{
					echo _FRONT_NOCOMMENT.'<br />';
				}
				
				echo tcms_html::hr('#cccccc');
				
				echo '<br />';
				echo '<strong class="news_title_bg text_huge">'._FRONT_COMMENT_TITLE.'</strong><br />';
				echo '<br />';
				
				echo '<a name="comments"></a>';
				
				echo '<form name="comment" id="comment" action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'" method="post">';
				
				if($use_captcha == 1){
					$captchaImage = tcms_gd::createCaptchaImage('cache/captcha/', $captcha_clean);
					
					echo '<strong>'._FRONT_CAPTCHA.'</strong>'
					.'<br />';
					
					// inputs
					echo '<div style="display: block; float: left; width: 80px;">'
					.'<img src="'.$imagePath.'cache/captcha/'.$captchaImage.'.png" border="0" style="padding: 0px 3px 0 0;" /></div>';
					
					echo '<div style="display: block; margin: 0 0 3px 1px; width: 300px;">'
					.'<input name="comment_captcha" id="comment_captcha" class="inputtext" type="text" /></div>';
					
					echo '<input name="check_captcha" id="check_captcha" value="'.$captchaImage.'" type="hidden" />'
					.'<br /><br />';
				}
				
				// inputs
				echo '<div style="display: block; float: left; width: 80px;">'
				.'<strong class="text_normal">'._FRONT_COMMENT_NAME.'</strong></div>';
				
				echo '<div style="display: block; margin: 0 0 3px 1px; width: 300px;">'
				.'<input name="comment_name" id="comment_name" class="inputtext" type="text" /></div>';
				
				
				// inputs
				echo '<div style="display: block; float: left; width: 80px;">'
				.'<strong class="text_normal">'._FRONT_COMMENT_EMAIL.'</strong></div>';
				
				echo '<div style="display: block; margin: 0 0 3px 1px; width: 300px;">'
				.'<input name="comment_email" id="comment_email" class="inputtext" type="text" /></div>';
				
				
				// inputs
				echo '<div style="display: block; float: left; width: 80px;">'
				.'<strong class="text_normal">'._FRONT_COMMENT_WEB.'</strong></div>';
				
				echo '<div style="display: block; margin: 0 0 3px 1px; width: 300px;">'
				.'<input name="comment_web" id="comment_web" class="inputtext" type="text" /></div>';
				
				
				// inputs
				echo '<div style="display: block; float: left; width: 80px;">'
				.'<strong class="text_normal">'._FRONT_COMMENT_TEXT.'</strong></div>';
				
				echo '<div style="display: block; margin: 0 0 3px 1px;">'
				.'<textarea name="comment_text" id="comment_text" class="inputtextarea"></textarea></div>';
				
				
				echo '<input type="hidden" name="cmd" value="comment_save" />';
				echo '<input type="hidden" name="news" value="'.$news.'" />';
				
				echo '<br /><input class="inputbutton" type="button" onclick="javascript:checkinputs(\'comment\');" value="'._FORM_SUBMIT.'" />';
				
				echo '</form>';
			}
		}
	}
	else{
		echo '<strong>'._MSG_NOT_PUBLISHED.'</strong>';
	}
}









if($use_news_comments == 1){
	//******************************************
	// SAVE COMMENT
	//
	if($cmd == 'comment_save'){
		// Timestamp
		$cur_c_date = date('YmdHis');
		$save_comment = true;
		
		if($use_captcha == 1){
			if($comment_captcha == ''){
				echo _MSG_NOCAPTCHA.'<br />';
				$save_comment = false;
			}
			else{ $save_comment = true; }
			
			if($save_comment){
				if($comment_captcha != $check_captcha){
					echo _MSG_CAPTCHA_NOT_VALID.'<br />';
					$save_comment = false;
				}
				else{ $save_comment = true; }
			}
		}
		
		if($save_comment){
			if($comment_name == ''){
				echo _MSG_NONAME;
				$save_comment = false;
			}
			else{
				$save_comment = true;
			}
		}
		
		if($save_comment){ if($comment_email == ''){ echo _MSG_NOEMAIL; $save_comment = false; }else{ $save_comment = true; } }
		if($save_comment){ if(strpos($comment_email, '@') == false){ echo _MSG_NOEMAIL; $save_comment = false; }else{ $save_comment = true; } }
		if($save_comment){ if($comment_text == '') { echo _MSG_NOMSG; $save_comment = false; }  else{ $save_comment = true; } }
		
		if($comment_web != ''){ if(substr($comment_web, 0, 7) != 'http://'){ $comment_web = 'http://'.$comment_web; } }
		
		
		
		if($save_comment == true){
			// clean from html tags
			$comment_name = strip_tags($comment_name);
			$comment_email = strip_tags($comment_email);
			$comment_text = strip_tags($comment_text);
			
			
			// linebreak
			$comment_text = $tcms_main->nl2br($comment_text);
			
			
			// CHARSETS
			$comment_text = $tcms_main->decode_text($comment_text, '2', $c_charset);
			
			
			$comment_ip = getenv('REMOTE_ADDR');
			if($comment_ip == ''){
				$comment_remote = 'localhost';
				$comment_ip = '127.0.0.1';
			}
			else{
				$comment_remote = getHostByAddr($comment_ip);
			}
			
			
			if($choosenDB == 'xml'){
				$xmluser = new xmlparser($tcms_administer_site.'/tcms_news/comments_'.$news.'/'.$cur_c_date.'.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('comment');
				
				$xmluser->write_value('name', $comment_name);
				$xmluser->write_value('email', $comment_email);
				$xmluser->write_value('web', $comment_web);
				$xmluser->write_value('msg', $comment_text);
				$xmluser->write_value('time', $cur_c_date);
				$xmluser->write_value('ip', $comment_ip);
				$xmluser->write_value('domain', $comment_remote);
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('comment');
				$xmluser->_xmlparser();
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`module`, `timestamp`, `name`, `email`, `web`, `msg`, `time`, `ip`, `domain`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'module, timestamp, name, email, web, msg, "time", ip, "domain"';
						break;
					
					case 'mssql':
						$newSQLColumns = '[module], [timestamp], [name], [email], [web], [msg], [time], [ip], [domain]';
						break;
				}
				
				$newSQLData = "'news', '".$cur_c_date."', '".$comment_name."', '".$comment_email."', '".$comment_web."', '".$comment_text."', '".$cur_c_date."', '".$comment_ip."', '".$comment_remote."'";
				
				$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'comments', $newSQLColumns, $newSQLData, $news);
			}
			
			
			$link = '?'.( isset($session) ? 'session='.$session.'&' : '' ).'id='.$id.'&s='.$s.'&news='.$news;
			if($seoEnabled == 1) $link = $tcms_main->urlAmpReplace($link);
			
			echo '<script>document.location=\''.$link.'\'</script>';
			
			
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'&amp;news='.$news;
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<a href="'.$link.'">'._TCMS_ADMIN_BACK.'</a>';
		}
		else{
			echo '<a href="javascript:history.back();">'._TCMS_ADMIN_BACK.'</a>';
		}
	}
}










/*******************************************
*
* Categories
* and
* MonthView
*
*/
if($cmd == '' && $news == ''){
	if(isset($date)){
		if(strlen($date) == 6){
			/*
			*
			* MONTHVIEW
			*
			*/
			if(substr(substr($date, 4, 2), 0, 1) == '0'){ $ccMonth = substr(substr($date, 4, 2), 1, 1); }
			else{ $ccMonth = substr($date, 4, 2); }
			
			echo tcms_html::contentheading(_NEWS_ARCHIV_FOR.'&nbsp;'.$monthName[$ccMonth].',&nbsp;'.substr($date, 0, 4))
			.'<br /><br />';
			
			
			if($choosenDB != 'xml'){
				if($check_session){
					if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){
						$authSQL = "OR ".$tcms_db_prefix."news.access = 'Protected' ";
					}
					if($is_admin == 'Administrator' || $is_admin == 'Developer'){
						$authSQL = "OR ".$tcms_db_prefix."news.access = 'Protected' OR ".$tcms_db_prefix."news.access = 'Private' ";
					}
				}
				
				$sqlStr = "SELECT * "
				."FROM ".$tcms_db_prefix."news "
				."WHERE date LIKE '%.".substr($date, 4, 2).'.'.substr($date, 0, 4)."' "
				."AND access = 'Public' ".$authSQL
				."AND ".$tcms_db_prefix."news.published = 1 "
				."ORDER BY stamp DESC";
			}
		}
		else{
			/*
			*
			* DAYVIEW
			*
			*/
			if(substr(substr($date, 6, 2), 0, 1) == '0'){ $ccDay = substr(substr($date, 6, 2), 1, 1); }
			else{ $ccDay = substr($date, 6, 2); }
			
			if(substr(substr($date, 4, 2), 0, 1) == '0'){ $ccMonth = substr(substr($date, 4, 2), 1, 1); }
			else{ $ccMonth = substr($date, 4, 2); }
			
			echo tcms_html::contentheading(_NEWS_ARCHIV_FOR.'&nbsp;'.$ccDay.'.&nbsp;'.$monthName[$ccMonth].',&nbsp;'.substr($date, 0, 4))
			.'<br /><br />';
			
			
			if($choosenDB != 'xml'){
				if($check_session){
					if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){
						$authSQL = "OR ".$tcms_db_prefix."news.access = 'Protected' ";
					}
					if($is_admin == 'Administrator' || $is_admin == 'Developer'){
						$authSQL = "OR ".$tcms_db_prefix."news.access = 'Protected' OR ".$tcms_db_prefix."news.access = 'Private' ";
					}
				}
				
				$sqlStr = "SELECT * "
				."FROM ".$tcms_db_prefix."news "
				."WHERE date = '".substr($date, 6, 2).".".substr($date, 4, 2).".".substr($date, 0, 4)."' "
				."AND access = 'Public' ".$authSQL
				."AND ".$tcms_db_prefix."news.published = 1 "
				."ORDER BY stamp DESC";
			}
		}
	}
	else{
		if($choosenDB == 'xml'){
			$xmlP = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$cat.'.xml', 'r');
			$catName = $xmlP->read_section('cat', 'name');
			$catDesc = $xmlP->read_section('cat', 'desc');
			
			if(!$catName){ $catName = ''; }
			if(!$catDesc){ $catDesc = ''; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'news_categories', $cat);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$catName = $sqlARR['name'];
			$catDesc = $sqlARR['desc'];
			
			if($catName == NULL){ $catName = ''; }
			if($catDesc == NULL){ $catDesc = ''; }
		}
		
		$catName = $tcms_main->decodeText($catName, '2', $c_charset);
		$catDesc = $tcms_main->decodeText($catDesc, '2', $c_charset);
		
		if($catName != ''){ echo tcms_html::contentheading(_NEWS_CATEGORY_ARCHIV.' \''.$catName.'\'').'<br />'; }
		if($catDesc != ''){ echo tcms_html::contentmain($catDesc).'<br /><br />'; }
		
		
		if($choosenDB != 'xml'){
			if($check_session){
				if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){
					$authSQL = "OR ".$tcms_db_prefix."news.access = 'Protected' ";
				}
				if($is_admin == 'Administrator' || $is_admin == 'Developer'){
					$authSQL = "OR ".$tcms_db_prefix."news.access = 'Protected' OR ".$tcms_db_prefix."news.access = 'Private' ";
				}
			}
			
			$sqlStr = "SELECT * "
			."FROM ".$tcms_db_prefix."news_to_categories "
			."INNER JOIN ".$tcms_db_prefix."news ON (".$tcms_db_prefix."news_to_categories.news_uid = ".$tcms_db_prefix."news.uid) "
			."WHERE ".$tcms_db_prefix."news_to_categories.cat_uid = '".$cat."' "
			."AND ".$tcms_db_prefix."news.published = 1 "
			."AND ".$tcms_db_prefix."news.access = 'Public' ".$authSQL
			."ORDER BY ".$tcms_db_prefix."news.stamp DESC, ".$tcms_db_prefix."news.date DESC, ".$tcms_db_prefix."news.time DESC";
		}
	}
	
	
	$cZ = 0;
	
	if($choosenDB == 'xml'){
		if(!empty($arr_news) && $arr_news != '' && isset($arr_news)){
			foreach($arr_news as $key => $cvalue){
				$isCorrect = false;
				
				if(isset($date)){
					if(strlen($date) == 6){
						/*
							-- MONTH ARCHIVE --
							
							check if category in news cat array
							the publishing
							and the access
						*/
						$main_xml = new xmlparser($tcms_administer_site.'/tcms_news/'.$cvalue,'r');
						$is_pub = $main_xml->read_section('news', 'published');
						$nws_acc  = $main_xml->read_section('news', 'access');
						$checkDate = $main_xml->read_section('news', 'date');
						
						
						if(substr(substr($date, 4, 2), 0, 1) == '0'){ $ccMonth = substr(substr($date, 4, 2), 1, 1); }
						else{ $ccMonth = substr($date, 4, 2); }
						
						if(strpos($checkDate, $ccMonth.'.'.substr($date, 0, 4))){
							$isCorrect = true;
						}
					}
					else{
						/*
							-- DAY ARCHIVE --
							
							check if category in news cat array
							the publishing
							and the access
						*/
						$main_xml = new xmlparser($tcms_administer_site.'/tcms_news/'.$cvalue,'r');
						
						$is_pub = $main_xml->read_section('news', 'published');
						$nws_acc  = $main_xml->read_section('news', 'access');
						$checkDate = $main_xml->read_section('news', 'date');
						
						
						if(strlen(substr($date, 6, 2)) == '0'){ $ccDay = '0'.substr(substr($date, 6, 2), 1, 1); }
						else{ $ccDay = substr($date, 6, 2); }
						
						if(substr(substr($date, 4, 2), 0, 1) != '0'){ $ccMonth = '0'.substr(substr($date, 4, 2), 1, 1); }
						else{ $ccMonth = substr($date, 4, 2); }
						
						if($checkDate == ($ccDay.'.'.$ccMonth.'.'.substr($date, 0, 4))) $isCorrect = true;
					}
				}
				else{
					/*
						-- CATEGORY ARCHIVE --
						
						check if category in news cat array
						the publishing
						and the access
					*/
					$main_xml = new xmlparser($tcms_administer_site.'/tcms_news/'.$cvalue,'r');
					$is_pub = $main_xml->read_section('news', 'published');
					$nws_acc  = $main_xml->read_section('news', 'access');
					$checkCat = $main_xml->read_section('news', 'category');
					$arrCat = explode('{###}', $checkCat);
					
					if(in_array($cat, $arrCat)){
						$isCorrect = true;
					}
				}
				
				
				if($nws_acc == 'Public'){ $show_this_news = true; }
				elseif($nws_acc == 'Protected'){
					if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){ $show_this_news = true; }
					else{ $show_this_news = false; }
				}
				elseif($nws_acc == 'Private'){
					if($is_admin == 'Administrator' || $is_admin == 'Developer'){ $show_this_news = true; }
					else{ $show_this_news = false; }
				}
				
				
				if($is_pub == 1 && $show_this_news == true && $isCorrect == true){
					$is_date  = $main_xml->read_section('news', 'publish_date');
					$is_date = mktime(substr($is_date, 11, 2), substr($is_date, 14, 2), 0, substr($is_date, 3, 2), substr($is_date, 0, 2), substr($is_date, 6, 4));
					
					if($is_date < time()){
						$arr_newsItems['title'][$cZ] = $main_xml->read_section('news', 'title');
						$arr_newsItems['news'][$cZ]  = $main_xml->read_section('news', 'newstext');
						$arr_newsItems['date'][$cZ]  = $main_xml->read_section('news', 'date');
						$arr_newsItems['time'][$cZ]  = $main_xml->read_section('news', 'time');
						$arr_newsItems['order'][$cZ] = $main_xml->read_section('news', 'order');
						$arr_newsItems['stamp'][$cZ] = $main_xml->read_section('news', 'stamp');
						$arr_newsItems['autor'][$cZ] = $main_xml->read_section('news', 'autor');
						$arr_newsItems['cmt'][$cZ]   = $main_xml->read_section('news', 'comments_enabled');
						$arr_newsItems['cat'][$cZ]   = $checkCat;
						
						if(!$arr_newsItems['title'][$cZ]){ $arr_newsItems['title'][$cZ] = ''; }
						if(!$arr_newsItems['date'][$cZ]) { $arr_newsItems['date'][$cZ]  = ''; }
						if(!$arr_newsItems['time'][$cZ]) { $arr_newsItems['time'][$cZ]  = ''; }
						if(!$arr_newsItems['order'][$cZ]){ $arr_newsItems['order'][$cZ] = ''; }
						if(!$arr_newsItems['stamp'][$cZ]){ $arr_newsItems['stamp'][$cZ] = ''; }
						if(!$arr_newsItems['autor'][$cZ]){ $arr_newsItems['autor'][$cZ] = ''; }
						if(!$arr_newsItems['cmt'][$cZ])  { $arr_newsItems['cmt'][$cZ]   = ''; }
						if(!$arr_newsItems['cat'][$cZ])  { $arr_newsItems['cat'][$cZ]   = ''; }
						
						$arr_newsItems['title'][$cZ] = $tcms_main->decodeText($arr_newsItems['title'][$cZ], '2', $c_charset);
						$arr_newsItems['news'][$cZ]  = $tcms_main->decodeText($arr_newsItems['news'][$cZ], '2', $c_charset);
						$arr_newsItems['autor'][$cZ] = $tcms_main->decodeText($arr_newsItems['autor'][$cZ], '2', $c_charset);
						
						$cZ++;
					}
					
					$show_this_news = false;
				}
			}
		}
		
		if($arr_newsItems['time']){
			array_multisort(
				$arr_newsItems['stamp'], SORT_DESC, 
				$arr_newsItems['date'], SORT_DESC, 
				$arr_newsItems['time'], SORT_DESC, 
				$arr_newsItems['title'], SORT_DESC, 
				$arr_newsItems['news'], SORT_DESC, 
				$arr_newsItems['autor'], SORT_DESC, 
				$arr_newsItems['cmt'], SORT_DESC, 
				$arr_newsItems['cat'], SORT_DESC, 
				$arr_newsItems['order'], SORT_DESC
			);
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlQuery($sqlStr);
		
		$count = 0;
		
		while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
			$is_date = $sqlARR['publish_date'];
			
			mktime(substr($is_date, 11, 2), substr($is_date, 14, 2), 0, substr($is_date, 3, 2), substr($is_date, 0, 2), substr($is_date, 6, 4));
			
			if($is_date < time()){
				$arr_newsItems['title'][$count] = $sqlARR['title'];
				$arr_newsItems['autor'][$count] = $sqlARR['autor'];
				$arr_newsItems['date'][$count]  = $sqlARR['date'];
				$arr_newsItems['time'][$count]  = $sqlARR['time'];
				$arr_newsItems['news'][$count]  = $sqlARR['newstext'];
				$arr_newsItems['order'][$count] = $sqlARR['uid'];
				$arr_newsItems['stamp'][$count] = $sqlARR['stamp'];
				$arr_newsItems['image'][$count] = $sqlARR['image'];
				$arr_newsItems['cmt'][$count]   = $sqlARR['comments_enabled'];
				
				if($arr_newsItems['title'][$count] == NULL){ $arr_newsItems['title'][$count] = ''; }
				if($arr_newsItems['autor'][$count] == NULL){ $arr_newsItems['autor'][$count] = ''; }
				if($arr_newsItems['date'][$count]  == NULL){ $arr_newsItems['date'][$count]  = ''; }
				if($arr_newsItems['time'][$count]  == NULL){ $arr_newsItems['time'][$count]  = ''; }
				if($arr_newsItems['news'][$count]  == NULL){ $arr_newsItems['news'][$count]  = ''; }
				if($arr_newsItems['order'][$count] == NULL){ $arr_newsItems['order'][$count] = ''; }
				if($arr_newsItems['stamp'][$count] == NULL){ $arr_newsItems['stamp'][$count] = ''; }
				if($arr_newsItems['image'][$count] == NULL){ $arr_newsItems['image'][$count] = ''; }
				if($arr_newsItems['cmt'][$count]   == NULL){ $arr_newsItems['cmt'][$count]   = ''; }
				
				$arr_newsItems['title'][$count] = $tcms_main->decodeText($arr_newsItems['title'][$count], '2', $c_charset);
				$arr_newsItems['news'][$count]  = $tcms_main->decodeText($arr_newsItems['news'][$count], '2', $c_charset);
				$arr_newsItems['autor'][$count] = $tcms_main->decodeText($arr_newsItems['autor'][$count], '2', $c_charset);
				
				$count++;
			}
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	
	
	if(!empty($arr_newsItems['stamp']) && $arr_newsItems['stamp'] != '' && isset($arr_newsItems['stamp'])){
		foreach($arr_newsItems['stamp'] as $key => $value){
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;s='.$s.'&amp;news='.$arr_newsItems['order'][$key];
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<div style="width: 100%;" class="news_title_bg">'
			.'<strong class="text_huge">'
			.'<a href="'.$link.'">'
			.$arr_newsItems['title'][$key]
			.'</a>'
			.'</strong>'
			.'</div>';
			
			
			/*
				time
			*/
			echo '<div style="padding-top: 5px;" class="news_content_bg">'
			.'<span class="text_small">';
			
			switch($use_timesince){
				case 0:
					echo lang_date(
						substr($arr_newsItems['date'][$key], 0, 2), 
						substr($arr_newsItems['date'][$key], 3, 2), 
						substr($arr_newsItems['date'][$key], 6, 4), 
						substr($arr_newsItems['time'][$key], 0, 2), 
						substr($arr_newsItems['time'][$key], 3, 2), 
						''
					);
					break;
				
				case 1:
					$timestamp = mktime(
						substr($arr_newsItems['time'][$key], 0, 2), 
						substr($arr_newsItems['time'][$key], 3, 2), 
						'00', 
						substr($arr_newsItems['date'][$key], 3, 2), 
						substr($arr_newsItems['date'][$key], 0, 2), 
						substr($arr_newsItems['date'][$key], 6, 4)
					);
					
					echo time_since($timestamp);
					break;
				
				case 2:
					$month = substr($arr_newsItems['date'][$key], 3, 2);
					echo substr($arr_newsItems['date'][$key], 0, 2).'. '
					.$monthName[((
						substr($month, 0, 1) == 0 ?
						substr($month, 1, 1) :
						$month
					))].' ';
					echo substr($arr_newsItems['date'][$key], 6, 4)
					.' '.substr($arr_newsItems['time'][$key], 0, 2).':'
					.substr($arr_newsItems['time'][$key], 3, 2).'h';
					echo ' '.time_of_day(substr($arr_newsItems['time'], 0, 2));
					break;
				
				default:
					echo lang_date(
						substr($arr_newsItems['date'][$key], 0, 2), 
						substr($arr_newsItems['date'][$key], 3, 2), 
						substr($arr_newsItems['date'][$key], 6, 4), 
						substr($arr_newsItems['time'][$key], 0, 2), 
						substr($arr_newsItems['time'][$key], 3, 2), 
						''
					);
					break;
			}
			
			
			/*
				comment link
				if enabled
			*/
			if($use_news_comments == 1){
				if($arr_newsItems['cmt'][$key] == 1){
					if($choosenDB == 'xml'){ $nw_amount = $tcms_main->readdir_count($tcms_administer_site.'/tcms_news/comments_'.$arr_newsItems['order'][$key].'/'); }
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB);
						$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'comments', $arr_newsItems['order'][$key]);
						
						$nw_amount = $sqlAL->sqlGetNumber($sqlQR);
					}
				}
			}
			
			
			/*
				get user id
				and the categories
			*/
			if($choosenDB == 'xml'){
				if($show_autor_as_link == 1){
					$userID = $tcms_main->getUserID($arr_newsItems['autor'][$key]);
				}
				
				if($arr_newsItems['cat'][$key] != ''){
					if(strpos($arr_newsItems['cat'][$key], '{###}')){
						$catLinkTmp = explode('{###}', $arr_newsItems['cat'][$key]);
						
						$count = 0;
						
						foreach($catLinkTmp as $catKey => $catVal){
							if(trim($catVal) != ''){
								$catXML = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$catVal.'.xml','r');
								
								$catLink['link'][$count] = $catVal;
								$catLink['name'][$count] = $catXML->read_section('cat', 'name');
								
								$catLink['name'][$count] = $tcms_main->decodeText($catLink['name'][$count], '2', $c_charset);
								
								$count++;
							}
						}
					}
					else{
						$catXML = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$arr_newsItems['cat'][$key].'.xml','r');
						
						$catLink['name'][0] = $catXML->read_section('cat', 'name');
						
						$catLink['name'][0] = $tcms_main->decodeText($catLink['name'][0], '2', $c_charset);
						
						$catLink['link'][0] = $arr_newsItems['cat'][$key];
					}
				}
				else{
					$catXML = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$defaultCat.'.xml','r');
					
					$catLink['name'][0] = $catXML->read_section('cat', 'name');
					
					$catLink['name'][0] = $tcms_main->decodeText($catLink['name'][0], '2', $c_charset);
					
					$catLink['link'][0] = $defaultCat;
				}
			}
			else{
				if($show_autor_as_link == 1){
					$userID = $tcms_main->getUserIDfromSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $arr_newsItems['autor'][$n_key]);
				}
				
				
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				
				$strSQL = "SELECT * "
				."FROM ".$tcms_db_prefix."news_to_categories "
				."INNER JOIN ".$tcms_db_prefix."news_categories ON (".$tcms_db_prefix."news_to_categories.cat_uid = ".$tcms_db_prefix."news_categories.uid) "
				."WHERE (".$tcms_db_prefix."news_to_categories.news_uid = '".$arr_newsItems['order'][$key]."')";
				
				$sqlQR = $sqlAL->sqlQuery($strSQL);
				$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
				
				
				if($sqlNR == 0){
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'news_categories', $defaultCat);
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					
					$catLink['name'][0] = $sqlARR['name'];
					$catLink['link'][0] = $defaultCat;
					
					if($catLink['name'][0] == NULL){ $catLink['name'][0] = ''; }
					
					$catLink['name'][0] = $tcms_main->decodeText($catLink['name'][0], '2', $c_charset);
				}
				else{
					$count = 0;
					
					while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
						$catLink['link'][$count] = $sqlARR['cat_uid'];
						$catLink['name'][$count] = $sqlARR['name'];
						
						$catLink['name'][$count] = $tcms_main->decodeText($catLink['name'][$count], '2', $c_charset);
						
						$count++;
					}
				}
			}
			
			
			echo '&nbsp;|';
			
			
			/*
				show autor, if enabled
				show categories
				show comments, if enabled
			*/
			if($show_autor == 1){
				if($show_autor_as_link == 1){
					if($arr_newsItems['autor'][$key] != ''){
						echo '&nbsp;'._NEWS_WRITTEN.'&nbsp;';
						
						if($userID != false){
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=profile&amp;s='.$s.'&amp;u='.$userID;
							$link = $tcms_main->urlAmpReplace($link);
							
							echo '<a href="'.$link.'">'.$arr_newsItems['autor'][$key].'</a>';
						}
						else{
							echo $arr_news['autor'];
						}
					}
				}
				else{
					echo '&nbsp;'._NEWS_WRITTEN.'&nbsp;'.$arr_newsItems['autor'][$key];
				}
			}
			
			if(!empty($catLink) && $catLink != ''){
				echo '&nbsp;'._NEWS_IN;
				
				foreach($catLink['link'] as $catKey => $catVal){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;s='.$s.'&amp;cat='.$catVal;
					$link = $tcms_main->urlAmpReplace($link);
					
					if($catKey != 0){ echo ','; }
					echo '&nbsp;<a href="'.$link.'">'
					.$catLink['name'][$catKey]
					.'</a>';
				}
			}
			
			if($use_trackback == 1){
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;s='.$s.'&amp;news='.$arr_newsItems['order'][$key].'&amp;cmd=trackback';
				$link = $tcms_main->urlAmpReplace($link);
				
				echo '&nbsp;|&nbsp;<a href="'.$link.'">'._NEWS_TRACKBACK.'</a>';
			}
			
			if($use_news_comments == 1){
				if($arr_newsItems['cmt'][$key] == 1){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;s='.$s.'&amp;news='.$arr_newsItems['order'][$key];
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '&nbsp;|&nbsp;<a href="'.$link.'#comments">'.$nw_amount.' '.( $nw_amount == 1 ? _FRONT_COMMENT : _FRONT_COMMENTS ).'</a>';
				}
			}
			
			echo '</span>';
			
			
			/*
				show the news
			*/
			echo '<br />';
			echo '<br />';
			echo '<div class="news_content_box">';
			
			$news_content = $arr_newsItems['news'][$key];
			
			$toendaScript = new toendaScript($news_content);
			$news_content = $toendaScript->toendaScript_trigger();
			$news_content = $toendaScript->checkSEO($news_content, $imagePath);
			
			$check_news_content = $toendaScript->toendaScript_more($news_content);
			
			if($check_news_content == true){
				$news_pos = $toendaScript->toendaScript_more($news_content, 'pos');
				$news_content = $toendaScript->toendaScript_more($news_content, 'text');
				$news_text = substr($news_content, 0, $news_pos);
				$news_text = trim($news_text);
				echo $news_text;
				$toendaScript_more_show = true;
			}
			else{
				$news_content = $toendaScript->toendaScript_more($news_content, 'text');
				
				if($cut_news == 0){
					$news_content = trim($news_content);
					echo $news_content;
					$toendaScript_more_show = false;
				}
				else{
					if(strlen($news_content) > $cut_news){
						$str_off = strpos($news_content, ' ', $cut_news);
						$news_text = substr($news_content, 0, $str_off);
						$news_text = trim($news_text);
						echo $news_text.' ...';
						$toendaScript_more_show = true;
					}
					elseif(strlen($news_content) < $cut_news){
						$news_content = trim($news_content);
						echo $news_content;
						$toendaScript_more_show = false;
					}
				}
			}
			
			if($toendaScript_more_show){
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;s='.$s.'&amp;news='.$arr_newsItems['order'][$key];
				$link = $tcms_main->urlAmpReplace($link);
				
				switch($readmore_link){
					case 0: //--> new line - left align
						echo '<br />'
						.'<a href="'.$link.'">'
						._FRONT_MORE.'&nbsp;&raquo;</a>';
						break;
					
					case 1: //--> new line - right align
						echo '<div align="right">'
						.'<a href="'.$link.'">'
						._FRONT_MORE.'&nbsp;&raquo;</a>'
						.'</div>';
						break;
					
					case 2: //--> self line - after text
						echo '&nbsp;<a href="'.$link.'">'
						._FRONT_MORE.'&nbsp;&raquo;</a>';
						break;
				}
			}
			
			echo '</div>'
			.'</div>'
			.'<br />';
			
			
			unset($catLink);
			
			echo $hr_line_2
			.'<br />';
		}
	}
}







/*******************************************
*
* Archive
*
*/
if($news != 'start' && $cmd != 'comment_save'){
	if($news == 'archive'){
		if($cmd != 'category'){
			$arrNewsDC = $tcms_dcp->getNewsDCList($is_admin, 0);
			
			echo '<table cellpadding="0" cellspacing="0" border="0" width="100%">';
			echo '<tr>'
				.'<th class="titleBG" valign="top" align="left" width="30%" colspan="2">&nbsp;'._DOWNLOADS_SUBMIT_ON.'</th>'
				.'<th class="titleBG" valign="top" align="left" width="70%">&nbsp;'._TABLE_TITLE.'</th><tr>';
			
			$sortPoint = false;
			
			if(!empty($arrNewsDC) && $arrNewsDC != '' && isset($arrNewsDC)){
				foreach($arrNewsDC as $n_key => $n_value){
					$dcNews = new tcms_dc_news();
					$dcNews = $arrNewsDC[$n_key];
					
					$sortDay   = substr($dcNews->GetDate(), 0, 2);
					$sortMonth = substr($dcNews->GetDate(), 3, 2);
					$sortYear  = substr($dcNews->GetDate(), 6, 4);
					
					if(isset($sortLastYear)){
						if($sortLastYear != $sortYear){ $sortPoint = false; }
					}
					
					if(isset($sortLastMonth)){
						if($sortLastMonth != $sortMonth){ $sortPoint = false; }
					}
					
					if($sortPoint == false){
						if(substr($sortMonth, 0, 1) == '0'){ $sortMonth = substr($sortMonth, 1, 1); }
						
						echo '<tr style="height: 18px;"><td colspan="3"></td></tr>';
						echo '<tr><td colspan="3" style="padding-left: 3px;">'
						.'<strong class="text_big">'.$monthName[$sortMonth].'&nbsp;'.$sortYear.'</strong>'
						.'</td></tr>';
						
						$sortPoint = true;
						$sortLastYear = $sortYear;
						$sortLastMonth = $sortMonth;
					}
					
					echo '<tr class="news_content_bg">';
					
					echo '<td valign="top" style="padding-left: 10px;">&nbsp;</td>';
					
					echo '<td valign="top">'
					.lang_date(substr($dcNews->GetDate(), 0, 2), substr($dcNews->GetDate(), 3, 2), substr($dcNews->GetDate(), 6, 4), substr($dcNews->GetTime(), 0, 2), substr($dcNews->GetTime(), 3, 2), '')
					.'</td>';
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'&amp;news='.$dcNews->GetID();
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<td valign="top">'.( $dcNews->GetTitle() == '' ? '' : '<a href="'.$link.'">'.$dcNews->GetTitle().'</a>' ).'</td>';
					
					echo '</tr>';
				}
			}
		}
		elseif($cmd == 'category'){
			if($choosenDB == 'xml'){
				if(!empty($arr_news) && $arr_news != '' && isset($arr_news)){
					$arr_cat_files = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_news_categories/');
					
					$count = 0;
					
					if(!empty($arr_cat_files) && $arr_cat_files != '' && isset($arr_cat_files)){
						foreach($arr_cat_files as $Ckey => $Cvalue){
							$cat_xml = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$Cvalue,'r');
							
							$this_cat_name = $cat_xml->read_section('cat', 'name');
							$this_cat_uid = substr($Cvalue, 0, 5);
							
							$this_cat_name = $tcms_main->decodeText($this_cat_name, '2', $c_charset);
							
							
							foreach($arr_news as $key => $value){
								$main_xml = new xmlparser($tcms_administer_site.'/tcms_news/'.$value,'r');
								$checkCat = $main_xml->read_section('news', 'category');
								$arrCat = explode('{###}', $checkCat);
								
								if(in_array($this_cat_uid, $arrCat)){
									$is_pub   = $main_xml->read_section('news', 'published');
									$is_date  = $main_xml->read_section('news', 'publish_date');
									$nws_acc  = $main_xml->read_section('news', 'access');
									
									if($nws_acc == 'Public'){ $show_this_news = true; }
									elseif($nws_acc == 'Protected'){
										if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){ $show_this_news = true; }
										else{ $show_this_news = false; }
									}
									elseif($nws_acc == 'Private'){
										if($is_admin == 'Administrator' || $is_admin == 'Developer'){ $show_this_news = true; }
										else{ $show_this_news = false; }
									}
									
									if($show_this_news == true){
										$is_date = mktime(substr($is_date, 11, 2), substr($is_date, 14, 2), 0, substr($is_date, 3, 2), substr($is_date, 0, 2), substr($is_date, 6, 4));
										
										if($is_pub == 1 && $is_date < time()){
											$arr_newsItems['categ'][$count] = $this_cat_name;
											$arr_newsItems['title'][$count] = $main_xml->read_section('news', 'title');
											$arr_newsItems['date'][$count]  = $main_xml->read_section('news', 'date');
											$arr_newsItems['time'][$count]  = $main_xml->read_section('news', 'time');
											$arr_newsItems['order'][$count] = $main_xml->read_section('news', 'order');
											$arr_newsItems['stamp'][$count] = $main_xml->read_section('news', 'stamp');
											
											if(!$arr_newsItems['title'][$count]){ $arr_newsItems['title'][$count] = ''; }
											if(!$arr_newsItems['date'][$count]) { $arr_newsItems['date'][$count]  = ''; }
											if(!$arr_newsItems['time'][$count]) { $arr_newsItems['time'][$count]  = ''; }
											if(!$arr_newsItems['order'][$count]){ $arr_newsItems['order'][$count] = ''; }
											if(!$arr_newsItems['stamp'][$count]){ $arr_newsItems['stamp'][$count] = ''; }
											
											$arr_newsItems['title'][$count] = $tcms_main->decodeText($arr_newsItems['title'][$count], '2', $c_charset);
											
											$count++;
										}
									}
								}
							}
						}
					}
				}
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$authSQL = '';
				
				
				if($check_session){
					if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){
						$authSQL = "OR ".$tcms_db_prefix."news.access = 'Protected' ";
					}
					if($is_admin == 'Administrator' || $is_admin == 'Developer'){
						$authSQL = "OR ".$tcms_db_prefix."news.access = 'Protected' OR ".$tcms_db_prefix."news.access = 'Private' ";
					}
				}
				
				
				$strSQL = "SELECT * "
				."FROM ".$tcms_db_prefix."news_categories "
				."ORDER BY name";
				
				$sqlQR = $sqlAL->sqlQuery($strSQL);
				$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
				
				$count = 0;
				
				if($sqlNR != 0){
					while($sqlARRnc = $sqlAL->sqlFetchArray($sqlQR)){
						$sqlStr = "SELECT * "
						."FROM ".$tcms_db_prefix."news_to_categories "
						."INNER JOIN ".$tcms_db_prefix."news ON (".$tcms_db_prefix."news_to_categories.news_uid = ".$tcms_db_prefix."news.uid) "
						."WHERE ".$tcms_db_prefix."news_to_categories.cat_uid = '".$sqlARRnc['uid']."' "
						."AND ".$tcms_db_prefix."news.published = 1 "
						."AND ".$tcms_db_prefix."news.access = 'Public' ".$authSQL
						."ORDER BY ".$tcms_db_prefix."news.stamp DESC, ".$tcms_db_prefix."news.date DESC, ".$tcms_db_prefix."news.time DESC";
						
						$sqlQR2 = $sqlAL->sqlQuery($sqlStr);
						$sqlNR2 = $sqlAL->sqlGetNumber($sqlQR2);
						
						if($sqlNR2 != 0){
							while($sqlARR = $sqlAL->sqlFetchArray($sqlQR2)){
								$is_date = $sqlARR['publish_date'];
								$nws_acc = $sqlARR['access'];
								
								if($nws_acc == 'Public'){ $show_this_news = true; }
								elseif($nws_acc == 'Protected'){
									if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){ $show_this_news = true; }
									else{ $show_this_news = false; }
								}
								elseif($nws_acc == 'Private'){
									if($is_admin == 'Administrator' || $is_admin == 'Developer'){ $show_this_news = true; }
									else{ $show_this_news = false; }
								}
								
								if($show_this_news == true){
									$is_date = mktime(substr($is_date, 11, 2), substr($is_date, 14, 2), 0, substr($is_date, 3, 2), substr($is_date, 0, 2), substr($is_date, 6, 4));
									
									if($is_date < time()){
										$arr_newsItems['categ'][$count] = $sqlARRnc['name'];
										$arr_newsItems['title'][$count] = $sqlARR['title'];
										$arr_newsItems['date'][$count]  = $sqlARR['date'];
										$arr_newsItems['time'][$count]  = $sqlARR['time'];
										$arr_newsItems['order'][$count] = $sqlARR['uid'];
										$arr_newsItems['stamp'][$count] = $sqlARR['stamp'];
										
										if($arr_newsItems['categ'][$count] == NULL){ $arr_newsItems['categ'][$count] = ''; }
										if($arr_newsItems['title'][$count] == NULL){ $arr_newsItems['title'][$count] = ''; }
										if($arr_newsItems['date'][$count]  == NULL){ $arr_newsItems['date'][$count]  = ''; }
										if($arr_newsItems['time'][$count]  == NULL){ $arr_newsItems['time'][$count]  = ''; }
										if($arr_newsItems['order'][$count] == NULL){ $arr_newsItems['order'][$count] = ''; }
										if($arr_newsItems['stamp'][$count] == NULL){ $arr_newsItems['stamp'][$count] = ''; }
										
										$arr_newsItems['title'][$count] = $tcms_main->decodeText($arr_newsItems['title'][$count], '2', $c_charset);
										
										$count++;
									}
								}
							}
						}
						
						$sqlAL->sqlFreeResult($sqlQR2);
					}
					
					$sqlAL->sqlFreeResult($sqlQR);
				}
			}
			
			if(is_array($arr_newsItems['stamp'])){
				array_multisort(
					$arr_newsItems['categ'], SORT_DESC, 
					$arr_newsItems['stamp'], SORT_DESC, 
					$arr_newsItems['date'], SORT_DESC, 
					$arr_newsItems['time'], SORT_DESC, 
					$arr_newsItems['title'], SORT_DESC, 
					$arr_newsItems['order'], SORT_DESC
				);
			}
			
			echo '<table cellpadding="0" cellspacing="0" border="0" width="100%">';
			echo '<tr>'
				.'<th class="titleBG" valign="top" align="left" width="30%" colspan="2">&nbsp;'._DOWNLOADS_SUBMIT_ON.'</th>'
				.'<th class="titleBG" valign="top" align="left" width="70%">&nbsp;'._TABLE_TITLE.'</th><tr>';
			
			$sortPoint = false;
			
			if(!empty($arr_newsItems['stamp']) && $arr_newsItems['stamp'] != '' && isset($arr_newsItems['stamp'])){
				foreach ($arr_newsItems['stamp'] as $key => $value){
					if($arr_newsItems['categ'][$key] != $arr_newsItems['categ'][$key - 1]){
						$sortPoint = false;
					}
					
					if($sortPoint == false){
						echo '<tr style="height: 18px;"><td colspan="3"></td></tr>';
						echo '<tr><td colspan="3" style="padding-left: 3px;">'
						.'<strong class="text_big">'.$arr_newsItems['categ'][$key].'</strong>'
						.'</td></tr>';
						$sortPoint = true;
					}
					
					echo '<tr class="news_content_bg">';
					
					echo '<td valign="top" style="padding-left: 10px;">&nbsp;</td>';
					
					echo '<td valign="top">'
					.lang_date(substr($arr_newsItems['date'][$key], 0, 2), substr($arr_newsItems['date'][$key], 3, 2), substr($arr_newsItems['date'][$key], 6, 4), substr($arr_newsItems['time'][$key], 0, 2), substr($arr_newsItems['time'][$key], 3, 2), '')
					.'</td>';
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'&amp;news='.$arr_newsItems['order'][$key];
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<td valign="top">'.( empty($arr_newsItems['title'][$key]) ? '' : '<a href="'.$link.'">'.$arr_newsItems['title'][$key].'</a>' ).'</td>';
					
					echo '</tr>';
				}
			}
		}
		
		echo '</table><br /><br />';
		
		
		/*
			TAB
		*/
		echo '<div style="display: block; float: left; padding-right: 5px;">';
		$link = '?'.( isset($session) ? 'session='.$session.'&' : '' ).'id=newsmanager&s='.$s;
		$link = $tcms_main->urlAmpReplace($link);
		echo '<input class="inputbutton" type="button" onclick="document.location=\''.$link.'\';" value="'._NEWS_ARCHIVE.' ('._NEWS_LAST.' '.$news_amount.')" />';
		echo '</div>';
		
		
		echo '<div style="display: block; float: left; padding-right: 5px;">';
		$link = '?'.( isset($session) ? 'session='.$session.'&' : '' ).'id=newsmanager&s='.$s.'&news=archive';
		$link = $tcms_main->urlAmpReplace($link);
		echo '<input class="inputbutton" type="button" onclick="document.location=\''.$link.'\';" value="'._NEWS_ARCHIVE.' ('._NEWS_ORDER_BY_TIME.')" />';
		echo '</div>';
		
		
		$link = '?'.( isset($session) ? 'session='.$session.'&' : '' ).'id=newsmanager&s='.$s.'&news=archive&cmd=category';
		$link = $tcms_main->urlAmpReplace($link);
		echo '<input class="inputbutton" type="button" onclick="document.location=\''.$link.'\';" value="'._NEWS_ARCHIVE.' ('._NEWS_ORDER_BY_CAT.')" />';
	}
}











//******************************************
// DELETE COMMENT
//

if($check_session){
	if($is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Presenter'){
		if($cmd == 'delete'){
			//*****************************************
			
			if($choosenDB == 'xml'){ unlink($tcms_administer_site.'/tcms_news/comments_'.$XMLplace.'/'.$XMLfile); }
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$strSQL = "DELETE FROM '.$tcms_db_prefix.'comments WHERE module='news' AND uid = '".$XMLplace."' AND timestamp = '".$XMLfile."'";
				
				$sqlAL->sqlQuery($strSQL);
			}
			
			$link = '?'.( isset($session) ? 'session='.$session.'&' : '' ).'id='.$id.'&s='.$s.'&news='.$XMLplace;
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<script>
			document.location=\''.$link.'\';
			alert(\''._MSG_DELETE.'\');
			</script>';
			
			//*****************************************
		}
	}
}


?>
