<?php
include 'include/header.php';

//gets article, title, and image from database and displays them

$result = mysql_query("select * from articles where article_id='$article_id'");
while($row = mysql_fetch_array($result)){

	$image_url = $row['image_url'];
	$article = stripslashes($row['article']);
			
//<-- content -->
	echo "<div class='content'><div class='post'>
	<br />
	</div>	";
	echo "<div class='post'>";
	echo "<img src='images/".$image_url."' alt='image' border='1' />";
	echo "</div>";	
	echo "<div class='post'>";		
	echo "
		<h4 style='color: #0000FF'>".$row['title']."</h4>
		<div class='posted'>
			<p>".$row['date']."</p>
		</div>".			
		$article
		."</div>"
		;
}

//if there is no article with that article_id...
if (!$title){
	echo "<div class='content'>";
	echo "<div class='post'>";
	echo "<img src='images/avocado.jpg' alt='image' border='1' />";
	echo "</div>";	
	echo "<div class='post'>";
	echo "<h4 style='color: #00F'>You have broken the internets</h4><p>There is no article associated with this URL.</p>";
	echo "</div></div>";
	include 'include/footer.php';
	exit;
}
?>				
	</div>


<!-- comments and right column -->
<?php
	
	include 'comments/view_comments.php';
	include 'comments/comment_form.php';
	include 'include/footer.php';
?>	