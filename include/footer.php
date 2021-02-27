<? 
$domain = $_SERVER['SERVER_NAME'];
include 'include/functions.php';
?>
<!-- BLUE BOX ******************************************************-->	
<div class="bbox">		
	<!-- LOGO ***************************-->
	<div class="item">
		<a  style="background: none" href="<?$domain?>/health"><img style="border: none" src="images/sprout.gif" alt="logo image" /></a>
	</div>			
	
	<!-- ARTICLES ***************************-->
	<div id="articles" class="item">
		<h3 class="heading">Articles</h3>
		<ul>
		<? list_articles(); ?>
		</ul>
	</div>			
	<?php 
	/* 
	<div id="contact" class="item">
		<h3 class="heading"><a href="contact.php">Contact</a></h3>
	</div>
	*/
	?>
	<!-- search ********** -->
	
	<div id="nav" class="item">
		<form method="post" action="search.php"><br />
			<input type="text" name="search_term" size='15' />
			<button type="submit" name="search">search</button>
		</form>
	</div>
	<div id="nav" class="item">
		<br />
		<a href="admin/index.php?user=guest"><strong style="color: red">Guest login</strong></a>
	</div>	
		
	<!-- FOOTER ***************************-->
	<div id="footer">
		<p>Copyright &copy; <?php echo date("Y");?></p>
	</div>
</div>

</body>
</html>
