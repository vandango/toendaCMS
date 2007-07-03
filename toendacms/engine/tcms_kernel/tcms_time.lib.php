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
 * @version 0.1.1
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
 * stopTimer                           -> Stop the timer
 * getTimerValue                       -> Return a string with the timer value
 * startSqlQueryCounter                -> Starts the sql query counter
 * incrmentSqlQueryCounter             -> Increment the sql query counter
 * getSqlQueryCountValue               -> Return the sql query count sum
 *
 *--------------------------------------------------------
 * DEPRECATED
 *--------------------------------------------------------
 * getmicrotime               -> return microtime
 * tcms_load_start            -> set starttime to start loading of page
 * tcms_load_end              -> set endtime to end loading of page and echo
 * current_date               -> return current date
 * current_time               -> return current time
 * loadtime_output            -> Return a string with the timer value
 * tcms_query_count_start     -> Starts the sql query counter
 * tcms_query_counter         -> Count the sql query counter
 * tcms_query_count_end_out   -> Return the sql query count sum
 * 
 */


class tcms_time{
	var $starttime;
	var $endtime;
	var $sqlQuery;
	var $_starttime;
	var $_endtime;
	var $_sqlQuerys;
	
	
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
		return date('H:i');
	}
	
	
	/**
	 *  Get the current date
	 */
	function getCurrentDate(){
		return date('d.m.Y');
	}
	
	
	/**
	 * Start the timer
	 */
	function startTimer(){
		$this->_starttime = $this->getMicrotime();
	}
	
	
	/**
	 * Stop the timer
	 */
	function stopTimer(){
		$this->_endtime = $this->getMicrotime();
		//return $this->displayTimerValue();
	}
	
	
	/**
	 * Return a string with the timer value
	 */
	function getTimerValue(){
		$time = $this->_endtime - $this->_starttime;
		
		return _MSG_PAGE_LOAD_1.'&nbsp;'.round($time, 4).'&nbsp;'._MSG_PAGE_LOAD_2;
	}
	
	
	/**
	 * Starts the sql query counter
	 */
	function startSqlQueryCounter(){
		$this->_sqlQuerys = 0;
	}
	
	
	/**
	 * Increment the sql query counter
	 */
	function incrmentSqlQueryCounter(){
		$this->_sqlQuerys++;
	}
	
	
	/**
	 * Return the sql query count sum
	 */
	function getSqlQueryCountValue(){
		return ( $this->_sqlQuerys == 1 ? $this->_sqlQuerys.' Database Query' : $this->_sqlQuerys.' Database Querys.' );
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
	
	
	/**
	 * @deprecated 
	 * @return Stop the loadtime counter
	 * @desc 
	 */
	function tcms_load_end(){
		global $endtime;
		$endtime = tcms_time::get_microtime();
		return tcms_time::loadtime_output();
	}
	
	
	/**
	 * @deprecated 
	 * @return Return a string with the loadtime
	 * @desc 
	 */
	function loadtime_output(){
		global $starttime;
		global $endtime;
		
		$time = $endtime - $starttime;
		
		return _MSG_PAGE_LOAD_1.'&nbsp;'.round($time, 4).'&nbsp;'._MSG_PAGE_LOAD_2;
	}
	
	
	/**
	 * @deprecated 
	 * @return Starts the sql query counter
	 * @desc 
	 */
	function tcms_query_count_start(){
		global $sqlQuery;
		$sqlQuery = 0;
	}
	
	
	/**
	 * @deprecated 
	 * @return Count the sql query counter
	 * @desc 
	 */
	function tcms_query_counter(){
		global $sqlQuery;
		$sqlQuery++;
		//echo '<h2>'.$sqlQuery.'</h2><br>';
	}
	
	
	/**
	 * @deprecated 
	 * @return Return the sql query count sum
	 * @desc 
	 */
	function tcms_query_count_end_out(){
		global $sqlQuery;
		return ( $sqlQuery == 1 ? $sqlQuery.' Database Query' : $sqlQuery.' Database Querys.' );
	}
}

?>