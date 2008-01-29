<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| law-concurring publishing form
|
| File:	ext_impressum.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS law-concurring publishing form
 *
 * This module is used as a law-concurring
 * publishing form.
 *
 * @version 0.4.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


/*
	INIT
*/

using('toendacms.datacontainer.impressum');

$dcImpressum = new tcms_dc_impressum();
$dcImpressum = $tcms_dcp->getImpressumDC($getLang);


//require_once('engine/tcms_kernel/tcms_countrylist.lib.php');

echo $tcms_html->contentModuleHeader(
	$dcImpressum->getTitle(), 
	$dcImpressum->getSubtitle(), 
	''
);


echo '<span class="contentmain">';

if($dcImpressum->getContact() != 'no_contact') {
	if($choosenDB == 'xml') {
		$impressum_xml = new xmlparser(
			_TCMS_PATH.'/tcms_contacts/'.$dcImpressum->getContact().'.xml', 
			'r'
		);
		
		$con_published = $impressum_xml->readValue('published');
		
		if($con_published == 1) {
			$contact['name']     = $impressum_xml->readValue('name');
			$contact['position'] = $impressum_xml->readValue('position');
			$contact['email']    = $impressum_xml->readValue('email');
			$contact['street']   = $impressum_xml->readValue('street');
			$contact['country']  = $impressum_xml->readValue('country');
			$contact['state']    = $impressum_xml->readValue('state');
			$contact['town']     = $impressum_xml->readValue('town');
			$contact['postal']   = $impressum_xml->readValue('postal');
			$contact['phone']    = $impressum_xml->readValue('phone');
			$contact['fax']      = $impressum_xml->readValue('fax');
		}
		
		$impressum_xml->flush();
		unset($impressum_xml);
		
		if($contact['name']     == false) { $contact['name']     = ''; }
		if($contact['position'] == false) { $contact['position'] = ''; }
		if($contact['email']    == false) { $contact['email']    = ''; }
		if($contact['street']   == false) { $contact['street']   = ''; }
		if($contact['country']  == false) { $contact['country']  = ''; }
		if($contact['state']    == false) { $contact['state']    = ''; }
		if($contact['town']     == false) { $contact['town']     = ''; }
		if($contact['postal']   == false) { $contact['postal']   = ''; }
		if($contact['phone']    == false) { $contact['phone']    = ''; }
		if($contact['fax']      == false) { $contact['fax']      = ''; }
	}
	else {
		$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
		$sqlCN = $sqlAL->connect(
			$sqlUser, 
			$sqlPass, 
			$sqlHost, 
			$sqlDB, 
			$sqlPort
		);
		
		$sqlQR = $sqlAL->query(
			"SELECT *"
			." FROM ".$tcms_db_prefix."contacts"
			." WHERE uid = '".$dcImpressum->getContact()."'"
			." AND published = 1"
		);
		
		$con_published = $sqlAL->getNumber($sqlQR);
		
		if($con_published != 0) {
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$contact['name']     = $sqlObj->name;
			$contact['position'] = $sqlObj->position;
			$contact['email']    = $sqlObj->email;
			$contact['street']   = $sqlObj->street;
			$contact['country']  = $sqlObj->country;
			$contact['state']    = $sqlObj->state;
			$contact['town']     = $sqlObj->town;
			$contact['postal']   = $sqlObj->postal;
			$contact['phone']    = $sqlObj->phone;
			$contact['fax']      = $sqlObj->fax;
		}
		
		$sqlAL->freeResult($sqlQR);
		unset($sqlAL);
		
		if($contact['name']     == NULL) { $contact['name']     = ''; }
		if($contact['position'] == NULL) { $contact['position'] = ''; }
		if($contact['email']    == NULL) { $contact['email']    = ''; }
		if($contact['street']   == NULL) { $contact['street']   = ''; }
		if($contact['country']  == NULL) { $contact['country']  = ''; }
		if($contact['state']    == NULL) { $contact['state']    = ''; }
		if($contact['town']     == NULL) { $contact['town']     = ''; }
		if($contact['postal']   == NULL) { $contact['postal']   = ''; }
		if($contact['phone']    == NULL) { $contact['phone']    = ''; }
		if($contact['fax']      == NULL) { $contact['fax']      = ''; }
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
	
	if(strtolower($contact['country']) == 'deutschland' 
	|| strtolower($contact['country']) == 'germany'
	|| strtolower($contact['country']) == '') {
		if(strlen($contact['postal']) == 4) {
			$contact['postal'] = '0'.$contact['postal'];
		}
	}
	
	echo '<strong class="imptitle">'.$websiteowner.'</strong><br /><br />';
	
	
	// contact person
	echo ( $tcms_main->isReal($contact['name']) ? '<strong>'._IMPRESSUM_CONTACTPERSON.':</strong> '.$contact['name'] : '' ).
	( $tcms_main->isReal($contact['position']) ? ', '.$contact['position'].'<br />' : '<br />' );
	
	
	// email
	if($cipher_email == 1) {
		echo ( $tcms_main->isReal($contact['email']) 
			? '<strong>'._IMPRESSUM_EMAIL.':</strong>'
			.'&nbsp;<script language="JavaScript">'
			.'JSCrypt.displayCryptMail(\''.$tcms_main->encodeBase64($contact['email']).'\', \''.$contact['name'].'\');'
			.'</script>'
			.'<br />' 
			: '' 
		);
	}
	else {
		echo ( $tcms_main->isReal($contact['email']) 
			? '<strong>'._IMPRESSUM_EMAIL.':</strong>'
			.'&nbsp;<a href="mailto:'.$contact['email'].'">'
			.$contact['email']
			.'</a>'
			.'<br />' 
			: '' 
		);
	}
	
	
	// phone and fax
	echo ( $tcms_main->isReal($contact['phone']) 
		? '<strong>'._IMPRESSUM_PHONE.':</strong>'
		.'&nbsp;'.$contact['phone']
		.'<br />' 
		: '' 
	)
	.( $tcms_main->isReal($contact['fax']) 
		? '<strong>'._IMPRESSUM_FAX.':</strong>'
		.'&nbsp;'.$contact['fax'] 
		: '' 
	);
	
	
	echo '<br />';
	//echo '<br />';
	
	
	// office
	echo '<span class="font"><strong>'._IMPRESSUM_OFFICE.'</strong><br />'
	.( $tcms_main->isReal($contact['name'])    ? $contact['name'].'<br />'   : '' )
	.( $tcms_main->isReal($contact['street'])  ? $contact['street'].'<br />' : '' )
	.( $tcms_main->isReal($contact['postal'])  ? $contact['postal'].' '      : '' )
	.( $tcms_main->isReal($contact['town'])    ? $contact['town'].'<br />'   : '' )
	.( $tcms_main->isReal($contact['state'])   ? $contact['state'].', '      : '' )
	.( $tcms_main->isReal($contact['country']) ? $contact['country']         : '' )
	.'</span>';
	
	echo '<br /><br />';
}

if($tcms_main->isReal($dcImpressum->getTaxNumber())) {
	echo '<strong>'._IMPRESSUM_TAX.':</strong> '
	.$dcImpressum->getTaxNumber()
	.'<br />';
}

if($tcms_main->isReal($dcImpressum->getUstID())) {
	echo '<strong>'._IMPRESSUM_UST.':</strong> '
	.$dcImpressum->getUstID();
}

echo '<br />'
.'<br />';


echo _IMPRESSUM_SITECOPY.' '.$websiteowner.' &copy; '.$websitecopyright.'. '._IMPRESSUM_COPY.'<br /><br />';


$toendaScript = new toendaScript($dcImpressum->getText());
$legal = $toendaScript->toendaScript_trigger();
$legal = $toendaScript->checkSEO($legal, $imagePath);
echo $legal;


echo '<br /><br />'.$cms_name.' - '.$cms_tagline.' &copy; '.$toenda_copyright.' by '
.'<a href="http://www.toenda.com" target="_blank">Toenda Software Development</a>.&nbsp;'
._TCMS_ADMIN_RIGHT
.'<br />'
.' '.$cms_name.' - '.$cms_tagline.' '._ABOUT_FREE_SOFTWARE;

echo '</span>';


// cleanup
unset($dcImpressum);

?>
