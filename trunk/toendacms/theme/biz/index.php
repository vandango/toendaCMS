<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?php

$skinData = 'src/';
$skinPath = $templatePath.$skinData;

/*
	You can use this theme with
	random images and with a
	header image for each page.
	
	You must only set the next
	parameters:
	
	$useRandomImages = 0; // <-- This means that you
	                      //     want to use a header
	                      //     image for each page.
	$useRandomImages = 1; // <-- This means that you
	                      //     want to use random images.
	
	$arrHeaderImages['???'] = ''; // <-- This are the images.
	                                     If you want a special
	                                     image for a document page
	                                     with a id like this [18e2a],
	                                     then copy on of this array
	                                     item and change the three
	                                     question marks with your id.
*/
$useRandomImages = 1;

$arrHeaderImages['frontpage'] = 'startpage01.jpg';
$arrHeaderImages['contactform'] = 'startpage02.jpg';
$arrHeaderImages['guestbook'] = 'startpage03.jpg';
$arrHeaderImages['newsmanager'] = 'startpage04.jpg';
$arrHeaderImages['download'] = 'startpage01.jpg';
$arrHeaderImages['products'] = 'startpage02.jpg';
$arrHeaderImages['imagegallery'] = 'startpage03.jpg';
$arrHeaderImages['register'] = 'startpage04.jpg';
$arrHeaderImages['profile'] = 'startpage01.jpg';

//$arrHeaderImages['18e2a'] = 'startpage01.jpg';

$arrHeaderImages['defaultimage'] = 'startpage02.jpg'; // <-- This image is displayed on all other pages.

?>
<head>
<title><?php
	echo _SITE_TITLE.' | ';
	include(_SITETITLE);
?></title>
<?php echo _SITE_META_DATA; ?>
<link href="<?php echo $skinPath; ?>css.css" rel="stylesheet" type="text/css" />
</head>


<body>

<div id="page">
	<div id="header">
		<div class="searchmenu"><?php include(_SEARCH); include(_LANG_SELECTOR); ?></div>
	</div>
	
	<div id="logo">
		<h1 class="title"><?php echo _SITE_LOGO; echo _SITE_NAME; ?></h1>
		<div class="description"><span class="subtitle"><? echo _SITE_KEY; ?></span></div>
	</div>
 	
	<div class="menu">
		<?php include(_TOP_MENU); ?>
	</div><?php
	
	/*
		This is the header image
	*/
	if($useRandomImages == 1) {
		if($id == 'frontpage') {
			?>
			<div id="hrule">
				<div class="pathway" style="border-bottom: 1px solid #fff; margin: 0; padding: 0 0 0 25px;">
					&raquo;&nbsp;
					<? include(_PATHWAY); ?>
				</div>
				
				<script language="JavaScript">
				var theImages = new Array();
				
				theImages[0] = '<? echo $skinPath; ?>startpage01.jpg';
				theImages[1] = '<? echo $skinPath; ?>startpage02.jpg';
				theImages[2] = '<? echo $skinPath; ?>startpage03.jpg';
				theImages[3] = '<? echo $skinPath; ?>startpage04.jpg';
				
				var j = 0
				var p = theImages.length;
				var preBuffer = new Array()
				
				for (i = 0; i < p; i++){
					preBuffer[i] = new Image();
					preBuffer[i].src = theImages[i];
				}
				
				var whichImage = Math.round(Math.random()*(p-1));
				
				function showImage(){
					document.write('<img border="0" alt="Startpage" src="' + theImages[whichImage] + '" />');
				}
				
				showImage();
				</script>
			</div>
			<?
		}
		else {
			?>
			<div id="hruleContent">
				<div class="pathway" style="border-bottom: 1px solid #fff; margin: 0; padding: 0 0 0 35px;">
					&raquo;&nbsp;
					<? include(_PATHWAY); ?>
				</div>
			</div>
			<?php
		}
	}
	else {
		?>
		<div id="hrule">
			<div class="pathway" style="border-bottom: 1px solid #fff; margin: 0; padding: 0 0 0 25px;">
				&raquo;&nbsp;
				<? include(_PATHWAY); ?>
			</div>
			<?php
			switch($id) {
				case 'frontpage':
					echo '<img border="0" alt="Startpage" src="'.$skinPath.$arrHeaderImages[$id].'" />';
					break;
				
				case 'contactform':
					echo '<img border="0" alt="Startpage" src="'.$skinPath.$arrHeaderImages[$id].'" />';
					break;
				
				case 'guestbook':
					echo '<img border="0" alt="Startpage" src="'.$skinPath.$arrHeaderImages[$id].'" />';
					break;
				
				case 'newsmanager':
					echo '<img border="0" alt="Startpage" src="'.$skinPath.$arrHeaderImages[$id].'" />';
					break;
				
				case 'download':
					echo '<img border="0" alt="Startpage" src="'.$skinPath.$arrHeaderImages[$id].'" />';
					break;
				
				case 'products':
					echo '<img border="0" alt="Startpage" src="'.$skinPath.$arrHeaderImages[$id].'" />';
					break;
				
				case 'imagegallery':
					echo '<img border="0" alt="Startpage" src="'.$skinPath.$arrHeaderImages[$id].'" />';
					break;
				
				case 'register':
					echo '<img border="0" alt="Startpage" src="'.$skinPath.$arrHeaderImages[$id].'" />';
					break;
				
				case 'profile':
					echo '<img border="0" alt="Startpage" src="'.$skinPath.$arrHeaderImages[$id].'" />';
					break;
				
				default:
					if(file_exists('theme/biz/'.$skinData.$arrHeaderImages[$id])) {
						echo '<img border="0" alt="'.$id.'" src="'.$skinPath.$arrHeaderImages[$id].'" />';
					}
					else {
						echo '<img border="0" alt="Startpage" src="'.$skinPath.$arrHeaderImages['defaultimage'].'" />';	
					}
					break;
			}
			?>
		</div>
		<?php
	}
	?>
	
	<div id="mainpage">
		<div class="mainText">
			<div class="item">
				<br />
				<?php include(_CONTENT); ?>
			</div>
			
			<div class="clear">
				<br />
				<?php include(_CONTENT_FOOTER); ?>
			</div>
		</div>
		
	 	<div class="sidebar">
	 		<?php
	 		if($useRandomImages == 1) {
				if($id != 'frontpage'){
					?>
					<div class="sidebarimage01">
						<script language="JavaScript">
						var theImages = new Array();
						
						theImages[0] = '<? echo $skinPath; ?>siteimage01.jpg';
						theImages[1] = '<? echo $skinPath; ?>siteimage02.jpg';
						
						var j = 0
						var p = theImages.length;
						var preBuffer = new Array()
						
						for (i = 0; i < p; i++){
							preBuffer[i] = new Image();
							preBuffer[i].src = theImages[i];
						}
						
						var whichImage = Math.round(Math.random()*(p-1));
						
						function showImage(){
							document.write('<img border="0" alt="Sidebar" src="' + theImages[whichImage] + '" />');
						}
						
						showImage();
						</script>
					</div>
					<?php
				}
				else{
					?>
					<br />
					<?php
				}
	 		}
	 		else {
	 			?>
				<br />
				<?php
	 		}
			
	 		include(_SIDE_MENU);
	 		include(_FRONT_NEWS);
			include(_CATEGORIES);
			include(_MONTHVIEW);
			include(_SIDE);
			include(_SIDE_LINKS);
			include(_LAST_IMAGES);
			include(_NEWSLETTER);
			include(_LOGIN);
			include(_POLL);
			include(_SHOW_LC);
			include(_CS);
			include(_SYNDICATION);
			?>
		</div>
		
		<div class="clear"><?php
			//include(_CONTENT_FOOTER);
		?></div>
	</div>
	
	<hr />
	
	<div id="footerline">&nbsp;</div>
	
	<div id="footer">
		<div style="padding-left: 14px;"><?php include(_FOOTER); ?></div>
	</div>
</div>

</body>

</html>
