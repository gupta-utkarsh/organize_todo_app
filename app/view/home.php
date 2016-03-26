<?php
	namespace View;
	class Home{
		public static function make($user=NULL){
			$twig = \View\Loader::make();
			if($user==NULL){
				$title = "Organize | Log In";
				echo $twig->render('sign_in.html', array('title' => $title, 'css_url' => '/organize/css/authenticate.min.css'));
			}
			else{
				$title = "Organize | Home";
				echo $twig->render('home.html',array('title' => $title, 'css_url' => '/organize/css/home.min.css', 'user' => $user, 'js_url' => '/organize/js/script.min.js' ));	
			}
		}
	} 