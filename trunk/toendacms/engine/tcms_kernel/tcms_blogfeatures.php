<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Load Modules Configuration
|
| File:		tcms_blogfeatures.lib.php
| Version:	0.0.4
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');



/* 
Plugin Name: Dunstan's Time Since 
Plugin URI: http://binarybonsai.com/wordpress/timesince
Description: Tells the time between the entry being posted and the comment being made.
Author: Michael Heilemann & Dunstan Orchard
Author URI: http://binarybonsai.com
Version: 1.1

This plugin is based on code from Dunstan Orchard's Blog. Pluginiffied by Michael Heilemann:
http://www.1976design.com/blog/archive/2004/07/23/redesign-time-presentation/

adapted from original code by Natalie Downe
http://blog.natbat.co.uk/archive/2003/Jun/14/time_since

Please direct support questions to: http://www.flickr.com/groups/binarybonsai/
And gratitude to: http://www.1976design.com/blog/
And sour comments to: null

*/



/*
	time since
*/
function time_since($older_date, $newer_date = false){
	global $tcms_main;
	
	// array of time period chunks
	$chunks = array(
	array(60 * 60 * 24 * 365 , 'year'),
	array(60 * 60 * 24 * 30 , 'month'),
	array(60 * 60 * 24 * 7, 'week'),
	array(60 * 60 * 24 , 'day'),
	array(60 * 60 , 'hour'),
	array(60 , 'minute'),
	);
	
	// $newer_date will equal false if we want to know the time elapsed between a date and the current time
	// $newer_date will have a value if we want to work out time elapsed between two known dates
	$newer_date = ( $newer_date == false ? time() + ( 3600 * $tcms_main->get_php_setting("gmt_offset") ) : $newer_date );
	
	// difference in seconds
	$since = $newer_date - $older_date;
	//$since = floor($since / 3600);
	
	/*if($since < 720){
		$t_d = floor($since / 24);
		$t_h = floor($since % 24);
		
		if($t_d > 1){
			$output = $t_d.'days ';
		}
		elseif($t_d == 1){
			$output = $t_d.'day ';
		}
		
		if($t_h > 1){
			$output .= $t_h.'hours ';
		}
		elseif($t_h == 1){
			$output .= '1 hour ';*/
			
			// we only want to output two chunks of time here, eg:
			// x years, xx months
			// x days, xx hours
			// so there's only two bits of calculation below:
		
			// step one: the first chunk
			for ($i = 0, $j = count($chunks); $i < $j; $i++){
				$seconds = $chunks[$i][0];
				$name = $chunks[$i][1];
		
				// finding the biggest chunk (if the chunk fits, break)
				if (($count = floor($since / $seconds)) != 0){
					break;
				}
			}
		/*}
		else{
			$t_y = floor($since / 8760);
			$t_m = floor(($since % 8760) / 720);
			
			if($t_y == 0){
				if($t_m > 1){
					$output = $t_m.'months ';
				}
				else if($t_m == 1){
					$output = $t_m.'month ';
				}
			}
			else{
				if($t_y == 1){
					$output = $t_y.'year ';
				}
				else{
					$output = $t_y.'years ';
				}
				
				if($t_m > 1){
					$output .= $t_m.'months ';
				}
				elseif($t_m == 1){
					$output .= $t_m.'month ';
				}
			}
		}
	}*/
	
	// set output var
	$output = ($count == 1) ? '1 '.$name : "$count {$name}s";

	// step two: the second chunk
	if ($i + 1 < $j){
		$seconds2 = $chunks[$i + 1][0];
		$name2 = $chunks[$i + 1][1];
		
		if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0){
			// add to output var
			$output .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
		}
	}
	
	return $output.' ago';
}



/*
	time of day
*/
function time_of_day($hour){
	switch($hour){
		case 00:
		case 01:
		case 02:
			$tod = 'the wee hours';
			break;
		
		case 03:
		case 04:
		case 05:
		case 06:
			$tod = 'terribly early in the morning';
			break;
		
		case 07:
		case 08:
		case 09:
			$tod = 'early morning';
			break;
		
		case 10:
			$tod = 'mid-morning';
			break;
		
		case 11:
			$tod = 'late morning';
			break;
		
		case 12:
		case 13:
			$tod = 'lunch time';
			break;
		
		case 14:
			$tod = 'early afternoon';
			break;
		
		case 15:
		case 16:
			$tod = 'mid-afternoon';
			break;
		
		case 17:
			$tod = 'late afternoon';
			break;
		
		case 18:
		case 19:
			$tod = 'early evening';
			break;
		
		case 20:
		case 21:
			$tod = 'evening time';
			break;
		
		case 22:
			$tod = 'late evening';
			break;
		
		case 23:
			$tod = 'late at night';
			break;
		
		default:
			$tod = '';
			break;
	}
	return $tod;
}

?>
