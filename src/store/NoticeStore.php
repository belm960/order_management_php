<?php

session_start();

$_SESSION["user"] = "admin";

include '../../src/common/DBConnection.php';

$conn=new DBConnection();

    $noticeSubject=$_POST['noticeSubject'];
    $noticeDate=$_POST['noticeDate'];
    $noticeTime=$_POST['noticeTime'];
    $noticeDesc=$_POST['noticeDesc'];

    $result=$conn->execute("INSERT INTO notices (subject, notice_date, notice_time, description, insert_by, insert_date) 
     VALUES ('".$noticeSubject."', '".$noticeDate."', '".$noticeTime."', '".$noticeDesc."', '".$_SESSION["user"]."', CURRENT_TIMESTAMP)");

    if($result) {
        header("Location: " ."../../views/admin/sendNotice.php?message=success");
        die();
    } else {
        header("Location: " ."../../views/admin/sendNotice.php?message=failed");
        die();
    }

class NoticeStore
{

}