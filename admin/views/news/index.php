<?php
session_start();
require_once("../../../autoload/autoload.php");
if(isset($_SESSION['id_admin']) && isset($_SESSION['role_id'])) //lấy thông tin id và quyền của user
{
    $id = $_SESSION['id_admin'] ;
    $role_id= $_SESSION['role_id'];
}

checkLogin($id,$role_id); //Kiểm tra id và quyền, logic là khi đăng nhập nó sẽ lưu id và roles vào session, khi click sang trang khác nó sẽ kiểm tra là được phép truy cập hay không
$permission = explode(',', $_SESSION['permission']);
if (!in_array('list-news', $permission) && !in_array('all', $permission)) {
    redirect_to('admin/views/errors.php'); // nếu không sẽ trả về trang errors
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("../../teamplate/head.php"); ?>
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php require_once("../../teamplate/sidebar.php"); ?>
        <!-- top navigation -->
        <?php require_once("../../teamplate/top.php"); ?>
        <!-- /top navigation -->
        <!-- page content -->
        <?php
        if(isset($_GET['action'])) //Kiểm tra có action trên url hay k
        {
            $action = $_GET['action']; //lấy value của action
            switch ($action) { //kiểm tra value của nó, nếu trùng case thì chạy
                case 'add':
                    # code...
                    include_once("add.php");
                    break;

                case 'edit':
                    # code...
                    include_once("edit.php");
                    break;

                default:
                    # code...
                    include_once("view.php");
                    break;
            }
        }else
        {
            include_once("view.php");
        }
        ?>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <?php require_once("../../teamplate/footer.php"); ?>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<?php require_once("../../teamplate/link_jquery.php"); ?>
</body>
</html>