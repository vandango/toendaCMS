<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| PHP Info
|
| File:		info.php
| Version:	0.0.5
|
+
*/





if(isset($_GET['v'])){ $v = $_GET['v']; }
if(isset($_GET['n'])){ $n = $_GET['n']; }
if(isset($_GET['id_user'])){ $id_user = $_GET['id_user']; }

if(isset($_POST['mediaImage'])){ $mediaImage = $_POST['mediaImage']; }
if(isset($_POST['saveMedia'])){ $saveMedia = $_POST['saveMedia']; }
if(isset($_POST['todo'])){ $todo = $_POST['todo']; }





/*****************
* INI
*/

define('_TCMS_VALID', 1);

$language_stage = 'admin';
include_once('../language/lang_admin.php');

$tcms_administer_site = 'data';

include_once('../tcms_kernel/tcms_time.lib.php');
include_once('../tcms_kernel/tcms.lib.php');
include_once('../tcms_kernel/tcms_html.lib.php');
include_once('../tcms_kernel/tcms_gd.lib.php');
include_once('../tcms_kernel/tcms_sql.lib.php');
include_once('../tcms_kernel/tcms_configuration.lib.php');
include_once('../../'.$tcms_administer_site.'/tcms_global/database.php');


$tcms_main = new tcms_main('../../'.$tcms_administer_site, $choosenDB);

// database
$choosenDB = $tcms_main->secure_password($tcms_db_engine, 'en');
$sqlUser   = $tcms_main->secure_password($tcms_db_user, 'en');
$sqlPass   = $tcms_main->secure_password($tcms_db_password, 'en');
$sqlHost   = $tcms_main->secure_password($tcms_db_host, 'en');
$sqlDB     = $tcms_main->secure_password($tcms_db_database, 'en');
$sqlPort   = $tcms_main->secure_password($tcms_db_port, 'en');
$sqlPrefix = $tcms_main->secure_password($tcms_db_prefix, 'en');
$tcms_db_prefix = $sqlPrefix;

$tcms_main->setDatabaseInfo($choosenDB);




//***********************************
// IF NOT LOGED IN
//
if(isset($id_user)){
	//***********************************************
	// IF THE FILE TO OLD, UNLINK IT
	//
	if($choosenDB == 'xml'){ $tcms_main->check_session($id_user, 'admin'); }
	else{ $tcms_main->check_sql_session($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $id_user); }
	
	
	
	
	
	
	
	
	if($choosenDB == 'xml'){
		if(isset($id_user) && $id_user != '' && file_exists('session/'.$id_user) && filesize('session/'.$id_user) != 0){ $check_session = true; }
		else{ $check_session = false; }
	}
	else{
		$check_session = $tcms_main->check_session_exists($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $id_user);
	}
	
	
	
	if($check_session){
		phpinfo();
	}
	else{
		echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
		.'<h1>'._MSG_SESSION_EXPIRED.'</h2>'
		.'</div>';
	}
}
else{
	echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
	.'<h1>'._DIE_LOGIN.'</h2>'
	.'</div>';
}

?>
