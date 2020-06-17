<?php
   include('connection.php');    
   $date=date('d-m-Y');
    $count=0;
    $totl_earning;
    $sql = "select sum((`qty`*`price`)-`discount`) as val from vendor_sell;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $totl_earning = $row['val'];
        }
    }
    $sql = "select sum((`qty`*`price`)-`discount`) as val from labour_sell;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $totl_earning += $row['val'];
        }
    }
    $sql = "select sum((`qty`*`price`)-`discount`) as val from retail_sell;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $totl_earning += $row['val'];
        }
    }
    
    $sql = "SELECT sum(`pending_amount`) as val FROM `customer`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $totl_pending = $row['val'];
        }
    }
    
    
    $sql = "SELECT count(`id`) as val FROM `customer`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $totl_customer = $row['val'];
        }
    }
    $sql = "SELECT count(`id`) as val FROM `labour`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $totl_labour = $row['val'];
        }
    }
    $sql = "SELECT count(`id`) as val FROM `items`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $totl_items = $row['val'];
        }
    }
    
    $sql = "SELECT count(`id`) as val FROM `vendor`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $totl_vendor = $row['val'];
        }
    }
    
     $sql = "SELECT COUNT(id) as val FROM `customer` WHERE `pending_amount` NOT in (0);";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $totl_pending_cus = $row['val'];
        }
    }
    
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
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include("master/header.php")?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include("master/dashboard.php")?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <!-- <pre>
                <?php 
            // print_r($_SESSION);
            ?>
              </pre> -->
                <h1>
                    Dashboard
                    <small>Version 2.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <div class="row col-sm-12">
                
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h2><?php echo $totl_items;?></h2>

              <p>Total Items</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h2>Rs <?php echo $totl_earning;?></h2>

              <p>Total Sell Amount</p>
            </div>
            <div class="icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h2>Rs <?php echo ($totl_earning-$totl_pending);?></h2>

              <p>Total Paid Amount</p>
            </div>
            <div class="icon">
              <i class="fas fa-dollar-sign"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h2>Rs <?php echo $totl_pending;?></h2>

              <p>Total Pending Amount</p>
            </div>
            <div class="icon">
              <i class="fas fa-dollar-sign"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
      </div>
      <div class="row col-sm-12">
                
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h2><?php echo $totl_vendor;?></h2>

              <p>Total Vendors</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h2><?php echo $totl_labour;?></h2>

              <p>Total Labours</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h2><?php echo $totl_customer;?></h2>

              <p>Total Customers</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h2><?php echo $totl_pending_cus;?></h2>

              <p>Total Pending Customers</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
      </div>
        <div class="col-md-12">
          <div class="box box-solid">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Purchaces
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse">
                    <div class="box-body">
                      <table id="table1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> No.#</th>
                                <th> Vendor</th>
                                <th> Invoive_no</th>
                                <!--<th> Company</th>-->
                                <!--<th> Old Stock</th>-->
                                <!--<th> Quantity</th>-->
                                <!--<th> Cost Price</th>-->
                                <!--<th> Retail Price</th>-->
                                <th> Date</th>
                                <!--<th> New Stock Price</th>-->
                                <!--<th> New Stock Retail Price</th>-->
                                <th> Action</th>
                            </tr>
                        </thead>
						<tbody>
						     <?php
                                $date=date('d-m-Y');
                                $count=0;
                                $sql = "SELECT buy_items.*,vendor.name AS vname FROM buy_items,vendor WHERE buy_items.date='$date' and buy_items.vendor_id=vendor.id GROUP BY `invoice_no` ";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        $count++;
                                        $id = $row['id'];
                                        $vname = $row['vname'];
                                        $date = $row['date'];
                                        $invoice = $row['invoice_no'];
                                        $vid = $row['vendor_id'];
                            ?>
							<tr>
                                <td> <?php echo $count;?></td>
                                <td> <?php echo $vname;?></td>
                                <td> <?php echo $invoice;?></td>
                                <td > <?php echo $date;?></td>
                                <td>
                                    <div style="display: inline-flex;" role="group">
                                        <form action="viewinvoice.php" method="POST">
                                            <input type="hidden" name="invoice_no" value="<?php echo $invoice;?>">
                                            <input type="hidden" name="vendor_id" value="<?php echo $vid;?>">
                                            <input type="hidden" name="vendor_name" value="<?php echo $vname;?>">
                                            <input type="hidden" name="date" value="<?php echo $date;?>">
                                            <button type="submit" name="viewinvoice"  data-toggle="tooltip" data-placement="top" title="View Invoice" class="btn btn-secondary"><i class="fas fa-file-invoice"></i></button>
                                        </form>
                                        <form action="function.php" method="POST">
                                            <input type="hidden" name="action_id" value="<?php echo $id;?>">
                                            <button type="submit" name="delete_buy"  onclick="return confirm('Are you sure, you want to delete?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-secondary"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>    
                                </td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
						</tbody>
                    </table>
                    </div>
                  </div>
                </div>
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                         Invoice 
                        
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="box-body">
                          <!-- Custom Tabs -->
                          <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#invoice1" data-toggle="tab">Customer</a></li>
                              <li><a href="#invoice2" data-toggle="tab">Retail</a></li>
                              <li><a href="#invoice3" data-toggle="tab">Labour</a></li>
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="invoice1">
                                <table id="table2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> No.#</th>
                                            <th> Name</th>
                                            <th> Invoive_no</th>
                                            <!--<th> Company</th>-->
                                            <!--<th> Old Stock</th>-->
                                            <!--<th> Quantity</th>-->
                                            <!--<th> Cost Price</th>-->
                                            <!--<th> Retail Price</th>-->
                                            <th> Date Time</th>
                                            <!--<th> New Stock Price</th>-->
                                            <!--<th> New Stock Retail Price</th>-->
                                            <th> Action</th>
                                        </tr>
                                    </thead>
									<tbody>
									     <?php
                    $date=date('d-m-Y');
                                            $count=0;
                                                $sql = "SELECT vendor_sell.*,customer.name AS cname FROM vendor_sell,customer WHERE vendor_sell.`date`='$date' and vendor_sell.customer_id=customer.id GROUP BY `invoice_no` ORDER by date DESC";
                                            
                                            
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0)
                                            {
                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                                    $count++;
                                                    $id = $row['id'];
                                                    $vname = $row['cname'];
                                                    $date = $row['date'];
                                                    $time = $row['time'];
                                                    $invoice = $row['invoice_no'];
                                                    $vid = $row['customer_id'];
                                        ?>
										<tr>
                                            <td> <?php echo $count;?></td>
                                            <td> <?php echo $vname;?></td>
                                            <td> <?php echo $invoice;?></td>
                                            <td > <?php echo $date."  ".$time;?></td>
                                            <td>
                                                <div style="display: inline-flex;" role="group">
                                                    <form action="viewcustomerinvoice.php" method="POST">
                                                        <input type="hidden" name="invoice_no" value="<?php echo $invoice;?>">
                                                        <input type="hidden" name="customer_id" value="<?php echo $vid;?>">
                                                        <input type="hidden" name="customer_name" value="<?php echo $vname;?>">
                                                        <input type="hidden" name="date" value="<?php echo $date;?>">
                                                        <button type="submit" name="viewinvoice"  data-toggle="tooltip" data-placement="top" title="View Invoice" class="btn btn-secondary"><i class="fas fa-file-invoice"></i></button>
                                                    </form>
                                                    <!--<form action="function.php" method="POST">-->
                                                    <!--    <input type="hidden" name="action_id" value="<?php echo $id;?>">-->
                                                    <!--    <button type="submit" name="delete_customer"  onclick="return confirm('Are you sure, you want to delete?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-secondary"><i class="fas fa-trash"></i></button>-->
                                                    <!--</form>-->
                                                </div>    
                                            </td>
                                        </tr>
                                        <?php
                                                }
                                            }
                                        ?>
									</tbody>
                                </table>
                              </div>
                              <!-- /.tab-pane -->
                              <div class="tab-pane" id="invoice2">
                                <table id="table3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> No.#</th>
                                            <th> Name</th>
                                            <th> Invoive_no</th>
                                            <!--<th> Company</th>-->
                                            <!--<th> Old Stock</th>-->
                                            <!--<th> Quantity</th>-->
                                            <!--<th> Cost Price</th>-->
                                            <!--<th> Retail Price</th>-->
                                            <th> Date</th>
                                            <!--<th> New Stock Price</th>-->
                                            <!--<th> New Stock Retail Price</th>-->
                                            <th> Action</th>
                                        </tr>
                                    </thead>
									<tbody>
									     <?php
                    $date=date('d-m-Y');
                                            $count=0;
                                            $sql = "SELECT * FROM retail_sell where date='$date' GROUP BY `invoice_no` ORDER BY date DESC";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0)
                                            {
                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                                    $count++;
                                                    $id = $row['id'];
                                                    $vname = $row['name'];
                                                    $date = $row['date'];
                                                    $invoice = $row['invoice_no'];
                                        ?>
										<tr>
                                            <td> <?php echo $count;?></td>
                                            <td> <?php echo $vname;?></td>
                                            <td> <?php echo $invoice;?></td>
                                            <td > <?php echo $date;?></td>
                                            <td>
                                                <div style="display: inline-flex;" role="group">
                                                    <form action="viewretailvoice.php" method="POST">
                                                        <input type="hidden" name="invoice_no" value="<?php echo $invoice;?>">
                                                        <input type="hidden" name="retail_name" value="<?php echo $vname;?>">
                                                        <input type="hidden" name="date" value="<?php echo $date;?>">
                                                        <button type="submit" name="viewinvoice"  data-toggle="tooltip" data-placement="top" title="View Invoice" class="btn btn-secondary"><i class="fas fa-file-invoice"></i></button>
                                                    </form>
                                                    <!--<form action="function.php" method="POST">-->
                                                    <!--    <input type="hidden" name="action_id" value="<?php echo $id;?>">-->
                                                    <!--    <button type="submit" name="delete_retail"  onclick="return confirm('Are you sure, you want to delete?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-secondary"><i class="fas fa-trash"></i></button>-->
                                                    <!--</form>-->
                                                </div>    
                                            </td>
                                        </tr>
                                        <?php
                                                }
                                            }
                                        ?>
									</tbody>
                                </table>
                              </div>
                              <!-- /.tab-pane -->
                              <div class="tab-pane" id="invoice3">
                                <table id="table4" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> No.#</th>
                                            <th> Name</th>
                                            <th> Invoive_no</th>
                                            <!--<th> Company</th>-->
                                            <!--<th> Old Stock</th>-->
                                            <!--<th> Quantity</th>-->
                                            <!--<th> Cost Price</th>-->
                                            <!--<th> Retail Price</th>-->
                                            <th> Date</th>
                                            <!--<th> New Stock Price</th>-->
                                            <!--<th> New Stock Retail Price</th>-->
                                            <th> Action</th>
                                        </tr>
                                    </thead>
									<tbody>
									     <?php
                    $date=date('d-m-Y');
                                            $count=0;
                                            $sql = "SELECT labour_sell.*,labour.name AS lname FROM labour_sell,labour WHERE labour_sell.`date`='$date' and labour_sell.labour_id=labour.id GROUP BY `invoice_no` ORDER by date DESC";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0)
                                            {
                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                                    $count++;
                                                    $id = $row['id'];
                                                    $vname = $row['lname'];
                                                    $date = $row['date'];
                                                    $invoice = $row['invoice_no'];
                                                    $vid = $row['labour_id'];
                                        ?>
										<tr>
                                            <td> <?php echo $count;?></td>
                                            <td> <?php echo $vname;?></td>
                                            <td> <?php echo $invoice;?></td>
                                            <td > <?php echo $date;?></td>
                                            <td>
                                                <div style="display: inline-flex;" role="group">
                                                    <form action="viewlabourinvoice.php" method="POST">
                                                        <input type="hidden" name="invoice_no" value="<?php echo $invoice;?>">
                                                        <input type="hidden" name="labour_id" value="<?php echo $vid;?>">
                                                        <input type="hidden" name="labour_name" value="<?php echo $vname;?>">
                                                        <input type="hidden" name="date" value="<?php echo $date;?>">
                                                        <button type="submit" name="viewinvoice"  data-toggle="tooltip" data-placement="top" title="View Invoice" class="btn btn-secondary"><i class="fas fa-file-invoice"></i></button>
                                                    </form>
                                                    <!--<form action="function.php" method="POST">-->
                                                    <!--    <input type="hidden" name="action_id" value="<?php echo $id;?>">-->
                                                    <!--    <button type="submit" name="delete_labour"  onclick="return confirm('Are you sure, you want to delete?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-secondary"><i class="fas fa-trash"></i></button>-->
                                                    <!--</form>-->
                                                </div>    
                                            </td>
                                        </tr>
                                        <?php
                                                }
                                            }
                                        ?>
									</tbody>
                                </table>
                              </div>
                              <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                          </div>
                          <!-- nav-tabs-custom -->
                    </div>
                  </div>
                </div>
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        Customer Invoice  <small class="text-info">(date)</small>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="box-body">
                      <table id="table5" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> No.#</th>
                                            <th> Name</th>
                                            <!--<th> Company</th>-->
                                            <!--<th> Old Stock</th>-->
                                            <!--<th> Quantity</th>-->
                                            <!--<th> Cost Price</th>-->
                                            <th> Pending Amount</th>
                                            <th> Date</th>
                                            <!--<th> New Stock Price</th>-->
                                            <!--<th> New Stock Retail Price</th>-->
                                            <th> Action</th>
                                        </tr>
                                    </thead>
									<tbody>
									     <?php
                    $date=date('d-m-Y');
                                            $count=0;
                                            $sql = "SELECT vendor_sell.*,customer.name AS cname,customer.pending_amount as pa FROM vendor_sell,customer WHERE vendor_sell.date='$date' and vendor_sell.customer_id IN (SELECT id from customer GROUP BY name) AND vendor_sell.customer_id=customer.id  ORDER by date DESC";
                                            
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0)
                                            {
                                                $count=0;
                                                $arr[0]="";
                                                $datee[0]="";
                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                                    $count++;
                                                    $id = $row['id'];
                                                    $vname = $row['cname'];
                                                    $date = $row['date'];
                                                    $time = $row['time'];
                                                    $pa = $row['pa'];
                                                    $vid = $row['customer_id'];
                                                    $count++;
                                                    $sear=$vname.$date;
                                                    if(!in_array($sear, $arr))
                                                    {
                                                        $arr[$count]=$vname.$date;
                                        ?>
										<tr>
                                            <td> <?php echo $count;?></td>
                                            <td> <?php echo $vname;?></td>
                                            <td > <?php echo $pa;?></td>
                                            <td > <?php echo $date?></td>
                                            <td>
                                                <div style="display: inline-flex;" role="group">
                                                    <form action="viewcustomerdateinvoice.php" method="POST">
                                                        <input type="hidden" name="customer_id" value="<?php echo $vid;?>">
                                                        <input type="hidden" name="pamount" value="<?php echo $pa;?>">
                                                        <input type="hidden" name="customer_name" value="<?php echo $vname;?>">
                                                        <input type="hidden" name="date" value="<?php echo $date;?>">
                                                        <button type="submit" name="viewinvoice"  data-toggle="tooltip" data-placement="top" title="View Invoice" class="btn btn-secondary"><i class="fas fa-file-invoice"></i></button>
                                                    </form>
                                                    <!--<form action="function.php" method="POST">-->
                                                    <!--    <input type="hidden" name="action_id" value="<?php echo $id;?>">-->
                                                    <!--    <button type="submit" name="delete_customer"  onclick="return confirm('Are you sure, you want to delete?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-secondary"><i class="fas fa-trash"></i></button>-->
                                                    <!--</form>-->
                                                </div>    
                                            </td>
                                        </tr>
                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
									</tbody>
                                </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
            
        </div>
        <!-- /.content-wrapper -->

        <?php include("master/footer.php")?>
        <!-- Control Sidebar -->
        <!-- <aside class="control-sidebar control-sidebar-dark">
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <div class="tab-content">
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

                </div>

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

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

                            <p>
                                Other sets of options are available
                            </p>
                        </div>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

                            <p>
                                Allow the user to show his name in blog posts
                            </p>
                        </div>

                        <h3 class="control-sidebar-heading">Chat Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
                        </div>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
                        </div>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
                        </div>
                    </form>
                </div>
            </div>
        </aside> -->
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
    <script>
        $(function() {
            $('#table1').DataTable();
            $('#table2').DataTable();
            $('#table3').DataTable();
            $('#table4').DataTable();
            $('#table5').DataTable();
        });
    </script>
</body>

</html>