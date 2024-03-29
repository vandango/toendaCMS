<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| User Register Module
|
| File:	ext_register.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS User Register Module
 *
 * This module is used for the register functions.
 *
 * @version 0.7.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content-Modules
 */


if(isset($_GET['cmd'])) { $cmd = $_GET['cmd']; }
if(isset($_GET['todo'])) { $todo = $_GET['todo']; }
if(isset($_GET['code'])) { $code = $_GET['code']; }
if(isset($_GET['conduct'])) { $conduct = $_GET['conduct']; }

if(isset($_POST['todo'])) { $todo = $_POST['todo']; }
if(isset($_POST['fulluser2'])) { $fulluser2 = $_POST['fulluser2']; }
if(isset($_POST['fullemail2'])) { $fullemail2 = $_POST['fullemail2']; }
if(isset($_POST['fullname'])) { $fullname = $_POST['fullname']; }
if(isset($_POST['fullemail'])) { $fullemail = $_POST['fullemail']; }
if(isset($_POST['fulluser'])) { $fulluser = $_POST['fulluser']; }
if(isset($_POST['pass_md5'])) { $pass_md5 = $_POST['pass_md5']; }
if(isset($_POST['v_pass_md5'])) { $v_pass_md5 = $_POST['v_pass_md5']; }
if(isset($_POST['new_hobby'])) { $new_hobby = $_POST['new_hobby']; }
if(isset($_POST['check_pass'])) { $check_pass = $_POST['check_pass']; }
if(isset($_POST['new_icq'])) { $new_icq = $_POST['new_icq']; }
if(isset($_POST['new_aim'])) { $new_aim = $_POST['new_aim']; }
if(isset($_POST['new_yim'])) { $new_yim = $_POST['new_yim']; }
if(isset($_POST['new_msn'])) { $new_msn = $_POST['new_msn']; }
if(isset($_POST['new_www'])) { $new_www = $_POST['new_www']; }
if(isset($_POST['new_occ'])) { $new_occ = $_POST['new_occ']; }
if(isset($_POST['new_location'])) { $new_location = $_POST['new_location']; }
if(isset($_POST['new_hobby'])) { $new_hobby = $_POST['new_hobby']; }




if(!isset($cmd)) { $cmd = 'register'; }




/*
	form:
	retrieve a new password
*/
if($cmd == 'lostpassword') {
	echo $tcms_html->contentModuleHeader(
		_REG_LPW, 
		'', 
		_REG_LPWTEXT
	);
	
	echo '<form action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.( isset($lang) ? '&amp;lang='.$lang : '' ).'" method="post">'
	.'<input name="cmd" type="hidden" value="retrieve" />';
	
	$width  = '150';
	$width2 = '150';
	
	
	// row
	echo $tcms_html->tableHead('1', '0', '0', '100%');
	
	
	// row
	echo '<tr height: 28px;"><td width="'.$width.'">'
	.'<span class="text_normal">'._PERSON_USERNAME.'</span>'
	.'</td><td>'
	.'<input class="inputtext" style="width: '.$width2.'px;" name="fulluser2" type="text" value="" />'
	.'</td></tr>';
	
	
	// row
	echo '<tr height: 28px;"><td width="'.$width.'">'
	.'<span class="text_normal">'._PERSON_EMAIL.'</span>'
	.'</td><td>'
	.'<input class="inputtext" style="width: '.$width2.'px;" name="fullemail2" type="text" value="" />'
	.'</td></tr>';
	
	
	// table end
	echo $tcms_html->tableEnd();
	
	
	// end
	echo '<br />'
	.'<input type="submit" value="'._REG_SUBMIT_LPW.'" border="0" class="inputbutton" />';
	
	echo '</form>';
}




/*
	retrieve a new password
*/

if($cmd == 'retrieve') {
	/*
		READ USERNAME AND PASSWORD
	*/
	
	if($fulluser2 == '' || $fullemail2 == '') {
		$link = '?id=register&s='.$s.'&cmd=lostpassword'
		.( isset($lang) ? '&amp;lang='.$lang : '' );
		$link = $tcms_main->urlConvertToSEO($link);
		
		echo '<script>'
		.'document.location.href=\''.$link.'\';'
		.'alert(\''._MSG_NOCONTENT.'\');'
		.'</script>';
	}
	else {
		if($choosenDB == 'xml') {
			$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_user/');
			
			foreach($arr_filename as $key => $value) {
				$user_login_xml = new xmlparser(_TCMS_PATH.'/tcms_user/'.$value,'r');
				
				$arr_maintag[$key] = substr($value, 0, 32);
				$ws_username       = $user_login_xml->readSection('user', 'username');
				$ws_email          = $user_login_xml->readSection('user', 'email');
				$ws_username       = $tcms_main->decodeText($ws_username, '2', $c_charset);
				
				if($fulluser2 == $ws_username 
				&& $ws_email == $fullemail2) {
					$arr_login['maintag'][$ws_username]  = $arr_maintag[$key];
					$arr_login['username'][$ws_username] = $user_login_xml->readSection('user', 'username');
					$arr_login['password'][$ws_username] = $user_login_xml->readSection('user', 'password');
					$arr_login['email'][$ws_username]    = $user_login_xml->readSection('user', 'email');
					
					$arr_login['username'][$ws_username] = $tcms_main->decodeText($arr_login['username'][$ws_username], '2', $c_charset);
					//$arr_login['email'][$ws_username]    = $tcms_main->decodeText($arr_login['email'][$ws_username], '2', $c_charset);
				}
			}
		}
		else {
			$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
			$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->query("SELECT * FROM ".$tcms_db_prefix."user WHERE username='".$fulluser2."' AND email='".$fullemail2."'");
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			if($sqlNR != 0) {
				$sqlARR = $sqlAL->fetchArray($sqlQR);
				
				$arr_login['maintag'][$fulluser2]  = $sqlARR['uid'];
				$arr_login['username'][$fulluser2] = $sqlARR['username'];
				$arr_login['password'][$fulluser2] = $sqlARR['password'];
				$arr_login['group'][$fulluser2]    = $sqlARR['group'];
				$arr_login['email'][$fulluser2]    = $sqlARR['email'];
				
				if($arr_login['maintag'][$fulluser2]  == NULL) { $arr_login['maintag'][$fulluser2]  = ''; }
				if($arr_login['username'][$fulluser2] == NULL) { $arr_login['username'][$fulluser2] = ''; }
				if($arr_login['password'][$fulluser2] == NULL) { $arr_login['password'][$fulluser2] = ''; }
				if($arr_login['group'][$fulluser2]    == NULL) { $arr_login['group'][$fulluser2]    = ''; }
				if($arr_login['email'][$fulluser2]    == NULL) { $arr_login['email'][$fulluser2]    = ''; }
				
				$arr_login['username'][$fulluser2] = $tcms_main->decodeText($arr_login['username'][$fulluser2], '2', $c_charset);
			}
			
			$sqlAL->sqlFreeResult($sqlQR);
		}
		
		
		
		/*
			retrieve
		*/
		if($fulluser2 == $arr_login['username'][$fulluser2]) {
			// CHECK GROUP
			if($fullemail2 == $arr_login['email'][$fulluser2]) {
				/*********************************************
				*
				* SEND THE NEW PASSWORD
				*
				*/
				$fullpass2 = substr(md5(microtime()),0,8);
				$savepass2 = md5($fullpass2);
				
				$user_file = $arr_login['maintag'][$fulluser2];
				$old_value = $arr_login['password'][$fulluser2];
				
				if($choosenDB == 'xml') {
					xmlparser::edit_value(_TCMS_PATH.'/tcms_user/'.$user_file.'.xml', 'password', $old_value, $savepass2);
				}
				else {
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$newSQLData = $tcms_db_prefix.'user.password="'.$savepass2.'"';
					$sqlQR = $sqlAL->updateOne($tcms_db_prefix.'user', $newSQLData, $user_file);
				}
				
				
				//*************************************
				// Mail
				$owner       = $tcms_config->getWebpageOwner();
				$owner_email = $tcms_config->getWebpageOwnerMail();
				
				$send_mail_to = $arr_login['email'][$fulluser2];
				$lpw_subject  = _REG_LPW_SUCCESS;
				$lpw_text     = _REG_TEXT_LPW;
				$sc_user      = _PERSON_USERNAME;
				$sc_pass      = _PERSON_PASSWORD;
				$sc_details   = _PERSON_DETAILS;
				$npw_activate = _MSG_ACTIVATE_NEW_PW_FIRST;
				$date         = date('d.m.Y');
				
				$header = "From: $owner <$owner_email>\n";
				$header .= 'Content-Type: text/plain';
				mail("$send_mail_to", "$owner - $date - $lpw_subject","
	$lpw_subject $fulluser2. 
----------------------------------------------------------------------
	
	$lpw_text
	
	$sc_details:
	$sc_user: $fulluser2
	$sc_pass: $fullpass2
	
----------------------------------------------------------------------
				","$header");
	//
	//*************************************
				
				$link = '?'.( isset($lang) ? '&amp;lang='.$lang : '' );
				$link = $tcms_main->urlConvertToSEO($link);
				
				echo '<script>'
				.'document.location.href=\''.$link.'\';'
				.'alert(\''._MSG_SEND.'\');'
				.'</script>';
			}
			else {
				$ws_check_lpw = 'no';
			}
		}
		else {
			$ws_check_lpw = 'no';
		}
		
		if($ws_check_lpw == 'no') {
			//Administrator
			$link = '?';
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<script>'
			.'document.location.href=\''.$link.'\';'
			.'alert(\''._LOGIN_FALSE_LPW.'\');'
			.'</script>';
		}
	}
}





/*
	REGISTER USER
*/

if($cmd != 'lostpassword' && $cmd != 'retrieve') {
	$dcSE = new tcms_dc_sidebarextensions();
	$dcSE = $tcms_dcp->getSidebarExtensionSettings();
	
	$show_login = $use_login;
	
	if($dcSE->getLoginUser()) {
		switch($cmd) {
			case 'register':
				/*
					register
					dialog
				*/
				
				echo $tcms_html->contentModuleHeader(
					_REG_TITLE, 
					'', 
					_REG_TEXT_1.' (<img style="padding: 6px 0 0 0;" src="'.$imagePath.'engine/images/dot_2.gif" border="0" />) '._REG_TEXT_2.' (<img style="padding: 6px 0 0 0;" src="'.$imagePath.'engine/images/dot_3.gif" border="0" />)'
				);
				
				echo '<form action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'&amp;cmd=save_registration" method="post">';
				//.'<input name="cmd" type="hidden" value="save_registration" />';
				
				$width  = '150';
				$width2 = '150';
				
				
				echo '<br />'
				.$tcms_html->userProfileTitle(_TABLE_GENERAL);
				//echo '<br />';
				
				
				// table head
				echo $tcms_html->tableHead('1', '0', '0', '100%');
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_NAME.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_2.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="fullname" type="text" />'
				//.'&nbsp;*&nbsp;'
				.'</td></tr>';
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_USERNAME.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_2.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="fulluser" type="text" />'
				.'</td></tr>';
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_PASSWORD.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_2.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="pass_md5" type="text" />'
				.'</td></tr>';
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_VPASSWORD.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_2.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="v_pass_md5" type="text" />'
				.'</td></tr>';
				
				
				$pass_md5 = substr(md5(microtime()),0,8);
				echo '<tr height: 28px;"><td colspan="2">'
				.'<input  name="pass" type="hidden" value="'.$pass_md5.'" />'
				.'</td></tr>';
				
				
				// table end
				echo $tcms_html->tableEnd();
				
				
				echo '<br />'
				.$tcms_html->userProfileTitle(_TABLE_CONTACT);
				//echo '<br />';
				
				
				// table head
				echo $tcms_html->tableHead('1', '0', '0', '100%');
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_EMAIL.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_2.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="fullemail" type="text" />'
				.'</td></tr>';
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_WWW.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="new_www" type="text" />'
				.'</td></tr>';
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_ICQ.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="new_icq" type="text" />'
				.'</td></tr>';
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_AIM.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="new_aim" type="text" />'
				.'</td></tr>';
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_MSN.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="new_msn" type="text" />'
				.'</td></tr>';
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_YIM.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="new_yim" type="text" />'
				.'</td></tr>';
				
				
				// table end
				echo $tcms_html->tableEnd();
				
				
				echo '<br />'
				.$tcms_html->userProfileTitle(_TABLE_PERSON);
				//echo '<br />';
				
				
				// table head
				echo $tcms_html->tableHead('1', '0', '0', '100%');
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_LOCATION.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="new_location" type="text" />'
				.'</td></tr>';
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_OCCUPATION.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="new_occ" type="text" />'
				.'</td></tr>';
				
				
				// row
				echo '<tr height: 28px;"><td width="'.$width.'">'
				.'&nbsp;<span class="text_normal">'._PERSON_HOBBY.'</span>'
				.'</td><td>'
				.'&nbsp;<img src="'.$imagePath.'engine/images/dot_3.gif" border="0" />&nbsp;'
				.'<input class="inputtext" style="width: '.$width2.'px;" name="new_hobby" type="text" />'
				.'</td></tr>';
				
				
				// table end
				echo $tcms_html->tableEnd();
				
				
				// end
				echo '<br />'
				.'<input type="submit" value="'._REG_SUBMIT_SR.'" border="0" class="inputbutton" />'
				.'</form>';
				
				break;
			
			case 'save_registration':
				/*
					save
					registration
				*/
				
				$finishRegister = true;
				
				// check name
				if($fullname == '') {
					$finishRegister = false;
					
					echo '<script>
					alert(\''._REG_NAME_NG.'\');
					history.back();
					</script>';
				}
				
				// check username
				if($fulluser == '') {
					$finishRegister = false;
					
					echo '<script>
					alert(\''._REG_USERNAME_NG.'\');
					history.back();
					</script>';
				}
				
				// check email
				if($fullemail == '') {
					$finishRegister = false;
					
					echo '<script>
					alert(\''._REG_EMAIL_NG.'\');
					history.back();
					</script>';
				}
				
				// check password
				if($pass_md5 != $v_pass_md5) {
					$finishRegister = false;
					
					echo '<script>
					alert(\''._MSG_PASSWORDNOTVALID.'\');
					history.back();
					</script>';
				}
				if($pass_md5 == '') {
					$finishRegister = false;
					
					echo '<script>
					alert(\''._MSG_NOPASSWORD.'\');
					history.back();
					</script>';
				}
				if($v_pass_md5 == '') {
					$finishRegister = false;
					
					echo '<script>
					alert(\''._MSG_NOPASSWORD.'\');
					history.back();
					</script>';
				}
				
				
				if($finishRegister) {
					$checkUsername = $tcms_ap->checkUsernameExists(
						$fulluser
					);
					
					/*if($choosenDB == 'xml') {
						$arr_filename = $tcms_file->getPathContent(_TCMS_PATH.'/tcms_user/');
						foreach($arr_filename as $keyz => $value) {
							$login_xml = new xmlparser(_TCMS_PATH.'/tcms_user/'.$value, 'r');
							$ws_username = $login_xml->readSection('user', 'username');
							
							if($ws_username == $fulluser) { $checkUsername = false; }
							else { $checkUsername = true; }
						}
					}
					else {
						$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
						$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
						
						$sqlQR = $sqlAL->query("SELECT * FROM ".$tcms_db_prefix."user WHERE username='".$fulluser."'");
						$user_exists = $sqlAL->getNumber($sqlQR);
						
						if($user_exists == 0) { $checkUsername = true; }
						else { $checkUsername = false; }
					}*/
					
					if(substr($new_www, 0, 7) != 'http://') {
						$new_www = 'http://'.$new_www;
					}
					
					if(!$checkUsername) {
						$pass2 = md5($pass_md5);
						
						$validate_md5 = $tcms_main->getNewUID(32, 'user');
						
						if($choosenDB == 'xml') {
							$fullname = $tcms_main->encodeText($fullname, '2', $c_charset);
							$fulluser2 = $tcms_main->encodeText($fulluser, '2', $c_charset);
							
							$xmluser = new xmlparser('cache/'.$validate_md5.'.xml', 'w');
							$xmluser->xml_declaration();
							$xmluser->xml_section('user');
							
							$xmluser->write_value('name', $fullname);
							$xmluser->write_value('username', $fulluser2);
							$xmluser->write_value('password', $pass2);
							$xmluser->write_value('email', $fullemail);
							$xmluser->write_value('group', 'User');
							$xmluser->write_value('join_date', date('Y.m.d-H:i:s'));
							$xmluser->write_value('homepage', $new_www);
							$xmluser->write_value('icq', $new_icq);
							$xmluser->write_value('aim', $new_aim);
							$xmluser->write_value('yim', $new_yim);
							$xmluser->write_value('msn', $new_msn);
							$xmluser->write_value('birthday', '');
							$xmluser->write_value('gender', '');
							$xmluser->write_value('occupation', $new_occ);
							$xmluser->write_value('enabled', '1');
							$xmluser->write_value('tcms_enabled', '1');
							$xmluser->write_value('static_value', '0');
							$xmluser->write_value('signature', '');
							$xmluser->write_value('location', $new_location);
							$xmluser->write_value('hobby', $new_hobby);
							
							$xmluser->xml_section_buffer();
							$xmluser->xml_section_end('user');
						}
						else {
							$fullname = $tcms_main->encodeText($fullname, '2', $c_charset);
							$fulluser2 = $tcms_main->encodeText($fulluser, '2', $c_charset);
							
							$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
							$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
							
							
							switch($choosenDB) {
								case 'mysql':
									$newSQLColumns = '`name`, `username`, `password`, `email`, `group`, `join_date`, '
									.'`homepage`, `icq`, `aim`, `yim`, `msn`, `occupation`, `location`, `hobby`, '
									.'`tcms_enabled`, `signature`';
									break;
								
								case 'pgsql':
									$newSQLColumns = 'name, username, "password", email, "group", join_date, '
									.'homepage, icq, aim, yim, msn, occupation, location, hobby, '
									.'tcms_enabled, signature';
									break;
								
								case 'mssql':
									$newSQLColumns = '[name], [username], [password], [email], [group], [join_date], '
									.'[homepage], [icq], [aim], [yim], [msn], [occupation], [location], [hobby], '
									.'[tcms_enabled], [signature]';
									break;
							}
							
							
							$newSQLData = "'".$fullname."', '".$fulluser2."', '".$pass2."', '".$fullemail."', 'User', '".date('Y.m.d-H:i:s')."', "
							."'".$new_www."', '".$new_icq."', '".$new_aim."', '".$new_yim."', '".$new_msn."', '".$new_occ."', "
							."'".$new_location."', '".$new_hobby."', 1, '_NEW_USER_'";
							
							$sqlQR = $sqlAL->createOne($tcms_db_prefix.'user', $newSQLColumns, $newSQLData, $validate_md5);
						}
						
						
						/*
							Mail
						*/
						$owner_email = $tcms_config->getWebpageOwnerMail();
						$owner       = $tcms_config->getWebpageOwner();
						$owner_url   = $tcms_config->getWebpageOwnerUrl();
						
						$send_mail_to = $fullemail;
						$subject      = _REG_SUCCESS;
						$success_text = _REG_SUCCESS_TEXT;
						$sc_user      = _PERSON_USERNAME;
						$sc_pass      = _PERSON_PASSWORD;
						$sc_details   = _PERSON_DETAILS;
						$userprofile  = _REG_USERPROFILE;
						$date         = date('d.m.Y');
						
						if(@strpos($owner_url, $seoPath)) {
							$owner_url = @str_replace($seoPath, '', $owner_url);
						}
						
						$link = '?'.( isset($session) ? 'session='.$session.'&' : '' )
						.'id=frontpage&s='.$s
						.( isset($lang) ? '&lang='.$lang : '' );
						$link = @$tcms_main->urlConvertToSEO($link);
						
						$seoURL = '?id=register'
						.( isset($lang) ? '&amp;lang='.$lang : '' )
						.'&cmd=validate&code=';
						$seoURL = @$tcms_main->urlConvertToSEO($seoURL);
						
						if($seoEnabled == 0) {
							$seoURL = @str_replace('&amp;', '&', $seoURL);
						}
						else {
							$seoURL = @str_replace('&amp;', '&', $seoURL);
							$seoURL = '/'.$seoFolder.'/'.$seoURL;
						}
						
						if($mail_with_smtp == '1') {
							// phpmailer
							$mail = new PHPMailer();
							
							$mail->IsSMTP();
							$mail->Host     = $mail_server_smtp;
							$mail->SMTPAuth = true;
							$mail->Username = $mail_user;
							$mail->Password = $mail_password;
							$mail->SetLanguage(
								'en', 
								'engine/tcms_kernel/phpmailer/language/'
							);
							
							$mail->From     = $owner_email;
							$mail->FromName = $owner;
							$mail->AddAddress($send_mail_to, $fulluser); 
							$mail->AddBCC($owner_email, $owner);
							
							$mail->WordWrap = 50;
							
							$mail->Subject  =  $owner.' - '.$date.' - '.$subject;
							
							// text message
							$mail_body_text = $subject.".\n"
							."----------------------------------------------------------------------\n\n"
							.$success_text."\n"
							.$sc_details."\n\n"
							.$sc_user.": ".$fulluser."\n"
							.$sc_pass.": ".$pass_md5."\n"
							."URL: ".$owner_url."/".$seoURL.$validate_md5."\n"
							.$sc_userprofile."\n"
							."----------------------------------------------------------------------";
							
							// html message
							$mail_body_html = $subject.'<hr />'
							.$success_text.'<br />'
							.$sc_details.'<br /><br />'
							.'<strong>'.$sc_user.'</strong>: '.$fulluser.'<br />'
							.'<strong>'.$sc_pass.'</strong>: '.$pass_md5.'<br />'
							.'<strong>URL</strong>:'.$owner_url.'/'.$seoURL.$validate_md5.'<br /><br />'
							.$sc_userprofile.'<hr />';
							
							if($mail_as_html == '1') {
								$mail->IsHTML(true);
								$mail->Body     =  $mail_body_html;
								$mail->AltBody  =  $mail_body_text;
							}
							else {
								$mail->IsHTML(false);
								//$mail->IsMail();
								//$mail->Body     =  $mail_body_text;
								//$mail->AltBody  =  $mail_body_html;
								$mail->Body     =  $mail_body_html;
								$mail->AltBody  =  $mail_body_text;
							}
							
							if(!$mail->Send()) {
								echo '<script>'
								.'history.back();'
								.'alert(\''._MSG_SEND_FAILED.'\n\nMailer Error: '.$mail->ErrorInfo.'\');'
								.'</script>';
							}
						}
						else {
							$header = "From: $owner <$owner_email>\n";
							$header .= "Content-Type: text/plain";
							mail("$send_mail_to", "$owner - $date - $subject","
	$subject. 
-----------------------------------------------------------------------------------
	
	$success_text
	$sc_details
	
-----------------------------------------------------------------------------------
	
	$sc_user: $fulluser
	$sc_pass: $pass_md5
	URL     : $owner_url/$seoURL$validate_md5
	
	$sc_userprofile
-----------------------------------------------------------------------------------
","$header");
							
							/*
								 Mail for the admin
							*/
							$send_mail_to = $fullemail;
							$subject      = _REG_SUCCESS;
							$success_text = _REG_SUCCESS_MAIL;
							$sc_user      = _PERSON_USERNAME;
							$sc_pass      = _PERSON_PASSWORD;
							$sc_details   = _TABLE_URL;
							$userprofile  = _REG_USERPROFILE;
							$app_get_mail = _REG_EMAIL;
							$date         = date('d.m.Y');
							
							$header = "From: $owner <$owner_email>\n";
							$header .= "Content-Type: text/plain";
							mail("$owner_email", "$app_get_mail - $date","
	$subject. 
-----------------------------------------------------------------------------------
	
	$success_text
	
-----------------------------------------------------------------------------------
	
	$sc_details: $owner_url
	$sc_user: $fulluser
	
-----------------------------------------------------------------------------------
","$header");
						}
						
						if($choosenDB == 'xml') {
							if(file_exists('cache/'.$validate_md5.'.xml')) {
								$checkUserExists = true;
							}
							else {
								$checkUserExists = false;
							}
						}
						else {
							$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
							$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
							
							$sqlQR = $sqlAL->getOne($tcms_db_prefix.'user', $validate_md5);
							$user_exists = $sqlAL->getNumber($sqlQR);
							
							if($user_exists != 0) {
								$checkUserExists = true;
							}
							else {
								$checkUserExists = false;
							}
						}
						
						if($checkUserExists) {
							$link = '?'.( isset($session) ? 'session='.$session.'&' : '' )
							.'id=frontpage&s='.$s
							.( isset($lang) ? '&amp;lang='.$lang : '' );
							$link = $tcms_main->urlConvertToSEO($link);
							
							echo '<script>'
							.'alert(\''._REG_SUCCESS.'.\');'
							.'document.location=\''.$link.'\';'
							.'</script>';
						}
						else {
							$link = '?'.( isset($session) ? 'session='.$session.'&' : '' )
							.'id=frontpage&s='.$s
							.( isset($lang) ? '&amp;lang='.$lang : '' );
							$link = $tcms_main->urlConvertToSEO($link);
							
							echo '<script>'
							.'alert(\''._REG_NO_SUCCESS.'.\');'
							.'document.location=\''.$link.'\';'
							.'</script>';
						}
					}
					else {
						echo '<script>
						alert(\''._MSG_USEREXISTS.'.\');
						history.go(-1);
						</script>';
					}
				}
				
				break;
			
			case 'validate':
				/*
					validate
					registration
				*/
				
				if($choosenDB == 'xml') {
					if($tcms_file->checkFileExist('cache/'.$code.'.xml')) {
						// tag
						$ws_agree = substr($code, 0, 32);
						
						// username
						$profile_xml = new xmlparser('cache/'.$code.'.xml','r');
						$username    = $profile_xml->readSection('user', 'username');
						$username    = $tcms_main->decodeText($username, '2', $c_charset);
						
						// COPY AND DELETE TMP
						if($tcms_file->checkFileExist('cache/'.$code.'.xml')) {
							copy(
								'cache/'.$code.'.xml', 
								$imagePath._TCMS_PATH.'/tcms_user/'.$ws_agree.'.xml'
							);
						}
						
						if($tcms_file->checkFileExist('cache/'.$code.'.xml')) {
							$tcms_file->deleteFile('cache/'.$code.'.xml');
						}
						
						// NOTEBOOK
						$xmluser = new xmlparser(_TCMS_PATH.'/tcms_notepad/'.$ws_agree.'.xml','w');
						$xmluser->xml_declaration();
						$xmluser->xml_section('note');
						
						$xmluser->write_value('name', $username);
						$xmluser->write_value('text', '[YOUR NEW NOTEBOOK]');
						
						$xmluser->xml_section_buffer();
						$xmluser->xml_section_end('note');
						
						// MESSAGE
						echo '<span class="text_normal">'._REG_VALIDATE.'</span>';
					}
					else {
						echo '<span class="text_normal">'._REG_NO_VALIDATE.'</span>';
					}
				}
				else {
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlSTR = "SELECT *"
					." FROM ".$tcms_db_prefix."user"
					." WHERE uid = '".$code."'"
					." AND enabled = 0"
					." AND signature = '_NEW_USER_'";
					
					$sqlQR = $sqlAL->query($sqlSTR);
					$user_exists = $sqlAL->getNumber($sqlQR);
					
					if($user_exists != 0) {
						$sqlARR = $sqlAL->fetchArray($sqlQR);
						$nname = $sqlARR['name'];
						$nname = $tcms_main->decodeText($nname, '2', $c_charset);
						
						$newSQLData = $tcms_db_prefix."user.enabled=1, "
						.$tcms_db_prefix."user.signature=''";
						
						$sqlQR = $sqlAL->updateOne($tcms_db_prefix.'user', $newSQLData, $code);
						
						$newSQLColumns = 'name, note';
						$newSQLData = "'".$nname."', '[YOUR NEW NOTEBOOK]'";
						$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'notepad', $newSQLColumns, $newSQLData, $code);
						
						echo '<span class="text_normal">'._REG_VALIDATE.'</span>';
					}
					else {
						echo '<span class="text_normal">'._REG_NO_VALIDATE.'</span>';
					}
				}
				
				break;
			
			case 'validatepw':
				/*
					validate
					lost password
				*/
				if($tcms_auth->doValidateNewPassword($conduct, $code)) {
					echo '<script>'
					.'document.location.href=\'index.php\';'
					.'alert(\''._MSG_SUCCESSFULL_RETRIEVED.'\');'
					.'</script>';
				}
				else {
					echo '<script>'
					.'document.location.href=\'index.php\';'
					.'alert(\''._MSG_ERROR_ON_RETRIEVING.'\');'
					.'</script>';
				}
				break;
		}
	}
	else {
		echo '<strong>'._MSG_REGNOTALLOWD.'</strong>';
	}
}


?>
