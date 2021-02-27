<?php

require 'connect.php';

$timeout=0;

if(!isset($_POST['submit']))
{	
	header('Location: http://neo-conception.org/test/');
	exit;	
}	
else{
	
	db_connect();		
	$username = mysql_real_escape_string(strtolower($_POST['username']));
	$password = mysql_real_escape_string($_POST['password']);	
	$query = mysql_query("SELECT is_root FROM adminUser WHERE username='$username' and password=password('$password')");		
	$row = mysql_fetch_array($query); //root status of the username
	
	if (!$row){	
		header('Location: http://neo-conception.org/test');
		exit;
	}
	
	$is_root = $row['is_root'];
	
	if($is_root=='1'){	
		session_start();
		$_SESSION['user_type']='admin';
		header('Location: http://neo-conception.org/test/form.php');
		exit;	
	}		
}	
?>