<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Frontpage
|
| File:		ext_frontpage.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Frontpage
 *
 * This module provides a frontpage with news and a text.
 *
 * @version 1.3.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


if(isset($_GET['save'])){ $save = $_GET['save']; }
if(isset($_GET['news'])){ $news = $_GET['news']; }
if(isset($_GET['cmd'])){ $cmd = $_GET['cmd']; }
if(isset($_GET['XMLplace'])){ $XMLplace = $_GET['XMLplace']; }
if(isset($_GET['XMLfile'])){ $XMLfile = $_GET['XMLfile']; }

if(isset($_POST['news'])){ $news = $_POST['news']; }
if(isset($_POST['cmd'])){ $cmd = $_POST['cmd']; }
if(isset($_POST['comment_name'])){ $comment_name = $_POST['comment_name']; }
if(isset($_POST['comment_email'])){ $comment_email = $_POST['comment_email']; }
if(isset($_POST['comment_web'])){ $comment_web = $_POST['comment_web']; }
if(isset($_POST['comment_text'])){ $comment_text = $_POST['comment_text']; }



/*
	INIT
*/

$getLang = $tcms_config->getLanguageCodeForTCMS($lang);

$toendaScript_more_show = false;

if(!isset($cmd)) $cmd = '';

using('toendacms.datacontainer.news');
using('toendacms.datacontainer.comment');
using('toendacms.datacontainer.account');

$hr_line_1 = '<tr class="hr_line"><td colspan="2"></td></tr>';
$hr_line_2 = '<tr style="height: 15px;"><td colspan="2"><br /><br /></td></tr>';
$hr_line_3 = '<hr class="hr_line" noshade="noshade" />';
$hr_line_4 = '<div style="height: '.$news_spacing.'px;">&nbsp;</div>';




/*
	LOAD
*/

if(!isset($show)){ $show = 'start'; }

if($show == 'start' && $cmd != 'comment' && $cmd != 'comment_save'){
	echo $tcms_html->contentModuleHeader($front_title, $front_stamp, $front_text);
	
	
	/*
		LOAD NEWS
	*/
	
	if($how_many != 0){
		if($front_news_title != ''){
			echo $tcms_html->contentTitle($front_news_title)
			.'<hr class="hr_line" />'
			.'<br />';
		}
		
		$arrNewsDC = $tcms_dcp->getNewsDCList($getLang, $is_admin, $how_many, '1', true);
		
		
		/*
			display news
		*/
		if(!empty($arrNewsDC) && $arrNewsDC != '' && isset($arrNewsDC)){
			foreach($arrNewsDC as $n_key => $n_value){
				$dcNews = new tcms_dc_news();
				$dcNews = $arrNewsDC[$n_key];
				
				
				if(($check_session && $canEdit)
				&& (($dcNews->GetAutor() == $ws_name)
				|| ($dcNews->GetAutor() == $ws_user))){
					$link = ( $seoFolder == '' ? '' : $seoFolder.'/' ).'engine/admin/admin.php?id_user='.$session.'&amp;site=mod_news&amp;todo=edit&amp;maintag='.$dcNews->GetID();
					
					echo '<div style="display: block; float: right;">';
					
					echo '<a href="'.$link.'" />';
					
					echo '<script>if(browser == \'ie\'){'
					.'document.write(\'<img alt="'._NEWS_EDIT_CURRENT.'" title="'._NEWS_EDIT_CURRENT.'" style="" src="'.$imagePath.'engine/images/pencil.gif" border="0" />\');'
					.'}else{'
					.'document.write(\'<img alt="'._NEWS_EDIT_CURRENT.'" title="'._NEWS_EDIT_CURRENT.'" style="padding-bottom: 0px; padding-top: 1px;" src="'.$imagePath.'engine/images/pencil.png" border="0" />\');'
					.'}</script>';
					
					echo '<noscript>'
					.'<img alt="'._NEWS_EDIT_CURRENT.'" title="'._NEWS_EDIT_CURRENT.'" style="" src="'.$imagePath.'engine/images/pencil.gif" border="0" />'
					.'</noscript>';
					
					echo '</a>';
					
					echo '</div>';
				}
				
				
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id=newsmanager&amp;s='.$s.'&amp;news='.$dcNews->GetID()
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlAmpReplace($link);
				
				echo '<div style="width: 100%;" class="news_title_bg">'
				.'<strong class="text_huge">'
				.'<a href="'.$link.'">'
				.$dcNews->GetTitle()
				.'</a>'
				.'</strong>'
				.'</div>';
				
				
				echo '<div style="padding-top: 5px;" class="news_content_bg">'
				.'<span class="text_small">';
				
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
						
						echo $tcms_blogfeatures->timeSince($timestamp);
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
						echo ' '.$tcms_blogfeatures->timeOfDay(substr($dcNews->GetTime(), 0, 2));
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
				
				/*
					the amount of comments
				*/
				if($use_news_comments == 1){
					if($dcNews->GetCommentsEnabled() == 1){
						$nw_amount = $tcms_dcp->getCommentDCList($dcNews->GetID(), 'news', false);
					}
				}
				
				
				/*
					get user id
					and the categories
				*/
				if($choosenDB == 'xml'){
					if($show_autor_as_link == 1)
						$userID = $tcms_main->getUserID($dcNews->GetAutor());
					
					
					/*
						load categories from xml
					*/
					if($dcNews->GetCategories() != ''){
						if(strpos($dcNews->GetCategories(), '{###}')){
							$catLinkTmp = explode('{###}', $dcNews->GetCategories());
							
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
							$catXML = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$dcNews->GetCategories().'.xml','r');
							
							$catLink['name'][0] = $catXML->read_section('cat', 'name');
							
							$catLink['name'][0] = $tcms_main->decodeText($catLink['name'][0], '2', $c_charset);
							
							$catLink['link'][0] = $dcNews->GetCategories();
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
					if($show_autor_as_link == 1)
						$userID = $tcms_main->getUserIDfromSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $dcNews->GetAutor());
					
					
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
						
						if($catLink['name'][0] == NULL) $catLink['name'][0] = '';
						
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
						if($dcNews->GetAutor() != ''){
							echo '&nbsp;'._NEWS_WRITTEN.'&nbsp;';
							
							if($userID != false){
								$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
								.'id=profile&amp;s='.$s.'&amp;u='.$userID
								.( isset($lang) ? '&amp;lang='.$lang : '' );
								$link = $tcms_main->urlAmpReplace($link);
								
								echo '<a href="'.$link.'">'
								.$dcNews->GetAutor().'</a>';
							}
							else{
								echo $dcNews->GetAutor();
							}
						}
					}
					else{
						echo '&nbsp;'._NEWS_WRITTEN.'&nbsp;'.$dcNews->GetAutor();
					}
				}
				
				if(!empty($catLink) && $catLink != ''){
					echo '&nbsp;'._NEWS_IN;
					
					foreach($catLink['link'] as $catKey => $catVal){
						if($catKey != 0){ echo ','; }
						
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=newsmanager&amp;s='.$s.'&amp;cat='.$catVal
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlAmpReplace($link);
						
						echo '&nbsp;<a href="'.$link.'">'
						.$catLink['name'][$catKey]
						.'</a>';
					}
				}
				
				if($use_trackback == 1){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=newsmanager&amp;s='.$s.'&amp;news='.$dcNews->GetID().'&amp;cmd=trackback'
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '&nbsp;|&nbsp;'
					.'<a href="'.$link.'">'._NEWS_TRACKBACK.'</a>';
				}
				
				if($use_news_comments == 1){
					if($dcNews->GetCommentsEnabled() == 1){
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=newsmanager&amp;s='.$s.'&amp;news='.$dcNews->GetID()
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlAmpReplace($link);
						
						echo '&nbsp;|&nbsp;'
						.'<a href="'.$link.'#comments">'
						.$nw_amount.' '.( $nw_amount == 1 ? _FRONT_COMMENT : _FRONT_COMMENTS ).'</a>';
					}
				}
				
				echo '</span>';
				
				
				/*
					show the news
				*/
				echo '<br />';
				echo '<br />';
				echo '<div class="news_content_box">';
				
				$news_content = $dcNews->GetText();
				
				$toendaScript = new toendaScript($news_content);
				$news_content = $toendaScript->doParse();
				$news_content = $toendaScript->checkSEO($news_content, $imagePath);
				
				$check_news_content = $toendaScript->toendaScript_more($news_content);
				
				if($check_news_content == true){
					$news_pos = $toendaScript->toendaScript_more($news_content, 'pos');
					$news_content = $toendaScript->toendaScript_more($news_content, 'text');
					$news = substr($news_content, 0, $news_pos);
					$news = trim($news);
					echo $news;
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
							$news = substr($news_content, 0, $str_off);
							$news = trim($news);
							echo $news.' ...';
							$toendaScript_more_show = true;
						}
						elseif(strlen($news_content) < $cut_news){
							$news_content = trim($news_content);
							echo $news_content;
							$toendaScript_more_show = false;
						}
					}
				}
				
				unset($toendaScript);
				
				if($toendaScript_more_show){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=newsmanager&amp;s='.$s.'&amp;news='.$dcNews->GetID()
					.( isset($lang) ? '&amp;lang='.$lang : '' );
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
				
				echo '</div></div>';
				echo '<br />';
				
				echo $hr_line_4;
				
				
				unset($catLink);
				unset($news_content);
				unset($dcNews);
			}
		}
		
		
		if(count($arrNewsDC) >= $how_many){
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id=newsmanager&amp;s='.$s
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<hr class="hr_line" /><div align="right">'
			.'<a href="'.$link.'">'._NEWS_ARCHIVE.' &raquo;</a>'
			.'</div>';
		}
	}
	
	
	if($use_syndication == 1){
		if($tcms_main->isReal($feed)){
			$tcms_dcp->generateFeed(
				$getLang, 
				$feed, 
				$seoFolder, 
				false, 
				$syn_amount, 
				$show_autor
			);
			
			if(isset($save) && $save == true){
				//$rss->saveFeed($feed, 'cache/'.$feed.'.xml', false);
				echo '<script>document.location=\''.$imagePath.'cache/'.$feed.'.xml\'</script>';
			}
			else{
				//$rss->saveFeed($feed, 'cache/'.$feed.'.xml', false);
			}
		}
	}
}


?>
