<?php
session_start();
	require_once("../../autoload/autoload.php");
	class Cate
	{
		public $db;
		public function __construct()
		{
			$this->db = new My_Model();

		}

		public function actionAdd($data)
		{

			$error = array();
			$category = array();
			if(testInputString($data['name']))
			{
				$category['name'] = testInputString($data['name']);
			}
			else
			{
				$error[] ="name";
			}

			if(testInputString($data['title']))
			{
				$category['title'] = safe_title(testInputString($data['title']));
			}
			else
			{
				$category['title'] = safe_title(testInputString($data['name']));
			}

			if(testInputString($data['sort_order']))
			{
				$category['sort_order'] = testInputString($data['sort_order']);
			}
			else
			{
				$error[] ="sort_order";
			}
			
			$category['parent_id'] = $data['parent_id'];
			$category['status'] = $data['status'];
			
			
			$category['created_at'] = get_date();
			if (empty($error)) {
				# code...
				$data_cate = $this->db->fetchwhere("category","name = '".$category['name']."' ");
				if (empty($data_cate)) 
				{
					# code...
					$this->db->insert('category',$category);
					$_SESSION['success'] = "Add successfully catalog.";
					rdr_url("../views/category/index.php");

				}
				else
				{
					$_SESSION['error'] = "Category already exists (*).";
					rdr_url("../views/category/index.php?action=add");
				}	
			}
			else
			{
				$_SESSION['error'] = "You need to enter all the fields marked (*).";
				rdr_url("../views/category/index.php?action=add");
			}
		}

		// end fuction actionAdd

		public function actionEdit($data)
		{

			$error = array();
			$category = array();
			$id = $data['id'];

			if(testInputString($data['name']))
			{
				$category['name'] = testInputString($data['name']);
			}
			else
			{
				$error[] ="name";
			}

			if(testInputString($data['title']))
			{
				$category['title'] = testInputString($data['title']);
			}
			else
			{
				$error[] ="title";
			}

			if(testInputString($data['sort_order']))
			{
				$category['sort_order'] = testInputString($data['sort_order']);
			}
			else
			{
				$error[] ="sort_order";
			}
			$category['parent_id'] = $data['parent_id'];
			$category['status'] = $data['status'];
			
			
			$category['created_at'] = get_date();
			if (empty($error)) 
			{
				# code...
				$this->db->update('category',$category,array("id" => $id));
				$_SESSION['success'] = "Successfully edited catalog";
				rdr_url("../views/category/index.php");	
			}
			else
			{
				$_SESSION['error'] = "You need to enter all the fields marked (*).";
				rdr_url("../views/category/index.php?action=edit&{$id}");
			}
		}


		public function deleteCate($data)
		{
			if (isset($_GET['id'])) {
				# code...
				$id = $_GET['id'];
				settype ($id, "int");
				$this->_del($id);
			}else{
				$_SESSION['error'] = "Category does not exist";
				rdr_url("../views/category/index.php");	
			}
			
		}
		public function _del($id,$rediect = true)
		{
			$where = 'parent_id = '.$id;
			$data = $this->db->fetchwhere('category',$where);
			
			if(empty($data))
			{
				$this->db->delete('category',$id);
				$_SESSION['success'] = "Category has been deleted.";
				rdr_url("../views/category/index.php");	
				
			}
			else
			{
				$_SESSION['error'] = "A subcategory exists that cannot be deleted. You need to delete subcategories and products from the previous category";
				rdr_url("../views/category/index.php");	
			}
		}


	}

	$actionCate = new Cate();
	switch($_REQUEST['action']){
		case 'add':
      		if($_SERVER['REQUEST_METHOD']=='POST')
				{
					$actionCate ->actionAdd($_REQUEST);
				}
        break;
	    case 'edit':
	    	if($_SERVER['REQUEST_METHOD']=='POST')
				{
					$actionCate ->actionEdit($_REQUEST);
				}  
	        break;
	    case 'delete':
	        	if($_SERVER['REQUEST_METHOD']=='GET')
				{
					$actionCate ->deleteCate($_REQUEST);
				} 
	        break;
	    default:
	       
	        break;

	}
		
 ?>