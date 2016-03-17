<?php
	require '../vendor/autoload.php';
	session_start();
	Toro::serve(array(
		'/'=> 'Controller\\Home',
		'/register' => 'Controller\\NewUser',
		'/sign_in' => 'Controller\\SignIn',
		'/validate_account' => 'Controller\\ValidateAccount',
		'/addtask' => 'Controller\\AddTask',
		'/deletetask' => 'Controller\\DeleteTask',
		'/archive' => 'Controller\\Archive',
		'/really' => 'Controller\\ListItemStatus',
		'/signout' => 'Controller\\SignOut'
	));