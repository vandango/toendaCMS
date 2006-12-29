<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| 404 error page
|
| File:		ext_error_404.php
| Version:	0.0.3
|
+
*/


echo '<html><head><title>404 :: Not Found</title></head><body>';

echo '<div style="background: #336699; color: #ffffff; padding: 5px; border: 1px solid #333333;">';
echo '<h1 style="color: #fff !important;">404 :: Not Found</h1>';
echo '</div>';

echo '<div style="background: #eeeeee; color: #333333; border: 1px solid #333333; height: 400px; padding: 5px; font-size: 13px;">';
echo '<strong>Error: The requested URL <a href="?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'">?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'</a> was not found on this server.</strong>';
echo '<br /><a href="javascript:history.go(-1);">Back</a>';
echo '</div>';

echo '</body></html>';

?>
