<?php /* _\|/_
         (o o)                         
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Error page
|
| File:		error.php
| Version:	0.0.1
|
+
*/





/*
	init
*/

$width = 150;







/*
	print system settings
*/

echo '<h2>'._TCMS_ERROR_INFO.'</h2>';
echo '<h3>'.$cms_name.' - '.$tagline.' | Version '.$release.' ('.$build.')</h3>';
echo '<hr />';
echo '<br />';





echo '<h3>'._TCMS_ERROR.'</h3>';


switch($code){
	case 0:
		echo _TCMS_ERROR_UNDEFINED;
		break;
	
	case 1:
		echo _TCMS_ERROR_XML_SAFE_MODE;
		break;
	
	default:
		echo _TCMS_ERROR_UNDEFINED;
		break;
}


echo '<br />';
echo '<br />';
echo '<hr />';
echo '<br />';







echo '<div style="display: block; float: left; margin: 0 0 0 40px; width: '.$width.'px;">'
.'<a class="tcms_main" href="javascript:history.back();">'
.'&larr; '._TCMS_BACK
.'</a>'
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">&nbsp;</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.'<a class="tcms_main" href="index.php">'
.''._TCMS_START
.'</a>'
.'</div>'
.'<br />';

?>
