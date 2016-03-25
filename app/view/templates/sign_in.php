<?php
	require_once 'head.php';
?>	
		<link rel="stylesheet" type="text/css" href="/organize/css/authenticate.min.css">	
		<form action="/organize/index.php/sign_in" method="post">
			<fieldset>
				<legend>Log In</legend>
				<label>
					User ID :
					<input type="text" name="username" placeholder="Enter Username" required/>
				</label>
				<br/><br/>
				<label>
					Password :
					<input type="password" name="password" placeholder="Enter Password" required/>
				</label>
				<br/><br/>
				<input type="Submit" value="Log In"/>
				<a href="register">Register</a>
			</fieldset>
		</form>
		<?php
			if(isset($message)){
				echo $message;
			}
	require_once 'footer.php';
?>		
	
	