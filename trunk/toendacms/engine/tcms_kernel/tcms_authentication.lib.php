<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Authentication
|
| File:	tcms_authentication.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Authentication
 *
 * This class is used to authenticate a login user.
 *
 * @version 0.2.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Methods
 *
 * __construct                 -> PHP5 Constructor
 * tcms_authentication         -> PHP4 Constructor
 * __destruct                  -> PHP5 Destructor
 * _tcms_authentication        -> PHP4 Destructor
 * 
 * setTcmsTimeObj              -> Set the tcms_time object
 *
 * createSession               -> Create a session
 * updateLoginTime             -> Update the last_login value to current datetime
 * doLogin                     -> Login to the system
 * doLogout                    -> Logout from the system
 * doRetrieve                  -> Retrieve a new password
 * sendRetrievementMail        -> Send a mail at the email of the founded user with a new password.
 *
 */


class tcms_authentication extends tcms_main {
	var $m_administer;
	var $m_imagePath;
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
	 * PHP5 Constructor
	 *
	 * @param String $administer
	 * @param String $charset
	 * @param String $imagePath
	 */
	function __construct($administer, $charset, $imagePath, $tcmsTimeObj = null){
		$this->m_administer = $administer;
		$this->m_imagePath = $imagePath;
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
	 * PHP4 Constructor
	 *
	 * @param String $administer
	 * @param String $charset
	 * @param String $imagePath
	 */
	function tcms_authentication($administer, $charset, $imagePath, $tcmsTimeObj = null){
		$this->__construct($administer, $charset, $imagePath, $tcmsTimeObj);
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_authentication(){
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
	 * Create a session
	 *
	 * @param String $username
	 * @param String $id
	 * @param Boolean $backend = false
	 * @return Boolean
	 */
	function createSession($username, $id, $backend = false){
		if($this->db_choosenDB == 'xml'){
			if($backend){
				$ws_path = '';
			}
			else{
				$ws_path = $this->m_imagePath.$this->m_administer.'/tcms_';
			}
			
			while(($session_id = md5(microtime())) && file_exists($ws_path.'session/'.$session_id)){}
			
			$session_save = fopen($ws_path.'session/'.$session_id, 'w');
			fclose($session_save);
			
			chmod($ws_path.'session/'.$session_id, 0777);
			
			umask(077);
			$wp = fopen($ws_path.'session/'.$session_id, 'w');
			fwrite($wp, $username.'##'.$id);
			fclose($wp);
			
			$www = fopen($ws_path.'session/'.$session_id, 'r');
			$ws_check = fread($www, filesize($ws_path.'session/'.$session_id));
			fclose($www);
			
			if(file_exists($ws_path.'session/'.$session_id))
				$ws_return = $session_id;
			else
				$ws_return = false;
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
			$session_exists = 1;
			
			do{
				$session_id = md5(microtime());
				$sqlQR = $sqlAL->getOne($this->db_prefix.'session', $session_id);
				$session_exists = $sqlAL->getNumber($sqlQR);
			}
			while($session_exists > 0);
			
			switch($this->db_choosenDB){
				case 'mysql': $newSQLColumns = 'date, user, user_id'; break;
				case 'pgsql': $newSQLColumns = 'date, "user", user_id'; break;
				case 'mssql': $newSQLColumns = 'date, [user], [user_id]'; break;
			}
			$newSQLData = "'".date('U')."', '".$username."', '".$id."'";
			
			$sqlQR = $sqlAL->createOne($this->db_prefix.'session', $newSQLColumns, $newSQLData, $session_id);
			
			$sqlAL->_sqlAbstractionLayer();
			
			$ws_return = $session_id;
		}
		
		return $ws_return;
	}
	
	
	
	/**
	 * Update the last_login value to current datetime
	 *
	 * @param String $tcmsUserID
	 */
	function updateLoginTime($tcmsUserID){
		if($this->db_choosenDB == 'xml'){
			$arrUserXML = $this->getPathContent($this->m_administer.'/tcms_user');
			
			if($this->isArray($arrUserXML)){
				foreach($arrUserXML as $key => $XMLUserFile){
					if($XMLUserFile != 'index.html'){
						if($tcmsUserID == substr($XMLUserFile, 0, 32)){
							$xmlUser = new xmlparser($this->m_administer.'/tcms_user/'.$XMLUserFile, 'r');
							$tmpLLXML = $xmlUser->readSection('user', 'last_login');
							
							if($tmpLLXML == false) $tmpLLXML = '';
							
							if($tmpLLXML != '') {
								$xmlUser->edit_value(
									$this->m_administer.'/tcms_user/'.$XMLUserFile, 
									'last_login', 
									$tmpLLXML, 
									date('Y.m.d-H:i:s')
								);
							}
							else {
								$xmlUser->add_one_value(
									$this->m_administer.'/tcms_user/'.$XMLUserFile, 
									'user', 
									'last_login', 
									date('Y.m.d-H:i:s')
								);
							}
							
							$xmlUser->flush();
							$xmlUser->_xmlparser();
							unset($xmlUser);
						}
					}
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
			
			$newSQLData = $this->db_prefix.'user.last_login="'.date('Y.m.d-H:i:s').'"';
			
			$sqlQR = $sqlAL->updateOne($this->db_prefix.'user', $newSQLData, $tcmsUserID);
			
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
		}
		
		// update last changes
		$xml = new xmlparser($this->m_administer.'/tcms_global/var.xml', 'r');
		$tmpLC = $xml->readSection('global', 'last_changes');
		
		if($tmpLC == false) $tmpLC = '';
		
		if($tmpLC != '') {
			$xml->edit_value(
				$this->m_administer.'/tcms_global/var.xml', 
				'last_changes', 
				$tmpLLXML, 
				date('Y-m-d H:i:s')
			);
		}
		else {
			$xml->add_one_value(
				$this->m_administer.'/tcms_global/var.xml', 
				'global', 
				'last_changes', 
				date('Y-m-d H:i:s')
			);
		}
		
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
	}
	
	
	
	/**
	 * Login to the system
	 *
	 * @param String $username
	 * @param String $password
	 * @param Boolean $backend = false
	 * @return String
	 */
	function doLogin($username, $password, $backend = false){
		if($this->db_choosenDB == 'xml'){
			$arr_files = $this->getPathContent($this->m_administer.'/tcms_user/');
			
			if($this->isReal($arr_files)){
				foreach($arr_files as $key => $value){
					$xml = new xmlparser($this->m_administer.'/tcms_user/'.$value,'r');
					
					$ws_username = $xml->readSection('user', 'username');
					$ws_username = $this->decodeText($ws_username, '2', $this->m_charset);
					
					// username
					if($ws_username == $username){
						$password = md5($password);
						$ws_password = $xml->readSection('user', 'password');
						
						// password
						if($ws_password == $password){
							$ws_enabled = $xml->readSection('user', 'enabled');
							
							// enabled
							if($ws_enabled == 1){
								$ws_group = $xml->readSection('user', 'group');
								
								$xml->flush();
								$xml->_xmlparser();
								unset($xml);
								
								if($ws_group == 'Administrator' || 
								$ws_group == 'User' || 
								$ws_group == 'Developer' || 
								$ws_group == 'Writer' || 
								$ws_group == 'Editor' || 
								$ws_group == 'Presenter'){
									$ws_maintag = substr($value, 0, 32);
									$ws_return = $this->createSession($ws_username, $ws_maintag, $backend);
									
									if($ws_return){
										$this->updateLoginTime($ws_maintag);
										
										return $ws_return;
									}
									else{
										return false;
									}
								}
								else{
									return false;
								}
							}
							else{
								return false;
							}
						}
						else{
							return false;
						}
					}
				}
			}
			else{
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
			
			$username = $this->encodeText($username, '2', $this->m_charset);
			
			$strSQL = "SELECT *"
			." FROM ".$this->db_prefix."user"
			." WHERE username='".$username."'"
			." AND password='".md5($password)."'"
			." AND enabled = 1";
			
			$sqlQR = $sqlAL->query($strSQL);
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			if($sqlNR > 0){
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				
				$ws_maintag  = $sqlObj->uid;
				$ws_username = $sqlObj->username;
				$ws_group = $sqlObj->group;
				
				if($ws_group == 'Administrator' || 
				$ws_group == 'User' || 
				$ws_group == 'Developer' || 
				$ws_group == 'Writer' || 
				$ws_group == 'Editor' || 
				$ws_group == 'Presenter'){
					$ws_return = $this->createSession($ws_username, $ws_maintag, $backend);
					
					if($ws_return){
						$this->updateLoginTime($ws_maintag);
						
						return $ws_return;
					}
					else{
						return false;
					}
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
	}
	
	
	
	/**
	 * Logout from the system, if $backend is true,
	 * you logout from the backend
	 *
	 * @param String $session
	 * @param Boolean $backend = false
	 * @return Boolean
	 */
	function doLogout($session, $backend = false){
		if($this->db_choosenDB == 'xml'){
			if($backend){
				if('session/'.$session)
					unlink('session/'.$session);
				else
					return false;
			}
			else{
				if($this->m_administer.'/tcms_session/'.$session)
					unlink($this->m_administer.'/tcms_session/'.$session);
				else
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
			
			$sqlAL->deleteOne($this->db_prefix.'session', $session);
			
			$sqlAL->_sqlAbstractionLayer();
			unset($sqlAL);
		}
		
		return true;
	}
	
	
	
	/**
	 * Retrieve a new password if username and email
	 * combination is found.
	 *
	 * @param String $username
	 * @param String $email
	 * @return Boolean
	 */
	function doRetrieve($username, $email){
		if($this->db_choosenDB == 'xml'){
			$arr_files = $this->getPathContent($this->m_administer.'/tcms_user/');
			
			if($this->isReal($arr_files)){
				foreach($arr_files as $key => $value){
					$xml = new xmlparser($this->m_administer.'/tcms_user/'.$value,'r');
					
					$ws_username = $xml->readSection('user', 'username');
					$ws_username = $this->decodeText($ws_username, '2', $this->m_charset);
					
					// username
					if($ws_username == $username){
						$ws_email = $xml->readSection('user', 'email');
						
						// password
						if($ws_email == $email){
							$ws_enabled  = $xml->readSection('user', 'enabled');
							$ws_password = $xml->readSection('user', 'password');
							
							// enabled
							if($ws_enabled == 1){
								$new_password  = substr(md5(microtime()), 0, 8);
								$save_password = md5($new_password);
								
								xmlparser::edit_value($this->m_administer.'/tcms_user/'.$value.'.xml', 'password', $ws_password, $save_password);
								
								$this->sendRetrievementMail($ws_username, $ws_email, $new_password);
								
								$xml->flush();
								$xml->_xmlparser();
								unset($xml);
							}
							else{
								return false;
							}
						}
						else{
							return false;
						}
					}
				}
			}
			else{
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
			
			$username = $this->encodeText($username, '2', $this->m_charset);
			
			$strSQL = "SELECT *"
			." FROM ".$this->db_prefix."user"
			." WHERE username='".$username."'"
			." AND email='".$email."'"
			." AND enabled = 1";
			
			$sqlQR = $sqlAL->query($strSQL);
			$sqlNR = $sqlAL->getNumber($sqlQR);
			
			if($sqlNR > 0){
				$sqlObj = $sqlAL->fetchObject($sqlQR);
				
				$ws_maintag  = $sqlObj->uid;
				$ws_username = $sqlObj->username;
				$ws_email    = $sqlObj->email;
				
				$new_password  = substr(md5(microtime()), 0, 8);
				$save_password = md5($new_password);
				
				$newSQLData = $this->db_prefix.'user.password="'.$save_password.'"';
				$sqlQR = $sqlAL->updateOne($this->db_prefix.'user', $newSQLData, $ws_maintag);
				
				$this->sendRetrievementMail($ws_username, $ws_email, $new_password);
				
				unset($sqlAL);
			}
			else{
				return false;
			}
		}
	}
	
	
	
	/**
	 * Send a mail at the email of the founded user
	 * with a new password.
	 *
	 * @param String $email
	 * @param String $new_password
	 * @return Boolean
	 */
	function sendRetrievementMail($username, $email, $new_password){
		$xml  = new xmlparser($this->m_administer.'/tcms_global/footer.xml','r');
		$owner_email = $xml->read_section('footer', 'email');
		$owner       = $xml->read_section('footer', 'websiteowner');
		$xml->flush();
		$xml->_xmlparser();
		unset($xml);
		
		$owner       = $this->decodeText($owner, '2', $this->m_charset);
		$owner_email = $this->decodeText($owner_email, '2', $this->m_charset);
		
		// mail
		include_once($this->m_administer.'/tcms_global/mail.php');
		
		$mail_with_smtp   = $tcms_mail_with_smtp;
		$mail_as_html     = $tcms_mail_as_html;
		$mail_server_pop3 = $tcms_mail_server_pop3;
		$mail_server_smtp = $tcms_mail_server_smtp;
		$mail_port        = $tcms_mail_port;
		$mail_pop3        = $tcms_mail_pop3;
		$mail_user        = $tcms_mail_user;
		$mail_password    = $tcms_mail_password;
		
		$lpw_subject  = _REG_LPW_SUCCESS;
		$lpw_text     = _REG_TEXT_LPW;
		$sc_user      = _PERSON_USERNAME;
		$sc_pass      = _PERSON_PASSWORD;
		$sc_details   = _PERSON_DETAILS;
		$date         = date('d.m.Y');
		
		if($mail_with_smtp == '1'){
			// phpmailer
			$mail = new PHPMailer();
			
			$mail->IsSMTP();
			$mail->Host     = $mail_server_smtp;
			$mail->SMTPAuth = true;
			$mail->Username = $mail_user;
			$mail->Password = $mail_password;
			
			$mail->From     = $owner_email;
			$mail->FromName = $owner;
			$mail->AddAddress($email, $username);
			
			$mail->WordWrap = 50;
			
			$mail->Subject  =  $owner.' - '.$date.' - '.$lpw_subject;
			
			// text message
			$mail_body_text = $msg_form_content." ".$date."
 ----------------------------------------------------------------------

 $lpw_text

 ".$sc_user.": $username
 ".$sc_pass.": $new_password
 ----------------------------------------------------------------------";
			
			// html message
			$mail_body_html = $msg_form_content.' '.$date.'<hr />'
			.$lpw_text.'<br /><br />'
			.'<strong>'.$sc_user.'</strong>: '.$username.'<br />'
			.'<strong>'.$sc_pass.'</strong>: '.$new_password.'<br />';
			
			if($mail_as_html == '1'){
				$mail->IsHTML(true);
				$mail->Body     =  $mail_body_html;
				$mail->AltBody  =  $mail_body_text;
			}
			else{
				$mail->IsHTML(false);
				//$mail->IsMail();
				//$mail->Body     =  $mail_body_text;
				//$mail->AltBody  =  $mail_body_html;
				$mail->Body     =  $mail_body_html;
				$mail->AltBody  =  $mail_body_text;
			}
			
			if(!$mail->Send()){
				echo '<script>'
				.'history.back();'
				.'alert(\''._MSG_SEND_FAILED.'\n\nMailer Error: '.$mail->ErrorInfo.'\');'
				.'</script>';
				break;
			}
		}
		else{
			$header = "From: $owner <$owner_email>\n";
			$header .= 'Content-Type: text/plain';
			mail($email, $owner.' - '.$date.' - '.$lpw_subject, "
 $lpw_subject $username
----------------------------------------------------------------------

 $lpw_text

 $sc_details:
 $sc_user: $username
 $sc_pass: $new_password

----------------------------------------------------------------------
","$header");
		}
	}
}

?>
