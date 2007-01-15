<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?

$skinPath = $templatePath.'src/';

?>
<head>
<title><?
	echo _SITE_TITLE.' | ';
	include(_SITETITLE);
?></title>
<? echo _SITE_META_DATA; ?>
<link href="<? echo $skinPath; ?>css.css" rel="stylesheet" type="text/css" />
</head>


<body>

<div id="page">
	<div id="header">
		<div class="searchmenu"><? include(_SEARCH); include(_LANG_SELECTOR); ?></div>
	</div>
	
	<div id="logo">
		<h1 class="title"><? echo _SITE_NAME; ?></h1>
		<div class="description"><span class="subtitle"><? echo _SITE_KEY; ?></span></div>
	</div>
 	
	<div class="menu">
		<? include(_TOP_MENU); ?>
	</div><?
	
	if($id == 'frontpage'){
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
	else{
		?>
		<div id="hruleContent">
			<div class="pathway" style="border-bottom: 1px solid #fff; margin: 0; padding: 0 0 0 35px;">
				&raquo;&nbsp;
				<? include(_PATHWAY); ?>
			</div>
		</div>
		<?
	}
	?>
	
	<div id="mainpage">
		<div class="mainText">
			<div class="item">
				<br />
				<? include(_CONTENT); ?>
			</div>
			
			<div class="clear">
				<br />
				<? include(_CONTENT_FOOTER); ?>
			</div>
		</div>
		
	 	<div class="sidebar">
	 		<?
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
				<?
			}
			else{
				?>
				<br />
				<?
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
		
		<div class="clear"><?
			//include(_CONTENT_FOOTER);
		?></div>
	</div>
	
	<hr />
	
	<div id="footerline">&nbsp;</div>
	
	<div id="footer">
		<div style="padding-left: 14px;"><? include(_FOOTER); ?></div>
	</div>
</div>

</body>

</html>
