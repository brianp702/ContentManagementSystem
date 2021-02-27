<?php if (empty($domain)){$domain = $_SERVER['SERVER_NAME'];} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script type="text/javascript" src="../jscripts/jquery-1.4.2.min.js"></script>
<script>
$(document).ready(function() {
	//$("#message").hide();
	$("#message").delay(3000).fadeTo("slow",0);
});
</script>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>health</title>
<meta name="keywords" content="health, fitness, intermittent fasting, longevity" />
<meta name="description" content="Unbiased articles on health, fitness, diet, and longevity." />
<link href="admin.css" rel="stylesheet" type="text/css" />
<link rel="SHORTCUT ICON" href="../favicon.ico"/>
</head>
<body OnLoad="document.nameform.username.focus();">
<a href="todo.php"><img src="../images/pixel.gif" style="border: none; cursor: default;"></a>
<div class="nav">
	<a href="<?domain?>/health/admin/admin.php"><img style="border: none" src="../images/sprout.gif"></a>
	<div class="logout">
		<a href="admin.php">Articles</a> 
		|
		<a href="<?domain?>/health/">Main site</a> 
		| 
		<a href="logout.php">Log Out</a>
	</div>	
</div>