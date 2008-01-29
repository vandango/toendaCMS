<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Component System Loader - Maincontent
|
| File:	ext_components.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Component System Loader - Maincontent
 *
 * This module is used as a base components loader.
 *
 * @version 0.1.5
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


//if component system is enabled
if($tcms_config->getComponentsSystemEnabled()){
	if($tcms_file->checkFileExist(_TCMS_PATH.'/components/'.$item.'/component.xml')){
		// get the component information about the choosen component
		$arrMainCS = $tcms_cs->getMainCS($item, $is_admin);
		
		// if component is not disabled
		if($arrMainCS['id'] != '_TCMS_COMPONENT_DISABLED_'){
			$_TCMS_CS_ID[$item]['id']     = 0;
			$_TCMS_CS_ID[$item]['name']   = $item;
			$_TCMS_CS_ID[$item]['folder'] = $arrMainCS['folder'];
			$_TCMS_CS_ID[$item]['path']   = $arrMainCS['path'];
			
			// get all special settings from it's own xml file
			$_TCMS_CS_ARRAY = $tcms_cs->getSpecialSettings(
				$item, 
				$arrMainCS['settings'], 
				$item
			);
			
			// finally include the mainsite file
			include_once(_TCMS_PATH.'/components/'.$arrMainCS['folder'].'/'.$arrMainCS['file']);
		}
		else{
			echo '<strong>'._MSG_DISABLED_MODUL.'</strong>';
		}
	}
	else{
		echo '<strong>'._MSG_DISABLED_MODUL.'</strong>';
	}
}

?>
