<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| License
|
| File:		mod_copyright.php
| Version:	0.0.4
+
*/


defined('_TCMS_VALID') or die('Restricted access');

$copy_xml = new xmlparser('../../engine/tcms_kernel/tcms_copyright.xml','r');

$copy = $copy_xml->read_value('copy');

echo $copy;

?>
