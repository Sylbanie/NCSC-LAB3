<?php
require_once 'models/username.php';

class userController{
	
	public function index(){
		echo "Usernames controller, Index action";
	}
	
	public function register(){ 
		require_once 'views/username/register.php';
	}
	
	public function save(){
		if(isset($_POST)){
			
			$name = isset($_POST['name']) ? $_POST['name'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$password = isset($_POST['password']) ? $_POST['password'] : false;
			
			if($name && $email && $password){
				$username = new username();
				$username->setName($name);
				$username->setEmail($email);
				$username->setPassword($password);

				$save = $username->save();
				if($save){
					$_SESSION['register'] = "complete";
				}else{
					$_SESSION['register'] = "failed";
				}
			}else{
				$_SESSION['register'] = "failed";
			}
		}else{
			$_SESSION['register'] = "failed";
		}
		header("Location:".base_url.'username/register');
	}
	
	public function login(){
		if(isset($_POST)){
			// Identify username
			// Query the database
			$username = new username();
			$username->setEmail($_POST['email']);
			$username->setPassword($_POST['password']);
			
			$identity = $username->login();
			
			if($identity && is_object($identity)){
				$_SESSION['identity'] = $identity;
				
				if($identity->rol == 'admin'){
					$_SESSION['admin'] = true;
				}
				
			}else{
				$_SESSION['error_login'] = 'Failed identification!!';
			}
		
		}
		header("Location:".base_url);
	}
	
	public function logout(){
		if(isset($_SESSION['identity'])){
			unset($_SESSION['identity']);
		}
		
		if(isset($_SESSION['admin'])){
			unset($_SESSION['admin']);
		}
		
		header("Location:".base_url);
	}
	
} 