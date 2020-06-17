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
                                <div class="box-tools">
                                    <button class="btn btn-primary" onclick="window.location.href= 'purchaseitem.php'">Add New</button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> No.#</th>
                                            <th> Name</th>
                                            <th> Bike</th>
                                            <th> Company</th>
                                            <!--<th> Old Stock</th>-->
                                            <th> Total Stock</th>
                                            <th> Stock Cost Price</th>
                                            <th> Stock Retail Price</th>
                                            <!--<th> New Stock</th>-->
                                            <!--<th> New Stock Price</th>-->
                                            <!--<th> New Stock Retail Price</th>-->
                                            <th> Action</th>
                                        </tr>
                                    </thead>
									<tbody>
									     <?php
                    
                                            $count=0;
                                            $sql = "SELECT items.*,company.name As cname,bike.name As bname FROM `items`,`bike`,`company` where items.company_id = company.id AND items.bike_id = bike.id";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0)
                                            {
                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                                    $count++;
                                                    $id = $row['id'];
                                                    $name = $row['name'];
                                                    $date = $row['date'];
                                                    $tstock = $row['total_stock'];
                                                    $os_cprice = $row['old_stock_cprice'];
                                                    $os_rprice = $row['old_stoct_price'];
                                                    $bname = $row['bname'];
                                                    $cname = $row['cname'];
                                        ?>
										<tr>
                                            <td> <?php echo $count;?></td>
                                            <td> <?php echo $name;?></td>
                                            <td> <?php echo $bname;?></td>
                                            <td> <?php echo $cname;?></td>
                                            <td> <?php echo $tstock;?></td>
                                            <td> <?php echo $os_cprice;?></td>
                                            <td > <?php echo $os_rprice;?></td>
                                            <td>
                                                <div style="display: inline-flex;" role="group">
                                                    <!--<form action="addstock.php" method="POST">-->
                                                    <!--    <input type="hidden" name="action_id" value="<?php //echo $id;?>">-->
                                                    <!--    <button type="submit" name="addstock"  data-toggle="tooltip" data-placement="top" title="Add Stock" class="btn btn-secondary"><i class="fas fa-plus"></i></button>-->
                                                    <!--</form>-->
                                                    <form action="edititem.php" method="POST">
                                                        <input type="hidden" name="action_id" value="<?php echo $id;?>">
                                                        <button type="submit" name="edit_item"  data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                                                    </form>
                                                    <form action="function.php" method="POST">
                                                        <input type="hidden" name="action_id" value="<?php echo $id;?>">
                                                        <button type="submit" name="delete_item"  onclick="return confirm('Are you sure, you want to delete?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-secondary"><i class="fas fa-trash"></i></button>
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

        <?php include("master/footer.php")?>
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