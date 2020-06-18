<?php

include('connection.php');?>



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
      <h1> Add Returns </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
        <li><a href="#">Return</a></li>
        <li class="active">Add Returns</li>
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
              <h3 class="box-title">Returns Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="function.php" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputPassword1"> Title</label>
                  <input type="text" class="form-control" name="title" value=""  id="exampleInputPassword1" required placeholder="Title">
                </div>
              </div>
              <div class="box-body">
			  	<div class="form-group">
                  <label for="exampleInputEmail1">Items</label>
                  <select required name="returnitemid" id="itemid" class="selectpicker" onBlur="var item = $('#itemid').val();populatefields(item)">
                    <?php
                    
                                                $sql = "SELECT * FROM `items`  ";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0)
                                                {
                                                    while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $itemid = $row['id'];
                                                    $name = $row['name'];
                                            ?>
                    <option value="<?php echo $itemid; ?>" ><?php echo $name; ?></option>
                    <?php }} ?>
                  </select>
                </div>
				<script>
					function populatefields(id){
						//alert(id);
						//console.log(id);
						var itemid, populate;
						$.post("ajax/ajax.php",{itemid:id,populate:'populate'},function(success){
						//console.log(success);
						jsonobj = JSON.parse(success);
						//success.parse
						//console.log(jsonobj.ostock);
						$('#ostock').val(jsonobj.ostock);
						$('#os_cprice').val(jsonobj.os_cprice);
						$('#os_cprice').val(jsonobj.os_cprice);
						$('#os_rprice').val(jsonobj.os_rprice);
						$('#nstock').val(jsonobj.nstock);
						$('#ns_rprice').val(jsonobj.ns_rprice);
						/*$array['name'] = $row['name'];
						$array['date'] = $row['date'];
						$array['ostock'] = $row['old_stock'];
						$array['os_cprice'] = $row['old_stock_cprice'];
						$array['os_rprice'] = $row['old_stoct_price'];
						$array['nstock'] = $row['new_stock'];
						$array['ns_cprice'] = $row['new_stock_cprice'];
						$array['ns_rprice'] = $row['new_stoct_price'];
						$array['biid'] = $row['bike_id'];
						$array['coid'] = $row['company_id'];
						*/						
						});				
					}
				</script>
                <div class="form-group">
                  <label for="exampleInputEmail1">Returnee</label>
                  <select required name="returnee" class="selectpicker" onBlur="hideother(this.value);">
                    <option value="customer"><?php echo 'customer'; ?></option>
                    <option value="vendor"><?php echo 'vendor'; ?></option>
                  </select>
                </div>
                <div class="form-group"  id="customer" style="display:none">
                  <label for="exampleInputEmail1">Customer</label>
                  <select required name="customer" class="selectpicker">
                    <?php
                    
                                                $sql = "SELECT * FROM `customer`  ";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0)
                                                {
                                                    while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $customerid = $row['id'];
                                                    $name = $row['name'];
                                            ?>
                    <option value="<?php echo $customerid; ?>" ><?php echo $name; ?></option>
                    <?php }} ?>
                  </select>
                </div>
                
                <div class="form-group" id="vendor" style="display:none">
                  <label for="exampleInputEmail1">Vendor</label>
                  <select required name="vendor" class="selectpicker">
                    <?php
                    
                                                $sql = "SELECT * FROM `vendor`";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0)
                                                {
                                                    while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    $vendorid = $row['id'];
                                                    $name = $row['name'];
                                            ?>
                    <option value="<?php echo $vendorid; ?>"><?php echo $name; ?></option>
                    <?php }} ?>
                  </select>
                </div>
				<script>
				function hideother(val){
				//alert(val);
					if(val=='customer'){
						
						$('#customer').css('display','block');
						$('#vendor').hide();
					}
					if(val=='vendor'){
						$('#vendor').css('display','block');
						$('#customer').hide();
					}
				}</script>
				 
        <!-- title returnitemid customer vendor qty(old stock) cprice(old stock) nqty(New Stock) ncprice(New Stock Cost Price)
        nrprice(New Stock Retail product) -->
                <div class="form-group">
                  <label for="exampleInputPassword1">Current Stock</label>
                  <input type="number" class="form-control" value="<?php  if(isset($_POST['populate']) && $_POST['populate']=='populate'){ echo @$array['ostock'] ;}?>" name="qty" required id="ostock" placeholder="Quantaty">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Returned Item Number</label>
                  <input type="number" class="form-control" value="" name="item_no" required id="item_no" placeholder="Item Number" />
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Old Stock Cost Price <small>(per product)</small></label>
                  <input type="number" name="cprice"  class="form-control"  value="<?php  if(isset($_POST['populate']) && $_POST['populate']=='populate'){ echo @$array['os_cprice'] ;}?>"  required id="os_cprice" placeholder="Cost Price Per Item">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Old Stock Retail product</label>
                  <input type="number" class="form-control" name="rprice" readonly value="<?php  if(isset($_POST['populate']) && $_POST['populate']=='populate'){ echo @$array['os_rprice'] ;}?>" required id="os_rprice" placeholder="Retail Price Per Item">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">New Stock</label>
                  <input type="number" class="form-control" name="nqty" readonly value="<?php  if(isset($_POST['populate']) && $_POST['populate']=='populate'){ echo @$array['nstock'] ;}?>" required id="nstock" placeholder="Quantaty">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">New Stock Cost Price <small>(per product)</small></label>
                  <input type="number" class="form-control" name="ncprice" readonly value="<?php if(isset($_POST['populate']) && $_POST['populate']=='populate'){  echo @$array['ns_cprice'] ;}?>" required id="ns_cprice" placeholder="Cost Price Per Item">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">New Stock Retail product</label>
                  <input type="number" class="form-control" name="nrprice" readonly value="<?php if(isset($_POST['populate']) && $_POST['populate']=='populate'){ echo @$array['ns_rprice'] ;}?>" required id="ns_rprice" placeholder="Retail Price Per Item">
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" name="add_returns" class="btn btn-primary btn-block">Submit</button>
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

