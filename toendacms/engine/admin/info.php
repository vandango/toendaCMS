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
| File:	info.php
|
+
*/


/**
 * PHP Info
 *
 * This is used as a help window.
 *
 * @version 0.1.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['v'])){ $v = $_GET['v']; }
if(isset($_GET['n'])){ $n = $_GET['n']; }
if(isset($_GET['id_user'])){ $id_user = $_GET['id_user']; }

if(isset($_POST['mediaImage'])){ $mediaImage = $_POST['mediaImage']; }
if(isset($_POST['saveMedia'])){ $saveMedia = $_POST['saveMedia']; }
if(isset($_POST['todo'])){ $todo = $_POST['todo']; }



/*
	init
*/

// define system
define('_TCMS_VALID', 1);

// include import loader
include_once('../tcms_kernel/tcms_loader.lib.php');

// load language loader
$language_stage = 'admin';
include_once('../language/lang_admin.php');

// load current active page
include_once('../../site.php');
define('_TCMS_PATH', '../../'.$tcms_site[0]['path']);

// import classes
include_once(_TCMS_PATH.'/tcms_global/database.php');

using('toendacms.kernel.time', false, true);
using('toendacms.kernel.main', false, true);
using('toendacms.kernel.html', false, true);
using('toendacms.kernel.gd', false, true);
using('toendacms.kernel.sql', false, true);
using('toendacms.kernel.configuration', false, true);
using('toendacms.kernel.account_provider', false, true);
using('toendacms.kernel.authentication', false, true);

// main
$tcms_main = new tcms_main(_TCMS_PATH, $choosenDB);

// authentication
$tcms_auth = new tcms_authentication(_TCMS_PATH, $c_charset, $imagePath);

// account provider
$tcms_ap = new tcms_account_provider(_TCMS_PATH, $c_charset, $tcms_time);

// database
$choosenDB = $tcms_db_engine;
$sqlUser   = $tcms_db_user;
$sqlPass   = $tcms_db_password;
$sqlHost   = $tcms_db_host;
$sqlDB     = $tcms_db_database;
$sqlPort   = $tcms_db_port;
$sqlPrefix = $tcms_db_prefix;
$tcms_db_prefix = $sqlPrefix;

$tcms_main->setDatabaseInfo($choosenDB);

// display
if(isset($id_user)) {
	$check_session = $tcms_auth->checkSessionExist($id_user, true);
	
	if($check_session) {
		phpinfo();
	}
	else {
		echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
		.'<h1>'._MSG_SESSION_EXPIRED.'</h2>'
		.'</div>';
	}
}
else {
	echo '<div align="center" style=" padding: 100px 10px 100px 10px; border: 1px solid #333; background-color: #f8f8f8; font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\', Serif;">'
	.'<h1>'._DIE_LOGIN.'</h2>'
	.'</div>';
}

?>
