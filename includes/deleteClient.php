<?php
ob_start();
include 'autoloader.php';

if(isset($_POST['delete'])){
    $inpdel = $_POST['DELCLIENTID'];

    $inpdel = explode('.', $inpdel);

    $dcc = new digitalCertifyController();

    for($i = 0; $i<count($inpdel); $i++){
        if($inpdel[$i] != ''){
            $dcc->deleteClient((int) $inpdel[$i]);
            rmdir(dirname(__DIR__) . "/files");
        }
    }
    header('location: ../loggeduser.php');
}