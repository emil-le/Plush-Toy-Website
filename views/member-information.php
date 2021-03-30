<?php
session_start();
require_once("../autoload/autoload.php");
if (!isset($_SESSION['users'])) {
    redirect_to('views/login.php');
}
$db = new My_Model();
$user = $db->fetchwhere('user','id = "'.$_SESSION['users']['id'].'"');
?>
<!DOCTYPE html >
<html  lang="vi" xml:lang="vi">
<?php  require_once __DIR__."/teamplate/head.php"; ?>
<body class="single single-products postid-193659 header-image content-sidebar">
<div id="wrap">
    <!-- div  content-before-header -->
    <?php  require_once __DIR__."/teamplate/content-before-header.php"; ?>
    <!--  End content-before-header -->

    <!--  div header -->
    <?php  require_once __DIR__."/teamplate/header.php"; ?>
    <!-- End div header -->
    <div class="breadcrumb">
        <div class="wrap"><a href="index.php">Home</a><span class="label"> &gt; </span>User information</div>
    </div>
    <div id="inner">
        <div id="content-sidebar-wrap">
            <!--  div menu-js -->
            <?php  require_once __DIR__."/teamplate/menu-js.php"; ?>
            <!-- End div menu-js  -->
            <div id="content" class="hfeed">
                <div class="post-178485 page type-page status-publish hentry entry">
                    <h1 class="entry-title">User information</h1>
                </div>
                <div id="product-seen">
                    <?php
                    if(isset($_SESSION['success']))
                    {
                        echo "<h1 class ='success'> ".$_SESSION['success']."</h1>";
                        unset($_SESSION['success']);

                    }


                    if(isset($_SESSION['error']))
                    {
                        echo "<h1 class='error'> ".$_SESSION['error']."</h1>";
                        unset($_SESSION['error']);

                    }
                    ?>
                    <table style="width: 100%" class="info-user">
                        <tbody>
                        <tr>
                            <td>Name : </td>
                            <td> <?php echo $user[0]['name'] ?> </td>
                        </tr>
                        <tr>
                            <td>Email : </td>
                            <td> <?php echo $user[0]['email'] ?> </td>
                        </tr>
                        <tr>
                            <td>Phone : </td>
                            <td> <?php echo "0".$user[0]['phone'] ?> </td>
                        </tr>

                        <tr>
                            <td>Address : </td>
                            <td> <?php echo $user[0]['address'] ?> </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- div sidebar -->
            <?php  require_once __DIR__."/teamplate/sidebar-info-user.php"; ?>
            <!--  end  div sidebar -->
        </div>
    </div>
    <!--  div footer  -->
    <?php  require_once __DIR__."/teamplate/footer.php"; ?>
    <!--  End div footer  -->
</div>
</body>
</html>
