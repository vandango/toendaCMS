<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Time methods
|
| File:		tcms_time.lib.php
| Version:	0.0.7
+
*/


defined('_TCMS_VALID') or die('Restricted access');



/**************************************
*
* TIME FUNCTIONS
*
* getmicrotime               -> return microtime
* tcms_load_start            -> set starttime to start loading of page
* tcms_load_end              -> set endtime to end loading of page and echo
* loadtime_output            -> return output data for loading time
* current_date               -> return current date
* current_time               -> return current time
* tcms_query_count_start     -> Starts the sql query counter
* tcms_query_counter         -> Count the sql query counter
* tcms_query_count_end_out   -> Return the sql query count sum
*
*/

class tcms_time{
	//*****************
	// GLOBALS
	//*****************
	var $starttime;
	var $endtime;
	var $sqlQuery;
	
	
	
	
	/***
	* @return microtime
	* @desc 
	*/
	function get_microtime(){
		list($usec, $sec) = explode(' ', microtime());
		return ((float)$usec + (float)$sec);
	}
	
	
	
	
	/***
	* @return Starts the loadtime counter
	* @desc 
	*/
	function tcms_load_start(){
		global $starttime;
		$starttime = tcms_time::get_microtime();
	}
	
	
	
	
	/***
	* @return Stop the loadtime counter
	* @desc 
	*/
	function tcms_load_end(){
		global $endtime;
		$endtime = tcms_time::get_microtime();
		return tcms_time::loadtime_output();
	}
	
	
	
	
	/***
	* @return Return a string with the loadtime
	* @desc 
	*/
	function loadtime_output(){
		global $starttime;
		global $endtime;
		
		$time = $endtime - $starttime;
		
		return _MSG_PAGE_LOAD_1.'&nbsp;'.round($time, 4).'&nbsp;'._MSG_PAGE_LOAD_2;
	}
	
	
	
	
	/***
	* @return the current time
	* @desc 
	*/
	function current_time(){
		$time = date('H:i');
		return $time;
	}
	
	
	
	
	/***
	* @return the current date
	* @desc 
	*/
	function current_date(){
		$date = date('d.m.Y');
		return $date;
	}
	
	
	
	
	/***
	* @return Starts the sql query counter
	* @desc 
	*/
	function tcms_query_count_start(){
		global $sqlQuery;
		$sqlQuery = 0;
	}
	
	
	
	
	/***
	* @return Count the sql query counter
	* @desc 
	*/
	function tcms_query_counter(){
		global $sqlQuery;
		$sqlQuery++;
		//echo '<h2>'.$sqlQuery.'</h2><br>';
	}
	
	
	
	
	/***
	* @return Return the sql query count sum
	* @desc 
	*/
	function tcms_query_count_end_out(){
		global $sqlQuery;
		return ( $sqlQuery == 1 ? $sqlQuery.' Database Query' : $sqlQuery.' Database Querys.' );
	}
}

?>