<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Toolbar for the components
|
| File:	tb_components.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Toolbar for the components
 *
 * This is used as toolbar for the components
 *
 * @version 0.0.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


switch($todo){
	case 'edit':
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
		break;
	
	case 'admin':
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
		break;
	
	default:
		break;
}



?>
