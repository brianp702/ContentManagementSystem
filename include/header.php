<?php
require 'include/connect.php';
db_connect();

$article_id = intval($_GET['id']);

$result = mysql_query("select title, meta_tags, description from articles where article_id='$article_id'");
while($row = mysql_fetch_array($result))
{
	$title = stripslashes($row['title']);
	$meta_tags = stripslashes($row['meta_tags']);
	$description = stripslashes($row['description']);
}
?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script type="text/javascript" src="jscripts/jquery-1.4.2.min.js"></script>
<script>
$(document).ready(function() {
 $("#message").delay(3000).fadeTo("slow", 0);
});
</script>	
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?if (isset($title)) {$title;}?></title>
<meta name="keywords" content="<? echo $meta_tags; ?>" />
<meta name="description" content="<? echo $description; ?>" />
<link href="default.css" rel="stylesheet" type="text/css" />
<link rel="SHORTCUT ICON" href="favicon.ico"/>
</head>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-4469127-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>

<body>
<?php 
	/*
 <a href="admin/admin.php"><img src="images/pixel.gif" style="border: none; cursor: default;"></a>
	*/	
?>
