<?php
	namespace Model;
	class SignIn{
		private $username;
		private $password;
		public $status;
		public $message;
		function __construct($payload){
			if(!isset($payload['username'],$payload['password'],$payload['status'])||$payload['status']==0){
				$this->status = 0;
				$this->message = "Invalid username or password";
			}
			elseif(!SignIn::check($payload)){
				$this->status = 0;
				$this->message = "Invalid username or password";
			}
			elseif(strlen($payload['username'])>20){
				$this->status = 0;
				error_log(base64_encode("Length of username was more than 20 characters"),0);
				$this->message= "Invalid username or password";
			}
			elseif(strlen($payload['username'])<8||strlen($payload['password'])<8){
				$this->status = 0;
				error_log(base64_encode("Length of username and password was less than 8 characters"),0);
				$this->message = "Invalid username or password";
			}
			else{
				$this->username = filter_var($payload['username'],FILTER_SANITIZE_STRING);
				$this->password = filter_var($payload['password'],FILTER_SANITIZE_STRING);
				$result = $this->get_pin();
				if($result==0){
					$this->status = 0;
					$this->message = "Invalid username or password";
				}
				else{	
					$salt = $result['salt'];
					$db_password = $result['password'];
					$this->password = hash('sha256', $salt.$this->password);
					if(strcmp($db_password,$this->password)!=0){
						$this->status = 0;
						$this->message = "Invalid username or password";
					}
					else{
						$id = $this->get_id();
						if($id==0){
							$this->status = 0;
							$this->message = "Invalid username or password";	
						}
						else{
							session_destroy();
							session_regenerate_id(true);
							session_start();
							$_SESSION['user_id'] = $id;
							$this->status = 1;
						}
					}
				}
			}
		}
		private static function check($payload){
			return preg_match("/^[a-zA-Z0-9_.]+$/", $payload['username'])&&preg_match("/^[a-zA-Z0-9_.@!#$%^&* ]+$/", $payload['password']);
		}

		private function get_pin(){
			$username = $this->username;
			$sql = "SELECT salt,password from users WHERE username=:username && active=1";
			$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
			$query->execute(array(':username'=>$username));
			if($query->rowCount()!=1){
				return 0;
			}
			$result = $query->fetch(\PDO::FETCH_ASSOC);
			return $result;
		}

		private function get_id(){
			$username = $this->username;
			$sql = "SELECT id from users WHERE username=:username && active=1";
			$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
			$query->execute(array(':username'=>$username));
			if($query->rowCount()!=1){
				return 0;
			}
			$id = $query->fetch(\PDO::FETCH_COLUMN, 0);
			return $id;	
		}
	}