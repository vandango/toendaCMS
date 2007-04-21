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


if(isset($_GET['id'])){ $id = $_GET['id']; }
if(isset($_GET['s'])){ $s = $_GET['s']; }
if(isset($_GET['session'])){ $session = $_GET['session']; }
if(isset($_GET['category'])){ $category = $_GET['category']; }
if(isset($_GET['article'])){ $article = $_GET['article']; }
if(isset($_GET['news'])){ $news = $_GET['news']; }
if(isset($_GET['albums'])){ $albums = $_GET['albums']; }


/**
 * Generate PDF Document
 * 
 * This module is used to generate a pdf document
 * 
 * @version 0.2.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS
 */


define('_TCMS_VALID', 1);

include_once('engine/tcms_kernel/tcms_loader.lib.php');

/*
include_once ('engine/tcms_kernel/tcms_xml.lib.php');
include_once ('engine/tcms_kernel/tcms.lib.php');
include_once ('engine/tcms_kernel/tcms_time.lib.php');
include_once ('engine/tcms_kernel/tcms_script.lib.php');
include_once ('engine/tcms_kernel/tcms_html.lib.php');
include_once ('engine/tcms_kernel/tcms_sql.lib.php');
include_once ('engine/tcms_kernel/tcms_modconfig.lib.php');
include_once ('engine/tcms_kernel/tcms_gd.lib.php');
include_once ('engine/tcms_kernel/tcms_version.lib.php');
include_once ('engine/tcms_kernel/tcms_configuration.lib.php');
*/

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


//**********************
// CURRENCYS
//
$arr_currency['html']['EUR'] = '&euro;';
$arr_currency['html']['USD'] = '$';


$tcms_administer_site = 'data';

include_once($tcms_administer_site.'/tcms_global/database.php');

$tcms_main      = new tcms_main($tcms_administer_site, $choosenDB);
$tcms_modconfig = new tcms_modconfig($tcms_administer_site, '');
$tcms_version   = new tcms_version();
$tcms_config    = new tcms_configuration($tcms_administer_site);


$language_stage = 'print';
include_once ('engine/language/lang_admin.php');


$choosenDB = $tcms_main->secure_password($tcms_db_engine, 'en');
$sqlUser   = $tcms_main->secure_password($tcms_db_user, 'en');
$sqlPass   = $tcms_main->secure_password($tcms_db_password, 'en');
$sqlHost   = $tcms_main->secure_password($tcms_db_host, 'en');
$sqlDB     = $tcms_main->secure_password($tcms_db_database, 'en');
$sqlPort   = $tcms_main->secure_password($tcms_db_port, 'en');
$sqlPrefix = $tcms_main->secure_password($tcms_db_prefix, 'en');
$tcms_db_prefix = $sqlPrefix;

$tcms_main->setDatabaseInfo($choosenDB);


$charset  = $tcms_config->getCharset();
$currency = $tcms_config->getCurrency();


$layout_xml = new xmlparser($tcms_administer_site.'/tcms_global/layout.xml','r');
$s = $layout_xml->read_section('layout', 'select');


$cms_name         = $tcms_version->getName();
$cms_tagline      = $tcms_version->getTagline();
$toenda_copyright = $tcms_version->getToendaCopyright();
$cms_release      = $tcms_version->getVersion();
$cms_build        = $tcms_version->getBuild();


$footer_xml       = new xmlparser(''.$tcms_administer_site.'/tcms_global/footer.xml','r');
$websiteowner     = $footer_xml->read_section('footer', 'websiteowner');
$websitecopyright = $footer_xml->read_section('footer', 'copyright');
$websiteowner_url = $footer_xml->read_section('footer', 'owner_url');
$footer_xml->flush();
$footer_xml->_xmlparser();





//******************************
// ACCESS LEVEL
//

switch($id){
	case 'newsmanager': $authorized = 'Public'; break;
	case 'products': $authorized = 'Public'; break;
	default:
		if($choosenDB == 'xml'){
			$cl_xml = new xmlparser($tcms_administer_site.'/tcms_content/'.$id.'.xml','r');
			$authorized = $cl_xml->read_section('main', 'access');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'content', $id);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			$authorized = $sqlARR['access'];
		}
		break;
}




/*******************
* CHECK FOR PUBLIC
* ACCESS
**/

if($choosenDB == 'xml'){
	if(isset($session) && $session != '' && file_exists($tcms_administer_site.'/tcms_session/'.$session) && filesize($tcms_administer_site.'/tcms_session/'.$session) != 0){ $check_session = true; }
	else{ $check_session = false; }
}
else{ $check_session = $tcms_main->check_session_exists($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session); }

if($check_session){
	if($choosenDB == 'xml'){
		$arr_ws = $tcms_main->create_username($session);
		
		$ws_user = $arr_ws['user'];
		$ws_id   = $arr_ws['id'];
		
		$authXML  = new xmlparser($tcms_administer_site.'/tcms_user/'.$ws_id.'.xml', 'r');
		$is_admin = $authXML->read_section('user', 'group');
	}
	else{
		$arr_ws = $tcms_main->create_sql_username($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $session);
		
		$ws_user = $arr_ws['user'];
		$ws_id   = $arr_ws['id'];
		
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'user', $ws_id);
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		$is_admin = $sqlARR['group'];
		if($is_admin == NULL){ $is_admin = ''; }
	}
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
				$main_xml = new xmlparser($tcms_administer_site.'/tcms_news/'.$news.'.xml','r');
				$arr_news['title'] = $main_xml->read_section('news', 'title');
				$arr_news['autor'] = $main_xml->read_section('news', 'autor');
				$arr_news['date']  = $main_xml->read_section('news', 'date');
				$arr_news['time']  = $main_xml->read_section('news', 'time');
				$arr_news['news']  = $main_xml->read_section('news', 'newstext');
				$arr_news['order'] = $main_xml->read_section('news', 'order');
				$arr_news['stamp'] = $main_xml->read_section('news', 'stamp');
				$arr_news['image'] = $main_xml->read_section('news', 'image');
				
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
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'news', $news);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
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
				$menu_xml = new xmlparser($tcms_administer_site.'/tcms_products/'.$category.'/'.$article.'.xml','r');
				$arr_product     = $menu_xml->read_section('info', 'product');
				$arr_product_no  = $menu_xml->read_section('info', 'product_number');
				$arr_factory     = $menu_xml->read_section('info', 'factory');
				$arr_factory_url = $menu_xml->read_section('info', 'factory_url');
				$arr_desc        = $menu_xml->read_section('info', 'desc');
				$arr_category    = $menu_xml->read_section('info', 'category');
				$arr_image       = $menu_xml->read_section('info', 'image');
				$arr_date        = $menu_xml->read_section('info', 'date');
				$arr_price       = $menu_xml->read_section('info', 'price');
				$arr_pricetax    = $menu_xml->read_section('info', 'price_tax');
				$arr_status      = $menu_xml->read_section('info', 'status');
				$arr_quantity    = $menu_xml->read_section('info', 'quantity');
				$arr_weight      = $menu_xml->read_section('info', 'weight');
				$arr_sort        = $menu_xml->read_section('info', 'sort');
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
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix."products WHERE uid='".$article."' AND sql_type='f' AND category='".$category."'");
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$arr_product     = $sqlARR['name'];
				$arr_product_no  = $sqlARR['product_number'];
				$arr_factory     = $sqlARR['factory'];
				$arr_factory_url = $sqlARR['factory_url'];
				$arr_desc        = $sqlARR['desc'];
				$arr_category    = $sqlARR['category'];
				$arr_image       = $sqlARR['image'];
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
			
			
			if($currency == 'EUR'){
				$setTemp = ( !empty($arr_pricetax) ? $arr_pricetax : $arr_price ).'&nbsp;'.$arr_currency['html'][$currency].'&nbsp;';
			}
			else{
				$setTemp = $arr_currency['html'][$currency].'&nbsp;'.( !empty($arr_pricetax) ? $arr_pricetax : $arr_price ).'&nbsp;';
			}
			
			$articleKey = ( trim($arr_product_no) == '' ? '' : '['.$arr_product_no.'], ' )
			.$setTemp.( !empty($arr_pricetax) ? _PRODUCTS_INC_TAX : _PRODUCTS_EX_TAX );
			
			
			
			$articleImage = ( trim($arr_image) == '_empty_' ? '' : '<img src="'.$imagePath.$tcms_administer_site.'/images/products/'.$arr_image.'" border="0" />' );
			
			
			
			if(trim($arr_factory_url) == ''){
				$arr_factory_url = _TABLE_FACTORY.': '.$arr_factory.'<br>';
			}
			else{
				$arr_factory_url = _TABLE_FACTORY.': '.$arr_factory.' ('.( substr($arr_factory_url, 0, 4) != 'http' ? 'http://' : '' ).$arr_factory_url.')<br>';
			}
			
			$articleFoot = $arr_factory_url._TABLE_WEIGHT.': '.$arr_weight.'<br>'
			._TABLE_STOCK.': '.$arr_quantity;
			
			
			
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
				$content_xml = new xmlparser($tcms_administer_site.'/tcms_content/'.$id.'.xml','r');
				$title     = $content_xml->read_section('main', 'title');
				$key       = $content_xml->read_section('main', 'key');
				$content00 = $content_xml->read_section('main', 'content00');
				$content01 = $content_xml->read_section('main', 'content01');
				$foot      = $content_xml->read_section('main', 'foot');
				$layout_id = $content_xml->read_section('main', 'db_layout');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'content', $id);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$title     = $sqlARR['title'];
				$key       = $sqlARR['key'];
				$content00 = $sqlARR['content00'];
				$content01 = $sqlARR['content01'];
				$foot      = $sqlARR['foot'];
				$layout_id = $sqlARR['db_layout'];
			}
			
			// TCMS SCRIPT
			$toendaScript = new toendaScript($key);
			$key = $toendaScript->toendaScript_trigger();
			
			$toendaScript = new toendaScript($content00);
			$content00 = $toendaScript->toendaScript_trigger();
			
			$toendaScript = new toendaScript($content01);
			$content01 = $toendaScript->toendaScript_trigger();
			
			$toendaScript = new toendaScript($foot);
			$foot = $toendaScript->toendaScript_trigger();
			
			// CHARSETS
			$title       = $tcms_main->decodeText($title, '2', $c_charset);
			$key         = $tcms_main->decodeText($key, '2', $c_charset);
			$content00   = $tcms_main->decodeText($content00, '2', $c_charset);
			$content01   = $tcms_main->decodeText($content01, '2', $c_charset);
			$foot        = $tcms_main->decodeText($foot, '2', $c_charset);
			
			break;
	}
	
	
	
	if(!isset($layout_id) || $layout_id == '' || empty($layout_id)){
		$layout_id = 'db_content_default.php';
	}
	
	$content00 = str_replace('{tcms_more}', '', $content00);
	
	///  BILDER RAUS LOESCHEN
	/// $content00
	///
	
	include('engine/db_layout/'.$layout_id);
	
	$content_template = str_replace('{$title}', $title, $content_template);
	$content_template = str_replace('{$key}', $key, $content_template);
	$content_template = str_replace('{$content00}', $content00, $content_template);
	$content_template = str_replace('{$content01}', $content01, $content_template);
	$content_template = str_replace('{$foot}', $foot, $content_template);
	
	
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
	
	include_once('engine/tcms_kernel/html2pdf/html2fpdf.php');
	
	$returnPDF = new HTML2FPDF();
	$returnPDF->AddPage();
	$returnPDF->WriteHTML($buffer);
	$returnPDF->SetAuthor($websiteowner);
	$returnPDF->SetCreator('toendaCMS - '.$cms_release.' - '.$cms_build);
	$returnPDF->Output();
	
	
	//--> XHTML2PDF
	/*
	$fp = fopen('cache/output4pdf.html', 'w');
	fwrite($fp, $buffer);
	fclose($fp);
	
	define('X_PATH', 'engine/tcms_kernel/xhtml2pdf/');
	define('DOC_PATH', 'cache/');
	
	include_once(X_PATH.'/classes/x2fpdf.php');
	
	$pdf['author'] = $websiteowner;
	$pdf['name'] = 'output4pdf.pdf';
	$pdf['title'] = 'toendaCMS generated PDF';
	$pdf['chapo'] = 'toendaCMS generated PDF';
	$pdf['date']['created'] = date('d.m.Y-H:i');
	$pdf['date']['modified'] = date('d.m.Y-H:i');
	
	$xpdf = new xhtml2pdf(DOC_PATH.'output4pdf.html', 'theme/printer/data/css.css', $config);
	
	$xpdf->SetTitle($pdf['title']);
	$xpdf->SetAuthor($pdf['author']);
	$xpdf->SetCreator('toendaCMS - '.$cms_release.' - '.$cms_build);
	$xpdf->SetSubject($pdf['chapo']);
	$xpdf->SetKeywords($keywords='');
	$xpdf->WriteRights();
	
	$xpdf->output($pdf['name'], 'I');
	
	unlink('cache/output4pdf.html');
	*/
}
else{
	include_once(_ERROR_401);
}



?>
