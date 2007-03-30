<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
|
| Webcam sidebar component
| [based an Aren Slootweg's work]
|
| File:		webcam_sb.php
| Version:	0.0.6
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');


if(isset($_GET['dc_name'])){ $dc_name = $_GET['dc_name']; }
if(isset($_GET['dc_domain'])){ $dc_domain = $_GET['dc_domain']; }

if(isset($_POST['dc_name'])){ $dc_name = $_POST['dc_name']; }
if(isset($_POST['dc_domain'])){ $dc_domain = $_POST['dc_domain']; }





$mySiteUrl = 'http://www.toenda.com';
$path = $tcms_administer_site.'/components/webcam/images';

$webcamTitle       = $_TCMS_CS_ARRAY['webcam']['content']['sb_webcam_title'];
$webcamSubTitle    = $_TCMS_CS_ARRAY['webcam']['content']['sb_webcam_subtitle'];
$show_webcam_title = $_TCMS_CS_ARRAY['webcam']['content']['sb_show_webcam_title'];
$cs_font_style     = $_TCMS_CS_ARRAY['webcam']['content']['sb_font_style'];
$refreshSeconds    = $_TCMS_CS_ARRAY['webcam']['content']['refresh'];
$sb_image_width    = $_TCMS_CS_ARRAY['webcam']['content']['sb_image_width'];

$webcamFolder   = $_TCMS_CS_ID['webcam']['folder'];


if($_TCMS_CS_ARRAY['webcam']['attribute']['sb_webcam_title']['ENCODE'] == 1){
	$webcamTitle = $tcms_main->encode_text_without_crypt($webcamTitle, '2', $c_charset);
}




// Open the image directory
if($handle = opendir($path)){
	// Walk to directory and filter dir and show only .jpg files
	while(false !== ($file = readdir($handle))){
		if($file != '.' && $file != '..' && end(explode('.',$file)) == 'jpg'){
			$files[] =  $file;
		}
	}
	
	// Sort files so the latest is down
	sort($files);
	
	// To prevent the Image directory to be filled up we keep only the last 10 images
	// Delete old files
	
	if(count($files)>10){
		for($i=0; $i<count($files)-10; $i++){
			unlink($path.'/'.$files[$i]);
		}
	}
	
	// Also kill the extra entry's in the array we have created
	$files = array_slice($files, count($files)-10, 10);
	closedir($handle);
}



if($show_webcam_title == 1){
	echo tcms_html::subtitle($webcamTitle);
	echo tcms_html::sidemain($webcamSubTitle);
	//echo '<br />';
}
else{
	echo '<br />';
}


/*
	Build the url for the refresh with the last images as parameter
	we use this GET var 'old' to detect if the camera is running
*/
$link = '?'.( isset($session) ? 'session='.$session.'&amp;' : '' ).'id=components&amp;item='.$webcamFolder.'&amp;s='.$s.'&amp;old='.end($files);
$url = $tcms_main->urlAmpReplace($link);



/*
	Build the page
	Here we refresh the iframe automatically every x seconds to update the image at the client
*/
echo '<script type="text/javascript">'
.'function reloadWebcam(){ location.reload(); }'
.'window.setTimeout(\'reloadWebcam()\', '.$refreshSeconds.'000);'
.'</script>';



echo '<div style="width: '.$sb_image_width.'px; '.$cs_font_style.'">'
.'<img src="'.$imagePath.$path.'/'.end($files).'" width="'.$sb_image_width.'" border="0" />'
.'<br />';



/*
	Get the date and time values from the image filename
*/
echo 'Date:&nbsp;'.substr(end($files),10,2).'-'.substr(end($files),8,2).'-'.substr(end($files),4,4).'<br />'
.'Time:&nbsp;'.strval(intval(substr(end($files),13,2))+1).':'.substr(end($files),15,2).':'.substr(end($files),17,2);


echo '</div>';


echo '<br />';
//echo '<br />';

?>
