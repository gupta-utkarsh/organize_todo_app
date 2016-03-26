<?php
	namespace View;
	class NewUser{
		public static function make($newuser=NULL){
			$twig = \View\Loader::make();
			if($newuser == NULL){
				$form_token = md5( uniqid('auth', true) );
				$_SESSION['form_token'] = $form_token;
				$title = "Register | Organize";
				echo $twig->render('sign_up.html', array('title' => $title,'form_token' => $form_token, 'css_url' => '/organize/css/authenticate.min.css'));
			}
			elseif($newuser->status==0){
				$message = $newuser->message;
				$form_token = md5( uniqid('auth', true) );
				$_SESSION['form_token'] = $form_token;
				$title = "Register | Organize";
				echo $twig->render('sign_up.html', array('title' => $title,'form_token' => $form_token, 'css_url' => '/organize/css/authenticate.min.css', 'message' => $message));
			}
			elseif($newuser->status==1){
				$email = $newuser->get_email();
				$message = "An email has been sent to ".$email." with a link to verify your account. Click on the link to start organizing your life. Cheers!";
				$title = "Validate Account | Organize";
				echo $twig->render('validate_account.html', array('title' => $title,'css_url' => '/organize/css/authenticate.min.css', 'message' => $message));
			}	
		}
	}