<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Account Provider
|
| File:	tcms_account_provider.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Account Provider
 * 
 * This class is used to provide methods to get and
 * save user accounts and also contacts.
 * 
 * @version 0.2.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 * 
 * <code>
 * 
 * Methods
 *
 * __construct                 -> PHP5 Constructor
 * tcms_account_provider       -> PHP4 Constructor
 * __destruct                  -> PHP5 Destructor
 * _tcms_account_provider      -> PHP4 Destructor
 *
 * getAccount                  -> Get a user account
 * getAccountByUsername        -> Get a user account by username
 * checkUserExists             -> Check if a user exist
 * createNewUser               -> Create a new user
 * saveAccount                 -> Save a account
 * getContact                  -> Get a contact item
 * 
 * </code>
 *
 */


class tcms_account_provider extends tcms_main {
	var $m_administer;
	var $m_charset;
	
	// database information
	var $db_choosenDB;
	var $db_user;
	var $db_pass;
	var $db_host;
	var $db_database;
	var $db_port;
	var $db_prefix;
	
	
	
	/**
	 * PHP5 Constructor
	 *
	 * @param String $administer
	 * @param String $charset
	 */
	function __construct($administer, $charset){
		$this->m_administer = $administer;
		$this->administer = $administer;
		$this->m_charset = $charset;
		
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
	 * PHP4 Constructor
	 *
	 * @param String $administer
	 * @param String $charset
	 */
	function tcms_account_provider($administer, $charset){
		$this->__construct($administer, $charset);
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_account_provider(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Get a user account
	 *
	 * @param String $id
	 * @return tcms_dc_account
	 */
	function getAccount($id){
		if($this->db_choosenDB == 'xml'){
			$xml = new xmlparser($this->m_administer.'/tcms_user/'.$id.'.xml', 'r');
			
			$wsID = $id;
			$wsUsername   = $xml->read_section('user', 'username');
			$wsPassword   = $xml->read_section('user', 'password');
			$wsEmail      = $xml->read_section('user', 'email');
			$wsName       = $xml->read_section('user', 'name');
			$wsGroup      = $xml->read_section('user', 'group');
			$wsJoinDate   = $xml->read_section('user', 'join_date');
			$wsLastLogin  = $xml->read_section('user', 'last_login');
			$wsBirthday   = $xml->read_section('user', 'birthday');
			$wsGender     = $xml->read_section('user', 'gender');
			$wsOccupation = $xml->read_section('user', 'occupation');
			$wsHomepage   = $xml->read_section('user', 'homepage');
			$wsICQ        = $xml->read_section('user', 'icq');
			$wsAIM        = $xml->read_section('user', 'aim');
			$wsYIM        = $xml->read_section('user', 'yim');
			$wsMSN        = $xml->read_section('user', 'msn');
			$wsSkype      = $xml->read_section('user', 'skype');
			$wsEnabled    = $xml->read_section('user', 'enabled');
			$wsScEnabled  = $xml->read_section('user', 'tcms_enabled');
			$wsStaticVal  = $xml->read_section('user', 'static_value');
			$wsSignature  = $xml->read_section('user', 'signature');
			$wsLocation   = $xml->read_section('user', 'location');
			$wsHobby      = $xml->read_section('user', 'hobby');
			
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			if($wsID         == false) $wsID         = '';
			if($wsUsername   == false) $wsUsername   = '';
			if($wsEmail      == false) $wsEmail      = '';
			if($wsName       == false) $wsName       = '';
			if($wsGroup      == false) $wsGroup      = 'User';
			if($wsJoinDate   == false) $wsJoinDate   = '';
			if($wsLastLogin  == false) $wsLastLogin  = '';
			if($wsBirthday   == false) $wsBirthday   = '';
			if($wsGender     == false) $wsGender     = '';
			if($wsOccupation == false) $wsOccupation = '';
			if($wsHomepage   == false) $wsHomepage   = '';
			if($wsICQ        == false) $wsICQ        = '';
			if($wsAIM        == false) $wsAIM        = '';
			if($wsYIM        == false) $wsYIM        = '';
			if($wsMSN        == false) $wsMSN        = '';
			if($wsSkype      == false) $wsSkype      = '';
			//if($wsEnabled    == false) $wsEnabled    = '';
			//if($wsScEnabled  == false) $wsScEnabled  = '';
			//if($wsStaticVal  == false) $wsStaticVal  = '';
			if($wsSignature  == false) $wsSignature  = '';
			if($wsLocation   == false) $wsLocation   = '';
			if($wsHobby      == false) $wsHobby      = '';
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->db_user, $this->db_pass, $this->db_host, $this->db_database, $this->db_port);
			
			$sqlStr = "SELECT * "
			."FROM ".$this->db_prefix."user "
			."WHERE uid = '".$id."'";
			
			$sqlQR = $sqlAL->sqlQuery($sqlStr);
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
			$wsID         = $sqlObj->uid;
			$wsPassword   = $sqlObj->password;
			$wsUsername   = $sqlObj->username;
			$wsEmail      = $sqlObj->email;
			$wsName       = $sqlObj->name;
			$wsGroup      = $sqlObj->group;
			$wsJoinDate   = $sqlObj->join_date;
			$wsLastLogin  = $sqlObj->last_login;
			$wsBirthday   = $sqlObj->birthday;
			$wsGender     = $sqlObj->gender;
			$wsOccupation = $sqlObj->occupation;
			$wsHomepage   = $sqlObj->homepage;
			$wsICQ        = $sqlObj->icq;
			$wsAIM        = $sqlObj->aim;
			$wsYIM        = $sqlObj->yim;
			$wsMSN        = $sqlObj->msn;
			$wsSkype      = $sqlObj->skype;
			$wsEnabled    = $sqlObj->enabled;
			$wsScEnabled  = $sqlObj->tcms_enabled;
			$wsStaticVal  = $sqlObj->static_value;
			$wsSignature  = $sqlObj->signature;
			$wsLocation   = $sqlObj->location;
			$wsHobby      = $sqlObj->hobby;
			
			$sqlAL->sqlFreeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			if($wsID         == NULL) $wsID         = '';
			if($wsUsername   == NULL) $wsUsername   = '';
			if($wsEmail      == NULL) $wsEmail      = '';
			if($wsName       == NULL) $wsName       = '';
			if($wsGroup      == NULL) $wsGroup      = 'User';
			if($wsJoinDate   == NULL) $wsJoinDate   = '';
			if($wsLastLogin  == NULL) $wsLastLogin  = '';
			if($wsBirthday   == NULL) $wsBirthday   = '';
			if($wsGender     == NULL) $wsGender     = '';
			if($wsOccupation == NULL) $wsOccupation = '';
			if($wsHomepage   == NULL) $wsHomepage   = '';
			if($wsICQ        == NULL) $wsICQ        = '';
			if($wsAIM        == NULL) $wsAIM        = '';
			if($wsYIM        == NULL) $wsYIM        = '';
			if($wsMSN        == NULL) $wsMSN        = '';
			if($wsSkype      == NULL) $wsSkype      = '';
			//if($wsEnabled    == NULL) $wsEnabled    = '';
			//if($wsScEnabled  == NULL) $wsScEnabled  = '';
			//if($wsStaticVal  == NULL) $wsStaticVal  = '';
			if($wsSignature  == NULL) $wsSignature  = '';
			if($wsLocation   == NULL) $wsLocation   = '';
			if($wsHobby      == NULL) $wsHobby      = '';
		}
		
		$wsUsername   = $this->decodeText($wsUsername, '2', $this->m_charset);
		$wsName       = $this->decodeText($wsName, '2', $this->m_charset);
		$wsOccupation = $this->decodeText($wsOccupation, '2', $this->m_charset);
		$wsSignature  = $this->decodeText($wsSignature, '2', $this->m_charset);
		$wsLocation   = $this->decodeText($wsLocation, '2', $this->m_charset);
		$wsHobby      = $this->decodeText($wsHobby, '2', $this->m_charset);
		
		$accDC = new tcms_dc_account();
		
		$accDC->SetID($wsID);
		$accDC->SetUsername($wsUsername);
		$accDC->SetPassword($wsPassword);
		$accDC->SetEmail($wsEmail);
		$accDC->SetName($wsName);
		$accDC->SetGroup($wsGroup);
		$accDC->SetJoinDate($wsJoinDate);
		$accDC->SetLastLogin($wsLastLogin);
		$accDC->SetBirthday($wsBirthday);
		$accDC->SetGender($wsGender);
		$accDC->SetOccupation($wsOccupation);
		$accDC->SetHomepage($wsHomepage);
		$accDC->SetICQ($wsICQ);
		$accDC->SetAIM($wsAIM);
		$accDC->SetYIM($wsYIM);
		$accDC->SetMSN($wsMSN);
		$accDC->SetSkype($wsSkype);
		$accDC->SetEnabled($wsEnabled);
		$accDC->SetTCMSScriptEnabled($wsScEnabled);
		$accDC->SetStaticValue($wsStaticVal);
		$accDC->SetSignature($wsSignature);
		$accDC->SetLocation($wsLocation);
		$accDC->SetHobby($wsHobby);
		
		return $accDC;
	}
	
	
	
	/**
	 * Get a user account by username
	 *
	 * @param String $username
	 * @return tcms_dc_account
	 */
	function getAccountByUsername($username){
		$accDC = new tcms_dc_account();
		
		$id = $this->getUserID($username);
		$accDC = $this->getAccount($id);
		
		return $accDC;
	}
	
	
	
	/**
	 * Check if a user exist
	 *
	 * @param String $id
	 * @return Boolean
	 */
	function checkUserExists($id) {
		if($this->db_choosenDB == 'xml'){
			if(file_exists($this->m_administer.'/tcms_user/'.$id.'.xml')) {
				return true;
			}
			else {
				return false;
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->db_user, $this->db_pass, $this->db_host, $this->db_database, $this->db_port);
			
			$sqlQR = $sqlAL->sqlGetOne($this->db_prefix.'user', $id);
			$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
			
			if($sqlNR > 0) {
				return true;
			}
			else{
				return false;
			}
		}
	}
	
	
	
	/**
	 * Create a new user
	 *
	 * @param tcms_dc_account $acc
	 */
	function createNewUser($acc) {
		$this->saveAccount($acc, false);
	}
	
	
	/**
	 * Save a account
	 *
	 * @param tcms_dc_account $acc
	 * @param Boolean $saveAsUpdate = true
	 */
	function saveAccount($acc, $saveAsUpdate = true) {
		$new_name      = $this->encodeText($acc->GetName(), '2', $this->m_charset);
		$new_username  = $this->encodeText($acc->GetUsername(), '2', $this->m_charset);
		$new_occ       = $this->encodeText($acc->GetOccupation(), '2', $this->m_charset);
		$new_signature = $this->encodeText($acc->GetSignature(), '2', $this->m_charset);
		$new_location  = $this->encodeText($acc->GetLocation(), '2', $this->m_charset);
		$new_hobby     = $this->encodeText($acc->GetHobby(), '2', $this->m_charset);
		
		if($this->db_choosenDB == 'xml'){
			$xmluser = new xmlparser($this->m_administer.'/tcms_user/'.$acc->GetID().'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('user');
			
			$xmluser->write_value('name', $new_name);
			$xmluser->write_value('username', $new_username);
			$xmluser->write_value('password', $acc->GetPassword());
			$xmluser->write_value('email', $acc->GetEmail());
			$xmluser->write_value('group', $acc->GetGroup());
			$xmluser->write_value('last_login', $acc->GetLastLogin());
			$xmluser->write_value('join_date', $acc->GetJoinDate());
			$xmluser->write_value('homepage', $acc->GetHomepage());
			$xmluser->write_value('icq', $acc->GetICQ());
			$xmluser->write_value('aim', $acc->GetAIM());
			$xmluser->write_value('yim', $acc->GetYIM());
			$xmluser->write_value('msn', $acc->GetMSN());
			$xmluser->write_value('skype', $acc->GetSkype());
			$xmluser->write_value('birthday', $acc->GetBirthday());
			$xmluser->write_value('gender', $acc->GetGender());
			$xmluser->write_value('occupation', $new_occ);
			$xmluser->write_value('enabled', $acc->GetEnabled());
			$xmluser->write_value('tcms_enabled', $acc->GetTCMSScriptEnabled());
			$xmluser->write_value('static_value', $acc->GetStaticValue());
			$xmluser->write_value('signature', $new_signature);
			$xmluser->write_value('location', $new_location);
			$xmluser->write_value('hobby', $new_hobby);
			
			$xmluser->xml_section_buffer();
			$xmluser->xml_section_end('user');
			$xmluser->_xmlparser();
			
			if(!$saveAsUpdate) {
				// notebook
				$xmluser = new xmlparser($this->m_administer.'/tcms_notepad/'.$acc->GetID().'.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section('note');
				
				$xmluser->write_value('name', $new_username);
				$xmluser->write_value('text', '');
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end('note');
				$xmluser->_xmlparser();
			}
			
			unset($xmluser);
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->db_user, $this->db_pass, $this->db_host, $this->db_database, $this->db_port);
			
			if($saveAsUpdate) {
				$newSQLData = ''
				.$this->db_prefix.'user.name="'.$new_name.'", '
				.$this->db_prefix.'user.username="'.$new_username.'", '
				.$this->db_prefix.'user.password="'.$acc->GetPassword().'", '
				.$this->db_prefix.'user.email="'.$acc->GetEmail().'", '
				.$this->db_prefix.'user.group="'.$acc->GetGroup().'", '
				.$this->db_prefix.'user.last_login="'.$acc->GetLastLogin().'", '
				.$this->db_prefix.'user.join_date="'.$acc->GetJoinDate().'", '
				.$this->db_prefix.'user.birthday="'.$acc->GetBirthday().'", '
				.$this->db_prefix.'user.gender="'.$acc->GetGender().'", '
				.$this->db_prefix.'user.occupation="'.$new_occ.'", '
				.$this->db_prefix.'user.homepage="'.$acc->GetHomepage().'", '
				.$this->db_prefix.'user.icq="'.$acc->GetICQ().'", '
				.$this->db_prefix.'user.aim="'.$acc->GetAIM().'", '
				.$this->db_prefix.'user.yim="'.$acc->GetYIM().'", '
				.$this->db_prefix.'user.msn="'.$acc->GetMSN().'", '
				.$this->db_prefix.'user.skype="'.$acc->GetSkype().'", '
				.$this->db_prefix.'user.enabled='.$acc->GetEnabled().', '
				.$this->db_prefix.'user.tcms_enabled='.$acc->GetTCMSScriptEnabled().', '
				.$this->db_prefix.'user.static_value='.$acc->GetStaticValue().', '
				.$this->db_prefix.'user.signature="'.$new_signature.'", '
				.$this->db_prefix.'user.location="'.$new_location.'", '
				.$this->db_prefix.'user.hobby="'.$new_hobby.'"';
				
				$sqlQR = $sqlAL->sqlUpdateOne($this->db_prefix.'user', $newSQLData, $acc->GetID());
			}
			else {
				switch($this->db_choosenDB){
					case 'mysql':
						$newSQLColumns = '`name`, `username`, `password`, `email`, `group`, `last_login`, '
						.'`join_date`, `birthday`, `gender`, `occupation`, `homepage`, `icq`, `aim`, `yim`, '
						.'`msn`, `skype`, `enabled`, `tcms_enabled`, `static_value`, `signature`, `location`, '
						.'`hobby`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'name, username, "password", email, "group", last_login, join_date, '
						.'birthday, gender, occupation, homepage, icq, aim, yim, msn, '
						.'skype, enabled, tcms_enabled, static_value, signature, "location", hobby';
						break;
					
					case 'mssql':
						$newSQLColumns = '[name], [username], [password], [email], [group], [last_login], '
						.'[join_date], [birthday], [gender], [occupation], [homepage], [icq], [aim], [yim], '
						.'[msn], [skype], [enabled], [tcms_enabled], [static_value], [signature], [location], '
						.'[hobby]';
						break;
				}
				
				$newSQLData = "'".$new_name."', "
				."'".$new_username."', "
				."'".$acc->GetPassword()."', "
				."'".$acc->GetEmail()."', "
				."'".$acc->GetGroup()."', "
				."'".$acc->GetLastLogin()."', "
				."'".$acc->GetJoinDate()."', "
				."'".$acc->GetBirthday()."', "
				."'".$acc->GetGender()."', "
				."'".$new_occ."', "
				."'".$acc->GetHomepage()."', "
				."'".$acc->GetICQ()."', "
				."'".$acc->GetAIM()."', "
				."'".$acc->GetYIM()."', "
				."'".$acc->GetMSN()."', "
				."'".$acc->GetSkype()."', "
				."".$acc->GetEnabled().", "
				."".$acc->GetTCMSScriptEnabled().", "
				."0, "
				."'".$new_signature."', "
				."'".$new_location."', "
				."'".$new_hobby."'";
				
				$sqlQR = $sqlAL->sqlCreateOne($this->db_prefix.'user', $newSQLColumns, $newSQLData, $acc->GetID());
				
				// notebook
				switch($this->db_choosenDB){
					case 'mysql':
						$newSQLColumns = '`name`, `note`';
						break;
					
					case 'pgsql':
						$newSQLColumns = 'name, note';
						break;
					
					case 'mssql':
						$newSQLColumns = '[name], [note]';
						break;
				}
				
				$newSQLData = "'".$new_username."', ''";
				
				$sqlQR = $sqlAL->sqlCreateOne($this->db_prefix.'notepad', $newSQLColumns, $newSQLData, $acc->GetID());
			}
		}
	}
	
	
	
	
	/**
	 * Get a contact item
	 *
	 * @param String $id
	 * @return tcms_dc_contact
	 */
	function getContact($id){
		if($this->db_choosenDB == 'xml'){
			$xml = new xmlparser($this->m_administer.'/tcms_contacts/'.$id.'.xml','r');
			$tc_defcon   = $xml->read_section('contact', 'default_con');
			$tc_pub      = $xml->read_section('contact', 'published');
			$tc_name     = $xml->read_section('contact', 'name');
			$tc_position = $xml->read_section('contact', 'position');
			$tc_email    = $xml->read_section('contact', 'email');
			$tc_street   = $xml->read_section('contact', 'street');
			$tc_country  = $xml->read_section('contact', 'country');
			$tc_state    = $xml->read_section('contact', 'state');
			$tc_town     = $xml->read_section('contact', 'town');
			$tc_postal   = $xml->read_section('contact', 'postal');
			$tc_phone    = $xml->read_section('contact', 'phone');
			$tc_fax      = $xml->read_section('contact', 'fax');
			$xml->flush();
			$xml->_xmlparser();
			unset($xml);
			
			//if($tc_defcon   == false){ $tc_defcon   = ''; }
			//if($tc_pub      == false){ $tc_pub      = ''; }
			if($tc_name     == false){ $tc_name     = ''; }
			if($tc_position == false){ $tc_position = ''; }
			if($tc_email    == false){ $tc_email    = ''; }
			if($tc_street   == false){ $tc_street   = ''; }
			if($tc_country  == false){ $tc_country  = ''; }
			if($tc_state    == false){ $tc_state    = ''; }
			if($tc_town     == false){ $tc_town     = ''; }
			if($tc_postal   == false){ $tc_postal   = ''; }
			if($tc_phone    == false){ $tc_phone    = ''; }
			if($tc_fax      == false){ $tc_fax      = ''; }
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB);
			$sqlCN = $sqlAL->sqlConnect($this->db_user, $this->db_pass, $this->db_host, $this->db_database, $this->db_port);
			
			$sqlQR = $sqlAL->sqlGetOne($this->db_prefix.'contacts', $id);
			$sqlObj = $sqlAL->sqlFetchObject($sqlQR);
			
			$tc_defcon   = $sqlObj->default_con;
			$tc_pub      = $sqlObj->published;
			$tc_name     = $sqlObj->name;
			$tc_position = $sqlObj->position;
			$tc_email    = $sqlObj->email;
			$tc_street   = $sqlObj->street;
			$tc_country  = $sqlObj->country;
			$tc_state    = $sqlObj->state;
			$tc_town     = $sqlObj->town;
			$tc_postal   = $sqlObj->postal;
			$tc_phone    = $sqlObj->phone;
			$tc_fax      = $sqlObj->fax;
			
			$sqlAL->sqlFreeResult($sqlQR);
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
			
			//if($tc_defcon   == NULL){ $tc_defcon   = ''; }
			//if($tc_pub      == NULL){ $tc_pub      = ''; }
			if($tc_name     == NULL){ $tc_name     = ''; }
			if($tc_position == NULL){ $tc_position = ''; }
			if($tc_email    == NULL){ $tc_email    = ''; }
			if($tc_street   == NULL){ $tc_street   = ''; }
			if($tc_country  == NULL){ $tc_country  = ''; }
			if($tc_state    == NULL){ $tc_state    = ''; }
			if($tc_town     == NULL){ $tc_town     = ''; }
			if($tc_postal   == NULL){ $tc_postal   = ''; }
			if($tc_phone    == NULL){ $tc_phone    = ''; }
			if($tc_fax      == NULL){ $tc_fax      = ''; }
		}
		
		$tc_name     = $this->decodeText($tc_name, '2', $this->m_charset);
		$tc_position = $this->decodeText($tc_position, '2', $this->m_charset);
		$tc_email    = $this->decodeText($tc_email, '2', $this->m_charset);
		$tc_street   = $this->decodeText($tc_street, '2', $this->m_charset);
		$tc_country  = $this->decodeText($tc_country, '2', $this->m_charset);
		$tc_state    = $this->decodeText($tc_state, '2', $this->m_charset);
		$tc_town     = $this->decodeText($tc_town, '2', $this->m_charset);
		$tc_postal   = $this->decodeText($tc_postal, '2', $this->m_charset);
		$tc_phone    = $this->decodeText($tc_phone, '2', $this->m_charset);
		$tc_fax      = $this->decodeText($tc_fax, '2', $this->m_charset);
		
		//$arr_names = explode(' ', $tc_name);
		
		$dcCon = new tcms_dc_contact();
		
		$dcCon->setID($id);
		$dcCon->setName($tc_name);
		//$dcCon->setFirstname($arr_names[0]);
		//$dcCon->setLastname($arr_names[1]);
		$dcCon->setPosition($tc_position);
		$dcCon->setEmail($tc_email);
		$dcCon->setStreet($tc_street);
		$dcCon->setCountry($tc_country);
		$dcCon->setState($tc_state);
		$dcCon->setCity($tc_town);
		$dcCon->setZipcode($tc_postal);
		$dcCon->setPhone($tc_phone);
		$dcCon->setFax($tc_fax);
		$dcCon->setDefaultContact($tc_defcon);
		$dcCon->setPublished($tc_pub);
		
		return $dcCon;
	}
}

?>
