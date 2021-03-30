<?php 
 require_once("../autoload/autoload.php");
    $_SESSION['current_url'] = (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    class ShowProduct extends My_Model{
        public function __construct(){
            parent::__construct();

        }
        // Show product new
        public function showProductNew()
        {
             return $data = parent::fetchwhere('product','  status = 1 ORDER BY created_at  DESC LIMIT 0,16  ');
        }
        public function showProductCategory()
        {
            $data_category = parent::fetchwhere('category','parent_id = 0 AND status = 1 ORDER BY sort_order ASC ');
            foreach ($data_category as $keys => $category)
            {
                $where = 'parent_id = '.$category["id"];
                $category_sub = parent::fetchwhere('category', $where);
                if (!empty($category_sub)) {
                    $data_category[$keys]['sub'] = $category_sub;

                    foreach ($data_category[$keys]['sub'] as $key  => $value)
                    {
                        $where = 'category_id = '.$value['id'].' LIMIT 0 ,16';
                        $product = parent::fetchwhere('product',$where);

                        $data_category[$keys]['sub'][$key]['subpro'] = $product;
                    }
                } else {

                    $where = 'category_id = '. $category["id"].' LIMIT 0 ,16';
                    $product = parent::fetchwhere('product',$where);
                    $data_category[$keys]['sub'][0]['subpro'] = $product;
                }

            }

            return $data_category ;

        }
    }

    $show_product = new ShowProduct();
    $product_new = $show_product ->showProductNew();
    $product_category = $show_product ->showProductCategory();
?>

<div id="content" class="hfeed">

    <div id="flexible-block-0" class="flexible-block-1 flexible-block block-odd block-1 block ">
        <h2 class='block-title'><a href='' title=''><span>Product New</span></a></h2>
        <div class="block-wrap">
            <div class="main-posts">
                <?php foreach($product_new as $itemp): ?>
                    <div id="post-193528" class="caia-block-item">
                        <div class="image-sp">
                            <a href="detail.php?id=<?php echo $itemp['id'] ?>" title="<?php echo $itemp['name'] ?>">
                                <div class="imghome" style="background:url(<?php echo url().'upload/product/'.$itemp['thunbar']; ?>) no-repeat center center;"/></div>
                            </a>

                        </div>
                        <h3><a href="detail.php?id=<?php echo $itemp['id'] ?>" title="<?php echo $itemp['name'] ?>"><?php echo $itemp['name'] ?></a></h3>
                        <div class="show-gia">
                            <?php if($itemp['sale'] == 0): ?>
                                <p class="price"><span><?php echo number_format($itemp['price'])  ?> $</span></p>
                            <?php else : ?>
                                <p class="price"><span>
                                    <?php 
                                        $price = ($itemp['price'] *(100 - $itemp['sale']))/100;
                                        echo number_format($price);
                                    ?>
                                 $</span></p>
                            <?php endif; ?>
                        </div>                                
                        <div id="buy-product" class="buy-product">
                            <a class="addtocart" title="Add cart" href="../Controller/add_cart.php?action=addtocart&id=<?php echo $itemp['id'] ?>" rel="193528">Add Cart</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- end 1 post -->				
            </div>
            <!-- end .main-posts -->
        </div>
        <!-- end .block-wrap -->
    </div>
    <?php foreach ( $product_category as $key_cate => $category): ?>
        <?php if (! empty($category['sub'])) :?>
            <div id="flexible-block-1" class="flexible-block-2 flexible-block block-even block-2 block ">
                <h2 class='block-title'><a href='product.php?action=category&id=<?php echo $category['id'] ?>' title='<?php echo $category['name'] ?>'><span><?php echo $category['name'] ?></span></a></h2>
                <div id="menu-1373" class="extra-menu">
                    <div class="">
                        <ul id="" class="menu">
                            <li id="menu-item-178437" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-178437"><a href="product.php?action=category&id=<?php echo $category['id'] ?>">View all</a></li>
                        </ul>
                    </div>
                </div>
                <div class="block-wrap">
                        <div class="main-posts">
                            <?php foreach( $category['sub'] as $key_sub => $value): ?>
                                <?php foreach ($value['subpro'] as $key_subpro => $values): ?>
                                    <div id="post-31660" class="caia-block-item">
                                        <div class="image-sp">
                                            <a href="detail.php?id=<?php echo $values['id'] ?>" title="<?php echo $values['name'] ?>">
                                                <div class="imghome" style="background:url(<?php echo url().'upload/product/'.$values['thunbar']; ?>) no-repeat center center;"/></div>
                                            </a>
                                        </div>
                                        <h3><a href="detail.php?id=<?php echo $values['id'] ?>" title="<?php echo $values['name']  ?>"><?php echo $values['name']  ?></a></h3>
                                        <div class="show-gia">
                                            <?php if($values['sale'] == 0): ?>
                                                <p class="price"><span><?php echo number_format($values['price'])  ?> $</span></p>
                                            <?php else : ?>
                                                <p class="price"><span>
                                                    <?php
                                                        $price = ($values['price'] *(100 - $values['sale']))/100;
                                                        echo number_format($price);
                                                    ?>
                                                $</span></p>
                                            <?php endif; ?>
                                         </div>
                                        <div id="buy-product" class="buy-product">
                                            <a class="addtocart" title="Add Cart" href="../Controller/add_cart.php?action=addtocart&id=<?php echo $values['id'] ?>">Add Cart</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                            <!-- end 1 post -->
                        </div>

                    <!-- end .main-posts -->
                </div>
                <!-- end .block-wrap -->
            </div>
        <?php endif; ?>
    <?php endforeach; ?>


    
    <div id="product-seen"></div>
</div>

