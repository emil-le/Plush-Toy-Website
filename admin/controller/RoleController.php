<?php
session_start();
require_once("../../autoload/autoload.php");

class Role extends My_Model
{
    public $db;
    public function __construct()
    {
        parent::__construct();
    }

    public function actionAdd($data, $file)
    {
        $roles = array();
        $roles['name'] = $data['name'];
        $roles['description'] = $data['description'];
        $roles['permission'] = implode(',', $data['permission']);
        parent::insert('roles', $roles);
        $_SESSION['success'] = "Add successfully roles.";
        rdr_url("../views/roles/index.php");
    }

    public function actionEdit($data,$file)
    {
        $id = $data['id'];
        $roles = array();
        $roles['name'] = $data['name'];
        $roles['description'] = $data['description'];
        $roles['permission'] = implode(',', $data['permission']);
        parent:: update('roles',$roles ,array("id" => $id));
        $_SESSION['success'] = "Add successfully roles.";
        rdr_url("../views/roles/index.php");
    }

    public function deleteRole($data)
    {
        if (isset($_GET['id'])) {
            # code...
            $id = $_GET['id'];
            settype ($id, "int");
            $this->_del($id);
        }else{
            $_SESSION['error'] = "Roles does not exist";
            rdr_url("../views/roles/index.php");
        }
    }

    public function _del($id, $rediect = true)
    {
        $data = parent::fetchid('roles', $id);
        if(!$data)
        {
            $_SESSION['error'] = "Roles does not exist";
            if($rediect){
                rdr_url("../views/roles/index.php");
            }else{
                return false;
            }
        }

        parent::delete('roles', $id);
        $_SESSION['success'] = "The roles has been deleted.";
        rdr_url("../views/roles/index.php");

    }
}

$role = new Role();
switch($_REQUEST['action']){
    case 'add':
        if($_SERVER['REQUEST_METHOD']=='POST')
        {

            $role->actionAdd($_REQUEST,$_FILES);
        }
        break;
    case 'edit':
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $role->actionEdit($_REQUEST,$_FILES);
        }
        break;
    case 'delete':
        if($_SERVER['REQUEST_METHOD']=='GET')
        {
            $role->deleteRole($_REQUEST);
        }
        break;
    default:

        break;
}