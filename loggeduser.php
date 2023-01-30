<?php
  session_start();
  include 'includes/autoloader.php';

  if(!isset($_SESSION['USERSESSION'])){
    header('location: index.php');
  }

?>

<!DOCTYPE html>

<html>
    <head>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href='css/mynewstyle.css' rel="stylesheet">

    </head>
    <body >
      <button class='btn btn-primary' id='createClient'>Criar</button>
      <button class='btn btn-primary' id='searchClient'>Pesquisar</button>
      
      <div class="hidden" id='openClientBtnHold'>
          <form method="POST">
            <input type='submit' class='btn btn-success' id='openClientBtn' value="Abrir" name="OPENCLIENT">
            <input id='clientidhold' type="hidden" name='CLIENTID'> 
          </form>
      </div>

      <nav class="navbar navbar-expand-lg bg-primary mb-4">
      <div class="container-fluid ">
        <a class="navbar-brand" href="#">Certificados</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-3 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="includes/logout.php">Sair</a>
            </li>
          </ul>
        </div>
      </div>
      </nav>
      
      <div id="overlay" class="hidden"></div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
        
        <?php
          if(isset($_POST['OPENCLIENT'])){
            $id = $_POST['CLIENTID'];
            $login = new loginview();
            $clientview = new digitalCertifyView($login->returnUserId());
            $clientview->showClient($id);
          }
        ?>

        <div id='clientCreateHold' class='hidden'>
          <button class="btn btn-danger mb-3" id='closeCreateClient'>Fechar</button>
          <form class="container mb-3" action='includes/clientCreate.php' method="post" enctype="multipart/form-data">
          <div class="row mb-3">
            <div class="col">
              <label for="client">Ciente</label>
              <input class="form-control" type="text" id="client" name="CLIENT">
            </div>
            <div class="col">
              <label for="dbt">Valor</label>
              <input class="form-control" type="number" step="0.01"  id="dbt" name="DEBT">
            </div>
            <div class="col">
              <label for="payday">Data de Emissão</label>
              <input class="form-control" type="date" id="payday" name="PAYDAY">
            </div>
            <div class="col">
              <label for="expday">Data de Vencimento</label>
              <input class="form-control" type="date" id="expday" name="EXPDATE">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="mail">E-mail</label>
              <input class="form-control" type="mail" id="mail" name="MAIL">
            </div>
            <div class="col">
              <label for="phone">Telefone</label>
              <input class="form-control" type="tel" id="phone" name="PHONE">
            </div>
            <div class="col">
              <label for="origin">Origem</label>
              <input class="form-control" type="text" id="origin" name="ORIGIN">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
                <label for="stat">Status</label>
              <select class="form-control" id="stat" name="STATUS">
                <option>ESPERANDO PAGAMENTO</option>
                <option>PAGO</option>
              </select>
            </div>
            <div class="col">
              <label for="rg">RG</label>
              <input class="form-control" type="text" id="rg" name="RG">
            </div>
            <div class="col">
              <label for="cpf">CPF</label>
              <input class="form-control" type="text" id="cpf" name="CPF" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}|\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}" title="Digite um CPF no formato: xxx.xxx.xxx-xx ou Digite um CNPJ no formato: xx.xxx.xxx/xxxx-xx">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
                <label for="type">Tipo</label>
              <select class="form-control" id="type" name="TYPE">
                <option>E-CPF A1</option>
                <option>E-CNPJ A1</option>
              </select>
            </div>
            <div class="col">
              <label for="COM">COMISSÃO</label>
              <input class="form-control" type="text" id="COM" name="COM">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col mb-3">
              <label for="file">Arquivos</label>
              <input class="form-control" type="file" id="file" name="FILE[]" multiple>
            </div>
            <div class="d-grid gap-2">
              <input class="btn btn-primary" type="submit"  value="Criar" name="create">
            </div>
          </div>
          </form>
        </div>
        <div id='clientSearchHold' class='hidden'>
          <button class="btn btn-danger mb-3" id='closeBtnSearchClient'>Fechar</button>
          <form method='post' class="container">
            <div class='row mb-3'>
              <div class="col">
                  <label class='form-label' for='client'>Cliente</label>
                  <input type="text" class="form-control" id='client' name='CLIENT'>
              </div>
              <div class="col">
                  <label class='form-label' for='price'>De</label>
                  <input type="number" step='0.01' class="form-control" id='price' name='PRICE' placeholder="preço">
              </div>
              <div class="col">
                  <label class='form-label' for='price2'>Até</label>
                  <input type="number" step='0.01' class="form-control" id='price2' name='PRICE2' placeholder="preço">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                  <label class='form-label' for='emdate'>Emissão De</label>
                  <input class="form-control" type="date" id='emdate' name='EMDATE' placeholder="Emissão"> 
              </div>
              <div class="col">
                  <label class='form-label' for='emdate2'>Até</label>
                  <input class="form-control" type="date" id='emdate2' name='EMDATE2' placeholder="Emissão"> 
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                  <label class='form-label' for='vendate'>Vencimento De</label>
                  <input class="form-control" type="date" id='vendate' name='VENDATE' placeholder="Vencimento"> 
              </div>
              <div class="col">
                  <label class='form-label' for='vendate2'>Até</label>
                  <input class="form-control" type="date" id='vendate2' name='VENDATE2' placeholder="Vencimento"> 
              </div>
            </div>
            <div class="row mb-3 mb-3">
              <div class="col">
                <label class='form-label' for='entid'>CPF/CNPJ</label>
                <input class="form-control" type="text" id="entid" name="ENTID" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}|\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}" title="Digite um CPF no formato: xxx.xxx.xxx-xx ou Digite um CNPJ no formato: xx.xxx.xxx/xxxx-xx">
              </div>
              <div class="col">
                <label class="form-label" for='stat'>Status</label>
                <select class="form-control" name='STAT'>
                  <option></option>
                  <option>ESPERANDO PAGAMENTO</option>
                  <option>PAGO</option>
                </select>
              </div>
              <div class="col">
                <label class="form-label" for='ori'>Origem</label>
                <select class="form-control" name='ORI'>
                  <option></option>
                  <?php
                       $login = new loginview();
                       $clientview = new digitalCertifyView($login->returnUserId());
                       $clientview->showOrigins();
                  ?>
                </select>
              </div>
              <div class="col">
                <label class="form-label" for='typ'>Tipo</label>
                <select id='typ' class="form-control" name='STYPE'>
                  <option></option>
                  <option>E-CNPJ A1</option>
                  <option>E-CPF A1</option>
                </select>
              </div>
            </div>
            <div class="d-grid gap-2">
                <input class="btn btn-primary" type="submit"  value="Criar" name="search">
            </div>
          </form>
          </div>

          <form action="includes/deleteClient.php" method="POST">
            <div class="hidden" id='delBtnHolder'>
              <input type='submit' class="btn btn-danger" id='delBtn' name="delete" value="Deletar">
            </div>
            <input type="hidden" id='delclientinp' value="" name="DELCLIENTID">
          </form>

      <?php
        if(isset($_POST['search'])){
          $client = $_POST['CLIENT'];
          $price = $_POST['PRICE'];
          $price2 = $_POST['PRICE2'];
          $emdate = $_POST['EMDATE'];
          $emdate2 = $_POST['EMDATE2'];
          $vendate = $_POST['VENDATE'];
          $vendate2 = $_POST['VENDATE2'];
          $entid = $_POST['ENTID'];
          $stat = $_POST['STAT'];
          $ori = $_POST['ORI'];
          $typ = $_POST['STYPE'];
        }else{
          $client = "";
          $price = "";
          $price2 = '';
          $emdate = "";
          $emdate2 = "";
          $vendate = "";
          $vendate2 = "";
          $entid = "";
          $stat = "";
          $ori = "";
          $typ = '';
        }

        $login = new loginview();
          echo '<div style="overflow-x:auto; width:95%; margin:auto">';
          echo '<table id="showTable" class="table">';
          $clientview = new digitalCertifyView($login->returnUserId(), $client, $price, $price2, $emdate, $emdate2, $vendate, $vendate2, $entid, $stat, $ori, $typ);

            echo '<thead>
            <th>Cliente</th>
            <th>Valor</th>
            <th>Data Emissão</th>
            <th>Data Vencimento</th>
            <th>Status</th>
            <th>RG</th>
            <th>CPF/CNPJ</th>
            <th>E-Mail</th>
            <th>Telefone</th>
            <th>Origem</th>
            <th>Tipo</th>
            <th>Comissão</th>
            <th>Valor Comissão</th>
            <th>Valor foi Repassado?</th>
            <th>Arquivos</th>
            </thead>';
          echo '<tbody id="tableBody">';
            $clientview->showClients();
            echo '</tbody>';
          echo '</table>';
          echo '</div>';
      ?>

      <script src='javascript/createClient.js'></script>
      <script src='javascript/openfiles.js'></script>
      <script src='javascript/searchClient.js'></script>
      <script src='javascript/selectrow.js'></script>
      <script src='javascript/openclient.js'></script>
  </body>
</html>
