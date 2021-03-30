<?php
session_start();
require_once("../autoload/autoload.php");

$db = new My_Model();
if(validate_id($_GET['id']))
{
	$id = validate_id($_GET['id']);
}

if(isset($_GET['action']))
{
	$action = $_GET['action'];
}

$url = (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];

switch ($action) {

	case 'addtocart':
		if (!isset($_SESSION['users'])) {
			$_SESSION['login_or_signUp'] = "You need to register an account to make an order.";
			if (isset($_SESSION['current_url'])) {
				$url = $_SESSION['current_url'];
			}
			header("Location: $url");
			exit();
		}
		if(isset($id)){
			$product = $db->fetchwhere('product','id = '.$id);

			$where = 'id = '.$id.'  AND qty =  0 ';
			$qty = $db->fetchwhere('product',$where);

			if(!empty($qty))
			{
				$_SESSION['error'] ="Sorry. The expired product cannot be added to the cart";
				rdr_url('../views/cart.php');
				die;
			}

			if(isset($_SESSION['cart'][$id]))
			{
				foreach($product as $value){
					$product_id 	= $id;
					$qty 			= $_SESSION['cart'][$id]['qty'] + 1;
					$name 			= $value['name'];
					$image 			= $value['thunbar'];
					$price 			= ($value['sale'] > 0)?($value['price'] *(100 - $value['sale']))/100 :$value['price'];
					$amount			= $qty * $price;

				}

			}else{
				foreach($product as $value){

					$product_id 	= $value['id'];
					$qty 			= 1;
					$name 			= $value['name'];
					$image 			= $value['thunbar'];
					$price 			= ($value['sale'] > 0)?($value['price'] *(100 - $value['sale']))/100 :$value['price'];
					$amount			= $qty * $price;

				}

			}
		}else
		{
			rdr_url('../index.php');
		}

		$_SESSION['cart'][$id]['product_id'] = $product_id;
		$_SESSION['cart'][$id]['qty'] = $qty;
		$_SESSION['cart'][$id]['name'] = $name;
		$_SESSION['cart'][$id]['price'] = $price;
		$_SESSION['cart'][$id]['image'] = $image;
		$_SESSION['cart'][$id]['amount'] = $amount;
		rdr_url('../views/cart.php');
		break;

	case 'delete-cart':
		# code...
		unset($_SESSION['cart'][$id]);
		rdr_url('../views/cart.php');

		break;

	case 'update_cart':
		# code...
		$id = $_GET['key'];
		$num = $_GET['qty'];


		$where = 'id = '.$id;
		$qty = $db->fetchwhere('product',$where);

		if(intval($qty[0]['qty']) < intval($num))
		{
			$_SESSION['error'] ="Sorry. The expired product cannot be added to the cart";
			rdr_url('../views/cart.php');
			die;
		}

		if(isset($_SESSION['cart'][$id]))
		{
			$_SESSION['cart'][$id]['qty'] =  intval($num);
			$_SESSION['cart'][$id]['amount'] = $_SESSION['cart'][$id]['price'] * $num;
		}
		rdr_url('../views/cart.php');
		break;
}
?>
