<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Search Result Page
|
| File:		ext_search_result.php
| Version:	0.4.9
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



if(isset($_POST['option'])){ $option = $_POST['option']; }
if(isset($_POST['searchword'])){ $searchword = $_POST['searchword']; }



if($choosenDB == 'xml'){
	$search_xml   = new xmlparser($tcms_administer_site.'/tcms_global/sidebar.xml','r');
	$search_title = $search_xml->read_section('side', 'search_title');
	
	$search_title = $tcms_main->decodeText($search_title, '2', $c_charset);
}
else{
	$sqlAL = new sqlAbstractionLayer($choosenDB);
	$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidebar_extensions', 'sidebar_extensions');
	$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
	
	$search_title = $sqlARR['search_title'];
	
	$search_title = $tcms_main->decodeText($search_title, '2', $c_charset);
}





echo tcms_html::contentheading(_SEARCH_TITLE)
.tcms_html::contentstamp($search_title)
.'<br /><br /><br />';

echo '<form action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?" method="post">'
.'<input type="hidden" name="id" value="search" />'
.'<input type="hidden" name="s" value="'.$s.'" />'
.( isset($session) ? '<input type="hidden" name="session" value="'.$session.'" />' : '' );


echo '<div align="left" class="text_normal">'
.'<input class="inputtext" style="width: 160px; padding-top: 2px;" type="text" name="searchword" value="'.$searchword.'" />'
.'&nbsp;'
.'<input type="submit" style="padding: 0 0 2px 0 !important;" value="'._SEARCH_SUBMIT.'" class="inputbutton" />'
.'<br /><br />';

echo '<div style="display:block; width:120px; float:left;">'
.'<label for="con">'
.'<input type="radio" style="border: 0px !important;" id="con" name="option" value="con"'.( $option == 'con' ? ' checked="checked"' : '' ).' />'
.'&nbsp;'._TCMS_MENU_CONTENT
.'</label>'
.'</div>';

if(in_array('newsmanager', $arr_side_navi['url']) || in_array('newsmanager', $arr_top_navi['id'])){
	echo '<div style="display:block; width:120px; float:left;">'
	.'<label for="news">'
	.'<input type="radio" style="border: 0px !important;" id="news" name="option" value="news"'.( $option == 'news' ? ' checked="checked"' : '' ).' />'
	.'&nbsp;'._TCMS_MENU_NEWS
	.'</label>'
	.'</div>';
}

if(in_array('products', $arr_side_navi['url']) || in_array('products', $arr_top_navi['id'])){
	echo '<div style="display:block;">'
	.'<label for="pro">'
	.'<input type="radio" style="border: 0px !important;" name="option" id="pro" value="pro"'.( $option == 'pro' ? ' checked="checked"' : '' ).' />'
	.'&nbsp;'._TCMS_MENU_PRODUCTS
	.'</label>'
	.'</div>';
}

if(in_array('download', $arr_side_navi['url']) || in_array('download', $arr_top_navi['id'])){
	echo '<div style="display:block; width:120px; float:left;">'
	.'<label for="down">'
	.'<input type="radio" style="border: 0px !important;" id="down" name="option" value="down"'.( $option == 'down' ? ' checked="checked"' : '' ).' />'
	.'&nbsp;'._TCMS_MENU_DOWN
	.'</label>'
	.'</div>';
}

if(in_array('imagegallery', $arr_side_navi['url']) || in_array('imagegallery', $arr_top_navi['id'])){
	echo '<div style="display:block; width:120px; float:left;">'
	.'<label for="img">'
	.'<input type="radio" style="border: 0px !important;" id="img" name="option" value="img"'.( $option == 'img' ? ' checked="checked"' : '' ).' />'
	.'&nbsp;'._TABLE_IMAGE
	.'</label>'
	.'</div>';
}

if(in_array('knowledgebase', $arr_side_navi['url']) || in_array('knowledgebase', $arr_top_navi['id'])){
	echo '<div style="display:block; width:120px; float:left;">'
	.'<label for="faq"><input type="radio" style="border: 0px !important;" id="faq" name="option" value="faq"'.( $option == 'faq' ? ' checked="checked"' : '' ).' />'
	.'&nbsp;'._TCMS_MENU_FAQ
	.'</label>'
	.'</div>';
}

echo '<div style="display:block;">'
.'<label for="all">'
.'<input type="radio" style="border: 0px !important;" name="option" id="all" value="all"'.( $option == 'all' ? ' checked' : '' ).' />'
.'&nbsp;'._NEWS_ALL
.'</label>'
.'</div>';

echo '</div>'
.'</form>';

echo '<br />';

echo tcms_html::search_result_bar(_SEARCH_TEXT_FOUND)
.'<br />';

if(!isset($option)) $option = 'con';
$nothing_search = _SEARCH_BOX;
$sc = 0;

if($searchword == '')
	echo tcms_html::contentmain(_SEARCH_START);
elseif($searchword == $nothing_search)
	echo tcms_html::contentmain(_SEARCH_EMPTY);
else{
	include_once('engine/tcms_kernel/tcms_search.lib.php');
	
	$tcms_search = new tcms_search($c_charset, $s, $tcms_administer_site, $is_admin);
	
	switch($option){
		case 'con': $sc = $tcms_search->searchDocuments($searchword); break;
		case 'news':
			$sc = search_news($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			break;
		
		case 'pro':
			$sc = search_products($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			break;
		
		case 'down':
			$sc = search_downloads($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			break;
		
		case 'img':
			$sc = search_images($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			break;
		
		case 'faq':
			$sc = search_faqs($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			break;
		
		case 'all':
			$sc = $tcms_search->searchDocuments($searchword);
			$sc = search_news($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			$sc = search_products($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			$sc = search_downloads($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			$sc = search_images($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			$sc = search_faqs($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			$sc = 1;
			break;
	}
	
	if($sc == 0)
		echo tcms_html::contentmain(_SEARCH_NOTFOUND_1.'&nbsp;'.$searchword.'&nbsp;'._SEARCH_NOTFOUND_2);
	
	echo '<br />'.tcms_html::search_box(_SEARCH_WITH_GOOGLE, 'http://www.google.com/search?q='.$searchword, $imagePath.'engine/images/logos/google.png');
	echo '<br />'.tcms_html::search_box(_SEARCH_WITH_GOOGLE, 'http://search.yahoo.com/search?p='.$searchword, $imagePath.'engine/images/logos/yahoo.png');
}






function search_news($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s){
	//$tcms_main = new tcms_main($tcms_administer_site);
	//$tcms_main->setGlobalFolder($seoFolder, $seoEnabled);
	global $tcms_db_prefix;
	global $tcms_main;
	global $tcms_administer_site;
	
	if($choosenDB == 'xml'){
		$arr_searchfiles = $tcms_main->load_xml_files($tcms_administer_site.'/tcms_news/', 'files');
		
		foreach($arr_searchfiles as $skey => $sval){
			//echo $sval.'<br>';
			$search_xml = new xmlparser($tcms_administer_site.'/tcms_news/'.$sval,'r');
			
			$acs = $search_xml->read_section('news', 'access');
			
			$canRead = $tcms_main->checkAccess($acs, $is_admin);
			
			if($canRead){
				$out = $search_xml->search_value_front('news', 'newstext', $searchword);
				
				if($out != false){
					$tit = $search_xml->read_section('news', 'title');
					$date = $search_xml->read_section('news', 'date');
					$time = $search_xml->read_section('news', 'time');
					
					$tit = $tcms_main->decodeText($tit, '2', $c_charset);
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;news='.substr($sval, 0, 10).'&amp;s='.$s;
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
					echo '<div class="search_result"><span class="text_small">'.$date.' - '.$time.'</span></div>';
					echo '<br />';
					
					$sc++;
				}
				else{
					$out = $search_xml->search_value_front('news', 'title', $searchword);
					if($out != false){
						$tit = $search_xml->read_section('news', 'title');
						$date = $search_xml->read_section('news', 'date');
						$time = $search_xml->read_section('news', 'time');
						
						$tit = $tcms_main->decodeText($tit, '2', $c_charset);
						
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;news='.substr($sval, 0, 10).'&amp;s='.$s;
						$link = $tcms_main->urlAmpReplace($link);
						
						echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
						echo '<div class="search_result"><span class="text_small">'.$date.' - '.$time.'</span></div>';
						echo '<br />';
						
						$sc++;
					}
				}
			}
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
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
		
		switch($choosenDB){
			case 'mysql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."news"
				." WHERE ( `access` = 'Public' "
				.$strAdd
				." AND ( `newstext` REGEXP '".$searchword."' OR `newstext` LIKE '%".$searchword."%' )"
				." OR ( `title` REGEXP '".$searchword."' OR `title` LIKE '%".$searchword."%' )";
				break;
			
			case 'pgsql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."news"
				." WHERE ( access = 'Public' "
				.$strAdd
				." AND ( newstext LIKE '%".$searchword."%' )"
				." OR ( title LIKE '%".$searchword."%' )";
				break;
			
			case 'mssql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."news"
				." WHERE ( [access] = 'Public' "
				.$strAdd
				." AND ( [newstext] LIKE '%".$searchword."%' )"
				." OR ( [title] LIKE '%".$searchword."%' )";
				break;
		}
		
		$sqlQR = $sqlAL->sqlQuery($strSQL);
		$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
		
		if($sqlNR != 0){
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$tit = $sqlARR['title'];
				$date = $sqlARR['date'];
				$time = $sqlARR['time'];
				$uid = $sqlARR['uid'];
				
				if($tit  == NULL){ $tit  = ''; }
				if($date == NULL){ $date = ''; }
				if($time == NULL){ $time = ''; }
				if($uid  == NULL){ $uid  = ''; }
				
				$tit = $tcms_main->decodeText($tit, '2', $c_charset);
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;news='.$uid.'&amp;s='.$s;
				$link = $tcms_main->urlAmpReplace($link);
				
				echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
				echo '<div class="search_result"><span class="text_small">'.$date.' - '.$time.'</span></div>';
				echo '<br />';
				
				$sc++;
			}
		}
	}
	
	return $sc;
}






function search_products($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s){
	//$tcms_main = new tcms_main($tcms_administer_site);
	//$tcms_main->setGlobalFolder($seoFolder, $seoEnabled);
	global $tcms_db_prefix;
	global $tcms_main;
	global $tcms_administer_site;
	
	if($choosenDB == 'xml'){
		$arr_searchfiles = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_products/', 'files');
		
		if(is_array($arr_searchfiles)){
			foreach($arr_searchfiles as $skey => $sval){
				//echo $sval.'<br>';
				$arr_searchfiles2 = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_products/'.$sval, 'files');
				
				if(is_array($arr_searchfiles2)){
					foreach($arr_searchfiles2 as $skey2 => $sval2){
						if($sval2 != 'folderinfo.xml'){
							$search_xml = new xmlparser($tcms_administer_site.'/tcms_products/'.$sval.'/'.$sval2,'r');
							
							$acs = $xml->read_section('main', 'access');
							
							$canRead = $this->checkAccess($acs, $is_admin);
							
							if($canRead){
								$out = $search_xml->search_value_front('info', 'product', $searchword);
								
								if($out != false){
									$tit = $search_xml->read_section('info', 'product');
									$desc = $search_xml->read_section('info', 'desc');
									$category = $search_xml->read_section('info', 'category');
									
									$tit = $tcms_main->decodeText($tit, '2', $c_charset);
									$desc = $tcms_main->decodeText($desc, '2', $c_charset);
									
									$toendaScript = new toendaScript($desc);
									$desc = $toendaScript->toendaScript_trigger();
									$key = $toendaScript->checkSEO($key, $imagePath);
									
									$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=products&amp;category='.$category.'&amp;article='.substr($sval, 0, 10).'&amp;s='.$s;
									$link = $tcms_main->urlAmpReplace($link);
									
									echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
									echo '<div class="search_result"><span class="text_small">'.substr($desc, 0, 500).'</span></div>';
									echo '<br />';
									
									$sc++;
								}
								else{
									$out = $search_xml->search_value_front('info', 'desc', $searchword);
									if($out != false){
										$tit = $search_xml->read_section('info', 'product');
										$desc = $search_xml->read_section('info', 'desc');
										$category = $search_xml->read_section('info', 'category');
										
										$tit = $tcms_main->decodeText($tit, '2', $c_charset);
										$desc = $tcms_main->decodeText($desc, '2', $c_charset);
										
										$toendaScript = new toendaScript($desc);
										$desc = $toendaScript->toendaScript_trigger();
										$key = $toendaScript->checkSEO($key, $imagePath);
										
										$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=products&amp;category='.$category.'&amp;article='.substr($sval, 0, 10).'&amp;s='.$s;
										$link = $tcms_main->urlAmpReplace($link);
										
										echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
										echo '<div class="search_result"><span class="text_small">'.substr($desc, 0, 500).'</span></div>';
										echo '<br />';
										
										$sc++;
									}
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
		
		switch($choosenDB){
			case 'mysql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."products"
				." WHERE ( `access` = 'Public' "
				.$strAdd
				." AND ( `name` REGEXP '".$searchword."' OR `name` LIKE '%".$searchword."%' )"
				." OR ( `desc` REGEXP '".$searchword."' OR `desc` LIKE '%".$searchword."%' )";
				break;
			
			case 'pgsql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."products"
				." WHERE ( access = 'Public' "
				.$strAdd
				." AND ( name LIKE '%".$searchword."%' )"
				." OR ( desc LIKE '%".$searchword."%' )";
				break;
			
			case 'mssql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."products"
				." WHERE ( [access] = 'Public' "
				.$strAdd
				." AND ( [name] LIKE '%".$searchword."%' )"
				." OR ( [desc] LIKE '%".$searchword."%' )";
				break;
		}
		
		$sqlQR = $sqlAL->sqlQuery($strSQL);
		$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
		
		if($sqlNR != 0){
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$tit = $sqlARR['name'];
				$desc = $sqlARR['desc'];
				$category = $sqlARR['category'];
				$uid = $sqlARR['uid'];
				
				if($tit  == NULL){ $tit  = ''; }
				if($desc == NULL){ $desc = ''; }
				if($uid  == NULL){ $uid  = ''; }
				
				$tit = $tcms_main->decodeText($tit, '2', $c_charset);
				$desc = $tcms_main->decodeText($desc, '2', $c_charset);
				
				$toendaScript = new toendaScript($desc);
				$desc = $toendaScript->toendaScript_trigger();
				$desc = $toendaScript->checkSEO($desc, $imagePath);
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=products&amp;category='.$category.'&amp;article='.$uid.'&amp;s='.$s;
				$link = $tcms_main->urlAmpReplace($link);
				
				echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
				echo '<div class="search_result"><span class="text_normal">'.substr($desc, 0, 500).'</span></div>';
				echo '<br />';
				
				$sc++;
			}
		}
	}
	
	return $sc;
}






function search_downloads($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s){
	//$tcms_main = new tcms_main('data');
	//$tcms_main->setGlobalFolder($seoFolder, $seoEnabled);
	global $tcms_db_prefix;
	global $tcms_main;
	global $tcms_administer_site;
	
	if($choosenDB == 'xml'){
		$arr_searchfiles = $tcms_main->readdir_ext($tcms_administer_site.'/files/', 'files');
		
		if(is_array($arr_searchfiles)){
			foreach($arr_searchfiles as $skey => $sval){
				if($sval != 'index.html'){
					$xml = new xmlparser($tcms_administer_site.'/files/'.$sval.'/info.xml','r');
					$type = $xml->read_section('info', 'sql_type');
					
					$acs = $xml->read_section('info', 'access');
					
					$canRead = $tcms_main->checkAccess($acs, $is_admin);
					
					if($canRead){
						$out = $xml->search_value_front('info', 'title', $searchword);
						
						if($type == 'f'){
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=download&amp;category='.$uid.'&amp;s='.$s;
							$link = $tcms_main->urlAmpReplace($link);
						}
						else{
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=download'.( $parent != null ? '&amp;category='.$parent : '' ).'&amp;s='.$s;
							$link = $tcms_main->urlAmpReplace($link);
						}
						
						if($out != false){
							$tit = $xml->read_section('info', 'name');
							$desc = $xml->read_section('info', 'desc');
							$category = $xml->read_section('info', 'category');
							
							$tit = $tcms_main->decodeText($tit, '2', $c_charset);
							$desc = $tcms_main->decodeText($desc, '2', $c_charset);
							
							$toendaScript = new toendaScript($desc);
							$desc = $toendaScript->doParse();
							$key = $toendaScript->checkSEO($key, $imagePath);
							
							echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
							echo '<div class="search_result"><span class="text_small">'.substr($desc, 0, 500).'</span></div>';
							echo '<br />';
							
							$sc++;
						}
						else{
							$out = $xml->search_value_front('info', 'desc', $searchword);
							if($out != false){
								$tit = $xml->read_section('info', 'name');
								$desc = $xml->read_section('info', 'desc');
								$category = $xml->read_section('info', 'category');
								
								$tit = $tcms_main->decodeText($tit, '2', $c_charset);
								$desc = $tcms_main->decodeText($desc, '2', $c_charset);
								
								$toendaScript = new toendaScript($desc);
								$desc = $toendaScript->doParse();
								$key = $toendaScript->checkSEO($key, $imagePath);
								
								echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
								echo '<div class="search_result"><span class="text_small">'.substr($desc, 0, 500).'</span></div>';
								echo '<br />';
								
								$sc++;
							}
						}
					}
					
					$xml->flush();
					$xml->_xmlparser();
					unset($xml);
				}
			}
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
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
		
		switch($choosenDB){
			case 'mysql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."downloads"
				." WHERE ( `access` = 'Public' "
				.$strAdd
				." AND ( `name` REGEXP '".$searchword."' OR `name` LIKE '%".$searchword."%' )"
				." OR ( `desc` REGEXP '".$searchword."' OR `desc` LIKE '%".$searchword."%' )"
				." OR ( `file` REGEXP '".$searchword."' OR `file` LIKE '%".$searchword."%' )";
				break;
			
			case 'pgsql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."downloads"
				." WHERE ( access = 'Public' "
				.$strAdd
				." AND ( name LIKE '%".$searchword."%' )"
				." OR ( desc LIKE '%".$searchword."%' )"
				." OR ( file LIKE '%".$searchword."%' )";
				break;
			
			case 'mssql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."downloads"
				." WHERE ( [access] = 'Public' "
				.$strAdd
				." AND ( [name] LIKE '%".$searchword."%' )"
				." OR ( [desc] LIKE '%".$searchword."%' )"
				." OR ( [file] LIKE '%".$searchword."%' )";
				break;
		}
		
		$sqlQR = $sqlAL->sqlQuery($strSQL);
		$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
		
		if($sqlNR != 0){
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$tit = $sqlARR['name'];
				$desc = $sqlARR['desc'];
				$category = $sqlARR['category'];
				$uid = $sqlARR['uid'];
				$type = $sqlARR['type'];
				$parent = $sqlARR['parent'];
				
				if($tit  == NULL){ $tit  = ''; }
				if($desc == NULL){ $desc = ''; }
				if($uid  == NULL){ $uid  = ''; }
				
				$tit = $tcms_main->decodeText($tit, '2', $c_charset);
				$desc = $tcms_main->decodeText($desc, '2', $c_charset);
				
				$toendaScript = new toendaScript($desc);
				$desc = $toendaScript->toendaScript_trigger();
				$key = $toendaScript->checkSEO($key, $imagePath);
				
				if($type == 'f'){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=download&amp;category='.$uid.'&amp;s='.$s;
					$link = $tcms_main->urlAmpReplace($link);
				}
				else{
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=download'.( $parent != null ? '&amp;category='.$parent : '' ).'&amp;s='.$s;
					$link = $tcms_main->urlAmpReplace($link);
				}
				
				echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
				echo '<div class="search_result"><span class="text_normal">'.substr($desc, 0, 500).'</span></div>';
				echo '<br />';
				
				$sc++;
			}
		}
	}
	
	return $sc;
}






function search_images($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s){
	//$tcms_main = new tcms_main('data');
	//$tcms_main->setGlobalFolder($seoFolder, $seoEnabled);
	global $tcms_db_prefix;
	global $tcms_main;
	global $tcms_administer_site;
	
	if($choosenDB == 'xml'){
		$arr_searchfiles = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_imagegallery/', 'files');
		
		if(is_array($arr_searchfiles)){
			foreach($arr_searchfiles as $skey => $sval){
				$arr_searchfiles2 = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_imagegallery/'.$sval, 'files');
				//echo $sval;
				if(is_array($arr_searchfiles2)){
					foreach($arr_searchfiles2 as $skey2 => $sval2){
						$search_xml = new xmlparser($tcms_administer_site.'/tcms_imagegallery/'.$sval.'/'.$sval2,'r');
						
						$tit = substr($sval2, 0, strpos($sval2, '.xml'));
						
						if($tit == $searchword){
							$desc = $search_xml->read_section('image', 'text');
							$category = $sval;
							
							$desc = $tcms_main->decodeText($desc, '2', $c_charset);
							
							$toendaScript = new toendaScript($desc);
							$desc = $toendaScript->toendaScript_trigger();
							
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=imagegallery&amp;albums='.$category.'&amp;s='.$s;
							$link = $tcms_main->urlAmpReplace($link);
							
							echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
							echo '<div class="search_result"><span class="text_small">'.substr($desc, 0, 500).'</span></div>';
							echo '<br />';
							
							$sc++;
						}
					}
				}
			}
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		switch($choosenDB){
			case 'mysql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."imagegallery"
				." WHERE ( `image` REGEXP '".$searchword."' OR `image` LIKE '%".$searchword."%' )"
				." OR ( `text` REGEXP '".$searchword."' OR `text` LIKE '%".$searchword."%' )";
				break;
			
			case 'pgsql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."imagegallery"
				." WHERE ( image LIKE '%".$searchword."%' )"
				." OR ( text LIKE '%".$searchword."%' )";
				break;
			
			case 'mssql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."imagegallery"
				." WHERE ( [image] LIKE '%".$searchword."%' )"
				." OR ( [text] LIKE '%".$searchword."%' )";
				break;
		}
		
		$sqlQR = $sqlAL->sqlQuery($strSQL);
		$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
		
		if($sqlNR != 0){
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$tit = $sqlARR['image'];
				$desc = $sqlARR['text'];
				$category = $sqlARR['album'];
				$uid = $sqlARR['uid'];
				
				if($tit  == NULL){ $tit  = ''; }
				if($desc == NULL){ $desc = ''; }
				if($uid  == NULL){ $uid  = ''; }
				
				$tit = $tcms_main->decodeText($tit, '2', $c_charset);
				$desc = $tcms_main->decodeText($desc, '2', $c_charset);
				
				$toendaScript = new toendaScript($desc);
				$desc = $toendaScript->toendaScript_trigger();
				$desc = $toendaScript->checkSEO($desc, $imagePath);
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=imagegallery&amp;albums='.$category.'&amp;s='.$s;
				$link = $tcms_main->urlAmpReplace($link);
				
				echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
				echo '<div class="search_result"><span class="text_normal">'.$desc.'</span></div>';
				echo '<br />';
				
				$sc++;
			}
		}
		else{
			$sqlQR = $sqlAL->sqlSearch($tcms_db_prefix.'imagegallery', 'text', $searchword);
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			
			if($sqlNR != 0){
				while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
					$tit = $sqlARR['image'];
					$desc = $sqlARR['text'];
					$category = $sqlARR['album'];
					$uid = $sqlARR['uid'];
					
					if($tit  == NULL){ $tit  = ''; }
					if($desc == NULL){ $desc = ''; }
					if($uid  == NULL){ $uid  = ''; }
					
					$tit = $tcms_main->decodeText($tit, '2', $c_charset);
					$desc = $tcms_main->decodeText($desc, '2', $c_charset);
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=imagegallery&amp;albums='.$category.'&amp;s='.$s;
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
					echo '<div class="search_result"><span class="text_normal">'.$desc.'</span></div>';
					echo '<br />';
					
					$sc++;
				}
			}
		}
	}
	
	return $sc;
}






function search_faqs($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s){
	global $tcms_db_prefix;
	global $tcms_main;
	global $tcms_administer_site;
	
	if($choosenDB == 'xml'){
		$arr_searchfiles = $tcms_main->readdir_ext($tcms_main->getAdministerSite().'/tcms_knowledgebase/', 'files');
		
		if(is_array($arr_searchfiles)){
			foreach($arr_searchfiles as $skey => $sval){
				$xml = new xmlparser($tcms_main->getAdministerSite().'/tcms_knowledgebase/'.$sval,'r');
				
				$found = false;
				
				$out = $xml->search_value_front('faq', 'content', $searchword);
				
				if($out == false){
					$out = $xml->search_value_front('faq', 'subtitle', $searchword);
					
					if($out == false){
						$out = $xml->search_value_front('faq', 'title', $searchword);
						
						if($out == false) $found = false;
						else $found = true;
					}
					else $found = true;
				}
				else $found = true;
					
				if($found){
					$acs = $xml->read_section('faq', 'access');
					
					/*
						check access
					*/
					if($acs != 'Public'){
						if($check_session){
							switch($acs){
								case 'Protected':
									if($is_admin == 'User' 
									|| $is_admin == 'Administrator' 
									|| $is_admin == 'Developer' 
									|| $is_admin == 'Editor' 
									|| $is_admin == 'Writer' 
									|| $is_admin == 'Presenter'){ $show_this_category = true; }
									else{ $show_this_category = false; }
									break;
								
								case 'Private':
									if($is_admin == 'Administrator' || $is_admin == 'Developer'){ $show_this_category = true; }
									else{ $show_this_category = false; }
									break;
							}
						}
						else{ $show_this_category = false; }
					}
					else{ $show_this_category = true; }
					
					if($show_this_category){
						$tit = $xml->read_section('faq', 'title');
						$subtit = $xml->read_section('faq', 'subtitle');
						$category = $xml->read_section('faq', 'category');
						
						$tit = $tcms_main->decodeText($tit, '2', $c_charset);
						$subtit = $tcms_main->decodeText($subtit, '2', $c_charset);
						
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=knowledgebase&amp;action=detail'.( $category != '' ? '&amp;category' : '' ).'&amp;article='.substr($sval, 0, 10).'&amp;s='.$s;
						$link = $tcms_main->urlAmpReplace($link);
						
						//echo '<div class="search_result"><span class="text_small">'.$date.' - '.$subtit.'</span></div>';
						
						echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
						echo tcms_html::search_result($subtit);
						echo '<br />';
						
						$sc++;
					}
				}
			}
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
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
		
		switch($choosenDB){
			case 'mysql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."knowledgebase"
				." WHERE ( `access` = 'Public' "
				.$strAdd
				." AND ( `content` REGEXP '".$searchword."' OR `content` LIKE '%".$searchword."%' )"
				." OR ( `subtitle` REGEXP '".$searchword."' OR `subtitle` LIKE '%".$searchword."%' )"
				." OR ( `title` REGEXP '".$searchword."' OR `title` LIKE '%".$searchword."%' )";
				break;
			
			case 'pgsql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."knowledgebase"
				." WHERE ( access = 'Public' "
				.$strAdd
				." AND ( content LIKE '%".$searchword."%' )"
				." OR ( subtitle LIKE '%".$searchword."%' )"
				." OR ( title LIKE '%".$searchword."%' )";
				break;
			
			case 'mssql':
				$strSQL = "SELECT *"
				." FROM ".$tcms_db_prefix."knowledgebase"
				." WHERE ( [access] = 'Public' "
				.$strAdd
				." AND ( [content] LIKE '%".$searchword."%' )"
				." OR ( [subtitle] LIKE '%".$searchword."%' )"
				." OR ( [title] LIKE '%".$searchword."%' )";
				break;
		}
		
		$sqlQR = $sqlAL->sqlQuery($strSQL);
		$sqlQR = $sqlAL->sqlSearch($tcms_db_prefix.'knowledgebase', 'content', $searchword);
		$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
		
		if($sqlNR != 0){
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$tit = $sqlARR['title'];
				$subtit = $sqlARR['subtitle'];
				$desc = $sqlARR['content'];
				$uid = $sqlARR['uid'];
				$cat = $sqlARR['category'];
				$type = $sqlARR['type'];
				
				if($tit     == NULL){ $tit     = ''; }
				if($desc    == NULL){ $desc    = ''; }
				if($subtit  == NULL){ $subtit  = ''; }
				if($uid     == NULL){ $uid     = ''; }
				if($cat     == NULL){ $cat     = ''; }
				if($type    == NULL){ $type    = ''; }
				
				$tit = $tcms_main->decodeText($tit, '2', $c_charset);
				$subtit = $tcms_main->decodeText($subtit, '2', $c_charset);
				$desc = $tcms_main->decodeText($desc, '2', $c_charset);
				
				$toendaScript = new toendaScript($desc);
				$desc = $toendaScript->toendaScript_trigger();
				$desc = $toendaScript->checkSEO($desc, $imagePath);
				
				$desc = substr($desc, 0, 200).' ...';
				
				switch($type){
					case 'c':
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=knowledgebase&amp;s='.$s.'&amp;cmd=list'.( $cat != '' ? '&amp;category='.$cat : '' );
						$link = $tcms_main->urlAmpReplace($link);
						break;
					
					case 'a':
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=knowledgebase&amp;s='.$s.'&amp;cmd=detail'.( $cat != '' ? '&amp;category='.$cat : '' ).'&amp;article='.$uid;
						$link = $tcms_main->urlAmpReplace($link);
						break;
				}
				
				echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
				echo '<div class="search_result"><span class="text_normal">'.$desc.'</span></div>';
				echo '<br />';
				
				$sc++;
			}
		}
	}
	
	return $sc;
}



?>
