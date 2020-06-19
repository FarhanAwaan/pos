<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="img/user8-128x128.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="">
                <a href="index.php">
                    <i class="fas fa-tachometer-alt"></i> <span>&nbsp;&nbsp;Dashboard</span>
                </a>
            </li>
            <!-- <li class="treeview">
                <a href="#">
            <i class="fab fa-product-hunt"></i> <span>&nbsp;&nbsp; Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
                <ul class="treeview-menu">
                    <li><a href="additem.php"><i class="far fa-circle"></i> &nbsp;&nbsp; Add Product</a></li>
                    <li><a href="viewitem.php"><i class="far fa-circle"></i> &nbsp;&nbsp; View Products</a></li>
                </ul>
            </li> -->
            <?php if ($_SESSION['role'] == 'admin') { ?>

                <li class="">
                    <a href="viewitem.php"><i class="fab fa-product-hunt"></i> &nbsp;&nbsp; <span>View Products</span></a>
                </li>

            <?php } ?>
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fas fa-copyright"></i> <span>&nbsp;Company</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="addcompany.php"><i class="far fa-circle"></i>&nbsp;&nbsp; Add Company</a></li>
                    <li><a href="viewcompany.php"><i class="far fa-circle"></i>&nbsp;&nbsp; View Company</a></li>
                </ul>
            </li> -->

            <?php if ($_SESSION['role'] == 'admin') { ?>
                <li class="">
                    <a href="viewcompany.php"><i class="fas fa-copyright"></i> &nbsp;&nbsp; <span>View Company</span></a>
                </li>

                <li class="">
                    <a href="viewreports.php"><i class="fas fa-balance-scale"></i> &nbsp;&nbsp; <span>Financial Reporting</span></a>
                </li>

                <li class="">
                    <a href="viewbike.php"><i class="fas fa-motorcycle"></i> &nbsp;&nbsp; <span>View Bikes</span></a>
                </li>

            <?php } ?>

            <li class="treeview">
                <a href="#">
            <i class="fas fa-cart-arrow-down"></i> <span>&nbsp;Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
                <ul class="treeview-menu">
                    <li><a href="sale.php"><i class="far fa-circle"></i>&nbsp;&nbsp; Sale</a></li>
                    <li><a href="labour.php"><i class="far fa-circle"></i>&nbsp;&nbsp; Labour</a></li>

            <?php if ($_SESSION['role'] == 'admin') { ?>
                    <li><a href="viewretailsales.php"><i class="far fa-circle"></i>&nbsp;&nbsp; View Retail Sales</a></li>
                    <li><a href="viewlaboursales.php"><i class="far fa-circle"></i>&nbsp;&nbsp; View Labour Sales</a></li>
                    <li><a href="viewcustomersales.php"><i class="far fa-circle"></i>&nbsp;&nbsp; View customer Sales</a></li>
                    <li><a href="viewcustomerdatesales.php"><i class="far fa-circle"></i>&nbsp;&nbsp; View customer Sales(date)</a></li>
            <?php } ?>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
            <i class="fas fa-shopping-bag"></i> <span>&nbsp;Purchase</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
                <ul class="treeview-menu">
                    <li><a href="purchaseitem.php"><i class="far fa-circle"></i>&nbsp;&nbsp; Purchase Items</a></li>

                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <li><a href="viewpurchase.php"><i class="far fa-circle"></i>&nbsp;&nbsp; View Purchases</a></li>

                <?php } ?>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
            <i class="fas fa-shopping-bag"></i> <span>&nbsp;Returns</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
                <ul class="treeview-menu">
                    <li><a href="viewreturnsreports.php"><i class="far fa-circle"></i>&nbsp;&nbsp; Add Returns</a></li>
                    <li><a href="return.php"><i class="far fa-circle"></i>&nbsp;&nbsp; Returns listings</a></li>
                    <!-- <li><a href="viewreturnsreports.php"><i class="far fa-circle"></i>&nbsp;&nbsp; View Return Report</a></li> -->
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
            <i class="fas fa-balance-scale"></i> <span>&nbsp;Expenditures</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
                <ul class="treeview-menu">
                    <li><a href="addexpenditure.php"><i class="far fa-circle"></i>&nbsp;&nbsp; Add Expenditure</a></li>
                    <li><a href="viewexpenditure.php"><i class="far fa-circle"></i>&nbsp;&nbsp; View Expenditures</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
            <i class="fa fa-users"></i> <span>&nbsp;Vendors</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
                <ul class="treeview-menu">
                    <li><a href="addvendor.php"><i class="far fa-circle"></i>&nbsp;&nbsp; Add Vendor</a></li>
                    <li><a href="viewvendor.php"><i class="far fa-circle"></i>&nbsp;&nbsp; View Vendors</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
            <i class="fa fa-users"></i> <span>&nbsp;Labour</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
                <ul class="treeview-menu">
                    <li><a href="addlabour.php"><i class="far fa-circle"></i>&nbsp;&nbsp; Add Labour</a></li>
                    <li><a href="viewlabour.php"><i class="far fa-circle"></i>&nbsp;&nbsp; View Labours</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
            <i class="fa fa-users"></i> <span>&nbsp;Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
                <ul class="treeview-menu">
                    <li><a href="addcustomer.php"><i class="far fa-circle"></i>&nbsp;&nbsp; Add Customer</a></li>
                    <li><a href="viewcustomer.php"><i class="far fa-circle"></i>&nbsp;&nbsp; View Customers</a></li>
                    <li><a href="viewbills.php"><i class="far fa-circle"></i>&nbsp;&nbsp; View Paid Bills</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>