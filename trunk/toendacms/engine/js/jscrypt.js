/*       _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| JavaScript crypting
|
| File:		jscrypt.js
| Version:	0.0.7
|
+
*/


/**
 * toendaCMS JavaScript Functions for ciphering
 * 
 * This file provides some javaScript functions.
 * 
 * @version 0.1.0
 * @author	Jonathan Naumann <jonathan@toenda.com>
 * @package toendaCMS
 * @subpackage tcms_kernel
 *
 * <code>
 * 
 * rot13init
 * rot13
 * base64arrays
 * decodeBase64
 * encodeBase64
 * decode_utf8
 * encode_utf8
 * doit
 * undoit
 * displayCrypt
 * displayCryptMail
 * displayCryptMailTo
 * saveEncoded
 * tcmsJSCrypt
 * 
 * </code>
 * 
 */


var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
var last = '';
var rot13map;


function rot13init(){
	var map = new Array();
	var s   = "abcdefghijklmnopqrstuvwxyz";
	
	for (i=0; i<s.length; i++)
	map[s.charAt(i)]			= s.charAt((i+13)%26);
	for (i=0; i<s.length; i++)
	map[s.charAt(i).toUpperCase()]	= s.charAt((i+13)%26).toUpperCase();
	return map;
}


function rot13(a){
	rot13init();
	
	if(!rot13map) rot13map = rot13init();
	
	s = '';
	for (i=0; i<a.length; i++)
	{
	var b = a.charAt(i);
	
	s	+= (b>='A' && b<='Z' || b>='a' && b<='z' ? rot13map[b] : b);
	}
	return s;
}


function encodeBase64(input) {
   var output = "";
   var chr1, chr2, chr3;
   var enc1, enc2, enc3, enc4;
   var i = 0;

   do {
      chr1 = input.charCodeAt(i++);
      chr2 = input.charCodeAt(i++);
      chr3 = input.charCodeAt(i++);

      enc1 = chr1 >> 2;
      enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
      enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
      enc4 = chr3 & 63;

      if (isNaN(chr2)) {
         enc3 = enc4 = 64;
      } else if (isNaN(chr3)) {
         enc4 = 64;
      }

      output = output + keyStr.charAt(enc1) + keyStr.charAt(enc2) + 
         keyStr.charAt(enc3) + keyStr.charAt(enc4);
   } while (i < input.length);
   
   return output;
}


function decodeBase64(input) {
   var output = "";
   var chr1, chr2, chr3;
   var enc1, enc2, enc3, enc4;
   var i = 0;

   // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
   input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

   do {
      enc1 = keyStr.indexOf(input.charAt(i++));
      enc2 = keyStr.indexOf(input.charAt(i++));
      enc3 = keyStr.indexOf(input.charAt(i++));
      enc4 = keyStr.indexOf(input.charAt(i++));

      chr1 = (enc1 << 2) | (enc2 >> 4);
      chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
      chr3 = ((enc3 & 3) << 6) | enc4;

      output = output + String.fromCharCode(chr1);

      if (enc3 != 64) {
         output = output + String.fromCharCode(chr2);
      }
      if (enc4 != 64) {
         output = output + String.fromCharCode(chr3);
      }
   } while (i < input.length);

   return output;
}


function decode_utf8(utftext) {
	var plaintext = '';
	var i = 0;
	var c = c1 = c2 = 0;
	
	while(i < utftext.length){
		c = utftext.charCodeAt(i);
		if(c < 128){
			plaintext += String.fromCharCode(c);
			i++;
		}
	else if((c>191) && (c<224)) {
	c2 = utftext.charCodeAt(i+1);
	plaintext += String.fromCharCode(((c&31)<<6) | (c2&63));
	i+=2;}
	else {
	c2 = utftext.charCodeAt(i+1); c3 = utftext.charCodeAt(i+2);
	plaintext += String.fromCharCode(((c&15)<<12) | ((c2&63)<<6) | (c3&63));
	i+=3;}
	}
	return plaintext;
}


function encode_utf8(rohtext) {
	// dient der Normalisierung des Zeilenumbruchs
	rohtext = rohtext.replace(/\r\n/g,"\n");
	var utftext = "";
	for(var n=0; n<rohtext.length; n++)
	{
	// ermitteln des Unicodes des  aktuellen Zeichens
	var c=rohtext.charCodeAt(n);
	// alle Zeichen von 0-127 => 1byte
	if (c<128)
	utftext += String.fromCharCode(c);
	// alle Zeichen von 127 bis 2047 => 2byte
	else if((c>127) && (c<2048)) {
	utftext += String.fromCharCode((c>>6)|192);
	utftext += String.fromCharCode((c&63)|128);}
	// alle Zeichen von 2048 bis 66536 => 3byte
	else {
	utftext += String.fromCharCode((c>>12)|224);
	utftext += String.fromCharCode(((c>>6)&63)|128);
	utftext += String.fromCharCode((c&63)|128);}
	}
	return utftext;
}


function doit(text){
	var cipherText = btoa(text);
	return cipherText;
}


function undoit(text){
	var clearText = atob(text);
	return clearText;
}


function displayCrypt(text){
	text = encodeBase64(text);
	document.write('UTF8: ' + text + '<br />');
	
	text = decodeBase64(text);
	document.write('base64: ' + text + '<br />');
}


function displayCryptMail(text, name){
	//text = encodeBase64(text);
	document.write('<a href="javascript:JSCrypt.cryptMail(\'' + text + '\');">' + name + '</a>');
}


function displayCryptMailTo(text){
	//text = encodeBase64(text);
	document.write('<a href="javascript:JSCrypt.cryptMail(\'' + text + '\');">');
}


function cryptMail(mail){
	mail = decodeBase64(mail);
	
	mail = mail.replace(/__NOSPAM__/, '@');
	document.location.href = 'mailto:' + mail;
}


function saveEncoded(id, base64Field) {
	var text = encodeBase64(
		document.getElementById('content').value
	);
	
	//document.write('--------->' + text);
	//document.write('--------->' + decodeBase64(text));
	
	document.getElementById(base64Field).value = text
	
	//document.write('--------->' + document.getElementById(base64Field).value);
	
	document.getElementById(id).submit();
}


function tcmsJSCrypt(){
	this.rot13 = rot13;
	this.encodeBase64 = encodeBase64;
	this.decodeBase64 = decodeBase64;
	this.encodeUTF8 = encode_utf8;
	this.decodeUTF8 = decode_utf8;
	this.displayCrypt = displayCrypt;
	this.displayCryptMail = displayCryptMail;
	this.displayCryptMailTo = displayCryptMailTo;
	this.cryptMail = cryptMail;
	this.saveEncoded = saveEncoded;
}


JSCrypt = new tcmsJSCrypt();
