<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Diary content component
|
| File:	diary.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Diary content component
 *
 * This components generates a diary. It's compatible with
 * the calendar component to show the diaries inside a
 * calendar.
 *
 * @version 0.2.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Components
 * 
 */


if(isset($_GET['todo'])) { $todo = $_GET['todo']; }
if(isset($_GET['ps'])) { $ps = $_GET['ps']; }

if(isset($_POST['todo'])) { $todo = $_POST['todo']; }
if(isset($_POST['ps'])) { $ps = $_POST['ps']; }



$path = _TCMS_PATH.'/components/diary/data';

$diaryTitle     = $_TCMS_CS_ARRAY['diary']['content']['diary_title'];
$diarySubTitle  = $_TCMS_CS_ARRAY['diary']['content']['diary_subtitle'];
$diaryText      = $_TCMS_CS_ARRAY['diary']['content']['diary_text'];
$arr_color[0]   = $_TCMS_CS_ARRAY['diary']['content']['color_row_1'];
$arr_color[1]   = $_TCMS_CS_ARRAY['diary']['content']['color_row_2'];

$diaryFolder    = $_TCMS_CS_ID['diary']['folder'];


$diaryTitle    = $tcms_main->decodeText($diaryTitle, '2', $c_charset, false, true);
$diarySubTitle = $tcms_main->decodeText($diarySubTitle, '2', $c_charset, false, true);
$diaryText     = $tcms_main->decodeText($diaryText, '2', $c_charset, false, true);



if(isset($feed) && !empty($feed) && $feed != '') {
	$rss = new UniversalFeedCreator();
	$rss->_setFormat($feed);
	$rss->useCached();
	$rss->title = $sitename;
	$rss->description = $sitekey;
	$rss->link = $websiteowner_url;
	$rss->syndicationURL = $websiteowner_url.$seoFolder.$PHP_SELF;
	
	$image = new FeedImage();
	$image->title = $sitename.' Logo';
	$image->url = $imagePath.'engine/images/logos/toendaCMS_button_01.png';
	$image->link = $websiteowner_url;
	$image->description = 'Feed provided by '.$sitekey.'. Click to visit.';
	
	$rss->image = $image;
}



if(!isset($date) || $date == '') {
	echo $tcms_html->contentModuleHeader(
		$diaryTitle, 
		$diarySubTitle, 
		$diaryText
	);
	
	
	$arrFile = $tcms_file->getPathContent($path);
	
	$count = 0;
	$showItem = false;
	
	if(is_array($arrFile)) {
		foreach($arrFile as $cKey => $cValue) {
			$xml = new xmlparser($path.'/'.$cValue, 'r');
			$pub = $xml->readSection('date', 'published');
			
			if($pub == false) { $pub = 0; }
			
			if($pub == 1) {
				$acs = $xml->readSection('date', 'access');
				
				$showItem = $tcms_auth->checkContentAccess($acs, $is_admin);
				
				if($showItem) {
					$arrDiary['stamp'][$count]  = $xml->readSection('date', 'stamp');
					$arrDiary['date'][$count]   = $xml->readSection('date', 'timestamp');
					$arrDiary['title'][$count]  = $xml->readSection('date', 'title');
					$arrDiary['text'][$count]   = $xml->readSection('date', 'text');
					$arrDiary['tic'][$count]    = $xml->readSection('date', 'tickets');
					$arrDiary['loc'][$count]    = $xml->readSection('date', 'location');
					$arrDiary['land'][$count]   = $xml->readSection('date', 'country');
					$arrDiary['town'][$count]   = $xml->readSection('date', 'town');
					$arrDiary['zip'][$count]    = $xml->readSection('date', 'zip');
					$arrDiary['adress'][$count] = $xml->readSection('date', 'adress');
					$arrDiary['tag'][$count]    = substr($cValue, 0, 10);
					
					$arrDiary['title'][$count]  = $tcms_main->decodeText($arrDiary['title'][$count], '2', $c_charset, false, true);
					$arrDiary['text'][$count]   = $tcms_main->decodeText($arrDiary['text'][$count], '2', $c_charset, false, true);
					$arrDiary['tic'][$count]    = $tcms_main->decodeText($arrDiary['tic'][$count], '2', $c_charset, false, true);
					$arrDiary['loc'][$count]    = $tcms_main->decodeText($arrDiary['loc'][$count], '2', $c_charset, false, true);
					$arrDiary['land'][$count]   = $tcms_main->decodeText($arrDiary['land'][$count], '2', $c_charset, false, true);
					$arrDiary['town'][$count]   = $tcms_main->decodeText($arrDiary['town'][$count], '2', $c_charset, false, true);
					$arrDiary['adress'][$count] = $tcms_main->decodeText($arrDiary['adress'][$count], '2', $c_charset, false, true);
					
					$tempDate = $arrDiary['date'][$count];
					
					$arrDiary['date'][$count]  = substr($tempDate, 0, 10);
					$arrDiary['time'][$count]  = substr($tempDate, 11, 5);
					
					$count++;
				}
			}
			
			$xml->flush();
			unset($xml);
		}
		
		
		if(is_array($arrDiary)) {
			if(!isset($ps)) { $ps = 'desc'; }
			
			
			switch($todo) {
				case 'time':
					if($ps == 'desc') {
						array_multisort(
							$arrDiary['stamp'], SORT_DESC, 
							$arrDiary['date'], SORT_DESC, 
							$arrDiary['time'], SORT_DESC, 
							$arrDiary['title'], SORT_DESC, 
							$arrDiary['text'], SORT_DESC, 
							$arrDiary['loc'], SORT_DESC, 
							$arrDiary['tic'], SORT_DESC, 
							$arrDiary['land'], SORT_DESC, 
							$arrDiary['town'], SORT_DESC, 
							$arrDiary['adress'], SORT_DESC, 
							$arrDiary['zip'], SORT_DESC, 
							$arrDiary['tag'], SORT_DESC
						);
					}
					else {
						array_multisort(
							$arrDiary['stamp'], SORT_ASC, 
							$arrDiary['date'], SORT_ASC, 
							$arrDiary['time'], SORT_ASC, 
							$arrDiary['title'], SORT_ASC, 
							$arrDiary['text'], SORT_ASC, 
							$arrDiary['loc'], SORT_ASC, 
							$arrDiary['tic'], SORT_ASC, 
							$arrDiary['land'], SORT_ASC, 
							$arrDiary['town'], SORT_ASC, 
							$arrDiary['adress'], SORT_ASC, 
							$arrDiary['zip'], SORT_ASC, 
							$arrDiary['tag'], SORT_ASC
						);
					}
					break;
				
				case 'title':
					if($ps == 'desc') {
						array_multisort(
							$arrDiary['title'], SORT_DESC, 
							$arrDiary['stamp'], SORT_DESC, 
							$arrDiary['date'], SORT_DESC, 
							$arrDiary['time'], SORT_DESC, 
							$arrDiary['text'], SORT_DESC, 
							$arrDiary['loc'], SORT_DESC, 
							$arrDiary['tic'], SORT_DESC, 
							$arrDiary['land'], SORT_DESC, 
							$arrDiary['town'], SORT_DESC, 
							$arrDiary['adress'], SORT_DESC, 
							$arrDiary['zip'], SORT_DESC, 
							$arrDiary['tag'], SORT_DESC
						);
					}
					else {
						array_multisort(
							$arrDiary['title'], SORT_ASC, 
							$arrDiary['stamp'], SORT_ASC, 
							$arrDiary['date'], SORT_ASC, 
							$arrDiary['time'], SORT_ASC, 
							$arrDiary['text'], SORT_ASC, 
							$arrDiary['loc'], SORT_ASC, 
							$arrDiary['tic'], SORT_ASC, 
							$arrDiary['land'], SORT_ASC, 
							$arrDiary['town'], SORT_ASC, 
							$arrDiary['adress'], SORT_ASC, 
							$arrDiary['zip'], SORT_ASC, 
							$arrDiary['tag'], SORT_ASC
						);
					}
					break;
				
				case 'loc':
					if($ps == 'desc') {
						array_multisort(
							$arrDiary['loc'], SORT_DESC, 
							$arrDiary['stamp'], SORT_DESC, 
							$arrDiary['date'], SORT_DESC, 
							$arrDiary['time'], SORT_DESC, 
							$arrDiary['title'], SORT_DESC, 
							$arrDiary['text'], SORT_DESC, 
							$arrDiary['tic'], SORT_DESC, 
							$arrDiary['land'], SORT_DESC, 
							$arrDiary['town'], SORT_DESC, 
							$arrDiary['adress'], SORT_DESC, 
							$arrDiary['zip'], SORT_DESC, 
							$arrDiary['tag'], SORT_DESC
						);
					}
					else {
						array_multisort(
							$arrDiary['loc'], SORT_ASC, 
							$arrDiary['stamp'], SORT_ASC, 
							$arrDiary['date'], SORT_ASC, 
							$arrDiary['time'], SORT_ASC, 
							$arrDiary['title'], SORT_ASC, 
							$arrDiary['text'], SORT_ASC, 
							$arrDiary['tic'], SORT_ASC, 
							$arrDiary['land'], SORT_ASC, 
							$arrDiary['town'], SORT_ASC, 
							$arrDiary['adress'], SORT_ASC, 
							$arrDiary['zip'], SORT_ASC, 
							$arrDiary['tag'], SORT_ASC
						);
					}
					break;
				
				case 'desc':
					if($ps == 'desc') {
						array_multisort(
							$arrDiary['text'], SORT_DESC, 
							$arrDiary['stamp'], SORT_DESC, 
							$arrDiary['date'], SORT_DESC, 
							$arrDiary['time'], SORT_DESC, 
							$arrDiary['title'], SORT_DESC, 
							$arrDiary['loc'], SORT_DESC, 
							$arrDiary['tic'], SORT_DESC, 
							$arrDiary['land'], SORT_DESC, 
							$arrDiary['town'], SORT_DESC, 
							$arrDiary['adress'], SORT_DESC, 
							$arrDiary['zip'], SORT_DESC, 
							$arrDiary['tag'], SORT_DESC
						);
					}
					else {
						array_multisort(
							$arrDiary['text'], SORT_ASC, 
							$arrDiary['stamp'], SORT_ASC, 
							$arrDiary['date'], SORT_ASC, 
							$arrDiary['time'], SORT_ASC, 
							$arrDiary['title'], SORT_ASC, 
							$arrDiary['loc'], SORT_ASC, 
							$arrDiary['tic'], SORT_ASC, 
							$arrDiary['land'], SORT_ASC, 
							$arrDiary['town'], SORT_ASC, 
							$arrDiary['adress'], SORT_ASC, 
							$arrDiary['zip'], SORT_ASC, 
							$arrDiary['tag'], SORT_ASC
						);
					}
					break;
				
				case 'tic':
					if($ps == 'tic') {
						array_multisort(
							$arrDiary['tic'], SORT_DESC, 
							$arrDiary['text'], SORT_DESC, 
							$arrDiary['stamp'], SORT_DESC, 
							$arrDiary['date'], SORT_DESC, 
							$arrDiary['time'], SORT_DESC, 
							$arrDiary['title'], SORT_DESC, 
							$arrDiary['loc'], SORT_DESC, 
							$arrDiary['land'], SORT_DESC, 
							$arrDiary['town'], SORT_DESC, 
							$arrDiary['adress'], SORT_DESC, 
							$arrDiary['zip'], SORT_DESC, 
							$arrDiary['tag'], SORT_DESC
						);
					}
					else {
						array_multisort(
							$arrDiary['tic'], SORT_ASC, 
							$arrDiary['text'], SORT_ASC, 
							$arrDiary['stamp'], SORT_ASC, 
							$arrDiary['date'], SORT_ASC, 
							$arrDiary['time'], SORT_ASC, 
							$arrDiary['title'], SORT_ASC, 
							$arrDiary['loc'], SORT_ASC, 
							$arrDiary['land'], SORT_ASC, 
							$arrDiary['town'], SORT_ASC, 
							$arrDiary['adress'], SORT_ASC, 
							$arrDiary['zip'], SORT_ASC, 
							$arrDiary['tag'], SORT_ASC
						);
					}
					break;
				
				default:
					array_multisort(
						$arrDiary['stamp'], SORT_ASC, 
						$arrDiary['date'], SORT_ASC, 
						$arrDiary['time'], SORT_ASC, 
						$arrDiary['title'], SORT_ASC, 
						$arrDiary['text'], SORT_ASC, 
						$arrDiary['loc'], SORT_ASC, 
						$arrDiary['tic'], SORT_ASC, 
						$arrDiary['land'], SORT_ASC, 
						$arrDiary['town'], SORT_ASC, 
						$arrDiary['adress'], SORT_ASC, 
						$arrDiary['zip'], SORT_ASC, 
						$arrDiary['tag'], SORT_ASC
					);
					break;
			}
			
			
			if($ps == 'asc') {
				$ps = 'desc';
			}
			else {
				$ps = 'asc';
			}
			
			
			$date_link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id=components&amp;item=diary&amp;s='.$s.'&amp;todo=time&amp;ps='.$ps;
			$date_link = $tcms_main->urlConvertToSEO($date_link, $seoFormat);
			
			$title_link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id=components&amp;item=diary&amp;s='.$s.'&amp;todo=title&amp;ps='.$ps;
			$title_link = $tcms_main->urlConvertToSEO($title_link, $seoFormat);
			
			$loc_link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id=components&amp;item=diary&amp;s='.$s.'&amp;todo=loc&amp;ps='.$ps;
			$loc_link = $tcms_main->urlConvertToSEO($loc_link, $seoFormat);
			
			$desc_link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id=components&amp;item=diary&amp;s='.$s.'&amp;todo=desc&amp;ps='.$ps;
			$desc_link = $tcms_main->urlConvertToSEO($desc_link, $seoFormat);
			
			$desc_tic = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
			.'id=components&amp;item=diary&amp;s='.$s.'&amp;todo=tic&amp;ps='.$ps;
			$desc_tic = $tcms_main->urlConvertToSEO($desc_tic, $seoFormat);
			
			
			echo '<table cellpadding="4" cellspacing="0" border="0" width="100%" style="text-align: left !important;">';
			echo '<tr>'
			.'<th class="titleBG" valign="top" width="15%"><a href="'.$title_link.'">'._TABLE_TITLE.'</a>&nbsp;</th>'
			.'<th class="titleBG" valign="top" width="5%"><a href="'.$date_link.'">'._TABLE_DATE.'</a>&nbsp;</th>'
			.'<th class="titleBG" valign="top" width="5%"><a href="'.$date_link.'">'._TABLE_TIME.'</a>&nbsp;</th>'
			.'<th class="titleBG" valign="top" width="25%"><a href="'.$loc_link.'">'._TABLE_LOCATION.'</a>&nbsp;</th>'
			.'<th class="titleBG" valign="top" width="50%"><a href="'.$desc_link.'">'._TABLE_DIARY_TICKET.'</a>&nbsp;</th>'
			//.'<th class="titleBG" valign="top" width="50%"><a href="'.$desc_tic.'">'._TABLE_DIARY_TICKET.'</a>&nbsp;</th>'
			.'</tr>';
			
			
			foreach($arrDiary['date'] as $key => $value) {
				$cTime = mktime(
					substr($arrDiary['time'][$key], 0, 2), 
					substr($arrDiary['time'][$key], 3, 2), 
					0, 
					substr($arrDiary['date'][$key], 3, 2), 
					substr($arrDiary['date'][$key], 0, 2), 
					substr($arrDiary['date'][$key], 6, 4)
				);
				
				$ccTime = time();
				
				if($cTime >= $ccTime) {
					if(isset($feed) && !empty($feed) && $feed != '') {
						$item = new FeedItem();
					    
					    $item->title = $arrDiary['title'][$key];
					    $item->link = $websiteowner_url.$seoFolder.'/?id=components&item=diary&date='.$arrDiary['tag'][$key];
					    $item->description = $arrDiary['text'][$key];
					    
					    $item->date = mktime(
					    	substr($arrDiary['time'][$key], 0, 2), 
					    	substr($arrDiary['time'][$key], 3, 2), 0, 
					    	substr($arrDiary['date'][$key], 3, 2), 
					    	substr($arrDiary['date'][$key], 0, 2), 
					    	substr($arrDiary['date'][$key], 6, 4)
					    );
					    
					    $item->source = $websiteowner_url;
					    $item->author = '';
					    
					    $rss->addItem($item);
					}
				    
				    
					if(is_integer($key/2)) {
						$wsc = 0;
					}
					else {
						$wsc = 1;
					}
					
					$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
					.'id=components&amp;item=diary&amp;s='.$s.'&amp;date='.$arrDiary['tag'][$key];
					$link = $tcms_main->urlConvertToSEO($link, $seoFormat);
					
					
					echo '<tr class="news_content_bg" bgcolor="'.$arr_color[$wsc].'">';
					
					
					echo '<td valign="top">'
					.'<a class="main" href="'.$link.'"><strong>'
					.$arrDiary['title'][$key]
					.'</strong></a>'
					.'</td>';
					
					
					echo '<td valign="top">'
					.lang_date(
						substr($arrDiary['date'][$key], 0, 2), 
						substr($arrDiary['date'][$key], 3, 2), 
						substr($arrDiary['date'][$key], 6, 4), 
						'', '', ''
					)
					.'</td>';
					
					
					echo '<td valign="top">'
					.substr($arrDiary['time'][$key], 0, 2)
					.':'
					.substr($arrDiary['time'][$key], 3, 2)
					.'</td>';
					
					
					echo '<td valign="top">'
					.$arrDiary['loc'][$key].'<br />'
					.$arrDiary['adress'][$key].'<br />'
					.$arrDiary['zip'][$key].' '.$arrDiary['town'][$key].' '.$arrDiary['land'][$key].'<br />'
					.'</td>';
					
					
					echo '<td valign="top">'
					.$arrDiary['text'][$key]
					.'</td>';
					
					
					//echo '<td valign="top">'
					//.$arrDiary['tic'][$key]
					//.'</td>';
					
					
					echo '</tr>';
				}
			}
			
			
			echo '</table><br /><br />';
		}
	}
	
	
	if(isset($feed) && !empty($feed) && $feed != '') {
		if(isset($save) && $save == true) {
			unlink('cache/Diary_'.$feed.'.xml');
			$rss->saveFeed($feed, 'cache/Diary_'.$feed.'.xml', false);
			//$rss->saveFeed($feed, 'cache/'.$feed.'.xml');
			echo '<script>document.location=\''.$imagePath.'cache/Diary_'.$feed.'.xml\'</script>';
		}
		else {
			$rss->saveFeed($feed, 'cache/Diary_'.$feed.'.xml', false);
		}
	}
}
else {
	$xml = new xmlparser($path.'/'.$date.'.xml', 'r');
	$pub = $xml->readSection('date', 'published');
	
	if($pub == false) { $pub = 0; }
	
	if($pub == 1) {
		$acs = $xml->readSection('date', 'access');
		
		$showItem = $tcms_auth->checkContentAccess($acs, $is_admin);
		
		if($showItem) {
			$arrDiary['stamp'] = $xml->readSection('date', 'stamp');
			$arrDiary['date']   = $xml->readSection('date', 'timestamp');
			$arrDiary['title']  = $xml->readSection('date', 'title');
			$arrDiary['text']   = $xml->readSection('date', 'text');
			$arrDiary['tic']    = $xml->readSection('date', 'tickets');
			$arrDiary['loc']    = $xml->readSection('date', 'location');
			$arrDiary['land']   = $xml->readSection('date', 'country');
			$arrDiary['town']   = $xml->readSection('date', 'town');
			$arrDiary['zip']    = $xml->readSection('date', 'zip');
			$arrDiary['adress'] = $xml->readSection('date', 'adress');
			
			$arrDiary['title']  = $tcms_main->decodeText($arrDiary['title'], '2', $c_charset, false, true);
			$arrDiary['text']   = $tcms_main->decodeText($arrDiary['text'], '2', $c_charset, false, true);
			$arrDiary['loc']    = $tcms_main->decodeText($arrDiary['loc'], '2', $c_charset, false, true);
			$arrDiary['tic']    = $tcms_main->decodeText($arrDiary['tic'], '2', $c_charset, false, true);
			$arrDiary['land']   = $tcms_main->decodeText($arrDiary['land'], '2', $c_charset, false, true);
			$arrDiary['town']   = $tcms_main->decodeText($arrDiary['town'], '2', $c_charset, false, true);
			$arrDiary['adress'] = $tcms_main->decodeText($arrDiary['adress'], '2', $c_charset, false, true);
			
			$tempDate = $arrDiary['date'];
			
			$arrDiary['date']  = substr($tempDate, 0, 10);
			$arrDiary['time']  = substr($tempDate, 11, 5);
		}
	}
	
	$xml->flush();
	unset($xml);
	
	
	if(!empty($arrDiary)) {
		// back link
		$date_link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' )
		.'id=components&amp;item=diary&amp;s='.$s;
		$date_link = $tcms_main->urlConvertToSEO($date_link, $seoFormat);
		
		
		// subtitle
		$wsTemp = lang_date(
			substr($arrDiary['date'], 0, 2), 
			substr($arrDiary['date'], 3, 2), 
			substr($arrDiary['date'], 6, 4), 
			'', 
			'', 
			'')
		.' - '
		.$arrDiary['loc']
		.' - '
		.substr($arrDiary['time'], 0, 2)
		.':'
		.substr($arrDiary['time'], 3, 2)
		.'<br />'
		.'(<a href="'.$date_link.'">'
		._TCMS_ADMIN_BACK
		.'</a>)';
		
		
		// content
		$wsTempText = '<p class="contentmain">'
		.$arrDiary['adress']
		.'<br />'
		.$arrDiary['zip'].' '.$arrDiary['town'].' '.$arrDiary['land']
		.'<br />'
		.'<br />'
		.$arrDiary['text'];
		
		
		// text
		echo $tcms_html->contentModuleHeader(
			$arrDiary['title'], 
			$wsTemp, 
			$wsTempText
		);
		
		
		/*echo '<p class="contentmain">'
		.'<strong>'
		._TABLE_DIARY_TICKET
		.': '
		.'</strong>'
		.$arrDiary['tic']
		.'</p>';*/
	}
}

?>
