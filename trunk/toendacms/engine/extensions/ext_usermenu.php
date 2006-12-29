<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| User Menu
|
| File:		ext_usermenu.php
| Version:	0.2.8
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



if($user_navigation == 1){
	if($choosenDB == 'xml'){
		$mtu_xml = new xmlparser($tcms_administer_site.'/tcms_global/sidebar.xml','r');
		$menu_title_user = $mtu_xml->read_section('side', 'usermenu_title');
		
		$xmlSet = new xmlparser($tcms_administer_site.'/tcms_global/userpage.xml','r');
		$npo = $xmlSet->read_section('userpage', 'news_publish');
		$ipo = $xmlSet->read_section('userpage', 'image_publish');
		$apo = $xmlSet->read_section('userpage', 'album_publish');
		$cpo = $xmlSet->read_section('userpage', 'cat_publish');
		$ppo = $xmlSet->read_section('userpage', 'pic_publish');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'sidebar_extensions', 'sidebar_extensions');
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		$menu_title_user = $sqlARR['usermenu_title'];
		
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'userpage', 'userpage');
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		$npo = $sqlARR['news_publish'];
		$ipo = $sqlARR['image_publish'];
		$apo = $sqlARR['album_publish'];
		$cpo = $sqlARR['cat_publish'];
		$ppo = $sqlARR['pic_publish'];
	}
	
	$menu_title_user = $tcms_main->decodeText($menu_title_user, '2', $charset);
	
	echo tcms_html::subtitle($menu_title_user);
	
	//echo $is_admin.'<--';
	
	echo '<ul style="list-style-type: none !important;">';
	
	if($npo == 1){
		// Publish News
		if($canEdit){
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;todo=submitNews';
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_SUBMIT_NEWS.'</a></li>';
		}
	}
	
	
	
	if($cpo == 1){
		// Create category
		if($canEdit){
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;todo=createCat';
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_CREATE_CATEGORY.'</a></li>';
		}
	}
	
	
	
	if($ppo == 1){
		// Upload image to mediamanager
		if($canEdit){
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;todo=submitMedia';
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_SUBMIT_MEDIA.'</a></li>';
		}
	}
	
	
	
	if($apo == 1){
		// Create Album
		if($canEdit){
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;todo=createAlbum';
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_CREATE_ALBUM.'</a></li>';
		}
	}
	
	
	
	if($ipo == 1){
		// Publish Images
		if($canEdit){
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;todo=submitImages';
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_SUBMIT_IMAGES.'</a></li>';
		}
	}
	
	
	
	// Your Profile
	$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;u='.$ws_id;
	$link = $tcms_main->urlAmpReplace($link);
	
	echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_PROFILE.'</a></li>';
	
	
	
	if($show_ml == 1){
		// Memberlist
		$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;action=list';
		$link = $tcms_main->urlAmpReplace($link);
		
		echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_LIST.'</a></li>';
	}
	
	
	
	// Administration
		if($canEdit){
		if($choosenDB == 'xml'){
			echo '<li><a class="mainlevel" href="'.$imagePath.'engine/admin/admin.php?id_user='.$session.'&amp;setXMLSession=1">'._LOGIN_ADMIN.'</a></li>';
		}
		else{
			echo '<li><a class="mainlevel" href="'.$imagePath.'engine/admin/admin.php?id_user='.$session.'">'._LOGIN_ADMIN.'</a></li>';
		}
	}
	
	// Logout
	$link = '?session='.$session.'&amp;id='.$id.'&amp;s='.$s.'&amp;reg_login=logout';
	$link = $tcms_main->urlAmpReplace($link);
	
	echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_LOGOUT.'</a></li>';
	
	echo '</ul>';
}

?>