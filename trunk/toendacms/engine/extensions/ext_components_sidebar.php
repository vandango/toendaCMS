<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Component System Loader - Sidebar
|
| File:	ext_components_sidebar.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * Component System Loader - Sidebar
 *
 * This module is used as a base components loader.
 *
 * @version 0.1.7
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage Content Modules
 */


if($tcms_config->getComponentsSystemEnabled()){
	if(is_array($arrSideCS) && !empty($arrSideCS)){
		foreach($arrSideCS['id'] as $key => $val){
			//echo $item.' - '.$arrSideCS['id'][$key].'<br>';
			
			$_TCMS_CS_ID[$arrSideCS['id'][$key]]['id']     = $key;
			$_TCMS_CS_ID[$arrSideCS['id'][$key]]['name']   = $arrSideCS['id'][$key];
			$_TCMS_CS_ID[$arrSideCS['id'][$key]]['folder'] = $arrSideCS['folder'][$key];
			$_TCMS_CS_ID[$arrSideCS['id'][$key]]['path']   = $arrSideCS['path'][$key];
			
			
			$_TCMS_CS_ARRAY = $tcms_cs->getSpecialSettings(
				$arrSideCS['folder'][$key], 
				$arrSideCS['settings'][$key], 
				$arrSideCS['id'][$key]
			);
			
			
			include_once(_TCMS_PATH.'/components/'.$arrSideCS['folder'][$key].'/'.$arrSideCS['file'][$key]);
			
			
			//echo '<br /><br />';
		}
	}
}

?>
