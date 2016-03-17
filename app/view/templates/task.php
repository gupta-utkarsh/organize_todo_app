<div class="task" id="task<?php echo $task->get_id(); ?>">
	<div class="task_header">
		<div class="task_title">
			<?php echo $task->get_title(); ?>	
		</div>
		<div class="task_remove">
			<i class="fa fa-remove"></i>
		</div>
	</div>
	<div class="task_content">
		<?php if($task->get_type()==1){ ?>
		<div class="task_list">
			<?php	foreach($task->get_list_items() as $item){
					$done = "";
					$class = "";
					if($item->get_done()=='1'){
						$done = "checked";
						$class = "line_through";
					}; ?>			
			<div class="task_list_item <?php echo $class; ?>" id="listitem<?php echo $item->get_id(); ?>">
				<div class="task_list_item_check">
					<input type="checkbox" name="checkbox" <?php echo $done; ?> >
				</div>
				<div class="task_list_item_content ">
					<?php echo $item->get_content() ?>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php	}	
			else{
				echo $task->get_content();
			} ?>
	</div>
</div>