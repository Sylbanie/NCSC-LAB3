<?php

class request{
	private $id;
	private $username_id;
	private $province;
	private $location;
	private $direction;
	private $cost;
	private $condition;
	private $date;
	private $hour;

	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId() {
		return $this->id;
	}

	function getUsername_id() {
		return $this->username_id;
	}

	function getProvince() {
		return $this->province;
	}

	function getLocation() {
		return $this->location;
	}

	function getDirection() {
		return $this->direction;
	}

	function getCost() {
		return $this->cost;
	}

	function getCondition() {
		return $this->condition;
	}

	function getDate() {
		return $this->date;
	}

	function getHour() {
		return $this->hour;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setUsername_id($username_id) {
		$this->username_id = $username_id;
	}

	function setProvince($province) {
		$this->province = $this->db->real_escape_string($province);
	}

	function setLocation($location) {
		$this->location = $this->db->real_escape_string($location);
	}

	function setDirection($direction) {
		$this->direction = $this->db->real_escape_string($direction);
	}

	function setCost($cost) {
		$this->cost = $cost;
	}

	function setCondition($condition) {
		$this->condition = $condition;
	}

	function setDate($date) {
		$this->date = $date;
	}

	function setHour($hour) {
		$this->hour = $hour;
	}

	public function getAll(){
		$products = $this->db->query("SELECT * FROM requests ORDER BY id DESC");
		return $products;
	}
	
	public function getOne(){
		$product = $this->db->query("SELECT * FROM requests WHERE id = {$this->getId()}");
		return $product->fetch_object();
	}
	
	public function getOneByUser(){
		$sql = "SELECT p.id, p.cost FROM requests p "
				//. "INNER JOIN request line lp ON lp.request_id = p.id "
				. "WHERE p.username_id = {$this->getUsername_id()} ORDER BY id DESC LIMIT 1";
			
		$request = $this->db->query($sql);
			
		return $request->fetch_object();
	}
	
	public function getAllByUser(){
		$sql = "SELECT p.* FROM requests p "
				. "WHERE p.username_id = {$this->getUsername_id()} ORDER BY id DESC";
			
		$request = $this->db->query($sql);
			
		return $request;
	}
	
	
	public function getproductsByrequest($id){
//		$sql = "SELECT * FROM products WHERE id IN "
//				. "(SELECT product_id FROM request line WHERE request_id={$id})";
	
		$sql = "SELECT pr.*, lp.units FROM products pr "
				. "INNER JOIN request line lp ON pr.id = lp.product_id "
				. "WHERE lp.request_id={$id}";
				
		$products = $this->db->query($sql);
			
		return $products;
	}
	
	public function save(){
		$sql = "INSERT INTO requests VALUES(NULL, {$this->getUsername_id()}, '{$this->getProvince()}', '{$this->getLocation()}', '{$this->getDirection()}', {$this->getCost()}, 'confirm', CURDATE(), CURTIME());";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function save_linea(){
		$sql = "SELECT LAST_INSERT_ID() as 'request';";
		$query = $this->db->query($sql);
		$request_id = $query->fetch_object()->request;
		
		foreach($_SESSION['cart'] as $element){
			$product = $element['product'];
			
			$insert = "INSERT INTO request line VALUES(NULL, {$request_id}, {$product->id}, {$element['units']})";
			$save = $this->db->query($insert);
		}
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function edit(){
		$sql = "UPDATE requests SET condition='{$this->getCondition()}' ";
		$sql .= " WHERE id={$this->getId()};";
		
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
}