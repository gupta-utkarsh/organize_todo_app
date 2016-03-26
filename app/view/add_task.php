<?php
	namespace View;
	class AddTask{
		public static function make($task=NULL){
			$twig = \View\Loader::make();
			if($task==NULL){
			}
			else{
				echo $twig->render('task.html', array('task' => $task));
			}
		}
	} 
