<?php
	namespace View;
	class SignIn{
		public static function make($sign_in=NULL){
			if($sign_in == NULL){
				require_once 'templates/sign_in.php';
			}
			elseif($sign_in->status==0){
				$message = $sign_in->message;
				require_once 'templates/sign_in.php';
			}
			elseif($sign_in->status==1){
				header("Location:/organize/index.php/");
			}
		}	
	}