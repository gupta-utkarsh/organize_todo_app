<?php
	namespace View;
	class NewUser{
		public static function make($newuser=NULL){
			if($newuser == NULL){
				$form_token = md5( uniqid('auth', true) );
				$_SESSION['form_token'] = $form_token;
				$title = "Register | Organize";
				require_once 'templates/sign_up.php';
			}
			elseif($newuser->status==0){
				$message = $newuser->message;
				$form_token = md5( uniqid('auth', true) );
				$_SESSION['form_token'] = $form_token;
				$title = "Register | Organize";
				require_once 'templates/sign_up.php';
			}
			elseif($newuser->status==1){
				$email = $newuser->get_email();
				$message = "An email has been sent to ".$email." with a link to verify your account. Click on the link to start organizing your life. Cheers!";
				$title = "Validate Account | Organize";
				require_once 'templates/validate_account.php';
			}	
		}
	}