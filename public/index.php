<?php
	require '../vendor/autoload.php';
	session_name('Organize_Session');
	session_set_cookie_params(0, '/', 'organize.in', false, true);
	session_start();

	ToroHook::add('404', function()
	{
		header('HTTP/1.1 404 Not Found', true, 404);
		echo "404 not found";
	});
	ToroHook::add('400', function()
	{
		header('HTTP/1.1 404 BAD REQUEST', true, 400);
		echo "404 bad request";
	});
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