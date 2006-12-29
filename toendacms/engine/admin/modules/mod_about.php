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
| File:		mod_about.php
| Version:	0.1.3
+
*/


defined('_TCMS_VALID') or die('Restricted access');





//=====================================================================
// XML OPEN
//=====================================================================

$credits_xml = new xmlparser('../../engine/tcms_kernel/tcms_copyright.xml','r');

$releaseVer   = $tcms_version->getVersion();
$codename     = $tcms_version->getCodename();
$status       = $tcms_version->getState();
$build        = $tcms_version->getBuild();
$cms_name     = $tcms_version->getName();
$release_date = $tcms_version->getReleaseDate();

$about_version = ''.$cms_name.' &bull; Version '.$releaseVer.' ['.$codename.'] &bull; '.$status.' &bull; '.$build.' &bull; Release date: '.$release_date.'&nbsp;';





//=====================================================================
// OUTPUT CREDITS
//=====================================================================

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





//=====================================================================
// OUTPUT SUPPORT
//=====================================================================

echo '<br /><br />';


echo tcms_html::table_head_nb('0', '0', '0', '600');

echo '<tr><td>';
echo '<img border="0" src="../images/letter.gif" align="left" /><strong>'._ABOUT_EMAIL_INFO.': </strong>';
echo '</td><td><a class="blog" href="mailto:info@toenda.com">info@toenda.com</a>';
echo '</td></tr>';

echo '<tr><td>';
echo '<img border="0" src="../images/letter.gif" align="left" /><strong>'._ABOUT_EMAIL_BUG.': </strong>';
echo '</td><td><a class="blog" href="mailto:bugs@toenda.com">bugs@toenda.com</a>';
echo '</td></tr>';

echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';

echo '<tr><td>';
echo '<img border="0" src="../images/web.gif" align="left" /><strong>'._ABOUT_URL_DEVELOPMENT.': </strong>';
echo '</td><td><a class="blog" href="http://www.toenda.com">www.toenda.com</a>';
echo '</td></tr>';

echo '<tr><td>';
echo '<img border="0" src="../images/web.gif" align="left" /><strong>toendaCMS Forum: </strong>';
echo '</td><td><a class="blog" href="http://forum.toendacms.com">forum.toendacms.com</a>';
echo '</td></tr>';

echo '<tr><td>';
echo '<img border="0" src="../images/web.gif" align="left" /><strong>toendaCMS Wiki: </strong>';
echo '</td><td><a class="blog" href="http://wiki.toendacms.com">wiki.toendacms.com</a>';
echo '</td></tr>';

echo '<tr><td>';
echo '<img border="0" src="../images/web.gif" align="left" /><strong>'._ABOUT_URL.': </strong>';
echo '</td><td><a class="blog" href="http://demo.toendacms.com">demo.toendacms.com</a>';
echo '</td></tr>';

echo '<tr><td>';
echo '<img border="0" src="../images/web.gif" align="left" /><strong>'._ABOUT_URL_DOWNLOAD.': </strong>';
echo '</td><td><a class="blog" href="http://www.toendacms.com">www.toendacms.com</a>';
echo '</td></tr>';

echo '<tr><td>';
echo '<img border="0" src="../images/web.gif" align="left" /><strong>'._ABOUT_URL_DOWNLOAD.': </strong>';
echo '</td><td><a class="blog" href="https://sourceforge.net/project/showfiles.php?group_id=129616">sourceforge.net/project/showfiles.php?group_id=129616</a>';
echo '</td></tr>';

echo tcms_html::table_end();




echo '<br /><br /><strong>OSI Certified Open Source Software</strong> - <a href="http://www.opensource.com" target="_blank">www.opensource.com</a>';


echo '</div>';

?>
