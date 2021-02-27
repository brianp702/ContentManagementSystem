<?php
session_start();

if($_SESSION['user_type']=='admin'){
	unset($_SESSION['user_type']);
	session_destroy();
}
header("Location: http://neo-conception.org/test/");
?>