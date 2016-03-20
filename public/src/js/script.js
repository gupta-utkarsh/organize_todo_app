$(document).ready(function(){

	//DOM variables

	var $add_task = $('.add_task');
		var $add_task_title = $('.add_task_title');
		var $add_task_content = $('.add_task_content');
		var $add_task_list = $('.add_task_list');
			var $add_task_list_item = $('.add_task_list_item');
				var $add_task_list_item_content = $('.add_task_list_item_content');
				var $remove_icon = $('.fa-remove');
			var $add_task_list_item_plus = $('.add_task_list_item_plus');
		var $add_task_form = $('#add_task_form');
		var $list_icon = $('.fa-list-ul');
	
	var $main = $('main');
		var $task = $('.task');

	var $check_list = 0;

	//Functions

	//Function to open up the new task box.

	function initiate_task() {
		$add_task.addClass("form_focus_background");
		$add_task_title.fadeIn();
		$add_task_form.fadeIn();
		$list_icon.fadeIn();
	}

	//Function to decimate the new task and reset the new task box to null.

	function decimate_task(){
		$add_task.removeClass("form_focus_background");
		$add_task_title.fadeOut();
		$add_task_form.fadeOut();
		$list_icon.fadeOut();
		if($check_list==1){
			$add_task_list.fadeOut();
			$add_task_list_item_plus.fadeOut();
			$add_task_content.fadeIn();
			$add_task_list_item.detach();
		}
		$add_task_title.text("");
		$add_task_content.text("");
		$check_list = 0;
	}

	//Function to change to list-type new task.

	function change_to_list(){
		$check_list = 1;
		$add_task_content.fadeOut(100);
		$list_icon.fadeOut();
		$add_task_list.fadeIn();
		$add_task_list_item_plus.fadeIn();
		add_list_item();
	}

	//Function to add a list item in new list-type task.

	function add_list_item(){
		var $div_check = jQuery('<div/>',{
			class: 'check'
		});
			
			var $checkbox = jQuery('<input>',{
				type : 'checkbox',
				name : 'checkbox'
			});

		var $div_item_content = jQuery('<div/>',{
			class:'add_task_list_item_content',
			placeholder : 'Add task',
			contentEditable : 'true'
		});

		var $icon_remove = jQuery('<i/>',{
			class:'fa fa-remove',
		});	

		var $div_item = jQuery('<div/>', {
			class: 'add_task_list_item'
		});
		
		$checkbox.appendTo($div_check);
		$div_check.appendTo($div_item);
		$div_item_content.appendTo($div_item);
		$icon_remove.appendTo($div_item);
		$div_item.appendTo($add_task_list);

		$add_task_list_item = $add_task_list.find('.add_task_list_item');
		$add_task_list_item_content = $add_task_list.find('.add_task_list_item_content');
	}

	//Function to submit the new task to the database.

	function submit_task(){
		var $message;
		var $task;
		if($check_list){
			var $n = $add_task_list_item.length;
			var $task_items = {};
			for(var $i=0; $i<$n; $i++){
				var $task_item = $add_task_list_item.eq($i);
				if($task_item.find('input').is(':checked'))
					$task_item_checked=1;
				else
					$task_item_checked=0;
				$task_items[$i]={
					content : $task_item.children(".add_task_list_item_content").text(),
					done : $task_item_checked
				}
			}
			$task = {
				title: $add_task_title.text(),
				type : $check_list,
				list : $task_items
			}
		}	
		else{
			$task = {
				title: $add_task_title.text(),
				content: $add_task_content.text(),
				type : $check_list
			}
		}
		$.ajax({
		    url: '/organize/index.php/addtask',
		    type: 'POST',
		    data: $task,
		    success: function(msg) {
		    	console.log(msg);
		    	$newtask = msg;
		        decimate_task();
		        insert_task(msg);
		    },
		    error: function(msg) {
		      	console.log(msg);
		    }
		});
	}

	//Function to add the new task created to the view.

	function insert_task($task){
		$main.prepend($task);
		mason($task);
	}

	//Function to delete tasks.

	function delete_task($task_id){
		$.ajax({
			url:'/organize/index.php/deletetask',
			type: 'POST',
			data: {
				task_id: $task_id
			},
			success:function(msg) {
				console.log(msg);
				mason();
			}
		});
	}

	function mason(){
		main = document.querySelector('main');
			masonry = new Masonry(main, {
				itemSelector: '.task'
			});
		
	}
	//Add Task Event Handlers

		$add_task_content.on('focus', function(){
			initiate_task();
		});
		
		$list_icon.on('click', function(){
			change_to_list();
		});

		$add_task_list_item_plus.on('click', function(){
			add_list_item();
		});

		$add_task_list.on({
			mouseenter: function(){
				$(this).find('.fa-remove').fadeIn(100);
			},
			mouseleave: function(){
				$(this).find('.fa-remove').fadeOut(100);
			}
			
		}, ".add_task_list_item");

		$add_task_list.on('click','.fa-remove',function(){
			$(this).parent().detach();
		});

	//Submit Task Controller
	$add_task_form.on('submit',function(){
		event.preventDefault();
		submit_task();
	});

	//Delete task controller
	$main.on('click','.fa-remove',function(){
		$temp = $(this).parent().parent().parent(); 
		$temp.fadeOut();
		setTimeout(function(){
			$temp.detach();
		}, 400);
		setTimeout(function(){
			delete_task(parseInt($temp.attr('id').replace("task","")));	
		},400);
	});

	//Change list item status
	$main.on('change','input:checkbox',function(){
    	$listitem = $(this).parent().parent();
    	$listitem_id = parseInt($listitem.attr('id').replace("listitem",""));
    	$done = 0;

        if (this.checked) {
        	$done = 1;
        	$listitem.addClass('line_through');
        }
        else{
        	$listitem.removeClass('line_through')
        }
        $.ajax({
			url:'/organize/index.php/really',
			type: 'POST',
			data: {
				listitem_id: $listitem_id,
				done: $done 
			},
			success:function(msg) {
				console.log(msg);
			}
		});
    });

    var main = document.querySelector('main');
	var masonry = new Masonry(main, {
		itemSelector: '.task'
	});
});
