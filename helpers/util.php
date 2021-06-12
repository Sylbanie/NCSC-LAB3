<?php

class Utils{
	
	public static function deleteSession($name){
		if(isset($_SESSION[$name])){
			$_SESSION[$name] = null;
			unset($_SESSION[$name]);
		}
		
		return $name;
	}
	
	public static function isAdmin(){
		if(!isset($_SESSION['admin'])){
			header("Location:".base_url);
		}else{
			return true;
		}
	}
	
	public static function isIdentity(){
		if(!isset($_SESSION['identity'])){
			header("Location:".base_url);
		}else{
			return true;
		}
	}
	
	public static function showCategories(){
		require_once 'models/category.php';
		$category = new category();
		$categories = $category->getAll();
		return $categories;
	}
	
	public static function statscart(){
		$stats = array(
			'count' => 0,
			'total' => 0
		);
		
		if(isset($_SESSION['cart'])){
			$stats['count'] = count($_SESSION['cart']);
			
			foreach($_SESSION['cart'] as $product){
				$stats['total'] += $product['price']*$product['units'];
			}
		}
		
		return $stats;
	}
	
	public static function showStatus($status){
		$value = 'Earing';
		
		if($status == 'confirm'){
			$value = 'Earing';
		}elseif($status == 'preparation'){
			$value = 'In preparation';
		}elseif($status == 'ready'){
			$value = 'Ready to ship';
		}elseif($status = 'sent'){
			$value = 'Sent';
		}
		
		return $value;
	}
	
}