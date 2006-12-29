<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Toolbar for the sidemenu
|
| File:		tb_sidemenu.php
| Version:	0.0.1
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');





switch($todo){
	case 'edit':
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site=mod_sidemenu"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
		break;
	
	default:
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site=mod_sidemenu&amp;todo=edit"><img title="'._TCMS_ADMIN_NEW.'" alt="'._TCMS_ADMIN_NEW.'" src="../images/admin_menu/new_file.png" border="0" /></a>';
		break;
}


?>
