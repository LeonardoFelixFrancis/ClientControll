<?php
ob_start();
include 'autoloader.php';

if(isset($_POST['add'])){
    $files = $_FILES['ADDFILE'];
    $lastId = $_POST['LASTID'];

    $saveF = new saveFile($files, $lastId);
    $saveF->saveNewFile();
    header('location: ../loggeduser.php');
}