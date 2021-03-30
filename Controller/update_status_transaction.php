<?php
session_start();
require_once("../autoload/autoload.php");

class UpdateTransaction  extends My_Model {

    public function __construct(){
        parent::__construct();
    }

    public function updateActive($id) {
        parent::update('transaction', array("active" => 2), array("id" => $id ));

    }
}

$updateTransaction =  new UpdateTransaction();
$id = $_GET['id_transaction'];
$updateTransaction ->updateActive($id);