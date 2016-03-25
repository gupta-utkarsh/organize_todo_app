	<main>
	<?php 
		foreach($user->get_tasks() as $task){
			require 'task.php';		
		}
	?>		
	</main>
</div>
		