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
| File:	ext_usermenu.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS User Menu
 *
 * This module is used as a user menu.
 *
 * @version 0.3.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


if($user_navigation == 1) {
	$dcSE = new tcms_dc_sidebarextensions();
	$dcSE = $tcms_dcp->getSidebarExtensionSettings();
	
	if($choosenDB == 'xml') {
		$xmlSet = new xmlparser(_TCMS_PATH.'/tcms_global/userpage.xml','r');
		$npo = $xmlSet->readSection('userpage', 'news_publish');
		$ipo = $xmlSet->readSection('userpage', 'image_publish');
		$apo = $xmlSet->readSection('userpage', 'album_publish');
		$cpo = $xmlSet->readSection('userpage', 'cat_publish');
		$ppo = $xmlSet->readSection('userpage', 'pic_publish');
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->getOne($tcms_db_prefix.'userpage', 'userpage');
		$sqlARR = $sqlAL->fetchArray($sqlQR);
		
		$npo = $sqlARR['news_publish'];
		$ipo = $sqlARR['image_publish'];
		$apo = $sqlARR['album_publish'];
		$cpo = $sqlARR['cat_publish'];
		$ppo = $sqlARR['pic_publish'];
	}
	
	echo $tcms_html->subTitle($dcSE->getUsermenuTitle());
	
	echo '<ul style="list-style-type: none !important;">';
	
	if($npo == 1) {
		// Publish News
		if($canEdit) {
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;todo=submitNews'
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_SUBMIT_NEWS.'</a></li>';
		}
	}
	
	
	
	if($cpo == 1) {
		// Create category
		if($canEdit) {
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;todo=createCat'
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_CREATE_CATEGORY.'</a></li>';
		}
	}
	
	
	
	if($ppo == 1) {
		// Upload image to mediamanager
		if($canEdit) {
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;todo=submitMedia'
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_SUBMIT_MEDIA.'</a></li>';
		}
	}
	
	
	
	if($apo == 1) {
		// Create Album
		if($canEdit) {
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;todo=createAlbum'
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_CREATE_ALBUM.'</a></li>';
		}
	}
	
	
	
	if($ipo == 1) {
		// Publish Images
		if($canEdit) {
			$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;todo=submitImages'
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_SUBMIT_IMAGES.'</a></li>';
		}
	}
	
	
	
	// Your Profile
	$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;u='.$ws_id
	.( isset($lang) ? '&amp;lang='.$lang : '' );
	$link = $tcms_main->urlConvertToSEO($link);
	
	echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_PROFILE.'</a></li>';
	
	
	
	if($dcSE->getShowMemberlist()) {
		// Memberlist
		$link = '?session='.$session.'&amp;id=profile&amp;s='.$s.'&amp;action=list'
		.( isset($lang) ? '&amp;lang='.$lang : '' );
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_LIST.'</a></li>';
	}
	
	
	
	// Administration
	if($canEdit) {
		if($choosenDB == 'xml') {
			echo '<li><a class="mainlevel" href="'.$imagePath.'engine/admin/admin.php?id_user='.$session.'&amp;setXMLSession=1">'._LOGIN_ADMIN.'</a></li>';
		}
		else {
			echo '<li><a class="mainlevel" href="'.$imagePath.'engine/admin/admin.php?id_user='.$session.'">'._LOGIN_ADMIN.'</a></li>';
		}
	}
	
	// Logout
	$link = '?session='.$session.'&amp;id='.$id.'&amp;s='.$s.'&amp;reg_login=logout'
	.( isset($lang) ? '&amp;lang='.$lang : '' );
	$link = $tcms_main->urlConvertToSEO($link);
	
	echo '<li><a class="mainlevel" href="'.$link.'">'._LOGIN_LOGOUT.'</a></li>';
	
	echo '</ul>';
}

?>