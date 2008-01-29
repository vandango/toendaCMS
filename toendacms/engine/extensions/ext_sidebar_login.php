<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Login Module
|
| File:	ext_sidebar_login.php
|
+
*/
//echo 'cookie: ';
//if($_COOKIE['session']) echo $_COOKIE['session'];


defined('_TCMS_VALID') or die('Restricted access');


if(isset($_GET['reg_login'])){ $reg_login = $_GET['reg_login']; }

if(isset($_POST['news'])){ $news = $_POST['news']; }
if(isset($_POST['id'])){ $id = $_POST['id']; }
if(isset($_POST['s'])){ $s = $_POST['s']; }
if(isset($_POST['reg_login'])){ $reg_login = $_POST['reg_login']; }
if(isset($_POST['reg_user'])){ $reg_user = $_POST['reg_user']; }
if(isset($_POST['reg_pass'])){ $reg_pass = $_POST['reg_pass']; }
if(isset($_POST['reg_cookie'])){ $reg_cookie = $_POST['reg_cookie']; }


/**
 * Login Module
 *
 * This module provides the login functionality
 * and a login formular.
 *
 * @version 0.5.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */


if(!isset($reg_login)){ $reg_login = NULL; }



if($use_login == 1) {
	$dcSE = new tcms_dc_sidebarextensions();
	$dcSE = $tcms_dcp->getSidebarExtensionSettings();
	
	
	
	// -----------------------------------
	// DISPLAY
	// -----------------------------------
	
	if($reg_login == NULL) {
		if($check_session) {
			/*
				READ USERNAME
			*/
			
			echo $tcms_html->subTitle($dcSE->getLoginTitle())
			.'<div align="left"><span class="text_small">'
			._LOGIN_WELCOME.',<br />'.$tcms_ap->getUsername($ws_id).'.'
			.'</span></div>'
			.'<br />';
		}
		else{
			if($dcSE->getShowLoginTitle()) {
				echo $tcms_html->subTitle($dcSE->getLoginTitle());
			}
			
			echo '<form name="selectform" action="'
			.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?'.( isset($session) ? '?session='.$session.'' : '' )
			.'" method="post">'
			.'<input type="hidden" name="id" value="'.$id.'" />'
			.'<input type="hidden" name="s" value="'.$s.'" />'
			.'<input type="hidden" name="reg_login" value="login" />'
			.( $tcms_main->isReal($news) && strlen($news) == 5 ? '<input type="hidden" name="news" value="'.$news.'" />' : '')
			.( isset($lang) ? '<input type="hidden" name="lang" value="'.$lang.'" />' : '' );
			
			echo '<div align="left" style="padding-top: 4px !important;" class="logintext">'
			.'<input type="text" name="reg_user" class="inputtext loginform" value="" />'
			.'&nbsp;'.$dcSE->getRegisterUserText().'<br />'
			.'<input type="password" name="reg_pass" class="inputtext loginform" value="" />'
			.'&nbsp;'.$dcSE->getRegisterPasswordText().'<br />'
			.'<input type="submit" value="'._LOGIN_SUBMIT.'" class="inputbutton" />'
			//.'<br />'
			//.'<span class="text_small">'
			//.'<input type="checkbox" name="reg_cookie" value="1" /> Angemeldet bleiben'
			//.'</span>'
			.'</div>';
			
			echo '</form>';
			
			echo '<div align="left">';
			
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id=register&amp;s='.$s.'&amp;cmd=lostpassword'
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<span class="text_small">'
			.'<a href="'.$link.'">'._LOGIN_FORGOTPW.'</a>'
			.'</span>';
			
			if($dcSE->getLoginUser()){
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id=register&amp;s='.$s
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '<br />'
				.'<span class="text_small">'
				.$dcSE->getNoLoginText()
				.'&nbsp;<a href="'.$link.'">'.$dcSE->getRegisterLinkText().'</a>'
				.'</span>';
			}
			
			if($dcSE->getShowMemberlist()){
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
				.'id=profile&amp;s='.$s.'&amp;action=list'
				.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '<br />'
				.'<span class="text_small">'
				.'<a href="'.$link.'">'._LOGIN_LIST.'</a>'
				.'</span>';
			}
			
			echo '</div>';
		}
		
		echo '<br />';
		//.'<br />';
	}
	
	
	
	// -----------------------------------
	// LOGIN NOW
	// -----------------------------------
	
	if($reg_login == 'login') {
		$linkAdd = '';
		
		$session = $tcms_auth->doLogin($reg_user, $reg_pass);
		
		if($session !== false && strlen($session) == 32) {
			if($reg_cookie) {
				$linkAdd = '&code=setc';
			}
			
			$link = '?session='.$session.'&id='.$id.'&s='.$s.$linkAdd
			.( isset($lang) ? '&lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link, false);
		}
		else {
			$link = '?id='.$id.'&s='.$s
			.( isset($lang) ? '&lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			if($session === 'u') {
				$msg = 'Incorrect usergroup!';
			}
		}
		
		echo '<script>'
		.'document.location.href=\''.$link.'\';'
		.( $session !== false && strlen($session) == 32 
			? '' 
			: 'alert(\''._LOGIN_FALSE.'\n'.$msg.'\');'
		).'</script>';
	}
	
	
	
	// -----------------------------------
	// LOGOUT NOW
	// -----------------------------------
	
	if($reg_login == 'logout'){
		$tcms_auth->doLogout($session);
		
		$link = '?s='.$s.( isset($lang) ? '&lang='.$lang : '' );
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<script>document.location.href=\''.$link.'\';</script>';
	}

	
	// cleanup
	unset($seDC);
}

?>
