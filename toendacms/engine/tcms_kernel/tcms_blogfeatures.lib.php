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
 * @version 0.1.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * Methods
 *
 * __construct                -> PHP5 Constructor
 * tcms_blogfeatures          -> PHP4 Constructor
 * __destruct                 -> PHP5 Destructor
 * _tcms_blogfeatures         -> PHP4 Destructor
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
	 * PHP5: Default constructor
	 */
	function __construct(){
	}
	
	
	
	/**
	 * PHP4: Default constructor
	 */
	function tcms_blogfeatures(){
		$this->__construct();
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_blogfeatures(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Return timesince string
	 * 
	 * @param String $older_date
	 * @param Boolean $newer_date
	 * @return String
	 */
	function timeSince($older_date, $newer_date = false){
		global $tcms_main;
		
		$chunks = array(
			array(60 * 60 * 24 * 365 , 'year'),
			array(60 * 60 * 24 * 30 , 'month'),
			array(60 * 60 * 24 * 7, 'week'),
			array(60 * 60 * 24 , 'day'),
			array(60 * 60 , 'hour'),
			array(60 , 'minute'),
		);
		
		$newer_date = ( 
			$newer_date == false 
			? time() + ( 3600 * $tcms_main->get_php_setting("gmt_offset") ) 
			: $newer_date 
		);
		
		// difference in seconds
		$since = $newer_date - $older_date;
		
		for ($i = 0, $j = count($chunks); $i < $j; $i++){
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];
			
			// finding the biggest chunk (if the chunk fits, break)
			if (($count = floor($since / $seconds)) != 0){
				break;
			}
		}
		
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
	
	
	
	/**
	 * Get the time of day
	 * 
	 * @param String $hour
	 * @return String
	*/
	function timeOfDay($hour){
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
}


?>
