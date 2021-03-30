<?php 
    require_once("../autoload/autoload.php");
    class ShowCategory extends My_Model{

        public function __construct()
        {
            parent::__construct();
        }
        function showCate()
        {

          $data = parent::fetchwhere('category','parent_id = 0  AND  status = 1 ORDER BY sort_order ASC');

          foreach ( $data as $key => $value)
          {

            $where = 'parent_id  = '. $value['id'].' AND  status = 1 ORDER BY sort_order ASC ' ;
            $data[$key]['category'] = parent::fetchwhere('category',$where);
          }
          return $data;
        }
    }
    $show_category = new ShowCategory();
    $data = $show_category ->showCate();
?>


<div id="content-slider">
    <div class="wrap">
        <div id="nav_menu-9" class="widget widget_nav_menu">
            <div class="widget-wrap">
                <div class="">
                    <ul id="" class="menu">
                        <?php foreach($data as $value): ?>
                            <li id="menu-item-180027" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-180027">
                                <a href="product.php?action=category&id=<?php echo $value['id'] ?>"
                                    <?php 
                                        
                                        if(empty($value['category'])) {
                                            echo "style = 'background-image:none;'";
                                        }
                                        
                                    ?>
                                    >
                                    <?php echo $value['name'] ?>
                                        
                                    </a>


                                    <?php if(!empty($value['category'])): ?>
                                        <ul class="sub-menu">
                                            <?php foreach ($value['category'] as $key => $sub ): ?>
                                                <li id="menu-item-180020" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-180020"><a href="product.php?action=sub_cate&id=<?php echo $sub['id'] ?>"><?php echo $sub['name'] ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif ?>
                                
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div id="simpleresponsiveslider_widget-2" class="widget widget_simpleresponsiveslider_widget">

            <div class="widget-wrap">

                <div class="rslides_container">
                    <ul class="rslides rslides1" style="max-width: 1000px;">
                        <li id="rslides1_s0" class="" style="display: block; float: none; position: absolute; opacity: 0; z-index: 1; transition: opacity 500ms ease-in-out;"><img src="<?php echo url(); ?>public/images/banner/foody-1.jpg" alt="slider"></li>
                        <li id="rslides1_s1" style="float: left; position: relative; opacity: 1; z-index: 2; display: list-item; transition: opacity 500ms ease-in-out;" class="rslides1_on"><img src="<?php echo url(); ?>public/images/banner/foody-2.jpg" alt="slider"></li>


                        <li id="rslides1_s1" style="float: left; position: relative; opacity: 1; z-index: 2; display: list-item; transition: opacity 500ms ease-in-out;" class="rslides1_on"><img src="<?php echo url(); ?>public/images/banner/foody-3.jpg" alt="slider"></li>

                       
                    </ul>
                </div>
            </div>
            

            
            
            
            

        </div>

        
        <div id="text-14" class="widget widget_text">
            <div class="widget-wrap">
                <div class="textwidget">
                    <img src="<?php echo url(); ?>upload/morinaga_1.jpg">
                </div>
            </div>
        </div>
    </div>
</div>