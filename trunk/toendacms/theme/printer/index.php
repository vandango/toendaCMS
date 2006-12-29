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

<h1><? echo _SITE_NAME; ?></h1>
<br />
<h3><? echo _SITE_KEY; ?></h3>

<br />
<br />
<br />

<?

echo '<div class="pathway" align="left">Print: ';
include(_PATHWAY);
echo '</div>';

?>

<hr />
<br />

<div class="contentdiv">
	<? include(_CONTENT); ?>
</div>

<script language="JavaScript">
window.print();
</script>

</body>
</html>
