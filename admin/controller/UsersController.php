<?php
session_start();
require_once("../../autoload/autoload.php");

class Users extends My_Model
{
    public function __construct()
    {
        parent::__construct();
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

        if (empty($error)) {
            # code...
            $user = parent::fetchwhere('user','id = '.$id);


            foreach($user as $value)
            {
                $email = $value['email'];
            }
            if($email == $admin['email'])
            {

                $where = array('id'=>$id);
                parent::update('user',$admin,$where);
                $_SESSION['success'] = "Edit successful.";
                rdr_url("../views/users/index.php");

            }else
            {
                $where = "email = '".$admin['email']."' ";
                $data = parent::fetchwhere('user',$where);
                if(empty($data))
                {
                    $where = array('id'=>$id);
                    parent::update('user',$admin,$where);
                    $_SESSION['success'] = "Users successful.";
                    rdr_url("../views/users/index.php");

                }
                else
                {
                    $_SESSION['error'] = "Users email already exists.";
                    rdr_url("../views/users/index.php?action=add");
                }

            }
        }else{
            //rdr_url("../views/admin/index.php?action=edit&id".$id);
        }


    }

    public function deleteUsers($data)
    {
        if (isset($_GET['id'])) {
            # code...
            $id = $_GET['id'];
            settype ($id, "int");
            $this->_del($id);
        }else{
            $_SESSION['error'] = "Users does not exist";
            rdr_url("../views/users/index.php");
        }

    }

    public function _del($id,$rediect = true)
    {

        $data = parent::fetchid('user',$id);
        if(!empty($data))
        {
            parent::delete('user',$id);
            $_SESSION['success'] = "Users has been deleted.";
            rdr_url("../views/users/index.php");

        }
        else
        {
            $_SESSION['error'] = "Users does not exist";

        }
    }
    // end class
}

$actionUsers = new Users();
switch($_REQUEST['action']){
    case 'edit':
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $actionUsers ->actionEdit($_REQUEST,$_FILES);
        }
        break;
    case 'delete':
        if($_SERVER['REQUEST_METHOD']=='GET')
        {
            $actionUsers ->deleteUsers($_REQUEST);
        }
        break;
    default:

        break;
}

?>