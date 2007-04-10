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
| File:		ext_components_sidebar.php
| Version:	0.1.4
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');




if($use_components == 1){
	if(is_array($arrSideCS) && !empty($arrSideCS)){
		foreach($arrSideCS['id'] as $key => $val){
			//echo $item.' - '.$arrSideCS['id'][$key].'<br>';
			//if($item == $arrSideCS['id'][$key]){
				$_TCMS_CS_ID[$arrSideCS['id'][$key]]['id']     = $key;
				$_TCMS_CS_ID[$arrSideCS['id'][$key]]['name']   = $arrSideCS['id'][$key];
				$_TCMS_CS_ID[$arrSideCS['id'][$key]]['folder'] = $arrSideCS['folder'][$key];
				$_TCMS_CS_ID[$arrSideCS['id'][$key]]['path']   = $arrSideCS['path'][$key];
				
				
				$_TCMS_CS_ARRAY = $tcms_cs->getSpecialSettings($arrSideCS['folder'][$key], $arrSideCS['settings'][$key], $arrSideCS['id'][$key]);
				
				
				include_once($tcms_administer_site.'/components/'.$arrSideCS['folder'][$key].'/'.$arrSideCS['file'][$key]);
				
				
				//echo '<br /><br />';
			//}
		}
	}
}

?>