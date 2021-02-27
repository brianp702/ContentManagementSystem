<?php
include '../include/connect.php';
db_connect();

$domain = "http://".$_SERVER['HTTP_HOST'];
$date = date('M j, Y g:ia');


// handle the magic quotes and get the $_POST variables
if(get_magic_quotes_gpc()) {
	$username = mysql_real_escape_string(strip_tags(stripslashes($_POST["username"])));
	$website = mysql_real_escape_string(strip_tags(stripslashes($_POST["website"])));
	$comment = mysql_real_escape_string(strip_tags(stripslashes($_POST["comment"])));
	$article_id = mysql_real_escape_string(strip_tags(stripslashes($_POST["article_id"])));
	$_POST['captcha_code'] = mysql_real_escape_string(strip_tags(stripslashes($_POST['captcha_code'])));
}
else {
	$username = mysql_real_escape_string(strip_tags($_POST["username"]));
	$website = mysql_real_escape_string(strip_tags($_POST["website"]));
	$comment = mysql_real_escape_string(strip_tags($_POST["comment"]));
	$article_id = mysql_real_escape_string(strip_tags($_POST["article_id"]));
	$_POST['captcha_code'] = mysql_real_escape_string(strip_tags($_POST['captcha_code']));
}

//check input
session_start(); 

include_once '../securimage/securimage.php';

$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {	
	header("Location: $domain/health/articles.php?id=".$article_id."&msg=captcha#form");
	die();
}
$article_id = intval($article_id);
// submit to database
if($username && $comment && !$website)
{
	mysql_query("
		INSERT INTO comments (
			article_id
			,website
			,username
			,comment
			,date
			)
		VALUES(
			'$article_id'
			,'NULL'
			,'$username'
			,'$comment'
			,'$date'
			)
			");	
}
else if ($username && $comment && $website)
{
	if(!preg_match("/http:\/\//", $website)) {
        $website = "http://" . $website;
    }
		mysql_query("
		INSERT INTO comments (
			article_id
			,username
			,website
			,comment
			,date
			)
		VALUES(
			'$article_id'
			,'$username'
			,'$website'
			,'$comment'
			,'$date'
			)
			");		
}
else {
	header("Location: $domain/health/articles.php?id=".$article_id."&msg=skipped#form");
	die();
}

header("Location: $domain/health/articles.php?id=".$article_id."#comment".mysql_insert_id());
die();
?>