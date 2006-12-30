/*       _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Check browser software
|
| File:		browsercheck.js
| Version:	0.0.3
|
+
*/


var browser = 'moz';
var realBrowser = '';
doBrowserCheck = true;
//doBrowserCheck = false;


function checkBrowser(){
	var name = navigator.userAgent;
	name = name.toLowerCase();
	
	ie = false;
	
	if(navigator.userAgent.indexOf("MSIE") > 0){
		ie = true;
		realBrowser = 'ie';
	}
	else{
		ie = false;
		
		if(name.indexOf("safari") > 0){
			realBrowser = 'safari';
		}
		else if(navigator.product == "Gecko"){
			realBrowser = 'moz';
		}
		else if(name.indexOf("opera") != -1){
			realBrowser = 'opera';
		}
		else if(name.indexOf("khtml") != -1){
			realBrowser = 'khtml';
		}
		else if(name.indexOf("konqueror") != -1){
			realBrowser = 'konqueror';
		}
		else{
			realBrowser = 'moz';
		}
	}
	
	if(ie) browser = 'ie';
	else browser = 'moz';
	
	//document.write(browser);
	//document.write(realBrowser);
}


if(doBrowserCheck)
	checkBrowser();

