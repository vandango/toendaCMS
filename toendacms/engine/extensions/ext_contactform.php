<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Contact Formular
|
| File:	ext_contactform.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Contact Formular
 *
 * This module provides a contactform with a internal
 * adressbook with vcard export.
 *
 * @version 0.8.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


if(isset($_POST['mail_name'])){ $mail_name = $_POST['mail_name']; }
if(isset($_POST['mail_email'])){ $mail_email = $_POST['mail_email']; }
if(isset($_POST['mail_website'])){ $mail_website = $_POST['mail_website']; }
if(isset($_POST['mail_subject'])){ $mail_subject = $_POST['mail_subject']; }
if(isset($_POST['mail_message'])){ $mail_message = $_POST['mail_message']; }
if(isset($_POST['kopie'])){ $kopie = $_POST['kopie']; }
if(isset($_POST['send_form'])){ $send_form = $_POST['send_form']; }


if($cform_enabled == 1){
	echo $tcms_html->contentModuleHeader(
		$contact_title, 
		$contact_stamp, 
		$contact_text
	);
	
	
	echo '<span class="contentmain">';
	
	using('toendacms.datacontainer.contact');
	
	
	
	/*
		adressbook
	*/
	
	if($item == 'adressbook' 
	&& $use_adressbook == 1){
		echo '<form id="adress_back" action="'
		.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=contactform&amp;s='.$s
		.'" method="get">'
		.'<input type="submit" class="inputbutton" value="'._TCMS_ADMIN_BACK.'" />'
		.( isset($lang) ? '<input type="hidden" name="lang" value="'.$lang.'" />' : '' )
		.'</form><br />';
		
		if($choosenDB == 'xml'){
			$arr_sbc = $tcms_main->readdir_ext($tcms_administer_site.'/tcms_contacts/');
			foreach ($arr_sbc as $key => $value){
				$contacts_xml = new xmlparser($tcms_administer_site.'/tcms_contacts/'.$value,'r');
				$tc_pub = $contacts_xml->read_section('contact', 'published');
				
				if($tc_pub == 1){
					$csb_id    = substr($value, 0, 10);
					$csb_name  = $contacts_xml->read_section('contact', 'name');
					$csb_job   = $contacts_xml->read_section('contact', 'position');
					$csb_email = $contacts_xml->read_section('contact', 'email');
					$csb_phone = $contacts_xml->read_section('contact', 'phone');
					
					if($csb_name  == false){ $csb_name  = ''; }
					if($csb_job   == false){ $csb_job   = ''; }
					if($csb_email == false){ $csb_email = ''; }
					if($csb_phone == false){ $csb_phone = ''; }
					
					$csb_name  = $tcms_main->decodeText($csb_name, '2', $c_charset);
					$csb_job   = $tcms_main->decodeText($csb_job, '2', $c_charset);
					$csb_email = $tcms_main->decodeText($csb_email, '2', $c_charset);
					$csb_phone = $tcms_main->decodeText($csb_phone, '2', $c_charset);
					
					echo '<div style="display: block; width: 400px;">';
					
					if(!empty($csb_email)){
						echo '<div style="display: block; float: right;">';
						
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=contactform&amp;s='.$s.'&amp;contact_email='.$csb_email
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlAmpReplace($link);
						
						echo '<a href="#" class="main" onclick="document.location=\''.$link.'\';" value="'._CONTACT_SEND_A_EMAIL.'" />';
						
						if($detect_browser == 1){
							echo '<script>if(browser == \'ie\'){
							document.write(\'<img style="margin-bottom: -6px;" alt="'._CONTACT_SEND_A_EMAIL.'" title="'._CONTACT_SEND_A_EMAIL.'" style="" src="'.$imagePath.'engine/images/email.gif" border="0" />\');
							}else{
							document.write(\'<img style="margin-bottom: -6px;" alt="'._CONTACT_SEND_A_EMAIL.'" title="'._CONTACT_SEND_A_EMAIL.'" style="padding-bottom: 0px; padding-top: 1px;" src="'.$imagePath.'engine/images/email.png" border="0" />\');
							}</script>';
							
							echo '<noscript>'
							.'<img style="margin-bottom: -6px;" alt="'._CONTACT_SEND_A_EMAIL.'" title="'._CONTACT_SEND_A_EMAIL.'" style="" src="'.$imagePath.'engine/images/email.gif" border="0" />'
							.'</noscript>';
						}
						else{
							echo '<img style="margin-bottom: -6px;" alt="'._CONTACT_SEND_A_EMAIL.'" title="'._CONTACT_SEND_A_EMAIL.'" style="" src="'.$imagePath.'engine/images/email.png" border="0" />';
						}
						
						echo '<strong style="padding-bottom: 3px; padding-top: 0px;">'._CONTACT_SEND_A_EMAIL.'</strong></a>';
						
						echo '<br />';
						
						
						$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
						.'id=contactform&amp;s='.$s.'&amp;action=vcard&amp;c='.$csb_id
						.( isset($lang) ? '&amp;lang='.$lang : '' );
						$link = $tcms_main->urlAmpReplace($link);
						
						echo '<form name="vcard" action="engine/tcms_kernel/vcard/vcard.php" method="post">'
						.'<input type="hidden" name="c" value="'.$csb_id.'">' // contact_id
						.'</form>';
						
						echo '<a href="#" class="main" onclick="document.vcard.submit();" />'
						.'<img style="margin-bottom: -6px;" alt="'._CONTACT_VCARD_DOWNLOAD.'" title="'._CONTACT_VCARD_DOWNLOAD.'"'
						.' src="'.$imagePath.'engine/images/vcard.png" border="0" />'
						.'&nbsp;<strong style="padding-bottom: 3px; padding-top: 0px;">'._CONTACT_VCARD_DOWNLOAD.'</strong>'
						.'</a>';
						
						echo '</div>';
					}
					
					
					echo ( !empty($csb_name)  ? '<strong class="text_normal">'.$csb_name.'</strong><br />' : '' );
					echo ( !empty($csb_job)   ? '<span class="text_small">'.$csb_job.'</span><br />' : '' );
					
					if($cipher_email == 1){
						echo ( !empty($csb_email) ? '<span class="text_normal"><script>JSCrypt.displayCryptMail(\''.$tcms_main->encodeBase64($csb_email).'\', \''.$csb_name.'\');</script></span><br />' : '' );
					}
					else{
						echo ( !empty($csb_email) ? '<span class="text_normal"><a href="mailto:'.$csb_email.'">'.$csb_email.'</a></span><br />' : '' );
					}
					
					echo ( !empty($csb_phone) ? '<span class="text_normal">'.$csb_phone.'</span><br />' : '' );
					echo '<br />';
					
					echo '</div>';
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($choosenDB);
			$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			
			$sqlQR = $sqlAL->sqlGetALL($tcms_db_prefix.'contacts WHERE published=1 ORDER BY name');
			
			while($sqlObj = $sqlAL->sqlFetchObject($sqlQR)){
				$csb_id      = $sqlObj->uid;
				$csb_name    = $sqlObj->name;
				$csb_job     = $sqlObj->position;
				$csb_email   = $sqlObj->email;
				$csb_street  = $sqlObj->street;
				$csb_postal  = $sqlObj->postal;
				$csb_city    = $sqlObj->town;
				$csb_phone   = $sqlObj->phone;
				$csb_fax     = $sqlObj->fax;
				$csb_state   = $sqlObj->state;
				$csb_country = $sqlObj->country;
				
				if($csb_name    == NULL){ $csb_name    = ''; }
				if($csb_job     == NULL){ $csb_job     = ''; }
				if($csb_email   == NULL){ $csb_email   = ''; }
				if($csb_street  == NULL){ $csb_street  = ''; }
				if($csb_postal  == NULL){ $csb_postal  = ''; }
				if($csb_city    == NULL){ $csb_city    = ''; }
				if($csb_phone   == NULL){ $csb_phone   = ''; }
				if($csb_fax     == NULL){ $csb_fax     = ''; }
				if($csb_state   == NULL){ $csb_state   = ''; }
				if($csb_country == NULL){ $csb_country = ''; }
				
				$csb_name    = $tcms_main->decodeText($csb_name, '2', $c_charset);
				$csb_job     = $tcms_main->decodeText($csb_job, '2', $c_charset);
				$csb_email   = $tcms_main->decodeText($csb_email, '2', $c_charset);
				$csb_street  = $tcms_main->decodeText($csb_street, '2', $c_charset);
				$csb_postal  = $tcms_main->decodeText($csb_postal, '2', $c_charset);
				$csb_city    = $tcms_main->decodeText($csb_city, '2', $c_charset);
				$csb_phone   = $tcms_main->decodeText($csb_phone, '2', $c_charset);
				$csb_fax     = $tcms_main->decodeText($csb_fax, '2', $c_charset);
				$csb_state   = $tcms_main->decodeText($csb_state, '2', $c_charset);
				$csb_country = $tcms_main->decodeText($csb_country, '2', $c_charset);
				
				if(strtolower($csb_country) == 'deutschland' 
				|| strtolower($csb_country) == 'germany'
				|| strtolower($csb_country) == '') {
					if(strlen($csb_postal) == 4) {
						$csb_postal = '0'.$csb_postal;
					}
				}
				
				
				echo '<div style="display: block; width: 400px;">';
				
				if(!empty($csb_email)){
					echo '<div style="display: block; float: right;">';
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=contactform&amp;s='.$s.'&amp;contact_email='.$csb_email
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<a href="#" class="main" onclick="document.location=\''.$link.'\';" />';
					
					if($detect_browser == 1){
						echo '<script>if(browser == \'ie\'){'
						.'document.write(\'<img style="margin-bottom: -6px;" alt="'._CONTACT_SEND_A_EMAIL.'" title="'._CONTACT_SEND_A_EMAIL.'" style="" src="'.$imagePath.'engine/images/email.gif" border="0" />\');'
						.'}else{'
						.'document.write(\'<img style="margin-bottom: -6px;" alt="'._CONTACT_SEND_A_EMAIL.'" title="'._CONTACT_SEND_A_EMAIL.'" style="padding-bottom: 0px; padding-top: 1px;" src="'.$imagePath.'engine/images/email.png" border="0" />\');'
						.'}</script>';
						
						echo '<noscript>'
						.'<img style="margin-bottom: -6px;" alt="'._CONTACT_SEND_A_EMAIL.'" title="'._CONTACT_SEND_A_EMAIL.'" style="" src="'.$imagePath.'engine/images/email.png" border="0" />'
						.'</noscript>';
					}
					else{
						echo '<img style="margin-bottom: -6px;" alt="'._CONTACT_SEND_A_EMAIL.'" title="'._CONTACT_SEND_A_EMAIL.'" style="" src="'.$imagePath.'engine/images/email.png" border="0" />';
					}
					
					echo '&nbsp;<strong style="padding-bottom: 3px; padding-top: 0px;">'._CONTACT_SEND_A_EMAIL.'</strong></a>';
					
					
					echo '<br />';
					
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=contactform&amp;s='.$s.'&amp;action=vcard&amp;c='.$csb_id
					.( isset($lang) ? '&amp;lang='.$lang : '' );
					$link = $tcms_main->urlAmpReplace($link);
					
					echo '<form name="vcard_'.$csb_id.'" action="engine/tcms_kernel/vcard/vcard.php" method="post">'
					.'<input type="hidden" name="c" value="'.$csb_id.'">' // contact_id
					.'</form>';
					
					echo '<a href="#" class="main" onclick="document.vcard_'.$csb_id.'.submit();" />'
					.'<img style="margin-bottom: -6px;" alt="'._CONTACT_VCARD_DOWNLOAD.'" title="'._CONTACT_VCARD_DOWNLOAD.'"'
					.' src="'.$imagePath.'engine/images/vcard.png" border="0" />'
					.'&nbsp;<strong style="padding-bottom: 3px; padding-top: 0px;">'._CONTACT_VCARD_DOWNLOAD.'</strong>'
					.'</a>';
					
					echo '</div>';
				}
				
				
				echo ( !empty($csb_name) ? '<strong class="text_big">'.$csb_name.'</strong>' : '' );
				echo ( !empty($csb_job)  ? ' &bull; <span class="text_normal">'.$csb_job.'</span><br />' : '<br />' );
				
				echo '<span class="text_normal">';
				
				if($cipher_email == 1){
					echo ( !empty($csb_email) ? '<span class="text_normal"><script>JSCrypt.displayCryptMail(\''.$tcms_main->encodeBase64($csb_email).'\', \''.$csb_name.'\');</script></span><br />' : '' );
				}
				else{
					echo ( !empty($csb_email) ? '<span class="text_normal"><a href="mailto:'.$csb_email.'">'.$csb_email.'</a></span><br />' : '' );
				}
				
				echo ( !empty($csb_phone)   ? '<strong>'._IMPRESSUM_PHONE.':</strong> '.$csb_phone.'<br />' : '' );
				echo ( !empty($csb_fax)     ? '<strong>'._IMPRESSUM_FAX.':</strong> '.$csb_fax.'<br />' : '' );
				echo ( !empty($csb_street)  ? $csb_street.'<br />' : '' );
				echo ( !empty($csb_postal)  ? $csb_postal : '' );
				echo ( !empty($csb_city)    ? '&nbsp;'.$csb_city.'' : '' );
				echo ( !empty($csb_state)   ? ' / '.$csb_state.', ' : '' );
				echo ( !empty($csb_country) ? ( empty($csb_state) ? ' / ' : '' ).$csb_country.'<br />' : '' );
				echo '</span>';
				echo '<br /><br />';
				
				echo '</div>';
			}
		}
	}
	
	
	
	
	
	/*
		contactform
	*/
	
	if($item != 'adressbook'){
		if($use_contactad == 1){
			echo '<span class="contentmain">';
			
			
			if($choosenDB == 'xml'){
				$con_file = $tcms_main->get_default_contact();
			}
			else{
				$con_file = $tcms_main->get_default_sql_contact($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
			}
			
			$dcCon = new tcms_dc_contact();
			$dcCon = $tcms_ap->getContact($con_file);
			
			
			$name     = $dcCon->getName();
			$position = $dcCon->getPosition();
			$email    = $dcCon->getEmail();
			$street   = $dcCon->getStreet();
			$country  = $dcCon->getCountry();
			$state    = $dcCon->getState();
			$town     = $dcCon->getCity();
			$postal   = $dcCon->getZipcode();
			$telefon  = $dcCon->getPhone();
			$fax      = $dcCon->getFax();
			
			if(strtolower($country) == 'deutschland' 
			|| strtolower($country) == 'germany'
			|| strtolower($country) == '') {
				if(strlen($postal) == 4) {
					$postal = '0'.$postal;
				}
			}
			
			
			if($dcCon->getPublished() == '1') {
				echo ( !empty($name) ? '<strong class="contentheading">'.$name.'</strong>&nbsp;&bull;&nbsp;' :'' );
				echo ( !empty($position) ? '<span class="contentmain">'.$position.'<br />' :'' );
				
				if($cipher_email == 1){
					echo ( !empty($email) ? '<strong>'._PERSON_EMAIL.':</strong> <script>JSCrypt.displayCryptMail(\''.$tcms_main->encodeBase64($email).'\', \''.$name.'\');</script><br />' : '' );
				}
				else{
					echo ( !empty($email) ? '<strong>'._PERSON_EMAIL.':</strong> <a href="mailto:'.$email.'">'.$email.'</a><br />' : '' );
				}
				
				echo ( !empty($telefon) ? '<strong>'._PERSON_PHONE.':</strong> '.$telefon.'<br />' : '' );
				echo ( !empty($fax)     ? '<strong>'._PERSON_FAX.':</strong> '.$fax.'<br />' : '' );
				
				echo '<br />';
				
				echo ( !empty($street)  ? $street.'<br />' : '' );
				echo ( !empty($postal)  ? $postal : '' );
				echo ( !empty($town)    ? ' '.$town.'<br />' : '' );
				echo ( !empty($country) ? $country : '' );
				echo ( !empty($state)   ? ', '.$state.'<br />' : '' );
				
				echo '</span><br /><br />';
			}
		}
		
		
		?><script language="JavaScript">
		function checkinputs(id){
			var sendOK = false;
			
			strName = document.forms[id].mail_name.value;
			if(strName == '') {
				sendOK = false;
				alert('<? echo _MSG_NONAME; ?>');
				document.forms[id].mail_name.focus();
				return;
			}
			else{ sendOK = true; }
			
			strEmail = document.forms[id].mail_email.value;
			if(strEmail == '') {
				sendOK = false;
				alert('<? echo _MSG_NOEMAIL; ?>');
				document.forms[id].mail_email.focus();
				return;
			}
			else{ sendOK = true; }
			
			if(strEmail.indexOf('@') == -1) {
				sendOK = false;
				alert('<? echo _MSG_NOEMAIL; ?>');
				document.forms[id].Email.focus();
				return;
			}
			else{ sendOK = true; }
			
			strmail_message = document.forms[id].mail_message.value;
			if(strmail_message == '') {
				sendOK = false;
				alert('<? echo _MSG_NOMSG; ?>');
				document.forms[id].mail_message.focus();
				return;
			}
			else{ sendOK = true; }
			
			if (sendOK){ document.forms[id].submit(); }
		}
		</script><?
		
		if(!empty($HTTP_POST_VARS)){ extract($HTTP_POST_VARS); }
		
		$remote = getenv('REMOTE_ADDR');
		$date = date('m.d.Y H:i:s');
		
		if ($remote == ""){ $ip = '<em> no ip </em>'; }
		else{ $ip = getHostByAddr($remote); }
		
		
		if(!isset($send_form) && $send_form != 1){
			if($use_adressbook == 1){
				echo '<form id="adress" action="'
				.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=contactform&amp;s='.$s
				.'" method="get">'
				.'<input name="item" type="hidden" value="adressbook" />'
				.( isset($session) ? '<input type="hidden" name="session" value="'.$session.'" />' : '' )
				.( isset($lang) ? '<input type="hidden" name="lang" value="'.$lang.'" />' : '' );
				
				echo '<input style="float: left;" type="button" class="inputbutton adressbook" onclick="javascript:document.forms[\'adress\'].submit();" value="'._CONTACT_ADRESS_BOOK.'" />'
				.'<noscript><input type="submit" class="inputbutton adressbook" value="'._CONTACT_ADRESS_BOOK.'" /></noscript>';
				
				echo '</form>';
			}
			
			
			echo '<form name="cform" id="cform" action="'
			.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=contactform&amp;s='.$s
			.'" method="post">'
			.'<input name="send_form" type="hidden" id="send_form" value="1" />'
			.( isset($session) ? '<input type="hidden" name="session" value="'.$session.'" />' : '' )
			.( isset($lang) ? '<input type="hidden" name="lang" value="'.$lang.'" />' : '' );
			
			if($use_adressbook == 1){
				echo '<input type="button" class="inputbutton sendmail" onclick="javascript:checkinputs(\'cform\');" value="'._FORM_SEND.'" />'
				.'<noscript><input type="submit" class="inputbutton sendmail" value="'._FORM_SEND.'" /></noscript>';
				
				echo '<br /><br />';
			}
			
			
			if($show_contactemail == 1) {
				// inputs
				echo '<div style="float: left; width: 140px;">'
				.'<strong><span class="text_normal">'._CONTACT_ADRESS_EMAIL.':</strong></span></div>';
				
				$contact_email_tmp = str_replace('@', '[at]', $contact_email);
				
				echo '<div style="margin: 0 0 3px 1px;">'
				.$contact_email_tmp.'</div>';
				
				echo '<br />';
			}
			
			
			// inputs
			echo '<div style="display: block; float: left; width: 60px;">'
			.'<span class="text_normal">'._FORM_NAME.'</span></div>';
			
			echo '<div style="display: block; margin: 0 0 3px 1px; width: 300px;">'
			.'<input type="text" class="inputtext" id="mail_name" name="mail_name" /></div>';
			
			
			// inputs
			echo '<div style="display: block; float: left; width: 60px;">'
			.'<span class="text_normal">'._FORM_EMAIL.'</span></div>';
			
			echo '<div style="display: block; margin: 0 0 3px 1px; width: 300px;">'
			.'<input type="text" class="inputtext" id="mail_email" name="mail_email" /></div>';
			
			
			// inputs
			echo '<div style="display: block; float: left; width: 60px;">'
			.'<span class="text_normal">'._FORM_URL.'</span></div>';
			
			echo '<div style="display: block; margin: 0 0 3px 1px; width: 300px;">'
			.'<input type="text" class="inputtext" id="mail_website" name="mail_website" /></div>';
			
			
			// inputs
			echo '<div style="display: block; float: left; width: 60px;">'
			.'<span class="text_normal">'._FORM_SUBJECT.'</span></div>';
			
			echo '<div style="display: block; margin: 0 0 3px 1px; width: 300px;">'
			.'<input type="text" class="inputtext" id="mail_subject" name="mail_subject" /></div>';
			
			
			// inputs
			echo '<div style="display: block; float: left; width: 60px;">'
			.'<span class="text_normal">'._FORM_MSG.'</span></div>';
			
			echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
			.'<textarea class="inputtextarea" id="mail_message" name="mail_message"></textarea></div>';
			
			
			// inputs
			echo '<div style="display: block; float: left; width: 30px;">'
			.'<input name="kopie" type="checkbox" id="kopie" value="checkbox" /></div>';
			
			echo '<div style="display: block; margin: 0 0 3px 1px; width: 300px; text-align: left;">'
			.'<span class="text_normal">'._FORM_COPY.'</span></div>';
			
			
			if($use_adressbook == 0){
				echo '<br />';
				
				echo '<input type="button" style="float: left;" class="inputbutton sendmail" onclick="javascript:checkinputs(\'cform\');" value="'._FORM_SEND.'" />'
				.'<noscript><input type="submit" class="inputbutton sendmail" value="'._FORM_SEND.'" /></noscript>';
			}
			
			
			// end form
			echo '</form>';
			
			/*
			if($use_adressbook == 1){
				echo '<form id="adress" action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?" method="get">'
				.'<input name="id" type="hidden" value="contactform" />'
				.'<input name="s" type="hidden" value="'.$s.'" />'
				.'<input name="item" type="hidden" value="adressbook" />'
				.( isset($session) ? '<input type="hidden" name="session" value="'.$session.'" />' : '' )
				.( isset($lang) ? '<input type="hidden" name="lang" value="'.$lang.'" />' : '' );
				
				echo '<input style="float: right;" type="button" class="inputbutton" onclick="javascript:document.forms[\'adress\'].submit();" value="'._CONTACT_ADRESS_BOOK.'" />'
				.'<noscript><input type="submit" class="inputbutton" value="'._CONTACT_ADRESS_BOOK.'" /></noscript>';
				
				echo '</form>';
			}*/
		}
		
		
		
		/*
			send email
		*/
		if($send_form == 1) {
			$mail_message = stripslashes($mail_message);
			$mail_message = $tcms_main->nl2br($mail_message);
			//$mail_messagehtml = ereg_replace("\n", "<br />", $mail_message);
			$mail_subject = stripslashes($mail_subject);
			$mail_website = stripslashes($mail_website);
			$date = date("d.m.Y H:i:s");
					
			
			// Formulardaten verschicken
			
			$form_name      = _FORM_NAME;
			$form_email     = _FORM_EMAIL;
			$form_url       = _FORM_URL;
			$form_subject   = _FORM_SUBJECT;
			$form_message   = _FORM_MSG;
			$msg_form_cform = _FORM_CFORM;
			
			$msg_form_thankyou = _FORM_THANKYOU;
			$msg_form_content  = _FORM_MSG_CONTENT;
			$msg_form_system   = _FORM_SYSTEM;
			$msg_form_regards  = _FORM_GREETS;
			
			if($mail_with_smtp == '1') {// && $mail_as_html == '1') {
				// phpmailer
				$mail = new PHPMailer();
				
				$mail->IsSMTP();
				$mail->Mailer   = 'smtp';
				$mail->Host     = $mail_server_smtp;
				$mail->SMTPAuth = true;
				//$mail->Timeout  = 60;
				
				$mail->Username = $mail_user;
				$mail->Password = $mail_password;
				
				$mail->From     = $mail_email;
				$mail->FromName = $mail_name;
				$mail->AddAddress($contact_email, $tcms_config->getWebpageOwner()); 
				$mail->AddReplyTo($mail_email, $mail_name);
				
				$mail->WordWrap = 50;
				
				$mail->Subject  =  $msg_form_cform;
				
				// text message
				$mail_body_text = $msg_form_content." ".$date."\n"
				."----------------------------------------------------------------------\n\n"
				.$form_name.": ".$mail_name."\n"
				.$form_url.": ".$mail_website."\n"
				.$form_subject.": ".$mail_subject."\n"
				.$form_email.": ".$mail_email."\n"
				.$form_message.":\n\n".$mail_message."\n"
				."----------------------------------------------------------------------\n"
				.$ip."\n"
				."----------------------------------------------------------------------";
				
				// html message
				$mail_body_html = $msg_form_content.' '.$date.'<hr />'
				.'<strong>'.$form_name.'</strong>: '.$mail_name.'<br />'
				.'<strong>'.$form_url.'</strong>: '.$mail_website.'<br />'
				.'<strong>'.$form_subject.'</strong>: '.$mail_subject.'<br />'
				.'<strong>'.$form_email.'</strong>: '.$mail_email.'<br />'
				.'<strong>'.$form_message.'</strong>:<br />'.$mail_message.'<br /><br />'
				.'<hr /><em>'.$ip.'</em><hr />';
				
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
				}
				
				if(isset($kopie)){
					// copy
					$mail->From     = $contact_email;
					$mail->FromName = $tcms_config->getWebpageOwner();
					$mail->AddAddress($mail_email, $mail_name);
					
					$mail->WordWrap = 50;
					
					$mail->Subject  =  $msg_form_cform;
					
					// text message
					$mail_body_text = $msg_form_content." ".$date."\n"
					.$msg_form_thankyou."\n"
					."----------------------------------------------------------------------\n\n"
					.$form_name.": ".$mail_name."\n"
					.$form_url.": ".$mail_website."\n"
					.$form_subject.": ".$mail_subject."\n"
					.$form_email.": ".$mail_email."\n"
					.$form_message.":\n\n".$mail_message."\n"
					."----------------------------------------------------------------------\n"
					.$msg_form_system."\n\n"
					.$msg_form_regards."\n"
					."----------------------------------------------------------------------";
					
					// html message
					$mail_body_html = $msg_form_content.' '.$date.'<br />'.$msg_form_thankyou.'<hr />'
					.'<strong>'.$form_name.'</strong>: '.$mail_name.'<br />'
					.'<strong>'.$form_url.'</strong>: '.$mail_website.'<br />'
					.'<strong>'.$form_subject.'</strong>: '.$mail_subject.'<br />'
					.'<strong>'.$form_email.'</strong>: '.$mail_email.'<br />'
					.'<strong>'.$form_message.'</strong>:<br />'.$mail_message.'<br /><br />'
					.'<hr />'.$msg_form_system.'<br /><br />'.$msg_form_regards.'<hr />';
					
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
					}
				}
				
				unset($mail);
				
				// end phpmailer
			}
			else {
				$header = "From: $mail_name <$mail_email>\n";
				$header .= "Reply-To: $mail_email\n";     
				$header .= "Content-Type: text/plain";
				
				mail($contact_email, $msg_form_cform,"
 $msg_form_content $date
 ----------------------------------------------------------------------
 
 $form_name:       $mail_name
 $form_url:        $mail_website
 $form_subject:    $mail_subject
 $form_email:      $mail_email
 $form_message:
 
$mail_message
	
 ----------------------------------------------------------------------
  $ip
 ----------------------------------------------------------------------
","$header");
				
				// mail to sender
				if(isset($kopie)){
					$msg_form_dear     = _FORM_DEAR;
					$msg_form_thankyou = _FORM_THANKYOU;
					$msg_form_follow   = _FORM_FOLLOWMSG;
					$form_name         = _FORM_NAME;
					$form_email        = _FORM_EMAIL;
					$form_url          = _FORM_URL;
					$form_subject      = _FORM_SUBJECT;
					$form_message      = _FORM_MSG;
					$msg_form_cform    = _FORM_CFORM;
					$msg_form_system   = _FORM_SYSTEM;
					$msg_form_regards  = _FORM_GREETS;
					
					$header1 = "From: ".$websiteowner."<".$contact_email.">\n";
					$header1 .= "Reply-To: ".$contact_email."\n";     
					$header1 .= "Content-Type: text/plain"; 
					mail("$mail_email","Re. $msg_form_cform - $websiteowner", "
 $msg_form_dear $mail_name,
 $msg_form_thankyou
 ----------------------------------------------------------------------
 
 $msg_form_follow
 
 $form_name:      $mail_name
 $form_email:     $mail_email
 $form_url:       $mail_website
 $form_subject:   $mail_subject
 $form_message:
 
$mail_message
	
 ----------------------------------------------------------------------
 $msg_form_system
		
 $msg_form_regards
 ".$websiteowner."","$header1"); 
				}
			}
			
			$link = '?'.( isset($session) ? 'session='.$session.'&' : '' )
			.'id='.$id.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlAmpReplace($link);
			
			echo '<script>'
			.'document.location=\''.$link.'\';'
			.'alert(\''._MSG_SEND.'\');'
			.'</script>';
		}
	}
	
	echo '</span>';
}
else{
	echo '<strong>'._MSG_DISABLED_MODUL.'</strong>';
}

?>
