<?php
    require_once("../autoload/autoload.php");

    class Sidebar extends My_Model{
        public function __construct()
        {
            parent::__construct();
        }

        public function showSellingProducts()
        {
            return $data = parent::fetchhot('product','buyed');
        }

        public function showProductHighlights()
        {
            $where = 'hot = 1 ORDER BY  created_at DESC';
            return $data = parent::fetchwhere('product',$where);
        }

        public function showNews()
        {
            $where = "1 ORDER BY id DESC LIMIT 0,5 ";
           return  $data = parent::fetchwhere('news',$where);
        }
    }

    $product = new Sidebar();
    $productSelling = $product -> showSellingProducts();
    $product_hig = $product -> showProductHighlights();
    $news = $product->showNews();
?>

<div id="sidebar" class="sidebar widget-area">
    
    
    <div id="caia-product-jquery-2" class="widget caia-product-jquery-widget">
        <div class="widget-wrap">
            <h4 class="widget-title widgettitle">New Toys Arrived</h4>
            <div class="main-posts">
                <div class="">
                    <ul>
                        <?php foreach($productSelling as $value): ?>
                        <li class="post-164177 products type-products status-publish has-post-thumbnail entry">
                            <a href="detail.php?id=<?php echo $value['id'] ?>" title="<?php echo $value['name'] ?>" class="alignleft"><img width="150" height="150" src="../upload/product/<?php echo $value['thunbar'] ?> " class="attachment-thumbnail" alt="<?php echo $value['name'] ?>" title="<?php echo $value['name'] ?>" /></a>
                            <h3 class="widget-item-title"><a href="detail.php?id=<?php echo $value['id'] ?>" title="<?php echo $value['name'] ?>"><?php echo $value['name'] ?></a></h3>
                            <div class="show-gia1"><span class="price"><span> <?php echo ($value['sale'] >0 )? (number_format(($value['price'] *(100 - $value['sale']))/100)): $value['price']  ?> $</span></span></div>
                            <div class="clear"></div>
                        </li>
                        <?php endforeach; ?>
                        <!--end post_class()-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div id="caia-post-list-3" class="widget caia-post-list-widget">
        <div class="widget-wrap">
            <h4 class="widget-title widgettitle">Bestselling</h4>
            <div class="main-posts">
                <?php foreach ($product_hig  as $key => $value): ?>
                <div class="post-170928 products type-products status-publish has-post-thumbnail hentry entry ">
                    <a href="detail.php?id=<?php echo $value['id'] ?>" title="<?php echo $value['name'] ?>" class="alignleft"><img width="150" height="150" src="../upload/product/<?php echo $value['thunbar'] ?> " class="attachment-thumbnail" alt="<?php echo $value['name'] ?>" title="<?php echo $value['name'] ?>" /></a>
                    <h3 class="widget-item-title"><a href="detail.php?id=<?php echo $value['id'] ?>" title="<?php echo $value['name'] ?>"><?php echo $value['name'] ?></a></h3>
                    <div class="show-gia1">
                        <?php if($value['sale'] == 0): ?>
                            <p class="price"><span><?php echo number_format($value['price'])  ?>$</span></p>
                        <?php else : ?>
                            <p class="price"><span>
                                <?php 
                                    $price = ($value['price'] *(100 - $value['sale']))/100;
                                    echo number_format($price);
                                ?>$</span></p>
                        <?php endif; ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php endforeach;?>
                <!--end post_class()-->
            </div>
        </div>
    </div>

    <div id="caia-post-list-2" class="widget caia-post-list-widget">
        <div class="widget-wrap">
            <h4 class="widget-title widgettitle">Blog</h4>
            <div class="main-posts">
                <?php foreach($news as $value): ?>
                <div class="post-178509 post type-post status-publish format-standard has-post-thumbnail hentry category-tin-tuc entry">
                    <a href="<?php echo 'news.php?id='.$value['id']; ?>" title="<?php echo $value['title'] ?>" class="alignleft"><img width="300" height="300" src="../upload/news/<?php echo $value['image_link'] ?> " class="attachment-thumbnail" alt="<?php echo $value['title'] ?>" title="<?php echo $value['title'] ?>"></a>
                    <h3 class="widget-item-title"><a href="<?php echo 'news.php?id='.$value['id']; ?>" title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></a></h3>
                    <div class="clear"></div>
                </div>
            <?php endforeach; ?>
                <!--end post_class()-->
            </div>
            <p class="more-from-category"><a href="list_new.php" title="">See more...</a></p>
        </div>
    </div>
    
    <div id="ads_widget-7" class="widget caia_ads_widget">
        <div class="widget-wrap">
            <div class="ads_content_widget">
                <div class="fb-page" data-href="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <div class="fb-xfbml-parse-ignore">
                        <blockquote cite="Foody Fresh"><a href=""></a></blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>