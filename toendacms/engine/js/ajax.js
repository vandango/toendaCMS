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
| Version:	0.0.9
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
* ajaxContentResizer(mouseevent)
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



function ajaxTextAreaSize(height) {
	var grip = document.getElementById('content_resizer');
	var box = document.getElementById('content');
	
	box.style.height = height + "px";
	grip.style.cursor = 's-resize';
}



function ajaxContentResizer(mouseevent){
	if(!mouseevent)
		mouseevent = window.event;
	
	//if(document.getElementById){
		var grip = document.getElementById('content_resizer');
		var box = document.getElementById('content');
		var boxheight = 0;
		
		if(box.style.height == '') {
			boxheight = 600;
			grip.style.cursor = 's-resize';
		}
		else if(box.style.height == '200px') {
			boxheight = 600;
			grip.style.cursor = 'n-resize';
		}
		else {
			boxheight = 200;//parseInt(box.style.height);
			grip.style.cursor = 's-resize';
		}
		
		//var newheight = mouseevent.clientY - 40;
		var newheight = boxheight;
		
		if(newheight > 0) {
			box.style.height = newheight + "px";
			document.location = '#top';
			document.getElementsByTagName('body')[0].style.height = '100% !important';
		}
		
		//box.value += "newheight: " + newheight + "\n";
		/*box.value += "mouseevent.clientY: " + mouseevent.clientY + "\n";
		box.value += "mouseevent.layerY: " + mouseevent.layerY + "\n";
		box.value += "mouseevent.screenY: " + mouseevent.screenY + "\n";
		box.value += "mouseevent.button: " + mouseevent.button + "\n";
		box.value += "mouseevent.type: " + mouseevent.type + "\n";
		box.value += "mouseevent.x: " + mouseevent.x + "\n";
		box.value += "mouseevent.y: " + mouseevent.y + "\n";*/
	/*}
	else if(document.all) {
		var grip = document.all.content_resizer;
		var box = document.all.content;
		var boxheight = 0;
		
		if(box.style.height == '')
			boxheight = 600;
		else
			boxheight = parseInt(box.style.height);
		
		var newheight = mouseevent.clientY - 40;
		
		if(newheight > 0) {
			box.style.height = newheight + "px";
		}
	}*/
}



/*
	Class
*/
function tcmsJSAjax(){
	this.ajaxChangeSidemenuType = ajaxChangeSidemenuType;
	this.ajaxChangeTopmenuType = ajaxChangeTopmenuType;
	this.ajaxChangeDateTime = ajaxChangeDateTime;
	this.ajaxContentResizer = ajaxContentResizer;
	this.ajaxTextAreaSize = ajaxTextAreaSize;
}


JSAjax = new tcmsJSAjax();

