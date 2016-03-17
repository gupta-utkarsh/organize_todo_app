<?php
	namespace Model;
	class NewUser{
		private $username;
		private $name;
		private $email;
		private $password;
		private $active;
		public $status;
		public $message;
		function __construct($payload){
			if(!isset($payload['password'],$payload['username'],$payload['name'],$payload['email'],$payload['status'])||$payload['status']!=1){
				$this->status = 0;
				$this->message = $payload['message'];
			}
			elseif(!NewUser::check($payload)){
				$this->status = 0;
				error_log(base64_encode("Special characters used"),0);
				$this->message = "Dont use special characters";
			}
			elseif(strlen($payload['username'])>20){
				$this->status = 0;
				error_log(base64_encode("Length of username was more than 20 characters"),0);
				$this->message= "Length of username should be less than 20 characters";
			}
			elseif(strlen($payload['username'])<8||strlen($payload['password'])<8){
				$this->status = 0;
				error_log(base64_encode("Length of username and password was less than 8 characters"),0);
				$this->message = "Length of username and password should be more than 8 characters";
			}
			else{
				$this->username = filter_var($payload['username'],FILTER_SANITIZE_STRING);
				$this->password = filter_var($payload['password'],FILTER_SANITIZE_STRING);
				$salt = openssl_random_pseudo_bytes(128);
				$hash = hash('sha256',openssl_random_pseudo_bytes(128));
				$this->password = hash('sha256', $salt.$this->password);
				$this->name = filter_var($payload['name'],FILTER_SANITIZE_STRING);
				$this->email = filter_var($payload['email'],FILTER_SANITIZE_EMAIL);
				$this->active = 0;
				if(!NewUser::check_username($this->username)){
					$this->status = 0;
					$this->message = "Username already exists";
				}
				elseif(!NewUser::check_email($this->email)){
					$this->status = 0;
					$this->message = "Email id already exists";
				}
				else{
					$sql = "INSERT INTO users(username,password,name,email,active,salt,hash) values(:username,:password,:name,:email,:active,:salt,:hash)";
					try{
						if(NewUser::send_email($this->email, $hash)){
							$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
							$query->execute(array(':username'=>$this->username,':password'=>$this->password,':name'=>$this->name,':email'=>$this->email,':active'=>$this->active,':salt'=>$salt,':hash'=>$hash));
							$this->status = 1;
							$this->message = "User registered Successfully";
						}	
					}
					catch(PDOException $e){
						$this->status = 0;
						$this->message = "Unexpected Error";
						error_log(base64_encode($e->getmessage()),0);
					}
				}								
			}
			return $this;
		}
		private static function check($payload){
			return preg_match("/^[a-zA-Z0-9_.@ ]+$/", $payload['name'])&& preg_match("/^[a-zA-Z0-9_.]+$/", $payload['username'])&&preg_match("/^[a-zA-Z0-9_.@]+$/", $payload['email'])&&preg_match("/^[a-zA-Z0-9_.@!#$%^&* ]+$/", $payload['password']);
		}
		private static function check_username($username){
			$sql = "SELECT COUNT(*) from users WHERE username=:username";
			$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
			$query->execute(array(':username'=>$username));
			$count = $query->fetch(\PDO::FETCH_COLUMN, 0);
			if($count==1){
				return false;
			}
			return true;
		}
		private static function check_email($email){
			$sql = "SELECT COUNT(*) from users WHERE email=:email";
			$query = MySql::get_instance()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
			$query->execute(array(':email'=>$email));
			$count = $query->fetch(\PDO::FETCH_COLUMN, 0);
			if($count==1){
				return false;
			}
			return true;
		}

		private static function send_email($email,$hash){
			require_once '../config/config.php';
			$to      = $email;
			$subject = 'Email Verification Link | Organize';
			$message = 'Hi there!'."\r\n".'You just signed up on Organize. Please verify your email by clicking on this link : http://localhost/organize/index.php/validate_account?email='.$email.'&hash='.$hash."\r\n\r\n".'Thank you for being patient and happy organizing!'."\r\n".'Cheers!'."\r\n".'~The Organize Team'; 	
    		$headers='From: Organize Team<'$CONFIG['email'].'>'."\r\n";
			return mail($to, $subject, $message, $headers);
		}

		public function get_email(){
			return $this->email;
		}
	}	