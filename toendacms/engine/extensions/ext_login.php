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
| File:		ext_login.php
| Version:	0.4.3
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
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */


if(!isset($reg_login)){ $reg_login = NULL; }



if($use_login == 1){
	if($check_session){
		/*
			READ USERNAME
		*/
		
		if($choosenDB == 'xml'){
			$authXML  = new xmlparser($tcms_administer_site.'/tcms_user/'.$ws_id.'.xml', 'r');
			$login_name = $authXML->read_section('user', 'name');
			$login_name = $tcms_main->decodeText($login_name, '2', $c_charset);
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'user', $ws_id);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			$login_name = $sqlARR['name'];
			if($login_name == NULL){ $login_name = ''; }
			$login_name = $tcms_main->decodeText($login_name, '2', $c_charset);
		}
		
		echo tcms_html::subtitle($login_title)
		.'<div align="left"><span class="text_small">'
		._LOGIN_WELCOME.',<br />'.$login_name.'.'
		.'</span></div>';
	}
	else{
		if($show_lt == 1)
			echo tcms_html::subtitle($login_title);
		
		echo '<form name="selectform" action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?'.( isset($session) ? '?session='.$session.'' : '' ).'" method="post">'
		.'<input type="hidden" name="id" value="'.$id.'" />'
		.'<input type="hidden" name="s" value="'.$s.'" />'
		.'<input type="hidden" name="reg_login" value="login" />'
		.( $tcms_main->isReal($news) ? '<input type="hidden" name="news" value="'.$news.'" />' : '');
		
		echo '<div align="left" style="padding-top: 4px !important;" class="logintext">'
		.'<input type="text" name="reg_user" class="inputtext loginform" value="" />&nbsp;'.$reg_username.'<br />'
		.'<input type="password" name="reg_pass" class="inputtext loginform" value="" />&nbsp;'.$reg_password.'<br />'
		.'<input type="submit" value="'._LOGIN_SUBMIT.'" class="inputbutton" />'
		//.'<br />'
		//.'<span class="text_small">'
		//.'<input type="checkbox" name="reg_cookie" value="1" /> Angemeldet bleiben'
		//.'</span>'
		.'</div>';
		
		echo '</form>';
		
		echo '<div align="left">';
		
		$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=register&amp;s='.$s.'&amp;cmd=lostpassword';
		$link = $tcms_main->urlAmpReplace($link);
		
		echo '<span class="text_small">'
		.'<a href="'.$link.'">'._LOGIN_FORGOTPW.'</a>'
		.'</span>';
		
		if($login_user == 1){
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=register&amp;s='.$s;
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<br />'
			.'<span class="text_small">'
			.$no_login
			.'&nbsp;<a href="'.$link.'">'.$reg_link.'</a>'
			.'</span>';
		}
		
		if($show_ml == 1){
			$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=profile&amp;s='.$s.'&amp;action=list';
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<br />'
			.'<span class="text_small">'
			.'<a href="'.$link.'">'._LOGIN_LIST.'</a>'
			.'</span>';
		}
		
		echo '</div>';
	}
	
	echo '<br />'
	.'<br />';
}



/*
	Login
*/
if($reg_login == 'login'){
	$linkAdd = '';
	
	$session = $tcms_auth->doLogin($reg_user, $reg_pass);
	
	if($session){
		if($reg_cookie) {
			$linkAdd = '&code=setc';
		}
		
		$link = '?session='.$session.'&id='.$id.'&s='.$s.$linkAdd;
		$link = $tcms_main->urlAmpReplace($link, false);
	}
	else{
		$link = '?id='.$id.'&amp;s='.$s;
		$link = $tcms_main->urlAmpReplace($link);
	}
	
	echo '<script>'
	.'document.location.href=\''.$link.'\';'
	.( $session ? '' : 'alert(\''._LOGIN_FALSE.'\');' )
	.'</script>';
}



/*
	Logout
*/
if($reg_login == 'logout'){
	$tcms_auth->doLogout($session);
	
	$link = '?s='.$s;
	$link = $tcms_main->urlAmpReplace($link);
	
	echo '<script>document.location.href=\''.$link.'\';</script>';
}

?>
