<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Domain check class
|
| File:	tcms_domaincheck.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Domain check class
 *
 * This class is used to have a internal domain
 * checker class.
 *
 * @version 0.0.1
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Methods
 *
 * __construct                 -> PHP5 Constructor
 * tcms_domaincheck            -> PHP4 Constructor
 * __destruct                  -> PHP5 Destructor
 * _tcms_domaincheck           -> PHP4 Destructor
 * 
 * getWhoisServer              -> Get a list of whois server
 * 
 */


class tcms_domaincheck {
	/**
	 * PHP5 Constructor
	 *
	 */
	function __construct(){
	}
	
	
	
	/**
	 * PHP4 Constructor
	 *
	 */
	function tcms_domaincheck(){
		$this->__construct();
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct(){
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_domaincheck(){
		$this->__destruct();
	}
	
	
	
	/**
	 * Get a list of whois server
	 *
	 * @param unknown_type $domain
	 * @return unknown
	 */
	function getWhoisServer($domain){
		$whoisservers = array(
			array("de","whois.denic.de"),
			array("com","rs.internic.net"),
			array("net","rs.internic.net"),
			array("org","whois.networksolutions.com"),
			array("info","whois.afilias.net"),
			array("biz","whois.biz"),
			array("at","whois.nic.at"),
			array("ch","whois.nic.ch"),
			array("li","whois.nic.ch"),
			array("co.uk","whois.nic.uk"),
			array("tv","whois.www.tv"),
			array("cc","whois.enicregistrar.com"),
			array("dk","whois.dk-hostmaster.dk"),
			array("it","whois.nic.it"),
			array("ws","whois.worldsite.ws")
		);
		
		$whocnt = count($whoisservers);
		
		for($x = 0; $x < $whocnt; $x++){
			$artld = $whoisservers[$x][0];
			$tldlen = intval(0 - strlen($artld));
			
			if(substr($domain, $tldlen) == $artld){
				$whosrv = $whoisservers[$x][1];
			}
		}
		
		return $whosrv;
	}
	
	
	
	/**
	 * This is a domain checker formular
	 *
	 * @return String
	 */
	function domainChecker($link){
		$input = '<form name="toendaDC" method="post" action="'.$link.'">'
		.'http://www. <input type="text" name="dc_name" />'
		.'<select name="dc_domain">'
		.'<option value=".de">.de</option>'
		.'<option value=".com">.com</option>'
		.'<option value=".net">.net</option>'
		.'<option value=".org">.org</option>'
		.'<option value=".info">.info</option>'
		.'<option value=".biz">.biz</option>'
		.'<option value=".at">.at</option>'
		.'<option value=".ch">.ch</option>'
		.'<option value=".li">.li</option>'
		.'<option value=".co.uk">.co.uk</option>'
		.'<option value=".tv">.tv</option>'
		.'<option value=".cc">.cc</option>'
		.'<option value=".dk">.dk</option>'
		.'<option value=".it">.it</option>'
		.'<option value=".ws">.ws</option>'
		.'</select>'
		.'<input type="hidden" name="cmd" value="check" />'
		.'<input type="submit" name="submit" value="Check" />'
		.'</form>';
		
		return $input;
	}
	
	
	
	
	
	
	
	/*
	*/
	function lookUp($dc_name){
		$lusrv = $this->getWhoisServer($dc_name);
		
		if(!$lusrv){
			return '';
		}
		
		$fp = fsockopen($lusrv,43);
		
		if($lusrv == "whois.denic.de"){
			fputs($fp, "-C ISO-8859-1 -T ace,dn $dc_name\r\n");
		}
		else{
			fputs($fp, "$dc_name\r\n");
		}
		
		$string = '';
		
		while(!feof($fp)){
			$string .= fgets($fp,128);
		}
		fclose($fp);
		
		$reg = "/Whois Server: (.*?)\n/i";
		preg_match_all($reg, $string, $matches);
		
		$secondtry = $matches[1][0];
		
		if($secondtry){
			$fp = fsockopen($secondtry,43);
			fputs($fp, "$dc_name\r\n");
			$string = '';
			
			while(!feof($fp)){
				$string .= fgets($fp,128);
			}
			fclose($fp);
		}
		
		if(ereg("(No match|No entries found|NOT FOUND|Not found|not found in database|We do not have an entry in our database matching your query)",$string)) {
			echo "<b>Der Domainname ".$dc_name." ist frei.</b>";
		}
		else{
			echo "<b>Der Domainname ".$dc_name." ist vergeben.</b>";
			//$whois = "<font size=\"12pt\">".$string."</font>";
			//$copy = "<center><font size=\"12pt\">Top-Side.de Php Domain Checker v1.1<br>(C) 2003 by <a target=\"_blank\" href=\"http://www.top-side.de\">Top-Side.de</a><br>based on <a href=\"http://www.nukedweb.com/phpscripts/\" target=\"_blank\">phpGlobalWhois</a></font></center>";
			return '';//$whois.$copy;
		}
	}
}


?>
