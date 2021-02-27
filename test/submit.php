<?php
session_start();
///////////////////////////////////////////
if($_SESSION['user_type']!='admin'){
	header("Location: http://neo-conception.org/test/");
}
//////////////////////////////////////////
include 'connect.php';
db_connect();

// handle the magic quotes and get the $_POST variables
if(get_magic_quotes_gpc()) {
	$firstname = mysql_real_escape_string(strip_tags(stripslashes($_POST["firstname"])));
	$lastname = mysql_real_escape_string(strip_tags(stripslashes($_POST["lastname"])));
	$email = mysql_real_escape_string(strip_tags(stripslashes($_POST["email"])));
	$phone = mysql_real_escape_string(strip_tags(stripslashes($_POST["phone"])));
}
else {
	$firstname = mysql_real_escape_string(strip_tags($_POST["firstname"]));
	$lastname = mysql_real_escape_string(strip_tags($_POST["lastname"]));
	$email = mysql_real_escape_string(strip_tags($_POST["email"]));
	$phone = mysql_real_escape_string(strip_tags($_POST["phone"]));
}

// submit to database
if($firstname && $lastname && $email && $phone)
{
	mysql_query("insert into exam values('$firstname','$lastname','$email','$phone', 'NULL')");	
	echo mysql_error();
	header("Location: http://neo-conception.org/test/view.php");
	exit;
}
else
{		
	echo "you skipped a field, <a href='form.php'>try again</a>";
}
?>