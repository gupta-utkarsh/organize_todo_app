<?php
	namespace View;
	class SignIn{
		public static function make($sign_in=NULL){
			if($sign_in == NULL){
				$title = "Organize | Log In";
				echo $twig->render('sign_in.html', array('title' => $title, 'css_url' => '/organize/css/authenticate.min.css'));
			}
			elseif($sign_in->status==0){
				$message = $sign_in->message;
				$title = "Organize | Log In";
				echo $twig->render('sign_in.html', array('title' => $title, 'css_url' => '/organize/css/authenticate.min.css', 'message' => $message));
			}
			elseif($sign_in->status==1){
				header("Location:/organize/index.php/");
			}
		}	
	}