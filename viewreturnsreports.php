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

    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

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
                    Returns Reports
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                    <li class="active"><a href="#">Reports</a></li>
                </ol>
            </section>
         
            <!-- Main content -->
            <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Select Report for:</h3>
                                </div>                            
                                <form role="form" action="viewreturnsreports.php" method="POST">
                                    <div class="box-body">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                                <select name="entity_type" class="form-control float-left">
                                                    <option value="customer">Customer</option>
                                                    <option value="vendor">Vendor</option>
                                                    <option value="retailer">Retailer</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                 <input type="text" class="form-control float-right" id="invoice_number" name="invoice_number" placeholder="Invoice Number" />
                                                
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <button type="submit" name="report" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-3">
                            <div class="info-box mb-3 bg-info">
                              <span class="info-box-icon">
                                <i class="fa fa-chart-line"></i>
                            </span>

                              <div class="info-box-content">
                                <span class="info-box-text">Total Sales</span>
                                <span class="info-box-number" id="totalSale">0 /-</span>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box mb-3 bg-success">
                              <span class="info-box-icon">
                                <i class="fa fa-dollar-sign"></i>
                            </span>

                              <div class="info-box-content">
                                <span class="info-box-text">Total Expense</span>
                                <span class="info-box-number" id="expenseTotalValue">0 /-</span>
                              </div>
                             
                            </div>
                        </div>
                    </div> -->
                <div class="row">

                <?php 
                     // entity_type invoice_number
                    $fromDate = ''; $tillDate = '';
                    if (isset($_POST['invoice_number']) && isset($_POST['entity_type'])) {
                        // echo '<pre>';
                            $invoice_number =      $_POST['invoice_number'];
                            $entity_type    =      $_POST['entity_type'];
                        }
                     else{
                            $invoice_number ='';
                            $entity_type    =  '';
                         }

                        // $count=0;
                        if($entity_type=='customer'){
                            $saleParams = array('labour_sell');
                        
                        }elseif($entity_type=='vendor'){
                            $saleParams = array('vendor_sell');
                        
                        }elseif($entity_type=='retailer'){
                            $saleParams = array('retail_sell');
                        
                        }else{
                            $saleParams = array('retail_sell','vendor_sell','labour_sell');
                        }
                        
                       
                        $saleToday = array(); $grandSaleToday = '0';
                        for ($i = 0; $i < count($saleParams); $i++) {

                          $financeSQL = "SELECT it.name as itemname,$saleParams[$i].invoice_no, $saleParams[$i].qty, $saleParams[$i].price, 
                                                $saleParams[$i].discount, $saleParams[$i].date
                                             FROM $saleParams[$i]
                                             LEFT JOIN items it ON it.id =    $saleParams[$i].item_id
                                            WHERE ($saleParams[$i].invoice_no) = '$invoice_number';";
                            $financeRes = $conn->query($financeSQL);
                            $financeResNumCount = mysqli_num_rows($financeRes);

                            // print_r($financeResNumCount); echo '<br>';
                            
                             if($financeResNumCount > 0){
                                while ($row = mysqli_fetch_assoc($financeRes)) {
                                    $saleToday[$saleParams[$i]][$row['date']] = $row;
                                }
                             }
                             else
                                $saleToday[$saleParams[$i]] = array();

                        }
                        
                        // echo '<pre>';
                        // print_r($expToday);
                        // exit;
                            ?>
                <!-- Start Printing Vendors Sale details  -->

                <?php if (isset($_POST['invoice_number']) && ($_POST['entity_type']=='vendor')) {?>
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h4>Vendor Sales</h4>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="tbl_vendorSell" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Item Name</th>
                                            <th>Invoice Number</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Discount</th>
                                           
                                        </tr>
                                    </thead>
									<tbody>
                                        <?php
                                        if (count($saleToday['vendor_sell']) != 0 && isset($saleToday)){

                                            foreach ($saleToday['vendor_sell'] as $vendor_sales) {
                                                echo '<tr>';
                                                echo '<td>'.$vendor_sales['date'].'</td>';
                                                echo '<td>'.$vendor_sales['itemname'].'</td>';
                                                echo '<td>'.$vendor_sales['invoice_no'].'</td>';
                                                echo '<td>'.$vendor_sales['price'].'</td>';
                                                echo '<td>'.$vendor_sales['qty'].'</td>';
                                                echo '<td>'.$vendor_sales['discount'].'</td>';
                                               // $total = ($vendor_sales['qty'] * $vendor_sales['price']) - $vendor_sales['discount'];
                                                // SUM((qty*price) - discount)
                                                echo '</tr>';
                                            }
                                        }
                                         ?>
									</tbody>
                                    <tfoot>
                                        <tr>
                                            <!-- <th colspan="5" style="text-align:right">PKR</th> -->
                                            <!-- <th id="vendorTotalSales" style="text-align:left"></th> -->
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                <?php }?>
                <!-- End Printing Vendors Sale details  -->
                <?php if (isset($_POST['invoice_number']) && ($_POST['entity_type']=='customer')) {?>
                <!-- Start Printing Labours Sale details  -->
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h4>Labour Sales</h4>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="tbl_labourSell" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Item Name</th>
                                            <th>Invoice Number</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Discount</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($saleToday['labour_sell']) != 0)
                                        {
                                            foreach ($saleToday['labour_sell'] as $vendor_sales) {
                                                echo '<tr>';
                                                echo '<td>'.$vendor_sales['date'].'</td>';
                                                echo '<td>'.$vendor_sales['itemname'].'</td>';
                                                echo '<td>'.$vendor_sales['invoice_no'].'</td>';
                                                echo '<td>'.$vendor_sales['price'].'</td>';
                                                echo '<td>'.$vendor_sales['qty'].'</td>';
                                                echo '<td>'.$vendor_sales['discount'].'</td>';
                                               // $total = ($vendor_sales['qty'] * $vendor_sales['price']) - $vendor_sales['discount'];
                                               // echo '<td>'.$total.'</td>';
                                                // SUM((qty*price) - discount)
                                                echo '</tr>';
                                            }
                                        }
                                         ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <!-- <th colspan="5" style="text-align:right">PKR</th>
                                            <th id="labourTotalSales" style="text-align:left"></th> -->
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                <!-- End Printing Labours Sale details  -->
                <?php }?>
                </div>
                <div class="row">
                <?php if (isset($_POST['invoice_number']) && ($_POST['entity_type']=='retailer')) {?>
                <!-- Start Printing Retail Sale details  -->
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h4>Retail Sales</h4>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="tbl_retailSell" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Item Name</th>
                                            <th>Invoice Number</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Discount</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($saleToday['retail_sell']) != 0)
                                        {
                                            foreach ($saleToday['retail_sell'] as $vendor_sales) {
                                                echo '<tr>';
                                                echo '<td>'.$vendor_sales['date'].'</td>';
                                                echo '<td>'.$vendor_sales['itemname'].'</td>';
                                                echo '<td>'.$vendor_sales['invoice_no'].'</td>';
                                                echo '<td>'.$vendor_sales['price'].'</td>';
                                                echo '<td>'.$vendor_sales['qty'].'</td>';
                                                echo '<td>'.$vendor_sales['discount'].'</td>';
                                               // $total = ($vendor_sales['qty'] * $vendor_sales['price']) - $vendor_sales['discount'];
                                               // echo '<td>'.$total.'</td>';

                                                // SUM((qty*price) - discount)
                                                echo '</tr>';
                                            }
                                        }
                                         ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <!-- <th colspan="5" style="text-align:right">PKR</th>
                                            <th id="retailTotalSales" style="text-align:left"></th> -->
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                <!-- End Printing Retail Sale details  -->
                <?php }?>
             
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
    <script src="js/jquery.min.js" deferred ></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="js/bootstrap.min.js" deferred></script>
    <!-- DataTables -->
    <!-- <script src="js/jquery.dataTables.min.js"></script> -->
    <script src="plugins/datatables/jquery.dataTables.js" deferred></script>

    <script src="js/dataTables.bootstrap.min.js" deferred></script>
    <!-- SlimScroll -->
    <script src="js/jquery.slimscroll.min.js" deferred></script>
    <!-- FastClick -->
    <script src="js/fastclick.js" deferred></script>
    <!-- AdminLTE App -->
    <script src="js/adminlte.min.js" deferred></script>
    <!-- AdminLTE for demo purposes -->
    <script src="js/demo.js" deferred></script>
	<script src="js/toastr.min.js" deferred></script>

    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js" deferred></script>
    <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js" deferred></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js" deferred></script>

    <!-- page script -->
    <script>
        $(document).ready(function() {
            $('.box-body.table').dataTable();
            $('#tbl_retailSell').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;
                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };
                        // Total over all pages
                        total = api
                            .column( 5 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        // Total over this page
                        pageTotal = api
                            .column( 5, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        // Update footer
                        $( api.column( 5 ).footer() ).html(
                            // 'PKR '+pageTotal +' ( PKR '+ total +' total)'
                            total
                        );
                    }
            });
            $('#tbl_vendorSell').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;
             
                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };
             
                        // Total over all pages
                        total = api
                            .column( 5 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
             
                        // Total over this page
                        pageTotal = api
                            .column( 5, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
             
                        // Update footer
                        $( api.column( 5 ).footer() ).html(
                            // 'PKR '+pageTotal +' ( PKR '+ total +' total)'
                            total
                        );
                    }
            });
            $('#tbl_labourSell').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;
             
                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };
             
                        // Total over all pages
                        total = api
                            .column( 5 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
             
                        // Total over this page
                        pageTotal = api
                            .column( 5, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
             
                        // Update footer
                        $( api.column( 5 ).footer() ).html(
                            // 'PKR '+pageTotal +' ( PKR '+ total +' total)'
                            total
                        );
                    }
            });
            $('#tbl_expenseToday').DataTable({
                // 'paging': true,
                // 'lengthChange': false,
                // 'searching': false,
                // 'ordering': false,
                // 'info': true,
                // 'autoWidth': false,
                "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;
             
                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };
                        // Total over all pages
                        total = api
                            .column( 2 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        // Total over this page
                        pageTotal = api
                            .column( 2, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        // Update footer
                        $( api.column( 2 ).footer() ).html(
                            // 'PKR '+pageTotal +' ( PKR '+ total +' total)'
                            total
                        );
                    }
            });

        //Date range picker
        $('#reportingDate').daterangepicker({
              timePicker: false,
              maxDate: new Date(),
              locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Clear',
                separator: " / ",
              }
            });

            setTimeout(function(){
                var totalVendorSale = $("#vendorTotalSales").html();
                var totalLabourSale = $("#labourTotalSales").html();
                var totalRetailSale = $("#retailTotalSales").html();

                var totalSale = parseInt(totalVendorSale)+parseInt(totalLabourSale)+parseInt(totalRetailSale);
                $("#totalSale").html(totalSale+' /-');

                var expenseTotalValue = $("#totalExpense").html();
                $("#expenseTotalValue").html(expenseTotalValue+' /-');
            }, 3000);
         
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