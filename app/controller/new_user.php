<?php
	namespace Controller;
	class NewUser{
		function get(){
			\View\NewUser::make();
		}
		function post(){
			$status = NULL;
			$message = NULL;
			if(isset($_POST['form_token'],$_POST['repassword'],$_POST['password'],$_POST['username'],$_POST['name'],$_POST['email'])){
				if($_POST['form_token']===$_SESSION['form_token']){
					if($_POST['password']===$_POST['repassword']){
							$status = 1;
					}
					else{
						$status = 0;
						error_log(base64_encode("Passwords do not match"),0);
						$message = "Passwords do not match";
					}
				}
				else{
					$status = 0;
					$message = "Dont mess with me";
					error_log(base64_encode("Dont mess with me"),0);
				}	
			}
			else{
				$status = 0;
				$message = "Dont mess with me";
			}	
			$payload = array(
					'username' => $_POST['username'],
					'name' => $_POST['name'],
					'email' => $_POST['email'],
					'password' => $_POST['password'],
					'status' => $status,
					'message' => $message
				);
			$newuser = new \Model\NewUser($payload);
			\View\NewUser::make($newuser);
		}
	}