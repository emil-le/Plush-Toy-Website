<?php
session_start();
    require_once("../../../autoload/autoload.php");

    if(isset($_SESSION['id_admin']) && isset($_SESSION['role_id']))
    {
        $id = $_SESSION['id_admin'] ;
        $permission = explode(',', $_SESSION['permission']);
        if (!in_array('home', $permission) && !in_array('all', $permission)) {
            redirect_to('admin/views/errors.php');
        }

    }  else {
        redirect_to('admin/views/');
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
              require_once("../../teamplate/content.php"); 
              
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