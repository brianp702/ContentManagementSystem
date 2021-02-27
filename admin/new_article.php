<?php
include '../include/functions.php';
authorize();

$date = date("F j, Y");
include 'header_admin.php';	
echo "<div class='content'>";
echo "<span style='font-size: 18pt;'><em>New Article</em></span><br /><br />";
include '../include/classes.php';


//--------------if image upload form was submitted -----------------------------
if ($_GET['status']=='uploaded'){
	if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg"))){
		if ($_FILES["file"]["error"] > 0){
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else{	
			$image_url = "uploaded_" . $_FILES["file"]["name"]; //prepends "uploaded_" to file name
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
			}			
		}
	}
	else{
		echo "<center><div id='message' style='color: #797876; background: #FFF1A8; padding: 5px;'><strong>File error: reason unknown.</strong></div></center>";
	}
}

//--------------if image download form was submitted -----------------------------
if ($_GET['status']=='downloaded'){
	$rand = md5(uniqid(rand(), true));
	$image_url = $_POST['image_url'];
	$filedata = "";

	$remoteimage = @fopen($image_url, 'rb');
	if ($remoteimage){
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
		echo "<img src='../images/".$image_url."' height='100' border='1' alt='image preview'><br />".$image_url."<hr />";		
	}
	else {
		echo "<b><p style='color: #F00'>URL error</p></b>";
	}
		
	
}
?>

<!-- image download form -->
<?php /* 
<form action='new_article.php?status=downloaded' method='post'>
		<table>
			<tr>
				<td>
					Image from URL: &nbsp
				</td>
				<td>
					<input type='text' name='image_url' />
					<input type='submit' value='Get image' />
				</td>
				<?php 
					if ($_GET['status']=='downloaded'){
						echo "<td><p style='color: #00F;'>Downloading another image will replace the one above.</p></td>";
					}	
				?>	
			</tr>
			<tr>
				<td colspan=2> <b> OR </b>
				</td
			</tr>
		</form>
	<br />
*/ ?>

<!-- image upload form -->	
<form action='new_article.php?status=uploaded' method='post' enctype='multipart/form-data'>
		
			<tr>
				<td>
					<strong>Upload banner image: </strong> &nbsp
				</td>
				<td>
					<input type='file' name='file' />
					<input type='submit' value=<? 
						if ($_GET['status']=='uploaded'){
							echo "'Upload and replace image />";
						}
						else{
							echo "'Upload' />";							
						} 
						?>
						
				</td>
				<td>(upload before filling out form below)</td>
				

			</tr>
		</form>
	</table>
	<br />
<!-- ************************************************************************************** -->
<!-- ************************************************************************************** -->
<!-- ************************************************************************************** -->
<!-- TinyMCE script -->	
<script language="javascript" type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	convert_urls : false,
	theme : "advanced",
	mode : "textareas"
});
</script>


<!-- the main form to create an article -->
<form action='create_new_article.php' method='post'>				
			<table border='0' width='900' border='0' cellpadding='3' cellspacing='0'>					   
				<tr align='left'> 					      
					<td valign='top'>						  
						<strong>Date:</strong>						  
					</td>					      
					<td valign='top'> 					       
						<input type='text' name='date' size='30' value='<?php echo $date; ?>'/>					      
					</td>
					<td rowspan="4" align="right">
					<? if ($_GET['status']=='uploaded'){ ?>
						<img src="../images/<?echo $image_url;?>" height="100" border="1" alt="image preview">
					<? }
						else{ 
					?>	
						<img src="../images/grapes.jpg" height="100" alt="default image">
					<? }		
					?>	
					</td>	
				</tr>
				<tr align='left'> 					      
					<td valign='top'>						  
						<strong>Title:	</strong>					 
					</td>
					<td> 					       
						<input type='text' name='title' size='45' value=''/>		      
					</td>						
				</tr>
				<tr align='left'> 					      
					<td valign='top'>						  
						<strong>Description:</strong>						 
					</td>
					<td> 					       
						<input type='text' name='description' size='45' value=''/>		      
					</td>						
				</tr>
				<tr align='left'> 					      
					<td valign='top'>						  
						<strong>Meta tags:</strong>						 
					</td>
					<td> 					       
						<input type='text' name='meta_tags' size='45' value=''/> (Separate with commas)	      
					</td>										    
				</tr>
				<tr align='left'> 					      
					<td valign='top'>						 
						<strong>Article:</strong>						  
					</td>						  
					<td colspan='2'>
						<textarea name='article' rows='20' cols='100'></textarea>	
					</td>					
				 </tr>
				 <tr>      
					<td> 					       
						<input type='hidden' name='image_url' value='<?php echo $image_url; ?>'/>				      
					</td>						
				</tr>
				<tr>							
					<td valign='top'>					
					</td>						
					<td>					
					    <input type='submit' value='Save'/>	
					</td>					
				</tr>				
		</table>		
</form>	