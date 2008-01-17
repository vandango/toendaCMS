<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| toendaCMS Import class
|
| File:	tcms_import.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Import class
 *
 * This class is used to provide a import class.
 *
 * @version 0.1.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * Methods
 * 
 * __construct                 -> Constructor
 * __destruct                  -> Destructor
 * 
 * setTcmsTimeObj              -> Set the tcms_time object
 *
 * importVCard                 -> Import a vcard
 * 
 * </code>
 *
 */


class tcms_import extends tcms_main {
	var $m_administer;
	var $m_charset;
	var $_tcmsTime;
	
	// database information
	var $db_choosenDB;
	var $db_user;
	var $db_pass;
	var $db_host;
	var $db_database;
	var $db_port;
	var $db_prefix;
	
	
	
	/**
	 * PHP5: Default constructor
	 *
	 * @param String $administer
	 * @param String $charset
	 * @param Object $tcmsTimeObj = null
	 */
	public function __construct($administer, $charset, $tcmsTimeObj = null){
		$this->m_administer = $administer;
		$this->administer = $administer;
		$this->m_charset = $charset;
		$this->_tcmsTime = $tcmsTimeObj;
		
		require($this->m_administer.'/tcms_global/database.php');
		
		$this->db_choosenDB = $tcms_db_engine;
		$this->db_user      = $tcms_db_user;
		$this->db_pass      = $tcms_db_password;
		$this->db_host      = $tcms_db_host;
		$this->db_database  = $tcms_db_database;
		$this->db_port      = $tcms_db_port;
		$this->db_prefix    = $tcms_db_prefix;
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	public function __destruct(){
	}
	
	
	
	/**
	 * Set the tcms_time object
	 *
	 * @param Object $value
	 */
	public function setTcmsTimeObj($value) {
		$this->_tcmsTime = $value;
	}
	
	
	
	/**
	 * Import a vcard
	 */
	public function importVCard() {
		if(substr($this->m_administer, 0, 6) == '../../') {
			$pathadd = '../../cache/__vcard.vcf';
		}
		else {
			$pathadd = 'cache/__vcard.vcf';
		}
		
		$file = new tcms_file($pathadd, 'r');
		
		// parse vcard file
		while(!$file->IsEOF()) {
			$line = $file->readLine();
			//echo $line.'<br />';
			
			
			// name
			if(substr($line, 0, 3) == 'FN:') {
				$arr_con['name'] = substr($line, 3);
			}
			
			
			// position
			if(substr($line, 0, 6) == 'TITLE:') {
				$arr_con['position'] = substr($line, 6);
			}
			
			
			// street
			if(substr($line, 0, 14) == 'ADR;WORK;PREF:') {
				$arr_splitter = substr($line, 13);
				
				$arr_split = explode(';', $arr_splitter);
				
				$arr_con['street'] = $arr_split[2];
				$arr_con['city'] = $arr_split[3];
				$arr_con['state'] = $arr_split[4];
				$arr_con['zip'] = $arr_split[5];
				$arr_con['country'] = $arr_split[6];
			}
			elseif(substr($line, 0, 42) == 'ADR;HOME;POSTAL;ENCODING=QUOTED-PRINTABLE:') {
				$arr_splitter = substr($line, 42);
				
				$arr_split = explode(';', $arr_splitter);
				
				$arr_con['street'] = $arr_split[2];
				$arr_con['city'] = $arr_split[3];
				$arr_con['state'] = $arr_split[4];
				$arr_con['zip'] = $arr_split[5];
				$arr_con['country'] = $arr_split[6];
			}
			else if(substr($line, 0, 16) == 'ADR;HOME;POSTAL:') {
				$arr_splitter = substr($line, 16);
				
				$arr_split = explode(';', $arr_splitter);
				
				$arr_con['street'] = $arr_split[2];
				$arr_con['city'] = $arr_split[3];
				$arr_con['state'] = $arr_split[4];
				$arr_con['zip'] = $arr_split[5];
				$arr_con['country'] = $arr_split[6];
			}
			
			
			// email
			if(substr($line, 0, 20) == 'EMAIL;PREF;INTERNET:') {
				$arr_con['email'] = substr($line, 20);
			}
			elseif(substr($line, 0, 15) == 'EMAIL;INTERNET:') {
				$arr_con['email'] = substr($line, 15);
			}
			
			
			// fon
			if(substr($line, 0, 46) == 'TEL;PREF;HOME;VOICE;ENCODING=QUOTED-PRINTABLE:') {
				$arr_con['fon'] = substr($line, 46);
			}
			elseif(substr($line, 0, 20) == 'TEL;PREF;HOME;VOICE:') {
				$arr_con['fon'] = substr($line, 20);
			}
		}
		
		$file->close();
		
		if(empty($arr_con['name'])     || $arr_con['name']     == '') $arr_con['name']     = '';
		if(empty($arr_con['position']) || $arr_con['position'] == '') $arr_con['position'] = '';
		if(empty($arr_con['email'])    || $arr_con['email']    == '') $arr_con['email']    = '';
		if(empty($arr_con['street'])   || $arr_con['street']   == '') $arr_con['street']   = '';
		if(empty($arr_con['country'])  || $arr_con['country']  == '') $arr_con['country']  = '';
		if(empty($arr_con['state'])    || $arr_con['state']    == '') $arr_con['state']    = '';
		if(empty($arr_con['city'])     || $arr_con['city']     == '') $arr_con['city']     = '';
		if(empty($arr_con['zip'])      || $arr_con['zip']      == '') $arr_con['zip']      = '';
		if(empty($arr_con['fon'])      || $arr_con['fon']      == '') $arr_con['fon']      = '';
		
		// generate contact
		$id = $this->getNewUID(10, 'contacts');
		
		if($this->db_choosenDB == 'xml'){
			$arr_con['name']     = $this->encodeText($arr_con['name'], '2', $this->m_charset);
			$arr_con['position'] = $this->encodeText($arr_con['position'], '2', $this->m_charset);
			$arr_con['email']    = $this->encodeText($arr_con['email'], '2', $this->m_charset);
			$arr_con['street']   = $this->encodeText($arr_con['street'], '2', $this->m_charset);
			$arr_con['country']  = $this->encodeText($arr_con['country'], '2', $this->m_charset);
			$arr_con['state']    = $this->encodeText($arr_con['state'], '2', $this->m_charset);
			$arr_con['city']     = $this->encodeText($arr_con['city'], '2', $this->m_charset);
			$arr_con['zip']      = $this->encodeText($arr_con['zip'], '2', $this->m_charset);
			$arr_con['fon']      = $this->encodeText($arr_con['fon'], '2', $this->m_charset);
			
			$xmlcon = new xmlparser($this->m_administer.'/tcms_contacts/'.$id.'.xml', 'w');
			$xmlcon->xml_declaration();
			$xmlcon->xml_section('contact');
			
			$xmlcon->write_value('default_con', '0');
			$xmlcon->write_value('published', '0');
			$xmlcon->write_value('name', $arr_con['name']);
			$xmlcon->write_value('position', $arr_con['position']);
			$xmlcon->write_value('email', $arr_con['email']);
			$xmlcon->write_value('street', $arr_con['street']);
			$xmlcon->write_value('country', $arr_con['country']);
			$xmlcon->write_value('state', $arr_con['state']);
			$xmlcon->write_value('town', $arr_con['city']);
			$xmlcon->write_value('postal', $arr_con['zip']);
			$xmlcon->write_value('phone', $arr_con['fon']);
			$xmlcon->write_value('fax', '');
			
			$xmlcon->xml_section_buffer();
			$xmlcon->xml_section_end('contact');
			$xmlcon->flush();
			$xmlcon->_xmlparser();
			unset($xmlcon);
		}
		else {
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->db_user, 
				$this->db_pass, 
				$this->db_host, 
				$this->db_database, 
				$this->db_port
			);
			
			switch($this->db_choosenDB){
				case 'mysql':
					$newSQLColumns = '`default_con`, `published`, `name`, `position`, `email`, '
					.'`street`, `country`, `state`, `town`, `postal`, `phone`, `fax`';
					break;
				
				case 'pgsql':
					$newSQLColumns = 'default_con, published, name, "position", email, street, '
					.'country, state, town, postal, phone, fax';
					break;
				
				case 'mssql':
					$newSQLColumns = '[default_con], [published], [name], [position], [email], '
					.'[street], [country], [state], [town], [postal], [phone], [fax]';
					break;
			}
			
			$newSQLData = "0, 0, '".$arr_con['name']."', '".$arr_con['position']."', "
			."'".$arr_con['email']."', '".$arr_con['street']."', '".$arr_con['country']."', "
			."'".$arr_con['state']."', '".$arr_con['city']."', '".$arr_con['zip']."', "
			."'".$arr_con['fon']."', ''";
			
			$sqlQR = $sqlAL->createOne($this->db_prefix.'contacts', $newSQLColumns, $newSQLData, $id);
		}
	}
}

?>
