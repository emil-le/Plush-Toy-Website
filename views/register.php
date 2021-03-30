<?php 
session_start();
    require_once("../autoload/autoload.php");

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
            
            if(empty($_POST['password']))
            {
                $errors[] = "password";
            }
            if(empty($_POST['rpassword']))
            {
                $errors[] = "rpassword";
            }

            if(isset($_POST['email'])&& filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
            {
                $data['email'] = $_POST['email'];
            }
            else
            {
                $errors[] = "email";
            }

            if(!empty($_POST['address']) )
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
               
                $datas = $db->fetchwhere('user','email = "'.$data['email'].'"');
                
                if(empty($datas))
                {
                    if($db->insert('user',$data)){
                        $datas = $db->fetchwhere('user','email = "'.$data['email'].'"');
                        $data = [
                            'id' => $datas[0]['id'],
                            'name_user' => $datas[0]['name'],
                            'email_user' => $datas[0]['email'],
                            'phone_user' => $datas[0]['phone'],
                            'address_user' => $datas[0]['address'],
                        ];
                        $_SESSION['users'] = $data;
                        $_SESSION['success_register'] = "Congratulations on your successful registration";
                        redirect_to();
                    }
                }else
                {

                    $_SESSION['error'] = "Email account already exists";
                }
            }
        }

   
    
?>
<!DOCTYPE html >
<html  lang="vi" xml:lang="vi">
    <?php require_once __DIR__."/../autoload/autoload.php"; ?>
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
               <div class="wrap"><a href="index.php">Home</a><span class="label"> &gt; </span>Sign Up</div>
            </div>
            <div id="inner">
               <div id="content-sidebar-wrap">
                   <!--  div menu-js -->
                        <?php  require_once __DIR__."/teamplate/menu-js.php"; ?>
                    <!-- End div menu-js  -->
                        <div id="content" class="hfeed">
                            <div class="post-178485 page type-page status-publish hentry entry">
                                <h1 class="entry-title">Sign up</h1>

                               
                                <form action="" method="post" accept-charset="utf-8">
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
                                                   <input type="text" class="style-input"  name="name" size="40">
                                                   <?php
                                                        if(isset($errors) && in_array('name',$errors))
                                                        {
                                                            echo"<br><span class='warning' >Please enter your first and last name.</span>";
                                                        }
                                                    ?>
                                            </div>
                                        </div>

                                        <div class="register">
                                          <div class="labels">
                                            <span class="labelx label-default"> Email :</span>
                                          </div>
                                          <div class="inputs">
                                               <input type="text" class="style-input" name="email" size="40">
                                               <?php
                                                    if(isset($errors) && in_array('email',$errors))
                                                    {
                                                        echo"<br><span class='warning' > Please enter your email.</span>";
                                                    }
                                                ?>
                                          </div>
                                        </div>


                                        <div class="register">
                                          <div class="labels">
                                            <span class="labelx label-default">Password :</span>
                                          </div>
                                          <div class="inputs">
                                               <input type="password" class="style-input" name="password" size="40">
                                                <?php
                                                    if(isset($errors) && in_array('password',$errors))
                                                    {
                                                        echo"<br><span class='warning' >Password does not match.</span>";
                                                    }
                                                ?>
                                          </div>
                                        </div> 


                                        <div class="register">
                                          <div class="labels">
                                            <span class="labelx label-default">Retype the password:</span>
                                          </div>
                                          <div class="inputs">
                                               <input type="password" class="style-input" name="rpassword" size="40">
                                               <?php
                                                    if(isset($errors) && in_array('password',$errors))
                                                    {
                                                        echo"<br><span class='warning' >Password does not match.</span>";
                                                    }
                                                ?>
                                          </div>
                                        </div>

                                        <div class="register">
                                          <div class="labels">
                                            <span class="labelx label-default">Phone :</span>
                                          </div>
                                          <div class="inputs">
                                               <input type="text" class="style-input" name="phone" size="40">
                                               <?php
                                                    if(isset($errors) && in_array('phone',$errors))
                                                    {
                                                        echo"<br><span class='warning' >Enter phone number must not be blank.</span>";
                                                    }
                                                ?>
                                          </div>
                                        </div>

                                        <div class="register">
                                          <div class="labels">
                                            <span class="labelx label-default">Address :</span>
                                          </div>
                                          <div class="inputs">
                                               <input type="text" class="style-input" name="address" size="40">

                                               <?php
                                                    if(isset($errors) && in_array('address',$errors))
                                                    {
                                                        echo"<br><span class='warning' >Enter an address must not be blank.</span>";
                                                    }
                                                ?>
                                          </div>
                                        </div>
                                        <div class="register">
                                             <div class="labels">
                                             </div>
                                             <div class="inputs">
                                                <p class="submit cart-summary" id="sub">
                                                    <input class="button" type="submit" value="Register">
                                                </p>
                                             </div>
                                        </div>
                                  </div>
                                </form>
                                  
                            </div>
                            <div id="product-seen"></div>
                        </div>
                            
                    <!-- div sidebar -->
                        <?php  require_once __DIR__."/teamplate/sidebar.php"; ?>
                   <!--  end  div sidebar -->
                </div>
            </div>
            <!--  div footer  -->
                 <?php  require_once __DIR__."/teamplate/footer.php"; ?>
            <!--  End div footer  -->
        </div>
    </body>
</html>
