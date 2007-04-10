<?php
/*** DON'T TOUCH THIS DECLARATION ***/
if(!defined('X_PATH')) define('X_PATH', $_SERVER['DOCUMENT_ROOT'].'/xhtml2pdf_v0.2.6');
if(!defined('X_PATH_CLASS')) define('X_PATH_CLASS', X_PATH.'/classes');
define('XHTML2PDF_DEFLINESIZE', '5');
define('XHTML2PDF_DEFCHARSIZE', '12');
$debug = 0;
/*************************************/

define('X_OWNER', fileOwner(X_PATH_CLASS.'/config.php')); 
define('X_RACINE', X_PATH); // define the racine directory of the application...
define('X_PATH_SHARE_IMG', X_PATH); // define the share directory to create img

if( file_exists(X_PATH.'/config.ini') && is_file(X_PATH.'/config.ini') 
	&& (fileowner(X_PATH.'/config.ini') == X_OWNER) )	 {
	
	$file = fOpen(X_PATH.'/config.ini', 'r');

	while(!feof($file)) {
		$lines[] = trim(fGets($file, 255));
	}
	
	foreach($lines as $val) {
		if( !ereg('^;', $val) && !empty($val) ) {
			$xploz = explode('=', $val);
			
			$line[trim($xploz[0])] = trim($xploz[1]);
		}
	}
	unset($xploz, $val, $lines, $file);
	
	$line['color']['header']['txt'] = explode_color($line['color_header_txt']);
	$line['color']['footer']['txt'] = explode_color($line['color_footer_txt']);
	$line['color']['header']['rect'] = explode_color($line['color_header_rectangle']);
	$line['color']['footer']['rect'] = explode_color($line['color_footer_rectangle']);

	if(empty($line['font_header_style'])) $line['font_header_style'] = '';
	if(empty($line['font_body_style'])) $line['font_body_style'] = '';
	if(empty($line['font_footer_style'])) $line['font_footer_style'] = '';
	
}

$config = array (

'choice' => array (
	// include header
	'header' => $line['choice_header'],

	// include footer
	'footer' => $line['choice_footer'],

	// include rectangle color in header and footer
	'rectangle' => $line['choix_rectangle'], 

	// display licence 
	'licence' => $line['rights'],
),

// css declaration managed
'allowed' => array( 
	'font-family' => 1,
	'font-size' => 1,
	'font-style' => 1,
	'font-weight' => 1,
	'color'     => 1,
	'display' => 1,
	'text-align' => 1,
	'text-decoration' => 1,
	'text-transform' => 1,
	'white-space' => 1,  
	'margin-top' => 1,
	'margin-right' => 1,
	'margin-bottom' => 1,
	'margin-left' => 1,  
),

// css default declaration
'attrdefault' => array ( 
	'font-family' => 'Arial',
	'font-size' => 12,
	'font-style' => 'normal',
	'font-weight' => '',
	'color'     => '#000',
	'display' => 'inline',
	'text-align' => 'left',
	'text-decoration' => 'none', 
	'text-transform' => 'none',
	'white-space' => 'normal',
	'margin-top' => 0,
	'margin-right' => 0,
	'margin-bottom' => 0,
	'margin-left' => 0,
),

// colors declaration
'color' => array (
	// declaration for the header's colors
	'header' => array (
		// color for the rectangle in header
		'rectangle' => array (
			'R' => $line['color']['header']['rect']['R'],
			'G' => $line['color']['header']['rect']['G'],
			'B' => $line['color']['header']['rect']['B'],
			'height' => $line['size_header_rectangle'],
			'style' => $line['style_header_rectangle'], // D = draw (contour), F = Fill (plein), DF = Draw 'n Fill (contour plein) 
		),
		// color for the text in header
		'text' => array (
			'R' => $line['color']['header']['txt']['R'],
			'G' => $line['color']['header']['txt']['G'],
			'B' => $line['color']['header']['txt']['B'],
		),
	),
	// declaration for the footer's colors
	'footer' => array (
		// color for the rectangle in footer
		'rectangle' => array (
			'R' => $line['color']['footer']['rect']['R'],
			'G' => $line['color']['footer']['rect']['G'],
			'B' => $line['color']['footer']['rect']['B'],
			'height' => $line['size_footer_rectangle'],
			'style' => $line['style_footer_rectangle'], // D = draw (contour), F = Fill (plein), DF = Draw 'n Fill (contour plein) 
		),
		// color for the text in footer
		'text' => array (
			'R' => $line['color']['footer']['txt']['R'],
			'G' => $line['color']['footer']['txt']['G'],
			'B' => $line['color']['footer']['txt']['B'],
		),
	),
),

// fonts declaration
'font' => array (
	'header' => array (
		'family' => $line['font_header_family'],
		'style' => $line['font_header_style'],
		'size' => $line['font_header_size'],
	),
	'body' => array (
		'family' => $line['font_body_family'],
		/*'style' => $line['font_body_style'],
		'size' => $line['font_body_size'],*/
	),
	'footer' => array (
		'family' => $line['font_footer_family'],
		'style' => $line['font_footer_style'],
		'size' => $line['font_footer_size'],
	),
),

// variables sites to include in header and/or footer
'site' => array (
	'name' => 'Site : '.$line['site_name'],
	'page' => 'Article : '.$pdf['title'],
	'url' => array (
		'site' => 'http://'.$_SERVER['HTTP_HOST'],
		'page' =>'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
	),
	'lang' => $line['lang'],
	'charset' => $line['charset'],
	'encoded_html' => $line['encoded_html'],
),

// variables to manage rights
'rights' => array (
	
	'author' => $pdf['author'],
	'title' => $pdf['title'],
	'chapo' => $pdf['chapo'],
	'date' => array (
		'created' => $pdf['date']['created'],
		'modified' => $pdf['date']['modified'],
	),
	
	'licence' => array (
		'code' => array (
			'GPL', 'FDL', 'LGPL', 'LAL', 
			'CC-BY', 'CC-BY-NC', 'CC-BY-ND', 'CC-BY-NC-ND', 'CC-BY-NC-SA', 'CC-BY-SA',
		),
		'url' => array (
			'GPL' => 'http://www.gnu.org/licenses/gpl.html',
			'FDL' => 'http://www.gnu.org/licenses/fdl.html',
			'LGPL' => 'http://www.gnu.org/licenses/lgpl.html',
			'LAL' => 'http://artlibre.org/licence/lal',
			'CC-BY' => 'http://creativecommons.org/licenses/by/2.5/',
			'CC-BY-NC' => 'http://creativecommons.org/licenses/by-nc/2.5/',
			'CC-BY-ND' => 'http://creativecommons.org/licenses/by-nd/2.5/',
			'CC-BY-NC-ND' => 'http://creativecommons.org/licenses/by-nc-nd/2.5/',
			'CC-BY-NC-SA' => 'http://creativecommons.org/licenses/by-nc-sa/2.5/',
			'CC-BY-SA' => 'http://creativecommons.org/licenses/by-sa/2.5/',
		),
		'query' => $line['licence'],
	),
),

'config' => array (
	'owner' => X_OWNER,
	'path' => X_PATH,
	'path_class' => X_PATH_CLASS,
	'path_img' => X_PATH_SHARE_IMG,
),

);

function explode_color($var) {
	$xplod = explode(',', $var);
	$array['R'] = $xplod[0];
	$array['G'] = $xplod[1];
	$array['B'] = $xplod[2];
	return $array;
}

if(!empty($debug)) var_dump($config);
?>
