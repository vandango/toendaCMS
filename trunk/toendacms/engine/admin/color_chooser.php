<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Color chooser
|
| File:	color_chooser.php
|
+
*/

define('_TCMS_VALID', 1);


/**
 * Color chooser
 *
 * This is used as a color chooser window.
 *
 * @version 0.0.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_GET['id'])){ $id = $_GET['id']; }


if(!isset($id)){ $id = 'color1'; }

$language_stage = 'admin';
include_once('../language/lang_admin.php');

include_once ('../tcms_kernel/tcms.lib.php');
include_once ('../tcms_kernel/tcms_html.lib.php');


$arrColor[0][0] = 'ff8080';
$arrColor[0][1] = 'ffff80';
$arrColor[0][2] = '80ff80';
$arrColor[0][3] = '00ff80';
$arrColor[0][4] = '80ffff';
$arrColor[0][5] = '0080ff';
$arrColor[0][6] = 'ff80c0';
$arrColor[0][7] = 'ff80ff';

$arrColor[1][0] = 'ff0000';
$arrColor[1][1] = 'ffff00';
$arrColor[1][2] = '80ff00';
$arrColor[1][3] = '00ff40';
$arrColor[1][4] = '00ffff';
$arrColor[1][5] = '0080c0';
$arrColor[1][6] = '8080c0';
$arrColor[1][7] = 'ff00ff';

$arrColor[2][0] = '804040';
$arrColor[2][1] = 'ff8040';
$arrColor[2][2] = '00ff00';
$arrColor[2][3] = '008080';
$arrColor[2][4] = '004080';
$arrColor[2][5] = '8080ff';
$arrColor[2][6] = '800040';
$arrColor[2][7] = 'ff0080';

$arrColor[3][0] = '800000';
$arrColor[3][1] = 'ff8000';
$arrColor[3][2] = '008000';
$arrColor[3][3] = '008040';
$arrColor[3][4] = '0000ff';
$arrColor[3][5] = '0000a0';
$arrColor[3][6] = '800080';
$arrColor[3][7] = '8000ff';

$arrColor[4][0] = '400000';
$arrColor[4][1] = '804000';
$arrColor[4][2] = '004000';
$arrColor[4][3] = '004040';
$arrColor[4][4] = '000080';
$arrColor[4][5] = '000040';
$arrColor[4][6] = '400040';
$arrColor[4][7] = '400080';

$arrColor[5][0] = '000000';
$arrColor[5][1] = '808000';
$arrColor[5][2] = '808040';
$arrColor[5][3] = '808080';
$arrColor[5][4] = '408080';
$arrColor[5][5] = 'c0c0c0';
$arrColor[5][6] = '3c073c';
$arrColor[5][7] = 'ffffff';

$arrColor[6][0] = '222222';
$arrColor[6][1] = 'cbcbb9';
$arrColor[6][2] = 'f4f7fd';
$arrColor[6][3] = '7c939f';
$arrColor[6][4] = 'cccccc';
$arrColor[6][5] = 'dddddd';
$arrColor[6][6] = 'ececec';
$arrColor[6][7] = 'eeeeee';

$arrColor[7][0] = 'dcdcdc';
$arrColor[7][1] = 'e8e7d7';
$arrColor[7][2] = 'c4c3b6';
$arrColor[7][3] = 'dcdcdc';
$arrColor[7][4] = 'dcdcdc';
$arrColor[7][5] = 'dcdcdc';
$arrColor[7][6] = 'dcdcdc';
$arrColor[7][7] = 'dcdcdc';





echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>toendaCMS Imagebrowser | '.$sitetitle.'</title>
<meta http-equiv="Content-Type" content="text/html; charset='.$c_charset.'" />
<meta name="generator" content="toendaCMS - Copyright 2003 - 2007 Toenda Software Development.  All rights reserved." />
<script language="JavaScript" type="text/javascript" src="../js/dhtml.js"></script>
<link href="theme/tcms_main.css" rel="stylesheet" type="text/css" />
</style>
</head>
<body>';


echo '<div align="center" style="margin: 0 5px 0 5px;">';

echo '<strong style="font-size: 15px;">'._TCMS_COLOR_CHOOSER.'</strong><br />';

echo $tcms_html->tableHeadStyle('0', '2', '0', '99%', 'border: 1px solid #000;');


for($i = 0; $i <= 7; $i++){
	echo '<tr>';
	
	for($n = 0; $n <= 7; $n++){
		echo '<td onclick="setColor(\''.$id.'\', \''.$arrColor[$i][$n].'\');" style="background: #'.$arrColor[$i][$n].'; border: 1px solid #000;">';
		
		echo '&nbsp;';
		
		echo '</td>';
	}
	
	echo '</tr>';
}


echo $tcms_html->tableEnd();

echo '</div>';


echo '</body></html>';


?>
