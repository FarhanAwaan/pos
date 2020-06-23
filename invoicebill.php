<?php

include('connection.php'); ?>
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
					Invoice Bill
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
					<li><a href="#">Bills</a></li>
					<li class="active">Invoice Bill</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
					<div class="col-md-12">
                                <div class="box box-primary">
                                     <div class="box-header with-border">
                                        <h4 class="box-title">Invoice</h4>
                                    </div>
                                    <div class="box-body" id="printshow">
                                        <center><h2>Brand</h2></center>
                                        <div class="pull-left m-t-20">
                                        <p><strong>Dated: </strong> <?php date_default_timezone_set('Asia/Karachi'); 
                                                            echo date('d-m-Y h:i:s A'); ?></p>
                                        <p><strong>Reference Number: </strong> <?php echo '5109'; ?></p>
                                        <p><strong>Duty Person: </strong> <?php echo 'Akhtar Hussain(SL5) Umer Ayyaz SM'; ?></p>
                                        <p><strong>Transaction: </strong> <?php echo 'Sale'; ?></p>
                                        
                            <!-- <p class="m-t-10"><strong>Order ID: </strong> <as id="cnmbr">P<?php //echo date('YmdHis'); ?></as></p>
                            <p><strong>Vendor Name: </strong>
                            <as id="vname"></as> -->
                            </p>
                        </div> 
                         <hr>
                           <div class="m-h-50"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table m-t-30" id="invoicet" style="border:1px solid black">
                                        <thead>
                                           <tr>
                                                <th style="font-weight: 700; font-size: 18px; border-left:1px solid black;border-right:none;border-top:1px solid black;border-bottom:1px solid black; width: 0.5% !important;">Customer:</th>
                                                <td rowspan="1" colspan='9' style="border-left:none;border-right:1px solid black;border-top:1px solid black;border-bottom:1px solid black">
                                                    <h2><center><strong>WHOLE SALE(AHMED AUTOS)<strong></center></h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="border:1px solid black">S#</th>
                                                <th style="border:1px solid black">Product</th>
                                                <th style="border:1px solid black">Model</th>
                                                <th style="border:1px solid black">Size/Series</th>
                                                <th style="border:1px solid black">Color</th>
                                                <th style="border:1px solid black">Rate</th>
                                                <th style="border:1px solid black">Qty</th>
                                                <th style="border:1px solid black">Dsc%</th>
                                                <th style="border:1px solid black">Dsc</th>
                                                <th style="border:1px solid black">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            <td style="border:1px solid black">S#</td>
                                                <td style="border:1px solid black">Product</td>
                                                <td style="border:1px solid black">Model</td>
                                                <td style="border:1px solid black">Size/Series</td>
                                                <td style="border:1px solid black">Color</td>
                                                <td style="border:1px solid black">Rate</td>
                                                <td style="border:1px solid black">Qty</td>
                                                <td style="border:1px solid black">Dsc%</td>
                                                <td style="border:1px solid black">Dsc</td>
                                                <td style="border:1px solid black">Total</td>
                                            </tr>  
                                            <tr>
                                            <td rowspan="1" colspan='10' style="border:1px solid black">&nbsp;</td>
                                            
                                            </tr> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                                 
                            <div class="row">
                                <div class="col-md-4"  style="float: right;">
                                    <div class="table-responsive">
                                        <table class="table m-t-30" id="invoic" style="border:1px solid black;float:right;border-collapse: initial;">
                                        <tr ><td style="font-weight: 700; font-size: 22px; border-left:1px solid black;border-right:none;border-top:1px solid black;border-bottom:1px solid black; width: 0.5% !important;">Total Bill: 24000</td></tr>  
                                        <tr><td  style="font-weight: 700; font-size: 22px; border-left:1px solid black;border-right:none;border-top:1px solid black;border-bottom:1px solid black; width: 0.5% !important;">Discount: 0</td></tr>  
                                        <tr><td  style="font-weight: 700; font-size: 22px; border-left:1px solid black;border-right:none;border-top:1px solid black;border-bottom:1px solid black; width: 0.5% !important;">Paid: 24000</td></tr>   
                                        <tr><td  style="font-weight: 700; font-size: 18px; border-left:1px solid black;border-right:none;border-top:1px solid black;border-bottom:1px solid black; width: 0.5% !important;">Counts: 81</td></tr> 
                                        <tr ><td style="font-weight: 700; font-size: 18px; border-left:1px solid black;border-right:none;border-top:1px solid black;border-bottom:1px solid black; width: 0.5% !important;background:antiquewhite">Balance: 0</td></tr> 
                                    </table>
                                    </div>
                                </div>
                            </div>
                            
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="clearfix m-t-40">
                                                    <h5 class="small text-inverse">Terms and Conditions</h5>

                                                    <small>
                                                        1- Check Item for Demage or Malfunction before Picking Up<br/>
                                                        2- All Guranteed Items have Gurantee Cards. A Safe Keeping is Recommended<br/>
                                                        3- Items Once Sold are not Refundable or Exchangeable<br/>
                                                        4- Count and Counter your Items before Loading and Uploading<br/>
                                                        Amount in Rupees: Twenty Four Thousand Only<br/>
                                                    </small>
                                                </div>
                                            </div>
                                          
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="clearfix m-t-40">
                                                    <h5 class="small text-inverse">Prepared By:</h5><span>__________________</span>
                                                </div>
                                            </div>
                                        </div>
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
	var table2=document.getElementById('invoicet');
         $("#invoicet").DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': false,
            'info': true,
            'autoWidth': false
          });
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
    
	</script>
	
</body>

</html>