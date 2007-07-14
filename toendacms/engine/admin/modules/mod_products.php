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
 * @version 0.4.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['category'])){ $category = $_GET['category']; }
if(isset($_GET['action'])){ $action = $_GET['action']; }
if(isset($_GET['check'])){ $check = $_GET['check']; }
if(isset($_GET['article'])){ $article = $_GET['article']; }
if(isset($_GET['rm'])){ $rm = $_GET['rm']; }

if(isset($_POST['rm'])){ $rm = $_POST['rm']; }
if(isset($_POST['create_folder'])){ $create_folder = $_POST['create_folder']; }
if(isset($_POST['delete'])){ $delete = $_POST['delete']; }
if(isset($_POST['new_pid'])){ $new_pid = $_POST['new_pid']; }
if(isset($_POST['new_ptitle'])){ $new_ptitle = $_POST['new_ptitle']; }
if(isset($_POST['new_pstamp'])){ $new_pstamp = $_POST['new_pstamp']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }
if(isset($_POST['new_cstate'])){ $new_cstate = $_POST['new_cstate']; }
if(isset($_POST['new_cstate'])){ $new_cstate = $_POST['new_cstate']; }
if(isset($_POST['new_ctitle'])){ $new_ctitle = $_POST['new_ctitle']; }
if(isset($_POST['new_usest'])){ $new_usest = $_POST['new_usest']; }
if(isset($_POST['new_date'])){ $new_date = $_POST['new_date']; }
if(isset($_POST['new_folder'])){ $new_folder = $_POST['new_folder']; }
if(isset($_POST['new_name'])){ $new_name = $_POST['new_name']; }
if(isset($_POST['new_desc'])){ $new_desc = $_POST['new_desc']; }
if(isset($_POST['new_sort'])){ $new_sort = $_POST['new_sort']; }
if(isset($_POST['new_pub'])){ $new_pub = $_POST['new_pub']; }
if(isset($_POST['new_access'])){ $new_access = $_POST['new_access']; }
if(isset($_POST['new_category'])){ $new_category = $_POST['new_category']; }
if(isset($_POST['article'])){ $article = $_POST['article']; }
if(isset($_POST['new_status'])){ $new_status = $_POST['new_status']; }
if(isset($_POST['new_product'])){ $new_product = $_POST['new_product']; }
if(isset($_POST['new_desc'])){ $new_desc = $_POST['new_desc']; }
if(isset($_POST['new_product_no'])){ $new_product_no = $_POST['new_product_no']; }
if(isset($_POST['new_date'])){ $new_date = $_POST['new_date']; }
if(isset($_POST['new_image'])){ $new_image = $_POST['new_image']; }
if(isset($_POST['new_factory'])){ $new_factory = $_POST['new_factory']; }
if(isset($_POST['new_factory_url'])){ $new_factory_url = $_POST['new_factory_url']; }
if(isset($_POST['new_price'])){ $new_price = $_POST['new_price']; }
if(isset($_POST['new_pricetax'])){ $new_pricetax = $_POST['new_pricetax']; }
if(isset($_POST['new_quantity'])){ $new_quantity = $_POST['new_quantity']; }
if(isset($_POST['new_weight'])){ $new_weight = $_POST['new_weight']; }
if(isset($_POST['new_sort'])){ $new_sort = $_POST['new_sort']; }
if(isset($_POST['tmp_image'])){ $tmp_image = $_POST['tmp_image']; }
if(isset($_POST['old_image'])){ $old_image = $_POST['old_image']; }
if(isset($_POST['lang_exist'])){ $lang_exist = $_POST['lang_exist']; }





// -------------------------------------------------
// INIT
// -------------------------------------------------

echo '<script language="JavaScript" src="../js/jscalendar/calendar.js"></script>';
echo '<script language="Javascript" src="../js/jscalendar/lang/calendar-en.js"></script>';
echo '<script language="Javascript" src="../js/jscalendar/calendar-setup.js"></script>';
echo '<link rel="stylesheet" type="text/css" media="all" href="../js/jscalendar/calendar-toendaCMS.css" title="toendaCMS" />';

if(!isset($todo)){ $todo = 'show'; }
if(!isset($action)){ $action = ''; }

$arr_farbe[0] = $arr_color[0];
$arr_farbe[1] = $arr_color[1];
$bgkey     = 0;

$c_xml     = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml','r');
$c_charset = $c_xml->readSection('global', 'charset');

if($choosenDB == 'xml'){
	$arr_products = $tcms_main->getPathContent('../../'.$tcms_administer_site.'/tcms_products/');
	
	if(isset($arr_products) && !empty($arr_products) && $arr_products != ''){
		foreach($arr_products as $key => $value){
			$menu_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_products/'.$value.'/folderinfo.xml','r');
			$arr_dwcc['name'][$key] = $menu_xml->readSection('folderinfo', 'name');
			$arr_dwcc['dir'][$key]  = $menu_xml->readSection('folderinfo', 'folder');
			
			// CHARSETS
			$arr_dwcc['name'][$key] = $tcms_main->decodeText($arr_dwcc['name'][$key], '2', $c_charset);
		}
	}
}
else{
	$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
	$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix."products WHERE sql_type='d'");
	
	$count = 0;
	
	while($sqlARR = $sqlAL->fetchArray($sqlQR)){
		$arr_dwcc['name'][$count]  = $sqlARR['name'];
		$arr_dwcc['dir'][$count]   = $sqlARR['category'];
		
		if($arr_dwcc['name'][$count] == NULL){ $arr_dwcc['name'][$count] = ''; }
		if($arr_dwcc['dir'][$count]  == NULL){ $arr_dwcc['dir'][$count]  = ''; }
		
		// CHARSETS
		$arr_dwcc['name'][$count] = $tcms_main->decodeText($arr_dwcc['name'][$count], '2', $c_charset);
		
		$count++;
		$checkCatAmount = $count;
	}
}





// -------------------------------------------------
// CONFIGURATION
// -------------------------------------------------

if($todo == 'config'){
	if($id_group == 'Developer' 
	|| $id_group == 'Administrator'){
		if($show_wysiwyg == 'tinymce'){
			include('../tcms_kernel/tcms_tinyMCE.lib.php');
			
			$tcms_tinyMCE = new tcms_tinyMCE($tcms_path, $seoEnabled);
			$tcms_tinyMCE->initTinyMCE();
			
			unset($tcms_tinyMCE);
		}
		
		if($choosenDB == 'xml'){
			if(file_exists('../../'.$tcms_administer_site.'/tcms_global/contactform.'.$getLang.'.xml')) {
				$pXML = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/products.xml','r');
				
				$old_pid    = $pXML->readSection('config', 'products_id');
				$old_ptitle = $pXML->readSection('config', 'products_title');
				$old_pstamp = $pXML->readSection('config', 'products_stamp');
				$old_ptext  = $pXML->readSection('config', 'products_text');
				$old_cstate = $pXML->readSection('config', 'category_state');
				$old_ctitle = $pXML->readSection('config', 'category_title');
				$old_usest  = $pXML->readSection('config', 'use_category_title');
				
				if(!$old_pid)   { $old_pid    = ''; }
				if(!$old_ptitle){ $old_ptitle = ''; }
				if(!$old_pstamp){ $old_pstamp = ''; }
				if(!$old_cstate){ $old_cstate = ''; }
				if(!$old_ctitle){ $old_ctitle = ''; }
				if(!$old_usest) { $old_usest  = ''; }
				
				$langExist = 1;
			}
			else {
				$langExist = 0;
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->getOne($tcms_db_prefix.'products_config', 'products');
			$langExist = $sqlAL->getNumber($sqlQR);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$old_pid    = $sqlObj->products_id;
			$old_ptitle = $sqlObj->products_title;
			$old_pstamp = $sqlObj->products_stamp;
			$old_ptext  = $sqlObj->products_text;
			$old_cstate = $sqlObj->produccategory_statets_text;
			$old_ctitle = $sqlObj->category_title;
			$old_usest  = $sqlObj->use_category_title;
			
			if($old_pid    == NULL){ $old_pid    = ''; }
			if($old_ptitle == NULL){ $old_ptitle = ''; }
			if($old_pstamp == NULL){ $old_pstamp = ''; }
			if($old_cstate == NULL){ $old_cstate = ''; }
			if($old_ctitle == NULL){ $old_ctitle = ''; }
			if($old_usest  == NULL){ $old_usest  = ''; }
		}
		
		$old_ptitle = $tcms_main->decodeText($old_ptitle, '2', $c_charset);
		$old_pstamp = $tcms_main->decodeText($old_pstamp, '2', $c_charset);
		$old_ptext  = $tcms_main->decodeText($old_ptext, '2', $c_charset);
		$old_ctitle = $tcms_main->decodeText($old_ctitle, '2', $c_charset);
		
		$old_ptitle = htmlspecialchars($old_ptitle);
		$old_pstamp = htmlspecialchars($old_pstamp);
		$old_ctitle = htmlspecialchars($old_ctitle);
		
		$old_ptext = ereg_replace('<br />'.chr(10), chr(13), $old_ptext);
		$old_ptext = ereg_replace('<br />'.chr(13), chr(13), $old_ptext);
		$old_ptext = ereg_replace('<br />', chr(13), $old_ptext);
		
		$old_ptext = ereg_replace('<br/>'.chr(10), chr(13), $old_ptext);
		$old_ptext = ereg_replace('<br/>'.chr(13), chr(13), $old_ptext);
		$old_ptext = ereg_replace('<br/>', chr(13), $old_ptext);
		
		$old_ptext = ereg_replace('<br>'.chr(10), chr(13), $old_ptext);
		$old_ptext = ereg_replace('<br>'.chr(13), chr(13), $old_ptext);
		$old_ptext = ereg_replace('<br>', chr(13), $old_ptext);
		
		
		if($tcms_main->isReal($lang))
			$getLang = $tcms_config->getLanguageCodeForTCMS($lang);
		else
			$getLang = $tcms_front_lang;
		
		
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
		echo '<tr><td valign="top">'
		._PRODUCTS_ID
		.'</td><td valign="top" colspan="2">'
		.'<input name="new_pid" readonly class="tcms_input_small tcms_bg_grey_03" value="'.$old_pid.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="top">'
		._PRODUCTS_SITETITLE
		.'</td><td valign="top" colspan="2">'
		.'<input name="new_ptitle" class="tcms_input_normal" value="'.$old_ptitle.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="top">'
		._PRODUCTS_SITESUBTITLE
		.'</td><td valign="top" colspan="2">'
		.'<input name="new_pstamp" class="tcms_input_normal" value="'.$old_pstamp.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="top">'
		._PRODUCTS_MAINCATEGORY
		.'</td><td valign="top" colspan="2">'
		.'<select name="new_cstate">';
		
		foreach($arr_dwcc['name'] as $pkey => $pval){
			echo '<option value="'.$arr_dwcc['dir'][$pkey].'"'.( $arr_dwcc['dir'][$pkey] == $old_cstate ? ' selected' : '' ).'>'.$pval.'</option>';
		}
		
		echo '</select>'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="top">'
		._PRODUCTS_CATEGORY_TITLE
		.'</td><td valign="top" colspan="2">'
		.'<input name="new_ctitle" class="tcms_input_normal" value="'.$old_ctitle.'" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td width="250">'
		._PRODUCTS_USE_CATEGORY_TITLE
		.'</td><td>'
		.'<input type="checkbox" name="new_usest" '.( $old_usest == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td valign="top" colspan="2">'
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
		
		echo '<br /></td></tr>';
		
		
		// Table end
		echo '</table><br />';
		
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
	
	$count = 0;
	$showAll = false;
	
	if($choosenDB == 'xml'){
		if($tcms_main->isArray($arr_products)){
			foreach($arr_products as $key => $value){
				$menu_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_products/'.$value.'/folderinfo.xml','r');
				$chkAcc   = $menu_xml->readSection('folderinfo', 'access');
				
				if($id_group == 'Developer' || $id_group == 'Administrator'){ $showAll = true; }
				else{
					if($chkAcc == 'Public' || $chkAcc == 'Protected'){ $showAll = true; }
					else{ $showAll = false; }
				}
				
				if($showAll == true){
					$arr_dw['name'][$count] = $menu_xml->readSection('folderinfo', 'name');
					$arr_dw['date'][$count] = $menu_xml->readSection('folderinfo', 'date');
					$arr_dw['desc'][$count] = $menu_xml->readSection('folderinfo', 'desc');
					$arr_dw['sort'][$count] = $menu_xml->readSection('folderinfo', 'sort');
					$arr_dw['dir'][$count]  = $menu_xml->readSection('folderinfo', 'folder');
					$arr_dw['pub'][$count]  = $menu_xml->readSection('folderinfo', 'pub');
					$arr_dw['ac'][$count]   = $menu_xml->readSection('folderinfo', 'access');
					
					$arr_dw['name'][$count] = $tcms_main->decodeText($arr_dw['name'][$count], '2', $c_charset);
					$arr_dw['desc'][$count] = $tcms_main->decodeText($arr_dw['desc'][$count], '2', $c_charset);
					
					$count++;
				}
			}
		}
		
		if(is_array($arr_dw['sort'])){
			array_multisort(
				$arr_dw['sort'], SORT_ASC, 
				$arr_dw['name'], SORT_ASC, 
				$arr_dw['date'], SORT_ASC, 
				$arr_dw['desc'], SORT_ASC, 
				$arr_dw['dir'], SORT_ASC, 
				$arr_dw['pub'], SORT_ASC, 
				$arr_dw['ac'], SORT_ASC
			);
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if($id_group == 'Developer' || $id_group == 'Administrator'){
			$strAdd = " OR access = 'Private' OR access = 'Protected' ) ";
		}
		else{
			$strAdd = " OR access = 'Protected' ) ";
		}
		
		$sqlSTR = "SELECT * "
		."FROM ".$tcms_db_prefix."products "
		."WHERE sql_type='d' "
		."AND ( access = 'Public' "
		.$strAdd
		."ORDER BY sort DESC, date DESC, name DESC";
		
		$sqlQR = $sqlAL->query($sqlSTR);
		
		$count = 0;
		
		while($sqlARR = $sqlAL->fetchArray($sqlQR)){
			$arr_dw['name'][$count]  = $sqlARR['name'];
			$arr_dw['date'][$count]  = $sqlARR['date'];
			$arr_dw['desc'][$count]  = $sqlARR['desc'];
			$arr_dw['sort'][$count]  = $sqlARR['sort'];
			$arr_dw['dir'][$count]   = $sqlARR['category'];
			$arr_dw['pub'][$count]   = $sqlARR['status'];
			$arr_dw['ac'][$count]    = $sqlARR['access'];
			
			if($arr_dw['name'][$count] == NULL){ $arr_dw['name'][$count] = ''; }
			if($arr_dw['date'][$count] == NULL){ $arr_dw['date'][$count] = ''; }
			if($arr_dw['desc'][$count] == NULL){ $arr_dw['desc'][$count] = ''; }
			if($arr_dw['sort'][$count] == NULL){ $arr_dw['sort'][$count] = ''; }
			if($arr_dw['dir'][$count]  == NULL){ $arr_dw['dir'][$count]  = ''; }
			if($arr_dw['pub'][$count]  == NULL){ $arr_dw['pub'][$count]  = ''; }
			if($arr_dw['ac'][$count]   == NULL){ $arr_dw['ac'][$count]   = ''; }
			
			$arr_dw['name'][$count] = $tcms_main->decodeText($arr_dw['name'][$count], '2', $c_charset);
			$arr_dw['desc'][$count] = $tcms_main->decodeText($arr_dw['desc'][$count], '2', $c_charset);
			
			$count++;
			$checkCatAmount = $count;
		}
	}
	
	
	echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder">';
	echo '<tr class="tcms_bg_blue_01">'
		.'<th valign="middle" class="tcms_db_title" width="15%" align="left">'._TABLE_TITLE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="35%" align="left">'._TABLE_DESCRIPTION.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_POS.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_PUBLISHED.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%">'._TABLE_MACCESS.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="5%" align="left">'._TABLE_DELETE.'</th>'
		.'<th valign="middle" class="tcms_db_title" width="10%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';
	
		
	if(isset($arr_dw['sort']) && !empty($arr_dw['sort']) && $arr_dw['sort'] != ''){
		foreach($arr_dw['sort'] as $key => $value){
			$bgkey++;
			if(is_integer($bgkey/2)){ $ws_farbe = $arr_farbe[0]; }
			else{ $ws_farbe = $arr_farbe[1]; }
			
			echo '<form name="'.$arr_dw['dir'][$key].'" id="'.$arr_dw['dir'][$key].'" action="admin.php?id_user='.$id_user.'&amp;site=mod_products" method="post">'
			.'<input name="todo" id="todo'.$key.'" type="hidden" value="category" />'
			.'<input name="new_date" type="hidden" value="'.$arr_dw['date'][$key].'" />'
			.'<input name="new_folder" type="hidden" value="'.$arr_dw['dir'][$key].'" />';
			
			
			// row
			echo '<tr id="row'.$key.'" '
			.'bgcolor="'.$ws_farbe.'" '
			.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
			.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$ws_farbe.'\')">';
			
			echo '<td valign="top" align="left" class="tcms_db_2"><input name="new_name" class="tcms_input_small" value="'.$arr_dw['name'][$key].'" /></td>';
			
			echo '<td valign="top" class="tcms_db_2" align="left"><textarea name="new_desc" class="tcms_textarea_low_width">'.$arr_dw['desc'][$key].'</textarea></td>';
			
			echo '<td valign="top" class="tcms_db_2" align="center"><input name="new_sort" type="text" class="tcms_input_makro" value="'.$arr_dw['sort'][$key].'" /></td>';
			
			echo '<td valign="top" align="center" class="tcms_db_2"><input name="new_pub" value="1" type="checkbox"'.( $arr_dw['pub'][$key] == 1 ? ' checked' : $arr_dw['pub'][$key] ).' /></td>';
			
			echo '<td valign="top" class="tcms_db_2" align="center">'
			.'<select name="new_access" class="tcms_select">'
				.'<option value="Public"'.( $arr_dw['ac'][$key] == 'Public' ? ' selected' : '' ).'>'._TABLE_PUBLIC.'</option>'
				.'<option value="Protected"'.( $arr_dw['ac'][$key] == 'Protected' ? ' selected' : '' ).'>'._TABLE_PROTECTED.'</option>';
				if($id_group == 'Developer' || $id_group == 'Administrator'){
					echo '<option value="Private"'.( $arr_dw['ac'][$key] == 'Private' ? ' selected' : '' ).'>'._TABLE_PRIVATE.'</option>';
				}
			echo '</select></td>';
			
			echo '<td class="tcms_db_2" valign="top"><input type="checkbox" name="delete" value="1" /></td>';
			
			echo '<td class="tcms_db_2" align="right" valign="middle">'
			.'<a title="'._TABLE_SAVEBUTTON.'" href="javascript:document.forms[\''.$arr_dw['dir'][$key].'\'].submit();">'
			.'<img title="'._TABLE_SAVEBUTTON.'" alt="'._TABLE_SAVEBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_save.gif" />'
			.'</a><br />'
			.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&site=mod_products&todo=edit&category='.$arr_dw['dir'][$key].'&action=show">'
			.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
			.'</a><br />'
			.'<a title="'._TABLE_DELBUTTON.'" href="javascript:submitXML(\''.$arr_dw['dir'][$key].'\', \'todo'.$key.'\', \'delete\');">'
			.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
			.'</a>'
			.'</td>';
			
			echo '</tr>';
			
			echo '</form>';
		}
	}
	
	echo '</table><br />';
}











// -------------------------------------------------
// EDIT CATEGORY
// -------------------------------------------------

if($todo == 'create'){
	echo tcms_html::bold(_TABLE_NEW);
	
	
	$width = '150';
	
	echo tcms_html::text(_PRODUCTS_NEW_CAT.'<br /><br />', 'left');
	
	
	// begin form
	echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_products" method="post">'
	.'<input name="todo" type="hidden" value="category" />'
	.'<input name="create_folder" type="hidden" value="1" />';
	
	
	// table head
	echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder"><tr class="tcms_bg_blue_01">';
	echo '<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>';
	echo '</tr></table>';
	
	
	// table head
	echo '<table width="100%" border="0" cellpadding="1" cellspacing="5" class="tcms_table">';
	
	
	// row
	echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_TITLE.'</strong></td>'
	.'<td valign="top"><input class="tcms_input_normal" name="new_name" type="text" />'
	.'</td></tr>';
	
	
	//================================================
	echo '
	<tr><td valign="top" width="'.$width.'">
		<strong class="tcms_bold">'._TABLE_DESCRIPTION.'</strong>
	</td><td valign="top">
		<textarea class="tcms_textarea_big" name="new_desc" type="text"></textarea>
	</td></tr>';
	//================================================
	echo '
	<tr><td valign="top" width="'.$width.'">
		<strong class="tcms_bold">'._TABLE_PUBLISHED.'</strong>
	</td><td valign="top">
		<input name="new_pub" value="1" type="checkbox" />
	</td></tr>';
	//================================================
	echo '
	<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_ACCESS.'</strong></td><td valign="top">'
	.'<select name="new_access" class="tcms_select">'
		.'<option value="Public"'.( isset($sm_access) && $sm_access == 'Public' ? ' selected' : '' ).'>'._TABLE_PUBLIC.'</option>'
		.'<option value="Protected"'.( isset($sm_access) && $sm_access == 'Protected' ? ' selected' : '' ).'>'._TABLE_PROTECTED.'</option>';
		if($id_group == 'Developer' || $id_group == 'Administrator'){
			echo '<option value="Private"'.( isset($sm_access) && $sm_access == 'Private' ? ' selected' : '' ).'>'._TABLE_PRIVATE.'</option>';
		}
	echo'</select>'
	.'</td></tr>';
	//================================================
	
	
	echo '</table>';
	
	/*
	* END
	*
	*****************/
	
	echo '</form>';
}













// -------------------------------------------------
// EDIT ITEM
// -------------------------------------------------

if($todo == 'edit'){
	if(isset($category) && $category != ''){
		if($choosenDB == 'xml'){
			$down_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_products/'.$category.'/folderinfo.xml','r');
			$down_cat = $down_xml->readSection('folderinfo', 'name');
			$down_acc = $menu_xml->readSection('folderinfo', 'access');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->getOne($tcms_db_prefix.'products', $category);
			$sqlARR = $sqlAL->fetchArray($sqlQR);
			
			$down_cat = $sqlARR['name'];
			$down_acc = $sqlARR['access'];
		}
		
		$down_cat = $tcms_main->decodeText($down_cat, '2', $c_charset);
	}
	
	if($id_group == 'Developer' || $id_group == 'Administrator'){ $showAll = true; }
	else{
		if($down_acc == 'Public' || $down_acc == 'Protected'){ $showAll = true; }
		else{ $showAll = false; }
	}
	
	
	if($showAll == true){
		if($action == 'show'){
			if($choosenDB == 'xml'){
				$arr_pfiles = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_products/'.$category);
				
				if(isset($arr_pfiles) && !empty($arr_pfiles) && $arr_pfiles != ''){
					foreach($arr_pfiles as $key => $value){
						if($value != 'folderinfo.xml'){
							$menu_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_products/'.$category.'/'.$value,'r');
							$arr_dw['product'][$key]     = $menu_xml->readSection('info', 'product');
							$arr_dw['date'][$key]        = $menu_xml->readSection('info', 'date');
							$arr_dw['status'][$key]      = $menu_xml->readSection('info', 'status');
							$arr_dw['sort'][$key]        = $menu_xml->readSection('info', 'sort');
							$arr_dw['tag'][$key]         = substr($value, 0, 10);
							
							if(!$arr_dw['product'][$key]){ $arr_dw['product'][$key] = ''; }
							if(!$arr_dw['date'][$key])   { $arr_dw['date'][$key]    = ''; }
							if(!$arr_dw['status'][$key]) { $arr_dw['status'][$key]  = ''; }
							if(!$arr_dw['sort'][$key])   { $arr_dw['sort'][$key]    = ''; }
							
							// CHARSETS
							$arr_dw['product'][$key] = $tcms_main->decodeText($arr_dw['product'][$key], '2', $c_charset);
						}
					}
				}
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
				$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix."products WHERE sql_type='f' AND category='".$category."'");
				
				$count = 0;
				
				while($sqlARR = $sqlAL->fetchArray($sqlQR)){
					$arr_dw['product'][$count] = $sqlARR['name'];
					$arr_dw['date'][$count]    = $sqlARR['date'];
					$arr_dw['status'][$count]  = $sqlARR['status'];
					$arr_dw['sort'][$count]    = $sqlARR['sort'];
					$arr_dw['tag'][$count]     = $sqlARR['uid'];
					
					if($arr_dw['product'][$count] == NULL){ $arr_dw['product'][$count] = ''; }
					if($arr_dw['date'][$count]    == NULL){ $arr_dw['date'][$count]    = ''; }
					if($arr_dw['status'][$count]  == NULL){ $arr_dw['status'][$count]  = ''; }
					if($arr_dw['sort'][$count]    == NULL){ $arr_dw['sort'][$count]    = ''; }
					if($arr_dw['tag'][$count]     == NULL){ $arr_dw['tag'][$count]     = ''; }
					
					// CHARSETS
					$arr_dw['product'][$count] = $tcms_main->decodeText($arr_dw['product'][$count], '2', $c_charset);
					
					$count++;
					$checkCatAmount = $count;
				}
			}
			
			if(isset($arr_dw) && !empty($arr_dw) && $arr_dw != '' && is_array($arr_dw)){
				array_multisort(
					$arr_dw['sort'], SORT_ASC, 
					$arr_dw['product'], SORT_ASC, 
					$arr_dw['date'], SORT_ASC, 
					$arr_dw['status'], SORT_ASC, 
					$arr_dw['tag'], SORT_ASC
				);
			}
			
			
			
			echo tcms_html::bold(_TABLE_EDIT);
			echo tcms_html::text(_PRODUCTS_EDIT.' '.$down_cat.'<br /><br />', 'left');
			
			
			
			
			echo '<table cellpadding="3" cellspacing="0" border="0" width="100%" class="noborder">';
			echo '<tr class="tcms_bg_blue_01">'
				.'<th valign="middle" class="tcms_db_title" width="70%" align="left">'._TABLE_TITLE.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="15%">'._TABLE_ENABLED.'</th>'
				.'<th valign="middle" class="tcms_db_title" width="15%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';
			
			if(isset($arr_dw['sort']) && !empty($arr_dw['sort']) && $arr_dw['sort'] != ''){
				foreach($arr_dw['sort'] as $key => $value){
					$bgkey++;
					if(is_integer($bgkey/2)){ $ws_farbe = $arr_farbe[0]; }
					else{ $ws_farbe = $arr_farbe[1]; }
					
					echo '<tr height="25" id="row'.$key.'" '
					.'bgcolor="'.$ws_farbe.'" '
					.'onMouseOver="wxlBgCol(\'row'.$key.'\',\'#ececec\')" '
					.'onMouseOut="wxlBgCol(\'row'.$key.'\',\''.$ws_farbe.'\')" '
					.'onclick="document.location=\'admin.php?id_user='.$id_user.'&site=mod_products&todo=edit&category='.$category.'&article='.$arr_dw['tag'][$key].'\';">';
					
					echo '<td class="tcms_db_2" align="left">'.$arr_dw['product'][$key].'</td>';
					
					echo '<td align="center" class="tcms_db_2">'.( $arr_dw['status'][$key] == 1 ? '<img src="../images/yes.png" border="0" />' : '<img src="../images/no.png" border="0" />' ).'</td>';
					
					echo '<td class="tcms_db_2" align="right" valign="middle">'
					.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&site=mod_products&todo=edit&category='.$category.'&article='.$arr_dw['tag'][$key].'">'
					.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
					.'</a>&nbsp;'
					.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&site=mod_products&todo=delArticle&category='.$category.'&article='.$arr_dw['tag'][$key].'">'
					.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
					.'</a>&nbsp;'
					.'</td>';
					
					echo '</tr>';
					
					echo '</form>';
				}
			}
			
			echo '</table><br />';
		}
		else{
			if(isset($article) && !empty($article) && $article != ''){
				if($choosenDB == 'xml'){
					$menu_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_products/'.$category.'/'.$article.'.xml','r');
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
					
					if(!$arr_product)    { $arr_product     = ''; }
					if(!$arr_product_no) { $arr_product_no  = ''; }
					if(!$arr_factory)    { $arr_factory     = ''; }
					if(!$arr_factory_url){ $arr_factory_url = ''; }
					if(!$arr_desc)       { $arr_desc        = ''; }
					if(!$arr_category)   { $arr_category    = ''; }
					if(!$arr_image)      { $arr_image       = ''; }
					if(!$arr_date)       { $arr_date        = ''; }
					if(!$arr_price)      { $arr_price       = ''; }
					if(!$arr_pricetax)   { $arr_pricetax    = ''; }
					if(!$arr_status)     { $arr_status      = ''; }
					if(!$arr_quantity)   { $arr_quantity    = ''; }
					if(!$arr_weight)     { $arr_weight      = ''; }
					if(!$arr_sort)       { $arr_sort        = ''; }
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlQR = $sqlAL->query("SELECT * FROM ".$tcms_db_prefix."products WHERE uid='".$article."' AND sql_type='f' AND category='".$category."'");
					
					$sqlARR = $sqlAL->fetchArray($sqlQR);
					
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
				
				// CHARSETS
				$arr_product = $tcms_main->decodeText($arr_product, '2', $c_charset);
				$arr_factory = $tcms_main->decodeText($arr_factory, '2', $c_charset);
				$arr_desc    = $tcms_main->decodeText($arr_desc, '2', $c_charset);
				
				echo tcms_html::bold(_TABLE_EDIT);
			}
			else{
				$arr_category = $down_cat;
				if(!isset($arr_sort) || empty($arr_sort) || $arr_sort == ''){ $arr_sort = '9999'; }
				if(!isset($arr_date) || empty($arr_date) || $arr_date == ''){ $arr_date = date('d.m.Y-H:i'); }
				
				if($choosenDB == 'xml'){ while(($article=substr(md5(microtime()),0,10)) && file_exists('../../'.$tcms_administer_site.'/tcms_products/'.$category.'/'.$article.'.xml')){} }
				else{ $article = $tcms_main->create_uid($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'products', 10); }
				
				$create_folder = 1;
				
				echo tcms_html::bold(_TABLE_NEW);
			}
			
			/*echo '<td valign="top" class="tcms_db_2" align="left">
				'.( 
				$arr_dw['image'][$key] == '_empty_' ? 
				'<img src="../images/no_picture.gif" border="0" />' : 
				'<img src="../../'.$tcms_administer_site.'/images/products/'.$arr_dw['image'][$key].'" border="0" />' 
				).'
			</td>';*/
			
			$width = '150';
			
			echo tcms_html::text(_PRODUCTS_NEW.' '.$down_cat.'. '._PRODUCTS_HELP.'<br /><br />', 'left');
			
			
			echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_products" method="post" enctype="multipart/form-data">'
			.'<input name="todo" type="hidden" value="save" />'
			.'<input name="article" type="hidden" value="'.$article.'" />';
			if($create_folder == 1){ echo '<input name="create_folder" type="hidden" value="1" />'; }
			
			
			echo '<table width="100%" cellpadding="0" cellspacing="0" class="tcms_noborder"><tr class="tcms_bg_blue_01">';
			echo '<th valign="middle" align="left" class="tcms_db_title tcms_padding_mini">'._TABLE_DETAILS.'</th>';
			echo '</tr></table>';
			
			echo '<table width="100%" border="0" cellpadding="1" cellspacing="5" class="tcms_table">';
			
			
			// row
			if(!isset($category) || $category == ''){
				echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_CATEGORY.'</strong></td>'
				.'<td valign="top">'
				.'<select name="category" class="tcms_select" onchange="document.getElementById(\'new_category\').value=this.value;">';
					if($choosenDB == 'xml'){
						$arr_products = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_products/');
						
						if(is_array($arr_products)){
							foreach($arr_products as $key => $value){
								if($value != 'index.html'){
									$menu_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_products/'.$value.'/folderinfo.xml','r');
									$down_cat = $menu_xml->readSection('folderinfo', 'name');
									
									$down_cat = $tcms_main->decodeText($down_cat, '2', $c_charset);
									
									echo '<option value="'.$value.'">'.$down_cat.'</option>';
								}
							}
						}
					}
					else{
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlString = "SELECT * "
						."FROM ".$tcms_db_prefix."products "
						."WHERE sql_type = 'd'";
						
						$sqlQR = $sqlAL->query($sqlString);
						$count = 0;
						
						while($sqlARR = $sqlAL->fetchArray($sqlQR)){
							$p_name = $sqlARR['name'];
							$p_cat  = $sqlARR['category'];
							
							if($count == 0){
								$tmp_category = $p_cat;
							}
							
							if($p_cat == NULL){ $p_cat = ''; }
							
							echo '<option value="'.$p_cat.'">'.$p_name.'</option>';
							
							$count++;
						}
					}
				echo '</select>'
				.'<input name="new_category" id="new_category" type="hidden" value="'.$tmp_category.'" />'
				.'</td></tr>';
			}
			else{
				echo '<tr style="display: none;"><td colspan="2">'
				.'<input name="category" type="hidden" value="'.$category.'" />'
				.'<input name="new_category" type="hidden" value="'.$category.'" />'
				.'</td></tr>';
			}
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_ENABLED.' / '._TABLE_STOCK.'</td>'
			.'<td valign="top">'
			.'<input type="checkbox" name="new_status" '.( isset($arr_status) && $arr_status == 1 ? 'checked' : '' ).' value="1" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_TITLE.'</td>'
			.'<td valign="top">'
			.'<input class="tcms_input_normal" name="new_product" type="text" value="'.( isset($arr_product) ? $arr_product : '' ).'" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_DESCRIPTION.'</td>'
			.'<td valign="top">'
			.'<textarea class="tcms_textarea_fat" name="new_desc" type="text">'.( isset($arr_desc) ? $arr_desc : '' ).'</textarea>'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_PRODUCTNO.'</td>'
			.'<td valign="top">'
			.'<input class="tcms_input_normal" name="new_product_no" type="text" value="'.( isset($arr_product_no) ? $arr_product_no : '' ).'" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_DATE.'</td>'
			.'<td valign="top">'
			.'<input class="tcms_input_small" id="new_date" name="new_date" type="text" value="'.( isset($arr_date) ? $arr_date : '' ).'" />'
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
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_IMAGE.'</td>'
			.'<td valign="top">'
			.'<input class="tcms_upload" name="new_image" type="file" accept="image/*" /><br />'
			.'<input name="tmp_image" id="tmp_image" type="hidden" value="'.$arr_image.'" />'
			.'<input name="old_image" id="old_image" type="hidden" value="'.$arr_image.'" />'
			.'</td></tr>';
			
			echo '<tr><td>&nbsp;</td><td valign="middle" align="left">'
			.( 
				trim($arr_image) == '_empty_' || trim($arr_image) == '' ? 
				'<img id="tmp_image_file" src="../images/no_picture.gif" border="0" />' : 
				( file_exists('../../'.$tcms_administer_site.'/images/products/'.$arr_image) ?
					'<img id="tmp_image_file" src="../../'.$tcms_administer_site.'/images/products/'.$arr_image.'" border="0" />' :
					'<img id="tmp_image_file" src="../images/no_picture.gif" border="0" />'
				)
			)
			.'&nbsp;('.( !empty($arr_image) ? $arr_image : '' ).')'
			.'&nbsp;<input type="button" name="tcms" value="'._EXT_NEWS_DESELECT.'" onclick="document.getElementById(\'tmp_image\').value=\'_empty_\';document.getElementById(\'tmp_image_file\').src=\'../images/no_picture.gif\';" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_FACTORY.'</td>'
			.'<td valign="top">'
			.'<input class="tcms_input_normal" name="new_factory" type="text" value="'.( !empty($arr_factory) ? $arr_factory : '' ).'" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_URL.'</td>'
			.'<td valign="top">'
			.'<input class="tcms_input_normal" name="new_factory_url" type="text" value="'.( !empty($arr_factory_url) ? $arr_factory_url : '' ).'" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_PRICE.'</td>'
			.'<td valign="top">'
			.'<input class="tcms_input_small" name="new_price" type="text" value="'.( !empty($arr_price) ? $arr_price : '' ).'" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_PRICE.' '._TABLE_TAX.'</td>'
			.'<td valign="top">'
			.'<input class="tcms_input_small" name="new_pricetax" type="text" value="'.( !empty($arr_pricetax) ? $arr_pricetax : '' ).'" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_QUANTITY.'</td>'
			.'<td valign="top">'
			.'<input class="tcms_input_small" name="new_quantity" type="text" value="'.( $arr_quantity != -1 ? $arr_quantity : '' ).'" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_WEIGHT.'</td>'
			.'<td valign="top">'
			.'<input class="tcms_input_small" name="new_weight" type="text" value="'.( !empty($arr_weight) ? $arr_weight : '' ).'" />'
			.'</td></tr>';
			
			
			// row
			echo '<tr><td valign="top" width="'.$width.'">'._TABLE_POS.'</td>'
			.'<td valign="top">'
			.'<input class="tcms_input_small" name="new_sort" type="text" value="'.( !empty($arr_sort) ? $arr_sort : '' ).'" />'
			.'</td></tr>';
			
			
			// table end
			echo '</table>';
			
			/*
			* END
			*
			*****************/
			
			echo '</form>';
		}
	}
	else{
		echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
	}
}





// -------------------------------------------------
// CASE CONFIGURATION
// -------------------------------------------------

if($todo == 'save_config') {
	if(empty($new_pid))   { $old_pid    = 'products'; }
	if(empty($new_ptitle)){ $new_ptitle = ''; }
	if(empty($new_pstamp)){ $new_pstamp = ''; }
	if(empty($content))   { $content    = ''; }
	if(empty($new_cstate)){ $new_cstate = $old_cstate; }
	if(empty($new_ctitle)){ $new_ctitle = ''; }
	if(empty($new_usest)) { $new_usest  = 0; }
	
	
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
	
	
	$new_ptitle = $tcms_main->decode_text($new_ptitle, '2', $c_charset);
	$new_pstamp = $tcms_main->decode_text($new_pstamp, '2', $c_charset);
	$content    = $tcms_main->decode_text($content, '2', $c_charset);
	$new_ctitle = $tcms_main->decode_text($new_ctitle, '2', $c_charset);
	
	
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
			.$tcms_db_prefix.'products_config.use_category_title='.$new_usest;
			
			switch($choosenDB) {
				case 'mysql':
					$sqlQR = $sqlAL->updateField(
						$tcms_db_prefix.'products_config', 
						$newSQLData, 
						'products_id', 
						'products" AND language = "'.$setLang
					);
					break;
				
				default:
					$sqlQR = $sqlAL->updateField(
						$tcms_db_prefix.'products_config', 
						$newSQLData, 
						'products_id', 
						"products' AND language = '".$setLang
					);
					break;
			}
		}
		else {
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`products_id`, `products_title`, '
					.'`products_stamp`, `products_text`, `category_state`, '
					.'`category_title`, `use_category_title`, `language`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'products_id, products_title, '
					.'products_stamp, products_text, "category_state", '
					.'category_title, use_category_title, "language"';
					break;
				
				case 'mssql':
					$newSQLColumns = '[products_id], [products_title], '
					.'[products_stamp], [products_text], [category_state], '
					.'[category_title], [use_category_title], [language]';
					break;
			}
			
			$newSQLData = "'".$new_pid."', '".$new_ptitle."', "
			."'".$new_pstamp."', '".$content."', "
			."'".$new_cstate."', '".$new_ctitle."', "
			.$new_usest.", '".$setLang."'";
			
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
// CREATE CATEGORY
// -------------------------------------------------

if($todo == 'category'){
	//*****************************************
	if(!isset($new_sort)){
		if($choosenDB == 'xml'){
			$max_files = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_products/');
			$new_sort = count($max_files) + 1;
		}
		else{
			$new_sort = $tcms_main->create_sort_id($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'products', 'sort');
		}
	}
	
	if($new_pub == '' || !isset($new_pub) || empty($new_pub)){ $new_pub = 0; }
	
	if(!isset($new_date)){ $new_date = date('d.m.Y-H:i'); }
	
	if(!isset($new_folder)){
		$new_folder = str_replace(' ', '_', $new_name);
		$new_folder = strtolower($new_folder);
	}
	
	if($new_name == '' || empty($new_name) || !isset($new_name)){ $new_name = '[FILE TITLE]'; }
	if($new_desc == '' || empty($new_desc) || !isset($new_desc)){ $new_desc = '[FILE DESCRIPTION]'; }
	
	//$content = $tcms_main->nl2br($content);
	
	// CHARSETS
	$new_name = $tcms_main->decode_text($new_name, '2', $c_charset);
	$new_desc = $tcms_main->decode_text($new_desc, '2', $c_charset);
	
	
	if($choosenDB == 'xml'){
		if($create_folder == 1){
			$old_umask = umask(0);
			mkdir('../../'.$tcms_administer_site.'/tcms_products/'.$new_folder, 0777);
			umask($old_umask);
		}
		
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_products/'.$new_folder.'/folderinfo.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('folderinfo');
		
		$xmluser->write_value('name', $new_name);
		$xmluser->write_value('date', $new_date);
		$xmluser->write_value('desc', $new_desc);
		$xmluser->write_value('sort', $new_sort);
		$xmluser->write_value('folder', $new_folder);
		$xmluser->write_value('pub', $new_pub);
		$xmluser->write_value('access', $new_access);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('folderinfo');
		$xmluser->_xmlparser();
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if($create_folder == 1){
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`name`, `date`, `desc`, `sort`, `category`, `status`, `access`, `sql_type`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'name, date, "desc", sort, category, status, "access", sql_type';
					break;
				
				case 'mssql':
					$newSQLColumns = '[name], [date], [desc], [sort], [category], [status], [access], [sql_type]';
					break;
			}
			
			$newSQLData = "'".$new_name."', '".$new_date."', '".$new_desc."', ".$new_sort.", '".$new_folder."', ".$new_pub.", '".$new_access."', 'd'";
			
			$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'products', $newSQLColumns, $newSQLData, $new_folder);
		}
		else{
			$newSQLData = ''
			.$tcms_db_prefix.'products.name="'.$new_name.'", '
			.$tcms_db_prefix.'products.date="'.$new_date.'", '
			.$tcms_db_prefix.'products.desc="'.$new_desc.'", '
			.$tcms_db_prefix.'products.sort='.$new_sort.', '
			.$tcms_db_prefix.'products.category="'.$new_folder.'", '
			.$tcms_db_prefix.'products.status='.$new_pub.', '
			.$tcms_db_prefix.'products.access="'.$new_access.'", '
			.$tcms_db_prefix.'products.sql_type="d"';
			
			$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'products', $newSQLData, $new_folder);
		}
	}
	
	//*****************************************
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_products\'</script>';
	
	//*****************************************
}












// -------------------------------------------------
// SAVE ITEM
// -------------------------------------------------


if($todo == 'save'){
	//*****************************************
	
	if(empty($new_status)){ $new_status = 0; }
	
	
	if($_FILES['new_image']['size'] > 0 && (
	$_FILES['new_image']['type'] == 'image/gif' || 
	$_FILES['new_image']['type'] == 'image/png' || 
	$_FILES['new_image']['type'] == 'image/jpg' || 
	$_FILES['new_image']['type'] == 'image/jpeg' || 
	$_FILES['new_image']['type'] == 'image/bmp')){
		$fileName = $_FILES['new_image']['name'];
		$imgDir = '../../'.$tcms_administer_site.'/images/products/';
		
		copy($_FILES['new_image']['tmp_name'], $imgDir.$fileName);
		
		$msg = _MSG_UPLOAD.' '.$imgDir.$_FILES['new_image']['name'];
		$new_image = $_FILES['new_image']['name'];
	}
	else{
		$msg = _MSG_NOIMAGE;
		$new_image = '_empty_';
	}
	
	
	if(isset($tmp_image) && !empty($tmp_image) && $tmp_image != ''){
		if(isset($new_image) && !empty($new_image) && $new_image != '' && $new_image != '_empty_'){
			if(file_exists('../../'.$tcms_administer_site.'/images/products/'.$tmp_image)){ unlink('../../'.$tcms_administer_site.'/images/products/'.$tmp_image); }
			$new_image = $new_image;
		}
		elseif(trim($tmp_image) == '_empty_'){
			if(file_exists('../../'.$tcms_administer_site.'/images/products/'.$old_image)){ unlink('../../'.$tcms_administer_site.'/images/products/'.$old_image); }
		}
		else{
			$new_image = $tmp_image;
		}
	}
	
	
	if(!isset($new_status)   || empty($new_status)   || $new_status   == ''){ $new_status   = 0; }
	if(!isset($new_quantity) || empty($new_quantity) || $new_quantity == ''){ $new_quantity = -1; }
	
	//$content = $tcms_main->nl2br($content);
	
	
	// CHARSETS
	$new_product = $tcms_main->decode_text($new_product, '2', $c_charset);
	$new_factory = $tcms_main->decode_text($new_factory, '2', $c_charset);
	$new_desc    = $tcms_main->decode_text($new_desc, '2', $c_charset);
	
	
	if($choosenDB == 'xml'){
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_products/'.$category.'/'.$article.'.xml', 'w');
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
		$xmluser->_xmlparser();
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		if($create_folder == 1){
			switch($choosenDB){
				case 'mysql':
					$newSQLColumns = '`name`, `product_number`, `factory`, `factory_url`, `desc`, '
					.'`category`, `image`, `date`, `price`, `price_tax`, `status`, `quantity`, '
					.'`weight`, `sort`, `sql_type`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'name, product_number, factory, factory_url, "desc", '
					.'category, image, date, price, price_tax, status, quantity, '
					.'weight, sort, sql_type';
					break;
				
				case 'mssql':
					$newSQLColumns = '[name], [product_number], [factory], [factory_url], [desc], '
					.'[category], [image], [date], [price], [price_tax], [status], [quantity], '
					.'[weight], [sort], [sql_type]';
					break;
			}
			
			$newSQLData = "'".$new_product."', '".$new_product_no."', '".$new_factory."', '".$new_factory_url."', '".$new_desc
			."', '".$new_category."', '".$new_image."', '".$new_date."', '".$new_price."', '".$new_pricetax."', ".$new_status.", ".$new_quantity.", '".$new_weight
			."', ".$new_sort.", 'f'";
			
			$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'products', $newSQLColumns, $newSQLData, $article);
		}
		else{
			$newSQLData = ''
			.$tcms_db_prefix.'products.name="'.$new_product.'", '
			.$tcms_db_prefix.'products.product_number="'.$new_product_no.'", '
			.$tcms_db_prefix.'products.factory="'.$new_factory.'", '
			.$tcms_db_prefix.'products.factory_url="'.$new_factory_url.'", '
			.$tcms_db_prefix.'products.desc="'.$new_desc.'", '
			.$tcms_db_prefix.'products.category="'.$new_category.'", '
			.$tcms_db_prefix.'products.image="'.$new_image.'", '
			.$tcms_db_prefix.'products.date="'.$new_date.'", '
			.$tcms_db_prefix.'products.price="'.$new_price.'", '
			.$tcms_db_prefix.'products.price_tax="'.$new_pricetax.'", '
			.$tcms_db_prefix.'products.status='.$new_status.', '
			.$tcms_db_prefix.'products.quantity='.$new_quantity.', '
			.$tcms_db_prefix.'products.weight="'.$new_weight.'", '
			.$tcms_db_prefix.'products.sort='.$new_sort.', '
			.$tcms_db_prefix.'products.sql_type="f"';
			$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'products', $newSQLData, $article);
		}
	}
	
	//*****************************************
	
	echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_products&todo=edit&category='.$category.'&action=show\'</script>';
	
	//*****************************************
}

















// -------------------------------------------------
// DELETE
// -------------------------------------------------
//===================================================================================
// DELETE
//===================================================================================
if($todo == 'delete'){
	if(isset($delete) && $delete == 1){
		if($choosenDB == 'xml'){ $tcms_main->rmdirr('../../'.$tcms_administer_site.'/tcms_products/'.$new_folder.'/'); }
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$sqlRes = $sqlAL->query("DELETE FROM ".$tcms_db_prefix."products WHERE category = '".$new_folder."'");
		}
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_products\';</script>';
	}
	else{
		echo '<script>alert(\''._MSG_DELETE_INACTIVE.'\');document.location=\'admin.php?id_user='.$id_user.'&site=mod_products\';</script>';
	}
}






if($todo == 'delArticle'){
	if($check == 'yes'){
		if($choosenDB == 'xml'){ unlink('../../'.$tcms_administer_site.'/tcms_products/'.$category.'/'.$article.'.xml'); }
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$sqlAL->sqlDeleteOne($tcms_db_prefix.'products', $article.'" AND category="'.$category);
		}
		
		echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_products&todo=edit&category='.$category.'&action=show\';</script>';
	}
	else{
		echo '<script type="text/javascript">
		delCheck = confirm("'._MSG_DELETE_SUBMIT.'");
		if(delCheck == false){
			document.location=\'admin.php?id_user='.$id_user.'&site=mod_products&todo=edit&category='.$category.'&action=show\';
		}
		else{
			document.location=\'admin.php?id_user='.$id_user.'&site=mod_products&todo=delArticle&check=yes&category='.$category.'&article='.$article.'\';
		}
		</script>';
	}
}

?>
