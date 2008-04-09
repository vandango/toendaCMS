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
| File:	ext_search_result.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Search Result Page
 *
 * This module is used as a search module.
 *
 * @version 0.7.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content-Modules
 */


if(isset($_POST['option'])){ $option = $_POST['option']; }
if(isset($_POST['searchword'])){ $searchword = $_POST['searchword']; }



if($choosenDB == 'xml'){
	$search_xml   = new xmlparser(_TCMS_PATH.'/tcms_global/sidebar.xml','r');
	$search_title = $search_xml->readSection('side', 'search_title');
	
	$search_title = $tcms_main->decodeText($search_title, '2', $c_charset);
	
	$search_xml->flush();
	unset($search_xml);
}
else{
	$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
	$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$sqlQR = $sqlAL->getOne($tcms_db_prefix.'sidebar_extensions', 'sidebar_extensions');
	$sqlObj = $sqlAL->fetchObject($sqlQR);
	
	$search_title = $sqlObj->search_title;
	
	$sqlAL->freeResult($sqlQR);
	unset($sqlAL);
	
	$search_title = $tcms_main->decodeText($search_title, '2', $c_charset);
}





echo $tcms_html->contentModuleHeader(_SEARCH_TITLE, $search_title, '');

echo '<form action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?" method="post">'
.'<input type="hidden" name="id" value="search" />'
.'<input type="hidden" name="s" value="'.$s.'" />'
.( isset($session) ? '<input type="hidden" name="session" value="'.$session.'" />' : '' )
.( isset($lang) ? '<input type="hidden" name="lang" value="'.$lang.'" />' : '' );


if(!isset($option)) {
	$option = 'con';
}


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

if($choosenDB == 'xml') {
	if(in_array('newsmanager', $arr_side_navi['url']) || in_array('newsmanager', $arr_top_navi['id'])){
		echo '<div style="display:block; width:120px; float:left;">'
		.'<label for="news">'
		.'<input type="radio" style="border: 0px !important;" id="news" name="option" value="news"'.( $option == 'news' ? ' checked="checked"' : '' ).' />'
		.'&nbsp;'._TCMS_MENU_NEWS
		.'</label>'
		.'</div>';
	}
}
else {
	echo '<div style="display:block; width:120px; float:left;">'
	.'<label for="news">'
	.'<input type="radio" style="border: 0px !important;" id="news" name="option" value="news"'.( $option == 'news' ? ' checked="checked"' : '' ).' />'
	.'&nbsp;'._TCMS_MENU_NEWS
	.'</label>'
	.'</div>';
}

if($choosenDB == 'xml') {
	if(in_array('products', $arr_side_navi['url']) || in_array('products', $arr_top_navi['id'])){
		echo '<div style="display:block;">'
		.'<label for="pro">'
		.'<input type="radio" style="border: 0px !important;" name="option" id="pro" value="pro"'.( $option == 'pro' ? ' checked="checked"' : '' ).' />'
		.'&nbsp;'._TCMS_MENU_PRODUCTS
		.'</label>'
		.'</div>';
	}
}
else {
	echo '<div style="display:block;">'
	.'<label for="pro">'
	.'<input type="radio" style="border: 0px !important;" name="option" id="pro" value="pro"'.( $option == 'pro' ? ' checked="checked"' : '' ).' />'
	.'&nbsp;'._TCMS_MENU_PRODUCTS
	.'</label>'
	.'</div>';
}

if($choosenDB == 'xml') {
	if(in_array('download', $arr_side_navi['url']) || in_array('download', $arr_top_navi['id'])){
		echo '<div style="display:block; width:120px; float:left;">'
		.'<label for="down">'
		.'<input type="radio" style="border: 0px !important;" id="down" name="option" value="down"'.( $option == 'down' ? ' checked="checked"' : '' ).' />'
		.'&nbsp;'._TCMS_MENU_DOWN
		.'</label>'
		.'</div>';
	}
}
else {
	echo '<div style="display:block; width:120px; float:left;">'
	.'<label for="down">'
	.'<input type="radio" style="border: 0px !important;" id="down" name="option" value="down"'.( $option == 'down' ? ' checked="checked"' : '' ).' />'
	.'&nbsp;'._TCMS_MENU_DOWN
	.'</label>'
	.'</div>';
}

if($choosenDB == 'xml') {
	if(in_array('imagegallery', $arr_side_navi['url']) || in_array('imagegallery', $arr_top_navi['id'])){
		echo '<div style="display:block; width:120px; float:left;">'
		.'<label for="img">'
		.'<input type="radio" style="border: 0px !important;" id="img" name="option" value="img"'.( $option == 'img' ? ' checked="checked"' : '' ).' />'
		.'&nbsp;'._TABLE_IMAGE
		.'</label>'
		.'</div>';
	}
}
else {
	echo '<div style="display:block; width:120px; float:left;">'
	.'<label for="img">'
	.'<input type="radio" style="border: 0px !important;" id="img" name="option" value="img"'.( $option == 'img' ? ' checked="checked"' : '' ).' />'
	.'&nbsp;'._TABLE_IMAGE
	.'</label>'
	.'</div>';
}

if($choosenDB == 'xml') {
	if(in_array('knowledgebase', $arr_side_navi['url']) || in_array('knowledgebase', $arr_top_navi['id'])){
		echo '<div style="display:block; width:130px; float:left;">'
		.'<label for="faq"><input type="radio" style="border: 0px !important;" id="faq" name="option" value="faq"'.( $option == 'faq' ? ' checked="checked"' : '' ).' />'
		.'&nbsp;'._TCMS_MENU_FAQ
		.'</label>'
		.'</div>';
	}
}
else {
	echo '<div style="display:block; width:130px; float:left;">'
	.'<label for="faq"><input type="radio" style="border: 0px !important;" id="faq" name="option" value="faq"'.( $option == 'faq' ? ' checked="checked"' : '' ).' />'
	.'&nbsp;'._TCMS_MENU_FAQ
	.'</label>'
	.'</div>';
}

echo '<div style="display:block;">'
.'<label for="all">'
.'<input type="radio" style="border: 0px !important;" name="option" id="all" value="all"'.( $option == 'all' ? ' checked="checked"' : '' ).' />'
.'&nbsp;'._NEWS_ALL
.'</label>'
.'</div>';

echo '</div>'
.'</form>';

echo '<br />';

echo $tcms_html->searchResultTitle(_SEARCH_TEXT_FOUND)
.'<br />';

$nothing_search = _SEARCH_BOX;
$sc = 0;

if($searchword == '') {
	echo $tcms_html->contentText(_SEARCH_START);
}
elseif($searchword == $nothing_search) {
	echo $tcms_html->contentText(_SEARCH_EMPTY);
}
else {
	using('toendacms.kernel.search');
	
	$tcms_search = new tcms_search(
		$c_charset, 
		$s, 
		_TCMS_PATH, 
		$is_admin, 
		$tcms_time, 
		$tcms_html, 
		$tcms_config
	);
	
	switch($option){
		case 'con':
			// documents
			echo '<div id="document_sr">'
			.$tcms_html->contentUnderlinedTitle(
				_TCMS_MENU_CONTENT
			).'</div>';
			
			$sc = $tcms_search->searchDocuments(
				$searchword, 
				$tcms_config->getLanguageFrontend()
			);
			
			if($sc > 0) {
				echo '<script type="text/javascript" language="JavaScript">'
				.'showXP(\'document_sr\');'
				.'</script>'
				.'<br />';
			}
			else {
				echo '<script type="text/javascript" language="JavaScript">'
				.'hideXP(\'document_sr\');'
				.'</script>';
			}
			break;
		
		case 'news':
			// news
			echo '<div id="news_sr">'
			.$tcms_html->contentUnderlinedTitle(
				_TCMS_MENU_NEWS
			).'</div>';
			
			$sc = $tcms_search->searchNews(
				$searchword, 
				$tcms_config->getLanguageFrontend()
			);
			
			if($sc > 0) {
				echo '<script type="text/javascript" language="JavaScript">'
				.'showXP(\'news_sr\');'
				.'</script>'
				.'<br />';
			}
			else {
				echo '<script type="text/javascript" language="JavaScript">'
				.'hideXP(\'news_sr\');'
				.'</script>';
			}
			break;
		
		case 'pro':
			// products
			echo '<div id="products_sr">'
			.$tcms_html->contentUnderlinedTitle(
				_TCMS_MENU_PRODUCTS
			).'</div>';
			
			$sc = search_products($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			
			if($sc > 0) {
				echo '<script type="text/javascript" language="JavaScript">'
				.'showXP(\'products_sr\');'
				.'</script>'
				.'<br />';
			}
			else {
				echo '<script type="text/javascript" language="JavaScript">'
				.'hideXP(\'products_sr\');'
				.'</script>';
			}
			break;
		
		case 'down':
			// downloads
			echo '<div id="down_sr">'
			.$tcms_html->contentUnderlinedTitle(
				_TCMS_MENU_DOWN
			).'</div>';
			
			$sc = search_downloads($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			
			if($sc > 0) {
				echo '<script type="text/javascript" language="JavaScript">'
				.'showXP(\'down_sr\');'
				.'</script>'
				.'<br />';
			}
			else {
				echo '<script type="text/javascript" language="JavaScript">'
				.'hideXP(\'down_sr\');'
				.'</script>';
			}
			break;
		
		case 'img':
			// images
			echo '<div id="img_sr">'
			.$tcms_html->contentUnderlinedTitle(
				_TCMS_MENU_GALLERY
			).'</div>';
			
			$sc = search_images($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			
			if($sc > 0) {
				echo '<script type="text/javascript" language="JavaScript">'
				.'showXP(\'img_sr\');'
				.'</script>'
				.'<br />';
			}
			else {
				echo '<script type="text/javascript" language="JavaScript">'
				.'hideXP(\'img_sr\');'
				.'</script>';
			}
			break;
		
		case 'faq':
			// faq
			echo '<div id="faq_sr">'
			.$tcms_html->contentUnderlinedTitle(
				_TCMS_MENU_FAQ
			).'</div>';
			
			$sc = search_faqs($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			
			if($sc > 0) {
				echo '<script type="text/javascript" language="JavaScript">'
				.'showXP(\'faq_sr\');'
				.'</script>'
				.'<br />';
			}
			else {
				echo '<script type="text/javascript" language="JavaScript">'
				.'hideXP(\'faq_sr\');'
				.'</script>';
			}
			break;
		
		case 'all':
			// documents
			echo '<div id="document_sr">'
			.$tcms_html->contentUnderlinedTitle(
				_TCMS_MENU_CONTENT
			).'</div>';
			
			$sc_all = $tcms_search->searchDocuments(
				$searchword, 
				$tcms_config->getLanguageFrontend()
			);
			
			if($sc_all > 0) {
				$sc++;
				
				echo '<script type="text/javascript" language="JavaScript">'
				.'showXP(\'document_sr\');'
				.'</script>'
				.'<br />';
			}
			else {
				echo '<script type="text/javascript" language="JavaScript">'
				.'hideXP(\'document_sr\');'
				.'</script>';
			}
			
			// news
			echo '<div id="news_sr">'
			.$tcms_html->contentUnderlinedTitle(
				_TCMS_MENU_NEWS
			).'</div>';
			
			$sc_all = $tcms_search->searchNews(
				$searchword, 
				$tcms_config->getLanguageFrontend()
			);
			
			if($sc_all > 0) {
				$sc++;
				
				echo '<script type="text/javascript" language="JavaScript">'
				.'showXP(\'news_sr\');'
				.'</script>'
				.'<br />';
			}
			else {
				echo '<script type="text/javascript" language="JavaScript">'
				.'hideXP(\'news_sr\');'
				.'</script>';
			}
			
			// products
			echo '<div id="products_sr">'
			.$tcms_html->contentUnderlinedTitle(
				_TCMS_MENU_PRODUCTS
			).'</div>';
			
			$sc_all = search_products($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			
			if($sc_all > 0) {
				$sc++;
				
				echo '<script type="text/javascript" language="JavaScript">'
				.'showXP(\'products_sr\');'
				.'</script>'
				.'<br />';
			}
			else {
				echo '<script type="text/javascript" language="JavaScript">'
				.'hideXP(\'products_sr\');'
				.'</script>';
			}
			
			// downloads
			echo '<div id="down_sr">'
			.$tcms_html->contentUnderlinedTitle(
				_TCMS_MENU_DOWN
			).'</div>';
			
			
			$sc_all = search_downloads($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			
			if($sc_all > 0) {
				$sc++;
				
				echo '<script type="text/javascript" language="JavaScript">'
				.'showXP(\'down_sr\');'
				.'</script>'
				.'<br />';
			}
			else {
				echo '<script type="text/javascript" language="JavaScript">'
				.'hideXP(\'down_sr\');'
				.'</script>';
			}
			
			// images
			echo '<div id="img_sr">'
			.$tcms_html->contentUnderlinedTitle(
				_TCMS_MENU_GALLERY
			).'</div>';
			
			$sc_all = search_images($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			
			if($sc_all > 0) {
				$sc++;
				
				echo '<script type="text/javascript" language="JavaScript">'
				.'showXP(\'img_sr\');'
				.'</script>'
				.'<br />';
			}
			else {
				echo '<script type="text/javascript" language="JavaScript">'
				.'hideXP(\'img_sr\');'
				.'</script>';
			}
			
			// faq
			echo '<div id="faq_sr">'
			.$tcms_html->contentUnderlinedTitle(
				_TCMS_MENU_FAQ
			).'</div>';
			
			$sc_all = search_faqs($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s);
			
			if($sc_all > 0) {
				$sc++;
				
				echo '<script type="text/javascript" language="JavaScript">'
				.'showXP(\'faq_sr\');'
				.'</script>'
				.'<br />';
			}
			else {
				echo '<script type="text/javascript" language="JavaScript">'
				.'hideXP(\'faq_sr\');'
				.'</script>';
			}
			
			//$sc = 1;
			break;
	}
	
	if($sc == 0) {
		echo $tcms_html->contentText(
			_SEARCH_NOTFOUND_1.'&nbsp;'.$searchword.'&nbsp;'._SEARCH_NOTFOUND_2
		);
	}
	
	echo '<br />'
	.$tcms_html->contentUnderlinedTitle(
		_SEARCH_WEBSEARCH
	)
	.$tcms_html->searchPanel(
		_SEARCH_WITH_GOOGLE, 
		'http://www.google.com/search?q='.$searchword, 
		$imagePath.'engine/images/logos/google.png'
	)
	.'<br />'
	.$tcms_html->searchPanel(
		_SEARCH_WITH_GOOGLE, 
		'http://search.yahoo.com/search?p='.$searchword, 
		$imagePath.'engine/images/logos/yahoo.png'
	);
}






function search_products($searchword, $choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session, $s){
	global $tcms_db_prefix;
	global $tcms_main;
	global $tcms_administer_site;
	global $lang;
	
	if($choosenDB == 'xml'){
		$arr_searchfiles = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_products/', 'files');
		
		if(is_array($arr_searchfiles)){
			foreach($arr_searchfiles as $skey => $sval){
				//echo $sval.'<br>';
				$arr_searchfiles2 = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_products/'.$sval, 'files');
				
				if(is_array($arr_searchfiles2)){
					foreach($arr_searchfiles2 as $skey2 => $sval2){
						if($sval2 != 'folderinfo.xml'){
							$search_xml = new xmlparser(_TCMS_PATH.'/tcms_products/'.$sval.'/'.$sval2,'r');
							
							$acs = $xml->readSection('main', 'access');
							
							$canRead = $this->checkAccess($acs, $is_admin);
							
							if($canRead){
								$out = $search_xml->search_value_front('info', 'product', $searchword);
								
								if($out != false){
									$tit = $search_xml->readSection('info', 'product');
									$desc = $search_xml->readSection('info', 'desc');
									$category = $search_xml->readSection('info', 'category');
									
									$tit = $tcms_main->decodeText($tit, '2', $c_charset);
									$desc = $tcms_main->decodeText($desc, '2', $c_charset);
									
									$toendaScript = new toendaScript($desc);
									$desc = $toendaScript->doParse();
									$desc = $toendaScript->checkSEO($desc, $imagePath);
									
									$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
									.'id=products&amp;category='.$category.'&amp;article='.substr($sval, 0, 10).'&amp;s='.$s
									.( isset($lang) ? '&amp;lang='.$lang : '' );
									$link = $tcms_main->urlConvertToSEO($link);
									
									echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
									echo '<div class="search_result"><span class="text_small">'.substr($desc, 0, 500).'</span></div>';
									echo '<br />';
									
									$sc++;
								}
								else{
									$out = $search_xml->search_value_front('info', 'desc', $searchword);
									if($out != false){
										$tit = $search_xml->readSection('info', 'product');
										$desc = $search_xml->readSection('info', 'desc');
										$category = $search_xml->readSection('info', 'category');
										
										$tit = $tcms_main->decodeText($tit, '2', $c_charset);
										$desc = $tcms_main->decodeText($desc, '2', $c_charset);
										
										$toendaScript = new toendaScript($desc);
										$desc = $toendaScript->doParse();
										$desc = $toendaScript->checkSEO($desc, $imagePath);
										
										$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
										.'id=products&amp;category='.$category.'&amp;article='.substr($sval, 0, 10).'&amp;s='.$s
										.( isset($lang) ? '&amp;lang='.$lang : '' );
										$link = $tcms_main->urlConvertToSEO($link);
										
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
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
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
		
		$sqlQR = $sqlAL->query($strSQL);
		$sqlNR = $sqlAL->getNumber($sqlQR);
		
		if($sqlNR != 0){
			while($sqlObj = $sqlAL->fetchObject($sqlQR)){
				$tit = $sqlObj->name;
				$desc = $sqlObj->desc;
				$category = $sqlObj->category;
				$uid = $sqlObj->uid;
				$sql_type = $sqlObj->sql_type;
				
				if($tit  == NULL){ $tit  = ''; }
				if($desc == NULL){ $desc = ''; }
				if($uid  == NULL){ $uid  = ''; }
				
				$tit = $tcms_main->decodeText($tit, '2', $c_charset);
				$desc = $tcms_main->decodeText($desc, '2', $c_charset);
				
				$toendaScript = new toendaScript($desc);
				$desc = $toendaScript->doParse();
				$desc = $toendaScript->checkSEO($desc, $imagePath);
				
				if($sql_type == 'c') {
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=products&amp;action=showall'
					.'&amp;cmd=browse'
					.'&amp;category='.$uid
					.'&amp;s='.$s
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlConvertToSEO($link);
					
					echo '<a class="main" href="'.$link.'">'.$tit.'</a>'
					.'<div class="search_result">'
					.'<span class="text_normal"><em>'._PRODUCTS_CATEGORY.'</em></span>'
					.'</div>'
					.'<br />';
				}
				else {
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=products&amp;action=showone'
					.'&amp;article='.$uid
					.'&amp;s='.$s
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlConvertToSEO($link);
					
					echo '<a class="main" href="'.$link.'">'.$tit.'</a>'
					.'<div class="search_result">'
					.'<span class="text_normal">'
					.'<em>'._PRODUCTS_ARTICLE.'</em><br />'
					.( strlen($desc) > 500 ? substr($desc, 0, 500).'...' : $desc )
					.'</span>'
					.'</div>'
					.'<br />';
				}
				
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
	global $lang;
	
	if($choosenDB == 'xml'){
		$arr_searchfiles = $tcms_file->getPathContent(_TCMS_PATH.'/files/', 'files');
		
		if(is_array($arr_searchfiles)){
			foreach($arr_searchfiles as $skey => $sval){
				if($sval != 'index.html'){
					$xml = new xmlparser(_TCMS_PATH.'/files/'.$sval.'/info.xml','r');
					$type = $xml->readSection('info', 'sql_type');
					
					$acs = $xml->readSection('info', 'access');
					
					$canRead = $tcms_main->checkAccess($acs, $is_admin);
					
					if($canRead){
						$out = $xml->search_value_front('info', 'title', $searchword);
						
						if($type == 'f'){
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id=download&amp;category='.$uid.'&amp;s='.$s
							.( isset($lang) ? '&amp;lang='.$lang : '' );
							$link = $tcms_main->urlConvertToSEO($link);
						}
						else{
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id=download'.( $parent != null ? '&amp;category='.$parent : '' ).'&amp;s='.$s
							.( isset($lang) ? '&amp;lang='.$lang : '' );
							$link = $tcms_main->urlConvertToSEO($link);
						}
						
						if($out != false){
							$tit = $xml->readSection('info', 'name');
							$desc = $xml->readSection('info', 'desc');
							$category = $xml->readSection('info', 'category');
							
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
								$tit = $xml->readSection('info', 'name');
								$desc = $xml->readSection('info', 'desc');
								$category = $xml->readSection('info', 'category');
								
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
					unset($xml);
				}
			}
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
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
		
		$sqlQR = $sqlAL->query($strSQL);
		$sqlNR = $sqlAL->getNumber($sqlQR);
		
		if($sqlNR != 0){
			while($sqlARR = $sqlAL->fetchArray($sqlQR)){
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
				$desc = $toendaScript->doParse();
				$desc = $toendaScript->checkSEO($desc, $imagePath);
				
				if($type == 'f'){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=download&amp;category='.$uid.'&amp;s='.$s
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlConvertToSEO($link);
				}
				else{
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=download'.( $parent != null ? '&amp;category='.$parent : '' ).'&amp;s='.$s
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlConvertToSEO($link);
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
	global $lang;
	
	if($choosenDB == 'xml'){
		$arr_searchfiles = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_imagegallery/', 'files');
		
		if(is_array($arr_searchfiles)){
			foreach($arr_searchfiles as $skey => $sval){
				$arr_searchfiles2 = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_imagegallery/'.$sval, 'files');
				//echo $sval;
				if(is_array($arr_searchfiles2)){
					foreach($arr_searchfiles2 as $skey2 => $sval2){
						$search_xml = new xmlparser(_TCMS_PATH.'/tcms_imagegallery/'.$sval.'/'.$sval2,'r');
						
						$tit = substr($sval2, 0, strpos($sval2, '.xml'));
						
						if($tit == $searchword){
							$desc = $search_xml->readSection('image', 'text');
							$category = $sval;
							
							$desc = $tcms_main->decodeText($desc, '2', $c_charset);
							
							$toendaScript = new toendaScript($desc);
							$desc = $toendaScript->doParse();
							$desc = $toendaScript->checkSEO($desc, $imagePath);
							
							$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
							.'id=imagegallery&amp;albums='.$category.'&amp;s='.$s
							.( isset($lang) ? '&amp;lang='.$lang : '' );
							$link = $tcms_main->urlConvertToSEO($link);
							
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
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
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
		
		$sqlQR = $sqlAL->query($strSQL);
		$sqlNR = $sqlAL->getNumber($sqlQR);
		
		if($sqlNR != 0){
			while($sqlARR = $sqlAL->fetchArray($sqlQR)){
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
				$desc = $toendaScript->doParse();
				$desc = $toendaScript->checkSEO($desc, $imagePath);
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id=imagegallery&amp;albums='.$category.'&amp;s='.$s
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '<a class="main" href="'.$link.'">'.$tit.'</a>';
				echo '<div class="search_result"><span class="text_normal">'.$desc.'</span></div>';
				echo '<br />';
				
				$sc++;
			}
		}
		else{
			$sqlQR = $sqlAL->search($tcms_db_prefix.'imagegallery', 'text', $searchword);
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			if($sqlNR != 0){
				while($sqlARR = $sqlAL->fetchArray($sqlQR)){
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
					$desc = $toendaScript->doParse();
					$desc = $toendaScript->checkSEO($desc, $imagePath);
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=imagegallery&amp;albums='.$category.'&amp;s='.$s
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlConvertToSEO($link);
					
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
	global $lang;
	
	if($choosenDB == 'xml'){
		$arr_searchfiles = $tcms_file->getPathContent($tcms_main->getAdministerSite().'/tcms_knowledgebase/', 'files');
		
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
					$acs = $xml->readSection('faq', 'access');
					
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
									|| $is_admin == 'Presenter') {
										$show_this_category = true;
									}
									else {
										$show_this_category = false;
									}
									break;
								
								case 'Private':
									if($is_admin == 'Administrator' || $is_admin == 'Developer') {
										$show_this_category = true;
									}
									else {
										$show_this_category = false;
									}
									break;
							}
						}
						else{ $show_this_category = false; }
					}
					else{ $show_this_category = true; }
					
					if($show_this_category){
						$tit = $xml->readSection('faq', 'title');
						$subtit = $xml->readSection('faq', 'subtitle');
						$category = $xml->readSection('faq', 'category');
						
						$tit = $tcms_main->decodeText($tit, '2', $c_charset);
						$subtit = $tcms_main->decodeText($subtit, '2', $c_charset);
						
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=knowledgebase&amp;action=detail'
						.( $category != '' ? '&amp;category' : '' ).'&amp;article='.substr($sval, 0, 10).'&amp;s='.$s
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlConvertToSEO($link);
						
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
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
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
		
		$sqlQR = $sqlAL->query($strSQL);
		$sqlQR = $sqlAL->search($tcms_db_prefix.'knowledgebase', 'content', $searchword);
		$sqlNR = $sqlAL->getNumber($sqlQR);
		
		if($sqlNR != 0){
			while($sqlARR = $sqlAL->fetchArray($sqlQR)){
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
				$desc = $toendaScript->doParse();
				$desc = $toendaScript->checkSEO($desc, $imagePath);
				
				$desc = substr($desc, 0, 200).' ...';
				
				switch($type){
					case 'c':
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=knowledgebase&amp;s='.$s.'&amp;cmd=list'.( $cat != '' ? '&amp;category='.$cat : '' )
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlConvertToSEO($link);
						break;
					
					case 'a':
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=knowledgebase&amp;s='.$s.'&amp;cmd=detail'.( $cat != '' ? '&amp;category='.$cat : '' ).'&amp;article='.$uid
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlConvertToSEO($link);
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
