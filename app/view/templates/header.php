<?php
	require_once "head.php";
?>		
		<link rel="stylesheet" type="text/css" href="/organize/css/home.min.css">
		<div class="head">
			<div class="brand-image">
				<h3>Organize</h3>
			</div>
			<div class="content">
				Welcome <?php echo $user->get_name(); ?> 
				<a class="button" href="/organize/index.php/signout">Sign Out</a>
			</div>
		</div>
		<div class="wrapper">