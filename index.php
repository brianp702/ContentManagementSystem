<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script type="text/javascript" src="jscripts/jquery-1.4.2.min.js"></script>		
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Welcome to <?echo $_SERVER['SERVER_NAME']; echo $_SERVER['PHP_DIR']?></title>
<meta name="keywords" content="health,diet,longevity,diseases" />
<meta name="description" content="Unbiased articles on health, fitness and longevity" />
<link href="default.css" rel="stylesheet" type="text/css" />
<link rel="SHORTCUT ICON" href="favicon.ico"/>
</head>

<body>
<a href="admin/admin.php"><img src="images/pixel.gif" style="border: none; cursor: default;"></a>
	
<!-- CONTENT ****************************-->
<div class="content">	
	<div class="post">
	<br />
	</div>	
	<div class="post">
		<img src="images/pod.jpg" alt="image" border="1" />
	</div>	
	<div class="post">		
		
		<h4 style='color: #0000FF'>Welcome to <?echo $_SERVER['SERVER_NAME']; echo $_SERVER['PHP_DIR']?></h4> 
		
		<p>
		I focus mainly on health, fitness, and financial peace. Below is a random article to get you started.
		</p>	
	</div>	
</div>



<?php
require 'include/connect.php';
db_connect();

//display random article

$result = mysql_query("
	SELECT
		article_id
		,title
		,date
		,image_url
		,article
		,meta_tags
		,description		 
	FROM articles 
	WHERE is_active = '1'
	ORDER BY RAND() 
	LIMIT 1
");
	
while($row = mysql_fetch_array($result)){
	$article_id = $row['article_id'];
	$image_url = $row['image_url'];
	$article = stripslashes($row['article']);
			
//<-- content -->
	echo "<div class='content'><div class='post'>
	<br />
	</div>	";
	echo "<div class='post'>";
	echo "<img src='images/".$image_url."' alt='image' border='1' />";
	echo "</div>";	
	echo "<div class='post'>";		
	echo "
		<h4 style='color: #0000FF'>".$row['title']."</h4>
		<div class='posted'>
			<p>".$row['date']."</p>
		</div>".			
		$article
		."</div>"
		;
}
?>

<div class="content">
	<div class="post">
		<a name="comments"></a>
		<h1 style="color: #0000FF">Comments</h1>		
		To make a comment, <a href="articles.php?id=<? echo $article_id;?>#comments">visit this article's page.</a>
	</div>
</div>		

<?
include 'include/footer.php';
?>	