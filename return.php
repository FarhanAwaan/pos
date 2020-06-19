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
      <h1> Rerutns </h1>
     
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li><a href="#">Rerutn from customer</a></li>
        <li class="active">Return to vendor</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
            <div class="box-tools">
           <button class="btn btn-primary" onclick="window.location.href= 'addreturns.php'">Add Returns</button>
         </div>
              <h3 class="box-title">Rerutns to Vendor</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="customer" class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                    <th style="width: 40px;"> Rerutns No.#</th>
                    <th>Vendor Name</th>
                    <th>Item Name</th>
                    <th> Returnee</th>
                    <th> Shop Name</th>
                    <th style="width: 70px;"> Date</th>
                    <th style="width: 70px;"> Address</th>
                    <th style="width: 70px;"> Old Stock</th>
                    <th style="width: 70px;"> New Stock</th>
                    <th style="width: 70px;"> Number1 | Number2</th>
                    <th style="width: 70px;"> Total Stock</th>
                    <th style="width: 70px;"> Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 			  
                           $sql = "SELECT r.*,it.name as itemname,it.old_stock as old_stock,
                                                it.new_stock as new_stock,it.total_stock as total_stock,
                                                vr.id as vid,vr.name as vname,vr.shop_name as shop,
                                                vr.date as dt,vr.address as addre,vr.number1 as num1,vr.number2 as num2,
                                                cm.id,cm.name,cm.shop_name,
                                                cm.pending_amount as cpam,cm.date,cm.address,cm.number1,cm.number2
                                    from `returns` r 
                                      left join customer cm 
                                        on 
                                      r.cid = cm.id
                                      left join items it 
                                        on 
                                      r.returnitemid = it.id
                                      left join vendor vr 
                                        on 
                                      r.vid = vr.id where r.returnee='vendor' ";
							$result = $conn->query($sql);
							//print_r($row = mysqli_fetch_assoc($result));
							if ($result->num_rows > 0)
							{
								while($row = mysqli_fetch_assoc($result))
								{
									$returnid = $row['returnid'];
									$id = $row['vid'];
                  $name = $row['vname'];
                  $itemname = $row['itemname'];
                  $old_stock = $row['old_stock'];
                  $new_stock = $row['new_stock'];
                  $total_stock = $row['total_stock'];
                 $itemname = $row['itemname'];
                  $returnee = $row['returnee'];
									$shop_name = $row['shop'];
									$date = $row['created_date'];
									$address = $row['addre'];
									$number1 = $row['num1'];
									$number2 = $row['num2'];
							    ?>
                  <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $name;?></td>
                    <td><?php echo $itemname;?></td>
                    <td><?php echo $returnee;?></td>
                    <td><?php echo $shop_name;?></td>
                    <td><?php echo $date;?></td>
                    <td><?php echo $address;?></td>
                    <td><?php echo $old_stock;?></td>
                    <td><?php echo $new_stock;?></td>
                    <td><?php echo $number1;?> | <?php echo $number2;?></td>
                    <td ><?php echo $total_stock;?></td>
                    <td><?php //if ($_SESSION['role'] == 'admin') { ?>
                      <div style="display: inline-flex;" role="group">
                        <form action="editreturns.php" method="POST">
                          <input type="hidden" name="action_id" value="<?php echo $returnid;?>">
                          <button type="submit" name="edit_return"  data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                        </form>
                        <form action="function.php" method="POST">
                          <input type="hidden" name="action_id" value="<?php echo $returnid;?>">
                          <button type="submit" name="delete_vendor_return"  onclick="return confirm('Are you sure, you want to delete?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-secondary"><i class="fas fa-trash"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  <?php  } } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title">Returns from Customer</h4>
              <div class="box-tools">
                 <button class="btn btn-primary" onclick="window.location.href= 'addreturns.php'">Add Returns</button>
               </div>
            </div>
            <table id="customer" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th style="width: 40px;"> Rerutns No.#</th>
                  <th> Customer Name</th>
                  <th>Item Name</th>
                  <th>Retrunee</th>
                  <th> Shop Name</th>
                  <th> Pending Amount</th>
                  <th style="width: 70px;"> Date</th>
                  <th style="width: 70px;"> Address</th>
                  <th style="width: 70px;"> Old Stock</th>
                  <th style="width: 70px;"> New Stock</th>
                  <th style="width: 70px;"> Number1|Number2</th>
                  <th style="width: 70px;">Total Stock </th>
                  <th style="width: 70px;"> Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 		
                	  $sql = "SELECT r.*,it.name as itemname,it.old_stock as old_stock,
                                            it.new_stock as new_stock,it.total_stock as total_stock,
                                            vr.id as vid,vr.name as vname,vr.shop_name as shop,
                                            vr.date as dt,vr.address as addre,vr.number1 as num1,vr.number2 as num2,
                                            cm.id,cm.name,cm.shop_name,
                                            cm.pending_amount as cpam,cm.date,cm.address,cm.number1,cm.number2
														          from `returns` r 
                                        left join customer cm 
                                          on 
                                        r.cid = cm.id
                                        left join items it 
                                          on 
                                        r.returnitemid = it.id
                                        left join vendor vr 
                                          on 
                                        r.vid = vr.id where r.returnee='customer'	";
							$result = $conn->query($sql);
							//print_r($row = mysqli_fetch_assoc($result));
							if ($result->num_rows > 0)
							{
								while($row = mysqli_fetch_assoc($result))
								{
                  $returnid = $row['returnid'];
                  $returnee = $row['returnee'];
									$id = $row['id'];
                  $name = $row['name'];
                  $itemname = $row['itemname'];
                  $old_stock = $row['old_stock'];
                  $old_stock = $row['old_stock'];
                  $total_stock = $row['total_stock'];
									$shop_name = $row['shop_name'];
									$date = $row['created_date'];
									$address = $row['address'];
									$number1 = $row['number1'];
									$number2 = $row['number2'];
									$pending_amount= $row['cpam'];
             ?>
                <tr>
                  <td><?php echo $id;?></td>
                  <td><?php echo $name;?></td>
                  <td><?php echo $itemname;?></td>
                  <td><?php echo $returnee;?></td>
                  <td><?php echo $shop_name;?></td>
                  <td><?php echo $pending_amount;?></td>
                  <td><?php echo $date;?></td>
                  <td><?php echo $address;?></td>
                  <td><?php echo $old_stock;?></td>
                  <td><?php echo $new_stock;?></td>
                  <td><?php echo $number1;?> | <?php echo $number2;?></td>
                  <td><?php echo $total_stock;?></td>
                  <td><?php //if ($_SESSION['role'] == 'admin') { ?>
                    <div style="display: inline-flex;" role="group">
                      <form action="editreturns.php" method="POST">
                        <input type="hidden" name="action_id" value="<?php echo $returnid;?>">
                        <button type="submit" name="edit_return"  data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                      </form>
                      <form action="function.php" method="POST">
                        <input type="hidden" name="action_id" value="<?php echo $returnid;?>">
                        <button type="submit" name="delete_customer_return"  onclick="return confirm('Are you sure, you want to delete?');" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-secondary"><i class="fas fa-trash"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
                <?php  } } ?>
              </tbody>
            </table>
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
