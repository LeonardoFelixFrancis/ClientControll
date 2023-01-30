<?php

class retrievePwd extends login{

    private $mail;

    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    public function resetPwd(){
        $dbMail = $this->getMail($this->mail);
        if($dbMail == $this->mail){
            return true;
        }
    }

    public function sendMail(){
        $subject = 'Recuperação de senha';
        $message = "Esse é um e-mail de recuperação de senha";
        $header = "From:leonardo@aprovarh.com.br";

        $mailSent = mail($this->mail, $subject, $message, $header);

        if($mailSent == true){
            echo "<div class='alert alert-success' role='alert'>
                    E-mail de recuperação enviado
                  </div>";
        }else{
            echo "<div class='alert alert-danger' role='alert'>
                    Erro ao enviar o E-mail de recuperação, tente novamente mais tarde
                </div>";
        }
    }
}