<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Default Content Template
|
| File:		db_content_default.php
| Version:	0.0.6
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



$content_template = '<div style="width: 99%; display: block;">
<div class="contentheading">{$title}</div>
<span class="contentstamp">{$key}</span><br />
<p class="contentmain"><br />
{$content00}<br />
{$content01}<br />
{$foot}</p>
</div>';


?>
