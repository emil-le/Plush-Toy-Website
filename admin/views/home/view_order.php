<?php
session_start();
  require_once("../../../autoload/autoload.php");
  if(isset($_SESSION['id_admin']) && isset($_SESSION['role_id']))
    {
      $id = $_SESSION['id_admin'] ;
      $role_id= $_SESSION['role_id'];
    } else {

      redirect_to();
   
    }
    checkLogin($id,$role_id);

    if ( $role_id !=1 &&  $role_id !=2 ) {

      redirect_to();
    }
    
    class Transaction extends My_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function getDataUser($id)
        {
            $where = 'id = '.$id;
            return $data = parent::fetchwhere('transaction',$where);
        }

        public function getDataOrder($id)
        {
            $where = 'transaction_id = '.$id;
            return $data = parent::fetchwhere('ordere',$where);
        }
    }
    $id = intval($_GET['id']);
    $dataTransaction = new Transaction();
    $dataUser = $dataTransaction->getDataUser($id);
    $dataOrdere = $dataTransaction->getDataOrder($id);
    
    if (empty($dataUser) || empty($dataOrdere)) {
        $_SESSION['error'] = "Order does not exist.";
        rdr_url("index.php"); 
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
    <!-- Bootstrap -->
    <link href="../../public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .border-none td {
            font-size: 14px;
            font-weight: 600;
            border-top: none !important;
            border-left: none !important;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <h1 style="text-transform: uppercase; font-size: 70px; text-align: center; color:#F4A460 ">Order</h1>
        <div class="col-md-12">
            <table class="table border-none ">
                <tr>
                    <td width=20%>Name :</td>
                    <td><?php echo $dataUser[0]['name'] ?> </td>
                </tr>
                <tr>
                    <td width=20%>Code order :</td>
                    <td><?php echo $dataUser[0]['id'] ?> </td>
                </tr>
                <tr>
                    <td>Address :</td>
                    <td><?php echo $dataUser[0]['address'] ?> </td>
                </tr>
                <tr>
                    <td>Phone :</td>
                    <td><?php echo $dataUser[0]['phone'] ?> </td>
                </tr>
                <tr>
                    <td>Total money :</td>
                    <td><?php echo number_format($dataUser[0]['amount']) ?>  đ</td>
                </tr>
                <tr>
                    <td>Created :</td>
                    <td><?php echo $dataUser[0]['created_at'] ?> </td>
                </tr>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Total money</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($dataOrdere as $key => $value): ?>
                    <tr>
                        <td><?php echo $key ?> </td>
                        <td><?php echo $value['name'] ?> </td>
                        <td><?php echo number_format($value['price']) ?> $</td>
                        <td><?php echo $value['qty'] ?> </td>
                        <td><?php echo number_format($value['amount']) ?> $</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    (function($)
    {
        $(document).ready(function()
        {
            var main = $('#form');

            // Tabs
            main.contentTabs();

            $('.prints')click(function() {
            $('#print').hide();
        });
        });
    })(jQuery);
</script>
</body>
</html>