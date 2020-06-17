<?php

include('connection.php');
if(isset($_POST['edit_item']))
{
    $id=$_POST['action_id'];
    
    $sql = "SELECT * FROM `items` where `id`='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $name = $row['name'];
            $date = $row['date'];
            $ostock = $row['old_stock'];
            $os_cprice = $row['old_stock_cprice'];
            $os_rprice = $row['old_stoct_price'];
            $nstock = $row['new_stock'];
            $ns_cprice = $row['new_stock_cprice'];
            $ns_rprice = $row['new_stoct_price'];
            $biid = $row['bike_id'];
            $coid = $row['company_id'];
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
	<link rel="stylesheet" href="css/fontawesome-all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="css/ionicons.min.css">
	<!-- Theme style -->
	<!-- DataTables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
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
	<style>
		.selectpicker {
			width: 100%;
			display: block;
			padding: 6px;
			border-color: #d4d4d4;
		}

		th i {
			font-size: 25px;
			margin-left: 20px;
			padding-top: 5px;
			color: gray;
		}

		th i:hover {
			color: black;
		}
	</style>
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
					Edit Product
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
					<li><a href="#">Products</a></li>
					<li class="active">Edit Product</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- left column -->
					<div class="col-md-6">
						<!-- general form elements -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Product Details</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							
			                <form role="form" action="function.php" method="POST">
			                    <input type="hidden" name="action_id" value="<?php echo $id;?>" >
								<div class="box-body">
									<div class="form-group">
										<label for="exampleInputPassword1"> Product Name</label>
										<input type="text" class="form-control" value="<?php echo $name ;?>" name="name" id="exampleInputPassword1" required placeholder=" Name">
									</div>
									<div class="form-group">
    									<label for="exampleInputEmail1">Bike</label>
    									<select required name="bike" id="bike" class="selectpicker">
    									    <?php
                    
                                                $sql = "SELECT * FROM `bike`";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0)
                                                {
                                                    while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $bid = $row['id'];
                                                    $name = $row['name'];
                                            ?>
    										<option value="<?php echo $bid; ?>"  <?php if($biid==$bid) echo 'selected="selected"'; ?>><?php echo $name; ?></option>
    										<?php }} ?>
    									</select>
    								</div>
    								<div class="form-group">
    									<label for="exampleInputEmail1">Company</label>
    									<select required name="company" class="selectpicker">
    										<?php
                    
                                                $sql = "SELECT * FROM `company`";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0)
                                                {
                                                    while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $cid = $row['id'];
                                                    $name = $row['name'];
                                            ?>
    										<option value="<?php echo $cid; ?>" <?php if($coid==$cid) echo 'selected="selected"'; ?>><?php echo $name; ?></option>
    										<?php }} ?>
    									</select>
    								</div>
    								<div class="form-group">
    									<label for="exampleInputPassword1">Old Stock</label>
    									<input type="number" class="form-control" value="<?php echo $ostock ;?>" readonly name="qty" required id="wire_used" placeholder="Quantaty">
    								</div>
    								<div class="form-group">
    									<label for="exampleInputPassword1">Old Stock Cost Price <small>(per product)</small></label>
    									<input type="number" class="form-control" value="<?php echo $os_cprice ;?>" name="cprice" required id="wire_used" placeholder="Cost Price Per Product">
    								</div>
    								<div class="form-group">
    									<label for="exampleInputPassword1">Old Stock Retail product</label>
    									<input type="number" class="form-control" name="rprice" value="<?php echo $os_rprice ;?>" required id="wire_used" placeholder="Retail Price Per Product">
    								</div>
    								<div class="form-group">
    									<label for="exampleInputPassword1">New Stock</label>
    									<input type="number" class="form-control" name="nqty" readonly value="<?php echo $nstock ;?>" required id="wire_used" placeholder="Quantaty">
    								</div>
    								<div class="form-group">
    									<label for="exampleInputPassword1">New Stock Cost Price <small>(per product)</small></label>
    									<input type="number" class="form-control" name="ncprice" value="<?php echo $ns_cprice ;?>" required id="wire_used" placeholder="Cost Price Per Product">
    								</div>
    								<div class="form-group">
    									<label for="exampleInputPassword1">New Stock Retail product</label>
    									<input type="number" class="form-control" name="nrprice" value="<?php echo $ns_rprice ;?>" required id="wire_used" placeholder="Retail Price Per Product">
    								</div>
    								<div class="box-footer">
    									<button type="submit" name="update_item" class="btn btn-primary btn-block">Submit</button>
    								</div>
								</div>
								
		                	</form>
						</div>
						<!-- /.box -->
					</div>
					<!--/.col (right) -->
				</div>
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
	<script src="js/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="js/bootstrap.min.js"></script>
	<!-- FastClick -->
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
    <?php
    
    }
}

?>