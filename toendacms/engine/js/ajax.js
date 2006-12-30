/*       _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Ajax Functions
|
| File:		ajax.js
| Version:	0.0.8
|
+
*/


/**
 * toendaCMS Kernel - System framework
 *
 * This class is used for a basic functions.
 *
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcmsJSAjax
 */


/*
* Methods
*
* ajaxChangeSidemenuType(type)
* ajaxChangeTopmenuType(type)
* ajaxChangeDateTime(item, value)
*
*/


function ajaxChangeSidemenuType(type){
	switch(type){
		case 'link':
			document.getElementById('sm_type_extern').style.display = 'none';
			document.getElementById('sm_type_intern').style.display = 'block';
			document.getElementById('sm_type_title').style.display = 'block';
			
			document.getElementById('sm_type_extern').name = 'nothing';
			document.getElementById('sm_type_intern').name = 'new_sm_link';
			break;
		
		case 'title':
			document.getElementById('sm_type_extern').style.display = 'none';
			document.getElementById('sm_type_intern').style.display = 'none';
			document.getElementById('sm_type_title').style.display = 'none';
			
			document.getElementById('sm_type_extern').name = 'nothing';
			document.getElementById('sm_type_intern').name = 'new_sm_link';
			break;
		
		case 'web':
			document.getElementById('sm_type_extern').style.display = 'block';
			document.getElementById('sm_type_intern').style.display = 'none';
			document.getElementById('sm_type_title').style.display = 'block';
			
			document.getElementById('sm_type_extern').name = 'new_sm_link';
			document.getElementById('sm_type_intern').name = 'nothing';
			break;
	}
}



function ajaxChangeTopmenuType(type){
	switch(type){
		case 'link':
			document.getElementById('tm_type_extern').style.display = 'none';
			document.getElementById('tm_type_intern').style.display = 'block';
			
			document.getElementById('tm_type_extern').name = 'nothing';
			document.getElementById('tm_type_intern').name = 'new_tm_link';
			break;
		
		case 'web':
			document.getElementById('tm_type_extern').style.display = 'block';
			document.getElementById('tm_type_intern').style.display = 'none';
			
			document.getElementById('tm_type_extern').name = 'new_tm_link';
			document.getElementById('tm_type_intern').name = 'nothing';
			break;
	}
}



function ajaxChangeDateTime(item, value){
	switch(item){
		case 'new_publish_date':
			document.getElementById('new_date').value = value.substr(0, 10);
			document.getElementById('new_time').value = value.substr(11, 5);
			break;
		
		case 'new_date':
			document.getElementById('new_publish_date').value = value + document.getElementById('new_publish_date').value.substr(10, 6);
			break;
		
		case 'new_time':
			document.getElementById('new_publish_date').value = document.getElementById('new_publish_date').value.substr(0, 11) + value;
			break;
	}
}



/*
	Class
*/
function tcmsJSAjax(){
	this.ajaxChangeSidemenuType = ajaxChangeSidemenuType;
	this.ajaxChangeTopmenuType = ajaxChangeTopmenuType;
	this.ajaxChangeDateTime = ajaxChangeDateTime;
}


JSAjax = new tcmsJSAjax();

