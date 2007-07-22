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
| File:	mod_products.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Products Manager
 *
 * This module is used for the products configuration
 * and the administration of all the products.
 *
 * @version 0.7.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


// global
if(isset($_GET['category'])){ $category = $_GET['category']; }
if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['type'])){ $type = $_GET['type']; }

if(isset($_POST['type'])){ $type = $_POST['type']; }
if(isset($_POST['delete'])){ $delete = $_POST['delete']; }
if(isset($_POST['lang_exist'])){ $lang_exist = $_POST['lang_exist']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }
if(isset($_POST['new_lang'])){ $new_lang = $_POST['new_lang']; }

// cfg
if(isset($_POST['new_pid'])){ $new_pid = $_POST['new_pid']; }
if(isset($_POST['new_ptitle'])){ $new_ptitle = $_POST['new_ptitle']; }
if(isset($_POST['new_pstamp'])){ $new_pstamp = $_POST['new_pstamp']; }
if(isset($_POST['new_cstate'])){ $new_cstate = $_POST['new_cstate']; }
if(isset($_POST['new_ctitle'])){ $new_ctitle = $_POST['new_ctitle']; }
if(isset($_POST['new_usest'])){ $new_usest = $_POST['new_usest']; }
if(isset($_POST['new_spou'])){ $new_spou = $_POST['new_spou']; }
if(isset($_POST['new_spt'])){ $new_spt = $_POST['new_spt']; }

// items
if(isset($_POST['new_name'])){ $new_name = $_POST['new_name']; }
if(isset($_POST['new_sort'])){ $new_sort = $_POST['new_sort']; }
if(isset($_POST['new_access'])){ $new_access = $_POST['new_access']; }
if(isset($_POST['new_category'])){ $new_category = $_POST['new_category']; }
if(isset($_POST['new_date'])){ $new_date = $_POST['new_date']; }
if(isset($_POST['new_pub'])){ $new_pub = $_POST['new_pub']; }
if(isset($_POST['new_sos'])){ $new_sos = $_POST['new_sos']; }
if(isset($_POST['new_factory'])){ $new_factory = $_POST['new_factory']; }
if(isset($_POST['new_factory_url'])){ $new_factory_url = $_POST['new_factory_url']; }
if(isset($_POST['new_product_no'])){ $new_product_no = $_POST['new_product_no']; }
if(isset($_POST['new_status'])){ $new_status = $_POST['new_status']; }
if(isset($_POST['new_price'])){ $new_price = $_POST['new_price']; }
if(isset($_POST['new_pricetax'])){ $new_pricetax = $_POST['new_pricetax']; }
if(isset($_POST['new_quantity'])){ $new_quantity = $_POST['new_quantity']; }
if(isset($_POST['new_parent'])){ $new_parent = $_POST['new_parent']; }
if(isset($_POST['new_weight'])){ $new_weight = $_POST['new_weight']; }

// images
if(isset($_POST['new_image1'])){ $new_image1 = $_POST['new_image1']; }
if(isset($_POST['tmp_image1'])){ $tmp_image1 = $_POST['tmp_image1']; }
if(isset($_POST['old_image1'])){ $old_image1 = $_POST['old_image1']; }
if(isset($_POST['new_image2'])){ $new_image2 = $_POST['new_image2']; }
if(isset($_POST['tmp_image2'])){ $tmp_image2 = $_POST['tmp_image2']; }
if(isset($_POST['old_image2'])){ $old_image2 = $_POST['old_image2']; }
if(isset($_POST['new_image3'])){ $new_image3 = $_POST['new_image3']; }
if(isset($_POST['tmp_image3'])){ $tmp_image3 = $_POST['tmp_image3']; }
if(isset($_POST['old_image3'])){ $old_image3 = $_POST['old_image3']; }
if(isset($_POST['new_image4'])){ $new_image4 = $_POST['new_image4']; }
if(isset($_POST['tmp_image4'])){ $tmp_image4 = $_POST['tmp_image4']; }
if(isset($_POST['old_image4'])){ $old_image4 = $_POST['old_image4']; }





// -------------------------------------------------
// INIT
// -------------------------------------------------

echo '<script language="JavaScript" src="../js/jscalendar/calendar.js"></script>';
echo '<script language="Javascript" src="../js/jscalendar/lang/calendar-en.js"></script>';
echo '<script language="Javascript" src="../js/jscalendar/calendar-setup.js"></script>';
echo '<link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-toendaCMS.css" title="toendaCMS" />';

if($show_wysiwyg == 'tinymce'){
	include('../tcms_kernel/tcms_tinyMCE.lib.php');
	
	$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
	$tcms_tinyMCE->initTinyMCE();
}

if(!isset($action)){ $action = ''; }
if(!isset($todo)){ $todo = 'show'; }

$arr_farbe[0] = $arr_color[0];
$arr_farbe[1] = $arr_color[1];
$bgkey     = 0;





// -------------------------------------------------
// CONFIGURATION
// -------------------------------------------------

if($todo == 'config'){
	if($id_group == 'Developer' 
	|| $id_group == 'Administrator'){
		if($tcms_main->isReal($lang))
			$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
		else
			$getLang = $tcms_front_lang;
		
		
		if($choosenDB == 'xml'){
			if(file_exists('../../'.$tcms_administer_site.'/tcms_global/contactform.'.$getLang.'.xml')) {
				$pXML = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/products.xml','r');
				
				$old_lang   = $pXML->readSection('config', 'language');
				$old_pid    = $pXML->readSection('config', 'products_id');
				$old_ptitle = $pXML->readSection('config', 'products_title');
				$old_pstamp = $pXML->readSection('config', 'products_stamp');
				$old_ptext  = $pXML->readSection('config', 'products_text');
				$old_cstate = $pXML->readSection('config', 'category_state');
				$old_ctitle = $pXML->readSection('config', 'category_title');
				$old_usest  = $pXML->readSection('config', 'use_category_title');
				$old_spou   = $pXML->readSection('config', 'show_price_only_users');
				$old_spt    = $pXML->readSection('config', 'startpagetitle');
				
				if(!$old_pid)   { $old_pid    = ''; }
				if(!$old_ptitle){ $old_ptitle = ''; }
				if(!$old_pstamp){ $old_pstamp = ''; }
				if(!$old_cstate){ $old_cstate = ''; }
				if(!$old_ctitle){ $old_ctitle = ''; }
				//if(!$old_usest) { $old_usest  = ''; }
				//if(!$old_spou)  { $old_spou   = ''; }
				if(!$old_spt)   { $old_spt    = ''; }
				
				$langExist = 1;
			}
			else {
				$langExist = 0;
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strQuery = "SELECT * "
			."FROM ".$tcms_db_prefix."products_config "
			."WHERE language = '".$getLang."'";
			
			//echo $strQuery;
			
			$sqlQR = $sqlAL->query($strQuery);
			$langExist = $sqlAL->getNumber($sqlQR);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$old_lang   = $sqlObj->language;
			$old_pid    = $sqlObj->products_id;
			$old_ptitle = $sqlObj->products_title;
			$old_pstamp = $sqlObj->products_stamp;
			$old_ptext  = $sqlObj->products_text;
			$old_cstate = $sqlObj->category_state;
			$old_ctitle = $sqlObj->category_title;
			$old_usest  = $sqlObj->use_category_title;
			$old_spou   = $sqlObj->show_price_only_users;
			$old_spt    = $sqlObj->startpagetitle;
			
			if($old_pid    == NULL){ $old_pid    = ''; }
			if($old_ptitle == NULL){ $old_ptitle = ''; }
			if($old_pstamp == NULL){ $old_pstamp = ''; }
			if($old_ptext  == NULL){ $old_ptext  = ''; }
			if($old_cstate == NULL){ $old_cstate = ''; }
			if($old_ctitle == NULL){ $old_ctitle = ''; }
			if($old_usest  == NULL){ $old_usest  = 0; }
			if($old_spou   == NULL){ $old_spou   = 0; }
			if($old_spt    == NULL){ $old_spt    = ''; }
		}
		
		$old_ptitle = $tcms_main->decodeText($old_ptitle, '2', $c_charset);
		$old_pstamp = $tcms_main->decodeText($old_pstamp, '2', $c_charset);
		$old_ptext  = $tcms_main->decodeText($old_ptext, '2', $c_charset);
		$old_ctitle = $tcms_main->decodeText($old_ctitle, '2', $c_charset);
		$old_spt    = $tcms_main->decodeText($old_spt, '2', $c_charset);
		
		$old_ptitle = htmlspecialchars($old_ptitle);
		$old_pstamp = htmlspecialchars($old_pstamp);
		$old_ctitle = htmlspecialchars($old_ctitle);
		$old_spt    = htmlspecialchars($old_spt);
		
		switch(trim($show_wysiwyg)){
			case 'tinymce':
				//$old_front_text = str_replace('src="', 'src="../../', $old_front_text);
				$old_ptext = stripslashes($old_ptext);
				break;
			
			case 'fckeditor':
				$old_ptext = str_replace('src="', 'src="../../../../', $old_ptext);
				$old_ptext = str_replace('src="../../../../http:', 'src="http:', $old_ptext);
				$old_ptext = str_replace('src="../../../../https:', 'src="https:', $old_ptext);
				$old_ptext = str_replace('src="../../../../ftp:', 'src="ftp:', $old_ptext);
				$old_ptext = str_replace('src="../../../..//', 'src="/', $old_ptext);
				break;
			
			default:
				$old_ptext = ereg_replace('<br />'.chr(10), chr(13), $old_ptext);
				$old_ptext = ereg_replace('<br />'.chr(13), chr(13), $old_ptext);
				$old_ptext = ereg_replace('<br />', chr(13), $old_ptext);
				
				$old_ptext = ereg_replace('<br/>'.chr(10), chr(13), $old_ptext);
				$old_ptext = ereg_replace('<br/>'.chr(13), chr(13), $old_ptext);
				$old_ptext = ereg_replace('<br/>', chr(13), $old_ptext);
				
				$old_ptext = ereg_replace('<br>'.chr(10), chr(13), $old_ptext);
				$old_ptext = ereg_replace('<br>'.chr(13), chr(13), $old_ptext);
				$old_ptext = ereg_replace('<br>', chr(13), $old_ptext);
				break;
		}
		
		
		if($langExist == 0) {
			$old_lang = $getLang;
		}
		
		
		
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_products" method="post">'
		.'<input name="todo" type="hidden" value="save_config" />'
		.'<input name="lang_exist" type="hidden" value="'.$langExist.'" />';
		
		
		
		// frontpage news settings
		echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder">'
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TCMS_ADMIN_EDIT_LANG.'</th>'
		.'</tr></table>';
		
		
		// language
		echo $tcms_html->tableHeadNoBorder('1', '0', '0', '100%');
		
		// row
		$link = 'admin.php?id_user='.$id_user.'&site=mod_products&amp;todo=config'
		.'&amp;lang=';
		
		$js = ' onchange="document.location=\''.$link.'\' + this.value;"';
		
		echo '<tr><td width="300" valign="top">'
		.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
		.'</td><td>'
		.'<select class="tcms_select" id="new_lang" name="new_lang"'.$js.'>';
		
		foreach($languages['fine'] as $key => $value) {
			if($old_lang == $languages['code'][$key])
				$dl = ' selected="selected"';
			else
				$dl = '';
			
			echo '<option value="'.$value.'"'.$dl.'>'
			.$languages['name'][$key]
			.'</option>';
		}
		
		echo '</select>'
		.'</td></tr>';
		
		
		// table end
		echo '<tr><td><br /></td></tr>'
		.$tcms_html->tableEnd();
		
		
		
		// table
		echo $tcms_html->tableHeadNoBorder('1', '0', '0', '100%');
		
		
		// table rows
		echo '<tr class="tcms_bg_blue_01"><td colspan="3" class="tcms_db_title tcms_padding_mini">'
		.'<strong>'._PRODUCTS_TITLE.'</strong>'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="middle" width="300" style="width: 300px !important;">'
		._PRODUCTS_ID
		.'</td><td valign="middle" colspan="2">'
		.'<input name="new_pid" readonly class="tcms_input_small tcms_bg_grey_03" value="'.$old_pid.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="middle">'
		._PRODUCTS_SITETITLE
		.'</td><td valign="middle" colspan="2">'
		.'<input name="new_ptitle" class="tcms_input_normal" value="'.$old_ptitle.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="middle">'
		._PRODUCTS_SITESUBTITLE
		.'</td><td valign="middle" colspan="2">'
		.'<input name="new_pstamp" class="tcms_input_normal" value="'.$old_pstamp.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="middle">'
		._PRODUCTS_STARTPAGETITLE
		.'</td><td valign="middle" colspan="2">'
		.'<input name="new_spt" class="tcms_input_normal" value="'.$old_spt.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="middle">'
		._PRODUCTS_MAINCATEGORY
		.'</td><td valign="middle" colspan="2">'
		.'<select name="new_cstate">';
		
		foreach($arr_dwcc['name'] as $pkey => $pval){
			echo '<option value="'.$arr_dwcc['dir'][$pkey].'"'.( $arr_dwcc['dir'][$pkey] == $old_cstate ? ' selected' : '' ).'>'.$pval.'</option>';
		}
		
		echo '</select>'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="middle">'
		._PRODUCTS_CATEGORY_TITLE
		.'</td><td valign="middle" colspan="2">'
		.'<input name="new_ctitle" class="tcms_input_normal" value="'.$old_ctitle.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="middle">'
		._PRODUCTS_USE_CATEGORY_TITLE
		.'</td><td>'
		.'<input type="checkbox" name="new_usest" '.( $old_usest == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="middle">'
		._PRODUCTS_SHOW_PRICE_ONLY_USERS
		.'</td><td>'
		.'<input type="checkbox" name="new_spou" '.( $old_spou == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="middle" colspan="2">'
		.'<br />'._TABLE_TEXT
		.( $show_wysiwyg != 'fckeditor' ? '<br /><br />'
		.'<script>'
		.'createToendaToolbar(\'imp\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');'
		.'</script>' : '' );
		
		if($show_wysiwyg != 'tinymce' && $show_wysiwyg != 'fckeditor') {
			if($show_wysiwyg == 'toendaScript') {
				echo '<script>createToolbar(\'imp\', \''.$tcms_lang.'\', \'toendaScript\');</script>';
			}
			else {
				echo '<script>createToolbar(\'imp\', \''.$tcms_lang.'\', \'HTML\');</script>';
			}
		}
		
		echo '<br /><br />';
		
		if($show_wysiwyg == 'tinymce'){
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" name="content" id="content" mce_editable="true">'
			.$old_ptext
			.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor'){
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			$oFCKeditor->Value = $old_ptext;
			$oFCKeditor->Create();
		}
		else{
			echo '<textarea class="tcms_textarea_huge" style="width: 95%;" id="content" name="content">'
			.$old_ptext
			.'</textarea>';
		}
		
		echo '</td></tr>';
		
		
		// Table end
		echo $tcms_html->tableEnd()
		.'<br />';
		
		echo '</form>';
	}
	else{
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
}





// -------------------------------------------------
// LIST ITEMS
// -------------------------------------------------

if($todo == 'show'){
	echo $tcms_html->bold(_PRODUCTS_TITLE);
	echo $tcms_html->text(_PRODUCTS_TEXT.'<br /><br />', 'left');
	
	
	/*
		display category path
	*/
	
	if(isset($category)) {
		if($choosenDB == 'xml') {
			/*$count = 0;
			
			$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$category.'.xml','r');
			
			//$access_cat = $down_xml->readSection('faq', 'access');
			
			$arrFAQparent['type'][$count] = $xml->readSection('faq', 'type');
			$arrFAQparent['pub'][$count]  = $xml->readSection('faq', 'publish_state');
			
			if($arrFAQparent['type'][$count] == 'c' && $arrFAQparent['pub'][$count] == '2'){
				$arrFAQparent['title'][$count]  = $xml->readSection('faq', 'title');
				$arrFAQparent['parent'][$count] = $xml->readSection('faq', 'parent');
				$arrFAQparent['uid'][$count]    = substr($category, 0, 10);
				
				// CHARSETS
				$arrFAQparent['title'][$count] = $tcms_main->decodeText($arrFAQparent['title'][$count], '2', $c_charset);
				
				$checkCat = $xml->readSection('faq', 'category');
				
				$count++;
				
				while($checkCat != ""){
					$xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_knowledgebase/'.$arrFAQparent['parent'][$count - 1].'.xml','r');
					
					$checkCat = $xml->readSection('faq', 'category');
					$arrFAQparent['type'][$count]   = $xml->readSection('faq', 'type');
					$arrFAQparent['pub'][$count]    = $xml->readSection('faq', 'publish_state');
					
					if($arrFAQparent['type'][$count] == 'c' && $arrFAQparent['pub'][$count] == '2'){
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
			switch($id_group) {
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
			//."AND publish_state = 2 "
			."AND sql_type = 'c' "
			."AND ( access = 'Public' "
			.$strAdd;
			
			$count = 0;
			
			$sqlQR = $sqlAL->query($sqlSTRparent);
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			while($sqlNR > 0) {
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				
				unset($sqlQR);
				
				$arr_parent['name'][$count] = $sqlObj->name;
				$arr_parent['uid'][$count]  = $sqlObj->uid;
				$arr_parent['cat'][$count]  = $sqlObj->category;
				
				if($arr_parent['name'][$count] == NULL){ $arr_parent['name'][$count] = ''; }
				if($arr_parent['uid'][$count]  == NULL){ $arr_parent['uid'][$count]  = ''; }
				if($arr_parent['cat'][$count]  == NULL){ $arr_parent['cat'][$count]  = ''; }
				
				// CHARSETS
				$arr_parent['name'][$count] = $tcms_main->decodeText($arr_parent['name'][$count], '2', $c_charset);
				
				$sqlSTRparent = "SELECT * "
				."FROM ".$tcms_db_prefix."products "
				."WHERE uid = '".$arr_parent['cat'][$count]."' "
				//."AND publish_state = 2 "
				."AND sql_type = 'c' "
				."AND ( access = 'Public' "
				.$strAdd;
				
				$sqlQR = $sqlAL->query($sqlSTRparent);
				
				$sqlNR = $sqlAL->getNumber($sqlQR);
				
				$count++;
				$checkTitle = $count;
			}
		}
		
		if(!isset($checkTitle)){ $checkTitle = 1; }
		
		
		echo '<a href="admin.php?id_user='.$id_user.'&amp;site=mod_products">'
		.'<strong>'
		._TCMS_MENU_PRODUCTS
		.'</strong>'
		.'</a>';
		
		
		for($i = ($checkTitle - 1); $i >= 0; $i--) {
			echo '&nbsp;/&nbsp;';
			
			if($i == 0) {
				echo $arr_parent['name'][$i];
			}
			else {
				echo '<a href="admin.php?id_user='.$id_user.'&amp;site=mod_products&amp;category='.$arr_parent['uid'][$i].'">'
				.$arr_parent['name'][$i]
				.'</a>';
			}
		}
		
		echo '<br /><br />';
	}
	
	
	/*
		load items
	*/
	
	$count = 0;
	$checkCatAmount = 0;
	
	if($choosenDB == 'xml'){
		$arr_products = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/tcms_products/');
		
		if(isset($arr_products) && !empty($arr_products) && $arr_products != ''){
			foreach($arr_products as $key => $value){
				$menu_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_products/'.$value.'/folderinfo.xml','r');
				$chkAcc   = $menu_xml->readSection('folderinfo', 'access');
				
				if($id_group == 'Developer' || $id_group == 'Administrator'){ $showAll = true; }
				else{
					if($chkAcc == 'Public' || $chkAcc == 'Protected'){ $showAll = true; }
					else{ $showAll = false; }
				}
				
				if($showAll == true) {
					$arr_pro['uid'][$key]  = $value;
					$arr_pro['name'][$key] = $menu_xml->readSection('folderinfo', 'name');
					$arr_pro['cat'][$key]  = $menu_xml->readSection('folderinfo', 'folder');
					$arr_pro['date'][$key] = $menu_xml->readSection('folderinfo', 'date');
					$arr_pro['sort'][$key] = $menu_xml->readSection('folderinfo', 'sort');
					$arr_pro['acs'][$key]  = $chkAcc;
					$arr_pro['type'][$key] = 'c';
					$arr_pro['sos'][$key]  = 0;
					$arr_pro['pub'][$key]  = $menu_xml->readSection('folderinfo', 'pub');
					$arr_pro['lang'][$key] = $menu_xml->readSection('folderinfo', 'language');
					
					// CHARSETS
					$arr_pro['name'][$key] = $tcms_main->decodeText($arr_pro['name'][$key], '2', $c_charset);
					
					$count++;
					$checkCatAmount = $count;
				}
			}
			
			if($tcms_main->isArray($arr_pro['sort'])){
				array_multisort(
					$arr_pro['sort'], SORT_ASC, 
					$arr_pro['date'], SORT_ASC, 
					$arr_pro['name'], SORT_ASC, 
					$arr_pro['cat'], SORT_ASC, 
					$arr_pro['pub'], SORT_ASC, 
					$arr_pro['acs'], SORT_ASC, 
					$arr_pro['type'], SORT_ASC, 
					$arr_pro['sos'], SORT_ASC, 
					$arr_pro['uid'], SORT_ASC, 
					$arr_pro['lang'], SORT_ASC
				);
			}
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		switch($id_group){
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
		
		if(!isset($category) || trim($category) == ''){
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."products "
			."WHERE ( parent IS NULL OR parent = '' ) "
			."AND ( category IS NULL OR category = '' ) "
			."AND ( access = 'Public' "
			.$strAdd
			."ORDER BY sort ASC, date ASC";
		}
		else{
			$sqlSTR = "SELECT * "
			."FROM ".$tcms_db_prefix."products "
			."WHERE category = '".$category."' "
			."AND ( access = 'Public' "
			.$strAdd
			."ORDER BY sort ASC, date ASC";
		}
		
		$sqlQR = $sqlAL->query($sqlSTR);
		
		$count = 0;
		
		while($sqlObj = $sqlAL->fetchObject($sqlQR)){
			$arr_pro['uid'][$count]   = $sqlObj->uid;
			$arr_pro['name'][$count]  = $sqlObj->name;
			$arr_pro['cat'][$count]   = $sqlObj->category;
			$arr_pro['date'][$count]  = $sqlObj->date;
			$arr_pro['sort'][$count]  = $sqlObj->sort;
			$arr_pro['acs'][$count]   = $sqlObj->access;
			$arr_pro['type'][$count]  = $sqlObj->sql_type;
			$arr_pro['sos'][$count]   = $sqlObj->show_on_startpage;
			$arr_pro['pub'][$count]   = $sqlObj->pub;
			$arr_pro['lang'][$count]  = $sqlObj->language;
			
			if($arr_pro['uid'][$count]  == NULL){ $arr_pro['uid'][$count]  = ''; }
			if($arr_pro['name'][$count] == NULL){ $arr_pro['name'][$count] = ''; }
			if($arr_pro['cat'][$count]  == NULL){ $arr_pro['cat'][$count]  = ''; }
			if($arr_pro['date'][$count] == NULL){ $arr_pro['date'][$count] = ''; }
			if($arr_pro['sort'][$count] == NULL){ $arr_pro['sort'][$count] = ''; }
			if($arr_pro['acs'][$count]  == NULL){ $arr_pro['acs'][$count]  = ''; }
			if($arr_pro['type'][$count] == NULL){ $arr_pro['type'][$count] = 'c'; }
			if($arr_pro['sos'][$count]  == NULL){ $arr_pro['sos'][$count]  = 0; }
			if($arr_pro['pub'][$count]  == NULL){ $arr_pro['pub'][$count]  = 0; }
			if($arr_pro['lang'][$count] == NULL){ $arr_pro['lang'][$count] = $tcms_config->getLanguageFrontend(); }
			
			// CHARSETS
			$arr_pro['name'][$count] = $tcms_main->decodeText($arr_pro['name'][$count], '2', $c_charset);
			
			$count++;
			$checkCatAmount = $count;
		}
	}
	
	$count = 0;
	$showAll = false;
	
	
	echo $tcms_html->tableHeadNoBorder('3', '0', '0', '100%');
	echo '<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left" colspan="2">'._TABLE_POS.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="30%" align="left">'._TABLE_TITLE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TCMS_LANGUAGE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_TYPE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_DATE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_PUBLISHED.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_FRONTPAGE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_ACCESS.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="15%" align="right">'._TABLE_FUNCTIONS.'</th>'
		.'</tr>';
	
	if($tcms_main->isArray($arr_pro['sort'])){	
		foreach($arr_pro['sort'] as $key => $value){
			$bgkey++;
			
			if(is_integer($bgkey / 2)) { $ws_color = $arr_color[0]; }
			else { $ws_color = $arr_color[1]; }
			
			
			$isCategory = ( trim($arr_pro['type'][$key]) == 'c' ? true : false );
			
			
			// onclick
			if($isCategory){
				$strLocation = 'document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_products&amp;category='.$arr_pro['uid'][$key].'\';';
			}
			
			
			// start form
			echo '<form name="'.$arr_pro['uid'][$key].'" id="'.$arr_pro['uid'][$key].'"'
			.' action="admin.php?id_user='.$id_user.'&amp;site=mod_products" method="post">'
			.'<input type="hidden" name="type" value="'.$arr_pro['type'][$key].'" />'
			.'<input type="hidden" name="maintag" value="'.$arr_pro['uid'][$key].'" />'
			.'<input type="hidden" name="new_category" value="'.$arr_pro['cat'][$key].'" />'
			.'<input type="hidden" name="todo" value="save_item" />';
			
			if($choosenDB == 'xml') {
				echo '<input type="hidden" name="new_date" value="'.$arr_pro['date'][$key].'" />'
				.'<input type="hidden" name="new_sos" value="'.$arr_pro['sos'][$key].'" />'
				.'<input type="hidden" name="new_factory" value="'.$arr_pro['uid'][$key].'" />'
				.'<input type="hidden" name="new_factory_url" value="'.$arr_pro['uid'][$key].'" />'
				.'<input type="hidden" name="new_status" value="'.$arr_pro['uid'][$key].'" />'
				.'<input type="hidden" name="new_product_no" value="'.$arr_pro['uid'][$key].'" />'
				.'<input type="hidden" name="new_price" value="'.$arr_pro['uid'][$key].'" />'
				.'<input type="hidden" name="new_pricetax" value="'.$arr_pro['uid'][$key].'" />'
				.'<input type="hidden" name="new_quantity" value="'.$arr_pro['uid'][$key].'" />';
				
				// --> more
			}
			
			
			// row
			echo '<tr id="row1'.$key.'" '
			.'bgcolor="'.$ws_color.'" '
			.'onMouseOver="wxlBgCol(\'row1'.$key.'\',\'#ececec\');wxlBgCol(\'row2'.$key.'\',\'#ececec\');" '
			.'onMouseOut="wxlBgCol(\'row1'.$key.'\',\''.$ws_color.'\');wxlBgCol(\'row2'.$key.'\',\''.$ws_color.'\');"'
			.( $dType == true
			? ''//' onclick="'.$strLocation.'"'
			: ''
			).'>';
			
			
			// image
			switch(trim($arr_pro['type'][$key])){
				case 'c':
					echo '<td class="tcms_db_2" style="width: 13px !important;" '.$strLocation.'>'
					.'<img border="0" src="../images/explore/faq_folder.png" />'
					.'</td>';
					break;
				
				case 'a':
					echo '<td class="tcms_db_2" style="width: 13px !important;" '.$strLocation.'>'
					.'<img border="0" src="../images/explore/faq_text.png" />'
					.'</td>';
					break;
				
				default:
					echo '<td class="tcms_db_2" style="width: 13px !important;" '.$strLocation.'>'
					.'<img border="0" src="../images/explore/faq_folder.png" />'
					.'</td>';
					break;
			}
			
			
			// title
			echo '<td valign="middle" align="left" class="tcms_db_2">'
			.'<input type="text" name="new_sort" value="'.$arr_pro['sort'][$key].'" class="tcms_id_box" />'
			.'</td>';
			
			
			// title
			echo '<td valign="middle" align="left" class="tcms_db_2">'
			.'<input type="text" name="new_name" value="'.$arr_pro['name'][$key].'" class="tcms_input_small" />'
			.'</td>';
			
			
			// language
			echo '<td valign="middle" align="left" class="tcms_db_2"'.$strJS.'>'
			.$tcms_main->getLanguageNameByTCMSLanguageCode($languages, $arr_pro['lang'][$key])
			.'</td>';
			
			
			// type
			switch(trim($arr_pro['type'][$key])){
				case 'c':
					echo '<td valign="middle" align="left" class="tcms_db_2">'._TABLE_CATEGORY.'</td>';
					break;
				
				case 'a':
					echo '<td valign="middle" align="left" class="tcms_db_2">'._TABLE_PRODUCT.'</td>';
					break;
				
				default:
					echo '<td valign="middle" align="left" class="tcms_db_2">'._TABLE_CATEGORY.'</td>';
					break;
			}
			
			
			// date
			echo '<td valign="middle" class="tcms_db_2" align="center">'
			.$arr_pro['date'][$key]
			.'&nbsp;</td>';
			
			
			// published
			echo '<td align="center" class="tcms_db_2">'
			.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_products&amp;todo=changePublish&amp;action=';
			
			switch($arr_pro['pub'][$key]){
				case 0: echo 'on'; break;
				case 1: echo 'off'; break;
			}
			
			echo '&amp;maintag='.$arr_pro['uid'][$key].'">';
			
			switch($arr_pro['pub'][$key]){
				case 0: echo '<img src="../images/no.png" border="0" />'; break;
				case 1: echo '<img src="../images/yes.png" border="0" />'; break;
			}
			
			echo '</a></td>';
			
			
			// mainpage
			echo '<td align="center" class="tcms_db_2">';
			
			if(trim($arr_pro['type'][$key]) == 'a') {
				echo '<a href="admin.php?id_user='.$id_user.'&amp;site=mod_products&amp;todo=enableMainpage&amp;action=';
				
				switch($arr_pro['sos'][$key]){
					case 0: echo 'on'; break;
					case 1: echo 'off'; break;
				}
				
				echo '&amp;maintag='.$arr_pro['uid'][$key].'">';
				
				switch($arr_pro['sos'][$key]){
					case 0: echo '<img src="../images/no.png" border="0" />'; break;
					case 1: echo '<img src="../images/yes.png" border="0" />'; break;
				}
				
				echo '</a>';
			}
			else {
				/*switch($arr_pro['sos'][$key]){
					case 0: echo '<img src="../images/no.png" border="0" />'; break;
					case 1: echo '<img src="../images/yes.png" border="0" />'; break;
				}*/
				echo '<img src="../images/wait.png" border="0" />';
			}
			
			echo '</td>';
			
			
			// access
			echo '<td valign="middle" class="tcms_db_2" align="center">'
			.'<select name="new_access" class="tcms_select">'
				.'<option value="Public"'.(    $arr_pro['acs'][$key] == 'Public'    ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
				.'<option value="Protected"'.( $arr_pro['acs'][$key] == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
				.'<option value="Private"'.(   $arr_pro['acs'][$key] == 'Private'   ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
			.'</select>'
			.'</td>';
			
			
			// functions
			switch(trim($arr_pro['type'][$key])){
				case 'c':
					echo '<td class="tcms_db_2" align="right" valign="middle">'
					.'<a title="'._TABLE_GOUPBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_products&amp;category='.$arr_pro['uid'][$key].'">'
					.'<img title="'._TABLE_GOUPBUTTON.'" alt="'._TABLE_GOUPBUTTON.'" style="padding-top: 3px;" border="0" src="../images/go_right.gif" />'
					.'</a>&nbsp;'
					.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_products&amp;todo=edit&amp;type=c&amp;maintag='.$arr_pro['uid'][$key].'">'
					.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/pencil.png" />'
					.'</a>&nbsp;';
					break;
				
				case 'a':
					echo '<td class="tcms_db_2" align="right" valign="middle">'
					.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_products&amp;todo=edit&amp;type=a&amp;maintag='.$arr_pro['uid'][$key].'">'
					.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/pencil.png" />'
					.'</a>&nbsp;';
					break;
				
				default:
					echo '<td class="tcms_db_2" align="right" valign="middle">'
					.'<a title="'._TABLE_GOUPBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_products&amp;category='.$arr_pro['uid'][$key].'">'
					.'<img title="'._TABLE_GOUPBUTTON.'" alt="'._TABLE_GOUPBUTTON.'" style="padding-top: 3px;" border="0" src="../images/go_right.gif" />'
					.'</a>&nbsp;'
					.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_products&amp;todo=edit&amp;type=c&amp;maintag='.$arr_pro['uid'][$key].'">'
					.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/pencil.png" />'
					.'</a>&nbsp;';
					break;
			}
			
			echo '<a title="'._TABLE_SAVEBUTTON.'" href="javascript:accept(\''.$arr_pro['uid'][$key].'\');">'
			.'<img title="'._TABLE_SAVEBUTTON.'" alt="'._TABLE_SAVEBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_save.gif" />'
			.'</a>&nbsp;'
			.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_products&amp;todo=delete&amp;maintag='.$arr_pro['uid'][$key].'&type='.$arr_pro['type'][$key].'" onclick="chk=confirm(\''._MSG_DELETE_SUBMIT.'\');return chk;">'
			.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
			.'</a>'
			.'</td>';
			
			
			// end row | end form
			echo '</tr>'
			.'</form>';
		}
	}
	
	echo '</table><br />';
}





// -------------------------------------------------
// EDIT ITEM
// -------------------------------------------------

if($todo == 'edit') {
	if(!$tcms_main->isReal($type)) {
		$type = 'c';
	}
	
	// load data
	if($tcms_main->isReal($maintag)){
		if($choosenDB == 'xml'){
			//
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			switch($id_group){
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
			."WHERE uid = '".$maintag."' "
			."AND ( access = 'Public' "
			.$strAdd
			."ORDER BY sort ASC, date ASC";
			
			$sqlQR = $sqlAL->query($sqlSTR);
			
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			// load data
			$wsUID        = $sqlObj->uid;
			$wsName       = $sqlObj->name;
			$wsLang       = $sqlObj->language;
			$wsCat        = $sqlObj->category;
			$wsDate       = $sqlObj->date;
			$wsText       = $sqlObj->desc;
			$wsPub        = $sqlObj->pub;
			$wsSort       = $sqlObj->sort;
			$wsAccess     = $sqlObj->access;
			$wsSos        = $sqlObj->show_on_startpage;
			$wsFactory    = $sqlObj->factory;
			$wsFactoryUrl = $sqlObj->factory_url;
			$wsState      = $sqlObj->status;
			$wsProductNr  = $sqlObj->product_number;
			$wsPrice      = $sqlObj->price;
			$wsTax        = $sqlObj->price_tax;
			$wsQuantity   = $sqlObj->quantity;
			$wsWeight     = $sqlObj->weight;
			$wsParent     = $sqlObj->parent;
			$wsImage1     = $sqlObj->image1;
			$wsImage2     = $sqlObj->image2;
			$wsImage3     = $sqlObj->image3;
			$wsImage4     = $sqlObj->image4;
			
			if($wsUID        == NULL){ $wsUID        = $maintag; }
			if($wsName       == NULL){ $wsName       = ''; }
			if($wsCat        == NULL){ $wsCat        = ''; }
			if($wsDate       == NULL){ $wsDate       = ''; }
			if($wsSort       == NULL){ $wsSort       = ''; }
			if($wsAccess     == NULL){ $wsAccess     = ''; }
			if($wsSos        == NULL){ $wsSos        = 0; }
			if($wsFactory    == NULL){ $wsFactory    = ''; }
			if($wsFactoryUrl == NULL){ $wsFactoryUrl = ''; }
			if($wsState      == NULL){ $wsState      = ''; }
			if($wsProductNr  == NULL){ $wsProductNr  = ''; }
			if($wsPrice      == NULL){ $wsPrice      = ''; }
			if($wsTax        == NULL){ $wsTax        = ''; }
			if($wsQuantity   == NULL){ $wsQuantity   = ''; }
			if($wsWeight     == NULL){ $wsWeight     = ''; }
			if($wsParent     == NULL){ $wsParent     = ''; }
			if($wsImage1     == NULL){ $wsImage1     = ''; }
			if($wsImage2     == NULL){ $wsImage2     = ''; }
			if($wsImage3     == NULL){ $wsImage3     = ''; }
			if($wsImage4     == NULL){ $wsImage4     = ''; }
			
			$wsType = $type;
			
			// only for the category
			if($type == 'c') {
				//
			}
			// only for an product
			else {
				//
			}
		}
		
		// CHARSETS
		$wsName = $tcms_main->decodeText($wsName, '2', $c_charset);
		$wsText = $tcms_main->decodeText($wsText, '2', $c_charset);
		
		$wsName = htmlspecialchars($wsName);
	}
	else {
		$maintag = $tcms_main->getNewUID(32, 'products');
		
		$wsState = 0;
		$wsType  = $type;
		$wsSos   = 0;
		$wsPub   = 0;
		$wsCat   = '';
		$wsDate  = $tcms_time->getCurrentDate().'-'.$tcms_time->getCurrentTime();
		$wsTax   = 19;
		$wsSort  = $tcms_main->getAmountOfItems('products');
		$wsLang  = $tcms_config->getLanguageFrontend();
	}
	
	echo $tcms_html->bold(_TABLE_NEW);
	
	if($type == 'c') {
		echo $tcms_html->text(_TCMS_ADMIN_NEW_CATEGORY.'<br /><br />', 'left');
	}
	else {
		echo $tcms_html->text(_TCMS_ADMIN_NEW_ITEM.'<br /><br />', 'left');
	}
	
	$width = '150';
	
	
	// begin form
	echo '<form id="productEditor" action="admin.php?id_user='.$id_user.'&amp;site=mod_products"'
	.' method="post" enctype="multipart/form-data">'
	.'<input type="hidden" name="todo" value="save" />'
	.'<input type="hidden" name="type" value="'.$wsType.'" />'
	.'<input type="hidden" name="maintag" value="'.$wsUID.'" />'
	.'<input type="hidden" name="new_parent" value="'.$wsParent.'" />';
	
	
	/*
		generate form
		related by the type
	*/
	// category
	if($type == 'c') {
		echo '<input type="hidden" name="new_date" value="'.$wsDate.'" />'
		.'<input type="hidden" name="new_sos" value="'.$wsSos.'" />'
		.'<input type="hidden" name="new_factory" value="'.$wsFactory.'" />'
		.'<input type="hidden" name="new_factory_url" value="'.$wsFactoryUrl.'" />'
		.'<input type="hidden" name="new_status" value="'.$wsState.'" />'
		.'<input type="hidden" name="new_product_no" value="'.$wsProductNr.'" />'
		.'<input type="hidden" name="new_price" value="'.$wsPrice.'" />'
		.'<input type="hidden" name="new_pricetax" value="'.$wsTax.'" />'
		.'<input type="hidden" name="new_quantity" value="'.$wsQuantity.'" />';
		
		// head
		echo $tcms_html->tableHeadNoBorder('0', '0', '0', '100%')
		.'<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>'
		.'</tr>'
		.$tcms_html->tableEnd();
		
		
		// table head
		echo $tcms_html->tableHeadClass('1', '5', '0', '100%', 'tcms_table');
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_CATEGORY.'</strong>'
		.'</td><td valign="top">'
		.'<select class="tcms_select" name="new_category">'
		.'<option value=""'.( $wsCat == '' ? ' selected="selected"' : '' ).'>'
		._FAQ_BASE_CATEGORY
		.'</option>';
		
		foreach($arrProductCategories['tag'] as $key => $value){
			echo '<option value="'.$value.'"'.( $wsCat == $value ? ' selected="selected"' : '' ).'>'
			.$arrProductCategories['title'][$key]
			.'</option>';
		}
		
		echo '</select>'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td width="300" valign="top">'
		.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
		.'</td><td>'
		.'<select class="tcms_select" id="new_lang" name="new_lang">';
		
		foreach($languages['code'] as $key => $value) {
			if($wsLang == $languages['code'][$key])
				$dl = ' selected="selected"';
			else
				$dl = '';
			
			echo '<option value="'.$value.'"'.$dl.'>'
			.$languages['name'][$key]
			.'</option>';
		}
		
		echo '</select>'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_TITLE.'</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_input_normal" name="new_name" type="text" value="'.$wsName.'" />'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_DESCRIPTION.'</strong>'
		.'</td><td valign="top">'
		.'<textarea class="tcms_textarea_big" name="content" type="text">'.$wsText.'</textarea>'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_PUBLISHED.'</strong>'
		.'</td><td valign="top">'
		.'<input name="new_pub" value="1"'.( $wsPub == 1 ? ' checked="checked"' : '' ).' type="checkbox" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_POS.'</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_id_box" name="new_sort" type="text" value="'.$wsSort.'" />'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_ACCESS.'</strong>'
		.'</td><td valign="top">'
		.'<select name="new_access" class="tcms_select">'
		.'<option value="Public"'.( $wsAccess == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
		.'<option value="Protected"'.( $wsAccess == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
		.'<option value="Private"'.( $wsAccess == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
		.'</select>'
		.'</td></tr>';
		
		
		// table end
		echo $tcms_html->tableEnd();
	}
	// product
	else {
		/*
			tabpane start
		*/
		echo '<div class="tab-pane" id="tab-pane-1">';
		
		
		/*
			text tab
		*/
		echo '<div class="tab-page" id="tab-page-text">'
		.'<h2 class="tab">'._TABLE_EDIT.'</h2>';
		
		
		// table head
		echo $tcms_html->tableHead('1', '5', '0', '100%');
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_CATEGORY.'</strong>'
		.'</td><td valign="top">'
		.'<select class="tcms_select" name="new_category">'
		.'<option value=""'.( $wsCat == '' ? ' selected="selected"' : '' ).'>'
		._FAQ_BASE_CATEGORY
		.'</option>';
		
		foreach($arrProductCategories['tag'] as $key => $value){
			echo '<option value="'.$value.'"'.( $wsCat == $value ? ' selected="selected"' : '' ).'>'
			.$arrProductCategories['title'][$key]
			.'</option>';
		}
		
		echo '</select>'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td width="300" valign="top">'
		.'<strong class="tcms_bold">'._TCMS_LANGUAGE.'</strong>'
		.'</td><td>'
		.'<select class="tcms_select" id="new_lang" name="new_lang">';
		
		foreach($languages['code'] as $key => $value) {
			if($wsLang == $languages['code'][$key])
				$dl = ' selected="selected"';
			else
				$dl = '';
			
			echo '<option value="'.$value.'"'.$dl.'>'
			.$languages['name'][$key]
			.'</option>';
		}
		
		echo '</select>'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_TITLE.'</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_input_normal" name="new_name" type="text" value="'.$wsName.'" />'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" colspan="2">'
		.'<br />'
		.'<strong class="tcms_bold">'._TABLE_TEXT.' ('._TABLE_ORDER.': '.$wsUID.')</strong>'
		.( $show_wysiwyg != 'fckeditor' ? '<br /><br />' : '' )
		.'<script>createToendaToolbar(\'productEditor\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'\', \'\', \''.$id_user.'\');</script>';
		
		if($show_wysiwyg != 'tinymce' 
		&& $show_wysiwyg != 'fckeditor') {
			if($show_wysiwyg == 'toendaScript') {
				echo '<script>createToolbar(\'productEditor\', \''.$tcms_lang.'\', \'toendaScript\');</script>';
			}
			else {
				echo '<script>createToolbar(\'productEditor\', \''.$tcms_lang.'\', \'HTML\');</script>';
			}
		}
		
		echo '<br /><br />';
		
		if($show_wysiwyg == 'tinymce') {
			echo '<textarea class="tcms_textarea_huge" style="width: 100%;" id="content" name="content" mce_editable="true">'
			.$wsText
			.'</textarea>';
		}
		elseif($show_wysiwyg == 'fckeditor') {
			$sBasePath = '../js/FCKeditor/';
			
			$oFCKeditor = new FCKeditor('content') ;
			$oFCKeditor->BasePath = $sBasePath;
			
			$oFCKeditor->Value = $wsText;
			$oFCKeditor->Create();
		}
		else{
			echo '<textarea class="tcms_textarea_huge" style="width: 100%;" id="content" name="content">'
			.$wsText
			.'</textarea>';
		}
		
		echo '<br />'
		.'</td>';
		
		
		// table end
		echo $tcms_html->tableEnd();
		
		
		/*
			settings tab
		*/
		echo '</div>'
		.'<div class="tab-page" id="tab-page-set">'
		.'<h2 class="tab">'._TABLE_SETTINGS.'</h2>';
		
		
		// table start
		echo $tcms_html->tableHead('1', '5', '0', '100%');
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_STOCK.'</strong>'
		.'</td><td valign="top">'
		.'<input name="new_status" value="1"'.( $wsState == 1 ? ' checked="checked"' : '' ).' type="checkbox" />'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_SHOWONMAINPAGE.'</strong>'
		.'</td><td valign="top">'
		.'<input name="new_sos" value="1"'.( $wsSos == 1 ? ' checked="checked"' : '' ).' type="checkbox" />'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_PUBLISHED.'</strong>'
		.'</td><td valign="top">'
		.'<input name="new_pub" value="1"'.( $wsPub == 1 ? ' checked="checked"' : '' ).' type="checkbox" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_POS.'</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_id_box" name="new_sort" type="text" value="'.$wsSort.'" />'
		.'</td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_ACCESS.'</strong>'
		.'</td><td valign="top">'
		.'<select name="new_access" class="tcms_select">'
		.'<option value="Public"'.( $wsAccess == 'Public' ? ' selected="selected"' : '' ).'>'._TABLE_PUBLIC.'</option>'
		.'<option value="Protected"'.( $wsAccess == 'Protected' ? ' selected="selected"' : '' ).'>'._TABLE_PROTECTED.'</option>'
		.'<option value="Private"'.( $wsAccess == 'Private' ? ' selected="selected"' : '' ).'>'._TABLE_PRIVATE.'</option>'
		.'</select>'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_DATE.'</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_input_small" id="new_date" name="new_date" type="text" value="'.$wsDate.'" />'
		.'<input type="button" value="&nbsp;" style="background: transparent url(../js/jscalendar/img.gif) no-repeat;" id="triggerButtonDateTime" />'
		.'</td></tr>';
		
		echo '<script type="text/javascript">
		Calendar.setup({
	        inputField     :    "new_date",
	        ifFormat       :    "%d.%m.%Y-%H:%M",
	        showsTime      :    true,
	        timeFormat     :    24,
	        button         :    "triggerButtonDateTime",
	        singleClick    :    false,
	        step           :    1
	    });
		</script>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_FACTORY.'</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_input_normal" name="new_factory" type="text" value="'.$wsFactoryUrl.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_URL.'</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_input_normal" name="new_factory_url" type="text" value="'.$wsFactoryUrl.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_PRODUCTNO.'</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_input_small" name="new_product_no" type="text" value="'.$wsProductNr.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_PRICE.' '._TABLE_PRICE_ADD.'</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_input_small" name="new_price" type="text" value="'.$wsPrice.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_TAX.'</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_id_box" name="new_pricetax" type="text" value="'.$wsTax.'" /> %'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_QUANTITY.'</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_input_small" name="new_quantity" type="text" value="'.$wsQuantity.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_WEIGHT.'</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_input_small" name="new_weight" type="text" value="'.$wsWeight.'" />'
		.'</td></tr>';
		
		
		// table end
		echo $tcms_html->tableEnd();
		
		
		/*
			settings tab
		*/
		echo '</div>'
		.'<div class="tab-page" id="tab-page-img">'
		.'<h2 class="tab">'._TABLE_IMAGES.'</h2>';
		
		
		// table start
		echo $tcms_html->tableHead('1', '5', '0', '100%');
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_IMAGE.' 1</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_upload" name="new_image1" type="file" accept="image/*" /><br />'
		.'<input name="tmp_image1" id="tmp_image1" type="hidden" value="'.$wsImage1.'" />'
		.'<input name="old_image1" id="old_image1" type="hidden" value="'.$wsImage1.'" />'
		.'</td></tr>';
		
		echo '<tr><td>&nbsp;</td><td valign="middle" align="left">'
		.( 
			trim($wsImage1) == '_empty_' || trim($wsImage1) == '' ? 
			'<img id="tmp_image_file1" src="../images/no_picture.gif" border="0" />' : 
			( file_exists('../../'.$tcms_administer_site.'/images/products/'.$wsImage1) ?
				'<img id="tmp_image_file1" src="../../'.$tcms_administer_site.'/images/products/'.$wsImage1.'" border="0" />' :
				'<img id="tmp_image_file1" src="../images/no_picture.gif" border="0" />'
			)
		)
		.'&nbsp;'.( $tcms_main->isReal($wsImage1) ? '('.$wsImage1.')' : '' )
		.'&nbsp;<input type="button" name="tcms1" value="'._EXT_NEWS_DESELECT.'" onclick="gebi(\'tmp_image1\').value=\'_empty_\';gebi(\'tmp_image_file1\').src=\'../images/no_picture.gif\';" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_IMAGE.' 2</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_upload" name="new_image2" type="file" accept="image/*" /><br />'
		.'<input name="tmp_image2" id="tmp_image2" type="hidden" value="'.$wsImage2.'" />'
		.'<input name="old_image2" id="old_image2" type="hidden" value="'.$wsImage2.'" />'
		.'</td></tr>';
		
		echo '<tr><td>&nbsp;</td><td valign="middle" align="left">'
		.( 
			trim($wsImage2) == '_empty_' || trim($wsImage2) == '' ? 
			'<img id="tmp_image_file2" src="../images/no_picture.gif" border="0" />' : 
			( file_exists('../../'.$tcms_administer_site.'/images/products/'.$wsImage2) ?
				'<img id="tmp_image_file2" src="../../'.$tcms_administer_site.'/images/products/'.$wsImage2.'" border="0" />' :
				'<img id="tmp_image_file2" src="../images/no_picture.gif" border="0" />'
			)
		)
		.'&nbsp;'.( $tcms_main->isReal($wsImage2) ? '('.$wsImage2.')' : '' )
		.'&nbsp;<input type="button" name="tcms2" value="'._EXT_NEWS_DESELECT.'" onclick="gebi(\'tmp_image2\').value=\'_empty_\';gebi(\'tmp_image_file2\').src=\'../images/no_picture.gif\';" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_IMAGE.' 3</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_upload" name="new_image3" type="file" accept="image/*" /><br />'
		.'<input name="tmp_image3" id="tmp_image3" type="hidden" value="'.$wsImage3.'" />'
		.'<input name="old_image3" id="old_image3" type="hidden" value="'.$wsImage3.'" />'
		.'</td></tr>';
		
		echo '<tr><td>&nbsp;</td><td valign="middle" align="left">'
		.( 
			trim($wsImage3) == '_empty_' || trim($wsImage3) == '' ? 
			'<img id="tmp_image_file3" src="../images/no_picture.gif" border="0" />' : 
			( file_exists('../../'.$tcms_administer_site.'/images/products/'.$wsImage3) ?
				'<img id="tmp_image_file3" src="../../'.$tcms_administer_site.'/images/products/'.$wsImage3.'" border="0" />' :
				'<img id="tmp_image_file3" src="../images/no_picture.gif" border="0" />'
			)
		)
		.'&nbsp;'.( $tcms_main->isReal($wsImage3) ? '('.$wsImage3.')' : '' )
		.'&nbsp;<input type="button" name="tcms3" value="'._EXT_NEWS_DESELECT.'" onclick="gebi(\'tmp_image3\').value=\'_empty_\';gebi(\'tmp_image_file3\').src=\'../images/no_picture.gif\';" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td valign="top" width="'.$width.'">'
		.'<strong class="tcms_bold">'._TABLE_IMAGE.' 4</strong>'
		.'</td><td valign="top">'
		.'<input class="tcms_upload" name="new_image4" type="file" accept="image/*" /><br />'
		.'<input name="tmp_image4" id="tmp_image4" type="hidden" value="'.$wsImage4.'" />'
		.'<input name="old_image4" id="old_image4" type="hidden" value="'.$wsImage4.'" />'
		.'</td></tr>';
		
		echo '<tr><td>&nbsp;</td><td valign="middle" align="left">'
		.( 
			trim($wsImage4) == '_empty_' || trim($wsImage4) == '' ? 
			'<img id="tmp_image_file4" src="../images/no_picture.gif" border="0" />' : 
			( file_exists('../../'.$tcms_administer_site.'/images/products/'.$wsImage4) ?
				'<img id="tmp_image_file4" src="../../'.$tcms_administer_site.'/images/products/'.$wsImage4.'" border="0" />' :
				'<img id="tmp_image_file4" src="../images/no_picture.gif" border="0" />'
			)
		)
		.'&nbsp;'.( $tcms_main->isReal($wsImage4) ? '('.$wsImage4.')' : '' )
		.'&nbsp;<input type="button" name="tcms4" value="'._EXT_NEWS_DESELECT.'" onclick="gebi(\'tmp_image4\').value=\'_empty_\';gebi(\'tmp_image_file4\').src=\'../images/no_picture.gif\';" />'
		.'</td></tr>';
		
		
		// table end
		echo $tcms_html->tableEnd();
		
		
		// tabpane end
		echo '</div>'
		.'<script type="text/javascript">'
		.'var tabPane1 = new WebFXTabPane(document.getElementById("tab-pane-1"));'
		.'tabPane1.addTabPage(document.getElementById("tab-page-text"));'
		.'tabPane1.addTabPage(document.getElementById("tab-page-set"));'
		.'tabPane1.addTabPage(document.getElementById("tab-page-img"));'
		.'setupAllTabs();'
		.'</script>'
		.'<br />';
	}
	
	
	echo '</form>';
}





// -------------------------------------------------
// SASE CONFIGURATION
// -------------------------------------------------

if($todo == 'save_config') {
	if(empty($new_pid))   { $old_pid    = 'products'; }
	if(empty($new_ptitle)){ $new_ptitle = ''; }
	if(empty($new_pstamp)){ $new_pstamp = ''; }
	if(empty($content))   { $content    = ''; }
	if(empty($new_cstate)){ $new_cstate = $old_cstate; }
	if(empty($new_ctitle)){ $new_ctitle = ''; }
	if(empty($new_usest)) { $new_usest  = 0; }
	if(empty($new_spou))  { $new_spou   = 0; }
	if(empty($new_spt))   { $new_spt    = ''; }
	
	
	$content = str_replace('src="../../../../http:', 'src="http:', $content);
	
	if($show_wysiwyg == 'tinymce'){
		//$content = str_replace('../../', '', $content);
		$content = stripslashes($content);
	}
	elseif($show_wysiwyg == 'fckeditor'){
		$content = str_replace('../../../../../../../../../', '', $content);
		$content = str_replace('../../../../', '', $content);
	}
	else{
		$content = $tcms_main->nl2br($content);
	}
	
	if($seoEnabled == 0 && $show_wysiwyg == 'tinymce'){
		//$content = str_replace('src="../../', 'src="', $content);
	}
	
	
	$new_ptitle = $tcms_main->encodeText($new_ptitle, '2', $c_charset);
	$new_pstamp = $tcms_main->encodeText($new_pstamp, '2', $c_charset);
	$content    = $tcms_main->encodeText($content, '2', $c_charset);
	$new_ctitle = $tcms_main->encodeText($new_ctitle, '2', $c_charset);
	
	
	if($tcms_main->isReal($new_lang)) {
		$setLang = $tcms_config->getLanguageCodeForTCMS($new_lang);
	}
	else {
		$setLang = '';
	}
	
	
	if($choosenDB == 'xml'){
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/products.'.$setLang.'.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('config');
		
		$xmluser->write_value('products_id', $new_pid);
		$xmluser->write_value('products_title', $new_ptitle);
		$xmluser->write_value('products_stamp', $new_pstamp);
		$xmluser->write_value('products_text', $content);
		$xmluser->write_value('category_state', $new_cstate);
		$xmluser->write_value('category_title', $new_ctitle);
		$xmluser->write_value('use_category_title', $new_usest);
		$xmluser->write_value('language', $new_lang);
		$xmluser->write_value('show_price_only_users', $new_spou);
		$xmluser->write_value('startpagetitle', $new_spt);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('config');
		$xmluser->_xmlparser();
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if($lang_exist > 0) {
			$newSQLData = ''
			.$tcms_db_prefix.'products_config.products_id="'.$new_pid.'", '
			.$tcms_db_prefix.'products_config.products_title="'.$new_ptitle.'", '
			.$tcms_db_prefix.'products_config.products_stamp="'.$new_pstamp.'", '
			.$tcms_db_prefix.'products_config.products_text="'.$content.'", '
			.$tcms_db_prefix.'products_config.category_state="'.$new_cstate.'", '
			.$tcms_db_prefix.'products_config.category_title="'.$new_ctitle.'", '
			.$tcms_db_prefix.'products_config.use_category_title='.$new_usest.', '
			.$tcms_db_prefix.'products_config.show_price_only_users='.$new_spou.', '
			.$tcms_db_prefix.'products_config.startpagetitle="'.$new_spt.'"';
			
			switch($choosenDB) {
				case 'mysql':
					$sqlQR = $sqlAL->updateField(
						$tcms_db_prefix.'products_config', 
						$newSQLData, 
						'language', 
						$setLang
					);
					break;
				
				default:
					$sqlQR = $sqlAL->updateField(
						$tcms_db_prefix.'products_config', 
						$newSQLData, 
						'language', 
						$setLang
					);
					break;
			}
		}
		else {
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`products_id`, `products_title`, '
					.'`products_stamp`, `products_text`, `category_state`, '
					.'`category_title`, `use_category_title`, `language`, '
					.'`show_price_only_users`, `startpagetitle`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'products_id, products_title, '
					.'products_stamp, products_text, "category_state", '
					.'category_title, use_category_title, "language", '
					.'show_price_only_users, startpagetitle';
					break;
				
				case 'mssql':
					$newSQLColumns = '[products_id], [products_title], '
					.'[products_stamp], [products_text], [category_state], '
					.'[category_title], [use_category_title], [language], '
					.'[show_price_only_users], [startpagetitle]';
					break;
			}
			
			$newSQLData = "'products', '".$new_ptitle."', "
			."'".$new_pstamp."', '".$content."', "
			."'".$new_cstate."', '".$new_ctitle."', "
			.$new_usest.", '".$setLang."', ".$new_spou.", '".$new_spt."'";
			
			$maintag = $tcms_main->getNewUID(8, 'products_config');
			
			$sqlQR = $sqlAL->createOne(
				$tcms_db_prefix.'products_config', 
				$newSQLColumns, 
				$newSQLData, 
				$maintag
			);
		}
	}
	
	
	if($setLang != '') {
		$setLang = $tcms_config->getLanguageCodeByTCMSCode($setLang);
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_products&todo=config'
		.'&lang='.$setLang.'\''
		.'</script>';
	}
	else {
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_products&todo=config'
		.'</script>';
	}
}





// -------------------------------------------------
// SASE SOME SETTINGS FROM A ITEM
// -------------------------------------------------

if($todo == 'save_item') {
	if(empty($new_name)){ $new_name = ''; }
	if(empty($type)){ $type = 'c'; }
	if(empty($new_access)){ $new_access = 'Public'; }
	if(empty($new_sort)){ $new_sort = $tcms_main->getAmountOfItems('products'); }
	
	$new_name = $tcms_main->encodeText($new_name, '2', $c_charset);
	
	
	// save
	if($choosenDB == 'xml') {
		/*$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_products/'.$category.'/'.$article.'.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('info');
		
		$xmluser->write_value('product', $new_product);
		$xmluser->write_value('product_number', $new_product_no);
		$xmluser->write_value('factory', $new_factory);
		$xmluser->write_value('factory_url', $new_factory_url);
		$xmluser->write_value('desc', $new_desc);
		$xmluser->write_value('category', $new_category);
		$xmluser->write_value('image', $new_image);
		$xmluser->write_value('date', $new_date);
		$xmluser->write_value('price', $new_price);
		$xmluser->write_value('price_tax', $new_pricetax);
		$xmluser->write_value('status', $new_status);
		$xmluser->write_value('quantity', $new_quantity);
		$xmluser->write_value('weight', $new_weight);
		$xmluser->write_value('sort', $new_sort);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('info');
		$xmluser->_xmlparser();*/
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$newSQLData = ''
		.$tcms_db_prefix.'products.name="'.$new_name.'", '
		.$tcms_db_prefix.'products.sort='.$new_sort.', '
		.$tcms_db_prefix.'products.access="'.$new_access.'", '
		.$tcms_db_prefix.'products.sql_type="'.$type.'"';
		
		$sqlQR = $sqlAL->updateOne(
			$tcms_db_prefix.'products', 
			$newSQLData, 
			$maintag
		);
	}
	
	echo '<script>'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_products'
	.( $new_category != '' ? '&category='.$new_category : '' ).'\';'
	.'</script>';
}





// -------------------------------------------------
// SASE ITEM (CATEGORY AND PRODUCT)
// -------------------------------------------------

if($todo == 'save') {
	/*
	if($_FILES['new_image1']['size'] > 0 && (
	$_FILES['new_image1']['type'] == 'image/gif' || 
	$_FILES['new_image1']['type'] == 'image/png' || 
	$_FILES['new_image1']['type'] == 'image/jpg' || 
	$_FILES['new_image1']['type'] == 'image/jpeg' || 
	$_FILES['new_image1']['type'] == 'image/bmp')){
	*/
	
	/*
		upload images
	*/
	
	// upload image1
	if($_FILES['new_image1']['size'] > 0 
	&& $tcms_main->isImage($_FILES['new_image1']['type'], true)){
		$fileName = $_FILES['new_image1']['name'];
		$imgDir = '../../'.$tcms_administer_site.'/images/products/';
		
		copy($_FILES['new_image1']['tmp_name'], $imgDir.$fileName);
		
		$msg = _MSG_UPLOAD.' '.$imgDir.$_FILES['new_image1']['name'];
		$new_image1 = $_FILES['new_image1']['name'];
	}
	else{
		$msg = _MSG_NOIMAGE;
		$new_image1 = '';
	}
	
	if($tcms_main->isReal($tmp_image1)) {
		if($tcms_main->isReal($new_image1) && $new_image1 != ''){
			if(file_exists('../../'.$tcms_administer_site.'/images/products/'.$tmp_image1)) {
				unlink('../../'.$tcms_administer_site.'/images/products/'.$tmp_image1);
			}
			
			$new_image1 = $new_image1;
		}
		elseif(trim($tmp_image1) == ''){
			if(file_exists('../../'.$tcms_administer_site.'/images/products/'.$old_image1)) {
				unlink('../../'.$tcms_administer_site.'/images/products/'.$old_image1);
			}
		}
		else{
			$new_image1 = $tmp_image1;
		}
	}
	
	// upload image2
	if($_FILES['new_image2']['size'] > 0 
	&& $tcms_main->isImage($_FILES['new_image2']['type'], true)){
		$fileName = $_FILES['new_image2']['name'];
		$imgDir = '../../'.$tcms_administer_site.'/images/products/';
		
		copy($_FILES['new_image2']['tmp_name'], $imgDir.$fileName);
		
		$msg = _MSG_UPLOAD.' '.$imgDir.$_FILES['new_image2']['name'];
		$new_image2 = $_FILES['new_image2']['name'];
	}
	else{
		$msg = _MSG_NOIMAGE;
		$new_image2 = '';
	}
	
	if($tcms_main->isReal($tmp_image2)){
		if($tcms_main->isReal($new_image2) && $new_image2 != ''){
			if(file_exists('../../'.$tcms_administer_site.'/images/products/'.$tmp_image2)) {
				unlink('../../'.$tcms_administer_site.'/images/products/'.$tmp_image2);
			}
			
			$new_image2 = $new_image2;
		}
		elseif(trim($tmp_image2) == ''){
			if(file_exists('../../'.$tcms_administer_site.'/images/products/'.$old_image2)) {
				unlink('../../'.$tcms_administer_site.'/images/products/'.$old_image2);
			}
		}
		else{
			$new_image2 = $tmp_image2;
		}
	}
	
	// upload image3
	if($_FILES['new_image3']['size'] > 0 
	&& $tcms_main->isImage($_FILES['new_image3']['type'], true)){
		$fileName = $_FILES['new_image3']['name'];
		$imgDir = '../../'.$tcms_administer_site.'/images/products/';
		
		copy($_FILES['new_image3']['tmp_name'], $imgDir.$fileName);
		
		$msg = _MSG_UPLOAD.' '.$imgDir.$_FILES['new_image3']['name'];
		$new_image3 = $_FILES['new_image3']['name'];
	}
	else{
		$msg = _MSG_NOIMAGE;
		$new_image3 = '';
	}
	
	if($tcms_main->isReal($tmp_image3)){
		if($tcms_main->isReal($new_image3) && $new_image3 != ''){
			if(file_exists('../../'.$tcms_administer_site.'/images/products/'.$tmp_image3)) {
				unlink('../../'.$tcms_administer_site.'/images/products/'.$tmp_image3);
			}
			
			$new_image3 = $new_image3;
		}
		elseif(trim($tmp_image3) == ''){
			if(file_exists('../../'.$tcms_administer_site.'/images/products/'.$old_image3)) {
				unlink('../../'.$tcms_administer_site.'/images/products/'.$old_image3);
			}
		}
		else{
			$new_image3 = $tmp_image3;
		}
	}
	
	// upload image4
	if($_FILES['new_image4']['size'] > 0 
	&& $tcms_main->isImage($_FILES['new_image4']['type'], true)){
		$fileName = $_FILES['new_image4']['name'];
		$imgDir = '../../'.$tcms_administer_site.'/images/products/';
		
		copy($_FILES['new_image4']['tmp_name'], $imgDir.$fileName);
		
		$msg = _MSG_UPLOAD.' '.$imgDir.$_FILES['new_image4']['name'];
		$new_image4 = $_FILES['new_image4']['name'];
	}
	else{
		$msg = _MSG_NOIMAGE;
		$new_image4 = '';
	}
	
	if($tcms_main->isReal($tmp_image4)){
		if($tcms_main->isReal($new_image4) && $new_image4 != ''){
			if(file_exists('../../'.$tcms_administer_site.'/images/products/'.$tmp_image4)) {
				unlink('../../'.$tcms_administer_site.'/images/products/'.$tmp_image4);
			}
			
			$new_image4 = $new_image4;
		}
		elseif(trim($tmp_image4) == ''){
			if(file_exists('../../'.$tcms_administer_site.'/images/products/'.$old_image4)) {
				unlink('../../'.$tcms_administer_site.'/images/products/'.$old_image4);
			}
		}
		else{
			$new_image4 = $tmp_image4;
		}
	}
	
	
	// check
	if(!$tcms_main->isReal($maintag)){
		$createItem = true;
		$maintag = $tcms_main->getNewUID(32, 'products');
	}
	else {
		$createItem = false;
	}
	
	if(empty($new_sos)){ $new_sos = 0; }
	if(empty($new_status)){ $new_status = 0; }
	if(empty($new_quantity)){ $new_quantity = -1; }
	if(empty($new_price)){ $new_price = -1; }
	if(!$tcms_main->isReal($new_pub)){ $new_pub = 0; }  // testweise mal mit !isReal ... schauen obs klappt
	
	if(empty($new_factory)){ $new_factory = ''; }
	if(empty($new_factory_url)){ $new_factory_url = ''; }
	if(empty($new_product_no)){ $new_product_no = ''; }
	if(empty($new_parent)){ $new_parent = ''; }
	if(empty($new_category)){ $new_category = ''; }
	if(empty($new_product_no)){ $new_product_no = ''; }
	if(empty($content)){ $new_product_no = ''; }
	if(empty($new_name)){ $new_name = ''; }
	
	if(empty($new_pricetax)){ $new_pricetax = '0'; }
	if(empty($type)){ $type = 'c'; }
	if(empty($new_access)){ $new_access = 'Public'; }
	if(empty($new_sort)){ $new_sort = $tcms_main->getAmountOfItems('products'); }
	if(empty($new_date)){ $new_date = $tcms_time->getCurrentDate().'-'.$tcms_time->getCurrentTime(); }
	
	// CHARSETS
	if($show_wysiwyg == 'tinymce'){
		$content = stripslashes($content);
	}
	elseif($show_wysiwyg == 'fckeditor'){
		$content = str_replace('../../../../../../../../../', '', $content);
		$content = str_replace('../../../../', '', $content);
	}
	else{
		$content = $tcms_main->nl2br($content);
	}
	
	$new_name = $tcms_main->encodeText($new_name, '2', $c_charset);
	$content = $tcms_main->encodeText($content, '2', $c_charset);
	$new_factory = $tcms_main->encodeText($new_factory, '2', $c_charset);
	$new_factory_url = $tcms_main->encodeText($new_factory_url, '2', $c_charset);
	
	
	// save
	if($choosenDB == 'xml') {
		/*$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_products/'.$category.'/'.$article.'.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('info');
		
		$xmluser->write_value('product', $new_product);
		$xmluser->write_value('product_number', $new_product_no);
		$xmluser->write_value('factory', $new_factory);
		$xmluser->write_value('factory_url', $new_factory_url);
		$xmluser->write_value('desc', $new_desc);
		$xmluser->write_value('category', $new_category);
		$xmluser->write_value('image', $new_image);
		$xmluser->write_value('date', $new_date);
		$xmluser->write_value('price', $new_price);
		$xmluser->write_value('price_tax', $new_pricetax);
		$xmluser->write_value('status', $new_status);
		$xmluser->write_value('quantity', $new_quantity);
		$xmluser->write_value('weight', $new_weight);
		$xmluser->write_value('sort', $new_sort);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('info');
		$xmluser->_xmlparser();*/
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if($createItem) {
			switch($choosenDB) {
				case 'mysql':
					$newSQLColumns = '`name`, `product_number`, `factory`, `factory_url`, `desc`, '
					.'`category`, `date`, `price`, `price_tax`, `status`, `quantity`, '
					.'`weight`, `sort`, `sql_type`, `language`, `image1`, `image2`, '
					.'`image3`, `image4`, `show_on_startpage`, `access`, '
					.'`pub`, `parent`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'name, product_number, factory, factory_url, "desc", '
					.'category, date, price, price_tax, status, quantity, '
					.'weight, sort, sql_type, "language", image1, image2, '
					.'image3, image4, show_on_startpage, "access", '
					.'pub, "parent"';
					break;
				
				case 'mssql':
					$newSQLColumns = '[name], [product_number], [factory], [factory_url], [desc], '
					.'[category], [date], [price], [price_tax], [status], [quantity], '
					.'[weight], [sort], [sql_type], [language], [image1], [image2], '
					.'[image3], [image4], [show_on_startpage], [access], '
					.'[pub], [parent]';
					break;
			}
			
			$newSQLData = ""
			."'".$new_name."', '".$new_product_no."', '".$new_factory."', '".$new_factory_url."', '".$content."', "
			."'".$new_category."', '".$new_date."', '".$new_price."', '".$new_pricetax."', ".$new_status.", ".$new_quantity.", "
			."'".$new_weight."', ".$new_sort.", '".$type."', '".$new_lang."', '".$new_image1."', '".$new_image2."', "
			."'".$new_image3."', '".$new_image4."', ".$new_sos.", '".$new_access."', "
			.$new_pub.", '".$new_parent."'";
			
			$sqlQR = $sqlAL->createOne(
				$tcms_db_prefix.'products', 
				$newSQLColumns, 
				$newSQLData, 
				$maintag
			);
		}
		else {
			$newSQLData = ''
			.$tcms_db_prefix.'products.name="'.$new_name.'", '
			.$tcms_db_prefix.'products.language="'.$new_lang.'", '
			.$tcms_db_prefix.'products.category="'.$new_category.'", '
			.$tcms_db_prefix.'products.date="'.$new_date.'", '
			.$tcms_db_prefix.'products.desc="'.$content.'", '
			.$tcms_db_prefix.'products.pub='.$new_pub.', '
			.$tcms_db_prefix.'products.sort='.$new_sort.', '
			.$tcms_db_prefix.'products.access="'.$new_access.'", '
			.$tcms_db_prefix.'products.show_on_startpage='.$new_sos.', '
			.$tcms_db_prefix.'products.factory="'.$new_factory.'", '
			.$tcms_db_prefix.'products.factory_url="'.$new_factory_url.'", '
			.$tcms_db_prefix.'products.status='.$new_status.', '
			.$tcms_db_prefix.'products.product_number="'.$new_product_no.'", '
			.$tcms_db_prefix.'products.price="'.$new_price.'", '
			.$tcms_db_prefix.'products.price_tax="'.$new_pricetax.'", '
			.$tcms_db_prefix.'products.quantity='.$new_quantity.', '
			.$tcms_db_prefix.'products.weight="'.$new_weight.'", '
			.$tcms_db_prefix.'products.parent="'.$new_parent.'", '
			.$tcms_db_prefix.'products.image1="'.$new_image1.'", '
			.$tcms_db_prefix.'products.image2="'.$new_image2.'", '
			.$tcms_db_prefix.'products.image3="'.$new_image3.'", '
			.$tcms_db_prefix.'products.image4="'.$new_image4.'", '
			.$tcms_db_prefix.'products.sql_type="'.$type.'"';
			
			$sqlQR = $sqlAL->updateOne(
				$tcms_db_prefix.'products', 
				$newSQLData, 
				$maintag
			);
		}
	}
	
	echo '<script>'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_products'
	.( $new_category != '' ? '&category='.$new_category : '' ).'\';'
	.'</script>';
}





// -------------------------------------------------
// CHANGE PUBLISHING
// -------------------------------------------------

if($todo == 'changePublish'){
	switch($action){
		// Take it off
		case 'off':
			if($choosenDB == 'xml') {
				xmlparser::edit_value(
					'../../'.$tcms_administer_site.'/tcms_products/'.$maintag.'.xml',
					'publish_state',
					'1',
					'0'
				);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'products.pub=0';
				$sqlQR = $sqlAL->updateOne($tcms_db_prefix.'products', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';'
				.'</script>';
			}
			else{
				if($tcms_main->isReal($new_faq_cat)) {
					$strAdd = '&category='.$new_faq_cat;
				}
				else {
					$strAdd = '';
				}
				
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_products'.$strAdd.'\';'
				.'</script>';
			}
			break;
		
		// Take it on
		case 'on':
			if($choosenDB == 'xml') {
				xmlparser::edit_value(
					'../../'.$tcms_administer_site.'/tcms_products/'.$maintag.'.xml',
					'publish_state',
					'0',
					'1'
				);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'products.pub=1';
				$sqlQR = $sqlAL->updateOne($tcms_db_prefix.'products', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';'
				.'</script>';
			}
			else{
				if($tcms_main->isReal($new_faq_cat)) {
					$strAdd = '&category='.$new_faq_cat;
				}
				else {
					$strAdd = '';
				}
				
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_products'.$strAdd.'\';'
				.'</script>';
			}
			break;
	}
}





// -------------------------------------------------
// CHANGE MAINPAGE SHOWABILITY
// -------------------------------------------------

if($todo == 'enableMainpage') {
	switch($action){
		// Take it off
		case 'off':
			if($choosenDB == 'xml') {
				xmlparser::edit_value(
					'../../'.$tcms_administer_site.'/tcms_products/'.$maintag.'.xml',
					'show_on_startpage',
					'1',
					'0'
				);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'products.show_on_startpage=0';
				$sqlQR = $sqlAL->updateOne($tcms_db_prefix.'products', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';'
				.'</script>';
			}
			else{
				if($tcms_main->isReal($new_faq_cat)) {
					$strAdd = '&category='.$new_faq_cat;
				}
				else {
					$strAdd = '';
				}
				
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_products'.$strAdd.'\';'
				.'</script>';
			}
			break;
		
		// Take it on
		case 'on':
			if($choosenDB == 'xml') {
				xmlparser::edit_value(
					'../../'.$tcms_administer_site.'/tcms_products/'.$maintag.'.xml',
					'show_on_startpage',
					'0',
					'1'
				);
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$newSQLData = $tcms_db_prefix.'products.show_on_startpage=1';
				$sqlQR = $sqlAL->updateOne($tcms_db_prefix.'products', $newSQLData, $maintag);
			}
			
			if($sender == 'desktop'){
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_page\';'
				.'</script>';
			}
			else{
				if($tcms_main->isReal($new_faq_cat)) {
					$strAdd = '&category='.$new_faq_cat;
				}
				else {
					$strAdd = '';
				}
				
				echo '<script type="text/javascript">'
				.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_products'.$strAdd.'\';'
				.'</script>';
			}
			break;
	}
}





// -------------------------------------------------
// DELETE
// -------------------------------------------------

if($todo == 'delete'){
	if($choosenDB == 'xml') {
		if($type == 'c') {
			/*$tcms_main->deleteDir(
				'../../'.$tcms_administer_site.'/tcms_products/'.$maintag.'/'
			);*/
			unlink('../../'.$tcms_administer_site.'/tcms_products/'.$maintag);
		}
		else {
			/*$tcms_main->deleteDir(
				'../../'.$tcms_administer_site.'/tcms_products/'.$maintag.'/'
			);*/
			unlink('../../'.$tcms_administer_site.'/tcms_products/'.$maintag);
		}
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if($type == 'c') {
			$sqlRes = $sqlAL->query(
				"DELETE FROM ".$tcms_db_prefix."products WHERE uid = '".$maintag."' OR category = '".$maintag."' "
			);
		}
		else {
			$sqlRes = $sqlAL->query(
				"DELETE FROM ".$tcms_db_prefix."products WHERE uid = '".$maintag."'"
			);
		}
	}
	
	echo '<script>'
	.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_products\';'
	.'</script>';
}

?>
