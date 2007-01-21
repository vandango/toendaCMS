<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Toolbar for Knowledgebase
|
| File:	tb_media.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Toolbar for the Mediamanager
 *
 * This is used as toolbar for the Mediamanager.
 *
 * @version 0.0.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


switch($todo){
	default:
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:accept(\'upload\');"><img title="'._TCMS_ADMIN_UPLOAD.'" alt="'._TCMS_ADMIN_UPLOAD.'" src="../images/admin_menu/upload.png" border="0" /></a>';
		break;
}



?>
