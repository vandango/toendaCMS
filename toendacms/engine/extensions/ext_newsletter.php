<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Extension Newsletter
|
| File:		ext_newsletter.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Newsletter Module
 *
 * This module provides the newsletter functionality.
 *
 * @version 0.3.4
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Sidebar Modules
 */


if(isset($_POST['newsletter'])){ $newsletter = $_POST['newsletter']; }
if(isset($_POST['nl_email'])){ $nl_email = $_POST['nl_email']; }
if(isset($_POST['nl_user'])){ $nl_user = $_POST['nl_user']; }



if(!isset($newsletter)){ $newsletter = ''; }



if($use_newsletter == 1){
	if($choosenDB == 'xml'){
		$nl_xml = new xmlparser(_TCMS_PATH.'/tcms_global/newsletter.xml','r');
		$show_ext_nl_title    = $nl_xml->read_section('newsletter', 'nl_show_title');
		$text_ext_newsletter  = $nl_xml->read_section('newsletter', 'nl_text');
		$title_ext_newsletter = $nl_xml->read_section('newsletter', 'nl_title');
		$link_ext_newsletter  = $nl_xml->read_section('newsletter', 'nl_link');
	}
	else{
		$sqlAL = new sqlAbstractionLayer($choosenDB);
		$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
		
		$sqlQR = $sqlAL->sqlGetOne($tcms_db_prefix.'newsletter', 'newsletter');
		$sqlARR = $sqlAL->sqlFetchArray($sqlQR);
		
		$show_ext_nl_title    = $sqlARR['nl_show_title'];
		$text_ext_newsletter  = $sqlARR['nl_text'];
		$title_ext_newsletter = $sqlARR['nl_title'];
		$link_ext_newsletter  = $sqlARR['nl_link'];
	}
	
	
	$text_ext_newsletter  = $tcms_main->decodeText($text_ext_newsletter, '2', $c_charset);
	$title_ext_newsletter = $tcms_main->decodeText($title_ext_newsletter, '2', $c_charset);
	$link_ext_newsletter  = $tcms_main->decodeText($link_ext_newsletter, '2', $c_charset);
	
	if($show_ext_nl_title == 1) {
		echo $tcms_html->subTitle($title_ext_newsletter, 'center');
	}
	else {
		//echo $tcms_html->text($text_ext_newsletter, 'left');
		$tcms_html->text($text_ext_newsletter, 'left');
	}
	
	echo '<div align="left">'
	.'<form name="selectform" action="'.( $seoEnabled == 1 ? $seoFolder.'/' : '' ).'?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'" method="post">'
	.'<input type="hidden" name="id" value="'.$id.'" />'
	.'<input type="hidden" name="s" value="'.$s.'" />'
	.'<input type="hidden" name="newsletter" value="subscribe" />'
	.( isset($lang) ? '<input type="hidden" name="lang" value="'.$lang.'" />' : '' );
	
	echo '<input type="text" name="nl_user" class="inputtext" style="width: 150px;" value="'._NL_USERNAME.'" onBlur="if(this.value==\'\') this.value=\''._NL_USERNAME.'\';" onfocus="if(this.value==\''._NL_USERNAME.'\') this.value=\'\';" /><br />'
	.'<input type="text" name="nl_email" class="inputtext" style="width: 150px;" value="'._NL_USEREMAIL.'" onBlur="if(this.value==\'\') this.value=\''._NL_USEREMAIL.'\';" onfocus="if(this.value==\''._NL_USEREMAIL.'\') this.value=\'\';" /><br />'
	.'<input type="submit" value="'.$link_ext_newsletter.'" class="inputbutton" />';
	
	echo '</form>'
	.'</div>';
	
	echo '<br /><br />';
}





// -----------------------------------
// SUBSCRIBING
// -----------------------------------

if($use_newsletter == 1) {
	if($newsletter == 'subscribe') {
		if($nl_email == '' 
		|| $nl_email == _NL_USEREMAIL 
		|| strpos($nl_email, '@') == false) {
			$link = '?session='.$session.'&id='.$id.'&s='.$s
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<script>'
			.'document.location=\''.$link.'\';'
			.'alert(\''._MSG_NOEMAIL.' ...\');'
			.'</script>';
		}
		elseif($nl_user == '' || $nl_user == _NL_USERNAME) {
			$link = '?session='.$session.'&id='.$id.'&s='.$s
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<script>'
			.'document.location=\''.$link.'\';'
			.'alert(\''._MSG_NONAME.' ...\');'
			.'</script>';
		}
		else{
			if($choosenDB == 'xml'){
				while(($tmp_md5 = substr(md5(time()),0,6)) && file_exists(_TCMS_PATH.'/tcms_newsletter/'.$tmp_md5.'.xml')){}
				
				$var_conf = 'nl_user';
				
				$nl_user = $tcms_main->encodeText($nl_user, '2', $c_charset);
				
				$xmluser = new xmlparser(_TCMS_PATH.'/tcms_newsletter/'.$tmp_md5.'.xml', 'w');
				$xmluser->xml_declaration();
				$xmluser->xml_section($var_conf);
				
				$xmluser->write_value('user', $nl_user);
				$xmluser->write_value('email', $nl_email);
				
				$xmluser->xml_section_buffer();
				$xmluser->xml_section_end($var_conf);
			}
			else{
				$maintag = $tcms_main->create_uid($choosenDB, $sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort, $tcms_db_prefix.'newsletter_items', 6);
				
				$nl_user = $tcms_main->encodeText($nl_user, '2', $c_charset);
				
				$sqlAL = new sqlAbstractionLayer($choosenDB);
				$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
				
				switch($choosenDB){
					case 'mysql':
						$newSQLColumns = '`user`, `email`';
						break;
					
					case 'pgsql':
						$newSQLColumns = '"user", email';
						break;
					
					case 'mssql':
						$newSQLColumns = '[user], [email]';
						break;
				}
				
				$newSQLData = "'".$nl_user."', '".$nl_email."'";
				
				$sqlQR = $sqlAL->sqlCreateOne($tcms_db_prefix.'newsletter_items', $newSQLColumns, $newSQLData, $maintag);
			}
			
			$link = '?'.( isset($session) ? 'session='.$session.'&' : '' ).'id='.$id.'&s='.$s
			.( isset($lang) ? '&amp;lang='.$lang : '' );
			$link = $tcms_main->urlConvertToSEO($link);
			
			echo '<script>'
			.'document.location=\''.$link.'\';'
			.'alert(\''._MSG_NEWSLETTER.'\');'
			.'</script>';
		}
	}
}

?>
