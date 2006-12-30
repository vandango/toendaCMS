/*       _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| DHTML Menu
|
| File:		menu.js
| Version:	0.0.5
|
+
*/


/************************************************
*
* JAVASCRIPT FUNCTIONS
*
* - Menu functions                    -> simpleMenu, developed by Travis Bekham
*
*/



//***************************************
//
// simpleMenu
//
// developed by Travis Bekham
// http://www.squidfingers.com
//
// updated by Jonathan Naumann
// http://vandango.toenda.com
//
//***************************************
Menu = {timer : null, current : null};

Menu.getStyle = function(name){
	return document.getElementById(name).style;
}

Menu.show = function(name, top){
	if(Menu.timer)
		clearTimeout(Menu.timer);
	Menu.getStyle(name).visibility = "visible";
	Menu.getStyle(name).top = top;
	Menu.current = name;
	//Menu.changeBG(name);
}

Menu.hide = function(){
	//Menu.cleanBG(name);
	Menu.timer = setTimeout("Menu.doHide()",300);
}

Menu.doHide = function(){
	if(this.current){
		Menu.getStyle(Menu.current).visibility = "hidden";
		Menu.current = null;
	}
}

Menu.changeBG = function(id){
	switch(id){
		case 'tcms_menu_main':
			document.getElementById('main_menu').style.background = 'url(../images/admin_menu/main_over.jpg)';
			document.getElementById('main_menu').style.border = '1px solid #aaaaaa';
			break;
	}
}

Menu.cleanBG = function(id){
	switch(id){
		case 'tcms_menu_main':
			document.getElementById('main_menu').style.background = 'url(../images/admin_menu/main.jpg)';
			document.getElementById('main_menu').style.border = '1px solid #eeeeee';
			break;
	}
}
