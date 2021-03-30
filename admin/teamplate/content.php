<?php 
	require_once("../../../autoload/autoload.php");

	class ShowData extends My_Model{
		public function __construct(){
			parent::__construct();
		}

		public function showTransaction($start,$display)
	    {
	      $data = parent::fetchAllpagina('transaction' , $start,$display);
	      return $data;
	    }
	    public function countid()
	    {
	       $data = parent::countTable('transaction');
	       return $data;
	    }

	    public function countPending()
	    {
	    	return $data = parent::fetchwhere('transaction','active = 0');
	    }

	    public function countProduct()
	    {
	    	$data = parent::countTable('product');
	       	return $data;
	    }

	    public function countNews()
	    {
	    	$data = parent::countTable('news');
	       	return $data;
	    }


	    public function productPay()
	    {
	    	$data = parent::fetchwhere('transaction','active = 1');
	    	$num = 0;
	    	foreach ($data as $key => $value) {
	    		# code...
	    		$num = $num + $value['amount'];
	    	}
	    	return $num;
	    }


	    public function productPending()
	    {
	    	$data = parent::fetchwhere('transaction','active = 0');
	    	$num = 0;
	    	foreach ($data as $key => $value) {
	    		# code...
	    		$num = $num + $value['amount'];
	    	}
	    	return $num;
	    }
	}

	$show_data = new ShowData();

	$display = 10;
	$start = (isset($_GET['s']) && filter_var($_GET['s'],FILTER_VALIDATE_INT,array('min_range'=>1)))?$_GET['s']:0;
	$record = $show_data ->countid();
	$data_transaction =$show_data ->showTransaction($start,$display);
	$data_pending = $show_data ->countPending();

	$num_product = $show_data->countProduct();

	$num_news = $show_data->countNews();

	$num_pay = $show_data->productPay();

	$num_pending = $show_data->productPending();
?>

<div class="right_col" role="main">
    <div class="col-md-12 col-sm-12 col-xs-12 ">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>Statistics of transaction data</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content br">
                    <div class="widget_summary">
                        <div class="col-md-6">Total transactions</div>
                        <div class="col-md-6"><b class="text-danger"><?php echo $record; ?></b></div>
                    </div>
                </div>
                <div class="x_content br">
                    <div class="widget_summary">
                        <div class="col-md-6">Pending</div>
                        <div class="col-md-6"><b class="text-danger"><?php echo count($data_pending); ?> </b></div>
                    </div>
                </div>
                <div class="x_content br">
                    <div class="widget_summary">
                        <div class="col-md-6">Transactions processed</div>
                        <div class="col-md-6"><b class="text-danger"> <?php echo $record - count($data_pending) ;   ?> </b></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ===========================end================== -->
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>Datas</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content br">
                    <div class="widget_summary">
                        <div class="col-md-6">Total products</div>
                        <div class="col-md-6"><b class="text-danger"><?php echo $num_product; ?></b></div>
                    </div>
                </div>
                <div class="x_content br">
                    <div class="widget_summary">
                        <div class="col-md-6">Total posts</div>
                        <div class="col-md-6"><b class="text-danger"><?php echo $num_news; ?> </b></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ===========================end================== -->
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>Revenue</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content br">
                    <div class="widget_summary">
                        <div class="col-md-6">Paid</div>
                        <div class="col-md-6"><b class="text-danger"><?php echo number_format($num_pay); ?> $</b></div>
                    </div>
                </div>
                <div class="x_content br">
                    <div class="widget_summary">
                        <div class="col-md-6">Pending</div>
                        <div class="col-md-6"><b class="text-danger"><?php echo number_format($num_pending);?> $</b></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ===========================end================== -->
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel tile">
            <div class="x_title">
                <h2>Transaction list</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name </th>
                        <th>Email </th>
                        <th>Address </th>
                        <th>Phone </th>
                        <th>Total money</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <?php foreach($data_transaction as $value): ?>
                        <tbody>
                        <tr>
                            <td><?php echo $value['id'] ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo $value['email'] ?></td>
                            <td><?php echo $value['address'] ?></td>
                            <td><?php echo $value['phone'] ?></td>
                            <td><?php echo number_format($value['amount']) ?>$</td>
                            <td class="text-center">
                                <?php if($value['active'] == 1): ?>
                                    <a href="<?php echo '../../controller/Active.php?action=unpaid&id='.$value['id'] ;?>" class="btn btn-xs btn-info active-info " data-active="31">Paid</a>
                                <?php elseif($value['active'] == 0): ?>
                                    <a href="<?php echo '../../controller/Active.php?action=pay&id='.$value['id'] ;?>" class="btn btn-xs btn-default active-info" data-active="32">Unpaid</a>
                                <?php else: ?>
                                    Cancelled
                                <?php endif; ?>
                            </td>
                            <td><?php echo $value['created_at'] ?></td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-danger btn-delete-action verify_action" href="<?php echo '../../controller/Active.php?action=delete&id='.$value['id'] ;?>"><i class="fa fa-trash-o"></i></a>
                                <a class="btn btn-xs btn-success" target="_blank" href="../home/view_order.php?id=<?php echo $value['id'] ?>"><i class="fa fa-fw fa-street-view" title=""></i></a>
                            </td>
                        </tr>
                        </tbody>
                    <?php endforeach ;?>
                </table>
            </div>
            <?php
            $table ='product';
            $link = 'index.php';
            echo pagination($display,$table,$link,$record);
            ?>
        </div>
    </div>
</div>