<?php
session_start();

$request_department =$_SESSION['department_from'];
$department_to = $_POST['department_to'];
$campus = $_SESSION['campus'];
$task_category = $_POST['task_category'];
$size = $_POST['size'];
$description = $_POST['description'];
$requested_by = $_SESSION['full_name'];
$status = 'PENDING';

$conn = new mysqli('localhost', 'root','','oms');
if ($conn-> connect_error){
    die('Connection Failed : '. $conn->connect_error);
}else {
    $stmt = $conn->prepare("insert into orders(request_department,department_to,campus, task_category, size, description, requested_by,status) value('$request_department','$department_to','$campus','$task_category','$size','$description','$requested_by','$status')");
    $stmt->execute();
    $_SESSION['status'] = "Data Inserted Succesfully";
    if(isset($_SESSION['role']))
    if($_SESSION['role']=='user'){
        header("Location:../../views/user/dashboard.php");
    }else{
        header("Location:../../views/admin/dashboard2.php");
    }
    $stmt->close();
    $conn->close();
}

?>