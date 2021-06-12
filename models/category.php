<?php

class Category{
	private $id;
	private $name;
	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId() {
		return $this->id;
	}

	function getname() {
		return $this->name;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setname($name) {
		$this->name = $this->db->real_escape_string($name);
	}

	public function getAll(){
		$categogies = $this->db->query("SELECT * FROM categogies ORDER BY id DESC;");
		return $categogies;
	}
	
	public function getOne(){
		$category = $this->db->query("SELECT * FROM categogies WHERE id={$this->getId()}");
		return $category->fetch_object();
	}
	
	public function save(){
		$sql = "INSERT INTO categogies VALUES(NULL, '{$this->getname()}');";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	
}