<?php

session_start();

include_once ('../common/DBConnection.php');

$dbConnection = new DBConnection();
$restlt = $dbConnection->getAll('SELECT * FROM admins');

$admin ="";
$login = false;
if (isset($_POST['login'])){
    $user_name = trim($_POST['userName']);
    $user_password = trim($_POST['password']);
    foreach ($restlt as $row){
        $admin = $row;
        if ($user_name == $admin['name'] && $user_password == $admin['password']) {
            $login=true;
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_password'] = $admin['password'];
            $_SESSION['role'] = $admin['role'];
            if($admin['role']=='admin'){
                header("Location:../../views/admin/dashboard.php");
            }else{
                header("Location:../../views/admin/dashboard2.php");
            }
            break;
        }
    }
}
if($login==false){
    header("Location:../../index.php?msg=User name or password is invalid");
}

class Login
{

}