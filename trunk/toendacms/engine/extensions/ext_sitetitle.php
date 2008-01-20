<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Sitetitle
|
| File:	ext_sitetitle.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Sitetitle
 *
 * This module is used fore the site title.
 *
 * @version 0.5.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


if(isset($_GET['albums'])){ $albums = $_GET['albums']; }
if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['category'])){ $category = $_GET['category']; }
if(isset($_GET['article'])){ $article = $_GET['article']; }
if(isset($_GET['news'])){ $news = $_GET['news']; }
if(isset($_GET['cat'])){ $cat = $_GET['cat']; }

if(isset($_POST['news'])){ $news = $_POST['news']; }



if(!isset($action)){ $action = 'showall'; }
if(!isset($task)){ $task = 'register'; }


$sitetitleAdditional = '';


switch($id){
	case $download_id:
		/*
			DOWNLOAD
		*/
		
		echo _PATH_HOME;
		
		if((!isset($category) || $category == '') && (!isset($file) || $file == '')){
			$sitetitleAdditional .= '&nbsp;/&nbsp;'.$download_title;
		}
		
		if(isset($category) || isset($file)){
			if($choosenDB == 'xml'){
				$count = 0;
				
				if($category != ''){
					$xml = new xmlparser(_TCMS_PATH.'/files/'.$category.'/info.xml', 'r');
					
					//$access_cat = $down_xml->readSection('faq', 'access');
					
					$arrFAQparent['type'][$count] = $xml->readSection('info', 'sql_type');
					$arrFAQparent['pub'][$count]  = $xml->readSection('info', 'pub');
				}
				else{
					$arrFAQparent['type'][$count] = 'd';
					$arrFAQparent['pub'][$count]  = '1';
				}
				
				if($arrFAQparent['type'][$count] == 'd' && $arrFAQparent['pub'][$count] == '1'){
					if($category != ''){
						$arrFAQparent['title'][$count]  = $xml->readSection('info', 'name');
						$arrFAQparent['parent'][$count] = $xml->readSection('info', 'parent');
						$arrFAQparent['uid'][$count]    = substr($category, 0, 10);
						
						// CHARSETS
						$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
						
						$checkCat = $xml->readSection('info', 'cat');
						
						$xml->flush();
						
						$count++;
					}
					else{
						$arrFAQparent['title'][$count]  = '';
						$arrFAQparent['parent'][$count] = '';
						$arrFAQparent['uid'][$count]    = '';
						
						$checkCat = '';
					}
					
					while($checkCat != ''){
						$xml = new xmlparser(_TCMS_PATH.'/files/'.$arrFAQparent['parent'][$count - 1].'/info.xml', 'r');
						
						$checkCat = $xml->readSection('info', 'cat');
						$arrFAQparent['type'][$count]   = $xml->readSection('info', 'sql_type');
						$arrFAQparent['pub'][$count]    = $xml->readSection('info', 'pub');
						
						if($arrFAQparent['type'][$count] == 'd' && $arrFAQparent['pub'][$count] == '1'){
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
			else{
				switch($is_admin){
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
				
				$sqlQR = $tcms_dal->query($sqlSTRparent);
				$sqlNR = $tcms_dal->getNumber($sqlQR);
				
				//echo '<b>'.$sqlNR.'<br>'.$sqlSTRparent.'</b><br><br>';
				
				while($sqlNR > 0){
					$sqlARR = $tcms_dal->fetchArray($sqlQR);
					
					unset($sqlQR);
					
					$arrFAQparent['title'][$count]  = $sqlARR['name'];
					$arrFAQparent['uid'][$count]    = $sqlARR['uid'];
					$arrFAQparent['parent'][$count] = $sqlARR['parent'];
					
					if($arrFAQparent['title'][$count]  == NULL){ $arrFAQparent['title'][$count]  = ''; }
					if($arrFAQparent['uid'][$count]    == NULL){ $arrFAQparent['uid'][$count]    = ''; }
					if($arrFAQparent['parent'][$count] == NULL){ $arrFAQparent['parent'][$count] = ''; }
					
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
			
			if(!isset($checkFAQTitle)) $checkFAQTitle = 1;
			
			
			$sitetitleAdditional .= '&nbsp;/&nbsp;';
			
			
			// list
			$sitetitleAdditional .= $download_title;
			
			
			for($i = ($checkFAQTitle - 1); $i >= 0; $i--){
				$sitetitleAdditional .= '&nbsp;/&nbsp;';
				
				if($i != 0){
					$sitetitleAdditional .= $arrFAQparent['title'][$i];
				}
				else{
					if(isset($article)){
						$sitetitleAdditional .= $arrFAQparent['title'][$i];
						
						//$sitetitleAdditional .= '&nbsp;/&nbsp;';
					}
					else{
						$sitetitleAdditional .= $arrFAQparent['title'][$i];
					}
				}
			}
		}
		
		
		// file
		/*if(isset($file)){
			if($arrParent['parent'] != null && $arrParent['parent'] != ''){
				$sitetitleAdditional .= '&nbsp;/&nbsp;';
			}
			
			$sitetitleAdditional .= '<span class="pathway">'.$file.'</a>';
		}*/
		break;
	
	case 'knowledgebase':
		/*
			FAQs
		*/
		
		echo _PATH_HOME;
		
		if(!isset($category) && !isset($article)){
			$sitetitleAdditional .= '&nbsp;/&nbsp;'.$faq_title;
		}
		
		if(isset($category) || isset($article)){
			if($choosenDB != 'xml'){
				switch($is_admin){
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
				
				while($sqlNR > 0){
					$sqlARR = $tcms_dal->fetchArray($sqlQR);
					
					unset($sqlQR);
					
					$arrFAQparent['title'][$count]  = $sqlARR['title'];
					$arrFAQparent['uid'][$count]    = $sqlARR['uid'];
					$arrFAQparent['parent'][$count] = $sqlARR['parent'];
					
					if($arrFAQparent['title'][$count]  == NULL){ $arrFAQparent['title'][$count]  = ''; }
					if($arrFAQparent['uid'][$count]    == NULL){ $arrFAQparent['uid'][$count]    = ''; }
					if($arrFAQparent['parent'][$count] == NULL){ $arrFAQparent['parent'][$count] = ''; }
					
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
					
					$count++;
					$checkFAQTitle = $count;
				}
			}
			
			if(!isset($checkFAQTitle)){ $checkFAQTitle = 1; }
			
			
			$sitetitleAdditional .= '&nbsp;/&nbsp;'
			.$faq_title;
			
			
			if($choosenDB != 'xml'){
				for($i = ($checkFAQTitle - 1); $i >= 0; $i--){
					$sitetitleAdditional .= '&nbsp;/&nbsp;';
					
					if($i != 0) {
						$sitetitleAdditional .= $arrFAQparent['title'][$i];
					}
					else {
						if(isset($article)) {
							$sitetitleAdditional .= $arrFAQparent['title'][$i];
							//.'&nbsp;/&nbsp;';
						}
						else {
							$sitetitleAdditional .= $arrFAQparent['title'][$i];
						}
					}
				}
				
				unset($arrFAQparent);
			}
		}
		
		if(isset($article)){
			if($choosenDB != 'xml'){
				switch($is_admin){
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
				
				if($arrFAQparent['title']  == NULL){ $arrFAQparent['title']  = ''; }
				if($arrFAQparent['parent'] == NULL){ $arrFAQparent['parent'] = ''; }
			}
			
			if($choosenDB != 'xml'){
				// CHARSETS
				$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
				
				if($arrFAQparent['parent'] != null && $arrFAQparent['parent'] != ''){
					$sitetitleAdditional .= '&nbsp;/&nbsp;';
				}
				
				$sitetitleAdditional .= $arrFAQparent['title'];
				
				unset($arrFAQparent);
			}
		}
		break;
	
	case $news_id:
		/*
			NEWS
		*/
		
		if(!isset($news) && !$cat && !isset($date)){
			$sitetitleAdditional .= _PATH_HOME
			.'&nbsp;/&nbsp;'
			.$titleway[$id];
		}
		
		if(isset($news)){
			$sitetitleAdditional .= _PATH_HOME
			.'&nbsp;/&nbsp;'
			.$titleway[$id];
			
			if($news != 'archive'){
				if($choosenDB == 'xml'){
					$news_detail_xml = new xmlparser(_TCMS_PATH.'/tcms_news/'.$news.'.xml','r');
					$arr_news['title'] = $news_detail_xml->readSection('news', 'title');
					$arr_news['order'] = $news_detail_xml->readSection('news', 'order');
					
					$arr_news['title'] = $tcms_main->decodeText($arr_news['title'], '2', $c_charset);
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->getOne($tcms_db_prefix.'news', $news);
					$sqlARR = $sqlAL->fetchArray($sqlQR);
					
					$arr_news['title'] = $sqlARR['title'];
					$arr_news['order'] = $sqlARR['uid'];
					
					$arr_news['title'] = $tcms_main->decodeText($arr_news['title'], '2', $c_charset);
				}
				
				$sitetitleAdditional .= '&nbsp;/&nbsp;'
				.$tcms_main->cleanGBScript($arr_news['title']);
			}
			
			if($news == 'archive'){
				$sitetitleAdditional .= '&nbsp;/&nbsp;'._NEWS_ARCHIVE;
			}
		}
		
		if(isset($date)) {
			if(strlen($date) == 6) {
				$sitetitleAdditional .= _PATH_HOME
				.'&nbsp;/&nbsp;'
				.$titleway[$id];
				
				if(substr(substr($day, 4, 2), 0, 1) == '0') {
					$ccMonth = substr(substr($date, 4, 2), 1, 1);
				}
				else {
					$ccMonth = substr($date, 4, 2);
				}
				
				$sitetitleAdditional .= '&nbsp;/&nbsp;'._NEWS_ARCHIV_FOR.'&nbsp;'.$monthName[$ccMonth].',&nbsp;'.substr($date, 0, 4);
			}
			else {
				$sitetitleAdditional .= _PATH_HOME
				.'&nbsp;/&nbsp;'
				.$titleway[$id];
				
				if(substr(substr($date, 4, 2), 0, 1) == '0') {
					$ccDay = substr(substr($date, 4, 2), 1, 1);
				}
				else {
					$ccDay = substr($date, 4, 2);
				}
				
				if(substr(substr($day, 4, 2), 0, 1) == '0') {
					$ccMonth = substr(substr($date, 4, 2), 1, 1);
				}
				else {
					$ccMonth = substr($date, 4, 2);
				}
				
				$sitetitleAdditional .= '&nbsp;/&nbsp;'._NEWS_ARCHIV_FOR.'&nbsp;'.$ccDay.'.&nbsp;'.$monthName[$ccMonth].',&nbsp;'.substr($date, 0, 4);
			}
		}
		
		if($cat) {
			$sitetitleAdditional .= _PATH_HOME
			.'&nbsp;/&nbsp;'
			.$titleway[$id];
			
			if($choosenDB == 'xml'){
				$xmlP = new xmlparser(_TCMS_PATH.'/tcms_news_categories/'.$cat.'.xml', 'r');
				$catName = $xmlP->readSection('cat', 'name');
				$catName = $tcms_main->decodeText($catName, '2', $c_charset);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getOne($tcms_db_prefix.'news_categories', $cat);
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				
				$catName = $sqlARR['name'];
				
				$catName = $tcms_main->decodeText($catName, '2', $c_charset);
			}
			
			$sitetitleAdditional .= '&nbsp;/&nbsp;'._NEWS_CATEGORY_ARCHIV.' \''.$catName.'\'';
		}
		break;
	
	case $image_id:
		/*
			IMAGEGALLERY
		*/
		
		if(!isset($albums)){
			$sitetitleAdditional .= _PATH_HOME
			.'&nbsp;/&nbsp;'
			.$titleway[$id];
		}
		
		if(isset($albums)){
			if($choosenDB == 'xml'){
				$album_xml   = new xmlparser(_TCMS_PATH.'/tcms_albums/album_'.$albums.'.xml', 'r');
				$album_title = $album_xml->readSection('album', 'title');
				
				$album_title = $tcms_main->decodeText($album_title, '2', $c_charset);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->query("SELECT * FROM ".$tcms_db_prefix."albums WHERE album_id='".$albums."'");
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				
				$album_title = $sqlARR['title'];
				
				$album_title = $tcms_main->decodeText($album_title, '2', $c_charset);
			}
			
			$sitetitleAdditional .= _PATH_HOME
			.'&nbsp;/&nbsp;'
			.$titleway[$id]
			.'&nbsp;/&nbsp;'
			.$album_title;
		}
		break;
	
	case $products_id:
		/*
			PRODUCTS
		*/
		
		$sitetitleAdditional .= _PATH_HOME;
		
		if(!isset($category) && !isset($article)){
			$sitetitleAdditional .= '&nbsp;/&nbsp;'.$products_title;
		}
		
		if(isset($category) || isset($article)) {
			if(isset($article)) {
				if($choosenDB == 'xml') {
					/*$xml = new xmlparser(_TCMS_PATH.'/tcms_knowledgebase/'.$article.'.xml','r');
					
					//$access_cat = $down_xml->readSection('faq', 'access');
					
					$arrFAQparent['type'] = $xml->readSection('faq', 'type');
					$arrFAQparent['pub']  = $xml->readSection('faq', 'publish_state');
					
					if($arrFAQparent['type'] == 'a' && $arrFAQparent['pub'] == '2'){
						$arrFAQparent['title']  = $xml->readSection('faq', 'title');
						$arrFAQparent['parent'] = $xml->readSection('faq', 'parent');
						$arrFAQparent['uid']    = substr($category, 0, 10);
						
						$arrFAQparent['title'] = $tcms_main->decodeText($arrFAQparent['title'], '2', $c_charset);
						
						if($arrFAQparent['parent'] != false && $arrFAQparent['parent'] != ''){
							echo '&nbsp;'.$pathwayChar.'&nbsp;';
						}
						
						echo $arrFAQparent['title'];
					}*/
				}
				else {
					switch($is_admin){
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
				
				while($sqlNR > 0){
					$sqlObj = $tcms_dal->fetchObject($sqlQR);
					
					unset($sqlQR);
					
					$arrFAQparent['title'][$count]  = $sqlObj->name;
					$arrFAQparent['uid'][$count]    = $sqlObj->uid;
					$arrFAQparent['parent'][$count] = $sqlObj->category;
					
					if($arrFAQparent['title'][$count]  == NULL){ $arrFAQparent['title'][$count]  = ''; }
					if($arrFAQparent['uid'][$count]    == NULL){ $arrFAQparent['uid'][$count]    = ''; }
					if($arrFAQparent['parent'][$count] == NULL){ $arrFAQparent['parent'][$count] = ''; }
					
					// CHARSETS
					$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
					
					$sqlSTRparent = "SELECT * "
					."FROM ".$tcms_db_prefix."products "
					."WHERE uid = '".$arrFAQparent['parent'][$count]."' "
					."AND pub = 1 "
					."AND type = 'c' "
					."AND ( access = 'Public' "
					.$strAdd;
					
					$sqlQR = $tcms_dal->query($sqlSTRparent);
					
					$sqlNR = $tcms_dal->getNumber($sqlQR);
					
					$count++;
					$checkFAQTitle = $count;
				}
			}
			
			if(!isset($checkFAQTitle)){ $checkFAQTitle = 1; }
			
			
			$sitetitleAdditional .= '&nbsp;/&nbsp;'
			.$products_title;
			
			
			if($choosenDB == 'xml') {
			}
			else {
				for($i = ($checkFAQTitle - 1); $i >= 0; $i--){
					$sitetitleAdditional .= '&nbsp;/&nbsp;';
					
					if($i != 0){
						$sitetitleAdditional .= $arrFAQparent['title'][$i];
					}
					else{
						if(isset($article)){
							$sitetitleAdditional .= $arrFAQparent['title'][$i];
							//.'&nbsp;/&nbsp;';
						}
						else{
							$sitetitleAdditional .= $arrFAQparent['title'][$i];
						}
					}
				}
				
				unset($arrFAQparent);
			}
		}
		
		if(isset($article)){
			if($choosenDB == 'xml') {
			}
			else {
				switch($is_admin){
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
				
				if($arrFAQparent['title']  == NULL){ $arrFAQparent['title']  = ''; }
				if($arrFAQparent['parent'] == NULL){ $arrFAQparent['parent'] = ''; }
			}
			
			if($choosenDB == 'xml') {
			}
			else {
				// CHARSETS
				$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
				
				if($arrFAQparent['parent'] != null && $arrFAQparent['parent'] != ''){
					$sitetitleAdditional .= '&nbsp;/&nbsp;';
				}
				
				$sitetitleAdditional .= $arrFAQparent['title'];
				
				unset($arrFAQparent);
			}
		}
		break;
	
	case 'register':
		/*
			REGISTER
		*/
		
		if($task == 'lostpassword') {
			$sitetitleAdditional .= _PATH_HOME
			.'&nbsp;/&nbsp;'
			._PATH_LOSTPW;
		}
		else {
			$sitetitleAdditional .= _PATH_HOME
			.'&nbsp;/&nbsp;'
			._PATH_REGISTRATION;
		}
		break;
	
	case 'profile':
		/*
			PROFILE
		*/
		
		$sitetitleAdditional .= _PATH_HOME
		.'&nbsp;/&nbsp;'
		._PATH_PROFILE;
		break;
	
	case 'search':
		/*
			SEARCH
		*/
		
		$sitetitleAdditional .= _PATH_HOME
		.'&nbsp;/&nbsp;'
		._PATH_SEARCH;
		break;
	
	case 'links':
		/*
			LINKS
		*/
		
		$sitetitleAdditional .= _PATH_HOME
		.'&nbsp;/&nbsp;'
		._PATH_LINKS;
		break;
	
	case 'polls':
		/*
			POLLS
		*/
		
		$sitetitleAdditional .= _PATH_HOME
		.'&nbsp;/&nbsp;'
		._PATH_POLLS;
		break;
	
	case 'impressum':
		/*
			IMPRESSUM
		*/
		
		$sitetitleAdditional .= _PATH_HOME
		.'&nbsp;/&nbsp;'
		._PATH_LEGAL;
		break;
	
	case 'contactform':
		/*
			CONTACTFORM
		*/
		
		$sitetitleAdditional .= _PATH_HOME
		.'&nbsp;/&nbsp;'
		._PATH_CONTACTFORM;
		break;
	
	case 'guestbook':
		/*
			GUESTBOOK
		*/
		
		$sitetitleAdditional .= _PATH_HOME
		.'&nbsp;/&nbsp;'
		._TCMS_MENU_QBOOK;
		break;
	
	case 'components':
		/*
			COMPONENTS
		*/
		
		if(file_exists(_TCMS_PATH.'/components/'.$item.'/component.xml')){
			$csXML = new xmlparser(_TCMS_PATH.'/components/'.$item.'/component.xml', 'r');
			$pathName = $csXML->readValue('title');
		}
		else{
			$pathName = _MSG_ERROR;
		}
		
		$sitetitleAdditional .= _PATH_HOME
		.'&nbsp;/&nbsp;'
		.$pathName;
		break;
	
	default:
		/*
			DEFAULT
		*/
		
		if($id == 'frontpage') {
			$sitetitleAdditional .= $pathway[$id];
		}
		else {
			$arrContentAccess = $tcms_dcp->getContentAccess($id);
			$authorized = $arrContentAccess['authorized'];
			$content_published = $arrContentAccess['content_published'];
			
			if($content_published == 1) {
				$ws_auth = $tcms_main->checkAccess($authorized, $is_admin);
				
				if($ws_auth) {
					using('toendacms.datacontainer.content');
					
					$dcContent = new tcms_dc_content();
					
					$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
					
					$dcContent = $tcms_dcp->getContentDC(
						$id, 
						true, 
						$getLang
					);
					
					//echo _PATH_HOME;
					//echo '&nbsp;/&nbsp;';
					$sitetitleAdditional .= $dcContent->getTitle();
				}
				else {
					$sitetitleAdditional .= $pathway[$id];
				}
			}
			else {
				$sitetitleAdditional .= $pathway[$id];
			}
		}
		break;
}


if(!defined('_SITE_TITLE_ADDITIONAL')) define('_SITE_TITLE_ADDITIONAL', $sitetitleAdditional);

if(trim(_SITE_TITLE) != '') {
	echo _SITE_TITLE.' | ';
}

if(trim(_SITE_TITLE_ADDITIONAL) != '') {
	echo _SITE_TITLE_ADDITIONAL;
}

?>
