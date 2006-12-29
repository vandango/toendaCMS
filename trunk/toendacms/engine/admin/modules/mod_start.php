<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Administrations Framework Startpage
|
| File:		mod_start.php
| Version:	0.1.2
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



echo '<table cellpadding="0" cellspacing="0" border="0" width="100%" class="noborder"><tr><td valign="top">';

echo '<h2>'.$cms_name.' '._TCMS_ADMIN_VER.' '.$release.' ['.$codename.']</h2>';
echo '<strong>'._START_MSG.' '.$id_name.'. '._START_QUESTION.'</strong><br /><br />';



/*
	content
*/
echo '<table cellpadding="0" cellspacing="0" border="0" width="500" class="noborder">';

echo '<tr><td width="400"><a class="tcms_home tcms_home_nm" href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=edit">'._START_TEXT_3.'</a></td></tr>';

echo '<tr><td width="400"><a class="tcms_home tcms_home_page" href="admin.php?id_user='.$id_user.'&amp;site=mod_page">'._START_TEXT_0.'</a></td></tr>';

if($id_group == 'Developer' || $id_group == 'Administrator' || $id_group == 'Tester'){
	echo '<tr><td width="400"><a class="tcms_home tcms_home_gid" href="admin.php?id_user='.$id_user.'&amp;site=mod_newpage">'._START_TEXT_1.'</a></td></tr>';
	
	echo '<tr><td width="400"><a class="tcms_home tcms_home_config" href="admin.php?id_user='.$id_user.'&amp;site=mod_global">'._START_TEXT_2.'</a></td></tr>';
}

echo '<tr><td width="400"><a class="tcms_home tcms_home_ig" href="admin.php?id_user='.$id_user.'&amp;site=mod_gallery">'._START_TEXT_4.'</a></td></tr>';

echo '</table>';




echo '</td></tr></table>';


?>
