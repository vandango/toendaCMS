<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Toolbar for the image gallery
|
| File:	tb_gallery.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Toolbar for the image gallery
 *
 * This is used for the image gallery
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
		//echo '<a style="padding: 3px 3px 0 3px;" href="javascript:history.back();"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=edit'.( isset($category) ? '&amp;category='.$category : '' ).'"><img title="'._TCMS_ADMIN_NEW.'" alt="'._TCMS_ADMIN_NEW.'" src="../images/admin_menu/new_file.png" border="0" /></a>';
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
		break;
	
	case 'createAlbum':
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
		break;
	
	case 'config':
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
		break;
	
	default:
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=config"><img title="'._TCMS_ADMIN_CONFIG.'" alt="'._TCMS_ADMIN_CONFIG.'" src="../images/admin_menu/config.png" border="0" /></a>';
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		switch($gg_albums){
			case 'edit':
				echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
				echo '<img src="../images/admin_menu/line.gif" border="0" />';
				echo '<a style="padding: 3px 3px 0 3px;" href="javascript:accept(\'del_img\');"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
				echo '<a style="padding: 3px 3px 0 3px;" href="javascript:accept(\'upload\');"><img title="'._TCMS_ADMIN_UPLOAD.'" alt="'._TCMS_ADMIN_UPLOAD.'" src="../images/admin_menu/upload.png" border="0" /></a>';
				break;
			
			case 'createftp':
				echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
				echo '<img src="../images/admin_menu/line.gif" border="0" />';
				echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
				break;
			
			default:
				echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=createAlbum"><img title="'._TCMS_ADMIN_CREATE.'" alt="'._TCMS_ADMIN_CREATE.'" src="../images/admin_menu/create.png" border="0" /></a>';
				echo '<a style="padding: 3px 3px 0 3px;" href="javascript:accept(\'upload\');"><img title="'._TCMS_ADMIN_UPLOAD.'" alt="'._TCMS_ADMIN_UPLOAD.'" src="../images/admin_menu/upload.png" border="0" /></a>';
				echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;gg_albums=createftp"><img title="'._TCMS_ADMIN_FTPUPLOAD.'" alt="'._TCMS_ADMIN_FTPUPLOAD.'" src="../images/admin_menu/create_ftp.png" border="0" /></a>'; 
				break;
		}
		
		break;
}



?>
