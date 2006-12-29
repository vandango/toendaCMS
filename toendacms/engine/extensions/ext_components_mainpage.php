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
| File:		ext_components_mainpage.php
| Version:	0.1.1
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');




//if component system is enabled
if($use_components == 1){
	if(file_exists($tcms_administer_site.'/components/'.$item.'/component.xml')){
		// get the component information about the choosen component
		$arrMainCS = $tcms_cs->getMainCS($item);
		
		// if component is not disabled
		if($arrMainCS['id'] != '_TCMS_COMPONENT_DISABLED_'){
			$_TCMS_CS_ID[$item]['id']     = 0;
			$_TCMS_CS_ID[$item]['name']   = $item;
			$_TCMS_CS_ID[$item]['folder'] = $arrMainCS['folder'];
			$_TCMS_CS_ID[$item]['path']   = $arrMainCS['path'];
			
			// get all special settings from it's own xml file
			$_TCMS_CS_ARRAY = $tcms_cs->getSpecialSettings($item, $arrMainCS['settings'], $item);
			
			// finally include the mainsite file
			include_once($tcms_administer_site.'/components/'.$arrMainCS['folder'].'/'.$arrMainCS['file']);
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
