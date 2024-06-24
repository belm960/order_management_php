<?php

session_start();

if(!isset($_SESSION['admin_name']) && !isset($_SESSION['password'])) {
    header("Location:../../index.php");
}

include '../../src/common/DBConnection.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hrm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
$id = intval($_GET['id']);
$sql = "SELECT request_department, task_category, size, description, requested_by FROM `orders` WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Order Management System</title>

    <!-- Bootstrap -->
    <link href="../../resource/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../resource/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../resource/css/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../resource/css/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../../resource/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../../resource/css/buttons.bootstrap.css" rel="stylesheet">
    <link href="../../resource/css/fixedHeader.bootstrap.css" rel="stylesheet">
    <link href="../../resource/css/responsive.bootstrap.css" rel="stylesheet">
    <link href="../../resource/css/scroller.bootstrap.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../resource/css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <style>
        .btn:hover {
            color: black;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            .title_left *{
                visibility: visible;
            }
            .title_order *{
                visibility:visible;
            }
            .x_content * {
                visibility: visible;
            }
            .x_content {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
    <div class="main_container">

        <!-- side and top bar include -->
        <?php include '../partPage/sideAndTopBarMenu.php' ?>
        <!-- /side and top bar include -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>
                            <img src="../../resource/images/img1.png" alt="" width="30px" height="30px" class="img-circle">
                            <span>Unity University</span>
                        </h3>
                        <h2>
                            Order Detail From <?php 
                            $department = $row['request_department'];
                            echo "$department";
                            ?> Department
                        </h2>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title row">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                        <a href="./viewOrder.php" onclick='window.print()' class="btn btn-primary" style="">Print</a>
                                    </li>
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link" href="./viewOrder.php"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php
                                // Database connection
                                echo "<table class='table table-bordered'>
                                        <tr>
                                            <th>Request Department</th>
                                            <td>{$row['request_department']}</td>
                                        </tr>
                                        <tr>
                                            <th>Task Category</th>
                                            <td>{$row['task_category']}</td>
                                        </tr>
                                        <tr>
                                            <th>Size</th>
                                            <td>{$row['size']}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{$row['description']}</td>
                                        </tr>
                                        <tr>
                                            <th>Requested By</th>
                                            <td>{$row['requested_by']}</td>
                                        </tr>
                                    </table>";
                            } else {
                                echo "<p>No record found</p>";
                            }
                        } else {
                            echo "<p>Invalid request</p>";
                        }

                        $conn->close();
                                ?>
                            </div>
                            <div>
                                <span class="row">
                                    <span>Click on the finished button if you have completed the task</span>
                                    <a href="./viewOrder.php" class="btn btn-success mt-3">Finished</a>
                                </span>
                            </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content include -->
        <?php include '../partPage/footer.html' ?>
        <!-- /footer content include -->
    </div>
</div>

<!-- jQuery -->
<script src="../../resource/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../resource/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../resource/js/fastclick.js"></script>
<!-- NProgress -->
<script src="../../resource/js/nprogress.js"></script>
<!-- iCheck -->
<script src="../../resource/js/icheck.min.js"></script>
<!-- Datatables -->
<script src="../../resource/js/jquery.dataTables.min.js"></script>
<script src="../../resource/js/dataTables.bootstrap.min.js"></script>
<script src="../../resource/js/dataTables.buttons.min.js"></script>
<script src="../../resource/js/buttons.bootstrap.min.js"></script>
<script src="../../resource/js/buttons.flash.min.js"></script>
<script src="../../resource/js/buttons.html5.min.js"></script>
<script src="../../resource/js/buttons.print.min.js"></script>
<script src="../../resource/js/dataTables.fixedHeader.min.js"></script>
<script src="../../resource/js/dataTables.keyTable.min.js"></script>
<script src="../../resource/js/dataTables.responsive.min.js"></script>
<script src="../../resource/js/responsive.bootstrap.js"></script>
<script src="../../resource/js/dataTables.scroller.min.js"></script>
<script src="../../resource/js/jszip.min.js"></script>
<script src="../../resource/js/pdfmake.min.js"></script>
<script src="../../resource/js/vfs_fonts.js"></script>
<!-- Custom Theme Scripts -->
<script src="../../resource/js/custom.min.js"></script>
</body>
</html>