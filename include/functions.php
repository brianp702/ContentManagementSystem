<?php
function login(){
	require '../include/connect.php';
	if (empty($domain)){$domain = $_SERVER['SERVER_NAME'];}
	$timeout=0;
	
	db_connect();		
	$username = mysql_real_escape_string(strtolower($_POST['username']));
	$password = mysql_real_escape_string($_POST['password']);	
	$query = mysql_query("
		SELECT
			is_root 
			,username
			,password
		FROM adminUser 
		WHERE username='$username' 
		and password ='$password'
	");		
	$row = mysql_fetch_array($query); //root status of the username
	
	if (!$row){	
		header("Location: http://$domain/health/admin/index.php?status=failure");
		die();
	}
	
	$is_admin = $row['is_root'];
	
	$status = "failure";
	
	if($is_admin=='1'){	
		session_start();
		$_SESSION['user_type']='admin';
		$status = "admin";
	}
	elseif($is_admin=='0'){	
		session_start();
		$_SESSION['user_type']='guest';
		$status = "guest";			
	}
	header("Location: http://$domain/health/admin/admin.php?status=$status");
	die();		

}

function authorize(){
		
	session_start();
	
	if (empty($domain)){$domain = $_SERVER['SERVER_NAME'];}
	/*
	if($_SESSION['user_type']=='admin'){
		require '../include/connect.php';
		db_connect();
	}
	else {		
		header("Location: http://$domain/health/admin");
		die();
	}
	*/
	
	//for guest login
	if($_SESSION['user_type']=='guest'){
		$is_admin = 0;	
		require '../include/connect.php';
		db_connect();
	}
	elseif($_SESSION['user_type']=='admin'){
		$is_admin = 1;
		require '../include/connect.php';
		db_connect();		
	}
	else {		
		header("Location: http://$domain/health/admin");
		die();	
	}		
}

function logout(){
	session_start();

	if($_SESSION['user_type']=='admin'){
		unset($_SESSION['user_type']);
		session_destroy();
	}
	$domain = $_SERVER['SERVER_NAME'];
	header("Location: http://$domain/health/admin/index.php?status=logout");
	die();
}

function list_articles(){
	require_once 'connect.php';
	db_connect();
	
	$domain = $_SERVER['SERVER_NAME'];
	
	$result = mysql_query("
		SELECT 
			title
			,article_id 
		FROM articles 
		WHERE is_active = '1'
		AND is_hidden = '0'
		ORDER by article_id
	");
	
	while($row = mysql_fetch_array($result))
	{
		$title = $row['title'];
		$article_id = $row['article_id'];
		echo "<li><a href='./articles.php?id=";
		echo $article_id;
		echo "'>";
		echo $title;
		echo "</a></li>\n";
	}	
}

?>