<?php
require '../connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="http://neo-conception.org/test/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form class="form" action="sum.php" method="post">
			<table width="420" border="0" cellpadding="3" cellspacing="0">
				   
				    <tr align="left"> 
				      <td valign="top" width="100">
					First number:
					  </td>

				      <td valign="top" width="405"> 
				       <input type="text" name="num1" size="5" /><br /><br />
				      </td>
				    </tr>
					<tr align="left"> 
				      <td valign="top" width="100">
					 Second Number:
					 </td>
				      <td valign="top" width="405"> 
				       <input type="top" name="num2" size="5" /><br /><br />
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