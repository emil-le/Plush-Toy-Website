<?php
  require_once("../../../autoload/autoload.php");
    if(isset($_SESSION['id_admin']) && isset($_SESSION['role_id']))
    {
      $id = $_SESSION['id_admin'] ;
      $role_id= $_SESSION['role_id'];
    }

    checkLogin($id,$role_id);
    $permission = explode(',', $_SESSION['permission']);
    if (!in_array('add-products', $permission) && !in_array('all', $permission)) {
        redirect_to('admin/views/errors.php');
    }

  class viewAdd
  {
    public $db;
    function __construct()
    {
      # code...
      $this->db = new My_Model();
    }

    function showOption()
    {

      $data = $this->db->fetchwhere('category','parent_id = 0');

      foreach ( $data as $key => $value)
      {

        $where = 'parent_id  = '. $value['id'] ;
        $data[$key]['category'] = $this->db->fetchwhere('category',$where);
      }
      return $data;
    }
  }
  $viewcate = new viewAdd();
  $parent = $viewcate->showOption();
?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add New Product</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <!-- <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                                  <button class="btn btn-default" type="button">Go!</button>
                              </span>
                        </div> -->
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right ">
                <button type="button" class="btn btn-round btn-danger" onclick="history.go(-1); return false;" style="float: right;" >Back</button>
                <a href="index.php" class="btn btn-round btn-success" style="float: right;">List product </a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add New Product <small>Add</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-xs-12">
                            <?php
                            if (isset($_SESSION['error']))
                            {
                                warning($_SESSION['error']);
                                unset($_SESSION['error']);

                            }
                            ?>
                            <form name="form" class="form" id="form" method="post" action="../../controller/ProductController.php?action=add" enctype="multipart/form-data">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <label for="param_name" class="formLeft magin-left-30">Name :<span class="req">(*)</span></label>
                                        </td>
                                        <td>
                                            <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Name" required="required" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="param_name " class="formLeft magin-left-30">Title :</label>
                                        </td>
                                        <td>
                                            <input id="title" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="title" placeholder="Title"  type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="param_name" class="formLeft magin-left-30">Price : <span class="req">(*)</span></label>
                                        </td>
                                        <td>
                                            <input id="price" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="price" placeholder="Price" required="required"  type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="param_name" class="formLeft magin-left-30">Amount : <span class="req">(*)</span></label>
                                        <td>
                                            <input type="number" id="qty" name="qty" required="required" min="0" placeholder=" " class="form-control col-md-7 col-xs-12">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="param_name" class="formLeft magin-left-30">
                                                Product hot :
                                        </td>
                                        <td>
                                            <input type="radio" name="hot" id="optionsRadios2" value="1" > Hot
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="param_name" class="formLeft magin-left-30">Category :<span class="req">(*)</span></label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control parsley-error" _autocheck="true" name="parent_id" required="required">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($parent as $key => $value) {
                                                        # code...
                                                        if(!empty($value['category']))
                                                        {
                                                            ?>
                                                            <optgroup label="<?php echo $value['name']?>">
                                                                <?php foreach ($value['category'] as $sub ): ?>
                                                                    <option value="<?php echo $sub['id'] ?>" >
                                                                        <?php echo $sub['name'] ?>
                                                                    </option>
                                                                <?php endforeach;?>
                                                            </optgroup>
                                                            <?php
                                                        }else
                                                        {
                                                            echo'<option id="heard"  value="'.$value['id'].'">'.$value['name'].'</option>';
                                                        }

                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="message"> Contents :</label>
                                        </td>
                                        <td>
                                            <textarea id="content"  class="form-control" name="content" style="width: 80% !important;"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="param_name" class="formLeft magin-left-30"> Image : <span class="req">(*)</span></label>
                                        </td>
                                        <td>
                                            <input type="file" class="image" id="image" name="image" required="required">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="param_name" class="formLeft magin-left-30">Status
                                                :<span class="req">(*)</span></label>
                                        </td>
                                        <td>
                                            <input type="radio" name="status" id="optionsRadios2" value="1" checked="checked"> Show
                                            <input type="radio" name="status" id="optionsRadios1" value="0"> Hidden
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-info ">Add New</button>
                                            <button type="reset" class="btn btn-default">Cancel</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
