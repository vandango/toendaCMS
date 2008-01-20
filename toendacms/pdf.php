<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Generate PDF Document
|
| File:	pdf.php
|
+
*/


/**
 * Generate PDF Document
 * 
 * This module is used to generate a pdf document
 * 
 * @version 0.2.9
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS
 */


if(isset($_GET['id'])){ $id = $_GET['id']; }
if(isset($_GET['s'])){ $s = $_GET['s']; }
if(isset($_GET['session'])){ $session = $_GET['session']; }
if(isset($_GET['category'])){ $category = $_GET['category']; }
if(isset($_GET['article'])){ $article = $_GET['article']; }
if(isset($_GET['news'])){ $news = $_GET['news']; }
if(isset($_GET['albums'])){ $albums = $_GET['albums']; }


define('_TCMS_VALID', 1);

include_once('engine/tcms_kernel/tcms_loader.lib.php');

using('toendacms.kernel.time');
using('toendacms.kernel.xml');
using('toendacms.kernel.configuration');
using('toendacms.kernel.main');
using('toendacms.kernel.sql');
using('toendacms.kernel.script');
using('toendacms.kernel.modconfig');
using('toendacms.kernel.gd');
using('toendacms.kernel.version');
using('toendacms.kernel.html');
using('toendacms.kernel.authentication');
using('toendacms.kernel.account_provider');


//**********************
// CURRENCYS
//
$arr_currency['html']['EUR'] = '&euro;';
$arr_currency['html']['USD'] = '$';


// load current active page
include_once('site.php');
define('_TCMS_PATH', $tcms_site[0]['path']);


require(_TCMS_PATH.'/tcms_global/database.php');

$tcms_main      = new tcms_main(_TCMS_PATH, $choosenDB);
$tcms_modconfig = new tcms_modconfig(_TCMS_PATH, '');
$tcms_version   = new tcms_version();
$tcms_config    = new tcms_configuration(_TCMS_PATH);


$language_stage = 'print';
include_once ('engine/language/lang_admin.php');

$choosenDB = $tcms_db_engine;
$sqlUser   = $tcms_db_user;
$sqlPass   = $tcms_db_password;
$sqlHost   = $tcms_db_host;
$sqlDB     = $tcms_db_database;
$sqlPort   = $tcms_db_port;
$sqlPrefix = $tcms_db_prefix;

$tcms_main->setDatabaseInfo($choosenDB);
$tcms_config->decodeConfiguration($tcms_main);


$charset  = $tcms_config->getCharset();
$currency = $tcms_config->getCurrency();


$cms_name         = $tcms_version->getName();
$cms_tagline      = $tcms_version->getTagline();
$toenda_copyright = $tcms_version->getToendaCopyright();
$cms_release      = $tcms_version->getVersion();
$cms_build        = $tcms_version->getBuild();


$s                = $tcms_config->getFrontendTheme();
$websiteowner     = $tcms_config->getWebpageOwner();
$websitecopyright = $tcms_config->getWebpageCopyright();
$websiteowner_url = $tcms_config->getWebpageOwnerUrl();
$seoEnabled       = $tcms_config->getSEOEnabled();

if($seoEnabled) {
	$seoFolder = $tcms_config->getSEOPath();
	
	if($seoFolder != '') {
		$seoFolder = '/'.$seoFolder.'/';
	}
	else {
		$seoFolder = '/';
	}
}
else {
	$seoFolder = '/';
}

// authentication
$tcms_auth = new tcms_authentication(_TCMS_PATH, $charset, $seoFolder);

// account provider
$tcms_ap = new tcms_account_provider(_TCMS_PATH, $charset);




//******************************
// ACCESS LEVEL
//

switch($id){
	case 'newsmanager': $authorized = 'Public'; break;
	case 'products': $authorized = 'Public'; break;
	default:
		if($choosenDB == 'xml'){
			$cl_xml = new xmlparser(_TCMS_PATH.'/tcms_content/'.$id.'.xml','r');
			$authorized = $cl_xml->readSection('main', 'access');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'content', $id);
			$sqlARR = $sqlAL->fetchArray($sqlQR);
			$authorized = $sqlARR['access'];
		}
		break;
}




/*
	CHECK FOR PUBLIC ACCESS
*/

$check_session = $tcms_auth->checkSessionExist($session);

if($check_session) {
	$arr_ws = $tcms_ap->getUserInfo($session);
	
	$ws_user  = $arr_ws['user'];
	$ws_id    = $arr_ws['id'];
	$is_admin = $arr_ws['group'];
}

if($authorized == 'Public'){ $ws_auth = 1; }

if($authorized == 'Protected'){
	$ws_auth = 0;
	if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Writer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){ $ws_auth = 1; }
	else{ $ws_auth = 0; }
}

if($authorized == 'Private'){
	$ws_auth = 0;
	if($is_admin == 'Administrator' || $is_admin == 'Developer'){ $ws_auth = 1; }
	else{ $ws_auth = 0; }
}





//*********************************
// READ XML
//

if($ws_auth == 1){
	switch($id){
		case 'newsmanager':
			if($choosenDB == 'xml'){
				$main_xml = new xmlparser(_TCMS_PATH.'/tcms_news/'.$news.'.xml','r');
				$arr_news['title'] = $main_xml->readSection('news', 'title');
				$arr_news['autor'] = $main_xml->readSection('news', 'autor');
				$arr_news['date']  = $main_xml->readSection('news', 'date');
				$arr_news['time']  = $main_xml->readSection('news', 'time');
				$arr_news['news']  = $main_xml->readSection('news', 'newstext');
				$arr_news['order'] = $main_xml->readSection('news', 'order');
				$arr_news['stamp'] = $main_xml->readSection('news', 'stamp');
				$arr_news['image'] = $main_xml->readSection('news', 'image');
				
				if(!$arr_news['title']){ $arr_news['title'] = ''; }
				if(!$arr_news['autor']){ $arr_news['autor'] = ''; }
				if(!$arr_news['date']) { $arr_news['date']  = ''; }
				if(!$arr_news['time']) { $arr_news['time']  = ''; }
				if(!$arr_news['news']) { $arr_news['news']  = ''; }
				if(!$arr_news['order']){ $arr_news['order'] = ''; }
				if(!$arr_news['stamp']){ $arr_news['stamp'] = ''; }
				if(!$arr_news['image']){ $arr_news['image'] = ''; }
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'news', $news);
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				
				$arr_news['title'] = $sqlARR['title'];
				$arr_news['autor'] = $sqlARR['autor'];
				$arr_news['date']  = $sqlARR['date'];
				$arr_news['time']  = $sqlARR['time'];
				$arr_news['news']  = $sqlARR['newstext'];
				$arr_news['order'] = $sqlARR['uid'];
				$arr_news['stamp'] = $sqlARR['stamp'];
				$arr_news['image'] = $sqlARR['published'];
				
				if($arr_news['title'] == NULL){ $arr_news['title'] = ''; }
				if($arr_news['autor'] == NULL){ $arr_news['autor'] = ''; }
				if($arr_news['date']  == NULL){ $arr_news['date']  = ''; }
				if($arr_news['time']  == NULL){ $arr_news['time']  = ''; }
				if($arr_news['news']  == NULL){ $arr_news['news']  = ''; }
				if($arr_news['order'] == NULL){ $arr_news['order'] = ''; }
				if($arr_news['stamp'] == NULL){ $arr_news['stamp'] = ''; }
				if($arr_news['image'] == NULL){ $arr_news['image'] = ''; }
			}
			
			$arr_news['title'] = $tcms_main->decodeText($arr_news['title'], '2', $c_charset);
			$arr_news['autor'] = $tcms_main->decodeText($arr_news['autor'], '2', $c_charset);
			$arr_news['news']  = $tcms_main->decodeText($arr_news['news'], '2', $c_charset);
			
			
			$news_content = $arr_news['news'];
			
			$toendaScript = new toendaScript($news_content);
			$news_content = $toendaScript->toendaScript_trigger();
			
			$news_content = $toendaScript->toendaScript_more($news_content, 'text');
			
			
			$title = $arr_news['title'];
			$key = '<span class="text_small">'.$arr_news['date'].' - '.$arr_news['time'].'</span>';// &bull; '._NEWS_WRITTEN.' '.$arr_news['autor'].'</span>';
			$content00 = $news_content;
			$content01 = '';
			$foot = '';
			
			break;
		
		case 'products':
			if($choosenDB == 'xml'){
				$menu_xml = new xmlparser(_TCMS_PATH.'/tcms_products/'.$category.'/'.$article.'.xml','r');
				$arr_product     = $menu_xml->readSection('info', 'product');
				$arr_product_no  = $menu_xml->readSection('info', 'product_number');
				$arr_factory     = $menu_xml->readSection('info', 'factory');
				$arr_factory_url = $menu_xml->readSection('info', 'factory_url');
				$arr_desc        = $menu_xml->readSection('info', 'desc');
				$arr_category    = $menu_xml->readSection('info', 'category');
				$arr_image       = $menu_xml->readSection('info', 'image');
				$arr_date        = $menu_xml->readSection('info', 'date');
				$arr_price       = $menu_xml->readSection('info', 'price');
				$arr_pricetax    = $menu_xml->readSection('info', 'price_tax');
				$arr_status      = $menu_xml->readSection('info', 'status');
				$arr_quantity    = $menu_xml->readSection('info', 'quantity');
				$arr_weight      = $menu_xml->readSection('info', 'weight');
				$arr_sort        = $menu_xml->readSection('info', 'sort');
				$arr_tag         = substr($value, 0, 10);
				
				if($arr_product == false)     { $arr_product     = ''; }
				if($arr_product_no == false)  { $arr_product_no  = ''; }
				if($arr_factory == false)     { $arr_factory     = ''; }
				if($arr_factory_url == false) { $arr_factory_url = ''; }
				if($arr_desc == false)        { $arr_desc        = ''; }
				if($arr_category == false)    { $arr_category    = ''; }
				if($arr_image == false)       { $arr_image       = ''; }
				if($arr_date == false)        { $arr_date        = ''; }
				if($arr_price == false)       { $arr_price       = ''; }
				if($arr_pricetax == false)    { $arr_pricetax    = ''; }
				if($arr_status == false)      { $arr_status      = ''; }
				if($arr_quantity == false)    { $arr_quantity    = ''; }
				if($arr_weight == false)      { $arr_weight      = ''; }
				if($arr_sort == false)        { $arr_sort        = ''; }
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->getAll(
					$tcms_db_prefix."products "
					."WHERE uid='".$article."' "
					."AND sql_type='a' "
					."AND pub=1 "
				);
				
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				
				$arr_product     = $sqlARR['name'];
				$arr_product_no  = $sqlARR['product_number'];
				$arr_factory     = $sqlARR['factory'];
				$arr_factory_url = $sqlARR['factory_url'];
				$arr_desc        = $sqlARR['desc'];
				$arr_category    = $sqlARR['category'];
				$arr_image       = $sqlARR['image1'];
				$arr_date        = $sqlARR['date'];
				$arr_price       = $sqlARR['price'];
				$arr_pricetax    = $sqlARR['price_tax'];
				$arr_status      = $sqlARR['status'];
				$arr_quantity    = $sqlARR['quantity'];
				$arr_weight      = $sqlARR['weight'];
				$arr_sort        = $sqlARR['sort'];
				$arr_tag         = $sqlARR['uid'];
				
				if($arr_product     == NULL){ $arr_product     = ''; }
				if($arr_product_no  == NULL){ $arr_product_no  = ''; }
				if($arr_factory     == NULL){ $arr_factory     = ''; }
				if($arr_factory_url == NULL){ $arr_factory_url = ''; }
				if($arr_desc        == NULL){ $arr_desc        = ''; }
				if($arr_category    == NULL){ $arr_category    = ''; }
				if($arr_image       == NULL){ $arr_image       = ''; }
				if($arr_date        == NULL){ $arr_date        = ''; }
				if($arr_price       == NULL){ $arr_price       = ''; }
				if($arr_pricetax    == NULL){ $arr_pricetax    = ''; }
				if($arr_status      == NULL){ $arr_status      = ''; }
				if($arr_quantity    == NULL){ $arr_quantity    = ''; }
				if($arr_weight      == NULL){ $arr_weight      = ''; }
				if($arr_sort        == NULL){ $arr_sort        = ''; }
				if($arr_tag         == NULL){ $arr_tag         = ''; }
			}
			
			
			$arr_factory = $tcms_main->decodeText($arr_factory, '2', $c_charset);
			
			
			
			if($arr_price != -1) {
				if($tcms_main->isReal($arr_pricetax)) {
					$setTemp .= '<strong>';
					
					$taxPrice = $tcms_main->getTaxPrice($arr_price, $arr_pricetax);
					
					if($currency == 'EUR') {
						$setTemp .= $arr_price
						.'&nbsp;'.$arr_currency['html'][$currency]
						.'</strong>&nbsp;'
						.'('.$taxPrice.')'
						.'&nbsp;'.$arr_currency['html'][$currency];
					}
					else {
						$setTemp .= $arr_currency['html'][$currency]
						.'&nbsp;'.$arr_price
						.'</strong>&nbsp;'
						.$arr_currency['html'][$currency]
						.'&nbsp;('.$taxPrice.')';
					}
					
					$setTemp .= '&nbsp;'
					.( !empty($arr_pricetax) ? _PRODUCTS_INC_TAX : _PRODUCTS_EX_TAX );
				}
				else {
					$setTemp .= '<strong>';
					
					if($currency == 'EUR') {
						$setTemp .= $arr_price
						.'&nbsp;'.$arr_currency['html'][$currency];
					}
					else {
						$setTemp .= $arr_currency['html'][$currency]
						.'&nbsp;'.$arr_price;
					}
					
					$setTemp .= '</strong>';
				}
			}
			
			
			$articleKey = ( trim($arr_product_no) == '' ? '' : '['.$arr_product_no.'], ' )
			.$setTemp;
			
			
			
			$articleImage = ( trim($arr_image) == '_empty_' ? '' : '<img src="'.$imagePath._TCMS_PATH.'/images/products/'.$arr_image.'" border="0" />' );
			
			
			
			if(trim($arr_factory_url) == ''){
				$arr_factory_url = _TABLE_FACTORY.': '.$arr_factory.'<br>';
			}
			else{
				$arr_factory_url = _TABLE_FACTORY.': '.$arr_factory.' ('.( substr($arr_factory_url, 0, 4) != 'http' ? 'http://' : '' ).$arr_factory_url.')<br>';
			}
			
			$articleFoot = $arr_factory_url._TABLE_WEIGHT.': '.$arr_weight.'<br>'
			.( $arr_quantity != -1 ? _TABLE_STOCK.': '.$arr_quantity : '' );
			
			
			
			$arr_product = $tcms_main->decodeText($arr_product, '2', $c_charset);
			$arr_desc    = $tcms_main->decodeText($arr_desc, '2', $c_charset);
			
			$title       = '<h1>'.$arr_product.'</h1>';
			$key         = $articleKey;
			$content00   = $arr_desc;
			$content01   = $articleImage;
			$foot        = $articleFoot;
			
			break;
		
		default:
			//===================================
			// CONTENTS
			//===================================
			if($choosenDB == 'xml'){
				$content_xml = new xmlparser(_TCMS_PATH.'/tcms_content/'.$id.'.xml','r');
				$title     = $content_xml->readSection('main', 'title');
				$key       = $content_xml->readSection('main', 'key');
				$content00 = $content_xml->readSection('main', 'content00');
				$content01 = $content_xml->readSection('main', 'content01');
				$foot      = $content_xml->readSection('main', 'foot');
				//$layout_id = $content_xml->readSection('main', 'db_layout');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'content', $id);
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				
				$title     = $sqlARR['title'];
				$key       = $sqlARR['key'];
				$content00 = $sqlARR['content00'];
				$content01 = $sqlARR['content01'];
				$foot      = $sqlARR['foot'];
				//$layout_id = $sqlARR['db_layout'];
			}
			
			// TCMS SCRIPT
			/*$toendaScript = new toendaScript($key);
			$key = $toendaScript->toendaScript_trigger();
			
			$toendaScript = new toendaScript($content00);
			$content00 = $toendaScript->toendaScript_trigger();
			
			$toendaScript = new toendaScript($content01);
			$content01 = $toendaScript->toendaScript_trigger();
			
			$toendaScript = new toendaScript($foot);
			$foot = $toendaScript->toendaScript_trigger();*/
			
			// TCMS SCRIPT
			$toendaScript = new toendaScript($key);
			$key = $toendaScript->doParse();
			
			$toendaScript = new toendaScript($content00);
			$content00 = $toendaScript->doParse();
			$content00 = $toendaScript->checkSEO($content00, $imagePath);
			
			$toendaScript = new toendaScript($content01);
			$content01 = $toendaScript->doParse();
			$content01 = $toendaScript->checkSEO($content01, $imagePath);
			
			$toendaScript = new toendaScript($foot);
			$foot = $toendaScript->doParse();
			$foot = $toendaScript->checkSEO($foot, $imagePath);
			
			// CHARSETS
			$title       = $tcms_main->decodeText($title, '2', $c_charset);
			$key         = $tcms_main->decodeText($key, '2', $c_charset);
			$content00   = $tcms_main->decodeText($content00, '2', $c_charset);
			$content01   = $tcms_main->decodeText($content01, '2', $c_charset);
			$foot        = $tcms_main->decodeText($foot, '2', $c_charset);
			
			break;
	}
	
	
	
	/*if(!isset($layout_id) || $layout_id == '' || empty($layout_id)){
		$layout_id = 'db_content_default.php';
	}*/
	
	$content00 = str_replace('{tcms_more}', '', $content00);
	
	$content_template .= '<div style="width: 99%; display: block;">'
	.'<div class="contentheading">'.$title.'</div>'
	.'<span class="contentstamp">'.$key.'</span><br /><br />'
	.'<div class="contentmain"><br />';
	
	$content_template .= $toendaScript->doParsePHP($content00, true);
	
	$content_template .= '<br />'.$content01.'<br />'
	.$foot.'</div>'
	.'</div>';
	
	
	$buffer = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
	.'<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">'
	.'<head><title>toendaCMS xHTML to PDF output file</title>'
	.'<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />'
	.'<meta name="generator" content="'.$cms_name.' - '.$cms_tagline.' | Copyright '.$toenda_copyright.' Toenda Software Development.  All rights reserved." />'
	.'</head><body>'
	.'<span style="font-size: 10px; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif; color: #333;">Generated by toendaCMS on '.date('l, d. F Y - H:i').'</span>'
	.'<hr noshade="noshade" />'
	.'<br />'.$content_template.'</body></html>';
	
	//echo $buffer;
	
	
	//--> DOMPDF
	
	$html ='<html><body>'.
	'<p>Put your html here, or generate it with your favourite '.
	'templating system.</p>'.
	'</body></html>';
	
	$fp = fopen('cache/output4pdf.html', 'w');
	fwrite($fp, $html);
	fclose($fp);
	
	$input_file = '../../../../cache/output4pdf.html';
	//$input_file = $seoFolder.'cache/output4pdf.html';
	
	$output_file = 'dompdf.pdf';
	
	$url = $seoFolder.'engine/tcms_kernel/dompdf/dompdf.php?input_file='
	.rawurlencode($input_file)
	.'&paper=letter&output_file='.rawurlencode($output_file);
    
    //header('Location: http://'.$_SERVER['HTTP_HOST'].$url);
    echo '<script>'
	.'document.location=\'http://'.$_SERVER['HTTP_HOST'].$url.'\';'
	.'</script>';
    
	unlink('cache/output4pdf.html');
    
	/*
	require_once('engine/tcms_kernel/dompdf/dompdf_config.inc.php');
	
	$dompdf = new DOMPDF();
	$dompdf->set_base_path('engine/tcms_kernel/dompdf/');
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream('../../../cache/dompdf.pdf');
	*/
	
	/*
	include_once('engine/tcms_kernel/html2pdf/html2fpdf.php');
	
	$returnPDF = new HTML2FPDF();
	$returnPDF->AddPage();
	$returnPDF->WriteHTML($buffer);
	$returnPDF->SetAuthor($websiteowner);
	$returnPDF->SetCreator('toendaCMS - '.$cms_release.' - '.$cms_build);
	$returnPDF->Output();
	*/
}
else{
	include_once(_ERROR_401);
}



?>
