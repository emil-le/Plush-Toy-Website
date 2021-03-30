<?php
session_start();
    require_once("../../autoload/autoload.php");

    class Product extends My_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function actionAdd($data,$file)
        {
            $error = array();
            $product = array();

            if(isset($data['name']) && !empty($data['name']))
            {
                $product['name'] = testInputString($data['name']);
            }
            else
            {
                $error[] ="name";
            }

            if(isset($data['title']) && !empty($data['title']))
            {
                $product['slug'] = testInputString($data['title']);
            }
            elseif(empty($data['title']))
            {
                $product['slug'] = safe_title(testInputString($data['name']));
            }

            if(isset($data['price']) && !empty($data['price']))
            {
                $product['price'] = testInputString($data['price']);
            }
            else
            {
                $error[] ="price";
            }


            if(isset($data['hot']) && !empty($data['hot']))
            {
                $product['hot'] = testInputString($data['hot']);
            }
            else
            {
                $product['hot'] = 0;
            }


            if(isset($data['sale']) && !empty($data['sale']))
            {
                $product['sale'] = testInputString($data['sale']);
            }
            else
            {
                $product['sale'] = 0;
            } 


            if(isset($data['qty']) && !empty($data['qty']))
            {
                $product['qty'] = testInputString($data['qty']);
            }
            else
            {
                $error[] ="qty";
            }

            if(isset($data['parent_id']) && !empty($data['parent_id']))
            {
                $product['category_id'] = testInputString($data['parent_id']);
            }
            else
            {
                $error[] ="parent_id";
            }


            if(isset($data['status']) && !empty($data['status']))
            {
                $product['status'] = testInputString($data['status']);
            }
            else
            {
                $error[] ="status";
            }

            if (!empty($_FILES['image']['name'])) {
                 # code...
                $product['thunbar'] =  uploadImage($file,'product','add');
             }else{
                $product['thunbar'] =  '';
             }

            $product['content'] = isset($data['content']) ? $data['content'] : NULL;

           if (empty($error)) {

                parent::insert('product', $product);

                $_SESSION['success'] = "Add successfully";
                rdr_url("../views/product/index.php");
          
           }else{

                $_SESSION['error'] = "You need to enter all the fields marked (*).";
                rdr_url("../views/product/add.php");
           }
        }

        public function actionEdit($data,$file)
        {
            $error = array();
            $product = array();

            if(isset($data['name']) && !empty($data['name']))
            {
                $product['name'] = testInputString($data['name']);
            }
            else
            {
                $error[] ="name";
            }

            if(isset($data['title']) && !empty($data['title']))
            {
                $product['slug'] = testInputString($data['title']);
            }
            elseif(empty($data['title']))
            {
                $product['slug'] = safe_title(testInputString($data['name']));
            }

            if(isset($data['price']) && !empty($data['price']))
            {
                $product['price'] = testInputString($data['price']);
            }
            else
            {
                $error[] ="price";
            }


            if(isset($data['hot']) && !empty($data['hot']))
            {
                $product['hot'] = testInputString($data['hot']);
            }
            else
            {
                $product['hot'] = 0;
            }


            if(isset($data['sale']) && !empty($data['sale']))
            {
                $product['sale'] = testInputString($data['sale']);
            }
            else
            {
                $product['sale'] = 0;
            }


            if(isset($data['qty']) && !empty($data['qty']))
            {
                $product['qty'] = testInputString($data['qty']);
            }
            else
            {
                $error[] ="qty";
            }

            if(isset($data['parent_id']) && !empty($data['parent_id']))
            {
                $product['category_id'] = testInputString($data['parent_id']);
            }
            else
            {
                $error[] ="parent_id";
            }


            if(isset($data['status']) && !empty($data['status']))
            {
                $product['status'] = testInputString($data['status']);
            }
            else
            {
                $error[] ="status";
            }

            $product['content'] = isset($data['content']) ? $data['content'] : NULL;
            
            if (!empty($file['image']['name'])) {
                 # code...
                $product['thunbar'] =  uploadImage($file,'product','edit');
            }

            $id = $data['id'];

            if (empty($error)) 
            {
                # code...
                parent:: update('product',$product ,array("id" => $id));
                $_SESSION['success'] = "Successfully edit the product.";
                rdr_url("../views/product/index.php"); 
            }
            else
            {
                $_SESSION['error'] = "You need to enter all the fields marked (*).";
                rdr_url("../views/product/index.php?action=edit&{$id}");
            }


        }

        public function deleteProduct($data)
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
        public function _del($id,$rediect = true)
        {

            $data = parent::fetchid('product',$id);
            if(!$data)
            {
                $_SESSION['error'] = "Product does not exist";
                if($rediect){
                    rdr_url("../views/product/index.php");
                }else{
                    return false;
                }
            }
                
            parent::delete('product', $id);

            foreach ($data as $key => $value) {
                # code...
                $link_img = url().'upload/product/'.$value['thunbar'];
            }
            if(file_exists($link_img))
            {
                unlink($link_img);
            }
            $_SESSION['success'] = "The product has been deleted.";
            rdr_url("../views/product/index.php"); 
           
        }

    }

   $actionProduct = new Product();
    switch($_REQUEST['action']){
        case 'add':
            if($_SERVER['REQUEST_METHOD']=='POST')
                {
                   
                    $actionProduct ->actionAdd($_REQUEST,$_FILES);
                }
        break;
        case 'edit':
            if($_SERVER['REQUEST_METHOD']=='POST')
                {
                    
                    $actionProduct ->actionEdit($_REQUEST,$_FILES);
                }  
            break;
        case 'delete':
                if($_SERVER['REQUEST_METHOD']=='GET')
                {
                    $actionProduct ->deleteProduct($_REQUEST);
                } 
            break;
        default:
            break;

    }


?>