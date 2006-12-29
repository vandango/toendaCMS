<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Content with Image Template
|
| File:		db_content_image.php
| Version:	0.0.7
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');




$content_template = '<div style="width: 99%; display: block;">
<div class="contentheading">{$title}</div>
<span class="contentstamp">{$key}</span><br />
<p class="contentmain"><br />
{$content00}<br />
{$foot}<br />
<img src="'.$imagePath.'data/images/Image/{$content01}" border="0" /></p>
</div>';

?>
