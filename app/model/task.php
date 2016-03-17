<?php
	namespace Model;
	class Task{
		private $id;
		private $title;
		private $type;
		private $content;
		private $list_items;
		public $status;
		public $message;
		function __construct($payload=NULL){
			if($payload==NULL);
			elseif($payload['status']==0){
				$this->status = $payload['status'];
				$this->message = $payload['message'];
			}
			else{
				$this->title = filter_var($payload['title'],FILTER_SANITIZE_STRING);
				$this->type = $payload['type'];
				if(!$this->type){
					$this->content = filter_var($payload['content'],FILTER_SANITIZE_STRING);
					$sql = "INSERT INTO tasks(user_id,title,type,content) values (:user_id,:title,:type,:content)";
					$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
					$query->execute(array(':user_id'=>$_SESSION['user_id'],':title'=>$this->title,':type'=>$this->type,':content'=>$this->content));
					$this->id = MySql::get_instance()->lastInsertId();
				}
				else{
					$sql = "INSERT INTO tasks(user_id,title,type) values (:user_id,:title,:type)";
					$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
					$query->execute(array(':user_id'=>$_SESSION['user_id'],':title'=>$this->title,':type'=>$this->type));
					$this->id = MySql::get_instance()->lastInsertId();
					$this->list_items = \Model\ListItem::insert($payload['list_items'],$this->id);
				}
				$this->status = 1;
			}
			return $this;
		}

		public static function get_tasks($user_id, $status){
			$tasks=NULL;
			if($user_id==$_SESSION['user_id']){
				$sql = "SELECT id,title,content,type from tasks WHERE user_id=:user_id && status=:status ORDER BY ts desc";
				$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
				$query->execute(array(':user_id'=>$user_id,':status'=>$status));
				$result = $query->fetchAll(\PDO::FETCH_ASSOC);
				$i = 0;
				foreach($result as $task_data){
					$task = new \Model\Task();
					foreach($task_data as $key=>$value){
						$task->$key = $value;
					}
					$task->list_items = \Model\ListItem::get_items($task->id);
					$tasks[$i] = $task;
					$i++;
				}
			}
			return $tasks;
		}

		public function get_id(){
			return $this->id;
		}

		public function get_title(){
			return $this->title;
		}

		public function get_type(){
			return $this->type;
		}

		public function get_content(){
			return $this->content;
		}
		
		public function get_list_items(){
			return $this->list_items;
		}
	}