<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Index Admin (Login interface)
|
| File:		index.php
|
+
*/


if(isset($_POST['username'])){ $username = $_POST['username']; }
if(isset($_POST['password'])){ $password = $_POST['password']; }
if(isset($_POST['email'])){ $email = $_POST['email']; }
if(isset($_POST['id_user'])){ $id_user = $_POST['id_user']; }
if(isset($_POST['todo'])){ $todo = $_POST['todo']; }
if(isset($_POST['cmd'])){ $cmd = $_POST['cmd']; }

if(isset($_GET['cmd'])){ $cmd = $_GET['cmd']; }
if(isset($_GET['todo'])){ $todo = $_GET['todo']; }
if(isset($_GET['id_user'])){ $id_user = $_GET['id_user']; }


/**
 * Index Admin (Login interface)
 *
 * This is used as global startpage for the
 * administraion backend.
 *
 * @version 0.6.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


/*
	Language and Globals
*/
define('_TCMS_VALID', 1);

$language_stage = 'admin';
$tcms_administer_site = 'data';


include_once('../language/lang_admin.php');
include_once('../tcms_kernel/tcms.lib.php');
include_once('../tcms_kernel/tcms_time.lib.php');
include_once('../tcms_kernel/tcms_sql.lib.php');
include_once('../tcms_kernel/tcms_xml.lib.php');
include_once('../../'.$tcms_administer_site.'/tcms_global/database.php');
include_once('../tcms_kernel/tcms_authentication.lib.php');
include_once('../tcms_kernel/tcms_configuration.lib.php');
include_once('../tcms_kernel/phpmailer/class.phpmailer.php');


$c_xml      = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/layout.xml','r');
$adminTheme = $c_xml->read_section('layout', 'admin');


$tcms_config = new tcms_configuration('../../'.$tcms_administer_site);
$c_charset = $tcms_config->getCharset();


$tcms_auth   = new tcms_authentication('../../'.$tcms_administer_site, $c_charset, '');


$tcms_main = new tcms_main('../../'.$tcms_administer_site);

$choosenDB = $tcms_main->secure_password($tcms_db_engine, 'en');
$sqlUser   = $tcms_main->secure_password($tcms_db_user, 'en');
$sqlPass   = $tcms_main->secure_password($tcms_db_password, 'en');
$sqlHost   = $tcms_main->secure_password($tcms_db_host, 'en');
$sqlDB     = $tcms_main->secure_password($tcms_db_database, 'en');
$sqlPort   = $tcms_main->secure_password($tcms_db_port, 'en');
$sqlPrefix = $tcms_main->secure_password($tcms_db_prefix, 'en');
$tcms_db_prefix = $sqlPrefix;

$tcms_main->setDatabaseInfo($choosenDB);


$footer_xml   = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/footer.xml','r');
$websiteowner = $footer_xml->read_section('footer', 'websiteowner');
$websiteowner = $tcms_main->decodeText($websiteowner, '2', $c_charset);


$param_save_mode = $tcms_main->getPHPSetting('safe_mode');
if($param_save_mode){
	$set_save_mode = $tcms_main->setPHPSetting('safe_mode', 'on');
}



/*
	Init
*/
$ws_login  = true;

if(!isset($cmd)) $cmd = '';



/*
	Version
*/
$ver_xml = new xmlparser('../../engine/tcms_kernel/tcms_version.xml','r');
$release      = $ver_xml->read_section('version', 'release');
$codename     = $ver_xml->read_section('version', 'codename');
$status       = $ver_xml->read_section('version', 'status');
$build        = $ver_xml->read_section('version', 'build');
$cms_name     = $ver_xml->read_section('version', 'name');
$cms_tagline  = $ver_xml->read_section('version', 'tagline');
$release_date = $ver_xml->read_section('version', 'release_date');
$toenda_copy  = $ver_xml->read_section('version', 'toenda_copyright');
$ver_xml->flush();
$ver_xml->_xmlparser();

$version = '&nbsp;'.$cms_name.' &bull; '.$release.' ['.$codename.'] &bull; '.$status.'&nbsp;';

$cms_version = $release;
$cms_build = $build;



echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>'.$websiteowner.' | toendaCMS Login'.( $cmd == 'lostpassword' ? ' &raquo; '._LOGIN_FORGOTPW : '' ).'</title>
<meta http-equiv="Content-Type" content="text/html; charset='.$c_charset.'" />
<!--
 This website is powered by '.$cms_name.' - '.$cms_tagline.'!
 Version '.$cms_version.' - '.$cms_build.'
 '.$cms_name.' is a free open source Content Management Framework created by Jonathan Naumann and licensed under the GNU/GPL license.
 '.$cms_name.' is copyright (c) '.$toenda_copy.' of Toenda Software Development.
 Components are copyright (c) of their respective owners.
 Information and contribution at http://toendacms.com
-->
<meta name="generator" content="'.$cms_name.' - '.$cms_tagline.' | Copyright '.$toenda_copy.' Toenda Software Development. '._TCMS_ADMIN_RIGHT.'" />
<link href="theme/'.$adminTheme.'/tcms_main.css" rel="stylesheet" type="text/css" />
<link href="theme/'.$adminTheme.'/tcms_editor.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../images/favicon.png">
<style> body{ background: #fff; } </style>
<script language="JavaScript">

function doLogin(){
	var sendOK = true;
	
	if(document.forms[\'login\'].username.value == \'\'){
		sendOK = false;
		alert(\''._LOGIN_USERNAME_JS.'\');
		document.forms[\'login\'].username.focus();
		return false;
	}
	
	if(document.forms[\'login\'].password.value == \'\'){
		sendOK = false;
		alert(\''._LOGIN_PASSWORD_JS.'\');
		document.forms[\'login\'].password.focus();
		return false;
	}
	
	if(sendOK)
		document.forms[\'login\'].submit();
}

function doRetrieve(){
	var sendOK = true;
	
	if(document.forms[\'retrieve\'].username.value == \'\'){
		sendOK = false;
		alert(\''._LOGIN_USERNAME_JS.'\');
		document.forms[\'retrieve\'].username.focus();
		return false;
	}
	
	if(document.forms[\'retrieve\'].email.value == \'\'){
		sendOK = false;
		alert(\''._MSG_NOEMAIL.'\');
		document.forms[\'retrieve\'].email.focus();
		return false;
	}
	
	if(document.forms[\'retrieve\'].email.value.indexOf(\'@\') == -1){
		sendOK = false;
		alert(\''._MSG_NOEMAIL.'\');
		document.forms[\'retrieve\'].email.focus();
		return false;
	}
	
	if(sendOK)
		document.forms[\'retrieve\'].submit();
}

function setFocus(){
	document.getElementById(\'username\').focus();
	document.forms[\'login\'].username.focus();
}

var browser = \'moz\';

function checkBrowser(){
	var name = navigator.userAgent;
	name = name.toLowerCase();
	
	if(navigator.userAgent.indexOf("Safari") > 0){ browser = \'moz\'; }
	else if(navigator.product == "Gecko"){ browser = \'moz\'; }
	else if(name.indexOf("opera") != -1){ browser = \'moz\'; }
	else if(navigator.userAgent.indexOf("Opera") != -1){ browser = \'moz\'; }
	else{ browser = \'ie\'; }
}

checkBrowser();

</script>
</head>

<body topmargin="0" rightmargin="0" leftmargin="0" onload="setFocus();">
';



/*
	Login and retrieve
*/

if($cmd == 'login'){
	$id_user = $tcms_auth->doLogin($username, $password, true);
	
	if($id_user){
		echo '<script>document.location.href=\'admin.php?id_user='.$id_user.'\';</script>';
	}
	else{
		echo '<div class="loginerror" align="center">'
		.'<h1>! '._MSG_ERROR.' !</h1>'
		.'<h2>'._LOGIN_FALSE.'</h2>'
		.'<br /><br />'
		.'</div>';
		
		$cmd = '';
	}
}

if($cmd == 'retrieve'){
	$tcms_auth->doRetrieve($username, $email);
	
	echo '<script>document.location.href=\'index.php\';</script>';
}



/*
	Login and retrievement form
*/

if($cmd == ''){
	echo '<div class="formbase"'.( $id_user == false ? ' style="margin: 10px auto 0 auto;"' : '' ).'>
	<div class="loginform">
		<h2 class="logintitle">'._LOGIN_MSG.'</h2>
		
		<div class="loginarea">
			<form action="index.php" method="post" id="login">
			
			'._LOGIN_USERNAME.'
			<br />
			<input class="loginbox" style="width: 120px;" type="text" id="username" name="username" value="'.( isset($username) ? $username : '' ).'" />
			
			'._LOGIN_PASSWORD.'
			<br />
			<input class="loginbox" style="width: 120px;" type="password" id="password" name="password" value="'.( isset($password) ? $password : '' ).'" />
			
			<input class="loginput" type="submit" onclick="javascript:doLogin();" value="Login" />
			<input type="hidden" name="cmd" value="login" />
			<input type="hidden" name="id_user" value="'.$id_user.'" />
			</form>
		</div>
	</div>
	</div>';
	
	echo '<noscript>
	<div align="center"><hr />
	<h1>!Warning!</h1>
	<h2>Javascript must be enabled for proper operation of the Administrator</h2>
	<hr /></div>
	</noscript>';
}

if($cmd == 'lostpassword'){
	echo '<div class="formbase"'.( $id_user == false ? ' style="margin: 10px auto 0 auto;"' : '' ).'>
	<div class="loginform">
		<h2 class="logintitle">'._REG_LPW.'</h2>
		
		<div class="loginarea">
			<form action="index.php" method="post" id="retrieve">
			
			'._PERSON_USERNAME.'
			<br />
			<input class="loginbox" style="width: 120px;" type="text" id="username" name="username" value="" />
			
			'._PERSON_EMAIL.'
			<br />
			<input class="loginbox" style="width: 120px;" type="text" id="email" name="email" value="" />
			
			<input class="loginput" type="submit" onclick="javascript:doRetrieve();" value="'._REG_SUBMIT_LPW.'" />
			<input type="hidden" name="cmd" value="retrieve" />
			</form>
		</div>
	</div>
	</div>';
}



/*
	Footer
*/
echo '
<div align="center" class="legal_index">'
.'<a href="../../">'._TCMS_ADMIN_BACK_TO_PAGE.'</a>'
.'&nbsp;|&nbsp;'
.( $cmd == ''
	? '<a href="index.php?cmd=lostpassword">'._LOGIN_FORGOTPW.'</a>'
	: '<a href="index.php">'._LOGIN_MSG.'</a>'
)
.'<br />'
.$version
.'<br />'
.'coded from scratch by <a class="legal_index" href="http://www.toenda.com" target="_blank">Toenda Software Development</a>'
.'<br />'
.'&copy; '.$toenda_copy.'&nbsp;'._TCMS_ADMIN_RIGHT
.'<br /><br />'
.'<img src="../images/logos/toendaCMS_button_02.png" border="0" />'
.'<br /><br />'
.'<script>if(browser == \'ie\'){'
.'document.write(\'You can use a better browser:<br />\');'
.'document.write(\'<a href=\"http://browsehappy.com/\" target=\"_blank\"><img src=\"../images/logos/browsehappy.gif\" border=\"0\" /></a>\');'
.'}</script>
';


/*
	end
*/
echo '
</div>
</body>
</html>
';


?>
