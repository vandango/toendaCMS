<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Startpage
|
| File:	mod_start.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Startpage
 *
 * This module is used as a a personal startpage.
 *
 * @version 0.2.
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


echo '<div>'
.'<div class="column prepend" id="welcome">'
.'<h3>'._START_MSG.' '.$id_name.'</h3>'
.'</div>';

echo '<hr class="box-hr" />'
.'<div class="column span-first">'
.'<div class="column span-first" id="box-header">'
.'<h3>'._TABLE_SYS_INFO.'</h3>'
._TABLE_YOU_ARE_RUNNING.' '.$cms_name.' '._TCMS_ADMIN_VER.' '.$release.' ['.$codename.']'
.'</div>';

$arrNewsStats = $tcms_dcp->getNewsStatistics($id_uid);

echo ' <div class="column span-first" id="box-header">'
.'<h3>'._TABLE_SITE_STATS.'</h3>'
.'<table id="site-stats" width="100%" cellspacing="0">'
.'<tr><td>'._TABLE_NUM_OF_NEWS.'</td><td>'.$arrNewsStats['news_amount'].'</td></tr>'
.'<tr><td>'._TABLE_NUM_OF_YOUR_NEWS.'</td><td>'.$arrNewsStats['your_news_amount'].'</td></tr>'
.'<tr><td>'._TABLE_NUM_OF_COMMENTS.'</td><td>'.$arrNewsStats['comment_amount'].'</td></tr>'
.'</table>'
.'</div>'
.'</div>';

echo '<div class="column prepend" id="box-header">'
.'<h3>'._START_QUESTION.'</h3>'
.'<table cellpadding="0" cellspacing="0" border="0" width="500" class="noborder">'
.'<tr><td width="400"><a class="tcms_home tcms_home_nm" href="admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=edit">'._START_TEXT_3.'</a></td></tr>'
.'<tr><td width="400"><a class="tcms_home tcms_home_page" href="admin.php?id_user='.$id_user.'&amp;site=mod_page">'._START_TEXT_0.'</a></td></tr>';

if($id_group == 'Developer' 
|| $id_group == 'Administrator' 
|| $id_group == 'Tester') {
	echo '<tr><td width="400"><a class="tcms_home tcms_home_gid" href="admin.php?id_user='.$id_user.'&amp;site=mod_newpage">'._START_TEXT_1.'</a></td></tr>'
	.'<tr><td width="400"><a class="tcms_home tcms_home_config" href="admin.php?id_user='.$id_user.'&amp;site=mod_global">'._START_TEXT_2.'</a></td></tr>';
}

echo '<tr><td width="400"><a class="tcms_home tcms_home_ig" href="admin.php?id_user='.$id_user.'&amp;site=mod_gallery">'._START_TEXT_4.'</a></td></tr>'
.'</table>'
.'</div>'
.'</div>';


?>
