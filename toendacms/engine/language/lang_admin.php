<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Language Administration
|
| File:		lang_admin.php
| Version:	0.0.9
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



include_once(( $language_stage == 'admin' ? '..' : 'engine' ).'/tcms_kernel/tcms_xml.lib.php');

switch($language_stage){
	case 'admin':
		$xml = new xmlparser('../../data/tcms_global/var.xml', 'r');
		$tcms_lang = $xml->read_section('global', 'lang');
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
		
		include_once('../language/'.$tcms_lang.'/lang_'.$tcms_lang.'.php');
		break;
	
	case 'index':
		$xml = new xmlparser('data/tcms_global/var.xml', 'r');
		$tcms_lang = $xml->read_section('global', 'front_lang');
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
		
		include_once('engine/language/'.$tcms_lang.'/lang_'.$tcms_lang.'.php');
		break;
	
	case 'print':
		$xml = new xmlparser('data/tcms_global/var.xml', 'r');
		$tcms_lang = $xml->read_section('global', 'front_lang');
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
		
		include_once('engine/language/'.$tcms_lang.'/lang_'.$tcms_lang.'.php');
		break;
}


?>
