<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| ABOUT ToendaCMS
|
| File:	mod_about.php
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * About toendaCMS
 *
 * This module is used as a media manager.
 *
 * @version 0.1.6
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS-Backend
 */


// --------------------------------------------------------------------
// INIT
// --------------------------------------------------------------------

$about_version = ''
.$tcms_version->getName().' - '.$tcms_version->getTagline().'!'
.'<br />Version '.$tcms_version->getVersion().' '
.$tcms_version->getBuild().' ['.$tcms_version->getCodename().'] '.$tcms_version->getState()
.'<br />Release date: '.$tcms_version->getReleaseDate().'&nbsp;';




// --------------------------------------------------------------------
// OUTPUT CREDITS
// --------------------------------------------------------------------

// Begin content
echo '<img src="../images/tcms_about.jpg" vspace="10" alt="toendaCMS logo" style="margin-right: 35px;" />';
echo '<img src="../images/logos/osi-certified-120x100.png" border="0" />';

echo '<div class="tcms_about_title">'._ABOUT_TITLE.'</div>';

echo '<div class="tcms_about_box">'
._ABOUT_TEXT.'<br /><br />'
.$about_version.'<br /><br />
Copyright &copy; '.$toenda_copy.' Jonathan Naumann ( <a class="tcms_about" href="http://www.toenda.com">Toenda Software Development</a> )
<br />'._ABOUT_TEXT2
.'<br /><br />';

echo '<div style="padding-left: 25px;"><em>'._ABOUT_CODE_IS_POESIE.'</em></div>';




// --------------------------------------------------------------------
// OUTPUT SUPPORT
// --------------------------------------------------------------------

echo '<br /><br />';


echo $tcms_html->tableHeadNoBorder('0', '0', '0', '600');


echo '<tr><td>'
.'<img border="0" src="../images/letter.gif" align="left" />'
.'<strong>'._ABOUT_EMAIL_INFO.': </strong>'
.'</td><td>'
.'<a class="blog" href="mailto:info@toenda.com">info@toenda.com</a>'
.'</td></tr>';


echo '<tr><td>'
.'<img border="0" src="../images/letter.gif" align="left" />'
.'<strong>'._ABOUT_EMAIL_BUG.': </strong>'
.'</td><td>'
.'<a class="blog" href="mailto:bugs@toenda.com">bugs@toenda.com</a>'
.'</td></tr>';


echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';


echo '<tr><td>'
.'<img border="0" src="../images/web.gif" align="left" />'
.'<strong>'._ABOUT_URL_DEVELOPMENT.': </strong>'
.'</td><td>'
.'<a class="blog" href="http://www.toenda.com" target="_blank">www.toenda.com</a>'
.'</td></tr>';


echo '<tr><td>'
.'<img border="0" src="../images/web.gif" align="left" />'
.'<strong>toendaCMS Forum: </strong>'
.'</td><td>'
.'<a class="blog" href="http://forum.toendacms.com" target="_blank">forum.toendacms.com</a>'
.'</td></tr>';


echo '<tr><td>'
.'<img border="0" src="../images/web.gif" align="left" />'
.'<strong>toendaCMS Wiki: </strong>'
.'</td><td>'
.'<a class="blog" href="http://wiki.toendacms.com" target="_blank">wiki.toendacms.com</a>'
.'</td></tr>';


echo '<tr><td>'
.'<img border="0" src="../images/web.gif" align="left" />'
.'<strong>'._ABOUT_URL.': </strong>'
.'</td><td>'
.'<a class="blog" href="http://demo.toendacms.com" target="_blank">demo.toendacms.com</a>'
.'</td></tr>';


echo '<tr><td>'
.'<img border="0" src="../images/web.gif" align="left" />'
.'<strong>'._ABOUT_URL_DOWNLOAD.': </strong>'
.'</td><td>'
.'<a class="blog" href="http://www.toendacms.com" target="_blank">www.toendacms.com</a>'
.'</td></tr>';


echo '<tr><td>'
.'<img border="0" src="../images/web.gif" align="left" />'
.'<strong>'._ABOUT_URL_DOWNLOAD.': </strong>'
.'</td><td>'
.'<a class="blog" href="https://sourceforge.net/project/showfiles.php?group_id=129616" target="_blank">'
.'sourceforge.net/project/showfiles.php?group_id=129616</a>'
.'</td></tr>';


echo '<tr><td>'
.'<img border="0" src="../images/web.gif" align="left" />'
.'<strong>'._ABOUT_SVN_REPO.': </strong>'
.'</td><td>'
.'<a class="blog" href="http://code.google.com/p/toendacmsorg/" target="_blank">'
.'http://code.google.com/p/toendacmsorg/</a>'
.'</td></tr>';


echo $tcms_html->tableEnd();


echo '<br /><br />'
.'<strong>OSI Certified Open Source Software</strong> - '
.'<a href="http://www.opensource.com" target="_blank">www.opensource.com</a>';


echo '</div>';

?>
