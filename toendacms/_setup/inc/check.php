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
| File:	check.php
|
+
*/


/**
 * Check system settings
 *
 * This file is used for the check actions.
 *
 * @version 0.2.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Installer
 *
 */


/*
	init
*/

$tmpAgent = explode(';', $_SERVER['HTTP_USER_AGENT']);

$width = 150;

$arrPHPSetting = $tcms_setup_cfg->getRequiredPHPSettings();
$arrWritableFilesystem = $tcms_setup_cfg->getWritableFilesystem();





/*
	print system settings
*/

echo '<h2>'._TCMS_SYSTEM_INFO.'</h2>'
.'<h3>'._TCMS_RELEVANT.' '.$release.' ('.$build.')</h3>'
.'<hr />'
.'<br />';





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
.( phpversion() >= $tcms_setup_cfg->getRequiredPHPVersion() 
	? phpversion().' >= '.$tcms_setup_cfg->getRequiredPHPVersion() 
	: '< '.$tcms_setup_cfg->getRequiredPHPVersion() 
)
.'</div>';

echo '<div style="display: block; margin: 0 0 0 560px;">'
.( phpversion() >= $tcms_setup_cfg->getRequiredPHPVersion() 
	? '<img src="images/yes.png" border="0" />' 
	: '<img src="images/no.png" border="0" />' 
)
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


foreach($arrPHPSetting['code'] as $key => $value) {
	echo '<div style="display: block; float: left; width: '.$width.'px;">'
	.$arrPHPSetting['name'][$key]
	.'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
	.( $tcms_main->getPHPSetting($value) ? 'on' : 'off' )
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">'
	.( $tcms_main->getPHPSetting($value)
		? '<img src="images/no.png" border="0" />'
		: '<img src="images/yes.png" border="0" />' )
	.'</div>';
	
	echo '<br />';
}


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


foreach($arrWritableFilesystem['path'] as $key => $value) {
	echo '<div style="display: block; float: left; width: '.$width.'px;">'
	.( strlen($arrWritableFilesystem['name'][$key]) > 22 
		? substr($arrWritableFilesystem['name'][$key], 0, 22).'...'
		: $arrWritableFilesystem['name'][$key]
	).'</div>';
	
	echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">'
	.( is_writeable($value)
		? '<span style="font-weight: bold; color: green;">'._TCMS_WRITEABLE.'</span>'
		: '<span style="font-weight: bold; color: red; text-decoration: underline;">'._TCMS_NOT_WRITEABLE.'</span>')
	.'</div>';
	
	echo '<div style="display: block; margin: 0 0 0 560px;">'
	.( is_writeable($value)
		? '<img src="images/yes.png" border="0" />'
		: '<img src="images/no.png" border="0" />' )
	.'</div>';
	
	echo '<br />';
}


echo '<hr />';
echo '<br />';







echo '<div style="display: block; float: left; margin: 0 0 0 40px; width: '.$width.'px;">'
.'<a class="tcms_main" href="index.php?site=language&amp;lang='.$lang.'">'
.'&larr; '._TCMS_BACK
.'</a>'
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">&nbsp;</div>';

if(phpversion() >= $tcms_setup_cfg->getRequiredPHPVersion()
&& extension_loaded('zlib') 
&& extension_loaded('gd') 
&& is_writeable($arrWritableFilesystem['path'][0]) 
&& is_writeable($arrWritableFilesystem['path'][1]) 
&& is_writeable($arrWritableFilesystem['path'][2]) 
&& is_writeable($arrWritableFilesystem['path'][3]) 
&& is_writeable($arrWritableFilesystem['path'][4]) 
&& is_writeable($arrWritableFilesystem['path'][5]) 
&& is_writeable($arrWritableFilesystem['path'][6]) 
&& is_writeable($arrWritableFilesystem['path'][7])) {
	echo '<div style="display: block; margin: 0 0 0 560px;">'
	.'<a class="tcms_main" href="index.php?site=license&amp;lang='.$lang.'">'
	._TCMS_NEXT.' &rarr;'
	.'</a>'
	.'</div>'
	.'<br />';
}
else {
	echo '<div style="display: block; margin: 0 0 0 560px;">'
	.'<a class="tcms_main" href="index.php?site=check&amp;lang='.$lang.'">'
	._TCMS_RELOAD.' &crarr;'
	.'</a>'
	.'</div>'
	.'<br />';
}

?>
