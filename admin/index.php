<?php
include "header_admin.php"
?>	

<?
if ($_GET['status']=='logout'){
	echo "<center><div id='message' style='color: #797876; background: #FFF1A8; padding: 5px;'><strong>You are logged out.  </strong></div></center>";
}	
elseif ($_GET['status']=='failure'){
	echo "<center><div id='message' style='color: #797876; background: #FFF1A8; padding: 5px;'><strong>Incorrect username/password.  </strong></div></center>";	
}
?>
<div class="content">
<h1>Administrator Login</h1>
		<form class="form" action="authorize.php" method="post" name="nameform">
			<table width="420" border="0" cellpadding="3" cellspacing="0">
				    <tr align="left"> 
				      <td valign="top" width="100"></td>
				      <td valign="top" width="405"></td>
					</tr>
				    <tr align="left"> 
				      <td valign="top" width="100">
					  Username:
					  </td>
				      <td valign="top" width="405"> 
				       <input type="text" name="username" size="20" <?php if ($_GET['user']=='guest'){	echo 'value="guest"';}?>/><br />
				      </td>
				    </tr>
					<tr align="left"> 
				      <td valign="top" width="100">
					  Password:
					  </td>
				      <td valign="top" width="405"> 
				       <input type="password" name="password" size="20" <?php if ($_GET['user']=='guest'){	echo 'value="guest"';}?>/><br />
				      </td>
				    </tr>
				    <tr align="left"> 
				      <td valign="top" width="100">
					  </td>
				      <td valign="top" width="100">
						<input type="submit" value="submit" name="submit"/>
					  </td>
				    </tr>
			</table>
		</form>
</div>
				
<? include 'footer_admin.php'; ?>	