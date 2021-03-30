<?php 
session_start();
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
               <div class="wrap"><a href="index.php">Home</a><span class="label"> &gt; </span>Contact</div>
            </div>
            <div id="inner">
                <div id="content-sidebar-wrap">
                   <!--  div menu-js -->
                        <?php  require_once __DIR__."/teamplate/menu-js.php"; ?>
                    <!-- End div menu-js  -->
                        <div id="content" class="hfeed">
                            <div class="post-7 page type-page status-publish hentry entry">
                                <h1 class="entry-title">Contact</h1>
                                <div class="entry-content">
                                    <p><span style="font-size: large;"><strong> <br>
                                        </strong></span>
                                    </p>
                                    <p><strong>Address:&nbsp;</strong> <a style="color: blue;" href="" target="_blank">(Map)</a></p>
                                    <p><strong>Mobile:</p>
                                    <p><strong>Phone : </strong></p>
                                    <p><strong>Email:</strong> </p>
                                    <p><strong>Skype: </strong> </p>
                                    <p><strong>Facebook:</strong></p>
                                    <p><strong><br>
                                        </strong>
                                    </p>
                                    <p>&nbsp;</p>
                                    <hr>
                                </div>
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
