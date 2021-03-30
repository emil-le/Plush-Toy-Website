<?php
session_start();
    require_once("../../autoload/autoload.php");

    class Order extends My_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function delete($data)
        {
            if (isset($_GET['id'])) {
                # code...
                $id = $_GET['id'];
                settype ($id, "int");
                $this->_del($id);
            }else{
                $_SESSION['error'] = "Product does not exist";
                rdr_url("../views/product/index.php"); 
            }
            
        }

        public function deleteall($data)
        {
            $ids = $_POST['ids'];
            foreach ($ids as  $id) {
                # code...
                $this-> _del($id);
                }
        }


        public function _del($id,$rediect = true)
        {

            $data = parent::fetchid('ordere',$id);
            if(!$data)
            {
                
                $_SESSION['error'] = "Order does not exist";
                if($rediect){
                    rdr_url("../views/order/index.php");
                }else{
                    return false;
                }
            }
                
            parent::delete('ordere',$id);

           

            $_SESSION['success'] = "The order has been deleted.";
            rdr_url("../views/order/index.php"); 
           
        }
    }

   $actionOrder = new Order();
    switch($_REQUEST['action']){
        case 'delete':
            if($_SERVER['REQUEST_METHOD']=='GET')
            {
                $actionOrder ->delete($_REQUEST);
            }
            break;
        default:
           rdr_url("../views/order/index.php"); 
            break;

    }


?>