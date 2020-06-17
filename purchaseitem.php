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
        										<label for="exampleInputPassword1"> Product Name</label>
        										<input list="itemsname" class="form-control" name="itemname" id="iname" required placeholder=" Name">
        										<datalist id="itemsname">
        										    <?php
                            
                                                        $sql = "SELECT DISTINCT(name) FROM `items`";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0)
                                                        {
                                                            while($row = mysqli_fetch_assoc($result))
                                                            {
                                                            $name = $row['name'];
                                                    ?>
            										<option value="<?php echo $name; ?>">
            										<?php } } ?>
                                                </datalist>
        									</div>
									        <div class="form-group">
    									<label for="exampleInputEmail1">Company</label>
    									<select required name="company" id="company" class="selectpicker">
    										<?php
                    
                                                $sql = "SELECT * FROM `company`";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0)
                                                {
                                                    while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $id = $row['id'];
                                                    $name = $row['name'];
                                            ?>
    										<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
    										<?php } } ?>
    									</select>
    								</div>
            								<div class="form-group">
    									<label for="exampleInputPassword1">Quantaty</label>
    									<input type="number" class="form-control" name="qty" required id="itemqty" placeholder="Quantaty">
    								</div>
    								<div class="form-group">
    									<label for="exampleInputPassword1">Retail product</label>
    									<input type="number" class="form-control" name="rprice" required id="rprice" placeholder="Retail Price Per Product">
    								</div>
								        </div>
								        <div class="col-sm-6">
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
                                                    $id = $row['id'];
                                                    $name = $row['name'];
                                            ?>
    										<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
    										<?php }} ?>
    									</select>
    								</div>
            								<div class="form-group">
            									<label for="exampleInputEmail1">Vendor</label>
            									<select required name="vendor" id="vendor" onchange="disablee()" class="selectpicker">
            									    <option hidden value="0" > -- Select --</option>
            										<?php
                            
                                                        $sql = "SELECT * FROM `vendor`";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0)
                                                        {
                                                            while($row = mysqli_fetch_assoc($result))
                                                            {
                                                            $id = $row['id'];
                                                            $name = $row['name'];
                                                    ?>
            										<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
            										<?php }} ?>
            									</select>
            								</div>
            								<div class="form-group">
            									<label for="exampleInputPassword1">Cost Price <small>(per product)</small></label>
            									<input type="number" class="form-control" name="cprice" required id="cprice" placeholder="Retail Price Per Product">
            								</div>
								        </div>
								    </div>
    								
								</div>
								<div class="box-footer">
    									<button type="button" name="add_item" id="addto" class="btn btn-primary btn-block">Add</button>
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
                                        <center><h2>Brand</h2></center>
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
                                                    <p class="m-t-10"><strong>Order ID: </strong> <as id="cnmbr">P<?php echo date('YmdHis'); ?></as></p>
                                                    <p><strong>Vendor Name: </strong>
                                                    <as id="vname"></as>
                                                        
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
                                                            <th>Name</th>
                                                            <th>Bike</th>
                                                            <th>Company</th>
                                                            <th>Quantity</th>
                                                            <th>Unit Cost</th>
                                                            <th>Total</th>
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
                                                <p class="text-right"><b>Sub-total:</b><as id="subtotl"> </as></p>
                                                <hr>
                                                <h4 class="text-right">Rs <as id="totlam2"></as></h4>
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
	    document.getElementById("addto").onclick = function() 
		{
		    var cprice=val(document.getElementById("cprice").value);
	        var pname=document.getElementById("iname").value;
	        var qty=val(document.getElementById("itemqty").value);
	        var rprice=document.getElementById("rprice").value;
	        var vendor1=document.getElementById("vendor");
            var vendorv = vendor1.options[vendor1.selectedIndex].value;
            var vendor = vendor1.options[vendor1.selectedIndex].text;
            var bike1=document.getElementById("bike");
            var bikev = bike1.options[bike1.selectedIndex].value;
            var bike = bike1.options[bike1.selectedIndex].text;
            var company1=document.getElementById("company");
            var companyv = company1.options[company1.selectedIndex].value;
            var company = company1.options[company1.selectedIndex].text;
            document.getElementById("vname").innerHTML =vendor;
	       // alert(vendort+"|"+companyt+"|"+biket);
	        if(pname == ""|| qty == 0|| cprice == 0|| rprice == "" || vendorv == 0 )
    		{
    			alert("please fill the form");
    		}
    		else
    		{
    		    if(confirm('Are you sure, you want to Add Product?'))
    	        {   
                    var qry=document.getElementById("cnmbr").innerHTML+"|"+vendorv+"|"+pname+"|"+bikev+"|"+companyv+"|"+qty+"|"+cprice+"|"+rprice;
                    // alert(qry);
                    $.ajax({
        	            type:"post",
        	            url:"purchase.php",
        	            data: {data: qry},
        	            success: function(data)
        	            {
        	                if(data == 'true')
        	                {
        	                     console.log("Ajax Response" + data);
                			 //   alert(data);
                			    $("#invoicet").find('tbody').append( "<tr><td>"+pname+"</td><td>"+bike+"</td><td>"+company+"</td><td>"+qty+"</td><td>"+cprice+"</td><td>"+(qty*cprice)+"</td></tr>" );
                    			toastr.success('Product Added Successfully..!','Success!');
                    			document.getElementById("iname").value = "";
                    			document.getElementById("itemqty").value = "";
                    			document.getElementById("cprice").value = "";
                    			document.getElementById("rprice").value="";
                        	    var finalpriceee=0;
                    			var disc=0;
                    			for(var i=1;i<=table2.rows.length;i++)
                    			{
                    				finalpriceee += val(table2.rows[i].cells[5].innerHTML);	
                    				document.getElementById("subtotl").innerHTML = finalpriceee;
                    				document.getElementById("totlam2").innerHTML = finalpriceee;
                    			}
        	                }
        	                else
        	                {
        	                    toastr.error('An unknown error occurred..!','Error!');
        	                }
        			    }
        			});
                    
                    //console.log(qry);
                    // }
    	        }
    	        else
    	        {
    	            
    	        }
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
    	function disablee()
    	{
    	    if(confirm('Are you sure?'))
    	    {
    	        document.getElementById("vendor").disabled=true;
    	    }
    	    else
    	    {
    	        document.getElementById('vendor').getElementsByTagName('option')[0].selected = 'selected';
    	    }
    	}
	</script>
	
</body>

</html>