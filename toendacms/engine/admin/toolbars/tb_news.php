<?php /* _\|/_
(o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Toolbar for news manager
|
| File:	tb_news.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Toolbar for news manager
 *
 * This is used as toolbar for the content manager.
 *
 * @version 0.0.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


switch($todo){
	case 'edit':
		echo '<img src="../images/admin_menu/line.gif" border="0" />';
		
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site=mod_news">'
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
		
		if($show_wysiwyg == 'tinymce' && $todo != 'config'){
			echo '<a'
			.' style="padding: 3px 3px 0 3px;"'
			.' href="javascript:'
			.'gebi(\'draft\').value=\'0\';'
			//.'ajaxSave();'
			.'tinyMCE.triggerSave();'
			.'tinyMCE.updateContent(\'content\');'
			.'save();'
			.'">'
			.'<img title="'._TCMS_ADMIN_APPLY.'" alt="'._TCMS_ADMIN_APPLY.'" src="../images/admin_menu/apply.png" border="0" />'
			.'</a>';
		}
		else {
			echo '<a style="padding: 3px 3px 0 3px;" href="javascript:apply();">'
			.'<img title="'._TCMS_ADMIN_APPLY.'" alt="'._TCMS_ADMIN_APPLY.'" src="../images/admin_menu/apply.png" border="0" />'
			.'</a>';
		}
		break;
	
	case 'config':
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
		
		echo '<a style="padding: 3px 3px 0 3px;" href="admin.php?id_user='.$id_user.'&amp;site='.$site.'&amp;todo=config">'
		.'<img title="'._TCMS_ADMIN_CONFIG.'" alt="'._TCMS_ADMIN_CONFIG.'" src="../images/admin_menu/config.png" border="0" />'
		.'</a>';
		
		echo '<img src="../images/admin_menu/line.gif" border="0" />';

		echo '<a style="padding: 3px 3px 0 3px;" '
		.'href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=edit">'
		.'<img title="'._TCMS_ADMIN_NEW.'" alt="'._TCMS_ADMIN_NEW.'" '
		.'src="../images/admin_menu/new_file.png" border="0" />'
		.'</a>';
		break;
}

?>
