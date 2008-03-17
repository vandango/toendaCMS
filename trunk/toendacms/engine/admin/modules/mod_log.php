<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| LogViewer
|
| File:	mod_log.php
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * About toendaCMS
 *
 * This module is used as a log viewer.
 *
 * @version 0.0.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


// --------------------------------------------------------------------
// INIT
// --------------------------------------------------------------------

$bgkey = 0;




// --------------------------------------------------------------------
// DISPLAY
// --------------------------------------------------------------------

if($todo == 'show') {
	if($id_group == 'Developer' 
	|| $id_group == 'Administrator') {
		$arrLogs = $tcms_log->GetEntryList();
	}
	else {
		$arrLogs = $tcms_log->GetEntryList(
			$id_uid
		);
	}
	
	//$tcms_main->paf($arrLogs);
	
	echo $tcms_html->bold(
		_STATS_LOG_TITLE
	);
	
	echo $tcms_html->text(
		_STATS_LOG_TEXT
		.( $id_group == 'Developer' || $id_group == 'Administrator' ? _STATS_LOG_TEXT_ADMIN : '' )
		.'<br /><br />', 
		'left'
	);
	
	echo '<table cellpadding="3" cellspacing="0" border="0" class="noborder" width="100%">'
	.'<tr class="tcms_bg_blue_01">'
	.'<th valign="middle" class="tcms_db_title" width="2%">&nbsp;</th>'
	.'<th valign="middle" class="tcms_db_title" width="8%" align="left">'._TABLE_USERNAME.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="15%" align="left">'._TABLE_TIME.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_IP.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="10%" align="left">'._TABLE_MODULE.'</th>'
	.'<th valign="middle" class="tcms_db_title" width="55%" align="left">'._TABLE_TEXT.'</th>'
	.'<tr>';
	
	if($tcms_main->isReal($arrLogs)) {
		$count = -1;
		
		foreach($arrLogs as $item) {
			$dcLog = new tcms_dc_log();
			$dcLog = $item;
			
			$bgkey++;
			$count++;
			
			if(is_integer($bgkey / 2)) {
				$wsColor = $arr_color[0];
			}
			else {
				$wsColor = $arr_color[1];
			}
			
			$strJS = ' onclick="document.location=\'admin.php?id_user='.$id_user.'&amp;site=mod_news&amp;todo=edit&amp;maintag='.$arr_news['order'][$key].'\';"';
			
			echo '<tr height="25" id="row'.$count.'" '
			.'bgcolor="'.$wsColor.'" '
			.'onMouseOver="wxlBgCol(\'row'.$count.'\',\'#ececec\')" '
			.'onMouseOut="wxlBgCol(\'row'.$count.'\',\''.$wsColor.'\')">';
			
			// icon
			echo '<td align="left" class="tcms_db_2">'
			.'<img src="../images/log.png" border="0" />'
			.'</td>';
			
			// user
			$username = $tcms_ap->getUsername($dcLog->getUserID());
			
			echo '<td align="left" class="tcms_db_2">'
			.'<a href="admin.php?id_user='.$id_user.'&amp;site=mod_user&amp;todo=edit&amp;maintag='.$dcLog->getUserID().'">'
			.$username
			.'</a>'
			.'</td>';
			
			// stamp
			$time = date(
				'd.m.Y - H:i:s', 
				$dcLog->getTimestamp()
			);
			
			echo '<td align="left" class="tcms_db_2">'
			.$time
			.'</td>';
			
			// ip
			echo '<td align="left" class="tcms_db_2">'
			.$dcLog->getIP()
			.'</td>';
			
			// module
			echo '<td align="left" class="tcms_db_2">'
			.$dcLog->getModule()
			.'</td>';
			
			// text
			echo '<td align="left" class="tcms_db_2">'
			.$dcLog->getText()
			.'</td>';
			
			echo '</tr>';
		}
	}
	
	echo $tcms_html->tableEnd()
	.'<br />';
}




// --------------------------------------------------------------------
// DISPLAY
// --------------------------------------------------------------------

if($todo == 'clear') {
	//
}

?>
