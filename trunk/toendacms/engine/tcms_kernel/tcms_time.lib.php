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
| File:	tcms_time.lib.php
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Time methods
 *
 * This class is used to have some often used time tools.
 *
 * @version 0.0.9
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Methods
 *
 *--------------------------------------------------------
 * CONSTRUCTOR AND DESTRUCTOR
 *--------------------------------------------------------
 *
 * __construct()                       -> PHP5 Default constructor
 * tcms_time()                         -> PHP4 Default constructor
 * __destruct()                        -> PHP5 Default destructor
 * _tcms_time()                        -> PHP4 Default destructor
 *
 *--------------------------------------------------------
 * MAIN FUNCTIONS
 *--------------------------------------------------------
 * 
 * getMicrotime                        -> Get a microtime
 * getCurrentTime                      -> Get the current time
 * getCurrentDate                      -> Get the current date
 * startTimer                          -> Start the timer
 *
 *--------------------------------------------------------
 * DEPRECATED
 *--------------------------------------------------------
 * getmicrotime               -> return microtime
 * tcms_load_start            -> set starttime to start loading of page
 * current_date               -> return current date
 * current_time               -> return current time
 * 
 */


/**************************************
*
* TIME FUNCTIONS
*
* tcms_load_end              -> set endtime to end loading of page and echo
* loadtime_output            -> return output data for loading time
* tcms_query_count_start     -> Starts the sql query counter
* tcms_query_counter         -> Count the sql query counter
* tcms_query_count_end_out   -> Return the sql query count sum
*
*/


class tcms_time{
	var $starttime;
	var $endtime;
	var $sqlQuery;
	
	
	
	/**
	 * PHP5 Default constructor
	 */
	function __construct(){
	}
	
	
	
	/**
	 * PHP4 Default constructor
	 */
	function tcms_time(){
		$this->__construct();
	}
	
	
	
	/**
	 * PHP5 Default destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Default destructor
	 */
	function _tcms_time(){
		$this->__destruct();
	}
	
	
	
	/*
		METHODS
	*/
	
	
	/**
	 * Get a microtime
	 */
	function getMicrotime(){
		list($usec, $sec) = explode(' ', microtime());
		return ((float)$usec + (float)$sec);
	}
	
	
	
	
	/**
	 * Get the current time
	 */
	function getCurrentTime(){
		$time = date('H:i');
		return $time;
	}
	
	
	
	
	/**
	 *  Get the current date
	 */
	function getCurrentDate(){
		$date = date('d.m.Y');
		return $date;
	}
	
	
	
	/**
	 * Start the timer
	 */
	function startTimer(){
		global $starttime;
		$starttime = tcms_time::getMicrotime();
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
	
	
	
	/*
		DEPRECATED
	*/
	
	
	
	/**
	 * @deprecated 
	 * @return Starts the loadtime counter
	 * @desc 
	 */
	function tcms_load_start(){
		global $starttime;
		$starttime = tcms_time::get_microtime();
	}
	
	
	/**
	 * @deprecated 
	 * @return microtime
	 * @desc 
	 */
	function get_microtime(){
		list($usec, $sec) = explode(' ', microtime());
		return ((float)$usec + (float)$sec);
	}
	
	
	
	
	/**
	 * @deprecated 
	 * @return the current time
	 * @desc 
	 */
	function current_time(){
		$time = date('H:i');
		return $time;
	}
	
	
	
	
	/**
	 * @deprecated 
	 * @return the current date
	 * @desc 
	 */
	function current_date(){
		$date = date('d.m.Y');
		return $date;
	}
}

?>