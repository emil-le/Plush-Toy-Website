<div id="header">
    <div class="wrap">
        <div id="title-area">
            <h1 id="title"><a href="index.php">BeautyBonsai</a></h1>
        </div>
        <div class="widget-area header-widget-area">
            <div id="code_widget-2" class="code-widget_search_form widget caia_code_widget">
                <div class="widget-wrap">
                    <form role="search" method="get" id="searchform" action="search.php">
                        <div class="search-list-category">
<!--                            <select name="price" id="cat" class="postform">-->
<!--                                <option value="0" selected="selected">Price </option>-->
<!--                                <option class="level-1" value="00000-30000">0-30.000</option>-->
<!--                                <option class="level-1" value="30000-60000">30.000-60.000</option>-->
<!--                                <option class="level-1" value="60000-100000">60.000-100.000</option>-->
<!--                                <option class="level-1" value="100000-150000">100.000-150.000</option>-->
<!--                                <option class="level-1" value="150000-200000">150.000-200.000</option>-->
<!--                                <option class="level-1" value="200000-250000">200.000-250.000</option>-->
<!--                                <option class="level-1" value="300000-350000">300.000-350.000</option>-->
<!--                                <option class="level-1" value="400000-450000">400.000-500.000</option>-->
<!--                                <option class="level-1" value="500000-5000000">Trên 500.000</option>-->
<!--                            </select>-->
                            <input type="text" value="" name="search" id="s" placeholder="Search"/>
                            <input type="submit" id="searchsubmit" value="Search" />
                        </div>
                    </form>
                </div>
            </div>
            <div id="shop-cart-4" class="widget gsc-shop-cart">
                <div class="widget-wrap">
                    <div class = "cart-wrap">
                        <!--hoangnm edit-->
                        <a href="../views/cart.php" title="View Cart">
                            <div style="width:41px;height:41px;display:inline-block;float:right"></div>
                            <p id="total-incart-price">
                            </p>
                            <span id="num-incart-products">
                            (
                            <span class="num-products"><?php echo (isset($_SESSION['cart']))?count($_SESSION['cart']):0; ?></span>
                            <span class="product-called"> sp</span>
                            )
                            </span>
                            <span class='checkout'>Cart</span>
                        </a>
                    </div>
                    <!-- end .wrap -->
                </div>
            </div>
            <div id="text-12" class="widget widget_text">
                <div class="widget-wrap">
                    <div class="textwidget">
                        <p id="button-product">CATEGORIES</p>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="top_menu">
            <ul class="menus">
                <a href="index.php"><li class="level-1">Home</li></a>
                <a href="product.php?action=product"><li>Plush Toys</li></a>
                <a href="list_new.php"><li>Blog</li></a>
                <a href="introduce.php"><li>About us</li></a>
                <a href="contact.php"><li>Contact</li></a>
                
            </ul>
        </div>

    </div>
</div>