<?php
	namespace View;
	class ValidateAccount{
		public static function make($validate=NULL){
			$title = "Validate Account | Organize";
			if($validate=!NULL){
				if($validate->status==1){
					$message = "Your account has been validated.<a href='../index.php'>Log In</a> and enjoy our services. Cheers!";
				}
				elseif($validate->status==0){
					$message = $validate->$message;	
				}
				echo $twig->render('validate_account.html', array('title' => $title, 'css_url' => '/organize/css/authenticate.min.css', 'message' => $message));	
			}
		}
	}		