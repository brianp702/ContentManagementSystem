<?php
include '../include/functions.php';
authorize();

//-------------------------------------------------------------------------------------------------------
include '../include/classes.php';

//--------------if image upload form was submitted, run this script -----------------------------
if ($_GET['status']=='uploaded'){
	if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpeg")	|| ($_FILES["file"]["type"] == "image/pjpeg"))){
		if ($_FILES["file"]["error"] > 0){
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else{
			$image_url = "uploaded_" . $_FILES["file"]["name"]; //prepends 'uploaded_' to file name
		  	$image_url = str_replace(" ", "-", $image_url); // replaces spaces with dashes
		  
			if (file_exists("../images/" . $_FILES["file"]["name"])){
				echo "<p style='color: #F00;'>" . $_FILES["file"]["name"] . " already exists. </p>";
			}
			else{
				// put the uploaded file in ../images
				move_uploaded_file($_FILES["file"]["tmp_name"],"../images/" . $image_url);
				
				//---------resize large images ------------------------
				
				//$full_image_url = "../images/" . $image_url;  *this didn't work for some reason
				list($width,$height) = getimagesize("../images/".$image_url);
				
				// resize images wider than 640
				if ( $width > 340 ){				
					$image = new SimpleImage();
   					$image->load("../images/".$image_url);
  					$image->resizeToWidth(340);
   					$image->save("../images/".$image_url);
				}
				// resize images taller than 400
				else if ( $height > 200 ){				
					$image = new SimpleImage();
   					$image->load("../images/".$image_url);
  					$image->resizeToHeight(200);
   					$image->save("../images/".$image_url);
				}		
				//-------------------------------------------------------
				
				$article_id = $_GET['id'];
				mysql_query("update articles set image_url='$image_url' where article_id='$article_id'");
			}
		}
	}		  	
	else{
		$message = "<center><div id='message' style='color: #797876; background: #FFF1A8; padding: 5px;'><strong>File error: reason unknown.</strong></div></center>";
	}
}
//--------------------------------------------------------------------------------------------------------

//---------- if article was edited-----------------------------------------------------------------
if ($_GET['status']=='edited'){
		if(get_magic_quotes_gpc()) {
			$article = mysql_real_escape_string(stripslashes($_POST['article']));
			$title = mysql_real_escape_string(stripslashes($_POST['title']));
			$description = mysql_real_escape_string(stripslashes($_POST['description']));
			$meta_tags = mysql_real_escape_string(stripslashes($_POST['meta_tags']));
		}
		else {
			$article = mysql_real_escape_string($_POST['article']);	
			$title = mysql_real_escape_string($_POST['title']);
			$description = mysql_real_escape_string($_POST['description']);
			$meta_tags = mysql_real_escape_string($_POST['meta_tags']);
		}
		$date = mysql_real_escape_string(strip_tags($_POST['date']));
		$delete = mysql_real_escape_string(strip_tags($_POST['delete']));
		$image_url = $_POST['image_url'];
		if (empty($image_url)){
			$image_url = "grapes.jpg";
		}

		$article_id = $_GET['id']; 
		mysql_query("
			UPDATE articles 
			SET 
				description='$description'
				,meta_tags='$meta_tags'
				,date='$date'
				,article='$article'
				,title='$title'
				,image_url='$image_url' 
			WHERE article_id='$article_id'
				");
		echo mysql_error();
		Header("Location: ./admin.php?status=updated");
}
//-----------------------------------------------------------------------------
include 'header_admin.php';
if (isset($message)){echo $message;}	

echo "<div class='content'>";
echo "<span style='font-size: 18pt;'><em>Edit Article</em></span><br /><br />";

// ------ if no article id...------------------------------------------------
if (!$_GET['id']){ 
	echo "You broke the internets. <a href='./admin.php'>back</a>";
	exit;
}

?>
	
<!--- calls the TinyMCE editor on all textareas -->	
<script language="javascript" type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	convert_urls : false,
	theme : "advanced",
	mode : "textareas"
});
</script>

<?
if (($_GET['status']=='downloaded') && ($_POST['image_url']!='')){
	$rand = md5(uniqid(rand(), true));
	$image_url = $_POST['image_url'];
	$filedata = "";
	$remoteimage = fopen($image_url, 'rb');
	if ($remoteimage) {
		while(!feof($remoteimage)) {
			$filedata.= fread($remoteimage,1024);
		}
	}
	fclose($remoteimage);
	$image_url = "../images/uploaded_".$rand.".jpg";
	$localimage = fopen($image_url,'wb');
	fwrite($localimage,$filedata);
	fclose($localimage);

	//resize it
	list($width,$height) = getimagesize("../images/".$image_url);

		// resize images wider than 640
		if ( $width > 340 ){				
			$image = new SimpleImage();
			$image->load("../images/".$image_url);
			$image->resizeToWidth(340);
			$image->save("../images/".$image_url);
		}
		// resize images taller than 400
		else if ( $height > 200 ){				
			$image = new SimpleImage();
			$image->load("../images/".$image_url);
			$image->resizeToHeight(200);
			$image->save("../images/".$image_url);
		}	
}
?>

<!-- image download form -->
<?php /* 
<form action='edit_articles.php?id=<?php echo $_GET['id']; ?>&status=downloaded' method='post'>
		<table>
			<tr>
				<td>
					<b>Submit new image</b>
				</td>
			</tr>
			<tr>
				<td>
					Image from URL: &nbsp
				</td>
				<td>
					<input type='text' name='image_url' />
					<input type='submit' value='Get image' />
				</td>
				<?php 
					if (($_GET['status']=='downloaded') && ($_POST['image_url']!='')){
						echo "<td><p style='color: #00F;'>Downloading another image will replace the one above.</p></td>";
					}	
				?>	
			</tr>
			<tr>
				<td> <b> OR </b>
				</td
			</tr>
		</form>
	<br />
*/?>
<!-- image upload form -->	
<table>
<form action='edit_articles.php?id=<?php echo $_GET['id']; ?>&status=uploaded' method='post' enctype='multipart/form-data'>
			<tr>
				<td>
					<strong>Upload banner image:</strong> &nbsp
				</td>
				<td>
					<input type='file' name='file' id='file' />
					<input type='submit' value='Upload and replace image' />
				</td>
		</form>
</table>	

<? 

// -------- get the article info from database--------------------------------------------
$article_id = $_GET['id']; 
$result = mysql_query("select date, title, article, image_url, description, meta_tags from articles where article_id='$article_id'");	
$row = mysql_fetch_array($result);
		
	$date = $row['date'];	
	$title = $row['title'];	
	$article = $row['article'];
	$image_url = $row['image_url'];
	$description = $row['description'];	
	$meta_tags = $row['meta_tags'];		
?>	
	<a name="<?php echo $title; ?>"></a>
		<br />
	<form action="edit_articles.php?id=<?php echo $article_id; ?>&status=edited" method="post">				
		<table border="0" width="900" cellpadding="3" cellspacing="0">					   
			<tr align="left"> 					      
				<td valign="top">						  
					<strong>Article ID:	</strong>					 
				</td>					      
				<td valign="top"> 					      
					<input type="text" name="article_id" readonly size="2"  value="<?php echo $article_id; ?>" />		
				</td>
				<td rowspan="4" align="right">
					<img src="../images/<?php echo $image_url; ?>" height="100" border="1">
				</td>					    
			</tr>							
			<tr align="left"> 					      
				<td valign="top">						  
					<strong>Date:	</strong>					  
				</td>
				<td> 					      
					<input type="text" name="date" size="25" value="<?php echo $date; ?>" />				      
				</td>					      
			</tr>						
			<tr> 					      
				<td valign="top">						  
					<strong>Title:</strong>						 
				</td>					      
				<td> 					  
					<input type="text" name="title" size="45" value="<?php echo $title; ?>" /> 				      
				</td>					    
			</tr>
			<tr align='left'> 					      
				<td valign='top'>						  
					<strong>Description:</strong>						 
				</td>
				<td> 					       
					<input type='text' name='description' size='65' value='<?php echo $description; ?>'/>		      
				</td>						
			</tr>
			<tr align='left'> 					      
				<td valign='top'>						  
					<strong>Meta tags:	</strong>					 
				</td>
				<td> 					       
					<input type='text' name='meta_tags' size='65' value='<?php echo $meta_tags; ?>'/> (Separate with commas) 
				</td>					
			</tr>
			<tr>
				<td valign="top">
					<strong>Image:</strong>
				</td>
				<td>
					<?php echo $image_url; ?>
				</td>											    
			</tr>
			<tr>      
				<td> 					       
					<input type="hidden" name="image_url" value="<?php echo $image_url; ?>" />				      
				</td>						
			</tr>							
			<tr align="left"> 					      
				<td valign="top">						 
					<strong>Article:	</strong>					  
				</td>						  
				<td valign="top" colspan="2">						  
					<textarea name="article" rows="20" cols="100"><?php echo $article; ?></textarea>
				</td>					
			 </tr>			
			<tr>							
				<td valign="top" width="175">					
				</td>						
				<td>					
					<input type="submit" value="Save" />			
				</td>					
			</tr>				
	</table>	
</form>	
</div>			
<? include 'footer_admin.php'; ?>