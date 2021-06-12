<?php
require_once 'models/order.php';

class orderController{
	
	public function make(){
		
		require_once 'views/order/make.php';
	}
	
	public function add(){
		if(isset($_SESSION['identity'])){
			$username_id = $_SESSION['identity']->id;
			$province = isset($_POST['province']) ? $_POST['province'] : false;
			$location = isset($_POST['location']) ? $_POST['location'] : false;
			$direction = isset($_POST['direction']) ? $_POST['direction'] : false;
			
			$stats = Utils::statscart();
			$cost = $stats['total'];
				
			if($province && $location && $direction){
				// Save data to db
				$order = new order();
				$order->setUsername_id($username_id);
				$order->setProvince($province);
				$order->setLocation($location);
				$order->setDirection($direction);
				$order->setCost($cost);
				
				$save = $order->save();
				
				// Save order
				$save_line = $order->save_line();
				
				if($save && $save_line){
					$_SESSION['order'] = "complete";
				}else{
					$_SESSION['order'] = "failed";
				}
				
			}else{
				$_SESSION['order'] = "failed";
			}
			
			header("Location:".base_url.'order/confirm');			
		}else{
			// Write the index
			header("Location:".base_url);
		}
	}
	
	public function confirm(){
		if(isset($_SESSION['identity'])){
			$identity = $_SESSION['identity'];
			$order = new order();
			$order->setUsername_id($identity->id);
			
			$order = $order->getOneByUser();
			
			$order_products = new order();
			$products = $order_products->getProductsByorder($order->id);
		}
		require_once 'views/order/confirm.php';
	}
	
	public function my_orders(){
		Utils::isIdentity();
		$username_id = $_SESSION['identity']->id;
		$order = new order();
		
		// Get order from user
		$order->setUsername_id($username_id);
		$orders = $order->getAllByUser();
		
		require_once 'views/order/my_orders.php';
	}
	
	public function detail(){
		Utils::isIdentity();
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			// New order
			$order = new order();
			$order->setId($id);
			$order = $order->getOne();
			
			$order_products = new order();
			$products = $order_products->getProductsByorder($id);
			
			require_once 'views/order/detail.php';
		}else{
			header('Location:'.base_url.'order/my_orders');
		}
	}
	
	public function manage(){
		Utils::isAdmin();
		$gestion = true;
		
		$order = new order();
		$orders = $order->getAll();
		
		require_once 'views/order/my_orders.php';
	}
	
	public function status(){
		Utils::isAdmin();
		if(isset($_POST['order_id']) && isset($_POST['status'])){
			// Collect data form
			$id = $_POST['order_id'];
			$status = $_POST['status'];
			
			// Upadate the order
			$order = new order();
			$order->setId($id);
			$order->setstatus($status);
			$order->edit();
			
			header("Location:".base_url.'order/detail&id='.$id);
		}else{
			header("Location:".base_url);
		}
	}
	
	
}