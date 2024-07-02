<?php
session_start();
$status = $_GET['status'];
$id = $_GET['id'];

$conn = new mysqli('localhost', 'root','','oms');
if ($conn-> connect_error){
    die('Connection Failed : '. $conn->connect_error);
}else {
    $stmt = $conn->prepare("update orders set status='$status' where id=$id");
    $stmt->execute();
    $_SESSION['accepted'] = "You Accepted The Order";
    if(isset($_SESSION['role']))
    if($_SESSION['role']=='manager'){
        header("Location:../../views/user/dashboard.php");
    }else{
        header("Location:../../views/admin/dashboard2.php");
    }
    $stmt->close();
    $conn->close();
}

?>