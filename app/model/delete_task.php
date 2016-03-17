<?php
	namespace Model;
	class DeleteTask{
		function __construct($task_id){
			$status = 1;
			if($task_id<=0){
				$status = 0;
			}
			else{
				$sql = "UPDATE tasks SET status=1 WHERE id=:id";
				$query = MySql::get_instance()->prepare($sql,array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
				$query->execute(array(':id'=>$task_id));
			}
			return $status;
		}
	}