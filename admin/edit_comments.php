<?php
include '../include/functions.php';
authorize();

include 'header_admin.php';
	
// handle the magic quotes and get the $_POST variables
if(get_magic_quotes_gpc()) {
	$comment = mysql_real_escape_string(strip_tags(stripslashes($_POST["comment"])));
}
else {
	$comment = mysql_real_escape_string(strip_tags($_POST["comment"]));
}
$comment_id = $_GET['comment_id'];
     	
// delete the comment
if ($_GET['action']=='delete') { 
	mysql_query("
		UPDATE comments 
		SET is_active = '0'
		WHERE comment_id ='$comment_id'
		");
	echo mysql_error();
	echo "<center><div id='message' style='color: #797876; background: #FFF1A8; padding: 5px;'><strong>Comment was deactivated. </strong></div></center>";		
}
// undelete the comment
elseif ($_GET['action']=='undelete') { 
	mysql_query("
		UPDATE comments 
		SET is_active = '1'
		WHERE comment_id ='$comment_id'
	");
	echo mysql_error();
	echo "<center><div id='message' style='color: #797876; background: #FFF1A8; padding: 5px;'><strong>Comment was restored.</strong></div></center>";		
}

?>
<script type="text/javascript">  
	$(document).ready(function(){
	  // Zebra stripe our tables
	  $("table tr:odd").addClass("odd");
	  $("table tr:even").addClass("even");
	});
</script>
<?
$article_id = $_GET['id'];

$result = mysql_query("
	SELECT
		comment
		,comment_id
		,comments.is_active
		,articles.title
	FROM comments
	LEFT JOIN articles on articles.article_id = comments.article_id 
	WHERE articles.article_id = '$article_id'
	ORDER BY comments.is_active DESC
	");	

?>
<div class="content">
	<p style="font-size: 18pt;"><em>Comments</em></p>
	<? /*
	while($row = mysql_fetch_array($result))
	{
		$title = stripslashes($row['title']);
		echo $title;
	} 
	*/
	?>		


	<table style="border: 1px grey solid" width="500px" class="striped" cellpadding="5px">
		<tr style="background: #3C9DD0; color:white;">
			<td align="center">Comment</td>
			<td align="center">Action</td>
		</tr>

<?
	while($row = mysql_fetch_array($result))
	{
		$comment_id = stripslashes($row['comment_id']);		
		$comment = stripslashes($row['comment']);
		$title = stripslashes($row['title']); 	
?>			
			<tr>
				<td><?php echo $comment; ?></td>
				<?
				if(($row['is_active']=='1')){
				?>	
				<td><a style="color: red;" href="<?$_SERVER['PHP_SELF']?>?action=delete&comment_id=<?echo $comment_id;?>&id=<?echo $article_id;?>">trash</a></td>
				<?
				}
				else{
				?>
				<td><a style="color: green;" href="<?$_SERVER['PHP_SELF']?>?action=undelete&comment_id=<?echo $comment_id;?>&id=<?echo $article_id;?>">restore</a></td>
				<?
				}
				?>	
			</tr>				
		
<?
}
?>
	</table>
</div>

<?php
include	"footer_admin.php";

/*
while($row = mysql_fetch_array($result))	{
	$comment = $row['comment'];	
?>	

		<form action="edit_comments.php?status=edited" method="post">				
			<table border="0" width="600" cellpadding="3" cellspacing="0">   
				
				<tr align="left"> 					      
					<td valign="top">						 
						Comment:						  
					</td>						  
					<td valign="top" colspan="2">						  
						<textarea name="comment" rows="4" cols="50"><?php echo $comment; ?></textarea>	
					</td>					
				 </tr>
<?
				if ($censored != 'NULL'){
?>				 
				 <tr align="left"> 					      
					<td valign="top">						 
						Censored:						  
					</td>						  
					<td valign="top" colspan="2">						  
						<textarea name="censored" rows="4" cols="50" style="background-color: #FCC"><?php echo $censored; ?></textarea>	
					</td>					
				 </tr>
				 
				<tr align="left">
					<td valign="top">		
					</td>					
					<td valign="top" width="140">				
						<input type="checkbox" name="unflag" value="YES"/> Unflag comment	
					</td>		
				</tr>
<?
				}
?>						
				<tr align="left">
					<td valign="top">		
					</td>					
					<td valign="top" width="140">				
						<input type="checkbox" name="delete" value="YES"/> Delete
					</td>		
				</tr>
				<tr>							
					<td valign="top" width="175">					
					</td>						
					<td>					
						<input type="submit" value="submit" />			
					</td>					
				</tr>				
		</table>			
		<br />			
		<hr />
	</form>				
<?php
}*/
?>	