<div class="content">
	<div class="post">
		<a name='form'></a>
		<h1 style="color: #00F">Submit comment:</h1>
		<?php		
		if ($_GET['msg']=='skipped'){
			echo "<center><div id='message' style='color: #797876; background: #FFF1A8; padding: 5px;'><strong>You skipped a field.</strong></div></center>";
		}
		if ($_GET['msg']=='captcha'){
			echo "<center><div id='message' style='color: #797876; background: #FFF1A8; padding: 5px;'><strong>Verification code was wrong.</strong></div></center>";
		}
		?>
		<form class="form" action="comments/submit.php" method="post">
			<table border="0" cellpadding="3" cellspacing="0">
				<tr valign='top'>
					<td>
						Name:
					</td>
					<td>
						<input type="text" name="username" size="30" />
					</td>
				</tr>
				<tr valign='top'>
					<td>
						Web site (optional):
					</td>
					<td>
						<input type="text" name="website" size="30" />
					</td>
				</tr>
				<tr valign='top'>
					<td>
						Comment:
					</td>
					<td>
						<textarea name="comment" rows="7" cols="40"></textarea>
					</td>
				</tr>
				</tr>
				<tr valign='top'>
					<td>
						<img id="captcha" src="securimage/securimage_show.php" width="120px" alt="CAPTCHA Image" />
						<br>

						<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">Reload Image</a>
					</td>
					<td>
						<input type="text" name="captcha_code" size="10" maxlength="6" />
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<input type="submit" value="submit" />
					</td>

					<tr>
						<td>
							<input type="hidden" name="article_id" value=< ?php echo "'".$article_id. "'" ?> />
						</td>
						<td>
							<input type="hidden" name="title" value=< ?php echo "'".$title. "'" ?> />
						</td>
					</tr>
			</table>
		</form>
	</div>
</div>
