<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| law-concurring Impressum
|
| File:		ext_impressum.php
| Version:	0.2.9
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');





//***************************
// Start page

//require_once('engine/tcms_kernel/tcms_countrylist.lib.php');

if(trim($imp_title) != ''){ echo tcms_html::contentheading($imp_title); }
if(trim($imp_stamp) != ''){ echo tcms_html::contentstamp($imp_stamp).'<br /><br /><br />'; }


echo '<span class="contentmain">';

if($imp_contact != '_no_contact_'){
	if($choosenDB == 'xml'){
		$impressum_xml = new xmlparser($tcms_administer_site.'/tcms_contacts/'.$imp_contact.'.xml','r');
		$con_published = $impressum_xml->read_value('published');
		
		if($con_published == 1){
			$contact['name']     = $impressum_xml->read_value('name');
			$contact['position'] = $impressum_xml->read_value('position');
			$contact['email']    = $impressum_xml->read_value('email');
			$contact['street']   = $impressum_xml->read_value('street');
			$contact['country']  = $impressum_xml->read_value('country');
			$contact['state']    = $impressum_xml->read_value('state');
			$contact['town']     = $impressum_xml->read_value('town');
			$contact['postal']   = $impressum_xml->read_value('postal');
			$contact['phone']    = $impressum_xml->read_value('phone');
			$contact['fax']      = $impressum_xml->read_value('fax');
		}
		
		if($contact['name']     == false){ $contact['name']     = ''; }
		if($contact['position'] == false){ $contact['position'] = ''; }
		if($contact['email']    == false){ $contact['email']    = ''; }
		if($contact['street']   == false){ $contact['street']   = ''; }
		if($contact['country']  == false){ $contact['country']  = ''; }
		if($contact['state']    == false){ $contact['state']    = ''; }
		if($contact['town']     == false){ $contact['town']     = ''; }
		if($contact['postal']   == false){ $contact['postal']   = ''; }
		if($contact['phone']    == false){ $contact['phone']    = ''; }
		if($contact['fax']      == false){ $contact['fax']      = ''; }
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlQuery("SELECT * FROM ".$tcms_db_prefix."contacts WHERE uid = '".$imp_contact."' AND published = 1");
		$con_published = $sqlAL->sqlGetNumber($sqlQR);
		
		if($con_published != 0){
			$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
			
			$contact['name']     = $sqlARR['name'];
			$contact['position'] = $sqlARR['position'];
			$contact['email']    = $sqlARR['email'];
			$contact['street']   = $sqlARR['street'];
			$contact['country']  = $sqlARR['country'];
			$contact['state']    = $sqlARR['state'];
			$contact['town']     = $sqlARR['town'];
			$contact['postal']   = $sqlARR['postal'];
			$contact['phone']    = $sqlARR['phone'];
			$contact['fax']      = $sqlARR['fax'];
		}
		
		if($contact['name']     == NULL){ $contact['name']     = ''; }
		if($contact['position'] == NULL){ $contact['position'] = ''; }
		if($contact['email']    == NULL){ $contact['email']    = ''; }
		if($contact['street']   == NULL){ $contact['street']   = ''; }
		if($contact['country']  == NULL){ $contact['country']  = ''; }
		if($contact['state']    == NULL){ $contact['state']    = ''; }
		if($contact['town']     == NULL){ $contact['town']     = ''; }
		if($contact['postal']   == NULL){ $contact['postal']   = ''; }
		if($contact['phone']    == NULL){ $contact['phone']    = ''; }
		if($contact['fax']      == NULL){ $contact['fax']      = ''; }
	}
	
	// CHARSETS
	$contact['name']     = $tcms_main->decodeText($contact['name'], '2', $c_charset);
	$contact['position'] = $tcms_main->decodeText($contact['position'], '2', $c_charset);
	$contact['email']    = $tcms_main->decodeText($contact['email'], '2', $c_charset);
	$contact['street']   = $tcms_main->decodeText($contact['street'], '2', $c_charset);
	$contact['country']  = $tcms_main->decodeText($contact['country'], '2', $c_charset);
	$contact['state']    = $tcms_main->decodeText($contact['state'], '2', $c_charset);
	$contact['town']     = $tcms_main->decodeText($contact['town'], '2', $c_charset);
	$contact['postal']   = $tcms_main->decodeText($contact['postal'], '2', $c_charset);
	$contact['phone']    = $tcms_main->decodeText($contact['phone'], '2', $c_charset);
	$contact['fax']      = $tcms_main->decodeText($contact['fax'], '2', $c_charset);
	
	echo '<strong class="imptitle">'.$websiteowner.'</strong><br /><br />';
	
	
	// contact person
	echo ( $tcms_main->isReal($contact['name']) ? '<strong>'._IMPRESSUM_CONTACTPERSON.':</strong> '.$contact['name'] : '' ).
	( $tcms_main->isReal($contact['position']) ? ', '.$contact['position'].'<br />' : '<br />' );
	
	
	// email
	if($cipher_email == 1)
		echo ( $tcms_main->isReal($contact['email']) ? '<strong>'._IMPRESSUM_EMAIL.':</strong> <script language="JavaScript">JSCrypt.displayCryptMail(\''.$tcms_main->encodeBase64($contact['email']).'\', \''.$contact['name'].'\');</script><br />': '' );
	else
		echo ( $tcms_main->isReal($contact['email']) ? '<strong>'._IMPRESSUM_EMAIL.':</strong> <a href="mailto:'.$contact['email'].'">'.$contact['email'].'</a><br />': '' );
	
	
	// phone and fax
	echo ( $tcms_main->isReal($contact['phone']) ? '<strong>'._IMPRESSUM_PHONE.':</strong> '.$contact['phone'].'<br />' : '' )
	.( $tcms_main->isReal($contact['fax']) ? '<strong>'._IMPRESSUM_FAX.':</strong> '.$contact['fax'] : '' );
	
	
	echo '<br /><br />';
	
	
	// office
	echo '<span class="font"><strong>'._IMPRESSUM_OFFICE.'</strong><br />'.
	( $tcms_main->isReal($contact['name'])    ? $contact['name'].'<br />' : '' ).
	( $tcms_main->isReal($contact['street'])  ? $contact['street'].'<br />' : '' ).
	( $tcms_main->isReal($contact['postal'])  ? $contact['postal'].' ' : '' ).
	( $tcms_main->isReal($contact['town'])    ? $contact['town'].'<br />' : '' ).
	( $tcms_main->isReal($contact['state'])   ? $contact['state'].', ' : '' ).
	( $tcms_main->isReal($contact['country']) ? $contact['country'] : '' ).
	'</span>';
	
	echo '<br /><br />';
}

echo ( $tcms_main->isReal($taxno) ? '<strong>'._IMPRESSUM_TAX.':</strong> '.$taxno.'<br />' : '' );
echo ( $tcms_main->isReal($ustid) ? '<strong>'._IMPRESSUM_UST.':</strong> '.$ustid : '' );

echo '<br /><br />';


echo _IMPRESSUM_SITECOPY.' '.$websiteowner.' &copy; '.$websitecopyright.'. '._IMPRESSUM_COPY.'<br /><br />';


$toendaScript = new toendaScript($legal);
$legal = $toendaScript->toendaScript_trigger();
$legal = $toendaScript->checkSEO($legal, $imagePath);
echo $legal;


echo '<br /><br />'.$cms_name.' - '.$cms_tagline.' &copy; '.$toenda_copyright.' by '
.'<a href="http://www.toenda.com" target="_blank">Toenda Software Development</a>.&nbsp;'
._TCMS_ADMIN_RIGHT
.'<br />'
.' '.$cms_name.' - '.$cms_tagline.' '._ABOUT_FREE_SOFTWARE;

echo '</span>';


?>
