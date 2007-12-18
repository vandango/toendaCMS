<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; <? echo $charset; ?>" />
<meta name="robots" content="noindex, nofollow">
<style>

body {
	font-size: 11px;
	font-family: 'Lucida Grande', Verdana, Arial, Sans-Serif;
	color: #444;
	margin: 0;
	padding: 10px 10px 10px 10px;
}

img {
	padding: 5px 5px 5px 5px;
}

.printHead {
	border-bottom: 1px solid black;
	padding-bottom: 10px;
	margin-bottom: 20px;
}

.contentheading {
	font-size: 15px;
	font-weight: bold;
}

.contentstamp {
	font-size: 13px;
}

.contentmain {
	font-size: 11px;
}

</style>
</head>

<body>

<div class="printHead">
<a href="javascript:window.print();">
<img alt="<? echo _TCMS_PRINT_NOW; ?>" title="<? echo _TCMS_PRINT_NOW; ?>" style="padding-top: 2px;" src="engine/images/print.gif" border="0" />
</a>
</div>

<div class="contentheading"><? echo $title; ?></div>
<br />
<span class="contentstamp"><? echo $key; ?></span>

<p class="contentmain">
<br />
<? echo $content00; ?><br />
<? echo $content01; ?><br />
<? echo $foot; ?><br />
</p>

</body>

</html>
