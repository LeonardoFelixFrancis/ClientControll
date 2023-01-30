<?php
ob_start();
session_start();
include 'autoloader.php';

if(isset($_POST['create'])){
    $client = $_POST['CLIENT'];
    $clientDebt = $_POST['DEBT'];
    $paymentDay = $_POST['PAYDAY'];
    $status = $_POST['STATUS'];
    $rg = $_POST['RG'];
    $cpf = $_POST['CPF'];   
    $expDate = $_POST['EXPDATE'];
    
    $files = $_FILES['FILE'];

    $mail = $_POST['MAIL'];
    $phone = $_POST['PHONE'];
    $origin = $_POST['ORIGIN'];
    $type = $_POST['TYPE'];
    $com = $_POST['COM'];

    $login = new loginview();
    $userid = $login->returnUserId();
    $client = new digitalCertifyController($client, $clientDebt, $paymentDay, $status, $userid, $rg, $cpf, $files, $expDate, $mail, $phone, $origin, $type, $com);
    $client->createClientTracker();
    header('location: ../loggeduser.php');
}   