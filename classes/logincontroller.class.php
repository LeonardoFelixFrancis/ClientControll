<?php

class logincontroller extends login{
    
    public function __construct($user, $pwd)
    {
        $this->user = $user;
        $this->pwd = $pwd;
    }    
    
    protected function errorHandler(){
        if($this->user == ''){
            array_push($this->error, 'User field is necessary');
            
        }
        if($this->pwd == ''){
            array_push($this->error, 'Pwd field is necessary');
        }
        $this->tryLoginUser($this->user,$this->pwd);
    }

    public function loginUser(){
        $this->errorHandler();
        if(!count($this->error)){
            $_SESSION['USERSESSION'] = $this->user;
        }else{
            session_destroy();
        }
    }

    public function returnErrors(){
        return $this->error;
    }
}