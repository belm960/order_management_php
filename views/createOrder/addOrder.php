<?php
session_start();

$request_department = $_POST['request_department'];
$task_category = $_POST['task_category'];
$size = $_POST['size'];
$description = $_POST['description'];
$requested_by = $_POST['requested_by'];

$conn = new mysqli('localhost', 'root','','hrm');
if ($conn-> connect_error){
    die('Connection Failed : '. $conn->connect_error);
}else {
    $stmt = $conn->prepare("insert into orders(request_department, task_category, size, description, requested_by) value('$request_department','$task_category','$size','$description','$requested_by')");
    $stmt->execute();
    $_SESSION['status'] = "Data Inserted Succesfully";
    if(isset($_SESSION['role']))
    if($_SESSION['role']=='admin'){
        header("Location:../../views/admin/dashboard.php");
    }else{
        header("Location:../../views/admin/dashboard2.php");
    }
    $stmt->close();
    $conn->close();
}

?>