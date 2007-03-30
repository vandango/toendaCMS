<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?

$skinPath = $templatePath.'data/';

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

<!--HEADER-->
<div id="header">
	<div id="topposition">
		<? echo _SITE_LOGO; ?>
		<div class="title"><? echo _SITE_NAME; ?></div>
		<br />
		<div class="subtitle"><? echo _SITE_KEY; ?></div>
	</div>
	
	<div id="navigation"><? include(_TOP_MENU); ?></div>
	<div id="fontcontrol"><? include(_SEARCH); ?></div>
</div>









<table cellpadding="0" cellspacing="0" border="1" id="wrapper" height="100%">
<tr><td height="100%" valign="top">
	<?
	
	echo '<div style="padding: 5px 0 0 18px;" class="pathway">&raquo; ';
	include(_PATHWAY);
	echo '</div>';
	
	?>
	<table cellpadding="0" cellspacing="0" border="1" class="contentdiv" height="100%">
	<tr><td height="100%" valign="top">
		<?
		
		include(_CONTENT);
		
		?>
	</td></tr>
	</table>
	
	<table cellpadding="0" cellspacing="0" border="1" class="sidebar" height="100%">
	<tr><td height="100%" valign="top">
		<div class="sidebarbody side">
			<h3>Menu</h3>
			
			<div class="searchform"><?
				
				//====================================
				//	_SIDE_MENU
				//
				include(_SIDE_MENU);
				
				
				//====================================
				//	_LOGIN
				//
				include(_LOGIN);
				
				
				//====================================
				//	_CS
				//
				include(_CS);
				
				
				if($id != 'products'){
					//====================================
					//  _CATEGORIES
					//
					include(_CATEGORIES);
					
					
					//====================================
					//	_SHOW_LC
					//
					include(_SHOW_LC);
					
					
					//====================================
					//	_NEWSLETTER
					//
					include(_NEWSLETTER);
					
					
					//====================================
					//	_POLL
					//
					include(_POLL);
				}
				
				
				if($id == 'products' || $id == 'contactform' || file_exists('data/tcms_sidebar/'.$id.'.xml')){
					//====================================
					//	_SIDE
					//
					include(_SIDE);
				}
				
				
				if($id == 'products'){
					//====================================
					//	_SHOW_LC
					//
					include(_SHOW_LC);
					
					
					//====================================
					//	_NEWSLETTER
					//
					include(_NEWSLETTER);
					
					
					//====================================
					//	_POLL
					//
					include(_POLL);
				}
				
			?></div>
		</div>
	</td></tr>
	</table>
	
	<div class="clearing" style="padding-left: 15px; padding-bottom: 15px;"><?
	
	//====================================
	//	_CONTENT_FOOTER
	//
	include(_CONTENT_FOOTER);
	
	?></div>
	<br />
</td></tr>
</table>


<!--FOOTER-->
<div id="footer">
	<div class="legal" align="center"><?
	
	//====================================
	//	_FOOTER
	//
	include(_FOOTER);
	
	?></div>
</div>

</body>

</html>
