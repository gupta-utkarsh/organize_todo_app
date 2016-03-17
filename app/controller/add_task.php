<?php
	namespace Controller;
	class AddTask{
		function get(){
			header("Location:/organize/index.php/");
		}
		function post(){
			$status = 1;
			$message = NULL;
			if(!isset($_POST['title'],$_POST['type'])){
				$status = 0;
				$message = "Invalid form submission";
			}	
			elseif($_POST['type']!=0&&$_POST['type']!=1){
				$status = 0;
				$message = "Invalid form submission";	
			}
			elseif(!$_POST['type']&&!isset($_POST['content'])){
				$status = 0;
				$message = "Invalid form submission";	
			}
			elseif($_POST['type']&&!isset($_POST['list'])){
				$status = 0;
				$message = "Invalid form submission";	
			}
			else{
				$payload = array(
					'title' => $_POST['title'],
					'type' => $_POST['type'],
					'content' => $_POST['content'],
					'list_items' => $_POST['list'],
					'status' => $status,
					'message' => $message
				);
				$newtask = new \Model\Task($payload);
				\View\AddTask::make($newtask);
			}
		}
	}