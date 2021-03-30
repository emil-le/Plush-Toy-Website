<?php
require_once("../../../autoload/autoload.php");

if(isset($_SESSION['id_admin']) && isset($_SESSION['role_id']))
{
    $id = $_SESSION['id_admin'] ;
    $role_id= $_SESSION['role_id'];
}

checkLogin($id,$role_id);

/**
 *
 */
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
        $data = $this->db ->fetchAllpagina('category' , $start,$display);
        return $data;
    }
    public function countid()
    {
        $data = $this->db->countTable('category');
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
                <h3>Categories</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
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
                        <h2>List categories<small>List</small></h2>
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
                                        if(isset($_SESSION['error']))
                                        {
                                            warning($_SESSION['error']);
                                            unset($_SESSION['error']);
                                        }
                                        ?>
                                        <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>Order of display </th>
                                            <th>Title</th>
                                            <th>Parent category id</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $stt = 0;
                                        if (empty($data)) {
                                            # code...
                                            $_SESSION['success'] = " Data not found !!!";
                                        }else
                                        {
                                            foreach ($data as $key => $value) {
                                                # code...
                                                $stt = $stt +1 ;
                                                echo'
                                                <td class="center">'.$stt.'</td>
                                                <td>'.$value['name'].'</td>
                                                <td class="center" >'.$value['sort_order'].'</td>
                                                <td>'.$value['title'].'</td>
                                                <td>';
                                                $where = 'id = '.$value["parent_id"];
                                                $parent_name = $show_list_cate-> show_parent('category',$where);
                                                if(!empty($parent_name))
                                                {
                                                    foreach ($parent_name as $key => $values) {
                                                        # code...
                                                        echo $values['name'];
                                                    }
                                                }
                                                else
                                                {
                                                    echo "Category parent";
                                                }

                                                echo '</td>
                                                
                                                <td class="center">';
                                                if ($value['status'] ==1) {
                                                    # code...
                                                    echo '<i class="fa fa-fw fa-check" style="font-size: 20px; color: #4caf50;"></i>';
                                                }
                                                else{
                                                    echo '<i class="fa fa-fw fa-close" style="font-size: 20px; color: red;"></i>';
                                                }

                                                echo  '</td>
                                                <td class="center">
                                                <a href="index.php?action=edit&id='.$value['id'].'">
                                                <i class="fa fa-edit" style="font-size: 20px; color: #4caf50;">
                                                </i>
                                                </a>
                                                </td>
                                                <td class="center">
                                                <a href ="../../controller/CateController.php?action=delete&id='.$value['id'].'"  class="verify_action"> 
                                                <i class="fa fa-trash-o" style="font-size: 20px; color: red;">
                                                </i>
                                                </p>
                                                </td>
                                                </tr>
                                                ';
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <?php
                        $table ='category';
                        $link = 'index.php';
                        echo pagination($display,$table,$link,$record);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>