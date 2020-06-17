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
					Create New User
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
					<li><a href="#">Users</a></li>
					<li class="active">Add User</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
			<form role="form" action="function.php" method="POST">
				<div class="row">
					<!-- left column -->
					<div class="col-md-6">
						<!-- general form elements -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">User Details</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
								<div class="box-body">
									<div class="form-group">
										<label for="exampleInputPassword1"> Name</label>
										<input type="text" class="form-control" name="uname" id="exampleInputPassword1" required placeholder=" Name">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1"> Father Name</label>
										<input type="text" class="form-control" name="fname" id="exampleInputPassword1" placeholder="Father Name">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">CNIC </label>
										<input type="number" class="form-control" name="cnic" id="exampleInputPassword1" required placeholder=" CNIC">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Father's CNIC</label>
										<input type="number" class="form-control" name="fcnic" id="exampleInputPassword1" placeholder=" Father CNIC">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Contact #</label>
										<input type="number" class="form-control" name="number" id="exampleInputPassword1" required placeholder=" Phone Number">
									</div>
								</div>
						</div>
						<!-- /.box -->

						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">User</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
								<div class="box-body">
									<div class="form-group">
										<label for="exampleInputPassword1">User Id</label>
										<input type="text" class="form-control" name="userid" id="exampleInputPassword1" required placeholder="User Id">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Password</label>
										<input type="password" class="form-control" name="password" id="exampleInputPassword1" required placeholder="Password">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Email</label>
										<input type="email" class="form-control" name="email" id="exampleInputPassword1" required placeholder="Email">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Comment</label>
										<textarea class="form-control" name="comment" rows="5" id="exampleInputPassword1" placeholder="Comment"></textarea>
									</div>

								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" name="register" class="btn btn-primary btn-block">Submit</button>
								</div>
						</div>


					</div>
					<!--/.col (left) -->
					<!-- right column -->
					<div class="col-md-6">
						<!-- general form elements -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Package Details</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
								<div class="box-body">
									<div class="form-group">
										<label for="exampleInputEmail1">Package</label>
										<select required name="package" onchange="fpackage()" id="fpackage" class="selectpicker">
											<option value="0|0" hidden>-- Select --</optionvalue>
											<option value="2|50">Mustard</option>
											<option value="9|150">Mustard 150</option>
										</select>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Modem</label>
										<select required name="modem" onchange="fmodem()" id="fmodem" class="selectpicker">
											<option value="0|0" hidden>-- Select --</optionvalue>
											<option value="2|250">Mustard 250</option>
											<option value="9|350">Mustard 350</option>
										</select>
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">MAC Address</label>
										<input type="text" class="form-control" name="mac" required id="exampleInputPassword1" placeholder="MAC Address">
									</div>

								</div>
								<!-- /.box-body -->
						</div>
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Expenditures</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
								<div class="box-body">
									<div class="form-group">
										<label for="exampleInputPassword1">Installation Charges</label>
										<input type="number" class="form-control" onkeyup="total()" name="installation_charges" required id="installation_charges" placeholder="Installation Charges">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Wire used <small>(per feet)</small></label>
										<input type="number" class="form-control" onkeyup="wire()" name="wire_used" required id="wire_used" placeholder="Wire Used Per Feet">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Wire Price <small>(per feet)</small></label>
										<input type="number" class="form-control" name="wire_price" onkeyup="wire()" required id="wire_price" placeholder="Wire Price Per Feet">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Total Wire Price</label>
										<input type="number" class="form-control" onkeyup="total()" name="wire_tprice" required id="wire_tprice" placeholder="Total Wire Price">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Modem Charges</label>
										<input type="number" class="form-control" onkeyup="total()" name="modem_charges" required id="modemp" placeholder="Modem Charges">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Advance Amount</label>
										<input type="number" class="form-control" onkeyup="total()" name="advance_charges" required id="advance_charges" placeholder="Advance Amount">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Others</label>
										<input type="number" class="form-control" onkeyup="total()" name="other_charges" required id="other_charges" placeholder="Other Expenditures">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Total Amount</label>
										<input type="number" class="form-control" name="total_charges" required id="total_charges" placeholder="Total Amount">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Package Charges</label>
										<input type="number" class="form-control" onkeyup="total()" name="package_charges" required id="packagep" placeholder="Package Charges">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Monthly Charges</label>
										<input type="number" class="form-control" onkeyup="total()" name="monthly_charges" required id="exampleInputPassword1" placeholder="Monthly Charges">
									</div>
								</div>
								<!-- /.box-body -->
						</div>

						<!-- /.box -->



					</div>

					<!--/.col (right) -->
				</div>
				<!-- /.row -->
			</form>
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
	<script type="text/javascript">
           $(document).ready(function () 
		   {
				$('#fpackage').change(function() {
					var price =$(this).val();
					var p1 = price.split('|');
                    p1=p1[1];
                    document.getElementById("packagep").value =p1;
					total();
				});
                $('#fmodem').change(function() {
					var price =$(this).val();
					var p1 = price.split('|');
                    p1=p1[1];
                    document.getElementById("modemp").value =p1;
					total();
				});
                
            });
			
            function wire()
                {
                    var price = document.getElementById("wire_price").value;
					price = parseInt(price);
                    var size = document.getElementById("wire_used").value;
					size = parseInt(size);
					var sum=size*price;
                    document.getElementById("wire_tprice").value =sum;
					total();
                }
				function total()
                {
                    var a = document.getElementById("installation_charges").value;
					var b = document.getElementById("wire_tprice").value;
					var c = document.getElementById("modemp").value;
					var d = document.getElementById("advance_charges").value;
					var e = document.getElementById("other_charges").value;
					var sum=(val(a)+val(b)+val(c)+val(d)+val(e));
					// alert(val(b));
                    document.getElementById("total_charges").value =sum;
                }
				function val(a)
				{
					if(a == '')
					{
						return 0;
					}
					else
					{
						return parseInt(a);
					}
				}
        </script>
</body>

</html>