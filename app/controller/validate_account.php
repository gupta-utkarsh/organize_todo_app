<?php
	namespace Controller;		
	class ValidateAccount{
		function get(){
			if(isset($_GET['email'],$_GET['hash'])){
				$payload = array(
					'email' => $_GET['email'],
					'hash' => $_GET['hash'],
				);
			}
			$validate = new \Model\ValidateAccount($payload);
			\View\ValidateAccount::make($validate);
		}
	}	