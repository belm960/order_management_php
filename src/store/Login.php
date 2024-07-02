<?php

session_start();

include_once ('../common/DBConnection.php');

$dbConnection = new DBConnection();
$restlt = $dbConnection->getAll('SELECT * FROM user');

$user ="";
$login = false;
if (isset($_POST['login'])){
    $user_name = trim($_POST['userName']);
    $user_password = trim($_POST['password']);
    foreach ($restlt as $row){
        $user = $row;
        if ($user_name == $user['username'] && $user_password == $user['password']) {
            $login=true;
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['user_password'] = $user['password'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['department_from'] = $user['department'];
            $_SESSION['campus'] = $user['campus'];
            $_SESSION['full_name'] = $user['full_name'];
            if($user['role']=='user'){
                header("Location:../../views/user/dashboard.php");
            }else if($user['role']=='manager'){
                header("Location:../../views/user/dashboard.php");
            }else{
                header("Location:../../views/user/dashboard2.php");
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