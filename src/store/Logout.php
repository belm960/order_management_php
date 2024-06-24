<?php

session_start();

unset($_SESSION['admin_name']);
unset($_SESSION['password']);

session_destroy();

header("Location:../../index.php?");

class Logout
{

}