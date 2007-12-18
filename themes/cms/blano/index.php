<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?

$skin_path = $templatePath.'data/';

?>
<head>
<title><?
	echo _SITE_TITLE.' | ';
	include(_SITETITLE);
?></title>
<? echo _SITE_META_DATA; ?>
<script type="text/javascript" language="JavaScript">
var name = navigator.userAgent.toLowerCase()
var css = 'moz';

var ie = (name.indexOf("msie")>-1 && name.indexOf("opera") == -1)
var netscape = (name.indexOf("mozilla") >=-1 && name.indexOf("msie")==-1)

if(ie) css = 'ie';
else css = 'moz';

document.write ('<link href="<? echo $skin_path; ?>nano_' + css + '.css" rel="stylesheet" type="text/css" />');
</script>
</head>

<body>

<div id="top">top</div>

<div id="page">
	<div class="header">
		<div class="header_left">
			<?
			echo $sitelogo;
			echo '<span class="title">'._SITE_NAME.'</span>';
			echo '<br />';
			echo '<span class="subtitle">'._SITE_KEY.'</span>';
			?>
		</div>
		
		<div class="header_right"><?
			
			//====================================
			//	_SEARCH
			//
			include(_LANG_SELECTOR);
			
					
			
			
			?>
		</div>
	</div>
	
	
	
	<div class="topmenu"><?
		
		//====================================
		//	_PATHWAY
		//
		include(_TOP_MENU);
		
	?></div>
	
	
	
	<div class="pagepathway pathway">URL | <?
		
		//====================================
		//	_PATHWAY
		//
		include(_PATHWAY);
		
	?></div><?
		
		//====================================
		// MAINPAGE IMAGE
		//
		if($id == 'frontpage'){
			echo '<div class="pageimagebig"><img src="'.$skin_path.'nano_bigimage.jpg" border="0" /></div>';
		}
		else{
			echo '<div class="pageimage"><img src="'.$skin_path.'nano_smallimage.jpg" border="0" /></div>';
		}
		
		
	?><div class="pagecontent">
		<div class="sidemenu">
			<ul>
				<li><? include(_SIDE_MENU); ?></li>
				<li><? include(_CATEGORIES); ?></li>
				<li><? include(_SIDE_LINKS); ?></li>
				<li><? include(_POLL); ?></li>
				<li><? include(_SHOW_LC); ?></li>
				<li><? include(_NEWSLETTER); ?></li>
			</ul>
		</div>
		
		<div class="mainpage"><?
			
			//====================================
			//	_PATHWAY
			//
			include(_CONTENT);
			
		?></div>
		
		<div class="sidebar">
			<ul><?
				
				if($choosenDB == 'xml'){
					if(file_exists('data/tcms_sidebar/'.$id.'.xml')){ $show_sbt_ever = true; }
					else{ $show_sbt_ever = false; }
				}
				else{
					$sqlAL = new sqlAbstractionLayer($choosenDB);
					$sqlCN = $sqlAL->sqlConnect($sqlUser, $sqlPass, $sqlHost, $sqlDB, $sqlPort);
					$sqlQR = $sqlAL->sqlGetAll("tcms_sidebar WHERE uid='".$id."'");
					$sqlNR = $sqlAL->sqlGetNumber($sqlQR);
					if($sqlNR != 0){ $show_sbt_ever = true; }
					else{ $show_sbt_ever = false; }
				}
				
				if($show_sbt_ever == true){
					echo '<li>';
					include(_SEARCH);
					include(_SIDE);
					echo '</li>';
				}
				
				?><li><? include(_LOGIN); ?></li>
			</ul>
		</div>
	</div><?
	
	//====================================
	//	_CONTENT_FOOTER
	//
	include(_CONTENT_FOOTER);
	
	?><div class="pageend"></div>
	
	
	
	<div class="pagefooter"><?
		
		//====================================
		//	_CONTENT_FOOTER
		//
		include(_FOOTER);
		
	?></div>
</div>

<div id="bottom">bottom</div>

</body>

</html>
