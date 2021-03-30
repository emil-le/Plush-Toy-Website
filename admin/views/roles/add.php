<?php
require_once("../../../autoload/autoload.php");

if(isset($_SESSION['id_admin']) && isset($_SESSION['role_id']))
{
    $id = $_SESSION['id_admin'] ;
    $role_id= $_SESSION['role_id'];
}

checkLogin($id,$role_id);
$permission = explode(',', $_SESSION['permission']);
if (!in_array('add-permission', $permission) && !in_array('all', $permission)) {
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
}

$viewcate = new viewAdd();

?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add new role</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right ">
                <button type="button" class="btn btn-round btn-danger" onclick="history.go(-1); return false;" style="float: right;" >Back</button>
                <a href="index.php" class="btn btn-round btn-success" style="float: right;">List Roles</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Roles <small>Add</small></h2>
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
                        <div class="col-xs-12">
                            <?php
                            if (isset($_SESSION['error']))
                            {
                                warning($_SESSION['error']);
                                unset($_SESSION['error']);

                            }
                            ?>
                            <form name="roles" class="roles" id="roles" method="post" action="../../controller/RoleController.php?action=add">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="param_name" class="formLeft magin-left-30">Name :<span class="req"> (*) </span></label>
                                            </td>
                                            <td>
                                                <input class="form-control col-md-7 col-xs-12" name="name" placeholder="Role" required="required" type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="param_name" class="formLeft magin-left-30">Description :</label>
                                            </td>
                                            <td>
                                                <input class="form-control col-md-7 col-xs-12" name="description" placeholder="Description" type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="param_name" class="formLeft magin-left-30">Permission :<span class="req"> (*) </span></label>
                                            </td>
                                            <td>
                                                <select class="form-control col-md-12 col-xs-12 permission" name="permission[]" multiple="multiple">
                                                    <?php foreach ($permissions as $key => $value): ?>
                                                        <option value="<?= $key ?>"><?= $value ?></option>
                                                    <?php endforeach; ?>
                                                </select>
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
