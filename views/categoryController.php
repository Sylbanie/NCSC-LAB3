<?php

require_once __DIR__.'/modelController.php';

class ProductController {

    public function getController() {
        $controller = new ModelController();
        return $controller;
    }

    /* select all products from the database */
    public function fetchProducts($offset, $total_records_per_page) {
        $controller = $this->getController();
        $sql = "SELECT id, name, price, quantity, category, image FROM product 
                ORDER BY name DESC LIMIT $offset, $total_records_per_page ;";
        $result = $controller->fetchRecords($sql);
        return $result;
    }

    /* select product */
    public function selectProduct($id) {
        $controller = $this->getController();
        $sql = "SELECT id, name, price, quantity, image, image_large, category FROM product
                WHERE id = ? ;";
        $result = $controller->oneParamRecord($sql, $id);
        return $result;
    }

    /* insert product */
    public function insertProduct($values) {
        $controller = $this->getController();
        $sql = "INSERT INTO product (name, price, quantity, image, image_large, category) 
                VALUES (?, ?, ?, ?, ?, ?);";
        $type = 'ssssss';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* select product by category */
	public function getAllCategory(){
		$sql = "SELECT p.*, c.name AS 'catname' FROM products p "
				. "INNER JOIN categorys c ON c.id = p.category_id "
				. "WHERE p.category_id = {$this->getcategory_id()} "
				. "ORDER BY id DESC";
		$products = $this->db->query($sql);
		return $products;
	}
	
	public function getRandom($limit){
		$products = $this->db->query("SELECT * FROM products ORDER BY RAND() LIMIT $limit");
		return $products;
	}
	
    /* get the number of products */
	public function getOne(){
		$product = $this->db->query("SELECT * FROM products WHERE id = {$this->getId()}");
		return $product->fetch_object();
	}
	
	public function save(){
		$sql = "INSERT INTO products VALUES(NULL, {$this->getcategory_id()}, '{$this->getname()}', '{$this->getdescription()}', {$this->getprice()}, {$this->getstock()}, null, CURDATE(), '{$this->getimage()}');";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	/* update product */
	public function edit(){
		$sql = "UPDATE products SET name='{$this->getname()}', description='{$this->getdescription()}', price={$this->getprice()}, stock={$this->getstock()}, category_id={$this->getcategory_id()}  ";
		
		if($this->getimage() != null){
			$sql .= ", image='{$this->getimage()}'";
		}
		
		$sql .= " WHERE id={$this->id};";
		
		
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	/* delete product */
	public function delete(){
		$sql = "DELETE FROM products WHERE id={$this->id}";
		$delete = $this->db->query($sql);
		
		$result = false;
		if($delete){
			$result = true;
		}
		return $result;
	}
}