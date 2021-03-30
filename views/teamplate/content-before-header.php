<div id="content-before-header">
    <div class="wrap">
        <div id="text-13" class="widget widget_text">
            <div class="widget-wrap">
                <div class="textwidget">
                    <div class="telephone-header">
<!--                        <a href="tel: 01639529405">01639529405</a>-->
                    </div>
                </div>
            </div>
        </div>
        <div id="nav_menu-8" class="widget widget_nav_menu">
            <div class="widget-wrap">
                <div class="menu-main-menu-container">
                    <ul id="menu-main-menu" class="menu">
                       
                        <?php if(!isset($_SESSION['users'])): ?>

                        <li id="menu-item-16" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-16"><a href="login.php">Login</a></li>
                        <li id="menu-item-16" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-16"><a href="register.php">Sign Up</a></li>
                       
                        <?php else: ?>
                        <?php 
                            echo ' <li id="menu-item-16" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-16"><a href="member-information.php" style="">Hello '.$_SESSION['users']['name_user'].'</a></li>';
                            echo '<li id="menu-item-16" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-16"><a href="';
                                echo url().'views/sing-out.php';
                            echo'">Logout</a></li>'
                        ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>