<?php
require_once 'models/product.php';

class productController{
	
	public function index(){
		$product = new Product();
		$products = $product->getRandom(6);
	
		// render view
		require_once 'views/product/feature.php'; 
	}
	
	public function ver(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		
			$product = new Product();
			$product->setId($id);
			
			$product = $product->getOne();
			
		}
		require_once 'views/product/ver.php';
	}
	
	public function manage(){
		Utils::isAdmin();
		
		$product = new Product();
		$products = $product->getAll();
		
		require_once 'views/product/manage.php';
	}
	
	public function crear(){
		Utils::isAdmin();
		require_once 'views/product/crear.php';
	}
	
	public function save(){
		Utils::isAdmin();
		if(isset($_POST)){
			$name = isset($_POST['name']) ? $_POST['name'] : false;
			$description = isset($_POST['description']) ? $_POST['description'] : false;
			$Price = isset($_POST['Price']) ? $_POST['Price'] : false;
			$stock = isset($_POST['stock']) ? $_POST['stock'] : false;
			$category = isset($_POST['category']) ? $_POST['category'] : false;
			// $image = isset($_POST['image']) ? $_POST['image'] : false;
			
			if($name && $description && $Price && $stock && $category){
				$product = new product();
				$product->setName($name);
				$product->setDescription($description);
				$product->setPrice($Price);
				$product->setStock($stock);
				$product->setCategory_id($category);
				
				// Save the image
				if(isset($_FILES['image'])){
					$file = $_FILES['image'];
					$filename = $file['name'];
					$mimetype = $file['type'];

					if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){

						if(!is_dir('uploads/images')){
							mkdir('uploads/images', 0777, true);
						}

						$product->setImage($filename);
						move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
					}
				}
				
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$product->setId($id);
					
					$save = $product->edit();
				}else{
					$save = $product->save();
				}
				
				if($save){
					$_SESSION['product'] = "complete";
				}else{
					$_SESSION['product'] = "failed";
				}
			}else{
				$_SESSION['product'] = "failed";
			}
		}else{
			$_SESSION['product'] = "failed";
		}
		header('Location:'.base_url.'product/manage');
	}
	
	public function editar(){
		Utils::isAdmin();
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$edit = true;
			
			$product = new Product();
			$product->setId($id);
			
			$pro = $product->getOne();
			
			require_once 'views/product/crear.php';
			
		}else{
			header('Location:'.base_url.'product/manage');
		}
	}
	
	public function eliminar(){
		Utils::isAdmin();
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$product = new Product();
			$product->setId($id);
			
			$delete = $product->delete();
			if($delete){
				$_SESSION['delete'] = 'complete';
			}else{
				$_SESSION['delete'] = 'failed';
			}
		}else{
			$_SESSION['delete'] = 'failed';
		}
		
		header('Location:'.base_url.'product/manage');
	}
	
}