<?php
	require_once 'head.php';
?>					
		<form action="../index.php/register" method="post">
			<fieldset>
				<legend>Sign Up</legend>
				Username you want to take :
				<input type="text" name="username" placeholder="johndoe17" required/>
				<br/><br/>
				Name : 
				<input type="text" name="name" placeholder="John Doe" required/>
				<br/><br/>
				Password :
				<input type="password" name="password" placeholder="***********" required/>
				<br/><br/>
				Re-enter Password :
				<input type="password" name="repassword" placeholder="**********" required/>
				<br/><br/>
				Email :
				<input type="email" name="email" placeholder="abc.xyz@swag.com" required/>
				<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
				<br/><br/>
				<input type="Submit" value="Register"/>
			</fieldset>
		</form>
		<?php
			if(isset($message)){
				echo $message;
			}
	require_once 'footer.php';
?>		