<?php
include('connection.php');

    // ================   For Maintain Stocks(Start)   ====================
    
    
    $sql = "SELECT * from `items`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $id = $row['id'];
            $name = $row['name'];
            $tstock = $row['total_stock'];
            $ostock= $row['old_stock'];
            $os_cprice = $row['old_stock_cprice'];
            $os_rprice = $row['old_stoct_price'];
            $nstock = $row['new_stock'];
            $ns_cprice = $row['new_stock_cprice'];
            $ns_rprice = $row['new_stoct_price'];
            
            if($ostock != 0 && $nstock != 0)
            {
                
            }
            else if($ostock == 0 && $nstock != 0)
            {
                // get new save in old and get for new from stock
                
                $trprice =0;
                $tcprice =0;
                $qty =0;
                $de=false;
                $sql6="SELECT * FROM `stock` WHERE `item_id`='$id' LIMIT 1";
                $result6 = $conn->query($sql6);
                if ($result6->num_rows > 0)
                {
                    while($row6 = mysqli_fetch_assoc($result6))
                    {
                        $sid =$row6['id'];
                        $trprice =$row6['rprice'];
                        $tcprice =$row6['cprice'];
                        $qty =$row6['qty'];
                        $de=true;
                    } 
                }
                $sql7="UPDATE `items` SET `old_stock`=new_stock,`old_stoct_price`=new_stoct_price,`old_stock_cprice`=new_stock_cprice,
                `new_stock`='$qty',`new_stoct_price`='$trprice',`new_stock_cprice`='$tcprice' where `id` = '$id'";
                $result7 = $conn->query($sql7);
                if($result7 > 0)
                {
                    if( $de == true)
                    {
                        $dlt2="DELETE FROM `stock` WHERE `id`='$sid'";
                        $resultd2 = $conn->query($dlt2);
                        if($resultd2 > 0)
                        {
                            
                        }
                        else
                        {
                            echo "7";
                        }
                    }
                }
                else
                {
                    echo "6";
                }
            }
            else if($ostock == 0 && $nstock == 0)
            {
                // both get from stock store in new and old
                $sql3="SELECT * FROM `stock` WHERE `item_id`='$id' LIMIT 2";
                $result3 = $conn->query($sql3);
                $count=0;
                if ($result3->num_rows > 0)
                {
                    while($row3 = mysqli_fetch_assoc($result3))
                    {
                        $sid[$count]=$row3['id'];
                        $trprice[$count]=$row3['rprice'];
                        $tcprice[$count]=$row3['cprice'];
                        $qty[$count]=$row3['qty'];
                        $count++;
                    }
                    
                    $sql4="UPDATE `items` SET `old_stock`='$qty[0]',`old_stoct_price`='$trprice[0]',`old_stock_cprice`='$tcprice[0]' where `id` = '$id'";
                    $result4 = $conn->query($sql4);
                    if($result4 > 0)
                    {
                        
                    }
                    else
                    {
                        echo "3";
                    }
                    
                    $sql5="UPDATE `items` SET `new_stock`='$qty[1]',`new_stoct_price`='$trprice[1]',`new_stock_cprice`='$tcprice[1]' where `id` = '$id'";
                    $result5 = $conn->query($sql5);
                    if($result5 > 0)
                    {
                        
                    }
                    else
                    {
                        echo "2";
                    }
                    
                    $dlt1="DELETE FROM `stock` WHERE `id` IN ('$sid[0]','$sid[1]')";
                    $resultd1 = $conn->query($dlt1);
                    if($resultd1 > 0)
                    {
                        
                    }
                    else
                    {
                        echo "5";
                    }
                }
                
            }
            else if($ostock != 0 && $nstock == 0)
            {
                // get from stock for new 
                $sql1="SELECT * FROM `stock` WHERE `item_id`='$id' LIMIT 1";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0)
                {
                    while($row1 = mysqli_fetch_assoc($result1))
                    {
                        $sid = $row1['id'];
                        $trprice=$row1['rprice'];
                        $tcprice=$row1['cprice'];
                        $qty=$row1['qty'];
                    }
                    
                    $sql2="UPDATE `items` SET `new_stock`='$qty',`new_stoct_price`='$trprice',`new_stock_cprice`='$tcprice' where `id` = '$id'";
                    $result2 = $conn->query($sql2);
                    if($result2 > 0)
                    {
                        $dlt="DELETE FROM `stock` WHERE `id`='$sid'";
                        $resultd = $conn->query($dlt);
                        if($resultd > 0)
                        {
                            
                        }
                        else
                        {
                            echo "4";
                        }
                    }
                    else
                    {
                        echo "1";
                    }
                }
            }
        }
    }
    
    
    
    
    
    
     // ================   For Maintain Stocks(End)   ====================
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link rel="stylesheet" href="css/toastr.min.css">
    <link rel="stylesheet" href="css/Style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    <div class="wrapper">

        <?php include("master/header.php")?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include("master/dashboard.php")?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Sale Products
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                    <li><a href="#">Sale</a></li>
                    <li class="active">Sale Products</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- /.box -->

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Products</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="product" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 40px;"> Product No.#</th>
                                            <th> Name</th>
                                            <th> Bike</th>
                                            <th> Company</th>
                                            <!--<th> Old Stock</th>-->
                                            <th style="width: 70px;"> Total Stock</th>
                                            <th style="width: 70px;"> Old Stock</th>
                                            <th style="width: 70px;"> Old Stock Cost Price</th>
                                            <th style="width: 70px;"> Old Stock Retail Price</th>
                                            <th style="width: 70px;"> New Stock</th>
                                            <th style="width: 70px;"> New Stock Cost Price</th>
                                            <th style="width: 70px;"> New Stock Retail Price</th>
                                            <!--<th> New Stock</th>-->
                                            <!--<th> New Stock Price</th>-->
                                            <!--<th> New Stock Retail Price</th>-->
                                            <!--<th> Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
									     <?php
                    
                                            $count=0;
                                            $sql = "SELECT items.*,company.name As cname,bike.name As bname FROM `items`,`bike`,`company` where total_stock not in ('0') and items.company_id = company.id AND items.bike_id = bike.id";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0)
                                            {
                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                                    $count++;
                                                    $id = $row['id'];
                                                    $name = $row['name'];
                                                    $tstock = $row['total_stock'];
                                                    $ostock = $row['old_stock'];
                                                    $os_cprice = $row['old_stock_cprice'];
                                                    $os_rprice = $row['old_stoct_price'];
                                                    $nstock = $row['new_stock'];
                                                    $ns_cprice = $row['new_stock_cprice'];
                                                    $ns_rprice = $row['new_stoct_price'];
                                                    $bname = $row['bname'];
                                                    $cname = $row['cname'];
                                        ?>
										<tr>
                                            <td> <?php echo $id;?></td>
                                            <td> <?php echo $name;?></td>
                                            <td> <?php echo $bname;?></td>
                                            <td> <?php echo $cname;?></td>
                                            <td> <?php echo ($ostock+$nstock);?></td>
                                            <td> <?php echo $ostock;?></td>
                                            <td> <?php echo $os_cprice;?></td>
                                            <td > <?php echo $os_rprice;?></td>
                                            <td> <?php echo $nstock;?></td>
                                            <td> <?php echo $ns_cprice;?></td>
                                            <td > <?php echo $ns_rprice;?></td>
                                            <!--<td>-->
                                            <!--    <div style="display: inline-flex;" role="group">-->
                                            <!--        <form action="addstock.php" method="POST">-->
                                            <!--            <input type="hidden" name="action_id" value="<?php echo $id;?>">-->
                                            <!--            <button type="submit" name="addstock"  data-toggle="tooltip" data-placement="top" title="Add Stock" class="btn btn-secondary"><i class="fas fa-plus"></i></button>-->
                                            <!--        </form>-->
                                            <!--        <form action="edititem.php" method="POST">-->
                                            <!--            <input type="hidden" name="action_id" value="<?php echo $id;?>">-->
                                            <!--            <button type="submit" name="edit_item"  data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-secondary"><i class="fas fa-edit"></i></button>-->
                                            <!--        </form>-->
                                            <!--        <form action="function.php" method="POST">-->
                                            <!--            <input type="hidden" name="action_id" value="<?php echo $id;?>">-->
                                            <!--            <button type="submit" name="delete_item"  onclick="return confirm('Are you sure, you want to delete?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-secondary"><i class="fas fa-trash"></i></button>-->
                                            <!--        </form>-->
                                            <!--    </div>    -->
                                            <!--</td>-->
                                        </tr>
                                        <?php
                                                }
                                            }
                                        ?>
									</tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box-body -->
                        
                    </div>
                    <!-- /.box -->
                    <div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Product Details</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							
			                <form role="form" action="function.php" method="POST">
								<div class="box-body">
								    <div class="row">
								        <div class="col-sm-6">
								            <div class="form-group">
        										<label for="exampleInputPassword1"> Product Number</label>
        										<input type="number" class="form-control" name="pid" id="pid" readonly placeholder=" Product Number">
        									</div>
        									<div class="form-group">
            									<label for="exampleInputPassword1">Quantaty</label>
            									<input type="number" min="1" max="999" class="form-control" name="qty" required id="qty" placeholder="Quantaty">
            								</div>
            					            <div class="form-group">
            									<label for="exampleInputPassword1">Discount<small></small></label>
            									<input type="number" class="form-control" name="discount" id="discount" placeholder="Discount">
            								</div>
    								        
            								<!--<div class="form-group">-->
            								<!--	<label for="exampleInputPassword1">Total Amount<small></small></label>-->
            								<!--	<input type="number" class="form-control" name="tprice" readonly id="tprice" placeholder="Total Amount">-->
            								<!--</div>-->
								        </div>
								        <div class="col-sm-6">
								            <div class="form-group">
        										<label for="exampleInputPassword1"> Product Name</label>
        										<input type="text" class="form-control" name="pname" id="pname" readonly placeholder=" Product Name">
        									</div>
        									<div class="form-group">
            									<label for="exampleInputPassword1">Retail Price</label>
            									<input type="number" class="form-control" name="rprice" required id="rprice" placeholder="Retail Price Per Product">
            								</div>
            								<div class="row">
            								    <div class="col-sm-6">
            								        <div class="form-group">
                                                        <label>Comission<small class="text-info"> in %age</small></label>
                                                        <input type="number" class="form-control" name="rprice" required id="comission" placeholder="Enter Comission">
                                                    </div>
            								    </div>
            								    <div class="col-sm-6">
            								        <div class="form-group">
                                                        <label>Labour Name</label>
                                                        <select class="form-control select2 col-sm-12" onchange="disablee()" id="cus_name" >
                                                          <option value="0" hidden selected="selected"> -- Labour Name -- </option>
                                                            <?php 
                                                            $sql = "SELECT * FROM `labour`";
                                                            $result = $conn->query($sql);
                                                            if ($result->num_rows > 0)
                                                            {
                                                                while($row = mysqli_fetch_assoc($result))
                                                                {
                                                                    $name = $row['name'];
                                                                    $id = $row['id'];
                                                            ?>
                                                            <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                                            <?php }} ?>
                                                        </select>
                                                      </div>
            								    </div>
            								</div>
								        </div>
								    </div>
    								<div class="box-footer">
    									<button type="button" name="add_item" id="addto" class="btn btn-primary btn-block">Add</button>
    								</div>
								</div>
								
		                	</form>
						</div>
						<!-- /.box -->
					</div>
                            <div class="col-md-12">
                                <div class="box box-primary">
                                     <div class="box-header with-border">
                                        <h4 class="box-title">Invoice</h4>
                                    </div>
                                    <div class="box-body" id="printshow">
                                        <center><h2>KBH</h2></center>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="pull-left m-t-30">
                                                    <address>
                                                        <strong>Twitter, Inc.</strong><br>
                                                        795 Folsom Ave, Suite 600<br>
                                                        San Francisco, CA 94107<br>
                                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                                    </address>
                                                </div>
                                                <div class="pull-right m-t-20">
                                                    <p class="m-t-10"><strong>Order ID: </strong> <as id="cnmbr">L<?php echo date('YmdHis'); ?></as></p>
                                                    <p><strong>Customer Name: </strong>
                                                        <as id="customername"></as>
                                                        
                                                    </p>
                                                    <p><strong>Date: </strong> <?php echo date('d-m-Y'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-h-50"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table m-t-30" id="invoicet">
                                                        <thead>
                                                        <tr>
                                                            <th>Product Code</th>
                                                            <th>Name</th>
                                                            <th>Quantity</th>
                                                            <th>Unit Cost</th>
                                                            <th>Total</th>
                                                            <th>Discount</th>
                                                            <th>Remove</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="clearfix m-t-40">
                                                    <h5 class="small text-inverse">PAYMENT TERMS AND POLICIES</h5>

                                                    <small>
                                                        All accounts are to be paid within 7 days from receipt of
                                                        invoice. To be paid by cheque or credit card or direct payment
                                                        online. If account is not paid within 7 days the credits details
                                                        supplied as confirmation of work undertaken will be charged the
                                                        agreed quoted fee noted above.
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-right">Sub-total:<as id="subtotl"> </as></p>
                                                <p class="text-right">Discout: <as id="disc"></as></p>
                                                <p class="text-right"><b>Total: <as id="totlam1"></as></b></p>
                                                <p class="text-right">Commission: <as id="comision"> </as> % : Rs <as id="comisionv"></as></p>
                                                <hr>
                                                <h4 class="text-right">Rs <as id="totlam2"></as></h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-print-none">
                                            <div class="text-right">
                                                <a onclick="printDiv()" id="print" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                <a href="#" onclick="approve()" id="approve" class="btn btn-primary waves-effect waves-light">Submit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <!-- /.col -->
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include("master/footer.php")?>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane" id="control-sidebar-home-tab">
                    <h3 class="control-sidebar-heading">Recent Activity</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                    <h3 class="control-sidebar-heading">Tasks Progress</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Custom Template Design
                                    <span class="label label-danger pull-right">70%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Update Resume
                                    <span class="label label-success pull-right">95%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Laravel Integration
                                    <span class="label label-warning pull-right">50%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Back End Framework
                                    <span class="label label-primary pull-right">68%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                </div>
                <!-- /.tab-pane -->

                <!-- Settings tab content -->
                <div class="tab-pane" id="control-sidebar-settings-tab">
                    <form method="post">
                        <h3 class="control-sidebar-heading">General Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

                            <p>
                                Some information about this general settings option
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

                            <p>
                                Other sets of options are available
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

                            <p>
                                Allow the user to show his name in blog posts
                            </p>
                        </div>
                        <!-- /.form-group -->

                        <h3 class="control-sidebar-heading">Chat Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
                        </div>
                        <!-- /.form-group -->
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/select2.full.min.js"></script>
    <!-- DataTables -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="js/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="js/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="js/demo.js"></script>
	<script src="js/toastr.min.js"></script>
	<script src="js/script.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $('.select2').select2();
            $('#product').DataTable();
            $("#print").hide();
        });
        $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
    </script>
    
    <script>
	    <?php 
	        if(isset($_GET['success']))
	        {
	            $msg = $_GET['success'];
	            ?>
	            toastr.success('<?php echo $msg;?>','Success!');
	            
	            <?php
	        }
	        if(isset($_GET['error']))
	        {
	            $msg = $_GET['error'];
	            ?>
	            toastr.error('<?php echo $msg;?>','Error!');
	            
	            <?php
	        }
	        
	    ?>
	</script>
	
	<script>
	function val(a)
				{
					if(a == '' || a == " ")
					{
						return 0;
					}
					else
					{
						return parseInt(a);
					}
				}
				
				

	var pid,pname,pnqty,poqty,pncprice,porprice,pnrprice,pocprice,tqty,index=0,index2=0,pprice=0;
	var cusname,cusid,custype,labour_com,cusstatus=false;
	var tpid=document.getElementById("pid") ,
	tpname=document.getElementById("pname") ;
	var table2=document.getElementById('invoicet');
	
	$('#product').find('tr').click( function(){
        index= ($(this).index()+1) ;
    });
                
// 	ttprice=document.getElementById("tprice") ,
// 	trprice=document.getElementById("rprice") ,
	
	    var table = document.getElementById('product');
		for (var i = 1; i < table.rows.length; i++) {
			table.rows[i].onclick = function() {
				pid = val(this.cells[0].innerHTML);
				pname = this.cells[1].innerHTML;
				tqty = val(this.cells[4].innerHTML);
				poqty = val(this.cells[5].innerHTML);
				pocprice = val(this.cells[6].innerHTML);
				porprice = val(this.cells[7].innerHTML);
				pnqty = val(this.cells[8].innerHTML);
				pncprice = val(this.cells[9].innerHTML);
				pnrprice = val(this.cells[10].innerHTML);
				tpid.value=pid;
            	tpname.value=pname;
				$("#qty").attr({ "max" : tqty });
				//rIndex = this.rowIndex;
				// document.getElementById("dishname").value = this.cells[0].innerHTML;
				// namee= this.cells[0].innerHTML;

				var finalpriceee=0;
				// 	for(var j=1;j<=table2.rows.length;j++)
				// 		{
				// 			 finalpriceee=finalpriceee + parseInt(table2.rows[j].cells[5].innerHTML);
							 
				// 		finalprice.innerHTML=finalpriceee;
						    	
				// 		}

			};

		}
		
		document.getElementById("addto").onclick = function() 
		{
    		if(document.getElementById("pid").value == ""|| document.getElementById("pname").value == ""|| document.getElementById("qty").value == ""|| document.getElementById("rprice").value == "")
    		{
    			alert("please fill the form");
    		}
    		else if(val(document.getElementById("qty").value) > tqty)
    		{
    		    alert('Available quantaty is '+tqty);
    		}
    		else
    		{
    		    var ajax=false;
            	var tpqty=val(document.getElementById("qty").value) ;
            	var tdiscount=document.getElementById("discount").value ;
    	        var oldq=0,newq=0;
    	        table.rows[index].cells[4].innerHTML=tqty-tpqty;
    	        if(tpqty <= poqty)
    	        {
    	            oldq=tpqty;
    	            pprice=porprice;
    	            table.rows[index].cells[5].innerHTML=poqty-tpqty;
    	        }
    	        else if(tpqty > poqty)
    	        {
    	            pprice=pnrprice;
    	            oldq=poqty;
    	            table.rows[index].cells[4].innerHTML=tqty-tpqty;
    	            table.rows[index].cells[5].innerHTML="0";
    	            tpqty=tpqty-poqty;
    	            if(tpqty <= pnqty)
    	            {
    	                newq=tpqty;
    	                table.rows[index].cells[8].innerHTML=pnqty-tpqty;
    	            }
    	            else
    	            {
    	               // toastr.error('Quantaty is not availabale.','Alert!');
    	            }
    	        }
    	        var pricc=val(document.getElementById("rprice").value);
            	$("#invoicet").find('tbody').append( "<tr><td>"+pid+"</td><td>"+pname+"</td><td>"+document.getElementById("qty").value+"</td><td>"+pricc+"</td><td>"+(document.getElementById("qty").value*pricc)+"</td><td>"+val(tdiscount)+"</td><td><input type='button' class='deleteDep btn btn-danger btn-xs' value='X'/></td><td style='display:none;'>"+oldq+"</td><td style='display:none;'>"+newq+"</td></tr>" );
    	            
    			
                    
                    // alert(+" ");
                // table.rows[index].cells[4].innerHTML=(val(table.rows[index].cells[4].innerHTML)-val(tpqty));
                
    			document.getElementById("pid").value = "";
    			document.getElementById("pname").value = "";
    			document.getElementById("qty").value = "";
    			document.getElementById("discount").value = "";
    			document.getElementById("rprice").value="";
    					
    			
    						
    	        $('body').on('click', 'input.deleteDep', function() 
    	        {
    	            index2=$(this).parents('tr').index();
    	            var delid=table2.rows[index2+1].cells[0].innerHTML;
    	            
    	           // alert(delid+1);
    	            for(var j=1;j<=table.rows.length;j++)
					{
					   // alert(table.rows[j].cells[0].innerHTML+" =  "+delid);
						 if(val(table.rows[j].cells[0].innerHTML) == val(delid))
						 {
						     table.rows[j].cells[4].innerHTML = (val(table.rows[j].cells[4].innerHTML) + val(table2.rows[index2+1].cells[2].innerHTML));
						     table.rows[j].cells[5].innerHTML = (val(table.rows[j].cells[5].innerHTML) + val(table2.rows[index2+1].cells[7].innerHTML));
						     table.rows[j].cells[8].innerHTML = (val(table.rows[j].cells[8].innerHTML) + val(table2.rows[index2+1].cells[8].innerHTML));
						     $(this).parents('tr').remove();  
						     var finalpriceee=0;
                			var disc=0;
                			if(table2.rows.length > 1)
                			{
                    			for(var i=1;i<=table2.rows.length;i++)
                    			{
                    			 //   alert((9+)+"  ");
                    				finalpriceee += val(table2.rows[i].cells[4].innerHTML);
                    				disc += val(table2.rows[i].cells[5].innerHTML);		
                    				document.getElementById("subtotl").innerHTML = finalpriceee;
                    				document.getElementById("disc").innerHTML = disc;
                    				document.getElementById("comision").innerHTML = labour_com;
                    				document.getElementById("comisionv").innerHTML = ((finalpriceee-disc)/100)*val(labour_com);
    				                document.getElementById("totlam2").innerHTML = ((finalpriceee-disc)-(((finalpriceee-disc)/100)*val(labour_com)));
                    			}
                			}
                			else
                			{
                			    document.getElementById("subtotl").innerHTML = "0";
                				document.getElementById("disc").innerHTML = "0";
                				document.getElementById("totlam1").innerHTML = "0";
                				document.getElementById("comisionv").innerHTML = "0";
            				    document.getElementById("totlam2").innerHTML = "0";
                			}
						 }
					}
                });
                
                var finalpriceee=0;
    			var disc=0;
    			for(var i=1;i<=table2.rows.length;i++)
    			{
    			 //   alert((9+)+"  ");
    				finalpriceee += val(table2.rows[i].cells[4].innerHTML);
    				disc += val(table2.rows[i].cells[5].innerHTML);		
    				document.getElementById("subtotl").innerHTML = finalpriceee;
    				document.getElementById("disc").innerHTML = disc;
    				document.getElementById("totlam1").innerHTML = (finalpriceee-disc);
    				document.getElementById("comision").innerHTML = labour_com;
    				document.getElementById("comisionv").innerHTML = ((finalpriceee-disc)/100)*val(labour_com);
	                document.getElementById("totlam2").innerHTML = ((finalpriceee-disc)-(((finalpriceee-disc)/100)*val(labour_com)));
    			}
    		}
	    }
	    
	    function approve()
        {
            if (!cusstatus) {
                  alert('Please Add Customer Details');
            }
            else if(table2.rows.length <= 1)
            {
                alert('Please Add Atleast One Product.');
            }
            else
            {
                $('#invoicet tr').find('td:eq(6),th:eq(6)').remove();
                qry=document.getElementById("cnmbr").innerHTML+"|"+cusid+"|"+labour_com+"|"+custype;
                var j=0,i;
                for( i=1;i <table2.rows.length;i++)
    			{
                    qry=qry +"|"+ document.getElementById("invoicet").rows[i].cells[0].innerHTML
                    +","+document.getElementById("invoicet").rows[i].cells[1].innerHTML
                    +","+document.getElementById("invoicet").rows[i].cells[2].innerHTML
                    +","+document.getElementById("invoicet").rows[i].cells[3].innerHTML
                    +","+document.getElementById("invoicet").rows[i].cells[4].innerHTML
                    +","+document.getElementById("invoicet").rows[i].cells[5].innerHTML;
                }
                // alert(qry);
                $.ajax({
    	            type:"post",
    	            url:"seller.php",
    	            data: {data: qry},
    	            success: function(data){
    			     //   console.log("Ajax Response" + data);
    			     //alert(data);
                     $("#addto").hide();
                     $("#approve").hide();
                     $("#print").show();
    			    }
    			});
                
                //console.log(qry);
                }
            }
	    
		function printDiv() {
		    
		    
			var printContents = document.getElementById('printshow').innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents
			//var divToPrint = document.getElementById('ContentPlaceHolder2_Panel1');
			//var newWin = window.open('', 'Print-Window');
			//newWin.document.open();
			//newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
			//newWin.document.close();
			//setTimeout(function () { newWin.close(); }, 10);
		}
		

		function disablee()
    	{
    	    if(document.getElementById("comission").value == ''|| document.getElementById("comission").value == null)
    	    {
    	        alert("Please Enter Commission First..");
    	    }
    	    else if(confirm('Are you sure?'))
    	    {
    	        var customer=document.getElementById("cus_name");
                cusid = customer.options[customer.selectedIndex].value;
                cusname = customer.options[customer.selectedIndex].text;
                labour_com=document.getElementById("comission").value;
                document.getElementById("comision").innerHTML = labour_com;
    		    custype="labour";
    	        document.getElementById("cus_name").disabled=true;
    	        document.getElementById("comission").disabled=true;
    	        document.getElementById("customername").innerHTML = cusname;
    	       // alert(cusid+"|"+cusname+"|"+custype);
    	        cusstatus=true;
    	    }
    	    else
    	    {
    	        document.getElementById('cus_name').getElementsByTagName('option')[0].selected = 'selected';
    	    }
    	}
	</script>
</body>

</html>