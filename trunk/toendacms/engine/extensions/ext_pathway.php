<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Pathway
|
| File:	ext_pathway.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Pathway
 *
 * This module is used as a pathway.
 *
 * @version 0.6.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content-Modules
 */


if(isset($_GET['albums'])) { $albums = $_GET['albums']; }
if(isset($_GET['action'])) { $action = $_GET['action']; }
if(isset($_GET['category'])) { $category = $_GET['category']; }
if(isset($_GET['article'])) { $article = $_GET['article']; }
if(isset($_GET['news'])) { $news = $_GET['news']; }
if(isset($_GET['cat'])) { $cat = $_GET['cat']; }
if(isset($_GET['cmd'])) { $cmd = $_GET['cmd']; }

if(isset($_POST['news'])) { $news = $_POST['news']; }
if(isset($_POST['cmd'])) { $cmd = $_POST['cmd']; }




if(!isset($action)) { $action = 'showall'; }
if(!isset($task)) { $task = 'register'; }



$_link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
//.'id='.$id
.'id=frontpage&amp;s='.$s
.( isset($lang) ? '&amp;lang='.$lang : '' );
$_link = $tcms_main->urlConvertToSEO($_link);

$_HOMEPATH = '<a class="pathway" href="'.$_link.'">'._PATH_HOME.'</a>';


switch($id) {
	case 'download':
		/*
			DOWNLOAD
		*/
		
		$dDC = new tcms_dc_download();
		$dDC = $tcms_dcp->getDownloadDC($getLang);
		
		echo $_HOMEPATH;
		
		if((!isset($category) || $category == '') && (!isset($file) || $file == '')) {
			echo '&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$dDC->getTitle().'</span>';
		}
		
		if(isset($category) || isset($file)) {
			if($choosenDB == 'xml') {
				$count = 0;
				
				if($category != '') {
					$xml = new xmlparser(_TCMS_PATH.'/files/'.$category.'/info.xml', 'r');
					
					//$access_cat = $down_xml->readSection('faq', 'access');
					
					$arrFAQparent['type'][$count] = $xml->readSection('info', 'sql_type');
					$arrFAQparent['pub'][$count]  = $xml->readSection('info', 'pub');
				}
				else {
					$arrFAQparent['type'][$count] = 'd';
					$arrFAQparent['pub'][$count]  = '1';
				}
				
				if($arrFAQparent['type'][$count] == 'd' && $arrFAQparent['pub'][$count] == '1') {
					if($category != '') {
						$arrFAQparent['title'][$count]  = $xml->readSection('info', 'name');
						$arrFAQparent['parent'][$count] = $xml->readSection('info', 'parent');
						$arrFAQparent['uid'][$count]    = substr($category, 0, 10);
						
						// CHARSETS
						$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
						
						$checkCat = $xml->readSection('info', 'cat');
						
						$xml->flush();
						
						$count++;
					}
					else {
						$arrFAQparent['title'][$count]  = '';
						$arrFAQparent['parent'][$count] = '';
						$arrFAQparent['uid'][$count]    = '';
						
						$checkCat = '';
					}
					
					while($checkCat != '') {
						$xml = new xmlparser(_TCMS_PATH.'/files/'.$arrFAQparent['parent'][$count - 1].'/info.xml', 'r');
						
						$checkCat = $xml->readSection('info', 'cat');
						$arrFAQparent['type'][$count]   = $xml->readSection('info', 'sql_type');
						$arrFAQparent['pub'][$count]    = $xml->readSection('info', 'pub');
						
						if($arrFAQparent['type'][$count] == 'd' && $arrFAQparent['pub'][$count] == '1') {
							$arrFAQparent['title'][$count]  = $xml->readSection('info', 'name');
							$arrFAQparent['parent'][$count] = $xml->readSection('info', 'parent');
							$arrFAQparent['uid'][$count]    = substr($arrFAQparent['parent'][$count - 1], 0, 10);
							
							$xml->flush();
							
							// CHARSETS
							$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
							
							//echo $count.' -> '.$arrFAQparent['parent'][$count].' -> '.$arrFAQparent['title'][$count].'<br>';
							
							$count++;
							$checkFAQTitle = $count;
						}
					}
				}
			}
			else {
				switch($is_admin) {
					case 'Developer':
					case 'Administrator':
						$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
						break;
					
					case 'User':
					case 'Editor':
					case 'Writer':
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
				
				$sqlQR = $tcms_dal->query($sqlSTRparent);
				$sqlNR = $tcms_dal->getNumber($sqlQR);
				
				//echo '<b>'.$sqlNR.'<br>'.$sqlSTRparent.'</b><br><br>';
				
				while($sqlNR > 0) {
					$sqlARR = $tcms_dal->fetchArray($sqlQR);
					
					unset($sqlQR);
					
					$arrFAQparent['title'][$count]  = $sqlARR['name'];
					$arrFAQparent['uid'][$count]    = $sqlARR['uid'];
					$arrFAQparent['parent'][$count] = $sqlARR['parent'];
					
					if($arrFAQparent['title'][$count]  == NULL) { $arrFAQparent['title'][$count]  = ''; }
					if($arrFAQparent['uid'][$count]    == NULL) { $arrFAQparent['uid'][$count]    = ''; }
					if($arrFAQparent['parent'][$count] == NULL) { $arrFAQparent['parent'][$count] = ''; }
					
					// CHARSETS
					$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
					
					$sqlSTRparent = "SELECT * "
					."FROM ".$tcms_db_prefix."downloads "
					."WHERE uid = '".$arrFAQparent['parent'][$count]."' "
					."AND ( access = 'Public' "
					.$strAdd;
					
					$sqlQR = $tcms_dal->query($sqlSTRparent);
					
					$sqlNR = $tcms_dal->getNumber($sqlQR);
					
					//echo $sqlNR.'<br>'.$sqlSTRparent.'<br><br>';
					
					$count++;
					$checkFAQTitle = $count;
				}
			}
			
			if(!isset($checkFAQTitle)) {
				$checkFAQTitle = 1;
			}
			
			echo '&nbsp;'.$pathwayChar.'&nbsp;';
			
			// list
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id=download&amp;s='.$s.'&amp;action=showall'
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<a class="pathway" href="'.$link.'">'.$dDC->getTitle().'</a>';
			
			
			for($i = ($checkFAQTitle - 1); $i >= 0; $i--) {
				echo '&nbsp;'.$pathwayChar.'&nbsp;';
				
				if($i != 0) {
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=download&amp;s='.$s.'&amp;action=showall&amp;category='.$arrFAQparent['uid'][$i]
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlConvertToSEO($link);
					
					echo '<a class="pathway" href="'.$link.'">'.$arrFAQparent['title'][$i].'</a>';
				}
				else {
					if(isset($article)) {
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=download&amp;s='.$s.'&amp;action=showall&amp;category='.$arrFAQparent['uid'][$i]
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlConvertToSEO($link);
						
						echo '<a class="pathway" href="'.$link.'">'.$arrFAQparent['title'][$i].'</a>';
						
						//echo '&nbsp;/&nbsp;';
					}
					else {
						echo $arrFAQparent['title'][$i];
					}
				}
			}
		}
		
		
		// file
		/*if(isset($file)) {
			if($arrParent['parent'] != null && $arrParent['parent'] != '') {
				echo '&nbsp;'.$pathwayChar.'&nbsp;';
			}
			
			echo '<span class="pathway">'.$file.'</a>';
		}*/
		
		
		unset($dDC);
		break;
	
	case $news_id:
		/*
			NEWS
		*/
		
		if(!isset($news) && !$cat && !isset($date)) {
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$pathway[$id].'</span>';
		}
		
		if(isset($news)) {
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;'.$arr_path[$id];
			
			if($news != 'archive') {
				if($choosenDB == 'xml') {
					$news_detail_xml = new xmlparser(_TCMS_PATH.'/tcms_news/'.$news.'.xml','r');
					$arr_news['title'] = $news_detail_xml->readSection('news', 'title');
					$arr_news['order'] = $news_detail_xml->readSection('news', 'order');
					
					$arr_news['title'] = $tcms_main->decodeText($arr_news['title'], '2', $c_charset);
				}
				else {
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->getOne($tcms_db_prefix.'news', $news);
					$sqlARR = $sqlAL->fetchArray($sqlQR);
					
					$arr_news['title'] = $sqlARR['title'];
					$arr_news['order'] = $sqlARR['uid'];
					
					$arr_news['title'] = $tcms_main->decodeText($arr_news['title'], '2', $c_charset);
				}
				
				echo '&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$arr_news['title'].'</span>';
			}
			
			if($news == 'archive')
				echo '&nbsp;'.$pathwayChar.'&nbsp;'._NEWS_ARCHIVE;
		}
		
		if(isset($date)) {
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;'.$arr_path[$id];
			
			if(strlen($date) == 6) {
				if(substr(substr($day, 4, 2), 0, 1) == '0')
					$ccMonth = substr(substr($date, 4, 2), 1, 1);
				else
					$ccMonth = substr($date, 4, 2);
				
				echo '&nbsp;'.$pathwayChar.'&nbsp;'._NEWS_ARCHIV_FOR.'&nbsp;'.$monthName[$ccMonth].',&nbsp;'.substr($date, 0, 4);
			}
			else {
				if(substr(substr($date, 4, 2), 0, 1) == '0') { $ccDay = substr(substr($date, 4, 2), 1, 1); }
				else { $ccDay = substr($date, 4, 2); }
				
				if(substr(substr($day, 4, 2), 0, 1) == '0') { $ccMonth = substr(substr($date, 4, 2), 1, 1); }
				else { $ccMonth = substr($date, 4, 2); }
				
				echo '&nbsp;'.$pathwayChar.'&nbsp;'._NEWS_ARCHIV_FOR.'&nbsp;'.$ccDay.'.&nbsp;'.$monthName[$ccMonth].',&nbsp;'.substr($date, 0, 4);
			}
		}
		
		if($cat) {
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;'.$arr_path[$id];
			
			if($choosenDB == 'xml') {
				$xmlP = new xmlparser(_TCMS_PATH.'/tcms_news_categories/'.$cat.'.xml', 'r');
				$catName = $xmlP->readSection('cat', 'name');
				
				$catName = $tcms_main->decodeText($catName, '2', $c_charset);
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'news_categories', $cat);
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				
				$catName = $sqlARR['name'];
				
				$catName = $tcms_main->decodeText($catName, '2', $c_charset);
			}
			
			echo '&nbsp;'.$pathwayChar.'&nbsp;'._NEWS_CATEGORY_ARCHIV.' \''.$catName.'\'';
		}
		break;
	
	case $image_id:
		/*
			IMAGEGALLERY
		*/
		
		if(!isset($albums)) {
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$pathway[$id].'</span>';
		}
		
		if(isset($albums)) {
			if($choosenDB == 'xml') {
				$album_xml   = new xmlparser(_TCMS_PATH.'/tcms_albums/album_'.$albums.'.xml', 'r');
				$album_title = $album_xml->readSection('album', 'title');
				
				$album_title = $tcms_main->decodeText($album_title, '2', $c_charset);
			}
			else {
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->query("SELECT * FROM ".$tcms_db_prefix."albums WHERE album_id='".$albums."'");
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				
				$album_title = $sqlARR['title'];
				
				$album_title = $tcms_main->decodeText($album_title, '2', $c_charset);
			}
			
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;'.$arr_path[$id].'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$album_title.'</span>';
		}
		break;
	
	case 'products':
		/*
			PRODUCTS
		*/
		
		echo $_HOMEPATH;
		
		$dcP = new tcms_dc_products();
		$dcP = $tcms_dcp->getProductsDC($getLang);
		
		if(!isset($category) && !isset($article)) {
			echo '&nbsp;'.$pathwayChar.'&nbsp;'
			.'<span class="pathway">'.$dcP->getTitle().'</span>';
		}
		
		if(isset($category) || isset($article)) {
			if(isset($article)) {
				if($choosenDB == 'xml') {
					/*$xml = new xmlparser(_TCMS_PATH.'/tcms_knowledgebase/'.$article.'.xml','r');
					
					//$access_cat = $down_xml->readSection('faq', 'access');
					
					$arrFAQparent['type'] = $xml->readSection('faq', 'type');
					$arrFAQparent['pub']  = $xml->readSection('faq', 'publish_state');
					
					if($arrFAQparent['type'] == 'a' && $arrFAQparent['pub'] == '2') {
						$arrFAQparent['title']  = $xml->readSection('faq', 'title');
						$arrFAQparent['parent'] = $xml->readSection('faq', 'parent');
						$arrFAQparent['uid']    = substr($category, 0, 10);
						
						$arrFAQparent['title'] = $tcms_main->decodeText($arrFAQparent['title'], '2', $c_charset);
						
						if($arrFAQparent['parent'] != false && $arrFAQparent['parent'] != '') {
							echo '&nbsp;'.$pathwayChar.'&nbsp;';
						}
						
						echo $arrFAQparent['title'];
					}*/
				}
				else {
					switch($is_admin) {
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
					."FROM ".$tcms_db_prefix."products "
					."WHERE uid = '".$article."' "
					."AND pub = 1 "
					."AND sql_type = 'a' "
					."AND ( access = 'Public' "
					.$strAdd;
					
					$count = 0;
					
					$sqlQR = $tcms_dal->query($sqlSTRparent);
					
					$sqlObj = $tcms_dal->fetchObject($sqlQR);
					
					$category = $sqlObj->category;
				}
			}
			
			if($choosenDB == 'xml') {
				/*$count = 0;
				
				if($category != '') {
					$xml = new xmlparser(_TCMS_PATH.'/tcms_knowledgebase/'.$category.'.xml','r');
					
					//$access_cat = $down_xml->readSection('faq', 'access');
					
					$arrFAQparent['type'][$count] = $xml->readSection('faq', 'type');
					$arrFAQparent['pub'][$count]  = $xml->readSection('faq', 'publish_state');
				}
				else {
					$arrFAQparent['type'][$count] = 'c';
					$arrFAQparent['pub'][$count]  = '2';
				}
				
				if($arrFAQparent['type'][$count] == 'c' && $arrFAQparent['pub'][$count] == '2') {
					if($category != '') {
						$arrFAQparent['title'][$count]  = $xml->readSection('faq', 'title');
						$arrFAQparent['parent'][$count] = $xml->readSection('faq', 'parent');
						$arrFAQparent['uid'][$count]    = substr($category, 0, 10);
						
						// CHARSETS
						$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
						
						$checkCat = $xml->readSection('faq', 'category');
						
						$count++;
					}
					else {
						$arrFAQparent['title'][$count]  = '';
						$arrFAQparent['parent'][$count] = '';
						$arrFAQparent['uid'][$count]    = '';
						
						$checkCat = '';
					}
					
					while($checkCat != '') {
						$xml = new xmlparser(_TCMS_PATH.'/tcms_knowledgebase/'.$arrFAQparent['parent'][$count - 1].'.xml','r');
						
						$checkCat = $xml->readSection('faq', 'category');
						$arrFAQparent['type'][$count]   = $xml->readSection('faq', 'type');
						$arrFAQparent['pub'][$count]    = $xml->readSection('faq', 'publish_state');
						
						if($arrFAQparent['type'][$count] == 'c' && $arrFAQparent['pub'][$count] == '2') {
							$arrFAQparent['title'][$count]  = $xml->readSection('faq', 'title');
							$arrFAQparent['parent'][$count] = $xml->readSection('faq', 'parent');
							$arrFAQparent['uid'][$count]    = substr($arrFAQparent['parent'][$count - 1], 0, 10);
							
							// CHARSETS
							$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
							
							//echo $count.' -> '.$arrFAQparent['parent'][$count].' -> '.$arrFAQparent['title'][$count].'<br>';
							
							$count++;
							$checkFAQTitle = $count;
						}
					}
				}*/
			}
			else {
				switch($is_admin) {
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
				."FROM ".$tcms_db_prefix."products "
				."WHERE uid = '".$category."' "
				."AND pub = 1 "
				."AND sql_type = 'c' "
				."AND ( access = 'Public' "
				.$strAdd;
				
				$count = 0;
				
				$sqlQR = $tcms_dal->query($sqlSTRparent);
				$sqlNR = $tcms_dal->getNumber($sqlQR);
				
				//echo '<b>'.$sqlNR.'<br>'.$sqlSTRparent.'</b><br><br>';
				
				while($sqlNR > 0) {
					$sqlObj = $tcms_dal->fetchObject($sqlQR);
					
					unset($sqlQR);
					
					$arrFAQparent['title'][$count]  = $sqlObj->name;
					$arrFAQparent['uid'][$count]    = $sqlObj->uid;
					$arrFAQparent['parent'][$count] = $sqlObj->category;
					
					if($arrFAQparent['title'][$count]  == NULL) { $arrFAQparent['title'][$count]  = ''; }
					if($arrFAQparent['uid'][$count]    == NULL) { $arrFAQparent['uid'][$count]    = ''; }
					if($arrFAQparent['parent'][$count] == NULL) { $arrFAQparent['parent'][$count] = ''; }
					
					// CHARSETS
					$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
					
					$sqlSTRparent = "SELECT * "
					."FROM ".$tcms_db_prefix."products "
					."WHERE uid = '".$arrFAQparent['parent'][$count]."' "
					."AND pub = 1 "
					."AND sql_type = 'c' "
					."AND ( access = 'Public' "
					.$strAdd;
					
					$sqlQR = $tcms_dal->query($sqlSTRparent);
					
					$sqlNR = $tcms_dal->getNumber($sqlQR);
					
					//echo $sqlNR.'<br>'.$sqlSTRparent.'<br><br>';
					
					$count++;
					$checkFAQTitle = $count;
				}
			}
			
			if(!isset($checkFAQTitle)) { $checkFAQTitle = 1; }
			
			
			echo '&nbsp;'.$pathwayChar.'&nbsp;';
			
			
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id=products&amp;s='.$s.'&amp;action=showall'
			.( isset($cmd) ? '&amp;cmd='.$cmd : '' )
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<a class="pathway" href="'.$link.'">'.$dcP->getTitle().'</a>';
			
			
			for($i = ($checkFAQTitle - 1); $i >= 0; $i--) {
				echo '&nbsp;'.$pathwayChar.'&nbsp;';
				
				if($i != 0) {
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=products&amp;s='.$s.'&amp;action=showall'
					.( isset($cmd) ? '&amp;cmd='.$cmd : '' )
					.'&amp;category='.$arrFAQparent['uid'][$i]
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlConvertToSEO($link);
					
					echo '<a class="pathway" href="'.$link.'">'.$arrFAQparent['title'][$i].'</a>';
				}
				else {
					if(isset($article)) {
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=products&amp;s='.$s.'&amp;action=showall'
						.( isset($cmd) ? '&amp;cmd='.$cmd : '' )
						.'&amp;category='.$arrFAQparent['uid'][$i]
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlConvertToSEO($link);
						
						echo '<a class="pathway" href="'.$link.'">'.$arrFAQparent['title'][$i].'</a>';
						
						//echo '&nbsp;/&nbsp;';
					}
					else {
						echo $arrFAQparent['title'][$i];
					}
				}
			}
		}
		
		if(isset($article)) {
			if($choosenDB == 'xml') {
				/*$xml = new xmlparser(_TCMS_PATH.'/tcms_knowledgebase/'.$article.'.xml','r');
				
				//$access_cat = $down_xml->readSection('faq', 'access');
				
				$arrFAQparent['type'] = $xml->readSection('faq', 'type');
				$arrFAQparent['pub']  = $xml->readSection('faq', 'publish_state');
				
				if($arrFAQparent['type'] == 'a' && $arrFAQparent['pub'] == '2') {
					$arrFAQparent['title']  = $xml->readSection('faq', 'title');
					$arrFAQparent['parent'] = $xml->readSection('faq', 'parent');
					$arrFAQparent['uid']    = substr($category, 0, 10);
					
					$arrFAQparent['title'] = $tcms_main->decodeText($arrFAQparent['title'], '2', $c_charset);
					
					if($arrFAQparent['parent'] != false && $arrFAQparent['parent'] != '') {
						echo '&nbsp;'.$pathwayChar.'&nbsp;';
					}
					
					echo $arrFAQparent['title'];
				}*/
			}
			else {
				switch($is_admin) {
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
				."FROM ".$tcms_db_prefix."products "
				."WHERE uid = '".$article."' "
				."AND pub = 1 "
				."AND sql_type = 'a' "
				."AND ( access = 'Public' "
				.$strAdd;
				
				$count = 0;
				
				$sqlQR = $tcms_dal->query($sqlSTRparent);
				
				$sqlObj = $tcms_dal->fetchObject($sqlQR);
				
				$arrFAQparent['title']  = $sqlObj->name;
				$arrFAQparent['parent'] = $sqlObj->category;
				
				if($arrFAQparent['title']  == NULL) { $arrFAQparent['title']  = ''; }
				if($arrFAQparent['parent'] == NULL) { $arrFAQparent['parent'] = ''; }
				
				// CHARSETS
				$arrFAQparent['title'] = $tcms_main->decodeText($arrFAQparent['title'], '2', $c_charset);
				
				if($arrFAQparent['parent'] != null && $arrFAQparent['parent'] != '') {
					echo '&nbsp;'.$pathwayChar.'&nbsp;';
				}
				
				echo $arrFAQparent['title'];
			}
		}
		
		unset($dcP);
		break;
	
	case 'knowledgebase':
		/*
			KNOWLEDGEBASE
		*/
		
		$kDC = new tcms_dc_knowledgebase();
		$kDC = $tcms_dcp->getKnowledgebaseDC($getLang);
		
		echo $_HOMEPATH;
		
		if(!isset($category) && !isset($article)) {
			echo '&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$kDC->getTitle().'</span>';
		}
		
		if(isset($category) || isset($article)) {
			if($choosenDB == 'xml') {
				$count = 0;
				
				if($category != '') {
					$xml = new xmlparser(_TCMS_PATH.'/tcms_knowledgebase/'.$category.'.xml','r');
					
					//$access_cat = $down_xml->readSection('faq', 'access');
					
					$arrFAQparent['type'][$count] = $xml->readSection('faq', 'type');
					$arrFAQparent['pub'][$count]  = $xml->readSection('faq', 'publish_state');
				}
				else {
					$arrFAQparent['type'][$count] = 'c';
					$arrFAQparent['pub'][$count]  = '2';
				}
				
				if($arrFAQparent['type'][$count] == 'c' && $arrFAQparent['pub'][$count] == '2') {
					if($category != '') {
						$arrFAQparent['title'][$count]  = $xml->readSection('faq', 'title');
						$arrFAQparent['parent'][$count] = $xml->readSection('faq', 'parent');
						$arrFAQparent['uid'][$count]    = substr($category, 0, 10);
						
						// CHARSETS
						$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
						
						$checkCat = $xml->readSection('faq', 'category');
						
						$count++;
					}
					else {
						$arrFAQparent['title'][$count]  = '';
						$arrFAQparent['parent'][$count] = '';
						$arrFAQparent['uid'][$count]    = '';
						
						$checkCat = '';
					}
					
					while($checkCat != '') {
						$xml = new xmlparser(_TCMS_PATH.'/tcms_knowledgebase/'.$arrFAQparent['parent'][$count - 1].'.xml','r');
						
						$checkCat = $xml->readSection('faq', 'category');
						$arrFAQparent['type'][$count]   = $xml->readSection('faq', 'type');
						$arrFAQparent['pub'][$count]    = $xml->readSection('faq', 'publish_state');
						
						if($arrFAQparent['type'][$count] == 'c' && $arrFAQparent['pub'][$count] == '2') {
							$arrFAQparent['title'][$count]  = $xml->readSection('faq', 'title');
							$arrFAQparent['parent'][$count] = $xml->readSection('faq', 'parent');
							$arrFAQparent['uid'][$count]    = substr($arrFAQparent['parent'][$count - 1], 0, 10);
							
							// CHARSETS
							$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
							
							//echo $count.' -> '.$arrFAQparent['parent'][$count].' -> '.$arrFAQparent['title'][$count].'<br>';
							
							$count++;
							$checkFAQTitle = $count;
						}
					}
				}
			}
			else {
				switch($is_admin) {
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
				."FROM ".$tcms_db_prefix."knowledgebase "
				."WHERE uid = '".$category."' "
				."AND publish_state = 2 "
				."AND type = 'c' "
				."AND ( access = 'Public' "
				.$strAdd;
				
				$count = 0;
				
				$sqlQR = $tcms_dal->query($sqlSTRparent);
				$sqlNR = $tcms_dal->getNumber($sqlQR);
				
				//echo '<b>'.$sqlNR.'<br>'.$sqlSTRparent.'</b><br><br>';
				
				while($sqlNR > 0) {
					$sqlARR = $tcms_dal->fetchArray($sqlQR);
					
					unset($sqlQR);
					
					$arrFAQparent['title'][$count]  = $sqlARR['title'];
					$arrFAQparent['uid'][$count]    = $sqlARR['uid'];
					$arrFAQparent['parent'][$count] = $sqlARR['parent'];
					
					if($arrFAQparent['title'][$count]  == NULL) { $arrFAQparent['title'][$count]  = ''; }
					if($arrFAQparent['uid'][$count]    == NULL) { $arrFAQparent['uid'][$count]    = ''; }
					if($arrFAQparent['parent'][$count] == NULL) { $arrFAQparent['parent'][$count] = ''; }
					
					// CHARSETS
					$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
					
					$sqlSTRparent = "SELECT * "
					."FROM ".$tcms_db_prefix."knowledgebase "
					."WHERE uid = '".$arrFAQparent['parent'][$count]."' "
					."AND publish_state = 2 "
					."AND type = 'c' "
					."AND ( access = 'Public' "
					.$strAdd;
					
					$sqlQR = $tcms_dal->query($sqlSTRparent);
					
					$sqlNR = $tcms_dal->getNumber($sqlQR);
					
					//echo $sqlNR.'<br>'.$sqlSTRparent.'<br><br>';
					
					$count++;
					$checkFAQTitle = $count;
				}
			}
			
			if(!isset($checkFAQTitle)) { $checkFAQTitle = 1; }
			
			
			echo '&nbsp;'.$pathwayChar.'&nbsp;';
			
			
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id=knowledgebase&amp;s='.$s.'&amp;action=list'
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<a class="pathway" href="'.$link.'">'.$kDC->getTitle().'</a>';
			
			
			for($i = ($checkFAQTitle - 1); $i >= 0; $i--) {
				echo '&nbsp;'.$pathwayChar.'&nbsp;';
				
				if($i != 0) {
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=knowledgebase&amp;s='.$s.'&amp;action=list&amp;category='.$arrFAQparent['uid'][$i]
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlConvertToSEO($link);
					
					echo '<a class="pathway" href="'.$link.'">'.$arrFAQparent['title'][$i].'</a>';
				}
				else {
					if(isset($article)) {
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=knowledgebase&amp;s='.$s.'&amp;action=list&amp;category='.$arrFAQparent['uid'][$i]
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlConvertToSEO($link);
						
						echo '<a class="pathway" href="'.$link.'">'.$arrFAQparent['title'][$i].'</a>';
						
						//echo '&nbsp;/&nbsp;';
					}
					else {
						echo $arrFAQparent['title'][$i];
					}
				}
			}
		}
		
		if(isset($article)) {
			if($choosenDB == 'xml') {
				$xml = new xmlparser(_TCMS_PATH.'/tcms_knowledgebase/'.$article.'.xml','r');
				
				//$access_cat = $down_xml->readSection('faq', 'access');
				
				$arrFAQparent['type'] = $xml->readSection('faq', 'type');
				$arrFAQparent['pub']  = $xml->readSection('faq', 'publish_state');
				
				if($arrFAQparent['type'] == 'a' && $arrFAQparent['pub'] == '2') {
					$arrFAQparent['title']  = $xml->readSection('faq', 'title');
					$arrFAQparent['parent'] = $xml->readSection('faq', 'parent');
					$arrFAQparent['uid']    = substr($category, 0, 10);
					
					$arrFAQparent['title'] = $tcms_main->decodeText($arrFAQparent['title'], '2', $c_charset);
					
					if($arrFAQparent['parent'] != false && $arrFAQparent['parent'] != '') {
						echo '&nbsp;'.$pathwayChar.'&nbsp;';
					}
					
					echo $arrFAQparent['title'];
				}
			}
			else {
				switch($is_admin) {
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
				."FROM ".$tcms_db_prefix."knowledgebase "
				."WHERE uid = '".$article."' "
				."AND publish_state = 2 "
				."AND type = 'a' "
				."AND ( access = 'Public' "
				.$strAdd;
				
				$count = 0;
				
				$sqlQR = $tcms_dal->query($sqlSTRparent);
				
				$sqlARR = $tcms_dal->fetchArray($sqlQR);
				
				$arrFAQparent['title']  = $sqlARR['title'];
				$arrFAQparent['parent'] = $sqlARR['parent'];
				
				if($arrFAQparent['title']  == NULL) { $arrFAQparent['title']  = ''; }
				if($arrFAQparent['parent'] == NULL) { $arrFAQparent['parent'] = ''; }
				
				// CHARSETS
				$arrFAQparent['title'] = $tcms_main->decodeText($arrFAQparent['title'], '2', $c_charset);
				
				if($arrFAQparent['parent'] != null && $arrFAQparent['parent'] != '') {
					echo '&nbsp;'.$pathwayChar.'&nbsp;';
				}
				
				echo $arrFAQparent['title'];
			}
		}
		break;
	
	case 'register':
		/*
			REGISTER
		*/
		
		if($cmd == 'lostpassword')
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'._PATH_LOSTPW.'</span>';
		else
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'._PATH_REGISTRATION.'</span>';
		break;
	
	case 'profile':
		/*
			PROFILE
		*/
		
		echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'._PATH_PROFILE.'</span>';
		break;
	
	case 'search':
		/*
			SEARCH
		*/
		
		echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'._PATH_SEARCH.'</span>';
		break;
	
	case 'links':
		/*
			LINKS
		*/
		
		echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'._PATH_LINKS.'</span>';
		break;
	
	case 'polls':
		/*
			POLLS
		*/
		
		echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'._PATH_POLLS.'</span>';
		break;
	
	case 'imprint':
		/*
			IMPRINT
		*/
		
		echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'._PATH_LEGAL.'</span>';
		break;
	
	case 'components':
		/*
			COMPONENTS
		*/
		
		if(file_exists(_TCMS_PATH.'/components/'.$item.'/component.xml')) {
			$csXML = new xmlparser(_TCMS_PATH.'/components/'.$item.'/component.xml', 'r');
			$pathName = $csXML->read_value('title');
		}
		else {
			$pathName = _MSG_ERROR;
		}
		
		echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$pathName.'</span>';
		break;
	
	default:
		/*
			DEFAULT
		*/
		
		if($id == $front_id)
			echo $_HOMEPATH;
		else
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$pathway[$id].'</span>';
		break;
}





?>
