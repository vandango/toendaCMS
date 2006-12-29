<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Version String
|
| File:		ext_version.php
| Version:	0.0.8
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



$version_xml = new xmlparser('engine/tcms_kernel/tcms_version.xml','r');
$cms_name = $version_xml->read_section('version', 'name');
$codename = $version_xml->read_section('version', 'codename');
//$release  = $version_xml->read_section('version', 'release');
//$status   = $version_xml->read_section('version', 'status');

$version = $cms_name.' ['.$codename.']';

?>
