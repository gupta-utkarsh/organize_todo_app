<?php
	namespace View;
	class ValidateAccount{
		public static function make($validate=NULL){
			if($validate->status==1){
				$message = "Your account has been validated.<a href='../index.php'>Log In</a> and enjoy our services. Cheers!";
				require_once 'templates/validate_account.php';
			}
			elseif($validate->status==0){
				$message = $validate->$message;
				require_once 'templates/validate_account.php';	
			}	
		}
	}		