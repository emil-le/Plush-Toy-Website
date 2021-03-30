<?php session_start(); ?>
<?php require_once __DIR__."/../autoload/autoload.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="vi" xml:lang="vi" prefix="og: http://ogp.me/ns#">
    <?php  require_once __DIR__."/teamplate/head.php"; ?>
    <body class="home blog header-image content-sidebar">
        <div id="wrap">

            <!-- div  content-before-header -->
                <?php  require_once __DIR__."/teamplate/content-before-header.php"; ?>
            <!--  End content-before-header -->

            <!--  div header -->
                <?php  require_once __DIR__."/teamplate/header.php"; ?>
            <!-- End div header -->

            <!-- div content-slider  -->
                <?php  require_once __DIR__."/teamplate/content-slider.php"; ?>
            <!--  End div content-slider  -->

            <!--  div inner  -->
                <div id="inner">
                    <div id="content-sidebar-wrap">
                        <?php  require_once __DIR__."/teamplate/inner.php"; ?>

                        <?php  require_once __DIR__."/teamplate/sidebar.php"; ?>
                   </div>
                </div>
            <!--  End div inner  -->

            
            <!--  div footer  -->
                 <?php  require_once __DIR__."/teamplate/footer.php"; ?>
            <!--  End div footer  -->
        </div>
        
    </body>
</html>
