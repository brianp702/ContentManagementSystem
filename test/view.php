<?php
session_start();
///////////////////////////////////////////
if($_SESSION['user_type']!='admin'){
	header("Location: http://neo-conception.org/test/");
}
//////////////////////////////////////////
include 'header.php';

	$result = mysql_query("select * from exam");
	
	echo "<table><tr><td><b>First name</b></td><td><b>Last Name</b></td><td><b>Email</b></td><td><b>Phone</b></td></tr>";
	while($row = mysql_fetch_array($result))
	{
?>		
			
				<tr>
					<td><input type="text" name="firstname" value="<? echo $row['firstname']; ?>"</td>
				
					<td><input type='text' name='lastname' value='<? echo $row['lastname']; ?>'</td>
			
					<td><input type='text' name='email' value='<? echo $row['email']; ?>'</td>
				
					<td><input type='text' name='phone' value='<? echo $row['phone']; ?>'</td>
					
					<td><a href="delete.php?id=<? echo $row['id']; ?>">x</a></td>
					
				</tr>
			
		
<?
	}
?>
</table>
<br /><br /><hr />
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
	
	
<?	
	include 'footer.php';
?>


