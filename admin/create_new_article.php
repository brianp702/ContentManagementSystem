<?php
include '../include/functions.php';
authorize();
$domain = $_SERVER['SERVER_NAME'];

if(get_magic_quotes_gpc()) {
	$article = mysql_real_escape_string(stripslashes($_POST['article']));
	$title = mysql_real_escape_string(stripslashes($_POST['title']));
	$description = mysql_real_escape_string(stripslashes($_POST['description']));
	$meta_tags = mysql_real_escape_string(stripslashes($_POST['meta_tags']));
}
else {
	$article = mysql_real_escape_string($_POST['article']);	
	$title = mysql_real_escape_string($_POST['title']);
	$description = mysql_real_escape_string($_POST['description']);
	$meta_tags = mysql_real_escape_string($_POST['meta_tags']);
}
$date = mysql_real_escape_string(strip_tags($_POST['date']));
$delete = mysql_real_escape_string(strip_tags($_POST['delete']));

$image_url = $_POST['image_url'];

if (empty($image_url)){
	$image_url = "grapes.jpg";
}

// put in db
mysql_query("
	insert into articles (
		title
		,date
		,image_url
		,article
		,meta_tags
		,description
	) 
	values (
		'$title'
		,'$date'
		,'$image_url'
		,'$article'
		,'$meta_tags'
		,'$description'
	)
	");
echo mysql_error();

// return to admin page
header("Location: http://$domain/health/admin/admin.php?status=new_article");
exit;
?>
