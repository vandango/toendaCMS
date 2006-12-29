<?php /* _\|/_
         (o o)                         
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Functions
|
| File:		functions.php
| Version:	0.0.3
|
+
*/



function getBuild(){
	$xml = new xmlparser('setup/tcms_version.xml', 'r');
	return $xml->read_section('version', 'build');
}

function getVersion(){
	$xml = new xmlparser('setup/tcms_version.xml', 'r');
	return $xml->read_section('version', 'release');
}

function securePassword($password, $encode = true){
  if($encode){
    $password = unserialize($password);
    $password = str_rot13($password);
  }
  else{
    //$password = str_rot13($password);
    //$password = serialize($password);
  }
  
  return $password;
}

function get_php_setting($val){
	$r = (ini_get($val) == '1' ? 1 : 0);
	return $r ? '<span style="font-weight: bold; color: red; text-decoration: underline;">ON</span>' : '<span style="font-weight: bold; color: green;">OFF</span>';
}

function getOS($osString){
	$osString = trim(strtolower($osString));
	
	switch($osString){
		case 'windows nt 5.0': $returnOS = 'Microsoft Windows 2000'; break;
		case 'windows nt 5.1': $returnOS = 'Microsoft Windows XP'; break;
		case 'windows nt 5.2': $returnOS = 'Microsoft Windows 2003'; break;
		case 'windows nt 6.0': $returnOS = 'Microsoft Windows Vista'; break;
		case 'windows nt': $returnOS = 'Microsoft Windows NT'; break;
		case 'winnt': $returnOS = 'Microsoft Windows NT'; break;
		case 'winnt 4.0': $returnOS = 'Microsoft Windows NT 4.0'; break;
		case 'winnt4.0': $returnOS = 'Microsoft Windows NT 4.0'; break;
		case 'windows 98': $returnOS = 'Microsoft Windows 98'; break;
		case 'win98': $returnOS = 'Microsoft Windows 98'; break;
		case 'windows 95': $returnOS = 'Microsoft Windows 95'; break;
		case 'win95': $returnOS = 'Microsoft Windows 95'; break;
		case 'sunos': $returnOS = 'Sun Solaris'; break;
		case 'freebsd': $returnOS = 'FreeBSD'; break;
		case 'ppc': $returnOS = 'Macintosh'; break;
		case 'mac os x': $returnOS = 'Mac OS X'; break;
		case 'linux': $returnOS = 'Linux'; break;
		case 'debian': $returnOS = 'Debian'; break;
		case 'beos': $returnOS = 'BeOS'; break;
		case 'apachebench': $returnOS = 'ApacheBench'; break;
		case 'aix': $returnOS = 'AIX'; break;
		case 'irix': $returnOS = 'Irix'; break;
		case 'osf': $returnOS = 'DEC OSF'; break;
		case 'hp-ux': $returnOS = 'HP-UX'; break;
		case 'netbsd': $returnOS = 'NetBSD'; break;
		case 'bsdi': $returnOS = 'BSDi'; break;
		case 'openbsd': $returnOS = 'OpenBSD'; break;
		case 'gnu': $returnOS = 'GNU/Linux'; break;
		case 'unix': $returnOS = 'Unknown Unix system'; break;
		default: $returnOS = 'Undefinied'; break;
	}
	
	return $returnOS;
}


?>
