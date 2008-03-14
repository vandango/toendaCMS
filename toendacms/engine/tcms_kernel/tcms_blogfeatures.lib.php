<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Blogfeatures
|
| File:	tcms_blogfeatures.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Blogfeatures
 *
 * This class is used for the some weblog features.
 * Adapted from original code by Natalie Downe: 
 * http://blog.natbat.co.uk/archive/2003/Jun/14/time_since
 *
 * @version 0.2.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * Methods
 *
 * __construct                -> Constructor
 * __destruct                 -> Destructor
 * 
 * timeSince                  -> Return timesince string
 * timeOfDay                  -> Get the time of day
 * 
 * </code>
 *
 */


class tcms_blogfeatures {
	private $m_var;
	
	
	
	/**
	 * Default constructor
	 */
	public function __construct(){
	}
	
	
	
	/**
	 * Destructor
	 */
	public function __destruct(){
	}
	
	
	
	/**
	 * Return timesince string
	 * 
	 * @param String $older_date
	 * @param Boolean $newer_date
	 * @param String $lang = 'en'
	 * @return String
	 */
	public function timeSince($older_date, $newer_date = false, $lang = 'en'){
		global $tcms_main;
		
		switch(trim($lang)) {
			case 'en':
				$chunks = array(
					array(60 * 60 * 24 * 365 , 'year'),
					array(60 * 60 * 24 * 30 , 'month'),
					array(60 * 60 * 24 * 7, 'week'),
					array(60 * 60 * 24 , 'day'),
					array(60 * 60 , 'hour'),
					array(60 , 'minute'),
				);
				break;
			
			case 'de':
				$chunks = array(
					array(60 * 60 * 24 * 365 , 'Jahr'),
					array(60 * 60 * 24 * 30 , 'Monat'),
					array(60 * 60 * 24 * 7, 'Woche'),
					array(60 * 60 * 24 , 'Tag'),
					array(60 * 60 , 'Stunde'),
					array(60 , 'Minute'),
				);
				break;
			
			default:
				$chunks = array(
					array(60 * 60 * 24 * 365 , 'year'),
					array(60 * 60 * 24 * 30 , 'month'),
					array(60 * 60 * 24 * 7, 'week'),
					array(60 * 60 * 24 , 'day'),
					array(60 * 60 , 'hour'),
					array(60 , 'minute'),
				);
				break;
		}
		
		$newer_date = ( 
			$newer_date == false 
			? time() + ( 3600 * $tcms_main->getPHPSetting("gmt_offset") ) 
			: $newer_date 
		);
		
		// difference in seconds
		$since = $newer_date - $older_date;
		
		for($i = 0, $j = count($chunks); $i < $j; $i++) {
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];
			
			// finding the biggest chunk (if the chunk fits, break)
			if(($count = floor($since / $seconds)) != 0) {
				break;
			}
		}
		
		// set output var
		switch(trim($lang)) {
			case 'en':
				$output = ($count == 1) ? '1 '.$name : $count.' '.$name.'s';
				break;
			
			case 'de':
				$output = ($count == 1) ? '1 '.$name : $count.' '.$name.'e';
				break;
			
			default:
				$output = ($count == 1) ? '1 '.$name : $count.' '.$name.'s';
				break;
		}
	
		// step two: the second chunk
		if ($i + 1 < $j) {
			$seconds2 = $chunks[$i + 1][0];
			$name2 = $chunks[$i + 1][1];
			
			if(($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
				// add to output var
				switch(trim($lang)) {
					case 'en':
						$output .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
						break;
					
					case 'de':
						$output .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}e";
						break;
					
					default:
						$output .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";
						break;
				}
			}
		}
		
		switch(trim($lang)) {
			case 'en':
				$output.' ago';
				break;
			
			case 'de':
				$output = str_replace('Stundee', 'Stunden', $output);
				$output = str_replace('Minutee', 'Minuten', $output);
				$output = str_replace('Wochee', 'Wochen', $output);
				$output.' her';
				break;
			
			default:
				$output.' ago';
				break;
		}
		
		return $output;
	}
	
	
	
	/**
	 * Get the time of day
	 * 
	 * @param String $hour
	 * @param String $lang = 'en'
	 * @return String
	*/
	public function timeOfDay($hour, $lang = 'en'){
		switch($hour){
			case 00:
			case 01:
			case 02:
				switch(trim($lang)) {
					case 'en': $tod = 'the wee hours'; break;
					case 'de': $tod = 'die Geisterstunde'; break;
					default: $tod = 'the wee hours'; break;
				}
				break;
			
			case 03:
			case 04:
			case 05:
			case 06:
				switch(trim($lang)) {
					case 'en': $tod = 'terribly early in the morning'; break;
					case 'de': $tod = 'sehr fr&#252;her morgen'; break;
					default: $tod = 'terribly early in the morning'; break;
				}
				break;
			
			case 07:
			case 08:
			case 09:
				switch(trim($lang)) {
					case 'en': $tod = 'early morning'; break;
					case 'de': $tod = 'fr&#252;her morgen'; break;
					default: $tod = 'early morning'; break;
				}
				break;
			
			case 10:
				switch(trim($lang)) {
					case 'en': $tod = 'mid-morning'; break;
					case 'de': $tod = 'morgens'; break;
					default: $tod = 'mid-morning'; break;
				}
				break;
			
			case 11:
				switch(trim($lang)) {
					case 'en': $tod = 'late morning'; break;
					case 'de': $tod = 'vormittags'; break;
					default: $tod = 'late morning'; break;
				}
				break;
			
			case 12:
			case 13:
				switch(trim($lang)) {
					case 'en': $tod = 'lunch time'; break;
					case 'de': $tod = 'Mittagszeit'; break;
					default: $tod = 'lunch time'; break;
				}
				break;
			
			case 14:
				switch(trim($lang)) {
					case 'en': $tod = 'early afternoon'; break;
					case 'de': $tod = 'fr&#252;her nachmittag'; break;
					default: $tod = 'early afternoon'; break;
				}
				break;
			
			case 15:
			case 16:
				switch(trim($lang)) {
					case 'en': $tod = 'mid-afternoon'; break;
					case 'de': $tod = 'nachmittags'; break;
					default: $tod = 'mid-afternoon'; break;
				}
				break;
			
			case 17:
				switch(trim($lang)) {
					case 'en': $tod = 'late afternoon'; break;
					case 'de': $tod = 'sp&#228;ter nachmittag'; break;
					default: $tod = 'late afternoon'; break;
				}
				break;
			
			case 18:
			case 19:
				switch(trim($lang)) {
					case 'en': $tod = 'early evening'; break;
					case 'de': $tod = 'fr&#252;her abend'; break;
					default: $tod = 'early evening'; break;
				}
				break;
			
			case 20:
			case 21:
				switch(trim($lang)) {
					case 'en': $tod = 'evening time'; break;
					case 'de': $tod = 'abends'; break;
					default: $tod = 'evening time'; break;
				}
				break;
			
			case 22:
				switch(trim($lang)) {
					case 'en': $tod = 'late evening'; break;
					case 'de': $tod = 'sp&#228;ter abend'; break;
					default: $tod = 'late evening'; break;
				}
				break;
			
			case 23:
				switch(trim($lang)) {
					case 'en': $tod = 'late at night'; break;
					case 'de': $tod = 'sp&#228;t in der Nacht'; break;
					default: $tod = 'late at night'; break;
				}
				break;
			
			default:
				$tod = '';
				break;
		}
		return $tod;
	}
}


?>
