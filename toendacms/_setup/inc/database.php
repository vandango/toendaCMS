<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Install database
|
| File:	database.php
|
+
*/


/**
 * Install database
 *
 * This file is used for the database actions.
 *
 * @version 0.6.8
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Installer
 *
 */


/*
	init
*/

if(!isset($todo))
	$todo = 'selectDB';




/*
	select database
*/

if($todo == 'selectDB'){
	echo '<h2>'._TCMS_DB_CHOOSE.'</h2>';
	echo '<h3>'._TCMS_DB_SYSTEMS.'</h3>';
	echo '<hr />';
	echo '<br />';
	
	echo '<h1>'._TCMS_DB_NEWINSTALL.'</h1>';
	//echo '<h3>'._TCMS_DB_PG_NOT.'</h3>';
	echo '<br />';
	
	
	echo '<div style="display: block; width: 600px; height: 160px;">';
		echo '<div style="display: block; float: left; width: 220px;">'
		.'<a class="tcms_main" href="index.php?site=database&amp;lang='.$lang.'&amp;todo=global&amp;db=mysql">'
		.'<img class="tcms_dbimage" src="images/mysql.jpg" border="0" />'
		.'</a>'
		.'</div>';
		
		
		echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 220px;">'
		.'<a class="tcms_main" href="index.php?site=database&amp;lang='.$lang.'&amp;todo=global&amp;db=pgsql">'
		.'<img class="tcms_dbimage" src="images/pgsql.jpg" border="0" />'
		.'</a>'
		.'</div>';
		
		
		echo '<div style="display: block; margin: 0 0 0 470px;">';
		echo '<!--[if IE]><div style="position: absolute; margin: 0 0 0 0;"><![endif]-->';
		echo '<a class="tcms_main" href="index.php?site=database&amp;lang='.$lang.'&amp;todo=global&amp;db=xml">'
		.'<img class="tcms_dbimage" src="images/xml.jpg" border="0" />'
		.'</a>'
		.'</div>';
		echo '<!--[if IE]></div><![endif]-->';
	echo '</div>';
	
	echo '<br />';
	
	echo '<div style="display: block; width: 600px; height: 160px;">';
		echo '<div style="display: block; float: left; width: 220px;">'
		.'<a class="tcms_main" href="index.php?site=database&amp;lang='.$lang.'&amp;todo=global&amp;db=mssql">'
		.'<img class="tcms_dbimage" src="images/mssql_2005.jpg" border="0" />'
		.'</a>'
		.'</div>';
		
		
		echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 220px;">'
		.''
		.'</div>';
		
		
		echo '<div style="display: block; margin: 0 0 0 470px;">';
		echo '<!--[if IE]><div style="position: absolute; margin: 0 0 0 0;"><![endif]-->';
		echo ''
		.'</div>';
		echo '<!--[if IE]></div><![endif]-->';
	echo '</div>';
	
	
	echo '<br />';
	echo '<hr />';
	echo '<br />';
	
	echo '<h1>'._TCMS_DB_UPDATE.'</h1>';
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 220px; text-align: center;">'
	.'<a class="tcms_main" href="index.php?site=database&amp;lang='.$lang.'&amp;todo=update&amp;db=mysql">'
	._TCMS_DB_MYSQL_UPDATE
	.'</a>'
	.'</div>';
	
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 220px; text-align: center;">'
	.'<a class="tcms_main" href="index.php?site=database&amp;lang='.$lang.'&amp;todo=update&amp;db=pgsql">'
	._TCMS_DB_PGSQL_UPDATE
	.'</a>'
	.'</div>';
	
	
	echo '<div style="display: block; margin: 0 0 0 450px; text-align: center;">'
	.'<a class="tcms_main" href="index.php?site=database&amp;lang='.$lang.'&amp;todo=update&amp;db=xml">'
	._TCMS_DB_XML_UPDATE
	.'</a>'
	.'</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 220px; text-align: center;">'
	.'<a class="tcms_main" href="index.php?site=database&amp;lang='.$lang.'&amp;todo=update&amp;db=mssql">'
	._TCMS_DB_MSSQL_UPDATE
	.'</a>'
	.'</div>';
	
	
	echo '<br />';
	echo '<br />';
	
	
	echo '<br />';
	echo '<hr />';
	echo '<br />';
	
	
	echo _TCMS_DB_UPDATE_TEXT;
	
	
	echo '<br />';
	echo '<br />';
	echo '<hr />';
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; margin: 0 0 0 40px; width: '.$width.'px;">'
	.'<a class="tcms_main" href="index.php?site=license&amp;lang='.$lang.'">'
	.'&larr; '._TCMS_BACK
	.'</a>'
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 20px; width: 250px;">&nbsp;</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>'
	.'<br />';
}




/*
	update toendaCMS
*/

if($todo == 'update') {
	echo '<h2>'._TCMS_DB_UPDATE_TITLE.'</h2>';
	echo '<h3>'._TCMS_DB_UPDATE_DB1.' ';
	
	switch($db){
		case 'mysql': echo 'MySQL'; break;
		case 'pgsql': echo 'PostgreSQL'; break;
		case 'mssql': echo 'Microsoft SQL Server'; break;
		case 'sqlite': echo 'SQLite'; break;
		case 'xml': echo 'XML'; break;
		default: echo 'XML'; break;
	}
	
	echo ' '._TCMS_DB_UPDATE_DB2.'</h3>';
	echo '<hr />';
	echo '<br />';
	
	
	echo _TCMS_DB_UPDATE_TEXT;
	
	
	echo '<br />';
	echo '<br />';
	echo '<hr />';
	echo '<br />';
	
	
	
	echo '<form action="index.php?site=database&amp;lang='.$lang.'" id="update_form" method="post">'
	.'<input name="todo" type="hidden" value="save_update" />'
	.'<input name="new_engine" type="hidden" value="'.$db.'" />';
	
	
	
	echo '<div style="display: block; float: left; width: 220px; font-weight: bold;">'
	._TCMS_DB_UPDATE_VERSION_107
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
	.'<input checked="checked" name="new_update" type="radio" value="107" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	
	echo '<div style="display: block; float: left; width: 220px; font-weight: bold;">'
	._TCMS_DB_UPDATE_VERSION_156
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
	.'<input checked="checked" name="new_update" type="radio" value="107" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<br />';
	echo '<hr />';
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; margin: 0 0 0 40px; width: '.$width.'px;">'
	.'<a class="tcms_main" href="index.php?site=database&amp;lang='.$lang.'">'
	.'&larr; '._TCMS_BACK
	.'</a>'
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 20px; width: 250px;">&nbsp;</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">'
	.'<a class="tcms_main" href="javascript:document.getElementById(\'update_form\').submit();">'
	._TCMS_NEXT.' &rarr;'
	.'</a>'
	.'</div>'
	.'<br />';
}








/*
	database settings
*/

if($todo == 'global'){
	echo '<h2>'._TCMS_DB_NEWINSTALL_TITLE.'</h2>';
	echo '<h3>'._TCMS_DB_NEWINSTALL_DB1.' ';
	
	switch($db){
		case 'mysql': echo 'MySQL'; break;
		case 'pgsql': echo 'PostgreSQL'; break;
		case 'mssql': echo 'Microsoft SQL Server'; break;
		case 'sqlite': echo 'SQLite (testing)'; break;
		case 'xml': echo 'XML'; break;
		default: echo 'XML'; break;
	}
	
	echo _TCMS_DB_NEWINSTALL_DB2.'</h3>';
	echo '<hr />';
	echo '<br />';
	
	
	echo _TCMS_DB_NEWINSTALL_TEXT;
	
	
	echo '<br />';
	echo '<br />';
	echo '<hr />';
	echo '<br />';
	
	
	/*
		text for postgre database
	*/
	
	if($db == 'pgsql') {// || $db == 'mssql'){
		echo '<div style="display: block; width: 500px; border: 2px solid #333; background: #ececec; padding: 0 8px 0 8px; color: #ff0000;">'
		.'<h3>'._TCMS_DB_PG_CREATEDB.'</h3>'
		.'</div><br />';
		echo '<br />';
	}
	
	
	
	// form head
	echo '<form action="index.php?site=database" id="db_form" method="post">'
	.'<input name="todo" type="hidden" value="save" />'
	.'<input name="lang" type="hidden" value="'.$lang.'" />'
	.'<input name="new_engine" type="hidden" value="'.$db.'" />';
	
	
	
	echo '<div style="display: block; float: left; width: 220px; font-weight: bold;">'
	._TCMS_DB_HOST
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
	.'<input class="tcms_input" name="new_host" type="text" value="localhost" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 220px; font-weight: bold;">'
	._TCMS_DB_USERNAME
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
	.'<input class="tcms_input" name="new_user" type="text" value="root" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 220px; font-weight: bold;">'
	._TCMS_DB_PASSWORD
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
	.'<input class="tcms_input" name="new_password" type="text" value="" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 220px; font-weight: bold;">'
	._TCMS_DB_DATABASE
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
	.'<input class="tcms_input" name="new_database" type="text" value="toendacms" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 220px; font-weight: bold;">'
	._TCMS_DB_TABLEPREFIX
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
	.'<input class="tcms_input" name="new_prefix" type="text" value="tcms_" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	switch($db){
		case 'mysql': $engine_port = '3306'; break;
		case 'pgsql': $engine_port = '5432'; break;
		default: $engine_port = '';
	}
	
	echo '<div style="display: block; float: left; width: 220px; font-weight: bold;">'
	._TCMS_DB_PORT
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
	.'<input class="tcms_input" name="new_port" type="text" value="'.$engine_port.'" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	switch($db){
		case 'mssql':
		case 'mysql':
			echo '<div style="display: block; float: left; width: 220px; font-weight: bold;">'
			._TCMS_DB_CREATEDB
			.'</div>';
			
			echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
			.'<input name="new_create" id="new_create" type="checkbox" checked="checked" value="1" />'
			.'</div>';
			
			echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
			
			echo '<br />';
			break;
	}
	
	
	switch($db){
		case 'mysql':
			echo '<div style="display: block; float: left; width: 220px; font-weight: bold;">'
			._TCMS_DB_DELETEDBBEFORECREATE
			.'</div>';
			
			echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
			.'<input name="new_drop" id="new_drop" type="checkbox" value="1" />'
			.'</div>';
			
			echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
			
			echo '<br />';
			break;
	}
	
	
	echo '<div style="display: block; float: left; width: 220px; font-weight: bold;">'
	._TCMS_DB_SAVE_SAMPLE_DATA
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
	.'<input name="new_sample" id="new_sample" type="checkbox" checked="checked" value="1" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
	
	
	echo '<br />';
	echo '<hr />';
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; margin: 0 0 0 40px; width: '.$width.'px;">'
	.'<a class="tcms_main" href="index.php?site=database&amp;lang='.$lang.'">'
	.'&larr; '._TCMS_BACK
	.'</a>'
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 20px; width: 250px;">&nbsp;</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">'
	.'<a class="tcms_main" href="javascript:document.getElementById(\'db_form\').submit();">'
	._TCMS_NEXT.' &rarr;'
	.'</a>'
	.'</div>'
	.'<br />';
	
	
	// Table end
	echo '</form>';
	
	
	// xml engine relocate
	if($db == 'xml') {
		if($tcms_main->get_php_setting('safe_mode') == 'off') {
			echo '<script>'
			.'document.getElementById(\'db_form\').submit();'
			.'</script>';
		}
		else {
			echo '<script>'
			.'document.location=\'index.php?site=error&code=1&lang='.$lang.'\';'
			.'</script>';
		}
	}
}







/*
	update database settings
*/

if($todo == 'save_update') {
	include_once('../'.$tcms_administer_site.'/tcms_global/database.php');
	
	$new_user     = $tcms_db_user;
	$new_password = $tcms_db_password;
	$new_host     = $tcms_db_host;
	$new_database = $tcms_db_database;
	$new_port     = $tcms_db_port;
	$new_prefix   = $tcms_db_prefix;
	
	if($new_engine == 'xml') {
		// XML data settings
		$gzFileName = 'xml_pdate_'.$new_update.'.zip';
		$gzFilePath = '../data/';
		$gzFileDir  = '../data';
		
		// copy file to data directory
		copy('db/'.$gzFileName, $gzFilePath.$gzFileName);
		
		// ZLib coding
		$archive = new PclZip($gzFilePath.$gzFileName);
		if($archive->extract(PCLZIP_OPT_PATH, $gzFileDir) == 0){
			die(_MSG_ERROR.' : '.$archive->errorInfo(true));
		}
		
		// remove zip file
		unlink($gzFilePath.$gzFileName);
		
		
		// update to new multi-language
		$layout_xml = new xmlparser('../'.$tcms_administer_site.'/tcms_global/var.xml','r');
		$plang = $layout_xml->read_value('front_lang');
		
		// update now
		updateLanguageForXML($tcms_administer_site);
	}
	else {
		if(file_exists('db/'.$new_engine.'_update_'.$new_update.'.sql')) {
			$fp = fopen('db/'.$new_engine.'_update_'.$new_update.'.sql', 'r');
			$tcms_sql_command = fread($fp, filesize('db/'.$new_engine.'_update_'.$new_update.'.sql'));
			fclose($fp);
			
			$sqlAL = new sqlAbstractionLayer($new_engine);
			
			
			// Fill the database with toendaCMS tables
			$sqlCN = $sqlAL->sqlConnect($new_user, $new_password, $new_host, $new_database, $new_port);
			
			$pieces = $tcms_main->split_sql($tcms_sql_command);
			
			for($i = 0; $i < count($pieces); $i++){
				$pieces[$i] = trim($pieces[$i]);
				if(!empty($pieces[$i]) && $pieces[$i] != '#'){
					$pieces[$i] = str_replace( "#####", $new_prefix, $pieces[$i]);
					//echo $pieces[$i].'<br />';
					$sqlQR = $sqlAL->sqlQuery($pieces[$i]);
				}
			}
			
			
			// update to new multi-language
			$layout_xml = new xmlparser('../'.$tcms_administer_site.'/tcms_global/var.xml','r');
			$plang = $layout_xml->read_value('front_lang');
			
			if(file_exists('db/'.$new_engine.'_ext_updateml.sql')){
				$fp = fopen('db/'.$new_engine.'_ext_updateml.sql', 'r');
				$tcms_ml = fread($fp, filesize('db/'.$new_engine.'_ext_updateml.sql'));
				fclose($fp);
				
				$sqlAL = new sqlAbstractionLayer($new_engine);
				
				$sqlCN = $sqlAL->sqlConnect($new_user, $new_password, $new_host, $new_database, $new_port);
				
				$pieces = $tcms_main->split_sql($tcms_ml);
				
				for($i = 0; $i < count($pieces); $i++){
					$pieces[$i] = trim($pieces[$i]);
					if(!empty($pieces[$i]) && $pieces[$i] != '#'){
						$pieces[$i] = str_replace( "#####", $new_prefix, $pieces[$i]);
						$pieces[$i] = str_replace( "+++++", $plang, $pieces[$i]);
						//echo $pieces[$i].'<br />';
						$sqlQR = $sqlAL->sqlQuery($pieces[$i]);
					}
				}
			}
		}
	}
	
	
	// create components folder
	if(!is_dir('../'.$tcms_administer_site.'/components/')) {
		mkdir('../'.$tcms_administer_site.'/components/');
		copy('db/index.html', '../'.$tcms_administer_site.'/components/index.html');
	}
	
	
	// create captchas folder
	if(!is_dir('../cache/captcha/')) {
		mkdir('../cache/captcha/');
		copy('db/index.html', '../cache/captcha/index.html');
	}
	
	
	if(file_exists('../'.$tcms_administer_site.'/tcms_global/database.php')) {
		echo '<script>'
		.'document.location.href=\'index.php?site=finish&db='.$new_engine.'\';'
		.'</script>';
	}
	else {
		echo '<script>'
		.'alert(\''._TCMS_DB_UPDATE_NOT_SUCCESSFULL.'\n'._TCMS_DB_CHECK_WRITERIGHTS.'\');'
		.'document.location.href=\'index.php?site=check\';'
		.'</script>';
	}
}






/*
	save database settings
*/

if($todo == 'save'){
	if(!isset($new_user)   || $new_user == '')   { $new_user   = 'root'; }
	if(!isset($new_host)   || $new_host == '')   { $new_host   = 'localhost'; }
	if(!isset($new_drop)   || empty($new_drop))  { $new_drop   = 0; }
	if(!isset($new_sample) || empty($new_sample)){ $new_sample = 0; }
	if(!isset($new_create) || empty($new_create)){ $new_create = 0; }
	
	
	if(!isset($new_port) || $new_port == '' || empty($new_port)){
		switch($new_engine){
			//case 'mysql': $new_port = '3306'; break;
			//case 'pgsql': $new_port = '5432'; break;
			default: $new_port = '';
		}
	}
	
	
	$set_engine   = $new_engine;
	$set_user     = $new_user;
	$set_password = $new_password;
	$set_host     = $new_host;
	$set_database = $new_database;
	$set_prefix   = $new_prefix;
	$set_port     = $new_port;
	
	
	//***************************************
	
	$fp_header = ''
.'<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Database Usersettings
|
| File:		database.php
| Version:	0.0.1
|
+
*/

$tcms_db_engine   = \''.$set_engine.'\';
$tcms_db_user     = \''.$set_user.'\';
$tcms_db_password = \''.$set_password.'\';
$tcms_db_host     = \''.$set_host.'\';
$tcms_db_database = \''.$set_database.'\';
$tcms_db_prefix   = \''.$set_prefix.'\';
$tcms_db_port     = \''.$set_port.'\';

?>
';
	
	$fp = fopen('../'.$tcms_administer_site.'/tcms_global/database.php', 'w');
	fwrite($fp, $fp_header);
	fclose($fp);
	
	//***************************************
	
	
	
	if($new_drop == 1) {
		$sqlAL = new sqlAbstractionLayer($new_engine);
		$sqlCN = $sqlAL->sqlConnectWithoutDB($new_user, $new_password, $new_host, $new_port);
		
		switch($new_engine){
			case 'mysql':
				$sql = 'DROP DATABASE `'.$new_database.'`';
				break;
		}
		
		$sqlQR = $sqlAL->sqlQuery($sql);
	}
	
	
	
	if($new_engine == 'xml') {
		// XML data settings
		$gzFileName = 'xml_data.zip';
		$gzFilePath = '../data/';
		$gzFileDir  = '../data';
		
		$gzMainName = 'xml_tcms_global.zip';
		$gzMainPath = '../data/tcms_global/';
		$gzMainDir  = '../data/tcms_global';
		
		// copy file to data directory
		copy('db/'.$gzFileName, $gzFilePath.$gzFileName);
		copy('db/'.$gzMainName, $gzMainPath.$gzMainName);
		
		// ZLib coding
		$archive = new PclZip($gzFilePath.$gzFileName);
		if($archive->extract(PCLZIP_OPT_PATH, $gzFileDir) == 0){
			die(_MSG_ERROR.' : '.$archive->errorInfo(true));
		}
		
		// ZLib coding
		$archive2 = new PclZip($gzMainPath.$gzMainName);
		if($archive2->extract(PCLZIP_OPT_PATH, $gzMainDir) == 0){
			die(_MSG_ERROR.' : '.$archive2->errorInfo(true));
		}
		
		// remove zip file
		unlink($gzFilePath.$gzFileName);
		
		// remove zip file
		unlink($gzMainPath.$gzMainName);
	}
	else {
		if($new_sample == 1) {
			$file = 'db/'.$new_engine.'_sample.sql';
		}
		else {
			$file = 'db/'.$new_engine.'_empty.sql';
			
			//$tcms_main->rmdirr('../'.$tcms_administer_site.'/images/albums/625106/');
			//$tcms_main->rmdirr('../'.$tcms_administer_site.'/thumbnails/625106/');
		}
		
		$fp = fopen($file, 'r');
		$tcms_sql_command = fread($fp, filesize($file));
		fclose($fp);
		
		$sqlAL = new sqlAbstractionLayer($new_engine);
		
		if($new_create == 1){
			switch($new_engine){
				case 'mysql':
					//
					// Create Database
					//
					
					$sqlCN = $sqlAL->sqlConnectWithoutDB($new_user, $new_password, $new_host, $new_port);
					
					if(isset($sqlCN['num']) && $sqlCN['num'] == 0){
						echo '<script>'
						.'alert(\''._TCMS_DB_CONNECTION.'\');'
						.'document.location.href=\'index.php?site=database&lang='.$lang.'&db='.$new_engine.'\';'
						.'</script>';
					}
					
					$sql = 'CREATE DATABASE `'.$new_database.'`';
					$sqlQR = $sqlAL->sqlQuery($sql);
					
					//
					//$sqlQR = $sqlAL->sqlDisconnect($sqlCN);
					//
					break;
				
				case 'mssql':
					//
					// Create Database
					//
					
					$sqlCN = $sqlAL->sqlConnectWithoutDB($new_user, $new_password, $new_host, $new_port);
					
					if(isset($sqlCN['num']) && $sqlCN['num'] == 0){
						echo '<script>'
						.'alert(\''._TCMS_DB_CONNECTION.'\');'
						.'document.location.href=\'index.php?site=database&lang='.$lang.'&db='.$new_engine.'\';'
						.'</script>';
					}
					
					$sql = 'CREATE DATABASE '.$new_database;
					$sqlQR = $sqlAL->sqlQuery($sql);
					
					//
					//$sqlQR = $sqlAL->sqlDisconnect($sqlCN);
					//
					break;
			}
		}
		
		
		// Fill the database with toendaCMS tables
		$sqlCN = $sqlAL->sqlConnect($new_user, $new_password, $new_host, $new_database, $new_port);
		
		if(isset($sqlCN['num']) && $sqlCN['num'] == 0){
			echo '<script>'
			.'alert(\''._TCMS_DB_CONNECTION.'\');'
			.'document.location.href=\'index.php?site=database&lang='.$lang.'&db='.$new_engine.'\';'
			.'</script>';
		}
		
		$pieces = $tcms_main->split_sql($tcms_sql_command);
		
		for($i = 0; $i < count($pieces); $i++){
			$pieces[$i] = trim($pieces[$i]);
			
			if(!empty($pieces[$i]) && $pieces[$i] != '#'){
				$pieces[$i] = str_replace('#####', $new_prefix, $pieces[$i]);
				//echo $pieces[$i].'<hr />';
				$sqlQR = $sqlAL->sqlQuery($pieces[$i]);
			}
		}
		
		// optimize
		if(file_exists('db/'.$new_engine.'_ext_optimize.sql')) {
			$fp = fopen('db/'.$new_engine.'_ext_optimize.sql', 'r');
			$tcms_sql_command = fread($fp, filesize('db/'.$new_engine.'_ext_optimize.sql'));
			fclose($fp);
			
			$pieces = $tcms_main->split_sql($tcms_sql_command);
			
			for($i = 0; $i < count($pieces); $i++){
				$pieces[$i] = trim($pieces[$i]);
				
				if(!empty($pieces[$i]) && $pieces[$i] != '#'){
					$pieces[$i] = str_replace('#####', $new_prefix, $pieces[$i]);
					//echo $pieces[$i].'<hr />';
					$sqlQR = $sqlAL->sqlQuery($pieces[$i]);
				}
			}
		}
	}
	
	/*
	$can = $tcms_main->canCHMOD('../data/');
	if($can){
		$tcms_main->reCHMOD('../data/', 0777);
	}
	*/
	
	
	if(file_exists('../'.$tcms_administer_site.'/tcms_global/database.php')) {
		echo '<script>'
		.'document.location.href=\'index.php?site=site&lang='.$lang.'&db='.$new_engine.'\';'
		.'</script>';
	}
	else {
		echo '<script>'
		.'alert(\''._TCMS_DB_SETTINGS.'\n'._TCMS_DB_CHECK_WRITERIGHTS.'\');'
		.'document.location.href=\'index.php?site=check&lang='.$lang.'\';'
		.'</script>';
	}
}

?>
