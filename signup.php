<?php
  session_start();
  include 'includes/autoloader.php';
?>

<!DOCTYPE html>

<html>
    <head> 

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <form class="row col-12 col-lg-6" action='includes/signup.inc.php' method="post">
                <div class="mb-3">
                    <label class="form-label" for="user">Usuário</label>
                    <input class="form-control" type="text" id="USER" name="USER">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="mail">E-Mail</label>
                    <input class="form-control" type="mail" id="mail" name="MAIL">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="pwd">Senha</label>
                    <input class="form-control" type="password" id="pwd" name="PWD">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="confpwd">Confirmar Senha</label>
                    <input class="form-control" type="password" id="confpwd" name="CONFPWD">
                </div>
                <div class="d-grid gap-2">
                    <input class="btn btn-primary" type="submit" value="cadastrar-se" name="signup">
                </div>
                <div class="d-flex justify-content-center">
                    <a class='form-text'href="index.php">FAZER LOGIN</a>
                </div>
            </form>
        </div>
  </body>
</html>
