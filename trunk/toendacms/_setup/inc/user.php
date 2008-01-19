<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Create user
|
| File:	user.php
|
+
*/


/**
 * Create user
 *
 * This file is used to create a user.
 *
 * @version 0.2.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Installer
 *
 */


if(!isset($todo)){ $todo = 'global'; }



/*
	main setting
*/

if($todo == 'global'){
	echo '<h2>'._TCMS_USER_TITLE.'</h2>';
	echo '<h3>'._TCMS_DB_NEWINSTALL_DB1.' '
	.( $db == 'mysql' ? 'MySQL' : ( $db == 'pgsql' ? 'PostgreSQL' : 'XML' ) ).'&nbsp;'
	._TCMS_DB_NEWINSTALL_DB2.'</h3>';
	echo '<hr />';
	echo '<br />';
	
	
	echo _TCMS_USER_TEXT;
	
	
	echo '<br />';
	echo '<br />';
	echo '<hr />';
	echo '<br />';
	
	
	
	// form head
	echo '<form action="index.php?site=user&amp;lang='.$lang.'" id="user_form" method="post">'
	.'<input name="todo" type="hidden" value="save" />'
	.'<input name="db" type="hidden" value="'.$db.'" />';
	
	
	
	echo '<h3>'._TCMS_USER_CREATE_USER.'</h3>';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_USER_FULLNAME
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="fullc_name" type="text" value="" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_USER_USERNAME
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="fullc_webname" type="text" value="root" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_USER_PASSWORD
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="fullc_password" type="text" value="banane" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_USER_PASSWORD_RETYPE
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="fullc_check_password" type="text" value="banane" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; width: 150px; font-weight: bold;">'
	._TCMS_USER_EMAIL
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 390px;">'
	.'<input class="tcms_input_site" name="fullc_email" type="text" value="your@email.here" />'
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 600px;">&nbsp;</div>';
	
	
	
	echo '<br />';
	echo '<hr />';
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; margin: 0 0 0 40px; width: '.$width.'px;">'
	.'<a class="tcms_main" href="index.php?site=site&amp;lang='.$lang.'&amp;db='.$db.'">'
	.'&larr; '._TCMS_BACK
	.'</a>'
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 20px; width: 250px;">&nbsp;</div>';
	
	echo '<div style="display: block; margin: 0 0 0 540px;">'
	.'<a class="tcms_main" href="javascript:document.getElementById(\'user_form\').submit();">'
	._TCMS_FINISH.' &rarr;'
	.'</a>'
	.'</div>'
	.'<br />';
	
	
	
	
	// table end
	echo '</form>';
}







/*
	SAVE, EDIT AND DELETE
*/

if($todo == 'save'){
	//***************************************
	require('../'.$tcms_administer_site.'/tcms_global/database.php');
	
	$new_engine   = $tcms_db_engine;
	$new_user     = $tcms_db_user;
	$new_password = $tcms_db_password;
	$new_host     = $tcms_db_host;
	$new_database = $tcms_db_database;
	$new_port     = $tcms_db_port;
	$new_prefix   = $tcms_db_prefix;
	
	
	
	$tmp_md5   = substr(md5(microtime()), 0, 32);
	$var_conf  = $tmp_md5;
	
	if(!isset($fullc_webname) || $fullc_webname == ''){ $fullc_webname = 'root'; }
	
	
	
	$fullc_name    = $tcms_main->encodeText($fullc_name, '2', $c_charset);
	$fullc_webname = $tcms_main->encodeText($fullc_webname, '2', $c_charset);
	
	
	
	if($fullc_password == '' || $fullc_password != $fullc_check_password){
		echo '<script>alert(\''._TCMS_USER_PASSWORD_ERROR.'\');</script>';
		echo '<script>history.go(-1);</script>';
	}
	else{
		$save_password = md5($fullc_password);
		
		if($new_engine == 'xml'){
			/*
				user
			*/
			$xmluser = new xmlparser('../'.$tcms_administer_site.'/tcms_user/'.$var_conf.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('user');
			
			$xmluser->write_value('name', $fullc_name);
			$xmluser->write_value('username', $fullc_webname);
			$xmluser->write_value('password', $save_password);
			$xmluser->write_value('email', $fullc_email);
			$xmluser->write_value('group', 'Administrator');
			$xmluser->write_value('join_date', date('Y.m.d-H:i:s'));
			$xmluser->write_value('birthday', '..');
			$xmluser->write_value('gender', '');
			$xmluser->write_value('occupation', '');
			$xmluser->write_value('homepage', '');
			$xmluser->write_value('icq', '');
			$xmluser->write_value('aim', '');
			$xmluser->write_value('yim', '');
			$xmluser->write_value('msn', '');
			$xmluser->write_value('skype', '');
			$xmluser->write_value('enabled', '1');
			$xmluser->write_value('tcms_enabled', '1');
			$xmluser->write_value('signature', '');
			$xmluser->write_value('location', '');
			$xmluser->write_value('hobby', '');
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('user');
			
			
			
			
			/*
				note
			*/
			$xmluser = new xmlparser('../'.$tcms_administer_site.'/tcms_notepad/'.$var_conf.'.xml','w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('note');
			
			$xmluser->write_value('name', $fullc_webname);
			$xmluser->write_value('text', _TCMS_USER_NOTEBOOK.' ...');
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('note');
			
			
			
			
			/*
				contact
			*/
			$tmp_maintag = substr(md5(microtime()), 0, 10);
			
			$xmluser = new xmlparser('../'.$tcms_administer_site.'/tcms_contacts/'.$tmp_maintag.'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('contact');
			
			$xmluser->write_value('default_con', '1');
			$xmluser->write_value('published', '1');
			$xmluser->write_value('name', $fullc_name);
			$xmluser->write_value('position', '');
			$xmluser->write_value('email', $fullc_email);
			$xmluser->write_value('street', '');
			$xmluser->write_value('country', '');
			$xmluser->write_value('state', '');
			$xmluser->write_value('town', '');
			$xmluser->write_value('postal', '');
			$xmluser->write_value('phone', '');
			$xmluser->write_value('fax', '');
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('contact');
			
			
			
			if(file_exists('../'.$tcms_administer_site.'/tcms_user/'.$var_conf.'.xml')){ $ccNext = true; }
			else{ $ccNext = false; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($new_engine);
			$sqlCN = $sqlAL->sqlConnect($new_user, $new_password, $new_host, $new_database, $new_port);
			
			
			/*
				user
			*/
			switch($new_engine){
				case 'mysql':
					$newSQLColumns = '`name`, `username`, `password`, `email`, `group`, `join_date`, `enabled`, `static_value`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'name, username, "password", email, "group", join_date, enabled, static_value';
					break;
			}
			
			$newSQLData = "'".$fullc_name."', '".$fullc_webname."', '".$save_password."', '".$fullc_email."', 'Administrator', '".date('Y.m.d-H:i:s')."', 1, 1";
			
			$sqlQR = $sqlAL->sqlCreateOne($new_prefix.'user', $newSQLColumns, $newSQLData, $var_conf);
			
			
			
			
			/*
				note
			*/
			switch($new_engine){
				case 'mysql':
					$newSQLColumns = '`name`, `note`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'name, note';
					break;
			}
			
			$newSQLData = "'".$fullc_webname."', '"._TCMS_USER_NOTEBOOK."'";
			
			$sqlQR = $sqlAL->sqlCreateOne($new_prefix.'notepad', $newSQLColumns, $newSQLData, $var_conf);
			
			
			
			
			/*
				contact
			*/
			$tmp_maintag = substr(md5(microtime()), 0, 10);
			
			switch($new_engine){
				case 'mysql':
					$newSQLColumns = '`default_con`, `published`, `name`, `position`, `email`, `street`, `country`, `state`, `town`, `postal`, `phone`, `fax`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'default_con, published, name, "position", email, street, country, state, town, postal, phone, fax';
					break;
			}
			
			$newSQLData = "1, 1, '".$fullc_name."', '', '".$fullc_email."', '', '', '', '', '', '', ''";
			
			$sqlQR = $sqlAL->sqlCreateOne($new_prefix.'contacts', $newSQLColumns, $newSQLData, $tmp_maintag);
			
			
			
			$ccNext = true;
		}
		
		
		
		if($ccNext){
			echo '<script>document.location.href=\'index.php?site=finish&lang='.$lang.'&db='.$new_engine.'\';</script>';
		}
		else{
			echo '<script>alert(\''._TCMS_USER_ERROR.'\');</script>';
			echo '<script>document.location.href=\'index.php?site=user&lang='.$lang.'&db='.$db.'\';</script>';
		}
	}
}

?>
