/*       _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Edit JavaScript Functions
|
| File:		edit.js
| Version:	0.7.8
|
+
*/


/**
 *
 * JAVASCRIPT EDITOR FUNCTIONS
 *
 * createToendaToolbar(form, lang, editor, extra, front, session)
 * createToendaHelpButton(lang, helptext)
 * createToolbar(form, lang, script)         -> show the toolbar
 * createTemplateToolbar(form, script)       -> show the toolbar for the template editor
 * createCSSToolbar(form, script)            -> show the toolbar for the css template editor
 * clearCommandHTML(form, id)                -> clear text from all HTML commands
 * clearCommandtoendaScript(form, id)        -> clear text from all toendaScript commands
 * insertCommand(form, id, command)          -> insert command at position
 *
 */



/**
 * Create a toenda toolbar
 * 
 * @param String form
 * @param String lang
 * @param String editor
 * @param String extra
 * @param String front
 * @param String session
 * @return String
 */
function createToendaToolbar(form, lang, editor, extra, front, session) {
	if(front == '') {
		extra = 'media.php?id_user=' + session + '&' + extra;
	}
	else {
		extra = front + extra;
	}
	
	switch(lang) {
		case 'english_EN':
			var tSB_image = 'Search images';
			var tSB_more = 'Own News end';
			var tSB_links = 'Search intern pages';
			break;
		
		case 'germany_DE':
			var tSB_image = 'Bilder suchen';
			var tSB_more = 'Eigene Neuigkeiten Ende';
			var tSB_links = 'Interne Seiten suchen';
			break;
		
		default:
			var tSB_image = 'Search images';
			var tSB_more = 'Own News end';
			var tSB_links = 'Search intern pages';
			break;
	}
	
	switch(editor) {
		case 'fckeditor':
			//
			break;
		
		case 'tinymce':
			document.write(
				'<a href="#" class="tcms_editor tcms_imagefont" alt="' 
				+ tSB_image 
				+ '" title="' 
				+ tSB_image 
				+ '" onclick="openWindow(\'' 
				+ extra 
				+ '\', \'ImageBrowser\', \'400\', \'500\', \'0\', \'0\');">&nbsp;</a>'
			);
			
			extra = 'node.php?id_user=' + session + '&' + extra;
			
			document.write(
				'<a href="#" class="tcms_editor tcms_link" alt="' 
				+ tSB_links 
				+ '" title="' 
				+ tSB_links 
				+ '" onclick="openWindow(\'' 
				+ extra 
				+ '\', \'LinkBrowser\', \'600\', \'500\', \'0\', \'0\');">&nbsp;</a>'
			);
			
			if(form == 'news' 
			|| form == 'contentPage') {
				document.write(
					'<a href="#" class="tcms_editor tcms_morefont" alt="' 
					+ tSB_more 
					+ '" title="' 
					+ tSB_more 
					+ '" onclick="tinyMCE.execCommand(\'mceInsertContent\',false,\'{tcms_more}\');">&nbsp;</a>'
				);
			}
			break;
		
		default:
			document.write('<a href="#" class="tcms_editor tcms_imagefont" alt="' + tSB_image + '" title="' + tSB_image + '" onclick="openWindow(\'' + extra + '\', \'ImageBrowser\', \'400\', \'500\', \'0\', \'0\');">&nbsp;</a>');
			
			extra = 'node.php?id_user=' + session + '&' + extra;
			document.write('<a href="#" class="tcms_editor tcms_link" alt="' + tSB_links + '" title="' + tSB_links + '" onclick="openWindow(\'' + extra + '\', \'LinkBrowser\', \'600\', \'500\', \'0\', \'0\');">&nbsp;</a>');
			
			if(form == 'news' 
			|| form == 'contentPage'
			|| form == 'personal') {
				document.write('<a href="#" class="tcms_editor tcms_morefont" alt="' + tSB_more + '" title="' + tSB_more + '" onclick="insertCommand(\'' + form + '\', \'content\', \'more\', \'toendaScript\');">&nbsp;</a>');
			}
			break;
	}
}



/**
 * Create the toenda help button
 * 
 * @param String lang
 * @param String helptext
 * @return String
 */
function createToendaHelpButton(lang, helptext) {
	switch(lang) {
		case 'english_EN':
			var tSB_help = 'Show help';
			break;
		
		case 'germany_DE':
			var tSB_help = 'Hilfe anzeigen';
			break;
		
		default:
			var tSB_help = 'Show help';
			break;
	}
	
	document.write('<a href="#" class="tcms_editor tcms_help" alt="' + tSB_help + '" title="' + tSB_help + '" onclick="helpWindow(\'help.php?helpText=' + helptext + '\');">&nbsp;</a>');
}



/**
 * Create a default toolbar
 * 
 * @param String form
 * @param String lang
 * @param String script
 * @return String
 */
function createToolbar(form, lang, script) {
	switch(lang) {
		case 'english_EN':
			var tSB_Cite = 'Cite';
			var tSB_List = 'List';
			var tSB_List = 'List';
			var tSB_nList = 'Numbered List';
			var tSB_ListItem = 'List item';
			var tSB_Center = 'Center';
			var tSB_Right = 'Right';
			var tSB_Left = 'Left';
			var tSB_Link = 'Link';
			var tSB_ClearC = 'Clear Tags';
			break;
		
		case 'germany_DE':
			var tSB_Cite = 'Zitat';
			var tSB_List = 'Liste';
			var tSB_nList = 'Nummerierte Liste';
			var tSB_ListItem = 'Listenpunkt';
			var tSB_Center = 'Zentriert';
			var tSB_Right = 'Rechts';
			var tSB_Left = 'Links';
			var tSB_Link = 'Link';
			var tSB_ClearC = 'Befehle l' + unescape("%F6") + 'schen';
			break;
		
		default:
			var tSB_Cite = 'Cite';
			var tSB_List = 'List';
			var tSB_nList = 'Numbered List';
			var tSB_ListItem = 'List item';
			var tSB_Center = 'Center';
			var tSB_Right = 'Right';
			var tSB_Left = 'Left';
			var tSB_Link = 'Link';
			var tSB_ClearC = 'Clear Tags';
			break;
	}
	
	document.write('<a href="#" class="tcms_editor tcms_headfont" alt="H1-6" title="H1-6" onclick="insertCommand(\'' + form + '\', \'content\', \'head\', \'' + script + '\');">&nbsp;</a>');
	document.write('<a href="#" class="tcms_editor tcms_boldfont" alt="B" title="B" onclick="insertCommand(\'' + form + '\', \'content\', \'b\', \'' + script + '\');">&nbsp;</a>');
	document.write('<a href="#" class="tcms_editor tcms_italicfont" alt="I" title="I" onclick="insertCommand(\'' + form + '\', \'content\', \'i\', \'' + script + '\');">&nbsp;</a>');
	
	if(script != 'Wiki') {
		document.write(
			'<a href="#" class="tcms_editor tcms_underlinedfont" alt="U" title="U" onclick="insertCommand(\'' 
			+ form + '\', \'content\', \'u\', \'' 
			+ script + '\');">&nbsp;</a>'
		);
		
		document.write(
			'<a href="#" class="tcms_editor tcms_ttfont" alt="tt" title="tt" onclick="insertCommand(\'' 
			+ form + '\', \'content\', \'tt\', \'' 
			+ script + '\');">&nbsp;</a>'
		);
	}
	
	document.write(
		'<a href="#" class="tcms_editor tcms_citefont" alt="' 
		+ tSB_Cite + '" title="' 
		+ tSB_Cite + '" onclick="insertCommand(\'' 
		+ form + '\', \'content\', \'cite\', \'' 
		+ script + '\');">&nbsp;</a>'
	);
	
	document.write(
		'<a href="#" class="tcms_editor tcms_hrfont" alt="Line" title="Line" onclick="insertCommand(\'' 
		+ form + '\', \'content\', \'hr\', \'' 
		+ script 
		+ '\');">&nbsp;</a>'
	);
	
	if(script != 'Wiki') {
		document.write(
			'<a href="#" class="tcms_editor tcms_ulfont" alt="' 
			+ tSB_List + '" title="' 
			+ tSB_List + '" onclick="insertCommand(\'' 
			+ form + '\', \'content\', \'ul\', \'' 
			+ script + '\');">&nbsp;</a>'
		);
	}
	
	document.write('<a href="#" class="tcms_editor tcms_olfont" alt="' + tSB_nList + '" title="' + tSB_nList + '" onclick="insertCommand(\'' + form + '\', \'content\', \'ol\', \'' + script + '\');">&nbsp;</a>');
	document.write('<a href="#" class="tcms_editor tcms_lifont" alt="' + tSB_ListItem + '" title="' + tSB_ListItem + '" onclick="insertCommand(\'' + form + '\', \'content\', \'li\', \'' + script + '\');">&nbsp;</a>');
	
	if(script != 'Wiki') {
		document.write(
			'<a href="#" class="tcms_editor tcms_centerfont" alt="' 
			+ tSB_Center + '" title="' 
			+ tSB_Center + '" onclick="insertCommand(\'' 
			+ form + '\', \'content\', \'center\', \'' 
			+ script + '\');">&nbsp;</a>'
		);
		
		document.write(
			'<a href="#" class="tcms_editor tcms_leftfont" alt="' 
			+ tSB_Left + '" title="' 
			+ tSB_Left + '" onclick="insertCommand(\'' 
			+ form + '\', \'content\', \'left\', \'' 
			+ script + '\');">&nbsp;</a>'
		);
		
		document.write(
			'<a href="#" class="tcms_editor tcms_rightfont" alt="' 
			+ tSB_Right + '" title="' 
			+ tSB_Right + '" onclick="insertCommand(\'' 
			+ form + '\', \'content\', \'right\', \'' 
			+ script + '\');">&nbsp;</a>'
		);
	}
	
	document.write('<a href="#" class="tcms_editor tcms_urlfont" alt="' + tSB_Link + '" title="' + tSB_Link + '" onclick="insertCommand(\'' + form + '\', \'content\', \'url\', \'' + script + '\');">&nbsp;</a>');
	
	if(script == 'HTML') {
		document.write('<a href="#" class="tcms_editor tcms_clearfont" alt="' + tSB_ClearC + '" title="' + tSB_ClearC + '" onclick="clearCommandHTML(\'' + form + '\', \'content\');">&nbsp;</a>');
	}
	else if(script == 'Wiki') {
		document.write('<a href="#" class="tcms_editor tcms_clearfont" alt="' + tSB_ClearC + '" title="' + tSB_ClearC + '" onclick="clearCommandWiki(\'' + form + '\', \'content\');">&nbsp;</a>');
	}
	else if(script == 'toendaScript') {
		document.write('<a href="#" class="tcms_editor tcms_clearfont" alt="' + tSB_ClearC + '" title="' + tSB_ClearC + '" onclick="clearCommandtoendaScript(\'' + form + '\', \'content\');">&nbsp;</a>');
	}
}



function createTemplateToolbar(form, script) {
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Sitetitle" onclick="insertCommand(\'' + form + '\', \'content\', \'st\', \'' + script + '\');" />');
	//document.write('<input type="button" name="tcms_more" class="tcms_more" value="Charset" onclick="insertCommand(\'' + form + '\', \'content\', \'char\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Metadata" onclick="insertCommand(\'' + form + '\', \'content\', \'md\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Sitename" onclick="insertCommand(\'' + form + '\', \'content\', \'sn\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Sitedescription" onclick="insertCommand(\'' + form + '\', \'content\', \'sd\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Topmenu" onclick="insertCommand(\'' + form + '\', \'content\', \'tm\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Sidemenu" onclick="insertCommand(\'' + form + '\', \'content\', \'sm\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Pathway" onclick="insertCommand(\'' + form + '\', \'content\', \'pw\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Content" onclick="insertCommand(\'' + form + '\', \'content\', \'c\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Sidecontent" onclick="insertCommand(\'' + form + '\', \'content\', \'sc\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Contentfooter" onclick="insertCommand(\'' + form + '\', \'content\', \'cf\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Footer" onclick="insertCommand(\'' + form + '\', \'content\', \'f\', \'' + script + '\');" />');
	
	document.write('<br />');
	
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Search" onclick="insertCommand(\'' + form + '\', \'content\', \'sea\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="News Categories" onclick="insertCommand(\'' + form + '\', \'content\', \'cat\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="News Archives" onclick="insertCommand(\'' + form + '\', \'content\', \'mv\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Sidelinks / Blogroll" onclick="insertCommand(\'' + form + '\', \'content\', \'sli\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Login" onclick="insertCommand(\'' + form + '\', \'content\', \'log\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Poll" onclick="insertCommand(\'' + form + '\', \'content\', \'poll\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Layout Changer" onclick="insertCommand(\'' + form + '\', \'content\', \'slc\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Newsletter" onclick="insertCommand(\'' + form + '\', \'content\', \'nl\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Last Images" onclick="insertCommand(\'' + form + '\', \'content\', \'li\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Syndication" onclick="insertCommand(\'' + form + '\', \'content\', \'syn\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Sidebar Components" onclick="insertCommand(\'' + form + '\', \'content\', \'cs\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Sidebar News" onclick="insertCommand(\'' + form + '\', \'content\', \'sbn\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Language Selector" onclick="insertCommand(\'' + form + '\', \'content\', \'ls\', \'' + script + '\');" />');
	
	document.write('<br />');
}



function createCSSToolbar(form, script) {
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="HTML Block" onclick="insertCommand(\'' + form + '\', \'content\', \'html\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Class Block" onclick="insertCommand(\'' + form + '\', \'content\', \'class\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="ID Block" onclick="insertCommand(\'' + form + '\', \'content\', \'id\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Comment" onclick="insertCommand(\'' + form + '\', \'content\', \'comment\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Width" onclick="insertCommand(\'' + form + '\', \'content\', \'width\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Margin" onclick="insertCommand(\'' + form + '\', \'content\', \'margin\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Padding" onclick="insertCommand(\'' + form + '\', \'content\', \'padding\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Font color" onclick="insertCommand(\'' + form + '\', \'content\', \'color\', \'' + script + '\');" />');
	document.write('<input type="button" name="tcms_more" class="tcms_more" value="Background" onclick="insertCommand(\'' + form + '\', \'content\', \'bg\', \'' + script + '\');" />');
	
	document.write('<br />');
}



function clearCommandHTML(form, id) {
	var content;
	
	input = document.forms[form].elements[id];
	content = input.value;
	
	content = content.replace(/<br \/>/gi, '');
	
	content = content.replace(/<hr \/>/gi, '');
	
	content = content.replace(/<strong>/gi, '');
	content = content.replace(/<\/strong>/gi, '');
	
	content = content.replace(/<h\w>/gi, '');
	content = content.replace(/<\/h\w>/gi, '');
	
	content = content.replace(/<em>/gi, '');
	content = content.replace(/<\/em>/gi, '');
	
	content = content.replace(/<u>/gi, '');
	content = content.replace(/<\/u>/gi, '');
	
	content = content.replace(/<blockquote>/gi, '');
	content = content.replace(/<\/blockquote>/gi, '');
	
	content = content.replace(/<tt>/gi, '');
	content = content.replace(/<\/tt>/gi, '');
	
	content = content.replace(/<ul>/gi, '');
	content = content.replace(/<\/ul>/gi, '');
	
	content = content.replace(/<ol>/gi, '');
	content = content.replace(/<\/ol>/gi, '');
	
	content = content.replace(/<li>/gi, '');
	content = content.replace(/<\/li>/gi, '');
	
	content = content.replace(/align="center"/gi, '');
	
	content = content.replace(/align="left"/gi, '');
	
	content = content.replace(/align="right"/gi, '');
	
	input.value = content;
}



function clearCommandWiki(form, id) {
	var content;
	
	/*
	'''Fetter Text'''
	''Kursiver Text''
	[http://www.beispiel.de Link-Text]
	[http://www.beispiel.de Link-Text]
	
	== H1 ==
	=== H2 ===
	==== H3 ====
	===== H4 =====
	[[Bild:Beispiel.jpg]]
	[[Media:Beispiel.ogg]]
	<math>Formel hier einfügen</math>
	<nowiki>Unformatierten Text hier einfügen</nowiki>
	--~~~~
	
	----
	*/
	
	input = document.forms[form].elements[id];
	content = input.value;
	
	content = content.replace(/----/gi, '');
	
	content = content.replace(/\'\'\'/gi, '');
	content = content.replace(/\'\'/gi, '');
	
	content = content.replace(/===== /gi, '');
	content = content.replace(/==== /gi, '');
	content = content.replace(/=== /gi, '');
	content = content.replace(/== /gi, '');
	
	content = content.replace(/\* /gi, '');
	content = content.replace(/\# /gi, '');
	
	input.value = content;
}



function clearCommandtoendaScript(form, id) {
	var content;
	
	input = document.forms[form].elements[id];
	content = input.value;
	
	content = content.replace(/{br}/gi, '');
	
	content = content.replace(/{hr}/gi, '');
	
	content = content.replace(/{h\w:}/gi, '');
	content = content.replace(/{:h\w}/gi, '');
	
	content = content.replace(/{b:}/gi, '');
	content = content.replace(/{:b}/gi, '');
	
	content = content.replace(/{i:}/gi, '');
	content = content.replace(/{:i}/gi, '');
	
	content = content.replace(/{u:}/gi, '');
	content = content.replace(/{:u}/gi, '');
	
	content = content.replace(/{tt:}/gi, '');
	content = content.replace(/{:tt}/gi, '');
	
	content = content.replace(/{cite:}/gi, '');
	content = content.replace(/{:cite}/gi, '');
	
	content = content.replace(/{ul:}/gi, '');
	content = content.replace(/{:ul}/gi, '');
	
	content = content.replace(/{ol:}/gi, '');
	content = content.replace(/{:ol}/gi, '');
	
	content = content.replace(/{li:}/gi, '');
	content = content.replace(/{:li}/gi, '');
	
	content = content.replace(/{center:}/gi, '');
	content = content.replace(/{:center}/gi, '');
	
	content = content.replace(/{left:}/gi, '');
	content = content.replace(/{:left}/gi, '');
	
	content = content.replace(/{right:}/gi, '');
	content = content.replace(/{:right}/gi, '');
	
	input.value = content;
}



function insertCommand(form, id, command, script) {
	var commandValuePre;
	var commandValuePost;
	var insName = '';
	
	var input = document.forms[form].elements[id];
	
	switch(script) {
		case 'HTML':
			switch(command) {
				case 'head':
					var insSize = prompt('Size (1-6):', '1');
					
					if(insSize == '' || insSize == 0 || insSize == null || insSize >= 7) {
						insSize = 1;
					}
					commandValuePre = '<h' + insSize + '>';
					commandValuePost = '</h' + insSize + '>';
					break;
				
				case 'b':
					commandValuePre = '<strong>';
					commandValuePost = '</strong>';
					break;
				
				case 'i':
					commandValuePre = '<em>';
					commandValuePost = '</em>';
					break;
				
				case 'u':
					commandValuePre = '<u>';
					commandValuePost = '</u>';
					break;
				
				case 'tt':
					commandValuePre = '<tt>';
					commandValuePost = '</tt>';
					break;
				
				case 'cite':
					commandValuePre = '<blockquote>';
					commandValuePost = '</blockquote>';
					break;
				
				case 'hr':
					commandValuePre = '<hr />';
					commandValuePost = '';
					break;
				
				case 'ul':
					commandValuePre = '<ul>';
					commandValuePost = '</ul>';
					break;
				
				case 'ol':
					commandValuePre = '<ol>';
					commandValuePost = '</ol>';
					break;
				
				case 'li':
					commandValuePre = '<li>';
					commandValuePost = '</li>';
					break;
				
				case 'center':
					commandValuePre = '<div align="center">';
					commandValuePost = '</div>';
					break;
				
				case 'left':
					commandValuePre = '<div align="left">';
					commandValuePost = '</div>';
					break;
				
				case 'right':
					commandValuePre = '<div align="right">';
					commandValuePost = '</div>';
					break;
				
				case 'url':
					var insURL = prompt('URL:', 'http://');
					var insTarget;
					
					var delCheck = confirm('Open in a new window?');
					if(delCheck != false) { insTarget = ' target="_blank"'; }
					else { insTarget = ''; }
					
					commandValuePre = '<a href="' + insURL + '"' + insTarget + '>';
					commandValuePost = '</a>';
					break;
				
				case 'more':
					commandValuePre = '';
					commandValuePost = '{tcms_more}';
					break;
				
				default:
					commandValuePre = '';
					commandValuePost = '<br />';
					break;
			}
			break;
		
		case 'Wiki':
			switch(command) {
				case 'head':
					var insSize = prompt('Size (1-4):', '1');
					
					if(insSize == '' || insSize == 0) {
						insSize = 1;
					}
					
					switch(insSize) {
						case '1':
							commandValuePre = '= ';
							commandValuePost = ' =';
							break;
						
						case '2':
							commandValuePre = '== ';
							commandValuePost = ' ==';
							break;
						
						case '3':
							commandValuePre = '=== ';
							commandValuePost = ' ===';
							break;
						
						case '4':
							commandValuePre = '==== ';
							commandValuePost = ' ====';
							break;
						
						default:
							commandValuePre = '= ';
							commandValuePost = ' =';
							break;
					}
					break;
				
				case 'b':
					commandValuePre = '\'\'\'';
					commandValuePost = '\'\'\'';
					break;
				
				case 'i':
					commandValuePre = '\'\'';
					commandValuePost = '\'\'';
					break;
				
				case 'hr':
					commandValuePre = '----';
					commandValuePost = '';
					break;
				
				case 'ol':
					commandValuePre = '# ';
					commandValuePost = '';
					break;
				
				case 'li':
					commandValuePre = '* ';
					commandValuePost = '';
					break;
				
				case 'url':
					var insURL = prompt('URL:', 'http://');
					var insTarget;
					
					var delCheck = confirm('Open in a new window?');
					if(delCheck != false) {
						insTarget = '_blank';
					}
					else {
						insTarget = '';
					}
					
					commandValuePre = '[' + insURL + ' ';
					commandValuePost = ']';
					break;
				
				case 'cite':
					commandValuePre = '<blockquote>';
					commandValuePost = '</blockquote>';
					break;
				
				case 'u':
				case 'tt':
				case 'ul':
				case 'center':
				case 'left':
				case 'right':
					commandValuePre = '';
					commandValuePost = '';
					break;
				
				case 'more':
					commandValuePre = '';
					commandValuePost = '{tcms_more}';
					break;
				
				default:
					commandValuePre = '';
					commandValuePost = '\n';
					break;
			}
			break;
		
		case 'toendaScript':
			switch(command) {
				case 'head':
					var insSize = prompt('Size (1-6):', '1');
					
					if(insSize == '' || insSize == 0) {
						insSize = 1;
					}
					
					commandValuePre = '{h' + insSize + ':}';
					commandValuePost = '{:h' + insSize + '}';
					break;
				
				case 'b':
					commandValuePre = '{b:}';
					commandValuePost = '{:b}';
					break;
				
				case 'i':
					commandValuePre = '{i:}';
					commandValuePost = '{:i}';
					break;
				
				case 'u':
					commandValuePre = '{u:}';
					commandValuePost = '{:u}';
					break;
				
				case 'tt':
					commandValuePre = '{tt:}';
					commandValuePost = '{:tt}';
					break;
				
				case 'ul':
					commandValuePre = '{ul:}';
					commandValuePost = '{:ul}';
					break;
				
				case 'hr':
					commandValuePre = '{hr}';
					commandValuePost = '';
					break;
				
				case 'cite':
					commandValuePre = '{cite:}';
					commandValuePost = '{:cite}';
					break;
				
				case 'ol':
					commandValuePre = '{ol:}';
					commandValuePost = '{:ol}';
					break;
				
				case 'li':
					commandValuePre = '{li:}';
					commandValuePost = '{:li}';
					break;
				
				case 'center':
					commandValuePre = '{center:}';
					commandValuePost = '{:center}';
					break;
				
				case 'left':
					commandValuePre = '{left:}';
					commandValuePost = '{:left}';
					break;
				
				case 'right':
					commandValuePre = '{right:}';
					commandValuePost = '{:right}';
					break;
				
				case 'url':
					var insURL = prompt('URL:', 'http://');
					var insTarget;
					
					var delCheck = confirm('Open in a new window?');
					if(delCheck != false) { insTarget = '_blank'; }
					else { insTarget = ''; }
					
					commandValuePre = '{url#' + insURL + '#' + insTarget + ':}';
					commandValuePost = '{:url}';
					break;
				
				case 'more':
					commandValuePre = '';
					commandValuePost = '{tcms_more}';
					break;
				
				default:
					commandValuePre = '';
					commandValuePost = '{br}';
					break;
			}
			break;
		
		case 'toendaTemplate':
			switch(command) {
				case 'st':
					commandValuePre = '<\? echo _SITE_TITLE.\' | \'; include(_SITETITLE); \?>';
					commandValuePost = '';
					break;
				
				case 'char':
					commandValuePre = '<\? $char_xml = new xmlparser(\'data/tcms_global/var.xml\', \'r\'); $charset = $char_xml->read_section(\'global\', \'charset\'); \?>\n';
					commandValuePost = '<meta http-equiv="Content-Type" content="text/html; charset=<\? echo $charset; \?>" />\n';
					break;
				
				case 'md':
					//commandValuePre = '<meta name="generator" content="<\? echo $cms_name; \?> - Copyright 2003 - 2005 Toenda Software Development.  All rights reserved." />\n<meta name="description" content="<\? echo $description; \?>" />\n';
					//commandValuePost = '<meta name="keywords" content="<\? echo $keywords; \?>" />\n<meta name="author" content="<\? echo $websiteowner; \?>" />\n';
					commandValuePre = '<\? include(_SITE_META_DATA); \?>\n';
					commandValuePost = '';
					break;
				
				case 'sn':
					commandValuePre = '<h1 class="title"><\? echo _SITE_NAME; \?></h1>\n';
					commandValuePost = '';
					break;
				
				case 'sd':
					commandValuePre = '<span class="subtitle"><\? echo _SITE_KEY; \?></span>\n';
					commandValuePost = '';
					break;
				
				case 'tm':
					commandValuePre = '<\? include(_TOP_MENU); \?>\n';
					commandValuePost = '';
					break;
				
				case 'sm':
					commandValuePre = '<\? include(_SIDE_MENU); \?>\n';
					commandValuePost = '';
					break;
				
				case 'pw':
					commandValuePre = '<\? include(_PATHWAY); \?>\n';
					commandValuePost = '';
					break;
				
				case 'c':
					commandValuePre = '<\? include(_CONTENT); \?>\n';
					commandValuePost = '';
					break;
				
				case 'sc':
					commandValuePre = '<\? include(_SIDE); \?>\n';
					commandValuePost = '';
					break;
				
				case 'cf':
					commandValuePre = '<\? include(_CONTENT_FOOTER); \?>\n';
					commandValuePost = '';
					break;
				
				case 'f':
					commandValuePre = '<\? include(_FOOTER); \?>\n';
					commandValuePost = '';
					break;
				
				case 'sea':
					commandValuePre = '<\? include(_SEARCH); \?>\n';
					commandValuePost = '';
					break;
				
				case 'cat':
					commandValuePre = '<\? include(_CATEGORIES); \?>\n';
					commandValuePost = '';
					break;
				
				case 'sli':
					commandValuePre = '<\? include(_SIDE_LINKS); \?>\n';
					commandValuePost = '';
					break;
				
				case 'log':
					commandValuePre = '<\? include(_LOGIN); \?>\n';
					commandValuePost = '';
					break;
				
				case 'poll':
					commandValuePre = '<\? include(_POLL); \?>\n';
					commandValuePost = '';
					break;
				
				case 'slc':
					commandValuePre = '<\? include(_SHOW_LC); \?>\n';
					commandValuePost = '';
					break;
				
				case 'nl':
					commandValuePre = '<\? include(_NEWSLETTER); \?>\n';
					commandValuePost = '';
					break;
				
				case 'li':
					commandValuePre = '<\? include(_LAST_IMAGES); \?>\n';
					commandValuePost = '';
					break;
				
				case 'syn':
					commandValuePre = '<\? include(_SYNDICATION); \?>\n';
					commandValuePost = '';
					break;
				
				case 'cs':
					commandValuePre = '<\? include(_CS); \?>\n';
					commandValuePost = '';
					break;
				
				case 'sbn':
					commandValuePre = '<\? include(_FRONT_NEWS); \?>\n';
					commandValuePost = '';
					break;
				
				case 'mv':
					commandValuePre = '<\? include(_MONTHVIEW); \?>\n';
					commandValuePost = '';
					break;
				
				case 'ls':
					commandValuePre = '<\? include(_LANG_SELECTOR); \?>\n';
					commandValuePost = '';
					break;
			}
			break;
		
		case 'CSS':
			switch(command) {
				case 'html':
					var insVal = prompt('Enter the needed HTML tag', 'body');
					
					if(insVal == '') { insVal = 'body'; }
					
					commandValuePre = insVal + ' {\n';
					commandValuePost = '}\n';
					break;
				
				case 'class':
					var insVal = prompt('Enter the needed class name', 'header');
					
					if(insVal == '') { insVal = 'YOUR_CLASS_NAME'; }
					
					commandValuePre = '.' + insVal + ' {\n';
					commandValuePost = '}\n';
					break;
				
				case 'id':
					var insVal = prompt('Enter the needed id name', 'page');
					
					if(insVal == '') { insVal = 'YOUR_ID_NAME'; }
					
					commandValuePre = '#' + insVal + ' {\n';
					commandValuePost = '}\n';
					break;
				
				case 'comment':
					commandValuePre = '/*';
					commandValuePost = '*/';
					break;
				
				case 'width':
					var insVal = prompt('Enter your width value\nFormats: 500px od 100%', '500px');
					
					if(insVal == '') { insVal = '100%'; }
					
					commandValuePre = 'width: ' + insVal;
					commandValuePost = ';\n';
					break;
				
				case 'margin':
					var insVal = prompt('Enter your margin values\nThis is the format: TOP RIGHT BOTTOM LEFT\nValue format: 0px 1px 2px 3px', '0px 0px 0px 0px');
					
					if(insVal == '') { insVal = '0px 0px 0px 0px'; }
					
					commandValuePre = 'margin: ' + insVal;
					commandValuePost = ';\n';
					break;
				
				case 'padding':
					var insVal = prompt('Enter your padding values\nThis is the format: TOP RIGHT BOTTOM LEFT\nValue format: 0px 1px 2px 3px', '0px 0px 0px 0px');
					
					if(insVal == '') { insVal = '0px 0px 0px 0px'; }
					
					commandValuePre = 'padding: ' + insVal;
					commandValuePost = ';\n';
					break;
				
				case 'color':
					var insVal = prompt('Enter the font color value\nThis is the format: RRGGBB', '000000');
					
					if(insVal == '') { insVal = '000000'; }
					
					commandValuePre = 'color: #' + insVal;
					commandValuePost = ';\n';
					break;
				
				case 'bg':
					var insVal = prompt('Enter the background color value\nThis is the format: RRGGBB', '000000');
					var insImg = prompt('Enter the background image name, leave blank for no image', '');
					
					if(insVal == '') { insVal = '000000'; }
					if(insImg != '') { insImg = ' url(' + insImg + ')'; }
					
					commandValuePre = 'background: #' + insVal + insImg;
					commandValuePost = ';\n';
					break;
			}
			break;
	}
	
	if(document.selection) {
		var oldContent;
		var newContent;
		var selectedContent;
		var changedSelectedContent;
		
		selectedContent = document.selection.createRange().text;
		oldContent = input.value;
		
		if(selectedContent == '') {
			if(command == 'url') {
				insName = prompt('Name:');
			}
			
			input.value = oldContent + commandValuePre + insName + commandValuePost
			input.focus();
		}
		else {
			changedSelectedContent = commandValuePre + selectedContent + commandValuePost;
			
			newContent = oldContent.replace(selectedContent, changedSelectedContent);
			
			input.value = newContent;
			input.focus();
		}
	}
	else if(window.getSelection) {
		var start = input.selectionStart;
		var end = input.selectionEnd;
		var insText = input.value.substring(start, end);
		
		if(insText.length == 0) {
			if(command == 'url') {
				insName = prompt('Name:');
			}
		}
		
		input.value = input.value.substr(0, start) + commandValuePre + insName + insText + commandValuePost + input.value.substr(end);
		
		var pos;
		
		if(insText.length == 0) {
			pos = start + commandValuePre.length;
		}
		else {
			pos = start + commandValuePre.length + insText.length + commandValuePost.length;
		}
		
		input.selectionStart = pos;
		input.selectionEnd = pos;
		input.focus();
	}
	else {
		var pos;
		var re = new RegExp('^[0-9]{0,3}$');
		
		while(!re.test(pos)) {
			//pos = prompt("Einfï¿½gen an Position (0.." + input.value.length + "):", "0");
			pos = input.value.length;
		}
		
		if(pos > input.value.length) {
			pos = input.value.length;
		}
		
		var insText = prompt('Insert Command:');
		input.value = input.value.substr(0, pos) + commandValuePre + insText + commandValuePost + input.value.substr(pos);
	}
}


