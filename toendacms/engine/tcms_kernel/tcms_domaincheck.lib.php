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
 * @version 0.0.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 * 
 * <code>
 * 
 * Methods
 *
 * __construct                 -> PHP5 Constructor
 * tcms_domaincheck            -> PHP4 Constructor
 * __destruct                  -> PHP5 Destructor
 * _tcms_domaincheck           -> PHP4 Destructor
 * 
 * getWhoisServer              -> Get a list of whois server
 * 
 * </code>
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
	 * @param String $domain
	 * @return Array
	 */
	function getWhoisServer($domain){
		$arrWhoisServers["de"]["whois.denic.de"];
		$arrWhoisServers["com"]["rs.internic.net"];
		$arrWhoisServers["net"]["rs.internic.net"];
		$arrWhoisServers["org"]["whois.networksolutions.com"];
		$arrWhoisServers["info"]["whois.afilias.net"];
		$arrWhoisServers["biz"]["whois.biz"];
		$arrWhoisServers["at"]["whois.nic.at"];
		$arrWhoisServers["ch"]["whois.nic.ch"];
		$arrWhoisServers["li"]["whois.nic.ch"];
		$arrWhoisServers["co.uk"]["whois.nic.uk"];
		$arrWhoisServers["tv"]["whois.www.tv"];
		$arrWhoisServers["cc"]["whois.enicregistrar.com"];
		$arrWhoisServers["dk"]["whois.dk-hostmaster.dk"];
		$arrWhoisServers["it"]["whois.nic.it"];
		$arrWhoisServers["ws"]["whois.worldsite.ws"];
		
		$whocnt = count($arrWhoisServers);
		
		for($x = 0; $x < $whocnt; $x++){
			$artld = $arrWhoisServers[$x][0];
			$tldlen = intval(0 - strlen($artld));
			
			if(substr($domain, $tldlen) == $artld){
				$whosrv = $arrWhoisServers[$x][1];
			}
		}
		
		return $whosrv;
	}
	
	
	
	/**
	 * This is a domain checker formular
	 *
	 * @param String $link
	 * @param String $domainname = ''
	 * @param String $domain = ''
	 * @return String
	 */
	function getDomainCheckForm($link, $domainname = '', $domain = ''){
		$input = '<form name="toendaDC" method="post" action="'.$link.'">'
		.'http://www. <input type="text" name="dc_name" value="'.$domainname.'" />'
		.'<select name="dc_domain">'
		.'<option value=".de"'.( $domain == '.de' ? ' selected="selected"' : '' ).'>.de</option>'
		.'<option value=".com"'.( $domain == '.com' ? ' selected="selected"' : '' ).'>.com</option>'
		.'<option value=".net"'.( $domain == '.net' ? ' selected="selected"' : '' ).'>.net</option>'
		.'<option value=".org"'.( $domain == '.org' ? ' selected="selected"' : '' ).'>.org</option>'
		.'<option value=".info"'.( $domain == '.info' ? ' selected="selected"' : '' ).'>.info</option>'
		.'<option value=".biz"'.( $domain == '.biz' ? ' selected="selected"' : '' ).'>.biz</option>'
		.'<option value=".at"'.( $domain == '.at' ? ' selected="selected"' : '' ).'>.at</option>'
		.'<option value=".ch"'.( $domain == '.ch' ? ' selected="selected"' : '' ).'>.ch</option>'
		.'<option value=".li"'.( $domain == '.li' ? ' selected="selected"' : '' ).'>.li</option>'
		.'<option value=".co.uk"'.( $domain == '.co.uk' ? ' selected="selected"' : '' ).'>.co.uk</option>'
		.'<option value=".tv"'.( $domain == '.tv' ? ' selected="selected"' : '' ).'>.tv</option>'
		.'<option value=".cc"'.( $domain == '.cc' ? ' selected="selected"' : '' ).'>.cc</option>'
		.'<option value=".dk"'.( $domain == '.dk' ? ' selected="selected"' : '' ).'>.dk</option>'
		.'<option value=".it"'.( $domain == '.it' ? ' selected="selected"' : '' ).'>.it</option>'
		.'<option value=".ws"'.( $domain == '.ws' ? ' selected="selected"' : '' ).'>.ws</option>'
		.'</select>'
		.'<input type="hidden" name="cmd" value="check" />'
		.'<input type="submit" name="submit" value="'._NL_CHECK.'" />'
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
