<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Help for toendaCMS
|
| File:		mod_help.php
| Version:	0.1.2
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



echo '<div class="tcms_help_title">toendaScript - Syntax Reference</div>';

echo '<br /><table border="0" class="tcms_help_box" cellpadding="4" cellspacing="0">
<tr class="tcms_help_box_title">
	<th>Command</th>
	<th>Close Command</th>
	<th>'._TABLE_DESCRIPTION.'</th>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top" width="20%">{br}</td>
	<td class="tcms_help_bb" valign="top" width="20%"></td>
	<td class="tcms_help_bb" valign="top" width="60%">Linebreak.</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">{b:}</td>
	<td class="tcms_help_bb" valign="top">{:b}</td>
	<td class="tcms_help_bb" valign="top">Change the font weight to bold.</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">{u:}</td>
	<td class="tcms_help_bb" valign="top">{:u}</td>
	<td class="tcms_help_bb" valign="top">Underline text.</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">{i:}</td>
	<td class="tcms_help_bb" valign="top">{:i}</td>
	<td class="tcms_help_bb" valign="top">Italize text.</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">{tt:}</td>
	<td class="tcms_help_bb" valign="top">{:tt}</td>
	<td class="tcms_help_bb" valign="top">Teletyper text (set font family to a serif font).</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">{center:}</td>
	<td class="tcms_help_bb" valign="top">{:center}</td>
	<td class="tcms_help_bb" valign="top">Center the marked.</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">{left:}</td>
	<td class="tcms_help_bb" valign="top">{:left}</td>
	<td class="tcms_help_bb" valign="top">Set the alignment to left.</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">{right:}</td>
	<td class="tcms_help_bb" valign="top">{:right}</td>
	<td class="tcms_help_bb" valign="top">Set the alignment to right.</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">{fc#______#:}</td>
	<td class="tcms_help_bb" valign="top">{:fc}</td>
	<td class="tcms_help_bb" valign="top">Set the fontcolor to ______, replace the ______ with the RGB color code you want to have (see <a href="http://de.selfhtml.org/helferlein/farben.htm" target="_blank">here</a>)</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">{url#_url_#:}<br />{url#_url_#_blank:}</td>
	<td class="tcms_help_bb" valign="top">{:url}</td>
	<td class="tcms_help_bb" valign="top">Creates a link to _url_. If you using {url#_url_#_blank:} to create a link, the link will open a new window.</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">{ul:}</td>
	<td class="tcms_help_bb" valign="top">{:ul}</td>
	<td class="tcms_help_bb" valign="top">Start a list.</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">{ol:}</td>
	<td class="tcms_help_bb" valign="top">{:ol}</td>
	<td class="tcms_help_bb" valign="top">Start a numbered list.</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">{li:}</td>
	<td class="tcms_help_bb" valign="top">{:li}</td>
	<td class="tcms_help_bb" valign="top">Create a list item.</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">{img#_PATH_<br />#border=NUMBER<br />#align=ALIGNMENMT<br />#height=HEIGHT<br />#width=WIDTH<br />#}</td>
	<td class="tcms_help_bb" valign="top"></td>
	<td class="tcms_help_bb" valign="top">Create a image</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">{ext#url=__URL__#}</td>
	<td class="tcms_help_bb" valign="top"></td>
	<td class="tcms_help_bb" valign="top">Include a extern file.</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">{h1:} - {h6:}</td>
	<td class="tcms_help_bb" valign="top">{:h1} - {h6:}</td>
	<td class="tcms_help_bb" valign="top">Create a header text. The number is the size of the header.</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">{cite:}</td>
	<td class="tcms_help_bb" valign="top">{:cite}</td>
	<td class="tcms_help_bb" valign="top">create a cite text.</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">{hr}</td>
	<td class="tcms_help_bb" valign="top"></td>
	<td class="tcms_help_bb" valign="top">Create a line.</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">{tcms_more}</td>
	<td class="tcms_help_bb" valign="top"></td>
	<td class="tcms_help_bb" valign="top">This is the tag to set a own end for the news on your frontpage.<br />Also you can use it to create documents with more then one page.</td>
</tr>
</table>';


echo '<br />';
echo '<br />';
echo '<br />';


echo '<div class="tcms_help_title">'._HELP_SUPPORTED_CHARSETS.'</div>';

echo '<br /><table border="0" class="tcms_help_box" cellpadding="4" cellspacing="0">
<tr class="tcms_help_box_title">
	<th>'._TABLE_CHARSET.'</th>
	<th>'._TABLE_ALIAS.'</th>
	<th>'._TABLE_DESCRIPTION.'</th>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top" width="20%">ISO-8859-1</td>
	<td class="tcms_help_bb" valign="top" width="20%">ISO8859-1</td>
	<td class="tcms_help_bb" valign="top" width="60%">Western European, Latin-1</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">ISO-8859-15</td>
	<td class="tcms_help_bb" valign="top">ISO8859-15</td>
	<td class="tcms_help_bb" valign="top">Western European, Latin-9. Adds the Euro sign, French and Finnish letters missing in Latin-1 (ISO-8859-1).</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">UTF-8</td>
	<td class="tcms_help_bb" valign="top">UTF-8</td>
	<td class="tcms_help_bb" valign="top">ASCII compatible multi-byte 8-bit Unicode.</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">cp866</td>
	<td class="tcms_help_bb" valign="top">ibm866, 866</td>
	<td class="tcms_help_bb" valign="top">DOS-specific Cyrillic charset.</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">cp1251</td>
	<td class="tcms_help_bb" valign="top">Windows-1251, win-1251, 1251</td>
	<td class="tcms_help_bb" valign="top">Windows-specific Cyrillic charset.</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">cp1252</td>
	<td class="tcms_help_bb" valign="top">Windows-1252, 1252</td>
	<td class="tcms_help_bb" valign="top">Windows specific charset for Western European.</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">KOI8-R</td>
	<td class="tcms_help_bb" valign="top">koi8-ru, koi8r</td>
	<td class="tcms_help_bb" valign="top">Russian.</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">BIG5</td>
	<td class="tcms_help_bb" valign="top">950</td>
	<td class="tcms_help_bb" valign="top">Traditional Chinese, mainly used in Taiwan.</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">GB2312</td>
	<td class="tcms_help_bb" valign="top">936</td>
	<td class="tcms_help_bb" valign="top">Simplified Chinese, national standard character set.</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">BIG5-HKSCS</td>
	<td class="tcms_help_bb" valign="top">&nbsp;</td>
	<td class="tcms_help_bb" valign="top">Big5 with Hong Kong extensions, Traditional Chinese.</td>
</tr><tr class="tcms_bg_grey_02">
	<td class="tcms_help_bb" valign="top">Shift_JIS</td>
	<td class="tcms_help_bb" valign="top">SJIS, 932</td>
	<td class="tcms_help_bb" valign="top">Japanese</td>
</tr><tr>
	<td class="tcms_help_bb" valign="top">EUC-JP</td>
	<td class="tcms_help_bb" valign="top">EUCJP</td>
	<td class="tcms_help_bb" valign="top">Japanese</td>
</tr>
</table>';

?>
