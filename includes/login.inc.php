<?php
ob_start();
session_start();
include 'autoloader.php';

if(isset($_POST['login'])){
    $user = $_POST['USER'];
    $pwd = $_POST['PWD'];

    $login = new logincontroller($user,$pwd);
    $login->loginUser();

    $loginView = new loginview();
    $loginView->showErrors($login->returnErrors());
    echo "Hello"; 
    header('location: ../loggeduser.php');
    exit();
}