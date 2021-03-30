<?php
session_start();
	require_once("../autoload/autoload.php");

	class Transation extends My_Model{
		public function __construct()
		{
			parent::__construct();
		}


		public function addInfo($data,$sesion)
		{
			$error = array();
			$info = array();

			if(testInputString($data['name']))
            {
                $info['name'] = testInputString($data['name']);
            }
            else
            {
                $error[] ="name";
                rdr_url('../views/payment.php');
                die;
            }


            if(testInputString($data['address']))
            {
                $info['address'] = testInputString($data['address']);
            }
            else
            {
                $error[] ="address";
            }

            if(testInputString($data['phone']))
            {
                $info['phone'] = testInputString($data['phone']);
            }
            else
            {
                $error[] ="phone";
            }


            if(testInputString($data['email']))
            {
                $info['email'] = testInputString($data['email']);
            }
            else
            {
                $error[] ="email";
            }

             if(testInputString($data['message']))
            {
                $info['message'] = testInputString($data['message']);
            }
            
           
            if(empty($error))
            {
            	$sum = 0;
            	foreach($sesion as $value)
            	{
            		$sum = $sum + $value['amount'];
            	}

            	$info['amount'] = $sum;
            	if(parent::insert('transaction',$info))
            	{
            		$where = '1 ORDER BY id DESC LIMIT 0,1';
            		$transaction = parent::fetchwhere('transaction',$where);

            		foreach ($transaction as $key => $value) {
            			# code...
            			$transaction_id = $value['id'];
            		}

            		foreach ($sesion as $key => $value) {
            			# code...
            			$sesion[$key]['transaction_id'] = $transaction_id ;
            			}
            		
                   
        			foreach ($sesion as $key => $value) {
        				# code...
        				if(parent::insert('ordere',$value)){
        					
                            unset($value);
        				}

        			}
                    unset($sesion);
            		$_SESSION['success'] ="Thank you for ordering. We will contact you as soon as possible.";

                    unset($_SESSION['cart']);
            		rdr_url('../views/cart.php');

            	}
            	else
            	{
            		$_SESSION['error'] ="Sorry .Your order has not been successfully placed ";
            		rdr_url('../views/cart.php');

            	}

            }else{
            	$_SESSION['error_info'] = "You need to enter all the fields marked *.";
            	rdr_url('../views/payment.php');
            }

		}
	}

	$info = new Transation();
	if(isset($_SESSION['cart']))
	{
		$data = $info -> addInfo($_REQUEST,$_SESSION['cart']);
	}else
	{
		rdr_url('../index.php');
		
	}
	
 ?>

