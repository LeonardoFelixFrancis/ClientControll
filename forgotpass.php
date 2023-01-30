<?php
ob_start();
include 'includes/autoloader.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form class="row col-12 col-lg-6" method="POST">
            <?php
                if(isset($_POST['forgotpwd'])){
                    $rsetPwd = new retrievePwd($_POST['mail']);
                    if($rsetPwd->resetPwd()){
                        $rsetPwd->sendMail();
                    }else{
                        echo '<div class="alert alert-danger" role="alert">
                                E-mail digitado não está cadastrado!
                              </div>';
                    }
                }
            ?>
            <div class="mb-3">
                <label class="form-label" for="mail">E-mail</label>
                <input class="form-control" type="mail" name="mail" id='mail'>
            </div>
            <div class="d-grid gap-2">
                <input class="btn btn-primary" type="submit" value="Recuperar Senha" name="forgotpwd">
            </div>
        </form>
    </div>
</body>
</html>
