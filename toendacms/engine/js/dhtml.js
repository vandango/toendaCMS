/*       _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| JavaScript Functions
|
| File:	dhtml.js
|
+
*/


/**
 * toendaCMS JavaScript Functions
 *
 * This file provides some favaScript functions.
 *
 * @version 0.5.2
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * JAVASCRIPT FUNCTIONS
 *
 * addLoadEvent(func)
 * getKeyCode(event)
 * displayKeyCode(object)
 *
 * gebi(id)
 *
 * getSelectedValue(select)
 *
 * show(id, top, left)               -> show box on place top and left
 * show_easy(id)                     -> show box without setting place
 * hide(id)                          -> hide menu (little box)
 * wxlBgCol(id, farbe)               -> change bgcolor of id if mouse over
 *
 * save()                            -> send first form on page
 * apply()                           -> apply
 * save_id(id)                       -> send form by id
 * accept(id)                        -> accept an form by id
 * checkinputs()                     -> check inputs of an form
 * submitXML(id, action, newvalue)   -> change value of "action" to "newvalue", then submit "id"
 *
 * imageWindow(img, param)           -> open a window with image
 * popWindow(path, sizex, sizy)      -> open a window with size x and y
 * printWindow(s, id, news, session) -> open a window for printjob
 * pdfWindow(s, id, news, session)   -> open a window with pdf inside
 * pageWindow(path)                  -> open a window with a php or html file
 * helpWindow(path)                  -> same as above
 * openWindow(file, title, width, height, scroll, resize)
 *                                     -> open a custom window
 *
 * setImage(img, id, script)         -> accept image for openers ID field
 * setLink(link, title, id, script)  -> accept link for openers ID field
 * setNewsImage(img, id, id2)        -> accept image for openers ID field for newsmanager config
 * setFAQImage(img, id, id2)         -> accept image for openers ID field for knowledgebase config
 * setColor(id, color)               -> accept a color for openers ID field
 * deleteMediafileExt                -> Delete a media file
 * deleteMediafile                   -> Delete a media file
 * deleteFolder                      -> Delete a folder in media browser
 *
 * showImage()                       -> random images   ---> TODO: take images as function parameter
 *
 * </code>
 *
 */




// --------------------------------------
// LIGTHBOX2 TOENDACMS PATH LOADER
// --------------------------------------

/*
// toendaCMS path loader
var _path;
var _includes;
$A(document.getElementsByTagName("script")).findAll( function(s) {
	return (s.src && s.src.match(/scriptaculous\.js(\?.*)?$/))
}).each( function(s) {
  _path = s.src.replace(/scriptaculous\.js(\?.*)?$/,'');
  _includes = s.src.match(/\?.*load=([a-z,]*)/);
  //alert(_path + ' --- ' + _includes)
});

//alert(_path + "images/loading.gif");
*/




// --------------------------------------
// SCRIPT
// --------------------------------------

/**
/* Script Registrar from Simon Wilson 
*/
function addLoadEvent(func) {
	var oldonload = window.onload;
	if(typeof window.onload != 'function') {
		window.onload = func;
	}
	else {
		window.onload = function() {
			oldonload();
			func();
		}
	}
}


function getKeyCode(event) {
   event = event || window.event;
   return event.keyCode;
}


function displayKeyCode(object) {
	object.onkeydown = function(event) {
		var charCode = getKeyCode(event);
		var charString = String.fromCharCode(charCode);
	}
}



// --------------------------------------
// GET ELEMENT BY ID
// --------------------------------------

function gebi(id) {
	return document.getElementById(id);
}



// --------------------------------------
// SELECT OPTIONS
// --------------------------------------

function getSelectedValue(select) {
	return select.options[select.options.selectedIndex].value;
}



// --------------------------------------
// RELOCATOR
// --------------------------------------

function relocateTo(link, lang) {
	var _link = link;
	
	if(lang != '') {
		if(_link.indexOf("//")) {
			_link = _link.replace(/\/\//g, '/' + lang + '/');
		}
	}
	
	document.location = _link;
}



// --------------------------------------
// SHOW MENU
// --------------------------------------

function show(id, top, left){
	document.getElementById(id).style.visibility='visible';
	document.getElementById(id).style.top=top;
	document.getElementById(id).style.left=left;
}


function show_easy(id){
	document.getElementById(id).style.visibility='visible';
}


function hide(id){
	document.getElementById(id).style.visibility='hidden';
}


function showXP(id){
	document.getElementById(id).style.display='absolute';
}


function hideXP(id){
	document.getElementById(id).style.display='none';
}





// --------------------------------------
// Backgroundcolor Changer
// --------------------------------------

function wxlBgCol(id,farbe) {
	if (document.all){
		document.all[id].style.backgroundColor=farbe;
	}
	else{
		if (document.getElementById){
			document.getElementById(id).style.backgroundColor=farbe;
		}
		else{
			if (document.layers){
				document.layers[id].bgColor=farbe;
			}
		}
	}
}





// --------------------------------------
// SAVE FORM VALUE
// --------------------------------------

function save(){
	document.forms[0].submit();
}


function apply(){
	gebi('draft').value = '0';
	document.forms[0].submit();
}


function save_id(id){
	//document.forms[id].submit();
	document.getElementById(id).submit();
}


function accept(id){
	document.getElementById(id).submit();
}


function checkinputs(){
	sendOK = true;
	
	if (sendOK) { document.forms[0].submit(); }
}


function submitXML(id, action, newvalue){
	document.getElementById(action).value = newvalue;
	document.getElementById(id).submit();
}


function submitForm(id){
	document.getElementById(id).submit();
}





// --------------------------------------
// OPEN WINDOWS
// --------------------------------------

function imageWindow(img, param){
	var path;
	
	if(param == 'media'){ path = '../../data/images/Image/'; }
	else{ path = ''; }
	
	win = window.open(path+img, 'Window', 'width=600,height=400,scrollbars=1,resizable=1');
	
	if(win != null){
		if(win.opener == null){
			mpic.opener = self;
		}
		//win.location.href = img;
	}
}


function popWindow(path, sizex, sizey){
	if(sizex == '') sizex = '600';
	if(sizey == '') sizey = '400';
	
	win = window.open(path, 'Window', 'width=' + sizex + ',height=' + sizey + ',scrollbars=1,resizable=1');
	
	if(win != null){
		if(win.opener == null){
			mpic.opener = self;
		}
		//win.location.href = img;
	}
}


function printWindow(s, id, news, session, imagePath){
	var path;
	
	switch(id){
		case 'modul':
			path = 'index.php?' + s + '&s=printer';
			break;
		
		case 'seo0':
			if(s == imagePath) {
				path = '/index.php/template:printer';
			}
			else {
				path = s + '/template:printer';
			}
			break;
		
		case 'seo1':
			if(s == imagePath) {
				path = '/index.php/template/printer';
			}
			else {
				path = s + '/template/printer';
			}
			break;
		
		case 'seo2':
			path = s + '&s=printer';
			break;
		
		default:
			path = 'print.php?id=' + id + '&s=' + s;
			
			if(news != '') {
				path = path + '&news=' + news;
			}
			
			if(session != '') {
				path = path + '&session=' + session;
			}
			break;
	}
	
	win = window.open(
		( id == 'seo2' ? path : imagePath + path ), 
		'Window', 
		'width=700, height=500, scrollbars=1, resizable=1'
	);
	
	if(win != null) {
		if(win.opener == null) {
			mpic.opener = self;
		}
	}
}


function pdfWindow(s, id, news, category, article, session, imagePath){
	var path;
	
	path = 'pdf.php?id=' + id + '&s=' + s;
	if(news != ''){ path = path + '&news=' + news; }
	if(category != ''){ path = path + '&category=' + category; }
	if(article != ''){ path = path + '&article=' + article; }
	if(session != ''){ path = path + '&session=' + session; }
	
	win = window.open(imagePath + path, 'Window', 'width=700,height=500,scrollbars=1,resizable=1');
	
	if(win != null){
		if(win.opener == null){
			mpic.opener = self;
		}
	}
}


function pageWindow(path){
	win = window.open(path, 'Window', 'width=700,height=500,scrollbars=1,resizable=1');
	
	if(win != null){
		if(win.opener == null){
			mpic.opener = self;
		}
	}
}


function helpWindow(path){
	win = window.open(path, 'toendaCMSHelpWindow', 'width=400,height=400,scrollbars=1,resizable=0');
	
	if(win != null){
		if(win.opener == null){
			mpic.opener = self;
		}
	}
}


/*
	open a window
*/
function openWindow(file, title, width, height, scroll, resize){
	if(title == '') title = 'Window';
	if(width == '') width = 400;
	if(height == '') height = 500;
	if(scroll == '') scroll = 0;
	if(resize == '') resize = 0;
	
	win = window.open(file, title, 'width=' + width + ',height=' + height + ',scrollbars=1,resizable=' + resize);
	
	if(win != null){
		if(win.opener == null){
			mpic.opener = self;
		}
	}
}





// --------------------------------------
// ACCEPT IMAGE TO CONTENT
// --------------------------------------

function setImageNL(img, id, script, url){
	if(script == 'toendaScript') {
		var commandValue = '{img#' + url + 'data/images/Image/' + img + '#border=0#}';
	}
	else {
		var commandValue = '<img title="' + img + '" alt="' + img + '" src="' + url + 'data/images/Image/' + img + '" border="0" />';
	}
	
	var input = window.opener.document.getElementById(id);
	
	if(document.selection){
		var oldContent;
		var newContent;
		var selectedContent;
		var changedSelectedContent;
		
		selectedContent = opener.document.selection.createRange().text;
		oldContent = input.value;
		
		if(selectedContent == ''){
			input.value = oldContent + commandValue;
			input.focus();
		}
		else{
			changedSelectedContent = selectedContent + commandValue;
			
			newContent = oldContent.replace(selectedContent, changedSelectedContent);
			
			input.value = newContent;
			input.focus();
		}
	}
	else if(window.getSelection){
		var start = input.selectionStart;
		var end = input.selectionEnd;
		var insText = input.value.substring(start, end);
		
		input.value = input.value.substr(0, start) + insText + commandValue + input.value.substr(end);
		
		var pos;
		
		if(insText.length == 0){
			pos = start + commandValue.length;
		}else{
			pos = start + insText.length + commandValue.length;
		}
		
		input.selectionStart = pos;
		input.selectionEnd = pos;
		input.focus();
	}
	else{
		var pos;
		var re = new RegExp('^[0-9]{0,3}$');
		
		while(!re.test(pos)){
			pos = input.value.length;
		}
		
		if(pos > input.value.length){
			pos = input.value.length;
		}
		
		var insText = prompt('Insert Command:');
		input.value = input.value.substr(0, pos) + commandValue + insText + input.value.substr(pos);
	}
	
	self.close();
}


function setImage(img, id, script){
	if(script == 'toendaScript') {
		var commandValue = '{img#data/images/Image/' + img + '#border=0#}';
	}
	else {
		var commandValue = '<img title="' + img + '" alt="' + img + '" src="data/images/Image/' + img + '" border="0" />';
	}
	
	var input = window.opener.document.getElementById(id);
	
	if(document.selection){
		var oldContent;
		var newContent;
		var selectedContent;
		var changedSelectedContent;
		
		selectedContent = opener.document.selection.createRange().text;
		oldContent = input.value;
		
		if(selectedContent == ''){
			input.value = oldContent + commandValue;
			input.focus();
		}
		else{
			changedSelectedContent = selectedContent + commandValue;
			
			newContent = oldContent.replace(selectedContent, changedSelectedContent);
			
			input.value = newContent;
			input.focus();
		}
	}
	else if(window.getSelection){
		var start = input.selectionStart;
		var end = input.selectionEnd;
		var insText = input.value.substring(start, end);
		
		input.value = input.value.substr(0, start) + insText + commandValue + input.value.substr(end);
		
		var pos;
		
		if(insText.length == 0){
			pos = start + commandValue.length;
		}else{
			pos = start + insText.length + commandValue.length;
		}
		
		input.selectionStart = pos;
		input.selectionEnd = pos;
		input.focus();
	}
	else{
		var pos;
		var re = new RegExp('^[0-9]{0,3}$');
		
		while(!re.test(pos)){
			pos = input.value.length;
		}
		
		if(pos > input.value.length){
			pos = input.value.length;
		}
		
		var insText = prompt('Insert Command:');
		input.value = input.value.substr(0, pos) + commandValue + insText + input.value.substr(pos);
	}
	
	self.close();
}


function setLink(link, title, id, script){
	if(title == '') title = link;
	
	if(script == 'toendaScript'){
		var commandValue = '{url#' + link + '#:}';
		commandValue = commandValue + title + '{:url}';
	}
	else{
		var commandValue = '<a href="' + link + '" alt="' + title + '" title="' + title + '">';
		commandValue = commandValue + title + '</a>';
	}
	
	var input = window.opener.document.getElementById(id);
	
	if(document.selection){
		var oldContent;
		var newContent;
		var selectedContent;
		var changedSelectedContent;
		
		selectedContent = opener.document.selection.createRange().text;
		oldContent = input.value;
		
		if(selectedContent == ''){
			input.value = oldContent + commandValue;
			input.focus();
		}
		else{
			changedSelectedContent = selectedContent + commandValue;
			
			newContent = oldContent.replace(selectedContent, changedSelectedContent);
			
			input.value = newContent;
			input.focus();
		}
	}
	else if(window.getSelection){
		var start = input.selectionStart;
		var end = input.selectionEnd;
		var insText = input.value.substring(start, end);
		
		input.value = input.value.substr(0, start) + insText + commandValue + input.value.substr(end);
		
		var pos;
		
		if(insText.length == 0){
			pos = start + commandValue.length;
		}else{
			pos = start + insText.length + commandValue.length;
		}
		
		input.selectionStart = pos;
		input.selectionEnd = pos;
		input.focus();
	}
	else{
		var pos;
		var re = new RegExp('^[0-9]{0,3}$');
		
		while(!re.test(pos)){
			pos = input.value.length;
		}
		
		if(pos > input.value.length){
			pos = input.value.length;
		}
		
		var insText = prompt('Insert Command:');
		input.value = input.value.substr(0, pos) + commandValue + insText + input.value.substr(pos);
	}
	
	self.close();
}


function setNewsImage(img, id, id2) {
	window.opener.document.getElementById(id).src = '../../data/images/Image/' + img;
	window.opener.document.getElementById(id).style.visibility='visible';
	window.opener.document.getElementById(id2).value = img;
	self.close();
}


function setFAQImage(img, id, id2) {
	window.opener.document.getElementById(id).src = '../../data/images/knowledgebase/' + img;
	window.opener.document.getElementById(id).style.display = 'block';
	window.opener.document.getElementById(id2).value = img;
	self.close();
}


function setColor(id, color) {
	window.opener.document.getElementById(id).value = color;
	self.close();
}


function deleteMediafileExt(session, action, path, image, message) {
	if(confirm(message)) {
		document.location='admin.php?site=mod_media&id_user=' + session + '&action=' + action + '&todo=deleteImage&path=' + path + '&delimg=' + image;
	}
}


function deleteMediafile(session, action, image, message) {
	if(confirm(message)) {
		document.location='admin.php?site=mod_media&id_user=' + session + '&action=' + action + '&todo=deleteImage&delimg=' + image;
	}
}


function deleteFolder(session, action, image, message) {
	if(confirm(message)) {
		document.location='admin.php?site=mod_media&id_user=' + session + '&action=' + action + '&todo=deleteFolder&delimg=' + image;
	}
}





// --------------------------------------
// ROTATE IMAGES
// --------------------------------------

function showImage(){
	var theImages = new Array();
	
	theImages[0] = 'theme/main/img/rotate/logo1.gif';
	theImages[1] = 'theme/main/img/rotate/logo2.gif';
	theImages[2] = 'theme/main/img/rotate/logo3.gif';
	theImages[3] = 'theme/main/img/rotate/logo4.gif';
	theImages[4] = 'theme/main/img/rotate/logo5.gif';
	theImages[5] = 'theme/main/img/rotate/logo6.gif';
	
	var j = 0
	var p = theImages.length;
	var preBuffer = new Array()
	for (i = 0; i < p; i++){
		preBuffer[i] = new Image()
		preBuffer[i].src = theImages[i]
	}
	
	var whichImage = Math.round(Math.random()*(p-1));
	function showImage2(){
		document.write('<img border="0" width="112" height="111" alt="Top Banner" src="'+theImages[whichImage]+'">');
	}
}
