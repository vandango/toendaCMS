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
| Version:	0.1.1
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
* gebi(id)
* ajaxChangeSidemenuType(type)
* ajaxChangeTopmenuType(type)
* ajaxChangeDateTime(item, value)
* ajaxContentResizer(mouseevent)
*
*/



// --------------------------------------
// GET ELEMENT BY ID
// --------------------------------------

function gebi(id) {
	return document.getElementById(id);
}


function getTimeFromNumber(number) {
	var tmp = 0;
	
	//tmp2 = Number(tmp2) / 0.6;
	//tmp2 = String(tmp2).substr(0, 2);
	//tmp2 = tmp2.replace(/,/g, '');
	//tmp2 = tmp2.replace(/./g, '');
	
	switch(number) {
		case '0':  tmp = '0'; break;
		case '1':  tmp = '0'; break;
		case '2':  tmp = '0'; break;
		case '3':  tmp = '0'; break;
		case '4':  tmp = '0'; break;
		case '5':  tmp = '3'; break;
		case '6':  tmp = '0'; break;
		case '7':  tmp = '0'; break;
		case '8':  tmp = '0'; break;
		case '9':  tmp = '0'; break;
		case '25': tmp = '15'; break;
		case '50': tmp = '30'; break;
		case '50': tmp = '30'; break;
		case '75': tmp = '45'; break;
		default:   tmp = '0'; break;
	}
	
	return tmp;
}



// --------------------------------------
// MENU
// --------------------------------------

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



// --------------------------------------
// DATETIME
// --------------------------------------

function ajaxChangeDateTime(item, value) {
	var tmp, tmp2;
	
	switch(item){
		case 'new_publish_date':
			var dt = value.substr(0, 10);
			var tm = value.substr(11, 5);
			
			switch(tm.length) {
				case 1:
					tm = '0' + tm + ':00';
					break;
				
				case 2:
					tm = tm + ':00';
					break;
				
				case 3:
					if(tm.indexOf(':') != -1) {
						tmp = tm.substr(0, tm.indexOf(':'));
						tmp2 = tm.substr(tm.indexOf(':') + 1);
						
						tm = ( tmp.length == 1 ? '0' + tmp : tmp ) + ':' + ( tmp2.length == 1 ? tmp2 + '0' : tmp2 );
						
						//tm = tm.substr(0, 2) + ':' + tm.substr(2, 1) + '0';
					}
					else if(tm.indexOf(',') > 0) {
						tmp = tm.substr(0, tm.indexOf(','));
						tmp2 = ts.substr(tm.indexOf(',') + 1);
						tmp2 = getTimeFromNumber(tmp2);
						
						tm = ( tmp.length == 1 ? '0' + tmp : tmp ) + ':' + ( tmp2.length == 1 ? tmp2 + '0' : tmp2 );
					}
					else {
						tm = tm + '00';
					}
					break;
				
				case 4:
					if(tm.indexOf(',') > 1) {
						tmp = tm.substr(0, tm.indexOf(','));
						tmp2 = ts.substr(tm.indexOf(',') + 1);
						tmp2 = getTimeFromNumber(tmp2);
						
						tm = ( tmp.length == 1 ? '0' + tmp : tmp ) + ':' + ( tmp2.length == 1 ? tmp2 + '0' : tmp2 );
					}
					else if(tm.indexOf(':') > 1) {
						tmp = tm.substr(0, tm.indexOf(':'));
						tmp2 = ts.substr(tm.indexOf(':') + 1);
						//tmp2 = getTimeFromNumber(tmp2);
						
						tm = ( tmp.length == 1 ? '0' + tmp : tmp ) + ':' + ( tmp2.length == 1 ? tmp2 + '0' : tmp2 );
					}
					break;
				
				default:
					break;
			}
			
			gebi('new_publish_date').value = gebi('new_publish_date').value.substr(0, 11) + tm;
			gebi('new_date').value = dt;
			gebi('new_time').value = tm;
			break;
		
		case 'new_date':
			gebi('new_publish_date').value = value + gebi('new_publish_date').value.substr(10, 6);
			break;
		
		case 'new_time':
			var ts = value;
			
			switch(ts.length) {
				case 1:
					ts = '0' + ts + ':00';
					break;
				
				case 2:
					ts = ts + ':00';
					break;
				
				case 3:
					//ts = ts + '0';
					if(ts.indexOf(':') != -1) {
						tmp = ts.substr(0, ts.indexOf(':'));
						tmp2 = ts.substr(ts.indexOf(':') + 1);
						
						ts = ( tmp.length == 1 ? '0' + tmp : tmp ) + ':' + ( tmp2.length == 1 ? tmp2 + '0' : tmp2 );
						
						//ts = ts.substr(0, 2) + ':' + ts.substr(2, 1) + '0';
					}
					else if(ts.indexOf(',') > 0) {
						tmp = ts.substr(0, ts.indexOf(','));
						tmp2 = ts.substr(ts.indexOf(',') + 1);
						tmp2 = getTimeFromNumber(tmp2);
						
						ts = ( tmp.length == 1 ? '0' + tmp : tmp ) + ':' + ( tmp2.length == 1 ? tmp2 + '0' : tmp2 );
					}
					else {
						ts = ts + '00';
					}
					break;
				
				case 4:
					if(ts.indexOf(',') > 0) {
						tmp = ts.substr(0, ts.indexOf(','));
						tmp2 = ts.substr(ts.indexOf(',') + 1);
						tmp2 = getTimeFromNumber(tmp2);
						
						ts = ( tmp.length == 1 ? '0' + tmp : tmp ) + ':' + ( tmp2.length == 1 ? tmp2 + '0' : tmp2 );
					}
					else if(ts.indexOf(':') > 0) {
						tmp = ts.substr(0, ts.indexOf(':'));
						tmp2 = ts.substr(ts.indexOf(':') + 1);
						//tmp2 = getTimeFromNumber(tmp2);
						
						ts = ( tmp.length == 1 ? '0' + tmp : tmp ) + ':' + ( tmp2.length == 1 ? tmp2 + '0' : tmp2 );
					}
					break;
				
				default:
					break;
			}
			
			gebi('new_time').value = ts;
			gebi('new_publish_date').value = gebi('new_publish_date').value.substr(0, 11) + ts;
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

