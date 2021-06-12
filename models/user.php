<?php

class username{
	private $id;
	private $name;
	private $email;
	private $password;
	private $role;
	private $image;
	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId() {
		return $this->id;
	}

	function getName() {
		return $this->name;
	}

	function getEmail() {
		return $this->email;
	}

	function getPassword() {
		return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
	}

	function getRole() {
		return $this->role;
	}

	function getImage() {
		return $this->image;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setName($name) {
		$this->name = $this->db->real_escape_string($name);
	}

	function setEmail($email) {
		$this->email = $this->db->real_escape_string($email);
	}

	function setPassword($password) {
		$this->password = $password;
	}

	function setRole($role) {
		$this->role = $role;
	}

	function setImage($image) {
		$this->image = $image;
	}

	public function save(){
		$sql = "INSERT INTO usernames VALUES(NULL, '{$this->getName()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', null);";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function login(){
		$result = false;
		$email = $this->email;
		$password = $this->password;
		
		// Check if user exists
		$sql = "SELECT * FROM usernames WHERE email = '$email'";
		$login = $this->db->query($sql);
		
		
		if($login && $login->num_rows == 1){
			$username = $login->fetch_object();
			
			// Verify password
			$verify = password_verify($password, $username->password);
			
			if($verify){
				$result = $username;
			}
		}
		
		return $result;
	}
	
	
	
}