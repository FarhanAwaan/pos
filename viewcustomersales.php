<?php
include('connection.php');

    

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
                <h1>
                    Products
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li class="active">View Products</li>
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
                                <table id="example1" class="table table-bordered table-striped">
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
                    
                                            $count=0;
                                            if(isset($_POST['viewcustomersales']))
                                            {
                                                $id=$_POST['action_id'];
                                                $sql = "SELECT vendor_sell.*,customer.name AS cname FROM vendor_sell,customer WHERE `customer_id`='$id' AND vendor_sell.customer_id=customer.id GROUP BY `invoice_no` ORDER by date DESC";
                                            }
                                            else
                                            {
                                                $sql = "SELECT vendor_sell.*,customer.name AS cname FROM vendor_sell,customer WHERE vendor_sell.customer_id=customer.id GROUP BY `invoice_no` ORDER by date DESC";
                                            }
                                            
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
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include("master/footer.php");?>
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
    <!-- page script -->
    <script>
        $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });
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
</body>

</html>