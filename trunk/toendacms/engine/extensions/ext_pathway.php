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
| File:		ext_pathway.php
| Version:	0.4.9
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



if(isset($_GET['albums'])){ $albums = $_GET['albums']; }
if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['category'])){ $category = $_GET['category']; }
if(isset($_GET['article'])){ $article = $_GET['article']; }
if(isset($_GET['news'])){ $news = $_GET['news']; }
if(isset($_GET['cat'])){ $cat = $_GET['cat']; }

if(isset($_POST['news'])){ $news = $_POST['news']; }




if(!isset($action)){ $action = 'showall'; }
if(!isset($task)){ $task = 'register'; }



$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'s='.$s;
$link = $tcms_main->urlAmpReplace($link);

$_HOMEPATH = '&nbsp;<a class="pathway" href="'.$link.'">'._PATH_HOME.'</a>';


switch($id){
	case $download_id:
		/*
			DOWNLOAD
		*/
		
		echo $_HOMEPATH;
		
		if((!isset($category) || $category == '') && (!isset($file) || $file == '')){
			echo '&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$download_title.'</span>';
		}
		
		if(isset($category) || isset($file)){
			if($choosenDB == 'xml'){
				$count = 0;
				
				if($category != ''){
					$xml = new xmlparser($tcms_administer_site.'/files/'.$category.'/info.xml', 'r');
					
					//$access_cat = $down_xml->read_section('faq', 'access');
					
					$arrFAQparent['type'][$count] = $xml->read_section('info', 'sql_type');
					$arrFAQparent['pub'][$count]  = $xml->read_section('info', 'pub');
				}
				else{
					$arrFAQparent['type'][$count] = 'd';
					$arrFAQparent['pub'][$count]  = '1';
				}
				
				if($arrFAQparent['type'][$count] == 'd' && $arrFAQparent['pub'][$count] == '1'){
					if($category != ''){
						$arrFAQparent['title'][$count]  = $xml->read_section('info', 'name');
						$arrFAQparent['parent'][$count] = $xml->read_section('info', 'parent');
						$arrFAQparent['uid'][$count]    = substr($category, 0, 10);
						
						// CHARSETS
						$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
						
						$checkCat = $xml->read_section('info', 'cat');
						
						$xml->flush();
						$xml->_xmlparser();
						
						$count++;
					}
					else{
						$arrFAQparent['title'][$count]  = '';
						$arrFAQparent['parent'][$count] = '';
						$arrFAQparent['uid'][$count]    = '';
						
						$checkCat = '';
					}
					
					while($checkCat != ''){
						$xml = new xmlparser($tcms_administer_site.'/files/'.$arrFAQparent['parent'][$count - 1].'/info.xml', 'r');
						
						$checkCat = $xml->read_section('info', 'cat');
						$arrFAQparent['type'][$count]   = $xml->read_section('info', 'sql_type');
						$arrFAQparent['pub'][$count]    = $xml->read_section('info', 'pub');
						
						if($arrFAQparent['type'][$count] == 'd' && $arrFAQparent['pub'][$count] == '1'){
							$arrFAQparent['title'][$count]  = $xml->read_section('info', 'name');
							$arrFAQparent['parent'][$count] = $xml->read_section('info', 'parent');
							$arrFAQparent['uid'][$count]    = substr($arrFAQparent['parent'][$count - 1], 0, 10);
							
							$xml->flush();
							$xml->_xmlparser();
							
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
				
				$sqlQR = $sqlAL->sqlQuery($sqlSTRparent);
				$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
				
				//echo '<b>'.$sqlNR.'<br>'.$sqlSTRparent.'</b><br><br>';
				
				while($sqlNR > 0){
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					
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
					
					$sqlQR = $sqlAL->sqlQuery($sqlSTRparent);
					
					$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
					
					//echo $sqlNR.'<br>'.$sqlSTRparent.'<br><br>';
					
					$count++;
					$checkFAQTitle = $count;
				}
			}
			
			if(!isset($checkFAQTitle))
				$checkFAQTitle = 1;
			
			echo '&nbsp;'.$pathwayChar.'&nbsp;';
			
			// list
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=download&amp;s='.$s.'&amp;action=showall';
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<a class="pathway" href="'.$link.'">'.$download_title.'</a>';
			
			
			for($i = ($checkFAQTitle - 1); $i >= 0; $i--){
				echo '&nbsp;'.$pathwayChar.'&nbsp;';
				
				if($i != 0){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=download&amp;s='.$s.'&amp;action=showall&amp;category='.$arrFAQparent['uid'][$i];
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<a class="pathway" href="'.$link.'">'.$arrFAQparent['title'][$i].'</a>';
				}
				else{
					if(isset($article)){
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=download&amp;s='.$s.'&amp;action=showall&amp;category='.$arrFAQparent['uid'][$i];
						$link = $tcms_main->urlAmpReplace($link);
						
						echo '<a class="pathway" href="'.$link.'">'.$arrFAQparent['title'][$i].'</a>';
						
						//echo '&nbsp;/&nbsp;';
					}
					else{
						echo $arrFAQparent['title'][$i];
					}
				}
			}
		}
		
		
		// file
		/*if(isset($file)){
			if($arrParent['parent'] != null && $arrParent['parent'] != ''){
				echo '&nbsp;'.$pathwayChar.'&nbsp;';
			}
			
			echo '<span class="pathway">'.$file.'</a>';
		}*/
		break;
	
	case $news_id:
		/*
			NEWS
		*/
		
		if(!isset($news) && !$cat && !isset($date)){
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$pathway[$id].'</span>';
		}
		
		if(isset($news)){
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;'.$arr_path[$id];
			
			if($news != 'archive'){
				if($choosenDB == 'xml'){
					$news_detail_xml = new xmlparser($tcms_administer_site.'/tcms_news/'.$news.'.xml','r');
					$arr_news['title'] = $news_detail_xml->read_section('news', 'title');
					$arr_news['order'] = $news_detail_xml->read_section('news', 'order');
					
					$arr_news['title'] = $tcms_main->decodeText($arr_news['title'], '2', $c_charset);
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'news', $news);
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					
					$arr_news['title'] = $sqlARR['title'];
					$arr_news['order'] = $sqlARR['uid'];
					
					$arr_news['title'] = $tcms_main->decodeText($arr_news['title'], '2', $c_charset);
				}
				
				echo '&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$arr_news['title'].'</span>';
			}
			
			if($news == 'archive')
				echo '&nbsp;'.$pathwayChar.'&nbsp;'._NEWS_ARCHIVE;
		}
		
		if(isset($date)){
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;'.$arr_path[$id];
			
			if(strlen($date) == 6){
				if(substr(substr($day, 4, 2), 0, 1) == '0')
					$ccMonth = substr(substr($date, 4, 2), 1, 1);
				else
					$ccMonth = substr($date, 4, 2);
				
				echo '&nbsp;'.$pathwayChar.'&nbsp;'._NEWS_ARCHIV_FOR.'&nbsp;'.$monthName[$ccMonth].',&nbsp;'.substr($date, 0, 4);
			}
			else{
				if(substr(substr($date, 4, 2), 0, 1) == '0'){ $ccDay = substr(substr($date, 4, 2), 1, 1); }
				else{ $ccDay = substr($date, 4, 2); }
				
				if(substr(substr($day, 4, 2), 0, 1) == '0'){ $ccMonth = substr(substr($date, 4, 2), 1, 1); }
				else{ $ccMonth = substr($date, 4, 2); }
				
				echo '&nbsp;'.$pathwayChar.'&nbsp;'._NEWS_ARCHIV_FOR.'&nbsp;'.$ccDay.'.&nbsp;'.$monthName[$ccMonth].',&nbsp;'.substr($date, 0, 4);
			}
		}
		
		if($cat){
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;'.$arr_path[$id];
			
			if($choosenDB == 'xml'){
				$xmlP = new xmlparser($tcms_administer_site.'/tcms_news_categories/'.$cat.'.xml', 'r');
				$catName = $xmlP->read_section('cat', 'name');
				
				$catName = $tcms_main->decodeText($catName, '2', $c_charset);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'news_categories', $cat);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
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
		
		if(!isset($albums))
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$pathway[$id].'</span>';
		
		if(isset($albums)){
			if($choosenDB == 'xml'){
				$album_xml   = new xmlparser($tcms_administer_site.'/tcms_albums/album_'.$albums.'.xml', 'r');
				$album_title = $album_xml->read_section('album', 'title');
				
				$album_title = $tcms_main->decodeText($album_title, '2', $c_charset);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlQuery("SELECT * FROM ".$tcms_db_prefix."albums WHERE album_id='".$albums."'");
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$album_title = $sqlARR['title'];
				
				$album_title = $tcms_main->decodeText($album_title, '2', $c_charset);
			}
			
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;'.$arr_path[$id].'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$album_title.'</span>';
		}
		break;
	
	case $products_id:
		/*
			PRODUCTS
		*/
		
		if($action == 'showall' || !isset($action))
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$pathway[$id].'</span>';
		
		if($action == 'showone'){
			if($choosenDB == 'xml'){
				$down_xml = new xmlparser($tcms_administer_site.'/tcms_products/'.$category.'/folderinfo.xml','r');
				$down_cat = $down_xml->read_section('folderinfo', 'name');
				
				$down_cat = $tcms_main->decodeText($down_cat, '2', $c_charset);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'products', $category);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$down_cat = $sqlARR['name'];
				
				$down_cat = $tcms_main->decodeText($down_cat, '2', $c_charset);
			}
			
			echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;'.$arr_path[$id].'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$down_cat.'</span>';
		}
		break;
	
	case 'knowledgebase':
		/*
			KNOWLEDGEBASE
		*/
		
		echo $_HOMEPATH;
		
		if(!isset($category) && !isset($article))
			echo '&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'.$faq_title.'</span>';
		
		if(isset($category) || isset($article)){
			if($choosenDB == 'xml'){
				$count = 0;
				
				if($category != ''){
					$xml = new xmlparser($tcms_administer_site.'/tcms_knowledgebase/'.$category.'.xml','r');
					
					//$access_cat = $down_xml->read_section('faq', 'access');
					
					$arrFAQparent['type'][$count] = $xml->read_section('faq', 'type');
					$arrFAQparent['pub'][$count]  = $xml->read_section('faq', 'publish_state');
				}
				else{
					$arrFAQparent['type'][$count] = 'c';
					$arrFAQparent['pub'][$count]  = '2';
				}
				
				if($arrFAQparent['type'][$count] == 'c' && $arrFAQparent['pub'][$count] == '2'){
					if($category != ''){
						$arrFAQparent['title'][$count]  = $xml->read_section('faq', 'title');
						$arrFAQparent['parent'][$count] = $xml->read_section('faq', 'parent');
						$arrFAQparent['uid'][$count]    = substr($category, 0, 10);
						
						// CHARSETS
						$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
						
						$checkCat = $xml->read_section('faq', 'category');
						
						$count++;
					}
					else{
						$arrFAQparent['title'][$count]  = '';
						$arrFAQparent['parent'][$count] = '';
						$arrFAQparent['uid'][$count]    = '';
						
						$checkCat = '';
					}
					
					while($checkCat != ''){
						$xml = new xmlparser($tcms_administer_site.'/tcms_knowledgebase/'.$arrFAQparent['parent'][$count - 1].'.xml','r');
						
						$checkCat = $xml->read_section('faq', 'category');
						$arrFAQparent['type'][$count]   = $xml->read_section('faq', 'type');
						$arrFAQparent['pub'][$count]    = $xml->read_section('faq', 'publish_state');
						
						if($arrFAQparent['type'][$count] == 'c' && $arrFAQparent['pub'][$count] == '2'){
							$arrFAQparent['title'][$count]  = $xml->read_section('faq', 'title');
							$arrFAQparent['parent'][$count] = $xml->read_section('faq', 'parent');
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
				."FROM ".$tcms_db_prefix."knowledgebase "
				."WHERE uid = '".$category."' "
				."AND publish_state = 2 "
				."AND type = 'c' "
				."AND ( access = 'Public' "
				.$strAdd;
				
				$count = 0;
				
				$sqlQR = $sqlAL->sqlQuery($sqlSTRparent);
				$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
				
				//echo '<b>'.$sqlNR.'<br>'.$sqlSTRparent.'</b><br><br>';
				
				while($sqlNR > 0){
					$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
					
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
					
					$sqlQR = $sqlAL->sqlQuery($sqlSTRparent);
					
					$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
					
					//echo $sqlNR.'<br>'.$sqlSTRparent.'<br><br>';
					
					$count++;
					$checkFAQTitle = $count;
				}
			}
			
			if(!isset($checkFAQTitle)){ $checkFAQTitle = 1; }
			
			
			echo '&nbsp;'.$pathwayChar.'&nbsp;';
			
			
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=knowledgebase&amp;s='.$s.'&amp;action=list';
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<a class="pathway" href="'.$link.'">'.$faq_title.'</a>';
			
			
			for($i = ($checkFAQTitle - 1); $i >= 0; $i--){
				echo '&nbsp;'.$pathwayChar.'&nbsp;';
				
				if($i != 0){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=knowledgebase&amp;s='.$s.'&amp;action=list&amp;category='.$arrFAQparent['uid'][$i];
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<a class="pathway" href="'.$link.'">'.$arrFAQparent['title'][$i].'</a>';
				}
				else{
					if(isset($article)){
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=knowledgebase&amp;s='.$s.'&amp;action=list&amp;category='.$arrFAQparent['uid'][$i];
						$link = $tcms_main->urlAmpReplace($link);
						
						echo '<a class="pathway" href="'.$link.'">'.$arrFAQparent['title'][$i].'</a>';
						
						//echo '&nbsp;/&nbsp;';
					}
					else{
						echo $arrFAQparent['title'][$i];
					}
				}
			}
		}
		
		if(isset($article)){
			if($choosenDB == 'xml'){
				$xml = new xmlparser($tcms_administer_site.'/tcms_knowledgebase/'.$article.'.xml','r');
				
				//$access_cat = $down_xml->read_section('faq', 'access');
				
				$arrFAQparent['type'] = $xml->read_section('faq', 'type');
				$arrFAQparent['pub']  = $xml->read_section('faq', 'publish_state');
				
				if($arrFAQparent['type'] == 'a' && $arrFAQparent['pub'] == '2'){
					$arrFAQparent['title']  = $xml->read_section('faq', 'title');
					$arrFAQparent['parent'] = $xml->read_section('faq', 'parent');
					$arrFAQparent['uid']    = substr($category, 0, 10);
					
					$arrFAQparent['title'] = $tcms_main->decodeText($arrFAQparent['title'], '2', $c_charset);
					
					if($arrFAQparent['parent'] != false && $arrFAQparent['parent'] != ''){
						echo '&nbsp;'.$pathwayChar.'&nbsp;';
					}
					
					echo $arrFAQparent['title'];
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
				."FROM ".$tcms_db_prefix."knowledgebase "
				."WHERE uid = '".$article."' "
				."AND publish_state = 2 "
				."AND type = 'a' "
				."AND ( access = 'Public' "
				.$strAdd;
				
				$count = 0;
				
				$sqlQR = $sqlAL->sqlQuery($sqlSTRparent);
				
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$arrFAQparent['title']  = $sqlARR['title'];
				$arrFAQparent['parent'] = $sqlARR['parent'];
				
				if($arrFAQparent['title']  == NULL){ $arrFAQparent['title']  = ''; }
				if($arrFAQparent['parent'] == NULL){ $arrFAQparent['parent'] = ''; }
				
				// CHARSETS
				$arrFAQparent['title'] = $tcms_main->decodeText($arrFAQparent['title'], '2', $c_charset);
				
				if($arrFAQparent['parent'] != null && $arrFAQparent['parent'] != ''){
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
	
	case 'impressum':
		/*
			IMPRESSUM
		*/
		
		echo $_HOMEPATH.'&nbsp;'.$pathwayChar.'&nbsp;<span class="pathway">'._PATH_LEGAL.'</span>';
		break;
	
	case 'components':
		/*
			COMPONENTS
		*/
		
		if(file_exists($tcms_administer_site.'/components/'.$item.'/component.xml')){
			$csXML = new xmlparser($tcms_administer_site.'/components/'.$item.'/component.xml', 'r');
			$pathName = $csXML->read_value('title');
		}
		else{
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
