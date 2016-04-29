<?php
	namespace Model;
	class ValidateAccount{
		private $email;
		private $hash;
		public $message;
		public $status;
		function __construct($payload){
			if(!isset($payload['email'],$payload['hash'])){
				$this->status=0;
				$this->message = "Error";
			}
			elseif(!ValidateAccount::check($payload)){
				$this->status=0;
				$this->message = "Error";
			}
			else{
				$this->email = filter_var($payload['email'],FILTER_SANITIZE_EMAIL);
				$this->hash = $payload['hash'];
				$db_hash = ValidateAccount::get_hash($this->email);
				if($db_hash==-1){
					$this->status = 0;
					$this->message = "Email id does not exist";
				}
				else{
					if($this->hash==$db_hash){
						if(ValidateAccount::set_active($this->email)){
							$this->status=1;
						}
					}
					else{
						$this->status=0;
						$this->message="Error";
					}
				}
			}
			return $this;
		}
		private static function get_hash($email){
			$sql = "SELECT hash from users WHERE email=:email";
			$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
			$query->execute(array(':email'=>$email));
			if($query->rowCount()!=1){
				return -1;
			}
			$hash = $query->fetch(\PDO::FETCH_COLUMN, 0);
			return $hash;
		}

		private static function check($payload){
			return preg_match("/^[a-zA-Z0-9]+$/", $payload['hash'])&&preg_match("/^[a-zA-Z0-9_.@]+$/", $payload['email']);
		}

		private static function set_active($email){
			$sql = "UPDATE users SET active=1 WHERE email=:email";
			$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
			return $query->execute(array(':email'=>$email));
		}
	}	