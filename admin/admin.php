<?php
include '../include/functions.php';
authorize();

include 'header_admin.php';
	
$article_id = $_GET['article_id'];

// delete the article
if ($_GET['action']=='delete') { 
	mysql_query("
		UPDATE articles
		SET is_active = '0'
		WHERE article_id ='$article_id'
		");
	echo mysql_error();
	echo "<center><div id='message' style='color: blue; background: #FFF1A8; padding: 10px;'><strong>Article was deactivated</strong></div></center>";		
}
// undelete the article
elseif ($_GET['action']=='undelete') {
	mysql_query("
		UPDATE articles 
		SET is_active = '1'
		WHERE article_id ='$article_id'
	");
	echo mysql_error();
	echo "<center><div id='message' style='color: blue; background: #FFF1A8; padding: 10px;'><strong>Article was restored.  </strong></div></center>";		
}	
?>
<script type="text/javascript">  
	$(document).ready(function(){
	  // Zebra stripe tables
	  $("table.striped tr:odd").addClass("odd");
	  $("table.striped tr:even").addClass("even");
	});
</script>
<?php
// get articles
if ($_SESSION['user_type']!='guest') {
	$result = mysql_query("
	SELECT 
		title
		,articles.article_id
		,articles.is_active
		,comments.comment
	FROM articles
	LEFT JOIN comments ON comments.article_id = articles.article_id
	GROUP by articles.article_id
	ORDER by title ASC
	");
} else {	
	$result = mysql_query("
		SELECT 
			title
			,articles.article_id
			,articles.is_active
			,comments.comment
		FROM articles
		LEFT JOIN comments ON comments.article_id = articles.article_id
		WHERE articles.is_hidden <> 1
		GROUP by articles.article_id
		ORDER by title ASC
		");	
}

?>

<div class="content">
	<p style="font-size: 18pt;"><em>Articles</em></p>
<?
echo "<a href='new_article.php'><strong style='font-weight: 900'>New article</strong></a>";
?>
<br><br>
	<table class="striped" cellpadding="5px">
		<tr style="background: #3C9DD0; color:white;">
			<td align="center">Title</td>
			<td colspan="4" align="center">Actions</td>
		</tr>	
<?
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$title = stripslashes($row['title']);
		$comment = stripslashes($row['comments.comment']);
		$article_is_active = stripslashes($row['articles.is_active']);
		$article_id = stripslashes($row['article_id']);		
?>			
			<tr<?if($row['is_active']=='0')echo" style='color: #9D9D9D;'";?>>

				<td><strong><? echo $title; ?></strong>&nbsp &nbsp</td>
				<td><a href='edit_articles.php?id=<? echo $article_id; ?>'>edit</a></td>
				<td><a href='<?$domain?>/health/articles.php?id=<? echo $article_id; ?>'>view</a></td>
				<?
				if (isset($row['comment'])){
				?>	
				<td><a href='edit_comments.php?id=<? echo $article_id; ?>'>comments</a></td>
				<?  
				}
				else {
				?>
				<td align="center">--</td>
				<?
				}  
				if(($row['is_active']=='1')){
				?>	
				<td><a style="color: red;" href="<?$_SERVER['PHP_SELF']?>?action=delete&article_id=<?echo $article_id;?>">delete</a></td>
				<?
				}
				else{
				?>
				<td><a style="color: green;" href="<?$_SERVER['PHP_SELF']?>?action=undelete&article_id=<?echo $article_id;?>">restore</a></td>
				<?
				}
				?>	

				
			</tr>				
		
<?
}
?>
</table>
	</div>
</div>
<? include 'footer_admin.php'; ?>