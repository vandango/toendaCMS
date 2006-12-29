<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Extensions: Sidebar
|
| File:		mod_side_extensions.php
| Version:	0.3.8
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');







if(isset($_GET['action'])){ $action = $_GET['action']; }

if(isset($_POST['_RELOCATE'])){ $_RELOCATE = $_POST['_RELOCATE']; }
if(isset($_POST['new_sidemenu_title'])){ $new_sidemenu_title = $_POST['new_sidemenu_title']; }
if(isset($_POST['sidemenu'])){ $sidemenu = $_POST['sidemenu']; }
if(isset($_POST['sidebar_title'])){ $sidebar_title = $_POST['sidebar_title']; }
if(isset($_POST['show_sbt'])){ $show_sbt = $_POST['show_sbt']; }
if(isset($_POST['chooser_title'])){ $chooser_title = $_POST['chooser_title']; }
if(isset($_POST['show_ct'])){ $show_ct = $_POST['show_ct']; }
if(isset($_POST['search_title'])){ $search_title = $_POST['search_title']; }
if(isset($_POST['show_st'])){ $show_st = $_POST['show_st']; }
if(isset($_POST['new_search_align'])){ $new_search_align = $_POST['new_search_align']; }
if(isset($_POST['search_br'])){ $search_br = $_POST['search_br']; }
if(isset($_POST['search_button'])){ $search_button = $_POST['search_button']; }
if(isset($_POST['search_word'])){ $search_word = $_POST['search_word']; }
if(isset($_POST['login_title'])){ $login_title = $_POST['login_title']; }
if(isset($_POST['nologin'])){ $nologin = $_POST['nologin']; }
if(isset($_POST['reg_link'])){ $reg_link = $_POST['reg_link']; }
if(isset($_POST['reg_user'])){ $reg_user = $_POST['reg_user']; }
if(isset($_POST['reg_pass'])){ $reg_pass = $_POST['reg_pass']; }
if(isset($_POST['register'])){ $register = $_POST['register']; }
if(isset($_POST['usermenu'])){ $usermenu = $_POST['usermenu']; }
if(isset($_POST['show_lt'])){ $show_lt = $_POST['show_lt']; }
if(isset($_POST['new_usermenu_title'])){ $new_usermenu_title = $_POST['new_usermenu_title']; }
if(isset($_POST['new_ncamount_show'])){ $new_ncamount_show = $_POST['new_ncamount_show']; }
if(isset($_POST['new_show_ml'])){ $new_show_ml = $_POST['new_show_ml']; }

if(isset($_POST['sidebar'])){ $sidebar = $_POST['sidebar']; }
if(isset($_POST['login'])){ $login = $_POST['login']; }
if(isset($_POST['chooser'])){ $chooser = $_POST['chooser']; }
if(isset($_POST['tmp_use_poll_s'])){ $tmp_use_poll_s = $_POST['tmp_use_poll_s']; }
if(isset($_POST['use_nl'])){ $use_nl = $_POST['use_nl']; }
if(isset($_POST['search'])){ $search = $_POST['search']; }
if(isset($_POST['new_use_feeds'])){ $new_use_feeds = $_POST['new_use_feeds']; }
if(isset($_POST['new_link_use_side'])){ $new_link_use_side = $_POST['new_link_use_side']; }
if(isset($_POST['new_side_gallery'])){ $new_side_gallery = $_POST['new_side_gallery']; }
if(isset($_POST['new_news_cat_show'])){ $new_news_cat_show = $_POST['new_news_cat_show']; }
if(isset($_POST['new_use_side_archives'])){ $new_use_side_archives = $_POST['new_use_side_archives']; }









if($id_group == 'Developer' || $id_group == 'Administrator'){
	if(!isset($action)){ $action = 'modules'; }
	
	echo '<script>
	var CHANGED = false;
	var RELOCATE = false;
	
	function checkChanges(target){
		if(CHANGED){
			var confirmSave = confirm("'._MSG_CHANGES.'\n'._MSG_SAVE_NOW.'");
			
			if(confirmSave == false){
				RELOCATE = false;
				document.getElementById(\'_RELOCATE\').value = \'0\';
				document.location = \'admin.php?id_user='.$id_user.'&site=mod_side_extensions&action=\' + target;
			}
			else{
				RELOCATE = true;
				document.getElementById(\'_RELOCATE\').value = \'1\';
				save();
			}
		}
		else{
			RELOCATE = false;
			document.getElementById(\'_RELOCATE\').value = \'0\';
			document.location = \'admin.php?id_user='.$id_user.'&site=mod_side_extensions&action=\' + target;
		}
	}
	</script>';
	
	echo '<div style="display: block; width: 100%; border-bottom: 1px solid #ccc; padding-bottom: 2px; margin: 10px 0 0 0;">'
	.'<div style="display: block; width: 30px; float: left;">&nbsp;</div>'
	.'<a'.( $action == 'modules' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' onclick="checkChanges(\'modules\');" href="#">'._SIDEEXT_MODUL.'</a>'
	.'<a'.( $action == 'settings' ? ' class="tcms_tabA"' : ' class="tcms_tab"' ).' onclick="checkChanges(\'settings\');" href="#">'._TABLE_SETTINGS.'</a>'
	.'</div>';
	
	echo '<div class="tcms_tabPage"><br />';
	
	
	
	
	
	
	
	
	
	
	if($action == 'modules'){
		//=====================================================
		//	INIT
		//=====================================================
		
		$xmlActive = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/modules.xml','r');
		
		$arrASM['use_side_gallery']   = $xmlActive->read_section('config', 'side_gallery');
		$arrASM['use_layout_chooser'] = $xmlActive->read_section('config', 'layout_chooser');
		$arrASM['use_side_links']     = $xmlActive->read_section('config', 'side_links');
		$arrASM['use_login']          = $xmlActive->read_section('config', 'login');
		$arrASM['use_side_category']  = $xmlActive->read_section('config', 'side_category');
		$arrASM['use_side_archives']  = $xmlActive->read_section('config', 'side_archives');
		$arrASM['use_syndication']    = $xmlActive->read_section('config', 'syndication');
		$arrASM['use_newsletter']     = $xmlActive->read_section('config', 'newsletter');
		$arrASM['use_search']         = $xmlActive->read_section('config', 'search');
		$arrASM['use_sidebar']        = $xmlActive->read_section('config', 'sidebar');
		$arrASM['use_poll']           = $xmlActive->read_section('config', 'poll');
		
		
		
		
		// BEGIN FORM
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_side_extensions" method="post">'
		.'<input name="todo" type="hidden" value="save_modules" />'
		.'<input name="_RELOCATE" id="_RELOCATE" type="hidden" value="0" />';
		
		
		// TABLE FOR OUTPUT AND INPUT
		echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// table title
		echo '<tr><td colspan="2" class="tcms_db_title tcms_bg_blue_01 tcms_padding_mini"><strong>'._SIDEEXT_MODUL.'</strong></td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250">'._GALLERY_LAST_SHOW.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="new_side_gallery"'.( $arrASM['use_side_gallery'] == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_TC_SHOW.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="chooser"'.( $arrASM['use_layout_chooser'] == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="250">'._LINK_USE_SIDELINKS.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="new_link_use_side"'.( $arrASM['use_side_links'] == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_LOGIN_SHOW.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="login" '.( $arrASM['use_login'] == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_NEWS_CATEGORIES_SHOW.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="new_news_cat_show" '.( $arrASM['use_side_category'] == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_NEWS_ARCHIVES_SHOW.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="new_use_side_archives" '.( $arrASM['use_side_archives'] == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._EXT_NEWS_USE_FEEDS.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="new_use_feeds" '.( $arrASM['use_syndication'] == 1 ? 'checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._NL_SHOW.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="use_nl"'.( $arrASM['use_newsletter'] == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_SEARCH_SHOW.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="search"'.( $arrASM['use_search'] == 1 ? ' checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_SIDEBAR_SHOW.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="sidebar" '.( $arrASM['use_sidebar'] == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._POLL_SHOW.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="tmp_use_poll_s" '.( $arrASM['use_poll'] == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// Table end
		echo '</table><br />';
		
		echo '</form>';
	}
	
	
	
	
	
	
	
	
	
	
	if($action == 'settings'){
		//=====================================================
		//	INIT
		//=====================================================
		if($choosenDB == 'xml'){
			$layout_xml         = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/sidebar.xml','r');
			$tmp_sidemenu_title = $layout_xml->read_section('side', 'sidemenu_title');
			$tmp_sidemenu       = $layout_xml->read_section('side', 'sidemenu');
			$tmp_sidebar_title  = $layout_xml->read_section('side', 'sidebar_title');
			$tmp_show_sbt       = $layout_xml->read_section('side', 'show_sidebar_title');
			$tmp_chooser_title  = $layout_xml->read_section('side', 'chooser_title');
			$tmp_show_ct        = $layout_xml->read_section('side', 'show_chooser_title');
			$tmp_search_title   = $layout_xml->read_section('side', 'search_title');
			$tmp_show_st        = $layout_xml->read_section('side', 'show_search_title');
			$tmp_search_ali     = $layout_xml->read_section('side', 'search_alignment');
			$tmp_search_br      = $layout_xml->read_section('side', 'search_withbr');
			$tmp_search_button  = $layout_xml->read_section('side', 'search_withbutton');
			$tmp_search_word    = $layout_xml->read_section('side', 'search_word');
			$tmp_login_title    = $layout_xml->read_section('side', 'login_title');
			$tmp_usermenu_title = $layout_xml->read_section('side', 'usermenu_title');
			$tmp_nologin        = $layout_xml->read_section('side', 'nologin');
			$tmp_reg_link       = $layout_xml->read_section('side', 'reg_link');
			$tmp_reg_user       = $layout_xml->read_section('side', 'reg_user');
			$tmp_reg_pass       = $layout_xml->read_section('side', 'reg_pass');
			$tmp_register       = $layout_xml->read_section('side', 'login_user');
			$tmp_usermenu       = $layout_xml->read_section('side', 'usermenu');
			$tmp_show_lt        = $layout_xml->read_section('side', 'show_login_title');
			$tmp_ncamount_show  = $layout_xml->read_section('side', 'show_news_cat_amount');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidebar_extensions', 'sidebar_extensions');
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$tmp_sidemenu_title = $sqlARR['sidemenu_title'];
			$tmp_sidemenu       = $sqlARR['sidemenu'];
			$tmp_sidebar_title  = $sqlARR['sidebar_title'];
			$tmp_show_sbt       = $sqlARR['show_sidebar_title'];
			$tmp_chooser_title  = $sqlARR['chooser_title'];
			$tmp_show_ct        = $sqlARR['show_chooser_title'];
			$tmp_search_title   = $sqlARR['search_title'];
			$tmp_show_st        = $sqlARR['show_search_title'];
			$tmp_search_ali     = $sqlARR['search_alignment'];
			$tmp_search_br      = $sqlARR['search_withbr'];
			$tmp_search_button  = $sqlARR['search_withbutton'];
			$tmp_search_word    = $sqlARR['search_word'];
			$tmp_login_title    = $sqlARR['login_title'];
			$tmp_usermenu_title = $sqlARR['usermenu_title'];
			$tmp_nologin        = $sqlARR['nologin'];
			$tmp_reg_link       = $sqlARR['reg_link'];
			$tmp_reg_user       = $sqlARR['reg_user'];
			$tmp_reg_pass       = $sqlARR['reg_pass'];
			$tmp_register       = $sqlARR['login_user'];
			$tmp_usermenu       = $sqlARR['usermenu'];
			$tmp_show_lt        = $sqlARR['show_login_title'];
			$tmp_ncamount_show  = $sqlARR['show_news_cat_amount'];
			$tmp_show_ml        = $sqlARR['show_memberlist'];
			
			if($tmp_sidemenu_title == NULL){ $tmp_sidemenu_title = ''; }
			if($tmp_sidemenu       == NULL){ $tmp_sidemenu       = ''; }
			if($tmp_sidebar_title  == NULL){ $tmp_sidebar_title  = ''; }
			if($tmp_show_sbt       == NULL){ $tmp_show_sbt       = ''; }
			if($tmp_chooser_title  == NULL){ $tmp_chooser_title  = ''; }
			if($tmp_show_ct        == NULL){ $tmp_show_ct        = ''; }
			if($tmp_search_title   == NULL){ $tmp_search_title   = ''; }
			if($tmp_show_st        == NULL){ $tmp_show_st        = 0; }
			if($tmp_search_ali     == NULL){ $tmp_search_ali     = ''; }
			if($tmp_search_br      == NULL){ $tmp_search_br      = ''; }
			if($tmp_search_button  == NULL){ $tmp_search_button  = ''; }
			if($tmp_search_word    == NULL){ $tmp_search_word    = ''; }
			if($tmp_login_title    == NULL){ $tmp_login_title    = ''; }
			if($tmp_usermenu_title == NULL){ $tmp_usermenu_title = ''; }
			if($tmp_nologin        == NULL){ $tmp_nologin        = ''; }
			if($tmp_reg_link       == NULL){ $tmp_reg_link       = ''; }
			if($tmp_reg_user       == NULL){ $tmp_reg_user       = ''; }
			if($tmp_reg_pass       == NULL){ $tmp_reg_pass       = ''; }
			if($tmp_register       == NULL){ $tmp_register       = ''; }
			if($tmp_usermenu       == NULL){ $tmp_usermenu       = ''; }
			if($tmp_show_lt        == NULL){ $tmp_show_lt        = ''; }
			if($tmp_ncamount_show  == NULL){ $tmp_ncamount_show  = 0; }
			if($tmp_show_ml        == NULL){ $tmp_show_ml        = ''; }
		}
		
		// CHARSETS
		$tmp_sidemenu_title = $tcms_main->decodeText($tmp_sidemenu_title, '2', $c_charset);
		$tmp_sidebar_title  = $tcms_main->decodeText($tmp_sidebar_title, '2', $c_charset);
		$tmp_chooser_title  = $tcms_main->decodeText($tmp_chooser_title, '2', $c_charset);
		$tmp_search_title   = $tcms_main->decodeText($tmp_search_title, '2', $c_charset);
		$tmp_login_title    = $tcms_main->decodeText($tmp_login_title, '2', $c_charset);
		$tmp_usermenu_title = $tcms_main->decodeText($tmp_usermenu_title, '2', $c_charset);
		$tmp_nologin        = $tcms_main->decodeText($tmp_nologin, '2', $c_charset);
		$tmp_reg_link       = $tcms_main->decodeText($tmp_reg_link, '2', $c_charset);
		$tmp_reg_user       = $tcms_main->decodeText($tmp_reg_user, '2', $c_charset);
		$tmp_reg_pass       = $tcms_main->decodeText($tmp_reg_pass, '2', $c_charset);
		$tmp_search_word    = $tcms_main->decodeText($tmp_search_word, '2', $c_charset);
		
		
		
		
		
		
		
		
		// BEGIN FORM
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_side_extensions" method="post">'
		.'<input name="todo" type="hidden" value="save" />'
		.'<input name="_RELOCATE" id="_RELOCATE" type="hidden" value="0" />';
		
		
		// TABLE FOR OUTPUT AND INPUT
		echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// table title
		echo '<tr><td colspan="2" class="tcms_db_title tcms_bg_blue_01 tcms_padding_mini"><strong>'._SIDEEXT_SIDEMENU.'</strong></td></tr>';
		
		
		// rows
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_SIDEMENU_TITLE.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" name="new_sidemenu_title" class="tcms_input_normal" value="'.$tmp_sidemenu_title.'" />'
		.'</td></tr>';
		
		
		// rows
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_SIDEMENU_SHOW.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" vspace="4" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="sidemenu" '.($tmp_sidemenu==1?'checked':'').' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr height: 28px;"><td colspan="2">&nbsp;</td></tr>';
		
		
		// row
		echo '<tr><td colspan="2" class="tcms_db_title tcms_bg_blue_01 tcms_padding_mini"><strong>'._SIDEEXT_NEWS.'</strong></td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_NEWS_CATEGORIES_AMOUNT_SHOW.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="new_ncamount_show" '.( $tmp_ncamount_show == 1 ? 'checked' : '' ).' value="1" />';
		
		if($choosenDB == 'xml'){ echo '<span style="color: #ff0000;">ATTENTION! I\'ts currently very slow with the XML Database.</span>'; }
		
		echo '</td></tr>';
		
		
		// row
		echo '<tr height: 28px;"><td colspan="2">&nbsp;</td></tr>';
		
		
		// row
		echo '<tr><td colspan="2" class="tcms_db_title tcms_bg_blue_01 tcms_padding_mini"><strong>'._SIDEEXT_SIDEBAR.'</strong></td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_SIDEBAR_TITLE.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" name="sidebar_title" class="tcms_input_normal" value="'.$tmp_sidebar_title.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_SIDEBAR_SHOW_TITLE.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="show_sbt" '.( $tmp_show_sbt == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr height: 28px;"><td colspan="2">&nbsp;</td></tr>';
		
		
		// row
		echo '<tr><td colspan="2" class="tcms_db_title tcms_bg_blue_01 tcms_padding_mini"><strong>'._SIDEEXT_TC.'</strong></td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_TC_TITLE.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" name="chooser_title" class="tcms_input_normal" value="'.$tmp_chooser_title.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_TC_SHOW_TITLE.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="show_ct" '.( $tmp_show_ct == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr height: 28px;"><td colspan="2">&nbsp;</td></tr>';
		
		
		// row
		echo '<tr><td colspan="2" class="tcms_db_title tcms_bg_blue_01 tcms_padding_mini"><strong>'._SIDEEXT_SEARCH.'</strong></td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_SEARCH_TITLE.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" name="search_title" class="tcms_input_normal" value="'.$tmp_search_title.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_SEARCH_WORD.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" name="search_word" class="tcms_input_normal" value="'.$tmp_search_word.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_SEARCH_WITH_BR.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="search_br"'.( $tmp_search_br == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_SEARCH_WITH_BUTTON.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="search_button"'.( $tmp_search_button == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_SEARCH_SHOW_TITLE.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="show_st"'.( $tmp_show_st == 1 ? ' checked="checked"' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_SEARCH_ALIGNMENT.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<select onchange="CHANGED = true;" name="new_search_align" class="tcms_select">'
		.'<option value="left"'.( $tmp_search_ali == 'left' ? ' selected="selected"' : '' ).'>'._TABLE_LEFT.'</option>'
		.'<option value="right"'.( $tmp_search_ali == 'right' ? ' selected="selected"' : '' ).'>'._TABLE_RIGHT.'</option>'
		.'<option value="center"'.( $tmp_search_ali == 'center' ? ' selected="selected"' : '' ).'>'._TABLE_CENTER.'</option>'
		.'</select>'
		.'</td></tr>';
		
		
		// row
		echo '<tr height: 28px;"><td colspan="2">&nbsp;</td></tr>';
		
		
		// row
		echo '<tr><td colspan="2" class="tcms_db_title tcms_bg_blue_01 tcms_padding_mini"><strong>'._SIDEEXT_LOGIN.'</strong></td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_LOGIN_TITLE.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" name="login_title" class="tcms_input_normal" type="text" value="'.$tmp_login_title.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_USERM_TITLE.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" name="new_usermenu_title" class="tcms_input_normal" type="text" value="'.$tmp_usermenu_title.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_LOGIN_USER.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" name="reg_user" class="tcms_input_normal" type="text" value="'.$tmp_reg_user.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_LOGIN_PASS.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" name="reg_pass" class="tcms_input_normal" type="text" value="'.$tmp_reg_pass.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_LOGIN_ACCOUNT.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" name="nologin" class="tcms_input_normal" type="text" value="'.$tmp_nologin.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_LOGIN_REG.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" name="reg_link" class="tcms_input_normal" type="text" value="'.$tmp_reg_link.'" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_LOGIN_MENU.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="usermenu" '.( $tmp_usermenu == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_LOGIN_SHOW_TITLE.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="show_lt" '.( $tmp_show_lt == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_LOGIN_ALLOW.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="register" '.( $tmp_register == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// row
		echo '<tr><td class="tcms_padding_mini" width="250">'._SIDEEXT_LOGIN_SHOW_MEMBERLIST.'</td>'
		.'<td><img src="../images/bullet_1.gif" border="0" style="margin: 5px 2px 0 0 !important;" />'
		.'<input onchange="CHANGED = true;" type="checkbox" name="new_show_ml" '.( $tmp_show_ml == 1 ? 'checked' : '' ).' value="1" />'
		.'</td></tr>';
		
		
		// Table end
		echo '</table><br />';
		
		echo '</form>';
	}
	
	
	
	echo '</div>';
	
	
	
	
	
	
	
	
	//==================================================
	// SAVE
	//==================================================
	
	if($todo == 'save_modules'){
		//***************************************
		//
		// WRITE XML
		//
		
		if(empty($tmp_use_poll_s))       { $tmp_use_poll_s        = 0; }
		if(empty($new_side_gallery))     { $new_side_gallery      = 0; }
		if(empty($chooser))              { $chooser               = 0; }
		if(empty($new_link_use_side))    { $new_link_use_side     = 0; }
		if(empty($login))                { $login                 = 0; }
		if(empty($new_news_cat_show))    { $new_news_cat_show     = 0; }
		if(empty($new_use_side_archives)){ $new_use_side_archives = 0; }
		if(empty($new_use_feeds))        { $new_use_feeds         = 0; }
		if(empty($use_nl))               { $use_nl                = 0; }
		if(empty($search))               { $search                = 0; }
		if(empty($sidebar))              { $sidebar               = 0; }
		
		
		$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/modules.xml', 'w');
		$xmluser->xml_declaration();
		$xmluser->xml_section('config');
		
		$xmluser->write_value('side_gallery', $new_side_gallery);
		$xmluser->write_value('layout_chooser', $chooser);
		$xmluser->write_value('side_links', $new_link_use_side);
		$xmluser->write_value('login', $login);
		$xmluser->write_value('side_category', $new_news_cat_show);
		$xmluser->write_value('side_archives', $new_use_side_archives);
		$xmluser->write_value('syndication', $new_use_feeds);
		$xmluser->write_value('newsletter', $use_nl);
		$xmluser->write_value('search', $search);
		$xmluser->write_value('sidebar', $sidebar);
		$xmluser->write_value('poll', $tmp_use_poll_s);
		
		$xmluser->xml_section_buffer();
		$xmluser->xml_section_end('config');
		$xmluser->_xmlparser();
		
		if($_RELOCATE == 0){
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_side_extensions&action=modules\';</script>';
		}
		else{
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_side_extensions&action=settings\';</script>';
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	if($todo == 'save'){
		//***************************************
		//
		// WRITE XML
		//
		
		
		if($new_sidemenu_title == ''){ $new_sidemenu_title = '[TYPE TITLE]'; }
		if(empty($sidemenu))         { $sidemenu           = 0; }
		if($sidebar_title == '')     { $sidebar_title      = '[TYPE TITLE]'; }
		if($chooser_title == '')     { $chooser_title      = '[TYPE TITLE]'; }
		if($search_title == '')      { $search_title       = '[TYPE TITLE]'; }
		if($login_title == '')       { $login_title        = '[TYPE TITLE]'; }
		if($new_usermenu_title == ''){ $new_usermenu_title = '[TYPE TITLE]'; }
		if($nologin == '')           { $nologin            = 'No account yet?'; }
		if($reg_link == '')          { $reg_link           = 'Create one'; }
		if($reg_user == '')          { $reg_user           = 'Username'; }
		if($reg_pass == '')          { $reg_pass           = 'Password'; }
		if($search_word == '')       { $search_word        = ''; }
		if(empty($register))         { $register           = 0; }
		if(empty($usermenu))         { $usermenu           = 0; }
		if(empty($show_lt))          { $show_lt            = 0; }
		if(empty($show_ct))          { $show_ct            = 0; }
		if(empty($show_st))          { $show_st            = 0; }
		if(empty($show_sbt))         { $show_sbt           = 0; }
		if(empty($search_br))        { $search_br          = 0; }
		if(empty($search_button))    { $search_button      = 0; }
		if(empty($new_ncamount_show)){ $new_ncamount_show  = 0; }
		if(empty($new_show_ml))      { $new_show_ml        = 0; }
		
		
		// CHARSETS
		$new_sidemenu_title = $tcms_main->decode_text($new_sidemenu_title, '2', $c_charset);
		$sidebar_title      = $tcms_main->decode_text($sidebar_title, '2', $c_charset);
		$chooser_title      = $tcms_main->decode_text($chooser_title, '2', $c_charset);
		$search_title       = $tcms_main->decode_text($search_title, '2', $c_charset);
		$login_title        = $tcms_main->decode_text($login_title, '2', $c_charset);
		$new_usermenu_title = $tcms_main->decode_text($new_usermenu_title, '2', $c_charset);
		$nologin            = $tcms_main->decode_text($nologin, '2', $c_charset);
		$reg_link           = $tcms_main->decode_text($reg_link, '2', $c_charset);
		$reg_user           = $tcms_main->decode_text($reg_user, '2', $c_charset);
		$reg_pass           = $tcms_main->decode_text($reg_pass, '2', $c_charset);
		$search_word        = $tcms_main->decode_text($search_word, '2', $c_charset);
		
		if($choosenDB == 'xml'){
			$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/sidebar.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('side');
			
			$xmluser->write_value('sidemenu_title', $new_sidemenu_title);
			$xmluser->write_value('sidemenu', $sidemenu);
			$xmluser->write_value('sidebar_title', $sidebar_title);
			$xmluser->write_value('show_sidebar_title', $show_sbt);
			$xmluser->write_value('chooser_title', $chooser_title);
			$xmluser->write_value('show_chooser_title', $show_ct);
			$xmluser->write_value('search_title', $search_title);
			$xmluser->write_value('show_search_title', $show_st);
			$xmluser->write_value('search_alignment', $new_search_align);
			$xmluser->write_value('search_withbr', $search_br);
			$xmluser->write_value('search_withbutton', $search_button);
			$xmluser->write_value('search_word', $search_word);
			$xmluser->write_value('login_title', $login_title);
			$xmluser->write_value('usermenu_title', $new_usermenu_title);
			$xmluser->write_value('nologin', $nologin);
			$xmluser->write_value('reg_link', $reg_link);
			$xmluser->write_value('reg_user', $reg_user);
			$xmluser->write_value('reg_pass', $reg_pass);
			$xmluser->write_value('login_user', $register);
			$xmluser->write_value('usermenu', $usermenu);
			$xmluser->write_value('show_login_title', $show_lt);
			$xmluser->write_value('show_news_cat_amount', $new_ncamount_show);
			$xmluser->write_value('show_memberlist', $new_show_ml);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('side');
			$xmluser->_xmlparser();
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$newSQLData = ''
			.$tcms_db_prefix.'sidebar_extensions.sidemenu_title="'.$new_sidemenu_title.'", '
			.$tcms_db_prefix.'sidebar_extensions.sidemenu='.$sidemenu.', '
			.$tcms_db_prefix.'sidebar_extensions.sidebar_title="'.$sidebar_title.'", '
			.$tcms_db_prefix.'sidebar_extensions.show_sidebar_title='.$show_sbt.', '
			.$tcms_db_prefix.'sidebar_extensions.chooser_title="'.$chooser_title.'", '
			.$tcms_db_prefix.'sidebar_extensions.show_chooser_title='.$show_ct.', '
			.$tcms_db_prefix.'sidebar_extensions.search_title="'.$search_title.'", '
			.$tcms_db_prefix.'sidebar_extensions.show_search_title='.$show_st.', '
			.$tcms_db_prefix.'sidebar_extensions.search_alignment="'.$new_search_align.'", '
			.$tcms_db_prefix.'sidebar_extensions.search_withbr='.$search_br.', '
			.$tcms_db_prefix.'sidebar_extensions.search_withbutton='.$search_button.', '
			.$tcms_db_prefix.'sidebar_extensions.search_word="'.$search_word.'", '
			.$tcms_db_prefix.'sidebar_extensions.login_title="'.$login_title.'", '
			.$tcms_db_prefix.'sidebar_extensions.usermenu_title="'.$new_usermenu_title.'", '
			.$tcms_db_prefix.'sidebar_extensions.nologin="'.$nologin.'", '
			.$tcms_db_prefix.'sidebar_extensions.reg_link="'.$reg_link.'", '
			.$tcms_db_prefix.'sidebar_extensions.reg_user="'.$reg_user.'", '
			.$tcms_db_prefix.'sidebar_extensions.reg_pass="'.$reg_pass.'", '
			.$tcms_db_prefix.'sidebar_extensions.login_user='.$register.', '
			.$tcms_db_prefix.'sidebar_extensions.usermenu='.$usermenu.', '
			.$tcms_db_prefix.'sidebar_extensions.show_login_title='.$show_lt.', '
			.$tcms_db_prefix.'sidebar_extensions.show_news_cat_amount='.$new_ncamount_show.', '
			.$tcms_db_prefix.'sidebar_extensions.show_memberlist='.$new_show_ml;
			
			$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'sidebar_extensions', $newSQLData, 'sidebar_extensions');
		}
		
		if($_RELOCATE == 0){
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_side_extensions&action=settings\';</script>';
		}
		else{
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_side_extensions&action=modules\';</script>';
		}
		
		//***************************************
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}


?>