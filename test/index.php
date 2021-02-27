<?php
include 'header.php';	
?>


		<form class="form" action="authorize.php" method="post">
			<table width="420" border="0" cellpadding="3" cellspacing="0">
				   
				    <tr align="left"> 
				      <td valign="top" width="100">
					  Username:
					  </td>
				      <td valign="top" width="405"> 
				       <input type="text" name="username" size="30" /><br /><br />
				      </td>
				    </tr>
					<tr align="left"> 
				      <td valign="top" width="100">
					  Password:
					  </td>
				      <td valign="top" width="405"> 
				       <input type="password" name="password" size="30" /><br /><br />
				      </td>
				    </tr>
				    <tr align="left"> 
				      <td valign="top" width="100">
					  </td>
				      <td valign="top" width="100"><br />
						<input type="submit" value="submit" name="submit"/>
					  </td>
				    </tr>
			</table>
		</form>


<? include 'footer.php'; ?>
	