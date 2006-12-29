<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Content with image to the right
|
| File:		db_content_image_right.php
| Version:	0.0.7
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');





$content_template = '<div style="width: 99%; display: block;">
<div class="contentheading">{$title}</div><br />
<span class="contentstamp">{$key}</span><br />
<p class="contentmain">
<img align="right" src="'.$imagePath.'data/images/Image/{$content01}" border="0" /><br />
{$content00}<br />
{$foot}</p>
</div>';

?>
