<?php /* _\|/_
         (o o)                         
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Check system settings
|
| File:		check.php
| Version:	0.1.5
|
+
*/





/*
	init
*/

$tmpAgent = explode(';', $_SERVER['HTTP_USER_AGENT']);

$width = 150;







/*
	print system settings
*/

echo '<h2>'._TCMS_SYSTEM_INFO.'</h2>';
echo '<h3>'._TCMS_RELEVANT.' '.$release.' ('.$build.')</h3>';
echo '<hr />';
echo '<br />';





echo '<h3>'._TCMS_SYSTEM.'</h3>';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
._TCMS_PLATFORM
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.getOS($tmpAgent[2])
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.'<img src="images/yes.png" border="0" />'
.'</div>';


echo '<br />';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
._TCMS_SYSTEM_USER
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.get_current_user()
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.'<img src="images/yes.png" border="0" />'
.'</div>';


echo '<br />';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
._TCMS_PHP_VERSION
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.( phpversion() >= '4.3.0' ? phpversion().' >= 4.3.0' : '< 4.3.0' )
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.( phpversion() >= '4.3.0' ? '<img src="images/yes.png" border="0" />' : '<img src="images/no.png" border="0" />' )
.'</div>';


echo '<br />';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
._TCMS_ZEND_VERSION
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.zend_version()
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.'<img src="images/yes.png" border="0" />'
.'</div>';


echo '<br />';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
._TCMS_WEB_SERVER
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.$_SERVER['SERVER_SOFTWARE']
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.'<img src="images/yes.png" border="0" />'
.'</div>';



echo '<br />';
echo '<hr />';
echo '<br />';



echo '<h3>'._TCMS_IMPORTENT_SETTINGS.'</h3>';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
.'Register Globals'
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.( $tcms_main->getPHPSetting('register_globals') ? 'on' : 'off' )
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.( $tcms_main->getPHPSetting('register_globals')
	? '<img src="images/no.png" border="0" />'
	: '<img src="images/yes.png" border="0" />' )
.'</div>';


echo '<br />';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
.'Save Mode'
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.$tcms_main->get_php_setting('safe_mode')
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.( $tcms_main->get_php_setting('safe_mode') == 'off'
	? '<img src="images/yes.png" border="0" />'
	: '<img src="images/no.png" border="0" />' )
.'</div>';


echo '<br />';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
.'zLib '._TCMS_MODULES_LOAD
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.( extension_loaded('zlib')
	? '<span style="font-weight: bold; color: green;">'._TCMS_LOADED.'</span>'
	: '<span style="font-weight: bold; color: red; text-decoration: underline;">'._TCMS_NOT_LOADED.'</span>')
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.( extension_loaded('zlib')
 ? '<img src="images/yes.png" border="0" />'
 : '<img src="images/no.png" border="0" />' )
.'</div>';


echo '<br />';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
.'GD '._TCMS_MODULES_LOAD
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.( extension_loaded('gd')
	? '<span style="font-weight: bold; color: green;">'._TCMS_LOADED.'</span>'
	: '<span style="font-weight: bold; color: red; text-decoration: underline;">'._TCMS_NOT_LOADED.'</span>')
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.( extension_loaded('gd')
 ? '<img src="images/yes.png" border="0" />'
 : '<img src="images/no.png" border="0" />' )
.'</div>';


echo '<br />';
echo '<hr />';
echo '<br />';



echo '<h3>'._TCMS_WRITE_RIGHTS.'</h3>';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
.'/data'
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.( is_writeable('../data')
	? '<span style="font-weight: bold; color: green;">'._TCMS_WRITEABLE.'</span>'
	: '<span style="font-weight: bold; color: red; text-decoration: underline;">'._TCMS_NOT_WRITEABLE.'</span>')
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.( is_writeable('../data')
	? '<img src="images/yes.png" border="0" />'
	: '<img src="images/no.png" border="0" />' )
.'</div>';


echo '<br />';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
.'/tmp'
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.( is_writeable('../tmp')
	? '<span style="font-weight: bold; color: green;">'._TCMS_WRITEABLE.'</span>'
	: '<span style="font-weight: bold; color: red; text-decoration: underline;">'._TCMS_NOT_WRITEABLE.'</span>')
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.( is_writeable('../tmp')
	? '<img src="images/yes.png" border="0" />'
	: '<img src="images/no.png" border="0" />' )
.'</div>';


echo '<br />';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
.'/cache'
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.( is_writeable('../cache')
	? '<span style="font-weight: bold; color: green;">'._TCMS_WRITEABLE.'</span>'
	: '<span style="font-weight: bold; color: red; text-decoration: underline;">'._TCMS_NOT_WRITEABLE.'</span>')
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.( is_writeable('../cache')
	? '<img src="images/yes.png" border="0" />'
	: '<img src="images/no.png" border="0" />' )
.'</div>';


echo '<br />';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
.'/cache/captcha'
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.( is_writeable('../cache/captcha')
	? '<span style="font-weight: bold; color: green;">'._TCMS_WRITEABLE.'</span>'
	: '<span style="font-weight: bold; color: red; text-decoration: underline;">'._TCMS_NOT_WRITEABLE.'</span>')
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.( is_writeable('../cache/captcha')
	? '<img src="images/yes.png" border="0" />'
	: '<img src="images/no.png" border="0" />' )
.'</div>';


echo '<br />';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
.'/data/tcms_global'
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.( is_writeable('../data/tcms_global')
	? '<span style="font-weight: bold; color: green;">'._TCMS_WRITEABLE.'</span>'
	: '<span style="font-weight: bold; color: red; text-decoration: underline;">'._TCMS_NOT_WRITEABLE.'</span>')
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.( is_writeable('../data/tcms_global')
	? '<img src="images/yes.png" border="0" />'
	: '<img src="images/no.png" border="0" />' )
.'</div>';


echo '<br />';


echo '<div style="display: block; float: left; width: '.$width.'px;">'
.'/engine/admin/session'
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
.( is_writeable('../engine/admin/session')
	? '<span style="font-weight: bold; color: green;">'._TCMS_WRITEABLE.'</span>'
	: '<span style="font-weight: bold; color: red; text-decoration: underline;">'._TCMS_NOT_WRITEABLE.'</span>')
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.( is_writeable('../engine/admin/session')
	? '<img src="images/yes.png" border="0" />'
	: '<img src="images/no.png" border="0" />' )
.'</div>';


echo '<br />';
echo '<hr />';
echo '<br />';







echo '<div style="display: block; float: left; margin: 0 0 0 40px; width: '.$width.'px;">'
.'<a class="tcms_main" href="index.php?site=language&amp;lang='.$lang.'">'
.'&larr; '._TCMS_BACK
.'</a>'
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">&nbsp;</div>';

if(extension_loaded('zlib') 
&& extension_loaded('gd') 
&& is_writeable('../data') 
&& is_writeable('../cache') 
&& is_writeable('../cache/captcha') 
&& is_writeable('../data/tcms_global')){
	echo '<div style="display: block; margin: 0 0 0 560px;">'
	.'<a class="tcms_main" href="index.php?site=license&amp;lang='.$lang.'">'
	._TCMS_NEXT.' &rarr;'
	.'</a>'
	.'</div>'
	.'<br />';
}
else{
	echo '<div style="display: block; margin: 0 0 0 560px;">'
	.'<a class="tcms_main" href="index.php?site=check&amp;lang='.$lang.'">'
	._TCMS_RELOAD.' &crarr;'
	.'</a>'
	.'</div>'
	.'<br />';
}

?>
