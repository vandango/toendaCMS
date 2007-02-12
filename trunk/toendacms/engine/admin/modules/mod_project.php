<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Filemanager for all Sites
|
| File:	mod_project.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Filemanager for all Sites
 *
 * This module is used as a filemanager for all Sites
 *
 * @version 0.4.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


// -----------------------------------------------------
// INIT
// -----------------------------------------------------

echo '<script language="JavaScript" src="../js/dhtml.js"></script>';

$tbgz         = 0;
$tfm_menu     = 0;
$bgz          = 0;
$fm_pos       = 200;
$fm_height    = 17;
$fm_menu      = 0;

$namen_xml    = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/namen.xml','r');
$sitename     = $namen_xml->read_section('namen', 'name');
$sitekey      = $namen_xml->read_section('namen', 'key');

$sitename     = $tcms_main->decodeText($sitename, '2', $c_charset);
$sitekey      = $tcms_main->decodeText($sitekey, '2', $c_charset);

$bMod         = false;
$checkEnd     = false;
$checkSubEnd  = false;

$news_id   = 'newsmanager';
$imp_id    = 'impressum';
$front_id  = 'frontpage';
$image_id  = 'imagegallery';
$guest_id  = 'guestbook';
$cform_id  = 'contactform';
$down_id   = 'download';
$pro_id    = 'products';
$links_id  = 'links';
$faq_id    = 'knowledgebase';
$cs_id     = 'components';





// -----------------------------------------------------
// SIDEMENU ITEMS
// -----------------------------------------------------

if($sidemenu_active == 1){
	if($choosenDB == 'xml'){
		$arr_explore['link'] = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_menu/');
		// IDS
		$ii = 0;
		while(!empty($arr_explore['link'][$ii])){
			if($arr_explore['link'][$ii] != 'index.html'){
				$explore_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_menu/'.$arr_explore['link'][$ii], 'r');
				$exp_type[$ii] = $explore_xml->read_value('type');
				
				if($exp_type[$ii] == 'link'){
					$arr_exp['name'][$ii] = $explore_xml->read_value('name');
					$arr_exp['id'][$ii]   = $explore_xml->read_value('id');
					$arr_exp['sub'][$ii]  = $explore_xml->read_value('subid');
					$arr_exp['link'][$ii] = $explore_xml->read_value('link');
					$arr_exp['type'][$ii] = $explore_xml->read_value('type');
					$arr_exp['pub'][$ii]  = $explore_xml->read_value('published');
					$arr_exp['uid'][$ii]  = substr($arr_explore['link'][$ii], 0, 5);
					
					$arr_exp['name'][$ii] = $tcms_main->decodeText($arr_exp['name'][$ii], '2', $c_charset);
				}
			}
			$ii++;
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix."sidemenu WHERE type = 'link'");
		
		$ii = 0;
		
		while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
			$exp_type[$ii] = $sqlARR['type'];
			if($exp_type[$ii] == NULL){ $exp_type[$ii] = ''; }
			
			$arr_exp['name'][$ii] = trim($sqlObj->name);
			$arr_exp['id'][$ii]   = trim($sqlObj->id);
			$arr_exp['sub'][$ii]  = trim($sqlObj->subid);
			$arr_exp['link'][$ii] = trim($sqlObj->link);
			$arr_exp['pub'][$ii]  = trim($sqlObj->published);
			$arr_exp['type'][$ii] = trim($sqlObj->type);
			$arr_exp['uid'][$ii]  = trim($sqlObj->uid);
			
			$arr_exp['name'][$ii] = $tcms_main->decodeText($arr_exp['name'][$ii], '2', $c_charset);
			
			$ii++;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	if(is_array($arr_exp)){
		array_multisort(
			$arr_exp['id'], SORT_ASC, SORT_REGULAR, 
			$arr_exp['sub'], SORT_ASC, SORT_REGULAR, 
			$arr_exp['link'], SORT_ASC, SORT_REGULAR, 
			$arr_exp['pub'], SORT_ASC, SORT_REGULAR, 
			$arr_exp['uid'], SORT_ASC, SORT_REGULAR, 
			$arr_exp['type'], SORT_ASC, SORT_REGULAR, 
			$arr_exp['name'], SORT_ASC, SORT_REGULAR
		);
	}
}





// -----------------------------------------------------
// TOPMENU ITEMS
// -----------------------------------------------------

if($topmenu_active == 1){
	if($choosenDB == 'xml'){
		$arr_explore['link'] = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_topmenu/');
		// IDS
		$iiT = 0;
		while(!empty($arr_explore['link'][$iiT])){
			if($arr_explore['link'][$iiT] != 'index.html'){
				$explore_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_topmenu/'.$arr_explore['link'][$iiT], 'r');
				
				$arr_expT['name'][$iiT] = $explore_xml->read_value('name');
				$arr_expT['id'][$iiT]   = $explore_xml->read_value('id');
				$arr_expT['link'][$iiT] = $explore_xml->read_value('link');
				$arr_expT['pub'][$iiT]  = $explore_xml->read_value('published');
				$arr_expT['type'][$iiT] = $explore_xml->read_value('type');
				$arr_expT['uid'][$iiT]  = substr($arr_explore['link'][$iiT], 0, 5);
				
				$arr_expT['name'][$iiT] = $tcms_main->decodeText($arr_expT['name'][$iiT], '2', $c_charset);
			}
			$iiT++;
		}
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'topmenu');
		
		$iiT = 0;
		
		while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
			$exp_type[$iiT] = $sqlARR['type'];
			if($exp_type[$iiT] == NULL){ $exp_type[$iiT] = ''; }
			
			$arr_expT['name'][$iiT] = trim($sqlObj->name);
			$arr_expT['id'][$iiT]   = trim($sqlObj->id);
			$arr_expT['link'][$iiT] = trim($sqlObj->link);
			$arr_expT['pub'][$iiT]  = trim($sqlObj->published);
			$arr_expT['type'][$iiT] = trim($sqlObj->type);
			$arr_expT['uid'][$iiT]  = trim($sqlObj->uid);
			
			$arr_expT['name'][$iiT] = $tcms_main->decodeText($arr_expT['name'][$iiT], '2', $c_charset);
			$iiT++;
		}
		
		$sqlAL->sqlFreeResult($sqlQR);
	}
	
	if(is_array($arr_expT)){
		array_multisort(
			$arr_expT['id'], SORT_ASC, SORT_REGULAR, 
			$arr_expT['link'], SORT_ASC, SORT_REGULAR, 
			$arr_expT['pub'], SORT_ASC, SORT_REGULAR, 
			$arr_expT['uid'], SORT_ASC, SORT_REGULAR, 
			$arr_expT['type'], SORT_ASC, SORT_REGULAR, 
			$arr_expT['name'], SORT_ASC, SORT_REGULAR
		);
	}
}





// -----------------------------------------------------
// CONTENT ITEMS
// -----------------------------------------------------

if(!isset($wpC)){ $wpC = 0; }

if($choosenDB == 'xml'){
	$arr_explore['main'] = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_content/');
	while(!empty($arr_explore['main'][$wpC])){
		if($arr_explore['main'][$wpC] != 'index.html'){
			$exploreC_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_content/'.$arr_explore['main'][$wpC], 'r');
			$arr_maint['title'][$wpC] = $exploreC_xml->read_value('title');
			$arr_maint['id'][$wpC]    = $exploreC_xml->read_value('id');
			$arr_maint['file'][$wpC]  = substr($arr_explore['main'][$wpC], 0, 5);
				
			$arr_maint['title'][$wpC] = $tcms_main->decodeText($arr_maint['title'][$wpC], '2', $c_charset);
		}
		$wpC++;
	}
}
else{
	$sqlAL = new sqlAbstractionLayer($choosenDB);
	$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
	
	$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'content');
	
	$count = 0;
	
	while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
		$arr_maint['title'][$wpC] = $sqlARR['title'];
		$arr_maint['id'][$wpC]    = $sqlARR['uid'];
		$arr_maint['file'][$wpC]  = $sqlARR['uid'];
		
		if($arr_maint['title'][$wpC] == NULL){ $arr_maint['title'][$wpC] = ''; }
		if($arr_maint['id'][$wpC] == NULL){ $arr_maint['id'][$wpC] = ''; }
		if($arr_maint['file'][$wpC] == NULL){ $arr_maint['file'][$wpC] = ''; }
			
		$arr_maint['title'][$wpC] = $tcms_main->decodeText($arr_maint['title'][$wpC], '2', $c_charset);
		
		$wpC++;
	}
	
	$sqlAL->sqlFreeResult($sqlQR);
}





// -----------------------------------------------------
// EXPLORE THE FILES
// -----------------------------------------------------

echo $tcms_html->tableHeadNoBorder('0', '0', '0', '200');



/*
	SIDEMENU
*/

echo '<tr><td style="height: 5px;"></td></tr>';

if($topmenu_active == 1){
	echo '<tr bgcolor="#ececec" height="25">';
	echo '<td valign="middle"><img style="padding: 1px 2px 0 3px;" align="left" src="../images/menu.png" border="0" /><strong style="font-size: 14px;">'
	.'<a style="font-size: 14px; color: #000;" href="admin.php?id_user='.$id_user.'&amp;site=mod_topmenu">'
	._TABLE_TOPMENU
	.'</a>'
	.'</strong></td></tr>';
	
	echo '<tr><td>&nbsp;'
	.'<a href="javascript: d.openAll();">'._TCMS_OPEN_ALL.'</a> | '
	.'<a href="javascript: d.closeAll();">'._TCMS_CLOSE_ALL.'</a>'
	.'<br />';
	
	echo '<div class="dtree">
	<script type="text/javascript">
	<!--
	d = new dTree(\'d\');
	-->
	d.add(0, -1, \''.$sitename.'\', \'admin.php?id_user='.$id_user.'&amp;site=mod_page\');
	';
	
	$iCounterPages = 1;
	$tbMod = false;
	
	if(is_array($arr_expT['id']) && !empty($arr_expT['id'])){
		foreach($arr_expT['id'] as $ekey => $evalue){
			$prjLink = '';
			
			// NEWS
			if($arr_expT['link'][$ekey] == $news_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_news';
				$tbMod = true;
			}
			
			// FRONTPAGE
			if($arr_expT['link'][$ekey] == $front_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_frontpage';
				$tbMod = true;
			}
			
			// IMPRESSUM
			if($arr_expT['link'][$ekey] == $imp_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_impressum';
				$tbMod = true;
			}
			
			// IMAGEGALLERY
			if($arr_expT['link'][$ekey] == $image_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_gallery';
				$tbMod = true;
			}
			
			// GUESTBOOK
			if($arr_expT['link'][$ekey] == $guest_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_extensions';
				$tbMod = true;
			}
			
			// CONTACT FORM
			if($arr_expT['link'][$ekey] == $cform_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_extensions';
				$tbMod = true;
			}
			
			// DOWNLOAD
			if($arr_expT['link'][$ekey] == $down_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_download';
				$tbMod = true;
			}
			
			// PRODUCTS
			if($arr_expT['link'][$ekey] == $pro_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_products';
				$tbMod = true;
			}
			
			// LINKS
			if($arr_expT['link'][$ekey] == $links_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_links';
				$tbMod = true;
			}
			
			// FAQ
			if($arr_expT['link'][$ekey] == $faq_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase';
				$tbMod = true;
			}
			
			// POLLS
			if($arr_expT['link'][$ekey] == 'polls') {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_poll';
				$tbMod = true;
			}
			
			// POLLS
			if($arr_expT['link'][$ekey] == 'search') {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_side_extensions';
				$tbMod = true;
			}
			
			// CS
			if(ereg($cs_id, $arr_expT['link'][$ekey])) {
				$_prjLink = str_replace('components&item=', '', $arr_expT['link'][$ekey]);
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=edit&amp;maintag='.$_prjLink;
				$tbMod = true;
			}
			
			// CONTENT
			if($tbMod == false){
				for($cMM = 0; $cMM < $wpC; $cMM++){
					if($arr_maint['id'][$cMM] == $arr_expT['link'][$ekey]){
						if($arr_expT['type'][$ekey] == 'web'){
							$prjLink = $arr_expT['link'][$ekey];
						}
						else{
							$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&amp;maintag='.$arr_expT['link'][$ekey];
						}
					}
					else{
						if($arr_expT['type'][$ekey] == 'web'){
							$prjLink = $arr_expT['link'][$ekey];
						}
						else{
							$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&amp;maintag='.$arr_expT['link'][$ekey];
						}
					}
				}
			}
			
			
			echo 'd.add('.$iCounterPages.', 0, \''.$arr_expT['name'][$ekey].'\', \''.$prjLink.'\');'.chr(13);
			
			$iCounterPages++;
			$tbMod = false;
		}
	}
	
	echo '
	document.write(d);
	//-->
	</script>
	</div>
	</td></tr>';
}



/*
	SIDEMENU
*/

echo '<tr><td style="height: 5px;"></td></tr>';

if($sidemenu_active == 1){
	echo '<tr bgcolor="#ececec" height="25">';
	echo '<td valign="middle"><img style="padding: 1px 2px 0 3px;" align="left" src="../images/menu.png" border="0" /><strong style="font-size: 14px;">'
	.'<a style="font-size: 14px; color: #000;" href="admin.php?id_user='.$id_user.'&amp;site=mod_sidemenu">'
	._TABLE_SIDEMENU
	.'</a>'
	.'</strong></td></tr>';
	
	echo '<tr><td>&nbsp;'
	.'<a href="javascript: d2.openAll();">'._TCMS_OPEN_ALL.'</a> | '
	.'<a href="javascript: d2.closeAll();">'._TCMS_CLOSE_ALL.'</a>'
	.'<br />';
	
	echo '<div class="dtree">
	<script type="text/javascript">
	<!--
	d2 = new dTree(\'d2\');
	d2.add(0, -1, \''.$sitename.'\', \'admin.php?id_user='.$id_user.'&amp;site=mod_page\');
	';
	
	$iCounterPages = 1;
	$iSub = 1;
	$tbMod = false;
	
	if(is_array($arr_exp['id']) && !empty($arr_exp['id'])){
		foreach($arr_exp['id'] as $ekey => $evalue){
			$prjLink = '';
			$tmpPage = $iCounterPages;
			
			// NEWS
			if($arr_exp['link'][$ekey] == $news_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_news';
				$tbMod = true;
			}
			
			// FRONTPAGE
			if($arr_exp['link'][$ekey] == $front_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_frontpage';
				$tbMod = true;
			}
			
			// IMPRESSUM
			if($arr_exp['link'][$ekey] == $imp_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_impressum';
				$tbMod = true;
			}
			
			// IMAGEGALLERY
			if($arr_exp['link'][$ekey] == $image_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_gallery';
				$tbMod = true;
			}
			
			// GUESTBOOK
			if($arr_exp['link'][$ekey] == $guest_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_extensions';
				$tbMod = true;
			}
			
			// CONTACT FORM
			if($arr_exp['link'][$ekey] == $cform_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_extensions';
				$tbMod = true;
			}
			
			// DOWNLOAD
			if($arr_exp['link'][$ekey] == $down_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_download';
				$tbMod = true;
			}
			
			// PRODUCTS
			if($arr_exp['link'][$ekey] == $pro_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_products';
				$tbMod = true;
			}
			
			// LINKS
			if($arr_exp['link'][$ekey] == $links_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_links';
				$tbMod = true;
			}
			
			// FAQ
			if($arr_exp['link'][$ekey] == $faq_id) {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase';
				$tbMod = true;
			}
			
			// POLLS
			if($arr_exp['link'][$ekey] == 'polls') {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_poll';
				$tbMod = true;
			}
			
			// POLLS
			if($arr_exp['link'][$ekey] == 'search') {
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_side_extensions';
				$tbMod = true;
			}
			
			// CS
			if(ereg($cs_id, $arr_exp['link'][$ekey])) {
				//$prjLink = $arr_exp['link'][$ekey];
				$_prjLink = str_replace('components&item=', '', $arr_exp['link'][$ekey]);
				$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_components&amp;todo=edit&amp;maintag='.$_prjLink;
				$tbMod = true;
			}
			
			// CONTENT
			if($tbMod == false){
				for($cMM = 0; $cMM < $wpC; $cMM++){
					if($arr_maint['id'][$cMM] == $arr_exp['link'][$ekey]){
						if($arr_exp['type'][$ekey] == 'web'){
							$prjLink = $arr_exp['link'][$ekey];
						}
						else{
							$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&amp;maintag='.$arr_exp['link'][$ekey];
						}
					}
					else{
						if($arr_exp['type'][$ekey] == 'web'){
							$prjLink = $arr_exp['link'][$ekey];
						}
						else{
							$prjLink = 'admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&amp;maintag='.$arr_exp['link'][$ekey];
						}
					}
				}
			}
			
			
			if($arr_exp['sub'][$ekey] == '-'){
				$iCounterPages++;
				
				echo 'd2.add('.$iCounterPages.', 0, \''.$arr_exp['name'][$ekey].'\', \''.$prjLink.'\');'.chr(13);
				
				$iSub = 1;
			}
			else {
				echo 'd2.add('.$iSub.', '.$iCounterPages.', \''.$arr_exp['name'][$ekey].'\', \''.$prjLink.'\');'.chr(13);
				
				$iSub++;
			}
			
			
			$tbMod = false;
		}
	}
	
	echo '
	document.write(d2);
	//-->
	</script>
	</div>
	</td></tr>';
}








/*


echo '<tr><td style="height: 5px;"></td></tr>';

if($topmenu_active == 1){
	echo '<tr bgcolor="#ececec" height="25">';
	echo '<td valign="middle"><img style="padding: 1px 2px 0 3px;" align="left" src="../images/menu.png" border="0" /><strong style="font-size: 14px;">'
	.'<a style="font-size: 14px; color: #000;" href="admin.php?id_user='.$id_user.'&amp;site=mod_topmenu">'
	._TABLE_TOPMENU
	.'</a>'
	.'</strong></td></tr>';
	
	echo '<tr><td style="height: 5px;"></td></tr>';
	
	echo '<tr class="tcms_explorer" bgcolor="#ececec">';
	echo '<td valign="middle"><img align="left" src="../images/explore/folder.gif" border="0" />
	&nbsp;<a href="admin.php?id_user='.$id_user.'&amp;site=mod_page">'.$sitename.'</a></td></tr>';
	
	//
	// Filemanager Init
	//
	$bg_f_01 = 'background="../images/explore/i.gif" style="background-repeat: repeat-y;"';
	
	if(is_array($arr_expT['id']) && !empty($arr_expT['id'])){
		foreach($arr_expT['id'] as $ekey => $evalue){
			if(is_integer($tbgz/2)){ $ws_color = 0; }else{ $ws_color = 1; }
			
			
			
			//*********************
			// MAINCONTENT
			//
			
			if($arr_expT['pub'][$ekey] == 1){ $fm_color = '333333'; }
			else{ $fm_color = 'ff0000'; }
			
			// NEWS
			if($arr_expT['link'][$ekey] == $news_id){
				$twp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_news">'.$arr_expT['name'][$ekey].'</a>';
				$tbMod = true;
			}
			
			// FRONTPAGE
			if($arr_expT['link'][$ekey] == $front_id){
				$twp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_frontpage">'.$arr_expT['name'][$ekey].'</a>';
				$tbMod = true;
			}
			
			// IMPRESSUM
			if($arr_expT['link'][$ekey] == $imp_id){
				$twp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_impressum">'.$arr_expT['name'][$ekey].'</a>';
				$tbMod = true;
			}
			
			// IMAGEGALLERY
			if($arr_expT['link'][$ekey] == $image_id){
				$twp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_gallery">'.$arr_expT['name'][$ekey].'</a>';
				$tbMod = true;
			}
			
			// GUESTBOOK
			if($arr_expT['link'][$ekey] == $guest_id){
				$twp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_extensions">'.$arr_expT['name'][$ekey].'</a>';
				$tbMod = true;
			}
			
			// CONTACT FORM
			if($arr_expT['link'][$ekey] == $cform_id){
				$twp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_extensions">'.$arr_expT['name'][$ekey].'</a>';
				$tbMod = true;
			}
			
			// DOWNLOAD
			if($arr_expT['link'][$ekey] == $down_id){
				$twp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_download">'.$arr_expT['name'][$ekey].'</a>';
				$tbMod = true;
			}
			
			// PRODUCTS
			if($arr_expT['link'][$ekey] == $pro_id){
				$twp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_products">'.$arr_expT['name'][$ekey].'</a>';
				$tbMod = true;
			}
			
			// LINKS
			if($arr_expT['link'][$ekey] == $links_id){
				$twp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_links">'.$arr_expT['name'][$ekey].'</a>';
				$tbMod = true;
			}
			
			// FAQ
			if($arr_expT['link'][$ekey] == $faq_id){
				$twp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase">'.$arr_expT['name'][$ekey].'</a>';
				$tbMod = true;
			}
			
			// CS
			if(ereg($cs_id, $arr_expT['link'][$ekey])){
				$twp_link = '<span style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'">'.$arr_expT['name'][$ekey].'</span>';
				$tbMod = true;
			}
			
			// CONTENT
			if($tbMod == false){
				for($cMM = 0; $cMM < $wpC; $cMM++){
					if($arr_maint['id'][$cMM] == $arr_expT['link'][$ekey]){
						if($arr_expT['type'][$ekey] == 'web'){
							$twp_link = '<span style="color: #'.$fm_color.'; font-size: 11px;" title="id = '.$arr_expT['link'][$ekey].'">'
							.$arr_expT['name'][$ekey]
							.'&nbsp;(&nbsp;'
							.'<a target="_blank" style="color: #'.$fm_color.'; font-size: 11px;" title="id = '.$arr_expT['link'][$ekey].'" href="'.$arr_expT['link'][$ekey].'">'
							.'<img src="../images/link_to.gif" border="0" /></a>)'
							.'</span>';
						}
						else{
							$twp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&amp;maintag='.$arr_expT['link'][$ekey].'">'
							.$arr_expT['name'][$ekey]
							.'</a>';
						}
					}
					else{
						if($arr_expT['type'][$ekey] == 'web'){
							$twp_link = '<span style="color: #'.$fm_color.'; font-size: 11px;" title="id = '.$arr_expT['link'][$ekey].'">'
							.$arr_expT['name'][$ekey]
							.'&nbsp;(&nbsp;'
							.'<a target="_blank" style="color: #'.$fm_color.'; font-size: 11px;" title="id = '.$arr_expT['link'][$ekey].'" href="'.$arr_expT['link'][$ekey].'">'
							.'<img src="../images/link_to.gif" border="0" /></a>)'
							.'</span>';
						}
						else{
							$twp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_expT['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&amp;maintag='.$arr_expT['link'][$ekey].'">'
							.$arr_expT['name'][$ekey]
							.'</a>';
						}
					}
				}
			}
			
			//
			//
			//*********************
			
			
			
			
			//*********************
			// PAGES/LINKS
			//
			
			echo '<tr height="'.$fm_height.'" style="height: '.$fm_height.'px;" class="tcms_explorer" bgcolor="'.$arr_color[$ws_color].'">';
			
			$tis_end = end($arr_expT['id']);
			$tis_end2 = end($arr_expT['id']);
			
			echo '<td width="80%" valign="top"'.( $evalue == $news_id ? $bg_f_01 : '' ).'><img align="left" src="../images/explore/';
			if($evalue == $tis_end){
				if($tcheckEnd == false){ echo 'l'; $tcheckEnd = true; }
				else{ echo 'px'; }
			}
			else{
				echo 't';
			}
			echo '.gif" border="0" />';
			
			if($arr_expT['pub'][$ekey] == 1){
				echo '<a title="'._TABLE_DISABLED_THIS.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_topmenu&amp;todo=publishItem&amp;action=off&amp;maintag='.$arr_expT['uid'][$ekey].'">';
				echo '<img align="left" src="../images/explore/html.gif" border="0" />';
				echo '</a>';
			}
			else{
				echo '<a title="'._TABLE_ENABLED_THIS.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_topmenu&amp;todo=publishItem&amp;action=on&amp;maintag='.$arr_expT['uid'][$ekey].'">';
				echo '<img align="left" src="../images/explore/html_closed.gif" border="0" />';
				echo '</a>';
			}
			
			echo '&nbsp;'.$twp_link;
			
			echo '</td>';
			
			//
			//
			//*********************
			
			
			
			
			echo '</tr>';
			
			$tbgz++;
			$tfm_menu++;
			$tbMod = false;
		}
	}
	
	echo '<tr><td style="height: 25px;"></td></tr>';
	
	
	unset($ekey);
	unset($evalue);
}










if($sidemenu_active == 1){
	echo '<tr bgcolor="#ececec" height="25">';
	echo '<td valign="middle"><img style="padding: 1px 2px 0 3px;" align="left" src="../images/menu.png" border="0" /><strong style="font-size: 14px;">'
	.'<a style="font-size: 14px; color: #000;" href="admin.php?id_user='.$id_user.'&amp;site=mod_sidemenu">'
	._TABLE_SIDEMENU
	.'</a>'
	.'</strong></td></tr>';
	
	echo '<tr><td style="height: 5px;"></td></tr>';
	
	echo '<tr class="tcms_explorer" bgcolor="#ececec">';
	echo '<td valign="middle"><img align="left" src="../images/explore/folder.gif" border="0" />
	&nbsp;<a href="admin.php?id_user='.$id_user.'&amp;site=mod_page">'.$sitename.'</a></td></tr>';
	
	//
	// Filemanager Init
	//
	$bg_f_01 = 'background="../images/explore/i.gif" style="background-repeat: repeat-y;"';
	
	if(is_array($arr_exp['id']) && !empty($arr_exp['id'])){
		foreach($arr_exp['id'] as $ekey => $evalue){
			if(is_integer($bgz/2)){ $ws_color = 0; }else{ $ws_color = 1; }
			
			
			
			//*********************
			// MAINCONTENT
			//
			
			if($arr_exp['pub'][$ekey] == 1){ $fm_color = '333333'; }
			else{ $fm_color = 'ff0000'; }
			
			// NEWS
			if($arr_exp['link'][$ekey] == $news_id){
				$wp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_news">'.$arr_exp['name'][$ekey].'</a>';
				$bMod = true;
			}
			
			// FRONTPAGE
			if($arr_exp['link'][$ekey] == $front_id){
				$wp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_frontpage">'.$arr_exp['name'][$ekey].'</a>';
				$bMod = true;
			}
			
			// IMPRESSUM
			if($arr_exp['link'][$ekey] == $imp_id){
				$wp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_impressum">'.$arr_exp['name'][$ekey].'</a>';
				$bMod = true;
			}
			
			// IMAGEGALLERY
			if($arr_exp['link'][$ekey] == $image_id){
				$wp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_gallery">'.$arr_exp['name'][$ekey].'</a>';
				$bMod = true;
			}
			
			// GUESTBOOK
			if($arr_exp['link'][$ekey] == $guest_id){
				$wp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_extensions">'.$arr_exp['name'][$ekey].'</a>';
				$bMod = true;
			}
			
			// CONTACT FORM
			if($arr_exp['link'][$ekey] == $cform_id){
				$wp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_extensions">'.$arr_exp['name'][$ekey].'</a>';
				$bMod = true;
			}
			
			// DOWNLOAD
			if($arr_exp['link'][$ekey] == $down_id){
				$wp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_download">'.$arr_exp['name'][$ekey].'</a>';
				$bMod = true;
			}
			
			// PRODUCTS
			if($arr_exp['link'][$ekey] == $pro_id){
				$wp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_products">'.$arr_exp['name'][$ekey].'</a>';
				$bMod = true;
			}
			
			// LINKS
			if($arr_exp['link'][$ekey] == $links_id){
				$wp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_links">'.$arr_exp['name'][$ekey].'</a>';
				$bMod = true;
			}
			
			// FAQ
			if($arr_exp['link'][$ekey] == $faq_id){
				$wp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_knowledgebase">'.$arr_exp['name'][$ekey].'</a>';
				$bMod = true;
			}
			
			// CS
			if(ereg($cs_id, $arr_exp['link'][$ekey])){
				$wp_link = '<span style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'">'.$arr_exp['name'][$ekey].'</span>';
				$bMod = true;
			}
			
			// CONTENT
			if($bMod == false){
				for($cMM = 0; $cMM < $wpC; $cMM++){
					if($arr_maint['id'][$cMM] == $arr_exp['link'][$ekey]){
						if($arr_exp['type'][$ekey] == 'web'){
							$wp_link = '<span style="color: #'.$fm_color.'; font-size: 11px;" title="id = '.$arr_exp['link'][$ekey].'">'
							.$arr_exp['name'][$ekey]
							.'&nbsp;(&nbsp;'
							.'<a target="_blank" style="color: #'.$fm_color.'; font-size: 11px;" title="id = '.$arr_exp['link'][$ekey].'" href="'.$arr_exp['link'][$ekey].'">'
							.'<img src="../images/link_to.gif" border="0" /></a>)'
							.'</span>';
						}
						else{
							$wp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&amp;maintag='.$arr_exp['link'][$ekey].'">'
							.$arr_exp['name'][$ekey]
							.'</a>';
						}
					}
					else{
						if($arr_exp['type'][$ekey] == 'web'){
							$wp_link = '<span style="color: #'.$fm_color.'; font-size: 11px;" title="id = '.$arr_exp['link'][$ekey].'">'
							.$arr_exp['name'][$ekey]
							.'&nbsp;(&nbsp;'
							.'<a target="_blank" style="color: #'.$fm_color.'; font-size: 11px;" title="id = '.$arr_exp['link'][$ekey].'" href="'.$arr_exp['link'][$ekey].'">'
							.'<img src="../images/link_to.gif" border="0" /></a>)'
							.'</span>';
						}
						else{
							$wp_link = '<a style="color: #'.$fm_color.';" title="id = '.$arr_exp['link'][$ekey].'" href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&amp;maintag='.$arr_exp['link'][$ekey].'">'
							.$arr_exp['name'][$ekey]
							.'</a>';
						}
					}
				}
			}
			
			//
			//
			//*********************
			
			
			
			
			//*********************
			// PAGES/LINKS
			//
			
			echo '<tr height="'.$fm_height.'" style="height: '.$fm_height.'px;" class="tcms_explorer" bgcolor="'.$arr_color[$ws_color].'">';
			
			$is_end = end($arr_exp['id']);
			$is_end2 = end($arr_exp['id']);
			
			echo '<td width="80%" valign="top"'.( $evalue == $news_id ? $bg_f_01 : '' ).'><img align="left" src="../images/explore/';
			if($evalue == $is_end){
				if($checkEnd == false){ echo 'l'; $checkEnd = true; }
				else{ echo 'px'; }
			}
			else{
				if($arr_exp['sub'][$ekey] == '-'){ echo 't'; }
				else{ echo 'i'; }
			}
			echo '.gif" border="0" />';
			
			if($arr_exp['sub'][$ekey] != '-'){
				echo '<img align="left" src="../images/explore/';
				if($arr_exp['sub'][$ekey + 1] == '-'){ echo 'l'; }
				else{
					if(array_key_exists(($ekey + 1), $arr_exp['id'])){ echo 't'; }
					else{ echo 'l'; }
				}
				echo '.gif" border="0" />';
			}
			
			if($arr_exp['pub'][$ekey] == 1){
				echo '<a title="'._TABLE_DISABLED_THIS.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_sidemenu&amp;todo=publishItem&amp;action=off&amp;maintag='.$arr_exp['uid'][$ekey].'">';
				echo '<img align="left" src="../images/explore/html.gif" border="0" />';
				echo '</a>';
			}
			else{
				echo '<a title="'._TABLE_ENABLED_THIS.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_sidemenu&amp;todo=publishItem&amp;action=on&amp;maintag='.$arr_exp['uid'][$ekey].'">';
				echo '<img align="left" src="../images/explore/html_closed.gif" border="0" />';
				echo '</a>';
			}
			
			echo '&nbsp;'.$wp_link;
			
			echo '</td>';
			
			//
			//
			//*********************
			
			
			
			
			echo '</tr>';
			
			$bgz++;
			$fm_menu++;
			$bMod = false;
		}
	}
}



*/

echo $tcms_html->tableEnd()
.'<br />';


?>
