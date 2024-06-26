<?php
session_start();

$request_department = $_POST['request_department'];
$task_category = $_POST['task_category'];
$size = $_POST['size'];
$description = $_POST['description'];
$requested_by = $_POST['requested_by'];
$status = 'PENDING';

$conn = new mysqli('localhost', 'root','','hrm');
if ($conn-> connect_error){
    die('Connection Failed : '. $conn->connect_error);
}else {
    $stmt = $conn->prepare("insert into orders(request_department, task_category, size, description, requested_by,status) value('$request_department','$task_category','$size','$description','$requested_by','$status')");
    $stmt->execute();
    $_SESSION['status'] = "Data Inserted Succesfully";
    header("Location:../dashboard.php");
    $stmt->close();
    $conn->close();
}

?>