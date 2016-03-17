<?php
	namespace View;
	class AddTask{
		public static function make($task=NULL){
			if($task==NULL){
				echo "";
			}
			else{
				require_once 'templates/task.php';
			}
		}
	} 
