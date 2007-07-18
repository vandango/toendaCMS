<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Products Manager
|
| File:	ext_products.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Products Manager
 *
 * This module is used as a product manager.
 *
 * @version 0.4.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['category'])){ $category = $_GET['category']; }
if(isset($_GET['article'])){ $article = $_GET['article']; }
if(isset($_GET['cmd'])){ $cmd = $_GET['cmd']; }

if(!isset($action)) { $action = 'showall'; }
if(!isset($cmd)) { $cmd = 'offers'; }





// -------------------------------------------------
// SHOW ALL / STARTPAGE
// -------------------------------------------------

if($action == 'showall'){
	echo $tcms_html->contentModuleHeader(
		$products_title, 
		$products_stamp, 
		( $cmd == 'browse' ? '' : $products_text )
	);
	
	
	$count = 0;
	$checkCatAmount = 0;
	$displayItem = true;
	
	
	/*
		list all startpage products
	*/
	
	echo $tcms_html->tableHeadClass('0', '0', '0', '100%', 'noborder')
	.'<tr><td valign="top" class="titleBG" style="padding-left: 2px;" align="left">';
	
	if(trim($startpage_title) != '') {
		// offer tab
		$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
		.'id=products&amp;s='.$s.'&amp;action=showall&amp;cmd=offers'
		.( isset($lang) ? '&amp;lang='.$lang : '' );
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<a class="'.( $cmd == 'offers' ? 'products_active_tab' : 'products_tab' ).'" href="'.$link.'">'
		.$startpage_title
		.'</a>';
	}
	
	// browse tab
	$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
	.'id=products&amp;s='.$s.'&amp;action=showall&amp;cmd=browse'
	.( isset($lang) ? '&amp;lang='.$lang : '' );
	$link = $tcms_main->urlConvertToSEO($link);
	
	echo '<a class="'.( $cmd == 'browse' ? 'products_active_tab' : 'products_tab' ).'" href="'.$link.'">'
	.'Browse'
	.'</a>';
	
	echo '</td><tr>'
	.'<tr style="height: 2px;"><td></td></tr>'
	.'<tr><td><br /></td></tr>'
	.$tcms_html->tableEnd();
	
	
	// -----------------------------------
	// load data
	// -----------------------------------
	
	/*
		browse categories and products
	*/
	if($cmd == 'browse') {
		if($choosenDB == 'xml') {
			//
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
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
			
			// generate sql string
			if(!isset($category)) {
				$sqlSTR = "SELECT * "
				."FROM ".$tcms_db_prefix."products "
				."WHERE language = '".$tcms_config->getLanguageFrontend()."' "
				."AND pub = 1 "
				."AND ((parent IS NULL) OR (category IS NULL) OR (category = '')) "
				."AND NOT (name = '') "
				."AND ( access = 'Public' "
				.$strAdd
				."ORDER BY sort ASC, date ASC, name ASC";
			}
			else {
				$sqlSTR = "SELECT * "
				."FROM ".$tcms_db_prefix."products "
				."WHERE uid = '".$category."' "
				."AND language = '".$tcms_config->getLanguageFrontend()."' "
				."AND pub = 1 "
				."AND NOT (name = '') "
				."AND ( access = 'Public' "
				.$strAdd
				."ORDER BY sort ASC, date ASC, name ASC";
				
				//$sqlQR = $sqlAL->query($sqlSTR);
				//$sqlNR = $sqlAL->getNumber($sqlQR);
				
				if($sqlNR > 0) {
					/*$sqlSTR = "SELECT * "
					."FROM ".$tcms_db_prefix."knowledgebase "
					."WHERE category = '".$category."' "
					."AND publish_state = 2 "
					."AND ( access = 'Public' "
					.$strAdd
					."ORDER BY sort ASC, date ASC, title ASC";*/
				}
				else {
					//$displayItem = false;
				}
			}
			
			if($displayItem) {
				$count = 0;
				
				//echo $sqlSTR.'<br />';
				
				$sqlQR = $sqlAL->query($sqlSTR);
				
				while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
					$arr_pro['uid'][$count]    = $sqlObj->uid;
					$arr_pro['name'][$count]   = $sqlObj->name;
					$arr_pro['desc'][$count]   = $sqlObj->desc;
					$arr_pro['date'][$count]   = $sqlObj->date;
					$arr_pro['image1'][$count] = $sqlObj->image1;
					$arr_pro['sort'][$count]   = $sqlObj->sort;
					
					
					if($show_price_only_users == 1) {
						$arr_pro['price'][$count]  = $sqlObj->price;
						$arr_pro['taxkey'][$count] = $sqlObj->price_tax;
						
						if($arr_pro['price'][$count]  == NULL){ $arr_pro['price'][$count]  = ''; }
						if($arr_pro['taxkey'][$count] == NULL){ $arr_pro['taxkey'][$count] = ''; }
					}
					
					
					if($arr_pro['uid'][$count]    == NULL){ $arr_pro['uid'][$count]    = ''; }
					if($arr_pro['name'][$count]   == NULL){ $arr_pro['name'][$count]   = ''; }
					if($arr_pro['desc'][$count]   == NULL){ $arr_pro['desc'][$count]   = ''; }
					if($arr_pro['date'][$count]   == NULL){ $arr_pro['date'][$count]   = ''; }
					if($arr_pro['image1'][$count] == NULL){ $arr_pro['image1'][$count] = ''; }
					if($arr_pro['sort'][$count]   == NULL){ $arr_pro['sort'][$count]   = ''; }
					
					
					// CHARSETS
					$arr_pro['name'][$count] = $tcms_main->decodeText($arr_pro['name'][$count], '2', $c_charset);
					$arr_pro['desc'][$count] = $tcms_main->decodeText($arr_pro['desc'][$count], '2', $c_charset);
					
					$count++;
					$checkCatAmount = $count;
				}
				
				$checkCatAmount--;
			}
			
			$intOdd = 0;
			
			echo 'hallo welt<br />';
			
			echo $tcms_html->tableHeadClass('2', '0', '1', '100%', 'noborder products_text');
			
			if($tcms_main->isArray($arr_pro['sort'])) {
				foreach($arr_pro['sort'] as $key => $value) {
					if($intOdd == 0) {
						echo '<tr>';
					}
					
					echo '<td width="50%" valign="top">';
					
					
					// link
					if(trim($arr_pro['name'][$key]) != '') {
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=products&amp;s='.$s.'&amp;action=showone'
						.'&amp;article='.$arr_pro['uid'][$key]
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlConvertToSEO($link);
						
						echo '<a class="products_top" href="'.$link.'">'
						.$arr_pro['name'][$key]
						.'</a>';
					}
					
					
					// desc
					if(trim($arr_pro['desc'][$key]) != '') {
						echo '<br />'
						.$arr_pro['desc'][$key];
					}
					
					
					// price
					if($show_price_only_users == 1) {
						
					}
					
					echo '</td>';
					
					// fill if amount is odd
					if($key == $checkCatAmount && is_integer($checkCatAmount / 2)) {
						echo '<td width="50%">&nbsp;</td>';
					}
					
					if($intOdd == 1) {
						echo '</tr>';
						
						$intOdd = 0;
					}
					else {
						$intOdd = 1;
					}
				}
			}
			
			echo $tcms_html->tableEnd();
		}
	}
	/*
		load current offers
	*/
	else if($cmd == 'offers') {
		if($choosenDB == 'xml') {
			//
		}
		else {
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
			
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."products "
			."WHERE show_on_startpage = 1 "
			."AND language = '".$tcms_config->getLanguageFrontend()."' "
			."AND sql_type = 'a' "
			//."AND status = 1 " // --> nur in artikelansicht anzeigen (ob auf lager oder grade leer)
			."AND pub = 1 "
			."AND NOT (name = '') "
			."AND ( access = 'Public' "
			.$strAdd
			."ORDER BY sort ASC, date ASC, name ASC";
			
			$sqlQR = $sqlAL->query($sqlSTR);
			$chkNr = $sqlAL->getNumber($sqlQR);
			
			if($chkNr != 0) {
				while($sqlObj = $sqlAL->fetchObject($sqlQR)) {
					$arr_pro['uid'][$count]    = $sqlObj->uid;
					$arr_pro['name'][$count]   = $sqlObj->name;
					$arr_pro['desc'][$count]   = $sqlObj->desc;
					$arr_pro['date'][$count]   = $sqlObj->date;
					$arr_pro['image1'][$count] = $sqlObj->image1;
					$arr_pro['sort'][$count]   = $sqlObj->sort;
					
					
					if($show_price_only_users == 1) {
						$arr_pro['price'][$count]  = $sqlObj->price;
						$arr_pro['taxkey'][$count] = $sqlObj->price_tax;
						
						if($arr_pro['price'][$count]  == NULL){ $arr_pro['price'][$count]  = ''; }
						if($arr_pro['taxkey'][$count] == NULL){ $arr_pro['taxkey'][$count] = ''; }
					}
					
					
					if($arr_pro['uid'][$count]    == NULL){ $arr_pro['uid'][$count]    = ''; }
					if($arr_pro['name'][$count]   == NULL){ $arr_pro['name'][$count]   = ''; }
					if($arr_pro['desc'][$count]   == NULL){ $arr_pro['desc'][$count]   = ''; }
					if($arr_pro['date'][$count]   == NULL){ $arr_pro['date'][$count]   = ''; }
					if($arr_pro['image1'][$count] == NULL){ $arr_pro['image1'][$count] = ''; }
					if($arr_pro['sort'][$count]   == NULL){ $arr_pro['sort'][$count]   = ''; }
					
					
					// CHARSETS
					$arr_pro['name'][$count] = $tcms_main->decodeText($arr_pro['name'][$count], '2', $c_charset);
					$arr_pro['desc'][$count] = $tcms_main->decodeText($arr_pro['desc'][$count], '2', $c_charset);
					
					$count++;
					$checkCatAmount = $count;
				}
				
				$checkCatAmount--;
			}
		}
		
		$intOdd = 0;
		
		echo $tcms_html->tableHeadClass('2', '0', '1', '100%', 'noborder products_text');
		
		if($tcms_main->isArray($arr_pro['sort'])){
			foreach($arr_pro['sort'] as $key => $value){
				if($intOdd == 0) {
					echo '<tr>';
				}
				
				echo '<td width="50%" valign="top">';
				
				
				// link
				if(trim($arr_pro['name'][$key]) != '') {
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=products&amp;s='.$s.'&amp;action=showone'
					.'&amp;article='.$arr_pro['uid'][$key]
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlConvertToSEO($link);
					
					echo '<a class="products_top" href="'.$link.'">'
					.$arr_pro['name'][$key]
					.'</a>';
				}
				
				
				// desc
				if(trim($arr_pro['desc'][$key]) != '') {
					echo '<br />'
					.$arr_pro['desc'][$key];
				}
				
				
				// price
				if($show_price_only_users == 1) {
					
				}
				
				echo '</td>';
				
				// fill if amount is odd
				if($key == $checkCatAmount && is_integer($checkCatAmount / 2)) {
					echo '<td width="50%">&nbsp;</td>';
				}
				
				if($intOdd == 1) {
					echo '</tr>';
					
					$intOdd = 0;
				}
				else {
					$intOdd = 1;
				}
			}
		}
		
		echo $tcms_html->tableEnd();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	echo '<br />';
	echo '<br />';
	echo '<br />';
	echo '<hr class="hr_line" />';
	echo '<hr class="hr_line" />';
	echo '<hr class="hr_line" />';
	
	if(isset($category))
		$main_category = $category;
	
	if(isset($main_category) && !empty($main_category) && $main_category != ''){
		if($choosenDB == 'xml'){
			if(file_exists($tcms_administer_site.'/tcms_products/'.$main_category.'/folderinfo.xml')){
				$menu_xml = new xmlparser($tcms_administer_site.'/tcms_products/'.$main_category.'/folderinfo.xml','r');
				$chkAcc   = $menu_xml->readSection('folderinfo', 'access');
				
				$showAll = $tcms_main->checkAccess($chkAcc, $is_admin);
				
				if($showAll == true){
					$arr_name = $menu_xml->readSection('folderinfo', 'name');
					$arr_date = $menu_xml->readSection('folderinfo', 'date');
					$arr_desc = $menu_xml->readSection('folderinfo', 'desc');
					$arr_sort = $menu_xml->readSection('folderinfo', 'sort');
					$arr_dir  = $menu_xml->readSection('folderinfo', 'folder');
					$arr_pub  = $menu_xml->readSection('folderinfo', 'pub');
					$arr_ac   = $menu_xml->readSection('folderinfo', 'access');
					
					$arr_pfiles = $tcms_main->getPathContent($tcms_administer_site.'/tcms_products/'.$main_category.'/');
					
					foreach($arr_pfiles as $key => $value){
						if($value != 'folderinfo.xml'){
							$menu_xml = new xmlparser($tcms_administer_site.'/tcms_products/'.$main_category.'/'.$value,'r');
							$arr_dw['product'][$key]     = $menu_xml->readSection('info', 'product');
							$arr_dw['desc'][$key]        = $menu_xml->readSection('info', 'desc');
							$arr_dw['image'][$key]       = $menu_xml->readSection('info', 'image');
							$arr_dw['date'][$key]        = $menu_xml->readSection('info', 'date');
							$arr_dw['status'][$key]      = $menu_xml->readSection('info', 'status');
							$arr_dw['price'][$key]       = $menu_xml->readSection('info', 'price');
							$arr_dw['price_tax'][$key]   = $menu_xml->readSection('info', 'price_tax');
							$arr_dw['sort'][$key]        = $menu_xml->readSection('info', 'sort');
							$arr_dw['tag'][$key]         = substr($value, 0, 10);
							
							if(!$arr_dw['product'][$key])   { $arr_dw['product'][$key]   = ''; }
							if(!$arr_dw['desc'][$key])      { $arr_dw['desc'][$key]      = ''; }
							if(!$arr_dw['image'][$key])     { $arr_dw['image'][$key]     = ''; }
							if(!$arr_dw['date'][$key])      { $arr_dw['date'][$key]      = ''; }
							if(!$arr_dw['status'][$key])    { $arr_dw['status'][$key]    = ''; }
							if(!$arr_dw['price'][$key])     { $arr_dw['price'][$key]     = ''; }
							if(!$arr_dw['price_tax'][$key]) { $arr_dw['price_tax'][$key] = ''; }
							if(!$arr_dw['sort'][$key])      { $arr_dw['sort'][$key]      = ''; }
							
							// CHARSETS
							$arr_dw['product'][$key] = $tcms_main->decodeText($arr_dw['product'][$key], '2', $c_charset);
							$arr_dw['desc'][$key]    = $tcms_main->decodeText($arr_dw['desc'][$key], '2', $c_charset);
						}
					}
				}
				
				$showAll = false;
			}
			
			if(is_array($arr_dw['product'])){
				array_multisort(
					$arr_dw['sort'], SORT_ASC, 
					$arr_dw['product'], SORT_ASC, 
					$arr_dw['desc'], SORT_ASC, 
					$arr_dw['image'], SORT_ASC, 
					$arr_dw['date'], SORT_ASC, 
					$arr_dw['status'], SORT_ASC, 
					$arr_dw['price'], SORT_ASC, 
					$arr_dw['price_tax'], SORT_ASC, 
					$arr_dw['tag'], SORT_ASC
				);
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
			
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."products "
			."WHERE uid='".$main_category."' "
			."AND sql_type='d' "
			."AND ( access = 'Public' "
			.$strAdd
			."ORDER BY sort DESC, date DESC, name DESC";
			
			$sqlQR = $sqlAL->query($sqlSTR);
			$chkNr = $sqlAL->getNumber($sqlQR);
			
			if($chkNr != 0){
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				
				$arr_name = $sqlARR['name'];
				$arr_date = $sqlARR['date'];
				$arr_desc = $sqlARR['desc'];
				$arr_sort = $sqlARR['sort'];
				$arr_dir  = $sqlARR['folder'];
				$arr_pub  = $sqlARR['pub'];
				$arr_ac   = $sqlARR['access'];
				
				if($arr_name == NULL){ $arr_name = ''; }
				if($arr_date == NULL){ $arr_date = ''; }
				if($arr_desc == NULL){ $arr_desc = ''; }
				if($arr_sort == NULL){ $arr_sort = ''; }
				if($arr_dir  == NULL){ $arr_dir  = ''; }
				if($arr_pub  == NULL){ $arr_pub  = ''; }
				if($arr_ac   == NULL){ $arr_ac   = ''; }
				
				$sqlQR = $sqlAL->getAll($tcms_db_prefix."products WHERE category='".$main_category."' AND sql_type='f'");
				
				$count = 0;
				
				while($sqlARR = $sqlAL->fetchArray($sqlQR)){
					$arr_dw['product'][$count]   = $sqlARR['name'];
					$arr_dw['desc'][$count]      = $sqlARR['desc'];
					$arr_dw['image'][$count]     = $sqlARR['image'];
					$arr_dw['date'][$count]      = $sqlARR['date'];
					$arr_dw['status'][$count]    = $sqlARR['status'];
					$arr_dw['price'][$count]     = $sqlARR['price'];
					$arr_dw['price_tax'][$count] = $sqlARR['price_tax'];
					$arr_dw['sort'][$count]      = $sqlARR['sort'];
					$arr_dw['tag'][$count]       = $sqlARR['uid'];
					
					if($arr_dw['product'][$count]   == NULL){ $arr_dw['product'][$count]   = ''; }
					if($arr_dw['desc'][$count]      == NULL){ $arr_dw['desc'][$count]      = ''; }
					if($arr_dw['image'][$count]     == NULL){ $arr_dw['image'][$count]     = ''; }
					if($arr_dw['date'][$count]      == NULL){ $arr_dw['date'][$count]      = ''; }
					if($arr_dw['status'][$count]    == NULL){ $arr_dw['status'][$count]    = ''; }
					if($arr_dw['price'][$count]     == NULL){ $arr_dw['price'][$count]     = ''; }
					if($arr_dw['price_tax'][$count] == NULL){ $arr_dw['price_tax'][$count] = ''; }
					if($arr_dw['sort'][$count]      == NULL){ $arr_dw['sort'][$count]      = ''; }
					if($arr_dw['tag'][$count]       == NULL){ $arr_dw['tag'][$count]       = ''; }
					
					// CHARSETS
					$arr_dw['product'][$count] = $tcms_main->decodeText($arr_dw['product'][$count], '2', $c_charset);
					$arr_dw['desc'][$count]    = $tcms_main->decodeText($arr_dw['desc'][$count], '2', $c_charset);
					
					$count++;
					$checkCatAmount = $count;
				}
			}
		}
		
		// CHARSETS
		$arr_name = $tcms_main->decodeText($arr_name, '2', $c_charset);
		$arr_desc = $tcms_main->decodeText($arr_desc, '2', $c_charset);
	}
	
	
	echo $tcms_html->tableHeadClass('0', '0', '0', '100%', 'noborder');
	echo '<tr>'
	.'<td valign="top" class="titleBG" style="padding-left: 2px;" align="left" colspan="2">'.$arr_name.'</td><tr>'
	.'<tr style="height: 2px;"><td colspan="2"></td></tr>'
	.'<tr><td colspan="2"><br /></td></tr>'
	.'<tr><td>';
	
	if(isset($arr_dw['sort']) && !empty($arr_dw['sort']) && $arr_dw['sort'] != ''){
		foreach($arr_dw['sort'] as $key => $value){
			if($arr_dw['status'][$key] == 1){
				echo $tcms_html->tableHead('0', '0', '0'. '100%');
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id=products&amp;s='.$s.'&amp;action=showone&amp;category='.$main_category.'&amp;article='.$arr_dw['tag'][$key]
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '<tr><td valign="middle" colspan="2" class="products_top">'
				.'<a class="products_top" href="'.$link.'">'
				.$arr_dw['product'][$key]
				.'</a></td></tr>';
				
				//-------------
				echo '<tr>';
				
				echo '<td valign="top" rowspan="2">'.$tcms_html->text($arr_dw['desc'][$key], 'left').'<br /></td>';
				
				echo '<td align="right" class="text_normal" width="110">';
					if($arr_dw['price_tax'][$key] != '' || !empty($arr_dw['price_tax'][$key])){
						echo '<strong>';
						
						if($currency == 'EUR'){
							echo $arr_dw['price_tax'][$key];
							echo '&nbsp;'.$arr_currency['html'][$currency];
						}
						else{
							echo $arr_currency['html'][$currency].'&nbsp;';
							echo $arr_dw['price_tax'][$key];
						}
						
						echo '</strong><br />'._PRODUCTS_INC_TAX;
					}
					elseif($arr_dw['price'][$key] != '' || !empty($arr_dw['price'][$key])){
						echo '<strong>';
						
						if($currency == 'EUR'){
						       echo $arr_dw['price'][$key];
						       echo '&nbsp;'.$arr_currency['html'][$currency];
						}
						else{
						       echo $arr_currency['html'][$currency].'&nbsp;';
						       echo $arr_dw['price'][$key];
						}
						
						echo '</strong><br />'._PRODUCTS_EX_TAX;
					}
				echo '</td>';
				
				echo '</tr>';
				
				echo '<tr><td align="right" valign="top">'
					.( $arr_dw['image'][$key] == '_empty_' ? 
					'<img src="'.$imagePath.'engine/images/no_picture.gif" border="0" />' : 
					'<img src="'.$imagePath.'data/images/products/'.$arr_dw['image'][$key].'" border="0" />' )
				.'</td></tr>';
				//-------------
				
				echo $tcms_html->tableEnd();
				
				echo '<br />';
			}
		}
	}
	
	echo '</td></tr>';
	echo $tcms_html->tableEnd();
	echo '<br />';
}





/*
	show one article
*/

if($action == 'showone'){
	if($choosenDB == 'xml'){
		$down_xml = new xmlparser($tcms_administer_site.'/tcms_products/'.$category.'/folderinfo.xml','r');
		$down_cat = $down_xml->readSection('folderinfo', 'name');
		$down_acc = $down_xml->readSection('folderinfo', 'access');
		
		$down_cat = $tcms_main->decodeText($down_cat, '2', $c_charset);
		
		$showAll = $tcms_main->checkAccess($down_acc, $is_admin);
		
		if($showAll == true){
			$menu_xml = new xmlparser($tcms_administer_site.'/tcms_products/'.$category.'/'.$article.'.xml','r');
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
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		$sqlQR = $sqlAL->getOne($tcms_db_prefix.'products', $category);
		$sqlARR = $sqlAL->fetchArray($sqlQR);
		$down_cat = $sqlARR['name'];
		$down_acc = $sqlARR['access'];
		
		$down_cat = $tcms_main->decodeText($down_cat, '2', $c_charset);
		
		$showAll = $tcms_main->checkAccess($down_acc, $is_admin);
		
		if($showAll == true){
			$sqlQR = $sqlAL->getAll($tcms_db_prefix."products WHERE uid='".$article."' AND sql_type='f' AND category='".$category."'");
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$arr_product     = $sqlObj->name;
			$arr_product_no  = $sqlObj->product_number;
			$arr_factory     = $sqlObj->factory;
			$arr_factory_url = $sqlObj->factory_url;
			$arr_desc        = $sqlObj->desc;
			$arr_category    = $sqlObj->category;
			$arr_image       = $sqlObj->image;
			$arr_date        = $sqlObj->date;
			$arr_price       = $sqlObj->price;
			$arr_pricetax    = $sqlObj->price_tax;
			$arr_status      = $sqlObj->status;
			$arr_quantity    = $sqlObj->quantity;
			$arr_weight      = $sqlObj->weight;
			$arr_sort        = $sqlObj->sort;
			$arr_tag         = $sqlObj->uid;
			
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
	}
	
	// CHARSETS
	$arr_product = $tcms_main->decodeText($arr_product, '2', $c_charset);
	$arr_factory = $tcms_main->decodeText($arr_factory, '2', $c_charset);
	$arr_desc    = $tcms_main->decodeText($arr_desc, '2', $c_charset);
	
	
	if($showAll == true){
		echo tcms_html::table_head('0', '0', '0', '100%');
		
		echo '<tr><td valign="top" colspan="2" class="products_top">'
		.$tcms_html->contentTitle($arr_product)
		.'<span class="text_small">'.( $arr_product_no != '' ? '['.$arr_product_no.']' : '' ).'</span>'
		.'</td></tr>';
		
		//-------------
		echo '<tr>';
		
		echo '<td valign="top" rowspan="2">'.$tcms_html->text($arr_desc, 'left').'<br /></td>';
		
		echo '<td align="right" class="text_normal" width="110">';
			if(($arr_pricetax != '' || !empty($arr_pricetax)) || ($arr_price != '' || !empty($arr_price))){
				echo '<strong>';
				
				if($currency == 'EUR'){
					echo ( !empty($arr_pricetax) ? $arr_pricetax : $arr_price );
					echo ' '.$arr_currency['html'][$currency];
				}
				else{
					echo $arr_currency['html'][$currency].' ';
					echo ( !empty($arr_pricetax) ? $arr_pricetax : $arr_price );
				}
				
				echo '</strong><br />'.( !empty($arr_pricetax) ? _PRODUCTS_INC_TAX : _PRODUCTS_EX_TAX );
			}
		echo '</td>';
		
		echo '</tr>';
		
		echo '<tr><td align="right" valign="top">'
			.( $arr_image == '_empty_' ? 
			'<img src="'.$imagePath.'engine/images/no_picture.gif" border="0" />' : 
			'<img src="'.$imagePath.'data/images/products/'.$arr_image.'" border="0" />' )
		.'</td></tr>';
		//-------------
		
		echo '<tr><td colspan="2" style="height: 10px;"></td></tr>';
		
		echo '<tr><td valign="top" colspan="2" class="text_normal">'
		
		.( $arr_factory != '' ? _TABLE_FACTORY.': '.'<a href="'.( substr($arr_factory_url, 0, 4) != 'http' ? 'http://' : '' ).$arr_factory_url.'">'.$arr_factory.'</a><br />' : '' )
		
		.( $arr_weight != '' ? _TABLE_WEIGHT.': '.$arr_weight.'<br />' : '' )
		
		.( $arr_quantity != -1 ? _TABLE_STOCK.': '.$arr_quantity.'<br />' : '' )
		
		.'</td></tr>';
		
		echo $tcms_html->tableEnd();
		
		echo '<br />';
	}
	else{
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
}



?>
