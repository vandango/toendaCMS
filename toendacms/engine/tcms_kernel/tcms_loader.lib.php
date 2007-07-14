<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
| "your ideas ahead"                                                     |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| toendaCMS Framework Loader
|
| File:	tcms_loader.lib.php
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


/**
 * toendaCMS Framework Loader
 *
 * This class is used for loading some framework
 * files.
 *
 * @version 0.1.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 */


/**
 * Intelligent file includer (for require_once)
 *
 * @param String $namespace
 */
function import($namespace) {
	using($namespace, true);
}


/**
 * Intelligent file includer (for include_once)
 *
 * @param String $namespace
 * @param Boolean $require = false
 * @param String $admin = false
 */
function using($namespace, $require = false, $admin = false) {
	//return tcms_loader::import($namespace);
	
	$data = explode('.', $namespace);
	
	switch($data[0]) {
		case 'toendacms':
			$mainPath = ( $admin ? '..' : 'engine' );
			$middlePath = '/tcms_';
			$endPath = '.lib.php';
			break;
		
		default:
			$mainPath = $data[0];
			$middlePath = '';
			$endPath = '';
			break;
	}
	
	switch($data[1]) {
		case 'kernel':
			$mainPath .= '/tcms_'.$data[1];
			$middlePath = '/tcms_';
			$endPath = '.lib.php';
			break;
		
		case 'datacontainer':
			$mainPath .= '/tcms_kernel';
			$middlePath = '/datacontainer/tcms_dc_';
			$endPath = '.lib.php';
			break;
		
		case 'data':
			$mainPath .= '/';
			$middlePath = '';
			$endPath = '';
			break;
		
		case 'database':
			$mainPath .= '/tcms_global/'.$data[1];
			$middlePath = '';
			$endPath = '.php';
			break;
		
		case 'tools':
			$mainPath .= '/tcms_kernel';
			$middlePath = '/';
			
			$data[3] = str_replace('_', '.', $data[3]);
			
			$endPath = '/'.$data[3].'.php';
			break;
		
		case 'js':
			$mainPath .= '/tcms_kernel';
			$middlePath = '/js/';
			
			$data[3] = str_replace('_', '.', $data[3]);
			
			$endPath = '/'.$data[3].'.php';
			break;
		
		case 'language':
			$mainPath .= '/'.$data[1];
			$middlePath = '/lang_';
			
			$endPath = '.php';
			break;
		
		default:
			$mainPath .= '/tcms_';
			$middlePath = '/tcms_';
			$endPath = '.lib.php';
			break;
	}
	
	//echo $mainPath.$middlePath.$data[2].$endPath.'<br>';
	
	if($data[2] == 'main') {
		if($require) {
			require_once($mainPath.'/tcms'.$endPath);
		}
		else {
			include_once($mainPath.'/tcms'.$endPath);
		}
	}
	elseif($data[2] == 'settings') {
		//echo $mainPath.$middlePath.$endPath;
		if($require) {
			require_once($mainPath.$middlePath.$endPath);
		}
		else {
			include_once($mainPath.$middlePath.$endPath);
		}
	}
	else {
		//echo $mainPath.$middlePath.$data[2].$endPath.'<br />';
		if($require) {
			require_once($mainPath.$middlePath.$data[2].$endPath);
		}
		else {
			include_once($mainPath.$middlePath.$data[2].$endPath);
		}
	}
}

?>
