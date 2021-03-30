<?php
//Xử lý dữ liệu
session_start();
require_once("../autoload/autoload.php");
$_SESSION['current_url'] = (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
class ViewProduct extends My_Model{

    public function __construct()
    {
        parent::__construct();

    }

    public function showProducCate($id) // hiện thị danh mục theo $id truyền vào
    {
        $id = validate_id($id); //kiểm tra id tồn tại
        $data_category = parent::fetchwhere('category','id = '.$id); //lấy dữ liệu danh mục theo $id

        foreach ($data_category as $keys => $category)// đọc từng dòng dữ liệu từ $data_category
        {
            $where = 'parent_id = '.$category["id"];
            $category_sub = parent::fetchwhere('category', $where);//lấy danh mục con

            if (empty($category_sub)) { //kiểm tra danh mục con có rỗng hay không, nếu rỗng thì chỉ lấy sp theo id truyền vào thui

                $data_category[$keys]['sub'] = $data_category; //truyền dữ liệu danh mục con vào $data_category

                foreach ($data_category[$keys]['sub'] as $key  => $value)
                {
                    $where = 'category_id = '.$value['id'].' AND status = 1 LIMIT 0 ,16';
                    $product = parent::fetchwhere('product',$where);
                    $data_category[$keys]['sub'][$key]['subpro'] = $product;
                } //vòng lập lấy sản phẩm

            } else {
                $data_category[$keys]['sub'] = $category_sub;//truyền dữ liệu danh mục con vào $data_category

                foreach ($data_category[$keys]['sub'] as $key  => $value) // k rỗng thì lấy id theo luôn (l.37)
                {
                    $where = 'category_id = '.$value['id'].' AND status = 1 LIMIT 0 ,16';//1 trang có 16 spham nen dung limit
                    $product = parent::fetchwhere('product',$where);//table = product
                    $data_category[$keys]['sub'][$key]['subpro'] = $product;
                }//vòng lập lấy sản phẩm
            }
        }
        return $data_category ; //xuất sản phẩm theo danh mục
    }

    public function showProducSub($id)//Hiện thị dữ liệu danh mục con, hàm như trên
    {
        $id = validate_id($id);

        $data_sub = parent::fetchwhere('category','id = '.$id);

        foreach ($data_sub as $key => $value) {
            # code...
            $where = "id = ".$value['parent_id'];
            $data_category = parent::fetchwhere('category',$where);
            $data_category[$key]['sub'] = $data_sub;

            foreach ($data_sub as $keys => $value) {
                # code...
                $where = 'category_id = '.$value['id'].' AND status = 1';
                $product = parent::fetchwhere('product',$where);

                $data_category[$key]['sub'][$keys]['subpro'] = $product;
            }
        }

        return $data_category;
    }

    public function showProduct($start,$num) // Hàm lấy tất cả sản phẩm
    {
        return $list = parent::fetchAllpagina('product' , $start,$num);
    }

    public function countid() // Hàm lấy tổng số lượng sản phẩm
    {
        $data = parent::countTable('product');
        return $data;
    }
}
//------------------- Chức năng phân trang --------------------------
$view_product = new ViewProduct();
$action = $_GET['action'];

switch ($action) {
    case 'category':
        # code...
        $id = validate_id($_GET['id']);
        $data = $view_product->showProducCate($id);
        break;
    case 'sub_cate':
        # code...
        $id = validate_id($_GET['id']);
        $datas = $view_product->showProducSub($id);

        break;
    case 'product':
        # code...
        $display = 16;
        $start = (isset($_GET['s']) && filter_var($_GET['s'],FILTER_VALIDATE_INT,array('min_range'=>1)))?$_GET['s']:0;
        $num = $view_product ->countid();

        $datax = $view_product -> showProduct($start,$display);
        break;


}

?>
<!-- Hiện thị dữ liệu cho 3 trang, danh mục, danh mục con và tất cả sản phẩm-->
<!DOCTYPE html>
<html  lang="vi" xml:lang="vi" >
<?php  require_once __DIR__."/teamplate/head.php"; ?>
<body class="single single-products postid-193659 header-image content-sidebar">
<div id="wrap">
    <!-- div  content-before-header -->
    <?php  require_once __DIR__."/teamplate/content-before-header.php"; ?>
    <!--  End content-before-header -->

    <!--  div header -->
    <?php  require_once __DIR__."/teamplate/header.php"; ?>
    <!-- End div header -->
    <?php if(!empty($data)): ?>
        <?php foreach ($data as $key =>$category): ?> <!-- Chức năng hện thị breadcrumb danh mục -->
            <div class="breadcrumb">
                <div class="wrap"><a href="index.php">Home</a><span class="label"> &gt; </span><a href="product.php?action=product">Products</a><span class="label"> > </span><?php echo $category['name'] ?></div>
            </div>
            <div id="inner">
                <div id="content-sidebar-wrap">
                    <!--  div menu-js -->
                    <?php  require_once __DIR__."/teamplate/menu-js.php"; ?>
                    <!-- End div menu-js  -->

                    <div id="content" class="hfeed">

                        <h1 class="archive-heading"><a href="product.php?action=category&id=<?php echo $category['id'] ?>" title="" rel="nofollow"><?php echo $category['name'] ?></a></h1>
                        <!-- Hiện thị sản phẩm -->
                        <?php foreach ($category['sub'] as $keyz_sub => $values): ?>
                            <?php foreach ($values['subpro'] as $key => $values): ?>
                                <div class="sp">
                                    <div class="post-135951 products type-products status-publish has-post-thumbnail hentry entry">
                                        <div class="image-sp">
                                            <a href="detail.php?id=<?php echo $values['id'] ?>">
                                                <div class="imghome" style="background:url(<?php echo url().'upload/product/'.$values['thunbar']; ?>) no-repeat center center;"></div>
                                            </a>
                                        </div>
                                        <h3><a href="detail.php?id=<?php echo $values['id'] ?>" rel="bookmark"><?php echo $values['name'] ?></a></h3>
                                        <div class="show-gia">
                                            <?php if($values['sale'] == 0): ?>
                                                <p class="price"><span><?php echo number_format($values['price'])  ?> $</span></p>
                                            <?php else : ?>
                                                <p class="price"><span>
                                                            <?php
                                                            $price = ($values['price'] *(100 - $values['sale']))/100;
                                                            echo number_format($price);
                                                            ?> $
                                                        </span></p>
                                            <?php endif; ?>
                                        </div>
                                        <!-- Chức năng thêm vào giỏ hàng -->
                                        <div id="buy-product" class="buy-product">
                                            <a class="addtocart" title="Add Cart" href="../Controller/add_cart.php?action=addtocart&id=<?php echo $values['id'] ?>" rel="135951">Add Cart</a>
                                        </div>
                                        <div class="entry-content"></div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php endforeach; ?>

                    </div>


                    <!-- div sidebar -->
                    <?php  require_once __DIR__."/teamplate/sidebar.php"; ?>
                    <!--  end  div sidebar -->
                </div>
            </div>
        <?php endforeach; ?>

    <?php elseif(!empty($datas)): ?>
        <?php foreach ($datas as $key =>$category): ?>
            <?php foreach ($category['sub'] as $keyz_sub => $values): ?>
                <div class="breadcrumb">
                    <div class="wrap"><a href="index.php">Home</a><span class="label"> &gt; </span><a href="product.php?action=product">Products</a><span class="label"></span><a href="product.php?action=category&id=<?php echo $category['id'] ?>"><?php echo  $category['name'] ?></a> <span class="label"> &gt; </span> <?php echo $values['name'] ?></div>
                </div>
                <div id="inner">
                <div id="content-sidebar-wrap">
                <!--  div menu-js -->
                <?php  require_once __DIR__."/teamplate/menu-js.php"; ?>
                <!-- End div menu-js  -->

                <div id="content" class="hfeed">

                <h1 class="archive-heading"><a href="product.php?action=sub_cate&id=<?php echo $values['id'] ?>" title="<?php echo $values['name'] ?>" rel="nofollow"><?php echo $values['name'] ?></a></h1>

                <?php foreach ($values['subpro'] as $key => $values): ?>
                    <div class="sp">
                        <div class="post-135951 products type-products status-publish has-post-thumbnail hentry entry">
                            <div class="image-sp">
                                <a href="detail.php?id=<?php echo $values['id'] ?>">
                                    <div class="imghome" style="background:url(<?php echo url().'upload/product/'.$values['thunbar']; ?>) no-repeat center center;"></div>
                                </a>
                            </div>
                            <h3><a href="detail.php?id=<?php echo $values['id'] ?>" rel="bookmark" title=""><?php echo $values['name'] ?></a></h3>
                            <div class="show-gia">
                                <?php if($values['sale'] == 0): ?>
                                    <p class="price"><span><?php echo number_format($values['price'])  ?></span></p>
                                <?php else : ?>
                                    <p class="price">
                                        <span>
                                            <?php
                                            $price = ($values['price'] *(100 - $values['sale']))/100;
                                            echo number_format($price);
                                            ?> $
                                        </span>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div id="buy-product" class="buy-product">
                                <a class="addtocart" title="Add Cart" href="../Controller/add_cart.php?action=addtocart&id=<?php echo $values['id'] ?>" rel="135951">Add Cart</a>
                            </div>
                            <div class="entry-content"></div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endforeach; ?>

            </div>


            <!-- div sidebar -->
            <?php  require_once __DIR__."/teamplate/sidebar.php"; ?>
            <!--  end  div sidebar -->
            </div>
            </div>
        <?php endforeach; ?>
    <?php elseif(!empty($datax)): ?>
        <div class="breadcrumb">
            <div class="wrap"><a href="index.php">Home</a><span class="label"> &gt; </span><a href="product.php?action=product">Products</a></div>
        </div>
        <div id="inner">
            <div id="content-sidebar-wrap">
                <!--  div menu-js -->
                <?php  require_once __DIR__."/teamplate/menu-js.php"; ?>
                <!-- End div menu-js  -->

                <div id="content" class="hfeed">

                    <h1 class="archive-heading"><a href="product.php?action=product" title="Products" rel="nofollow">Products</a></h1>

                    <?php foreach ($datax as $key => $values): ?>
                        <div class="sp">
                            <div class="post-135951 products type-products status-publish has-post-thumbnail hentry entry">
                                <div class="image-sp">
                                    <a href="detail.php?id=<?php echo $values['id'] ?>">
                                        <div class="imghome" style="background:url(<?php echo url().'upload/product/'.$values['thunbar']; ?>) no-repeat center center;"></div>
                                    </a>
                                </div>
                                <h3><a href="detail.php?id=<?php echo $values['id'] ?>" rel="bookmark" title="Ô dài Furama Resort"><?php echo $values['name'] ?></a></h3>
                                <div class="show-gia">
                                    <?php if($values['sale'] == 0): ?>
                                        <p class="price"><span><?php echo number_format($values['price'])  ?></span></p>
                                    <?php else : ?>
                                        <p class="price"><span>
                                                            <?php
                                                            $price = ($values['price'] *(100 - $values['sale']))/100;
                                                            echo number_format($price);
                                                            ?> đ
                                                        </span></p>
                                    <?php endif; ?>
                                </div>
                                <div id="buy-product" class="buy-product">
                                    <a class="addtocart" title="Đặt mua" href="../Controller/add_cart.php?action=addtocart&id=<?php echo $values['id'] ?>" rel="135951">Add Cart</a>
                                </div>
                                <div class="entry-content"></div>
                            </div>
                        </div>
                    <?php endforeach;?>
                    <div class="col-lg-12">
                        <div class="navigation">
                            <?php
                            $table ='product';
                            $link = 'product.php?action=product&';
                            echo navigation($display,$table,$link,$num);
                            ?>
                        </div>
                    </div>

                </div>
                <!-- div sidebar -->
                <?php  require_once __DIR__."/teamplate/sidebar.php"; ?>
                <!--  end  div sidebar -->
            </div>
        </div>
    <?php endif;?>

    <!--  div footer  -->
    <?php  require_once __DIR__."/teamplate/footer.php"; ?>
    <!--  End div footer  -->
</div>
</body>
</html>


