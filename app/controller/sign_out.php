<?php
	namespace Controller;
	class SignOut{
		function get(){
			unset($_SESSION['user_id']);
			session_destroy();
			session_regenerate_id(true);
			session_start();
			header("Location : http://organize.in");
		}
	}