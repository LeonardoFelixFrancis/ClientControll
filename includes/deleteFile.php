<?php
ob_start();
include 'autoloader.php';

if(isset($_POST['submit'])){
    $file = $_POST['DELFILE'];
    echo $file;
    $id = $_POST['LASTID'];

    $delf = new deleteFile($file, $id);
    $delf->deleteFile();
    header('location: ../loggeduser.php');
}