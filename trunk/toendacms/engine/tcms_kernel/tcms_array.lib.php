<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Module Array's
|
| File:	tcms_array.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Array's
 * 
 * This file is used for different variables.
 * 
 * @version 0.3.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 */


/*
	TABLES
*/

$ticTCMS = 0;
$arrTables[$ticTCMS++] = 'albums';
$arrTables[$ticTCMS++] = 'comments';
$arrTables[$ticTCMS++] = 'contactform';
$arrTables[$ticTCMS++] = 'contacts';
$arrTables[$ticTCMS++] = 'content';
$arrTables[$ticTCMS++] = 'downloads';
$arrTables[$ticTCMS++] = 'downloads_config';
$arrTables[$ticTCMS++] = 'frontpage';
$arrTables[$ticTCMS++] = 'guestbook';
$arrTables[$ticTCMS++] = 'guestbook_items';
$arrTables[$ticTCMS++] = 'imagegallery';
$arrTables[$ticTCMS++] = 'imagegallery_config';
$arrTables[$ticTCMS++] = 'imprint';
$arrTables[$ticTCMS++] = 'knowledgebase';
$arrTables[$ticTCMS++] = 'knowledgebase_config';
$arrTables[$ticTCMS++] = 'links';
$arrTables[$ticTCMS++] = 'links_config';
$arrTables[$ticTCMS++] = 'log';
$arrTables[$ticTCMS++] = 'news';
$arrTables[$ticTCMS++] = 'newsletter';
$arrTables[$ticTCMS++] = 'newsletter_items';
$arrTables[$ticTCMS++] = 'newsmanager';
$arrTables[$ticTCMS++] = 'news_categories';
$arrTables[$ticTCMS++] = 'news_to_categories';
$arrTables[$ticTCMS++] = 'notepad';
$arrTables[$ticTCMS++] = 'polls';
$arrTables[$ticTCMS++] = 'poll_config';
$arrTables[$ticTCMS++] = 'poll_items';
$arrTables[$ticTCMS++] = 'products';
$arrTables[$ticTCMS++] = 'products_config';
$arrTables[$ticTCMS++] = 'session';
$arrTables[$ticTCMS++] = 'sidebar';
$arrTables[$ticTCMS++] = 'sidebar_extensions';
$arrTables[$ticTCMS++] = 'sidemenu';
$arrTables[$ticTCMS++] = 'statistics';
$arrTables[$ticTCMS++] = 'statistics_ip';
$arrTables[$ticTCMS++] = 'statistics_os';
$arrTables[$ticTCMS++] = 'topmenu';
$arrTables[$ticTCMS++] = 'user';
$arrTables[$ticTCMS++] = 'userpage';





/*
	GROUPS
*/

$arr_group[0] = 'Developer';
$arr_group[1] = 'Administrator';
$arr_group[2] = 'Writer';
$arr_group[3] = 'Editor';
$arr_group[4] = 'Presenter';
$arr_group[5] = 'User';

$arr_group_txt[0] = _GROUP_DEV;
$arr_group_txt[1] = _GROUP_ADMIN;
$arr_group_txt[2] = _GROUP_WRITER;
$arr_group_txt[3] = _GROUP_EDITOR;
$arr_group_txt[4] = _GROUP_PRESENTER;
$arr_group_txt[5] = _GROUP_USER;





/*
	CURRENCYS
*/

$arr_currency['name']['EUR'] = 'Euro';
$arr_currency['code']['EUR'] = 'EUR';
$arr_currency['html']['EUR'] = '&euro;';

$arr_currency['name']['USD'] = 'US Dollar';
$arr_currency['code']['USD'] = 'USD';
$arr_currency['html']['USD'] = '$';





/*
	FILESYSTEMS
*/

$arr_fs['tag'][0] = 'folder';
$arr_fs['des'][0] = _FOLDER_DEFAULT;
$arr_fs['tag'][1] = 'folder_html';
$arr_fs['des'][1] = _FOLDER_HTML;
$arr_fs['tag'][2] = 'folder_image';
$arr_fs['des'][2] = _FOLDER_IMAGES;
$arr_fs['tag'][3] = 'folder_packages';
$arr_fs['des'][3] = _FOLDER_PACK;
$arr_fs['tag'][4] = 'folder_print';
$arr_fs['des'][4] = _FOLDER_PRINT;
$arr_fs['tag'][5] = 'folder_sound';
$arr_fs['des'][5] = _FOLDER_SOUND;
$arr_fs['tag'][6] = 'folder_txt';
$arr_fs['des'][6] = _FOLDER_DOCU;
$arr_fs['tag'][7] = 'folder_video';
$arr_fs['des'][7] = _FOLDER_VID;





/*
	DATES
*/

for($ic = 0; $ic < 31; $ic ++){
	if($ic + 1 < 10){ $icd = $ic + 1; $icd = '0'.$icd; }
	else{ $icd = $ic + 1; }
	$arr_day[$ic] = $icd;
}
for($ic = 0; $ic < 12; $ic ++){
	if($ic + 1 < 10){ $icm = $ic + 1; $icm = '0'.$icm; }
	else{ $icm = $ic + 1; }
	$arr_month[$ic] = $icm;
}
for($ic = 0; $ic < 12; $ic ++){
	if($ic + 1 < 10){ $icm = $ic + 1; }
	else{ $icm = $ic + 1; }
	$arr_month12[$ic] = $icm;
}

$monthName[1] = _TCMS_MONTH_JANUARY;
$monthName[2] = _TCMS_MONTH_FEBUARY;
$monthName[3] = _TCMS_MONTH_MARCH;
$monthName[4] = _TCMS_MONTH_APRIL;
$monthName[5] = _TCMS_MONTH_MAY;
$monthName[6] = _TCMS_MONTH_JUNE;
$monthName[7] = _TCMS_MONTH_JULY;
$monthName[8] = _TCMS_MONTH_AUGUST;
$monthName[9] = _TCMS_MONTH_SEPTEMBER;
$monthName[10] = _TCMS_MONTH_OCTOBER;
$monthName[11] = _TCMS_MONTH_NOVEMBER;
$monthName[12] = _TCMS_MONTH_DECEMBER;





/*
	CHARSETS
*/

$icc = 0;
$arr_char[$icc++] = 'ISO-8859-1';
if(extension_loaded('mbstring')){
	$arr_char[$icc++] = 'ISO-8859-2';
	$arr_char[$icc++] = 'ISO-8859-3';
	$arr_char[$icc++] = 'ISO-8859-4';
	$arr_char[$icc++] = 'ISO-8859-5';
	$arr_char[$icc++] = 'ISO-8859-6';
	$arr_char[$icc++] = 'ISO-8859-7';
	$arr_char[$icc++] = 'ISO-8859-8';
	$arr_char[$icc++] = 'ISO-8859-9';
	$arr_char[$icc++] = 'ISO-8859-10';
	$arr_char[$icc++] = 'ISO-8859-11';
	$arr_char[$icc++] = 'ISO-8859-12';
	$arr_char[$icc++] = 'ISO-8859-13';
	$arr_char[$icc++] = 'ISO-8859-14';
}
$arr_char[$icc++] = 'ISO-8859-15';
$arr_char[$icc++] = 'UTF-8';
if(extension_loaded('mbstring')){
	$arr_char[$icc++] = 'UTF-16';
}
$arr_char[$icc++] = 'cp866';
$arr_char[$icc++] = 'cp1251';
$arr_char[$icc++] = 'cp1252';
$arr_char[$icc++] = 'KOI8-R';
$arr_char[$icc++] = 'BIG5';
$arr_char[$icc++] = 'GB2312';
$arr_char[$icc++] = 'BIG5-HKSCS';
$arr_char[$icc++] = 'Shift_JIS';
$arr_char[$icc++] = 'EUC-JP';
if(extension_loaded('mbstring')){
	$arr_char[$icc++] = 'HTML-ENTITIES';
}
unset($icc);





/*
	DATABASES
*/

$arrDB['tech'][0] = 'xml';
$arrDB['name'][0] = _DB_XML;
$arrDB['tech'][1] = 'mysql';
$arrDB['name'][1] = _DB_MYSQL;
$arrDB['tech'][2] = 'pgsql';
$arrDB['name'][2] = _DB_PGSQL;
$arrDB['tech'][3] = 'mssql';
$arrDB['name'][3] = _DB_MSSQL;





/*
	LANGUAGES
*/

$arr_language = $tcms_file->getPathContent('../language/');

foreach($arr_language as $key => $value){
	if($value != 'index.html' && $value != 'lang_admin.php' && ( substr($value, 0, 1) != '.' )){
		$arr_lang[$key] = $value;
	}
}

?>
