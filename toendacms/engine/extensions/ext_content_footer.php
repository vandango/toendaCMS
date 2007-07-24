<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Website Content Footer
|
| File:	ext_content_footer.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Content footer
 *
 * Content footer with links for the "top of page", "print" 
 * and "pdf" functions.
 *
 * @version 0.5.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS
 */


//echo '<br />';
echo '<div align="left" class="contentFooter">';



/*
	Top of Page
*/

echo '<a href="#top">';

if($detect_browser == 1){
	echo '<script>if(browser == \'ie\'){'
	.'document.write(\'<img alt="'._TCMS_TOP_OF_PAGE.'" title="'._TCMS_TOP_OF_PAGE.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/top.gif" border="0" />\');'
	.'}else{'
	.'document.write(\'<img alt="'._TCMS_TOP_OF_PAGE.'" title="'._TCMS_TOP_OF_PAGE.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/top.png" border="0" />\');'
	.'}</script>';
	
	echo '<noscript>'
	.'<img alt="'._TCMS_TOP_OF_PAGE.'" title="'._TCMS_TOP_OF_PAGE.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/top.png" border="0" />'
	.'</noscript>';
}
else{
	echo '<img alt="'._TCMS_TOP_OF_PAGE.'" title="'._TCMS_TOP_OF_PAGE.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/top.png" border="0" />';
}

echo '</a>';

echo '&nbsp;';



/*
	Print
*/

if($id == 'register' 
|| $id == 'profile' 
|| $id == 'polls' 
|| $id == 'impressum' 
|| $id == 'imagegallery' 
|| $id == 'guestbook' 
|| $id == 'contactform' 
|| $id == 'products' 
|| $id == 'search' 
|| $id == 'download' 
|| $id == 'knowledgebase' 
|| $id == 'components' 
|| $id == 'frontpage' 
|| isset($cat) 
|| !isset($_GET['news'])){
	if($seoEnabled == 1){
		$print_url = $_SERVER['REQUEST_URI'];
		
		if($seoFormat == 0){
			$print_url = str_replace('/template:'.$s, '', $print_url);
			$modulSEO = 'seo0';
		}
		else{
			$print_url = str_replace('/template/'.$s, '', $print_url);
			$modulSEO = 'seo1';
		}
		
		$print_url = substr($print_url, strpos($print_url, 'index.php'));
	}
	else{
		$print_url = str_replace('&s='.$s, '', $_SERVER['QUERY_STRING']);
		$print_url = str_replace('&amp;s='.$s, '', $print_url);
		
		$modulSEO = 'modul';
	}
	
	echo '<a href="javascript:printWindow(\''.$print_url.'\', \''.$modulSEO.'\', \'\', \'\', \''.$imagePath.'\');">';
}
else{
	echo '<a href="javascript:printWindow(\''.$s.'\', \''.$id.'\', \''.$_GET['news'].'\', \''.$session.'\', \''.$imagePath.'\');">';
}

if($detect_browser == 1){
	echo '<script>if(browser == \'ie\'){'
	.'document.write(\'<img alt="'._TCMS_PRINT_PAGE.'" title="'._TCMS_PRINT_PAGE.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/print.gif" border="0" />\');'
	.'}else{'
	.'document.write(\'<img alt="'._TCMS_PRINT_PAGE.'" title="'._TCMS_PRINT_PAGE.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/print.png" border="0" />\');'
	.'}</script>';
	
	echo '<noscript>'
	.'<img alt="'._TCMS_PRINT_PAGE.'" title="'._TCMS_PRINT_PAGE.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/print.png" border="0" />'
	.'</noscript>';
}
else{
	echo '<img alt="'._TCMS_PRINT_PAGE.'" title="'._TCMS_PRINT_PAGE.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/print.png" border="0" />';
}

echo '</a>';



/*
	PDF
*/

if($tcms_config->usePDFLink()) {
	if($id != 'register' 
	&& $id != 'profile' 
	&& $id != 'polls' 
	&& $id != 'impressum' 
	&& $id != 'imagegallery' 
	&& $id != 'guestbook' 
	&& $id != 'contactform' 
	&& $id != 'search' 
	&& $id != 'links' 
	&& $id != 'knowledgebase' 
	&& $id != 'download' 
	&& $id != 'components' 
	&& $id != 'frontpage'){
		$show_pdf = false;
		
		switch(trim($id)){
			case 'newsmanager':
				if(isset($news) && $news != 'archive' && $news != 'start' && (!isset($cat) || $cat == '')){
					$pdfID = $id;
					$pdfCategory = '';
					$pdfArticle = '';
					$show_pdf = true;
				}
				break;
			
			case 'products':
				if(isset($category)){
					$pdfID = $id;
					$pdfCategory = $category;
					$pdfArticle = $article;
					$show_pdf = true;
				}
				break;
			
			default:
				$pdfID = $id;
				$pdfCategory = '';
				$pdfArticle = '';
				$show_pdf = true;
				break;
		}
		
		//if(trim($id) == 'products'){ $show_pdf = false; }
		
		if($show_pdf){
			echo '&nbsp;';
			echo '<a href="javascript:pdfWindow(\''.$s.'\', \''.$pdfID.'\', \''.$news.'\', \''.$pdfCategory.'\', \''.$pdfArticle.'\', \''.$session.'\', \''.$imagePath.'\');">';
			
			
			if($detect_browser == 1){
				echo '<script>if(browser == \'ie\'){'
				.'document.write(\'<img alt="'._TCMS_PDF_PAGE.'" title="'._TCMS_PDF_PAGE.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/pdf.gif" border="0" />\');'
				.'}else{'
				.'document.write(\'<img alt="'._TCMS_PDF_PAGE.'" title="'._TCMS_PDF_PAGE.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/pdf.png" border="0" />\');'
				.'}</script>';
				
				echo '<noscript>'
				.'<img alt="'._TCMS_PDF_PAGE.'" title="'._TCMS_PDF_PAGE.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/pdf.png" border="0" />'
				.'</noscript>';
			}
			else{
				echo '<img alt="'._TCMS_PDF_PAGE.'" title="'._TCMS_PDF_PAGE.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/pdf.png" border="0" />';
			}
			
			
			echo '</a>';
		}
	}
}



/*
	Author
*/

switch($id){
	case 'register'      : break;
	case 'profile'       : break;
	case 'search'        : break;
	case 'polls'         : break;
	case 'knowledgebase' : break;
	case 'components'    : break;
	case $download_id    : break;
	case $products_id    : break;
	case $send_id        : break;
	case 'links'         : break;
	case $book_id        : break;
	case $image_id       : break;
	case $news_id        : break;
	case $front_id       : break;
	case $imp_id         : break;
	
	default:
		if($show_doc_autor == 1){
			echo '&nbsp;&nbsp;'
			.'<img style="padding-top: 2px;" src="'.$imagePath.'engine/images/v_line.gif" border="0" />'
			.'&nbsp;&nbsp;';
			
			if($choosenDB == 'xml') $userID = $tcms_main->getUserID($docAutor);
			else $userID = $tcms_main->getUserIDfromSQL($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $docAutor);
			
			if(trim($docAutor) != ''){
				if($userID != false){
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=profile&amp;s='.$s.'&amp;u='.$userID
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlConvertToSEO($link);
					
					echo '<a style="text-decoration: none !important;" class="text_small" href="'.$link.'">';
				}
				
				
				if($detect_browser == 1){
					echo '<script>if(browser == \'ie\'){'
					.'document.write(\'<img alt="'._NEWS_WRITTEN.'&nbsp;'.$docAutor.'" title="'._NEWS_WRITTEN.'&nbsp;'.$docAutor.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/docuser.gif" border="0" />\');'
					.'}else{'
					.'document.write(\'<img alt="'._NEWS_WRITTEN.'&nbsp;'.$docAutor.'" title="'._NEWS_WRITTEN.'&nbsp;'.$docAutor.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/docuser.png" border="0" />\');'
					.'}</script>';
					
					echo '<noscript>'
					.'<img alt="'._NEWS_WRITTEN.'&nbsp;'.$docAutor.'" title="'._NEWS_WRITTEN.'&nbsp;'.$docAutor.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/docuser.gif" border="0" />'
					.'</noscript>';
				}
				else{
					echo '<img alt="'._NEWS_WRITTEN.'&nbsp;'.$docAutor.'" title="'._NEWS_WRITTEN.'&nbsp;'.$docAutor.'" style="padding-top: 2px;" src="'.$imagePath.'engine/images/docuser.gif" border="0" />';
				}
				
				
				echo '<span class="text_small">'
				._NEWS_WRITTEN.'&nbsp;'.$docAutor
				.'</span>';
				
				if($userID != false){
					echo '</a>';
				}
			}
		}
		break;
}



/*
	language settings
*/

if($tcms_config->useContentLanguage()) {
	switch($id){
		case 'register'      : break;
		case 'profile'       : break;
		case 'search'        : break;
		case 'polls'         : break;
		case 'knowledgebase' : break;
		case 'components'    : break;
		case $download_id    : break;
		case $products_id    : break;
		case $send_id        : break;
		case 'links'         : break;
		case $book_id        : break;
		case $image_id       : break;
		case $news_id        : break;
		case $front_id       : break;
		case $imp_id         : break;
		
		default:
			$arr_langs = $tcms_dcp->getContentLanguages($id);
			
			$tcms_main->paf($arr_langs);
			
			if($tcms_main->isReal($arr_langs)) {
				//display: block; float: 
				echo '<br />'
				.'<div style="none; margin: 3px 0 3px 0;">';
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id='.$id
				.'&amp;s='.$s
				.'&amp;lang=';
				$link = $tcms_main->urlConvertToSEO($link);
				
				$js = ' onchange="relocateTo(\''.$link.'\', this.value);"';
				
				echo _TCMS_THIS_PAGE_IN.': '
				.'<select id="doc_language" name="doc_language"'.$js.'>';
				
				foreach($languages['fine'] as $key => $val) {
					if(in_array($languages['code'][$key], $arr_langs)
					|| $languages['code'][$key] == $tcms_config->getLanguageFrontend()) {
						$defLang = $tcms_config->getLanguageCode(true);
						
						if($defLang == $lang) {
							if($tcms_config->getLanguageFrontend() == $languages['code'][$key])
								$dl = ' selected="selected"';
							else
								$dl = '';
						}
						else {
							if($lang == $val)
								$dl = ' selected="selected"';
							else
								$dl = '';
						}
						
						echo '<option value="'.$val.'"'.$dl.'>'.$languages['name'][$key].'</option>';
					}
				}
				
				$js = ' onclick="relocateTo(\''.$link.'\', getSelectedValue(getElementById(\'doc_language\')));"';
				
				echo '</select>'
				.'<input type="button" value="'._FORM_GO.'" class="inputbutton"'.$js.' />';
				
				echo '</div>';
			}
			break;
	}
}



echo '</div>';


?>
