<!-- Xử lý dữ liệu -->
<?php 
session_start();
    require_once("../autoload/autoload.php"); // chèn file autoload.php vào file này
    class ListNew extends My_Model{ // kế thừa class My_model
        // parent:: sử dụng hàm của class thừa kế
        public function __construct() // hàm khởi tạo class -> khi tạo mới class tự chạy hàm này
        {
            parent::__construct();// sử dụng hàm khởi tạo của My_model
        }

        public function listNew($start,$num)
        {
            return $list = parent::fetchAllpagina('news',$start,$num); // Tương tác dữ liệu
        }


        public function countid()
        {
           $data = parent::countTable('news'); // Tương tác dữ liệu
           return $data;
        }
    }
    // $_get và $_post là để lấy tham số từ url ví dụ
    // http://localhost:8080//BeautyBonsai/views/news.php?id=22
    // id=22 là tham số được lấy bằng $_get
    // khác nhau giữa $_get và $post là $_get lấy tham số hiện thị trên url còn $_post thì được mã hóa

    // isset() -> hàm kiểm tra tồn tại, kết  qua trả về true hoặc false
    $list = new ListNew(); //lấy dữ liệu tin tức từ hàm ListNew (khai báo phía trên)

    //----------------------Chức năng Phân Trang----------------------------------------------------
    $display = 1; // số lượng bài viết hiện thị trên trang
    $start = (isset($_GET['s']) && filter_var($_GET['s'],FILTER_VALIDATE_INT,array('min_range'=>1)))?$_GET['s']:0;// dạng viết tắt của hàm if, đây là số thứ tự bắt đầu hiện thị số sản phẩm trên 1 trang
    $num = $list ->countid();//đếm số sản phẩm

    $list_new = $list -> listNew($start,$display);//hiện thị sản phẩm $start là thứ tự bắt đầu, $display là số lượng sản phẩm
?>
<!-- Hiện thị dữ liệu -->
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
               <div class="wrap"><a href="index.php">Home</a><span class="label"> &gt; </span>News</div>
            </div>
            <div id="inner">
                <div id="content-sidebar-wrap">
                   <!--  div menu-js -->
                        <?php  require_once __DIR__."/teamplate/menu-js.php"; ?>
                    <!-- End div menu-js  -->
                       <div id="content" class="hfeed">
                            <h1 class="archive-heading"><a href="list_new.php" rel="nofollow"></a></h1>
                                <?php foreach($list_new as $value): ?> <!-- Lấy từng tin tức trong mảng tin tức $list_new  -->
                                <!-- phần dưới là hiện thị, mỗi echo là xuất loại dữ liệu  -->
                                    <div class="tt">
                                        <div class="post-178509 post type-post status-publish format-standard has-post-thumbnail hentry category-tin-tuc entry">
                                            <a href="<?php echo 'news.php?id='.$value['id']; ?>" title="<?php echo $value['title'] ?>"><img width="300" height="300" src="../upload/news/<?php echo $value['image_link'] ?> " class="alignleft post-image entry-image" alt="<?php echo $value['title'] ?>" itemprop="image"></a>
                                            <h2 class="entry-title"><a href="<?php echo 'news.php?id='.$value['id']; ?>" rel="bookmark"><?php echo $value['title'] ?></a></h2>
                                            <div class="entry-content">
                                                <p>
                                                    <?php echo $value['intro'] ?>
                                                </p>
                                                <p><a href="<?php echo 'news.php?id='.$value['id']; ?>" class="more-link">see more</a></p>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            
                                <div class="navigation">
                                    <?php 
                                        $table ='news';
                                        $link = 'list_new.php?';
                                        echo navigation($display,$table,$link,$num); 
                                    ?> 
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
