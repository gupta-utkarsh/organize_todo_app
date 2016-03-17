<?php
	namespace Controller;
	class DeleteTask{
		function get(){
			header("Location:/organize/index.php/");
		}
		function post(){
			$status = 1;
			if(!isset($_POST['task_id'])||!is_numeric($_POST['task_id'])){
				$status = 0;
			}
			$status = new \Model\DeleteTask($_POST['task_id']);
		}
	}
?>	