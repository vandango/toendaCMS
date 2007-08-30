<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Installation Tool
|
| File:	index.php
|
+
*/

define('_TCMS_VALID', 1);


/**
 * toendaCMS Installation Tool
 *
 * This file is used as the installer central.
 *
 * @version 0.4.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Installer
 *
 */


/*
	_POST and _GET
*/

if(isset($_GET['site'])){ $site = $_GET['site']; }
if(isset($_GET['u'])){ $u = $_GET['u']; }
if(isset($_GET['db'])){ $db = $_GET['db']; }
if(isset($_GET['todo'])){ $todo = $_GET['todo']; }
if(isset($_GET['lang'])){ $lang = $_GET['lang']; }
if(isset($_GET['new_engine'])){ $new_engine = $_GET['new_engine']; }


if(isset($_POST['site'])){ $site = $_POST['site']; }
if(isset($_POST['u'])){ $u = $_POST['u']; }
if(isset($_POST['db'])){ $db = $_POST['db']; }
if(isset($_POST['todo'])){ $todo = $_POST['todo']; }
if(isset($_POST['lang'])){ $lang = $_POST['lang']; }
if(isset($_POST['new_engine'])){ $new_engine = $_POST['new_engine']; }




// ERROR

if(isset($_GET['code'])){ $code = $_GET['code']; }

if(isset($_POST['code'])){ $code = $_POST['code']; }




// DATABASE

if(isset($_GET['new_user'])){ $new_user = $_GET['new_user']; }
if(isset($_GET['new_password'])){ $new_password = $_GET['new_password']; }
if(isset($_GET['new_host'])){ $new_host = $_GET['new_host']; }
if(isset($_GET['new_database'])){ $new_database = $_GET['new_database']; }
if(isset($_GET['new_port'])){ $new_port = $_GET['new_port']; }

if(isset($_POST['new_host'])){ $new_host = $_POST['new_host']; }
if(isset($_POST['new_user'])){ $new_user = $_POST['new_user']; }
if(isset($_POST['new_password'])){ $new_password = $_POST['new_password']; }
if(isset($_POST['new_database'])){ $new_database = $_POST['new_database']; }
if(isset($_POST['new_prefix'])){ $new_prefix = $_POST['new_prefix']; }
if(isset($_POST['new_port'])){ $new_port = $_POST['new_port']; }
if(isset($_POST['new_create'])){ $new_create = $_POST['new_create']; }
if(isset($_POST['new_drop'])){ $new_drop = $_POST['new_drop']; }
if(isset($_POST['new_sample'])){ $new_sample = $_POST['new_sample']; }
if(isset($_POST['new_update'])){ $new_update = $_POST['new_update']; }





// SITE

if(isset($_POST['m_title'])){ $m_title = $_POST['m_title']; }
if(isset($_POST['m_name'])){ $m_name = $_POST['m_name']; }
if(isset($_POST['new_key'])){ $new_key = $_POST['new_key']; }
if(isset($_POST['logo'])){ $logo = $_POST['logo']; }
if(isset($_POST['owner'])){ $owner = $_POST['owner']; }
if(isset($_POST['url'])){ $url = $_POST['url']; }
if(isset($_POST['copy'])){ $copy = $_POST['copy']; }
if(isset($_POST['email'])){ $email = $_POST['email']; }
if(isset($_POST['new_show_tcmslogo'])){ $new_show_tcmslogo = $_POST['new_show_tcmslogo']; }
if(isset($_POST['new_show_plt'])){ $new_show_plt = $_POST['new_show_plt']; }
if(isset($_POST['menu'])){ $menu = $_POST['menu']; }
if(isset($_POST['second_menu'])){ $second_menu = $_POST['second_menu']; }
if(isset($_POST['keywords'])){ $keywords = $_POST['keywords']; }
if(isset($_POST['charset'])){ $charset = $_POST['charset']; }
if(isset($_POST['tmp_use_wysiwyg'])){ $tmp_use_wysiwyg = $_POST['tmp_use_wysiwyg']; }
if(isset($_POST['tmp_lang'])){ $tmp_lang = $_POST['tmp_lang']; }
if(isset($_POST['tmp_front_lang'])){ $tmp_front_lang = $_POST['tmp_front_lang']; }
if(isset($_POST['tmp_charset'])){ $tmp_charset = $_POST['tmp_charset']; }
if(isset($_POST['description'])){ $description = $_POST['description']; }
if(isset($_POST['tmp_currency'])){ $tmp_currency = $_POST['tmp_currency']; }
if(isset($_POST['new_tcmsinst'])){ $new_tcmsinst = $_POST['new_tcmsinst']; }
if(isset($_POST['new_websiteowner'])){ $new_websiteowner = $_POST['new_websiteowner']; }
if(isset($_POST['new_owner_url'])){ $new_owner_url = $_POST['new_owner_url']; }
if(isset($_POST['new_copyright'])){ $new_copyright = $_POST['new_copyright']; }





// USER

if(isset($_POST['fullc_password'])){ $fullc_password = $_POST['fullc_password']; }
if(isset($_POST['fullc_check_password'])){ $fullc_check_password = $_POST['fullc_check_password']; }
if(isset($_POST['fullc_webname'])){ $fullc_webname = $_POST['fullc_webname']; }
if(isset($_POST['fullc_name'])){ $fullc_name = $_POST['fullc_name']; }
if(isset($_POST['fullc_email'])){ $fullc_email = $_POST['fullc_email']; }









/*
	init
*/

if(!isset($site)){ $site = 'language'; }
if(!isset($lang)){ $lang = 'en'; }

include_once('../engine/tcms_kernel/tcms_time.lib.php');
include_once('../engine/tcms_kernel/tcms_xml.lib.php');
include_once('../engine/tcms_kernel/tcms_configuration.lib.php');
include_once('../engine/tcms_kernel/tcms_version.lib.php');
include_once('../engine/tcms_kernel/tcms_html.lib.php');
include_once('../engine/tcms_kernel/tcms.lib.php');
include_once('../engine/tcms_kernel/tcms_sql.lib.php');
include_once('../engine/tcms_kernel/pclzip/pclzip.lib.php');
include_once('functions.php');

$tcms_main = new tcms_main('../data');

$tcms_administer_site = 'data';

$param_save_mode = $tcms_main->getPHPSetting('safe_mode');
if($param_save_mode == 'on'){
	$set_save_mode = $tcms_main->setPHPSetting('safe_mode', 'off');
}








/*
	version
*/

$ver_xml = new xmlparser('../engine/tcms_kernel/tcms_version.xml','r');

$release      = $ver_xml->read_section('version', 'release');
$codename     = $ver_xml->read_section('version', 'codename');
$status       = $ver_xml->read_section('version', 'status');
$build        = $ver_xml->read_section('version', 'build');
$cms_name     = $ver_xml->read_section('version', 'name');
$tagline      = $ver_xml->read_section('version', 'tagline');
$release_date = $ver_xml->read_section('version', 'release_date');
$copyright_yr = $ver_xml->read_section('version', 'toenda_copyright');

$version = $cms_name.' | '.$tagline.' &bull; '.$release.' ['.$codename.'] &bull; '.$status;






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
<title>toendaCMS Setup - Your ideas ahead | Willkommen zum toendaCMS Setup / Welcome to the toendaCMS setup</title>
<link href="css/css.css" rel="stylesheet" type="text/css" />
</head>


<body>

<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
<tr><td align="left" height="38" width="100%" style="background: #640008 url(images/head_base.png);">
	<img src="images/head_install.png" border="0" align="left" />
	<img src="images/head_right.png" border="0" align="right" />
</td></tr>
</table>

<br />
<?

include('lang/'.strtolower($lang).'_'.strtoupper($lang).'.php');


switch($site){
	case 'language': $step = 1; break;
	case 'check':    $step = 2; break;
	case 'license':  $step = 3; break;
	case 'database': $step = 4; break;
	case 'site':     $step = 5; break;
	case 'user':     $step = 6; break;
	case 'finish':   $step = 7; break;
	default:         $step = 0; break;
}

?>
<div class="tcms_steps" align="center">
	<img src="images/steps/<? if($step >= 1) echo 's1a'; else echo 's1b'; ?>.png" border="0" />
	<img src="images/steps/<? if($step >= 2) echo 's2a'; else echo 's2b'; ?>.png" border="0" />
	<img src="images/steps/<? if($step >= 3) echo 's3a'; else echo 's3b'; ?>.png" border="0" />
	<img src="images/steps/<? if($step >= 4) echo 's4a'; else echo 's4b'; ?>.png" border="0" />
	<img src="images/steps/<? if($step >= 5) echo 's5a'; else echo 's5b'; ?>.png" border="0" />
	<img src="images/steps/<? if($step >= 6) echo 's6a'; else echo 's6b'; ?>.png" border="0" />
	<img src="images/steps/<? if($step >= 7) echo 's7a'; else echo 's7b'; ?>.png" border="0" />
</div>

<div class="tcms_mainbody">
	<div class="tcms_tablehead"><? echo $frame_title[$lang][$site]; ?></div>
	
	<div class="tcms_tablebody"><?
		
		switch($site){
			case 'language':
				include($site.'.php');
				break;
			
			default:
				include('inc/'.$site.'.php');
				break;
		}
		
	?></div>
	
	<div class="tcms_tablefooter tcms_legal">&nbsp;</div>
</div>

<div align="center" class="tcms_legal">
	<strong><? echo $version; ?></strong>
	<br />
	coded from scratch by
	<a class="tcms_legal" href="http://www.toenda.com" target="_blank">Toenda Software Development</a>.
	&copy; <? echo $copyright_yr; ?> All rights reserved.
	<br />
	<strong>OSI Certified Open Source Software</strong>
	<br />
	<br />
	<a class="tcms_legal" href="http://forum.toendacms.com" target="_blank"><img src="images/toendaCMS_button_02.png" border="0" /></a>
	<br />
	<img src="../engine/images/logos/osi-certified-120x100.png" border="0" />
</div>

<div style="position: absolute; top: 63px; left: 198px;">
<strong class="white"></strong>
</div>

</body>

</html>
