<?php
	namespace Model;
	class DeleteTask{
		function __construct($task_id){
			$status = 1;
			if($task_id<=0){
				$status = 0;
			}
			else{
				$user_id = $_SESSION['user_id'];
				$sql = "UPDATE tasks SET status=1 WHERE id=:id && user_id=:user_id";
				$query = MySql::get_instance()->prepare($sql,array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
				$query->execute(array(':id'=>$task_id,':user_id'=>$user_id));
			}
			return $status;
		}
	}