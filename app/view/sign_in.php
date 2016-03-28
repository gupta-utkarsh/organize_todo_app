<?php
	namespace View;
	class SignIn{
		public static function make($sign_in=NULL){
			$twig = \View\Loader::make();
			if($sign_in == NULL){
				header("Location: http://organize.in");
			}
			elseif($sign_in->status==0){
				$message = $sign_in->message;
				$title = "Organize | Log In";
				echo $twig->render('sign_in.html', array('title' => $title, 'css_url' => '/css/authenticate.min.css', 'message' => $message));
			}
			elseif($sign_in->status==1){
				header("Location: http://organize.in");
			}
		}	
	}