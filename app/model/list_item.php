<?php 
	namespace Model;
	class ListItem{
		private $id;
		private $content;
		private $done;
		function __construct(){

		}

		public static function insert($payload,$task_id){
			$list_items = NULL;
			$i=0;
			foreach($payload as $list_item_data){
				if(ListItem::Check($list_item_data['done'])){
					$list_item = new \Model\ListItem();
					$list_item->content = filter_var($list_item_data['content'],FILTER_SANITIZE_STRING);
					$list_item->done = filter_var($list_item_data['done'],FILTER_SANITIZE_NUMBER_INT);
					$sql = "INSERT into listitems(content,done,task_id) values (:content,:done,:task_id)";
					$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
					$query->execute(array(':content'=>$list_item->content,':done'=>$list_item->done,':task_id'=>$task_id));
					$list_item->id = MySql::get_instance()->lastInsertId();
					$list_items[$i] = $list_item;
					$i++;		
				}	
			}
			return $list_items;
		}

		private static function check($done){
			return preg_match("/^[0-1]{1}$/", $done);
		}

		public static function get_items($task_id){
			$list_items = NULL;
			$sql = "SELECT id,content,done from listitems WHERE task_id=:task_id";
			$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
			$query->execute(array(':task_id'=>$task_id));
			$result = $query->fetchAll(\PDO::FETCH_ASSOC);
			$i = 0;
			foreach($result as $item_data){
				$list_item = new \Model\ListItem();
				foreach($item_data as $key=>$value){
					$list_item->$key = $value;
				}
				$list_items[$i] = $list_item;
				$i++;
			}
			return $list_items;
		}

		public static function change_status($payload){
			if(preg_match("/^[0-1]{1}$/", $payload['done']) && preg_match("/^[0-9]+$/", $payload['id'])){
				$sql = "UPDATE listitems SET done=:done WHERE id=:id";
				$query = MySql::get_instance()->prepare($sql,array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
				$query->execute(array(':id'=>$payload['id'],':done'=>$payload['done']));
			}	
		}

		public function get_id(){
			return $this->id;
		}

		public function get_content(){
			return $this->content;
		}

		public function get_done(){
			return $this->done;
		}




	}	
?>