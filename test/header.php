<?php

require 'connect.php';
db_connect();

$result = mysql_query("select * from tdk");
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
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>PHP Exam -- <? echo $title; ?></title>
<meta name="keywords" content="<? echo $meta_tags; ?>" />
<meta name="description" content="<? echo $description; ?>" />
<link href="http://neo-conception.org/test/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="content">
<div class="post">
<a href="view.php">view</a>
<a href="form.php">form</a>
<a href="logout.php">log out</a>

<hr />
<br />