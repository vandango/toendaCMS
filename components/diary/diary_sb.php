<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Diary sidebar component
|
| File:		diary_sb.php
| Version:	0.1.7
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');





$path = $tcms_administer_site.'/components/diary/data';

$diaryTitle     = $_TCMS_CS_ARRAY['diary']['content']['sb_diary_title'];
$diarySubTitle  = $_TCMS_CS_ARRAY['diary']['content']['sb_diary_subtitle'];
$showDiaryTitle = $_TCMS_CS_ARRAY['diary']['content']['sb_show_diary_title'];
$howManyDates   = $_TCMS_CS_ARRAY['diary']['content']['sb_how_many_dates'];

$diaryFolder    = $_TCMS_CS_ID['diary']['folder'];


$diaryTitle    = $tcms_main->encode_text_without_db($diaryTitle, '2', $c_charset);
$diarySubTitle = $tcms_main->encode_text_without_db($diarySubTitle, '2', $c_charset);




if(isset($feed) && !empty($feed) && $feed != ''){
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




if($showDiaryTitle == 1){
	echo tcms_html::subtitle($diaryTitle);
	
	if($diarySubTitle != ''){
		echo tcms_html::sidemain($diarySubTitle);
	}
	
	echo '<br />';
}
else{
	echo '<br />';
}



$arrFile = $tcms_main->readdir_ext($path);

$count = 0;
$showItem = false;

if(is_array($arrFile)){
	unset($arrDiary);
	
	foreach($arrFile as $cKey => $cValue){
		if($count < $howManyDates){
			$xml = new xmlparser($path.'/'.$cValue, 'r');
			$pub = $xml->read_section('date', 'published');
			
			if($pub == false){ $pub = 0; }
			
			if($pub == 1){
				$acs = $xml->read_section('date', 'access');
				
				
				if($check_session){
					switch($acs){
						case 'Public':
							$showItem = true;
							break;
						
						case 'Protected':
							if($is_admin == 'User' || $is_admin == 'Administrator' || $is_admin == 'Developer' || $is_admin == 'Editor' || $is_admin == 'Presenter'){
								$showItem = true;
							}
							else{ $showItem = false; }
							break;
						
						case 'Private':
							if($is_admin == 'Administrator' || $is_admin == 'Developer'){ $showItem = true; }
							else{ $showItem = false; }
							break;
						
						default:
							$showItem = false;
							break;
					}
				}
				else{
					if($acs == 'Public'){ $showItem = true; }
					else{ $showItem = false; }
				}
				
				
				if($showItem){
					$arrDiary['stamp'][$count] = $xml->read_section('date', 'stamp');
					$arrDiary['date'][$count]  = $xml->read_section('date', 'timestamp');
					$arrDiary['town'][$count]  = $xml->read_section('date', 'town');
					$arrDiary['title'][$count] = $xml->read_section('date', 'title');
					$arrDiary['loc'][$count]   = $xml->read_section('date', 'location');
					$arrDiary['tag'][$count]   = substr($cValue, 0, 10);
					
					$arrDiary['town'][$count]  = $tcms_main->encode_text_without_db($arrDiary['town'][$count], '2', $c_charset);
					$arrDiary['title'][$count] = $tcms_main->encode_text_without_db($arrDiary['title'][$count], '2', $c_charset);
					$arrDiary['loc'][$count]   = $tcms_main->encode_text_without_db($arrDiary['loc'][$count], '2', $c_charset);
					
					$tempDate = $arrDiary['date'][$count];
					
					$arrDiary['date'][$count]  = substr($tempDate, 0, 10);
					$arrDiary['time'][$count]  = substr($tempDate, 11, 5);
					
					$count++;
				}
			}
		}
		
		$xml->flush();
		$xml->_xmlparser();
	}
	
	
	if(is_array($arrDiary)){
		array_multisort(
			$arrDiary['stamp'], SORT_ASC, 
			$arrDiary['date'], SORT_ASC, 
			$arrDiary['time'], SORT_ASC, 
			$arrDiary['town'], SORT_ASC, 
			$arrDiary['loc'], SORT_ASC, 
			$arrDiary['title'], SORT_ASC, 
			$arrDiary['tag'], SORT_ASC
		);
		
		
		foreach($arrDiary['date'] as $key => $value){
			$cTime = mktime(substr($arrDiary['time'][$key], 0, 2), substr($arrDiary['time'][$key], 3, 2), 0, substr($arrDiary['date'][$key], 3, 2), substr($arrDiary['date'][$key], 0, 2), substr($arrDiary['date'][$key], 6, 4));
			$ccTime = date('U');
			
			if($cTime >= $ccTime){
				echo '<div class="sidemain" style="padding-left: 6px;">';
				
				
				$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=components&amp;item=diary&amp;s='.$s.'&amp;date='.$arrDiary['tag'][$key];
				$link = $tcms_main->urlAmpReplace($link, $seoFormat);
				
				
				if($arrDiary['loc'][$key] != ''){
					echo '<strong><a class="main" href="'.$link.'">'
					.$arrDiary['loc'][$key]
					.'</a></strong>'
					.'<br />';
				}
				
				
				if($arrDiary['town'][$key] != ''){
					echo //'<strong><a class="main" href="'.$link.'">'
					lang_date(
						substr($arrDiary['date'][$key], 0, 2), 
						substr($arrDiary['date'][$key], 3, 2), 
						substr($arrDiary['date'][$key], 6, 4), 
						'', '', ''
					)
					.' - '
					.$arrDiary['town'][$key]
					//.'</a></strong>'
					.'<br />';
				}
				
				
				if($arrDiary['title'][$key] != ''){
					echo $arrDiary['title'][$key]
					.'<br />';
				}
				
				
				echo '</div>'
				.'<br />';
			}
		}
	}
}



echo '<div align="center">'
.tcms_html::bold(_TABLE_DIARY_RSS)
.'</div>';



$link = '?id=components&amp;item=diary&amp;feed=RSS0.91&amp;save=true';
$link = $tcms_main->urlAmpReplace($link);

echo '<div align="center">'
.'<a href="'.$link.'">'
.'<img src="'.$imagePath.'engine/images/logos/f_rss091.png" alt="RSS 0.91" title="RSS 0.91 Syndication" align="middle" name="image" border="0" /></a>'
.'</div>';


$link = '?id=components&amp;item=diary&amp;feed=RSS1.0&amp;save=true';
$link = $tcms_main->urlAmpReplace($link);

echo '<div align="center">'
.'<a href="'.$link.'">'
.'<img src="'.$imagePath.'engine/images/logos/f_rss10.png" alt="RSS 1.0" title="RSS 1.0 Syndication" align="middle" name="image" border="0" /></a>'
.'</div>';


$link = '?id=components&amp;item=diary&amp;feed=RSS2.0&amp;save=true';
$link = $tcms_main->urlAmpReplace($link);

echo '<div align="center">'
.'<a href="'.$link.'">'
.'<img src="'.$imagePath.'engine/images/logos/f_rss20.png" alt="RSS 2.0" title="RSS 2.0 Syndication" align="middle" name="image" border="0" /></a>'
.'</div>';

?>
