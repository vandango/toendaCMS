<?php /* _\|/_
         (o o)                         
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| finish setup
|
| File:		finish.php
| Version:	0.1.2
|
+
*/





echo '<h2>'._TCMS_FINISH_TITLE.'</h2>';
echo '<h3>'._TCMS_DB_NEWINSTALL_DB1.' '
.( $db == 'mysql' ? 'MySQL' : ( $db == 'pgsql' ? 'PostgreSQL' : 'XML' ) ).'&nbsp;'
._TCMS_DB_NEWINSTALL_DB2.'</h3>';
echo '<hr />';
echo '<br />';


if(is_writeable('../data/files') 
&& is_writeable('../data/images') 
&& is_writeable('../cache') 
&& is_writeable('../data/tcms_global') 
&& is_writeable('../data/thumbnails')){
	//copy('../engine/tcms_kernel/tcms_version.xml', 'tcms_version.xml');
	
	echo _TCMS_FINISH_TEXT1.'<br />'
	._TCMS_FINISH_TEXT2;
	
	
	
	echo '<br />';
	echo '<br />';
	
	
	
	echo '<h3>'._TCMS_FINISH_YOUR_NEW_WEBSITE.'</h3>';
	
	
	echo '<div style="display: block; float: left; margin: 0 0 0 50px; width: 250px;">'
	.'<a class="tcms_main" href="../">'
	.'<img src="images/bullet_1.gif" border="0" />&nbsp;'
	._TCMS_FINISH_FRONTPAGE
	.'</a>'
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0; width: 250px;">&nbsp;</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
	
	
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; margin: 0 0 0 50px; width: 250px;">'
	.'<a class="tcms_main" href="../engine/admin/index.php">'
	.'<img src="images/bullet_1.gif" border="0" />&nbsp;'
	._TCMS_FINISH_ADMINISTRATION
	.'</a>'
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0; width: 250px;">&nbsp;</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>';
	
	
	
	echo '<br />';
	echo '<br />';
	
	
	
	echo '<div style="display: block; width: 500px; border: 2px solid #333; background: #ececec; padding: 0 8px 0 8px; color: #ff0000; margin: 0 auto 0 auto;">'
	.'<h3>'._TCMS_FINISH_TEXT3.'<br />'
	._TCMS_FINISH_TEXT4.'<br />'
	._TCMS_FINISH_TEXT5.'<br />'
	.( $db == 'xml' ? '&rarr; engine/admin/session<br />' : '' )
	.'&rarr; data/<br />'
	.'&rarr; cache/<br />'
	.'</h3>'
	.'</div><br />';
}
else{
	echo '<br />';
	
	
	
	echo '<div style="display: block; width: 500px; border: 2px solid #333; background: #ececec; padding: 0 8px 0 8px; color: #ff0000; margin: 0 auto 0 auto;">'
	.'<h3>'._TCMS_FINISH_ERROR.'</h3>'
	.'</div><br />';
	
	
	
	echo '<br />';
	echo '<hr />';
	echo '<br />';
	
	
	echo '<div style="display: block; float: left; margin: 0 0 0 40px; width: '.$width.'px;">'
	.'<a class="tcms_main" href="index.php?site=finish&amp;lang='.$lang.'&db='.$db.'">'
	._TCMS_RELEVANT.' &crarr;'
	.'</a>'
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 20px; width: 250px;">&nbsp;</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">&nbsp;</div>'
	.'<br />';
}


?>
