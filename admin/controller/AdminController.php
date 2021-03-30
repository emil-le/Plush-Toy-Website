<?php
session_start();
    require_once("../../autoload/autoload.php");

    class Admin extends My_Model
    {
        public function __construct()
        {
            parent::__construct();
        }


        public function actionAdd($data,$file)
        {
            $error = array();
            $admin = array();

            if(testInputString($data['name']))
            {
                $admin['name'] = testInputString($data['name']);
            }
            else
            {
                $error[] ="name";
            }

            if(testInputString($data['email']))
            {
                $admin['email'] = testInputString($data['email']);
            }
            else
            {
                $error[] ="email";
            }

            if(!testInputString($data['password']))
            {
               $error[] ="password";
            }

            if(!testInputString($data['password2']))
            {
               $error[] ="password2";
            }

            if($data['password'] == $data['password2'] )
            {
                $admin['password'] = md5(testInputString($data['password2']));
            }
            else
            {

                $_SESSION['error'] = "The password you entered does not match.";
                rdr_url("../views/admin/index.php?action=add");
                $error[] ="password";

            }

            if(testInputString($data['phone']))
            {
                $admin['phone'] = testInputString($data['phone']);
            }
            else
            {
                $error[] ="phone";
            }

            if(testInputString($data['address']))
            {
                $admin['address'] = testInputString($data['address']);
            }
            else
            {
                $error[] ="address";
            } 


            if(testInputString($data['roles_id']))
            {
                $admin['role_id'] = testInputString($data['roles_id']);
            }
            else
            {
                $error[] ="roles_id";
            }

            if(testInputString($data['status']))
            {
                $admin['status'] = testInputString($data['status']);
            }
            else
            {
                $error[] ="status";
            }
             
            $admin['avata'] =  uploadImage($file,'admin');


            
           if (empty($error)) {
               # code...
                $where = "email = '".$admin['email']."' ";
                $data = parent::fetchwhere('admin',$where);
                if(empty($data))
                {
                    parent::insert('admin',$admin);
                    $_SESSION['success'] = "Insert succeeded.";
                    rdr_url("../views/admin/index.php");

                }
                else
                {
                      $_SESSION['error'] = "Admin email already exists.";
                      rdr_url("../views/admin/index.php?action=add");
                }
           }
        }

        public function actionEdit($data,$file){
            $id = $data['id'];
            $error = array();
            $admin = array();

            if(testInputString($data['name']))
            {
                $admin['name'] = testInputString($data['name']);
            }
            else
            {
                $error[] ="name";
            }

            if(testInputString($data['email']))
            {
                $admin['email'] = testInputString($data['email']);
            }
            else
            {
                $error[] ="email";
            }


            if(testInputString($data['phone']))
            {
                $admin['phone'] = testInputString($data['phone']);
            }
            else
            {
                $error[] ="phone";
            }

            if(testInputString($data['address']))
            {
                $admin['address'] = testInputString($data['address']);
            }
            else
            {
                $error[] ="address";
            } 


            if(testInputString($data['roles_id']))
            {
                $admin['role_id'] = testInputString($data['roles_id']);
            }
            else
            {
                $error[] ="roles_id";
            }

            if(testInputString($data['status']))
            {
                $admin['status'] = testInputString($data['status']);
            }
            else
            {
                $error[] ="status";
            }
             
            if (!empty($file['image']['name'])) {
                 # code...
                $admin['avata'] =  uploadImage($file,'admin','edit');
             }


           if (empty($error)) {
               # code...
                $user = parent::fetchwhere('admin','id = '.$id);
                

                foreach($user as $value)
                {
                    $email = $value['email'];
                }
                if($email == $admin['email'])
                {

                    $where = array('id'=>$id);
                    parent::update('admin',$admin,$where);
                    $_SESSION['success'] = "Edit successful.";
                    rdr_url("../views/admin/index.php");

                }else
                {
                    $where = "email = '".$admin['email']."' ";
                    $data = parent::fetchwhere('admin',$where);
                    if(empty($data))
                    {
                        $where = array('id'=>$id);
                        parent::update('admin',$admin,$where);
                        $_SESSION['success'] = "Edit successful.";
                        rdr_url("../views/admin/index.php");

                    }
                    else
                    {
                          $_SESSION['error'] = "Admin email already exists.";
                          rdr_url("../views/admin/index.php?action=add");
                    }

                }
            }else{
                //rdr_url("../views/admin/index.php?action=edit&id".$id);
            }
           
           
        }

        public function deleteAdmin($data)
        {
            if (isset($_GET['id'])) {
                # code...
                $id = $_GET['id'];
                settype ($id, "int");
                $this->_del($id);
            }else{
                $_SESSION['error'] = "Admin does not exist";
                rdr_url("../views/admin/index.php"); 
            }
            
        }

        
        public function _del($id,$rediect = true)
        {

            $data = parent::fetchid('admin',$id);
            if(!empty($data))
            {
                parent::delete('admin',$id);
                $_SESSION['success'] = "Admin has been deleted.";
                rdr_url("../views/admin/index.php"); 
                
            }
            else
            {
                $_SESSION['error'] = "Admin does not exist";
                
            }
        }
        // end class
    }

   $actionAdmin = new Admin();
    switch($_REQUEST['action']){
        case 'add':
            if($_SERVER['REQUEST_METHOD']=='POST')
                {
                    $actionAdmin ->actionAdd($_REQUEST,$_FILES);
                }
        break;
        case 'edit':
            if($_SERVER['REQUEST_METHOD']=='POST')
                {
                    $actionAdmin ->actionEdit($_REQUEST,$_FILES);
                }  
            break;
        case 'delete':
                if($_SERVER['REQUEST_METHOD']=='GET')
                {
                    $actionAdmin ->deleteAdmin($_REQUEST);
                } 
            break;
        default:
           
            break;
    }

?>