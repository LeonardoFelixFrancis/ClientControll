<?php

class digitalCertifyController extends digitalCertify{
    
    public function __construct($client = '', $clientDebt = '', $paymentDay = '', $status = '', $userid = '', $rg = '', $cpf = '', $file = '', $expDate = '', $mail = '', $phone = '', $origin = '', $type = '', $comission = '', $passed='')
    {
        $this->client = $client;
        $this->clientDebt = $clientDebt;
        $this->paymentDay = date('Y-m-d', strtotime($paymentDay));
        $this->status = $status;
        $this->userid = $userid;
        $this->rg = $rg;
        $this->cpf = $cpf;
        $this->filePath = dirname(__DIR__) . "/files/";
        $this->file = $file;
        $this->expDate = date('Y-m-d', strtotime($expDate));
        $this->mail = $mail;
        $this->phone = $phone;
        $this->origin = $origin;
        $this->type = $type;
        $this->comission = $comission;
        $this->passed = $passed;
    }

    private function errorHandler(){
        if($this->client == ''){
            array_push($this->error, "Client name field is necessary");
        }
        if($this->clientDebt == ''){
            array_push($this->error, "Client debt field is necessary");
        }
        if($this->paymentDay == ''){
            array_push($this->error, "Payment day field is necessary");
        }
        if($this->status == ''){
            array_push($this->error, "Status field is necessary");
        }
        if($this->userid == ''){
            array_push($this->error, 'User not logged in');
        }
        if($this->cpf == ''){
            array_push($this->error, "CPF field is necessary");
        }
        if($this->rg == ''){
            array_push($this->error, 'RG Field is necessary');
        }
        if($this->expDate == ''){
            array_push($this->error, "Expiration date is necessary");
        }


        $this->queryErrorHandler();

    }

    public function createClientTracker(){
        $this->errorHandler();
        print_r($this->error);
        if(!count($this->error)){
            $this->insertDigitalCertify();
            echo $this->lastId;
            mkdir($this->filePath.$this->lastId);
            $_SESSION['LASTID'] = $this->lastId;
            for($i=0;$i<count($this->file['name']);$i++){
                $filename = $this->file['name'][$i];
                move_uploaded_file($this->file['tmp_name'][$i], $this->filePath.$this->lastId.'/'.$filename);
            }
        }
    }

    public function deleteClient($clientId){
        $this->delId = $clientId;
        $this->connDeleteClient();
    }

    public function editClient($clientId){
        $this->changeId = $clientId;
        $this->updateClient();
    }
}