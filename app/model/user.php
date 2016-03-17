<?php
	namespace Model;
	class User{
		private $id;
		private $username;
		private $name;
		private $email;
		private $tasks;
		function __construct(){
			if(isset($_SESSION['user_id'])){
				if(preg_match("/^[0-9]+$/", $_SESSION['user_id'])){
					$this->init();
				}
				else{
					unset($_SESSION['user_id']);
					session_destroy();
					session_regenerate_id(true);
					session_start();
				}
			}
			else{
				session_destroy();
				session_regenerate_id(true);
				session_start();
			}
		}
		private function init(){
			$temp_id = $_SESSION['user_id'];
			$sql = "SELECT username,name,email from users WHERE id=:temp_id";
			$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
			$query->execute(array(':temp_id'=>$temp_id));
			if($query->rowCount()!=1){
				return -1;
			}
			$this->id=$temp_id;
			$temp = $query->fetch(\PDO::FETCH_ASSOC);
			$this->username = $temp['username'];
			$this->name = $temp['name'];
			$this->email = $temp['email'];
			$this->tasks = \Model\Task::get_tasks($this->id,'0'); 
		}

		public function get_tasks(){
			return $this->tasks;
		}

		public function get_name(){
			return $this->name;
		}

		public function get_email(){
			return $this->email;
		}
	}
?>