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
| File:		tb_contact.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Toolbar for content manager
 *
 * This is used as toolbar for the products manager.
 *
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


echo '<img src="../images/admin_menu/line.gif" border="0" />';

if($todo == 'edit'){
	echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
	echo '<img src="../images/admin_menu/line.gif" border="0" />';
	echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=edit'.( isset($category) ? '&amp;category='.$category : '' ).'"><img title="'._TCMS_ADMIN_NEW.'" alt="'._TCMS_ADMIN_NEW.'" src="../images/admin_menu/new_file.png" border="0" /></a>';
	echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
}
elseif($todo == 'config'){
	echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
	echo '<img src="../images/admin_menu/line.gif" border="0" />';
	echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
}
elseif($todo == 'create'){
	echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'"><img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" /></a>';
	echo '<img src="../images/admin_menu/line.gif" border="0" />';
	echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();"><img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" /></a>';
}
else{
	echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=config"><img title="'._TCMS_ADMIN_CONFIG.'" alt="'._TCMS_ADMIN_CONFIG.'" src="../images/admin_menu/config.png" border="0" /></a>';
	echo '<img src="../images/admin_menu/line.gif" border="0" />';
	echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=create"><img title="'._TCMS_ADMIN_NEW.'" alt="'._TCMS_ADMIN_NEW.'" src="../images/admin_menu/new_file.png" border="0" /></a>';
}

/*switch($todo){
	case 'edit':
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site=mod_content">'
		.'<img title="'._TCMS_ADMIN_BACK.'" alt="'._TCMS_ADMIN_BACK.'" src="../images/admin_menu/back.png" border="0" />'
		.'</a>';
		
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		if($show_wysiwyg == 'tinymce' && $todo != 'config'){
			echo '<a style="padding: 3px 3px 0 3px;" href="javascript:tinyMCE.triggerSave();tinyMCE.updateContent(\'content\');save();">'
			.'<img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" />'
			.'</a>';
		}
		else {
			echo '<a style="padding: 3px 3px 0 3px;" href="javascript:save();">'
			.'<img title="'._TCMS_ADMIN_SAVE.'" alt="'._TCMS_ADMIN_SAVE.'" src="../images/admin_menu/save.png" border="0" />'
			.'</a>';
		}
		break;

	default:
		echo '<img src="../images/admin_menu/line.gif" border="0" />';

		echo '<a style="padding: 3px 3px 0 3px;" '
		.'href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit">'
		.'<img title="'._TCMS_ADMIN_NEW.'" alt="'._TCMS_ADMIN_NEW.'" '
		.'src="../images/admin_menu/new_file.png" border="0" />'
		.'</a>';
		
		echo '<a style="padding: 3px 3px 0 3px;" '
		.'href="admin.php?id_user='.$id_user.'&amp;site=mod_content&amp;todo=edit&lang=new">'
		.'<img title="'._CONTENT_NEW_LANG_DOCUMENT.'" alt="'._CONTENT_NEW_LANG_DOCUMENT.'" '
		.'src="../images/admin_menu/new_file_lang.png" border="0" />'
		.'</a>';
		break;
}*/

?>
