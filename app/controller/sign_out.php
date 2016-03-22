<?php
	namespace Controller;
	class SignOut{
		function get(){
			unset($_SESSION['user_id']);
			session_regenerate_id(true);
			session_start();
			header('Location : /organize/index.php/');
		}
	}