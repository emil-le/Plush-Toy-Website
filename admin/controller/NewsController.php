<?php
session_start();
    require_once("../../autoload/autoload.php");

    class News {

        public $db;
        public function __construct(){
            $this->db = new My_Model();
        }


        public function actionAdd($data,$file) //Thêm news
        {
            $error = array();

            $news = array();

            if(testInputString($data['title']))
            {
                $news['title'] = testInputString($data['title']);
            }
            else
            {
                $error[] ="title";
            }


            if(testInputString($data['intro']))
            {
                $news['intro'] = testInputString($data['intro']);
            }
            else
            {
                $error[] ="intro";
            }

            if(!empty($data['content']))
            {
                $news['content'] = trim($data['content']);
            }
            else
            {
                $error[] ="content";
            }

            if(testInputString($data['status']))
            {
                $news['status'] = testInputString($data['status']);
            }
            else
            {
                $error[] ="status";
            }
             if ($file) {
                 # code...
                $news['image_link'] =  uploadImage($file,'news','add');
             }else{
                $news['image_link'] =  ' ';
             }

             if(empty($error)){

                if($this->db->insert('news',$news))
                {
                    $_SESSION['success'] = "Add successfully.";
                    rdr_url("../views/news/index.php");
                }
             }else{

                $_SESSION['error'] = "You need to enter all the fields marked (*).";
                rdr_url("../views/news/add.php");
           }

             

        }

        public function actionEdit($data,$file)// Sửa news
        {
            $id = $data['id'];


            $error = array();

            $news = array();

            if(testInputString($data['title']))
            {
                $news['title'] = testInputString($data['title']);
            }
            else
            {
                $error[] ="title";
            }


            if(testInputString($data['intro']))
            {
                $news['intro'] = testInputString($data['intro']);
            }
            else
            {
                $error[] ="intro";
            }

            if(!empty($data['content']))
            {
                $news['content'] = trim($data['content']);
            }
            else
            {
                $error[] ="content";
            }



            if(testInputString($data['status']))
            {
                $news['status'] = testInputString($data['status']);
            }
            else
            {
                $error[] ="status";
            }
             
            if (!empty($file['image']['name'])) {
                 # code...
                $news['image_link'] =  uploadImage($file,'news','edit');
            }


             if(empty($error)){

                if($this->db->update('news', $news , array("id" => $id)))
                {
                    $_SESSION['success'] = "Edit successful.";
                    rdr_url("../views/news/index.php");
                } else {
                    $_SESSION['error'] = "You need to fill out the fields with stars.";
                    rdr_url("../views/news/add.php");
                 }
             }else{

                $_SESSION['error'] = "You need to fill out the fields with stars.";
                rdr_url("../views/news/add.php");
           }


        }


        public function deleteNew($data) //Xóa news
        {
            if (isset($_GET['id'])) {
                # code...
                $id = $_GET['id'];
                settype ($id, "int");
                $this->_del($id);
            }else{
                $_SESSION['error'] = "News does not exist";
                rdr_url("../views/news/index.php"); 
            }
            
        }

        public function deleteall($data) //Xóa nhiều news 1 lúc
        {
            $ids = $_POST['ids'];
            foreach ($ids as  $id) {
                # code...
                $this-> _del($id);
                }
        }
            


        public function _del($id, $rediect = true) //Hủy class
        {

            $data = parent::fetchid('news',$id);
            if(!$data)
            {
                
                $_SESSION['error'] = "News does not exist";
                if($rediect){
                    rdr_url("../views/news/index.php");
                }else{
                    return false;
                }
            }
                
            $this->db->delete('news', $id);

            $_SESSION['success'] = "News has been deleted.";
            rdr_url("../views/news/index.php"); 
           
        }


        // end class
    }


    $actionNews = new News();
    switch($_REQUEST['action']){
        case 'add':
            if($_SERVER['REQUEST_METHOD']=='POST')
                {
                   
                    $actionNews ->actionAdd($_REQUEST,$_FILES);
                    
                }
        break;
        case 'edit':
            if($_SERVER['REQUEST_METHOD']=='POST')
                {
                    
                    $actionNews ->actionEdit($_REQUEST,$_FILES);

                }  
            break;
        case 'delete':
                if($_SERVER['REQUEST_METHOD']=='GET')
                {
                    $actionNews ->deleteNew($_REQUEST);
                } 
            break;
       
    }

?>