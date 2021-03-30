<?php
session_start();
require_once("../autoload/autoload.php");
if (!isset($_SESSION['users'])) {
    redirect_to('views/login.php');
}
$db = new My_Model();
$user = $db->fetchwhere('user','id = "'.$_SESSION['users']['id'].'"');

$db = new My_Model();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $errors = array();
    $data = array();
    if(!empty($_POST['name']))
    {
        $data['name'] = $_POST['name'];
    }
    else
    {
        $errors[]= "name";
    }

    if(!empty($_POST['address']))
    {
        $data['address'] = $_POST['address'];

    }
    else
    {
        $errors[] = "address";

    }

    if(!empty($_POST['phone']))
    {
        $data['phone'] = trim($_POST['phone']);
    }
    else
    {
        $errors[]= "phone";
    }

    if(empty($errors))
    {
        if($db->update('user', $data, array("id" => $_SESSION['users']['id']))){
            $_SESSION['success'] = "Edit information successfully.";
            redirect_to('views/member-information.php');
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
        <div class="wrap"><a href="index.php">Home</a><span class="label"> &gt; </span>Edit member information</div>
    </div>
    <div id="inner">
        <div id="content-sidebar-wrap">
            <!--  div menu-js -->
            <?php  require_once __DIR__."/teamplate/menu-js.php"; ?>
            <!-- End div menu-js  -->
            <div id="content" class="hfeed">
                <div class="post-178485 page type-page status-publish hentry entry">
                    <h1 class="entry-title">Edit member information</h1>


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
                                    <span class="labelx label-default">Name :</span>
                                </div>
                                <div class="inputs">
                                    <input type="text" value="<?php echo $user[0]['name'] ?>"  name="name" size="40">
                                    <?php
                                    if(isset($errors) && in_array('name',$errors))
                                    {
                                        echo"<br><span class='warning mgl-255' >Please enter your name</span>";
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="register">
                                <div class="labels">
                                    <span class="labelx label-default"> Email :</span>
                                </div>
                                <div class="inputs">
                                    <input type="text" name="email" value="<?php echo $user[0]['email'] ?>" size="40" disabled>
                                    <?php
                                    if(isset($errors) && in_array('email',$errors))
                                    {
                                        echo"<br><span class='warning mgl-255' >Please enter your email.</span>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="register">
                                <div class="labels">
                                    <span class="labelx label-default">Phone:</span>
                                </div>
                                <div class="inputs">
                                    <input type="text" name="phone" value="<?php echo "0". $user[0]['phone'] ?>" size="40">
                                    <?php
                                    if(isset($errors) && in_array('phone',$errors))
                                    {
                                        echo"<br><span class='warning mgl-255' >Enter phone number must not be blank.</span>";
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="register">
                                <div class="labels">
                                    <span class="labelx label-default"> Address :</span>
                                </div>
                                <div class="inputs">
                                    <input type="text" value="<?php echo $user[0]['address'] ?> " name="address" size="40">

                                    <?php
                                    if(isset($errors) && in_array('address',$errors))
                                    {
                                        echo"<br><span class='warning mgl-255' >Enter an address must not be blank.</span>";
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
