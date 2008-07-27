<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Calendar component
|
| File:	carlendar.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Calendar component
 *
 * This components generates a calendar.
 *
 * @version 0.3.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Components
 * 
 */


$cs_calendar_title       = $_TCMS_CS_ARRAY['calendar']['content']['calendar_title'];
$cs_show_calendar_title  = $_TCMS_CS_ARRAY['calendar']['content']['show_calendar_title'];
$cs_sunday_color         = $_TCMS_CS_ARRAY['calendar']['content']['sunday_color'];
$cs_saturday_color       = $_TCMS_CS_ARRAY['calendar']['content']['saturday_color'];
$cs_currentday_backcolor = $_TCMS_CS_ARRAY['calendar']['content']['currentday_backcolor'];
$cs_weekday_border       = $_TCMS_CS_ARRAY['calendar']['content']['weekday_border'];
$cs_day_with_event       = $_TCMS_CS_ARRAY['calendar']['content']['day_with_event'];
$cs_day_as_link          = $_TCMS_CS_ARRAY['calendar']['content']['day_as_link'];
$cs_linked_module        = $_TCMS_CS_ARRAY['calendar']['content']['linked_module'];
$cs_show_current_day     = $_TCMS_CS_ARRAY['calendar']['content']['show_current_day'];


if($_TCMS_CS_ARRAY['calendar']['attribute']['calendar_title']['ENCODE'] == 1){
	$cs_calendar_title = $tcms_main->decodeText($cs_calendar_title, '2', $c_charset, true, true);
}




if($cs_show_calendar_title == 1) {
	echo $tcms_html->subTitle($cs_calendar_title);
}
else {
	echo '<br />';
}


$cal_month    = date('n');
$cal_year     = date('Y');
$cal_firstDay = date('w', mktime(0, 0, 0, $cal_month, 1, $cal_year));
$cal_mainDate = date('t');
$cal_today    = date('d');

if($cal_firstDay == 0) $cal_firstDay = 7;

$tempMonth = $cal_month;

if(substr($tempMonth, 0, 1) == '0') $tempMonth = substr($tempMonth, 1, 1);

$outDate = lang_date($cal_today, $monthName[$tempMonth], $cal_year, '', '', '');




echo $tcms_html->tableHeadStyle('2', '0', '0', '100%', '');

echo '<th colspan="7" align="right">'
.( $show_current_day == 1 ? '<span class="text_normal">'.$outDate.'</span>' : '' )
.'</th>';

echo '<tr>'
.'<td align="center" style="border: 1px solid #'.$cs_weekday_border.';"><strong class="text_normal">'.$dayName['short']['mon'].'</strong></td>'
.'<td align="center" style="border: 1px solid #'.$cs_weekday_border.';"><strong class="text_normal">'.$dayName['short']['tue'].'</strong></td>'
.'<td align="center" style="border: 1px solid #'.$cs_weekday_border.';"><strong class="text_normal">'.$dayName['short']['wed'].'</strong></td>'
.'<td align="center" style="border: 1px solid #'.$cs_weekday_border.';"><strong class="text_normal">'.$dayName['short']['thu'].'</strong></td>'
.'<td align="center" style="border: 1px solid #'.$cs_weekday_border.';"><strong class="text_normal">'.$dayName['short']['fri'].'</strong></td>'
.'<td align="center" style="color: #'.$cs_saturday_color.'; border: 1px solid #'.$cs_weekday_border.';"><strong class="text_normal">'.$dayName['short']['sat'].'</strong></td>'
.'<td align="center" style="color: #'.$cs_sunday_color.'; border: 1px solid #'.$cs_weekday_border.';"><strong class="text_normal">'.$dayName['short']['sun'].'</strong></td>'
.'</tr><tr>';

$i = 1;

while($i < $cal_firstDay){
	echo '<td>&nbsp;</td>';
	$i++;
}

$i = 1;

// load the calendar
while($i <= $cal_mainDate){
	// if show link enabled
	if($cs_day_as_link == 1){
		// choose the linked module
		// for the link_to on a day
		switch($cs_linked_module){
			case 'newsmanager':
				// look into all news post's and
				// check if a post is on this day
				if($choosenDB == 'xml'){
					$arr_files = $tcms_file->getPathContent($tcms_administer_site.'/tcms_news/');
					$cal_cnt = 0;
					
					if(is_array($arr_files)){
						foreach($arr_files as $key => $value){
							if($value != 'index.html'){
								$menu_xml = new xmlparser($tcms_administer_site.'/tcms_news/'.$value,'r');
								$is_lang = $menu_xml->readSection('news', 'language');
								
								if($is_lang == $tcms_config->getLanguageCodeForTCMS($lang)) {
									$cal_date = $menu_xml->readValue('date');
									
									$checkdate = ( strlen($i) == 1 ? '0'.$i : $i ).'.'.( strlen($cal_month) == 1 ? '0'.$cal_month : $cal_month ).'.'.$cal_year;
									
									if($cal_date == $checkdate) $cal_cnt++;
								}
								
								$menu_xml->flush();
								$menu_xml->_xmlparser();
								unset($menu_xml);
							}
						}
					}
					
					unset($arr_files);
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB, $tcms_time);
					$sqlCN = $sqlAL->connect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					
					$sqlString = "SELECT COUNT(uid) AS count FROM ".$tcms_db_prefix."news"
					." WHERE date = '".( strlen($i) == 1 ? '0'.$i : $i ).".".( strlen($cal_month) == 1 ? '0'.$cal_month : $cal_month ).".".$cal_year."'"
					." AND language = '".$tcms_config->getLanguageCodeForTCMS($lang)."'";
					
					$sqlQR = $sqlAL->query($sqlString);
					
					$sqlObj = $sqlAL->fetchObject($sqlQR);
					
					$cal_cnt = $sqlObj->count;
					
					if($cal_cnt == NULL) $cal_cnt = 0;
				}
				break;
			
			case 'diary':
				// look into all diary date's and
				// check if a date is on this day
				$arr_files = $tcms_file->getPathContent($tcms_administer_site.'/components/diary/data/');
				$cal_cnt = 0;
				
				if(is_array($arr_files)){
					foreach($arr_files as $key => $value){
						if($value != 'index.html'){
							$xml = new xmlparser($tcms_administer_site.'/components/diary/data/'.$value,'r');
							$pub = $xml->readSection('date', 'published');
							
							if($pub == 1){
								$cal_date = $xml->readValue('timestamp');
								$cal_date = substr($cal_date, 0, 10);
								
								$checkdate = ( strlen($i) == 1 ? '0'.$i : $i ).'.'.( strlen($cal_month) == 1 ? '0'.$cal_month : $cal_month ).'.'.$cal_year;
								
								// date from diary-date and
								// the current date the same
								if($cal_date == $checkdate){
									$cal_uid = substr($value, 0, 10);
									$cal_cnt = 1;
								}
							}
						}
					}
				}
				
				unset($arr_files);
				break;
		}
	}
	else{
		$cal_cnt = 0;
	}
	
	
	// cal td
	$cal_rest = ($i + $cal_firstDay - 1) % 7;
	
	if($i == $cal_today){
		echo '<td style="background: #'.$cs_currentday_backcolor.';" align="center" class="text_normal">';
	}
	else{
		echo '<td class="text_normal" '
		.( $cal_cnt != 0 ? 'style="background: #'.$cs_day_with_event.';" ' : '' )
		.'align="center">';
	}
	
	
	// cal link
	if($cal_cnt != 0){
		switch($cs_linked_module){
			case 'newsmanager':
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=newsmanager&amp;s='.$s.'&amp;date='.$cal_year.( strlen($cal_month) == 1 ? '0'.$cal_month : $cal_month ).( strlen($i) == 1 ? '0'.$i : $i );
				$link = $tcms_main->urlAmpReplace($link, $seoFormat);
				break;
			
			case 'diary':
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=components&amp;item=diary&amp;s='.$s.'&amp;date='.$cal_uid;
				$link = $tcms_main->urlAmpReplace($link, $seoFormat);
				break;
		}
	}
	
	if($i == $cal_today){
		echo '<strong class="text_normal"><em>'
		.( $cal_cnt == 0 ? '' : '<a href="'.$link.'">' )
		.$i
		.( $cal_cnt == '' ? '' : '</a>' )
		.'</em></strong>';
	}
	elseif($cal_rest == 6){
		echo '<span class="text_normal" style="color:#'.$cs_saturday_color.';">'
		.( $cal_cnt == 0 ? '' : '<a href="'.$link.'">' )
		.$i
		.( $cal_cnt == '' ? '' : '</a>' )
		.'</span>';
	}
	elseif($cal_rest == 0){
		echo '<strong class="text_normal" style="color:#'.$cs_sunday_color.';">'
		.( $cal_cnt == 0 ? '' : '<a href="'.$link.'">' )
		.$i
		.( $cal_cnt == '' ? '' : '</a>' )
		.'</strong>';
	}
	else{
		echo ( $cal_cnt == 0 ? '' : '<a href="'.$link.'">' )
		.$i
		.( $cal_cnt == '' ? '' : '</a>' );
	}
	
	
	// cal end
	echo '</td>';
	
	if($cal_rest == 0) echo '</tr><tr>';
	
	$i++;
}

echo '</tr></table>';

unset($i);


echo '<br />';
//echo '<br />';

?>
