<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Toolbar for Guestbook configuration
|
| File:	tb_guestbook_config.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Toolbar for Guestbook configuration
 *
 * This is used as toolbar for the Guestbook configuration.
 *
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['type'])){ $type = $_GET['type']; }


switch($todo){
	default:
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();">'
		.'<img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'"'
		.' src="../images/admin_menu/save.png" border="0" />'
		.'</a>';
		break;
}



?>
