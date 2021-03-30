<?php
require_once("../../../autoload/autoload.php");
if(isset($_SESSION['id_admin']) && isset($_SESSION['role_id']))
{
    $id = $_SESSION['id_admin'] ;
    $role_id= $_SESSION['role_id'];
}

checkLogin($id,$role_id);

class showData
{
    public $db;
    public  function __construct()
    {
        # code...
        $this->db = new My_Model();
    }
    public function show_list($start,$display)
    {
        $data = $this->db ->fetchAllpagina('product' , $start,$display);
        return $data;
    }
    public function countid()
    {
        $data = $this->db->countTable('product');
        return $data;
    }

    public function show_parent($table,$where)
    {
        $data = $this->db->fetchwhere($table,$where);
        return $data;
    }

}

$show_list_cate = new showData();

$display = 10;
$start = (isset($_GET['s']) && filter_var($_GET['s'],FILTER_VALIDATE_INT,array('min_range'=>1)))?$_GET['s']:0;
$record = $show_list_cate ->countid();
$data =$show_list_cate ->show_list($start,$display);


?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Product Management</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <!--  <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                        </div> -->
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right ">
                <button type="button" class="btn btn-round btn-danger" onclick="history.go(-1); return false;" style="float: right;" >Back</button>
                <a href="index.php?action=add" class="btn btn-round btn-primary" style="float: right;">Add New </a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Product Management<small>List</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form method="get" action="" class="list_filter form">
                                    <table class="table table-bordered">
                                        <?php
                                        if(isset($_SESSION['success']))
                                        {
                                            success($_SESSION['success']);
                                            unset($_SESSION['success']);
                                        }
                                        ?>
                                        <thead>
                                        <tr>
                                            <th style="width: 3%">Number</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $stt = 0 ?>
                                        <?php foreach($data as $value): ?>
                                            <tr class="row_<?php echo $value['id']?>">
                                                <td class="center" style="width: 3%"><?php echo $stt = $stt +1 ?></td>
                                                <td class="center">  <img src="<?php echo !empty($value['thunbar']) ?  url().'upload/product/'.$value['thunbar'] : url() . 'admin/public/images/image_default.png'; ?>" class="img-thumbnail" alt="Cinque Terre" width="80" height="80">  </td>
                                                <td><?php echo $value['name'] ?></td>
                                                <td>
                                                    <?php
                                                    $where = 'id = '.$value["category_id"];
                                                    $parent_name = $show_list_cate-> show_parent('category',$where);
                                                    if(!empty($parent_name))
                                                    {
                                                        foreach ($parent_name as $key => $values) {
                                                            # code...
                                                            echo $values['name'];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo number_format($value['price'])?> $</td>
                                                <td><?php echo $value['qty'] ?> </td>
                                                <td class="center">
                                                    <?php if($value['status'] == 1): ?>
                                                        <?php echo '<i class="fa fa-fw fa-check" id = "icon_xanh"></i> '?>
                                                    <?php else : ?>
                                                        <?php echo '<i class="fa fa-fw fa-close" id = "icon_red"></i>';?>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo date("Y-m-d", strtotime($value['created_at']))  ?> </td>
                                                <td class="center">
                                                    <?php echo '<a href="index.php?action=edit&id='.$value['id'].'">' ;?>
                                                    <i class="fa fa-edit" id = "icon_xanh" ></i>
                                                    </a>
                                                </td>
                                                <td class="center">
                                                    <a href ="../../controller/ProductController.php?action=delete&id=<?php echo $value['id'] ?>" class="verify_action" >
                                                        <i class="fa fa-trash-o" id = "icon_red" >
                                                        </i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- End Foreach -->
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <?php
                        $table ='product';
                        $link = 'index.php';
                        echo pagination($display,$table,$link,$record);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>