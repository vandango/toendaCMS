<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Components Upload Manager
|
| File:	mod_upload_components.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Components Upload Manager
 *
 * This module is used as a upload and edit page for the
 * components.
 *
 * @version 0.0.3
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage toendaCMS Backend
 */


if(isset($_POST['zlib_upload'])){ $zlib_upload = $_POST['zlib_upload']; }





// ---------------------------------
// VIEW
// ---------------------------------

if($id_group == 'Developer' 
|| $id_group == 'Administrator'){
	/*
		init
	*/
	if(!isset($todo)){ $todo = 'show'; }
	
	
	
	
	
	/*
		upload
	*/
	if($todo == 'show'){
		echo $tcms_html->text(_CS_UPLOAD_TEXT.'<br /><br />', 'left');
		
		
		// form
		echo '<!--BEGIN-FORM-->'
		.'<form name="zlib" id="zlib" action="admin.php?id_user='.$id_user.'&site=mod_upload_components" method="post" enctype="multipart/form-data">'
		.'<input name="todo" type="hidden" value="zlib_save" />'
		.'<!--BEGIN-TABLE-->';
		
		
		// table
		echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" class="noborder">';
		
		
		// table title
		echo '<tr class="tcms_bg_blue_01"><td colspan="2" class="tcms_db_title tcms_padding_mini"><strong>'._CS_UPLOAD_ZTITLE.'</strong></td></tr>';
		echo '<tr><td colspan="2" class="tcms_padding_mini">&nbsp;</td></tr>';
		
		
		// table rows
		echo '<tr><td class="tcms_padding_mini" width="150">'._CS_UPLOAD_ZFILE.'</td><td>'
		.'<input name="zlib_upload" type="file" class="tcms_upload" />'
		.'</td></tr>';
		
		
		echo '<tr><td colspan="2" class="tcms_padding_mini">&nbsp;</td></tr>';
		
		
		// Table end
		echo '</table><br />';
		
		
		// end form
		echo '</form>';
	}
	
	
	
	
	
	/*
		GZ OR ZIP UPLOAD AND INSTALL
	*/
	if($todo == 'zlib_save') {
		if($_FILES['zlib_upload']['size'] > 0 
		&& $_FILES['zlib_upload']['type'] == 'application/zip') {
			// theme file name
			$gzFileName = $_FILES['zlib_upload']['name'];
			
			// theme dir name
			if(strpos($gzFileName, '.zip') == false){ $gzEnd = strpos($gzFileName, '.gz'); }
			else{ $gzEnd = strpos($gzFileName, '.zip'); }
			$gzDirName = substr($gzFileName, 0, $gzEnd);
			
			// make theme dir and make theme var name
			mkdir('../../'.$tcms_administer_site.'/components/'.$gzDirName, 0777);
			
			// theme paths
			$themeDir  = '../../'.$tcms_administer_site.'/components/'.$gzDirName.'/';
			$themePath = '../../'.$tcms_administer_site.'/components/';
			
			// copy file to theme directory
			copy($_FILES['zlib_upload']['tmp_name'], $themeDir.$gzFileName);
			
			// ZLib coding
			$archive = new PclZip($themeDir.$gzFileName);
			if($archive->extract(PCLZIP_OPT_PATH, $themePath) == 0){
				die(_MSG_ERROR.' : '.$archive->errorInfo(true));
			}
			
			// remove zip file
			unlink($themeDir.$gzFileName);
			
			// make path writeable
			chmod($themeDir, 0777);
		}
		
		echo '<script>'
		.'document.location=\'admin.php?id_user='.$id_user.'&site=mod_components\';'
		.'</script>';
	}
}
else {
	echo '<strong>'._MSG_NOTENOUGH_USERRIGHTS.'</strong>';
}

?>
