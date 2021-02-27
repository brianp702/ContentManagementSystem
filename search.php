<?php
include 'include/header.php';

$search_term = $_POST['search_term'];
?>
<div class="content">
	<div class = "post">
		<h4 style="color: #00F">Search results</h4>	
		<?
		$result = mysql_query("SELECT * FROM articles WHERE article LIKE '%$search_term%'");
		if(mysql_num_rows($result)!=0){
			
			$i=1;
			
			while($row = mysql_fetch_array($result)){
				echo "$i . <a href='articles.php?id=".$row['article_id']."'>".$row['title']."</a><br /><br />";
				$i++;
			}
		}
		else {
			echo "No results found for '$search_term'.";
			
		}
		?>
	</div>
</div>
<?	
include 'include/footer.php';		
?>