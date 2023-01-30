<?php
ob_start();

class digitalCertifyView extends digitalCertify{

       protected $client;
       protected $price;
       protected $emdate;
       protected $emdate2;
       protected $vendate;
       protected $vendate2;
       protected $entid;
       protected $price2;
       protected $stat;
       protected $ori;
       protected $typ;

    public function __construct($userid, $client = '', $price = '',$price2 = '', $emdate = '', $emdate2 = '', $vendate = '', $vendate2 = '', $entid = '', $stat = '', $ori = '', $type = '', $pass='')
    {
       
        $this->userid = $userid;
        $this->client = $client;
        $this->price = $price;
        $this->price2 = $price2;
        if($emdate != "")
            $this->emdate = date('Y-m-d', strtotime($emdate));
        else    
            $this->emdate = '';
        if($emdate2 != "")
            $this->emdate2 = date('Y-m-d', strtotime($emdate2));
        else    
            $this->emdate2 = '';
        if($vendate != "")
            $this->vendate = date('Y-m-d', strtotime($vendate));
        else    
            $this->vendate = '';
        if($vendate2 != "")
            $this->vendate2 = date('Y-m-d', strtotime($vendate2));
        else    
            $this->vendate2 = '';
        $this->entid = $entid;
        $this->stat = $stat;
        $this->ori = $ori;
        $this->typ = $type;
        $this->passed = $pass;
    }
    public function showClients(){
        $clients = $this->getDigitalCerify();
        while($client = $clients->fetch()){
                $clientEmDate = explode('-',$client['iDate']);
                $clientExpDate = explode('-',$client['expDate']);
                $file =  dirname(__DIR__).'/files/'.$client['id'];
                $files = array_diff(scandir($file), array('..', '.'));
                
                if($this->client != '' && $this->client != $client['client'] && $client != ''){
                    $client = '';
                    
                }else if($this->entid != '' && $this->entid != $client['cpf'] && $client != ''){
                    $client = '';
                    
                }else if($this->emdate != '' && $client != ''){
                    $emdate = explode('-', $this->emdate);
                    if((int) $emdate[0] > (int) $clientEmDate[0]){
                        $client = '';
                        

                    }else if((int) $emdate[1] > (int) $clientEmDate[1] && (int) $emdate[0] == (int) $clientEmDate[0]){
                        $client = '';
                        

                    }else if((int) $emdate[2] > (int) $clientEmDate[2] && (int) $emdate[1] == (int) $clientEmDate[1]){
                        $client = '';
                        
                    }
                }else if($this->emdate2 != '' && $client != ''){
                    $emdate2 = explode('-', $this->emdate2);
            
                    if((int) $emdate2[0] < (int) $clientEmDate[0]){
                        $client = '';
                    }else if((int) $emdate2[1] < (int) $clientEmDate[1] && (int) $emdate2[0] == (int) $clientEmDate[0]){
                        $client = '';
                    }else if((int) $emdate2[2] < (int) $clientEmDate[2] && (int) $emdate2[1] == (int) $clientEmDate[1]){
                        $client = '';
                    }
                }else if($this->vendate != '' && $client != ''){
                    $vendate = explode('-', $this->vendate);
                    if((int) $vendate[0] > (int) $clientExpDate[0]){
                        $client = '';
                        
                    }else if((int) $vendate[1] > (int) $clientExpDate[1] && (int) $vendate[0] == (int) $clientExpDate[0]){
                        $client = '';
                        
                    }else if((int) $vendate[2] > (int) $clientExpDate[2] && (int) $vendate[1] == (int) $clientExpDate[1]){
                        $client = '';
                        
                    }
                }else if($this->vendate2 != '' && $client != ''){
                    $vendate2 = explode('-', $this->vendate2);
            
                    if((int) $vendate2[0] < (int) $clientExpDate[0]){
                        $client = '';
                        

                    }else if((int) $vendate2[1] < (int) $clientExpDate[1] && (int) $vendate2[0] == (int) $clientExpDate[0]){
                        $client = '';
                        

                    }else if((int) $vendate2[2] < (int) $clientExpDate[2] && (int) $vendate2[1] == (int) $clientExpDate[1]){
                        $client = '';
                        

                    }
                }else if($this->price != ''  && $this->price > $client['clientDebt'] && $client != ''){
                    $client = '';
                    
                }else if($this->price2 != ''  && $this->price2 < $client['clientDebt'] && $client != ''){
                    $client = '';
                    
                }else if($this->stat != '' && $this->stat != $client['stat'] && $client != ''){
                    $client = '';
                }else if($this->ori != '' && $this->ori != $client['origin'] && $client != ''){
                    $client = '';
                }else if($this->typ != '' && $this->typ != $client['certType']){
                    $client = '';
                }
                else{
                    echo '<tr data-id='.$client["id"].' class="clientRow">';
                    echo '<td>'.$client['client'].'</td>';
                    echo '<td> R$'.$client['clientDebt'].'</td>';

                    $dat = explode('-', $client['iDate']);
                    echo '<td>'.$dat[2].'/'.$dat[1].'/'.$dat[0].'</td>';
                    $dat = explode('-', $client['expDate']);
                    echo '<td>'.$dat[2].'/'.$dat[1].'/'.$dat[0].'</td>';
                    echo '<td>'.$client['stat'].'</td>';
                    echo '<td>'.$client['rg'].'</td>';
                    echo '<td>'.$client['cpf'].'</td>';
                    echo '<td>'.$client['mail'].'</td>';
                    echo '<td>'.$client['phone'].'</td>';
                    echo '<td>'.$client['origin'].'</td>';
                    echo '<td>'.$client['certType'].'</td>';
                    
                    if(strpos($client['comission'], '%')){
                        echo '<td>'.$client['comission'].'</td>';
                        echo '<td> R$'.((int)str_replace('%',"",$client['comission'])/100)*$client['clientDebt'].'</td>';
                    }else if($client['comission'] != ""){
                        echo '<td>'.((int) $client['comission']/$client['clientDebt'])*100 .'%</td>';
                        echo '<td>R$'.$client['comission'].'</td>';
                    }else{
                        echo '<td></td>';
                        echo '<td></td>';
                    }
                    echo '<td>'.$client['passed'].'</td>';
                    echo '<td>';
                    echo '<button id="'.$client['id'].'" class="filesbtn btn btn-primary">Abrir Arquivos</button>';
                    echo '<div id="files.'.$client['id'].'"class="container closedfiles files">';

                    echo '<button class="btn btn-danger mb-3" id="files.'.$client['id'].'close">Fechar</button>';

                    echo '<div class="addfileform">';
                    echo "<form class='container mb-3' action='includes/movefile.php' method='post' enctype='multipart/form-data'>
                        <div class='row'>
                        <div class='col mb-3'>
                            <label for='file'>Adicionar Arquivos</label>
                            <input class='form-control' type='file' id='file' name='ADDFILE[]' multiple>
                        </div>
                        <div class='d-grid gap-2'>
                            <input class='btn btn-primary' type='submit'  value='Adicionar' name='add'>
                        </div>
                        <input style='display:none' name='LASTID' value=".$client['id'].">
                        </form>";
                    echo '</div>';

                    foreach($files as $f){
                        $f = preg_replace('/\s+/', '_', $f);

                            echo '<form class=container action="includes/deleteFile.php" method="post">';
                            echo '<div class="row">';
                                echo '<div class=col-10>';
                                echo '<p><a target="_blank" href="files/'.$client['id'].'/'.$f.'"download>'.$f.'</a><input class="hidden" type=text value='.$f.' name="DELFILE">
                                <input style="display:none" name="LASTID" value="'.$client['id'].'">';
                                echo '</div>';
                                echo '<div class=col-2>';
                                echo '<input class="btn btn-danger mr-3" type=submit value="Deletar" name="submit"></p>';
                                echo '</div>';
                            echo '</div>';
                            echo '</form>';

                    }
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
        }
        
    }
    public function showOrigins(){
        $origins = $this->getOrigins();
        while($ori = $origins->fetch()){
            if($ori['origin'] != ''){
                echo '<option>';
                echo $ori['origin'];
                echo '</option>';
            }
        }
    }

    public function showClient($id){
        $clients = $this->getDigitalCerify();
        while($client = $clients->fetch()){
            if($client['id'] == $id){
                
                echo "<div id='clientOpenHold' class=''>
                <button class='btn btn-danger mb-3' id='closeOpenClient'>Fechar</button>
                <form class='container mb-3' action='includes/clientEdit.php' method='post' enctype='multipart/form-data'>
                <div class='row mb-3'>
                  <div class='col'>
                    <label for='client'>Ciente</label>
                    <input class='form-control' type='text' id='client' name='CLIENT' value=".preg_replace("/ /", "&nbsp;", $client['client']).">
                  </div>
                  <div class='col'>
                    <label for='dbt'>Valor</label>
                    <input class='form-control' type='number' step='0.01'  id='dbt' name='DEBT' value=".$client['clientDebt'].">
                  </div>
                  <div class='col'>
                    <label for='payday'>Data de Emissão</label>
                    <input class='form-control' type='date' id='payday' name='PAYDAY' value=".$client['iDate'].">
                  </div>
                  <div class='col'>
                    <label for='expday'>Data de Vencimento</label>
                    <input class='form-control' type='date' id='expday' name='EXPDATE' value=".$client['expDate'].">
                  </div>
                </div>
                <div class='row mb-3'>
                  <div class='col'>
                    <label for='mail'>E-mail</label>
                    <input class='form-control' type='mail' id='mail' name='MAIL' value=".$client['mail'].">
                  </div>
                  <div class='col'>
                    <label for='phone'>Telefone</label>
                    <input class='form-control' type='tel' id='phone' name='PHONE' value=".preg_replace("/ /", "&nbsp;", $client['phone']).">
                  </div>
                  <div class='col'>
                    <label for='origin'>Origem</label>
                    <input class='form-control' type='text' id='origin' name='ORIGIN' value=".preg_replace("/ /", "&nbsp;", $client['origin']).">
                  </div>
                  <div class='col'>
                    <label for='pass'>Valor Repassado?</label>
                    ";
                    if($client['passed'] == "NÃO"){
                        echo "<select class='form-control' id='pass' name='PASS'>
                              <option>NÃO</option>
                              <option>SIM</option>
                              </select>";
                    }else if($client['passed'] == "SIM"){
                        echo "<select class='form-control' id='pass' name='PASS'>
                        <option>SIM</option>
                        <option>NÃO</option>
                        </select>";
                    }else{
                        echo "<select class='form-control' id='pass' name='PASS'>
                        <option> </option>
                        <option>SIM</option>
                        <option>NÃO</option>
                        </select>";
                    }
                echo " </div>
                </div>
                <div class='row mb-3'>
                  <div class='col'>
                      <label for='stat'>Status</label>
                    ";
                    if($client['stat']=="PAGO"){
                        echo "<select class='form-control' id='stat' name='STATUS'>
                        <option selected='selected'>PAGO</option>
                        <option>ESPERANDO PAGAMENTO</option>
                        </select>";
                    }else if($client['stat']=="ESPERANDO PAGAMENTO"){
                        echo "<select class='form-control' id='stat' name='STATUS' >
                        <option selected='selected'>ESPERANDO PAGAMENTO</option>
                        <option>PAGO</option>
                        </select>";
                    }

                echo "
                </div>
                  <div class='col'>
                    <label for='rg'>RG</label>
                    <input class='form-control' type='text' id='rg' name='RG' value=".$client['rg'].">
                  </div>
                  <div class='col'>
                    <label for='cpf'>CPF</label>
                    <input class='form-control' type='text' id='cpf' value=".$client['cpf']." name='CPF' pattern='\d{3}\.\d{3}\.\d{3}-\d{2}|\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}' title='Digite um CPF no formato: xxx.xxx.xxx-xx ou Digite um CNPJ no formato: xx.xxx.xxx/xxxx-xx'>
                  </div>
                </div>
                <div class='row mb-3'>
                  <div class='col'>
                      <label for='type'>Tipo</label>
                      ";

                      if($client['certType'] == "E-CPF A1"){
                        echo "<select class='form-control' id='type' name='TYPE' value=".$client['certType'].">
                        <option>E-CPF A1</option>
                        <option>E-CNPJ A1</option>
                      </select>";
                      }else if($client['certType'] == "E-CNPJ A1"){
                        echo "<select class='form-control' id='type' name='TYPE' value=".$client['certType'].">
                        <option>E-CNPJ A1</option>
                        <option>E-CPF A1</option>
                      </select>";
                      }
                echo "
                    </div>
                  <div class='col'>
                    <label for='COM'>COMISSÃO</label>
                    <input class='form-control' type='text' id='COM' name='COM' value=".$client['comission'].">
                  </div>
                </div>
                <div class='row mb-3'>
                  <div class='d-grid gap-2'>
                    <input type='hidden' name='CLIENTID' value=".$client['id'].">
                    <input class='btn btn-primary' type='submit'  value='Editar' name='edit'>
                  </div>
                </div>
                </form>
              </div>";
            }
        }
    }
}