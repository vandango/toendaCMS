<?php /* _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Aren Slootweg                                                  |
+------------------------------------------------------------------------+
|
| Webcam component
|
| File:		webcam.php
| Version:	0.1.5
|
| Tested With
| - Creative webcam and monitor program
| - Lifetec LT9388
|
+
*/


defined('_TCMS_VALID') or die('Restricted access');





// Step 1: Check your webcam monitor software or create day/time dependend image filenames
//
// Webcams from Creative
// ---------------------
// The most monitor programs that are included by webcams have the
// possibility to grap an image every x seconds and place it in a user path.
// Place this path somewhere in your website root in our case here the webcam directory.
//
// This are the files that the Creative monitor programs creates:
//
// 25-03-2005  20:29            47.958 Img-20050325-1928590140.jpg
// 25-03-2005  20:29            48.114 Img-20050325-1929290250.jpg
// 25-03-2005  20:30            48.115 Img-20050325-1929590312.jpg
// 25-03-2005  20:30            47.903 Img-20050325-1930290390.jpg
// 25-03-2005  20:31            48.087 Img-20050325-1930590453.jpg
// 25-03-2005  20:31            47.627 Img-20050325-1931290546.jpg
// 25-03-2005  20:32            47.873 Img-20050325-1931590625.jpg
// 25-03-2005  20:32            47.761 Img-20050325-1932290703.jpg
// 25-03-2005  20:33            48.089 Img-20050325-1932590781.jpg
// 25-03-2005  20:33            48.151 Img-20050325-1933290859.jpg
// 25-03-2005  20:34            47.851 Img-20050325-1933590921.jpg
// 25-03-2005  20:34            47.777 Img-20050325-1934300015.jpg






//
// Step 2:
//

$mySiteUrl = 'http://www.toenda.com';
$path = $tcms_administer_site.'/components/webcam/images';

$webcamTitle       = $_TCMS_CS_ARRAY['webcam']['content']['webcam_title'];
$webcamSubTitle    = $_TCMS_CS_ARRAY['webcam']['content']['webcam_subtitle'];
$show_webcam_title = $_TCMS_CS_ARRAY['webcam']['content']['show_webcam_title'];
$cs_font_style     = $_TCMS_CS_ARRAY['webcam']['content']['font_style'];
$refreshSeconds    = $_TCMS_CS_ARRAY['webcam']['content']['refresh'];
$image_width       = $_TCMS_CS_ARRAY['webcam']['content']['image_width'];

$webcamFolder   = $_TCMS_CS_ID['webcam']['folder'];


if($_TCMS_CS_ARRAY['webcam']['attribute']['webcam_title']['ENCODE'] == 1){
	$webcamTitle = $tcms_main->encode_text_without_crypt($webcamTitle, '2', $c_charset);
}





//
// Step 3:
//

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
	echo tcms_html::contentheading($webcamTitle);
	echo tcms_html::contentmain($webcamSubTitle);
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



echo '<div style="width: '.$image_width.'px; '.$cs_font_style.'">'
.'<img src="'.$imagePath.$path.'/'.end($files).'" width="'.$image_width.'" border="0" />'
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
