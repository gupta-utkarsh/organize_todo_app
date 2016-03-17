<?php
	namespace Controller;
	class SignIn{
		function post(){
			$status = 0;
			if(isset($_POST['username'],$_POST['password'])){
				$status = 1;
			}
			$payload = array(
					'username' => $_POST['username'],
					'password' => $_POST['password'],
					'status' => $status
			);
			$sign_in = new \Model\SignIn($payload);
			\View\SignIn::make($sign_in);
		}
		function get(){
			\View\SignIn::make();	
		}
	}	