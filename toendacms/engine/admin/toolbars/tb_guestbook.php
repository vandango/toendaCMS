<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Toolbar for Guestbook entrys
|
| File:	tb_guestbook.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Toolbar for Guestbook entrys
 *
 * This is used as toolbar for the Guestbook entrys.
 *
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


if(isset($_GET['type'])){ $type = $_GET['type']; }


switch($todo){
	case 'edit':
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site=mod_guestbook">'
		.'<img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" />'
		.'</a>';
		
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();">'
		.'<img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" />'
		.'</a>';
		break;

	default:
		echo '<img src="../images/admin_menu/line.gif" border="0" />';

		echo '<a style="padding: 3px 3px 0 3px;" '
		.'href="admin.php?id_user='.$id_user.'&amp;site=mod_guestbook&amp;todo=edit">'
		.'<img title="'._TCMS_ADMIN_NEW.'" alt="'._TCMS_ADMIN_NEW.'" '
		.'src="../images/admin_menu/new_file.png" border="0" />'
		.'</a>';
		
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		echo '<a style="padding: 3px 3px 0 3px;" '
		.'href="admin.php?id_user='.$id_user.'&amp;site=mod_guestbook&amp;todo=deleteall">'
		.'<img title="'._TCMS_ADMIN_DELETE_ALL.'" alt="'._TCMS_ADMIN_DELETE_ALL.'" '
		.'src="../images/admin_menu/delete_all.png" border="0" />'
		.'</a>';
		break;
}



?>
