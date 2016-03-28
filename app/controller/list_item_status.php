<?php
	namespace Controller;
	class ListItemStatus{
		function get(){
			header("Location : http://organize.in");
		}
		function post(){
			if(isset($_POST['listitem_id'],$_POST['done'])){
				$payload = array(
					'id' => $_POST['listitem_id'],
					'done' => $_POST['done']
				);
				\Model\ListItem::change_status($payload);
			}
		}
	}