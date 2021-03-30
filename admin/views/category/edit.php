<?php
  require_once("../../../autoload/autoload.php");

    if(isset($_SESSION['id_admin']) && isset($_SESSION['role_id']))
    {
        $id = $_SESSION['id_admin'] ;
        $role_id= $_SESSION['role_id'];
    }

    checkLogin($id,$role_id);
    $permission = explode(',', $_SESSION['permission']);
    if (!in_array('edit-category', $permission) && !in_array('all', $permission)) {
        redirect_to('admin/views/errors.php');
    }
  /**
  * kế thừa từ hàm
  */
  class viewAdd extends My_Model
  {
   
  }

  $db = new viewAdd();
  $parent = $db->fetchwhere('category','parent_id = 0');
  if(testInputInt($_GET['id']))
  {
    $id = testInputInt($_GET['id']); 

    $where = "id = ".$id;
    $data = $db->fetchwhere ('category',$where);

    if (empty($data)) {
      # code...
      $_SESSION['error'] = "Category does not already exist (*).";
    }
  }
  else
  {
    
    
    echo "<script> window.location = 'index.php'; </script>";
    
  }

?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit category</h3>
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
                <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right ">
                    <a href="index.php" class="btn btn-round btn-success" style="float: right;">List Categories </a>
                    <a href="index.php?action=add" class="btn btn-round btn-primary" style="float: right;">Add New </a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Category <small>Edit</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php
                        if (isset($_SESSION['error']))
                        {
                            warning($_SESSION['error']);
                            unset($_SESSION['error']);

                        }
                        ?>
                        <div class="col-xs-12">
                            <?php
                            foreach ($data as $key => $value) {
                                # code...

                                ?>
                                <form name="category" class="category" id="category" method="post" action="../../controller/CateController.php?action=edit&id=<?php echo $id ?>">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <label for="param_name" class="formLeft magin-left-30">Name :<span class="req">(*)</span></label>
                                            </td>
                                            <td>
                                                <input type="text" name="name" class="form-control " id="name" placeholder="Name Category" value="<?php echo $value['name'] ?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="param_name " class="formLeft magin-left-30">Title :<span class="req">(*)</span></label>
                                            </td>
                                            <td>
                                                <input type="text" name="title" class="form-control  " id="title" placeholder="Title" value="<?php echo $value['title'] ?>" required >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="param_name" class="formLeft magin-left-30">Order of display :</label>
                                            </td>
                                            <td>
                                                <input type="text" name="sort_order" class="form-control " id="sort_order" placeholder="Thứ tự hiển thị." value="<?php echo $value['sort_order'] ?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="param_name" class="formLeft magin-left-30">Categories parent  :<span class="req">(*)</span></label>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control" _autocheck="true" name="parent_id">
                                                        <option value="0">List category parent</option>
                                                        <?php
                                                        foreach ($parent as $key => $values)
                                                        {
                                                            # code...
                                                            echo'<option'
                                                            ?>
                                                            <?php
                                                            if($value['parent_id'] == $values['id'])
                                                            {
                                                                echo "selected";
                                                            }

                                                            echo' value="'.$values['id'].'">'.$values['name'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="param_name" class="formLeft magin-left-30">Status
                                                    :<span class="req">(*)</span></label>
                                            </td>
                                            <td>
                                                <input type="radio" name="status" id="optionsRadios2" value="1"
                                                    <?php
                                                    if ($value['status'] == 1) {
                                                        # code...
                                                        echo "checked='checked'";
                                                    }
                                                    ?>  > Show
                                                &nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="status" id="optionsRadios1" value="0"
                                                    <?php
                                                    if ($value['status'] == 0) {
                                                        # code...
                                                        echo "checked='checked'";
                                                    }
                                                    ?>
                                                > Hidden
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-info ">Update</button>
                                                <button type="reset" class="btn btn-default">Cancel</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>