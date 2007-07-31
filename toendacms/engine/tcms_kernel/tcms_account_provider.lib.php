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
 * @version 0.2.9
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
 * setTcmsTimeObj              -> Set the tcms_time object
 *
 * getUsername                 -> Get the username of a user id
 * getUserID                   -> Return ID for username or realname
 * getUserInfo                 -> Get some information about a user
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
	private $m_administer;
	private $m_charset;
	private $_tcmsTime;
	
	// database information
	private $db_choosenDB;
	private $db_user;
	private $db_pass;
	private $db_host;
	private $db_database;
	private $db_port;
	private $db_prefix;
	
	
	
	/**
	 * PHP5 Constructor
	 *
	 * @param String $administer
	 * @param String $charset
	 */
	function __construct($administer, $charset, $tcmsTimeObj = null){
		$this->m_administer = $administer;
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
		
		parent::setAdministerSite($administer);
		//parent::__construct($administer, $tcmsTimeObj);
		//parent::setDatabaseInfo($this->db_choosenDB);
	}
	
	
	
	/**
	 * PHP4 Constructor
	 *
	 * @param String $administer
	 * @param String $charset
	 */
	function tcms_account_provider($administer, $charset, $tcmsTimeObj = null){
		$this->__construct($administer, $charset, $tcmsTimeObj);
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
	 * Set the tcms_time object
	 *
	 * @param Object $value
	 */
	function setTcmsTimeObj($value) {
		$this->_tcmsTime = $value;
	}
	
	
	
	/**
	 * Get the username of a user id
	 *
	 * @param String $userID
	 * @return String
	 */
	function getUsername($userID) {
		if($this->db_choosenDB == 'xml') {
			if(file_exists($this->administer.'/tcms_user/'.$userID.'.xml')) {
				$xmlUser = new xmlparser($this->administer.'/tcms_user/'.$userID.'.xml', 'r');
				
				$tmpNickXML = $xmlUser->readSection('user', 'username');
			}
			else{
				$tmpNickXML = '';
			}
			
			if($tmpNickXML == '') {
				$nickXML = false;
			}
			else{
				$nickXML = $this->decodeText($tmpNickXML, '2', $this->m_charset);
			}
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
			
			$sqlQR = $sqlAL->query("SELECT * FROM ".$this->db_prefix."user WHERE uid = '".$userID."'");
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			if($sqlNR > 0) {
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				$nickXML = $sqlObj->username;
				$nickXML = $this->decodeText($tmpNickXML, '2', $this->m_charset);
			}
			else {
				$nickXML = false;
			}
		}
		
		return $nickXML;
	}
	
	
	
	/**
	 * Get the id for a user
	 *
	 * @param String $realOrNick
	 * @return String
	 */
	function getUserID($realOrNick) {
		if($this->db_choosenDB == 'xml') {
			$arrUserXML = $this->getPathContent($this->administer.'/tcms_user');
			
			$userFound = false;
			
			foreach($arrUserXML as $key => $XMLUserFile) {
				if($XMLUserFile != 'index.html'){
					$xmlUser = new xmlparser($this->administer.'/tcms_user/'.$XMLUserFile, 'r');
					
					$tmpNickXML = $xmlUser->readSection('user', 'name');
					$nickXML = $this->decodeText($tmpNickXML, '2', $this->m_charset);
					
					if($realOrNick == $nickXML){
						return substr($XMLUserFile, 0, 32);
						$userFound = true;
						break;
					}
					else{
						$tmpRealXML = $xmlUser->readSection('user', 'username');
						$arrRealXML = $this->decodeText($tmpRealXML, '2', $this->m_charset);
						
						if($realOrNick == $arrRealXML){
							return substr($XMLUserFile, 0, 32);
							$userFound = true;
							break;
						}
						else{
							$userFound = false;
						}
					}
					
					$nickXML = '';
					$arrRealXML = '';
				}
			}
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->db_user, 
				$this->db_pass, 
				$this->db_host, 
				$this->db_database, 
				$this->db_port
			);
			
			$sqlQR = $sqlAL->query("SELECT * FROM ".$this->db_prefix."user WHERE username = '".$realOrNick."'");
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			if($sqlNR != 0){
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				$userID = $sqlObj->uid;
			}
			else{
				$sqlQR = $sqlAL->query("SELECT * FROM ".$this->db_prefix."user WHERE name = '".$realOrNick."'");
				$sqlNR = $sqlAL->getNumber($sqlQR);
				
				if($sqlNR != 0){
					$sqlARR = $sqlAL->fetchObject($sqlQR);
					$userID = $sqlObj->uid;
				}
				else{
					$userID = false;
				}
			}
			
			return $userID;
		}
		
		if(!$userFound){ return false; }
	}
	
	
	
	/**
	 * Get some information about the current user
	 *
	 * @param String $session
	 * @return Array
	 */
	function getUserInfo($session){
		if($this->db_choosenDB == 'xml'){
			$fileopen = fopen($this->administer.'/tcms_session/'.$session, 'r');
			$arr_user = fread($fileopen, filesize($this->administer.'/tcms_session/'.$session));
			
			$arr_username = explode('##', $arr_user);
			$ws_user = $arr_username[0];
			$ws_id   = $arr_username[1];
			
			fclose($fileopen);
			
			$authXML = new xmlparser($this->administer.'/tcms_user/'.$ws_id.'.xml', 'r');
			
			$arr_ws['user']  = $ws_user;
			$arr_ws['id']    = $ws_id;
			$arr_ws['group'] = $authXML->readSection('user', 'group');
			$arr_ws['name']  = $authXML->readSection('user', 'name');
			
			$authXML->flush();
			$authXML->_xmlparser();
			unset($authXML);
		}
		else{
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->db_user, 
				$this->db_pass, 
				$this->db_host, 
				$this->db_database, 
				$this->db_port
			);
			
			if($this->db_choosenDB == 'mssql'){
				$strSQL = "SELECT "
				.$this->db_prefix."session.[user_id], "
				.$this->db_prefix."user.[name], "
				.$this->db_prefix."user.username, "
				.$this->db_prefix."user.[group]"
				//.$this->db_prefix."usergroup.right"
				." FROM ".$this->db_prefix."session"
				." INNER JOIN ".$this->db_prefix."user ON (".$this->db_prefix."session.[user_id] = ".$this->db_prefix."user.uid)"
				//." INNER JOIN ".$this->db_prefix."usergroup ON (".$this->db_prefix."user.group = ".$this->db_prefix."usergroup.uid)"
				." WHERE (".$this->db_prefix."session.uid = '".$session."')";
			}
			else{
				$strSQL = "SELECT "
				.$this->db_prefix."session.user_id, "
				.$this->db_prefix."user.name, "
				.$this->db_prefix."user.username, "
				.$this->db_prefix."user.group"
				//.$this->db_prefix."usergroup.right"
				." FROM ".$this->db_prefix."session"
				." INNER JOIN ".$this->db_prefix."user ON (".$this->db_prefix."session.user_id = ".$this->db_prefix."user.uid)"
				//." INNER JOIN ".$this->db_prefix."usergroup ON (".$this->db_prefix."user.group = ".$this->db_prefix."usergroup.uid)"
				." WHERE (".$this->db_prefix."session.uid = '".$session."')";
			}
			
			$sqlQR = $sqlAL->query($strSQL);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
			$arr_ws['name']  = $sqlObj->name;
			$arr_ws['user']  = $sqlObj->username;
			$arr_ws['id']    = $sqlObj->user_id;
			$arr_ws['group'] = $sqlObj->group;
			//$arr_ws['right'] = $sqlObj->right;
			
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
		}
		
		return $arr_ws;
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
			$wsUsername   = $xml->readSection('user', 'username');
			$wsPassword   = $xml->readSection('user', 'password');
			$wsEmail      = $xml->readSection('user', 'email');
			$wsName       = $xml->readSection('user', 'name');
			$wsGroup      = $xml->readSection('user', 'group');
			$wsJoinDate   = $xml->readSection('user', 'join_date');
			$wsLastLogin  = $xml->readSection('user', 'last_login');
			$wsBirthday   = $xml->readSection('user', 'birthday');
			$wsGender     = $xml->readSection('user', 'gender');
			$wsOccupation = $xml->readSection('user', 'occupation');
			$wsHomepage   = $xml->readSection('user', 'homepage');
			$wsICQ        = $xml->readSection('user', 'icq');
			$wsAIM        = $xml->readSection('user', 'aim');
			$wsYIM        = $xml->readSection('user', 'yim');
			$wsMSN        = $xml->readSection('user', 'msn');
			$wsSkype      = $xml->readSection('user', 'skype');
			$wsEnabled    = $xml->readSection('user', 'enabled');
			$wsScEnabled  = $xml->readSection('user', 'tcms_enabled');
			$wsStaticVal  = $xml->readSection('user', 'static_value');
			$wsSignature  = $xml->readSection('user', 'signature');
			$wsLocation   = $xml->readSection('user', 'location');
			$wsHobby      = $xml->readSection('user', 'hobby');
			
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
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->db_user, 
				$this->db_pass, 
				$this->db_host, 
				$this->db_database, 
				$this->db_port
			);
			
			$sqlStr = "SELECT * "
			."FROM ".$this->db_prefix."user "
			."WHERE uid = '".$id."'";
			
			$sqlQR = $sqlAL->query($sqlStr);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
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
			
			$sqlAL->freeResult;($sqlQR);
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
		
		$accDC->setID($wsID);
		$accDC->setUsername($wsUsername);
		$accDC->setPassword($wsPassword);
		$accDC->setEmail($wsEmail);
		$accDC->setName($wsName);
		$accDC->setGroup($wsGroup);
		$accDC->setJoinDate($wsJoinDate);
		$accDC->setLastLogin($wsLastLogin);
		$accDC->setBirthday($wsBirthday);
		$accDC->setGender($wsGender);
		$accDC->setOccupation($wsOccupation);
		$accDC->setHomepage($wsHomepage);
		$accDC->setICQ($wsICQ);
		$accDC->setAIM($wsAIM);
		$accDC->setYIM($wsYIM);
		$accDC->setMSN($wsMSN);
		$accDC->setSkype($wsSkype);
		$accDC->setEnabled($wsEnabled);
		$accDC->setTCMSScriptEnabled($wsScEnabled);
		$accDC->setStaticValue($wsStaticVal);
		$accDC->setSignature($wsSignature);
		$accDC->setLocation($wsLocation);
		$accDC->setHobby($wsHobby);
		
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
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->db_user, 
				$this->db_pass, 
				$this->db_host, 
				$this->db_database, 
				$this->db_port
			);
			
			$sqlQR = $sqlAL->getOne($this->db_prefix.'user', $id);
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
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
		$new_name      = $this->encodeText($acc->getName(), '2', $this->m_charset);
		$new_username  = $this->encodeText($acc->getUsername(), '2', $this->m_charset);
		$new_occ       = $this->encodeText($acc->getOccupation(), '2', $this->m_charset);
		$new_signature = $this->encodeText($acc->getSignature(), '2', $this->m_charset);
		$new_location  = $this->encodeText($acc->getLocation(), '2', $this->m_charset);
		$new_hobby     = $this->encodeText($acc->getHobby(), '2', $this->m_charset);
		
		if($this->db_choosenDB == 'xml'){
			$xmluser = new xmlparser($this->m_administer.'/tcms_user/'.$acc->GetID().'.xml', 'w');
			$xmluser->xml_declaration();
			$xmluser->xml_section('user');
			
			$xmluser->write_value('name', $new_name);
			$xmluser->write_value('username', $new_username);
			$xmluser->write_value('password', $acc->getPassword());
			$xmluser->write_value('email', $acc->getEmail());
			$xmluser->write_value('group', $acc->getGroup());
			$xmluser->write_value('last_login', $acc->getLastLogin());
			$xmluser->write_value('join_date', $acc->getJoinDate());
			$xmluser->write_value('homepage', $acc->getHomepage());
			$xmluser->write_value('icq', $acc->getICQ());
			$xmluser->write_value('aim', $acc->getAIM());
			$xmluser->write_value('yim', $acc->getYIM());
			$xmluser->write_value('msn', $acc->getMSN());
			$xmluser->write_value('skype', $acc->getSkype());
			$xmluser->write_value('birthday', $acc->getBirthday());
			$xmluser->write_value('gender', $acc->getGender());
			$xmluser->write_value('occupation', $new_occ);
			$xmluser->write_value('enabled', $acc->getEnabled());
			$xmluser->write_value('tcms_enabled', $acc->getTCMSScriptEnabled());
			$xmluser->write_value('static_value', $acc->getStaticValue());
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
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->db_user, 
				$this->db_pass, 
				$this->db_host, 
				$this->db_database, 
				$this->db_port
			);
			
			if($saveAsUpdate) {
				$newSQLData = ''
				.$this->db_prefix.'user.name="'.$new_name.'", '
				.$this->db_prefix.'user.username="'.$new_username.'", '
				.$this->db_prefix.'user.password="'.$acc->getPassword().'", '
				.$this->db_prefix.'user.email="'.$acc->getEmail().'", '
				.$this->db_prefix.'user.group="'.$acc->getGroup().'", '
				.$this->db_prefix.'user.last_login="'.$acc->getLastLogin().'", '
				.$this->db_prefix.'user.join_date="'.$acc->getJoinDate().'", '
				.$this->db_prefix.'user.birthday="'.$acc->getBirthday().'", '
				.$this->db_prefix.'user.gender="'.$acc->getGender().'", '
				.$this->db_prefix.'user.occupation="'.$new_occ.'", '
				.$this->db_prefix.'user.homepage="'.$acc->getHomepage().'", '
				.$this->db_prefix.'user.icq="'.$acc->getICQ().'", '
				.$this->db_prefix.'user.aim="'.$acc->getAIM().'", '
				.$this->db_prefix.'user.yim="'.$acc->getYIM().'", '
				.$this->db_prefix.'user.msn="'.$acc->getMSN().'", '
				.$this->db_prefix.'user.skype="'.$acc->getSkype().'", '
				.$this->db_prefix.'user.enabled='.$acc->getEnabled().', '
				.$this->db_prefix.'user.tcms_enabled='.$acc->getTCMSScriptEnabled().', '
				.$this->db_prefix.'user.static_value='.$acc->getStaticValue().', '
				.$this->db_prefix.'user.signature="'.$new_signature.'", '
				.$this->db_prefix.'user.location="'.$new_location.'", '
				.$this->db_prefix.'user.hobby="'.$new_hobby.'"';
				
				$sqlQR = $sqlAL->updateOne($this->db_prefix.'user', $newSQLData, $acc->getID());
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
				."'".$acc->getPassword()."', "
				."'".$acc->getEmail()."', "
				."'".$acc->getGroup()."', "
				."'".$acc->getLastLogin()."', "
				."'".$acc->getJoinDate()."', "
				."'".$acc->getBirthday()."', "
				."'".$acc->getGender()."', "
				."'".$new_occ."', "
				."'".$acc->getHomepage()."', "
				."'".$acc->getICQ()."', "
				."'".$acc->getAIM()."', "
				."'".$acc->getYIM()."', "
				."'".$acc->getMSN()."', "
				."'".$acc->getSkype()."', "
				."".$acc->getEnabled().", "
				."".$acc->getTCMSScriptEnabled().", "
				."0, "
				."'".$new_signature."', "
				."'".$new_location."', "
				."'".$new_hobby."'";
				
				$sqlQR = $sqlAL->createOne($this->db_prefix.'user', $newSQLColumns, $newSQLData, $acc->getID());
				
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
				
				$sqlQR = $sqlAL->createOne($this->db_prefix.'notepad', $newSQLColumns, $newSQLData, $acc->getID());
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
			$tc_defcon   = $xml->readSection('contact', 'default_con');
			$tc_pub      = $xml->readSection('contact', 'published');
			$tc_name     = $xml->readSection('contact', 'name');
			$tc_position = $xml->readSection('contact', 'position');
			$tc_email    = $xml->readSection('contact', 'email');
			$tc_street   = $xml->readSection('contact', 'street');
			$tc_country  = $xml->readSection('contact', 'country');
			$tc_state    = $xml->readSection('contact', 'state');
			$tc_town     = $xml->readSection('contact', 'town');
			$tc_postal   = $xml->readSection('contact', 'postal');
			$tc_phone    = $xml->readSection('contact', 'phone');
			$tc_fax      = $xml->readSection('contact', 'fax');
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
			$sqlAL = new sqlAbstractionLayer($this->db_choosenDB, $this->_tcmsTime);
			$sqlCN = $sqlAL->connect(
				$this->db_user, 
				$this->db_pass, 
				$this->db_host, 
				$this->db_database, 
				$this->db_port
			);
			
			$sqlQR = $sqlAL->getOne($this->db_prefix.'contacts', $id);
			$sqlObj = $sqlAL->fetchObject($sqlQR);
			
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
			
			$sqlAL->freeResult($sqlQR);
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
		
		if(strtolower($tc_country) == 'deutschland' 
		|| strtolower($tc_country) == 'germany'
		|| strtolower($tc_country) == '') {
			if(strlen($tc_postal) == 4) {
				$tc_postal = '0'.$tc_postal;
			}
		}
		
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
