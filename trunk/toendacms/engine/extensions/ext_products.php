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
 * @version 0.5.5
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
	
	echo '<br />'
	.'<hr noshade="noshade" class="titleBG" />'
	.'<br />';
	
	
	
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
				."ORDER BY sql_type ASC, sort ASC, name ASC";
			}
			else {
				$sqlSTR = "SELECT * "
				."FROM ".$tcms_db_prefix."products "
				."WHERE category = '".$category."' "
				."AND language = '".$tcms_config->getLanguageFrontend()."' "
				."AND pub = 1 "
				."AND NOT (name = '') "
				."AND ( access = 'Public' "
				.$strAdd
				."ORDER BY sql_type ASC, sort ASC, name ASC";
				
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
					$arr_pro['type'][$count]   = $sqlObj->sql_type;
					$arr_pro['price'][$count]  = $sqlObj->price;
					$arr_pro['taxkey'][$count] = $sqlObj->price_tax;
					
					
					if($arr_pro['price'][$count]  == NULL){ $arr_pro['price'][$count]  = ''; }
					if($arr_pro['taxkey'][$count] == NULL){ $arr_pro['taxkey'][$count] = ''; }
					if($arr_pro['uid'][$count]    == NULL){ $arr_pro['uid'][$count]    = ''; }
					if($arr_pro['name'][$count]   == NULL){ $arr_pro['name'][$count]   = ''; }
					if($arr_pro['desc'][$count]   == NULL){ $arr_pro['desc'][$count]   = ''; }
					if($arr_pro['date'][$count]   == NULL){ $arr_pro['date'][$count]   = ''; }
					if($arr_pro['image1'][$count] == NULL){ $arr_pro['image1'][$count] = ''; }
					if($arr_pro['sort'][$count]   == NULL){ $arr_pro['sort'][$count]   = ''; }
					if($arr_pro['type'][$count]   == NULL){ $arr_pro['type'][$count]   = ''; }
					
					
					// CHARSETS
					$arr_pro['name'][$count] = $tcms_main->decodeText($arr_pro['name'][$count], '2', $c_charset);
					$arr_pro['desc'][$count] = $tcms_main->decodeText($arr_pro['desc'][$count], '2', $c_charset);
					
					$count++;
					$checkCatAmount = $count;
				}
				
				$checkCatAmount--;
			}
			
			$intOdd = 0;
			
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
						.( trim($arr_pro['type'][$key]) == 'a' 
							? 'id=products&amp;s='.$s.'&amp;action=showone'
							.'&amp;article='.$arr_pro['uid'][$key]
							
							: 'id=products&amp;s='.$s.'&amp;action=showall'
							.'&amp;cmd=browse'
							.'&amp;category='.$arr_pro['uid'][$key]
						)
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
			//."uid, name, desc, date, image1, sort, category, price, price_tax "
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
					$arr_pro['cat'][$count]    = $sqlObj->category;
					
					
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
					if($arr_pro['cat'][$count]    == NULL){ $arr_pro['cat'][$count]    = ''; }
					
					
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
					//.( trim($arr_pro['cat'][$key]) != '' ? '&amp;category='.$arr_pro['cat'][$key] : '' )
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





// -------------------------------------------------
// SHOW ONE
// -------------------------------------------------

if($action == 'showone') {
	$sqlNR = 0;
	
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
		."WHERE uid='".$article."' "
		//."AND category='".$category."'"
		."AND pub = 1 "
		."AND sql_type = 'a' "
		."AND ( access = 'Public' "
		.$strAdd;
		
		$sqlQR = $sqlAL->query($sqlSTR);
		$sqlNR = $sqlAL->getNumber($sqlQR);
		
		if($sqlNR > 0) {
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$arr_name        = $sqlObj->name;
			$arr_product_no  = $sqlObj->product_number;
			$arr_factory     = $sqlObj->factory;
			$arr_factory_url = $sqlObj->factory_url;
			$arr_desc        = $sqlObj->desc;
			$arr_category    = $sqlObj->category;
			$arr_date        = $sqlObj->date;
			$arr_price       = $sqlObj->price;
			$arr_pricetax    = $sqlObj->price_tax;
			$arr_status      = $sqlObj->status;
			$arr_quantity    = $sqlObj->quantity;
			$arr_weight      = $sqlObj->weight;
			$arr_sort        = $sqlObj->sort;
			$arr_uid         = $sqlObj->uid;
			$arr_image1      = $sqlObj->image1;
			$arr_image2      = $sqlObj->image2;
			$arr_image3      = $sqlObj->image3;
			$arr_image4      = $sqlObj->image4;
			
			if($arr_name        == NULL){ $arr_name        = ''; }
			if($arr_product_no  == NULL){ $arr_product_no  = ''; }
			if($arr_factory     == NULL){ $arr_factory     = ''; }
			if($arr_factory_url == NULL){ $arr_factory_url = ''; }
			if($arr_desc        == NULL){ $arr_desc        = ''; }
			if($arr_category    == NULL){ $arr_category    = ''; }
			if($arr_date        == NULL){ $arr_date        = ''; }
			if($arr_price       == NULL){ $arr_price       = ''; }
			if($arr_pricetax    == NULL){ $arr_pricetax    = ''; }
			if($arr_status      == NULL){ $arr_status      = ''; }
			if($arr_quantity    == NULL){ $arr_quantity    = ''; }
			if($arr_weight      == NULL){ $arr_weight      = ''; }
			if($arr_sort        == NULL){ $arr_sort        = ''; }
			if($arr_uid         == NULL){ $arr_uid         = ''; }
			if($arr_image1      == NULL){ $arr_image1      = ''; }
			if($arr_image2      == NULL){ $arr_image2      = ''; }
			if($arr_image3      == NULL){ $arr_image3      = ''; }
			if($arr_image4      == NULL){ $arr_image4      = ''; }
			
			$arr_name = $tcms_main->decodeText($arr_name, '2', $c_charset);
			$arr_desc = $tcms_main->decodeText($arr_desc, '2', $c_charset);
			
			$arr_name = htmlspecialchars($arr_name);
			
			// load cat
			if(trim($arr_category) != '') {
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
				."WHERE uid='".$arr_category."' "
				//."AND category='".$category."'"
				."AND pub = 1 "
				//."AND sql_type = 'a' "
				."AND ( access = 'Public' "
				.$strAdd;
				
				$sqlQR = $sqlAL->query($sqlSTR);
				$sqlNR = $sqlAL->getNumber($sqlQR);
				
				if($sqlNR > 0) {
					$sqlObj = $sqlAL->fetchObject($sqlQR);
					
					$wsName = $sqlObj->name;
					$wsUID  = $sqlObj->uid;
					
					if($wsName == NULL){ $wsName = ''; }
					if($wsUID  == NULL){ $wsUID  = ''; }
					
					$wsName = $tcms_main->decodeText($wsName, '2', $c_charset);
				}
			}
		}
	}
	
	
	// display item
	if($sqlNR > 0) {
		echo $tcms_html->tableHead('0', '0', '1', '100%')
		.'<tr><td valign="top" colspan="2" class="products_top">'
		.$tcms_html->contentTitle($arr_name)
		.'<span class="text_small">';
		
		if(trim($wsName) != '') {
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id=products&amp;s='.$s.'&amp;action=showall'
			.'&amp;cmd=browse'
			.'&amp;category='.$wsUID
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<a class="products_top" href="'.$link.'">'
			.$wsName
			.'</a>&nbsp;~&nbsp;';
		}
		
		echo ( $arr_product_no != '' ? '['.$arr_product_no.']' : '' )
		.'</span>'
		.'</td></tr>';
		
		// row1
		echo '<tr>'
		.'<td valign="top">'
		.$tcms_html->text($arr_desc, 'left')
		.'<br />'
		.'</td>'
		.'<td valign="top" align="right" class="text_normal" width="110">';
		
		if($arr_price != -1) {
			if($tcms_main->isReal($arr_pricetax)) {
				echo '<strong>';
				
				$taxPrice = $tcms_main->getTaxPrice($arr_price, $arr_pricetax);
				
				if($currency == 'EUR') {
					echo $arr_price
					.'&nbsp;'.$arr_currency['html'][$currency]
					.'</strong><br />'
					.'('.$taxPrice.')'
					.'&nbsp;'.$arr_currency['html'][$currency];
				}
				else {
					echo $arr_currency['html'][$currency]
					.'&nbsp;'.$arr_price
					.'</strong><br />'
					.$arr_currency['html'][$currency]
					.'&nbsp;('.$taxPrice.')';
				}
				
				echo '<br />'
				.( !empty($arr_pricetax) ? _PRODUCTS_INC_TAX : _PRODUCTS_EX_TAX );
			}
			else {
				echo '<strong>';
				
				if($currency == 'EUR') {
					echo $arr_price
					.'&nbsp;'.$arr_currency['html'][$currency];
				}
				else {
					echo $arr_currency['html'][$currency]
					.'&nbsp;'.$arr_price;
				}
				
				echo '</strong><br />';
			}
		}
		
		echo '</td>'
		.'</tr>';
		
		echo '<tr><td valign="top" colspan="2">';
		
		if($arr_image1 != '' && file_exists('data/images/products/'.$arr_image1)) {
			$img_size_1 = getimagesize('data/images/products/'.$arr_image1);
			$img_o_width_1  = $img_size_1[0];
			$img_o_height_1 = $img_size_1[1];
			
			echo '<a href="'.$imagePath.'data/images/products/'.$arr_image1.'" rel="lightbox">';
			
			if($detect_browser == 1){
				echo '<script>if(browser == \'ie\'){'
				.'document.write(\'<img align="left"'
				.( $img_o_width_1 > 235
					? ' width="235"'
					: ''
				).' src="'.$imagePath.'data/images/products/'.$arr_image1.'" border="0" />\');'
				.'}else{'
				.'document.write(\'<img align="left"'
				.( $img_o_width_1 > 235
					? ' width="47%"'
					: ''
				).' src="'.$imagePath.'data/images/products/'.$arr_image1.'" border="0" />\');'
				.'}</script>';
				
				echo '<noscript>'
				.'<img align="left"'
				.( $img_o_width_1 > 235
					? ' width="47%"'
					: ''
				).' src="'.$imagePath.'data/images/products/'.$arr_image1.'" border="0" />'
				.'</noscript>';
			}
			else{
				echo '<img align="left"'
				.( $img_o_width_1 > 235
					? ' width="47%"'
					: ''
				).' src="'.$imagePath.'data/images/products/'.$arr_image1.'" border="0" />';
			}
			
			echo '</a>';
		}
		
		if($arr_image2 != '' && file_exists('data/images/products/'.$arr_image2)) {
			$img_size_2 = getimagesize('data/images/products/'.$arr_image2);
			$img_o_width_2  = $img_size_2[0];
			$img_o_height_2 = $img_size_2[1];
			
			echo '<a href="'.$imagePath.'data/images/products/'.$arr_image2.'" rel="lightbox">';
			
			if($detect_browser == 1){
				echo '<script>if(browser == \'ie\'){'
				.'document.write(\'<img align="left"'
				.( $img_o_width_2 > 235
					? ' width="235"'
					: ''
				).' src="'.$imagePath.'data/images/products/'.$arr_image2.'" border="0" />\');'
				.'}else{'
				.'document.write(\'<img align="left"'
				.( $img_o_width_2 > 235
					? ' width="47%"'
					: ''
				).' src="'.$imagePath.'data/images/products/'.$arr_image2.'" border="0" />\');'
				.'}</script>';
				
				echo '<noscript>'
				.'<img align="left"'
				.( $img_o_width_2 > 235
					? ' width="47%"'
					: ''
				).' src="'.$imagePath.'data/images/products/'.$arr_image2.'" border="0" />'
				.'</noscript>';
			}
			else{
				echo '<img align="left"'
				.( $img_o_width_2 > 235
					? ' width="47%"'
					: ''
				).' src="'.$imagePath.'data/images/products/'.$arr_image2.'" border="0" />';
			}
			
			echo '</a>';
		}
		
		if($arr_image3 != '' && file_exists('data/images/products/'.$arr_image3)) {
			$img_size_3 = getimagesize('data/images/products/'.$arr_image3);
			$img_o_width_3  = $img_size_3[0];
			$img_o_height_3 = $img_size_3[1];
			
			echo '<a href="'.$imagePath.'data/images/products/'.$arr_image3.'" rel="lightbox">'
			.'<img align="left"'
			.( $img_o_width_3 > 235
				? ' width="47%"'
				: ''
			).' src="'.$imagePath.'data/images/products/'.$arr_image3.'" border="0" />'
			.'</a>';
		}
		
		if($arr_image4 != '' && file_exists('data/images/products/'.$arr_image4)) {
			$img_size_4 = getimagesize('data/images/products/'.$arr_image4);
			$img_o_width_4  = $img_size_4[0];
			$img_o_height_4 = $img_size_4[1];
			
			echo '<a href="'.$imagePath.'data/images/products/'.$arr_image4.'" rel="lightbox">'
			.'<img align="left"'
			.( $img_o_width_4 > 235
				? ' width="47%"'
				: ''
			).' src="'.$imagePath.'data/images/products/'.$arr_image4.'" border="0" />'
			.'</a>';
		}
		
		echo '</td>'
		.'</tr>';
		
		echo '<tr>'
		.'<td colspan="2" style="height: 10px;"></td>'
		.'</tr>';
		
		echo '<tr>'
		.'<td valign="top" colspan="2" class="text_normal">'
		.( $arr_factory != '' 
			? _TABLE_FACTORY
			.': <a href="'
			.( substr($arr_factory_url, 0, 4) != 'http' 
				? 'http://' 
				: '' 
			).$arr_factory_url.'">'.$arr_factory.'</a><br />' 
			: '' 
		)
		.( $arr_weight != '' 
			? _TABLE_WEIGHT.': '.$arr_weight.'<br />' 
			: '' 
		)
		.( $arr_quantity != -1 
			? _TABLE_STOCK.': '.$arr_quantity.'<br />' 
			: '' 
		)
		.'</td></tr>';
		
		echo $tcms_html->tableEnd()
		.'<br />';
	}
	else {
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
} 

?>
