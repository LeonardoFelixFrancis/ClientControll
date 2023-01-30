<?php
session_start();
include 'autoloader.php';

if(isset($_POST['signup'])){
    $user = $_POST['USER'];
    $mail = $_POST['MAIL'];
    $pwd = $_POST['PWD'];
    $confpwd = $_POST['CONFPWD'];
    $signUp = new signupcontroller();
    $error = $signUp->signUpUser($user, $mail, $pwd, $confpwd);

    $_SESSION['ARRAY'] = $error;

    header("location: ../index.php");
}

