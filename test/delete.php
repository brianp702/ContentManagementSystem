<?php
session_start();
///////////////////////////////////////////
if($_SESSION['user_type']!='admin'){
	header("Location: http://neo-conception.org/test/");
}
//////////////////////////////////////////
include 'connect.php';
db_connect();


$id = $_GET['id'];
if ($id)
{
	mysql_query("delete from exam where id='$id'");	
	echo mysql_error();
	header("Location: http://neo-conception.org/test/view.php");
	exit;
}

?>