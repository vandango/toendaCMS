<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| 401 error page
|
| File:		ext_error_401.php
| Version:	0.0.3
|
+
*/


echo '<html><head><title>401 :: Unauthorized</title></head><body>';

echo '<div style="background: #336699; color: #ffffff; border: 1px solid #333333; padding: 5px;">';
echo '<h1 style="color: #fff !important;">401 :: Unauthorized</h1>';
echo '</div>';

echo '<div style="background: #eeeeee; color: #333333; border: 1px solid #333333; height: 400px; padding: 5px; font-size: 13px;">';
echo '<strong>Error: You must have an account and loged in to see the requested URL <a href="?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'">?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id='.$id.'&amp;s='.$s.'</a>.</strong>';
echo '<br /><a href="javascript:history.go(-1);">Back</a>';
echo '</div>';

echo '</body></html>';

?>