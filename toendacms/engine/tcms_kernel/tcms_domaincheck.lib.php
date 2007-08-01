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
 * @version 0.0.4
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
 * getDomainCheckForm          -> This is a domain checker formular
 * 
 * </code>
 * 
 */


class tcms_domaincheck {
	private $_arrWhoisServers;
	
	/**
	 * PHP5 Constructor
	 *
	 */
	function __construct() {
		$this->_arrWhoisServers = array(
			'de'     => array('whois.denic.de', 'No match for'),
			'at'     => array('whois.nit.at', 'No match for'),
			'ch'     => array('whois.nic.ch', 'No match for'),
			'li'     => array('whois.nic.ch', 'No match for'),
			'tv'     => array('whois.www.tv', 'No match for'),
			'it'     => array('whois.nic.it', 'No match for'),
			'dk'     => array('whois.dk-hostmaster.dk', 'No match for'),
			'com'    => array('whois.crsnic.net', 'No match for'),
			'net'    => array('whois.crsnic.net', 'No match for'),
			'org'    => array('whois.pir.org', 'NOT FOUND'),
			'biz'    => array('whois.biz', 'Not found'),
			'info'   => array('whois.afilias.net', 'NOT FOUND'),
			'co.uk'  => array('whois.nic.uk', 'No match'),
			'co.ug'  => array('wawa.eahd.or.ug', 'No entries found'),
			'or.ug'  => array('wawa.eahd.or.ug', 'No entries found'),
			'ac.ug'  => array('wawa.eahd.or.ug', 'No entries found'),
			'ne.ug'  => array('wawa.eahd.or.ug', 'No entries found'),
			'sc.ug'  => array('wawa.eahd.or.ug', 'No entries found'),
			'nl' 	 => array('whois.domain-registry.nl', 'not a registered domain'),
			'ro'     => array('whois.rotld.ro', 'No entries found for the selected'),
			'com.au' => array('whois.ausregistry.net.au', 'No data Found'),
			'ca'     => array('whois.cira.ca', 'AVAIL'),
			'org.uk' => array('whois.nic.uk', 'No match'),
			'name'   => array('whois.nic.name', 'No match'),
			'us'     => array('whois.nic.us', 'Not Found'),
			'ws'     => array('whois.website.ws', 'No Match'),
			'be'     => array('whois.ripe.net', 'No entries'),
			'com.cn' => array('whois.cnnic.cn', 'no matching record'),
			'net.cn' => array('whois.cnnic.cn', 'no matching record'),
			'org.cn' => array('whois.cnnic.cn', 'no matching record'),
			'no'     => array('whois.norid.no', 'no matches'),
			'se'     => array('whois.nic-se.se', 'No data found'),
			'nu'     => array('whois.nic.nu', 'NO MATCH for'),
			'com.tw' => array('whois.twnic.net', 'No such Domain Name'),
			'net.tw' => array('whois.twnic.net', 'No such Domain Name'),
			'org.tw' => array('whois.twnic.net', 'No such Domain Name'),
			'cc'     => array('whois.nic.cc', 'No match'),
			'nl'     => array('whois.domain-registry.nl', 'is free'),
			'pl'     => array('whois.dns.pl', 'No information about'),
			'pt'     => array('whois.ripe.net', 'No entries found')
			//'org'    => array('whois.networksolutions.com', 'NOT FOUND'),
			//'com'    => array('rs.internic.net', 'No match for'),
			//'net'    => array('rs.internic.net', 'No match for'),
			//'cc'     => array('whois.enicregistrar.com', 'No match'),
			//'ws'     => array('whois.worldsite.ws', 'No Match'),
		);
	}
	
	
	
	/**
	 * PHP4 Constructor
	 *
	 */
	function tcms_domaincheck() {
		$this->__construct();
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	function __destruct() {
	}
	
	
	
	/**
	 * PHP4 Destructor
	 */
	function _tcms_domaincheck() {
		$this->__destruct();
	}
	
	
	
	/**
	 * This is a domain checker formular
	 *
	 * @param String $link
	 * @param String $domainname = ''
	 * @param String $domain = ''
	 * @return String
	 */
	function getDomainCheckForm($link, $domainname = '', $domain = '') {
		$input = '<form name="toendaDC" method="post" action="'.$link.'">'
		.'http://www. <input type="text" name="dc_name" value="'.$domainname.'" />'
		.'<select name="dc_domain">';
		
		foreach($this->_arrWhoisServers as $key => $val) {
			$input .= '<option value="'.$key.'"'.( $domain == $key ? ' selected="selected"' : '' ).'>'
			.'.'.$key
			.'</option>';
		}
		
		$input .= '</select>'
		.'<input type="hidden" name="cmd" value="check" />'
		.'<input type="submit" name="submit" value="'._NL_CHECK.'" />'
		.'</form>';
		
		return $input;
	}
	
	
	
	/**
	 * Check the name of a url for false characters
	 *
	 * @param String $domain
	 */
	function checkName($domain) {
		$domain = trim($domain);
		
		if($domain == '') {
			return false;
		}
		
		if(strlen($domain) < 3 || strlen($domain) > 57) {
			return false;
		}
		
		if(@ereg("^-|-$", $domain)) {
			return false;
		}
		
		if(!ereg("([a-z]|[A-Z]|[0-9]|-){".strlen($domain)."}", $domain)) {
			return false;
		}
		
		return true;
	}
	
	
	
	/**
	 * Get a list of whois server
	 *
	 * @param String $domain
	 * @return Array
	 */
	function getWhoisServer($domain) {
		$arrWhoisServers = array(
			"com" => array("whois.crsnic.net","No match for"),
			"net" => array("whois.crsnic.net","No match for"),				
			"org" => array(" whois.pir.org","NOT FOUND"),					
			"biz" => array("whois.biz","Not found"),					
			"info" => array("whois.afilias.net","NOT FOUND"),					
			"co.uk" => array("whois.nic.uk","No match"),					
			"co.ug" => array("wawa.eahd.or.ug","No entries found"),	
			"or.ug" => array("wawa.eahd.or.ug","No entries found"),
			"ac.ug" => array("wawa.eahd.or.ug","No entries found"),
			"ne.ug" => array("wawa.eahd.or.ug","No entries found"),
			"sc.ug" => array("wawa.eahd.or.ug","No entries found"),
			"nl" 	=> array("whois.domain-registry.nl","not a registered domain"),
			"ro" => array("whois.rotld.ro","No entries found for the selected"),
			"com.au" => array("whois.ausregistry.net.au","No data Found"),
			"ca" => array("whois.cira.ca", "AVAIL"),
			"org.uk" => array("whois.nic.uk","No match"),
			"name" => array("whois.nic.name","No match"),
			"us" => array("whois.nic.us","Not Found"),
			"ws" => array("whois.website.ws","No Match"),
			"be" => array("whois.ripe.net","No entries"),
			"com.cn" => array("whois.cnnic.cn","no matching record"),
			"net.cn" => array("whois.cnnic.cn","no matching record"),
			"org.cn" => array("whois.cnnic.cn","no matching record"),
			"no" => array("whois.norid.no","no matches"),
			"se" => array("whois.nic-se.se","No data found"),
			"nu" => array("whois.nic.nu","NO MATCH for"),
			"com.tw" => array("whois.twnic.net","No such Domain Name"),
			"net.tw" => array("whois.twnic.net","No such Domain Name"),
			"org.tw" => array("whois.twnic.net","No such Domain Name"),
			"cc" => array("whois.nic.cc","No match"),
			"nl" => array("whois.domain-registry.nl","is free"),
			"pl" => array("whois.dns.pl","No information about"),
			"pt" => array("whois.ripe.net","No entries found")
		);
		
		/*
		$arrWhoisServers['de']['whois.denic.de'];
		$arrWhoisServers['com']['rs.internic.net'];
		$arrWhoisServers['net']['rs.internic.net'];
		$arrWhoisServers['org']['whois.networksolutions.com'];
		$arrWhoisServers['info']['whois.afilias.net'];
		$arrWhoisServers['biz']['whois.biz'];
		$arrWhoisServers['at']['whois.nic.at'];
		$arrWhoisServers['ch']['whois.nic.ch'];
		$arrWhoisServers['li']['whois.nic.ch'];
		$arrWhoisServers['co.uk']['whois.nic.uk'];
		$arrWhoisServers['tv']['whois.www.tv'];
		$arrWhoisServers['cc']['whois.enicregistrar.com'];
		$arrWhoisServers['dk']['whois.dk-hostmaster.dk'];
		$arrWhoisServers['it']['whois.nic.it'];
		$arrWhoisServers['ws']['whois.worldsite.ws'];
		*/
		
		
		$amount = count($arrWhoisServers, COUNT_RECURSIVE);
		//echo 'anzahl server: '.$amount.'<br>';
		
		for($x = 0; $x < $amount; $x++) {
			$artld = $arrWhoisServers[$x][0];
			$tldlen = intval(0 - strlen($artld));
			
			//echo $x.' --- '.$artld.' --- '.$tldlen.'<br>';
			
			if(substr($domain, $tldlen) == $artld) {
				$server = $arrWhoisServers[$x][1];
				//echo $server.'<br>';
			}
		}
		
		return $server;
	}
	
	
	
	
	
	
	
	
	
	
	
	function checkDomain($domain, $ext) {
		$output = '';
		
		echo 'connect to: '.$this->_arrWhoisServers[$ext][0].'<br>';
		
		if(($sc = fsockopen($this->_arrWhoisServers[$ext][0], 43)) == false) {
			return 2;
		}
		
		fputs($sc, $domain.$ext);
		
		while(!feof($sc)){
			$output .= fgets($sc, 128);
		}
		
		fclose($sc);
		
		echo 'ausgabe: '.$output.'<br>';
		
		//compare what has been returned by the server
		if(eregi($this->_arrWhoisServers[$ext][1], $output)) {
			return 0;
		}
		else{
			return 1;
		}
	}
	
	
	
	
	
	
	function whois($domain,$ext)
{ $template = '';
$server = $this->_arrWhoisServers[$ext][0];
    if(($sc = fsockopen($server,43))==false){
        if(($sc = fsockopen($server,43))==false){
            //echo"There is a temporary service disruption Please again try later";
            $layout =2;
            print_results($layout);
            exit;
        }
    }
    if($ext=="com"||$ext=="net"){
        //
        fputs($sc, "$domain.$ext\n");
        while(!feof($sc)){
            $temp = fgets($sc,128);
            if(ereg("Whois Server:", $temp)) {
                $server = str_replace("Whois Server: ", "", $temp);
                $server = trim($server);
            }
        }
        fclose($sc);
        if(($sc = fsockopen($server,43))==false){
            //echo"There is a temporary service disruption Please try later";
            $layout =2;
            print_results($layout);
            exit;
        }
    }

    $output="";
    fputs($sc,"$domain.$ext\n");
    while(!feof($sc)){$output.=fgets($sc,128);}
    fclose($sc);
    //print
	print_whois($output);
    

}
	
	
	
	
	
	/*
	*/
	function lookUp($dcName, $dcDomain, $option) {
		echo '<br>start check for '.$dcName.'.'.$dcDomain.' by '.$option.' ...<br>';
		
		$domain = $dcName;
		$ext = $dcDomain;
		
		if(array_key_exists($dcDomain, $this->_arrWhoisServers)) {
			if($option == 'check') {
				echo '<br>dimain:'.$this->checkDomain($dcName, $dcDomain).'<br>';
			}
			else if($option == 'whois') {
				$this->whois($domain,$ext);
			}
		}
    elseif($ext == "co.za"){
    	if($option == "check"){
    	   if(function_exists(curl_init)){
					$layout = cozacurlcheck($domain);
			}else{
					$layout = cozacheck($domain);
			}
			print_results($layout);
		}elseif($option=="whois"){
			if(function_exists(curl_init)){
				cozacurlwhois($domain);
			}else{
				cozawhois($domain);
			}
		}
    }
    elseif($ext == "all"){
	    $layout = "<tr>\n<td>\n<table width=\"100%\" border=\"0\" cellPadding=2 class=font1l>\n";
	    foreach($serverdefs as $ext => $servers)
	    {
		    $server = $servers[0];
		    $nomatch = $servers[1];
		    $available = check_domain($domain, $ext);
		    if ($available == 0)
		    {
			    $layout .= sprintf("<tr>\n<td>\n%s.%s</td>\n<td>\n<font color=\"green\">\n<b>Available!</b>\n</font>\n</td>\n", $domain, $ext);
			    $layout .= sprintf("<td>\n<a href=\"%s?domain=%s.%s\">register now</a>\n</td>\n</tr>\n", $registerlink, $domain, $ext);
			}
			elseif ($available == 2)
		    {
			    $layout .= sprintf("<tr>\n<td>\n%s.%s</td>\n<td>\n<font color=\"grey\">\nUnknown</font>\n</td>\n", $domain, $ext);
			    $layout .= "<td>\nCould not contact server</td>\n</tr>\n";
			}
			else
			{
				$layout .= sprintf("\n<tr>\n<td>\n%s.%s</td>\n<td>\n<font color=\"red\">Taken\n</font>\n</td>\n", $domain, $ext);
			   $layout .= sprintf("<td>\n<a href=\"%s?domain=%s&ext=%s&option=whois\">check whois</a></td>\n</tr>\n", $PHP_SELF, $domain, $ext);
		   }
	    }
	    $layout .= "</table>\n</td>\n</tr>\n";
	    $ext = " all supported domains";
	    print_results($layout);
	}
/*
		
		
		$lusrv = $this->getWhoisServer($dc_name);
		
		echo 'whoisserver: '.$lusrv.'<br>';
		
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
		}*/
	}
}


?>
