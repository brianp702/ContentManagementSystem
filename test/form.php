<?php 
session_start();
///////////////////////////////////////////
if($_SESSION['user_type']!='admin'){
	header("Location: http://neo-conception.org/test/");
}
//////////////////////////////////////////
include 'header.php';
?>
		<form class="form" action="submit.php" method="post">
			<table border="0" cellpadding="3" cellspacing="0">
				  
				    <tr valign='top'> 
				      <td>
					  First Name:
					  </td>
				      <td> 
				       <input type="text" name="firstname" size="30" />
				      </td>
				    </tr>
				    <tr valign='top'> 
				      <td>
					 Last Name:
					  </td>
				      <td> 
				       <input type="text" name="lastname" size="30" />
				      </td>
				    </tr>
					<tr valign='top'> 
				      <td>
					  Email:
					  </td>
					  <td>
						<input type="text" name="email" size="30" />
					  </td>
				    </tr>
				    <tr valign='top'> 
				      <td>
					 Phone:
					  </td>
					  <td>
						<input type="text" name="phone" size="30" />
					  </td>
				    </tr>
					<tr> 
				      <td>
					  </td>
				      <td>
						<input type="submit" value="submit"/>
					  </td>
				    </tr>
					 
			</table>				
		</form>
<?php 
include 'footer.php'; 
?>