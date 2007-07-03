<?php /* _\|/_
         (o o)                         
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS SQL Abstraction Layer
|
| File:	tcms_sql.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS SQL Abstraction Layer
 *
 * This class is used as a basic abstraction class for all needed
 * database methods. It's for an abstraction between all PHP supported
 * database servers.
 *
 * This class let you control varius SQL server interfaces like
 * MySQl, SQLite or PostgreSQL. If you using SQLite, the "$sqlDB" is a file
 * you using for your Database (path with db filename or only filename).
 *
 * This database abstraction is in development and supports all listet database
 * servers. We work on more ...
 *
 * Supported Database Server:
 * - MySQL         -> mysql
 * - PostgreSQL    -> pgsql
 * - MS SQL Server -> mssql
 * 
 * Untested Database Server:
 * - SQLite        -> sqlite
 *
 * @version 0.6.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * 
 * <code>
 * 
 * Methods
 *
 *--------------------------------------------------------
 * CONSTRUCTOR AND DESTRUCTOR
 *--------------------------------------------------------
 *
 * __construct($sqlInterface)                        -> PHP5 Default constructor
 * sqlAbstractionLayer($sqlInterface)                -> PHP4 Default constructor
 * __destruct()                                      -> PHP5 Default destructor
 * _sqlAbstractionLayer()                            -> PHP4 Default destructor
 * 
 *--------------------------------------------------------
 * PROPERTIES
 *--------------------------------------------------------
 * 
 * setTcmsTimeObj                                    -> Set the tcms_time object
 *
 *--------------------------------------------------------
 * SIMPLE LAYER
 *--------------------------------------------------------
 *
 * error                                             -> sqlError
 * connect                                           -> sqlConnect
 * connectWithoutDB                                  -> sqlConnectWithoutDB
 * persistConnect                                    -> sqlPersistConnect
 * disconnect                                        -> sqlDisconnect
 * createDB                                          -> sqlCreateDB
 * query                                             -> sqlQuery
 * fetchArray                                        -> sqlFetchArray
 * fetchObject                                       -> sqlFetchObject
 * freeResult                                        -> sqlFreeResult
 * getAll                                            -> sqlGetAll
 * getOne                                            -> sqlGetOne
 * updateOne                                         -> sqlUpdateOne
 * updateField                                       -> sqlUpdateField
 * createOne                                         -> sqlCreateOne
 * deleteOne                                         -> Delete one from a Table where UID = ?
 * deleteIndividual                                  -> Delete one from a Table where "individual" = ?
 * deleteAll                                         -> Delete all from a Table
 * deleteTable                                       -> Delete Table
 * getNumber                                         -> Return the number of affected rows of a query
 * search                                            -> Search
 * createBackup                                      -> Create a backup file of the selected table
 * createUID                                         -> Create a uid for a $sqlTable with length $sqlNumber
 * getStats                                          -> Get sql server state
 *
 *--------------------------------------------------------
 * MAIN FUNCTIONS
 *--------------------------------------------------------
 *
 * sqlError($sqlErrorNumber)
 * -> SQL Error Messenger
 *    (returns: DB Connection Error Message)
 * 
 * sqlConnect($sqlUser, $sqlPassword, $sqlHost, $sqlDB, $sqlPort)
 * -> Connect to your server and open your database
 *    (Returns: DB Connection ID ($sqlConnectionID))
 *
 * sqlConnectWithoutDB($sqlUser, $sqlPassword, $sqlHost, $sqlPort)
 * -> Connect to your server
 * -> Returns: DB Connection ID ($sqlConnectionID)
 *
 * sqlPersistConnect($sqlUser, $sqlPassword, $sqlHost, $sqlDB, $sqlPort)
 * -> Persist connect to DB
 * -> Returns: DB Connection ID ($sqlConnectionID)
 *
 * sqlDisconnect($sqlConnectionID)                   -> Disconnect from your DB, if needed
 * sqlCreateDB($sqlConnectionID)                     -> Create DB, needed for installation
 *
 *--------------------------------------------------------
 * COMMON FUNCTIONS
 *--------------------------------------------------------
 *
 * sqlQuery($sqlQueryString)                         -> Sql query function with SQL language
 * sqlFetchArray($sqlQueryResult)                    -> Array with result from query
 * sqlFetchObject($sqlQueryResult)                   -> Object with result from query
 * sqlFreeResult($sqlQueryResult)                    -> Free the saveplace for data
 * sqlGetAll($sqlTable)                              -> Get all data from table
 * sqlGetOne($sqlTable, $sqlUID)                     -> Get one from table where UID = ?
 * 
 * sqlUpdateOne($sqlTable, $newDataString, $sqlUID, $withDebug = false)
 * -> Update one row in table where UID = ? and set ...
 *    ($newDataString = [name_of_column="new value", name_of_column="new value"])
 * 
 * sqlUpdateField($sqlTable, $newDataString, $sqlField, $sqlUID, $withDebug = false)
 * -> Update one row in table where $sqlField = ? and set ...
 *    ($newDataString = [name_of_column="new value", name_of_column="new value"])
 * 
 * sqlCreateOne($sqlTable, $newDataString, $sqlUID, $withDebug = false)
 * -> Create one row in $sqlTable where UID must be $sqlUID
 *    ($newDataString = [name_of_column="new value", name_of_column="new value"])
 * 
 * sqlDeleteOne($sqlTable, $sqlUID)                  -> Delete one row from $sqlTable where uid = $sqlUID
 *
 * sqlDeleteIdv($sqlTable, $sqlIndividual, $sqlValue, $withDebug = false)
 * -> Delete all from $sqlTable where $sqlIndividual = $sqlValue
 * 
 * sqlDeleteAll($sqlTable, $withDebug = false)       -> Delete all from a table
 * sqlGetNumber($sqlQueryResult)                     -> Get number of rows of a query
 * 
 * sqlSearch($sqlTable, $sqlSearchColumn, $sqlSearchWord)
 * -> Search for $sqlSearchWord in $sqlSearchColumn in table $sqlTable
 * 
 * sqlCreateBackup($sqlTable, $outfile)              -> Create a backup file of the selected table
 * sqlCreateUID($sqlTable, $sqlNumber)               -> Create a uid for a $sqlTable with length $sqlNumber
 * sqlGetStats()                                     -> Get sql server state
 * sqlDeleteTable($tableName, $withDebug = false)    -> Delete Table
 * </code>
 *
 */


class sqlAbstractionLayer{
	/*
		PRIVATE VAR
	*/
	var $_sqlInterface;
	var $_sqlUsername;
	var $_sqlPassword;
	var $_sqlHost;
	var $_sqlDB;
	var $_sqlPort;
	var $_tcmsTime;
	
	
	
	//--------------------------------------------------------
	// CONSTRUCTOR AND DESTRUCTOR
	//--------------------------------------------------------
	
	/**
	 * PHP5 Default constructor
	 * 
	 * @param String $sqlInterface
	 * @param Object $tcmsTimeObj = null (optional)
	 */
	function __construct($sqlInterface, $tcmsTimeObj = null){
		$this->_sqlInterface = $sqlInterface;
		
		if($tcmsTimeObj != null) {
			$this->_tcmsTime = $tcmsTimeObj;
		}
	}
	
	
	
	/**
	 * PHP4 Default constructor
	 * 
	 * @param String $sqlInterface
	 * @param Object $tcmsTimeObj = null (optional)
	 */
	function sqlAbstractionLayer($sqlInterface, $tcmsTimeObj = null){
		$this->__construct($sqlInterface, $tcmsTimeObj);
	}
	
	
	
	/**
	 * PHP5 Default destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Default destructor
	 */
	function _sqlAbstractionLayer(){
		$this->__destruct();
	}
	
	
	
	//--------------------------------------------------------
	// PROPERTIES
	//--------------------------------------------------------
	
	/**
	 * Set the tcms_time object
	 *
	 * @param Object $value
	 */
	function setTcmsTimeObj($value) {
		$this->_tcmsTime = $value;
	}
	
	
	
	//--------------------------------------------------------
	// SIMPLE LAYER
	//--------------------------------------------------------
	
	/**
	 * sqlError
	 * 
	 * Array:
	 * -> num - Error Number
	 * -> msg - Message
	 * 
	 * @param integer $sqlErrorNumber
	 * @return Array SQL Error Message in an Array with fields:
	 */
	function error($sqlErrorNumber) {
		return $this->sqlError($sqlErrorNumber);
	}
	
	
	
	/**
	 * DB Connector
	 * 
	 * @param String $sqlUser
	 * @param String $sqlPassword
	 * @param String $sqlHost
	 * @param String $sqlDB
	 * @param Integer $sqlPort
	 * @return Integer MySql Connection ID
	 */
	function connect($sqlUser, $sqlPassword, $sqlHost, $sqlDB, $sqlPort) {
		return $this->sqlConnect($sqlUser, $sqlPassword, $sqlHost, $sqlDB, $sqlPort);
	}
	
	
	
	/**
	 * DB Connector (without database)
	 * 
	 * @param String $sqlUser
	 * @param String $sqlPassword
	 * @param String $sqlHost
	 * @param String $sqlDB
	 * @param Integer $sqlPort
	 * @return Integer MySql Connection ID
	 */
	function connectWithoutDB($sqlUser, $sqlPassword, $sqlHost, $sqlPort) {
		return $this->sqlConnectWithoutDB($sqlUser, $sqlPassword, $sqlHost, $sqlPort);
	}
	
	
	
	/**
	 * DB Connector (persist)
	 * 
	 * @param String $sqlUser
	 * @param String $sqlPassword
	 * @param String $sqlHost
	 * @param String $sqlDB
	 * @param Integer $sqlPort
	 * @return Integer MySql Connection ID
	 */
	function persistConnect($sqlUser, $sqlPassword, $sqlHost, $sqlDB, $sqlPort) {
		return $this->sqlPersistConnect($sqlUser, $sqlPassword, $sqlHost, $sqlDB, $sqlPort);
	}
	
	
	
	/**
	 * DB Disconnector
	 * 
	 * @param Integer $sqlConnectionID
	 * @return Boolean
	 */
	function disconnect($sqlConnectionID) {
		return $this->sqlDisconnect($sqlConnectionID);
	}
	
	
	
	/**
	 * Create database
	 * 
	 * @param String $sqlNewDBTitle
	 * @return Boolean
	 */
	function createDB($sqlNewDBTitle) {
		return $this->sqlCreateDB($sqlNewDBTitle);
	}
	
	
	
	/**
	 * SQL Query
	 * 
	 * @param String $sqlQueryString
	 * @param Boolean $withDebug = false
	 * @return Boolean
	 */
	function query($sqlQueryString, $withDebug = false){
		return $this->sqlQuery($sqlQueryString, $withDebug);
	}
	
	
	
	/**
	 * SQL Fetch Array
	 * 
	 * @param Resource $sqlQueryResult
	 * @return Array
	 */
	function fetchArray($sqlQueryResult) {
		return $this->sqlFetchArray($sqlQueryResult);
	}
	
	
	
	/**
	 * SQL Fetch Object
	 * 
	 * @param Resource $sqlQueryResult
	 * @return Object
	 */
	function fetchObject($sqlQueryResult) {
		return $this->sqlFetchObject($sqlQueryResult);
	}
	
	
	
	/**
	 * Free the saveplace for data
	 *
	 * @param resource $sqlQueryResult
	 */
	function freeResult($sqlQueryResult) {
		$this->sqlFreeResult($sqlQueryResult);
	}
	
	
	
	/**
	 * Return all data from a table
	 * 
	 * @param String $sqlTable
	 * @return Fetchable Result
	 */
	function getAll($sqlTable) {
		return $this->sqlGetAll($sqlTable);
	}
	
	
	
	/**
	 * Return all from a table where UID = ?
	 * 
	 * @param String $sqlTable
	 * @param String $sqlUID
	 * @return Fetchable Result
	 */
	function getOne($sqlTable, $sqlUID) {
		return $this->sqlGetOne($sqlTable, $sqlUID);
	}
	
	
	
	/**
	 * Update one from a Table where UID = ?
	 * 
	 * @param String $sqlTable
	 * @param String $newDataString
	 * @param String $sqlUID
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function updateOne($sqlTable, $newDataString, $sqlUID, $withDebug = false) {
		return $this->sqlUpdateOne($sqlTable, $newDataString, $sqlUID, $withDebug);
	}
	
	
	
	/**
	 * Update one from a Table where UID = ?
	 * 
	 * @param String $sqlTable
	 * @param String $newDataString
	 * @param String $sqlField
	 * @param String $sqlUID
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function updateField($sqlTable, $newDataString, $sqlField, $sqlUID, $withDebug = false) {
		return $this->sqlUpdateField($sqlTable, $newDataString, $sqlField, $sqlUID, $withDebug);
	}
	
	
	
	/**
	 * Create a entry in a Table where UID = ?
	 * 
	 * @param String $sqlTable
	 * @param String $sqlColumns
	 * @param String $newDataString
	 * @param String $sqlUID
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function createOne($sqlTable, $sqlColumns, $newDataString, $sqlUID, $withDebug = false) {
		return $this->sqlCreateOne($sqlTable, $sqlColumns, $newDataString, $sqlUID, $withDebug);
	}
	
	
	
	/**
	 * Delete one from a Table where UID = ?
	 * 
	 * @param String $sqlTable
	 * @param String $sqlUID
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function deleteOne($sqlTable, $sqlUID, $withDebug = false) {
		return $this->sqlDeleteOne($sqlTable, $sqlUID, $withDebug);
	}
	
	
	
	/**
	 * Delete one from a Table where "individual" = ?
	 * 
	 * @param String $sqlTable
	 * @param String $sqlIndividual
	 * @param String $sqlValue
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function deleteIndividual($sqlTable, $sqlIndividual, $sqlValue, $withDebug = false) {
		return $this->sqlDeleteIdv($sqlTable, $sqlIndividual, $sqlValue, $withDebug);
	}
	
	
	
	/**
	 * Delete all from a Table
	 * 
	 * @param String $sqlTable
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function deleteAll($sqlTable, $withDebug = false) {
		return $this->sqlDeleteAll($sqlTable, $withDebug);
	}
	
	
	
	/**
	 * Delete Table
	 * 
	 * @param String $tableName
	 * @param Boolean $withDebug = false
	 * @return Boolean
	 */
	function deleteTable($tableName, $withDebug = false) {
		return $this->sqlDeleteTable($tableName, $withDebug);
	}
	
	
	
	/**
	 * Return the number of affected rows of a query
	 * 
	 * @param String $sqlQueryResult
	 * @return Integer
	 */
	function getNumber($sqlQueryResult) {
		return $this->sqlGetNumber($sqlQueryResult);
	}
	
	
	
	/**
	 * Search
	 * 
	 * @param String $sqlTable
	 * @param String $sqlSearchColumn
	 * @param String $sqlSearchWord
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function search($sqlTable, $sqlSearchColumn, $sqlSearchWord, $withDebug = false) {
		return $this->sqlSearch($sqlTable, $sqlSearchColumn, $sqlSearchWord, $withDebug);
	}
	
	
	
	/**
	 * Create a backup file of the selected table
	 * 
	 * @param Boolean $with_output
	 * @param Boolean $structure_only
	 */
	function createBackup($with_output, $structure_only) {
		return $this->sqlCreateBackup($with_output, $structure_only);
	}
	
	
	
	/**
	 * Create a uid for a $sqlTable with length $sqlNumber
	 * 
	 * @param String $sqlTable
	 * @param String $sqlNumber
	 * @return String
	 */
	function createUID($sqlTable, $sqlNumber) {
		return $this->sqlCreateUID($sqlTable, $sqlNumber);
	}
	
	
	
	/**
	 * Get sql server state
	 * 
	 * @return String
	 */
	function getStats() {
		return $this->sqlGetStats();
	}
	
	
	
	//--------------------------------------------------------
	// MAIN FUNCTIONS
	//--------------------------------------------------------
	
	/**
	 * sqlError
	 * 
	 * Array:
	 * -> num - Error Number
	 * -> msg - Message
	 * 
	 * @param UnknownType $sqlErrorNumber
	 * @return Array SQL Error Message in an Array with fields:
	 */
	function sqlError($sqlErrorNumber){
		$arr_sqlErrorMSG['num'][0] = 0;
		$arr_sqlErrorMSG['msg'][0] = $this->_sqlInterface.' Database Connection failed!';
		
		$arr_sqlErrorMSG['num'][1] = 1;
		$arr_sqlErrorMSG['msg'][1] = 'No <strong>sqlAbstractionLayer</strong> Object initialized!';
		
		
		$returnError['num'] = $arr_sqlErrorMSG['num'][$sqlErrorNumber];
		$returnError['msg'] = $arr_sqlErrorMSG['msg'][$sqlErrorNumber];
		
		/*
		$fp = fopen('log.txt', 'w');
		fwrite($fp, $returnError['num'].' --- '.$returnError['msg']);
		fclose($fp);
		*/
		
		return $returnError;
	}
	
	
	
	/**
	 * DB Connector
	 * 
	 * @param String $sqlUser
	 * @param String $sqlPassword
	 * @param String $sqlHost
	 * @param String $sqlDB
	 * @param Integer $sqlPort
	 * @return Integer MySql Connection ID
	 */
	function sqlConnect($sqlUser, $sqlPassword, $sqlHost, $sqlDB, $sqlPort){
		if(isset($this->_sqlInterface) && !empty($this->_sqlInterface) && $this->_sqlInterface != ''){
			$this->_sqlUsername = $sqlUser;
			$this->_sqlPassword = $sqlPassword;
			$this->_sqlHost = $sqlHost;
			$this->_sqlDB = $sqlDB;
			
			if($sqlPort != '' || !empty($sqlPort))
				$this->_sqlPort = $sqlPort;
			
			switch($this->_sqlInterface){
				case 'mysql':
					$sqlConnectionID = @mysql_connect($this->_sqlHost, $this->_sqlUsername, $this->_sqlPassword);
					
					if($sqlConnectionID)
						$sqlConnectionID = mysql_select_db($this->_sqlDB);
					else
						$sqlConnectionID = $this->sqlError(0);
					break;
				
				case 'pgsql':
					$conn_string = ' user='.$this->_sqlUsername.' dbname='.$this->_sqlDB.' password='.$this->_sqlPassword.' host='.$this->_sqlHost;
  					$conn_string .= isset($this->_sqlPort) ? ' port='.$this->_sqlPort : '';
					$sqlConnectionID = @pg_connect($conn_string);
					
					if($sqlConnectionID == False)
						$sqlConnectionID = $this->sqlError(0);
					break;
				
				case 'sqlite':
					$sqlConnectionID = @sqlite_open($this->_sqlDB);
					break;
				
				case 'mssql':
					$sqlConnectionID = @mssql_connect($this->_sqlHost, $this->_sqlUsername, $this->_sqlPassword);
					
					if($sqlConnectionID)
						$sqlConnectionID = @mssql_select_db($this->_sqlDB);
					else
						$sqlConnectionID = $this->sqlError(0);
					break;
			}
		}
		else{ $sqlConnectionID = $this->sqlError(1); }
		
		return $sqlConnectionID;
	}
	
	
	
	/**
	 * DB Connector (without database)
	 * 
	 * @param String $sqlUser
	 * @param String $sqlPassword
	 * @param String $sqlHost
	 * @param String $sqlDB
	 * @param Integer $sqlPort
	 * @return Integer MySql Connection ID
	 */
	function sqlConnectWithoutDB($sqlUser, $sqlPassword, $sqlHost, $sqlPort){
		if(isset($this->_sqlInterface) && !empty($this->_sqlInterface) && $this->_sqlInterface != ''){
			
			$this->_sqlUsername = $sqlUser;
			$this->_sqlPassword = $sqlPassword;
			$this->_sqlHost = $sqlHost;
			$this->_sqlDB = $sqlDB;
			
			if($sqlPort != '' || !empty($sqlPort)){ $this->_sqlPort = $sqlPort; }
			
			switch($this->_sqlInterface){
				case 'mysql':
					$sqlConnectionID = @mysql_connect($this->_sqlHost, $this->_sqlUsername, $this->_sqlPassword);
					
					if($sqlConnectionID == false)
						$sqlConnectionID = $this->sqlError(0);
					break;
				
				case 'pgsql':
					$conn_string = ' user='.$this->_sqlUsername.' password='.$this->_sqlPassword.' host='.$this->_sqlHost;
  					$conn_string .= isset($this->_sqlPort) ? ' port='.$this->_sqlPort : '';
					$sqlConnectionID = @pg_connect($conn_string);
					
					if($sqlConnectionID == False)
						$sqlConnectionID = $this->sqlError(0);
					break;
				
				case 'sqlite':
					$sqlConnectionID = @sqlite_open($this->_sqlDB);
					break;
				
				case 'mssql':
					$sqlConnectionID = @mssql_connect($this->_sqlHost, $this->_sqlUsername, $this->_sqlPassword);
					
					if($sqlConnectionID == False)
						$sqlConnectionID = $this->sqlError(0);
					break;
			}
		}
		else{ $sqlConnectionID = $this->sqlError(1); }
		
		return $sqlConnectionID;
	}
	
	
	
	/**
	 * DB Connector (persist)
	 * 
	 * @param String $sqlUser
	 * @param String $sqlPassword
	 * @param String $sqlHost
	 * @param String $sqlDB
	 * @param Integer $sqlPort
	 * @return Integer MySql Connection ID
	 */
	function sqlPersistConnect($sqlUser, $sqlPassword, $sqlHost, $sqlDB, $sqlPort){
		if(isset($this->_sqlInterface) && !empty($this->_sqlInterface) && $this->_sqlInterface != ''){
			
			$this->_sqlUsername = $sqlUser;
			$this->_sqlPassword = $sqlPassword;
			$this->_sqlHost = $sqlHost;
			$this->_sqlDB = $sqlDB;
			if($sqlPort != '' || !empty($sqlPort)){ $this->_sqlPort = $sqlPort; }
			
			switch($this->$_sqlInterface){
				case 'mysql':
					$sqlConnectionID = @mysql_pconnect($this->_sqlHost, $this->_sqlUsername, $this->_sqlPassword);
					
					if($sqlConnectionID)
						$sqlConnectionID = mysql_select_db($this->_sqlDB);
					else
						$sqlConnectionID = $this->sqlError(0);
					break;
				
				case 'pgsql':
					$sqlConnectionID = @pg_pconnect('host='.$this->_sqlHost.''.( isset($this->_sqlPort) && !empty($this->_sqlPort) ? ' port='.$this->_sqlPort : '' ).' dbname='.$this->_sqlDB.' user='.$this->_sqlUsername.' password='.$this->_sqlPassword);
					
					if($sqlConnectionID == False)
						$sqlConnectionID = $this->sqlError(0);
					break;
				
				case 'sqlite':
					$sqlConnectionID = @sqlite_popen($this->_sqlDB);
					break;
				
				case 'mssql':
					$sqlConnectionID = @mssql_pconnect($this->_sqlHost, $this->_sqlUsername, $this->_sqlPassword);
					
					if($sqlConnectionID)
						$sqlConnectionID = mssql_select_db($this->_sqlDB);
					else
						$sqlConnectionID = $this->sqlError(0);
					break;
			}
		}
		else{ $sqlConnectionID = $this->sqlError(1); }
		
		return $sqlConnectionID;
	}
	
	
	
	/**
	 * DB Disconnector
	 * 
	 * @param Integer $sqlConnectionID
	 * @return Boolean
	 */
	function sqlDisconnect($sqlConnectionID){
		switch($this->_sqlInterface){
			case 'mysql':
				$bClose = @mysql_close($sqlConnectionID);
				break;
			
			case 'pgsql':
				$bClose = @pg_close($sqlConnectionID);
				break;
			
			case 'sqlite':
				$bClose = @sqlite_close($sqlConnectionID);
				break;
			
			case 'mssql':
				$bClose = @mssql_close($sqlConnectionID);
				break;
		}
		
		return $bClose;
	}
	
	
	
	/**
	 * Create database
	 * 
	 * @param String $sqlNewDBTitle
	 * @return Boolean
	 */
	function sqlCreateDB($sqlNewDBTitle){
		switch($this->_sqlInterface){
			case 'mysql':
				$bCreate = @mysql_create_db($sqlNewDBTitle);
				break;
			
			case 'pgsql':
				$bCreate = '';
				break;
			
			case 'sqlite':
				$bCreate = '';
				break;
			
			case 'mssql':
				$bCreate = '';
				break;
		}
		
		return $bClose;
	}
	
	
	
	
	//--------------------------------------------------------
	// COMMON FUNCTIONS
	//--------------------------------------------------------
	
	/**
	 * SQL Query
	 * 
	 * @param String $sqlQueryString
	 * @param Boolean $withDebug = false
	 * @return Boolean
	 */
	function sqlQuery($sqlQueryString, $withDebug = false){
		global $tcms_time;
		
		switch($this->_sqlInterface){
			case 'mysql':
				if($withDebug) {
					$fp = fopen('log_sqlQuery_'.microtime().'.txt', 'w');
					fwrite($fp, $sqlQueryString);
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mysql_query($sqlQueryString);
				if(!$sqlResult)
					$sqlResult = 'Invalid query: ' . mysql_error();
				break;
			
			case 'pgsql':
				if($withDebug) {
					$fp = fopen('log_sqlQuery_'.microtime().'.txt', 'w');
					fwrite($fp, $sqlQueryString);
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = pg_query($sqlQueryString);
				if(!$sqlResult)
					$sqlResult = 'Invalid query: ' . pg_result_error();
				break;
			
			case 'sqlite':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = sqlite_query($sqlQueryString);
				$sqlError  = sqlite_last_error($this->_sqlDB);
				if(!$sqlResult)
					$sqlResult = 'Invalid query: ' . sqlite_error_string($sqlError);
				break;
			
			case 'mssql':
				if($withDebug) {
					$fp = fopen('log_sqlQuery_'.microtime().'.txt', 'w');
					fwrite($fp, $sqlQueryString);
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mssql_query($sqlQueryString);
				if(!$sqlResult)
					$sqlResult = 'Invalid query: ' . $sqlQueryString;
				break;
		}
		
		return $sqlResult;
	}
	
	
	
	/**
	 * SQL Fetch Array
	 * 
	 * @param Resource $sqlQueryResult
	 * @return Array
	 */
	function sqlFetchArray($sqlQueryResult){
		switch($this->_sqlInterface){
			case 'mysql':
				$fetchArray = @mysql_fetch_array($sqlQueryResult);
				break;
			
			case 'pgsql':
				$fetchArray = @pg_fetch_array($sqlQueryResult);
				break;
			
			case 'sqlite':
				$fetchArray = @sqlite_fetch_array($sqlQueryResult);
				break;
			
			case 'mssql':
				$fetchArray = @mssql_fetch_array($sqlQueryResult);
				break;
		}
		
		return $fetchArray;
	}
	
	
	
	/**
	 * SQL Fetch Object
	 * 
	 * @param Resource $sqlQueryResult
	 * @return Object
	 */
	function sqlFetchObject($sqlQueryResult){
		switch($this->_sqlInterface){
			case 'mysql':
				$fetchObject = @mysql_fetch_object($sqlQueryResult);
				break;
			
			case 'pgsql':
				$fetchObject = @pg_fetch_object($sqlQueryResult);
				break;
			
			case 'sqlite':
				$fetchObject = @sqlite_fetch_object($sqlQueryResult);
				break;
			
			case 'mssql':
				$fetchObject = @mssql_fetch_object($sqlQueryResult);
				break;
		}
		
		return $fetchObject;
	}
	
	
	
	/**
	 * Free the saveplace for data
	 *
	 * @param resource $sqlQueryResult
	 */
	function sqlFreeResult($sqlQueryResult){
		switch($this->_sqlInterface){
			case 'mysql':
				@mysql_free_result($sqlQueryResult);
				break;
			
			case 'pgsql':
				@pg_free_result($sqlQueryResult);
				break;
			
			case 'sqlite':
				// --> NO USE OF "FREE RESULT" <--
				break;
			
			case 'mssql':
				@mssql_free_result($sqlQueryResult);
				break;
		}
	}
	
	
	
	/**
	 * Return all data from a table
	 * 
	 * @param String $sqlTable
	 * @return Fetchable Result
	 */
	function sqlGetAll($sqlTable){
		global $tcms_time;
		
		switch($this->_sqlInterface){
			case 'mysql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mysql_query('SELECT * FROM '.$sqlTable);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . mysql_error(); }
				break;
			
			case 'pgsql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = pg_query('SELECT * FROM '.$sqlTable);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . pg_result_error(); }
				break;
			
			case 'sqlite':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = sqlite_query('SELECT * FROM '.$sqlTable);
				$sqlError  = sqlite_last_error($this->_sqlDB);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . sqlite_error_string($sqlError); }
				break;
			
			case 'mssql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mssql_query('SELECT * FROM '.$sqlTable);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . $sqlQueryString; }
				break;
		}
		
		return $sqlResult;
	}
	
	
	
	/**
	 * Return all from a table where UID = ?
	 * 
	 * @param String $sqlTable
	 * @param String $sqlUID
	 * @return Fetchable Result
	 */
	function sqlGetOne($sqlTable, $sqlUID){
		global $tcms_time;
		
		switch($this->_sqlInterface){
			case 'mysql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				//echo 'SELECT * FROM '.$sqlTable.' WHERE uid = "'.$sqlUID.'"<br />';
				$sqlResult = mysql_query('SELECT * FROM '.$sqlTable.' WHERE uid = "'.$sqlUID.'"');
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . mysql_error(); }
				break;
			
			case 'pgsql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = pg_query("SELECT * FROM ".$sqlTable." WHERE uid = '".$sqlUID."'");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . pg_result_error(); }
				break;
			
			case 'sqlite':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = sqlite_query('SELECT * FROM '.$sqlTable.' WHERE uid = "'.$sqlUID.'"');
				$sqlError  = sqlite_last_error($this->_sqlDB);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . sqlite_error_string($sqlError); }
				break;
			
			case 'mssql':
				/*
				$fp = fopen('log_GetOne_'.microtime().'.txt', 'w');
				fwrite($fp, "SELECT * FROM ".$sqlTable." WHERE uid = '".$sqlUID."'");
				fclose($fp);
				*/
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mssql_query("SELECT * FROM ".$sqlTable." WHERE [uid] = '".$sqlUID."'");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . $sqlQueryString; }
				break;
		}
		
		return $sqlResult;
	}
	
	
	
	/**
	 * Update one from a Table where UID = ?
	 * 
	 * @param String $sqlTable
	 * @param String $newDataString
	 * @param String $sqlUID
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function sqlUpdateOne($sqlTable, $newDataString, $sqlUID, $withDebug = false){
		global $tcms_time;
		
		switch($this->_sqlInterface){
			case 'mysql':
				if($withDebug) {
					$fp = fopen('log_sqlUpdateOne_'.microtime().'.txt', 'w');
					fwrite($fp, 'UPDATE '.$sqlTable.' SET '.$newDataString.' WHERE uid = "'.$sqlUID.'"');
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mysql_query('UPDATE '.$sqlTable.' SET '.$newDataString.' WHERE uid = "'.$sqlUID.'"');
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . mysql_error(); }
				break;
			
			case 'pgsql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$newDataString = str_replace('"', "'", $newDataString);
				$newDataString = str_replace($sqlTable.'.', '"', $newDataString);
				$newDataString = str_replace('=', '"=', $newDataString);
				
				if($withDebug) {
					$fp = fopen('log_sqlUpdateOne_'.microtime().'.txt', 'w');
					fwrite($fp, "UPDATE ".$sqlTable." SET ".$newDataString."  WHERE uid = '".$sqlUID."'");
					fclose($fp);
				}
				
				$sqlResult = pg_query("UPDATE ".$sqlTable." SET ".$newDataString."  WHERE uid = '".$sqlUID."'");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . pg_result_error(); }
				break;
			
			case 'sqlite':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = sqlite_query('UPDATE '.$sqlTable.' SET '.$newDataString.' WHERE uid = "'.$sqlUID.'"');
				$sqlError  = sqlite_last_error($this->_sqlDB);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . sqlite_error_string($sqlError); }
				break;
			
			case 'mssql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$newDataString = str_replace('"', "'", $newDataString);
				$newDataString = str_replace($sqlTable.'.', $sqlTable.'.[', $newDataString);
				$newDataString = str_replace('=', ']=', $newDataString);
				
				if($withDebug) {
					$fp = fopen('log_sqlUpdateOne_'.microtime().'.txt', 'w');
					fwrite($fp, "UPDATE ".$sqlTable." SET ".$newDataString."  WHERE [uid] = '".$sqlUID."'");
					fclose($fp);
				}
				
				$sqlResult = mssql_query("UPDATE ".$sqlTable." SET ".$newDataString."  WHERE [uid] = '".$sqlUID."'");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . $sqlQueryString; }
				break;
		}
		
		return $sqlResult;
	}
	
	
	
	/**
	 * Update one from a Table where UID = ?
	 * 
	 * @param String $sqlTable
	 * @param String $newDataString
	 * @param String $sqlField
	 * @param String $sqlUID
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function sqlUpdateField($sqlTable, $newDataString, $sqlField, $sqlUID, $withDebug = false){
		global $tcms_time;
		
		switch($this->_sqlInterface){
			case 'mysql':
				if($withDebug) {
					$fp = fopen('log_sqlUpdateOne_'.microtime().'.txt', 'w');
					fwrite($fp, 'UPDATE '.$sqlTable.' SET '.$newDataString.' WHERE '.$sqlField.' = "'.$sqlUID.'"');
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mysql_query('UPDATE '.$sqlTable.' SET '.$newDataString.' WHERE '.$sqlField.' = "'.$sqlUID.'"');
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . mysql_error(); }
				break;
			
			case 'pgsql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$newDataString = str_replace('"', "'", $newDataString);
				$newDataString = str_replace($sqlTable.'.', '"', $newDataString);
				$newDataString = str_replace('=', '"=', $newDataString);
				
				if($withDebug) {
					$fp = fopen('log_sqlUpdateOne_'.microtime().'.txt', 'w');
					fwrite($fp, "UPDATE ".$sqlTable." SET ".$newDataString."  WHERE ".$sqlField." = '".$sqlUID."'");
					fclose($fp);
				}
				
				$sqlResult = pg_query("UPDATE ".$sqlTable." SET ".$newDataString."  WHERE ".$sqlField." = '".$sqlUID."'");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . pg_result_error(); }
				break;
			
			case 'sqlite':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = sqlite_query('UPDATE '.$sqlTable.' SET '.$newDataString.' WHERE '.$sqlField.' = "'.$sqlUID.'"');
				$sqlError  = sqlite_last_error($this->_sqlDB);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . sqlite_error_string($sqlError); }
				break;
			
			case 'mssql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$newDataString = str_replace('"', "'", $newDataString);
				$newDataString = str_replace($sqlTable.'.', $sqlTable.'.[', $newDataString);
				$newDataString = str_replace('=', ']=', $newDataString);
				
				if($withDebug) {
					$fp = fopen('log_sqlUpdateOne_'.microtime().'.txt', 'w');
					fwrite($fp, "UPDATE ".$sqlTable." SET ".$newDataString."  WHERE [".$sqlField."] = '".$sqlUID."'");
					fclose($fp);
				}
				
				$sqlResult = mssql_query("UPDATE ".$sqlTable." SET ".$newDataString."  WHERE [".$sqlField."] = '".$sqlUID."'");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . $sqlQueryString; }
				break;
		}
		
		return $sqlResult;
	}
	
	
	
	/**
	 * Create a entry in a Table where UID = ?
	 * 
	 * @param String $sqlTable
	 * @param String $sqlColumns
	 * @param String $newDataString
	 * @param String $sqlUID
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function sqlCreateOne($sqlTable, $sqlColumns, $newDataString, $sqlUID, $withDebug = false){
		global $tcms_time;
		
		switch($this->_sqlInterface){
			case 'mysql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				if($withDebug) {
					$fp = fopen('log_sqlCreateOne_'.microtime().'.txt', 'w');
					fwrite($fp, "INSERT INTO ".$sqlTable." ( ".$sqlColumns.", `uid`) VALUES( ".$newDataString." , '".$sqlUID."' )");
					fclose($fp);
				}
				
				$sqlResult = mysql_query("INSERT INTO ".$sqlTable." ( ".$sqlColumns.", `uid`) VALUES( ".$newDataString." , '".$sqlUID."' )");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . mysql_error(); }
				break;
			
			case 'pgsql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				if($withDebug) {
					$fp = fopen('log_sqlCreateOne_'.microtime().'.txt', 'w');
					fwrite($fp, "INSERT INTO ".$sqlTable." ( ".$sqlColumns.", uid) VALUES( ".$newDataString." , '".$sqlUID."' )");
					fclose($fp);
				}
				
				$sqlResult = pg_query("INSERT INTO ".$sqlTable." ( ".$sqlColumns.", uid) VALUES( ".$newDataString." , '".$sqlUID."' )");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . pg_result_error(); }
				break;
			
			case 'sqlite':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = sqlite_query('INSERT INTO '.$sqlTable.' ( '.$sqlColumns.', "uid") VALUES( '.$newDataString.' , '.$sqlUID.' )');
				$sqlError  = sqlite_last_error($this->_sqlDB);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . sqlite_error_string($sqlError); }
				break;
			
			case 'mssql':
				if($withDebug) {
					$fp = fopen('log_sqlCreateOne_'.microtime().'.txt', 'w');
					fwrite($fp, "INSERT INTO ".$sqlTable." ( ".$sqlColumns.", \"uid\") VALUES( ".$newDataString." , '".$sqlUID."' )");
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mssql_query("INSERT INTO ".$sqlTable." ( ".$sqlColumns.", [uid]) VALUES( ".$newDataString." , '".$sqlUID."' )");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . $sqlQueryString; }
				break;
		}
		
		return $sqlResult;
	}
	
	
	
	/**
	 * Delete one from a Table where UID = ?
	 * 
	 * @param String $sqlTable
	 * @param String $sqlUID
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function sqlDeleteOne($sqlTable, $sqlUID, $withDebug = false){
		global $tcms_time;
		
		switch($this->_sqlInterface){
			case 'mysql':
				if($withDebug) {
					$fp = fopen('log_sqlDeleteOne_'.microtime().'.txt', 'w');
					fwrite($fp, 'DELETE FROM '.$sqlTable.' WHERE uid = "'.$sqlUID.'"');
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mysql_query('DELETE FROM '.$sqlTable.' WHERE uid = "'.$sqlUID.'"');
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . mysql_error(); }
				break;
			
			case 'pgsql':
				if($withDebug) {
					$fp = fopen('log_sqlDeleteOne_'.microtime().'.txt', 'w');
					fwrite($fp, "DELETE FROM ".$sqlTable." WHERE uid = '".$sqlUID."'");
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = pg_query("DELETE FROM ".$sqlTable." WHERE uid = '".$sqlUID."'");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . pg_result_error(); }
				break;
			
			case 'sqlite':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = sqlite_query('DELETE FROM '.$sqlTable.' WHERE uid = "'.$sqlUID.'"');
				$sqlError  = sqlite_last_error($this->_sqlDB);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . sqlite_error_string($sqlError); }
				break;
			
			case 'mssql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mssql_query("DELETE FROM ".$sqlTable." WHERE [uid] = '".$sqlUID."'");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . $sqlQueryString; }
				break;
		}
		
		return $sqlResult;
	}
	
	
	
	/**
	 * Delete one from a Table where "individual" = ?
	 * 
	 * @param String $sqlTable
	 * @param String $sqlIndividual
	 * @param String $sqlValue
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function sqlDeleteIdv($sqlTable, $sqlIndividual, $sqlValue, $withDebug = false){
		global $tcms_time;
		
		switch($this->_sqlInterface){
			case 'mysql':
				if($withDebug) {
					$fp = fopen('log_sqlDeleteIdv_'.microtime().'.txt', 'w');
					fwrite($fp, 'DELETE FROM '.$sqlTable.' WHERE '.$sqlIndividual.' = "'.$sqlValue.'"');
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mysql_query('DELETE FROM '.$sqlTable.' WHERE '.$sqlIndividual.' = "'.$sqlValue.'"');
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . mysql_error(); }
				break;
			
			case 'pgsql':
				if($withDebug) {
					$fp = fopen('log_sqlDeleteIdv_'.microtime().'.txt', 'w');
					fwrite($fp, "DELETE FROM ".$sqlTable." WHERE ".$sqlIndividual." = '".$sqlValue."'");
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = pg_query("DELETE FROM ".$sqlTable." WHERE ".$sqlIndividual." = '".$sqlValue."'");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . pg_result_error(); }
				break;
			
			case 'sqlite':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = sqlite_query('DELETE FROM '.$sqlTable.' WHERE '.$sqlIndividual.' = "'.$sqlValue.'"');
				$sqlError  = sqlite_last_error($this->_sqlDB);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . sqlite_error_string($sqlError); }
				break;
			
			case 'mssql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mssql_query("DELETE FROM ".$sqlTable." WHERE ".$sqlIndividual." = '".$sqlValue."'");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . $sqlQueryString; }
				break;
		}
		
		return $sqlResult;
	}
	
	
	
	/**
	 * Delete all from a Table
	 * 
	 * @param String $sqlTable
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function sqlDeleteAll($sqlTable, $withDebug = false){
		global $tcms_time;
		
		switch($this->_sqlInterface){
			case 'mysql':
				if($withDebug) {
					$fp = fopen('log_sqlDeleteAll_'.microtime().'.txt', 'w');
					fwrite($fp, 'DELETE FROM '.$sqlTable);
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mysql_query('DELETE FROM '.$sqlTable);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . mysql_error(); }
				break;
			
			case 'pgsql':
				if($withDebug) {
					$fp = fopen('log_sqlDeleteAll_'.microtime().'.txt', 'w');
					fwrite($fp, "DELETE FROM ".$sqlTable);
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = pg_query("DELETE FROM ".$sqlTable);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . pg_result_error(); }
				break;
			
			case 'sqlite':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = sqlite_query('DELETE FROM '.$sqlTable);
				$sqlError  = sqlite_last_error($this->_sqlDB);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . sqlite_error_string($sqlError); }
				break;
			
			case 'mssql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mssql_query("DELETE FROM ".$sqlTable);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . $sqlQueryString; }
				break;
		}
		
		return $sqlResult;
	}
	
	
	
	/**
	 * Return the number of affected rows of a query
	 * 
	 * @param String $sqlQueryResult
	 * @return Integer
	 */
	function sqlGetNumber($sqlQueryResult){
		switch($this->_sqlInterface){
			case 'mysql':
				$sqlResult = @mysql_num_rows($sqlQueryResult);
				break;
			
			case 'pgsql':
				$sqlResult = @pg_num_rows($sqlQueryResult);
				break;
			
			case 'sqlite':
				$sqlResult = @sqlite_num_rows($sqlQueryResult);
				break;
			
			case 'mssql':
				$sqlResult = @mssql_num_rows($sqlQueryResult);
				break;
		}
		
		return $sqlResult;
	}
	
	
	
	/**
	 * Search
	 * 
	 * @param String $sqlTable
	 * @param String $sqlSearchColumn
	 * @param String $sqlSearchWord
	 * @param String $withDebug = false
	 * @return Integer
	 */
	function sqlSearch($sqlTable, $sqlSearchColumn, $sqlSearchWord, $withDebug = false){
		global $tcms_time;
		
		switch($this->_sqlInterface){
			case 'mysql':
				if($withDebug) {
					$fp = fopen('log_'.microtime().'.txt', 'w');
					fwrite($fp, 'SELECT * FROM '.$sqlTable.' WHERE '.$sqlSearchColumn.' REGEXP "'.$sqlSearchWord.'" OR '.$sqlSearchColumn.' LIKE "%'.$sqlSearchWord.'%"');
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mysql_query('SELECT * FROM '.$sqlTable.' WHERE '.$sqlSearchColumn.' REGEXP "'.$sqlSearchWord.'" OR '.$sqlSearchColumn.' LIKE "%'.$sqlSearchWord.'%"');
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . mysql_error(); }
				break;
			
			case 'pgsql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = pg_query("SELECT * FROM ".$sqlTable." WHERE ".$sqlSearchColumn." LIKE '%".$sqlSearchWord."%'");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . pg_result_error(); }
				break;
			
			case 'sqlite':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = sqlite_query('SELECT * FROM '.$sqlTable.' WHERE '.$sqlSearchColumn.' REGEXP "'.$sqlSearchWord.'"');
				$sqlError  = sqlite_last_error($this->_sqlDB);
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . sqlite_error_string($sqlError); }
				break;
			
			case 'mssql':
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mssql_query("SELECT * FROM ".$sqlTable." WHERE ".$sqlSearchColumn." LIKE '%".$sqlSearchWord."%'");
				if(!$sqlResult){ $sqlResult = 'Invalid query: ' . $sqlQueryString; }
				break;
		}
		
		return $sqlResult;
	}
	
	
	
	/**
	 * Create a backup file of the selected table
	 * 
	 * @param Boolean $with_output
	 * @param Boolean $structure_only
	 */
	function sqlCreateBackup($with_output, $structure_only){
		include_once('../tcms_kernel/tcms_sql_dump.lib.php');
		
		$sqlDump = new tcms_sql_dump();
		
		switch($this->_sqlInterface){
			case 'mysql':
				if($with_output == 1){
					$fp = fopen('../../cache/mysql_database_backup_['.$this->_sqlDB.'].sql', 'w');
					fwrite($fp, $sqlDump->MySQLBackup($this->_sqlHost, $this->_sqlDB, $this->_sqlUsername, $this->_sqlPassword, $structure_only));
					fclose($fp);
				}
				else{
					$sqlResult = htmlspecialchars($sqlDump->MySQLBackup($this->_sqlHost, $this->_sqlDB, $this->_sqlUsername, $this->_sqlPassword, $structure_only));
				}
				break;
			
			case 'pgsql':
				if($with_output == 1){
					//$fp = fopen('../../cache/pgsql_database_backup_['.$this->_sqlDB.'].sql', 'w');
					//fwrite($fp, $sqlDump->MySQLBackup($this->_sqlHost, $this->_sqlDB, $this->_sqlUsername, $this->_sqlPassword, $structure_only));
					//fclose($fp);
				}
				else{
					//$sqlResult = htmlspecialchars($sqlDump->MySQLBackup($this->_sqlHost, $this->_sqlDB, $this->_sqlUsername, $this->_sqlPassword, $structure_only));
				}
				break;
			
			case 'sqlite':
				break;
			
			case 'mssql':
				if($with_output == 1){
					//$fp = fopen('../../cache/mssql_database_backup_['.$this->_sqlDB.'].sql', 'w');
					//fwrite($fp, $sqlDump->MySQLBackup($this->_sqlHost, $this->_sqlDB, $this->_sqlUsername, $this->_sqlPassword, $structure_only));
					//fclose($fp);
				}
				else{
					//$sqlResult = htmlspecialchars($sqlDump->MySQLBackup($this->_sqlHost, $this->_sqlDB, $this->_sqlUsername, $this->_sqlPassword, $structure_only));
				}
				break;
		}
		
		unset($sqlDump);
		
		return $sqlResult;
	}
	
	
	
	/**
	 * Create a uid for a $sqlTable with length $sqlNumber
	 * 
	 * @param String $sqlTable
	 * @param String $sqlNumber
	 * @return String
	 */
	function sqlCreateUID($sqlTable, $sqlNumber){
		$uidExists = true;
		
		while($uidExists){
			$sqlUID = substr(md5(microtime()), 0, $sqlNumber);
			
			switch($this->_sqlInterface){
				case 'mysql':
					$sqlResult = @mysql_query('SELECT * FROM '.$sqlTable.' WHERE uid="'.$sqlUID.'"');
					
					if(!$sqlResult)
						$sqlResult = 'Invalid query: '.mysql_error(); break;
					
					if(mysql_num_rows($sqlResult) == 0)
						$uidExists = false;
					else
						$uidExists = true;
					break;
				
				case 'pgsql':
					$sqlResult = @pg_query($sqlQueryString);
					
					if(!$sqlResult)
						$sqlResult = 'Invalid query: '.pg_result_error();
					//$uidExists = mysql_num_rows($sqlResult);
					break;
				
				case 'sqlite':
					$sqlResult = @sqlite_query($sqlQueryString);
					$sqlError  = @sqlite_last_error($this->_sqlDB);
					if(!$sqlResult){ $sqlResult = 'Invalid query: '.sqlite_error_string($sqlError); }
					//$uidExists = mysql_num_rows($sqlResult);
					break;
				
				case 'mssql':
					$sqlResult = @mssql_guid_string('');
					if(!$sqlResult)
						$sqlResult = 'Invalid query: '.$sqlQueryString;
					break;
			}
		}
		
		return $sqlUID;
	}
	
	
	
	/**
	 * Get sql server state
	 * 
	 * @return String
	 */
	function sqlGetStats(){
		switch($this->_sqlInterface){
			case 'mysql':
				$sqlStats = mysql_stat();
				break;
			
			case 'pgsql':
				$sqlStats = 'NOT YET IMPLEMENTED!';
				break;
			
			case 'mssql':
				$sqlStats = 'NOT YET IMPLEMENTED!';
				break;
		}
		
		return $sqlStats;
	}
	
	
	
	/**
	 * Delete Table
	 * 
	 * @param String $tableName
	 * @param Boolean $withDebug = false
	 * @return Boolean
	 */
	function sqlDeleteTable($tableName, $withDebug = false){
		global $tcms_time;
		
		switch($this->_sqlInterface){
			case 'mysql':
				$sql = 'DROP TABLE '.$tableName;
				
				if($withDebug) {
					$fp = fopen('log_deleteTable_'.microtime().'.txt', 'w');
					fwrite($fp, $sql);
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mysql_query($sqlQueryString);
				if(!$sqlResult)
					$sqlResult = 'Invalid query: ' . mysql_error();
				break;
			
			case 'pgsql':
				$sql = 'DROP TABLE '.$tableName;
				
				if($withDebug) {
					$fp = fopen('log_deleteTable_'.microtime().'.txt', 'w');
					fwrite($fp, $sql);
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = pg_query($sqlQueryString);
				if(!$sqlResult)
					$sqlResult = 'Invalid query: ' . pg_result_error();
				break;
			
			case 'sqlite':
				$sql = 'DROP TABLE '.$tableName;
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = sqlite_query($sqlQueryString);
				$sqlError  = sqlite_last_error($this->_sqlDB);
				if(!$sqlResult)
					$sqlResult = 'Invalid query: ' . sqlite_error_string($sqlError);
				break;
			
			case 'mssql':
				$sql = 'DROP TABLE ['.$tableName.']';
				
				if($withDebug) {
					$fp = fopen('log_deleteTable_'.microtime().'.txt', 'w');
					fwrite($fp, $sql);
					fclose($fp);
				}
				
				//tcms_time::tcms_query_counter();
				if($tcms_time != null) $tcms_time->incrmentSqlQueryCounter();
				
				$sqlResult = mssql_query($sqlQueryString);
				if(!$sqlResult)
					$sqlResult = 'Invalid query: ' . $sqlQueryString;
				break;
		}
		
		return $sqlResult;
	}
}

?>
