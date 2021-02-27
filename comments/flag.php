<?
/*
include '../include/connect.php';
db_connect();

$comment_id = $_GET['comment_id'];
$censored = "[Comment flagged as inappropriate. Will be reviewed by admin.]";
$article_id = $_GET['article_id'];

$result = mysql_query("select comment from comments where comment_id='$comment_id'");
	while($row = mysql_fetch_array($result)){
		$comment = $row['comment'];
		$censored_mail = $comment;
		mysql_query("update comments set comment='$censored' where comment_id='$comment_id'");
		mysql_error();
		mysql_query("update comments set censored='$comment' where comment_id='$comment_id'");
		mysql_error();
		
		//notify me of the flagging via email
		$to = 'jiggapayne2@hotmail.com';
		$from = 'neo-conception';
		$body = 'Comment ID:'.$comment_id.' Censored: '.$censored_mail.' Article ID: '.$article_id;
		$headers = "From: $from";
		mail($to,$from,$body,$headers);
			
	}
	header("Location: http://neo.brianpayne.us/articles.php?id=".$article_id."&comment_id=".$comment_id."&flag=yes#comment".$comment_id);
?>