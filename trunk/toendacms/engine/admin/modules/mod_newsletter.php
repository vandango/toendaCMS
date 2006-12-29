<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Extension Newsletter
|
| File:		mod_newsletter.php
| Version:	0.5.0
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');




if(isset($_GET['check'])){ $check = $_GET['check']; }

if(isset($_POST['action'])){ $action = $_POST['action']; }
if(isset($_POST['title_nl'])){ $title_nl = $_POST['title_nl']; }
if(isset($_POST['text_nl'])){ $text_nl = $_POST['text_nl']; }
if(isset($_POST['link_nl'])){ $link_nl = $_POST['link_nl']; }
if(isset($_POST['show_nlt'])){ $show_nlt = $_POST['show_nlt']; }
if(isset($_POST['subject'])){ $subject = $_POST['subject']; }
if(isset($_POST['content'])){ $content = $_POST['content']; }
if(isset($_POST['date'])){ $date = $_POST['date']; }
if(isset($_POST['maintag'])){ $maintag = $_POST['maintag']; }
if(isset($_POST['new_nl_email'])){ $new_nl_email = $_POST['new_nl_email']; }
if(isset($_POST['new_nl_name'])){ $new_nl_name = $_POST['new_nl_name']; }




if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Writer'){
	/*
		INIT
	*/
	if(!isset($action)){ $action = 'show'; }
	
	$bgkey     = 0;
	
	
	
	
	$alwaysCheck = 0;
	
	$imapServer = $mail_server_pop3;
	//$imapPort = '143';
	$imapPort = $mail_port;
	$imapPOP3 = $mail_pop3;
	$imapUsername = $mail_user;
	$imapPassword = $mail_password;
	
	/*
		check mail for email
		with NO NEWSLETTER inside
	*/
	
	$checkNOW = false;
	
	if($alwaysCheck == 1){ $checkNOW = true; }
	else{
		if($todo == 'alwaysCheck'){ $checkNOW = true; }
		else{ $checkNOW = false; }
	}
	
	if($checkNOW == true){
		echo tcms_html::bold(_NL_CHECKTITLE).'<br />';
		echo tcms_html::text(_NL_CHECKTEXT.'<br /><br />', 'left');
		
		echo '<div style="padding: 0 0 0 10px;">';
		
		echo '... check mailbox ...<br />';
		
		
		$checkHandle = @imap_open('{'.$imapServer.( $imapPOP3 == 1 ? '/pop3' : '' ).':'.$imapPort.'}', $imapUsername, $imapPassword, OP_READONLY) || die('<h2>Cannot open mailbox!</h2>');
		
		
		if($checkHandle != false){
			$checkString = _NL_CHECKSTRING;
			
			$checkHeaders = imap_headers($checkHandle);
			$checkBody = imap_body($checkHandle);
			
			imap_close($checkHandle);
			
			/*
			echo '<script>'
			.'alert(\''._NL_MAILSCHECKED.'\');'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_newsletter\''
			.'</script>';*/
		}
		
		echo '</div>';
	}
	
	
	
	
	/*
		load data
	*/
	if($todo == 'config'){
		if($id_group == 'Developer' || $id_group == 'Administrator'){
			if($choosenDB == 'xml'){
				$nl_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/newsletter.xml','r');
				$old_title_nl = $nl_xml->read_section('newsletter', 'nl_title');
				$old_show_nlt = $nl_xml->read_section('newsletter', 'nl_show_title');
				$old_text_nl  = $nl_xml->read_section('newsletter', 'nl_text');
				$old_link_nl  = $nl_xml->read_section('newsletter', 'nl_link');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'newsletter', 'newsletter');
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$old_title_nl = $sqlARR['nl_title'];
				$old_show_nlt = $sqlARR['nl_show_title'];
				$old_text_nl  = $sqlARR['nl_text'];
				$old_link_nl  = $sqlARR['nl_link'];
			}
			
			
			$old_title_nl    = $tcms_main->decodeText($old_title_nl, '2', $c_charset);
			$old_text_nl     = $tcms_main->decodeText($old_text_nl, '2', $c_charset);
			$old_link_nl     = $tcms_main->decodeText($old_link_nl, '2', $c_charset);
			
			
			
			
			
			
			if($action == 'show'){
				// form
				echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_newsletter" method="post">'
				.'<input name="todo" type="hidden" value="save_nl" />';
				
				
				// table head
				echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
				
				
				// table title
				echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini"><strong>'._NL_CONFIG.'</strong></td></tr>';
				
				
				// table rows
				echo '<tr><td class="tcms_padding_mini" width="250">'._NL_TITLE.'</td>'
				.'<td><img src="../images/bullet_1.gif" border="0" vspace="4" style="margin: 5px 0 0 0 !important;" />'
				.'<input name="title_nl" class="tcms_input_normal" value="'.$old_title_nl.'" />'
				.'</td></tr>';
				
				
				// table rows
				echo '<tr><td class="tcms_padding_mini" width="250">'._NL_TEXT.'</td>'
				.'<td><img src="../images/bullet_1.gif" border="0" vspace="4" style="margin: 5px 0 0 0 !important;" />'
				.'<input name="text_nl" class="tcms_input_normal" value="'.$old_text_nl.'" />'
				.'</td></tr>';
				
				
				// table rows
				echo '<tr><td class="tcms_padding_mini" width="250">'._NL_SUBMIT.'</td>'
				.'<td><img src="../images/bullet_1.gif" border="0" vspace="4" style="margin: 5px 0 0 0 !important;" />'
				.'<input name="link_nl" class="tcms_input_normal" value="'.$old_link_nl.'" />'
				.'</td></tr>';
				
				
				// table rows
				echo '<tr><td class="tcms_padding_mini" width="250">'._NL_SHOW_TITLE.'</td>'
				.'<td><img src="../images/bullet_1.gif" border="0" vspace="4" style="margin: 5px 0 0 0 !important;" />'
				.'<input type="checkbox" name="show_nlt"'.( $old_show_nlt == 1 ? ' checked="checked"' : '' ).' value="1" />'
				.'</td></tr>';
				
				
				// Table end
				echo '</table></form><br />';
			}
		}
		else{
			echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
		}
	}
	else{
		if($todo == 'show'){
			/*
				SEND NEWSLETTER
			*/
			
			?><script language="JavaScript">
			function sendinputs(){
				sendOK = true;
				
				strsubject = document.getElementById('subject').value;
				if(strsubject == '') {
					sendOK = false;
					alert('<? echo _MSG_NOSUBJECT; ?>');
					document.getElementById('subject').focus();
					return;
				}
				
				strmessage = document.getElementById('content').value;
				if(strmessage == '') {
					sendOK = false;
					alert('<? echo _MSG_NOMSG; ?>');
					document.getElementById('content').focus;
					return;
				}
				
				if (sendOK){ document.getElementById('newsletter').submit(); }
			}
			</script><?
			
			
			// begin form
			echo '<form name="newsletter" id="newsletter" method="post" action="admin.php?id_user='.$id_user.'&amp;site=mod_newsletter">'
			.'<input name="todo" type="hidden" value="send_newsletter">'
			.'<input name="date" type="hidden" value="'.date('d.m.Y').'">';
			
			
			// table head
			echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
			
			
			// table title
			echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini"><strong>'._NL_SEND.'</strong></td></tr>';
			
			
			// table rows
			echo '<tr><td class="tcms_padding_mini" width="250">'._NL_SUBJECT.'</td>'
			.'<td><img src="../images/bullet_1.gif" border="0" vspace="4" style="margin: 5px 0 0 0 !important;" />'
			.'<input name="subject" id="subject" type="text" class="tcms_input_normal" size="40">'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td class="tcms_padding_mini" width="250">'._TCMS_ADMIN_SEND.'</td>'
			.'<td><img src="../images/bullet_1.gif" border="0" vspace="4" style="margin: 5px 0 0 0 !important;" />'
			.'<a class="tcms_navigation_button" href="javascript:sendinputs();">'._TCMS_ADMIN_SEND.'</a>'
			.'</td></tr>';
			
			
			// table rows
			echo '<tr><td class="tcms_padding_mini" width="250">'._NL_USER.'</td>'
			.'<td><img src="../images/bullet_1.gif" border="0" vspace="4" style="margin: 5px 0 0 0 !important;" />'
			.'<a class="tcms_navigation_button" href="admin.php?id_user='.$id_user.'&amp;site=mod_newsletter&amp;todo=listNL">'._NL_USER.'</a>'
			.'</td></tr>';
			
			
			if($alwaysCheck == 0){
				// table rows
				echo '<tr><td class="tcms_padding_mini" width="250">'._NL_CHECKFORUNSUBSCRIBE.'</td>'
				.'<td><img src="../images/bullet_1.gif" border="0" vspace="4" style="margin: 5px 0 0 0 !important;" />'
				.'<a class="tcms_navigation_button" href="admin.php?id_user='.$id_user.'&amp;site=mod_newsletter&amp;todo=alwaysCheck">'._NL_CHECK.'</a>'
				.'</td></tr>';
			}
			
			
			// linebreak
			echo '<tr><td colspan="2" height="2"><br /></td></tr>';
			
			
			$c_xml        = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/var.xml','r');
			$seoEnabled   = $c_xml->read_section('global', 'seo_enabled');
			$seoFolder    = $c_xml->read_section('global', 'server_folder');
			
			$footer_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/footer.xml','r');
			$_owner_url  = $footer_xml->read_section('footer', 'owner_url');
			
			if($seoEnabled == 1)
				$_owner_url = $_owner_url.'/'.$seoFolder.'/';
			else
				$_owner_url = $_owner_url.'/';
			
			
			// table rows with toolbar
			echo '<tr><td class="tcms_padding_mini" width="250" valign="top" colspan="2">'._NL_MESSAGE
			.'<br />'
			.'<script>createToendaToolbar(\'newsletter\', \''.$tcms_lang.'\', \''.$show_wysiwyg.'\', \'n=without&url='.$_owner_url.'\', \'\', \''.$id_user.'\');</script>';
			
			if($show_wysiwyg == 'toendaScript'){
				echo '<script>createToolbar(\'newsletter\', \''.$tcms_lang.'\', \'toendaScript\');</script>';
			}
			else{
				echo '<script>createToolbar(\'newsletter\', \''.$tcms_lang.'\', \'HTML\');</script>';
			}
			
			echo '</td></tr>';
			
			
			// editor
			echo '<tr><td colspan="2" valign="top">'
			.'<textarea name="content" id="content" cols="40" rows="8" class="tcms_textarea_nl"></textarea>'
			.'</td></tr>';
			
			
			// table end
			echo '</table></form>';
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	if($todo == 'listNL'){
		/*
			LOAD NEWSLETTER USER
		*/
		
		if($choosenDB == 'xml'){
			$arr_nl_user['files'] = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_newsletter/');
			
			$nl = 0;
			if(isset($arr_nl_user['files']) && !empty($arr_nl_user['files']) && $arr_nl_user['files'] != ''){
				foreach($arr_nl_user['files'] as $nl => $val){
					$nl_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_newsletter/'.$arr_nl_user['files'][$nl], 'r');
					
					$arr_nl_user['tag'][$nl]   = substr($arr_nl_user['files'][$nl], 0, 6);
					$arr_nl_user['id'][$nl]    = $nl_xml->read_section('nl_user', 'user');
					$arr_nl_user['email'][$nl] = $nl_xml->read_section('nl_user', 'email');
					
					$arr_nl_user['id'][$nl] = $tcms_main->decodeText($arr_nl_user['id'][$nl], '2', $c_charset);
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'newsletter_items');
			$count = 0;
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$arr_nl_user['tag'][$count]   = $sqlARR['uid'];
				$arr_nl_user['id'][$count]    = $sqlARR['user'];
				$arr_nl_user['email'][$count] = $sqlARR['email'];
				
				$arr_nl_user['id'][$count] = $tcms_main->decodeText($arr_nl_user['id'][$count], '2', $c_charset);
				
				$count++;
			}
		}
		
		if(isset($arr_nl_user['id']) && !empty($arr_nl_user['id']) && $arr_nl_user['id'] != ''){
			array_multisort(
				$arr_nl_user['id'], SORT_DESC, 
				$arr_nl_user['email'], SORT_DESC, 
				$arr_nl_user['tag'], SORT_DESC
			);
		}
		
		
		
		
		/*
			VALUES
		*/
		
		echo tcms_html::bold(_NL_USER).'<br />';
		
		
		echo '<table cellpadding="3" cellspacing="0" border="0" width="100%" class="noborder">';
		echo '<tr class="tcms_bg_blue_01">'
			.'<th valign="middle" class="tcms_db_title" width="5%">&nbsp;</th>'
			.'<th valign="middle" class="tcms_db_title" align="left" width="35%">'._TABLE_NAME.'</th>'
			.'<th valign="middle" class="tcms_db_title" align="left">'._TABLE_EMAIL.'</th>'
			.'<th valign="middle" class="tcms_db_title" width="20%" align="right">'._TABLE_FUNCTIONS.'</th><tr>';
		
		if(isset($arr_nl_user['id']) && !empty($arr_nl_user['id']) && $arr_nl_user['id'] != ''){
			foreach ($arr_nl_user['id'] as $nl_key => $nl_value){
				$bgkey++;
				if(is_integer($bgkey/2)){ $ws_color = $arr_color[0]; } else{ $ws_color = $arr_color[1]; }
				
				echo '<tr id="row'.$nl_key.'" '
				.'bgcolor="'.$ws_color.'" '
				.'onMouseOver="wxlBgCol(\'row'.$nl_key.'\',\'#ececec\')" '
				.'onMouseOut="wxlBgCol(\'row'.$nl_key.'\',\''.$ws_color.'\')" '
				.'onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_newsletter&amp;todo=edit&amp;maintag='.$arr_nl_user['tag'][$nl_key].'\';">';
				
				echo '<td align="center" class="tcms_db_2"><img src="../images/letter.gif" border="0" /></td>';
				
				echo '<td class="tcms_db_2">'.($arr_nl_user['id'][$nl_key]==''?'<em>-empty-</em>':$arr_nl_user['id'][$nl_key]).'</td>';
				
				echo '<td class="tcms_db_2">'.(empty($arr_nl_user['email'][$nl_key])?'<em>-empty-</em>':$arr_nl_user['email'][$nl_key]).'</td>';
				
				echo '<td class="tcms_db_2" align="right">'
				.'<a title="'._TABLE_EDITBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_newsletter&amp;todo=edit&amp;maintag='.$arr_nl_user['tag'][$nl_key].'">'
				.'<img title="'._TABLE_EDITBUTTON.'" alt="'._TABLE_EDITBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_edit.gif" />'
				.'</a>&nbsp;'
				.'<a title="'._TABLE_DELBUTTON.'" href="admin.php?id_user='.$id_user.'&amp;site=mod_newsletter&amp;todo=delete&amp;maintag='.$arr_nl_user['tag'][$nl_key].'">'
				.'<img title="'._TABLE_DELBUTTON.'" alt="'._TABLE_DELBUTTON.'" style="padding-top: 3px;" border="0" src="../images/a_delete.gif" />'
				.'</a>&nbsp;'
				.'</td>';
				
				echo '</tr>';
			}
		}
		
		echo '</table><br />';
	}
	
	
	
	
	
	
	
	
	
	
	/*
		EDIT FORMULAR
	*/
	
	if($todo == 'edit'){
		// Auslesen
		$createAct = false;
		
		if(isset($maintag)){
			if($choosenDB == 'xml'){
				$main_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_newsletter/'.$maintag.'.xml','r');
				$arr_nl['email'] = $main_xml->read_section('nl_user', 'email');
				$arr_nl['name'] = $main_xml->read_section('nl_user', 'user');
				
				if(!$arr_nl['email']){ $arr_nl['email'] = ''; }
				if(!$arr_nl['name']) { $arr_nl['name'] = ''; }
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'newsletter_items', $maintag);
				$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
				
				$arr_nl['email'] = $sqlARR['email'];
				$arr_nl['name']  = $sqlARR['user'];
			}
			
			$arr_nl['name'] = $tcms_main->decodeText($arr_nl['name'], '2', $c_charset);
		}
		else{
			if($choosenDB == 'xml'){ while(($maintag = substr(md5(time()),0,6)) && file_exists('../../'.$tcms_administer_site.'/tcms_newsletter/'.$maintag.'.xml')){} }
			else{ $maintag = $tcms_main->create_uid($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'newsletter_items', 6); }
		}
		
		
		// HTML
		if($arr_nl['email'] == ''){
			echo tcms_html::bold(_TABLE_NEW);
			$edit_add_news = _NL_NEWUSER;
			$createAct = true;
		}
		else{
			echo tcms_html::bold(_TABLE_EDIT);
			$edit_add_news = _NL_EDITUSER;
			$createAct = false;
		}
		
		
		$width = '150';
		
		
		echo tcms_html::text($edit_add_news.'<br /><br />', 'left');
		
		
		// begin form
		echo '<form action="admin.php?id_user='.$id_user.'&amp;site=mod_newsletter" method="post">'
		.'<input name="todo" type="hidden" value="save" />'
		.'<input name="maintag" type="hidden" value="'.$maintag.'" />';
		
		if($createAct){ echo '<input name="action" type="hidden" value="new" />'; }
		
		
		// table head
		echo '<table width="100%" border="0" cellpadding="1" cellspacing="5" class="tcms_table">';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_NAME.'</strong></td>'
		.'<td width="20"><img src="../images/dot_2.gif" border="0" /></td>'
		.'<td valign="top"><input class="tcms_input_normal" name="new_nl_name" type="text" value="'.$arr_nl['name'].'" /></td></tr>';
		
		
		// table row
		echo '<tr><td valign="top" width="'.$width.'"><strong class="tcms_bold">'._TABLE_EMAIL.'</strong></td>'
		.'<td width="20"><img src="../images/dot_2.gif" border="0" /></td>'
		.'<td valign="top"><input class="tcms_input_normal" name="new_nl_email" type="text" value="'.$arr_nl['email'].'" /></td></tr>';
		
		
		// table end
		echo '</table></form>';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	/*
		SENDING MESSAGE
	*/
	
	if($todo == 'send_newsletter'){
		if($choosenDB == 'xml'){
			$arr_send_nl['files'] = $tcms_main->readdir_ext('../../'.$tcms_administer_site.'/tcms_newsletter/');
			
			$nl = 0;
			foreach($arr_send_nl['files'] as $nl => $val){
				$nl_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_newsletter/'.$arr_send_nl['files'][$nl], 'r');
				
				$arr_send_nl['email'][$nl] = $nl_xml->read_section('nl_user', 'email');
				$arr_send_nl['user'][$nl]  = $nl_xml->read_section('nl_user', 'user');
				$arr_send_nl['user'][$nl] = $tcms_main->decodeText($arr_send_nl['user'][$nl], '2', $c_charset);
				
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetAll($tcms_db_prefix.'newsletter_items');
			$count = 0;
			
			while($sqlARR = $sqlAL->sqlFetchArray($sqlQR)){
				$arr_send_nl['user'][$count]  = $sqlARR['user'];
				$arr_send_nl['email'][$count] = $sqlARR['email'];
				
				$arr_send_nl['user'][$count] = $tcms_main->decodeText($arr_send_nl['user'][$count], '2', $c_charset);
				
				$count++;
			}
		}
		
		
		if($choosenDB == 'xml'){
			$send_nl_xml = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/contactform.xml','r');
			$owner_email = $send_nl_xml->read_section('email', 'contact');
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$strQuery = "SELECT contact "
			."FROM ".$tcms_db_prefix."contactform "
			."WHERE uid = 'contactform'";
			
			$sqlQR = $sqlAL->sqlQuery($strQuery);
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$owner_email = $sqlARR['contact'];
			
			$sqlAL->_sqlAbstractionLayer();
			
			if($owner_email == NULL){ $owner_email = ''; }
		}
		
		
		$footer_xml  = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/footer.xml','r');
		$owner       = $footer_xml->read_section('footer', 'websiteowner');
		
		
		$owner_email = $tcms_main->decodeText($owner_email, '2', $c_charset);
		$owner       = $tcms_main->decodeText($owner, '2', $c_charset);
		$nlmailmsg   = _NL_MAILMESSAGE.': '._NL_CHECKSTRING;
		
		if($mail_with_smtp == '1')
			$mail = new PHPMailer();
		
		foreach($arr_send_nl['email'] as $key => $val){
			//echo $arr_send_nl['email'][$key]."<br />";
			$send_mail_to = $arr_send_nl['email'][$key];
			$send_name = $arr_send_nl['user'][$key];
			
			// send mail:
			// over own smtp or
			// over php mail() function
			if($mail_with_smtp == '1'){
				// phpmailer
				//$mail = new PHPMailer();
				
				$mail->IsSMTP();
				$mail->Host     = $mail_server_smtp;
				$mail->SMTPAuth = true;
				$mail->Username = $mail_user;
				$mail->Password = $mail_password;
				
				$mail->From     = $owner_email;
				$mail->FromName = $owner;
				$mail->AddAddress($send_mail_to, $send_name);
				
				if($key == 0)
					$mail->AddReplyTo($owner_email, $owner);
				
				$mail->WordWrap = 50;
				
				$mail->Subject  =  $owner.' - '._NL_NEWSLETTER.' - '.$date.' -  '.$subject;
				
				// text message
				$mail_body_text = $msg_form_content." ".$date."
 ----------------------------------------------------------------------
 "._FORM_SUBJECT.": $subject
 "._FORM_DEAR.": $send_name
 $mail_message
 ----------------------------------------------------------------------
 $nlmailmsg $owner_email";
				
				// html message
				$mail_body_html = $msg_form_content.' '.$date.'<hr />'
				.'<strong>'._FORM_SUBJECT.'</strong>: '.$subject.'<br />'
				.'<strong>'._FORM_DEAR.'</strong>: '.$send_name.'<br /><br />'
				.$content.'<br /><br />'
				.'<hr />'.$nlmailmsg.' '.$owner_email;
				
				if($mail_as_html == '1'){
					$mail->IsHTML(true);
					$mail->Body     =  $mail_body_html;
					$mail->AltBody  =  $mail_body_text;
				}
				else{
					$mail->IsHTML(false);
					//$mail->IsMail();
					//$mail->Body     =  $mail_body_text;
					//$mail->AltBody  =  $mail_body_html;
					$mail->Body     =  $mail_body_html;
					$mail->AltBody  =  $mail_body_text;
				}
				
				if(!$mail->Send()){
					echo '<script>'
					.'history.back();'
					.'alert(\''._MSG_SEND_FAILED.'\n\nMailer Error: '.$mail->ErrorInfo.'\');'
					.'</script>';
					break;
				}
			}
			else{
				$header = "From: $owner <$owner_email>\n";
				$header .= "Content-Type: text/plain";
				mail($send_mail_to, $owner.' - '._NL_NEWSLETTER.' - '.$date.' -  '.$subject, _FORM_FROM.$owner."
-------------------------------------------------------------------------------
	
 "._FORM_SUBJECT.": $subject
 "._FORM_DEAR.":    $send_name
 "._FORM_MESSAGE.":
	
	$content
	
-------------------------------------------------------------------------------
	
	$nlmailmsg $owner_email
","$header");
			}
		}
		
		echo '<script>'
		.'alert(\''._MSG_SEND.'\');'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_newsletter\';'
		.'</script>';
	}
	
	
	
	
	
	/*
		SAVEING GLOBAL NEWSLETTER SETTINGS
	*/
	
	if($todo == 'save_nl'){
		if($id_group == 'Developer' || $id_group == 'Administrator'){
			if(empty($use_nl))  { $use_nl   = 0; }
			if(empty($show_nlt)){ $show_nlt = 0; }
			if($text_nl == '')  { $text_nl  = $old_text_nl; }
			if($title_nl == '') { $title_nl = 'Newsletter'; }
			if($link_nl == '')  { $link_nl  = 'Submit'; }
			
			
			$text_nl    = $tcms_main->decode_text($text_nl, '2',$c_charset);
			$title_nl   = $tcms_main->decode_text($title_nl, '2', $c_charset);
			$link_nl    = $tcms_main->decode_text($link_nl, '2', $c_charset);
			
			
			if($choosenDB == 'xml'){
				$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_global/newsletter.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('newsletter');
				
				$xmluser->write_value('nl_title', $title_nl);
				$xmluser->write_value('nl_show_title', $show_nlt);
				$xmluser->write_value('nl_text', $text_nl);
				$xmluser->write_value('nl_link', $link_nl);
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('newsletter');
				$xmluser->_xmlparser();
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				$newSQLData = ''
				.$tcms_db_prefix.'newsletter.nl_title="'.$title_nl.'", '
				.$tcms_db_prefix.'newsletter.nl_show_title='.$show_nlt.', '
				.$tcms_db_prefix.'newsletter.nl_text="'.$text_nl.'", '
				.$tcms_db_prefix.'newsletter.nl_link="'.$link_nl.'"';
				
				$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'newsletter', $newSQLData, 'newsletter');
			}
			
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_newsletter&todo=config\'</script>';
		}
	}
	
	
	
	
	/*
		SAVING NEWSLETTER USER
	*/
	
	if($todo == 'save'){
		if($new_nl_email == '' || strpos($new_nl_email, '@') == false) {
			echo '<script>'
			.'alert(\''._MSG_NOEMAIL.' ...\');'
			.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_newsletter\''
			.'</script>';
		}
		else{
			if($choosenDB == 'xml'){
				$var_conf = 'nl_user';
				
				$new_nl_name = $tcms_main->decode_text($new_nl_name, '2', $c_charset);
				
				$xmluser = new xmlparser('../../'.$tcms_administer_site.'/tcms_newsletter/'.$maintag.'.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section($var_conf);
				
				$xmluser->write_value('user', $new_nl_name);
				$xmluser->write_value('email', $new_nl_email);
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end($var_conf);
				$xmluser->_xmlparser();
			}
			else{
				$new_nl_name = $tcms_main->decode_text($new_nl_name, '2', $c_charset);
				
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				if(isset($action) && !empty($action) && $action == 'new'){
					switch($choosenDB){
						case 'mysql':
							$newSQLColumns = '`user`, `email`';
							break;
						
						case 'pgsql':
							$newSQLColumns = 'user, email';
							break;
						
						case 'mssql':
							$newSQLColumns = '[user], [email]';
							break;
					}
					$newSQLData = "'".$new_nl_name."', '".$new_nl_email."'";
					
					$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'newsletter_items', $newSQLColumns, $newSQLData, $maintag);
				}
				else{
					$newSQLData = ''
					.$tcms_db_prefix.'newsletter_items.user="'.$new_nl_name.'", '
					.$tcms_db_prefix.'newsletter_items.email="'.$new_nl_email.'"';
					
					$sqlQR = $sqlAL->sqlUpdateOne($tcms_db_prefix.'newsletter_items', $newSQLData, $maintag);
				}
			}
			
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_newsletter&todo=listNL\'</script>';
		}
	}
	
	
	
	
	/*
		DELETE
	*/
	
	if($todo == 'delete'){
		if($check == 'yes'){
			if($choosenDB == 'xml'){
				unlink('../../'.$tcms_administer_site.'/tcms_newsletter/'.$maintag.'.xml');
			}
			else{
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				$sqlAL->sqlDeleteOne($tcms_db_prefix.'newsletter_items', $maintag);
			}
			
			echo '<script>document.location=\'admin.php?id_user='.$id_user.'&site=mod_newsletter&todo=listNL\'</script>';
		}
		else{
			echo '<script type="text/javascript">
			delCheck = confirm("'._MSG_DELETE_SUBMIT.'");
			if(delCheck == false){
				document.location=\'admin.php?id_user='.$id_user.'&site=mod_newsletter\';
			}
			else{
				document.location=\'admin.php?id_user='.$id_user.'&site=mod_newsletter&todo=delete&check=yes&maintag='.$maintag.'\';
			}
			</script>';
		}
	}
}
else{
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}



?>
