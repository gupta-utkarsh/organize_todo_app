<?php
	namespace Model;
	class MySql{
		private static $instance = NULL;
		public static function get_instance(){
		    if(!self::$instance)
		    {
			    require '../config/config.php';
			    self::$instance = new \PDO('mysql:host=' . $CONFIG['db_host'] . ';dbname=' . $CONFIG['db_name'], $CONFIG['db_user'], $CONFIG['db_pass']);
			    self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}
		    return self::$instance;
		}
	}