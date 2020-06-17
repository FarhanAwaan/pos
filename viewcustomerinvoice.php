<?php

include('connection.php'); 
if(isset($_POST['viewinvoice']))
{
    $id=$_POST['action_id'];
    $date=$_POST['date'];
    $name=$_POST['customer_name'];
    $invoice_no=$_POST['invoice_no'];

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
					Purchase Product
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
					<li><a href="#">Purchase</a></li>
					<li class="active">Purchase Product</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- left column -->
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
                                                    <p class="m-t-10"><strong>Order ID: </strong> <as id="cnmbr"><?php echo $invoice_no; ?></as></p>
                                                    <p><strong>Customer Name:</strong>
                                                    <?php echo $name;?> 
                                                        
                                                    </p>
                                                    <p><strong>Date: </strong> <?php echo $date ?></p>
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
                                                            <th>Name</th>
                                                            <th>Bike</th>
                                                            <th>Company</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Total</th>
                                                            <th>Discount</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            $sql="select vs.*,i.name as iname,b.name AS bname,c.name AS cname from vendor_sell vs,items i,bike b,company c where vs.item_id=i.id AND i.bike_id=b.id AND i.company_id=c.id AND invoice_no='$invoice_no'";
                                                            $result=$conn->query($sql);
                                                            if($result ->num_rows > 0)
                                                            {
                                                                $sum=0;
                                                                $tdis=0;
                                                                
                                                                while($row = mysqli_fetch_assoc($result))
                                                                {
                                                                    $iname=$row['iname'];
                                                                    $bname=$row['cname'];
                                                                    $cname=$row['bname'];
                                                                    $discount=$row['discount'];
                                                                    $cprice=$row['price'];
                                                                    $qty=$row['qty'];
                                                                    $totl=($cprice*$qty);
                                                                    $tdis +=$discount;
                                                                    $sum += $totl;
                                                                    ?>
                                                            <tr>
                                                                <td><?php echo $iname;?></td>
                                                                <td><?php echo $bname;?></td>
                                                                <td><?php echo $cname;?></td>
                                                                <td><?php echo $qty;?></td>
                                                                <td><?php echo $cprice;?></td>
                                                                <td><?php echo $totl;?></td>
                                                                <td><?php echo $discount;?></td>
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
                                                <p class="text-right"><b>Sub-total:</b><?php echo $sum;?></p>
                                                <p class="text-right"><b>Discount:</b><?php echo $tdis;?></p>
                                                <hr>
                                                <h4 class="text-right">Rs <?php echo $sum-$tdis; ?></h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-print-none">
                                            <div class="text-right">
                                                <a onclick="printDiv()" id="print" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                <!--<a href="#" onclick="approve()" id="approve" class="btn btn-primary waves-effect waves-light">Submit</a>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
	</script>
	
</body>

</html>
<?php }?>