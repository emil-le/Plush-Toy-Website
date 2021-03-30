<?php
session_start();
require_once("../autoload/autoload.php");

if (!isset($_SESSION['users'])) {
    redirect_to('views/login.php');
}
$db = new My_Model();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $errors = array();
    $data = array();


    if(empty($_POST['password']))
    {
        $errors[] = "password";
    }
    if(empty($_POST['rpassword']))
    {
        $errors[] = "rpassword";
    }

    if(isset($_POST['password']) && preg_match('/^[\w\'.-]{2,20}$/i',trim($_POST['password'])))
    {
        if($_POST['password'] == $_POST['rpassword'])
        {
            $data['password'] = md5($_POST['rpassword']);
        }
        else
        {
            $errors[] = "password";
        }
    }

    if (empty($_POST['password'])) {
        $errors[] = "password_present";
    } else {
        $password_present = md5($_POST['password_present']);
    }

    if(empty($errors))
    {

        $datas = $db->fetchwhere('user','password = "'.$password_present.'" AND id = ' . $_SESSION['users']['id']);

        if(!empty($datas))
        {
            if($db->update('user', $data,array("id" => $_SESSION['users']['id']))){
                $_SESSION['success'] = "Change password successfully";
                unset($_SESSION['users']);
                redirect_to();
            }
        }else
        {

            $_SESSION['error'] = "The current password is incorrect";
        }
    }
}
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
        <div class="wrap"><a href="index.php">Home</a><span class="label"> &gt; Change password </span> </div>
    </div>
    <div id="inner">
        <div id="content-sidebar-wrap">
            <!--  div menu-js -->
            <?php  require_once __DIR__."/teamplate/menu-js.php"; ?>
            <!-- End div menu-js  -->
            <div id="content" class="hfeed">
                <div class="post-178485 page type-page status-publish hentry entry">
                    <h1 class="entry-title">Change password</h1>


                    <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                        <div class="entry-content">
                            <div class="register">

                                <div class="labels">
                                    <span class="labelx label-default">Current password :</span>
                                </div>
                                <div class="inputs">
                                    <input type="password"  name="password_present" size="40">
                                    <?php
                                    if(isset($errors) && in_array('password_present',$errors))
                                    {
                                        echo"<br><span class='warning mgl-255' >Please enter the current password.</span>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="register">
                                <div class="labels">
                                    <span class="labelx label-default"> Password :</span>
                                </div>
                                <div class="inputs">
                                    <input type="password" name="password" size="40">
                                    <?php
                                    if(isset($errors) && in_array('password',$errors))
                                    {
                                        echo"<br><span class='warning mgl-255' >Password does not match.</span>";
                                    }
                                    ?>
                                </div>
                            </div>


                            <div class="register">
                                <div class="labels">
                                    <span class="labelx label-default">Retype the password:</span>
                                </div>
                                <div class="inputs">
                                    <input type="password" name="rpassword" size="40">
                                    <?php
                                    if(isset($errors) && in_array('password',$errors))
                                    {
                                        echo"<br><span class='warning mgl-255' >Password does not match.</span>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="register">
                                <div class="labels">
                                </div>
                                <div class="inputs">
                                    <p class="submit cart-summary" id="sub">
                                        <input class="button" type="submit" value="Update">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div id="product-seen"></div>
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
