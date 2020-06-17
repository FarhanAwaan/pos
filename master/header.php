<?php include('session.php'); ?>

    <link rel="stylesheet" href="css/Style.css">
<header class="main-header">
    <!-- Logo -->
    <a href="../index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>  KBH</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b> POS | </b> KBH</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="fas fa-bars"></span>
      </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
            <!--    <li class="dropdown messages-menu">-->
            <!--        <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
            <!--  <i class="far fa-envelope"></i>-->
            <!--  <span class="label label-success">4</span>-->
            <!--</a>-->
            <!--        <ul class="dropdown-menu">-->
            <!--            <li class="header">You have 4 messages</li>-->
            <!--            <li>-->
                            <!-- inner menu: contains the actual data -->
            <!--                <ul class="menu">-->
            <!--                    <li>-->
                                    <!-- start message -->
            <!--                        <a href="#">-->
            <!--                            <div class="pull-left">-->
            <!--                                <img src="img/user8-128x128.jpg" class="img-circle" alt="User Image">-->
            <!--                            </div>-->
            <!--                            <h4>-->
            <!--                                Support Team-->
            <!--                                <small><i class="fa fa-clock-o"></i> 5 mins</small>-->
            <!--                            </h4>-->
            <!--                            <p>Why not buy a new awesome theme?</p>-->
            <!--                        </a>-->
            <!--                    </li>-->
                                <!-- end message -->
            <!--                    <li>-->
            <!--                        <a href="#">-->
            <!--                            <div class="pull-left">-->
            <!--                                <img src="img/user3-128x128.jpg" class="img-circle" alt="User Image">-->
            <!--                            </div>-->
            <!--                            <h4>-->
            <!--                                AdminLTE Design Team-->
            <!--                                <small><i class="fa fa-clock-o"></i> 2 hours</small>-->
            <!--                            </h4>-->
            <!--                            <p>Why not buy a new awesome theme?</p>-->
            <!--                        </a>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <a href="#">-->
            <!--                            <div class="pull-left">-->
            <!--                                <img src="img/user4-128x128.jpg" class="img-circle" alt="User Image">-->
            <!--                            </div>-->
            <!--                            <h4>-->
            <!--                                Developers-->
            <!--                                <small><i class="fa fa-clock-o"></i> Today</small>-->
            <!--                            </h4>-->
            <!--                            <p>Why not buy a new awesome theme?</p>-->
            <!--                        </a>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <a href="#">-->
            <!--                            <div class="pull-left">-->
            <!--                                <img src="img/user3-128x128.jpg" class="img-circle" alt="User Image">-->
            <!--                            </div>-->
            <!--                            <h4>-->
            <!--                                Sales Department-->
            <!--                                <small><i class="fa fa-clock-o"></i> Yesterday</small>-->
            <!--                            </h4>-->
            <!--                            <p>Why not buy a new awesome theme?</p>-->
            <!--                        </a>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <a href="#">-->
            <!--                            <div class="pull-left">-->
            <!--                                <img src="img/user4-128x128.jpg" class="img-circle" alt="User Image">-->
            <!--                            </div>-->
            <!--                            <h4>-->
            <!--                                Reviewers-->
            <!--                                <small><i class="fa fa-clock-o"></i> 2 days</small>-->
            <!--                            </h4>-->
            <!--                            <p>Why not buy a new awesome theme?</p>-->
            <!--                        </a>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--            </li>-->
            <!--            <li class="footer"><a href="#">See All Messages</a></li>-->
            <!--        </ul>-->
            <!--    </li>-->
                <!-- Notifications: style can be found in dropdown.less -->
            <!--    <li class="dropdown notifications-menu">-->
            <!--        <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
            <!--  <i class="far fa-bell"></i>-->
            <!--  <span class="label label-warning">10</span>-->
            <!--</a>-->
            <!--        <ul class="dropdown-menu">-->
            <!--            <li class="header">You have 10 notifications</li>-->
            <!--            <li>-->
                            <!-- inner menu: contains the actual data -->
            <!--                <ul class="menu">-->
            <!--                    <li>-->
            <!--                        <a href="#">-->
            <!--          <i class="fa fa-users text-aqua"></i> 5 new members joined today-->
            <!--        </a>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <a href="#">-->
            <!--          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the-->
            <!--          page and may cause design problems-->
            <!--        </a>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <a href="#">-->
            <!--          <i class="fa fa-users text-red"></i> 5 new members joined-->
            <!--        </a>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <a href="#">-->
            <!--          <i class="fa fa-shopping-cart text-green"></i> 25 sales made-->
            <!--        </a>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <a href="#">-->
            <!--          <i class="fa fa-user text-red"></i> You changed your username-->
            <!--        </a>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--            </li>-->
            <!--            <li class="footer"><a href="#">View all</a></li>-->
            <!--        </ul>-->
            <!--    </li>-->
                <!-- Tasks: style can be found in dropdown.less -->
            <!--    <li class="dropdown tasks-menu">-->
            <!--        <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
            <!--  <i class="far fa-bell"></i>-->
            <!--  <span class="label label-danger">9</span>-->
            <!--</a>-->
            <!--        <ul class="dropdown-menu">-->
            <!--            <li class="header">You have 9 tasks</li>-->
            <!--            <li>-->
                            <!-- inner menu: contains the actual data -->
            <!--                <ul class="menu">-->
            <!--                    <li>-->
                                    <!-- Task item -->
            <!--                        <a href="#">-->
            <!--                            <h3>-->
            <!--                                Design some buttons-->
            <!--                                <small class="pull-right">20%</small>-->
            <!--                            </h3>-->
            <!--                            <div class="progress xs">-->
            <!--                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">-->
            <!--                                    <span class="sr-only">20% Complete</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </a>-->
            <!--                    </li>-->
                                <!-- end task item -->
            <!--                    <li>-->
                                    <!-- Task item -->
            <!--                        <a href="#">-->
            <!--                            <h3>-->
            <!--                                Create a nice theme-->
            <!--                                <small class="pull-right">40%</small>-->
            <!--                            </h3>-->
            <!--                            <div class="progress xs">-->
            <!--                                <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">-->
            <!--                                    <span class="sr-only">40% Complete</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </a>-->
            <!--                    </li>-->
                                <!-- end task item -->
            <!--                    <li>-->
                                    <!-- Task item -->
            <!--                        <a href="#">-->
            <!--                            <h3>-->
            <!--                                Some task I need to do-->
            <!--                                <small class="pull-right">60%</small>-->
            <!--                            </h3>-->
            <!--                            <div class="progress xs">-->
            <!--                                <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">-->
            <!--                                    <span class="sr-only">60% Complete</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </a>-->
            <!--                    </li>-->
                                <!-- end task item -->
            <!--                    <li>-->
                                    <!-- Task item -->
            <!--                        <a href="#">-->
            <!--                            <h3>-->
            <!--                                Make beautiful transitions-->
            <!--                                <small class="pull-right">80%</small>-->
            <!--                            </h3>-->
            <!--                            <div class="progress xs">-->
            <!--                                <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">-->
            <!--                                    <span class="sr-only">80% Complete</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </a>-->
            <!--                    </li>-->
                                <!-- end task item -->
            <!--                </ul>-->
            <!--            </li>-->
            <!--            <li class="footer">-->
            <!--                <a href="#">View all tasks</a>-->
            <!--            </li>-->
            <!--        </ul>-->
            <!--    </li>-->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-calculator"></i>
              <span class="hidden-xs">Calculator</span>
            </a>
            <ul class="dropdown-menu">
                
                
                
                 <form name="form" class="well calcontainer col-xs-12  col-sm-offset-4 col-sm-12  col-md-offset-3 col-md-6  col-lg-offset-3 col-lg-6">
                      

                    <!-- panel for the calc -->

                    <input class=" form-control " id="panel" name="panel" placeholder="0." disabled>
                    
                     <br/>

                    <!-- User Input Buttons for the calc -->

                    <input class="form-group btn btn-default bttn" type="button" name="bttn7" value="7" onclick="calC(bttn7.value);">
                    <input class="form-group btn btn-default bttn" type="button" name="bttn8" value="8" onclick="calC(bttn8.value);">
                    <input class="form-group btn btn-default bttn" type="button" name="bttn9" value="9" onclick="calC(bttn9.value);">
                    <input class="form-group btn btn-danger bttn" type="button" name="bttnplus" value="+" onclick="calC(bttnplus.value);"><br/>
                    <input class="form-group btn btn-default bttn" type="button" name="bttn4" value="4" onclick="calC(bttn4.value);">
                    <input class="form-group btn btn-default bttn" type="button" name="bttn5" value="5" onclick="calC(bttn5.value);">
                    <input class="form-group btn btn-default bttn" type="button" name="bttn6" value="6" onclick="calC(bttn6.value);">
                    <input class="form-group btn btn-danger bttn" type="button" name="bttnminus" value="-" onclick="calC(bttnminus.value);"><br/>

                    <input class="form-group btn btn-default bttn" type="button" name="bttn1" value="1" onclick="calC(bttn1.value);">
                    <input class="form-group btn btn-default bttn" type="button" name="bttn2" value="2" onclick="calC(bttn2.value);">
                    <input class="form-group btn btn-default bttn" type="button" name="bttn3" value="3" onclick="calC(bttn3.value);">
                    <input class="form-group btn btn-danger bttn" type="button" name="bttnmulti" value="*" onclick="calC(bttnmulti.value);"><br/>
                    <input class="form-group btn btn-default bttn" type="button" name="bttndot" value="." onclick="calC(bttndot.value);">
                    <input class="form-group btn btn-default bttn" type="button" name="bttn0" value="0" onclick="calC(bttn0.value);">
                    <input class="form-group btn btn-danger bttn" type="button" name="bttnmod" value="%" onclick="calC(bttnmod.value);">
                    <input class="form-group btn btn-danger bttn" type="button" name="bttndiv" value="/" onclick="calC(bttndiv.value);"><br/>

                    <!-- calling new reset function -->
                    <input class="form-group btn btn-info bttn bttne" type="button" name="bttnclear" value="CE" onclick="CE();">

                    <input class="form-group btn btn-success bttn bttne" type="button" name="bttnEQL" value="=" onclick="panel.value=eval(panel.value);">


                </form>
                
                
                
              </ul>
                </li>
                
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="function.php?logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
                <!-- <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
    
	<script src="js/script.js"></script>
</header>