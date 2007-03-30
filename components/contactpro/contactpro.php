<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Contactform PRO component
|
| File:		contactpro.php
| Version:	0.2.0
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



if(isset($_POST['cpro_company'])){ $cpro_company = $_POST['cpro_company']; }
if(isset($_POST['cpro_title'])){ $cpro_title = $_POST['cpro_title']; }
if(isset($_POST['cpro_lastname'])){ $cpro_lastname = $_POST['cpro_lastname']; }
if(isset($_POST['cpro_firstname'])){ $cpro_firstname = $_POST['cpro_firstname']; }
if(isset($_POST['cpro_street'])){ $cpro_street = $_POST['cpro_street']; }
if(isset($_POST['cpro_zip'])){ $cpro_zip = $_POST['cpro_zip']; }
if(isset($_POST['cpro_city'])){ $cpro_city = $_POST['cpro_city']; }
if(isset($_POST['cpro_fon'])){ $cpro_fon = $_POST['cpro_fon']; }
if(isset($_POST['cpro_fon_city'])){ $cpro_fon_city = $_POST['cpro_fon_city']; }
if(isset($_POST['cpro_country'])){ $cpro_country = $_POST['cpro_country']; }
if(isset($_POST['cpro_email'])){ $cpro_email = $_POST['cpro_email']; }
if(isset($_POST['cpro_website'])){ $cpro_website = $_POST['cpro_website']; }
if(isset($_POST['cpro_subject'])){ $cpro_subject = $_POST['cpro_subject']; }
if(isset($_POST['cpro_message'])){ $cpro_message = $_POST['cpro_message']; }
if(isset($_POST['send_form'])){ $send_form = $_POST['send_form']; }
if(isset($_POST['cpro_receiver'])){ $cpro_receiver = $_POST['cpro_receiver']; }
if(isset($_POST['cpro_ustd'])){ $cpro_ustd = $_POST['cpro_ustd']; }
if(isset($_POST['cpro_fax'])){ $cpro_fax = $_POST['cpro_fax']; }



/*
	init
*/

require_once('engine/tcms_kernel/tcms_countrylist.lib.php');

$path = $tcms_administer_site.'/components/contactpro/images';

$cformproTitle     = $_TCMS_CS_ARRAY['contactpro']['content']['cformpro_title'];
$cformproSubTitle  = $_TCMS_CS_ARRAY['contactpro']['content']['cformpro_subtitle'];
$showCformproTitle = $_TCMS_CS_ARRAY['contactpro']['content']['show_cformpro_title'];
$contactproEmail   = $_TCMS_CS_ARRAY['contactpro']['content']['cformpro_email'];

$cformproFolder = $_TCMS_CS_ID['contactpro']['folder'];

//$contactproEmail = str_replace('@', '__NO_SPAM__', $contactproEmail);
//$contactproEmail = 'mail@octacom-antriebstechnik.de';


if($_TCMS_CS_ARRAY['contactpro']['attribute']['cformpro_title']['ENCODE'] == 1){
	$cformproTitle = $tcms_main->decodeText($cformproTitle, '2', $tcms_config->getCharset(), true);
}

if($_TCMS_CS_ARRAY['contactpro']['attribute']['cformpro_subtitle']['ENCODE'] == 1){
	$cformproSubTitle = $tcms_main->decodeText($cformproSubTitle, '2', $tcms_config->getCharset(), true);
}


include_once('lang/'.$tcms_config->getLanguageFrontend().'.php');


echo '<style type="text/css">
@import "/'.$tcms_config->getSEOPath().'/'.$tcms_administer_site.'/components/'.$cformproFolder.'/style/style.css";
</style>';



/*
	title
*/

if($showCformproTitle == 1){
	echo tcms_html::contentheading($cformproTitle);
	echo tcms_html::contentmain($cformproSubTitle);
	echo '<br />';
}
else{
	echo '<br />';
}



/*
	data
*/

echo '<script language="JavaScript">
function checkCProInputs(){
	var sendOK = false;
	
	if(document.getElementById(\'cpro_lastname\').value == \'\') {
		sendOK = false;
		alert(\''._MSG_NONAME.'\');
		document.getElementById(\'cpro_lastname\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(isNaN(document.getElementById(\'cpro_lastname\').value) == false) {
		sendOK = false;
		alert(\''._CPRO_MSG_NUMBER.'\');
		document.getElementById(\'cpro_lastname\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(document.getElementById(\'cpro_company\').value == \'\') {
		sendOK = false;
		alert(\''._MSG_NOCONTENT.'\');
		document.getElementById(\'cpro_company\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(isNaN(document.getElementById(\'cpro_company\').value) == false) {
		sendOK = false;
		alert(\''._CPRO_MSG_NUMBER.'\');
		document.getElementById(\'cpro_company\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(document.getElementById(\'cpro_street\').value == \'\') {
		sendOK = false;
		alert(\''._MSG_NOCONTENT.'\');
		document.getElementById(\'cpro_street\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(document.getElementById(\'cpro_zip\').value == \'\') {
		sendOK = false;
		alert(\''._MSG_NOCONTENT.'\');
		document.getElementById(\'cpro_zip\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(isNaN(document.getElementById(\'cpro_zip\').value)) {
		sendOK = false;
		alert(\''._CPRO_MSG_NONUMBER.'\');
		document.getElementById(\'cpro_zip\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(document.getElementById(\'cpro_zip\').value.length < 5) {
		sendOK = false;
		alert(\''._CPRO_MSG_LENGTH.'\');
		document.getElementById(\'cpro_zip\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(document.getElementById(\'cpro_city\').value == \'\') {
		sendOK = false;
		alert(\''._MSG_NOCONTENT.'\');
		document.getElementById(\'cpro_city\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(isNaN(document.getElementById(\'cpro_city\').value) == false) {
		sendOK = false;
		alert(\''._CPRO_MSG_NUMBER.'\');
		document.getElementById(\'cpro_city\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(document.getElementById(\'cpro_fon\').value == \'\') {
		sendOK = false;
		alert(\''._MSG_NOCONTENT.'\');
		document.getElementById(\'cpro_fon\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(isNaN(document.getElementById(\'cpro_fon\').value)) {
		sendOK = false;
		alert(\''._CPRO_MSG_NONUMBER.'\');
		document.getElementById(\'cpro_fon\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(document.getElementById(\'cpro_fon_city\').value == \'\') {
		sendOK = false;
		alert(\''._MSG_NOCONTENT.'\');
		document.getElementById(\'cpro_fon_city\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(isNaN(document.getElementById(\'cpro_fon_city\').value)) {
		sendOK = false;
		alert(\''._CPRO_MSG_NONUMBER.'\');
		document.getElementById(\'cpro_fon_city\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(document.getElementById(\'cpro_fax\').value == \'\') {
		sendOK = false;
		alert(\''._MSG_NOCONTENT.'\');
		document.getElementById(\'cpro_fax\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(isNaN(document.getElementById(\'cpro_fax\').value)) {
		sendOK = false;
		alert(\''._CPRO_MSG_NONUMBER.'\');
		document.getElementById(\'cpro_fax\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(document.getElementById(\'cpro_email\').value == \'\') {
		sendOK = false;
		alert(\''._MSG_NOEMAIL.'\');
		document.getElementById(\'cpro_email\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(document.getElementById(\'cpro_email\').value.indexOf(\'@\') == -1) {
		sendOK = false;
		alert(\''._MSG_EMAILVALID.'\');
		document.getElementById(\'cpro_email\').focus();
		return false;
	}
	else{ sendOK = true; }
	
	if(document.getElementById(\'cpro_subject\').value == \'\') {
		sendOK = false;
		alert(\''._MSG_NOSUBJECT.'\');
		document.getElementById(\'cpro_subject\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(isNaN(document.getElementById(\'cpro_subject\').value) == false) {
		sendOK = false;
		alert(\''._CPRO_MSG_NUMBER.'\');
		document.getElementById(\'cpro_subject\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(document.getElementById(\'cpro_message\').value == \'\') {
		sendOK = false;
		alert(\''._MSG_NOMSG.'\');
		document.getElementById(\'cpro_message\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if(document.getElementById(\'cpro_ustd\').value == \'\') {
		sendOK = false;
		alert(\''._MSG_NOCONTENT.'\');
		document.getElementById(\'cpro_ustd\').focus();
		return false;
	}
	else { sendOK = true; }
	
	if (sendOK){ document.getElementById(\'cformpro\').submit(); }
}
</script>';

if(!isset($send_form) && $send_form != 1){
	echo '<br />'
	.'<form name="cformpro" id="cformpro" method="post" action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?">'
	.'<input name="send_form" type="hidden" id="send_form" value="1" />'
	.'<input name="id" type="hidden" id="id" value="components" />'
	.'<input name="item" type="hidden" id="item" value="contactpro" />'
	.'<input name="s" type="hidden" id="s" value="'.$s.'" />';
	
	if(isset($session)) echo '<input name="session" type="hidden" id="session" value="'.$session.'" />';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="text_normal">'._CPRO_TO.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<select name="cpro_receiver" class="inputtext">'
	.'<option value="mail">Allgemein</option>'
	.'<option value="mf">Marion Frick (Office)</option>'
	.'<option value="rt">Rainer Turba (Einkauf/Verkauf)</option>'
	.'<option value="tl">Thomas Lenz (Service/Logistig)</option>'
	.'<option value="bn">Beate Nürnberger (Controller)</option>'
	.'<option value="hu">Heiko Umlauf (Reparatur/Versand)</option>'
	.'<option value="jl">Jürgen Leibrich (Vertrieb)</option>'
	.'<option value="ok">Oliver Kendi (IT)</option>'
	.'</select>'
	.'</div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="text_normal">'._CPRO_PERSON_TITLE.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<select name="cpro_title" class="inputtext">'
	.'<option value="mr">'._CPRO_PERSON_TITLE_MR.'</option>'
	.'<option value="mrs">'._CPRO_PERSON_TITLE_MRS.'</option>'
	.'</select>'
	.'</div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="redPoints">*</span>&nbsp;'
	.'<span class="text_normal">'._CPRO_PERSON_LASTNAME.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<input type="text" class="inputtext inputSmall190px" id="cpro_lastname" name="cpro_lastname" /></div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="text_normal">'._CPRO_PERSON_FIRSTNAME.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<input type="text" class="inputtext inputSmall190px" id="cpro_firstname" name="cpro_firstname" /></div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="redPoints">*</span>&nbsp;'
	.'<span class="text_normal">'._CPRO_PERSON_COMPANY.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<input type="text" class="inputtext inputSmall190px" id="cpro_company" name="cpro_company" /></div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="redPoints">*</span>&nbsp;'
	.'<span class="text_normal">'._CPRO_PERSON_USTD.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<input type="text" class="inputtext inputSmall190px" id="cpro_ustd" name="cpro_ustd" /></div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="redPoints">*</span>&nbsp;'
	.'<span class="text_normal">'._CPRO_PERSON_STREET.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<input type="text" class="inputtext inputSmall190px" id="cpro_street" name="cpro_street" /></div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="redPoints">*</span>&nbsp;'
	.'<span class="text_normal">'._CPRO_PERSON_ZIP.' / '._CPRO_PERSON_CITY.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<input type="text" class="inputtext inputSmall40px" id="cpro_zip" name="cpro_zip" />'
	.'<input type="text" class="inputtext inputSmall143px" id="cpro_city" name="cpro_city" />'
	.'</div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="redPoints">*</span>&nbsp;'
	.'<span class="text_normal">'._CPRO_PERSON_FON_CITY.' / '._CPRO_PERSON_FON.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<input type="text" class="inputtext inputSmall40px" id="cpro_fon_city" name="cpro_fon_city" />'
	.'<input type="text" class="inputtext inputSmall143px" id="cpro_fon" name="cpro_fon" />'
	.'</div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="redPoints">*</span>&nbsp;'
	.'<span class="text_normal">'._CPRO_PERSON_FAX.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<input type="text" class="inputtext inputSmall190px" id="cpro_fax" name="cpro_fax" /></div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="text_normal">'._CPRO_PERSON_COUNTRY.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<select name="cpro_country" class="inputtext" style="width: 195px;">';
	
	//foreach($arrCountryList as $key => $value){
	//	echo '<option value="'.$key.'"'.( $key == 'de' ? ' selected="selected"' : '' ).'>'.$value.'</option>';
	//}
	foreach($arrCountryList as $key => $value){
		echo '<option value="'.$arrCountryList[$key]['xs'].'"'.( $arrCountryList[$key]['xs'] == 'de' ? ' selected="selected"' : '' ).'>'.$value['xl'].'</option>';
	}
	
	echo '</select>'
	.'</div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="redPoints">*</span>&nbsp;'
	.'<span class="text_normal">'._CPRO_PERSON_EMAIL.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<input type="text" class="inputtext inputSmall190px" id="cpro_email" name="cpro_email" /></div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="text_normal">'._CPRO_PERSON_WEB.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<input type="text" class="inputtext inputSmall190px" id="cpro_website" name="cpro_website" /></div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="redPoints">*</span>&nbsp;'
	.'<span class="text_normal">'._CPRO_PERSON_SUBJECT.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<input type="text" class="inputtext inputSmall190px" id="cpro_subject" name="cpro_subject" /></div>';
	
	
	// inputs
	echo '<div style="display: block; float: left; width: 150px;">'
	.'<span class="text_normal">'._CPRO_PERSON_MSG.'</span></div>';
	
	echo '<div style="display: block; margin: 0 0 3px 1px; width: 400px;">'
	.'<textarea class="inputtextarea" id="cpro_message" name="cpro_message"></textarea></div>';
	
	
	// button
	echo '<br />';
		
	echo '<input type="button" class="inputbutton" onclick="javascript:checkCProInputs();" value="'._CPRO_SEND.'" />'
	.'<noscript><input type="submit" class="inputbutton" value="'._CPRO_SEND.'" /></noscript>';
	
	
	// end form
	echo '</form>';
}


if($tcms_main->isReal($send_form) && $send_form == 1){
	$cpro_message = stripslashes($cpro_message);
	$cpro_message = $tcms_main->nl2br($cpro_message);
	
	$cpro_subject = stripslashes($cpro_subject);
	$cpro_website = stripslashes($cpro_website);
	
	$date = date("d.m.Y H:i:s");
	
	$remote = getenv('REMOTE_ADDR');
	$date = date('m.d.Y H:i:s');
	
	if($remote == '') $ip = '<em> no ip </em>';
	else $ip = getHostByAddr($remote);
	
	$c_fullname     = ( $cpro_title == 'mr' ? _CPRO_PERSON_TITLE_MR : _CPRO_PERSON_TITLE_MRS );
	$c_fullname     .= ' '.$cpro_firstname.' '.$cpro_lastname;
	$c_street       = $cpro_street;
	$c_zip_city     = $cpro_zip.' '.$cpro_city;
	$c_fonnumber    = $cpro_fon;
	$c_fonnumber_city    = $cpro_fon_city;
	$c_fax    = $cpro_fax;
	$c_country      = $arrCountryList[$cpro_country];
	$c_subject      = $cpro_subject;
	$c_web          = $cpro_website;
	$c_mail         = $cpro_email;
	$c_msg          = $cpro_message;
	$c_company      = $cpro_company;
	$c_ustd         = $cpro_ustd;
	
	$form_name      = _FORM_NAME;
	$form_street    = _CPRO_PERSON_STREET;
	$form_zip_city  = _CPRO_PERSON_ZIP.' / '._CPRO_PERSON_CITY;
	$form_fonnumber = _CPRO_PERSON_FON;
	$form_fonnumber_city = _CPRO_PERSON_FON_CITY;
	$form_fax = _CPRO_PERSON_FAX;
	$form_country   = _CPRO_PERSON_COUNTRY;
	$form_email     = _CPRO_PERSON_EMAIL;
	$form_web       = _CPRO_PERSON_WEB;
	$form_message   = _CPRO_PERSON_MSG;
	$form_company   = _CPRO_PERSON_COMPANY;
	$form_ustd      = _CPRO_PERSON_USTD;
	
	$msg_form_content = _FORM_MSG_CONTENT;
	
	switch($cpro_receiver){
		case 'mail':
			$m_contactproEmail = 'mail@octacom-antriebstechnik.de';
			break;
		
		case 'mf':
			$m_contactproEmail = 'frick@octacom-antriebstechnik.de';
			break;
		
		case 'rt':
			$m_contactproEmail = 'turba@octacom-antriebstechnik.de';
			break;
		
		case 'tl':
			$m_contactproEmail = 'lenz@octacom-antriebstechnik.de';
			break;
		
		case 'bn':
			$m_contactproEmail = 'nuernberger@octacom-antriebstechnik.de';
			break;
		
		case 'hu':
			$m_contactproEmail = 'umlauf@octacom-antriebstechnik.de';
			break;
		
		case 'jl':
			$m_contactproEmail = 'leibrich@octacom-antriebstechnik.de';
			break;
		
		case 'ok':
			$m_contactproEmail = 'O.Kendi@octacom-antriebstechnik.de';
			break;
		
		default:
			$m_contactproEmail = 'mail@octacom-antriebstechnik.de';
			break;
	}
	
	$header = "From: $mail_name <$mail_email>\n";
	$header .= "Reply-To: $mail_email\n";     
	$header .= "Content-Type: text/plain"; 
	
	mail($m_contactproEmail, $c_subject,"
 $ip $date
 ----------------------------------------------------------------------
 
 $form_name:       $c_fullname
 $form_company:    $c_company
 $form_ustd:       $c_ustd
 $form_street:     $c_street
 $form_zip_city:   $c_zip_city
 $form_fonnumber_city:  $c_fonnumber_city
 $form_fonnumber:  $c_fonnumber
 $form_fax:  $c_fax
 $form_country:    $c_country
 $form_web:        $c_web
 $form_email:      $c_mail
 $form_message:

$c_msg

 ----------------------------------------------------------------------
","$header");
	
	$link = '?'.( isset($session) ? 'session='.$session.'&' : '' ).'id=components&item=contactpro';
	$link = $tcms_main->urlAmpReplace($link);
	
	echo '<script>'
	.'document.location=\''.$link.'\';'
	.'alert(\''._MSG_SEND.'\');'
	.'</script>';
}


echo '<br />';
//echo '<br />';

?>
