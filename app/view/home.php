<?php
	namespace View;
	class Home{
		public static function make($user=NULL){
			if($user==NULL){
				$title = "Organize | Log In";
				require_once 'templates/sign_in.php';
			}
			else{
				$title = "Organize | Home";
				require_once 'templates/home.php';
			}
		}
	} 