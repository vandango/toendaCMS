<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<title><? echo $sitetitle; ?></title>
<link rel="shortcut icon" href="img/favicon.png" />
<link rel="stylesheet" type="text/css" href="theme/redsolution/data/css.css" />
<meta name="generator" content="<? echo $cms_name; ?> - Copyright 2003 - 2004 Toenda Software Company.  All rights reserved." />
<meta name="description" content="<? echo $description; ?>" />
<meta name="keywords" content="<? echo $keywords; ?>" />
<meta name="author" content="<? echo $websiteowner; ?>" />
</head><?

$footer_xml = new xmlparser('data/tcms_global/footer.xml','r');
$owner_url=$footer_xml->read_section('footer', 'owner_url');

?><body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<br />

<table align="center" bgcolor="#93a19b" border="0" cellpadding="0" cellspacing="0" width="800" class="tb_body">
<tr><td valign="top">

	<table align="center" border="0" cellpadding="0" cellspacing="0" width="800">
	<tr><td>
		<img src="theme/redsolution/data/_balken.gif" alt="" height="20" width="800">
	</td></tr>

	<tr><td bgcolor="#ffffff">

		<table border="0" cellpadding="0" cellspacing="0" width="800">
		<tr><td bgcolor="#93a19b" width="200">

			<span class="title">
			<strong><?php echo _SITE_NAME; ?></strong>
			</span>
			<br />

		</td><td valign="middle">

			<span class="subtitle">
			<strong><?php echo _SITE_KEY; ?></strong>
			</span>

		</td><td rowspan="3" bgcolor="#cfd6d5" valign="top" width="80">
			<a class="legal" href="<? echo $owner_url; ?>"><img src="theme/redsolution/data/_logo.png" alt="Startseite" border="0" height="60" width="80"></a>
		</td></tr>
		<tr><td rowspan="2" bgcolor="#cfd6d5">
			<img src="theme/redsolution/data/_anim.jpg" height="50" width="200" border="0" />
		</td></tr>

		<tr><td bgcolor="#cfd6d5" valign="bottom">

			<table border="0" cellpadding="0" cellspacing="0">
			<tr><td><?
				
				//====================================
				//	_PATHWAY
				//
				include(_PATHWAY);
				
			?></td></tr>
			</table>

		</td></tr>
		</table>

	</td></tr>

	<tr><td bgcolor="#ffffff">

		<table border="0" cellpadding="0" cellspacing="0" width="800">
		<tr><td rowspan="2" bgcolor="#ffffff" valign="top" width="100">

			<br />
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr valign="top"><td width="100"><?
				
				//====================================
				//	_SIDE_MENU
				//
				include(_SIDE_MENU);
				
				//====================================
				//	_CATEGORIES
				//
				include(_CATEGORIES);
				
			?></tr></td>
			</table>

		</td><td bgcolor="#f5f5f5" valign="top"><?

			/*if(!isset($id))     { $id=0; }
			if(!isset($ttt_img)){ $ttt_img = '_top_00.png'; }
			switch($id){
				case 1: $ttt_img = '_top_01.png'; break;
				case 3: $ttt_img = '_top_03.png'; break;
				case 5: $ttt_img = '_top_05.png'; break;
			}*/
			
			$ttt_img = '_top_01.png';
			
			?><img src="theme/redsolution/top_banner/<? echo $ttt_img; ?>" width="550" border="0" />
			
			<table border="0" cellpadding="0" cellspacing="0" height="280" width="100%">
			<tr><td valign="top" style="padding: 5px;"><?
				
				//====================================
				//	_CONTENT
				//
				include(_CONTENT);
				
				?><br />
				<br />

			</td></tr>
			</table><?
			
			//====================================
			//	_CONTENT_FOOTER
			//
			include(_CONTENT_FOOTER);
			
		?></td><td rowspan="2" bgcolor="#ffffff" valign="top" width="150">
			<br />
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr valign="top"><td width="150"><?
				
				//====================================
				//	_NEWSLETTER
				//
				include(_LOGIN);
				
				//====================================
				//	_CS
				//
				include(_CS);	
				
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
				
				//====================================
				//	_SIDE
				//
				include(_SIDE);	
				
			?></tr></td>
			</table>

		</td></tr>
		</table>

	</td></tr>
	</table>

</td></tr>
<tr><td>
</td></tr>

<tr><td bgcolor="#ffffff" background="theme/redsolution/data/_balken.gif">
	&nbsp;
</td></tr>
</table>

<br />

<table cellpadding="0" cellspacing="0" border="0" align="center" width="800">
<tr><td><?

	//====================================
	//	_FOOTER
	//
	include(_FOOTER);
	
?></td></tr>
</table>

<br />

</body>
</html>