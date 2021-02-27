<?
include '../include/classes.php';
//--------------if image upload form was submitted, run this script -----------------------------
if ($_GET['status']=='uploaded'){
	if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg")) && ($_FILES["file"]["size"] <= 1550000)){
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
			echo "<img src='../images/".$image_url."' height='100' border='1' alt='image preview'><br /><hr />";
		}
	}
	else{
		echo "<p style='color: #F00;'>Invalid file: wrong file type, or file size > 550000 bytes.</p><br />";
	}
}
?>