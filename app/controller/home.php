<?php
	namespace Controller;
	class Home{
		function get(){
			if(!isset($_SESSION['user_id'])){
				\View\Home::make();
			}
			else{
				$user = new \Model\User();
				\View\Home::make($user);
			}
		}
	}