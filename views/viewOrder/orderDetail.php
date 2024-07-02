<?php

session_start();

if(!isset($_SESSION['user_name']) && !isset($_SESSION['password'])) {
    header("Location:../../index.php");
}

include '../../src/common/DBConnection.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oms";
$id;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM `orders` WHERE id = $id";
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
.dialog {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
}

.dialog-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
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
                                            <th>Department To</th>
                                            <td>{$row['department_to']}</td>
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
                                        <tr>
                                            <th>Status</th>
                                            <td>{$row['status']}</td>
                                        </tr>
                                    </table>
                                    <span>Click on the finished button if you have completed the task</span>
                                    <a id='openDialog' class='btn btn-success mt-3'>Accept</a>";
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
                                <div id="dialog" class="dialog">
                                    <div class="dialog-content">
                                        <span id="close" class="close">&times;</span>
                                        <h2>Are you Sure?</h2>
                                            <span class="section">Do you Accept and transfer the order to the department?</span>
                                        <div class="col-md-offset-3 section">
                                            <button id="cancel_accept" class="btn btn-primary btn-lg mr-5">Cancel</button>
                                            <?php 
                                                echo "<a href='./acceptOrder.php?status=ACCEPT&id=$id' id='send_accept' class='btn btn-success btn-lg'>Accept!</a>"

                                            ?>                                        </div>                                       
                                    </div>
                                </div>
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
<script>
    // Open dialog box when button is clicked
    document.getElementById('openDialog').addEventListener('click', function() {
        $("#dialog").css("display", "block");
    });

    // Close dialog box when close button or outside area is clicked
    document.getElementById('close').addEventListener('click', function() {
        $("#dialog").css("display", "none");
    });

    document.getElementById('cancel_accept').addEventListener('click', function() {
        $("#dialog").css("display", "none");
    });
    document.getElementById('send_accept').addEventListener('click', function() {
        $("#dialog").css("display", "none");
    });
    //document.getElementById('dialog').addEventListener('click', function() {
    //    $("#dialog").css("display", "none");
    //});

    // Prevent dialog from closing when clicking inside the dialog content
    document.getElementsByClassName("dialog-content").addEventListener('click', function(e) {
        e.stopPropagation();
    });
</script>
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