<?php
include 'include/header.php';

$message = "test email body";
mail('jiggapayne2@hotmail.com', 'subject', $message);
?>

<!-- contact form -->
<div class='content'>
	<div class='post'>
		<img src='images/grapes.jpg' alt='image' border='1' />
	</div>
	<div class='post'>
		<h4 style='color: #0000FF'>Contact</h4>
			<?php
			  
			  
			  $email='';
			  $body='';
			  
			if ($_POST){
						$from = stripslashes($_POST['email']);
						$body = stripslashes($_POST['body']);
						$to = 'jiggapayne2@hotmail.com';
						$subject = 'neoconception.org';
						$headers = "From: $from";
						
						// validate e-mail address
						$valid = eregi('^([0-9a-z]+[-._+&])*[0-9a-z]+@([-0-9a-z]+[.])+[a-z]{2,6}$',$from);
						$crack = eregi("(\r|\n)(to:|from:|cc:|bcc:)",$body);
						
						if ($from && $body && $valid && !$crack){
							mail($to,$from,$body,$headers);
							echo "<center><div id='message' style='color: #797876; background: #FFF1A8; padding: 5px;'><strong>Message sent</strong></div></center>";
						}
						else{
							echo "<center><div id='message' style='color: #797876; background: #FFF1A8; padding: 5px;'><strong>Fill out the form completely</strong></div></center></p>";
						}
			}
			?>
					
			<form action="contact.php" method="post">
			  <table>
				<tr>
					<td>
						Your e-mail address
					</td>
					<td>
						<input type="text" name="email" id="email" size="30" />
					</td>
				</tr>
				<tr>
					<td>
						Your message
					</td>
					<td>
						<textarea name="body" id ="body" cols="40" rows="5"></textarea>
					</td>
				</tr>
				<tr><td id="submit" colspan="2"><button type="submit">Send message</button></td></tr>
			  </table>
			</form>
			
	</div>
</div>


<!-- right column -->
<?php
	include 'include/footer.php';
?>	