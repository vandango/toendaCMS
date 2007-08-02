<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS SQL Database Dump
|
| File:	tcms_sql_dump.lib.php
+
*/


defined('_TCMS_VALID') or die('Restricted access');

/**
 * toendaCMS SQL Database Dump
 *
 * This class is used for a complete database backup dump.
 *
 * @version 0.0.5
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
 * tcms_sql_dump()                     -> PHP4 Default constructor
 * __destruct()                        -> PHP5 Default destructor
 * _tcms_sql_dump()                    -> PHP4 Default destructor
 *
 *--------------------------------------------------------
 * MAIN FUNCTIONS
 *--------------------------------------------------------
 *
 * MySQLBackup()                       -> Creates an backup dump of a database
 * 
 */


class tcms_sql_dump {
	private $cms_ver;
	private $cms_build;
	
	
	
	/**
	 * PHP5 Default constructor
	 */
	function __construct(){
		include_once('../tcms_kernel/tcms_xml.lib.php');
		
		$xml = new xmlparser('../tcms_kernel/tcms_version.xml','r');
		$this->cms_ver   = $xml->read_section('version', 'release');
		$this->cms_build = $xml->read_section('version', 'build');
	}
	
	
	
	/**
	 * PHP4 Default constructor
	 */
	function tcms_sql_dump(){
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
	function _tcms_sql_dump(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Creates an backup dump of a database
	 * 
	 * @param String $host
	 * @param String $dbname
	 * @param String $uid
	 * @param String $pwd
	 * @param Boolean $structure_only
	 */
	function MySQLBackup($host, $dbname, $uid, $pwd, $structure_only = false){
		$crlf = "\r\n";
		
		$con = @mysql_connect($host, $uid, $pwd) or die("Could not connect");
		$db = @mysql_select_db($dbname, $con) or die("Could not select db");
		
		$result = @mysql_query("SELECT VERSION() AS version");
		
		if($result != FALSE && @mysql_num_rows($result) > 0){
			$row = @mysql_fetch_array($result);
			$match = explode('.', $row['version']);
		}
		else{
			$result=@mysql_query("SHOW VARIABLES LIKE \'version\'");
			
			if($result != FALSE && @mysql_num_rows($result) > 0){
				$row = @mysql_fetch_row($result);
				$match = explode('.', $row[1]);
			}
		}
		
		if(!isset($match) || !isset($match[0])){
			$match[0] = 3;
		}
		
		if (!isset($match[1])) {
			$match[1] = 21;
		}
		
		if (!isset($match[2])) {
			$match[2] = 0;
		}
		
		if(!isset($row)) {
			$row = '3.21.0';
		}
		
		define('MYSQL_INT_VERSION', (int)sprintf('%d%02d%02d', $match[0], $match[1], intval($match[2])));
		define('MYSQL_STR_VERSION', $row['version']);
		unset($match);
		
		$sql = "#--------------------------------------------------------------------".$crlf;
		$sql.= "# toendaCMS MySQL Database Backup".$crlf;
		$sql.= "#".$crlf;
		$sql.= "# This is a backup file generated by toendaCMS".$crlf;
		$sql.= "# http://www.toenda.com".$crlf;
		$sql.= "#".$crlf;
		$sql.= "# Backup Date: ".gmdate('d-m-Y H:i:s', time())." GMT".$crlf;
		$sql.= "#".$crlf;
		$sql.= "# WARNING: Only try to restore on servers running the exact same version of toendaCMST".$crlf;
		$sql.= "#".$crlf;
		$sql.= "# toendaCMS version ".$this->cms_ver." - build".$this->cms_build.$crlf;
		$sql.= "#".$crlf;
		$sql.= "# Host: $host Database: $dbname".$crlf;
		$sql.= "#".$crlf;
		$sql.= "# Server version: ".MYSQL_STR_VERSION.$crlf;
		
		$sql.= $crlf.$crlf.$crlf;
		
		//out($sql);
		
		$res = @mysql_list_tables($dbname);
		$nt = @mysql_num_rows($res);
		
		for ($a=0;$a<$nt;$a++) {
			$row=mysql_fetch_row($res);
			$tablename=$row[0];
			
			$sql .= $crlf."# ----------------------------------------".$crlf."# table structure for table '$tablename' ".$crlf;
			
			// For MySQL < 3.23.20  
			if (MYSQL_INT_VERSION >= 32321) {
				$result=mysql_query("SHOW CREATE TABLE $tablename");
				
				if ($result != FALSE && mysql_num_rows($result) > 0) {
					$tmpres = mysql_fetch_array($result);
					$pos           = strpos($tmpres[1], ' (');
					$tmpres[1]     = substr($tmpres[1], 0, 13).$tmpres[0].substr($tmpres[1], $pos);
					$sql .= $tmpres[1].";".$crlf.$crlf;
				}
				
				mysql_free_result($result);
			}
			else {
				$sql.="CREATE TABLE $tablename(".$crlf;  
				$result=mysql_query("show fields  from $tablename",$con);  
				
				while ($row = mysql_fetch_array($result)) {
					$sql .= "  ".$row['Field'];
					$sql .= ' ' . $row['Type'];
					
					if (isset($row['Default']) && $row['Default'] != '') {
						$sql .= ' DEFAULT \'' . $row['Default'] . '\'';
					}
					
					if ($row['Null'] != 'YES') {
						$sql .= ' NOT NULL';
					}
					
					if ($row['Extra'] != '') {
						$sql .= ' ' . $row['Extra'];
					}
					
					$sql .= ",".$crlf;
				}
				
				mysql_free_result($result);
				$sql = ereg_replace(',' . $crlf . '$', '', $sql);
				
				$result = mysql_query("SHOW KEYS FROM $tablename");
				
				while ($row = mysql_fetch_array($result)) {
					$ISkeyname    = $row['Key_name'];
					$IScomment  = (isset($row['Comment'])) ? $row['Comment'] : '';
					$ISsub_part = (isset($row['Sub_part'])) ? $row['Sub_part'] : '';
					
					if ($ISkeyname != 'PRIMARY' && $row['Non_unique'] == 0) {
						$ISkeyname = "UNIQUE|$kname";
					}
					
					if ($IScomment == 'FULLTEXT') {
						$ISkeyname = 'FULLTEXT|$kname';
					}
					
					if (!isset($index[$ISkeyname])) {
						$index[$ISkeyname] = array();
					}
					
					if ($ISsub_part > 1) {
						$index[$ISkeyname][] = $row['Column_name'] . '(' . $ISsub_part . ')';
					} else {
						$index[$ISkeyname][] = $row['Column_name'];
					}
				}
				
				mysql_free_result($result);
				
				while (list($x, $columns) = @each($index)) {
					$sql     .= ",".$crlf;
					
					if ($x == 'PRIMARY') {
						$sql .= '  PRIMARY KEY (';
					} else if (substr($x, 0, 6) == 'UNIQUE') {
						$sql .= '  UNIQUE ' . substr($x, 7) . ' (';
					} else if (substr($x, 0, 8) == 'FULLTEXT') {
						$sql .= '  FULLTEXT ' . substr($x, 9) . ' (';
					} else {
						$sql .= '  KEY ' . $x . ' (';
					}
					
					$sql     .= implode($columns, ', ') . ')';
				}
				
				$sql .=  $crlf.");".$crlf.$crlf;
			}
			
			//out($sql);
			
			if(!$structure_only){
				$result = mysql_query("SELECT * FROM  $tablename");
				$fields_cnt   = mysql_num_fields($result);
				
				while ($row = mysql_fetch_row($result)) {
					$table_list     = '(';
					
					for ($j = 0; $j < $fields_cnt; $j++) {
						$table_list .= mysql_field_name($result, $j) . ', ';
					}
					
					$table_list = substr($table_list, 0, -2);
					$table_list     .= ')';
					
					$sql .= 'INSERT INTO ' . $tablename . ' VALUES (';
					
					for ($j = 0; $j < $fields_cnt; $j++) {
						if (!isset($row[$j])) {
							$sql .= ' NULL, ';
						} else if ($row[$j] == '0' || $row[$j] != '') {
							$type          = mysql_field_type($result, $j);
							
							// a number
							if ($type == 'tinyint' || $type == 'smallint' || $type == 'mediumint' || $type == 'int' || $type == 'bigint'  ||$type == 'timestamp') {
								$sql .= $row[$j] . ', ';
							}
							// a string
							else {
								$dummy  = '';
								$srcstr = $row[$j];
								
								for ($xx = 0; $xx < strlen($srcstr); $xx++) {
									$yy = strlen($dummy);
									if ($srcstr[$xx] == '\\')   $dummy .= '\\\\';
									if ($srcstr[$xx] == '\'')   $dummy .= '\\\'';
									if ($srcstr[$xx] == "\x00") $dummy .= '\0';
									if ($srcstr[$xx] == "\x0a") $dummy .= '\n';
									if ($srcstr[$xx] == "\x0d") $dummy .= '\r';
									if ($srcstr[$xx] == "\x1a") $dummy .= '\Z';
									if (strlen($dummy) == $yy)  $dummy .= $srcstr[$xx];
								}
								
								$sql .= "'" . $dummy . "', ";
							}
						} else {
							$sql .= "'', ";
						} // end if
					} // end for
					
					$sql = ereg_replace(', $', '', $sql);
					$sql .= ");".$crlf;
					//out($sql);
				}
				
				mysql_free_result($result);
			}
		}
		
		return $sql;
	}
}


?>