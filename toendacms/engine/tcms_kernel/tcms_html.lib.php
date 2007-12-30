<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Html structure class
|
| File:	tcms_html.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Html structure class
 *
 * This class is used to provide some often used html
 * codes.
 *
 * @version 0.5.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */

class tcms_html {
	/**
	 * PHP5 Constructor
	 */
	public function __construct() {
	}
	
	
	
	/**
	 * PHP5 Destructor
	 */
	public function __destruct() {
	}
	
	
	
	/**
	 * A header for all content modules
	 * 
	 * @param String $title = ''
	 * @param String $subtitle = ''
	 * @param String $text = ''
	 * @return String
	 */
	public function contentModuleHeader($title = '', $subtitle = '', $text = '') {
		$output = '';
		
		if(trim($title) != '') {
			$output .= $this->contentTitle($title);
		}
		
		if(trim($subtitle) != '') {
			$output .= $this->contentSubtitle($subtitle).'<br />';
		}
		
		if(trim($text) != '' && trim($text) != '---') {
			$output .= $this->contentText($text).'<br />';
		}
		else if(trim($text) != '---') {
			$output .= '<br />';
		}
		
		return $output;
	}
	
	
	
	/**
	 * A header for all content modules
	 * 
	 * @param String $title = ''
	 * @param String $subtitle = ''
	 * @param String $text = ''
	 * @param Object $tcmsScriptObj = null
	 * @return String
	 */
	public function contentModuleHeaderWithParser($title = '', $subtitle = '', $text = '', $tcmsScriptObj = null) {
		if(trim($title) != '') {
			echo $this->contentTitle($title);
		}
		
		if(trim($subtitle) != '') {
			echo $this->contentSubtitle($subtitle).'<br />';
		}
		
		if(trim($text) != '' && trim($text) != '---') {
			echo '<p class="contentmain">';
			$tcmsScriptObj->doParsePHP($text);
			echo '</p><br />';
		}
		else if(trim($text) != '---') {
			echo '<br />';
		}
	}
	
	
	
	/**
	 * A header for the content title
	 * 
	 * @param String $title = ''
	 * @return String
	 */
	public function contentUnderlinedTitle($title = '') {
		return '<div class="text_huge">'.$title.'</div>'
		.'<hr class="hr_line" />'
		.'<br />';
	}
	
	
	
	/**
	 * A header for the content title
	 * 
	 * @param String $title = ''
	 * @return String
	 */
	public function contentTitle($title = '') {
		return '<div class="contentheading">'.$title.'</div>';
	}
	
	
	
	/**
	 * A header for the content subtitle
	 * 
	 * @param String $subtitle = ''
	 * @return String
	 */
	public function contentSubtitle($subtitle) {
		return '<span class="contentstamp">'.$subtitle.'</span><br />';
	}
	
	
	
	/**
	 * A header for the content text
	 * 
	 * @param String $text = ''
	 * @return String
	 */
	public function contentText($text) {
		return ( trim($text) != '' ? '<p class="contentmain">'.$text.'</p><br />' : '' );
	}
	
	
	
	/**
	 * A header for the sidebar title
	 * 
	 * @param String $title = ''
	 * @return String
	 */
	public function sidebarTitle($title) {
		return ( trim($title) != '' ? '<strong class="sideheading">'.$title.'</strong>' : '' );
	}
	
	
	
	/**
	 * A header for the sidebar text
	 * 
	 * @param String $text = ''
	 * @return String
	 */
	public function sidebarText($text) {
		return ( trim($text) != '' ? '<span class="sidemain">'.$text.'</span><br />' : '' );
	}
	
	
	
	/**
	 * Html for a subtitle
	 * 
	 * @param String $subTitle
	 * @return String
	 */
	public function subTitle($subTitle) {
		return ( trim($subTitle) != '' ? '<strong class="menutitle">'.$subTitle.'</strong>' : '' );
	}
	
	
	
	/**
	 * Html for a bold text
	 * 
	 * @param String $text
	 * @return String
	 */
	public function bold($text) {
		return '<strong>'.$text.'</strong><br />';
	}
	
	
	
	/**
	 * Html for a normal text
	 * 
	 * @param String $text
	 * @param String $align = 'left'
	 * @return String
	 */
	public function text($text, $align = 'left') {
		if(trim($align) == '')
			$align = 'left';
		
		return '<span class="text_normal" style="text-align: '.$align.';">'.$text.'</span>';
	}
	
	
	
	/**
	 * Html for a image
	 * 
	 * @param String $path
	 * @param String $barWidth = ''
	 * @param String $barHeight = ''
	 * @return String
	 */
	public function image($path, $barWidth = '', $barHeight = '') {
		return '<img src="'.$path.'" border="0"'
		.( trim($barHeight) != '' ? ' height="'.$barHeight.'"' : '')
		.( trim($barWidth) != '' ? ' width="'.$barWidth.'"' : '')
		.' style="border: 0px !important; margin: 0px !important; padding: 0px !important;" />';
	}
	
	
	
	/**
	 * Html for a hr rule
	 * 
	 * @param String $color = '#000'
	 * @return String
	 */
	public function hr($color = '#000') {
		return '<hr noshade="noshade" style="background: '.$color.'; height: 1px; border: 0px solid '.$color.';" height="1" />';
	}
	
	
	
	/**
	 * Html for a table head
	 * 
	 * @param String $padding = '0'
	 * @param String $spacing = '0'
	 * @param String $border = '0'
	 * @param String $width = '100%'
	 * @return String
	 */
	public function tableHead($padding = '0', $spacing = '0', $border = '0', $width = '100%') {
		return '<table'
		.( trim($padding) != '' ? ' cellpadding="'.$padding.'"' : '')
		.( trim($spacing) != '' ? ' cellspacing="'.$spacing.'"' : '')
		.( trim($border) != '' ? ' border="'.$border.'"' : '')
		.( trim($width) != '' ? ' width="'.$width.'"' : '')
		.'>';
	}
	
	
	
	/**
	 * Html for a table head with a styling tag
	 * 
	 * @param String $padding = '0'
	 * @param String $spacing = '0'
	 * @param String $border = '0'
	 * @param String $width = ''
	 * @param String $style = ''
	 * @return String
	 */
	public function tableHeadStyle($padding = '0', $spacing = '0', $border = '0', $width = '', $style = '') {
		return '<table'
		.( trim($padding) != '' ? ' cellpadding="'.$padding.'"' : '')
		.( trim($spacing) != '' ? ' cellspacing="'.$spacing.'"' : '')
		.( trim($border) != '' ? ' border="'.$border.'"' : '')
		.( trim($width) != '' ? ' width="'.$width.'"' : '')
		.( trim($style) != '' ? ' style="'.$style.'"' : '')
		.'>';
	}
	
	
	
	/**
	 * Html for a table head with a class tag
	 * 
	 * @param String $padding = '0'
	 * @param String $spacing = '0'
	 * @param String $border = '0'
	 * @param String $width = ''
	 * @param String $class = ''
	 * @return String
	 */
	public function tableHeadClass($padding = '0', $spacing = '0', $border = '0', $width = '', $class = '') {
		return '<table'
		.( trim($padding) != '' ? ' cellpadding="'.$padding.'"' : '')
		.( trim($spacing) != '' ? ' cellspacing="'.$spacing.'"' : '')
		.( trim($border) != '' ? ' border="'.$border.'"' : '')
		.( trim($width) != '' ? ' width="'.$width.'"' : '')
		.( trim($class) != '' ? ' class="'.$class.'"' : '')
		.'>';
	}
	
	
	
	/**
	 * Html for a table head with a alignment tag
	 * 
	 * @param String $padding = '0'
	 * @param String $spacing = '0'
	 * @param String $border = '0'
	 * @param String $width = ''
	 * @param String $align = ''
	 * @return String
	 */
	public function tableHeadAlignment($padding = '0', $spacing = '0', $border = '0', $width = '', $align = '') {
		return '<table'
		.( trim($padding) != '' ? ' cellpadding="'.$padding.'"' : '')
		.( trim($spacing) != '' ? ' cellspacing="'.$spacing.'"' : '')
		.( trim($border) != '' ? ' border="'.$border.'"' : '')
		.( trim($width) != '' ? ' width="'.$width.'"' : '')
		.( trim($align) != '' ? ' align="'.$align.'"' : '')
		.'>';
	}
	
	
	
	/**
	 * Html for a table head with a noborder class tag
	 * 
	 * @param String $padding = '0'
	 * @param String $spacing = '0'
	 * @param String $border = '0'
	 * @param String $width = '100%'
	 * @return String
	 */
	public function tableHeadNoBorder($padding = '0', $spacing = '0', $border = '0', $width = '100%') {
		return '<table'
		.( trim($padding) != '' ? ' cellpadding="'.$padding.'"' : '')
		.( trim($spacing) != '' ? ' cellspacing="'.$spacing.'"' : '')
		.( trim($border) != '' ? ' border="'.$border.'"' : '')
		.( trim($width) != '' ? ' width="'.$width.'"' : '')
		.' class="noborder"'
		.'>';
	}
	
	
	
	/**
	 * Display a table row
	 *
	 * @param Integer $rowType = 1 (1 = Admin Global-Setting Row)
	 * @param Integer $rowContentType = 1 (1 = Checkbox)
	 * @param String $title = ''
	 * @param String $inVariable = ''
	 * @param String $outVariableName = ''
	 * @param Boolean $rowIsOdd = false
	 * @param String $rowOddColor = ''
	 * @return String
	 */
	public function tableRow($rowType = 1, $rowContentType = 1, $title = '', $inVariable = '', $outVariableName = '', $rowIsOdd = false, $rowOddColor = '') {
		$row = '';
		
		switch($rowType) {
			case 1:
				/*
					Admin Global-Setting Row
				*/
				
				$row = '<tr'.( $rowIsOdd ? ' style="background: '.$rowOddColor.';"' : '' ).'>'
				.'<td'
				.' width="300"'
				.' height="25"'
				.' style="width: 300px !important;"'
				.' class="tcms_padding_mini"'
				.' valign="top"'
				.'>'
				.$title
				.'</td><td>';
				
				switch($rowContentType) {
					case 1:
						/*
							Checkbox
						*/
						
						$row .= '<input'
						.' type="checkbox"'
						.' id="'.$outVariableName.'"'
						.' name="'.$outVariableName.'"'
						.($inVariable == 1 ? ' checked="checked"' : '' )
						.' value="1"'
						.' />';
						break;
					
					case 2:
						/*
							Textarea
						*/
						
						$row .= '<script language="Javascript">'
						.'var _tcmsVALUE = "Site is proudly powered by'
						.' toendaCMS &#169; 2003 - 2008 Toenda Software Development.'
						.' All rights reserved.<br />toendaCMS is Free Software'
						.' released under the GNU/GPL License.<br />";'
						.'</script>';
						
						$row .= '<textarea'
						.' id="'.$outVariableName.'"'
						.' name="'.$outVariableName.'"'
						.' class="tcms_textarea_big"'
						.'>'.$inVariable.'</textarea>'
						.'<br />'
						//.'<img src="../images/px.png" width="9" height="9" border="0" style="margin: 5px 2px 0 0 !important;" align="left" />'
						.'<input type="button" name="_paste_tcmsVALUE" value="'._GLOBAL_PASTE_FOOTER_TEXT.'"'
						.' onclick="document.getElementById(\'new_footer_text\').value = document.getElementById(\'new_footer_text\').value + _tcmsVALUE" />';
						break;
					
					default:
						break;
				}
				
				$row .= '</td>'
				.'</tr>';
				break;
			
			default:
				break;
		}
		
		return $row;
	}
	
	
	
	/**
	 * Html for the closing table tag
	 * 
	 * @return String
	 */
	public function tableEnd() {
		return '</table>';
	}
	
	
	
	/**
	 * Message for the installer link
	 * 
	 * @return String
	 */
	public function messageInstallerLink() {
		$returnStr = '<div align="center">'
		.'<br /><br /><br /><br />'
		.'<img src="engine/images/tcms_top.jpg" border="0" />'
		.'<h1 style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\'; padding: 50px 0 0 0;">toendaCMS is not installed!</h1>'
		.'<strong style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\';">'
		.'<a style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\'; color: #676767;" href="setup/index.php">Go to installation</a>'
		.'</strong>'
		.'</div>';
		
		return $returnStr;
	}
	
	
	
	/**
	 * Message if the software is installed
	 * 
	 * @return String
	 */
	public function messageIsInstalled() {
		$returnStr = '<div align="center">'
		.'<br /><br /><br /><br />'
		.'<img src="engine/images/tcms_top.jpg" border="0" />'
		.'<h1 style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\'; padding: 50px 0 0 0;">Please remove the <em>setup/</em> folder!</h1>'
		.'<strong style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\';">If you want to update a installed version, '
		.'<a style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\'; color: #676767;" href="setup/index.php">start the installer</a>.'
		.'</strong>'
		.'</div>';
		
		return $returnStr;
	}
	
	
	
	/**
	 * Message if data is unwritebale
	 * 
	 * @return String
	 */
	public function messageUnwritableData() {
		$returnStr = '<div align="center">'
		.'<br /><br /><br /><br />'
		.'<img src="engine/images/tcms_top.jpg" border="0" />'
		.'<h1 style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\'; padding: 50px 0 0 0;">The folder <em>data/</em> is not writable!</h1>'
		.'</div>';
		
		return $returnStr;
	}
	
	
	
	/**
	 * Message if session is unwritebale
	 * 
	 * @return String
	 */
	public function messageUnwritableSession() {
		$returnStr = '<div align="center">'
		.'<br /><br /><br /><br />'
		.'<img src="engine/images/tcms_top.jpg" border="0" />'
		.'<h1 style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\'; padding: 50px 0 0 0;">The folder <em>data/tcms_session/</em> is not writeable!</h1>'
		.'</div>';
		
		return $returnStr;
	}
	
	
	
	/**
	 * Message for updateing
	 * 
	 * @return String
	 */
	public function messageStartUpdate() {
		$returnStr = '<div align="center">'
		.'<br /><br />'
		.'<h1 style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\'; padding: 50px 0 0 0;">'
		.'Version is not up to date!</h1>'
		.'<strong style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\';">'
		.'<a style="font-family: Georgia, \'Lucida Grande\', \'Lucida Sans\'; color: #676767;" href="setup/index.php">'
		.'Start update!</a>'
		.'</strong>'
		.'</div>';
		
		return $returnStr;
	}
	
	
	
	/**
	 * Message for the test environment
	 * 
	 * @return String
	 */
	public function messageIsTestEnvironment() {
		$returnStr = '<div style="'
		.'background: #ffff80; padding: 5px; border: solid 5px #ff0000; '
		.'width: auto; text-align: center; font-weight: bold; color: #ff0000;'
		.'"><strong>'._TCMS_TEST_ENVIRONMENT.'</strong></div>';
		
		return $returnStr;
	}
	
	
	
	/**
	 * Poll vote bar with radio button
	 * 
	 * @param String $question = ''
	 * @param Integer $value = 0
	 * @param Integer $width = 10
	 * @return String
	 */
	public function pollVoteBar($question = '', $value = 0, $width = 10) {
		return '<div class="poll_sheet" style="width: '.$width.'px;">'
		.'<input type="radio" name="answer" value="'.$value.'" />&nbsp;'
		.( $question == '' ? '' : $question )
		.'</div>';
	}
	
	
	
	/**
	 * Poll result table
	 * 
	 * @param String $tr_height = '10'
	 * @param String $vote_name
	 * @param String $vb_width
	 * @param String $vote_bar
	 * @param String $vote_number
	 * @param String $vote_percent
	 * @return String
	 */
	public function pollResultTable($tr_height = '10', $vote_name, $vb_width, $vote_bar, $vote_number, $vote_percent) {
		$prt = '<tr align="left" height="'.$tr_height.'" class="sidemain">'
		.'<td align="left" colspan="3">'.$vote_name.'</td>'
		.'</tr>'
		.'<tr align="left" height="'.$tr_height.'" class="sidemain">'
		.'<td align="left" width="'.$vb_width.'" align="left">'.$vote_bar.'</td>'
		.'<td width="10" align="right">&nbsp;'.$vote_number.'&nbsp;</td>'
		.'<td width="10" align="right">&nbsp;'.$vote_percent.'&nbsp;</td>'
		.'</tr>';
		
		return $prt;
	}
	
	
	
	/**
	 * Poll result table break line
	 * 
	 * @param String $color = '#ccc'
	 * @return String
	 */
	public function pollResultTableBreakLine($color = '#ccc') {
		return '<tr style="height: 1px; background-color: '.$color.';"><td colspan="3"></td></tr>';
	}
	
	
	
	/**
	 * Search result bar
	 * 
	 * @param String $text = ''
	 * @return String
	 */
	public function searchResultTitle($text = '') {
		return '<div class="search_result_bar">'.$text.'</div>';
	}
	
	
	
	/**
	 * Search result panel
	 * 
	 * @param String $text = ''
	 * @return String
	 */
	public function searchResultPanel($text) {
		return '<div class="search_result">'.$text.'</div>';
	}
	
	
	
	/**
	 * Search panel
	 * 
	 * @param String $text
	 * @param String $url_and_searchword
	 * @param String $image
	 * @return String
	 */
	public function searchPanel($text, $url_and_searchword, $image) {
		return '<table cellpadding="0" cellspacing="0" border="0">'
		.'<tr><td valign="top" style="height: 18px; font-family: Verdana, sans-serif; font-size : 11px;">'
		.$text.'&nbsp;'
		.'</td><td valign="top">'
		.'<a href="'.$url_and_searchword.'" target="_blank"><img src="'.$image.'" border="0" /></a>'
		.'</td></tr></table>';
	}
	
	
	
	/**
	 * Userprofile Titlebox
	 * 
	 * @param String $title = ''
	 * @return String
	 */
	public function userProfileTitle($title) {
		return '<div style="display: block; width: 100%;" class="user_profile_title">'.$title.'</div>';
	}
	
	
	
	/**
	 * displayExceptionDisplay an exception
	 *
	 * @param String $message
	 * @param Array $stacktrace
	 * @param Integer $line
	 * @param String $file
	 * @param Integer $line
	 */
	public function displayException($message, $stacktrace, $line, $file, $code) {
		//$stacktrace = str_replace('\n', '<br />', $stacktrace);
		
		echo '<br />'
		.'<div style="'
		.'display: block; width: 600px; padding: 10px; border: 2px solid #ff0000; background: #ececec;'
		.'">'
		.'<strong>ERROR</strong>'
		.'<br />'
		.'<br />'
		.'<strong>File:</strong> '.$file
		.'<br />'
		.'<strong>Line:</strong> '.$line
		.'<br />'
		.'<strong>Code:</strong> '.$code
		.'<br />'
		.'<strong>Message:</strong> '.$message
		.'<br />'
		.'<strong>Stacktrace:</strong>'
		.'<br />';
		
		foreach($stacktrace as $key => $value) {
			echo '<br />';
			
			echo '&nbsp;&nbsp;&nbsp;&nbsp;File: '.$value['file'].'<br />';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;Line: '.$value['line'].'<br />';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;public function: '.$value['public function'].'<br />';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;Class: '.$value['class'].'<br />';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;Type: '.$value['type'].'<br />';
			
			foreach($value['args'] as $key => $val) {
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Argument #'.$key.': '.$val.'<br />';
			}
			
			echo '<br />';
		}
		
		echo '<br />'
		.'</div>';
	}
	
	
	// ------------------------------------
	// DEPRECATED
	// ------------------------------------
	
	
	
	/**
	 * DEPRECATED: Html for a table head
	 * 
	 * @deprecated
	 * @param String $padding = '0'
	 * @param String $spacing = '0'
	 * @param String $border = '0'
	 * @param String $width = ''
	 * @return String
	 */
	public function table_head($padding = '0', $spacing = '0', $border = '0', $width = '') {
		return tcms_html::tableHead($padding, $spacing, $border, $width);
	}
	
	
	
	/**
	 * DEPRECATED: Html for a table head with a styling tag
	 * 
	 * @deprecated
	 * @param String $padding = '0'
	 * @param String $spacing = '0'
	 * @param String $border = '0'
	 * @param String $width = ''
	 * @param String $style = ''
	 * @return String
	 */
	public function table_head_style($padding = '0', $spacing = '0', $border = '0', $width = '', $style = '') {
		return tcms_html::tableHeadStyle($padding, $spacing, $border, $width, $style);
	}
	
	
	
	/**
	 * DEPRECATED: Html for a table head with a class tag
	 * 
	 * @deprecated
	 * @param String $padding = '0'
	 * @param String $spacing = '0'
	 * @param String $border = '0'
	 * @param String $width = ''
	 * @param String $class = ''
	 * @return String
	 */
	public function table_head_cl($padding = '0', $spacing = '0', $border = '0', $width = '', $class = '') {
		return tcms_html::tableHeadClass($padding, $spacing, $border, $width, $class);
	}
	
	
	
	/**
	 * DEPRECATED: Html for a table head with a alignment tag
	 * 
	 * @deprecated
	 * @param String $padding = '0'
	 * @param String $spacing = '0'
	 * @param String $border = '0'
	 * @param String $width = ''
	 * @param String $align = ''
	 * @return String
	 */
	public function table_head_align($padding = '0', $spacing = '0', $border = '0', $width = '', $align = '') {
		return tcms_html::tableHeadAlignment($padding, $spacing, $border, $width, $align);
	}
	
	
	
	/**
	 * DEPRECATED: Html for a table head with a noborder class tag
	 * 
	 * @deprecated
	 * @param String $padding = '0'
	 * @param String $spacing = '0'
	 * @param String $border = '0'
	 * @param String $width = ''
	 * @return String
	 */
	public function table_head_nb($padding = '0', $spacing = '0', $border = '0', $width = '') {
		return tcms_html::tableHeadNoBorder($padding, $spacing, $border, $width);
	}
	
	
	
	/**
	 * DEPRECATED: Html for the closing table tag
	 * 
	 * @deprecated
	 * @return String
	 */
	public function table_end() {
		return tcms_html::tableEnd();
	}
	
	
	
	/**
	 * DEPRECATED: Message for the installer link
	 * 
	 * @deprecated
	 * @return String
	 */
	public function msg_gotoinstall() {
		return tcms_html::messageInstallerLink();
	}
	
	
	
	/**
	 * DEPRECATED: Message if data is unwritebale
	 * 
	 * @deprecated
	 * @return String
	 */
	public function msg_nowrite_data() {
		return tcms_html::messageUnwritableData();
	}
	
	
	
	/**
	 * DEPRECATED: Message if session is unwritebale
	 * 
	 * @deprecated
	 * @return String
	 */
	public function msg_nowrite_session() {
		return tcms_html::messageUnwritableSession();
	}
	
	
	
	/**
	 * DEPRECATED: Message if the software is installed
	 * 
	 * @deprecated
	 * @return String
	 */
	public function msg_isinstalled() {
		return tcms_html::messageIsInstalled();
	}
	
	
	
	/**
	 * DEPRECATED: Poll vote bar with radio button
	 * 
	 * @deprecated
	 * @param String $question = ''
	 * @param Integer $value = 0
	 * @param Integer $width = 10
	 * @return String
	 */
	public function poll_sheet($question, $value, $width) {
		return tcms_html::pollVoteBar($question, $value, $width);
	}
	
	
	
	/**
	 * DEPRECATED: A header for the content title
	 * 
	 * @deprecated
	 * @param String $title = ''
	 * @return String
	 */
	public function contentheading($title = '') {
		return tcms_html::contentTitle($title);
	}
	
	
	
	/**
	 * DEPRECATED: A header for the content subtitle
	 * 
	 * @deprecated
	 * @param String $subtitle = ''
	 * @return String
	 */
	public function contentstamp($subtitle) {
		return tcms_html::contentSubtitle($subtitle);
	}
	
	
	
	/**
	 * DEPRECATED: A header for the content text
	 * 
	 * @deprecated
	 * @param String $text = ''
	 * @return String
	 */
	public function contentmain($text) {
		return tcms_html::contentText($text);
	}
	
	
	
	/**
	 * DEPRECATED: A header for the sidebar title
	 * 
	 * @deprecated
	 * @param String $title = ''
	 * @return String
	 */
	public function sideheading($title) {
		return tcms_html::sidebarTitle($title);
	}
	
	
	
	/**
	 * DEPRECATED: A header for the sidebar text
	 * 
	 * @deprecated
	 * @param String $text = ''
	 * @return String
	 */
	public function sidemain($text) {
		return tcms_html::sidebarText($text);
	}
	
	
	
	/**
	 * DEPRECATED: Userprofile Titlebox
	 * 
	 * @deprecated
	 * @param String $title = ''
	 * @return String
	 */
	public function user_gerneral($title = '') {
		return tcms_html::userProfileTitle($title);
	}
	
	
	
	/**
	 * DEPRECATED: Poll result table
	 * 
	 * @deprecated
	 * @param String $tr_height = '10'
	 * @param String $vote_name
	 * @param String $vb_width
	 * @param String $vote_bar
	 * @param String $vote_number
	 * @param String $vote_percent
	 * @return String
	 */
	public function poll_result_table($tr_height, $vote_name, $vb_width, $vote_bar, $vote_number, $vote_percent) {
		echo tcms_html::pollResultTable($tr_height, $vote_name, $vb_width, $vote_bar, $vote_number, $vote_percent);
	}
	
	
	
	/**
	 * DEPRECATED: Poll result table break line
	 * 
	 * @deprecated
	 * @param String $color = '#ccc'
	 * @return String
	 */
	public function poll_result_table_line($color = '#ccc') {
		return tcms_html::pollResultTableBreakLine($color);
	}
	
	
	
	/**
	 * DEPRECATED: Search result bar
	 * 
	 * @deprecated
	 * @param String $text = ''
	 * @return String
	 */
	public function search_result_bar($text = '') {
		return tcms_html::searchResultTitle($text);
	}
	
	
	
	/**
	 * DEPRECATED: Search result panel
	 * 
	 * @deprecated
	 * @param String $text = ''
	 * @return String
	 */
	public function search_result($text) {
		return tcms_html::searchResultPanel($text);
	}
	
	
	
	/**
	 * DEPRECATED: Search panel
	 * 
	 * @deprecated
	 * @param String $text
	 * @param String $url_and_searchword
	 * @param String $image
	 * @return String
	 */
	public function search_box($text, $url_and_searchword, $image) {
		return tcms_html::searchPanel($text, $url_and_searchword, $image);
	}
}

?>
