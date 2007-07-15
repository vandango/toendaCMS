<?php /* _\|/_
(o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Toolbar for products manager
|
| File:	tb_contact.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Toolbar for products manager
 *
 * This is used as toolbar for the products manager
 *
 * @version 0.0.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


switch($todo){
	case 'edit':
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'">'
		.'<img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" />'
		.'</a>';
		
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();">'
		.'<img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" />'
		.'</a>';
		break;
	
	case 'config':
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'">'
		.'<img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" />'
		.'</a>';
		
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();">'
		.'<img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" />'
		.'</a>';
		break;
	
	default:
		if(isset($category)){
			echo '<img src="../images/admin_menu/line.gif" border="0" />';
			
			echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'">'
			.'<img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" />'
			.'</a>';
		}
		
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=config">'
		.'<img title="'._TCMS_ADMIN_CONFIG.'" alt="'._TCMS_ADMIN_CONFIG.'" src="../images/admin_menu/config.png" border="0" />'
		.'</a>';
		
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=edit&amp;type=c">'
		.'<img title="'._TCMS_ADMIN_NEW_CATEGORY.'" alt="'._TCMS_ADMIN_NEW_CATEGORY.'" src="../images/admin_menu/create_cat.png" border="0" />'
		.'</a>';
		
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=edit&amp;type=a">'
		.'<img title="'._TCMS_ADMIN_NEW_ITEM.'" alt="'._TCMS_ADMIN_NEW_ITEM.'" src="../images/admin_menu/new_file.png" border="0" />'
		.'</a>';
		break;
}

?>
