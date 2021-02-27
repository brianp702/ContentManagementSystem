<div class="content">
	<div class="post">
		<a name="comments"></a>
		<h1 style="color: #0000FF">Comments</h1>
		<a name="comments"></a>
	
		<?php
		$result = mysql_query("select website, username, date, comment, comment_id from comments where article_id='$article_id' and is_active = '1' order by comment_id");
		echo "<div class='posted'>" . mysql_num_rows($result) . " comments</div></div>";
		
		while($row = mysql_fetch_array($result))
		{
			echo "<a name='comment".$row['comment_id']."'></a>";
			if ($row['website'] != 'NULL') {

				echo "<div class='post'>
				<table>
					<tr>
						<td><b><a href='".$row['website']."'>".$row['username']."</a></b></td>
					</tr>
				";
			}
			else {
				echo "<div class='post'>		
					<table>
						<tr>
							<td><b>".$row['username']."</b></td>
						</tr>
					";
			}			
			echo "		
					<tr>
						<td class='posted'>".$row['date']."</td>
					</tr>
					<tr>
						<td colspan='2'>".nl2br($row['comment'])."</td>
					</tr>
					<tr>
				";
				/*
				if (($_GET['flag']=='yes') && ($_GET['comment_id']==$row['comment_id'])){
					echo "<td><p style='color: #F00; font-size: 10px; text-decoration: none'>comment flagged</td>";
				}
				else if($row['censored']=='NULL') {
					echo "<td><a style='color: #00F; font-size: 10px; text-decoration: none' href='../comments/flag.php?comment_id=".$row['comment_id']."&amp;article_id=".$article_id."'>flag as inappropriate</a></td>";
				}
				*/
			?>
			</tr>	
		</table>
	</div>
<?
	}
?>
</div>
