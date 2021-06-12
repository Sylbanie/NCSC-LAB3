<?php
require_once 'models/category.php';
require_once 'models/product.php';

class categoryController{
	
	public function index(){
		Utils::isAdmin();
		$category = new Category();
		$categories = $category->getAll();
		
		require_once 'views/category/index.php';
	}
	
	public function ver(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			// Get category
			$category = new Category();
			$category->setId($id);
			$category = $category->getOne();
			
			// Get products
			$product = new Product();
			$product->setCategory_id($id);
			$products = $product->getAllCategory();
		}
		
		require_once 'views/category/ver.php';
	}
	
	public function create(){
		Utils::isAdmin();
		require_once 'views/category/create.php';
	}
	
	public function save(){
		Utils::isAdmin();
	    if(isset($_POST) && isset($_POST['name'])){
			// Save the category to db
			$category = new Category();
			$category->setName($_POST['name']);
			$save = $category->save();
		}
		header("Location:".base_url."category/index");
	}
	
}