<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| License
|
| File:		license.php
| Version:	0.0.7
|
+
*/




echo '<h2>toendaCMS &amp; GNU/GPL '._TCMS_LICENSE.'</h2>';
echo '<h3>GNU General Public License</h3>';
echo '<hr />';
echo '<br />';



$copy_xml = new xmlparser('../engine/tcms_kernel/tcms_copyright.xml','r');
$copy = $copy_xml->read_value('copy');

echo '<div style="width: 677px; height: 500px; overflow: auto; border: 1px solid #ccc; padding: 3px;">';
echo $copy;
echo '</div>';



echo '<br />';
echo '<hr />';
echo '<br />';



echo '<div style="display: block; float: left; margin: 0 0 0 40px; width: '.$width.'px;">'
.'<a class="tcms_main" href="index.php?lang='.$lang.'">'
.'&larr; '._TCMS_NOT_AGREE
.'</a>'
.'</div>';

echo '<div style="display: block; float: left; margin: 0 0 0 30px; width: 250px;">&nbsp;</div>';

echo '<div style="display: block; margin: 0 0 0 530px;">'
.'<a class="tcms_main" href="index.php?site=database&amp;lang='.$lang.'">'
._TCMS_AGREE.' &rarr;'
.'</a>'
.'</div>';



echo '<br />';


?>
