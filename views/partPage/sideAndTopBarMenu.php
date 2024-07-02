<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="../../resource/images/img1.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>Unity University</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                        <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php 
                                if(isset($_SESSION['role'])&&$_SESSION['role']=='admin'){
                                    echo '<li><a href="../admin/dashboard.php">Dashboard</a></li>';
                                }else{
                                    echo '<li><a href="../admin/dashboard2.php">Dashboard</a></li>';                                }
                            ?>
                            <!--<li><a href="../admin/dashboard2.php">Dashboard2</a></li>-->
                            <!--<li><a href="../admin/dashboard3.php">Dashboard3</a></li>-->
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Orders</h3>
                <ul class="nav side-menu">
                <li>
                    <a><i class="fa fa-edit"></i> Engineering <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php 
                        if(isset($_SESSION['role'])&&$_SESSION['role']=='admin'){
                            echo '<li><a href="../createOrder/createOrder.php">Create Order</a></li><li><a href="../viewOrder/viewOrder.php">View Order</a></li>
                        <li><a href="../viewOrder/viewOrder.php?status=PENDING">Completed Orders</a></li><li><a href="../viewOrder/viewOrder.php">Approved Orders</a></li>';
                        }else if (isset($_SESSION['role'])&&$_SESSION['role']=='user'){
                            echo '<li><a href="../createOrder/createOrder.php">Create Order</a></li>';}
                        else if (isset($_SESSION['role'])&&$_SESSION['role']=='manager'){
                            echo '<li><a href="../viewOrder/viewOrder.php?status=PENDING&type=requested_order">Requested Order</a></li>
                                <li><a href="../viewOrder/viewOrder.php?status=ACCEPTED&type=your_order">Your Order</a></li>';}
                    ?>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen" onclick="toggleFullScreen()">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="../../src/store/Logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="../../resource/images/img1.png" alt="">
                        <? echo $_SESSION['full_name']; ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="../../src/store/Logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>

                <!-- <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-calendar"></i>
                        <span class="badge bg-green"><?=$_SESSION["event"]?></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

                        <?php
                           foreach ($_SESSION["events"] as $event){
                        ?>
                        <li>
                            <a>
                                <span class="image"><img src="../../resource/images/img1.png" alt="Profile Image" /></span>
                                <span>
                                  <span>Unity University</span>
                                  <span class="time"><?=$event['event_time']?></span>
                                </span>
                                <span class="message">
                                  <?=$event['subject']?>
                               </span>
                            </a>
                        </li>
                        <?php
                           }
                        ?>
                        <li>
                            <div class="text-center">
                                <a href="../liveEvent/liveEvent.php">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->