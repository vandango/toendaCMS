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
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Time methods
 *
 * This class is used to have some often used time tools.
 *
 * @version 0.3.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * Methods
 *
 *--------------------------------------------------------
 * CONSTRUCTOR AND DESTRUCTOR
 *--------------------------------------------------------
 *
 * __construct()                       -> Default constructor
 * __destruct()                        -> Default destructor
 *
 *--------------------------------------------------------
 * MAIN public functionS
 *--------------------------------------------------------
 * 
 * getMicrotime                        -> Get a microtime
 * getCurrentTime                      -> Get the current time
 * getCurrentDate                      -> Get the current date
 * startTimer                          -> Start the timer
 * stopTimer                           -> Stop the timer
 * getCurrentTimerValue                -> Return a string with the current timer value
 * getTimerValue                       -> Return a string with the timer value
 * startSqlQueryCounter                -> Starts the sql query counter
 * incrmentSqlQueryCounter             -> Increment the sql query counter
 * getSqlQueryCountValue               -> Return the sql query count sum
 * convertSecondsIntoString            -> Convert seconds into a time string
 * 
 * </code>
 *
 */


class tcms_time {
	var $starttime;
	var $endtime;
	var $sqlQuery;
	var $_starttime;
	var $_endtime;
	var $_sqlQuerys;
	
	
	/**
	 * Default constructor
	 */
	public function __construct() {
	}
	
	
	/**
	 * Default destructor
	 */
	public function __destruct() {
	}
	
	
	/*
		METHODS
	*/
	
	
	/**
	 * Get a microtime
	 */
	public function getMicrotime() {
		list($usec, $sec) = explode(' ', microtime());
		return ((float)$usec + (float)$sec);
	}
	
	
	/**
	 * Get the current time
	 */
	public function getCurrentTime() {
		return date('H:i');
	}
	
	
	/**
	 *  Get the current date
	 */
	public function getCurrentDate() {
		return date('d.m.Y');
	}
	
	
	/**
	 * Start the timer
	 */
	public function startTimer() {
		$this->_starttime = $this->getMicrotime();
	}
	
	
	/**
	 * Stop the timer
	 */
	public function stopTimer() {
		$this->_endtime = $this->getMicrotime();
		//return $this->displayTimerValue();
	}
	
	
	/**
	 * Return a string with the current timer value
	 */
	public function getCurrentTimerValue() {
		$this->_endtime = $this->getMicrotime();
		$time = $this->_endtime - $this->_starttime;
		
		return round($time, 4);
	}
	
	
	/**
	 * Return a string with the timer value
	 */
	public function getTimerValue() {
		$time = $this->_endtime - $this->_starttime;
		
		return round($time, 4);
	}
	
	
	/**
	 * Starts the sql query counter
	 */
	public function startSqlQueryCounter() {
		$this->_sqlQuerys = 0;
	}
	
	
	/**
	 * Increment the sql query counter
	 */
	public function incrmentSqlQueryCounter() {
		$this->_sqlQuerys++;
	}
	
	
	/**
	 * Return the sql query count sum
	 */
	public function getSqlQueryCountValue() {
		return ( $this->_sqlQuerys == 1 ? $this->_sqlQuerys.' Database Query' : $this->_sqlQuerys.' Database Querys.' );
	}
	
	
	
	/**
	 * Convert seconds into a time string
	 *
	 * @param String $language
	 * @param Integer $NumberOfSeconds
	 * @return String
	 */
	public function convertSecondsIntoString($language, $NumberOfSeconds) {
		if($language == 'de') {
			$time_map = array(
				'Jahre'    => 31536000,    # 365 Tage
				'Monate'   => 2592000,    # 30 Tage
				'Wochen'   => 604800,    # 7 Tage
				'Tage'     => 86400,
				'Stunden'  => 3600,
				'Minuten'  => 60,
				'Sekunden' => 1,
			);
		}
		else {
			$time_map = array(
				'Years'   => 31536000,    # 365 Tage
				'Months'  => 2592000,    # 30 Tage
				'Weeks'   => 604800,    # 7 Tage
				'Days'    => 86400,
				'Hours'   => 3600,
				'Minutes' => 60,
				'Seconds' => 1,
			);
		}
		
		$SecondsTotal = $NumberOfSeconds;
		$SecondsLeft  = $SecondsTotal;
		
		$stack = array();
		$count = 0;
		
		foreach($time_map as $k => $v) {
			if($SecondsLeft < $v 
			|| $SecondsLeft == 0) {
				continue;
			}
			else {
				$amount = floor($SecondsLeft/ $v);
				$SecondsLeft = $SecondsLeft % $v;
				
				$label = ($amount>1) ? $k : substr($k, 0, -1);
				$stack[] = sprintf('<strong>%s</strong> %s', $amount, $label);
				
				$stack2[$count]['name'] = $label;
				$stack2[$count]['value'] = $amount;
				
				$count++;
			}
		}
		
		$result[0] = $stack2;
		$result[1] = join (', ', $stack);
		
		return $result;
	}
}

?>